<?php
// export.php - Bulk export functionality
require_once 'config.php';

// Get export type
$type = $_GET['type'] ?? 'excel';
$employeeFilter = $_GET['employee'] ?? '';
$perspectiveFilter = $_GET['perspective'] ?? '';
$categoryFilter = $_GET['category'] ?? '';

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Filter data if needed
if (!empty($employeeFilter) && isset($employeeEvaluations[$employeeFilter])) {
    $employeeEvaluations = [$employeeFilter => $employeeEvaluations[$employeeFilter]];
}

// Additional filtering
$filteredEvaluations = [];
foreach ($employeeEvaluations as $employeeId => $data) {
    // Filter by perspective
    if (!empty($perspectiveFilter) && (!isset($data['perspective_counts'][$perspectiveFilter]) || $data['perspective_counts'][$perspectiveFilter] == 0)) {
        continue;
    }

    // Filter by category
    if (!empty($categoryFilter) && $data['performance_category'] !== $categoryFilter) {
        continue;
    }

    $filteredEvaluations[$employeeId] = $data;
}

if ($type === 'excel') {
    exportToExcel($filteredEvaluations);
} elseif ($type === 'pdf') {
    exportToPDF($filteredEvaluations);
}

// Excel export function
function exportToExcel($employeeEvaluations)
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="merq_performance_evaluation_' . date('Y-m-d') . '.xls"');

    echo "<table border='1'>";
    echo "<tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Weighted Score</th>
            <th>Performance Category</th>
            <th>Self-evaluation</th>
            <th>Supervisor</th>
            <th>Subordinate</th>
            <th>Colleague</th>
            <th>Other</th>
            <th>Total Evaluations</th>
        </tr>";

    foreach ($employeeEvaluations as $employeeId => $data) {
        $employee = $data['details'];
        $perspectiveCounts = $data['perspective_counts'];

        echo "<tr>
                <td>" . htmlspecialchars($employeeId) . "</td>
                <td>" . htmlspecialchars($employee['full_name'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($employee['position_title'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($employee['department_name'] ?? 'N/A') . "</td>
                <td>" . round($data['weighted_score'], 2) . "%</td>
                <td>" . htmlspecialchars($data['performance_category']) . "</td>
                <td>" . ($perspectiveCounts['Self-evaluation'] ?? 0) . "</td>
                <td>" . ($perspectiveCounts['Supervisor'] ?? 0) . "</td>
                <td>" . ($perspectiveCounts['Subordinate'] ?? 0) . "</td>
                <td>" . ($perspectiveCounts['Colleague'] ?? 0) . "</td>
                <td>" . ($perspectiveCounts['Other'] ?? 0) . "</td>
                <td>" . array_sum($perspectiveCounts) . "</td>
            </tr>";
    }

    echo "</table>";
    exit;
}

// PDF export function
function exportToPDF($employeeEvaluations)
{
    // For a real implementation, you would use a PDF library like TCPDF or Dompdf
    // This is a simplified version that outputs HTML that can be saved as PDF

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="merq_performance_evaluation_' . date('Y-m-d') . '.pdf"');

    $html = '<html><head><title>MERQ Performance Evaluation Report</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #003366; color: white; }
            </style>
            </head><body>';

    $html .= '<h1>MERQ Performance Evaluation Report</h1>';
    $html .= '<p>Generated on: ' . date('Y-m-d H:i:s') . '</p>';
    $html .= '<table>
                <tr>
                    <th>Employee Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Weighted Score</th>
                    <th>Performance Category</th>
                    <th>Total Evaluations</th>
                </tr>';

    foreach ($employeeEvaluations as $employeeId => $data) {
        $employee = $data['details'];

        $html .= '<tr>
                    <td>' . htmlspecialchars($employee['full_name'] ?? 'N/A') . '</td>
                    <td>' . htmlspecialchars($employee['position_title'] ?? 'N/A') . '</td>
                    <td>' . htmlspecialchars($employee['department_name'] ?? 'N/A') . '</td>
                    <td>' . round($data['weighted_score'], 2) . '%</td>
                    <td>' . htmlspecialchars($data['performance_category']) . '</td>
                    <td>' . array_sum($data['perspective_counts']) . '</td>
                </tr>';
    }

    $html .= '</table></body></html>';

    // In a real implementation, you would use a PDF library to convert HTML to PDF
    // For this example, we'll just output the HTML
    echo $html;
    exit;
}
