<?php
require_once __DIR__ . '/../includes/ethiopian_date.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../models/Timesheet.php';

class ExportController
{
    public function exportToExcel($userData, $timesheetData, $year, $month)
    {
        try {
            // Get projects data from session (similar to Flask version)
            $projectsKey = "projects_{$userData['user_id']}_{$year}_{$month}";
            $projects = isset($_SESSION[$projectsKey]) ? $_SESSION[$projectsKey] : [];

            // Generate Excel file
            $filename = $this->generateExcelFile($userData, $timesheetData, $projects, $year, $month);

            return [
                'success' => true,
                'message' => 'Excel file generated successfully',
                'filename' => $filename,
                'filepath' => sys_get_temp_dir() . '/' . $filename
            ];
        } catch (Exception $e) {
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

            // Update header content - use exact cell references from Flask version
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

            // Fill project data (rows 8-14) - exact positioning from Flask
            $projectIndex = 0;

            foreach ($projects as $project) {
                if ($projectIndex >= 7) break; // Template has space for 7 projects

                $row = 8 + $projectIndex; // Rows 8-14 for projects

                // Update project name in column C
                $safeCellUpdate('C' . $row, $project['name'] ?? 'Project ' . ($projectIndex + 1));

                // Get project hours from timesheet data
                $projectId = strval($project['id']);
                $projectHours = isset($timesheetData['projects'][$projectId]) ? $timesheetData['projects'][$projectId] : [];

                // Fill daily hours starting from column D (day 1 = column D, day 2 = column E, etc.)
                for ($day = 1; $day <= 31; $day++) { // Template supports up to 31 days
                    if ($day <= $monthDays && isset($projectHours[$day])) {
                        $hours = floatval($projectHours[$day]);
                        if ($hours > 0) {
                            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day); // Column D = day 1
                            $safeCellUpdate($columnLetter . $row, $hours);
                        }
                    }
                }

                $projectIndex++;
            }

            // Fill leave data (rows 16-21) - exact positioning from Flask
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
                for ($day = 1; $day <= 31; $day++) {
                    if ($day <= $monthDays && isset($leaveData[$day])) {
                        $hours = floatval($leaveData[$day]);
                        if ($hours > 0) {
                            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(3 + $day);
                            $safeCellUpdate($columnLetter . $row, $hours);
                        }
                    }
                }
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
