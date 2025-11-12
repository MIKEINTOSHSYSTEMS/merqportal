<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../includes/ethiopian_date.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../models/Timesheet.php';
require_once __DIR__ . '/../models/Project.php';

SessionManager::start();
header('Content-Type: application/json');

if (!SessionManager::isLoggedIn()) {
    Utils::jsonResponse(['error' => 'Unauthorized'], 401);
}

$currentUser = SessionManager::getUser();
$userId = $currentUser['user_id'];
$timesheetModel = new Timesheet();
$projectModel = new Project();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['action'])) {
        switch ($input['action']) {
            case 'load':
                $year = intval($input['year'] ?? 0);
                $month = intval($input['month'] ?? 0);

                if (!$year || !$month) {
                    Utils::jsonResponse(['error' => 'Year and month are required'], 400);
                }

                $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
                $timesheetData = initializeUserTimesheet($userId, $year, $month, $monthDays);

                // Generate calendar data
                $calendarData = [];
                for ($day = 1; $day <= $monthDays; $day++) {
                    $weekdayIndex = EthiopianDateConverter::getEthiopianWeekday($year, $month, $day);
                    $ethDate = EthiopianDateConverter::formatEthiopianDate($day, $month, $year);

                    $calendarData[] = [
                        'day' => $day,
                        'date' => $ethDate,
                        'weekday_amharic' => ETHIOPIAN_WEEKDAYS_AMHARIC[$weekdayIndex],
                        'weekday_english' => ETHIOPIAN_WEEKDAYS_ENGLISH[$weekdayIndex],
                        'is_weekend' => $weekdayIndex >= 5
                    ];
                }

                // Get user projects from database
                $projects = $projectModel->getUserProjects($userId, $year, $month);

                // Ensure we always have at least the MERQ Internal project
                $hasMerqInternal = false;
                foreach ($projects as $project) {
                    if (strtolower($project['project_name']) === 'merq internal') {
                        $hasMerqInternal = true;
                        break;
                    }
                }

                if (!$hasMerqInternal) {
                    $totalHours = calculateTotalWorkingHours($year, $month);
                    $newProject = $projectModel->addUserProject($userId, $year, $month, 'MERQ Internal', $totalHours);
                    if ($newProject) {
                        $projects[] = $newProject;
                    }
                }

                // Populate project hours from database
                foreach ($projects as &$project) {
                    $projectId = strval($project['project_id'] ?? $project['id']);
                    $project['hours'] = $projectModel->getProjectHours($userId, $year, $month, $projectId);

                    // Also populate in timesheetData for consistency
                    $timesheetData['projects'][$projectId] = $project['hours'];
                }

                Utils::jsonResponse([
                    'calendar' => $calendarData,
                    'timesheet_data' => $timesheetData,
                    'projects' => $projects,
                    'month_days' => $monthDays
                ]);
                break;

            case 'save':
                $year = intval($input['year'] ?? 0);
                $month = intval($input['month'] ?? 0);
                $projectHours = $input['project_hours'] ?? [];
                $leaveHours = $input['leave_hours'] ?? [];

                if (!$year || !$month) {
                    Utils::jsonResponse(['error' => 'Year and month are required'], 400);
                }

                $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
                $timesheetData = initializeUserTimesheet($userId, $year, $month, $monthDays);

                // Save project hours using Project model
                foreach ($projectHours as $projectId => $hoursData) {
                    if (!isset($timesheetData['projects'][$projectId])) {
                        $timesheetData['projects'][$projectId] = [];
                    }

                    foreach ($hoursData as $day => $hours) {
                        $dayNum = intval($day);
                        $hoursFloat = floatval($hours);
                        
                        if ($dayNum >= 1 && $dayNum <= $monthDays) {
                            $timesheetData['projects'][$projectId][$dayNum] = $hoursFloat;

                            // Save to database using Project model
                            $projectModel->updateProjectHours($userId, $year, $month, $projectId, $dayNum, $hoursFloat);
                        }
                    }
                }

                // Save leave hours
                foreach ($leaveHours as $leaveType => $hoursData) {
                    if (isset($timesheetData['leave_entries'][$leaveType])) {
                        foreach ($hoursData as $day => $hours) {
                            $dayNum = intval($day);
                            if ($dayNum >= 1 && $dayNum <= $monthDays) {
                                $timesheetData['leave_entries'][$leaveType][$dayNum] = floatval($hours);
                            }
                        }
                    }
                }

                // Update totals
                updateAllTotals($userId, $year, $month);

                Utils::jsonResponse([
                    'success' => true,
                    'message' => 'Timesheet saved successfully',
                    'totals' => [
                        'daily_totals' => $timesheetData['daily_totals'],
                        'leave_totals' => $timesheetData['leave_totals'],
                        'grand_totals' => $timesheetData['grand_totals']
                    ]
                ]);
                break;

            case 'clear':
                $year = intval($input['year'] ?? 0);
                $month = intval($input['month'] ?? 0);

                if (!$year || !$month) {
                    Utils::jsonResponse(['error' => 'Year and month are required'], 400);
                }

                $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

                // Clear timesheet data
                $timesheetKey = "timesheet_{$userId}_{$year}_{$month}";
                if (isset($_SESSION[$timesheetKey])) {
                    // Clear project hours
                    foreach ($_SESSION[$timesheetKey]['projects'] as $projectId => $projectData) {
                        $_SESSION[$timesheetKey]['projects'][$projectId] = array_fill(1, $monthDays, 0.0);

                        // Clear hours in database for each day
                        for ($day = 1; $day <= $monthDays; $day++) {
                            $projectModel->updateProjectHours($userId, $year, $month, $projectId, $day, 0.0);
                        }
                    }

                    // Clear all leave hours
                    foreach ($_SESSION[$timesheetKey]['leave_entries'] as $leaveType => $leaveData) {
                        $_SESSION[$timesheetKey]['leave_entries'][$leaveType] = array_fill(1, $monthDays, 0.0);
                    }

                    // Reset totals
                    $_SESSION[$timesheetKey]['daily_totals'] = array_fill(1, $monthDays, 0.0);
                    $_SESSION[$timesheetKey]['leave_totals'] = array_fill(1, $monthDays, 0.0);
                    $_SESSION[$timesheetKey]['grand_totals'] = array_fill(1, $monthDays, 0.0);
                }

                Utils::jsonResponse([
                    'success' => true,
                    'message' => 'Timesheet cleared successfully',
                    'totals' => [
                        'daily_totals' => array_fill(1, $monthDays, 0.0),
                        'leave_totals' => array_fill(1, $monthDays, 0.0),
                        'grand_totals' => array_fill(1, $monthDays, 0.0)
                    ]
                ]);
                break;                

            case 'prefill':
                $year = intval($input['year'] ?? 0);
                $month = intval($input['month'] ?? 0);

                Utils::logToFile("Prefill request for user $userId, year $year, month $month");

                if (!$year || !$month) {
                    Utils::jsonResponse(['error' => 'Year and month are required'], 400);
                }

                $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
                $timesheetData = initializeUserTimesheet($userId, $year, $month, $monthDays);

                // Get first project (MERQ Internal)
                $projects = $projectModel->getUserProjects($userId, $year, $month);
                if (empty($projects)) {
                    Utils::jsonResponse(['error' => 'No projects found'], 400);
                }

                // Use project_id instead of id
                $firstProject = $projects[0];
                $firstProjectId = strval($firstProject['project_id'] ?? $firstProject['id']);
                $prefilledData = [];

                Utils::logToFile("Prefilling hours for project $firstProjectId, month has $monthDays days");

                // Prefill hours based on weekdays
                for ($day = 1; $day <= $monthDays; $day++) {
                    $weekdayIndex = EthiopianDateConverter::getEthiopianWeekday($year, $month, $day);

                    // Set default hours based on weekday
                    if ($weekdayIndex < 4) { // Monday-Thursday: 8 hours
                        $defaultHours = 8.0;
                    } elseif ($weekdayIndex == 4) { // Friday: 8 hours
                        $defaultHours = 8.0;
                    } elseif ($weekdayIndex == 5) { // Saturday: 4 hours
                        $defaultHours = 4.0;
                    } else { // Sunday: 0 hours
                        $defaultHours = 0.0;
                    }

                    // Set hours for first project
                    if (!isset($timesheetData['projects'][$firstProjectId])) {
                        $timesheetData['projects'][$firstProjectId] = [];
                    }
                    $timesheetData['projects'][$firstProjectId][$day] = $defaultHours;
                    $prefilledData[strval($day)] = $defaultHours;

                    // Save to database
                    $projectModel->updateProjectHours($userId, $year, $month, $firstProjectId, $day, $defaultHours);

                    Utils::logToFile("Day $day: weekday $weekdayIndex, hours $defaultHours");
                }

                // Save the updated timesheet data to session
                $timesheetKey = "timesheet_{$userId}_{$year}_{$month}";
                $_SESSION[$timesheetKey] = $timesheetData;

                // Update totals and save
                updateAllTotals($userId, $year, $month);

                // Get updated project data from database
                $updatedProjects = $projectModel->getUserProjects($userId, $year, $month);
                foreach ($updatedProjects as &$project) {
                    $projectId = strval($project['project_id'] ?? $project['id']);
                    $project['hours'] = $projectModel->getProjectHours($userId, $year, $month, $projectId);
                }

                // Get updated totals
                updateAllTotals($userId, $year, $month);
                $updatedData = $_SESSION[$timesheetKey];

                Utils::logToFile("Prefill completed, returning data for " . count($prefilledData) . " days");

                Utils::jsonResponse([
                    'success' => true,
                    'message' => 'Default hours prefilled successfully',
                    'prefilled_data' => $prefilledData,
                    'projects' => $updatedProjects,
                    'timesheet_data' => $updatedData,
                    'totals' => [
                        'daily_totals' => $updatedData['daily_totals'],
                        'leave_totals' => $updatedData['leave_totals'],
                        'grand_totals' => $updatedData['grand_totals']
                    ]
                ]);
                break;

            case 'add_projects':
                $year = intval($input['year'] ?? 0);
                $month = intval($input['month'] ?? 0);
                $projectIds = $input['project_ids'] ?? [];
                $allocatedHours = floatval($input['allocated_hours'] ?? 0);

                if (!$year || !$month) {
                    Utils::jsonResponse(['error' => 'Year and month are required'], 400);
                }

                if (empty($projectIds)) {
                    Utils::jsonResponse(['error' => 'No projects selected'], 400);
                }

                // Add projects to user's allocations
                $addedProjects = [];
                foreach ($projectIds as $projectId) {
                    // Get project name first
                    $project = $projectModel->getProjectById($projectId);
                    if ($project) {
                        $result = $projectModel->addUserProject($userId, $year, $month, $project['project_name'], $allocatedHours);
                        if ($result) {
                            $addedProjects[] = $result;
                        }
                    }
                }

                if (!empty($addedProjects)) {
                    Utils::jsonResponse([
                        'success' => true,
                        'message' => count($addedProjects) . ' project(s) added successfully',
                        'added_projects' => $addedProjects
                    ]);
                } else {
                    Utils::jsonResponse(['error' => 'Failed to add projects'], 500);
                }
                break;                

            case 'preview':
                $year = intval($input['year'] ?? 0);
                $month = intval($input['month'] ?? 0);

                if (!$year || !$month) {
                    Utils::jsonResponse(['error' => 'Year and month are required'], 400);
                }

                $previewData = calculateTimesheetTotals($userId, $year, $month);
                $previewData['year'] = $year;
                $previewData['month'] = $month;
                $previewData['month_name'] = ETHIOPIAN_MONTHS_AMHARIC[$month - 1];

                Utils::jsonResponse([
                    'success' => true,
                    'preview_data' => $previewData
                ]);
                break;

            default:
                Utils::jsonResponse(['error' => 'Invalid action'], 400);
        }
    } else {
        Utils::jsonResponse(['error' => 'No action specified'], 400);
    }
} else {
    Utils::jsonResponse(['error' => 'Invalid request method'], 405);
}

// Helper functions matching Flask version
function initializeUserTimesheet($userId, $year, $month, $monthDays) {
    global $timesheetModel;

    $timesheetKey = "timesheet_{$userId}_{$year}_{$month}";

    if (!isset($_SESSION[$timesheetKey])) {
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

    return $_SESSION[$timesheetKey];
}

function calculateTotalWorkingHours($year, $month) {
    $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
    $totalHours = 0.0;

    for ($day = 1; $day <= $monthDays; $day++) {
        $weekdayIndex = EthiopianDateConverter::getEthiopianWeekday($year, $month, $day);

        if ($weekdayIndex < 4) {
            $dayHours = 8.0;
        } elseif ($weekdayIndex == 4) {
            $dayHours = 8.0;
        } elseif ($weekdayIndex == 5) {
            $dayHours = 4.0;
        } else {
            $dayHours = 0.0;
        }

        $totalHours += $dayHours;
    }

    return $totalHours;
}

function updateAllTotals($userId, $year, $month) {
    $timesheetKey = "timesheet_{$userId}_{$year}_{$month}";

    if (!isset($_SESSION[$timesheetKey])) {
        return;
    }

    $timesheetData = &$_SESSION[$timesheetKey];
    $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

    // Reset totals
    $timesheetData['daily_totals'] = array_fill(1, $monthDays, 0.0);
    $timesheetData['leave_totals'] = array_fill(1, $monthDays, 0.0);
    $timesheetData['grand_totals'] = array_fill(1, $monthDays, 0.0);

    // Calculate project totals
    foreach ($timesheetData['projects'] as $projectId => $projectData) {
        foreach ($projectData as $day => $hours) {
            if ($day >= 1 && $day <= $monthDays) {
                $hours = floatval($hours);
                $timesheetData['daily_totals'][$day] += $hours;
                $timesheetData['grand_totals'][$day] += $hours;
            }
        }
    }

    // Calculate leave totals
    foreach ($timesheetData['leave_entries'] as $leaveType => $leaveData) {
        foreach ($leaveData as $day => $hours) {
            if ($day >= 1 && $day <= $monthDays) {
                $hours = floatval($hours);
                $timesheetData['leave_totals'][$day] += $hours;
                $timesheetData['grand_totals'][$day] += $hours;
            }
        }
    }
}

function calculateTimesheetTotals($userId, $year, $month) {
    $timesheetKey = "timesheet_{$userId}_{$year}_{$month}";

    if (!isset($_SESSION[$timesheetKey])) {
        return [
            'project_totals' => [],
            'daily_totals' => [],
            'leave_totals' => [],
            'grand_totals' => [],
            'total_work_hours' => 0,
            'total_leave_hours' => 0,
            'grand_total' => 0
        ];
    }

    $timesheetData = $_SESSION[$timesheetKey];
    $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

    // Get projects from database
    $projectModel = new Project();
    $projects = $projectModel->getUserProjects($userId, $year, $month);

    // Calculate project totals with percentages
    $projectTotals = [];
    $totalWorkHours = array_sum($timesheetData['daily_totals']);
    $totalLeaveHours = array_sum($timesheetData['leave_totals']);
    $grandTotal = $totalWorkHours + $totalLeaveHours;

    foreach ($projects as $project) {
        $projectId = strval($project['project_id'] ?? $project['id']);
        $projectTotal = isset($timesheetData['projects'][$projectId]) ?
            array_sum($timesheetData['projects'][$projectId]) : 0.0;
        $allocatedHours = $project['allocated_hours'] ?? 0;

        $projectTotals[] = [
            'name' => $project['project_name'] ?? $project['name'],
            'total_hours' => $projectTotal,
            'allocated_hours' => $allocatedHours,
            'equiv_days' => $projectTotal / 8,
            'percent_direct' => $totalWorkHours > 0 ? ($projectTotal / $totalWorkHours) * 100 : 0,
            'percent_total' => $grandTotal > 0 ? ($projectTotal / $grandTotal) * 100 : 0
        ];
    }

    return [
        'project_totals' => $projectTotals,
        'daily_totals' => $timesheetData['daily_totals'],
        'leave_totals' => $timesheetData['leave_totals'],
        'grand_totals' => $timesheetData['grand_totals'],
        'total_work_hours' => $totalWorkHours,
        'total_leave_hours' => $totalLeaveHours,
        'grand_total' => $grandTotal
    ];
}
?>