<?php
// employee_report.php - Detailed employee evaluation report
require_once 'config.php';

$employeeId = $_GET['employee'] ?? '';
if (empty($employeeId)) {
    //header('Location: employee_report.php');
    header('Location: dashboard.php');
    exit;
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

// Prepare data for charts
$categoryLabels = [];
$categoryScores = [];

foreach ($employeeData['category_scores'] as $category => $scoreData) {
    if ($scoreData['count'] > 0) {
        $categoryLabels[] = substr($category, 0, 15) . (strlen($category) > 15 ? '...' : '');
        $categoryScores[] = round($scoreData['percentage'], 1);
    }
}

$perspectiveLabels = [];
$perspectiveCounts = [];

foreach ($employeeData['perspective_counts'] as $perspective => $count) {
    if ($count > 0) {
        $perspectiveLabels[] = $perspective;
        $perspectiveCounts[] = $count;
    }
}

require_once 'header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Employee Performance Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <style>
        .card-report {
            transition: transform 0.3s;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-report:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .performance-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
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

        .evaluation-table th {
            background-color: #003366;
            color: white;
        }

        .accordion-button:not(.collapsed) {
            background-color: #003366;
            color: white;
        }

        .matrix-table th {
            background-color: #003366;
            color: white;
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 250px;
            }

            .card-report {
                margin-bottom: 15px;
            }
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 15px;
        }

        .chart-legend-item {
            display: flex;
            align-items: center;
            margin: 5px 10px;
        }

        .chart-legend-color {
            width: 15px;
            height: 15px;
            margin-right: 5px;
            border-radius: 3px;
        }

        .mb-4 {
            margin-top: 70px;
            margin-bottom: 1.5rem !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="header-section">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1><?= htmlspecialchars($employeeDetails['full_name'] ?? '') ?></h1>
                            <p class="mb-0"><?= htmlspecialchars($employeeDetails['position_title'] ?? '') ?> - <?= htmlspecialchars($employeeDetails['department_name'] ?? '') ?></p>
                        </div>
                        <div class="text-end mt-2 mt-md-0">
                            <a href="dashboard.php" class="btn btn-light me-2"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
                            <a href="export_report.php?employee=<?= htmlspecialchars($employeeId ?? '') ?>&type=pdf" class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
                            <a href="export_report.php?employee=<?= htmlspecialchars($employeeId ?? '') ?>&type=excel" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Export Excel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Summary Section -->
            <div class="col-md-4">
                <div class="card card-report">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Performance Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="performance-badge d-inline-block 
                                <?= ($employeeData['performance_category'] ?? '') === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Developing' ? 'bg-developing' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                <?= htmlspecialchars($employeeData['performance_category'] ?? '') ?>
                            </div>
                            <h2 class="mt-3"><?= round($employeeData['weighted_score'] ?? 0, 1) ?>%</h2>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar 
                                    <?= ($employeeData['weighted_score'] ?? 0) < 30 ? 'bg-needs-improvement' : '' ?>
                                    <?= ($employeeData['weighted_score'] ?? 0) >= 30 && ($employeeData['weighted_score'] ?? 0) < 61 ? 'bg-developing' : '' ?>
                                    <?= ($employeeData['weighted_score'] ?? 0) >= 61 && ($employeeData['weighted_score'] ?? 0) < 76 ? 'bg-meets-expectations' : '' ?>
                                    <?= ($employeeData['weighted_score'] ?? 0) >= 76 && ($employeeData['weighted_score'] ?? 0) <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                    <?= ($employeeData['weighted_score'] ?? 0) > 90 ? 'bg-outstanding' : '' ?>"
                                    role="progressbar"
                                    style="width: <?= ($employeeData['weighted_score'] ?? 0) ?>%;"
                                    aria-valuenow="<?= ($employeeData['weighted_score'] ?? 0) ?>"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <h6>Evaluation Perspectives:</h6>
                        <ul class="list-group mb-3">
                            <?php foreach ($employeeData['perspective_counts'] ?? [] as $perspective => $count): ?>
                                <?php if (($count ?? 0) > 0): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= htmlspecialchars($perspective ?? '') ?>
                                        <span class="badge bg-primary rounded-pill"><?= $count ?></span>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                        <h6>Total Evaluations:</h6>
                        <p class="fs-4"><?= array_sum($employeeData['perspective_counts'] ?? []) ?></p>
                    </div>
                </div>

                <!-- Category Scores -->
                <div class="card card-report">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Category Scores</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($employeeData['category_scores'] ?? [] as $category => $scoreData): ?>
                            <?php if (($scoreData['count'] ?? 0) > 0): ?>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><?= htmlspecialchars($category ?? '') ?></span>
                                        <span class="category-score"><?= round($scoreData['percentage'] ?? 0, 1) ?>%</span>
                                    </div>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar 
                                            <?= ($scoreData['percentage'] ?? 0) < 30 ? 'bg-needs-improvement' : '' ?>
                                            <?= ($scoreData['percentage'] ?? 0) >= 30 && ($scoreData['percentage'] ?? 0) < 61 ? 'bg-developing' : '' ?>
                                            <?= ($scoreData['percentage'] ?? 0) >= 61 && ($scoreData['percentage'] ?? 0) < 76 ? 'bg-meets-expectations' : '' ?>
                                            <?= ($scoreData['percentage'] ?? 0) >= 76 && ($scoreData['percentage'] ?? 0) <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                            <?= ($scoreData['percentage'] ?? 0) > 90 ? 'bg-outstanding' : '' ?>"
                                            role="progressbar"
                                            style="width: <?= ($scoreData['percentage'] ?? 0) ?>%;"
                                            aria-valuenow="<?= ($scoreData['percentage'] ?? 0) ?>"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Charts -->
                <div class="card card-report">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Category Performance</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card card-report">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title mb-0">Evaluation Perspectives</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="perspectiveChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-8">
                <!-- Strengths and Improvements -->
                <div class="card card-report">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Strengths</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($strengthsAndImprovements['strengths'])): ?>
                            <p class="text-muted">No strengths recorded.</p>
                        <?php else: ?>
                            <?php foreach ($strengthsAndImprovements['strengths'] as $strength): ?>
                                <div class="mb-3 p-3 bg-light rounded">
                                    <p class="mb-1"><?= nl2br(htmlspecialchars($strength['text'] ?? '')) ?></p>
                                    <small class="text-muted">From <?= htmlspecialchars($strength['perspective'] ?? '') ?> on <?= htmlspecialchars($strength['date'] ?? '') ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card card-report">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title mb-0">Areas for Improvement</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($strengthsAndImprovements['improvements'])): ?>
                            <p class="text-muted">No areas for improvement recorded.</p>
                        <?php else: ?>
                            <?php foreach ($strengthsAndImprovements['improvements'] as $improvement): ?>
                                <div class="mb-3 p-3 bg-light rounded">
                                    <p class="mb-1"><?= nl2br(htmlspecialchars($improvement['text'] ?? '')) ?></p>
                                    <small class="text-muted">From <?= htmlspecialchars($improvement['perspective'] ?? '') ?> on <?= htmlspecialchars($improvement['date'] ?? '') ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Evaluation Details -->
                <div class="card card-report">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">Evaluation Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="evaluationAccordion">
                            <?php foreach ($employeeData['evaluations'] ?? [] as $index => $evaluation):
                                $matrixQuestions = getMatrixQuestions($evaluation['details'] ?? []);
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $index ?>">
                                        <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
                                            Evaluation from <?= htmlspecialchars($evaluation['perspective'] ?? '') ?> - <?= htmlspecialchars($evaluation['submission_date'] ?? '') ?> (Score: <?= round($evaluation['score'] ?? 0, 1) ?>%)
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $index ?>" data-bs-parent="#evaluationAccordion">
                                        <div class="accordion-body">
                                            <?php foreach ($matrixQuestions as $category => $questions): ?>
                                                <h6><?= htmlspecialchars($category ?? '') ?></h6>
                                                <table class="table table-sm table-bordered mb-4">
                                                    <thead>
                                                        <tr>
                                                            <th>Question</th>
                                                            <th width="100">Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($questions as $question): ?>
                                                            <?php
                                                            $answerValue = '';
                                                            foreach ($evaluation['details']['answers'] ?? [] as $answer) {
                                                                if (($answer['type'] ?? '') === 'matrix' && ($answer['label'] ?? '') === "$category > $question") {
                                                                    $answerValue = $answer['answer'] ?? '';
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($question ?? '') ?></td>
                                                                <td>
                                                                    <span class="badge bg-<?=
                                                                                            $answerValue == 1 ? 'danger' : ($answerValue == 2 ? 'warning' : ($answerValue == 3 ? 'info' : ($answerValue == 4 ? 'primary' : ($answerValue == 5 ? 'success' : 'secondary'))))
                                                                                            ?>">
                                                                        <?= htmlspecialchars($answerValue ?? '') ?>/5
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endforeach; ?>

                                            <!-- Textarea responses -->
                                            <?php foreach ($evaluation['details']['answers'] ?? [] as $answer): ?>
                                                <?php if (($answer['type'] ?? '') === 'textarea' && !empty($answer['answer'] ?? '')): ?>
                                                    <div class="mb-3">
                                                        <h6><?= htmlspecialchars($answer['label'] ?? '') ?></h6>
                                                        <p class="p-2 bg-light rounded"><?= nl2br(htmlspecialchars($answer['answer'] ?? '')) ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>

    <script>
        // Category Performance Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($categoryLabels) ?>,
                datasets: [{
                    label: 'Score (%)',
                    data: <?= json_encode($categoryScores) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                }
            }
        });

        // Perspective Distribution Chart
        const perspectiveCtx = document.getElementById('perspectiveChart').getContext('2d');
        const perspectiveChart = new Chart(perspectiveCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($perspectiveLabels) ?>,
                datasets: [{
                    data: <?= json_encode($perspectiveCounts) ?>,
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
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>