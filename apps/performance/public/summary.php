<?php
// summary.php - Comprehensive performance evaluation summary with CEO feedback and responses
require_once '../includes/config.php';
require_once '../includes/auth_check.php';
require_once '../includes/EmailTemplates.php';
//require_once '../includes/header.php';

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
                        <i class="fas fa-chart-pie me-3"></i>Performance Evaluation Summary Report
                    </h1>
                    <p class="lead mb-0">
                        Comprehensive overview of all employee evaluations with CEO feedback and responses
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
                <i class="fas fa-file-excel me-2"></i>Export to Excel
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

    <script>
        $(document).ready(function() {
            // Initialize DataTable with export capabilities
            /*

                        $('#summaryTable').DataTable({
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
                            }
                        });
            */
            // Add responsive data-label attributes for mobile
            $('#summaryTable tbody td').each(function() {
                var cellIndex = $(this).index();
                var headerText = $('#summaryTable thead th').eq(cellIndex).text();
                $(this).attr('data-label', headerText);
            });
        });
    </script>
    <script>
        // Email sending functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Track if email is being sent to prevent duplicates
            let isSendingEmail = false;

            // Initialize DataTable
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
                }
            });

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
                fetch('sendreport.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: 'action=send_single&employee_id=' + employeeId
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.status);
                        }

                        // Always try to parse as JSON
                        return response.json();
                    })
                    .then(data => {
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
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Restore button
                        $button.html(originalText);
                        $button.attr('class', originalClass);
                        $button.prop('disabled', false);
                        isSendingEmail = false;

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Send Email',
                            html: `Could not send email to <strong>${employeeName}</strong>.<br>Error: ${error.message}`,
                            confirmButtonColor: '#3085d6'
                        });
                    });
            }

            // Add responsive data-label attributes for mobile
            $('#summaryTable tbody td').each(function() {
                var cellIndex = $(this).index();
                var headerText = $('#summaryTable thead th').eq(cellIndex).text();
                $(this).attr('data-label', headerText);
            });

            // Remove any duplicate event listeners on page load
            $(document).off('click', '.send-email-btn');
        });
    </script>
</body>

</html>

<?php
// Function to export data to Excel using the same approach as export.php
function exportToExcel($employees, $employeeEvaluations, $allCEOFeedback, $allFeedbackResponses)
{
    // Prepare the data for export in HTML table format
    $html = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Performance Evaluation Summary Report</title>
        <style>
            body { font-family: Arial, sans-serif; }
            table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #003366; color: white; font-weight: bold; }
            .summary-row { background-color: #f2f2f2; font-weight: bold; }
            .section-header { background-color: #20c997; color: white; font-size: 16px; font-weight: bold; padding: 10px; }
            .sub-header { background-color: #f8f9fa; font-weight: bold; }
        </style>
    </head>
    <body>';

    // Report Header
    $html .= '<h1 style="text-align: center; color: #003366;">MERQ Consultancy - Performance Evaluation Summary Report</h1>';
    $html .= '<h3 style="text-align: center; color: #666;">Generated on: ' . date('F j, Y \a\t g:i A') . '</h3>';
    $html .= '<hr>';

    // Summary Statistics
    $totalEmployees = count($employees);
    $totalEvaluations = 0;
    $employeesWithFeedback = 0;
    $totalFeedbackCount = 0;
    $totalResponses = 0;

    foreach ($employees as $employeeId => $employee) {
        if (isset($employeeEvaluations[$employeeId])) {
            $totalEvaluations += array_sum($employeeEvaluations[$employeeId]['perspective_counts']);
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

    $averageScore = 0;
    $scoreCount = 0;
    foreach ($employees as $employeeId => $employee) {
        if (isset($employeeEvaluations[$employeeId])) {
            $averageScore += $employeeEvaluations[$employeeId]['weighted_score'];
            $scoreCount++;
        }
    }
    $averageScore = $scoreCount > 0 ? $averageScore / $scoreCount : 0;

    $html .= '<table>
        <tr class="summary-row">
            <td>Total Employees</td>
            <td>' . $totalEmployees . '</td>
            <td>Average Score</td>
            <td>' . round($averageScore, 2) . '%</td>
        </tr>
        <tr class="summary-row">
            <td>Total Evaluations</td>
            <td>' . $totalEvaluations . '</td>
            <td>Employees with CEO Feedback</td>
            <td>' . $employeesWithFeedback . ' (' . round(($employeesWithFeedback / $totalEmployees) * 100, 1) . '%)</td>
        </tr>
        <tr class="summary-row">
            <td>Total CEO Feedback Items</td>
            <td>' . $totalFeedbackCount . '</td>
            <td>Total Feedback Responses</td>
            <td>' . $totalResponses . '</td>
        </tr>
    </table>';

    // Main Data Table
    $html .= '<h2 class="section-header">Detailed Employee Performance Summary</h2>';
    $html .= '<table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Supervisor</th>
                <th>Weighted Score</th>
                <th>Performance Category</th>
                <th>Self Eval</th>
                <th>Supervisor</th>
                <th>Subordinate</th>
                <th>Colleague</th>
                <th>Other</th>
                <th>Total Eval</th>
                <th>CEO Feedback</th>
                <th>Priority Levels</th>
                <th>Target Dates</th>
                <th>Categories</th>
                <th>Feedback Responses</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($employees as $employeeId => $employee) {
        $evaluationData = isset($employeeEvaluations[$employeeId]) ? $employeeEvaluations[$employeeId] : null;
        $ceoFeedback = isset($allCEOFeedback[$employeeId]) ? $allCEOFeedback[$employeeId] : [];

        // Prepare feedback details
        $priorityLevels = [];
        $targetDates = [];
        $categories = [];
        $feedbackCount = count($ceoFeedback);
        $responseCount = 0;

        foreach ($ceoFeedback as $feedback) {
            $priorityLevels[] = ucfirst($feedback['priority']);
            if (!empty($feedback['target_completion_date'])) {
                $targetDates[] = date('M d, Y', strtotime($feedback['target_completion_date']));
            }
            $categories[] = $feedback['category_name'] ?? 'General';

            if (isset($allFeedbackResponses[$feedback['id']])) {
                $responseCount += count($allFeedbackResponses[$feedback['id']]);
            }
        }

        $perspectives = $evaluationData ? $evaluationData['perspective_counts'] : [
            'Self-evaluation' => 0,
            'Supervisor' => 0,
            'Subordinate' => 0,
            'Colleague' => 0,
            'Other' => 0
        ];

        $html .= '<tr>';
        $html .= '<td>' . $employeeId . '</td>';
        $html .= '<td>' . htmlspecialchars($employee['full_name'] ?? 'N/A') . '</td>';
        $html .= '<td>' . htmlspecialchars($employee['position_title'] ?? 'N/A') . '</td>';
        $html .= '<td>' . htmlspecialchars($employee['department_name'] ?? 'N/A') . '</td>';
        $html .= '<td>' . htmlspecialchars($employee['supervisor_name'] ?? 'N/A') . '</td>';
        $html .= '<td>' . ($evaluationData ? round($evaluationData['weighted_score'], 2) . '%' : 'N/A') . '</td>';
        $html .= '<td>' . ($evaluationData ? htmlspecialchars($evaluationData['performance_category']) : 'Not Evaluated') . '</td>';
        $html .= '<td>' . $perspectives['Self-evaluation'] . '</td>';
        $html .= '<td>' . $perspectives['Supervisor'] . '</td>';
        $html .= '<td>' . $perspectives['Subordinate'] . '</td>';
        $html .= '<td>' . $perspectives['Colleague'] . '</td>';
        $html .= '<td>' . $perspectives['Other'] . '</td>';
        $html .= '<td>' . array_sum($perspectives) . '</td>';
        $html .= '<td>' . $feedbackCount . '</td>';
        $html .= '<td>' . implode(', ', array_unique($priorityLevels)) . '</td>';
        $html .= '<td>' . implode(', ', $targetDates) . '</td>';
        $html .= '<td>' . implode(', ', array_unique($categories)) . '</td>';
        $html .= '<td>' . $responseCount . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // Detailed CEO Feedback Section
    $html .= '<h2 class="section-header">Detailed CEO Feedback and Responses</h2>';

    foreach ($employees as $employeeId => $employee) {
        $ceoFeedback = isset($allCEOFeedback[$employeeId]) ? $allCEOFeedback[$employeeId] : [];

        if (!empty($ceoFeedback)) {
            $html .= '<h3>' . htmlspecialchars($employee['full_name'] ?? 'Employee ' . $employeeId) . ' - ' . count($ceoFeedback) . ' Feedback Item(s)</h3>';

            foreach ($ceoFeedback as $index => $feedback) {
                $responses = isset($allFeedbackResponses[$feedback['id']]) ? $allFeedbackResponses[$feedback['id']] : [];

                $html .= '<table style="margin-bottom: 15px;">
                    <tr class="sub-header">
                        <td colspan="2">Feedback #' . ($index + 1) . ' - ' . htmlspecialchars($feedback['category_name'] ?? 'General') . '</td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>Priority:</strong></td>
                        <td>' . ucfirst($feedback['priority']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>' . date('F j, Y \a\t g:i A', strtotime($feedback['created_at'])) . '</td>
                    </tr>';

                if (!empty($feedback['target_completion_date'])) {
                    $html .= '<tr>
                        <td><strong>Target Date:</strong></td>
                        <td>' . date('F j, Y', strtotime($feedback['target_completion_date'])) . '</td>
                    </tr>';
                }

                $html .= '<tr>
                        <td><strong>From CEO:</strong></td>
                        <td>' . htmlspecialchars($feedback['ceo_name']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback:</strong></td>
                        <td>' . nl2br(htmlspecialchars($feedback['feedback_text'])) . '</td>
                    </tr>';

                if (!empty($responses)) {
                    $html .= '<tr class="sub-header">
                        <td colspan="2">' . count($responses) . ' Response(s)</td>
                    </tr>';

                    foreach ($responses as $responseIndex => $response) {
                        $html .= '<tr>
                            <td><strong>Response #' . ($responseIndex + 1) . ':</strong></td>
                            <td>
                                ' . nl2br(htmlspecialchars($response['response_text'])) . '<br>
                                <small><em>By: ' . htmlspecialchars($response['employee_name']) . ' on ' . date('F j, Y \a\t g:i A', strtotime($response['submitted_at'])) . '</em></small>
                            </td>
                        </tr>';
                    }
                } else {
                    $html .= '<tr>
                        <td><strong>Responses:</strong></td>
                        <td>No responses yet</td>
                    </tr>';
                }

                $html .= '</table>';
            }
        }
    }

    $html .= '</body></html>';

    // Set headers for Excel download
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="performance_summary_' . date('Y-m-d_His') . '.xls"');
    header('Cache-Control: max-age=0');

    echo $html;
    exit;
}
