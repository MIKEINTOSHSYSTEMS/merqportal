<?php
// emailtest.php - Comprehensive Email Tester
require_once '../includes/config.php';
require_once '../includes/auth_check.php';
require_once '../includes/SettingsManager.php';
require_once '../includes/EmailSender.php';
require_once '../includes/EmailTemplates.php';

// Check if user is admin
if (!canManagePermissions($_SESSION['user_id'])) {
    header('Location: dashboard.php?error=access_denied');
    exit;
}

// Initialize settings manager and email sender
$settingsManager = new SettingsManager();
$emailSender = new EmailSender($settingsManager);

// Get current settings
$configStatus = $emailSender->getConfigStatus();
$smtpSettings = $emailSender->getSmtpSettings();


// Handle AJAX requests
$isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if ($isAjaxRequest) {
    header('Content-Type: application/json');

    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    switch ($action) {
        case 'test_basic':
            $testEmail = $_POST['test_email'] ?? '';
            $result = $emailSender->testEmailConfig($testEmail, 'basic');
            echo json_encode($result);
            break;

        case 'test_comprehensive':
            $testEmail = $_POST['test_email'] ?? '';
            $result = $emailSender->testEmailConfig($testEmail, 'comprehensive');
            echo json_encode($result);
            break;

        case 'check_connection':
            try {
                // Use reflection to access private method for testing
                $reflection = new ReflectionClass($emailSender);
                $method = $reflection->getMethod('testSMTPConnection');
                $method->setAccessible(true);
                $result = $method->invoke($emailSender);
                echo json_encode($result);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Connection test failed: ' . $e->getMessage()
                ]);
            }
            break;

        case 'check_phpmailer':
            $loaded = $emailSender->getConfigStatus()['phpmailer_loaded'];
            echo json_encode([
                'success' => $loaded,
                'message' => $loaded ? 'PHPMailer is loaded' : 'PHPMailer not found'
            ]);
            break;

        case 'save_settings':
            $newSettings = [
                'host' => $_POST['host'] ?? '',
                'port' => $_POST['port'] ?? '587',
                'username' => $_POST['username'] ?? '',
                'password' => $_POST['password'] ?? '',
                'encryption' => $_POST['encryption'] ?? 'tls',
                'from_email' => $_POST['from_email'] ?? '',
                'from_name' => $_POST['from_name'] ?? 'MERQ Consultancy'
            ];

            // Save settings (you need to implement this in SettingsManager)
            $saved = $settingsManager->saveSmtpSettings($newSettings);

            echo json_encode([
                'success' => $saved,
                'message' => $saved ? 'Settings saved successfully' : 'Failed to save settings',
                'settings' => $newSettings
            ]);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
    exit;
}

require_once '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Tester - MERQ Performance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #003366 !important;
            --secondary-color: #20c997;
            --accent-color: #07c9e9;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-bg: ;
            --border-radius: 12px;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .tester-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 50px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .tester-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: transform 0.3s;
        }

        .tester-card:hover {
            transform: translateY(-5px);
        }

        .status-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .config-item {
            background: var(--primary-color);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-left: 4px solid var(--primary-color);
        }

        .test-button {
            background: linear-gradient(135deg, var(--success-color) 0%, #0b5e42 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .test-button:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(25, 135, 84, 0.3);
        }

        .test-button:disabled {
            opacity: 0.6;
            transform: none;
        }

        .result-box {
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-top: 1.5rem;
            display: none;
        }

        .result-box.success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 6px solid var(--success-color);
            display: block;
        }

        .result-box.error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border-left: 6px solid var(--danger-color);
            display: block;
        }

        .result-box.warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%);
            border-left: 6px solid var(--warning-color);
            display: block;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step .icon {
            width: 50px;
            height: 50px;
            background: white;
            border: 3px solid #dee2e6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.5rem;
            color: #6c757d;
            transition: all 0.3s;
        }

        .step.completed .icon {
            background: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }

        .step.active .icon {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .step .label {
            font-weight: 600;
            color: #6c757d;
        }

        .step.completed .label {
            color: var(--success-color);
        }

        .progress-steps {
            position: absolute;
            top: 25px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #dee2e6;
            z-index: 0;
        }

        .progress-steps-fill {
            height: 100%;
            background: var(--success-color);
            width: 0%;
            transition: width 0.3s;
        }

        .test-results-detail {
            max-height: 400px;
            overflow-y: auto;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.02);
            border-radius: 8px;
        }

        .detail-item {
            padding: 0.5rem;
            border-bottom: 1px solid #dee2e6;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .badge-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }

        .stat-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.3);
        }

        .stat-circle .number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-circle .label {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .tester-card {
                padding: 1.5rem;
            }

            .step .icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="tester-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-envelope-open-text me-3"></i>Email Tester
                    </h1>
                    <p class="lead mb-0">
                        Comprehensive email configuration testing tool
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="admin_dashboard.php" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                    <a href="sendreport.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Send Reports
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Current Configuration Status -->
        <div class="status-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-3"><i class="fas fa-cog me-2"></i>Current Email Configuration</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="config-item">
                                <i class="fas fa-server me-2" style="color: var(--primary-color);"></i>
                                <strong>SMTP Host:</strong>
                                <span class="float-end"><?= htmlspecialchars($smtpSettings['host'] ?: 'Not set') ?></span>
                            </div>
                            <div class="config-item">
                                <i class="fas fa-plug me-2" style="color: var(--primary-color);"></i>
                                <strong>Port:</strong>
                                <span class="float-end"><?= htmlspecialchars($smtpSettings['port'] ?: '587') ?></span>
                            </div>
                            <div class="config-item">
                                <i class="fas fa-lock me-2" style="color: var(--primary-color);"></i>
                                <strong>Encryption:</strong>
                                <span class="float-end"><?= htmlspecialchars($smtpSettings['encryption'] ?: 'tls') ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="config-item">
                                <i class="fas fa-user me-2" style="color: var(--primary-color);"></i>
                                <strong>Username:</strong>
                                <span class="float-end"><?= htmlspecialchars($smtpSettings['username'] ?: 'Not set') ?></span>
                            </div>
                            <div class="config-item">
                                <i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i>
                                <strong>From Email:</strong>
                                <span class="float-end"><?= htmlspecialchars($smtpSettings['from_email'] ?: 'Not set') ?></span>
                            </div>
                            <div class="config-item">
                                <i class="fas fa-tag me-2" style="color: var(--primary-color);"></i>
                                <strong>From Name:</strong>
                                <span class="float-end"><?= htmlspecialchars($smtpSettings['from_name'] ?: 'MERQ Consultancy') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="stat-circle">
                        <span class="number">
                            <?php if ($configStatus['configured']): ?>
                                <i class="fas fa-check-circle"></i>
                            <?php else: ?>
                                <i class="fas fa-exclamation-triangle"></i>
                            <?php endif; ?>
                        </span>
                        <span class="label">
                            <?= $configStatus['configured'] ? 'Configured' : 'Not Configured' ?>
                        </span>
                    </div>
                    <span class="badge bg-<?= $configStatus['phpmailer_loaded'] ? 'success' : 'danger' ?> p-2">
                        <i class="fas <?= $configStatus['phpmailer_loaded'] ? 'fa-check' : 'fa-times' ?> me-1"></i>
                        PHPMailer: <?= $configStatus['phpmailer_loaded'] ? 'Loaded' : 'Not Found' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Test Email Form -->
        <div class="tester-card">
            <h4 class="mb-4"><i class="fas fa-vial me-2" style="color: var(--primary-color);"></i>Test Email Configuration</h4>

            <div class="step-indicator mb-4" id="stepIndicator">
                <div class="progress-steps">
                    <div class="progress-steps-fill" id="progressFill" style="width: 0%;"></div>
                </div>
                <div class="step" id="step1">
                    <div class="icon"><i class="fas fa-check"></i></div>
                    <div class="label">Configure</div>
                </div>
                <div class="step" id="step2">
                    <div class="icon"><i class="fas fa-plug"></i></div>
                    <div class="label">Connect</div>
                </div>
                <div class="step" id="step3">
                    <div class="icon"><i class="fas fa-paper-plane"></i></div>
                    <div class="label">Send</div>
                </div>
                <div class="step" id="step4">
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                    <div class="label">Verify</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="testEmail" class="form-label fw-bold">
                            <i class="fas fa-envelope me-2"></i>Test Email Address
                        </label>
                        <input type="email" class="form-control form-control-lg" id="testEmail"
                            placeholder="Enter email address to send test to"
                            value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>">
                        <div class="form-text">
                            This email will receive the test message. Use your own email to verify delivery.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <div class="d-grid">
                            <button class="test-button" id="runBasicTest" <?= !$configStatus['configured'] ? 'disabled' : '' ?>>
                                <i class="fas fa-play me-2"></i>Run Basic Test
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <button class="btn btn-outline-primary w-100" id="runConnectionTest" <?= !$configStatus['configured'] ? 'disabled' : '' ?>>
                        <i class="fas fa-network-wired me-2"></i>Test SMTP Connection Only
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-success w-100" id="runComprehensiveTest" <?= !$configStatus['configured'] ? 'disabled' : '' ?>>
                        <i class="fas fa-microscope me-2"></i>Run Comprehensive Test
                    </button>
                </div>
            </div>
        </div>

        <!-- Test Results -->
        <div class="tester-card" id="resultsCard" style="display: none;">
            <h4 class="mb-4"><i class="fas fa-chart-bar me-2" style="color: var(--primary-color);"></i>Test Results</h4>

            <div id="resultsContainer"></div>
        </div>

        <!-- Quick Configuration Form -->
        <div class="tester-card">
            <h4 class="mb-4"><i class="fas fa-edit me-2" style="color: var(--primary-color);"></i>Quick SMTP Configuration</h4>

            <form id="smtpConfigForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="smtpHost" class="form-label">SMTP Host</label>
                        <input type="text" class="form-control" id="smtpHost"
                            value="<?= htmlspecialchars($smtpSettings['host'] ?? '') ?>"
                            placeholder="e.g., smtp.gmail.com">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="smtpPort" class="form-label">Port</label>
                        <select class="form-select" id="smtpPort">
                            <option value="587" <?= ($smtpSettings['port'] ?? '587') == '587' ? 'selected' : '' ?>>587 (TLS)</option>
                            <option value="465" <?= ($smtpSettings['port'] ?? '') == '465' ? 'selected' : '' ?>>465 (SSL)</option>
                            <option value="25" <?= ($smtpSettings['port'] ?? '') == '25' ? 'selected' : '' ?>>25 (Non-Secure)</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="smtpEncryption" class="form-label">Encryption</label>
                        <select class="form-select" id="smtpEncryption">
                            <option value="tls" <?= ($smtpSettings['encryption'] ?? 'tls') == 'tls' ? 'selected' : '' ?>>TLS</option>
                            <option value="ssl" <?= ($smtpSettings['encryption'] ?? '') == 'ssl' ? 'selected' : '' ?>>SSL</option>
                            <option value="none" <?= ($smtpSettings['encryption'] ?? '') == 'none' ? 'selected' : '' ?>>None</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="smtpUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="smtpUsername"
                            value="<?= htmlspecialchars($smtpSettings['username'] ?? '') ?>"
                            placeholder="SMTP username">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="smtpPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="smtpPassword"
                            value="<?= htmlspecialchars($smtpSettings['password'] ?? '') ?>"
                            placeholder="SMTP password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fromEmail" class="form-label">From Email</label>
                        <input type="email" class="form-control" id="fromEmail"
                            value="<?= htmlspecialchars($smtpSettings['from_email'] ?? '') ?>"
                            placeholder="noreply@yourdomain.com">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fromName" class="form-label">From Name</label>
                        <input type="text" class="form-control" id="fromName"
                            value="<?= htmlspecialchars($smtpSettings['from_name'] ?? 'MERQ Consultancy') ?>"
                            placeholder="MERQ Consultancy">
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary btn-lg" id="saveConfigBtn">
                        <i class="fas fa-save me-2"></i>Save Configuration
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-lg" id="testWithNewConfig">
                        <i class="fas fa-flask me-2"></i>Test with These Settings
                    </button>
                </div>
            </form>
        </div>

        <!-- Common SMTP Providers -->
        <div class="tester-card">
            <h4 class="mb-4"><i class="fas fa-database me-2" style="color: var(--primary-color);"></i>Common SMTP Providers</h4>

            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 provider-card" data-provider="gmail">
                        <div class="card-body text-center">
                            <i class="fab fa-google fa-3x mb-3" style="color: #ea4335;"></i>
                            <h5>Gmail</h5>
                            <p class="small">smtp.gmail.com<br>Port: 587 (TLS)</p>
                            <button class="btn btn-sm btn-outline-primary use-provider" data-provider="gmail">
                                Use Settings
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 provider-card" data-provider="outlook">
                        <div class="card-body text-center">
                            <i class="fab fa-microsoft fa-3x mb-3" style="color: #00a4ef;"></i>
                            <h5>Outlook</h5>
                            <p class="small">smtp-mail.outlook.com<br>Port: 587 (TLS)</p>
                            <button class="btn btn-sm btn-outline-primary use-provider" data-provider="outlook">
                                Use Settings
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 provider-card" data-provider="yahoo">
                        <div class="card-body text-center">
                            <i class="fab fa-yahoo fa-3x mb-3" style="color: #410093;"></i>
                            <h5>Yahoo</h5>
                            <p class="small">smtp.mail.yahoo.com<br>Port: 465 (SSL)</p>
                            <button class="btn btn-sm btn-outline-primary use-provider" data-provider="yahoo">
                                Use Settings
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 provider-card" data-provider="sendgrid">
                        <div class="card-body text-center">
                            <i class="fas fa-paper-plane fa-3x mb-3" style="color: #1b82e2;"></i>
                            <h5>SendGrid</h5>
                            <p class="small">smtp.sendgrid.net<br>Port: 587 (TLS)</p>
                            <button class="btn btn-sm btn-outline-primary use-provider" data-provider="sendgrid">
                                Use Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let currentTestId = 0;

            // Update step indicator
            function updateStepIndicator(step) {
                $('#step1, #step2, #step3, #step4').removeClass('completed active');

                for (let i = 1; i <= step; i++) {
                    $(`#step${i}`).addClass('completed');
                }

                if (step < 4) {
                    $(`#step${step + 1}`).addClass('active');
                }

                const progressWidth = (step / 4) * 100;
                $('#progressFill').css('width', progressWidth + '%');
            }

            // Reset step indicator
            function resetStepIndicator() {
                $('#step1, #step2, #step3, #step4').removeClass('completed active');
                $('#step1').addClass('active');
                $('#progressFill').css('width', '25%');
            }

            // Show results
            function showResults(data, testType) {
                const resultsCard = $('#resultsCard');
                const resultsContainer = $('#resultsContainer');

                let html = '';

                if (data.success) {
                    html = `
                        <div class="result-box success">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle fa-3x me-3 text-success"></i>
                                <div>
                                    <h5 class="mb-1">✅ Test Successful</h5>
                                    <p class="mb-0">${data.message}</p>
                                </div>
                            </div>
                    `;
                } else {
                    html = `
                        <div class="result-box error">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-exclamation-circle fa-3x me-3 text-danger"></i>
                                <div>
                                    <h5 class="mb-1">❌ Test Failed</h5>
                                    <p class="mb-0">${data.message}</p>
                                </div>
                            </div>
                    `;
                }

                // Detailed tests
                if (data.tests) {
                    html += '<div class="test-results-detail mt-3"><h6>Detailed Results:</h6>';

                    $.each(data.tests, function(key, test) {
                        const icon = test.success ? '✅' : '❌';
                        const bgClass = test.success ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10';

                        html += `
                            <div class="detail-item ${bgClass}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><strong>${icon} ${key.replace(/_/g, ' ').toUpperCase()}:</strong></span>
                                    <span class="badge bg-${test.success ? 'success' : 'danger'}">${test.success ? 'PASS' : 'FAIL'}</span>
                                </div>
                                <p class="mb-0 small">${test.message}</p>
                        `;

                        if (test.details) {
                            html += '<pre class="mt-2 small">' + JSON.stringify(test.details, null, 2) + '</pre>';
                        }

                        html += '</div>';
                    });

                    html += '</div>';
                }

                // Configuration details
                if (data.configuration) {
                    html += `
                        <div class="mt-3">
                            <h6>Configuration Status:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-${data.configuration.smtp_host ? 'check text-success' : 'times text-danger'} me-2"></i>SMTP Host</li>
                                        <li><i class="fas fa-${data.configuration.smtp_username ? 'check text-success' : 'times text-danger'} me-2"></i>Username</li>
                                        <li><i class="fas fa-${data.configuration.from_email ? 'check text-success' : 'times text-danger'} me-2"></i>From Email</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-${data.configuration.phpmailer_loaded ? 'check text-success' : 'times text-danger'} me-2"></i>PHPMailer</li>
                                        <li><i class="fas fa-info-circle me-2"></i>Port: ${data.configuration.smtp_port}</li>
                                        <li><i class="fas fa-info-circle me-2"></i>Encryption: ${data.configuration.smtp_encryption}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                }

                html += `<div class="text-muted mt-2 small">Test completed at: ${data.timestamp || new Date().toLocaleString()}</div>`;
                html += '</div>';

                resultsContainer.html(html);
                resultsCard.show();

                // Update step indicator based on success
                if (data.success) {
                    updateStepIndicator(4);
                } else {
                    if (data.tests) {
                        if (data.tests.configuration && data.tests.configuration.success) {
                            if (data.tests.smtp_connection && data.tests.smtp_connection.success) {
                                updateStepIndicator(3);
                            } else {
                                updateStepIndicator(2);
                            }
                        } else {
                            updateStepIndicator(1);
                        }
                    }
                }
            }

            // Run basic test
            $('#runBasicTest').click(function() {
                const testEmail = $('#testEmail').val().trim();

                if (!testEmail) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Required',
                        text: 'Please enter a test email address'
                    });
                    return;
                }

                if (!isValidEmail(testEmail)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email',
                        text: 'Please enter a valid email address'
                    });
                    return;
                }

                const button = $(this);
                button.prop('disabled', true);
                button.html('<i class="fas fa-spinner fa-spin me-2"></i>Testing...');

                resetStepIndicator();
                updateStepIndicator(1);

                $.ajax({
                    url: 'emailtest.php',
                    method: 'POST',
                    data: {
                        action: 'test_basic',
                        test_email: testEmail
                    },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        showResults(data, 'basic');

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Test Successful',
                                text: 'Test email sent successfully! Check your inbox.',
                                timer: 3000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Test Failed',
                                text: data.message,
                                footer: 'Check configuration and try again'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Failed to communicate with server: ' + error
                        });

                        $('#resultsCard').hide();
                    },
                    complete: function() {
                        button.prop('disabled', false);
                        button.html('<i class="fas fa-play me-2"></i>Run Basic Test');
                    }
                });
            });

            // Run connection test only
            $('#runConnectionTest').click(function() {
                const button = $(this);
                button.prop('disabled', true);
                button.html('<i class="fas fa-spinner fa-spin me-2"></i>Testing Connection...');

                resetStepIndicator();
                updateStepIndicator(1);

                $.ajax({
                    url: 'emailtest.php',
                    method: 'POST',
                    data: {
                        action: 'check_connection'
                    },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        if (data.success) {
                            updateStepIndicator(2);

                            Swal.fire({
                                icon: 'success',
                                title: 'Connection Successful',
                                text: 'Successfully connected to SMTP server',
                                timer: 3000
                            });

                            $('#resultsCard').hide();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Connection Failed',
                                text: data.message
                            });

                            $('#resultsCard').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Failed to communicate with server: ' + error
                        });
                    },
                    complete: function() {
                        button.prop('disabled', false);
                        button.html('<i class="fas fa-network-wired me-2"></i>Test SMTP Connection Only');
                    }
                });
            });

            // Run comprehensive test
            $('#runComprehensiveTest').click(function() {
                const testEmail = $('#testEmail').val().trim();

                if (!testEmail) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Required',
                        text: 'Please enter a test email address'
                    });
                    return;
                }

                if (!isValidEmail(testEmail)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email',
                        text: 'Please enter a valid email address'
                    });
                    return;
                }

                const button = $(this);
                button.prop('disabled', true);
                button.html('<i class="fas fa-spinner fa-spin me-2"></i>Running Comprehensive Test...');

                resetStepIndicator();
                updateStepIndicator(1);

                $.ajax({
                    url: 'emailtest.php',
                    method: 'POST',
                    data: {
                        action: 'test_comprehensive',
                        test_email: testEmail
                    },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        showResults(data, 'comprehensive');

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'All Tests Passed',
                                text: 'Comprehensive testing completed successfully!',
                                timer: 3000
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Failed to communicate with server: ' + error
                        });

                        $('#resultsCard').hide();
                    },
                    complete: function() {
                        button.prop('disabled', false);
                        button.html('<i class="fas fa-microscope me-2"></i>Run Comprehensive Test');
                    }
                });
            });

            // Save configuration
            $('#saveConfigBtn').click(function() {
                const config = {
                    host: $('#smtpHost').val(),
                    port: $('#smtpPort').val(),
                    username: $('#smtpUsername').val(),
                    password: $('#smtpPassword').val(),
                    encryption: $('#smtpEncryption').val(),
                    from_email: $('#fromEmail').val(),
                    from_name: $('#fromName').val()
                };

                // Validate
                if (!config.host || !config.username || !config.from_email) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete Configuration',
                        text: 'Please fill in at least host, username, and from email'
                    });
                    return;
                }

                const button = $(this);
                button.prop('disabled', true);
                button.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');

                $.ajax({
                    url: 'emailtest.php',
                    method: 'POST',
                    data: {
                        action: 'save_settings',
                        ...config
                    },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved!',
                                text: 'Configuration saved successfully',
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Save Failed',
                                text: data.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to save configuration'
                        });
                    },
                    complete: function() {
                        button.prop('disabled', false);
                        button.html('<i class="fas fa-save me-2"></i>Save Configuration');
                    }
                });
            });

            // Test with new config without saving
            $('#testWithNewConfig').click(function() {
                const testEmail = $('#testEmail').val().trim();

                if (!testEmail) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Required',
                        text: 'Please enter a test email address'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Test with New Settings',
                    text: 'This will test the entered settings without saving them permanently. Continue?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, test it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // TODO: Implement test with temporary settings
                        // This would require backend support for temporary config testing
                        Swal.fire({
                            icon: 'info',
                            title: 'Coming Soon',
                            text: 'This feature is under development. Please save settings first.'
                        });
                    }
                });
            });

            // Use provider settings
            $('.use-provider').click(function() {
                const provider = $(this).data('provider');

                const providers = {
                    gmail: {
                        host: 'smtp.gmail.com',
                        port: '587',
                        encryption: 'tls'
                    },
                    outlook: {
                        host: 'smtp-mail.outlook.com',
                        port: '587',
                        encryption: 'tls'
                    },
                    yahoo: {
                        host: 'smtp.mail.yahoo.com',
                        port: '465',
                        encryption: 'ssl'
                    },
                    sendgrid: {
                        host: 'smtp.sendgrid.net',
                        port: '587',
                        encryption: 'tls'
                    }
                };

                const settings = providers[provider];
                if (settings) {
                    $('#smtpHost').val(settings.host);
                    $('#smtpPort').val(settings.port);
                    $('#smtpEncryption').val(settings.encryption);

                    Swal.fire({
                        icon: 'success',
                        title: 'Provider Selected',
                        text: `${provider.charAt(0).toUpperCase() + provider.slice(1)} settings applied. Please enter your credentials.`,
                        timer: 2000
                    });
                }
            });

            // Email validation helper
            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Auto-fill from email if empty
            if (!$('#fromEmail').val()) {
                const testEmail = $('#testEmail').val();
                if (testEmail) {
                    $('#fromEmail').val(testEmail);
                }
            }

            // Initialize
            resetStepIndicator();
        });
    </script>
</body>

</html>