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

    // Get actual timesheet data from model
    $timesheetModel = new Timesheet();
    $timesheetData = $timesheetModel->getUserTimesheet($user['user_id'], $year, $month);

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