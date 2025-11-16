<?php
require_once __DIR__ . '/../includes/ethiopian_date.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../models/Timesheet.php';
require_once __DIR__ . '/../models/Project.php';

class ExportController
{
    public function exportToExcel($userData, $timesheetData, $year, $month)
    {
        try {
            // Get projects data from database
            $projectModel = new Project();
            $projects = $projectModel->getUserProjects($userData['user_id'], $year, $month);

            // Debug logging
            error_log("Exporting timesheet for user: " . $userData['user_id']);
            error_log("Year: $year, Month: $month");
            error_log("Projects count: " . count($projects));
            error_log("Timesheet data keys: " . implode(', ', array_keys($timesheetData)));

            if (isset($timesheetData['projects'])) {
                error_log("Projects in timesheet data: " . implode(', ', array_keys($timesheetData['projects'])));
            }

            // Generate Excel file with proper data
            $filename = $this->generateExcelFile($userData, $timesheetData, $projects, $year, $month);

            return [
                'success' => true,
                'message' => 'Excel file generated successfully',
                'filename' => $filename,
                'filepath' => sys_get_temp_dir() . '/' . $filename
            ];
        } catch (Exception $e) {
            error_log("Export error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to generate Excel file: ' . $e->getMessage()
            ];
        }
    }

    public function generatePreview($userData, $timesheetData, $year, $month)
    {
        $monthName = ETHIOPIAN_MONTHS_AMHARIC[$month - 1];
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        $totals = $this->calculateTotals($timesheetData, $monthDays);

        $preview = [
            'year' => $year,
            'month' => $month,
            'month_name' => $monthName,
            'project_totals' => array_map(function ($project) use ($totals) {
                $totalHours = $project['total_hours'];
                $allocatedHours = $project['allocated_hours'] ?? 0;
                return [
                    'name' => $project['name'],
                    'total_hours' => $totalHours,
                    'allocated_hours' => $allocatedHours,
                    'equiv_days' => $allocatedHours > 0 ? $totalHours / 8 : 0,
                    'percent_direct' => $totals['total_work_hours'] > 0 ? ($totalHours / $totals['total_work_hours']) * 100 : 0,
                    'percent_total' => ($totals['total_work_hours'] + $totals['total_leave_hours']) > 0 ?
                        ($totalHours / ($totals['total_work_hours'] + $totals['total_leave_hours'])) * 100 : 0
                ];
            }, $totals['project_totals']),
            'total_work_hours' => $totals['total_work_hours'],
            'total_leave_hours' => $totals['total_leave_hours'],
            'grand_total' => $totals['grand_total']
        ];

        return $preview;
    }

    private function calculateTotals($timesheetData, $monthDays)
    {
        $projectTotals = [];
        $dailyWorkHours = array_fill(1, $monthDays, 0.0);
        $dailyLeaveHours = array_fill(1, $monthDays, 0.0);
        $dailyGrandTotals = array_fill(1, $monthDays, 0.0);

        // Calculate project totals
        if (isset($timesheetData['projects'])) {
            foreach ($timesheetData['projects'] as $projectId => $projectData) {
                $total = 0;
                foreach ($projectData as $day => $hours) {
                    $hours = floatval($hours);
                    $total += $hours;
                    $dailyWorkHours[$day] += $hours;
                    $dailyGrandTotals[$day] += $hours;
                }
                $projectTotals[] = [
                    'id' => $projectId,
                    'name' => $projectData['name'] ?? 'Project ' . $projectId,
                    'total_hours' => $total
                ];
            }
        }

        // Calculate leave totals
        if (isset($timesheetData['leave_entries'])) {
            foreach ($timesheetData['leave_entries'] as $leaveType => $leaveData) {
                foreach ($leaveData as $day => $hours) {
                    $hours = floatval($hours);
                    $dailyLeaveHours[$day] += $hours;
                    $dailyGrandTotals[$day] += $hours;
                }
            }
        }

        return [
            'project_totals' => $projectTotals,
            'daily_work_hours' => $dailyWorkHours,
            'daily_leave_hours' => $dailyLeaveHours,
            'daily_grand_totals' => $dailyGrandTotals,
            'total_work_hours' => array_sum($dailyWorkHours),
            'total_leave_hours' => array_sum($dailyLeaveHours),
            'grand_total' => array_sum($dailyGrandTotals)
        ];
    }

    private function generateExcelFile($userData, $timesheetData, $projects, $year, $month)
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        $templatePath = __DIR__ . '/../templates/MERQ_TIMESHEET_ETH-CAL_TEMPLATE.xlsx';

        if (!file_exists($templatePath)) {
            throw new Exception('Template file not found: ' . $templatePath);
        }

        try {
            // Load the Excel template
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);
            $worksheet = $spreadsheet->getActiveSheet();

            $monthName = ETHIOPIAN_MONTHS_AMHARIC[$month - 1];
            $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

            // Safe method to update cells (handles merged cells)
            $safeCellUpdate = function ($cellRef, $value) use ($worksheet) {
                try {
                    // Check if cell is part of a merged range and unmerge if needed
                    $cell = $worksheet->getCell($cellRef);
                    $mergedRanges = $worksheet->getMergeCells();
                    foreach ($mergedRanges as $mergedRange) {
                        if ($cell->isInRange($mergedRange)) {
                            $worksheet->unmergeCells($mergedRange);
                            break;
                        }
                    }
                    $worksheet->setCellValue($cellRef, $value);
                    return true;
                } catch (Exception $e) {
                    error_log("Warning: Could not update cell $cellRef: " . $e->getMessage());
                    return false;
                }
            };

            // Update header content
            $headerUpdates = [
                ['AJ19', "$monthName $year"],
                ['C25', "$monthName $year"],
                ['AJ3', "$monthName $year"],
                ['H5', $userData['full_name']],
                ['X4', $monthName],
                ['X5', $year]
            ];

            foreach ($headerUpdates as $update) {
                $safeCellUpdate($update[0], $update[1]);
            }

            // Fill DATE row (Row 6: D6 to AG6)
            for ($day = 1; $day <= $monthDays; $day++) {
                $ethDate = EthiopianDateConverter::formatEthiopianDate($day, $month, $year);
                $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day); // Column D = day 1
                $cellRef = $column . '6';
                $safeCellUpdate($cellRef, $ethDate);
            }

            // Fill WEEKDAY row (Row 7: D7 to AG7)
            for ($day = 1; $day <= $monthDays; $day++) {
                $weekdayIndex = EthiopianDateConverter::getEthiopianWeekday($year, $month, $day);
                $weekdayAmharic = ETHIOPIAN_WEEKDAYS_AMHARIC[$weekdayIndex];
                $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                $cellRef = $column . '7';
                $safeCellUpdate($cellRef, $weekdayAmharic);
            }

            // Fill PROJECT HOURS (Rows 8-14: D8 to AG14)
            $projectIndex = 0;
            foreach ($projects as $project) {
                if ($projectIndex >= 7) break; // Template has space for 7 projects

                $row = 8 + $projectIndex; // Rows 8-14 for projects

                // Update project name in column C
                $safeCellUpdate('C' . $row, $project['project_name'] ?? 'Project ' . ($projectIndex + 1));

                // Get project hours from timesheet data
                $projectId = strval($project['project_id'] ?? $project['id']);
                $projectHours = isset($timesheetData['projects'][$projectId]) ? $timesheetData['projects'][$projectId] : [];

                // Fill daily hours starting from column D (day 1 = column D, day 2 = column E, etc.)
                for ($day = 1; $day <= $monthDays; $day++) {
                    if (isset($projectHours[$day])) {
                        $hours = floatval($projectHours[$day]);
                        if ($hours > 0) {
                            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                            $cellRef = $columnLetter . $row;
                            $safeCellUpdate($cellRef, $hours);
                        }
                    }
                }

                $projectIndex++;
            }

            // Fill LEAVE HOURS (Rows 16-21: D16 to AG21)
            $leaveTypes = [
                ['vacation', 16],
                ['sick_leave', 17],
                ['holiday', 18],
                ['personal_leave', 19],
                ['bereavement', 20],
                ['other', 21]
            ];

            foreach ($leaveTypes as $leaveInfo) {
                $leaveKey = $leaveInfo[0];
                $row = $leaveInfo[1];

                $leaveData = isset($timesheetData['leave_entries'][$leaveKey]) ? $timesheetData['leave_entries'][$leaveKey] : [];

                // Fill daily leave hours starting from column D
                for ($day = 1; $day <= $monthDays; $day++) {
                    if (isset($leaveData[$day])) {
                        $hours = floatval($leaveData[$day]);
                        if ($hours > 0) {
                            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                            $cellRef = $columnLetter . $row;
                            $safeCellUpdate($cellRef, $hours);
                        }
                    }
                }
            }

            // Calculate and fill TOTALS (Rows 23-25: D23 to AG25)

            // Row 23: Total Direct Work (sum of projects)
            for ($day = 1; $day <= $monthDays; $day++) {
                $totalDirect = 0;
                foreach ($projects as $project) {
                    $projectId = strval($project['project_id'] ?? $project['id']);
                    $projectHours = isset($timesheetData['projects'][$projectId]) ? $timesheetData['projects'][$projectId] : [];
                    $totalDirect += isset($projectHours[$day]) ? floatval($projectHours[$day]) : 0;
                }

                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                $cellRef = $columnLetter . '23';
                $safeCellUpdate($cellRef, $totalDirect);
            }

            // Row 24: Total Leave (sum of all leave types)
            for ($day = 1; $day <= $monthDays; $day++) {
                $totalLeave = 0;
                foreach ($leaveTypes as $leaveInfo) {
                    $leaveKey = $leaveInfo[0];
                    $leaveData = isset($timesheetData['leave_entries'][$leaveKey]) ? $timesheetData['leave_entries'][$leaveKey] : [];
                    $totalLeave += isset($leaveData[$day]) ? floatval($leaveData[$day]) : 0;
                }

                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                $cellRef = $columnLetter . '24';
                $safeCellUpdate($cellRef, $totalLeave);
            }

            // Row 25: Grand Total (Direct Work + Leave)
            for ($day = 1; $day <= $monthDays; $day++) {
                $totalDirect = 0;
                foreach ($projects as $project) {
                    $projectId = strval($project['project_id'] ?? $project['id']);
                    $projectHours = isset($timesheetData['projects'][$projectId]) ? $timesheetData['projects'][$projectId] : [];
                    $totalDirect += isset($projectHours[$day]) ? floatval($projectHours[$day]) : 0;
                }

                $totalLeave = 0;
                foreach ($leaveTypes as $leaveInfo) {
                    $leaveKey = $leaveInfo[0];
                    $leaveData = isset($timesheetData['leave_entries'][$leaveKey]) ? $timesheetData['leave_entries'][$leaveKey] : [];
                    $totalLeave += isset($leaveData[$day]) ? floatval($leaveData[$day]) : 0;
                }

                $grandTotal = $totalDirect + $totalLeave;
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                $cellRef = $columnLetter . '25';
                $safeCellUpdate($cellRef, $grandTotal);
            }

            // Update signature section with Ethiopian date
            $currentDate = new DateTime();
            $ethDate = EthiopianDateConverter::gregorianToEthiopian($currentDate->format('Y-m-d'));
            $ethDateStr = sprintf("%02d/%02d/%04d", $ethDate['day'], $ethDate['month'], $ethDate['year']);

            $signatureUpdates = [
                ['K29', $ethDateStr], // Employee date
                ['AJ29', $ethDateStr], // Supervisor date
                ['B29', $userData['full_name']] // Employee name
            ];

            // Update supervisor information if available
            if (isset($userData['supervisor_name']) && $userData['supervisor_name']) {
                $signatureUpdates[] = ['P29', $userData['supervisor_name']];
            }
            if (isset($userData['supervisor_position_title']) && $userData['supervisor_position_title']) {
                $signatureUpdates[] = ['T29', $userData['supervisor_position_title']];
            }

            foreach ($signatureUpdates as $update) {
                $safeCellUpdate($update[0], $update[1]);
            }

            // Generate filename
            $safeName = preg_replace('/[^A-Za-z0-9\-_]/', '_', $userData['full_name']);
            $filename = 'MERQ_Timesheet_' . $safeName . '_' . $monthName . '_' . $year . '.xlsx';

            // Save the modified Excel file
            $filepath = sys_get_temp_dir() . '/' . $filename;
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filepath);

            return $filename;
        } catch (Exception $e) {
            throw new Exception('Failed to generate Excel file: ' . $e->getMessage());
        }
    }
}
