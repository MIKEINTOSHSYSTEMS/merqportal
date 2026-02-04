<?php
// sendreport.php - Send performance reports via email
require_once '../includes/config.php';
require_once '../includes/auth_check.php';
require_once '../includes/SettingsManager.php';
require_once '../includes/EmailSender.php';
require_once '../includes/EmailTemplates.php';

// Check if this is an AJAX request for sending own report
$isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Get the requested employee ID
$requestedEmployeeId = intval($_POST['employee_id'] ?? $_GET['employee'] ?? 0);
$currentUserId = $_SESSION['user_id'];

// Permission check: Allow if user is admin OR sending their own report
if (!canManagePermissions($currentUserId) && $requestedEmployeeId != $currentUserId) {
    if ($isAjaxRequest) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Access denied. You can only send your own report.']);
    } else {
        header('Location: dashboard.php?error=access_denied');
    }
    exit;
}

// Initialize settings manager and email sender
$settingsManager = new SettingsManager();
$emailSender = new EmailSender($settingsManager);

// Get all employees
$employees = getEmployeesFromDatabase();

// Get evaluation data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Get all CEO feedback
$allCEOFeedback = [];
foreach ($employees as $employeeId => $employee) {
    $allCEOFeedback[$employeeId] = getCEOFeedback($employeeId, false);
}

// Handle AJAX requests
if ($isAjaxRequest) {
    $action = $_POST['action'] ?? '';
    $employeeId = intval($_POST['employee_id'] ?? 0);
    
    // Validate: User can only send their own report unless they're admin
    if (!canManagePermissions($currentUserId) && $employeeId != $currentUserId) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'You can only send your own report.']);
        exit;
    }
    
    if ($action === 'send_single' && $employeeId && isset($employees[$employeeId])) {
        $result = $emailSender->sendPerformanceReport(
            $employeeId,
            $employees[$employeeId],
            $employeeEvaluations[$employeeId] ?? null,
            $allCEOFeedback[$employeeId] ?? []
        );
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    // Return JSON for any AJAX request
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid AJAX request']);
    exit;
}

// Handle regular form submission (non-AJAX) - only for admins
if (!canManagePermissions($_SESSION['user_id'])) {
    header('Location: dashboard.php?error=access_denied');
    exit;
}

// Handle form submission
$results = [];
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'send_single':
            $employeeId = intval($_POST['employee_id'] ?? 0);
            if ($employeeId && isset($employees[$employeeId])) {
                $result = $emailSender->sendPerformanceReport(
                    $employeeId,
                    $employees[$employeeId],
                    $employeeEvaluations[$employeeId] ?? null,
                    $allCEOFeedback[$employeeId] ?? []
                );

                if ($result['success']) {
                    $message = "Report sent successfully to " . htmlspecialchars($employees[$employeeId]['full_name']);
                    $messageType = 'success';
                } else {
                    $message = "Failed to send report: " . $result['message'];
                    $messageType = 'error';
                }
            }
            break;

        case 'send_selected':
            $selectedEmployees = $_POST['selected_employees'] ?? [];
            if (!empty($selectedEmployees)) {
                $employeeIds = array_map('intval', $selectedEmployees);
                $result = $emailSender->sendBatchReports($employeeIds);

                if ($result['success']) {
                    $message = "Sent {$result['sent']} out of {$result['total']} reports successfully";
                    $messageType = 'success';
                } else {
                    $message = "Sent {$result['sent']} out of {$result['total']} reports. {$result['failed']} failed.";
                    $messageType = $result['sent'] > 0 ? 'warning' : 'error';
                }

                $results = $result['details'];
            } else {
                $message = "Please select at least one employee";
                $messageType = 'error';
            }
            break;

        case 'send_all':
            $allEmployeeIds = array_keys($employees);
            $result = $emailSender->sendBatchReports($allEmployeeIds);

            if ($result['success']) {
                $message = "Sent all {$result['total']} reports successfully";
                $messageType = 'success';
            } else {
                $message = "Sent {$result['sent']} out of {$result['total']} reports. {$result['failed']} failed.";
                $messageType = $result['sent'] > 0 ? 'warning' : 'error';
            }

            $results = $result['details'];
            break;

        case 'test_preview':
            $employeeId = intval($_POST['preview_employee_id'] ?? 0);
            if ($employeeId && isset($employees[$employeeId])) {
                // Store preview data in session for display
                $_SESSION['email_preview'] = [
                    'employee' => $employees[$employeeId],
                    'report' => $employeeEvaluations[$employeeId] ?? null,
                    'feedback' => $allCEOFeedback[$employeeId] ?? []
                ];
                header('Location: sendreport.php?preview=1');
                exit;
            }
            break;
    }
}

// Check if we're showing a preview
$showPreview = isset($_GET['preview']) && $_GET['preview'] == 1;
$previewData = $_SESSION['email_preview'] ?? null;
if ($previewData) {
    $emailTemplates = new EmailTemplates($settingsManager);
    $previewTemplate = $emailTemplates->getPerformanceReportTemplate(
        $previewData['employee'],
        $previewData['report'],
        $previewData['feedback'],
        $emailSender->generateLoginUrl($previewData['employee']['user_id'] ?? 0)
    );

    // Clear preview data after displaying
    unset($_SESSION['email_preview']);
}

require_once '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Reports via Email - MERQ Performance Evaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #07c9e9;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
        }

        .sendreport-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 50px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            margin-bottom: 2rem;
        }

        .action-card {
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
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .btn-send {
            background: linear-gradient(135deg, #198754 0%, #136b3f 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
        }

        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(25, 135, 84, 0.2);
        }

        .btn-preview {
            background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
            color: white;
            border: none;
        }

        .btn-test {
            background: linear-gradient(135deg, #ffc107 0%, #e6ac00 100%);
            color: black;
            border: none;
        }

        .employee-selector {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
        }

        .employee-item {
            padding: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }

        .employee-item:hover {
            background-color: #f8f9fa;
        }

        .employee-item:last-child {
            border-bottom: none;
        }

        .email-preview {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            max-height: 600px;
            overflow-y: auto;
        }

        .result-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .select-all-checkbox {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .stats-number {
                font-size: 1.5rem;
            }

            .employee-selector {
                max-height: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="sendreport-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-paper-plane me-3"></i>Send Reports via Email
                    </h1>
                    <p class="lead mb-0">
                        Send performance evaluation reports and CEO feedback to employees via email
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
        <?php if ($message): ?>
            <div class="alert alert-<?= $messageType === 'success' ? 'success' : ($messageType === 'warning' ? 'warning' : 'danger') ?> alert-dismissible fade show">
                <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : ($messageType === 'warning' ? 'exclamation-triangle' : 'exclamation-circle') ?> me-2"></i>
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Email Configuration Status -->
        <?php $emailConfig = $emailSender->getConfigStatus(); ?>
        <div class="action-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-2"><i class="fas fa-envelope me-2"></i>Email Configuration Status</h5>
                    <p class="mb-0 text-muted">
                        <?php if ($emailConfig['configured']): ?>
                            <span class="text-success"><i class="fas fa-check-circle me-1"></i>SMTP configured</span>
                        <?php else: ?>
                            <span class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>Using PHP mail() as fallback</span>
                        <?php endif; ?>
                        • Sender: <?= htmlspecialchars($settingsManager->getSettingValue('from_email')) ?>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="settings.php#email" class="btn btn-outline-primary">
                        <i class="fas fa-cog me-2"></i>Configure Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number"><?= count($employees) ?></div>
                    <div class="stats-label">Total Employees</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($employeeEvaluations, function ($eval) {
                            return !empty($eval);
                        })) ?>
                    </div>
                    <div class="stats-label">Evaluated Employees</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($allCEOFeedback, function ($feedback) {
                            return !empty($feedback);
                        })) ?>
                    </div>
                    <div class="stats-label">With CEO Feedback</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <?php
                    $emailsConfigured = 0;
                    foreach ($employees as $employee) {
                        if (!empty($employee['email'])) {
                            $emailsConfigured++;
                        }
                    }
                    ?>
                    <div class="stats-number"><?= $emailsConfigured ?></div>
                    <div class="stats-label">Email Configured</div>
                </div>
            </div>
        </div>

        <?php if ($showPreview && $previewTemplate): ?>
            <!-- Email Preview -->
            <div class="action-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5><i class="fas fa-eye me-2"></i>Email Preview</h5>
                    <a href="sendreport.php" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Close Preview
                    </a>
                </div>

                <div class="email-preview">
                    <?= $previewTemplate['html'] ?>
                </div>

                <div class="mt-3">
                    <p><strong>Subject:</strong> <?= htmlspecialchars($previewTemplate['subject']) ?></p>
                    <p><strong>Recipient:</strong> <?= htmlspecialchars($previewData['employee']['full_name']) ?> &lt;<?= htmlspecialchars($previewData['employee']['email']) ?>&gt;</p>
                </div>

                <div class="text-center mt-4">
                    <form method="POST">
                        <input type="hidden" name="action" value="send_single">
                        <input type="hidden" name="employee_id" value="<?= $previewData['employee']['user_id'] ?>">
                        <button type="submit" class="btn btn-send">
                            <i class="fas fa-paper-plane me-2"></i>Send to <?= htmlspecialchars($previewData['employee']['full_name']) ?>
                        </button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Batch Actions -->
            <div class="action-card">
                <h5 class="mb-4"><i class="fas fa-users me-2"></i>Batch Actions</h5>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <form method="POST" class="h-100">
                            <input type="hidden" name="action" value="send_all">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fs-1 text-primary mb-3"></i>
                                    <h5 class="card-title">Send to All Employees</h5>
                                    <p class="card-text text-muted">Send reports to all <?= count($employees) ?> employees</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <button type="submit" class="btn btn-send w-100" onclick="return confirm('Send reports to ALL <?= count($employees) ?> employees?')">
                                        <i class="fas fa-paper-plane me-2"></i>Send All
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-user-check fs-1 text-success mb-3"></i>
                                <h5 class="card-title">Send to Selected</h5>
                                <p class="card-text text-muted">Select specific employees to receive reports</p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <button type="button" class="btn btn-send w-100" data-bs-toggle="modal" data-bs-target="#selectEmployeesModal">
                                    <i class="fas fa-list-check me-2"></i>Select Employees
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-eye fs-1 text-info mb-3"></i>
                                <h5 class="card-title">Preview Email</h5>
                                <p class="card-text text-muted">Preview what the email will look like</p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <button type="button" class="btn btn-preview w-100" data-bs-toggle="modal" data-bs-target="#previewModal">
                                    <i class="fas fa-eye me-2"></i>Preview Template
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Individual Employee Actions -->
            <div class="action-card">
                <h5 class="mb-4"><i class="fas fa-user me-2"></i>Individual Employee Actions</h5>

                <div class="table-responsive">
                    <table id="employeesTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Score</th>
                                <th>CEO Feedback</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employeeId => $employee): ?>
                                <?php
                                $evaluation = $employeeEvaluations[$employeeId] ?? null;
                                $feedback = $allCEOFeedback[$employeeId] ?? [];
                                $hasEmail = !empty($employee['email']);
                                $hasEvaluation = !empty($evaluation);
                                $hasFeedback = !empty($feedback);
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($employee['full_name']) ?>&background=007bff&color=fff&size=32"
                                                alt="<?= htmlspecialchars($employee['full_name']) ?>"
                                                class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <strong><?= htmlspecialchars($employee['full_name']) ?></strong>
                                                <br>
                                                <small class="text-muted">ID: <?= $employeeId ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($employee['position_title'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($employee['department_name'] ?? 'N/A') ?></td>
                                    <td>
                                        <?php if ($evaluation): ?>
                                            <span class="badge bg-<?=
                                                                    $evaluation['weighted_score'] < 30 ? 'danger' : ($evaluation['weighted_score'] < 60 ? 'warning' : ($evaluation['weighted_score'] < 75 ? 'info' : ($evaluation['weighted_score'] < 90 ? 'primary' : 'success'))) ?>">
                                                <?= round($evaluation['weighted_score'] ?? 0, 1) ?>%
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">No data</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($hasFeedback): ?>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-comment me-1"></i>
                                                <?= count($feedback) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-dark">None</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($hasEmail): ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>
                                                <?= htmlspecialchars($employee['email']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">No email</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="action" value="send_single">
                                                <input type="hidden" name="employee_id" value="<?= $employeeId ?>">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    <?= !$hasEmail || !$hasEvaluation ? 'disabled title="Missing email or evaluation data"' : '' ?>>
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            </form>

                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="action" value="test_preview">
                                                <input type="hidden" name="preview_employee_id" value="<?= $employeeId ?>">
                                                <button type="submit" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Results Section -->
        <?php if (!empty($results)): ?>
            <div class="action-card">
                <h5 class="mb-4"><i class="fas fa-clipboard-check me-2"></i>Send Results</h5>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $employeeId => $result): ?>
                                <?php $employee = $employees[$employeeId] ?? ['full_name' => 'Unknown', 'email' => '']; ?>
                                <tr>
                                    <td><?= htmlspecialchars($employee['full_name']) ?></td>
                                    <td><?= htmlspecialchars($employee['email']) ?></td>
                                    <td>
                                        <span class="badge result-badge bg-<?= $result['success'] ? 'success' : 'danger' ?>">
                                            <?= $result['success'] ? 'Sent' : 'Failed' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small><?= htmlspecialchars($result['message']) ?> (<?= $result['method'] ?? 'N/A' ?>)</small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Select Employees Modal -->
    <div class="modal fade" id="selectEmployeesModal" tabindex="-1" aria-labelledby="selectEmployeesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="selectEmployeesModalLabel">Select Employees</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="selectedEmployeesForm">
                    <input type="hidden" name="action" value="send_selected">

                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllEmployees">
                                <label class="form-check-label" for="selectAllEmployees">
                                    <strong>Select All Employees</strong>
                                </label>
                            </div>
                        </div>

                        <div class="employee-selector">
                            <?php foreach ($employees as $employeeId => $employee): ?>
                                <?php
                                $evaluation = $employeeEvaluations[$employeeId] ?? null;
                                $hasEmail = !empty($employee['email']);
                                $hasEvaluation = !empty($evaluation);
                                $canSend = $hasEmail && $hasEvaluation;
                                ?>
                                <div class="employee-item">
                                    <div class="form-check">
                                        <input class="form-check-input employee-checkbox" type="checkbox"
                                            name="selected_employees[]" value="<?= $employeeId ?>"
                                            id="employee_<?= $employeeId ?>"
                                            <?= !$canSend ? 'disabled' : '' ?>>
                                        <label class="form-check-label w-100" for="employee_<?= $employeeId ?>">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong><?= htmlspecialchars($employee['full_name']) ?></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?= htmlspecialchars($employee['position_title'] ?? 'N/A') ?> •
                                                        <?= htmlspecialchars($employee['department_name'] ?? 'N/A') ?>
                                                    </small>
                                                </div>
                                                <div class="text-end">
                                                    <?php if ($hasEmail && $hasEvaluation): ?>
                                                        <span class="badge bg-success">Ready</span>
                                                    <?php elseif (!$hasEmail): ?>
                                                        <span class="badge bg-danger">No email</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning">No evaluation</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-3">
                            <p><strong>Selected:</strong> <span id="selectedCount">0</span> out of <?= count($employees) ?> employees</p>
                            <p><strong>Ready to send:</strong> <span id="readyCount">0</span> employees</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-send" id="sendSelectedBtn" disabled>
                            <i class="fas fa-paper-plane me-2"></i>Send to Selected
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="previewModalLabel">Preview Email Template</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="previewForm">
                    <input type="hidden" name="action" value="test_preview">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="preview_employee_id" class="form-label">Select Employee for Preview</label>
                            <select class="form-select" id="preview_employee_id" name="preview_employee_id" required>
                                <option value="">-- Select an employee --</option>
                                <?php foreach ($employees as $employeeId => $employee): ?>
                                    <?php if (!empty($employee['email']) && isset($employeeEvaluations[$employeeId])): ?>
                                        <option value="<?= $employeeId ?>">
                                            <?= htmlspecialchars($employee['full_name']) ?> (<?= htmlspecialchars($employee['position_title'] ?? 'N/A') ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            This will show you exactly what the email will look like when sent to the employee.
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-preview">
                            <i class="fas fa-eye me-2"></i>Preview Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#employeesTable').DataTable({
                pageLength: 25,
                order: [
                    [0, 'asc']
                ],
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    targets: [6]
                }],
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

            // Select all functionality in modal
            $('#selectAllEmployees').change(function() {
                const isChecked = $(this).prop('checked');
                $('.employee-checkbox:not(:disabled)').prop('checked', isChecked);
                updateSelectionCounts();
            });

            // Update selection counts
            function updateSelectionCounts() {
                const totalCheckboxes = $('.employee-checkbox').length;
                const selectedCheckboxes = $('.employee-checkbox:checked').length;
                const enabledCheckboxes = $('.employee-checkbox:not(:disabled)').length;
                const readyCheckboxes = $('.employee-checkbox:not(:disabled):checked').length;

                $('#selectedCount').text(selectedCheckboxes);
                $('#readyCount').text(readyCheckboxes);

                // Enable/disable send button
                $('#sendSelectedBtn').prop('disabled', readyCheckboxes === 0);
            }

            // Update counts when checkboxes change
            $('.employee-checkbox').change(updateSelectionCounts);

            // Initial count update
            updateSelectionCounts();

            // Modal show event
            $('#selectEmployeesModal').on('show.bs.modal', function() {
                updateSelectionCounts();
            });

            // Form validation for preview
            $('#previewForm').submit(function(e) {
                const employeeId = $('#preview_employee_id').val();
                if (!employeeId) {
                    e.preventDefault();
                    alert('Please select an employee for preview.');
                    return false;
                }
            });

            // Confirm before sending to all
            $('form[action*="send_all"]').submit(function(e) {
                if (!confirm('Are you sure you want to send emails to ALL employees? This may take several minutes.')) {
                    e.preventDefault();
                    return false;
                }

                // Show loading state
                const btn = $(this).find('button[type="submit"]');
                const originalText = btn.html();
                btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...');
                btn.prop('disabled', true);

                // Re-enable after 5 seconds (in case of failure)
                setTimeout(() => {
                    btn.html(originalText);
                    btn.prop('disabled', false);
                }, 5000);
            });

            // Single send confirmation
            $('form[action*="send_single"]').submit(function(e) {
                const employeeId = $(this).find('input[name="employee_id"]').val();
                const employeeName = $(this).closest('tr').find('td:first-child strong').text().trim();

                if (!confirm(`Send report to ${employeeName}?`)) {
                    e.preventDefault();
                    return false;
                }

                // Show loading state
                const btn = $(this).find('button[type="submit"]');
                const originalText = btn.html();
                btn.html('<i class="fas fa-spinner fa-spin"></i>');
                btn.prop('disabled', true);

                // Re-enable after 3 seconds
                setTimeout(() => {
                    btn.html(originalText);
                    btn.prop('disabled', false);
                }, 3000);
            });

            // Batch send confirmation
            $('#selectedEmployeesForm').submit(function(e) {
                const selectedCount = $('.employee-checkbox:not(:disabled):checked').length;

                if (!confirm(`Send reports to ${selectedCount} selected employees?`)) {
                    e.preventDefault();
                    return false;
                }

                // Show loading state
                const btn = $('#sendSelectedBtn');
                const originalText = btn.html();
                btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...');
                btn.prop('disabled', true);

                // Re-enable after 5 seconds
                setTimeout(() => {
                    btn.html(originalText);
                    btn.prop('disabled', false);
                }, 5000);
            });
        });
    </script>
</body>

</html>