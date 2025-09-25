<?php
// admin/settings.php
require_once 'config.php';
require_once 'SettingsManager.php';

// Check authentication
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/session-config.php';
}

require_once 'auth_check.php';

// Initialize settings manager
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$settingsManager = new SettingsManager($conn);

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settingsToUpdate = [];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'setting_') === 0) {
            $settingName = substr($key, 8); // Remove 'setting_' prefix
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
}

// Get all settings
$settings = $settingsManager->getAllSettings();

// Include header
$currentPage = 'settings.php';
require_once 'header.php';
?>

<style>
    .nav-tabs .nav-link {
        display: flex;
        align-items: center;
    }

    .nav-tabs .nav-link i {
        margin-right: 8px;
    }

    .row {
        padding-top: 69px;
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-.5 * var(--bs-gutter-x));
        margin-left: calc(-.5 * var(--bs-gutter-x));
    }
</style>


<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-cog me-2"></i>Evaluation Settings</h1>
        </div>

        <?php if ($message): ?>
            <div class="alert alert-<?= $messageType === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST" id="settingsForm">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="fas fa-sliders-h me-1"></i>General
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab">
                                <i class="fas fa-calendar-alt me-1"></i>Schedule
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab">
                                <i class="fas fa-envelope me-1"></i>Email Settings
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="settingsTabsContent">

                        <!-- General Settings Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Evaluation Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="setting_evaluation_active"
                                                value="1" <?= $settings['evaluation_active']['value'] ? 'checked' : '' ?>>
                                            <label class="form-check-label">
                                                Enable evaluation system
                                            </label>
                                        </div>
                                        <small class="form-text text-muted"><?= $settings['evaluation_active']['description'] ?></small>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="setting_allow_self_evaluation"
                                                value="1" <?= $settings['allow_self_evaluation']['value'] ? 'checked' : '' ?>>
                                            <label class="form-check-label">
                                                Allow self-evaluations
                                            </label>
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
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="redirect_url" class="form-label">Redirect URL</label>
                                        <input type="url" class="form-control" id="redirect_url" name="setting_redirect_url"
                                            value="<?= htmlspecialchars($settings['redirect_url']['value']) ?>" required>
                                        <small class="form-text text-muted"><?= $settings['redirect_url']['description'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Settings Tab -->
                        <div class="tab-pane fade" id="schedule" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="evaluation_start_date" class="form-label">Evaluation Start Date</label>
                                        <input type="datetime-local" class="form-control" id="evaluation_start_date"
                                            name="setting_evaluation_start_date"
                                            value="<?= $settings['evaluation_start_date']['value'] ? date('Y-m-d\TH:i', strtotime($settings['evaluation_start_date']['value'])) : '' ?>">
                                        <small class="form-text text-muted">Leave empty for immediate availability</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="evaluation_end_date" class="form-label">Evaluation End Date</label>
                                        <input type="datetime-local" class="form-control" id="evaluation_end_date"
                                            name="setting_evaluation_end_date"
                                            value="<?= $settings['evaluation_end_date']['value'] ? date('Y-m-d\TH:i', strtotime($settings['evaluation_end_date']['value'])) : '' ?>">
                                        <small class="form-text text-muted">Leave empty for no end date</small>
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

                                <?php if ($settings['evaluation_start_date']['value']): ?>
                                    <br><strong>Start:</strong> <?= date('F j, Y g:i A', strtotime($settings['evaluation_start_date']['value'])) ?>
                                <?php endif; ?>

                                <?php if ($settings['evaluation_end_date']['value']): ?>
                                    <br><strong>End:</strong> <?= date('F j, Y g:i A', strtotime($settings['evaluation_end_date']['value'])) ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Email Settings Tab -->
                        <div class="tab-pane fade" id="email" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>SMTP Settings</h5>

                                    <div class="mb-3">
                                        <label for="smtp_host" class="form-label">SMTP Host</label>
                                        <input type="text" class="form-control" id="smtp_host" name="setting_smtp_host"
                                            value="<?= htmlspecialchars($settings['smtp_host']['value']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="smtp_port" class="form-label">SMTP Port</label>
                                        <input type="number" class="form-control" id="smtp_port" name="setting_smtp_port"
                                            value="<?= htmlspecialchars($settings['smtp_port']['value']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="smtp_username" class="form-label">SMTP Username</label>
                                        <input type="text" class="form-control" id="smtp_username" name="setting_smtp_username"
                                            value="<?= htmlspecialchars($settings['smtp_username']['value']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="smtp_password" class="form-label">SMTP Password</label>
                                        <input type="password" class="form-control" id="smtp_password" name="setting_smtp_password"
                                            value="<?= htmlspecialchars($settings['smtp_password']['value']) ?>">
                                        <small class="form-text text-muted">Leave blank to keep current password</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5>Email Templates</h5>

                                    <div class="mb-3">
                                        <label for="from_email" class="form-label">From Email</label>
                                        <input type="email" class="form-control" id="from_email" name="setting_from_email"
                                            value="<?= htmlspecialchars($settings['from_email']['value']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="from_name" class="form-label">From Name</label>
                                        <input type="text" class="form-control" id="from_name" name="setting_from_name"
                                            value="<?= htmlspecialchars($settings['from_name']['value']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="notification_subject" class="form-label">Notification Subject</label>
                                        <input type="text" class="form-control" id="notification_subject" name="setting_notification_subject"
                                            value="<?= htmlspecialchars($settings['notification_subject']['value']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="auto_reminder_days" class="form-label">Auto Reminder (Days)</label>
                                        <input type="number" class="form-control" id="auto_reminder_days" name="setting_auto_reminder_days"
                                            value="<?= htmlspecialchars($settings['auto_reminder_days']['value']) ?>">
                                        <small class="form-text text-muted">Days before sending automatic reminders</small>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notification_template" class="form-label">Notification Template</label>
                                <textarea class="form-control" id="notification_template" name="setting_notification_template"
                                    rows="6"><?= htmlspecialchars($settings['notification_template']['value']) ?></textarea>
                                <small class="form-text text-muted">
                                    Available variables: {employee_name}, {due_date}, {evaluation_period}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Settings
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo me-1"></i>Reset to Defaults
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function resetForm() {
        if (confirm('Are you sure you want to reset all settings to their default values?')) {
            // You can implement a reset functionality here
            // This would require additional server-side logic
            alert('Reset functionality would be implemented here');
        }
    }

    // Form validation
    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        const startDate = document.getElementById('evaluation_start_date').value;
        const endDate = document.getElementById('evaluation_end_date').value;

        if (startDate && endDate && new Date(startDate) >= new Date(endDate)) {
            e.preventDefault();
            alert('End date must be after start date!');
            return false;
        }
    });
</script>

<?php
// Include footer
require_once 'footer.php';
?>