<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../controllers/ExportController.php';
require_once __DIR__ . '/../includes/utils.php';

SessionManager::start();

header('Content-Type: application/json');

if (!SessionManager::isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user = SessionManager::getUser();

// Handle GET requests for direct downloads
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $year = intval($_GET['year'] ?? date('Y'));
    $month = intval($_GET['month'] ?? date('n'));

    // Get actual timesheet data from session (not just model)
    $timesheetKey = "timesheet_{$user['user_id']}_{$year}_{$month}";

    // Initialize session data if not exists
    if (!isset($_SESSION[$timesheetKey])) {
        require_once __DIR__ . '/../includes/ethiopian_date.php';
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        $_SESSION[$timesheetKey] = [
            'projects' => [],
            'leave_entries' => [
                'vacation' => array_fill(1, $monthDays, 0.0),
                'sick_leave' => array_fill(1, $monthDays, 0.0),
                'holiday' => array_fill(1, $monthDays, 0.0),
                'personal_leave' => array_fill(1, $monthDays, 0.0),
                'bereavement' => array_fill(1, $monthDays, 0.0),
                'other' => array_fill(1, $monthDays, 0.0)
            ],
            'daily_totals' => array_fill(1, $monthDays, 0.0),
            'leave_totals' => array_fill(1, $monthDays, 0.0),
            'grand_totals' => array_fill(1, $monthDays, 0.0)
        ];
    }

    $timesheetData = $_SESSION[$timesheetKey];

    // Also get data from database to ensure we have all project hours
    $timesheetModel = new Timesheet();
    $dbTimesheetData = $timesheetModel->getUserTimesheet($user['user_id'], $year, $month);

    // Debug: Log what we're getting from database
    error_log("Database timesheet data projects: " . json_encode(array_keys($dbTimesheetData['projects'] ?? [])));
    error_log("Session timesheet data projects: " . json_encode(array_keys($timesheetData['projects'] ?? [])));

    // Merge database data with session data - prioritize session data (user entered hours)
    if (isset($dbTimesheetData['projects'])) {
        foreach ($dbTimesheetData['projects'] as $projectId => $projectHours) {
            // If we have session data for this project, merge it (session data takes priority)
            if (isset($timesheetData['projects'][$projectId]) && !empty($timesheetData['projects'][$projectId])) {
                // Session data exists, use it (this contains user-entered hours)
                error_log("Using session data for project $projectId");
            } else {
                // No session data, use database data
                $timesheetData['projects'][$projectId] = $projectHours;
                error_log("Using database data for project $projectId");
            }
        }
    }

    // Debug: Log final merged data
    error_log("Final merged projects: " . json_encode(array_keys($timesheetData['projects'])));
    foreach ($timesheetData['projects'] as $projectId => $hours) {
        $nonZeroDays = array_filter($hours, function ($h) {
            return $h > 0;
        });
        error_log("Project $projectId has " . count($nonZeroDays) . " days with hours > 0");
    }

    $exportController = new ExportController();
    $result = $exportController->exportToExcel($user, $timesheetData, $year, $month);

    if ($result['success']) {
        // Set headers for Excel file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $result['filename'] . '"');
        header('Content-Length: ' . filesize($result['filepath']));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Output file
        readfile($result['filepath']);

        // Clean up temp file
        if (file_exists($result['filepath'])) {
            unlink($result['filepath']);
        }
        exit;
    } else {
        http_response_code(500);
        echo json_encode($result);
        exit;
    }
}

// Handle POST requests for AJAX calls
$action = $_POST['action'] ?? '';

$exportController = new ExportController();

try {
    switch ($action) {
        case 'preview':
            $year = intval($_POST['year'] ?? date('Y'));
            $month = intval($_POST['month'] ?? date('n'));

            // Get actual timesheet data
            $timesheetModel = new Timesheet();
            $timesheetData = $timesheetModel->getUserTimesheet($user['user_id'], $year, $month);

            $preview = $exportController->generatePreview($user, $timesheetData, $year, $month);

            echo json_encode([
                'success' => true,
                'preview' => $preview
            ]);
            break;

        case 'export':
            $year = intval($_POST['year'] ?? date('Y'));
            $month = intval($_POST['month'] ?? date('n'));

            // Get actual timesheet data
            $timesheetModel = new Timesheet();
            $timesheetData = $timesheetModel->getUserTimesheet($user['user_id'], $year, $month);

            $result = $exportController->exportToExcel($user, $timesheetData, $year, $month);

            echo json_encode($result);
            break;

        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    error_log("Export API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Internal server error']);
}
?>