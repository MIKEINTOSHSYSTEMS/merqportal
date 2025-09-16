<?php
// dashboard.php - Employee dashboard showing only their data
require_once '../includes/config.php';
require_once '../includes/header.php';

// Get the logged-in user's ID
$userId = $_SESSION['user_id'];

// Fetch and process data for this user only
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Filter to show only the current user's data
$userData = isset($employeeEvaluations[$userId]) ? $employeeEvaluations[$userId] : null;

// Get employee details
$employeeDetails = getEmployeeDetails($userId);
$strengthsAndImprovements = $userData ? getStrengthsAndImprovements($userData['evaluations']) : ['strengths' => [], 'improvements' => []];

// Prepare data for charts
$categoryLabels = [];
$categoryScores = [];

if ($userData && isset($userData['category_scores']) && is_array($userData['category_scores'])) {
    foreach ($userData['category_scores'] as $category => $scoreData) {
        if (isset($scoreData['count']) && $scoreData['count'] > 0) {
            $categoryLabels[] = substr($category, 0, 15) . (strlen($category) > 15 ? '...' : '');
            $categoryScores[] = round($scoreData['percentage'], 1);
        }
    }
}
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
    <script src="../script/performance.js"></script>
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #07cae9;
            --light-bg: #f8f9fa;
            --bg-color: #f7fafc;
            --card-bg: #ffffff;
            --header-bg: #ffffff77;
            /*rgba(255, 255, 255, 0.95);*/
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 12px;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --error-color: #f56565;
            --info-color: #4299e1;
            --border-color: #e2e8f0;
            --neon-green: #00ddff;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            --card-hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            color: #343a40;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-dashboard {
            transition: var(--transition);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            border: none;
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        .card-dashboard:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-hover-shadow);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #d9d9d9 100%);
            color: white;
            border-bottom: none;
            padding: 1.2rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        .performance-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .bg-needs-improvement {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .bg-developing {
            background: linear-gradient(135deg, #fd7e14 0%, #e76505 100%);
            color: white;
        }

        .bg-meets-expectations {
            background: linear-gradient(135deg, #ffc107 0%, #e6ac00 100%);
            color: black;
        }

        .bg-exceeds-expectations {
            background: linear-gradient(135deg, #20c997 0%, #19a97d 100%);
            color: white;
        }

        .bg-outstanding {
            background: linear-gradient(135deg, #198754 0%, #136b3f 100%);
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            animation: slideIn 0.5s ease-out;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .progress {
            height: 12px;
            border-radius: 10px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .list-group-item {
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px !important;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .accordion-button {
            border-radius: 8px !important;
            font-weight: 500;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-score {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 250px;
            }

            .stats-number {
                font-size: 1.8rem;
            }

            .card-dashboard {
                margin-bottom: 15px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 15px rgba(0, 51, 102, 0.4);
            z-index: 1000;
            cursor: pointer;
            transition: var(--transition);
        }

        .floating-action-btn:hover {
            transform: scale(1.1);
            background: #00264d;
        }

        .no-print {
            display: flex;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
            }
        }

        .tooltip-btn {
            cursor: pointer;
            color: var(--primary-color);
            margin-left: 5px;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

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
            top: 100px;
            padding-top: 70px;
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

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: rgb(7 34 71) !important;
        }

        .btn-link {
            --bs-btn-font-weight: 400;
            --bs-btn-color: #f79b1f;
            --bs-btn-bg: transparent;
            --bs-btn-border-color: transparent;
            --bs-btn-hover-color: var(--bs-link-hover-color);
            --bs-btn-hover-border-color: transparent;
            --bs-btn-active-color: var(--bs-link-hover-color);
            --bs-btn-active-border-color: transparent;
            --bs-btn-disabled-color: #6c757d;
            --bs-btn-disabled-border-color: transparent;
            --bs-btn-box-shadow: 0 0 0 #000;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
            text-decoration: underline;
        }

        .btn-link:hover {
            color: #fafafa;
        }

        /* Digital Clock Styles */
        .digital-clock {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--neon-green);
            padding: 10px 15px;
            border-radius: var(--border-radius);
            display: inline-block;
            margin-right: 15px;
            box-shadow: var(--shadow);
        }

        .clock-time {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .clock-date {
            font-size: 0.9rem;
            text-align: center;
            margin-top: 5px;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="h3 mb-1">My Performance Dashboard</h3>
                        <p class="mb-0 text-muted">Welcome, <b><?= htmlspecialchars($_SESSION['full_name'] ?? 'User') ?></b></p>
                        <p class="mb-0 text-muted">Position: <b><?= htmlspecialchars($employeeDetails['position_title'] ?? '') ?></b></p>
                        <p>Under <b><?= htmlspecialchars($employeeDetails['department_name'] ?? '') ?> Depratment</b></p>
                    </div>
                    <div class="d-flex mt-2 mt-md-0">
                        <!--
                        <button onclick="window.print()" class="btn btn-light me-2 no-print">
                            <i class="fas fa-print me-1"></i> Print Report
                        </button>
                        -->
                    </div>
                    <div class="digital-clock">
                        <div class="clock-time" id="clockTime">00:00:00</div>
                        <div class="clock-date" id="clockDate">Loading...</div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($userData): ?>
            <!-- Performance Overview Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number"><?= round($userData['weighted_score'] ?? 0, 1) ?>%</div>
                        <div class="stats-label">Overall Score</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number"><?= array_sum($userData['perspective_counts'] ?? []) ?></div>
                        <div class="stats-label">Total Evaluations</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number"><?= count($userData['perspective_counts'] ?? []) ?></div>
                        <div class="stats-label">Evaluation Perspectives</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number"><?= count($userData['category_scores'] ?? []) ?></div>
                        <div class="stats-label">Categories Evaluated</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Column - Summary and Charts -->
                <div class="col-lg-5">
                    <!-- Performance Summary -->
                    <div class="card card-report">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Performance Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div class="performance-badge d-inline-block 
                                <?= ($userData['performance_category'] ?? '') === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                <?= ($userData['performance_category'] ?? '') === 'Developing' ? 'bg-developing' : '' ?>
                                <?= ($userData['performance_category'] ?? '') === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                <?= ($userData['performance_category'] ?? '') === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                <?= ($userData['performance_category'] ?? '') === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                    <?= htmlspecialchars($userData['performance_category'] ?? 'Not Available') ?>
                                </div>
                                <h2 class="mt-3"><?= round($userData['weighted_score'] ?? 0, 1) ?>%</h2>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar 
                                    <?= ($userData['weighted_score'] ?? 0) < 30 ? 'bg-needs-improvement' : '' ?>
                                    <?= ($userData['weighted_score'] ?? 0) >= 30 && ($userData['weighted_score'] ?? 0) < 61 ? 'bg-developing' : '' ?>
                                    <?= ($userData['weighted_score'] ?? 0) >= 61 && ($userData['weighted_score'] ?? 0) < 76 ? 'bg-meets-expectations' : '' ?>
                                    <?= ($userData['weighted_score'] ?? 0) >= 76 && ($userData['weighted_score'] ?? 0) <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                    <?= ($userData['weighted_score'] ?? 0) > 90 ? 'bg-outstanding' : '' ?>"
                                        role="progressbar"
                                        style="width: <?= ($userData['weighted_score'] ?? 0) ?>%;"
                                        aria-valuenow="<?= ($userData['weighted_score'] ?? 0) ?>"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <h6><i class="fas fa-users me-1"></i> Evaluation Perspectives:</h6>
                            <ul class="list-group mb-3">
                                <?php if (isset($userData['perspective_counts']) && is_array($userData['perspective_counts'])): ?>
                                    <?php foreach ($userData['perspective_counts'] as $perspective => $count): ?>
                                        <?php if ($count > 0): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= htmlspecialchars($perspective ?? '') ?>
                                                <span class="badge bg-primary rounded-pill"><?= $count ?></span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="list-group-item">No evaluation data available</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Category Performance -->
                    <div class="card card-report">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-chart-bar me-2"></i>Category Performance</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Details -->
                <div class="col-lg-7">
                    <!-- Category Scores -->
                    <div class="card card-report">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fa-solid fa-arrow-up-9-1 me-2"></i>Category Scores</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($userData['category_scores'] ?? [] as $category => $scoreData): ?>
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

                    <!-- Strengths and Improvements -->
                    <div class="accordion mb-4" id="feedbackAccordion">
                        <!-- Strengths -->
                        <div class="card card-report">
                            <div class="card-header" id="strengthsHeading">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#strengthsCollapse" aria-expanded="false" aria-controls="strengthsCollapse">
                                        <span><i class="fas fa-plus-circle me-2"></i> Strengths</span>
                                        <span class="badge bg-success"><?= count($strengthsAndImprovements['strengths'] ?? []) ?></span>
                                    </button>
                                </h5>
                            </div>
                            <div id="strengthsCollapse" class="collapse" aria-labelledby="strengthsHeading" data-bs-parent="#feedbackAccordion">
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
                        </div>

                        <!-- Improvements -->
                        <div class="card card-report">
                            <div class="card-header" id="improvementsHeading">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#improvementsCollapse" aria-expanded="false" aria-controls="improvementsCollapse">
                                        <span><i class="fas fa-plus-circle me-2"></i> Areas for Improvement</span>
                                        <span class="badge bg-warning"><?= count($strengthsAndImprovements['improvements'] ?? []) ?></span>
                                    </button>
                                </h5>
                            </div>
                            <div id="improvementsCollapse" class="collapse" aria-labelledby="improvementsHeading" data-bs-parent="#feedbackAccordion">
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button -->
            <div class="floating-action-btn no-print" onclick="scrollToTop()">
                <i class="fas fa-arrow-up"></i>
            </div>

            <script>
                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })

                // Animate elements on page load
                document.addEventListener('DOMContentLoaded', function() {
                    // Animate stats cards
                    anime({
                        targets: '.stats-card',
                        translateY: [50, 0],
                        opacity: [0, 1],
                        delay: anime.stagger(100),
                        duration: 800,
                        easing: 'easeOutQuart'
                    });

                    // Animate progress bars
                    setTimeout(function() {
                        document.querySelectorAll('.progress-bar').forEach(function(bar) {
                            bar.style.transition = 'width 1.5s ease-in-out';
                        });
                    }, 500);
                });

                // Category Performance Chart
                const categoryCtx = document.getElementById('categoryChart').getContext('2d');
                const categoryChart = new Chart(categoryCtx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($categoryLabels) ?>,
                        datasets: [{
                            label: 'Score (%)',
                            data: <?= json_encode($categoryScores) ?>,
                            backgroundColor: '#00799BFF',
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
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                titleFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    size: 13
                                },
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.raw + '%';
                                    }
                                }
                            },
                            legend: {
                                display: false
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                formatter: function(value) {
                                    return value + '%';
                                },
                                color: '#343a40',
                                font: {
                                    weight: 'bold',
                                    size: 11
                                }
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    },
                    plugins: [ChartDataLabels]
                });

                // Refresh data function
                function refreshData() {
                    const refreshBtn = document.getElementById('refreshBtn');
                    const originalHtml = refreshBtn.innerHTML;

                    // Show loading state
                    refreshBtn.innerHTML = '<span class="loading-spinner"></span> Refreshing...';
                    refreshBtn.disabled = true;

                    // Simulate refresh (in a real app, this would be an AJAX call)
                    setTimeout(function() {
                        // Reload the page
                        window.location.reload();
                    }, 1500);
                }

                // Scroll to top function
                function scrollToTop() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }

                // Add event listener for scroll to show/hide floating button
                window.addEventListener('scroll', function() {
                    const floatingBtn = document.querySelector('.floating-action-btn');
                    if (window.scrollY > 300) {
                        floatingBtn.style.display = 'flex';
                        anime({
                            targets: '.floating-action-btn',
                            opacity: 1,
                            scale: [0.8, 1],
                            duration: 500,
                            easing: 'easeOutQuart'
                        });
                    } else {
                        floatingBtn.style.display = 'none';
                    }
                });
            </script>
        <?php else: ?>
            <div class="alert alert-info">
                <h4 class="alert-heading">No Evaluation Data Available</h4>
                <p>You don't have any performance evaluation data yet. Please check back later or contact your administrator.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php require_once '../includes/footer.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>