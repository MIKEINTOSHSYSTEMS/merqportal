<?php
// admin_dashboard.php - Main dashboard page
require_once '../includes/config.php';
require_once '../includes/auth_check.php';


// Get employees from database
$employees = getEmployeesFromDatabase();

// Fetch and process data
$submissions = getSubmissions();
// Count them
$totalSubmissions = count($submissions);
$employeeEvaluations = calculateWeightedScores($submissions);

// Get employees from database for dropdown
$employeesFromDB = getEmployeesFromDatabase();

// Handle filters
$selectedEmployee = $_GET['employee'] ?? '';
$selectedPerspective = $_GET['perspective'] ?? '';
$selectedCategory = $_GET['category'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

// Filter evaluations if needed
$filteredEvaluations = $employeeEvaluations;
if (!empty($selectedEmployee) && isset($employeeEvaluations[$selectedEmployee])) {
    $filteredEvaluations = [$selectedEmployee => $employeeEvaluations[$selectedEmployee]];
}

// Apply additional filters
$filteredEvaluations = applyFilters($filteredEvaluations, $selectedPerspective, $selectedCategory, $startDate, $endDate);

// Prepare data for charts
$performanceCounts = [
    'Needs Significant Improvement' => 0,
    'Developing' => 0,
    'Meets Expectations' => 0,
    'Exceeds Expectations' => 0,
    'Outstanding' => 0,
    'Not Rated' => 0
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

foreach ($filteredEvaluations as $data) {
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

// Function to apply filters
function applyFilters($evaluations, $perspective, $category, $startDate, $endDate)
{
    $filtered = [];

    foreach ($evaluations as $employeeId => $data) {
        // Filter by perspective
        if (!empty($perspective) && (!isset($data['perspective_counts'][$perspective]) || $data['perspective_counts'][$perspective] == 0)) {
            continue;
        }

        // Filter by category
        if (!empty($category) && $data['performance_category'] !== $category) {
            continue;
        }

        // Filter by date range
        if (!empty($startDate) || !empty($endDate)) {
            $hasValidDate = false;
            foreach ($data['evaluations'] as $evaluation) {
                $evalDate = strtotime($evaluation['submission_date']);
                $startTimestamp = !empty($startDate) ? strtotime($startDate) : 0;
                $endTimestamp = !empty($endDate) ? strtotime($endDate) : PHP_INT_MAX;

                if ($evalDate >= $startTimestamp && $evalDate <= $endTimestamp) {
                    $hasValidDate = true;
                    break;
                }
            }

            if (!$hasValidDate) {
                continue;
            }
        }

        $filtered[$employeeId] = $data;
    }

    return $filtered;
}

require_once '../includes/header.php';
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="../js/interactive.js"></script>
    <link href="../css/main.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-md-block">
                <form method="get" action="admin_dashboard.php">
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
                            <option value="Not Rated" <?= $selectedCategory === 'Not Rated' ? 'selected' : '' ?>>Not Rated</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="start_date" value="<?= htmlspecialchars($startDate) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="end_date" value="<?= htmlspecialchars($endDate) ?>">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Apply Filters</button>
                    <a href="admin_dashboard.php" class="btn btn-outline-secondary w-100">Reset Filters</a>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="export.php?type=excel&employee=<?= htmlspecialchars($selectedEmployee) ?>&perspective=<?= htmlspecialchars($selectedPerspective) ?>&category=<?= htmlspecialchars($selectedCategory) ?>&start_date=<?= htmlspecialchars($startDate) ?>&end_date=<?= htmlspecialchars($endDate) ?>" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export to Excel
                        </a>
                        <a href="export.php?type=pdf&employee=<?= htmlspecialchars($selectedEmployee) ?>&perspective=<?= htmlspecialchars($selectedPerspective) ?>&category=<?= htmlspecialchars($selectedCategory) ?>&start_date=<?= htmlspecialchars($startDate) ?>&end_date=<?= htmlspecialchars($endDate) ?>" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                        </a>
                    </div>
                    <hr>
                    </hr>
                </form>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Performance Evaluation Dashboard</h2>
                    <span class="badge bg-primary"><?= $totalSubmissions ?> Submissions</span>
                </div>

                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Employees Evaluated</h5>
                                <h2 class="card-text"><?= count($filteredEvaluations) ?></h2>
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
                                    foreach ($filteredEvaluations as $data) {
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
                                <h5 class="card-title">Outstanding</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Outstanding'] +  $performanceCounts['Not Rated'] ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-exceeds-expectations">
                            <div class="card-body">
                                <h5 class="card-title">Exceeds Expectations</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Exceeds Expectations'] ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Meets Expectation</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Meets Expectations'] ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-developing">
                            <div class="card-body">
                                <h5 class="card-title">Developing</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Developing'] ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">Need Improvement</h5>
                                <h2 class="card-text">
                                    <?= $performanceCounts['Needs Significant Improvement'] + $performanceCounts['Needs Significant Improvement'] ?>
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
                                <div class="chart-legend" id="performanceLegend"></div>
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
                                <div class="chart-legend" id="perspectiveLegend"></div>
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
                                        <th>CEO Feedback</th>
                                        <th>Weighted Score</th>
                                        <th>Performance Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($filteredEvaluations)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No evaluations found with the selected filters.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php
                                        // Get CEO feedback counts for all employees
                                        $ceoFeedbackCounts = [];
                                        foreach ($filteredEvaluations as $employeeId => $data) {
                                            $ceoFeedbackCounts[$employeeId] = getCEOFeedbackCount($employeeId);
                                        }
                                        ?>

                                        <?php foreach ($filteredEvaluations as $employeeId => $data): ?>
                                            <?php $employee = $data['details']; ?>
                                            <?php $feedbackCount = $ceoFeedbackCounts[$employeeId]; ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($employee['full_name']) ?>&background=007bff&color=fff&size=40"
                                                                alt="<?= htmlspecialchars($employee['full_name']) ?>"
                                                                class="rounded-circle me-3" width="40" height="40">
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <strong><?= htmlspecialchars($employee['full_name']) ?></strong><br>
                                                            <small class="text-muted"><?= htmlspecialchars($employee['position_title']) ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php foreach ($data['perspective_counts'] as $perspective => $count): ?>
                                                        <?php if ($count > 0): ?>
                                                            <span class="badge bg-light text-dark me-1 mb-1">
                                                                <?= htmlspecialchars($perspective) ?>: <?= $count ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $feedbackCount = getCEOFeedbackCount($employeeId);
                                                    $responseCount = 0;
                                                    $ceoFeedbackItems = getCEOFeedback($employeeId, false);
                                                    foreach ($ceoFeedbackItems as $feedback) {
                                                        $responses = getFeedbackResponses($feedback['id']);
                                                        $responseCount += count($responses);
                                                    }
                                                    ?>
                                                    <?php if ($feedbackCount > 0): ?>
                                                        <div class="d-flex flex-column gap-1">
                                                            <span class="badge bg-warning text-dark ceo-feedback-badge"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="<?= $feedbackCount ?> CEO Feedback item(s)">
                                                                <i class="fas fa-user-tie me-1"></i><?= $feedbackCount ?> Feedback
                                                            </span>
                                                            <?php if ($responseCount > 0): ?>
                                                                <span class="badge bg-success response-badge"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="<?= $responseCount ?> Response(s)">
                                                                    <i class="fas fa-reply me-1"></i><?= $responseCount ?> Response(s)
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary response-badge"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="No responses yet">
                                                                    <i class="fas fa-clock me-1"></i>Awaiting
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">None</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar 
                                            <?= $data['weighted_score'] < 30 ? 'bg-needs-improvement' : '' ?>
                                            <?= $data['weighted_score'] >= 30 && $data['weighted_score'] <= 60 ? 'bg-developing' : '' ?>
                                            <?= $data['weighted_score'] >= 60 && $data['weighted_score'] <= 75 ? 'bg-meets-expectations' : '' ?>
                                            <?= $data['weighted_score'] >= 75 && $data['weighted_score'] <= 90 ? 'bg-exceeds-expectations' : '' ?>
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
                                        <?= $data['performance_category'] === 'Outstanding' ? 'bg-outstanding' : '' ?>
                                        <?= $data['performance_category'] === 'Not Rated' ? 'bg-not-rated' : '' ?>">
                                                        <?= htmlspecialchars($data['performance_category']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="employee_report.php?employee=<?= htmlspecialchars($employeeId) ?>"
                                                            class="btn btn-sm btn-info"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-title="View Report">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <?php if ($feedbackCount > 0): ?>
                                                            <a href="feedback.php?employee=<?= htmlspecialchars($employeeId) ?>"
                                                                class="btn btn-sm btn-warning"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="View CEO Feedback">
                                                                <i class="fas fa-user-tie"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
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

    <?php require_once '../includes/footer.php'; ?>

    <script>
        // Register the plugin to all charts
        Chart.register(ChartDataLabels);

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
                    'Outstanding',
                    'Not Rated' // Add this
                ],
                datasets: [{
                    data: [
                        <?= $performanceCounts['Needs Significant Improvement'] ?>,
                        <?= $performanceCounts['Developing'] ?>,
                        <?= $performanceCounts['Meets Expectations'] ?>,
                        <?= $performanceCounts['Exceeds Expectations'] ?>,
                        <?= $performanceCounts['Outstanding'] ?>,
                        <?= $performanceCounts['Not Rated'] ?> // Add this
                    ],
                    backgroundColor: [
                        '#dc3545',
                        '#fd7e14',
                        '#ffc107',
                        '#20c997',
                        '#198754',
                        '#6c757d'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                weight: 'bold',
                                size: 14,
                                family: 'Arial'
                            },
                            color: '#07c9e9' // Set the legend text color to custom color
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        },
                        titleFont: {
                            weight: 'bold',
                            size: 14,
                            family: 'Arial'
                        },
                        bodyFont: {
                            weight: 'bold',
                            size: 14,
                            family: 'Arial'
                        },
                        titleColor: '#0783E9FF', // Tooltip title color
                        bodyColor: '#00DDFFFF' // Tooltip body color
                    },
                    datalabels: {
                        color: '#2D5D64FF', // Set datalabels to custom color
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        formatter: (value, ctx) => {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${percentage}%`;
                        }
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
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}`;
                            }
                        },
                        titleFont: {
                            weight: 'bold',
                            size: 14,
                            family: 'Arial'
                        },
                        bodyFont: {
                            weight: 'bold',
                            size: 14,
                            family: 'Arial'
                        },
                        titleColor: '#527D83FF', // Tooltip title color
                        bodyColor: '#00D9FFFF' // Tooltip body color
                    },
                    datalabels: {
                        color: '#0097BAFF', // Set datalabels to custom color
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold'
                        },
                        formatter: function(value) {
                            return value;
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#2164F4FF' // Set Y axis tick labels to custom color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#007C8FFF' // Set X axis tick labels to custom color
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
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw + '%';
                            }
                        },
                        titleFont: {
                            weight: 'bold',
                            size: 14,
                            family: 'Arial'
                        },
                        bodyFont: {
                            weight: 'bold',
                            size: 14,
                            family: 'Arial'
                        },
                        titleColor: 'red', // Tooltip title color
                        bodyColor: 'orange' // Tooltip body color
                    },
                    datalabels: {
                        color: '#005663FF', // Set datalabels to custom color
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold'
                        },
                        formatter: function(value) {
                            return value + '%';
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            },
                            color: '#006C7CFF' // Y axis tick labels color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#07c9e9' // X axis tick labels color
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>