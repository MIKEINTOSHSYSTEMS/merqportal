<?php
// dashboard.php - Main dashboard page
require_once 'config.php';

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Get employees from database for dropdown
$employeesFromDB = getEmployeesFromDatabase();

// Handle filters
$selectedEmployee = $_GET['employee'] ?? '';
$selectedPerspective = $_GET['perspective'] ?? '';
$selectedCategory = $_GET['category'] ?? '';

// Filter evaluations if needed
$filteredEvaluations = $employeeEvaluations;
if (!empty($selectedEmployee) && isset($employeeEvaluations[$selectedEmployee])) {
    $filteredEvaluations = [$selectedEmployee => $employeeEvaluations[$selectedEmployee]];
}

// Prepare data for charts
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

$categoryAverages = [
    'Job Knowledge and Technical Skills' => 0,
    'Quality of Work' => 0,
    'Productivity and Efficiency' => 0,
    'Communication Skills' => 0,
    'Teamwork and Collaboration' => 0,
    'Problem-Solving and Initiative' => 0,
    'Professionalism and Work Ethic' => 0,
    'Adaptability and Continuous Improvement' => 0
];

$categoryCounts = array_fill_keys(array_keys($categoryAverages), 0);

foreach ($employeeEvaluations as $data) {
    $performanceCounts[$data['performance_category']]++;

    foreach ($data['perspective_counts'] as $perspective => $count) {
        $perspectiveCounts[$perspective] += $count;
    }

    foreach ($data['category_scores'] as $category => $scoreData) {
        if ($scoreData['count'] > 0) {
            $categoryAverages[$category] += $scoreData['percentage'];
            $categoryCounts[$category]++;
        }
    }
}

// Calculate final category averages
foreach ($categoryAverages as $category => $total) {
    if ($categoryCounts[$category] > 0) {
        $categoryAverages[$category] = $total / $categoryCounts[$category];
    }
}


require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Performance Evaluation Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-dashboard {
            transition: transform 0.3s;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-dashboard:hover {
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

        .sidebar {
            margin-top: 66px;
            background-color: #f8f9fa;
            height: 100vh;
            position: sticky;
            top: 0;
            padding-top: 20px;
        }

        .main-content {
            padding: 20px;
        }

        .evaluation-table th {
            background-color: #003366;
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto;
                position: relative;
            }

            .chart-container {
                height: 250px;
            }
        }

        .mb-4 {
            margin-top: 55px !important;
            margin-bottom: 1.5rem !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-md-block">
                <!--
                <div class="text-center mb-4">
                    <img src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" alt="MERQ Consultancy" class="img-fluid" style="max-height: 60px;">
                    <h5 class="mt-2">Performance Evaluation System</h5>
                </div>
    -->

                <form method="get" action="dashboard.php">
                    <div class="mb-3">
                        <label for="employeeFilter" class="form-label">Employee</label>
                        <select class="form-select" id="employeeFilter" name="employee">
                            <option value="">All Employees</option>
                            <?php foreach ($employeesFromDB as $id => $employee): ?>
                                <option value="<?= htmlspecialchars($id) ?>" <?= $selectedEmployee === $id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($employee['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="perspectiveFilter" class="form-label">Perspective</label>
                        <select class="form-select" id="perspectiveFilter" name="perspective">
                            <option value="">All Perspectives</option>
                            <option value="Self-evaluation" <?= $selectedPerspective === 'Self-evaluation' ? 'selected' : '' ?>>Self-evaluation</option>
                            <option value="Supervisor" <?= $selectedPerspective === 'Supervisor' ? 'selected' : '' ?>>Supervisor</option>
                            <option value="Subordinate" <?= $selectedPerspective === 'Subordinate' ? 'selected' : '' ?>>Subordinate</option>
                            <option value="Colleague" <?= $selectedPerspective === 'Colleague' ? 'selected' : '' ?>>Colleague</option>
                            <option value="Other" <?= $selectedPerspective === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categoryFilter" class="form-label">Performance Category</label>
                        <select class="form-select" id="categoryFilter" name="category">
                            <option value="">All Categories</option>
                            <option value="Needs Significant Improvement" <?= $selectedCategory === 'Needs Significant Improvement' ? 'selected' : '' ?>>Needs Significant Improvement</option>
                            <option value="Developing" <?= $selectedCategory === 'Developing' ? 'selected' : '' ?>>Developing</option>
                            <option value="Meets Expectations" <?= $selectedCategory === 'Meets Expectations' ? 'selected' : '' ?>>Meets Expectations</option>
                            <option value="Exceeds Expectations" <?= $selectedCategory === 'Exceeds Expectations' ? 'selected' : '' ?>>Exceeds Expectations</option>
                            <option value="Outstanding" <?= $selectedCategory === 'Outstanding' ? 'selected' : '' ?>>Outstanding</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Apply Filters</button>
                    <a href="dashboard.php" class="btn btn-outline-secondary w-100">Reset Filters</a>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="export.php?type=excel&employee=<?= htmlspecialchars($selectedEmployee) ?>&perspective=<?= htmlspecialchars($selectedPerspective) ?>&category=<?= htmlspecialchars($selectedCategory) ?>" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export to Excel
                        </a>
                        <a href="export.php?type=pdf&employee=<?= htmlspecialchars($selectedEmployee) ?>&perspective=<?= htmlspecialchars($selectedPerspective) ?>&category=<?= htmlspecialchars($selectedCategory) ?>" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                        </a>
                    </div>
                    <hr>
                    </hr>
                    <!--
                    <a href="../index.php" class="btn btn-secondary w-100"> <i class="bi bi-pen"></i> Go to Performance Evaluation App</a>
                            -->
                </form>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Performance Evaluation Dashboard</h2>
                    <span class="badge bg-primary"><?= count($submissions) ?> Submissions</span>
                </div>

                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Employees Evaluated</h5>
                                <h2 class="card-text"><?= count($employeeEvaluations) ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Average Score</h5>
                                <h2 class="card-text">
                                    <?php
                                    $totalScore = 0;
                                    $count = 0;
                                    foreach ($employeeEvaluations as $data) {
                                        $totalScore += $data['weighted_score'];
                                        $count++;
                                    }
                                    echo $count > 0 ? round($totalScore / $count, 1) . '%' : 'N/A';
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Top Performers</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Exceeds Expectations'] + $performanceCounts['Outstanding'] ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Need Improvement</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Needs Significant Improvement'] + $performanceCounts['Developing'] ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-dashboard">
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
                        <div class="card card-dashboard">
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

                <!-- Additional Charts -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card card-dashboard">
                            <div class="card-header">
                                <h5>Category Performance Averages</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="categoryChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Evaluations Table -->
                <div class="card card-dashboard mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Employee Evaluations</h5>
                        <span class="badge bg-secondary"><?= count($filteredEvaluations) ?> Results</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover evaluation-table">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Evaluations</th>
                                        <th>Weighted Score</th>
                                        <th>Performance Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($filteredEvaluations)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No evaluations found with the selected filters.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($filteredEvaluations as $employeeId => $data): ?>
                                            <?php $employee = $data['details']; ?>
                                            <tr>
                                                <td>
                                                    <strong><?= htmlspecialchars($employee['full_name']) ?></strong><br>
                                                    <small class="text-muted"><?= htmlspecialchars($employee['position_title']) ?></small>
                                                </td>
                                                <td>
                                                    <?php foreach ($data['perspective_counts'] as $perspective => $count): ?>
                                                        <?php if ($count > 0): ?>
                                                            <span class="badge bg-light text-dark me-1">
                                                                <?= htmlspecialchars($perspective) ?>: <?= $count ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar 
                                                            <?= $data['weighted_score'] < 30 ? 'bg-needs-improvement' : '' ?>
                                                            <?= $data['weighted_score'] >= 30 && $data['weighted_score'] < 61 ? 'bg-developing' : '' ?>
                                                            <?= $data['weighted_score'] >= 61 && $data['weighted_score'] < 76 ? 'bg-meets-expectations' : '' ?>
                                                            <?= $data['weighted_score'] >= 76 && $data['weighted_score'] <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                                            <?= $data['weighted_score'] > 90 ? 'bg-outstanding' : '' ?>"
                                                            role="progressbar"
                                                            style="width: <?= $data['weighted_score'] ?>%;"
                                                            aria-valuenow="<?= $data['weighted_score'] ?>"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <?= round($data['weighted_score'], 1) ?>%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="performance-badge 
                                                        <?= $data['performance_category'] === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                                        <?= $data['performance_category'] === 'Developing' ? 'bg-developing' : '' ?>
                                                        <?= $data['performance_category'] === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                                        <?= $data['performance_category'] === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                                        <?= $data['performance_category'] === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                                        <?= htmlspecialchars($data['performance_category']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="employee_report.php?employee=<?= htmlspecialchars($employeeId) ?>" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i> View Report
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>

    <script>
        // Performance Distribution Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
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

        // Perspective Distribution Chart
        const perspectiveCtx = document.getElementById('perspectiveChart').getContext('2d');
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

        // Category Performance Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: [
                    'Job Knowledge',
                    'Quality of Work',
                    'Productivity',
                    'Communication',
                    'Teamwork',
                    'Problem-Solving',
                    'Professionalism',
                    'Adaptability'
                ],
                datasets: [{
                    label: 'Average Score (%)',
                    data: [
                        <?= round($categoryAverages['Job Knowledge and Technical Skills'], 1) ?>,
                        <?= round($categoryAverages['Quality of Work'], 1) ?>,
                        <?= round($categoryAverages['Productivity and Efficiency'], 1) ?>,
                        <?= round($categoryAverages['Communication Skills'], 1) ?>,
                        <?= round($categoryAverages['Teamwork and Collaboration'], 1) ?>,
                        <?= round($categoryAverages['Problem-Solving and Initiative'], 1) ?>,
                        <?= round($categoryAverages['Professionalism and Work Ethic'], 1) ?>,
                        <?= round($categoryAverages['Adaptability and Continuous Improvement'], 1) ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(201, 203, 207, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(0, 128, 0, 0.7)'
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(0, 128, 0)'
                    ],
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>