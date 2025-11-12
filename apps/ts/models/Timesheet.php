<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/ethiopian_date.php';

// Global storage for timesheet data (like Python's timesheet_storage)
global $timesheet_storage, $user_projects;
$timesheet_storage = $timesheet_storage ?? [];
$user_projects = $user_projects ?? [];

class Timesheet {
    public function getUserTimesheet($userId, $year, $month) {
        global $timesheet_storage;

        $key = "timesheet_{$userId}_{$year}_{$month}";
        return $timesheet_storage[$key] ?? $this->initializeUserTimesheet($userId, $year, $month);
    }

    public function saveUserTimesheet($userId, $year, $month, $data) {
        global $timesheet_storage;

        $key = "timesheet_{$userId}_{$year}_{$month}";
        $timesheet_storage[$key] = $data;
        return true;
    }

    private function initializeUserTimesheet($userId, $year, $month) {
        global $timesheet_storage;

        $key = "timesheet_{$userId}_{$year}_{$month}";
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Ensure monthDays is an integer
        if (!is_int($monthDays)) {
            error_log("ERROR: getEthiopianMonthDays returned non-integer: " . json_encode($monthDays));
            $monthDays = 30; // fallback
        }

        $timesheet_storage[$key] = [
            'projects' => [],
            'leave_entries' => [
                'vacation' => array_fill(1, (int)$monthDays, 0.0),
                'sick_leave' => array_fill(1, (int)$monthDays, 0.0),
                'holiday' => array_fill(1, (int)$monthDays, 0.0),
                'personal_leave' => array_fill(1, (int)$monthDays, 0.0),
                'bereavement' => array_fill(1, (int)$monthDays, 0.0),
                'other' => array_fill(1, (int)$monthDays, 0.0)
            ],
            'daily_totals' => array_fill(1, (int)$monthDays, 0.0),
            'leave_totals' => array_fill(1, (int)$monthDays, 0.0),
            'grand_totals' => array_fill(1, (int)$monthDays, 0.0)
        ];

        return $timesheet_storage[$key];
    }

    public function getUserProjects($userId, $year, $month) {
        global $user_projects;

        $key = "projects_{$userId}_{$year}_{$month}";
        return $user_projects[$key] ?? $this->initializeUserProjects($userId, $year, $month);
    }

    private function initializeUserProjects($userId, $year, $month) {
        global $user_projects;

        $key = "projects_{$userId}_{$year}_{$month}";
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Ensure monthDays is an integer
        if (!is_int($monthDays)) {
            error_log("ERROR: getEthiopianMonthDays returned non-integer in initializeUserProjects: " . json_encode($monthDays));
            $monthDays = 30; // fallback
        }

        $totalHours = $this->calculateTotalWorkingHours($year, $month);

        $user_projects[$key] = [
            [
                'id' => 1,
                'name' => 'MERQ Internal',
                'allocated_hours' => $totalHours,
                'total_hours' => 0.0,
                'hours' => []
            ]
        ];

        return $user_projects[$key];
    }

    public function addUserProject($userId, $year, $month, $projectName, $allocatedHours) {
        global $user_projects;

        $key = "projects_{$userId}_{$year}_{$month}";
        $projects = $this->getUserProjects($userId, $year, $month);

        // Generate new project ID
        $newId = max(array_column($projects, 'id'), 0) + 1;

        $newProject = [
            'id' => $newId,
            'name' => $projectName,
            'allocated_hours' => floatval($allocatedHours),
            'total_hours' => 0.0,
            'hours' => []
        ];

        $projects[] = $newProject;
        $user_projects[$key] = $projects;

        return $newProject;
    }

    public function deleteUserProject($userId, $year, $month, $projectId) {
        global $user_projects;

        $key = "projects_{$userId}_{$year}_{$month}";
        if (isset($user_projects[$key])) {
            $user_projects[$key] = array_filter($user_projects[$key], function($project) use ($projectId) {
                return $project['id'] != $projectId;
            });
        }
    }

    public function prefillDefaultHours($userId, $year, $month) {
        $timesheetData = $this->getUserTimesheet($userId, $year, $month);
        $projects = $this->getUserProjects($userId, $year, $month);
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        if (empty($projects)) {
            return false;
        }

        $firstProjectId = strval($projects[0]['id']);
        $prefilledData = [];

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
            $prefilledData[$day] = $defaultHours;
        }

        // Update totals and save
        $this->updateTotals($timesheetData, $year, $month);
        $this->saveUserTimesheet($userId, $year, $month, $timesheetData);

        return $prefilledData;
    }

    public function calculateTotals($userId, $year, $month) {
        $timesheetData = $this->getUserTimesheet($userId, $year, $month);
        $projects = $this->getUserProjects($userId, $year, $month);
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Ensure monthDays is an integer
        if (!is_int($monthDays)) {
            error_log("ERROR: getEthiopianMonthDays returned non-integer in calculateTotals: " . json_encode($monthDays));
            $monthDays = 30; // fallback
        }
        $monthDays = (int)$monthDays;

        // Calculate project totals with percentages
        $projectTotals = [];
        $totalWorkHours = 0;

        foreach ($projects as $project) {
            $projectId = strval($project['id']);
            $projectHours = isset($timesheetData['projects'][$projectId]) ? $timesheetData['projects'][$projectId] : [];
            $projectTotal = array_sum($projectHours);

            $projectTotals[] = [
                'name' => $project['name'],
                'total_hours' => $projectTotal,
                'allocated_hours' => $project['allocated_hours'],
                'equiv_days' => $projectTotal / 8,
                'percent_direct' => 0, // Will be calculated after all projects
                'percent_total' => 0  // Will be calculated after all projects
            ];
            $totalWorkHours += $projectTotal;
        }

        // Calculate percentages
        foreach ($projectTotals as &$project) {
            $project['percent_direct'] = $totalWorkHours > 0 ? ($project['total_hours'] / $totalWorkHours) * 100 : 0;
            $project['percent_total'] = ($monthDays * 8) > 0 ? ($project['total_hours'] / ($monthDays * 8)) * 100 : 0;
        }

        // Calculate leave totals
        $totalLeaveHours = 0;
        foreach ($timesheetData['leave_entries'] as $leaveData) {
            $totalLeaveHours += array_sum($leaveData);
        }

        $grandTotal = $totalWorkHours + $totalLeaveHours;

        return [
            'project_totals' => $projectTotals,
            'total_work_hours' => $totalWorkHours,
            'total_leave_hours' => $totalLeaveHours,
            'grand_total' => $grandTotal,
            'year' => $year,
            'month' => $month,
            'month_name' => ETHIOPIAN_MONTHS_AMHARIC[$month - 1]
        ];
    }

    private function calculateTotalWorkingHours($year, $month) {
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Ensure monthDays is an integer
        if (!is_int($monthDays)) {
            error_log("ERROR: getEthiopianMonthDays returned non-integer in calculateTotalWorkingHours: " . json_encode($monthDays));
            $monthDays = 30; // fallback
        }
        $monthDays = (int)$monthDays;

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

    private function updateTotals(&$timesheetData, $year, $month) {
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Ensure monthDays is an integer
        if (!is_int($monthDays)) {
            error_log("ERROR: getEthiopianMonthDays returned non-integer in updateTotals: " . json_encode($monthDays));
            $monthDays = 30; // fallback
        }

        // Reset totals
        $timesheetData['daily_totals'] = array_fill(1, (int)$monthDays, 0.0);
        $timesheetData['leave_totals'] = array_fill(1, (int)$monthDays, 0.0);
        $timesheetData['grand_totals'] = array_fill(1, (int)$monthDays, 0.0);

        // Calculate project totals
        foreach ($timesheetData['projects'] as $projectData) {
            foreach ($projectData as $day => $hours) {
                if ($day >= 1 && $day <= $monthDays) {
                    $timesheetData['daily_totals'][$day] += $hours;
                }
            }
        }

        // Calculate leave totals
        foreach ($timesheetData['leave_entries'] as $leaveData) {
            foreach ($leaveData as $day => $hours) {
                if ($day >= 1 && $day <= $monthDays) {
                    $timesheetData['leave_totals'][$day] += $hours;
                }
            }
        }

        // Calculate grand totals
        for ($day = 1; $day <= $monthDays; $day++) {
            $timesheetData['grand_totals'][$day] =
                $timesheetData['daily_totals'][$day] + $timesheetData['leave_totals'][$day];
        }
    }
}
?>