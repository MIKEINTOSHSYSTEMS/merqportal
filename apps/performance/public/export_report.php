<?php
// export_report.php - Individual employee report export
require_once '../includes/config.php';

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

// Prepare data for JavaScript
$jsData = [
    'employeeId' => $employeeId,
    'employeeDetails' => $employeeDetails,
    'employeeData' => $employeeData,
    'strengthsAndImprovements' => $strengthsAndImprovements,
    'type' => $type
];

// Convert to JSON for JavaScript usage
$jsonData = json_encode($jsData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Employee Report</title>

    <!-- CDN for jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <!-- CDN for SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 18px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .error {
            color: red;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="loading" class="loading">
            <div class="spinner"></div>
            <p>Generating report, please wait...</p>
        </div>
        <div id="error" class="error" style="display: none;"></div>

        <!-- Hidden table for Excel export -->
        <table id="export-table" style="display: none;">
            <thead>
                <tr>
                    <th colspan="2">MERQ Employee Performance Evaluation Report</th>
                </tr>
                <tr>
                    <td colspan="2"><strong>Generated on:</strong> <?= date('Y-m-d H:i:s') ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <h3>Employee Details</h3>
                    </td>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        // Parse PHP data
        const data = <?= $jsonData ?>;
        const exportType = data.type;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (exportType === 'excel') {
                exportToExcel();
            } else if (exportType === 'pdf') {
                exportToPDF();
            } else {
                showError('Invalid export type');
            }
        });

        function exportToExcel() {
            try {
                // Prepare table data
                const tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';

                // Employee details
                addTableRow(tableBody, 'Employee ID:', data.employeeId);
                addTableRow(tableBody, 'Name:', data.employeeDetails.full_name || 'N/A');
                addTableRow(tableBody, 'Position:', data.employeeDetails.position_title || 'N/A');
                addTableRow(tableBody, 'Department:', data.employeeDetails.department_name || 'N/A');
                addTableRow(tableBody, 'Supervisor:', data.employeeDetails.supervisor_name || 'N/A');
                addEmptyRow(tableBody);

                // Performance summary
                addTableHeader(tableBody, 'Performance Summary');
                addTableRow(tableBody, 'Weighted Score:', data.employeeData.weighted_score.toFixed(2) + '%');
                addTableRow(tableBody, 'Performance Category:', data.employeeData.performance_category);
                addEmptyRow(tableBody);

                // Evaluation perspectives
                addTableHeader(tableBody, 'Evaluation Perspectives');
                Object.entries(data.employeeData.perspective_counts).forEach(([perspective, count]) => {
                    if (count > 0) {
                        addTableRow(tableBody, perspective + ':', count);
                    }
                });
                addTableRow(tableBody, 'Total Evaluations:',
                    Object.values(data.employeeData.perspective_counts).reduce((a, b) => a + b, 0));
                addEmptyRow(tableBody);

                // Category scores
                addTableHeader(tableBody, 'Category Scores');
                Object.entries(data.employeeData.category_scores).forEach(([category, scoreData]) => {
                    if (scoreData.count > 0) {
                        addTableRow(tableBody, category + ':', scoreData.percentage.toFixed(1) + '%');
                    }
                });
                addEmptyRow(tableBody);

                // Strengths
                if (data.strengthsAndImprovements.strengths.length > 0) {
                    addTableHeader(tableBody, 'Strengths');
                    data.strengthsAndImprovements.strengths.forEach((strength, index) => {
                        addTableRow(tableBody,
                            (index + 1) + '.',
                            strength.text + ' (From ' + strength.perspective + ' on ' + strength.date + ')'
                        );
                    });
                    addEmptyRow(tableBody);
                }

                // Areas for improvement
                if (data.strengthsAndImprovements.improvements.length > 0) {
                    addTableHeader(tableBody, 'Areas for Improvement');
                    data.strengthsAndImprovements.improvements.forEach((improvement, index) => {
                        addTableRow(tableBody,
                            (index + 1) + '.',
                            improvement.text + ' (From ' + improvement.perspective + ' on ' + improvement.date + ')'
                        );
                    });
                }

                // Export to Excel
                const table = document.getElementById('export-table');
                const wb = XLSX.utils.table_to_book(table, {
                    sheet: "Employee Report"
                });

                // Set column widths
                if (!wb.Sheets['Employee Report']['!cols']) {
                    wb.Sheets['Employee Report']['!cols'] = [];
                }
                wb.Sheets['Employee Report']['!cols'][0] = {
                    width: 30
                };
                wb.Sheets['Employee Report']['!cols'][1] = {
                    width: 50
                };

                XLSX.writeFile(wb, `merq_employee_${data.employeeId}_evaluation_${getCurrentDate()}.xlsx`);

                // Redirect back after successful export
                setTimeout(() => {
                    window.history.back();
                }, 1000);

            } catch (error) {
                console.error('Excel export error:', error);
                showError('Error generating Excel file: ' + error.message);
            }
        }

        function exportToPDF() {
            try {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Set document properties
                doc.setProperties({
                    title: `MERQ Employee Evaluation - ${data.employeeDetails.full_name}`,
                    subject: 'Performance Evaluation Report',
                    author: 'MERQ System'
                });

                let yPosition = 20;
                const pageWidth = doc.internal.pageSize.width;
                const margin = 15;
                const contentWidth = pageWidth - (2 * margin);

                // Header
                doc.setFontSize(16);
                doc.setFont('helvetica', 'bold');
                doc.text('MERQ Employee Performance Evaluation Report', pageWidth / 2, yPosition, {
                    align: 'center'
                });

                yPosition += 10;
                doc.setFontSize(10);
                doc.setFont('helvetica', 'normal');
                doc.text(`Generated on: ${getCurrentDate()}`, pageWidth / 2, yPosition, {
                    align: 'center'
                });
                yPosition += 15;

                // Employee Details Section
                yPosition = addSectionHeader(doc, 'Employee Details', yPosition);
                yPosition = addKeyValuePair(doc, 'Employee ID:', data.employeeId, yPosition, margin, contentWidth);
                yPosition = addKeyValuePair(doc, 'Full Name:', data.employeeDetails.full_name || 'N/A', yPosition, margin, contentWidth);
                yPosition = addKeyValuePair(doc, 'Position:', data.employeeDetails.position_title || 'N/A', yPosition, margin, contentWidth);
                yPosition = addKeyValuePair(doc, 'Department:', data.employeeDetails.department_name || 'N/A', yPosition, margin, contentWidth);
                yPosition = addKeyValuePair(doc, 'Supervisor:', data.employeeDetails.supervisor_name || 'N/A', yPosition, margin, contentWidth);
                yPosition += 10;

                // Performance Summary
                yPosition = addSectionHeader(doc, 'Performance Summary', yPosition);
                yPosition = addKeyValuePair(doc, 'Weighted Score:', data.employeeData.weighted_score.toFixed(2) + '%', yPosition, margin, contentWidth);
                yPosition = addKeyValuePair(doc, 'Performance Category:', data.employeeData.performance_category, yPosition, margin, contentWidth);

                // Add progress bar visualization
                const score = data.employeeData.weighted_score;
                const barWidth = 100;
                const barHeight = 8;
                const fillWidth = (score / 100) * barWidth;

                doc.setFillColor(200, 200, 200);
                doc.rect(margin, yPosition, barWidth, barHeight, 'F');

                // Color based on score
                const fillColor = getPerformanceColor(score);
                doc.setFillColor(fillColor.r, fillColor.g, fillColor.b);
                doc.rect(margin, yPosition, fillWidth, barHeight, 'F');

                doc.setFontSize(8);
                doc.setTextColor(0, 0, 0);
                doc.text(score.toFixed(1) + '%', margin + barWidth + 5, yPosition + barHeight / 2 + 1);
                yPosition += 15;

                // Evaluation Perspectives Table
                yPosition = addSectionHeader(doc, 'Evaluation Perspectives', yPosition);
                const perspectiveData = [
                    ['Perspective', 'Count']
                ];
                Object.entries(data.employeeData.perspective_counts).forEach(([perspective, count]) => {
                    if (count > 0) {
                        perspectiveData.push([perspective, count.toString()]);
                    }
                });
                perspectiveData.push(['Total', Object.values(data.employeeData.perspective_counts).reduce((a, b) => a + b, 0).toString()]);

                doc.autoTable({
                    startY: yPosition,
                    head: [perspectiveData[0]],
                    body: perspectiveData.slice(1),
                    margin: {
                        left: margin,
                        right: margin
                    },
                    styles: {
                        fontSize: 8,
                        cellPadding: 3
                    },
                    headStyles: {
                        fillColor: [0, 52, 102]
                    }
                });
                yPosition = doc.lastAutoTable.finalY + 10;

                // Category Scores Table
                yPosition = addSectionHeader(doc, 'Category Scores', yPosition);
                const categoryData = [
                    ['Category', 'Score (%)']
                ];
                Object.entries(data.employeeData.category_scores).forEach(([category, scoreData]) => {
                    if (scoreData.count > 0) {
                        categoryData.push([category, scoreData.percentage.toFixed(1) + '%']);
                    }
                });

                doc.autoTable({
                    startY: yPosition,
                    head: [categoryData[0]],
                    body: categoryData.slice(1),
                    margin: {
                        left: margin,
                        right: margin
                    },
                    styles: {
                        fontSize: 8,
                        cellPadding: 3
                    },
                    headStyles: {
                        fillColor: [0, 52, 102]
                    },
                    columnStyles: {
                        0: {
                            cellWidth: 70
                        },
                        1: {
                            cellWidth: 30,
                            halign: 'right'
                        }
                    }
                });
                yPosition = doc.lastAutoTable.finalY + 10;

                // Strengths
                if (data.strengthsAndImprovements.strengths.length > 0) {
                    yPosition = addSectionHeader(doc, 'Strengths', yPosition);
                    data.strengthsAndImprovements.strengths.forEach((strength, index) => {
                        yPosition = addTextBlock(doc,
                            `${index + 1}. ${strength.text}`,
                            `From ${strength.perspective} on ${strength.date}`,
                            yPosition, margin, contentWidth, [34, 139, 34]
                        );
                    });
                    yPosition += 5;
                }

                // Areas for Improvement
                if (data.strengthsAndImprovements.improvements.length > 0) {
                    yPosition = addSectionHeader(doc, 'Areas for Improvement', yPosition);
                    data.strengthsAndImprovements.improvements.forEach((improvement, index) => {
                        yPosition = addTextBlock(doc,
                            `${index + 1}. ${improvement.text}`,
                            `From ${improvement.perspective} on ${improvement.date}`,
                            yPosition, margin, contentWidth, [255, 165, 0]
                        );
                    });
                }

                // Footer
                const pageCount = doc.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(100, 100, 100);
                    doc.text(`Page ${i} of ${pageCount}`, pageWidth - margin, doc.internal.pageSize.height - 10, {
                        align: 'right'
                    });
                    doc.text('MERQ Performance Evaluation System - Confidential', margin, doc.internal.pageSize.height - 10);
                }

                // Save the PDF
                doc.save(`merq_employee_${data.employeeId}_evaluation_${getCurrentDate()}.pdf`);

                // Redirect back after successful export
                setTimeout(() => {
                    window.history.back();
                }, 1000);

            } catch (error) {
                console.error('PDF export error:', error);
                showError('Error generating PDF file: ' + error.message);
            }
        }

        // Helper functions
        function addTableRow(tbody, label, value) {
            const row = document.createElement('tr');
            row.innerHTML = `<td><strong>${label}</strong></td><td>${value}</td>`;
            tbody.appendChild(row);
        }

        function addTableHeader(tbody, title) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="2"><h3>${title}</h3></td>`;
            tbody.appendChild(row);
        }

        function addEmptyRow(tbody) {
            const row = document.createElement('tr');
            row.innerHTML = '<td colspan="2">&nbsp;</td>';
            tbody.appendChild(row);
        }

        function addSectionHeader(doc, title, yPosition) {
            if (yPosition > 250) {
                doc.addPage();
                yPosition = 20;
            }

            doc.setFontSize(12);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(0, 52, 102);
            doc.text(title, 15, yPosition);

            doc.setDrawColor(0, 52, 102);
            doc.line(15, yPosition + 2, 80, yPosition + 2);

            return yPosition + 10;
        }

        function addKeyValuePair(doc, key, value, yPosition, margin, contentWidth) {
            if (yPosition > 270) {
                doc.addPage();
                yPosition = 20;
            }

            doc.setFontSize(10);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(0, 0, 0);
            doc.text(key, margin, yPosition);

            doc.setFont('helvetica', 'normal');
            const lines = doc.splitTextToSize(value.toString(), contentWidth - 50);
            doc.text(lines, margin + 45, yPosition);

            return yPosition + (lines.length * 7) + 5;
        }

        function addTextBlock(doc, mainText, subText, yPosition, margin, contentWidth, color = [0, 0, 0]) {
            if (yPosition > 270) {
                doc.addPage();
                yPosition = 20;
            }

            // Background
            doc.setFillColor(color[0], color[1], color[2], 10);
            doc.rect(margin, yPosition, contentWidth, 20, 'F');

            // Main text
            doc.setFontSize(9);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(0, 0, 0);
            const mainLines = doc.splitTextToSize(mainText, contentWidth - 10);
            doc.text(mainLines, margin + 5, yPosition + 5);

            // Sub text
            doc.setFontSize(7);
            doc.setFont('helvetica', 'italic');
            doc.setTextColor(100, 100, 100);
            doc.text(subText, margin + 5, yPosition + 5 + (mainLines.length * 4) + 2);

            return yPosition + 25 + (mainLines.length * 4);
        }

        function getPerformanceColor(score) {
            if (score < 30) return {
                r: 220,
                g: 53,
                b: 69
            }; // Red
            if (score < 61) return {
                r: 253,
                g: 126,
                b: 20
            }; // Orange
            if (score < 76) return {
                r: 255,
                g: 193,
                b: 7
            }; // Yellow
            if (score <= 90) return {
                r: 32,
                g: 201,
                b: 151
            }; // Green
            return {
                r: 25,
                g: 135,
                b: 84
            }; // Dark Green
        }

        function getCurrentDate() {
            return new Date().toISOString().split('T')[0];
        }

        function showError(message) {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('error').style.display = 'block';
            document.getElementById('error').textContent = message;
        }
    </script>
</body>

</html>