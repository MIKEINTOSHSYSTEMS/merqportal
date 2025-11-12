<?php
require_once __DIR__ . '/../includes/ethiopian_date.php';
require_once __DIR__ . '/../models/Timesheet.php';
require_once __DIR__ . '/../vendor/autoload.php'; // For PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController
{
    public function exportToExcel($userData, $timesheetData, $year, $month)
    {
        try {
            // Generate Excel file using template
            $result = $this->generateExcelFile($userData, $timesheetData, $year, $month);

            return [
                'success' => true,
                'message' => 'Excel file generated successfully',
                'filename' => $result['filename'],
                'filepath' => $result['filepath']
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

    private function generateExcelFile($userData, $timesheetData, $year, $month)
    {
        $templatePath = __DIR__ . '/../templates/MERQ_TIMESHEET_ETH-CAL_TEMPLATE.xlsx';

        if (!file_exists($templatePath)) {
            throw new Exception("Template file not found: " . $templatePath);
        }

        // Load the template
        $spreadsheet = IOFactory::load($templatePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $monthName = ETHIOPIAN_MONTHS_AMHARIC[$month - 1];
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);

        // Update header information
        $this->updateTemplateHeaders($worksheet, $userData, $year, $month, $monthName);

        // Fill project hours
        $this->fillProjectHours($worksheet, $timesheetData, $monthDays);

        // Fill leave hours
        $this->fillLeaveHours($worksheet, $timesheetData, $monthDays);

        // Update signature section with Ethiopian date
        $this->updateSignatureSection($worksheet, $userData);

        // Generate filename
        $cleanName = preg_replace('/[^a-zA-Z0-9_ -]/', '', $userData['full_name']);
        $cleanName = str_replace(' ', '_', trim($cleanName));
        $timestamp = date('Ymd_His');
        $filename = "{$cleanName}_{$monthName}_{$year}_MERQ_TIMESHEET_{$timestamp}.xlsx";

        // Save to temporary file
        $tempDir = sys_get_temp_dir();
        $filepath = $tempDir . '/' . $filename;

        $writer = new Xlsx($spreadsheet);
        $writer->save($filepath);

        return [
            'filename' => $filename,
            'filepath' => $filepath
        ];
    }

    private function updateTemplateHeaders($worksheet, $userData, $year, $month, $monthName)
    {
        // Update various header cells in the template
        $headerUpdates = [
            'AJ19' => "{$monthName} {$year}",
            'C25' => "{$monthName} {$year}",
            'AJ3' => "{$monthName} {$year}",
            'H5' => $userData['full_name'],
            'X4' => $monthName,
            'X5' => $year,
            'B29' => $userData['full_name'] // Employee name in signature
        ];

        foreach ($headerUpdates as $cell => $value) {
            if ($worksheet->cellExists($cell)) {
                $worksheet->setCellValue($cell, $value);
            }
        }

        // Update supervisor information if available
        if (isset($userData['supervisor_name']) && $worksheet->cellExists('P29')) {
            $worksheet->setCellValue('P29', $userData['supervisor_name']);
        }
        if (isset($userData['supervisor_position_title']) && $worksheet->cellExists('T29')) {
            $worksheet->setCellValue('T29', $userData['supervisor_position_title']);
        }
    }

    private function fillProjectHours($worksheet, $timesheetData, $monthDays)
    {
        // Clear existing project data (rows 8-14)
        for ($row = 8; $row <= 14; $row++) {
            $worksheet->setCellValue("C{$row}", ""); // Project name
            for ($day = 1; $day <= 31; $day++) {
                $col = $this->getColumnLetter(3 + $day); // Starting from column D
                $worksheet->setCellValue("{$col}{$row}", 0);
            }
        }

        // Fill project data
        if (isset($timesheetData['projects'])) {
            $row = 8;
            foreach ($timesheetData['projects'] as $projectId => $projectData) {
                if ($row > 14) break; // Only 7 projects max in template

                $projectName = $this->getProjectName($projectId);
                $worksheet->setCellValue("C{$row}", $projectName);

                // Fill daily hours
                foreach ($projectData as $day => $hours) {
                    if ($day >= 1 && $day <= $monthDays && $hours > 0) {
                        $col = $this->getColumnLetter(3 + $day);
                        $worksheet->setCellValue("{$col}{$row}", $hours);
                    }
                }
                $row++;
            }
        }
    }

    private function fillLeaveHours($worksheet, $timesheetData, $monthDays)
    {
        $leaveTypes = [
            'vacation' => 16,
            'sick_leave' => 17,
            'holiday' => 18,
            'personal_leave' => 19,
            'bereavement' => 20,
            'other' => 21
        ];

        // Clear existing leave data
        foreach ($leaveTypes as $row) {
            for ($day = 1; $day <= 31; $day++) {
                $col = $this->getColumnLetter(3 + $day);
                $worksheet->setCellValue("{$col}{$row}", 0);
            }
        }

        // Fill leave data
        if (isset($timesheetData['leave_entries'])) {
            foreach ($leaveTypes as $leaveType => $row) {
                if (isset($timesheetData['leave_entries'][$leaveType])) {
                    $leaveData = $timesheetData['leave_entries'][$leaveType];
                    foreach ($leaveData as $day => $hours) {
                        if ($day >= 1 && $day <= $monthDays && $hours > 0) {
                            $col = $this->getColumnLetter(3 + $day);
                            $worksheet->setCellValue("{$col}{$row}", $hours);
                        }
                    }
                }
            }
        }
    }

    private function updateSignatureSection($worksheet, $userData)
    {
        // Get current Ethiopian date
        $ethDate = EthiopianDateConverter::getCurrentEthiopianDate();
        $ethDateStr = "{$ethDate['day']}/{$ethDate['month']}/{$ethDate['year']}";

        // Update dates in signature section
        if ($worksheet->cellExists('K29')) {
            $worksheet->setCellValue('K29', $ethDateStr); // Employee date
        }
        if ($worksheet->cellExists('AJ29')) {
            $worksheet->setCellValue('AJ29', $ethDateStr); // Supervisor date
        }
    }

    private function getColumnLetter($columnIndex)
    {
        $letters = '';
        while ($columnIndex >= 0) {
            $letters = chr(65 + ($columnIndex % 26)) . $letters;
            $columnIndex = (int)($columnIndex / 26) - 1;
        }
        return $letters;
    }

    private function getProjectName($projectId)
    {
        // You might want to fetch the actual project name from database
        $projectModel = new Project();
        $project = $projectModel->getProjectById($projectId);
        return $project ? $project['project_name'] : "Project {$projectId}";
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
                    if ($day >= 1 && $day <= $monthDays) {
                        $dailyWorkHours[$day] += $hours;
                        $dailyGrandTotals[$day] += $hours;
                    }
                }
                $projectTotals[] = [
                    'id' => $projectId,
                    'name' => $this->getProjectName($projectId),
                    'total_hours' => $total
                ];
            }
        }

        // Calculate leave totals
        if (isset($timesheetData['leave_entries'])) {
            foreach ($timesheetData['leave_entries'] as $leaveType => $leaveData) {
                foreach ($leaveData as $day => $hours) {
                    $hours = floatval($hours);
                    if ($day >= 1 && $day <= $monthDays) {
                        $dailyLeaveHours[$day] += $hours;
                        $dailyGrandTotals[$day] += $hours;
                    }
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
}
