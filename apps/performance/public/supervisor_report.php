<?php
// supervisor_report.php - Main reporting dashboard for supervisors
require_once '../includes/config.php';
require_once '../includes/header.php';

// Get the logged-in user's ID and role
$currentUserId = $_SESSION['user_id'];
$isAdmin = (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) || ($currentUserId == 35);

// Get employees based on user role
if ($isAdmin) {
    // Admins/CEO see all employees
    $employees = getEmployeesFromDatabase();
} else {
    // Supervisors see only their subordinates
    $employees = getSupervisorSubordinates($currentUserId);
}

// Get all submissions
$submissions = getSubmissions();

// Calculate weighted scores
$employeeEvaluations = calculateWeightedScores($submissions);

// Filter evaluations to only include employees the supervisor can access
$filteredScores = [];
foreach ($employeeEvaluations as $employeeId => $data) {
    if (isset($employees[$employeeId]) || $isAdmin) {
        $filteredScores[$employeeId] = $data;
    }
}

// Handle filters
$searchTerm = $_GET['search'] ?? '';
$selectedCategory = $_GET['category'] ?? '';
$selectedPerspective = $_GET['perspective'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

// Apply filters
if (!empty($searchTerm) || !empty($selectedCategory) || !empty($selectedPerspective) || !empty($startDate) || !empty($endDate)) {
    $filteredScores = filterEmployeeScores($filteredScores, $searchTerm, $selectedCategory, $selectedPerspective, $startDate, $endDate);
}

// Handle export requests
if (isset($_GET['export'])) {
    $exportType = $_GET['export'];

    if ($exportType === 'excel') {
        exportToExcel($filteredScores);
    } elseif ($exportType === 'pdf') {
        exportToPDF($filteredScores);
    }
}

// Handle individual report request
$individualReport = null;
$matrixQuestions = [];
if (isset($_GET['employee_id']) && isset($_GET['submission_id'])) {
    $employeeId = $_GET['employee_id'];
    $submissionId = $_GET['submission_id'];

    // Check if user has access to this employee's data
    if (isset($filteredScores[$employeeId]) || $isAdmin) {
        foreach ($filteredScores[$employeeId]['evaluations'] as $evaluation) {
            if ($evaluation['submission_id'] == $submissionId) {
                $individualReport = $evaluation;
                $matrixQuestions = getMatrixQuestions($evaluation['details']);
                break;
            }
        }
    }
}

// Function to get supervisor's subordinates
/*
function getSupervisorSubordinates($supervisorId)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        error_log("DB Connection failed: " . $conn->connect_error);
        return [];
    }

    $sql = "SELECT 
                u.user_id, 
                u.employee_id,
                u.full_name,
                u.first_name,
                u.middle_name,
                u.last_name,
                u.email,    
                u.role,
                p.position_title, 
                d.department_name, 
                u.supervisor_id,
                s.full_name AS supervisor_name
            FROM users u
            LEFT JOIN positions p ON u.position_id = p.position_id
            LEFT JOIN departments d ON u.department_id = d.department_id
            LEFT JOIN users s ON u.supervisor_id = s.user_id
            WHERE u.supervisor_id = ? AND u.is_active = 1
            ORDER BY u.full_name ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supervisorId);
    $stmt->execute();
    $result = $stmt->get_result();

    $subordinates = [];
    while ($row = $result->fetch_assoc()) {
        $subordinates[$row['user_id']] = $row;
    }

    $stmt->close();
    $conn->close();

    return $subordinates;
}
    */

// Filter function
function filterEmployeeScores($employeeScores, $searchTerm, $category, $perspective, $startDate, $endDate)
{
    $filtered = [];

    foreach ($employeeScores as $employeeId => $data) {
        // Filter by search term
        if (!empty($searchTerm)) {
            $employeeName = strtolower($data['details']['full_name'] ?? '');
            $position = strtolower($data['details']['position_title'] ?? '');
            $department = strtolower($data['details']['department_name'] ?? '');
            $search = strtolower($searchTerm);

            if (
                strpos($employeeName, $search) === false &&
                strpos($position, $search) === false &&
                strpos($department, $search) === false
            ) {
                continue;
            }
        }

        // Filter by category
        if (!empty($category) && $data['performance_category'] !== $category) {
            continue;
        }

        // Filter by perspective
        if (!empty($perspective) && (!isset($data['perspective_counts'][$perspective]) || $data['perspective_counts'][$perspective] == 0)) {
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

    echo $html;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Performance Evaluation Report - Supervisor View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <link href="../css/main.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Supervisor Header -->
        <div class="supervisor-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4><i class="bi bi-person-badge"></i> Supervisor Performance Report</h4>
                    <small>
                        <?php
                        if ($isAdmin) {
                            echo "Viewing: All Employees (Admin Access)";
                        } else {
                            echo "Viewing: My Subordinates (" . count($employees) . " employees)";
                        }
                        ?>
                    </small>
                </div>
                <div>
                    <a href="supervisor_report.php?export=excel" class="btn btn-light btn-sm">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </a>
                    <a href="supervisor_report.php?export=pdf" class="btn btn-light btn-sm ms-1">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>

        <?php if (!$isAdmin && empty($employees)): ?>
            <div class="alert alert-info">
                <h4><i class="bi bi-info-circle"></i> No Subordinates Assigned</h4>
                <p>You are not currently assigned as a supervisor for any employees. Please contact HR if this is incorrect.</p>
            </div>
        <?php else: ?>

            <!-- Filters -->
            <div class="card card-report mb-4">
                <div class="card-header">
                    <h5>Filters</h5>
                </div>
                <div class="card-body">
                    <form method="get" action="supervisor_report.php" class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Search Employee</label>
                            <input type="text" class="form-control" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" placeholder="Search by name, position, or department">
                        </div>
                        <div class="col-md-3">
                            <label for="category" class="form-label">Performance Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                <option value="Needs Significant Improvement" <?= $selectedCategory === 'Needs Significant Improvement' ? 'selected' : '' ?>>Needs Significant Improvement</option>
                                <option value="Developing" <?= $selectedCategory === 'Developing' ? 'selected' : '' ?>>Developing</option>
                                <option value="Meets Expectations" <?= $selectedCategory === 'Meets Expectations' ? 'selected' : '' ?>>Meets Expectations</option>
                                <option value="Exceeds Expectations" <?= $selectedCategory === 'Exceeds Expectations' ? 'selected' : '' ?>>Exceeds Expectations</option>
                                <option value="Outstanding" <?= $selectedCategory === 'Outstanding' ? 'selected' : '' ?>>Outstanding</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="perspective" class="form-label">Evaluation Perspective</label>
                            <select class="form-select" id="perspective" name="perspective">
                                <option value="">All Perspectives</option>
                                <option value="Self-evaluation" <?= $selectedPerspective === 'Self-evaluation' ? 'selected' : '' ?>>Self-evaluation</option>
                                <option value="Supervisor" <?= $selectedPerspective === 'Supervisor' ? 'selected' : '' ?>>Supervisor</option>
                                <option value="Subordinate" <?= $selectedPerspective === 'Subordinate' ? 'selected' : '' ?>>Subordinate</option>
                                <option value="Colleague" <?= $selectedPerspective === 'Colleague' ? 'selected' : '' ?>>Colleague</option>
                                <option value="Other" <?= $selectedPerspective === 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" value="<?= htmlspecialchars($startDate) ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="end_date" value="<?= htmlspecialchars($endDate) ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="supervisor_report.php" class="btn btn-outline-secondary ms-2">Reset Filters</a>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!empty($individualReport)): ?>
                <!-- Individual Report View -->
                <div class="card card-report mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Individual Evaluation Report</h5>
                        <a href="supervisor_report.php" class="btn btn-sm btn-outline-secondary">Back to Summary</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Employee:</strong> <?= htmlspecialchars($individualReport['employee_name']) ?></p>
                                <p><strong>Position:</strong> <?= htmlspecialchars($individualReport['position_title']) ?></p>
                                <p><strong>Department:</strong> <?= htmlspecialchars($individualReport['department_name']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Evaluator:</strong> <?= htmlspecialchars($individualReport['evaluator_name']) ?></p>
                                <p><strong>Perspective:</strong> <?= htmlspecialchars($individualReport['evaluator_perspective']) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($individualReport['submission_date']) ?></p>
                            </div>
                        </div>

                        <ul class="nav nav-tabs" id="reportTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="true">Summary</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="matrix-tab" data-bs-toggle="tab" data-bs-target="#matrix" type="button" role="tab" aria-controls="matrix" aria-selected="false">Matrix Questions</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="charts-tab" data-bs-toggle="tab" data-bs-target="#charts" type="button" role="tab" aria-controls="charts" aria-selected="false">Charts</button>
                            </li>
                        </ul>

                        <div class="tab-content mt-4" id="reportTabContent">
                            <!-- Summary Tab -->
                            <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-report">
                                            <div class="card-header">
                                                <h6>Overall Score</h6>
                                            </div>
                                            <div class="card-body text-center">
                                                <h2><?= round($individualReport['weighted_score'], 1) ?>%</h2>
                                                <span class="performance-badge 
                                                <?= $individualReport['performance_category'] === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                                <?= $individualReport['performance_category'] === 'Developing' ? 'bg-developing' : '' ?>
                                                <?= $individualReport['performance_category'] === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                                <?= $individualReport['performance_category'] === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                                <?= $individualReport['performance_category'] === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                                    <?= htmlspecialchars($individualReport['performance_category']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-report">
                                            <div class="card-header">
                                                <h6>Category Scores</h6>
                                            </div>
                                            <div class="card-body">
                                                <?php foreach ($individualReport['category_scores'] as $category => $scoreData): ?>
                                                    <div class="mb-2">
                                                        <div class="d-flex justify-content-between">
                                                            <span><?= htmlspecialchars($category) ?></span>
                                                            <span><?= round($scoreData['percentage'], 1) ?>%</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar 
                                                            <?= $scoreData['percentage'] < 30 ? 'bg-needs-improvement' : '' ?>
                                                            <?= $scoreData['percentage'] >= 30 && $scoreData['percentage'] < 61 ? 'bg-developing' : '' ?>
                                                            <?= $scoreData['percentage'] >= 61 && $scoreData['percentage'] < 76 ? 'bg-meets-expectations' : '' ?>
                                                            <?= $scoreData['percentage'] >= 76 && $scoreData['percentage'] <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                                            <?= $scoreData['percentage'] > 90 ? 'bg-outstanding' : '' ?>"
                                                                role="progressbar"
                                                                style="width: <?= $scoreData['percentage'] ?>%;"
                                                                aria-valuenow="<?= $scoreData['percentage'] ?>"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card card-report">
                                            <div class="card-header">
                                                <h6>Strengths</h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($individualReport['details']['strengths'])): ?>
                                                    <p><?= nl2br(htmlspecialchars($individualReport['details']['strengths'])) ?></p>
                                                <?php else: ?>
                                                    <p class="text-muted">No strengths recorded.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-report">
                                            <div class="card-header">
                                                <h6>Areas for Improvement</h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($individualReport['details']['areas_for_improvement'])): ?>
                                                    <p><?= nl2br(htmlspecialchars($individualReport['details']['areas_for_improvement'])) ?></p>
                                                <?php else: ?>
                                                    <p class="text-muted">No areas for improvement recorded.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Matrix Questions Tab -->
                            <div class="tab-pane fade" id="matrix" role="tabpanel" aria-labelledby="matrix-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered matrix-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Rating</th>
                                                <th>Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($matrixQuestions as $question => $data): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars(str_replace('matrix_', '', $question)) ?></td>
                                                    <td>
                                                        <?php if (is_array($data)): ?>
                                                            <?= htmlspecialchars($data['rating'] ?? 'N/A') ?>
                                                        <?php else: ?>
                                                            <?= htmlspecialchars($data) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (is_array($data) && !empty($data['comments'])): ?>
                                                            <?= nl2br(htmlspecialchars($data['comments'])) ?>
                                                        <?php else: ?>
                                                            <span class="text-muted">No comments</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Charts Tab -->
                            <div class="tab-pane fade" id="charts" role="tabpanel" aria-labelledby="charts-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-report">
                                            <div class="card-header">
                                                <h6>Category Performance</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-container">
                                                    <canvas id="categoryChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-report">
                                            <div class="card-header">
                                                <h6>Performance Distribution</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-container">
                                                    <canvas id="performanceChart"></canvas>
                                                </div>
                                                <div class="chart-legend" id="performanceLegend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Summary View -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-report">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Subordinates Performance Summary</h5>
                                <span class="badge bg-secondary"><?= count($filteredScores) ?> Subordinates Evaluated</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <?php foreach ($filteredScores as $employeeId => $data): ?>
                                        <?php $employee = $data['details']; ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="card employee-card" onclick="window.location='subordinate_report.php?employee=<?= htmlspecialchars($employeeId) ?>'">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h5 class="card-title"><?= htmlspecialchars($employee['full_name'] ?? 'N/A') ?></h5>
                                                            <p class="card-text mb-1">
                                                                <small class="text-muted"><?= htmlspecialchars($employee['position_title'] ?? 'N/A') ?></small>
                                                            </p>
                                                            <p class="card-text mb-1">
                                                                <small class="text-muted"><?= htmlspecialchars($employee['department_name'] ?? 'N/A') ?></small>
                                                            </p>
                                                        </div>
                                                        <span class="performance-badge 
                                                        <?= $data['performance_category'] === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                                        <?= $data['performance_category'] === 'Developing' ? 'bg-developing' : '' ?>
                                                        <?= $data['performance_category'] === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                                        <?= $data['performance_category'] === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                                        <?= $data['performance_category'] === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                                            <?= htmlspecialchars($data['performance_category']) ?>
                                                        </span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span>Overall Score</span>
                                                            <span><?= round($data['weighted_score'], 1) ?>%</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <?php foreach ($data['perspective_counts'] as $perspective => $count): ?>
                                                            <?php if ($count > 0): ?>
                                                                <span class="badge bg-light text-dark me-1">
                                                                    <?= htmlspecialchars($perspective) ?>: <?= $count ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="mt-3">
                                                        <a href="subordinate_report.php?employee=<?= htmlspecialchars($employeeId) ?>" class="btn btn-sm btn-primary">View Full Report</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if (empty($filteredScores)): ?>
                                    <div class="alert alert-info">
                                        No evaluations found with the selected filters.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($individualReport)): ?>
        <script>
            // Category Performance Chart for Individual Report
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
                        label: 'Score (%)',
                        data: [
                            <?= round($individualReport['category_scores']['Job Knowledge and Technical Skills']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Quality of Work']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Productivity and Efficiency']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Communication Skills']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Teamwork and Collaboration']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Problem-Solving and Initiative']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Professionalism and Work Ethic']['percentage'], 1) ?>,
                            <?= round($individualReport['category_scores']['Adaptability and Continuous Improvement']['percentage'], 1) ?>
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
                            }
                        },
                        datalabels: {
                            color: '#000',
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
                                }
                            }
                        }
                    }
                }
            });

            // Performance Distribution Chart for Individual Report
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
                            <?= $individualReport['performance_category'] === 'Needs Significant Improvement' ? 1 : 0 ?>,
                            <?= $individualReport['performance_category'] === 'Developing' ? 1 : 0 ?>,
                            <?= $individualReport['performance_category'] === 'Meets Expectations' ? 1 : 0 ?>,
                            <?= $individualReport['performance_category'] === 'Exceeds Expectations' ? 1 : 0 ?>,
                            <?= $individualReport['performance_category'] === 'Outstanding' ? 1 : 0 ?>
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
                            labels: {
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map(function(label, i) {
                                            const value = data.datasets[0].data[i];
                                            const percentage = Math.round((value / data.datasets[0].data.reduce((a, b) => a + b, 0)) * 100);
                                            return {
                                                text: `${label}: ${value} (${percentage}%)`,
                                                fillStyle: data.datasets[0].backgroundColor[i],
                                                strokeStyle: data.datasets[0].backgroundColor[i],
                                                lineWidth: 1,
                                                hidden: isNaN(data.datasets[0].data[i]) || chart.getDatasetMeta(0).data[i].hidden,
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
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        },
                        datalabels: {
                            color: '#fff',
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
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>