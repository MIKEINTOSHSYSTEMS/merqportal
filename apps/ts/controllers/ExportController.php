<?php
require_once __DIR__ . '/../includes/ethiopian_date.php';
require_once __DIR__ . '/../models/Timesheet.php';

class ExportController {
    public function exportToExcel($userData, $timesheetData, $year, $month) {
        try {
            // Generate Excel file
            $filename = $this->generateExcelFile($userData, $timesheetData, $year, $month);

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

    public function generatePreview($userData, $timesheetData, $year, $month) {
        $monthName = ETHIOPIAN_MONTHS_AMHARIC[$month - 1];
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        $totals = $this->calculateTotals($timesheetData, $monthDays);

        $preview = [
            'year' => $year,
            'month' => $month,
            'month_name' => $monthName,
            'project_totals' => array_map(function($project) use ($totals) {
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

    private function calculateTotals($timesheetData, $monthDays) {
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

    private function generateExcelFile($userData, $timesheetData, $year, $month)
    {
        require_once __DIR__ . '/../includes/excel_formatter.php';

        $monthName = ETHIOPIAN_MONTHS_AMHARIC[$month - 1];
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Create workbook
        $workbook = new \PHPExcel();
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('Timesheet');

        // Set headers
        $worksheet->setCellValue('A1', 'MERQ CONSULTANCY PLC');
        $worksheet->setCellValue('A2', 'ወርሃዊ የስራ ሰዓት መከታተያ / Monthly Timesheet Tracker');
        $worksheet->setCellValue('A4', 'Employee Name:');
        $worksheet->setCellValue('B4', $userData['full_name']);
        $worksheet->setCellValue('A5', 'Month:');
        $worksheet->setCellValue('B5', $monthName . ' ' . $year);

        // Create calendar header
        $worksheet->setCellValue('A7', 'Date');
        $worksheet->setCellValue('B7', 'Day');

        // Add project columns
        $colIndex = 2;
        if (isset($timesheetData['projects'])) {
            foreach ($timesheetData['projects'] as $projectId => $projectData) {
                $worksheet->setCellValueByColumnAndRow($colIndex++, 6, $projectData['name'] ?? 'Project');
            }
        }

        // Add leave columns
        $leaveTypes = ['vacation', 'sick_leave', 'holiday', 'personal_leave', 'bereavement', 'other'];
        foreach ($leaveTypes as $leaveType) {
            $worksheet->setCellValueByColumnAndRow($colIndex++, 6, ucfirst(str_replace('_', ' ', $leaveType)));
        }

        $worksheet->setCellValueByColumnAndRow($colIndex++, 6, 'Total Hours');

        // Fill data rows
        for ($day = 1; $day <= $monthDays; $day++) {
            $row = $day + 7;

            // Date and weekday
            $ethDate = EthiopianDateConverter::formatEthiopianDate($day, $month, $year);
            $weekdayIndex = EthiopianDateConverter::getEthiopianWeekday($year, $month, $day);
            $weekday = ETHIOPIAN_WEEKDAYS_AMHARIC[$weekdayIndex];

            $worksheet->setCellValueByColumnAndRow(0, $row, $ethDate);
            $worksheet->setCellValueByColumnAndRow(1, $row, $weekday);

            $colIndex = 2;
            $dailyTotal = 0;

            // Project hours
            if (isset($timesheetData['projects'])) {
                foreach ($timesheetData['projects'] as $projectId => $projectData) {
                    $hours = isset($projectData[$day]) ? floatval($projectData[$day]) : 0;
                    $worksheet->setCellValueByColumnAndRow($colIndex++, $row, $hours);
                    $dailyTotal += $hours;
                }
            }

            // Leave hours
            foreach ($leaveTypes as $leaveType) {
                $hours = isset($timesheetData['leave_entries'][$leaveType][$day]) ?
                    floatval($timesheetData['leave_entries'][$leaveType][$day]) : 0;
                $worksheet->setCellValueByColumnAndRow($colIndex++, $row, $hours);
                $dailyTotal += $hours;
            }

            // Daily total
            $worksheet->setCellValueByColumnAndRow($colIndex++, $row, $dailyTotal);
        }

        // Generate filename
        $filename = 'MERQ_Timesheet_' . $userData['full_name'] . '_' . $monthName . '_' . $year . '.xlsx';

        // Save file
        $filepath = sys_get_temp_dir() . '/' . $filename;
        $writer = \PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
        $writer->save($filepath);

        return $filename;
    }
}