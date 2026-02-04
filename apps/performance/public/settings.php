<?php
// settings.php - System settings management
require_once '../includes/config.php';
require_once '../includes/auth_check.php';
require_once '../includes/SettingsManager.php';
require_once '../includes/EmailSender.php';
require_once '../includes/EmailTemplates.php';

// Check if user is the main admin (user_id = 1 only)
if ($_SESSION['user_id'] != 1) {
    header('Location: dashboard.php?error=access_denied_settings');
    exit;
}

// Check if user is admin
if (!canManagePermissions($_SESSION['user_id'])) {
    header('Location: dashboard.php?error=access_denied');
    exit;
}

// Initialize settings manager
$settingsManager = new SettingsManager();
$emailSender = new EmailSender($settingsManager);

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'save_settings':
            $settingsToUpdate = [];

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'setting_') === 0) {
                    $settingName = substr($key, 8);
                    $settingsToUpdate[$settingName] = $value;
                }
            }

            if ($settingsManager->updateSettings($settingsToUpdate)) {
                $message = 'Settings updated successfully!';
                $messageType = 'success';
            } else {
                $message = 'Error updating settings. Please try again.';
                $messageType = 'error';
            }
            break;

        case 'test_email':
            $testEmail = $_POST['test_email'] ?? '';
            if (filter_var($testEmail, FILTER_VALIDATE_EMAIL)) {
                $result = $emailSender->testEmailConfig($testEmail);

                // Log the result for debugging
                error_log("Test email result: " . print_r($result, true));

                if ($result['success']) {
                    $message = 'Test email sent successfully! Please check your inbox.';
                    $messageType = 'success';
                } else {
                    $message = 'Failed to send test email: ' . htmlspecialchars($result['message']);
                    $messageType = 'error';
                }
            } else {
                $message = 'Please enter a valid email address for testing.';
                $messageType = 'error';
            }
            break;

        case 'clear_cache':
            if (clearAllCache()) {
                $message = 'Cache cleared successfully!';
                $messageType = 'success';
            } else {
                $message = 'Failed to clear cache.';
                $messageType = 'error';
            }
            break;
    }
}

// Get all settings
$settings = $settingsManager->getAllSettings();
$emailConfigStatus = $emailSender->getConfigStatus();

require_once '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - MERQ Performance Evaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #07c9e9;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
        }

        .settings-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 50px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            margin-bottom: 2rem;
        }

        .settings-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .config-status {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .status-good {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .nav-tabs .nav-link {
            color: var(--primary-color);
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-save {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 51, 102, 0.2);
        }

        .btn-test {
            background: linear-gradient(135deg, #20c997 0%, #19a97d 100%);
            color: white;
            border: none;
        }

        .btn-clear {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
            border: none;
        }

        .setting-description {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="settings-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-cog me-3"></i>System Settings
                    </h1>
                    <p class="lead mb-0">
                        Configure system preferences, email settings, and performance evaluation parameters
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
            <div class="alert alert-<?= $messageType === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Configuration Status -->
        <div class="settings-card">
            <h4 class="mb-3"><i class="fas fa-info-circle me-2"></i>System Status</h4>

            <div class="row">
                <div class="col-md-3">
                    <div class="config-status <?= $settingsManager->isEvaluationActive() ? 'status-good' : 'status-warning' ?>">
                        <h6><i class="fas fa-toggle-<?= $settingsManager->isEvaluationActive() ? 'on' : 'off' ?> me-2"></i>Evaluation Status</h6>
                        <p class="mb-0">
                            <?= $settingsManager->isEvaluationActive() ? 'Active' : 'Inactive' ?>
                            <?php if (!$settingsManager->isEvaluationActive()): ?>
                                <br><small>Users will be redirected to: <?= $settingsManager->getRedirectUrl() ?></small>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="config-status <?= $emailConfigStatus['configured'] ? 'status-good' : 'status-warning' ?>">
                        <h6><i class="fas fa-envelope me-2"></i>Email Configuration</h6>
                        <p class="mb-0">
                            <?= $emailConfigStatus['method'] ?>
                            <br>
                            <small>PHPMailer: <?= $emailConfigStatus['phpmailer_loaded'] ? '✓ Loaded' : '✗ Not found' ?></small>
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="config-status">
                        <h6><i class="fas fa-database me-2"></i>Cache Status</h6>
                        <p class="mb-0">
                            <?php $cacheStats = getCacheStats(); ?>
                            <?= $cacheStats['files'] ?> files (<?= $cacheStats['size'] ?>)
                            <br><small>TTL: <?= $cacheStats['ttl'] ?></small>
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="config-status">
                        <h6><i class="fas fa-server me-2"></i>SMTP Server</h6>
                        <p class="mb-0">
                            <?= !empty($emailConfigStatus['smtp_host']) ? htmlspecialchars($emailConfigStatus['smtp_host']) : 'Not configured' ?>
                            <br><small>Port: <?= !empty($emailConfigStatus['smtp_port']) ? htmlspecialchars($emailConfigStatus['smtp_port']) : 'N/A' ?></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Form -->
        <form method="POST" id="settingsForm">
            <input type="hidden" name="action" value="save_settings">

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                        <i class="fas fa-sliders-h me-2"></i>General
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab">
                        <i class="fas fa-calendar-alt me-2"></i>Schedule
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab">
                        <i class="fas fa-envelope me-2"></i>Email Settings
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tools-tab" data-bs-toggle="tab" data-bs-target="#tools" type="button" role="tab">
                        <i class="fas fa-tools me-2"></i>Tools
                    </button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="settingsTabsContent">
                <!-- General Settings Tab -->
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="settings-card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required-field">Evaluation Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="setting_evaluation_active"
                                            value="1" <?= $settings['evaluation_active']['value'] ? 'checked' : '' ?>>
                                        <label class="form-check-label">
                                            Enable evaluation system
                                        </label>
                                    </div>
                                    <div class="setting-description">
                                        <?= $settings['evaluation_active']['description'] ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="setting_allow_self_evaluation"
                                            value="1" <?= $settings['allow_self_evaluation']['value'] ? 'checked' : '' ?>>
                                        <label class="form-check-label">
                                            Allow self-evaluations
                                        </label>
                                    </div>
                                    <div class="setting-description">
                                        Allow employees to submit self-evaluations
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="setting_allow_multiple_submissions"
                                            value="1" <?= $settings['allow_multiple_submissions']['value'] ? 'checked' : '' ?>>
                                        <label class="form-check-label">
                                            Allow multiple submissions
                                        </label>
                                    </div>
                                    <div class="setting-description">
                                        Allow multiple evaluation submissions per employee
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="redirect_url" class="form-label required-field">Redirect URL</label>
                                    <input type="url" class="form-control" id="redirect_url" name="setting_redirect_url"
                                        value="<?= htmlspecialchars($settings['redirect_url']['value']) ?>" required>
                                    <div class="setting-description">
                                        <?= $settings['redirect_url']['description'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Settings Tab -->
                <div class="tab-pane fade" id="schedule" role="tabpanel">
                    <div class="settings-card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="evaluation_start_date" class="form-label">Evaluation Start Date</label>
                                    <input type="datetime-local" class="form-control" id="evaluation_start_date"
                                        name="setting_evaluation_start_date"
                                        value="<?= !empty($settings['evaluation_start_date']['value']) ?
                                                    date('Y-m-d\TH:i', strtotime($settings['evaluation_start_date']['value'])) : '' ?>">
                                    <div class="setting-description">
                                        When the evaluation period begins (leave empty for immediate)
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="evaluation_end_date" class="form-label">Evaluation End Date</label>
                                    <input type="datetime-local" class="form-control" id="evaluation_end_date"
                                        name="setting_evaluation_end_date"
                                        value="<?= !empty($settings['evaluation_end_date']['value']) ?
                                                    date('Y-m-d\TH:i', strtotime($settings['evaluation_end_date']['value'])) : '' ?>">
                                    <div class="setting-description">
                                        When the evaluation period ends (leave empty for no end date)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Current Status:</strong>
                            <?php if ($settingsManager->isEvaluationActive()): ?>
                                <span class="text-success">Evaluation is ACTIVE</span>
                            <?php else: ?>
                                <span class="text-danger">Evaluation is INACTIVE</span>
                            <?php endif; ?>

                            <?php if (!empty($settings['evaluation_start_date']['value'])): ?>
                                <br><strong>Start:</strong> <?= date('F j, Y g:i A', strtotime($settings['evaluation_start_date']['value'])) ?>
                            <?php endif; ?>

                            <?php if (!empty($settings['evaluation_end_date']['value'])): ?>
                                <br><strong>End:</strong> <?= date('F j, Y g:i A', strtotime($settings['evaluation_end_date']['value'])) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Email Settings Tab -->
                <div class="tab-pane fade" id="email" role="tabpanel">
                    <div class="settings-card">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-4"><i class="fas fa-server me-2"></i>SMTP Configuration</h5>

                                <div class="mb-3">
                                    <label for="smtp_host" class="form-label">SMTP Host</label>
                                    <input type="text" class="form-control" id="smtp_host" name="setting_smtp_host"
                                        value="<?= htmlspecialchars($settings['smtp_host']['value']) ?>"
                                        placeholder="smtp.gmail.com or smtp.yourdomain.com">
                                    <div class="setting-description">
                                        Your mail server address
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="smtp_port" class="form-label">SMTP Port</label>
                                    <input type="number" class="form-control" id="smtp_port" name="setting_smtp_port"
                                        value="<?= htmlspecialchars($settings['smtp_port']['value']) ?>"
                                        placeholder="587 for TLS, 465 for SSL">
                                    <div class="setting-description">
                                        Usually 587 (TLS) or 465 (SSL)
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="smtp_username" class="form-label">SMTP Username</label>
                                    <input type="text" class="form-control" id="smtp_username" name="setting_smtp_username"
                                        value="<?= htmlspecialchars($settings['smtp_username']['value']) ?>"
                                        placeholder="your-email@domain.com">
                                    <div class="setting-description">
                                        Your email address for authentication
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="smtp_password" class="form-label">SMTP Password</label>
                                    <input type="password" class="form-control" id="smtp_password" name="setting_smtp_password"
                                        value="<?= htmlspecialchars($settings['smtp_password']['value']) ?>"
                                        placeholder="Leave blank to keep current">
                                    <div class="setting-description">
                                        App password or email password (leave blank to keep current)
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-4"><i class="fas fa-envelope-open me-2"></i>Email Templates</h5>

                                <div class="mb-3">
                                    <label for="from_email" class="form-label required-field">From Email</label>
                                    <input type="email" class="form-control" id="from_email" name="setting_from_email"
                                        value="<?= htmlspecialchars($settings['from_email']['value']) ?>"
                                        placeholder="noreply@yourdomain.com" required>
                                    <div class="setting-description">
                                        Sender email address for all system emails
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="from_name" class="form-label required-field">From Name</label>
                                    <input type="text" class="form-control" id="from_name" name="setting_from_name"
                                        value="<?= htmlspecialchars($settings['from_name']['value']) ?>"
                                        placeholder="Your Company Name" required>
                                    <div class="setting-description">
                                        Display name for sender
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="notification_subject" class="form-label">Notification Subject</label>
                                    <input type="text" class="form-control" id="notification_subject" name="setting_notification_subject"
                                        value="<?= htmlspecialchars($settings['notification_subject']['value']) ?>"
                                        placeholder="Performance Evaluation Notification">
                                    <div class="setting-description">
                                        Default subject for notification emails
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="auto_reminder_days" class="form-label">Auto Reminder (Days)</label>
                                    <input type="number" class="form-control" id="auto_reminder_days" name="setting_auto_reminder_days"
                                        value="<?= htmlspecialchars($settings['auto_reminder_days']['value']) ?>"
                                        min="0" max="30">
                                    <div class="setting-description">
                                        Days before sending automatic reminders (0 to disable)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notification_template" class="form-label">Notification Template</label>
                            <textarea class="form-control" id="notification_template" name="setting_notification_template"
                                rows="6" placeholder="Dear {employee_name}, ..."><?= htmlspecialchars($settings['notification_template']['value']) ?></textarea>
                            <div class="setting-description">
                                Available variables: {employee_name}, {position}, {department}, {score}, {category}, {due_date}, {login_url}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tools Tab -->
                <div class="tab-pane fade" id="tools" role="tabpanel">
                    <div class="settings-card">
                        <h5 class="mb-4"><i class="fas fa-wrench me-2"></i>System Tools</h5>

                        <!-- Email Test -->
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Test Email Configuration</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Send a test email to verify your email configuration is working correctly.</p>

                                <form method="POST" class="row g-3">
                                    <input type="hidden" name="action" value="test_email">

                                    <div class="col-md-8">
                                        <label for="test_email" class="form-label">Test Email Address</label>
                                        <input type="email" class="form-control" id="test_email" name="test_email"
                                            placeholder="recipient@example.com" required>
                                    </div>

                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-test w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Send Test Email
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Cache Management -->
                        <div class="card mb-3">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0"><i class="fas fa-broom me-2"></i>Cache Management</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Clear cached data to ensure fresh information is loaded.</p>

                                <form method="POST">
                                    <input type="hidden" name="action" value="clear_cache">

                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Warning:</strong> Clearing cache will temporarily slow down the system as data needs to be reloaded from APIs and databases.
                                    </div>

                                    <button type="submit" class="btn btn-clear" onclick="return confirm('Are you sure you want to clear all cache? This will temporarily slow down the system.')">
                                        <i class="fas fa-trash-alt me-2"></i>Clear All Cache
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- System Information -->
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>System Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>PHP Version:</strong> <?= phpversion() ?></p>
                                        <p><strong>Server Software:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?></p>
                                        <p><strong>Database Host:</strong> <?= DB_HOST ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Cache Status:</strong> <?= CACHE_ENABLED ? 'Enabled' : 'Disabled' ?></p>
                                        <p><strong>Cache Files:</strong> <?= getCacheStats()['files'] ?></p>
                                        <p><strong>Cache Size:</strong> <?= getCacheStats()['size'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="settings-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save me-2"></i>Save All Settings
                        </button>
                        <button type="button" class="btn btn-outline-secondary ms-2" onclick="resetForm()">
                            <i class="fas fa-undo me-2"></i>Reset Changes
                        </button>
                    </div>
                    <div class="text-muted">
                        <small>Settings are automatically saved when you click "Save All Settings"</small>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const settingsForm = document.getElementById('settingsForm');
            if (settingsForm) {
                settingsForm.addEventListener('submit', function(e) {
                    const startDate = document.getElementById('evaluation_start_date').value;
                    const endDate = document.getElementById('evaluation_end_date').value;
                    const fromEmail = document.getElementById('from_email').value;

                    // Validate date range
                    if (startDate && endDate && new Date(startDate) >= new Date(endDate)) {
                        e.preventDefault();
                        alert('End date must be after start date!');
                        document.getElementById('evaluation_end_date').focus();
                        return false;
                    }

                    // Validate email format
                    if (fromEmail && !isValidEmail(fromEmail)) {
                        e.preventDefault();
                        alert('Please enter a valid email address for "From Email"');
                        document.getElementById('from_email').focus();
                        return false;
                    }

                    // Show loading state
                    const saveBtn = settingsForm.querySelector('.btn-save');
                    const originalText = saveBtn.innerHTML;
                    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                    saveBtn.disabled = true;

                    // Re-enable button after 3 seconds (in case submission fails)
                    setTimeout(() => {
                        saveBtn.innerHTML = originalText;
                        saveBtn.disabled = false;
                    }, 3000);
                });
            }

            // Password field toggle
            const smtpPassword = document.getElementById('smtp_password');
            if (smtpPassword) {
                const toggleBtn = document.createElement('button');
                toggleBtn.type = 'button';
                toggleBtn.className = 'btn btn-sm btn-outline-secondary position-absolute';
                toggleBtn.style.right = '10px';
                toggleBtn.style.top = '50%';
                toggleBtn.style.transform = 'translateY(-50%)';
                toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';

                smtpPassword.parentNode.style.position = 'relative';
                smtpPassword.style.paddingRight = '60px';
                smtpPassword.parentNode.appendChild(toggleBtn);

                toggleBtn.addEventListener('click', function() {
                    const type = smtpPassword.type === 'password' ? 'text' : 'password';
                    smtpPassword.type = type;
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }

            // Tab persistence
            const settingsTabs = document.getElementById('settingsTabs');
            if (settingsTabs) {
                const activeTab = localStorage.getItem('settingsActiveTab');
                if (activeTab) {
                    const tab = document.querySelector(`[data-bs-target="${activeTab}"]`);
                    if (tab) {
                        const tabInstance = new bootstrap.Tab(tab);
                        tabInstance.show();
                    }
                }

                settingsTabs.addEventListener('click', function(e) {
                    if (e.target.dataset.bsTarget) {
                        localStorage.setItem('settingsActiveTab', e.target.dataset.bsTarget);
                    }
                });
            }
        });

        // Reset form function
        function resetForm() {
            if (confirm('Are you sure you want to reset all changes? Any unsaved changes will be lost.')) {
                window.location.reload();
            }
        }

        // Email validation function
        function isValidEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    </script>
</body>

</html>