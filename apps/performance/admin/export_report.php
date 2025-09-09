<?php
// export_report.php - Individual employee report export
require_once 'config.php';

$employeeId = $_GET['employee'] ?? '';
$type = $_GET['type'] ?? 'excel';

if (empty($employeeId)) {
    die("Employee ID is required.");
}

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

if (!isset($employeeEvaluations[$employeeId])) {
    die("Employee not found or no evaluations available.");
}

$employeeData = $employeeEvaluations[$employeeId];
$employeeDetails = $employeeData['details'];
$strengthsAndImprovements = getStrengthsAndImprovements($employeeData['evaluations']);

if ($type === 'excel') {
    exportEmployeeToExcel($employeeId, $employeeData, $employeeDetails, $strengthsAndImprovements);
} elseif ($type === 'pdf') {
    exportEmployeeToPDF($employeeId, $employeeData, $employeeDetails, $strengthsAndImprovements);
}

// Excel export function for individual employee
function exportEmployeeToExcel($employeeId, $employeeData, $employeeDetails, $strengthsAndImprovements)
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="merq_employee_' . $employeeId . '_evaluation_' . date('Y-m-d') . '.xls"');

    echo "<table border='1'>";
    echo "<tr><th colspan='2'>Employee Performance Evaluation Report</th></tr>";
    echo "<tr><td colspan='2'><strong>Generated on:</strong> " . date('Y-m-d H:i:s') . "</td></tr>";
    echo "<tr><td colspan='2'>&nbsp;</td></tr>";

    // Employee details
    echo "<tr><td colspan='2'><h3>Employee Details</h3></td></tr>";
    echo "<tr><td><strong>Employee ID:</strong></td><td>" . htmlspecialchars($employeeId) . "</td></tr>";
    echo "<tr><td><strong>Name:</strong></td><td>" . htmlspecialchars($employeeDetails['full_name'] ?? 'N/A') . "</td></tr>";
    echo "<tr><td><strong>Position:</strong></td><td>" . htmlspecialchars($employeeDetails['position_title'] ?? 'N/A') . "</td></tr>";
    echo "<tr><td><strong>Department:</strong></td><td>" . htmlspecialchars($employeeDetails['department_name'] ?? 'N/A') . "</td></tr>";
    echo "<tr><td colspan='2'>&nbsp;</td></tr>";

    // Performance summary
    echo "<tr><td colspan='2'><h3>Performance Summary</h3></td></tr>";
    echo "<tr><td><strong>Weighted Score:</strong></td><td>" . round($employeeData['weighted_score'], 2) . "%</td></tr>";
    echo "<tr><td><strong>Performance Category:</strong></td><td>" . htmlspecialchars($employeeData['performance_category']) . "</td></tr>";
    echo "<tr><td colspan='2'>&nbsp;</td></tr>";

    // Evaluation perspectives
    echo "<tr><td colspan='2'><h3>Evaluation Perspectives</h3></td></tr>";
    foreach ($employeeData['perspective_counts'] as $perspective => $count) {
        if ($count > 0) {
            echo "<tr><td><strong>" . htmlspecialchars($perspective) . ":</strong></td><td>" . $count . "</td></tr>";
        }
    }
    echo "<tr><td><strong>Total Evaluations:</strong></td><td>" . array_sum($employeeData['perspective_counts']) . "</td></tr>";
    echo "<tr><td colspan='2'>&nbsp;</td></tr>";

    // Category scores
    echo "<tr><td colspan='2'><h3>Category Scores</h3></td></tr>";
    foreach ($employeeData['category_scores'] as $category => $scoreData) {
        if ($scoreData['count'] > 0) {
            echo "<tr><td><strong>" . htmlspecialchars($category) . ":</strong></td><td>" . round($scoreData['percentage'], 1) . "%</td></tr>";
        }
    }
    echo "<tr><td colspan='2'>&nbsp;</td></tr>";

    // Strengths
    if (!empty($strengthsAndImprovements['strengths'])) {
        echo "<tr><td colspan='2'><h3>Strengths</h3></td></tr>";
        foreach ($strengthsAndImprovements['strengths'] as $index => $strength) {
            echo "<tr><td colspan='2'>" . ($index + 1) . ". " . nl2br(htmlspecialchars($strength['text'])) . "<br><em>(From " . htmlspecialchars($strength['perspective']) . " on " . htmlspecialchars($strength['date']) . ")</em></td></tr>";
        }
        echo "<tr><td colspan='2'>&nbsp;</td></tr>";
    }

    // Areas for improvement
    if (!empty($strengthsAndImprovements['improvements'])) {
        echo "<tr><td colspan='2'><h3>Areas for Improvement</h3></td></tr>";
        foreach ($strengthsAndImprovements['improvements'] as $index => $improvement) {
            echo "<tr><td colspan='2'>" . ($index + 1) . ". " . nl2br(htmlspecialchars($improvement['text'])) . "<br><em>(From " . htmlspecialchars($improvement['perspective']) . " on " . htmlspecialchars($improvement['date']) . ")</em></td></tr>";
        }
    }

    echo "</table>";
    exit;
}

// PDF export function for individual employee
function exportEmployeeToPDF($employeeId, $employeeData, $employeeDetails, $strengthsAndImprovements)
{
    // For a real implementation, you would use a PDF library like TCPDF or Dompdf
    // This is a simplified version that outputs HTML that can be saved as PDF

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="merq_employee_' . $employeeId . '_evaluation_' . date('Y-m-d') . '.pdf"');

    $html = '<html><head><title>MERQ Employee Performance Evaluation Report</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #003366; color: white; }
                h3 { margin-top: 20px; margin-bottom: 10px; color: #003366; }
            </style>
            </head><body>';

    $html .= '<h1>MERQ Employee Performance Evaluation Report</h1>';
    $html .= '<p><strong>Generated on:</strong> ' . date('Y-m-d H:i:s') . '</p>';

    // Employee details
    $html .= '<h3>Employee Details</h3>';
    $html .= '<table>
                <tr><td><strong>Employee ID:</strong></td><td>' . htmlspecialchars($employeeId) . '</td></tr>
                <tr><td><strong>Name:</strong></td><td>' . htmlspecialchars($employeeDetails['full_name'] ?? 'N/A') . '</td></tr>
                <tr><td><strong>Position:</strong></td><td>' . htmlspecialchars($employeeDetails['position_title'] ?? 'N/A') . '</td></tr>
                <tr><td><strong>Department:</strong></td><td>' . htmlspecialchars($employeeDetails['department_name'] ?? 'N/A') . '</td></tr>
            </table>';

    // Performance summary
    $html .= '<h3>Performance Summary</h3>';
    $html .= '<table>
                <tr><td><strong>Weighted Score:</strong></td><td>' . round($employeeData['weighted_score'], 2) . '%</td></tr>
                <tr><td><strong>Performance Category:</strong></td><td>' . htmlspecialchars($employeeData['performance_category']) . '</td></tr>
            </table>';

    // Evaluation perspectives
    $html .= '<h3>Evaluation Perspectives</h3>';
    $html .= '<table>';
    foreach ($employeeData['perspective_counts'] as $perspective => $count) {
        if ($count > 0) {
            $html .= '<tr><td><strong>' . htmlspecialchars($perspective) . ':</strong></td><td>' . $count . '</td></tr>';
        }
    }
    $html .= '<tr><td><strong>Total Evaluations:</strong></td><td>' . array_sum($employeeData['perspective_counts']) . '</td></tr>';
    $html .= '</table>';

    // Category scores
    $html .= '<h3>Category Scores</h3>';
    $html .= '<table>';
    foreach ($employeeData['category_scores'] as $category => $scoreData) {
        if ($scoreData['count'] > 0) {
            $html .= '<tr><td><strong>' . htmlspecialchars($category) . ':</strong></td><td>' . round($scoreData['percentage'], 1) . '%</td></tr>';
        }
    }
    $html .= '</table>';

    // Strengths
    if (!empty($strengthsAndImprovements['strengths'])) {
        $html .= '<h3>Strengths</h3>';
        foreach ($strengthsAndImprovements['strengths'] as $index => $strength) {
            $html .= '<p>' . ($index + 1) . '. ' . nl2br(htmlspecialchars($strength['text'])) . '<br><em>(From ' . htmlspecialchars($strength['perspective']) . ' on ' . htmlspecialchars($strength['date']) . ')</em></p>';
        }
    }

    // Areas for improvement
    if (!empty($strengthsAndImprovements['improvements'])) {
        $html .= '<h3>Areas for Improvement</h3>';
        foreach ($strengthsAndImprovements['improvements'] as $index => $improvement) {
            $html .= '<p>' . ($index + 1) . '. ' . nl2br(htmlspecialchars($improvement['text'])) . '<br><em>(From ' . htmlspecialchars($improvement['perspective']) . ' on ' . htmlspecialchars($improvement['date']) . ')</em></p>';
        }
    }

    $html .= '</body></html>';

    // In a real implementation, you would use a PDF library to convert HTML to PDF
    // For this example, we'll just output the HTML
    echo $html;
    exit;
}
