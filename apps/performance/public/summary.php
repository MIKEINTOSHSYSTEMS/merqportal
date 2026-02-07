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
                    html: 'Generating comprehensive report with multiple sheets...<br><br><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 1500,
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
// Function to export data to Excel with proper multiple sheets structure
function exportToExcel($employees, $employeeEvaluations, $allCEOFeedback, $allFeedbackResponses)
{
    while (ob_get_level()) {
        ob_end_clean();
    }

    $filename = "MERQ_performance_summary_" . date('Y-m-d_His') . ".xls";

    // Set proper headers for Excel XML
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Cache-Control: max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Start XML output
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<?mso-application progid="Excel.Sheet"?>';
    echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
          xmlns:x="urn:schemas-microsoft-com:office:excel"
          xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
          xmlns:html="http://www.w3.org/TR/REC-html40"
          xmlns:o="urn:schemas-microsoft-com:office:office"
          xmlns:v="urn:schemas-microsoft-com:vml">';

    // Styles
    echo '<Styles>';
    echo '<Style ss:ID="Default" ss:Name="Normal">
            <Font ss:FontName="Calibri" ss:Size="11" ss:Color="#000000"/>
          </Style>';
    echo '<Style ss:ID="Title">
            <Font ss:FontName="Calibri" ss:Size="16" ss:Color="#003377" ss:Bold="1"/>
            <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
          </Style>';
    echo '<Style ss:ID="Subtitle">
            <Font ss:FontName="Calibri" ss:Size="12" ss:Color="#777777"/>
            <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
          </Style>';
    echo '<Style ss:ID="Header">
            <Font ss:FontName="Calibri" ss:Size="12" ss:Color="#FFFFFF" ss:Bold="1"/>
            <Interior ss:Color="#20c997" ss:Pattern="Solid"/>
            <Borders>
              <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
              <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
              <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
              <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
            </Borders>
            <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
          </Style>';
    echo '<Style ss:ID="SubHeader">
            <Font ss:FontName="Calibri" ss:Size="11" ss:Color="#000000" ss:Bold="1"/>
            <Interior ss:Color="#E0E0E0" ss:Pattern="Solid"/>
            <Borders>
              <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
              <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
              <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
              <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
            </Borders>
          </Style>';
    echo '<Style ss:ID="Excellent"><Interior ss:Color="#D4EDDA" ss:Pattern="Solid"/></Style>';
    echo '<Style ss:ID="Good"><Interior ss:Color="#D1ECF1" ss:Pattern="Solid"/></Style>';
    echo '<Style ss:ID="Average"><Interior ss:Color="#FFF3CD" ss:Pattern="Solid"/></Style>';
    echo '<Style ss:ID="Poor"><Interior ss:Color="#F8D7DA" ss:Pattern="Solid"/></Style>';
    echo '<Style ss:ID="NeedsImprovement"><Interior ss:Color="#F5C6CB" ss:Pattern="Solid"/></Style>';
    echo '<Style ss:ID="TextWrap">
            <Alignment ss:Vertical="Top" ss:WrapText="1"/>
          </Style>';
    echo '<Style ss:ID="Bold">
            <Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1"/>
          </Style>';

    echo '<Style ss:ID="RespAll">
            <Interior ss:Color="#D4EDDA" ss:Pattern="Solid"/>
            <Font ss:Bold="1"/>
          </Style>';

    echo '<Style ss:ID="RespPartial">
            <Interior ss:Color="#FFF3CD" ss:Pattern="Solid"/>
          </Style>';

    echo '<Style ss:ID="RespNone">
            <Interior ss:Color="#F8D7DA" ss:Pattern="Solid"/>
          </Style>';

    echo '<Style ss:ID="DeadAllInTime">
            <Interior ss:Color="#C3E6CB" ss:Pattern="Solid"/>
            <Font ss:Bold="1"/>
          </Style>';

    echo '<Style ss:ID="DeadPending">
            <Interior ss:Color="#FFE8A1" ss:Pattern="Solid"/>
          </Style>';

    echo '<Style ss:ID="DeadOverdue">
            <Interior ss:Color="#F5C6CB" ss:Pattern="Solid"/>
            <Font ss:Bold="1"/>
          </Style>';

    echo '<Style ss:ID="DeadSomeLate">
            <Interior ss:Color="#FFD6A5" ss:Pattern="Solid"/>
          </Style>';

    echo '<Style ss:ID="Hyperlink">
        <Font ss:FontName="Calibri" ss:Size="12" ss:Color="#047FC1" ss:Bold="1" ss:Underline="Single"/>
      </Style>';

    echo '<Style ss:ID="HintStyle">
        <Font ss:FontName="Calibri" ss:Size="12" ss:Bold="1"/>
        <Interior ss:Color="#F2F2F2" ss:Pattern="Solid"/>
      </Style>';

    echo '</Styles>';

    // ============================================
    // WORKSHEET 1: SUMMARY REPORT
    // ============================================
    echo '<Worksheet ss:Name="Summary Report">';
    echo '<Table>';

    // Set column widths
    echo '<Column ss:Width="80"/>';
    echo '<Column ss:Width="150"/>';
    echo '<Column ss:Width="120"/>';
    echo '<Column ss:Width="150"/>';
    echo '<Column ss:Width="120"/>';
    echo '<Column ss:Width="80"/>';
    echo '<Column ss:Width="150"/>';
    echo '<Column ss:Width="100"/>';
    echo '<Column ss:Width="100"/>';
    echo '<Column ss:Width="100"/>';
    echo '<Column ss:Width="80"/>';
    echo '<Column ss:Width="120"/>';
    echo '<Column ss:Width="120"/>';

    // Logo Row
    echo '<Row ss:Height="60">';
    echo '<Cell ss:MergeAcross="2">';
    //echo '<Data ss:Type="String">=IMAGE("https://app.merqconsultancy.org/assets/images/merq-logo.png", "merq",3,200,140)</Data>';

    echo '<ss:Data ss:Type="String">';
    echo '<html:img src="https://app.merqconsultancy.org/assets/images/merq-logo.png" width="140" height="60" align="left"/>';
    echo '</ss:Data>';

    echo '</Cell>';
    echo '<Cell ss:MergeAcross="6" ss:StyleID="Title">';
    echo '<Data ss:Type="String">MERQ CONSULTANCY</Data>';
    echo '</Cell>';
    echo '</Row>';

   // echo '<Row>';
   // echo '<Cell ss:MergeAcross="12" ss:StyleID="Title"><Data ss:Type="String">MERQ CONSULTANCY</Data></Cell>';
   // echo '</Row>';

    echo '<Row>';
    echo '<Cell ss:MergeAcross="12" ss:StyleID="Title"><Data ss:Type="String">PERFORMANCE EVALUATION SUMMARY REPORT</Data></Cell>';
    echo '</Row>';


    echo '<Row>';
    echo '<Cell ss:MergeAcross="12" ss:StyleID="Subtitle"><Data ss:Type="String">Generated on: ' . date('F j, Y \a\t g:i A') . '</Data></Cell>';
    echo '</Row>';

    echo '<Row><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/></Row>';

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
                    $responseCount += count($allFeedbackResponses[$feedback['id']]);
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
    $averageScore = $scoreCount > 0 ? round($averageScore / $scoreCount, 2) : 0;

    // Detailed Employee Performance
    echo '<Row>';
    echo '<Cell ss:MergeAcross="12" ss:StyleID="Header"><Data ss:Type="String">DETAILED EMPLOYEE PERFORMANCE SUMMARY</Data></Cell>';
    echo '</Row>';

    // Column headers
    $headers = [
        'Employee ID',
        'Full Name',
        'Position',
        'Department',
        'Supervisor',
        'Weighted Score',
        'Performance Category',
        'Total Evaluations',
        'CEO Feedback Items',
        'Feedback Responses',
        'Response Rate',
        'Response Status',
        'Deadline Status'
    ];

    echo '<Row>';
    foreach ($headers as $header) {
        echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">' . $header . '</Data></Cell>';
    }
    echo '</Row>';

    // Employee data rows
    foreach ($employees as $employeeId => $employee) {

        $evaluationData = isset($employeeEvaluations[$employeeId]) ? $employeeEvaluations[$employeeId] : null;
        $ceoFeedback    = isset($allCEOFeedback[$employeeId]) ? $allCEOFeedback[$employeeId] : [];

        $totalEvals   = $evaluationData ? array_sum($evaluationData['perspective_counts']) : 0;
        $feedbackCount = count($ceoFeedback);

        // Calculate responses
        $responseCount = 0;
        foreach ($ceoFeedback as $feedback) {
            if (isset($allFeedbackResponses[$feedback['id']])) {
                $responseCount += count($allFeedbackResponses[$feedback['id']]);
            }
        }

        $responseRate   = $feedbackCount > 0
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
            $anyOverdue   = false;

            foreach ($ceoFeedback as $feedback) {

                $hasResponse = isset($allFeedbackResponses[$feedback['id']])
                    && !empty($allFeedbackResponses[$feedback['id']]);

                if (!$hasResponse && !empty($feedback['target_completion_date'])) {

                    $allResponded = false;
                    $targetDate  = new DateTime($feedback['target_completion_date']);
                    $today       = new DateTime();

                    if ($today > $targetDate) {
                        $anyOverdue = true;
                    }
                } elseif ($hasResponse && !empty($feedback['target_completion_date'])) {

                    $targetDate   = new DateTime($feedback['target_completion_date']);
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

        // Score style
        $scoreStyle = 'Default';
        $score = $evaluationData ? $evaluationData['weighted_score'] : 0;

        if ($score >= 90) {
            $scoreStyle = 'Excellent';
        } elseif ($score >= 75) {
            $scoreStyle = 'Good';
        } elseif ($score >= 60) {
            $scoreStyle = 'Average';
        } elseif ($score >= 30) {
            $scoreStyle = 'Poor';
        } elseif ($score > 0) {
            $scoreStyle = 'NeedsImprovement';
        }

        // Sheet name for hyperlink (MUST match individual worksheet)
        $sheetName = createValidSheetName($employee['full_name'] ?? 'Employee', $employeeId);

        echo '<Row>';

        echo '<Cell><Data ss:Type="String">' . $employeeId . '</Data></Cell>';

        // 🔗 FULL NAME → clickable hyperlink to employee sheet
        echo '<Cell ss:StyleID="Hyperlink" ss:HRef="#\''
            . $sheetName
            . '\'!A1">';
        echo '<Data ss:Type="String">'
            . htmlspecialchars($employee['full_name'] ?? 'N/A', ENT_XML1)
            . '</Data>';
        echo '</Cell>';

        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['position_title'] ?? 'N/A', ENT_XML1) . '</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['department_name'] ?? 'N/A', ENT_XML1) . '</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['supervisor_name'] ?? 'N/A', ENT_XML1) . '</Data></Cell>';

        echo '<Cell ss:StyleID="' . $scoreStyle . '">
            <Data ss:Type="Number">' . ($evaluationData ? round($evaluationData['weighted_score'], 2) : 0) . '</Data>
          </Cell>';

        echo '<Cell><Data ss:Type="String">' . ($evaluationData ? $evaluationData['performance_category'] : 'Not Evaluated') . '</Data></Cell>';
        echo '<Cell><Data ss:Type="Number">' . $totalEvals . '</Data></Cell>';
        echo '<Cell><Data ss:Type="Number">' . $feedbackCount . '</Data></Cell>';
        echo '<Cell><Data ss:Type="Number">' . $responseCount . '</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . $responseRate . '</Data></Cell>';

        // Response style
        $responseStyle = 'Default';
        if ($responseStatus === 'All Responded') {
            $responseStyle = 'RespAll';
        } elseif ($responseStatus === 'No Responses' || $responseStatus === 'No Feedback') {
            $responseStyle = 'RespNone';
        } else {
            $responseStyle = 'RespPartial';
        }

        // Deadline style
        $deadlineStyle = 'Default';
        if ($deadlineStatus === 'All In Time') {
            $deadlineStyle = 'DeadAllInTime';
        } elseif ($deadlineStatus === 'Overdue') {
            $deadlineStyle = 'DeadOverdue';
        } elseif ($deadlineStatus === 'Some Late') {
            $deadlineStyle = 'DeadSomeLate';
        } elseif ($deadlineStatus === 'Pending') {
            $deadlineStyle = 'DeadPending';
        }

        echo '<Cell ss:StyleID="' . $responseStyle . '"><Data ss:Type="String">' . $responseStatus . '</Data></Cell>';
        echo '<Cell ss:StyleID="' . $deadlineStyle . '"><Data ss:Type="String">' . $deadlineStatus . '</Data></Cell>';

        echo '</Row>';
    }

    echo '<Row><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/></Row>';

    // Hint rows
    echo '<Row ss:StyleID="HintStyle">
            <Cell/><Cell><Data ss:Type="String">HINT:</Data></Cell><Cell/>
        </Row>';
    echo '<Row ss:StyleID="HintStyle">
            <Cell/><Cell><Data ss:Type="String">Click on the Names to go to Individual Employee Sheets</Data></Cell><Cell/>
        </Row>';
    echo '<Row ss:StyleID="HintStyle">
            <Cell/><Cell><Data ss:Type="String">Click on Back to Summary</Data></Cell><Cell/>
        </Row>';

    echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

    // Performance Distribution
    echo '<Row>';
    echo '<Cell ss:MergeAcross="2" ss:StyleID="Header"><Data ss:Type="String">PERFORMANCE DISTRIBUTION</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Performance Category</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Employee Count</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Percentage</Data></Cell>';
    echo '</Row>';

    foreach ($performanceDistribution as $category => $count) {
        $percentage = $totalEmployees > 0 ? round(($count / $totalEmployees) * 100, 1) : 0;
        echo '<Row>';
        echo '<Cell><Data ss:Type="String">' . $category . '</Data></Cell>';
        echo '<Cell><Data ss:Type="Number">' . $count . '</Data></Cell>';
        echo '<Cell><Data ss:Type="Number">' . $percentage . '</Data></Cell>';
        echo '</Row>';
    }

    echo '<Row><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/><Cell/></Row>';


    // Summary Statistics Section
    echo '<Row>';
    echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">SUMMARY STATISTICS</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Metric</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Count</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Metric</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Value</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Total Employees</Data></Cell>';
    echo '<Cell><Data ss:Type="Number">' . $totalEmployees . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Average Performance Score</Data></Cell>';
    echo '<Cell><Data ss:Type="Number">' . $averageScore . '</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Total Evaluations</Data></Cell>';
    echo '<Cell><Data ss:Type="Number">' . $totalEvaluations . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Employees with CEO Feedback</Data></Cell>';
    echo '<Cell><Data ss:Type="String">' . $employeesWithFeedback . ' (' . round(($employeesWithFeedback / max(1, $totalEmployees)) * 100, 1) . '%)</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Total CEO Feedback Items</Data></Cell>';
    echo '<Cell><Data ss:Type="Number">' . $totalFeedbackCount . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Total Feedback Responses</Data></Cell>';
    echo '<Cell><Data ss:Type="Number">' . $totalResponses . '</Data></Cell>';
    echo '</Row>';

    echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

    // -------------------------------------------------
    // LEGEND – Response & Deadline Status Colors
    // -------------------------------------------------
    echo '<Row>';
    echo '<Cell ss:MergeAcross="4" ss:StyleID="Header"><Data ss:Type="String">STATUS COLOR LEGEND</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Type</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Status</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Meaning</Data></Cell>';
    echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Color</Data></Cell>';
    echo '</Row>';

    // Response status legend
    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Response Status</Data></Cell>';
    echo '<Cell ss:StyleID="RespAll"><Data ss:Type="String">All Responded</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Employee responded to all CEO feedback items</Data></Cell>';
    echo '<Cell ss:StyleID="RespAll"><Data ss:Type="String">Green</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Response Status</Data></Cell>';
    echo '<Cell ss:StyleID="RespPartial"><Data ss:Type="String">Partial</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Some feedback items have responses</Data></Cell>';
    echo '<Cell ss:StyleID="RespPartial"><Data ss:Type="String">Yellow</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Response Status</Data></Cell>';
    echo '<Cell ss:StyleID="RespNone"><Data ss:Type="String">No Responses / No Feedback</Data></Cell>';
    echo '<Cell><Data ss:Type="String">No response submitted yet or no feedback assigned</Data></Cell>';
    echo '<Cell ss:StyleID="RespNone"><Data ss:Type="String">Red</Data></Cell>';
    echo '</Row>';

    // Deadline status legend
    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Deadline Status</Data></Cell>';
    echo '<Cell ss:StyleID="DeadAllInTime"><Data ss:Type="String">All In Time</Data></Cell>';
    echo '<Cell><Data ss:Type="String">All feedback items were responded to before the deadline</Data></Cell>';
    echo '<Cell ss:StyleID="DeadAllInTime"><Data ss:Type="String">Green</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Deadline Status</Data></Cell>';
    echo '<Cell ss:StyleID="DeadSomeLate"><Data ss:Type="String">Some Late</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Some feedback responses were submitted after the deadline</Data></Cell>';
    echo '<Cell ss:StyleID="DeadSomeLate"><Data ss:Type="String">Orange</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Deadline Status</Data></Cell>';
    echo '<Cell ss:StyleID="DeadOverdue"><Data ss:Type="String">Overdue</Data></Cell>';
    echo '<Cell><Data ss:Type="String">At least one feedback item is overdue without a response</Data></Cell>';
    echo '<Cell ss:StyleID="DeadOverdue"><Data ss:Type="String">Red</Data></Cell>';
    echo '</Row>';

    echo '<Row>';
    echo '<Cell><Data ss:Type="String">Deadline Status</Data></Cell>';
    echo '<Cell ss:StyleID="DeadPending"><Data ss:Type="String">Pending</Data></Cell>';
    echo '<Cell><Data ss:Type="String">Responses are still within the allowed deadline</Data></Cell>';
    echo '<Cell ss:StyleID="DeadPending"><Data ss:Type="String">Yellow</Data></Cell>';
    echo '</Row>';


    echo '</Table>';
    echo '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
            <PageSetup>
                <Header x:Margin="0.3"/>
                <Footer x:Margin="0.3"/>
                <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
            </PageSetup>
            <Print>
                <ValidPrinterInfo/>
                <HorizontalResolution>600</HorizontalResolution>
                <VerticalResolution>600</VerticalResolution>
            </Print>
            <Selected/>
            <ProtectObjects>False</ProtectObjects>
            <ProtectScenarios>False</ProtectScenarios>
          </WorksheetOptions>';
    echo '</Worksheet>';

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

        echo '<Worksheet ss:Name="' . $sheetName . '">';
        echo '<Table>';
        echo '<Column ss:Width="150"/>';
        echo '<Column ss:Width="300"/>';
        echo '<Column ss:Width="150"/>';
        echo '<Column ss:Width="300"/>';

        // ⬅ BACK TO SUMMARY LINK
        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Hyperlink" ss:HRef="#\'Summary Report\'!A1">';
        echo '<Data ss:Type="String">⬅ Back to Summary Report</Data>';
        echo '</Cell>';
        echo '</Row>';

        //echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

        // Logo and Title Row for individual sheets
        echo '<Row ss:Height="60">';
        //echo '<Cell ss:MergeAcross="1">';
        echo '<Cell ss:MergeAcross="0">';
        //echo '<Data ss:Type="String">=IMAGE("https://app.merqconsultancy.org/assets/images/merq-logo.png", "merq",3,200,140)</Data>';

        echo '<ss:Data ss:Type="String">';
        echo '<html:img src="https://app.merqconsultancy.org/assets/images/merq-logo.png" width="140" height="60" align="left"/>';
        echo '</ss:Data>';

        echo '</Cell>';
        //echo '<Cell ss:MergeAcross="1" ss:StyleID="Title">';
        echo '<Cell ss:MergeAcross="1" ss:StyleID="Title">';
        echo '<Data ss:Type="String">INDIVIDUAL PERFORMANCE REPORT</Data>';
        echo '</Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Title"><Data ss:Type="String">' . htmlspecialchars($employee['full_name']) . '</Data></Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Subtitle"><Data ss:Type="String">Employee ID: ' . $employeeId . ' | Generated: ' . date('F j, Y') . '</Data></Cell>';
        echo '</Row>';

        echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

        // Employee Information
        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">EMPLOYEE INFORMATION</Data></Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Full Name:</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['full_name']) . '</Data></Cell>';
        echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Position:</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['position_title'] ?? 'N/A') . '</Data></Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Department:</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['department_name'] ?? 'N/A') . '</Data></Cell>';
        echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Supervisor:</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['supervisor_name'] ?? 'N/A') . '</Data></Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Employee ID:</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . $employeeId . '</Data></Cell>';
        echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Email:</Data></Cell>';
        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($employee['email'] ?? 'N/A') . '</Data></Cell>';
        echo '</Row>';

        echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

        // Performance Overview
        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">PERFORMANCE OVERVIEW</Data></Cell>';
        echo '</Row>';

        if ($evaluationData) {
            echo '<Row>';
            echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Overall Weighted Score:</Data></Cell>';
            $score = $evaluationData['weighted_score'];
            $scoreStyle = 'Default';

            if ($score >= 90) {
                $scoreStyle = 'Excellent';
            } elseif ($score >= 75) {
                $scoreStyle = 'Good';
            } elseif ($score >= 60) {
                $scoreStyle = 'Average';
            } elseif ($score >= 30) {
                $scoreStyle = 'Poor';
            } elseif ($score > 0) {
                $scoreStyle = 'NeedsImprovement';
            }

            echo '<Cell ss:StyleID="' . $scoreStyle . '"><Data ss:Type="Number">' . round($score, 2) . '</Data></Cell>';

            echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Performance Category:</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . $evaluationData['performance_category'] . '</Data></Cell>';
            echo '</Row>';

            echo '<Row>';
            echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Total Evaluations:</Data></Cell>';
            echo '<Cell><Data ss:Type="Number">' . array_sum($evaluationData['perspective_counts']) . '</Data></Cell>';
            echo '<Cell/><Cell/>';
            echo '</Row>';

            echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

            // Evaluation Perspectives
            if (!empty($evaluationData['perspective_counts'])) {
                echo '<Row>';
                echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">EVALUATION PERSPECTIVES</Data></Cell>';
                echo '</Row>';

                foreach ($evaluationData['perspective_counts'] as $perspective => $count) {
                    if ($count > 0) {
                        echo '<Row>';
                        echo '<Cell><Data ss:Type="String">' . $perspective . ':</Data></Cell>';
                        echo '<Cell><Data ss:Type="Number">' . $count . '</Data></Cell>';
                        echo '<Cell/><Cell/>';
                        echo '</Row>';
                    }
                }

                echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';
            }

            // Category Scores
            if (!empty($evaluationData['category_scores'])) {
                echo '<Row>';
                echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">CATEGORY PERFORMANCE SCORES</Data></Cell>';
                echo '</Row>';

                echo '<Row>';
                echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Category</Data></Cell>';
                echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Average Score (1-5)</Data></Cell>';
                echo '<Cell ss:StyleID="SubHeader"><Data ss:Type="String">Percentage</Data></Cell>';
                echo '<Cell/>';
                echo '</Row>';

                foreach ($evaluationData['category_scores'] as $category => $scoreData) {
                    if (($scoreData['count'] ?? 0) > 0) {
                        $average = round($scoreData['average'] ?? 0, 2);
                        $percentage = round($scoreData['percentage'] ?? 0, 1);

                        echo '<Row>';
                        echo '<Cell><Data ss:Type="String">' . htmlspecialchars($category, ENT_XML1) . '</Data></Cell>';
                        echo '<Cell><Data ss:Type="Number">' . $average . '</Data></Cell>';
                        echo '<Cell><Data ss:Type="Number">' . $percentage . '</Data></Cell>';
                        echo '<Cell/>';
                        echo '</Row>';
                    }
                }

                echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';
            }
        } else {
            echo '<Row>';
            echo '<Cell ss:MergeAcross="3"><Data ss:Type="String">No performance evaluation data available for this employee.</Data></Cell>';
            echo '</Row>';
            echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';
        }


        // CEO Feedback Section
        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">CEO FEEDBACK</Data></Cell>';
        echo '</Row>';

        if (!empty($ceoFeedback)) {
            $totalResponses = 0;
            foreach ($ceoFeedback as $feedback) {
                if (isset($allFeedbackResponses[$feedback['id']])) {
                    $totalResponses += count($allFeedbackResponses[$feedback['id']]);
                }
            }

            echo '<Row>';
            echo '<Cell ss:MergeAcross="3"><Data ss:Type="String">' . count($ceoFeedback) . ' Feedback Items, ' . $totalResponses . ' Responses</Data></Cell>';
            echo '</Row>';

            foreach ($ceoFeedback as $index => $feedback) {
                $responses = isset($allFeedbackResponses[$feedback['id']]) ? $allFeedbackResponses[$feedback['id']] : [];

                echo '<Row>';
                echo '<Cell ss:MergeAcross="3" ss:StyleID="SubHeader"><Data ss:Type="String">Feedback #' . ($index + 1) . ' - ' . ($feedback['category_name'] ?? 'General Feedback') . ' (' . ucfirst($feedback['priority']) . ' Priority)</Data></Cell>';
                echo '</Row>';

                echo '<Row>';
                echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">From CEO:</Data></Cell>';
                echo '<Cell><Data ss:Type="String">' . $feedback['ceo_name'] . '</Data></Cell>';
                echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Date Given:</Data></Cell>';
                echo '<Cell><Data ss:Type="String">' . date('F j, Y \a\t g:i A', strtotime($feedback['created_at'])) . '</Data></Cell>';
                echo '</Row>';

                if (!empty($feedback['target_completion_date'])) {
                    echo '<Row>';
                    echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Target Completion:</Data></Cell>';
                    echo '<Cell><Data ss:Type="String">' . date('F j, Y', strtotime($feedback['target_completion_date'])) . '</Data></Cell>';
                    echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Status:</Data></Cell>';

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

                    $statusStyle = 'Default';

                    if (strpos($statusText, 'Responded In Time') !== false) {
                        $statusStyle = 'DeadAllInTime';
                    } elseif (strpos($statusText, 'Responded Late') !== false) {
                        $statusStyle = 'DeadSomeLate';
                    } elseif (strpos($statusText, 'Overdue') !== false) {
                        $statusStyle = 'DeadOverdue';
                    } elseif (strpos($statusText, 'days remaining') !== false) {
                        $statusStyle = 'DeadPending';
                    }

                    echo '<Cell ss:StyleID="' . $statusStyle . '"><Data ss:Type="String">' . htmlspecialchars($statusText, ENT_XML1) . '</Data></Cell>';

                    echo '</Row>';
                }

                // Feedback text with 12 merged rows for better display
                echo '<Row>';
                echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Feedback:</Data></Cell>';
                echo '<Cell ss:MergeAcross="2" ss:MergeDown="11" ss:StyleID="TextWrap"><Data ss:Type="String">' . htmlspecialchars($feedback['feedback_text']) . '</Data></Cell>';
                echo '</Row>';

                // Add empty rows to complete the 12 rows for the merged cell
                for ($i = 1; $i < 12; $i++) {
                    echo '<Row/>';
                }

                // Responses
                if (!empty($responses)) {
                    echo '<Row>';
                    echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Responses (' . count($responses) . '):</Data></Cell>';
                    echo '<Cell ss:MergeAcross="2"/>';
                    echo '</Row>';

                    foreach ($responses as $responseIndex => $response) {
                        // Response text with 6 merged rows
                        echo '<Row>';
                        echo '<Cell><Data ss:Type="String">Response #' . ($responseIndex + 1) . ':</Data></Cell>';
                        echo '<Cell ss:MergeAcross="2" ss:MergeDown="5" ss:StyleID="TextWrap"><Data ss:Type="String">' . htmlspecialchars($response['response_text']) . '</Data></Cell>';
                        echo '</Row>';

                        // Add empty rows to complete the 6 rows for the response cell
                        for ($i = 1; $i < 6; $i++) {
                            echo '<Row/>';
                        }

                        echo '<Row>';
                        echo '<Cell><Data ss:Type="String">Submitted:</Data></Cell>';
                        echo '<Cell ss:MergeAcross="2"><Data ss:Type="String">' . date('F j, Y \a\t g:i A', strtotime($response['submitted_at'])) . '</Data></Cell>';
                        echo '</Row>';
                    }
                } else {
                    echo '<Row>';
                    echo '<Cell ss:StyleID="Bold"><Data ss:Type="String">Responses:</Data></Cell>';
                    echo '<Cell ss:MergeAcross="2"><Data ss:Type="String">No responses yet from the employee.</Data></Cell>';
                    echo '</Row>';
                }

                echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';
            }
        } else {
            echo '<Row>';
            echo '<Cell ss:MergeAcross="3"><Data ss:Type="String">No CEO feedback available for this employee.</Data></Cell>';
            echo '</Row>';
        }

        echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

        // Summary and Recommendations
        echo '<Row>';
        echo '<Cell ss:MergeAcross="3" ss:StyleID="Header"><Data ss:Type="String">SUMMARY & RECOMMENDATIONS</Data></Cell>';
        echo '</Row>';

        // Helper to print one bullet row
        $printBullet = function ($text) {
            echo '<Row>';
            echo '<Cell ss:MergeAcross="3" ss:StyleID="TextWrap"><Data ss:Type="String">• ' . htmlspecialchars($text, ENT_XML1) . '</Data></Cell>';
            echo '</Row>';
        };

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
                $printBullet('Outstanding Performance: Demonstrates exceptional performance across all categories.');
                $printBullet('Recommendation: Consider for leadership roles, special projects, or recognition awards.');
            } elseif ($score >= 75) {
                $printBullet('Exceeds Expectations: Consistently performs above job requirements.');
                $printBullet('Recommendation: Provide opportunities for growth and increased responsibility.');
            } elseif ($score >= 60) {
                $printBullet('Meets Expectations: Meets all job requirements satisfactorily.');
                $printBullet('Recommendation: Continue current development plan, focus on specific skill enhancements.');
            } elseif ($score >= 30) {
                $printBullet('Developing: Shows potential but needs improvement in some areas.');
                $printBullet('Recommendation: Create targeted development plan with regular check-ins.');
            } else {
                $printBullet('Needs Significant Improvement: Immediate attention required for performance improvement.');
                $printBullet('Recommendation: Implement performance improvement plan with clear milestones.');
            }

            if ($feedbackCount > 0) {

                $printBullet(
                    'Feedback Engagement: ' .
                        $responseCount . ' response(s) to ' .
                        $feedbackCount . ' feedback item(s) (' .
                        $responseRate . '% response rate).'
                );

                if ($responseCount == 0) {
                    $printBullet('Action Required: Employee needs to respond to CEO feedback.');
                } elseif ($responseCount < $feedbackCount) {
                    $printBullet('Action Required: Employee needs to respond to remaining feedback items.');
                }
            }
        } else {

            $printBullet('No evaluation data available.');
            $printBullet('Recommendation: Ensure employee completes self-evaluation and receives evaluations from others.');
        }

        echo '<Row><Cell/><Cell/><Cell/><Cell/></Row>';

        // Footer
        echo '<Row>';
        echo '<Cell ss:MergeAcross="3"><Data ss:Type="String">Report Generated: ' . date('F j, Y \a\t g:i A') . '</Data></Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:MergeAcross="3"><Data ss:Type="String">Confidential: This report contains sensitive performance information.</Data></Cell>';
        echo '</Row>';

        echo '<Row>';
        echo '<Cell ss:MergeAcross="3"><Data ss:Type="String">System: MERQ Consultancy Performance Management System</Data></Cell>';
        echo '</Row>';

        echo '</Table>';
        echo '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
                <PageSetup>
                    <Header x:Margin="0.3"/>
                    <Footer x:Margin="0.3"/>
                    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
                </PageSetup>
                <Print>
                    <ValidPrinterInfo/>
                    <HorizontalResolution>600</HorizontalResolution>
                    <VerticalResolution>600</VerticalResolution>
                </Print>
                <Selected/>
                <ProtectObjects>False</ProtectObjects>
                <ProtectScenarios>False</ProtectScenarios>
              </WorksheetOptions>';
        echo '</Worksheet>';
    }

    echo '</Workbook>';
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