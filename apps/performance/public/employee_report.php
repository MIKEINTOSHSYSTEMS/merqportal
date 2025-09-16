<?php
// employee_report.php - Detailed employee evaluation report
require_once '../includes/config.php';
require_once '../includes/auth_check.php'; // Add authentication check

// Get employee ID from query parameter or use logged-in user's ID
$employeeId = $_GET['employee'] ?? $_SESSION['user_id'];

// Ensure user can only access their own data unless they're admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    $employeeId = $_SESSION['user_id'];
}

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

if (!isset($employeeEvaluations[$employeeId])) {
    // If no evaluation data, redirect to dashboard
    header('Location: dashboard.php');
    exit;
}

$employeeData = $employeeEvaluations[$employeeId];
$employeeDetails = $employeeData['details'];
$strengthsAndImprovements = getStrengthsAndImprovements($employeeData['evaluations']);

// Prepare data for charts - with proper error checking
$categoryLabels = [];
$categoryScores = [];

if (isset($employeeData['category_scores']) && is_array($employeeData['category_scores'])) {
    foreach ($employeeData['category_scores'] as $category => $scoreData) {
        if (isset($scoreData['count']) && $scoreData['count'] > 0) {
            $categoryLabels[] = substr($category, 0, 15) . (strlen($category) > 15 ? '...' : '');
            $categoryScores[] = round($scoreData['percentage'], 1);
        }
    }
}

$perspectiveLabels = [];
$perspectiveCounts = [];

if (isset($employeeData['perspective_counts']) && is_array($employeeData['perspective_counts'])) {
    foreach ($employeeData['perspective_counts'] as $perspective => $count) {
        if ($count > 0) {
            $perspectiveLabels[] = $perspective;
            $perspectiveCounts[] = $count;
        }
    }
}

// Prepare data for trend charts
$submissionDates = [];
$performanceTrend = [];
$categoryTrends = [];

if (isset($employeeData['evaluations']) && is_array($employeeData['evaluations'])) {
    foreach ($employeeData['evaluations'] as $evaluation) {
        if (isset($evaluation['submission_date'])) {
            $date = date('M Y', strtotime($evaluation['submission_date']));
            $submissionDates[] = $date;
            $performanceTrend[] = isset($evaluation['score']) ? round($evaluation['score'], 1) : 0;

            // Prepare category trends
            if (isset($evaluation['category_scores']) && is_array($evaluation['category_scores'])) {
                foreach ($evaluation['category_scores'] as $category => $score) {
                    if (!isset($categoryTrends[$category])) {
                        $categoryTrends[$category] = [];
                    }
                    $categoryTrends[$category][] = isset($score['average']) ? round($score['average'], 1) : 0;
                }
            }
        }
    }
}

// Get unique perspectives for filters
$perspectives = [];
if (isset($employeeData['perspective_counts']) && is_array($employeeData['perspective_counts'])) {
    $perspectives = array_keys($employeeData['perspective_counts']);
}

require_once '../includes/header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Employee Performance Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #00C7FFFF;
            --secondary-color: #0073ACFF;
            --success-color: #4cc9f0;
            --info-color: #00EAFFFF;
            --warning-color: #f72585;
            --danger-color: #e63946;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --light-gray: #e9ecef;
        }

        body {
            background-color: #f5f7fb;
            color: #343a40;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-report {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 24px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-left: 4px solid var(--primary-color);
        }

        .card-report:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1.2rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        .performance-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
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

        .chart-container-sm {
            height: 250px;
        }

        .evaluation-table th {
            background-color: var(--primary-color);
            color: white;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--primary-color);
            color: white;
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .matrix-table th {
            background-color: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 250px;
            }

            .chart-container-sm {
                height: 200px;
            }

            .card-report {
                margin-bottom: 15px;
            }

            .filter-section {
                flex-direction: column;
            }
        }

        .filter-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .print-only {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .print-section,
            .print-section * {
                visibility: visible;
            }

            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            .print-only {
                display: block;
            }

            .card-report {
                break-inside: avoid;
            }

            .chart-container {
                height: 200px;
            }

            .accordion-button::after {
                display: none !important;
            }

            .accordion-button:not(.collapsed) {
                background-color: white !important;
                color: black !important;
                box-shadow: none;
            }

            .accordion-collapse {
                display: block !important;
                height: auto !important;
            }
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stats-label {
            color: var(--gray-color);
            font-weight: 500;
        }

        .suggestion-card {
            border-left: 4px solid var(--primary-color);
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
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            z-index: 1000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floating-action-btn:hover {
            transform: scale(1.1);
            background: var(--secondary-color);
        }

        .btn-link {
            --bs-btn-font-weight: 400;
            --bs-btn-color: #00c7ff;
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


        .mb-4 {
            margin-top: 70px;
            margin-bottom: 1.5rem !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4 print-section">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h1 class="h2 mb-1">Performance Report</h1>
                        <p class="mb-0 text-muted"><b><?= htmlspecialchars($_SESSION['full_name'] ?? 'User') ?></b></p>
                        <p class="mb-0 text-muted">Position: <b><?= htmlspecialchars($employeeDetails['position_title'] ?? '') ?></b></p>
                        <p>Under <b><?= htmlspecialchars($employeeDetails['department_name'] ?? '') ?> Depratment</b></p>
                        <p>Supervisor: <b><?= htmlspecialchars($employeeDetails['supervisor_name'] ?? '') ?> </b></p>
                    </div>
                    <div class="d-flex mt-2 mt-md-0">
                        <button onclick="printReport()" class="btn btn-light me-2 no-print">
                            <i class="fas fa-print me-1"></i> Print Report
                        </button>
                        <a href="dashboard.php" class="btn btn-light me-2 no-print">
                            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                        </a>
                        <div class="dropdown no-print">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-download me-1"></i> Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="export_report.php?employee=<?= htmlspecialchars($employeeId ?? '') ?>&type=pdf">PDF</a></li>
                                <li><a class="dropdown-item" href="export_report.php?employee=<?= htmlspecialchars($employeeId ?? '') ?>&type=excel">Excel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Header (Only visible when printing) -->
        <div class="print-only mb-4">
            <h1>Employee Performance Report: <?= htmlspecialchars($employeeDetails['full_name'] ?? '') ?></h1>
            <p>Position: <?= htmlspecialchars($employeeDetails['position_title'] ?? '') ?> | Department: <?= htmlspecialchars($employeeDetails['department_name'] ?? '') ?></p>
            <p>Generated on: <?= date('F j, Y') ?></p>
            <hr>
        </div>

        <!-- Filters Section -->
        <div class="filter-section no-print">
            <div class="filter-group">
                <label class="form-label">Perspective Filter</label>
                <select class="form-select" id="perspectiveFilter">
                    <option value="all">All Perspectives</option>
                    <?php foreach ($perspectives as $perspective): ?>
                        <option value="<?= htmlspecialchars($perspective) ?>"><?= htmlspecialchars($perspective) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label class="form-label">Performance Category</label>
                <select class="form-select" id="performanceFilter">
                    <option value="all">All Categories</option>
                    <option value="Needs Significant Improvement">Needs Improvement</option>
                    <option value="Developing">Developing</option>
                    <option value="Meets Expectations">Meets Expectations</option>
                    <option value="Exceeds Expectations">Exceeds Expectations</option>
                    <option value="Outstanding">Outstanding</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="form-label">Date Range</label>
                <select class="form-select" id="dateFilter">
                    <option value="all">All Time</option>
                    <option value="3months">Last 3 Months</option>
                    <option value="6months">Last 6 Months</option>
                    <option value="1year">Last Year</option>
                </select>
            </div>

            <div class="filter-group">
                <button class="btn btn-primary" id="applyFilters">
                    <i class="fas fa-filter me-1"></i> Apply Filters
                </button>
                <button class="btn btn-outline-secondary mt-2" id="resetFilters">
                    <i class="fas fa-sync me-1"></i> Reset
                </button>
            </div>
        </div>

        <!-- Performance Overview Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number"><?= round($employeeData['weighted_score'] ?? 0, 1) ?>%</div>
                    <div class="stats-label">Overall Score</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number"><?= array_sum($employeeData['perspective_counts'] ?? []) ?></div>
                    <div class="stats-label">Total Evaluations</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number"><?= count($perspectives) ?></div>
                    <div class="stats-label">Evaluation Perspectives</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number"><?= count($employeeData['category_scores'] ?? []) ?></div>
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
                                <?= ($employeeData['performance_category'] ?? '') === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Developing' ? 'bg-developing' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                <?= ($employeeData['performance_category'] ?? '') === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                <?= htmlspecialchars($employeeData['performance_category'] ?? 'Not Available') ?>
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

                        <h6><i class="fas fa-users me-1"></i> Evaluation Perspectives:</h6>
                        <ul class="list-group mb-3">
                            <?php if (isset($employeeData['perspective_counts']) && is_array($employeeData['perspective_counts'])): ?>
                                <?php foreach ($employeeData['perspective_counts'] as $perspective => $count): ?>
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

                <!-- Performance Trend -->
                <div class="card card-report">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Performance Trend</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="trendChart"></canvas>
                        </div>
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

                <!-- Evaluation Perspectives -->
                <div class="card card-report">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-chart-pie me-2"></i>Evaluation Perspectives</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="perspectiveChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="col-lg-7">

                <!-- Category Scores -->
                <div class="card card-report">
                    <!--<div class="card-header bg-info text-white">-->
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fa-solid fa-arrow-up-9-1 me-2"></i>Category Scores</h5>
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



                <!-- Improvement Suggestions -->
                <div class="card card-report suggestion-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-lightbulb me-2"></i>Performance Improvement Suggestions</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $lowestCategories = [];
                        if (isset($employeeData['category_scores']) && is_array($employeeData['category_scores'])) {
                            foreach ($employeeData['category_scores'] as $category => $scoreData) {
                                if (isset($scoreData['count']) && $scoreData['count'] > 0) {
                                    $lowestCategories[$category] = $scoreData['percentage'];
                                }
                            }
                            asort($lowestCategories);
                            $lowestCategories = array_slice($lowestCategories, 0, 3, true);
                        }

                        if (!empty($lowestCategories)): ?>
                            <p>Based on the evaluation results, focus on improving these areas:</p>
                            <ul class="list-group">
                                <?php foreach ($lowestCategories as $category => $score): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= htmlspecialchars($category) ?>
                                        <span class="badge bg-danger rounded-pill"><?= round($score, 1) ?>%</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No specific improvement areas identified.</p>
                        <?php endif; ?>
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

                <!-- Evaluation Details -->
                <div class="card card-report">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-clipboard-list me-2"></i>Evaluation Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="evaluationAccordion">
                            <?php if (isset($employeeData['evaluations']) && is_array($employeeData['evaluations'])): ?>
                                <?php foreach ($employeeData['evaluations'] as $index => $evaluation):
                                    $matrixQuestions = getMatrixQuestions($evaluation['details'] ?? []);
                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?= $index ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                                                <div class="d-flex justify-content-between w-100 me-3">
                                                    <span>
                                                        <i class="fas fa-user-circle me-1"></i>
                                                        <?= htmlspecialchars($evaluation['perspective'] ?? '') ?>
                                                        - <?= htmlspecialchars($evaluation['submission_date'] ?? '') ?>
                                                    </span>
                                                    <span class="badge 
                                                        <?= ($evaluation['score'] ?? 0) < 30 ? 'bg-needs-improvement' : '' ?>
                                                        <?= ($evaluation['score'] ?? 0) >= 30 && ($evaluation['score'] ?? 0) < 61 ? 'bg-developing' : '' ?>
                                                        <?= ($evaluation['score'] ?? 0) >= 61 && ($evaluation['score'] ?? 0) < 76 ? 'bg-meets-expectations' : '' ?>
                                                        <?= ($evaluation['score'] ?? 0) >= 76 && ($evaluation['score'] ?? 0) <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                                        <?= ($evaluation['score'] ?? 0) > 90 ? 'bg-outstanding' : '' ?>">
                                                        <?= round($evaluation['score'] ?? 0, 1) ?>%
                                                    </span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#evaluationAccordion">
                                            <div class="accordion-body">
                                                <?php if (!empty($matrixQuestions)): ?>
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
                                                                    if (isset($evaluation['details']['answers']) && is_array($evaluation['details']['answers'])) {
                                                                        foreach ($evaluation['details']['answers'] as $answer) {
                                                                            if (($answer['type'] ?? '') === 'matrix' && ($answer['label'] ?? '') === "$category > $question") {
                                                                                $answerValue = $answer['answer'] ?? '';
                                                                                break;
                                                                            }
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
                                                <?php endif; ?>

                                                <!-- Textarea responses -->
                                                <?php if (isset($evaluation['details']['answers']) && is_array($evaluation['details']['answers'])): ?>
                                                    <?php foreach ($evaluation['details']['answers'] as $answer): ?>
                                                        <?php if (($answer['type'] ?? '') === 'textarea' && !empty($answer['answer'] ?? '')): ?>
                                                            <div class="mb-3">
                                                                <h6><?= htmlspecialchars($answer['label'] ?? '') ?></h6>
                                                                <p class="p-2 bg-light rounded"><?= nl2br(htmlspecialchars($answer['answer'] ?? '')) ?></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">No evaluation details available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="floating-action-btn no-print" onclick="printReport()">
        <i class="fas fa-print"></i>
    </div>

    <?php require_once '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Print function
        function printReport() {
            window.print();
        }

        // Initialize all accordions properly
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap accordions
            const accordions = document.querySelectorAll('.accordion-button');
            accordions.forEach(button => {
                button.addEventListener('click', function() {
                    const target = this.getAttribute('data-bs-target');
                    const collapseElement = document.querySelector(target);

                    // Toggle icon
                    const icon = this.querySelector('i');
                    if (icon) {
                        if (this.classList.contains('collapsed')) {
                            icon.classList.remove('fa-plus-circle');
                            icon.classList.add('fa-minus-circle');
                        } else {
                            icon.classList.remove('fa-minus-circle');
                            icon.classList.add('fa-plus-circle');
                        }
                    }
                });
            });

            // Make sure all accordions start collapsed
            const collapses = document.querySelectorAll('.accordion-collapse');
            collapses.forEach(collapse => {
                collapse.classList.remove('show');
            });
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
                    //backgroundColor: 'rgba(67, 97, 238, 0.7)',
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
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value) {
                            return value + '%';
                        },
                        color: '#343a40',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
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
                        '#f6c23e',
                        '#36b9cc',
                        '#7209b7',
                        '#3a0ca3',
                        '#560bad'
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
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const value = data.datasets[0].data[i];
                                        const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);

                                        return {
                                            text: label + ': ' + value + ' (' + percentage + '%)',
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return percentage + '%';
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 11
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Performance Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($submissionDates) ?>,
                datasets: [{
                    label: 'Performance Score',
                    data: <?= json_encode($performanceTrend) ?>,
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderColor: '#2897B9FF',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: 'rgb(67, 97, 238)',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        min: Math.max(0, Math.min(...<?= json_encode($performanceTrend) ?>) - 10),
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
                    },
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: 60,
                                yMax: 60,
                                borderColor: 'rgb(255, 193, 7)',
                                borderWidth: 2,
                                borderDash: [5, 5],
                                label: {
                                    display: true,
                                    content: 'Meets Expectations Threshold',
                                    position: 'end'
                                }
                            }
                        }
                    }
                }
            }
        });

        // Filter functionality
        document.getElementById('applyFilters').addEventListener('click', function() {
            const perspectiveFilter = document.getElementById('perspectiveFilter').value;
            const performanceFilter = document.getElementById('performanceFilter').value;
            const dateFilter = document.getElementById('dateFilter').value;

            // This would typically make an AJAX request to filter data
            // For now, we'll just show a notification
            Swal.fire({
                icon: 'info',
                title: 'This feature is under development! | Filters Applied |',
                text: `Perspective: ${perspectiveFilter}, Performance: ${performanceFilter}, Date Range: ${dateFilter}`,
                confirmButtonColor: '#00F7FFFF',
                timer: 2000
            });
        });

        document.getElementById('resetFilters').addEventListener('click', function() {
            document.getElementById('perspectiveFilter').value = 'all';
            document.getElementById('performanceFilter').value = 'all';
            document.getElementById('dateFilter').value = 'all';

            Swal.fire({
                icon: 'success',
                title: 'Filters Reset',
                confirmButtonColor: '#00FFD0FF',
                timer: 1500
            });
        });
    </script>
</body>

</html>