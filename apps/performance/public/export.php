<?php
// export.php - Bulk export functionality
require_once '../includes/config.php';

// Get export type and filters
$type = $_GET['type'] ?? 'excel';
$employeeFilter = $_GET['employee'] ?? '';
$perspectiveFilter = $_GET['perspective'] ?? '';
$categoryFilter = $_GET['category'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Filter data
$filteredEvaluations = [];
foreach ($employeeEvaluations as $employeeId => $data) {
    // Filter by employee
    if (!empty($employeeFilter) && $employeeId !== $employeeFilter) {
        continue;
    }

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

// Prepare data for JavaScript
$jsData = [
    'evaluations' => $filteredEvaluations,
    'filters' => [
        'employee' => $employeeFilter,
        'perspective' => $perspectiveFilter,
        'category' => $categoryFilter,
        'startDate' => $startDate,
        'endDate' => $endDate
    ],
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
    <title>Export Bulk Report</title>

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
            <p>Generating bulk report, please wait...</p>
        </div>
        <div id="error" class="error" style="display: none;"></div>

        <!-- Hidden table for Excel export -->
        <table id="export-table" style="display: none;">
            <thead>
                <tr>
                    <th colspan="12">MERQ Performance Evaluation Report - Bulk Export</th>
                </tr>
                <tr>
                    <td colspan="12"><strong>Generated on:</strong> <?= date('Y-m-d H:i:s') ?></td>
                </tr>
                <tr id="filter-info">
                    <!-- Filter information will be added by JavaScript -->
                </tr>
                <tr>
                    <td colspan="12">&nbsp;</td>
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
                // Prepare filter information
                const filterInfo = document.getElementById('filter-info');
                const filters = [];

                if (data.filters.employee) filters.push(`Employee: ${data.filters.employee}`);
                if (data.filters.perspective) filters.push(`Perspective: ${data.filters.perspective}`);
                if (data.filters.category) filters.push(`Category: ${data.filters.category}`);
                if (data.filters.startDate) filters.push(`Start Date: ${data.filters.startDate}`);
                if (data.filters.endDate) filters.push(`End Date: ${data.filters.endDate}`);

                filterInfo.innerHTML = `<td colspan="12"><strong>Filters:</strong> ${filters.join(' | ') || 'All Employees'}</td>`;

                // Prepare table header
                const tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';

                // Add header row
                const headerRow = document.createElement('tr');
                headerRow.innerHTML = `
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
                `;
                tableBody.appendChild(headerRow);

                // Add data rows
                Object.entries(data.evaluations).forEach(([employeeId, evalData]) => {
                    const employee = evalData.details;
                    const perspectives = evalData.perspective_counts;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${employeeId}</td>
                        <td>${employee.full_name || 'N/A'}</td>
                        <td>${employee.position_title || 'N/A'}</td>
                        <td>${employee.department_name || 'N/A'}</td>
                        <td>${evalData.weighted_score.toFixed(2)}%</td>
                        <td>${evalData.performance_category}</td>
                        <td>${perspectives['Self-evaluation'] || 0}</td>
                        <td>${perspectives['Supervisor'] || 0}</td>
                        <td>${perspectives['Subordinate'] || 0}</td>
                        <td>${perspectives['Colleague'] || 0}</td>
                        <td>${perspectives['Other'] || 0}</td>
                        <td>${Object.values(perspectives).reduce((a, b) => a + b, 0)}</td>
                    `;
                    tableBody.appendChild(row);
                });

                // Add summary row
                const totalEmployees = Object.keys(data.evaluations).length;
                const totalEvaluations = Object.values(data.evaluations).reduce((total, evalData) => {
                    return total + Object.values(evalData.perspective_counts).reduce((a, b) => a + b, 0);
                }, 0);
                const averageScore = totalEmployees > 0 ?
                    Object.values(data.evaluations).reduce((total, evalData) => total + evalData.weighted_score, 0) / totalEmployees : 0;

                const summaryRow = document.createElement('tr');
                summaryRow.innerHTML = `
                    <td colspan="4"><strong>SUMMARY</strong></td>
                    <td><strong>${averageScore.toFixed(2)}%</strong></td>
                    <td colspan="1"><strong>Average</strong></td>
                    <td colspan="6"><strong>Total Employees: ${totalEmployees} | Total Evaluations: ${totalEvaluations}</strong></td>
                `;
                tableBody.appendChild(summaryRow);

                // Export to Excel
                const table = document.getElementById('export-table');
                const wb = XLSX.utils.table_to_book(table, {
                    sheet: "Performance Report"
                });

                // Set column widths
                if (!wb.Sheets['Performance Report']['!cols']) {
                    wb.Sheets['Performance Report']['!cols'] = [];
                }
                // Set specific column widths
                const colWidths = [12, 20, 20, 15, 12, 20, 8, 8, 8, 8, 8, 8];
                colWidths.forEach((width, index) => {
                    wb.Sheets['Performance Report']['!cols'][index] = {
                        width
                    };
                });

                XLSX.writeFile(wb, `merq_performance_evaluation_${getCurrentDate()}.xlsx`);

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
                const doc = new jsPDF('landscape');

                // Set document properties
                doc.setProperties({
                    title: 'MERQ Performance Evaluation - Bulk Report',
                    subject: 'Bulk Performance Evaluation Report',
                    author: 'MERQ System'
                });

                let yPosition = 20;
                const pageWidth = doc.internal.pageSize.width;
                const margin = 15;

                // Header
                doc.setFontSize(16);
                doc.setFont('helvetica', 'bold');
                doc.text('MERQ Performance Evaluation Report - Bulk Export', pageWidth / 2, yPosition, {
                    align: 'center'
                });

                yPosition += 8;
                doc.setFontSize(10);
                doc.setFont('helvetica', 'normal');
                doc.text(`Generated on: ${getCurrentDate()}`, pageWidth / 2, yPosition, {
                    align: 'center'
                });

                // Filter information
                const filters = [];
                if (data.filters.employee) filters.push(`Employee: ${data.filters.employee}`);
                if (data.filters.perspective) filters.push(`Perspective: ${data.filters.perspective}`);
                if (data.filters.category) filters.push(`Category: ${data.filters.category}`);
                if (data.filters.startDate) filters.push(`Start Date: ${data.filters.startDate}`);
                if (data.filters.endDate) filters.push(`End Date: ${data.filters.endDate}`);

                yPosition += 8;
                doc.setFontSize(9);
                doc.text(`Filters: ${filters.join(' | ') || 'All Employees'}`, margin, yPosition);
                yPosition += 10;

                // Summary statistics
                const totalEmployees = Object.keys(data.evaluations).length;
                const totalEvaluations = Object.values(data.evaluations).reduce((total, evalData) => {
                    return total + Object.values(evalData.perspective_counts).reduce((a, b) => a + b, 0);
                }, 0);
                const averageScore = totalEmployees > 0 ?
                    Object.values(data.evaluations).reduce((total, evalData) => total + evalData.weighted_score, 0) / totalEmployees : 0;

                doc.setFontSize(10);
                doc.setFont('helvetica', 'bold');
                doc.text(`Summary: ${totalEmployees} Employees | ${totalEvaluations} Evaluations | Average Score: ${averageScore.toFixed(2)}%`,
                    margin, yPosition);
                yPosition += 8;

                // Main data table
                const tableData = [
                    [
                        'Employee ID', 'Name', 'Position', 'Department',
                        'Score %', 'Category', 'Self', 'Supervisor',
                        'Subordinate', 'Colleague', 'Other', 'Total'
                    ]
                ];

                Object.entries(data.evaluations).forEach(([employeeId, evalData]) => {
                    const employee = evalData.details;
                    const perspectives = evalData.perspective_counts;

                    tableData.push([
                        employeeId,
                        employee.full_name || 'N/A',
                        employee.position_title || 'N/A',
                        employee.department_name || 'N/A',
                        evalData.weighted_score.toFixed(2) + '%',
                        evalData.performance_category,
                        (perspectives['Self-evaluation'] || 0).toString(),
                        (perspectives['Supervisor'] || 0).toString(),
                        (perspectives['Subordinate'] || 0).toString(),
                        (perspectives['Colleague'] || 0).toString(),
                        (perspectives['Other'] || 0).toString(),
                        Object.values(perspectives).reduce((a, b) => a + b, 0).toString()
                    ]);
                });

                doc.autoTable({
                    startY: yPosition,
                    head: [tableData[0]],
                    body: tableData.slice(1),
                    margin: {
                        left: margin,
                        right: margin
                    },
                    styles: {
                        fontSize: 7,
                        cellPadding: 2
                    },
                    headStyles: {
                        fillColor: [0, 52, 102],
                        textColor: 255,
                        fontStyle: 'bold'
                    },
                    alternateRowStyles: {
                        fillColor: [240, 240, 240]
                    },
                    theme: 'grid',
                    tableWidth: 'auto',
                    columnStyles: {
                        0: {
                            cellWidth: 15
                        },
                        1: {
                            cellWidth: 25
                        },
                        2: {
                            cellWidth: 25
                        },
                        3: {
                            cellWidth: 20
                        },
                        4: {
                            cellWidth: 12
                        },
                        5: {
                            cellWidth: 25
                        },
                        6: {
                            cellWidth: 8
                        },
                        7: {
                            cellWidth: 10
                        },
                        8: {
                            cellWidth: 12
                        },
                        9: {
                            cellWidth: 10
                        },
                        10: {
                            cellWidth: 8
                        },
                        11: {
                            cellWidth: 8
                        }
                    }
                });

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
                doc.save(`merq_performance_evaluation_bulk_${getCurrentDate()}.pdf`);

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