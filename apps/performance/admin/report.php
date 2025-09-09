<?php
// report.php - Main reporting dashboard
require_once 'config.php';

// Get all submissions
$submissions = getSubmissions();

// Calculate weighted scores
$employeeScores = calculateWeightedScores($submissions);

// Handle export requests
if (isset($_GET['export'])) {
    $exportType = $_GET['export'];

    if ($exportType === 'excel') {
        exportToExcel($employeeScores);
    } elseif ($exportType === 'pdf') {
        exportToPDF($employeeScores);
    }
}

// Handle individual report request
$individualReport = null;
$matrixQuestions = [];
if (isset($_GET['employee_id']) && isset($_GET['submission_id'])) {
    $employeeId = $_GET['employee_id'];
    $submissionId = $_GET['submission_id'];

    if (isset($employeeScores[$employeeId])) {
        foreach ($employeeScores[$employeeId]['evaluations'] as $evaluation) {
            if ($evaluation['submission_id'] == $submissionId) {
                $individualReport = $evaluation;
                $matrixQuestions = getMatrixQuestions($evaluation['details']);
                break;
            }
        }
    }
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Consultancy - Performance Evaluation Reporting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-bottom: 1.5rem;
        }

        .table th {
            background-color: #003366;
            color: white;
        }

        .progress {
            height: 25px;
        }

        .judgment-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 50rem;
        }

        .nav-tabs .nav-link.active {
            background-color: #003366;
            color: white;
            border: 1px solid #003366;
        }

        .matrix-table {
            font-size: 0.9rem;
        }

        .matrix-table th {
            background-color: #f8f9fa;
            color: #212529;
        }

        .bg-needs-improvement {
            background-color: #dc3545;
            color: white;
        }

        .bg-developing {
            background-color: #fd7e14;
            color: white;
        }

        .bg-meets-expectations {
            background-color: #ffc107;
            color: black;
        }

        .bg-exceeds-expectations {
            background-color: #20c997;
            color: white;
        }

        .bg-outstanding {
            background-color: #198754;
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .card {
                margin-bottom: 1rem;
            }

            .judgment-badge {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .btn-group .dropdown-menu {
                position: absolute;
                inset: 0px auto auto 0px;
                margin: 0px;
                transform: translate(0px, 40px);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Performance Evaluation Reporting</h1>
                    <div>
                        <a href="?export=excel" class="btn btn-success me-2"><i class="fas fa-file-excel me-1"></i> Export Excel</a>
                        <a href="?export=pdf" class="btn btn-danger"><i class="fas fa-file-pdf me-1"></i> Export PDF</a>
                    </div>
                </div>

                <?php if ($individualReport): ?>
                    <!-- Individual Report View -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Individual Evaluation Report</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p><strong>Employee:</strong> <?php echo htmlspecialchars($employeeScores[$_GET['employee_id']]['details']['full_name'] ?? 'N/A'); ?></p>
                                    <p><strong>Position:</strong> <?php echo htmlspecialchars($employeeScores[$_GET['employee_id']]['details']['position_title'] ?? 'N/A'); ?></p>
                                    <p><strong>Department:</strong> <?php echo htmlspecialchars($employeeScores[$_GET['employee_id']]['details']['department_name'] ?? 'N/A'); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Perspective:</strong> <?php echo htmlspecialchars($individualReport['perspective'] ?? 'N/A'); ?></p>
                                    <p><strong>Evaluation Date:</strong> <?php echo htmlspecialchars($individualReport['submission_date'] ?? 'N/A'); ?></p>
                                    <p><strong>Overall Score:</strong> <?php echo round($individualReport['score'] ?? 0, 2); ?>%</p>
                                </div>
                            </div>

                            <h5 class="mb-3">Category Scores</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered matrix-table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Average Score</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $category_scores = $individualReport['details']['category_scores'] ?? [];
                                        foreach ($category_scores as $category => $scoreData):
                                            if ($scoreData['count'] > 0): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($category); ?></td>
                                                    <td><?php echo round($scoreData['average'] ?? 0, 2); ?> / 5</td>
                                                    <td><?php echo round($scoreData['percentage'] ?? 0, 1); ?>%</td>
                                                </tr>
                                        <?php endif;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <h5 class="mb-3 mt-4">Detailed Responses</h5>
                            <div class="accordion" id="responsesAccordion">
                                <?php
                                $currentCategory = '';
                                $accordionIndex = 0;
                                $answers = $individualReport['details']['answers'] ?? [];

                                foreach ($matrixQuestions as $category => $questions):
                                    $accordionIndex++;
                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo $accordionIndex; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $accordionIndex; ?>" aria-expanded="false" aria-controls="collapse<?php echo $accordionIndex; ?>">
                                                <?php echo htmlspecialchars($category); ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $accordionIndex; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $accordionIndex; ?>" data-bs-parent="#responsesAccordion">
                                            <div class="accordion-body">
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Question</th>
                                                            <th>Rating</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($questions as $question):
                                                            $answerValue = '';
                                                            foreach ($answers as $answer) {
                                                                if ($answer['type'] === 'matrix' && $answer['label'] === "$category > $question") {
                                                                    $answerValue = $answer['answer'];
                                                                    break;
                                                                }
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($question); ?></td>
                                                                <td><?php echo htmlspecialchars($answerValue); ?> / 5</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?php
                                // Textarea responses
                                $textIndex = $accordionIndex;
                                foreach ($answers as $answer):
                                    if ($answer['type'] === 'textarea' && !empty($answer['answer'])):
                                        $textIndex++;
                                ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $textIndex; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $textIndex; ?>" aria-expanded="false" aria-controls="collapse<?php echo $textIndex; ?>">
                                                    <?php echo htmlspecialchars($answer['label']); ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?php echo $textIndex; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $textIndex; ?>" data-bs-parent="#responsesAccordion">
                                                <div class="accordion-body">
                                                    <p><?php echo nl2br(htmlspecialchars($answer['answer'])); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="?" class="btn btn-secondary">Back to Overview</a>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Overview Dashboard -->
                    <ul class="nav nav-tabs mb-4" id="reportTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="true">Summary</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="detailed-tab" data-bs-toggle="tab" data-bs-target="#detailed" type="button" role="tab" aria-controls="detailed" aria-selected="false">Detailed View</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="charts-tab" data-bs-toggle="tab" data-bs-target="#charts" type="button" role="tab" aria-controls="charts" aria-selected="false">Charts</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="reportTabsContent">
                        <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                            <div class="row">
                                <?php foreach ($employeeScores as $employeeId => $employeeData):
                                    $performanceCategory = $employeeData['performance_category'] ?? 'Not Rated';
                                    $weightedScore = $employeeData['weighted_score'] ?? 0;
                                    $perspectiveCounts = $employeeData['perspective_counts'] ?? [];
                                ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($employeeData['details']['full_name'] ?? 'Employee ' . $employeeId); ?></h5>
                                                <span class="judgment-badge 
                                                    <?php
                                                    if ($performanceCategory === 'Outstanding') echo 'bg-outstanding';
                                                    elseif ($performanceCategory === 'Exceeds Expectations') echo 'bg-exceeds-expectations';
                                                    elseif ($performanceCategory === 'Meets Expectations') echo 'bg-meets-expectations';
                                                    elseif ($performanceCategory === 'Developing') echo 'bg-developing';
                                                    else echo 'bg-needs-improvement';
                                                    ?>">
                                                    <?php echo htmlspecialchars($performanceCategory); ?>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-3">Weighted Score: <?php echo round($weightedScore, 2); ?>%</h6>

                                                <div class="progress mb-3">
                                                    <div class="progress-bar 
                                                        <?php
                                                        if ($weightedScore >= 91) echo 'bg-outstanding';
                                                        elseif ($weightedScore >= 76) echo 'bg-exceeds-expectations';
                                                        elseif ($weightedScore >= 61) echo 'bg-meets-expectations';
                                                        elseif ($weightedScore >= 31) echo 'bg-developing';
                                                        else echo 'bg-needs-improvement';
                                                        ?>"
                                                        role="progressbar"
                                                        style="width: <?php echo $weightedScore; ?>%"
                                                        aria-valuenow="<?php echo $weightedScore; ?>"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <?php echo round($weightedScore, 1); ?>%
                                                    </div>
                                                </div>

                                                <p class="card-text">
                                                    <strong>Evaluation Perspectives:</strong><br>
                                                    <?php
                                                    foreach ($perspectiveCounts as $perspective => $count) {
                                                        if ($count > 0) {
                                                            echo htmlspecialchars($perspective) . ': ' . $count . '<br>';
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="?employee_id=<?php echo urlencode($employeeId); ?>" class="btn btn-sm btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="detailed" role="tabpanel" aria-labelledby="detailed-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Employee</th>
                                                    <th>Weighted Score</th>
                                                    <th>Performance Category</th>
                                                    <th>Perspectives</th>
                                                    <th>Evaluations</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($employeeScores as $employeeId => $employeeData):
                                                    $performanceCategory = $employeeData['performance_category'] ?? 'Not Rated';
                                                    $weightedScore = $employeeData['weighted_score'] ?? 0;
                                                    $perspectiveCounts = $employeeData['perspective_counts'] ?? [];
                                                    $evaluations = $employeeData['evaluations'] ?? [];
                                                ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($employeeData['details']['full_name'] ?? 'Employee ' . $employeeId); ?></td>
                                                        <td><?php echo round($weightedScore, 2); ?>%</td>
                                                        <td>
                                                            <span class="badge 
                                                                <?php
                                                                if ($performanceCategory === 'Outstanding') echo 'bg-outstanding';
                                                                elseif ($performanceCategory === 'Exceeds Expectations') echo 'bg-exceeds-expectations';
                                                                elseif ($performanceCategory === 'Meets Expectations') echo 'bg-meets-expectations';
                                                                elseif ($performanceCategory === 'Developing') echo 'bg-developing';
                                                                else echo 'bg-needs-improvement';
                                                                ?>">
                                                                <?php echo htmlspecialchars($performanceCategory); ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            foreach ($perspectiveCounts as $perspective => $count) {
                                                                if ($count > 0) {
                                                                    echo htmlspecialchars($perspective) . ': ' . $count . '<br>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo count($evaluations); ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Actions
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="?employee_id=<?php echo urlencode($employeeId); ?>">View Summary</a></li>
                                                                    <li>
                                                                        <hr class="dropdown-divider">
                                                                    </li>
                                                                    <?php foreach ($evaluations as $evaluation): ?>
                                                                        <li>
                                                                            <a class="dropdown-item" href="?employee_id=<?php echo urlencode($employeeId); ?>&submission_id=<?php echo $evaluation['submission_id']; ?>">
                                                                                View <?php echo htmlspecialchars($evaluation['perspective']); ?> Evaluation
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="charts" role="tabpanel" aria-labelledby="charts-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Performance Distribution</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="performanceChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Evaluation Perspectives</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="perspectiveChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Add some interactive functionality
            document.addEventListener('DOMContentLoaded', function() {
                // Enable tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Performance Distribution Chart
                <?php
                $performanceCounts = [
                    'Needs Significant Improvement' => 0,
                    'Developing' => 0,
                    'Meets Expectations' => 0,
                    'Exceeds Expectations' => 0,
                    'Outstanding' => 0
                ];

                $perspectiveCounts = [
                    'Self-evaluation' => 0,
                    'Supervisor' => 0,
                    'Subordinate' => 0,
                    'Colleague' => 0,
                    'Other' => 0
                ];

                foreach ($employeeScores as $data) {
                    $performanceCounts[$data['performance_category']]++;

                    foreach ($data['perspective_counts'] as $perspective => $count) {
                        $perspectiveCounts[$perspective] += $count;
                    }
                }
                ?>

                const performanceCtx = document.getElementById('performanceChart')?.getContext('2d');
                if (performanceCtx) {
                    const performanceChart = new Chart(performanceCtx, {
                        type: 'pie',
                        data: {
                            labels: [
                                'Needs Significant Improvement',
                                'Developing',
                                'Meets Expectations',
                                'Exceeds Expectations',
                                'Outstanding'
                            ],
                            datasets: [{
                                data: [
                                    <?= $performanceCounts['Needs Significant Improvement'] ?>,
                                    <?= $performanceCounts['Developing'] ?>,
                                    <?= $performanceCounts['Meets Expectations'] ?>,
                                    <?= $performanceCounts['Exceeds Expectations'] ?>,
                                    <?= $performanceCounts['Outstanding'] ?>
                                ],
                                backgroundColor: [
                                    '#dc3545',
                                    '#fd7e14',
                                    '#ffc107',
                                    '#20c997',
                                    '#198754'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                }
                            }
                        }
                    });
                }

                // Perspective Distribution Chart
                const perspectiveCtx = document.getElementById('perspectiveChart')?.getContext('2d');
                if (perspectiveCtx) {
                    const perspectiveChart = new Chart(perspectiveCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Self-evaluation', 'Supervisor', 'Subordinate', 'Colleague', 'Other'],
                            datasets: [{
                                label: 'Number of Evaluations per Perspective',
                                data: [
                                    <?= $perspectiveCounts['Self-evaluation'] ?>,
                                    <?= $perspectiveCounts['Supervisor'] ?>,
                                    <?= $perspectiveCounts['Subordinate'] ?>,
                                    <?= $perspectiveCounts['Colleague'] ?>,
                                    <?= $perspectiveCounts['Other'] ?>
                                ],
                                backgroundColor: [
                                    '#4e73df',
                                    '#1cc88a',
                                    '#36b9cc',
                                    '#f6c23e',
                                    '#e74a3b'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    </div>
</body>

</html>