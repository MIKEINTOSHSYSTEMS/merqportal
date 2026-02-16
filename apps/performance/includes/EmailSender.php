<?php
// EmailSender.php - Handles email sending functionality using PHPMailer only
class EmailSender
{
    private $settingsManager;
    private $emailTemplates;
    private $smtpSettings;
    private $debug = false;

    public function __construct($settingsManager = null)
    {
        $this->settingsManager = $settingsManager;
        $this->emailTemplates = new EmailTemplates($settingsManager);

        if ($settingsManager) {
            $this->smtpSettings = $settingsManager->getSmtpSettings();
        } else {
            $this->smtpSettings = [
                'host' => 'cloud.merqconsultancy.org',
                'port' => '587',
                'username' => 'internal@cloud.merqconsultancy.org',
                'password' => '',
                'encryption' => 'tls',
                'from_email' => 'noreply@merqconsultancy.org',
                'from_name' => 'MERQ Consultancy'
            ];
        }
    }

    // Send performance report email
    public function sendPerformanceReport($employeeId, $employeeData = null, $reportData = null, $ceoFeedback = null)
    {
        // Load data if not provided
        if (!$employeeData) {
            $employeeData = getEmployeeDetails($employeeId);
        }

        if (!$reportData) {
            $submissions = getSubmissions();
            $allReports = calculateWeightedScores($submissions);
            $reportData = $allReports[$employeeId] ?? null;
        }

        if (!$ceoFeedback) {
            $ceoFeedback = getCEOFeedback($employeeId, false);
        }

        // Get all responses for the CEO feedback
        $allResponses = [];
        foreach ($ceoFeedback as $feedback) {
            $responses = getFeedbackResponses($feedback['id']);
            $allResponses[$feedback['id']] = $responses;
        }

        if (!$employeeData || !$reportData) {
            return ['success' => false, 'message' => 'Employee data or report data not found'];
        }

        // Get employee email
        $toEmail = $employeeData['email'] ?? '';
        if (empty($toEmail)) {
            return ['success' => false, 'message' => 'Employee email not found'];
        }

        // Generate login URL
        $loginUrl = $this->generateLoginUrl($employeeId);

        // Get enhanced email template with responses
        $template = $this->emailTemplates->getEnhancedPerformanceReportTemplate(
            $employeeData,
            $reportData,
            $ceoFeedback,
            $allResponses,
            $loginUrl
        );

        // Send email
        return $this->sendEmail(
            $toEmail,
            $employeeData['full_name'],
            $template['subject'],
            $template['html'],
            $template['text']
        );
    }

    // Send CEO feedback notification
    public function sendCEOFeedbackNotification($employeeId, $feedbackId, $feedbackData = null)
    {
        $employeeData = getEmployeeDetails($employeeId);
        if (!$feedbackData) {
            $feedbackData = getCEOFeedbackItem($feedbackId);
        }

        if (!$employeeData || !$feedbackData) {
            return ['success' => false, 'message' => 'Employee or feedback data not found'];
        }

        $toEmail = $employeeData['email'] ?? '';
        if (empty($toEmail)) {
            return ['success' => false, 'message' => 'Employee email not found'];
        }

        $template = $this->emailTemplates->getCEOFeedbackTemplate(
            $employeeData,
            $feedbackData,
            $feedbackData['ceo_name'] ?? 'CEO'
        );

        // Also send copy to CEO (user_id 35)
        $ceoEmail = $this->getCEOEmail();
        $cc = [];
        if ($ceoEmail) {
            $cc[] = $ceoEmail;
        }

        return $this->sendEmail(
            $toEmail,
            $employeeData['full_name'],
            $template['subject'],
            $template['html'],
            $template['text'],
            $cc
        );
    }

    // Send response notification
    public function sendResponseNotification($feedbackId, $responseText, $respondentId)
    {
        $feedbackData = getCEOFeedbackItem($feedbackId);
        if (!$feedbackData) {
            return ['success' => false, 'message' => 'Feedback data not found'];
        }

        $employeeData = getEmployeeDetails($feedbackData['employee_id']);
        $respondentData = getEmployeeDetails($respondentId);

        if (!$employeeData || !$respondentData) {
            return ['success' => false, 'message' => 'Employee data not found'];
        }

        $template = $this->emailTemplates->getResponseNotificationTemplate(
            $respondentData,
            $feedbackData,
            $responseText,
            $respondentData['full_name']
        );

        // Send to CEO (user_id 35)
        $ceoEmail = $this->getCEOEmail();
        if (!$ceoEmail) {
            return ['success' => false, 'message' => 'CEO email not found'];
        }

        // Also send copy to the employee who responded
        $respondentEmail = $respondentData['email'] ?? '';
        $cc = [];
        if ($respondentEmail) {
            $cc[] = $respondentEmail;
        }

        return $this->sendEmail(
            $ceoEmail,
            'CEO',
            $template['subject'],
            $template['html'],
            $template['text'],
            $cc
        );
    }

    // Send batch reports
    public function sendBatchReports($employeeIds)
    {
        $results = [];
        $successCount = 0;
        $errorCount = 0;

        foreach ($employeeIds as $employeeId) {
            $result = $this->sendPerformanceReport($employeeId);
            $results[$employeeId] = $result;
            
            if ($result['success']) {
                $successCount++;
            } else {
                $errorCount++;
            }
            
            // Small delay to prevent overwhelming the mail server
            usleep(100000); // 0.1 second
        }

        return [
            'success' => $errorCount === 0,
            'total' => count($employeeIds),
            'sent' => $successCount,
            'failed' => $errorCount,
            'details' => $results
        ];
    }

    // Main email sending function using PHPMailer ONLY
    private function sendEmail($to, $toName, $subject, $htmlBody, $textBody = '', $cc = [])
    {
        // Validate email address
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Invalid email address: ' . $to,
                'method' => 'validation_failed'
            ];
        }

        // Check if SMTP is configured
        if (empty($this->smtpSettings['host']) || empty($this->smtpSettings['username'])) {
            return [
                'success' => false,
                'message' => 'SMTP not configured. Please configure SMTP settings first.',
                'method' => 'configuration_error',
                'smtp_host' => $this->smtpSettings['host'],
                'smtp_username' => $this->smtpSettings['username']
            ];
        }

        // Send via PHPMailer with SMTP
        try {
            return $this->sendViaPHPMailer($to, $toName, $subject, $htmlBody, $textBody, $cc);
        } catch (Exception $e) {
            error_log("PHPMailer failed: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'PHPMailer failed: ' . $e->getMessage(),
                'method' => 'phpmailer_error',
                'error_details' => $e->getMessage()
            ];
        }
    }

    // Send email via PHPMailer with SMTP
    private function sendViaPHPMailer($to, $toName, $subject, $htmlBody, $textBody, $cc)
    {
        // Load PHPMailer
        $phpmailerLoaded = $this->loadPHPMailer();
        if (!$phpmailerLoaded) {
            throw new Exception('PHPMailer not found. Please install PHPMailer in vendor directory.');
        }

        try {
            // Create new PHPMailer instance
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = $this->smtpSettings['host'];
            $mail->Port = $this->smtpSettings['port'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpSettings['username'];
            $mail->Password = $this->smtpSettings['password'];

            // Encryption
            if ($this->smtpSettings['encryption'] === 'tls') {
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            } elseif ($this->smtpSettings['encryption'] === 'ssl') {
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            }

            // Timeout settings
            $mail->Timeout = 30;
            $mail->SMTPKeepAlive = true;
            
            // SMTP Options for debugging and compatibility
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // Enable debug mode if set
            if ($this->debug) {
                $mail->SMTPDebug = 2;
                $mail->Debugoutput = function($str, $level) {
                    error_log("PHPMailer Debug [$level]: $str");
                };
            }

            // Sender
            $mail->setFrom($this->smtpSettings['from_email'], $this->smtpSettings['from_name']);
            $mail->addReplyTo($this->smtpSettings['from_email'], $this->smtpSettings['from_name']);

            // Recipient
            $mail->addAddress($to, $toName);

            // CC recipients
            if (!empty($cc)) {
                foreach ($cc as $ccEmail) {
                    if (filter_var($ccEmail, FILTER_VALIDATE_EMAIL)) {
                        $mail->addCC($ccEmail);
                    }
                }
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $htmlBody;
            $mail->AltBody = $textBody ?: strip_tags($htmlBody);

            // Send email
            $sent = $mail->send();

            if ($sent) {
                return [
                    'success' => true,
                    'message' => 'Email sent successfully via SMTP (PHPMailer)',
                    'method' => 'phpmailer_smtp',
                    'to' => $to,
                    'subject' => $subject
                ];
            } else {
                throw new Exception('PHPMailer send() returned false');
            }
        } catch (Exception $e) {
            error_log("PHPMailer Exception: " . $e->getMessage());
            throw new Exception('PHPMailer failed: ' . $e->getMessage());
        }
    }

    // Helper function to load PHPMailer
    private function loadPHPMailer()
    {
        // Check if PHPMailer is already loaded
        if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            return true;
        }

        // Try multiple possible paths for PHPMailer
        $possiblePaths = [
            __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php',
            __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php',
            __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php',
            dirname(__DIR__) . '/vendor/phpmailer/phpmailer/src/PHPMailer.php',
            dirname(dirname(__DIR__)) . '/vendor/phpmailer/phpmailer/src/PHPMailer.php',
            // Add path for your specific structure
            dirname(__DIR__) . '/includes/vendor/phpmailer/phpmailer/src/PHPMailer.php'
        ];

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                try {
                    require_once $path;
                    // Also load required classes
                    $basePath = dirname($path);
                    if (file_exists($basePath . '/SMTP.php')) {
                        require_once $basePath . '/SMTP.php';
                    }
                    if (file_exists($basePath . '/Exception.php')) {
                        require_once $basePath . '/Exception.php';
                    }

                    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                        return true;
                    }
                } catch (Exception $e) {
                    error_log("Failed to load PHPMailer from $path: " . $e->getMessage());
                }
            }
        }

        return false;
    }

    // Helper methods
    public function generateLoginUrl($employeeId)
    {
        $baseUrl = $this->getBaseUrl();
        return $baseUrl . '/apps/performance/public/dashboard.php?employee=' . $employeeId;
    }

    private function getCEOEmail()
    {
        // Get CEO email (user_id 35)
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT email FROM users WHERE user_id = 35";
        $result = $conn->query($sql);
        
        if ($result && $row = $result->fetch_assoc()) {
            $conn->close();
            return $row['email'];
        }
        
        $conn->close();
        return null;
    }

    private function getBaseUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $protocol . $host;
    }

    // Test email configuration with detailed results
    public function testEmailConfig($testEmail, $testType = 'basic')
    {
        $results = [
            'success' => false,
            'message' => '',
            'tests' => [],
            'configuration' => $this->getConfigStatus(),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        /* ---------------------------------------
       Step 1: Check PHPMailer
    --------------------------------------- */
        $phpmailerLoaded = $this->loadPHPMailer();
        $results['tests']['phpmailer_loaded'] = [
            'success' => $phpmailerLoaded,
            'message' => $phpmailerLoaded
                ? 'PHPMailer loaded successfully'
                : 'PHPMailer not found'
        ];

        if (!$phpmailerLoaded) {
            $results['message'] = 'PHPMailer library not found';
            return $results;
        }

        /* ---------------------------------------
       Step 2: Validate SMTP configuration
    --------------------------------------- */
        $configValid =
            !empty($this->smtpSettings['host']) &&
            !empty($this->smtpSettings['username']) &&
            !empty($this->smtpSettings['from_email']);

        $results['tests']['configuration'] = [
            'success' => $configValid,
            'message' => $configValid
                ? 'SMTP configuration valid'
                : 'SMTP configuration incomplete',
            'details' => [
                'host' => !empty($this->smtpSettings['host']) ? '✓' : '✗',
                'username' => !empty($this->smtpSettings['username']) ? '✓' : '✗',
                'from_email' => !empty($this->smtpSettings['from_email']) ? '✓' : '✗',
                'port' => $this->smtpSettings['port'] ?? '587',
                'encryption' => $this->smtpSettings['encryption'] ?? 'tls'
            ]
        ];

        if (!$configValid) {
            $results['message'] = 'SMTP configuration incomplete';
            return $results;
        }

        /* ---------------------------------------
       Step 3: Validate test email
    --------------------------------------- */
        $emailValid = filter_var($testEmail, FILTER_VALIDATE_EMAIL);

        $results['tests']['test_email'] = [
            'success' => $emailValid,
            'message' => $emailValid
                ? 'Test email address valid'
                : 'Invalid test email address'
        ];

        if (!$emailValid) {
            $results['message'] = 'Invalid test email address';
            return $results;
        }

        /* ---------------------------------------
       Step 4: Test SMTP Connection
    --------------------------------------- */
        try {
            $connectionTest = $this->testSMTPConnection();
            $results['tests']['smtp_connection'] = $connectionTest;

            if (!$connectionTest['success']) {
                $results['message'] = 'SMTP connection failed';
                return $results;
            }
        } catch (Exception $e) {
            $results['tests']['smtp_connection'] = [
                'success' => false,
                'message' => 'SMTP connection failed: ' . $e->getMessage()
            ];
            $results['message'] = 'SMTP connection exception';
            return $results;
        }

        /* ---------------------------------------
       Step 5: Send Test Email (ALWAYS SEND)
    --------------------------------------- */
        try {

            if ($testType === 'comprehensive') {
                $this->setDebug(true);
            }

            $testSubject = 'Test Email from MERQ Performance System';
            $testHtml = $this->getTestEmailHtml($results['configuration']);
            $testText = $this->getTestEmailText($results['configuration']);

            $sendResult = $this->sendEmail(
                $testEmail,
                'Test Recipient',
                $testSubject,
                $testHtml,
                $testText
            );

            $results['tests']['send_test'] = $sendResult;

            if (!empty($sendResult['success'])) {
                $results['success'] = true;
                $results['message'] = 'Test email sent successfully';
            } else {
                $results['message'] = $sendResult['message'] ?? 'Failed to send test email';
            }

            if ($testType === 'comprehensive') {
                $this->setDebug(false);
            }
        } catch (Exception $e) {

            $results['tests']['send_test'] = [
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage()
            ];

            $results['message'] = 'Exception occurred during send';
        }

        return $results;
    }


    // Test SMTP connection without sending email
    private function testSMTPConnection()
    {
        $result = [
            'success' => false,
            'message' => '',
            'details' => []
        ];

        try {
            $phpmailerLoaded = $this->loadPHPMailer();
            if (!$phpmailerLoaded) {
                throw new Exception('PHPMailer not loaded');
            }

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            
            // Configure SMTP
            $mail->isSMTP();
            $mail->Host = $this->smtpSettings['host'];
            $mail->Port = $this->smtpSettings['port'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpSettings['username'];
            $mail->Password = $this->smtpSettings['password'];
            
            if ($this->smtpSettings['encryption'] === 'tls') {
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            } elseif ($this->smtpSettings['encryption'] === 'ssl') {
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            }

            $mail->Timeout = 10; // Short timeout for connection test
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // Try to connect to SMTP server
            $mail->smtpConnect();
            
            $result['success'] = true;
            $result['message'] = 'Successfully connected to SMTP server';
            $result['details'] = [
                'host' => $this->smtpSettings['host'],
                'port' => $this->smtpSettings['port'],
                'encryption' => $this->smtpSettings['encryption']
            ];

            // Close connection
            $mail->smtpClose();

        } catch (Exception $e) {
            $result['message'] = 'Connection failed: ' . $e->getMessage();
            $result['details'] = [
                'error' => $e->getMessage(),
                'host' => $this->smtpSettings['host'],
                'port' => $this->smtpSettings['port']
            ];
        }

        return $result;
    }

    // Get email configuration status
    public function getConfigStatus()
    {
        $phpmailerLoaded = $this->loadPHPMailer();
        
        $status = [
            'smtp_host' => !empty($this->smtpSettings['host']),
            'smtp_port' => $this->smtpSettings['port'] ?? '587',
            'smtp_username' => !empty($this->smtpSettings['username']),
            'smtp_password' => !empty($this->smtpSettings['password']) ? '✓' : '✗',
            'smtp_encryption' => $this->smtpSettings['encryption'] ?? 'tls',
            'from_email' => !empty($this->smtpSettings['from_email']),
            'from_name' => !empty($this->smtpSettings['from_name']),
            'phpmailer_loaded' => $phpmailerLoaded,
            'method' => 'PHPMailer SMTP (Only)',
            'settings' => [
                'host' => $this->smtpSettings['host'] ?: 'Not set',
                'port' => $this->smtpSettings['port'] ?: '587',
                'username' => $this->smtpSettings['username'] ?: 'Not set',
                'from_email' => $this->smtpSettings['from_email'] ?: 'Not set',
                'from_name' => $this->smtpSettings['from_name'] ?: 'Not set',
                'encryption' => $this->smtpSettings['encryption'] ?: 'tls'
            ]
        ];

        $status['configured'] = $status['smtp_host'] && 
                                $status['smtp_username'] && 
                                $status['from_email'] && 
                                $status['phpmailer_loaded'];

        return $status;
    }

    // Get test email HTML
    private function getTestEmailHtml($config)
    {
        $date = date('F j, Y \a\t g:i A');
        $host = $this->smtpSettings['host'];
        $fromEmail = $this->smtpSettings['from_email'];
        $fromName = $this->smtpSettings['from_name'];

        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Email</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #003366; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 10px 10px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #6c757d; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 24px;">✅ Test Email Successful</h1>
        </div>
        
        <div class="content">
            <div class="success">
                <strong>Email Configuration Test Passed!</strong><br>
                This email confirms that your SMTP settings are working correctly.
            </div>
            
            <div class="info">
                <h3 style="margin-top: 0;">Test Details:</h3>
                <p><strong>Date/Time:</strong> {$date}</p>
                <p><strong>SMTP Host:</strong> {$host}</p>
                <p><strong>From:</strong> {$fromName} &lt;{$fromEmail}&gt;</p>
                <p><strong>Method:</strong> PHPMailer SMTP (Only)</p>
            </div>
            
            <div class="info">
                <h3 style="margin-top: 0;">What this means:</h3>
                <ul>
                    <li>✓ SMTP server connection successful</li>
                    <li>✓ Authentication credentials are valid</li>
                    <li>✓ PHPMailer is properly loaded</li>
                    <li>✓ Email sending functionality is working</li>
                </ul>
            </div>
            
            <div class="footer">
                <p>This is a test email from the MERQ Consultancy Performance Management System.</p>
                <p>You can now use the system to send performance reports and notifications.</p>
            </div>
        </div>
    </div>
</body>
</html>
HTML;
    }

    // Get test email text version
    private function getTestEmailText($config)
    {
        $date = date('F j, Y \a\t g:i A');
        $host = $this->smtpSettings['host'];
        $fromEmail = $this->smtpSettings['from_email'];

        return "TEST EMAIL SUCCESSFUL\n\n" .
               "Date/Time: $date\n" .
               "SMTP Host: $host\n" .
               "From: $fromEmail\n" .
               "Method: PHPMailer SMTP (Only)\n\n" .
               "This test confirms your email configuration is working correctly.\n" .
               "You can now use the system to send performance reports and notifications.";
    }

    // Enable debug mode
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    // Get SMTP settings
    public function getSmtpSettings()
    {
        return $this->smtpSettings;
    }
}
?>