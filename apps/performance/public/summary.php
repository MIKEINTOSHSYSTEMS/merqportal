<?php

// Increase PHP limits for Excel generation
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300); // 5 minutes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Add this to help with memory management
gc_enable();

// Temporarily disable platform check
//putenv('COMPOSER_PLATFORM_CHECK=0');

// summary.php - Comprehensive performance evaluation summary with CEO feedback and responses
require_once '../includes/config.php';
require_once '../includes/auth_check.php';
require_once '../includes/EmailTemplates.php';
//require_once '../includes/header.php';

// Load PHPSpreadsheet classes
//require_once '../vendor/autoload.php'; // Using Standalone if it's installed here, but we will use Timesheet's autoload to avoid conflicts to install use composer require PhpOffice/PhpSpreadsheet in the root of the performance director and then use that autoload here
require_once '../../ts/vendor/autoload.php'; // Using Timesheet's already installed PHPSpreadsheet to avoid conflicts and ensure compatibility

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Check if user has permission to access this summary
//if (!hasPermission($_SESSION['user_id'], 'admin_dashboard')) {
//    header('Location: dashboard.php?error=access_denied');
//    exit;
//}

// Get all employees
$employees = getEmployeesFromDatabase();

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Get all CEO feedback for all employees
$allCEOFeedback = [];
$allFeedbackResponses = [];
foreach ($employees as $employeeId => $employee) {
    $ceoFeedback = getCEOFeedback($employeeId, false); // Get published feedback
    $allCEOFeedback[$employeeId] = $ceoFeedback;

    // Get responses for each feedback
    foreach ($ceoFeedback as $feedback) {
        $responses = getFeedbackResponses($feedback['id']);
        $allFeedbackResponses[$feedback['id']] = $responses;
    }
}

// Handle filters
$selectedDepartment = $_GET['department'] ?? '';
$selectedPosition = $_GET['position'] ?? '';
$selectedSupervisor = $_GET['supervisor'] ?? '';
$performanceCategory = $_GET['performance_category'] ?? '';
$hasCEOFeedback = $_GET['has_ceo_feedback'] ?? '';
$searchTerm = $_GET['search'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

// Prepare filter data
$departments = [];
$positions = [];
$supervisors = [];

foreach ($employees as $employee) {
    if (!empty($employee['department_name'])) {
        $departments[$employee['department_name']] = $employee['department_name'];
    }
    if (!empty($employee['position_title'])) {
        $positions[$employee['position_title']] = $employee['position_title'];
    }
    if (!empty($employee['supervisor_name'])) {
        $supervisors[$employee['supervisor_name']] = $employee['supervisor_name'];
    }
}

// Sort the filter arrays alphabetically for better UX
asort($departments);
asort($positions);
asort($supervisors);

// Filter employees based on criteria
$filteredEmployees = [];
foreach ($employees as $employeeId => $employee) {
    // Apply department filter
    if (!empty($selectedDepartment) && $employee['department_name'] !== $selectedDepartment) {
        continue;
    }

    // Apply position filter
    if (!empty($selectedPosition) && $employee['position_title'] !== $selectedPosition) {
        continue;
    }

    // Apply supervisor filter
    if (!empty($selectedSupervisor) && $employee['supervisor_name'] !== $selectedSupervisor) {
        continue;
    }

    // Apply performance category filter
    if (!empty($performanceCategory)) {
        if (!isset($employeeEvaluations[$employeeId])) {
            continue;
        }
        if ($employeeEvaluations[$employeeId]['performance_category'] !== $performanceCategory) {
            continue;
        }
    }

    // Apply CEO feedback filter
    if (!empty($hasCEOFeedback)) {
        $hasFeedback = !empty($allCEOFeedback[$employeeId]) && count($allCEOFeedback[$employeeId]) > 0;
        if ($hasCEOFeedback === 'yes' && !$hasFeedback) {
            continue;
        }
        if ($hasCEOFeedback === 'no' && $hasFeedback) {
            continue;
        }
    }

    // Apply search filter - FIXED: Handle null values
    if (!empty($searchTerm)) {
        $searchFound = false;
        $searchFields = [
            $employee['full_name'] ?? '',
            $employee['position_title'] ?? '',
            $employee['department_name'] ?? '',
            $employee['email'] ?? '',
            $employee['supervisor_name'] ?? ''
        ];

        foreach ($searchFields as $field) {
            if (stripos($field, $searchTerm) !== false) {
                $searchFound = true;
                break;
            }
        }

        if (!$searchFound) {
            continue;
        }
    }

    $filteredEmployees[$employeeId] = $employee;
}

// Prepare data for export if requested
if (isset($_GET['export']) && $_GET['export'] === 'excel') {
    exportToExcel($filteredEmployees, $employeeEvaluations, $allCEOFeedback, $allFeedbackResponses);
    exit;
}

require_once '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Evaluation Summary Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #07c9e9;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .summary-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 50px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            margin-bottom: 2rem;
        }

        .filter-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
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

        .summary-table-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .performance-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
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

        .bg-not-rated {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
        }

        .priority-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .btn-export {
            background: linear-gradient(135deg, #198754 0%, #136b3f 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(25, 135, 84, 0.2);
        }

        .dataTables_wrapper {
            margin-top: 1rem;
        }

        table.dataTable {
            border-collapse: collapse !important;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        table.dataTable thead th {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            padding: 1rem;
        }

        table.dataTable tbody tr {
            transition: background-color 0.2s ease;
        }

        table.dataTable tbody tr:hover {
            background-color: #f8f9fa;
        }

        table.dataTable tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .feedback-details {
            max-width: 300px;
            white-space: normal;
        }

        .employee-info {
            display: flex;
            align-items: center;
        }

        .employee-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .summary-header {
                padding: 1.5rem 0;
            }

            .stats-number {
                font-size: 1.8rem;
            }

            table.dataTable thead {
                display: none;
            }

            table.dataTable tbody td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table.dataTable tbody td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: calc(50% - 20px);
                padding-right: 10px;
                text-align: left;
                font-weight: bold;
                color: var(--primary-color);
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="summary-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-clipboard-list me-3"></i>Summary Report
                    </h1>
                    <p class="lead mb-0">
                        Comprehensive overview of all employee performance evaluations with CEO feedback and responses
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="admin_dashboard.php" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number"><?= count($filteredEmployees) ?></div>
                    <div class="stats-label">Total Employees</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <?php
                    $totalEvaluations = 0;
                    foreach ($filteredEmployees as $employeeId => $employee) {
                        if (isset($employeeEvaluations[$employeeId])) {
                            $totalEvaluations += array_sum($employeeEvaluations[$employeeId]['perspective_counts']);
                        }
                    }
                    ?>
                    <div class="stats-number"><?= $totalEvaluations ?></div>
                    <div class="stats-label">Total Evaluations</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <?php
                    $employeesWithFeedback = 0;
                    foreach ($filteredEmployees as $employeeId => $employee) {
                        if (!empty($allCEOFeedback[$employeeId]) && count($allCEOFeedback[$employeeId]) > 0) {
                            $employeesWithFeedback++;
                        }
                    }
                    ?>
                    <div class="stats-number"><?= $employeesWithFeedback ?></div>
                    <div class="stats-label">Employees with CEO Feedback</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <?php
                    $totalFeedbackCount = 0;
                    foreach ($allCEOFeedback as $employeeFeedback) {
                        $totalFeedbackCount += count($employeeFeedback);
                    }
                    ?>
                    <div class="stats-number"><?= $totalFeedbackCount ?></div>
                    <div class="stats-label">Total CEO Feedback Items</div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filter-card">
            <h4 class="mb-4"><i class="fas fa-filter me-2"></i>Filter Options</h4>
            <form method="get" action="summary.php" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Department</label>
                    <select class="form-select" name="department">
                        <option value="">All Departments</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= htmlspecialchars($dept) ?>" <?= $selectedDepartment === $dept ? 'selected' : '' ?>>
                                <?= htmlspecialchars($dept) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Position</label>
                    <select class="form-select" name="position">
                        <option value="">All Positions</option>
                        <?php foreach ($positions as $pos): ?>
                            <option value="<?= htmlspecialchars($pos) ?>" <?= $selectedPosition === $pos ? 'selected' : '' ?>>
                                <?= htmlspecialchars($pos) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Supervisor</label>
                    <select class="form-select" name="supervisor">
                        <option value="">All Supervisors</option>
                        <?php foreach ($supervisors as $sup): ?>
                            <option value="<?= htmlspecialchars($sup) ?>" <?= $selectedSupervisor === $sup ? 'selected' : '' ?>>
                                <?= htmlspecialchars($sup) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Performance Category</label>
                    <select class="form-select" name="performance_category">
                        <option value="">All Categories</option>
                        <option value="Needs Significant Improvement" <?= $performanceCategory === 'Needs Significant Improvement' ? 'selected' : '' ?>>Needs Significant Improvement</option>
                        <option value="Developing" <?= $performanceCategory === 'Developing' ? 'selected' : '' ?>>Developing</option>
                        <option value="Meets Expectations" <?= $performanceCategory === 'Meets Expectations' ? 'selected' : '' ?>>Meets Expectations</option>
                        <option value="Exceeds Expectations" <?= $performanceCategory === 'Exceeds Expectations' ? 'selected' : '' ?>>Exceeds Expectations</option>
                        <option value="Outstanding" <?= $performanceCategory === 'Outstanding' ? 'selected' : '' ?>>Outstanding</option>
                        <option value="Not Rated" <?= $performanceCategory === 'Not Rated' ? 'selected' : '' ?>>Not Rated</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">CEO Feedback</label>
                    <select class="form-select" name="has_ceo_feedback">
                        <option value="">All</option>
                        <option value="yes" <?= $hasCEOFeedback === 'yes' ? 'selected' : '' ?>>Has Feedback</option>
                        <option value="no" <?= $hasCEOFeedback === 'no' ? 'selected' : '' ?>>No Feedback</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Search Employee</label>
                    <input type="text" class="form-control" name="search" value="<?= htmlspecialchars($searchTerm) ?>"
                        placeholder="Name, email, position...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" value="<?= htmlspecialchars($startDate) ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" value="<?= htmlspecialchars($endDate) ?>">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="d-grid gap-2 w-100">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Apply Filters
                        </button>
                        <a href="summary.php" class="btn btn-outline-secondary">Reset Filters</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Export Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">
                <i class="fas fa-table me-2"></i>Summary Report
                <small class="text-muted ms-2">(<?= count($filteredEmployees) ?> employees)</small>
            </h4>
            <a href="summary.php?export=excel&<?= http_build_query($_GET) ?>" class="btn-export">
                <i class="fas fa-file-excel me-2"></i>Generate Report & Export To Excel
            </a>
        </div>

        <!-- Summary Table -->
        <div class="summary-table-container">
            <table id="summaryTable" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Employee Details</th>
                        <th>Performance Score</th>
                        <th>Evaluations</th>
                        <th>CEO Feedback</th>
                        <th>Feedback Responses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($filteredEmployees)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-search fa-2x mb-3"></i>
                                    <h5>No employees found</h5>
                                    <p>Try adjusting your filters or search criteria</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($filteredEmployees as $employeeId => $employee): ?>
                            <?php
                            $evaluationData = isset($employeeEvaluations[$employeeId]) ? $employeeEvaluations[$employeeId] : null;
                            $ceoFeedback = isset($allCEOFeedback[$employeeId]) ? $allCEOFeedback[$employeeId] : [];
                            $totalResponses = 0;

                            // Calculate total responses for this employee
                            foreach ($ceoFeedback as $feedback) {
                                if (isset($allFeedbackResponses[$feedback['id']])) {
                                    $totalResponses += count($allFeedbackResponses[$feedback['id']]);
                                }
                            }
                            ?>
                            <tr>
                                <!-- Employee Details -->
                                <td data-label="Employee Details">
                                    <div class="employee-info">
                                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($employee['full_name'] ?? 'N/A') ?>&background=007bff&color=fff&size=40"
                                            alt="<?= htmlspecialchars($employee['full_name'] ?? 'N/A') ?>"
                                            class="employee-avatar">
                                        <div>
                                            <strong><?= htmlspecialchars($employee['full_name'] ?? 'N/A') ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($employee['position_title'] ?? 'N/A') ?></small><br>
                                            <small><?= htmlspecialchars($employee['department_name'] ?? 'N/A') ?></small><br>
                                            <small>Supervisor: <?= htmlspecialchars($employee['supervisor_name'] ?? 'N/A') ?></small>
                                        </div>
                                    </div>
                                </td>

                                <!-- Performance Score -->
                                <td data-label="Performance Score">
                                    <?php if ($evaluationData): ?>
                                        <div class="mb-2">
                                            <span class="performance-badge 
                                                <?= $evaluationData['performance_category'] === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                                <?= $evaluationData['performance_category'] === 'Developing' ? 'bg-developing' : '' ?>
                                                <?= $evaluationData['performance_category'] === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                                <?= $evaluationData['performance_category'] === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                                <?= $evaluationData['performance_category'] === 'Outstanding' ? 'bg-outstanding' : '' ?>
                                                <?= $evaluationData['performance_category'] === 'Not Rated' ? 'bg-not-rated' : '' ?>">
                                                <?= htmlspecialchars($evaluationData['performance_category'] ?? 'Not Rated') ?>
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar 
                                                <?= $evaluationData['weighted_score'] < 30 ? 'bg-needs-improvement' : '' ?>
                                                <?= $evaluationData['weighted_score'] >= 30 && $evaluationData['weighted_score'] < 61 ? 'bg-developing' : '' ?>
                                                <?= $evaluationData['weighted_score'] >= 61 && $evaluationData['weighted_score'] < 76 ? 'bg-meets-expectations' : '' ?>
                                                <?= $evaluationData['weighted_score'] >= 76 && $evaluationData['weighted_score'] <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                                <?= $evaluationData['weighted_score'] > 90 ? 'bg-outstanding' : '' ?>"
                                                role="progressbar"
                                                style="width: <?= $evaluationData['weighted_score'] ?? 0 ?>%;"
                                                aria-valuenow="<?= $evaluationData['weighted_score'] ?? 0 ?>"
                                                aria-valuemin="0"
                                                aria-valuemax="100">
                                                <?= round($evaluationData['weighted_score'] ?? 0, 1) ?>%
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">No evaluation data</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Evaluations -->
                                <td data-label="Evaluations">
                                    <?php if ($evaluationData): ?>
                                        <div class="mb-2">
                                            <strong>Total: <?= array_sum($evaluationData['perspective_counts']) ?></strong>
                                        </div>
                                        <?php foreach ($evaluationData['perspective_counts'] as $perspective => $count): ?>
                                            <?php if ($count > 0): ?>
                                                <span class="badge bg-light text-dark me-1 mb-1">
                                                    <?= htmlspecialchars($perspective) ?>: <?= $count ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-muted">No evaluations</span>
                                    <?php endif; ?>
                                </td>

                                <!-- CEO Feedback -->
                                <td data-label="CEO Feedback" class="feedback-details">
                                    <?php if (!empty($ceoFeedback)): ?>
                                        <div class="mb-2">
                                            <strong>Total: <?= count($ceoFeedback) ?></strong>
                                        </div>
                                        <?php foreach ($ceoFeedback as $feedback): ?>
                                            <div class="mb-2 p-2 border rounded">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <span class="badge priority-badge bg-<?=
                                                                                            $feedback['priority'] == 'low' ? 'success' : ($feedback['priority'] == 'medium' ? 'warning' : ($feedback['priority'] == 'high' ? 'danger' : 'dark'))
                                                                                            ?>">
                                                        <?= ucfirst($feedback['priority']) ?>
                                                    </span>
                                                    <?php if (!empty($feedback['target_completion_date'])): ?>
                                                        <small class="text-muted">
                                                            <?= date('M d, Y', strtotime($feedback['target_completion_date'])) ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </div>
                                                <small class="d-block mt-1">
                                                    <?= htmlspecialchars($feedback['category_name'] ?? 'General') ?>
                                                </small>
                                                <p class="mb-1 small">
                                                    <?= nl2br(htmlspecialchars(substr($feedback['feedback_text'], 0, 100))) ?>
                                                    <?= strlen($feedback['feedback_text']) > 100 ? '...' : '' ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-muted">No CEO feedback</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Feedback Responses -->
                                <td data-label="Feedback Responses">
                                    <?php if (!empty($ceoFeedback) && $totalResponses > 0): ?>
                                        <div class="mb-2">
                                            <strong>Total Responses: <?= $totalResponses ?></strong>
                                        </div>
                                        <?php foreach ($ceoFeedback as $feedback): ?>
                                            <?php if (isset($allFeedbackResponses[$feedback['id']]) && !empty($allFeedbackResponses[$feedback['id']])): ?>
                                                <div class="mb-1 small">
                                                    <strong><?= htmlspecialchars($feedback['category_name'] ?? 'General') ?>:</strong>
                                                    <?= count($allFeedbackResponses[$feedback['id']]) ?> response(s)
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-muted">No responses</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Actions -->
                                <td data-label="Actions">
                                    <div class="btn-group-vertical" role="group">
                                        <a href="employee_report.php?employee=<?= htmlspecialchars($employeeId) ?>"
                                            class="btn btn-sm btn-info mb-1" title="View Detailed Report">
                                            <i class="fas fa-eye"></i> Report
                                        </a>

                                        <!-- Send Email Button -->
                                        <button type="button" class="btn btn-sm btn-success mb-1 send-email-btn"
                                            data-employee-id="<?= $employeeId ?>"
                                            data-employee-name="<?= htmlspecialchars($employee['full_name'] ?? 'Employee') ?>"
                                            data-employee-email="<?= htmlspecialchars($employee['email'] ?? '') ?>"
                                            title="Send performance report via email">
                                            <i class="fas fa-envelope"></i> Email
                                        </button>

                                        <?php if (!empty($ceoFeedback)): ?>
                                            <a href="feedback.php?employee=<?= htmlspecialchars($employeeId) ?>"
                                                class="btn btn-sm btn-warning mb-1" title="View CEO Feedback">
                                                <i class="fas fa-comment"></i> Feedback
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with export capabilities
            const table = $('#summaryTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,
                pageLength: 25,
                order: [
                    [0, 'asc']
                ],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                drawCallback: function() {
                    // Remove old event listeners first to prevent duplicates
                    $('.send-email-btn').off('click');
                    // Re-attach event listeners after table redraw
                    attachEmailButtonListeners();

                    // Add responsive data-label attributes for mobile
                    $('#summaryTable tbody td').each(function() {
                        var cellIndex = $(this).index();
                        var headerText = $('#summaryTable thead th').eq(cellIndex).text();
                        $(this).attr('data-label', headerText);
                    });
                }
            });

            // Export button enhancement - SIMPLIFIED VERSION
            $('.btn-export').on('click', function(e) {
                e.preventDefault();
                const exportUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Preparing Excel Export',
                    html: 'Generating Evaluation Summary Report with multiple sheets PLEASE WAIT UNTIL IT DOWNLOADS...<br><br><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 4700,
                    timerProgressBar: true,
                    willClose: () => {
                        // Simple redirect - this will trigger the download
                        window.location.href = exportUrl;
                    }
                });
            });

            // Email sending functionality
            // Track if email is being sent to prevent duplicates
            let isSendingEmail = false;

            // Attach event listeners to email buttons
            function attachEmailButtonListeners() {
                $('.send-email-btn').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Prevent multiple clicks while sending
                    if (isSendingEmail) {
                        return;
                    }

                    const employeeId = $(this).data('employee-id');
                    const employeeName = $(this).data('employee-name');
                    const employeeEmail = $(this).data('employee-email');

                    sendEmailToEmployee(employeeId, employeeName, employeeEmail, $(this));
                });
            }

            // Initial attachment
            attachEmailButtonListeners();

            // Function to send email
            function sendEmailToEmployee(employeeId, employeeName, employeeEmail, $button) {
                if (!employeeEmail) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Email Address',
                        text: `${employeeName} does not have an email address configured.`,
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                const originalText = $button.html();
                const originalClass = $button.attr('class');

                // Set sending flag and update button
                isSendingEmail = true;
                $button.html('<i class="fas fa-spinner fa-spin"></i>');
                $button.removeClass('btn-success').addClass('btn-secondary');
                $button.prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: 'sendreport.php',
                    method: 'POST',
                    data: {
                        action: 'send_single',
                        employee_id: employeeId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Email Sent!',
                                html: `Performance report has been sent to:<br><strong>${employeeName}</strong><br>${employeeEmail}`,
                                confirmButtonColor: '#3085d6',
                                timer: 3000,
                                timerProgressBar: true
                            });

                            // Update button to show success
                            $button.html('<i class="fas fa-check"></i>');
                            $button.removeClass('btn-secondary').addClass('btn-success');

                            // Reset after 3 seconds
                            setTimeout(() => {
                                $button.html(originalText);
                                $button.attr('class', originalClass);
                                $button.prop('disabled', false);
                                isSendingEmail = false;
                            }, 3000);
                        } else {
                            throw new Error(data.message || 'Failed to send email');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);

                        // Restore button
                        $button.html(originalText);
                        $button.attr('class', originalClass);
                        $button.prop('disabled', false);
                        isSendingEmail = false;

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Send Email',
                            html: `Could not send email to <strong>${employeeName}</strong>.<br>Error: ${error}`,
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            }

            // Initial data-label setup
            $('#summaryTable tbody td').each(function() {
                var cellIndex = $(this).index();
                var headerText = $('#summaryTable thead th').eq(cellIndex).text();
                $(this).attr('data-label', headerText);
            });
        });
    </script>
</body>

</html>

<?php
// Function to export data to Excel with proper multiple sheets structure using PHPSpreadsheet
function exportToExcel($employees, $employeeEvaluations, $allCEOFeedback, $allFeedbackResponses)
{
    
    // Create new Spreadsheet
    $spreadsheet = new Spreadsheet();
    
    // Set document properties
    $spreadsheet->getProperties()
        ->setCreator("MERQ Consultancy")
        ->setLastModifiedBy("MERQ Performance System")
        ->setTitle("Performance Evaluation Summary Report")
        ->setSubject("Performance Evaluation Summary")
        ->setDescription("Comprehensive performance evaluation report with CEO feedback")
        ->setKeywords("performance evaluation CEO feedback MERQ")
        ->setCategory("Performance Report");
    
    // ============================================
    // WORKSHEET 1: SUMMARY REPORT
    // ============================================
    $summarySheet = $spreadsheet->getActiveSheet();
    $summarySheet->setTitle('Summary Report');
    
    // Set default column widths
    $summarySheet->getColumnDimension('A')->setWidth(12);
    $summarySheet->getColumnDimension('B')->setWidth(25);
    $summarySheet->getColumnDimension('C')->setWidth(20);
    $summarySheet->getColumnDimension('D')->setWidth(25);
    $summarySheet->getColumnDimension('E')->setWidth(20);
    $summarySheet->getColumnDimension('F')->setWidth(15);
    $summarySheet->getColumnDimension('G')->setWidth(25);
    $summarySheet->getColumnDimension('H')->setWidth(20);
    $summarySheet->getColumnDimension('I')->setWidth(20);
    $summarySheet->getColumnDimension('J')->setWidth(20);
    $summarySheet->getColumnDimension('K')->setWidth(15);
    $summarySheet->getColumnDimension('L')->setWidth(20);
    $summarySheet->getColumnDimension('M')->setWidth(20);
    
    // Define styles - RESTORED FROM OLD VERSION
    $titleStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => '003377'],
            'size' => 16,
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    
    $subtitleStyle = [
        'font' => [
            'size' => 12,
            'color' => ['rgb' => '777777']
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
            'size' => 12,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => '20c997'] // Green from old version
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ];
    
    $subHeaderStyle = [
        'font' => [
            'bold' => true,
            'size' => 11,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => 'E0E0E0']
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ];
    
    $hyperlinkStyle = [
        'font' => [
            'color' => ['rgb' => '047FC1'],
            'underline' => Font::UNDERLINE_SINGLE,
            'bold' => true,
        ],
    ];
    
    $hintStyle = [
        'font' => [
            'bold' => true,
            'size' => 12,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => 'F2F2F2']
        ],
    ];
    
    // PERFORMANCE CATEGORY STYLES - EXACT COLORS FROM OLD VERSION
    $performanceCategoryStyles = [
        'Outstanding' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => '198754'],
                'endColor' => ['rgb' => '136b3f']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ],
        'Exceeds Expectations' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => '20c997'],
                'endColor' => ['rgb' => '19a97d']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ],
        'Meets Expectations' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => 'ffc107'],
                'endColor' => ['rgb' => 'e6ac00']
            ],
            'font' => [
                'color' => ['rgb' => '000000'],
                'bold' => true
            ]
        ],
        'Developing' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => 'fd7e14'],
                'endColor' => ['rgb' => 'e76505']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ],
        'Needs Significant Improvement' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => 'dc3545'],
                'endColor' => ['rgb' => 'c82333']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ],
        'Not Rated' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => '6c757d'],
                'endColor' => ['rgb' => '5a6268']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ]
    ];
    
    // SCORE STYLES (for weighted score column)
    $scoreStyles = [
        'Excellent' => ['fill' => ['color' => ['rgb' => 'D4EDDA']]], // Light green
        'Good' => ['fill' => ['color' => ['rgb' => 'D1ECF1']]],      // Light cyan
        'Average' => ['fill' => ['color' => ['rgb' => 'FFF3CD']]],   // Light yellow
        'Poor' => ['fill' => ['color' => ['rgb' => 'F8D7DA']]],      // Light red
        'NeedsImprovement' => ['fill' => ['color' => ['rgb' => 'F5C6CB']]], // Darker red
    ];
    
    // RESPONSE STATUS STYLES - EXACT COLORS FROM OLD VERSION
    $responseStyles = [
        'RespAll' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'D4EDDA']
            ],
            'font' => ['bold' => true]
        ],
        'RespPartial' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFF3CD']
            ]
        ],
        'RespNone' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'F8D7DA']
            ]
        ],
    ];
    
    // DEADLINE STATUS STYLES - EXACT COLORS FROM OLD VERSION
    $deadlineStyles = [
        'DeadAllInTime' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'C3E6CB']
            ],
            'font' => ['bold' => true]
        ],
        'DeadSomeLate' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFD6A5']
            ]
        ],
        'DeadOverdue' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'F5C6CB']
            ],
            'font' => ['bold' => true]
        ],
        'DeadPending' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFE8A1']
            ]
        ],
    ];
    
    // PRIORITY BADGE STYLES (for individual sheets)
    $priorityStyles = [
        'low' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '28a745'] // Green
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ],
        'medium' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'ffc107'] // Yellow
            ],
            'font' => [
                'color' => ['rgb' => '000000'],
                'bold' => true
            ]
        ],
        'high' => [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'dc3545'] // Red
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ],
        'critical' => [
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => ['rgb' => '721c24'],
                'endColor' => ['rgb' => '490c12']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true
            ]
        ]
    ];
    
    // Text wrap style
    $textWrapStyle = [
        'alignment' => [
            'wrapText' => true,
            'vertical' => Alignment::VERTICAL_TOP,
        ],
    ];

    // Current row counter
    $currentRow = 1;

    // MERQ LOGO Section - Add actual logo image
    $logoPath = __DIR__ . '/merqg.jpg'; // Adjust path if needed

    if (file_exists($logoPath)) {
        // Add logo to cells A1:C3 (3 rows high, 3 columns wide)
        $drawing = new Drawing();
        $drawing->setName('MERQ Logo');
        $drawing->setDescription('MERQ Consultancy Logo');
        $drawing->setPath($logoPath);
        $drawing->setHeight(47); // 150px height
        $drawing->setWidth(47);  // 150px width
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setWorksheet($summarySheet);

        // Merge cells for logo area (A1:C3)
        $summarySheet->mergeCells('A1:C3');

        // Title next to logo (D1:M3)
        $summarySheet->mergeCells('D1:M3');
        $summarySheet->setCellValue('D1', "MERQ CONSULTANCY PLC - PERIODIC EMPLOYEES PERFORMANCE EVALUATION SUMMARY REPORT");
        $summarySheet->getStyle('D1')->applyFromArray($titleStyle);
        $summarySheet->getStyle('D1')->getAlignment()->setWrapText(true);

        $currentRow = 4; // Start after logo area
    } else {
        // Fallback if logo doesn't exist
        $summarySheet->mergeCells('A1:D3');
        $summarySheet->setCellValue('A1', 'MERQ CONSULTANCY');
        $summarySheet->getStyle('A1')->applyFromArray($titleStyle);

        // Title
        $currentRow = 4;
        $summarySheet->mergeCells("A{$currentRow}:M{$currentRow}");
        $summarySheet->setCellValue("A{$currentRow}", 'PERIODIC EMPLOYEES PERFORMANCE EVALUATION SUMMARY REPORT');
        $summarySheet->getStyle("A{$currentRow}")->applyFromArray($titleStyle);
        $currentRow++;
    }
    
    // Date Row
    $summarySheet->mergeCells("A{$currentRow}:M{$currentRow}");
    $summarySheet->setCellValue("A{$currentRow}", 'Generated on: ' . date('F j, Y \a\t g:i A'));
    $summarySheet->getStyle("A{$currentRow}")->applyFromArray($subtitleStyle);
    
    $currentRow += 2;
    
    // Calculate summary statistics
    $totalEmployees = count($employees);
    $totalEvaluations = 0;
    $employeesWithFeedback = 0;
    $totalFeedbackCount = 0;
    $totalResponses = 0;
    
    $performanceDistribution = [
        'Outstanding' => 0,
        'Exceeds Expectations' => 0,
        'Meets Expectations' => 0,
        'Developing' => 0,
        'Needs Significant Improvement' => 0,
        'Not Rated' => 0
    ];
    
    // First pass to calculate statistics
    foreach ($employees as $employeeId => $employee) {
        if (isset($employeeEvaluations[$employeeId])) {
            $totalEvaluations += array_sum($employeeEvaluations[$employeeId]['perspective_counts']);
            $category = $employeeEvaluations[$employeeId]['performance_category'];
            if (isset($performanceDistribution[$category])) {
                $performanceDistribution[$category]++;
            }
        } else {
            $performanceDistribution['Not Rated']++;
        }
        
        if (!empty($allCEOFeedback[$employeeId])) {
            $employeesWithFeedback++;
            $totalFeedbackCount += count($allCEOFeedback[$employeeId]);
            foreach ($allCEOFeedback[$employeeId] as $feedback) {
                if (isset($allFeedbackResponses[$feedback['id']])) {
                    $totalResponses += count($allFeedbackResponses[$feedback['id']]);
                }
            }
        }
    }
    
    // Detailed Employee Performance Section
    $summarySheet->mergeCells("A{$currentRow}:M{$currentRow}");
    $summarySheet->setCellValue("A{$currentRow}", 'DETAILED EMPLOYEE PERFORMANCE SUMMARY');
    $summarySheet->getStyle("A{$currentRow}")->applyFromArray($headerStyle);
    $currentRow++;
    
    // Column headers
    $headers = [
        'A' => 'Employee ID',
        'B' => 'Full Name',
        'C' => 'Position',
        'D' => 'Department',
        'E' => 'Supervisor',
        'F' => 'Weighted Score',
        'G' => 'Performance Category',
        'H' => 'Total Evaluations',
        'I' => 'CEO Feedback Items',
        'J' => 'Feedback Responses',
        'K' => 'Response Rate',
        'L' => 'Response Status',
        'M' => 'Deadline Status'
    ];
    
    foreach ($headers as $col => $header) {
        $summarySheet->setCellValue($col . $currentRow, $header);
    }
    $summarySheet->getStyle("A{$currentRow}:M{$currentRow}")->applyFromArray($subHeaderStyle);
    $currentRow++;
    
    // Employee data rows
    foreach ($employees as $employeeId => $employee) {
        $evaluationData = isset($employeeEvaluations[$employeeId]) ? $employeeEvaluations[$employeeId] : null;
        $ceoFeedback = isset($allCEOFeedback[$employeeId]) ? $allCEOFeedback[$employeeId] : [];
        
        $totalEvals = $evaluationData ? array_sum($evaluationData['perspective_counts']) : 0;
        $feedbackCount = count($ceoFeedback);
        
        // Calculate responses
        $responseCount = 0;
        foreach ($ceoFeedback as $feedback) {
            if (isset($allFeedbackResponses[$feedback['id']])) {
                $responseCount += count($allFeedbackResponses[$feedback['id']]);
            }
        }
        
        $responseRate = $feedbackCount > 0 
            ? round(($responseCount / $feedbackCount) * 100, 0) . '%'
            : 'N/A';
        
        $responseStatus = 'No Feedback';
        $deadlineStatus = 'No Feedback';
        
        if ($feedbackCount > 0) {
            if ($responseCount == 0) {
                $responseStatus = 'No Responses';
            } elseif ($responseCount == $feedbackCount) {
                $responseStatus = 'All Responded';
            } else {
                $responseStatus = 'Partial (' . $responseCount . '/' . $feedbackCount . ')';
            }
            
            // Deadline calculation
            $allResponded = true;
            $anyOverdue = false;
            
            foreach ($ceoFeedback as $feedback) {
                $hasResponse = isset($allFeedbackResponses[$feedback['id']]) 
                    && !empty($allFeedbackResponses[$feedback['id']]);
                
                if (!$hasResponse && !empty($feedback['target_completion_date'])) {
                    $allResponded = false;
                    $targetDate = new DateTime($feedback['target_completion_date']);
                    $today = new DateTime();
                    
                    if ($today > $targetDate) {
                        $anyOverdue = true;
                    }
                } elseif ($hasResponse && !empty($feedback['target_completion_date'])) {
                    $targetDate = new DateTime($feedback['target_completion_date']);
                    $lastResponse = new DateTime($allFeedbackResponses[$feedback['id']][0]['submitted_at']);
                    
                    if ($lastResponse > $targetDate) {
                        $anyOverdue = true;
                    }
                }
            }
            
            if ($allResponded && !$anyOverdue) {
                $deadlineStatus = 'All In Time';
            } elseif ($allResponded && $anyOverdue) {
                $deadlineStatus = 'Some Late';
            } elseif (!$allResponded && $anyOverdue) {
                $deadlineStatus = 'Overdue';
            } else {
                $deadlineStatus = 'Pending';
            }
        }
        
        // Set row data
        $summarySheet->setCellValue('A' . $currentRow, $employeeId);
        
        // Employee name with sheet reference
        $sheetName = createValidSheetName($employee['full_name'] ?? 'Employee', $employeeId);
        $summarySheet->setCellValue('B' . $currentRow, $employee['full_name'] ?? 'N/A');
        $summarySheet->getCell('B' . $currentRow)->getHyperlink()->setUrl("#'{$sheetName}'!A1");
        
        $summarySheet->setCellValue('C' . $currentRow, $employee['position_title'] ?? 'N/A');
        $summarySheet->setCellValue('D' . $currentRow, $employee['department_name'] ?? 'N/A');
        $summarySheet->setCellValue('E' . $currentRow, $employee['supervisor_name'] ?? 'N/A');
        
        $score = $evaluationData ? round($evaluationData['weighted_score'], 2) : 0;
        $summarySheet->setCellValue('F' . $currentRow, $score);
        $summarySheet->getStyle('F' . $currentRow)->getNumberFormat()->setFormatCode('0.00');
        
        $performanceCategory = $evaluationData ? $evaluationData['performance_category'] : 'Not Rated';
        $summarySheet->setCellValue('G' . $currentRow, $performanceCategory);
        
        $summarySheet->setCellValue('H' . $currentRow, $totalEvals);
        $summarySheet->setCellValue('I' . $currentRow, $feedbackCount);
        $summarySheet->setCellValue('J' . $currentRow, $responseCount);
        $summarySheet->setCellValue('K' . $currentRow, $responseRate);
        $summarySheet->setCellValue('L' . $currentRow, $responseStatus);
        $summarySheet->setCellValue('M' . $currentRow, $deadlineStatus);
        
        // Apply hyperlink style to name
        $summarySheet->getStyle('B' . $currentRow)->applyFromArray($hyperlinkStyle);
        
        // Apply score style (background color based on score)
        if ($evaluationData) {
            $score = $evaluationData['weighted_score'];
            if ($score >= 90) {
                $summarySheet->getStyle('F' . $currentRow)->applyFromArray($scoreStyles['Excellent']);
            } elseif ($score >= 75) {
                $summarySheet->getStyle('F' . $currentRow)->applyFromArray($scoreStyles['Good']);
            } elseif ($score >= 60) {
                $summarySheet->getStyle('F' . $currentRow)->applyFromArray($scoreStyles['Average']);
            } elseif ($score >= 30) {
                $summarySheet->getStyle('F' . $currentRow)->applyFromArray($scoreStyles['Poor']);
            } elseif ($score > 0) {
                $summarySheet->getStyle('F' . $currentRow)->applyFromArray($scoreStyles['NeedsImprovement']);
            }
        }
        
        // Apply PERFORMANCE CATEGORY style with gradient
        if (isset($performanceCategoryStyles[$performanceCategory])) {
            $summarySheet->getStyle('G' . $currentRow)->applyFromArray($performanceCategoryStyles[$performanceCategory]);
        }
        
        // Apply response status style
        if ($responseStatus === 'All Responded') {
            $summarySheet->getStyle('L' . $currentRow)->applyFromArray($responseStyles['RespAll']);
        } elseif ($responseStatus === 'No Responses' || $responseStatus === 'No Feedback') {
            $summarySheet->getStyle('L' . $currentRow)->applyFromArray($responseStyles['RespNone']);
        } else {
            $summarySheet->getStyle('L' . $currentRow)->applyFromArray($responseStyles['RespPartial']);
        }
        
        // Apply deadline status style
        if ($deadlineStatus === 'All In Time') {
            $summarySheet->getStyle('M' . $currentRow)->applyFromArray($deadlineStyles['DeadAllInTime']);
        } elseif ($deadlineStatus === 'Overdue') {
            $summarySheet->getStyle('M' . $currentRow)->applyFromArray($deadlineStyles['DeadOverdue']);
        } elseif ($deadlineStatus === 'Some Late') {
            $summarySheet->getStyle('M' . $currentRow)->applyFromArray($deadlineStyles['DeadSomeLate']);
        } elseif ($deadlineStatus === 'Pending') {
            $summarySheet->getStyle('M' . $currentRow)->applyFromArray($deadlineStyles['DeadPending']);
        }
        
        // Add thin borders to all cells in this row
        $summarySheet->getStyle("A{$currentRow}:M{$currentRow}")->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD'],
                ],
            ],
        ]);
        
        $currentRow++;
    }
    
    $currentRow += 2;
    
    // Hint section
    $summarySheet->setCellValue('B' . $currentRow, 'HINT:');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($hintStyle);
    $currentRow++;
    
    $summarySheet->setCellValue('B' . $currentRow, 'Click on the Names to go to Individual Employee Sheets');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($hintStyle);
    $currentRow++;
    
    $summarySheet->setCellValue('B' . $currentRow, 'Click on Back to Summary to return to main summary');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($hintStyle);
    
    $currentRow += 2;
    
    // Performance Distribution
    $summarySheet->mergeCells("A{$currentRow}:C{$currentRow}");
    $summarySheet->setCellValue("A{$currentRow}", 'PERFORMANCE DISTRIBUTION');
    $summarySheet->getStyle("A{$currentRow}")->applyFromArray($headerStyle);
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Performance Category');
    $summarySheet->setCellValue('B' . $currentRow, 'Employee Count');
    $summarySheet->setCellValue('C' . $currentRow, 'Percentage');
    $summarySheet->getStyle("A{$currentRow}:C{$currentRow}")->applyFromArray($subHeaderStyle);
    $currentRow++;
    
    foreach ($performanceDistribution as $category => $count) {
        $percentage = $totalEmployees > 0 ? round(($count / $totalEmployees) * 100, 1) : 0;
        $summarySheet->setCellValue('A' . $currentRow, $category);
        $summarySheet->setCellValue('B' . $currentRow, $count);
        $summarySheet->setCellValue('C' . $currentRow, $percentage);
        
        // Apply the same performance category styles
        if (isset($performanceCategoryStyles[$category])) {
            $summarySheet->getStyle('A' . $currentRow)->applyFromArray($performanceCategoryStyles[$category]);
        }
        
        $currentRow++;
    }
    
    $currentRow += 2;
    
    // Summary Statistics
    $summarySheet->mergeCells("A{$currentRow}:D{$currentRow}");
    $summarySheet->setCellValue("A{$currentRow}", 'SUMMARY STATISTICS');
    $summarySheet->getStyle("A{$currentRow}")->applyFromArray($headerStyle);
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Metric');
    $summarySheet->setCellValue('B' . $currentRow, 'Count');
    $summarySheet->setCellValue('C' . $currentRow, 'Metric');
    $summarySheet->setCellValue('D' . $currentRow, 'Value');
    $summarySheet->getStyle("A{$currentRow}:D{$currentRow}")->applyFromArray($subHeaderStyle);
    $currentRow++;
    
    $averageScore = 0;
    $scoreCount = 0;
    foreach ($employees as $employeeId => $employee) {
        if (isset($employeeEvaluations[$employeeId])) {
            $averageScore += $employeeEvaluations[$employeeId]['weighted_score'];
            $scoreCount++;
        }
    }
    $averageScore = $scoreCount > 0 ? round($averageScore / $scoreCount, 2) : 0;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Total Employees');
    $summarySheet->setCellValue('B' . $currentRow, $totalEmployees);
    $summarySheet->setCellValue('C' . $currentRow, 'Average Performance Score');
    $summarySheet->setCellValue('D' . $currentRow, $averageScore);
    $summarySheet->getStyle('D' . $currentRow)->getNumberFormat()->setFormatCode('0.00');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Total Evaluations');
    $summarySheet->setCellValue('B' . $currentRow, $totalEvaluations);
    $summarySheet->setCellValue('C' . $currentRow, 'Employees with CEO Feedback');
    $employeesWithFeedbackPct = round(($employeesWithFeedback / max(1, $totalEmployees)) * 100, 1);
    $summarySheet->setCellValue('D' . $currentRow, $employeesWithFeedback . ' (' . $employeesWithFeedbackPct . '%)');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Total CEO Feedback Items');
    $summarySheet->setCellValue('B' . $currentRow, $totalFeedbackCount);
    $summarySheet->setCellValue('C' . $currentRow, 'Total Feedback Responses');
    $summarySheet->setCellValue('D' . $currentRow, $totalResponses);
    
    $currentRow += 3;
    
    // Legend Section
    $summarySheet->mergeCells("A{$currentRow}:D{$currentRow}");
    $summarySheet->setCellValue("A{$currentRow}", 'STATUS COLOR LEGEND');
    $summarySheet->getStyle("A{$currentRow}")->applyFromArray($headerStyle);
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Type');
    $summarySheet->setCellValue('B' . $currentRow, 'Status');
    $summarySheet->setCellValue('C' . $currentRow, 'Meaning');
    $summarySheet->setCellValue('D' . $currentRow, 'Color');
    $summarySheet->getStyle("A{$currentRow}:D{$currentRow}")->applyFromArray($subHeaderStyle);
    $currentRow++;
    
    // Response status legend
    $summarySheet->setCellValue('A' . $currentRow, 'Response Status');
    $summarySheet->setCellValue('B' . $currentRow, 'All Responded');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($responseStyles['RespAll']);
    $summarySheet->setCellValue('C' . $currentRow, 'Employee responded to all CEO feedback items');
    $summarySheet->setCellValue('D' . $currentRow, 'Green');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Response Status');
    $summarySheet->setCellValue('B' . $currentRow, 'Partial');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($responseStyles['RespPartial']);
    $summarySheet->setCellValue('C' . $currentRow, 'Some feedback items have responses');
    $summarySheet->setCellValue('D' . $currentRow, 'Yellow');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Response Status');
    $summarySheet->setCellValue('B' . $currentRow, 'No Responses / No Feedback');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($responseStyles['RespNone']);
    $summarySheet->setCellValue('C' . $currentRow, 'No response submitted yet or no feedback assigned');
    $summarySheet->setCellValue('D' . $currentRow, 'Red');
    $currentRow++;
    
    // Deadline status legend
    $summarySheet->setCellValue('A' . $currentRow, 'Deadline Status');
    $summarySheet->setCellValue('B' . $currentRow, 'All In Time');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($deadlineStyles['DeadAllInTime']);
    $summarySheet->setCellValue('C' . $currentRow, 'All feedback items were responded to before the deadline');
    $summarySheet->setCellValue('D' . $currentRow, 'Green');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Deadline Status');
    $summarySheet->setCellValue('B' . $currentRow, 'Some Late');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($deadlineStyles['DeadSomeLate']);
    $summarySheet->setCellValue('C' . $currentRow, 'Some feedback responses were submitted after the deadline');
    $summarySheet->setCellValue('D' . $currentRow, 'Orange');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Deadline Status');
    $summarySheet->setCellValue('B' . $currentRow, 'Overdue');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($deadlineStyles['DeadOverdue']);
    $summarySheet->setCellValue('C' . $currentRow, 'At least one feedback item is overdue without a response');
    $summarySheet->setCellValue('D' . $currentRow, 'Red');
    $currentRow++;
    
    $summarySheet->setCellValue('A' . $currentRow, 'Deadline Status');
    $summarySheet->setCellValue('B' . $currentRow, 'Pending');
    $summarySheet->getStyle('B' . $currentRow)->applyFromArray($deadlineStyles['DeadPending']);
    $summarySheet->setCellValue('C' . $currentRow, 'Responses are still within the allowed deadline');
    $summarySheet->setCellValue('D' . $currentRow, 'Yellow');
    
    // ============================================
    // INDIVIDUAL EMPLOYEE SHEETS
    // ============================================
    $sheetCount = 0;
    foreach ($employees as $employeeId => $employee) {
        $sheetCount++;
        if ($sheetCount > 50) break; // Limit to 50 sheets for performance
        
        $evaluationData = isset($employeeEvaluations[$employeeId]) ? $employeeEvaluations[$employeeId] : null;
        $ceoFeedback = isset($allCEOFeedback[$employeeId]) ? $allCEOFeedback[$employeeId] : [];
        $sheetName = createValidSheetName($employee['full_name'] ?? 'Employee', $employeeId);
        
        // Create new worksheet
        $employeeSheet = $spreadsheet->createSheet();
        $employeeSheet->setTitle($sheetName);
        
        // Set column widths
        $employeeSheet->getColumnDimension('A')->setWidth(25);
        $employeeSheet->getColumnDimension('B')->setWidth(40);
        $employeeSheet->getColumnDimension('C')->setWidth(25);
        $employeeSheet->getColumnDimension('D')->setWidth(40);
        
        $currentEmployeeRow = 1;
        
        // Back to summary link
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", '⬅ Back to Summary Report');
        $employeeSheet->getCell("A{$currentEmployeeRow}")->getHyperlink()->setUrl("#'Summary Report'!A1");
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($hyperlinkStyle);
        $currentEmployeeRow += 2;

        // MERQ Logo
        $logoPath = __DIR__ . '/merqg.jpg';

        if (file_exists($logoPath)) {
            // Add logo to cells A1:C3
            $drawing = new Drawing();
            $drawing->setName('MERQ Logo');
            $drawing->setDescription('MERQ Consultancy Logo');
            $drawing->setPath($logoPath);
            $drawing->setHeight(47);
            $drawing->setWidth(47);
            $drawing->setCoordinates('A' . $currentEmployeeRow);
            $drawing->setOffsetX(10);
            $drawing->setOffsetY(10);
            $drawing->setWorksheet($employeeSheet);

            // TEST OF Title above logo 
          //  $employeeSheet->mergeCells("B{$currentEmployeeRow}:C{$currentEmployeeRow}");
          //  $employeeSheet->setCellValue("B{$currentEmployeeRow}", 'MERQ CONSULTANCY');
          //  $employeeSheet->getStyle("B{$currentEmployeeRow}")->applyFromArray($titleStyle);
          //  $currentEmployeeRow++;
            // END OF IT

            // Merge cells for logo area
            $employeeSheet->mergeCells("A{$currentEmployeeRow}:C" . ($currentEmployeeRow + 2));

            // Title next to logo
            $employeeSheet->mergeCells("D{$currentEmployeeRow}:D" . ($currentEmployeeRow + 2));
            $employeeSheet->setCellValue("D{$currentEmployeeRow}", 'INDIVIDUAL PERFORMANCE REPORT');
            $employeeSheet->getStyle("D{$currentEmployeeRow}")->applyFromArray($titleStyle);
            $employeeSheet->getStyle("D{$currentEmployeeRow}")->getAlignment()
                ->setWrapText(true)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $currentEmployeeRow += 3;
        } else {
            // Fallback if logo doesn't exist
            $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
            $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'MERQ CONSULTANCY');
            $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($titleStyle);
            $currentEmployeeRow++;
        }
        
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", htmlspecialchars($employee['full_name'] ?? 'Employee'));
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($titleStyle);
        $currentEmployeeRow++;
        
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'Employee ID: ' . $employeeId . ' | Generated: ' . date('F j, Y'));
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($subtitleStyle);
        $currentEmployeeRow += 2;
        
        // Employee Information
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'EMPLOYEE INFORMATION');
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($headerStyle);
        $currentEmployeeRow++;
        
        $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Full Name:');
        $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
        $employeeSheet->setCellValue('B' . $currentEmployeeRow, htmlspecialchars($employee['full_name'] ?? 'N/A'));
        $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Position:');
        $employeeSheet->getStyle('C' . $currentEmployeeRow)->getFont()->setBold(true);
        $employeeSheet->setCellValue('D' . $currentEmployeeRow, htmlspecialchars($employee['position_title'] ?? 'N/A'));
        $currentEmployeeRow++;
        
        $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Department:');
        $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
        $employeeSheet->setCellValue('B' . $currentEmployeeRow, htmlspecialchars($employee['department_name'] ?? 'N/A'));
        $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Supervisor:');
        $employeeSheet->getStyle('C' . $currentEmployeeRow)->getFont()->setBold(true);
        $employeeSheet->setCellValue('D' . $currentEmployeeRow, htmlspecialchars($employee['supervisor_name'] ?? 'N/A'));
        $currentEmployeeRow++;
        
        $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Employee ID:');
        $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
        $employeeSheet->setCellValue('B' . $currentEmployeeRow, $employeeId);
        $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Email:');
        $employeeSheet->getStyle('C' . $currentEmployeeRow)->getFont()->setBold(true);
        $employeeSheet->setCellValue('D' . $currentEmployeeRow, htmlspecialchars($employee['email'] ?? 'N/A'));
        $currentEmployeeRow += 2;
        
        // Performance Overview
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'PERFORMANCE OVERVIEW');
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($headerStyle);
        $currentEmployeeRow++;
        
        if ($evaluationData) {
            $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Overall Weighted Score:');
            $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
            
            $score = $evaluationData['weighted_score'];
            $employeeSheet->setCellValue('B' . $currentEmployeeRow, round($score, 2));
            $employeeSheet->getStyle('B' . $currentEmployeeRow)->getNumberFormat()->setFormatCode('0.00');
            
            // Apply score style
            if ($score >= 90) {
                $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($scoreStyles['Excellent']);
            } elseif ($score >= 75) {
                $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($scoreStyles['Good']);
            } elseif ($score >= 60) {
                $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($scoreStyles['Average']);
            } elseif ($score >= 30) {
                $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($scoreStyles['Poor']);
            } elseif ($score > 0) {
                $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($scoreStyles['NeedsImprovement']);
            }
            
            $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Performance Category:');
            $employeeSheet->getStyle('C' . $currentEmployeeRow)->getFont()->setBold(true);
            
            $performanceCategory = $evaluationData['performance_category'];
            $employeeSheet->setCellValue('D' . $currentEmployeeRow, $performanceCategory);
            
            // Apply performance category style with gradient
            if (isset($performanceCategoryStyles[$performanceCategory])) {
                $employeeSheet->getStyle('D' . $currentEmployeeRow)->applyFromArray($performanceCategoryStyles[$performanceCategory]);
            }
            
            $currentEmployeeRow++;
            
            $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Total Evaluations:');
            $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
            $employeeSheet->setCellValue('B' . $currentEmployeeRow, array_sum($evaluationData['perspective_counts']));
            $currentEmployeeRow += 2;
            
            // Evaluation Perspectives
            if (!empty($evaluationData['perspective_counts'])) {
                $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
                $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'EVALUATION PERSPECTIVES');
                $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($headerStyle);
                $currentEmployeeRow++;
                
                foreach ($evaluationData['perspective_counts'] as $perspective => $count) {
                    if ($count > 0) {
                        $employeeSheet->setCellValue('A' . $currentEmployeeRow, $perspective . ':');
                        $employeeSheet->setCellValue('B' . $currentEmployeeRow, $count);
                        $currentEmployeeRow++;
                    }
                }
                $currentEmployeeRow++;
            }
            
            // Category Scores
            if (!empty($evaluationData['category_scores'])) {
                $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
                $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'CATEGORY PERFORMANCE SCORES');
                $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($headerStyle);
                $currentEmployeeRow++;
                
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Category');
                $employeeSheet->setCellValue('B' . $currentEmployeeRow, 'Average Score (1-5)');
                $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Percentage');
                $employeeSheet->getStyle("A{$currentEmployeeRow}:C{$currentEmployeeRow}")->applyFromArray($subHeaderStyle);
                $currentEmployeeRow++;
                
                foreach ($evaluationData['category_scores'] as $category => $scoreData) {
                    if (($scoreData['count'] ?? 0) > 0) {
                        $average = round($scoreData['average'] ?? 0, 2);
                        $percentage = round($scoreData['percentage'] ?? 0, 1);
                        
                        $employeeSheet->setCellValue('A' . $currentEmployeeRow, htmlspecialchars($category));
                        $employeeSheet->setCellValue('B' . $currentEmployeeRow, $average);
                        $employeeSheet->getStyle('B' . $currentEmployeeRow)->getNumberFormat()->setFormatCode('0.00');
                        $employeeSheet->setCellValue('C' . $currentEmployeeRow, $percentage);
                        $employeeSheet->getStyle('C' . $currentEmployeeRow)->getNumberFormat()->setFormatCode('0.0');
                        $currentEmployeeRow++;
                    }
                }
                $currentEmployeeRow++;
            }
        } else {
            $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
            $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'No performance evaluation data available for this employee.');
            $currentEmployeeRow += 2;
        }
        
        // CEO Feedback Section
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'CEO FEEDBACK');
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($headerStyle);
        $currentEmployeeRow++;
        
        if (!empty($ceoFeedback)) {
            $totalResponses = 0;
            foreach ($ceoFeedback as $feedback) {
                if (isset($allFeedbackResponses[$feedback['id']])) {
                    $totalResponses += count($allFeedbackResponses[$feedback['id']]);
                }
            }
            
            $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
            $employeeSheet->setCellValue("A{$currentEmployeeRow}", count($ceoFeedback) . ' Feedback Items, ' . $totalResponses . ' Responses');
            $currentEmployeeRow++;
            
            foreach ($ceoFeedback as $index => $feedback) {
                $responses = isset($allFeedbackResponses[$feedback['id']]) ? $allFeedbackResponses[$feedback['id']] : [];
                
                $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
                $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'Feedback #' . ($index + 1) . ' - ' . ($feedback['category_name'] ?? 'General Feedback'));
                
                // Add priority badge
                $priority = strtolower($feedback['priority'] ?? 'medium');
                $priorityStyle = $priorityStyles[$priority] ?? $priorityStyles['medium'];
                $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($priorityStyle);
                $employeeSheet->getStyle("A{$currentEmployeeRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $currentEmployeeRow++;
                
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'From CEO:');
                $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
                $employeeSheet->setCellValue('B' . $currentEmployeeRow, $feedback['ceo_name']);
                $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Date Given:');
                $employeeSheet->getStyle('C' . $currentEmployeeRow)->getFont()->setBold(true);
                $employeeSheet->setCellValue('D' . $currentEmployeeRow, date('F j, Y \a\t g:i A', strtotime($feedback['created_at'])));
                $currentEmployeeRow++;
                
                if (!empty($feedback['target_completion_date'])) {
                    $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Target Completion:');
                    $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
                    $employeeSheet->setCellValue('B' . $currentEmployeeRow, date('F j, Y', strtotime($feedback['target_completion_date'])));
                    $employeeSheet->setCellValue('C' . $currentEmployeeRow, 'Status:');
                    $employeeSheet->getStyle('C' . $currentEmployeeRow)->getFont()->setBold(true);
                    
                    $statusText = '';
                    $today = new DateTime();
                    $targetDate = new DateTime($feedback['target_completion_date']);
                    
                    if (!empty($responses)) {
                        $lastResponse = new DateTime($responses[0]['submitted_at']);
                        if ($lastResponse <= $targetDate) {
                            $statusText = 'Responded In Time';
                        } else {
                            $daysLate = $lastResponse->diff($targetDate)->days;
                            $statusText = 'Responded Late by ' . $daysLate . ' days';
                        }
                    } else {
                        if ($today > $targetDate) {
                            $daysOverdue = $today->diff($targetDate)->days;
                            $statusText = 'Overdue by ' . $daysOverdue . ' days';
                        } else {
                            $daysRemaining = $targetDate->diff($today)->days;
                            $statusText = $daysRemaining . ' days remaining';
                        }
                    }
                    
                    $employeeSheet->setCellValue('D' . $currentEmployeeRow, $statusText);
                    
                    // Apply status style
                    if (strpos($statusText, 'Responded In Time') !== false) {
                        $employeeSheet->getStyle('D' . $currentEmployeeRow)->applyFromArray($deadlineStyles['DeadAllInTime']);
                    } elseif (strpos($statusText, 'Responded Late') !== false) {
                        $employeeSheet->getStyle('D' . $currentEmployeeRow)->applyFromArray($deadlineStyles['DeadSomeLate']);
                    } elseif (strpos($statusText, 'Overdue') !== false) {
                        $employeeSheet->getStyle('D' . $currentEmployeeRow)->applyFromArray($deadlineStyles['DeadOverdue']);
                    } elseif (strpos($statusText, 'days remaining') !== false) {
                        $employeeSheet->getStyle('D' . $currentEmployeeRow)->applyFromArray($deadlineStyles['DeadPending']);
                    }
                    
                    $currentEmployeeRow++;
                }
                
                // Feedback text with text wrap
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Feedback:');
                $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
                $employeeSheet->mergeCells("B{$currentEmployeeRow}:D{$currentEmployeeRow}");
                $employeeSheet->setCellValue('B' . $currentEmployeeRow, htmlspecialchars($feedback['feedback_text']));
                $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($textWrapStyle);
                
                // Adjust row height for feedback text
                $feedbackText = $feedback['feedback_text'];
                $lineCount = ceil(strlen($feedbackText) / 100); // Approximate lines based on 100 chars per line
                $rowHeight = max(30, $lineCount * 30); // Minimum 30, 30 per line but adjust as needed
                $employeeSheet->getRowDimension($currentEmployeeRow)->setRowHeight($rowHeight);
                
                $currentEmployeeRow++;
                
                // Responses
                if (!empty($responses)) {
                    $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Responses (' . count($responses) . '):');
                    $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
                    $currentEmployeeRow++;
                    
                    foreach ($responses as $responseIndex => $response) {
                        $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Response #' . ($responseIndex + 1) . ':');
                        $employeeSheet->mergeCells("B{$currentEmployeeRow}:D{$currentEmployeeRow}");
                        $employeeSheet->setCellValue('B' . $currentEmployeeRow, htmlspecialchars($response['response_text']));
                        $employeeSheet->getStyle('B' . $currentEmployeeRow)->applyFromArray($textWrapStyle);
                        
                        // Adjust row height for response text
                        $responseText = $response['response_text'];
                        $lineCount = ceil(strlen($responseText) / 100);
                        $rowHeight = max(30, $lineCount * 30);
                        $employeeSheet->getRowDimension($currentEmployeeRow)->setRowHeight($rowHeight);
                        
                        $currentEmployeeRow++;
                        
                        $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Submitted:');
                        $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
                        $employeeSheet->mergeCells("B{$currentEmployeeRow}:D{$currentEmployeeRow}");
                        $employeeSheet->setCellValue('B' . $currentEmployeeRow, date('F j, Y \a\t g:i A', strtotime($response['submitted_at'])));
                        $currentEmployeeRow++;
                    }
                } else {
                    $employeeSheet->setCellValue('A' . $currentEmployeeRow, 'Responses:');
                    $employeeSheet->getStyle('A' . $currentEmployeeRow)->getFont()->setBold(true);
                    $employeeSheet->mergeCells("B{$currentEmployeeRow}:D{$currentEmployeeRow}");
                    $employeeSheet->setCellValue('B' . $currentEmployeeRow, 'No responses yet from the employee.');
                    $currentEmployeeRow++;
                }
                
                $currentEmployeeRow++;
            }
        } else {
            $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
            $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'No CEO feedback available for this employee.');
            $currentEmployeeRow += 2;
        }
        
        // Summary and Recommendations
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'SUMMARY & RECOMMENDATIONS');
        $employeeSheet->getStyle("A{$currentEmployeeRow}")->applyFromArray($headerStyle);
        $currentEmployeeRow++;
        
        if ($evaluationData) {
            $score = $evaluationData['weighted_score'];
            $feedbackCount = count($ceoFeedback);
            $responseCount = 0;
            
            if ($feedbackCount > 0) {
                foreach ($ceoFeedback as $feedback) {
                    if (isset($allFeedbackResponses[$feedback['id']])) {
                        $responseCount += count($allFeedbackResponses[$feedback['id']]);
                    }
                }
                $responseRate = $feedbackCount > 0 
                    ? round(($responseCount / $feedbackCount) * 100, 0)
                    : 0;
            }
            
            if ($score >= 90) {
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Outstanding Performance: Demonstrates exceptional performance across all categories.');
                $currentEmployeeRow++;
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Recommendation: Consider for leadership roles, special projects, or recognition awards.');
                $currentEmployeeRow++;
            } elseif ($score >= 75) {
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Exceeds Expectations: Consistently performs above job requirements.');
                $currentEmployeeRow++;
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Recommendation: Provide opportunities for growth and increased responsibility.');
                $currentEmployeeRow++;
            } elseif ($score >= 60) {
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Meets Expectations: Meets all job requirements satisfactorily.');
                $currentEmployeeRow++;
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Recommendation: Continue current development plan, focus on specific skill enhancements.');
                $currentEmployeeRow++;
            } elseif ($score >= 30) {
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Developing: Shows potential but needs improvement in some areas.');
                $currentEmployeeRow++;
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Recommendation: Create targeted development plan with regular check-ins.');
                $currentEmployeeRow++;
            } else {
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Needs Significant Improvement: Immediate attention required for performance improvement.');
                $currentEmployeeRow++;
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Recommendation: Implement performance improvement plan with clear milestones.');
                $currentEmployeeRow++;
            }
            
            if ($feedbackCount > 0) {
                $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Feedback Engagement: ' . 
                    $responseCount . ' response(s) to ' . 
                    $feedbackCount . ' feedback item(s) (' . 
                    $responseRate . '% response rate).');
                $currentEmployeeRow++;
                
                if ($responseCount == 0) {
                    $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Action Required: Employee needs to respond to CEO feedback.');
                    $currentEmployeeRow++;
                } elseif ($responseCount < $feedbackCount) {
                    $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Action Required: Employee needs to respond to remaining feedback items.');
                    $currentEmployeeRow++;
                }
            }
        } else {
            $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• No evaluation data available.');
            $currentEmployeeRow++;
            $employeeSheet->setCellValue('A' . $currentEmployeeRow, '• Recommendation: Ensure employee completes self-evaluation and receives evaluations from others.');
            $currentEmployeeRow++;
        }
        
        $currentEmployeeRow += 2;
        
        // Footer
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'Report Generated: ' . date('F j, Y \a\t g:i A'));
        $currentEmployeeRow++;
        
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'Confidential: This report contains sensitive performance information.');
        $currentEmployeeRow++;
        
        $employeeSheet->mergeCells("A{$currentEmployeeRow}:D{$currentEmployeeRow}");
        $employeeSheet->setCellValue("A{$currentEmployeeRow}", 'System: MERQ Consultancy Performance Management System');
    }
    
    // Set the first sheet as active
    $spreadsheet->setActiveSheetIndex(0);
    
    // Generate filename
    $filename = "MERQ_Consultancy_Employees_Periodic_Evaluation_Summary_" . date('Y-m-d_His') . ".xlsx";
    
    // Clear any previous output
    while (ob_get_level()) {
        ob_end_clean();
    }
    
    // Set headers for Excel download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Create writer and output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

// Helper function to create valid Excel sheet names
function createValidSheetName($employeeName, $employeeId)
{
    if (empty($employeeName)) {
        $employeeName = 'Employee';
    }

    // Remove invalid characters
    $invalidChars = ['\\', '/', '*', '?', ':', '[', ']'];
    $sheetName = str_replace($invalidChars, '', $employeeName);

    // Normalize spaces
    $sheetName = preg_replace('/\s+/', ' ', $sheetName);
    $sheetName = trim($sheetName);

    // Always append employee id to avoid duplicates
    $sheetName = $sheetName . '_' . $employeeId;

    // Excel limit
    return substr($sheetName, 0, 31);
}
//#####################-MIKEINTOSH-SYSTEMS-##############################//