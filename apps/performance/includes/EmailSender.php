<?php
// EmailSender.php - Handles email sending functionality using PHPMailer
class EmailSender
{
    private $settingsManager;
    private $emailTemplates;
    private $smtpSettings;

    public function __construct($settingsManager = null)
    {
        $this->settingsManager = $settingsManager;
        $this->emailTemplates = new EmailTemplates($settingsManager);
        //$this->debug = false;

        if ($settingsManager) {
            $this->smtpSettings = $settingsManager->getSmtpSettings();
        } else {
            $this->smtpSettings = [
                'host' => '',
                'port' => '587',
                'username' => '',
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

    // Main email sending function using PHPMailer
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
            // Fall back to PHP mail() if no SMTP configured
            return $this->sendViaPHP($to, $toName, $subject, $htmlBody, $textBody, $cc);
        }

        // Try PHPMailer with SMTP first
        $phpmailerResult = null;
        try {
            $phpmailerResult = $this->sendViaPHPMailer($to, $toName, $subject, $htmlBody, $textBody, $cc);

            // If PHPMailer succeeded, return immediately (don't fall back)
            if ($phpmailerResult['success']) {
                return $phpmailerResult;
            }
        } catch (Exception $e) {
            error_log("PHPMailer SMTP failed: " . $e->getMessage());
            // Continue to fallback
        }

        // Only fall back to PHP mail() if PHPMailer failed
        $phpMailResult = $this->sendViaPHP($to, $toName, $subject, $htmlBody, $textBody, $cc);

        // Indicate which method was used
        $phpMailResult['fallback_used'] = ($phpmailerResult === null || !$phpmailerResult['success']);

        return $phpMailResult;
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
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

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

            // Enable debugging if needed
         //   if ($this->debug) {
         //       $mail->SMTPDebug = 2;
         //       ob_start();
         //   }

            // Send email
            $sent = $mail->send();

         //   if ($this->debug) {
         //       $debugOutput = ob_get_clean();
         //       error_log("PHPMailer Debug: " . $debugOutput);
         //   }

            if ($sent) {
                return [
                    'success' => true,
                    'message' => 'Email sent successfully via SMTP (PHPMailer)',
                    'method' => 'phpmailer_smtp'
                ];
            } else {
                throw new Exception('PHPMailer send() returned false');
            }
        } catch (Exception $e) {
            error_log("PHPMailer Exception: " . $e->getMessage());
            throw new Exception('PHPMailer failed: ' . $e->getMessage());
        }
    }

    // Send email via PHP mail() as fallback
    private function sendViaPHP($to, $toName, $subject, $htmlBody, $textBody, $cc)
    {
        $fromEmail = $this->smtpSettings['from_email'];
        $fromName = $this->smtpSettings['from_name'];

        $headers = [
            'From' => "$fromName <$fromEmail>",
            'Reply-To' => $fromEmail,
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Mailer' => 'PHP/' . phpversion()
        ];
        
        if (!empty($cc)) {
            $headers['Cc'] = implode(', ', $cc);
        }
        
        // Convert headers to string
        $headersString = '';
        foreach ($headers as $key => $value) {
            $headersString .= "$key: $value\r\n";
        }

        $toHeader = !empty($toName) ? "$toName <$to>" : $to;
        
        // Suppress warnings for mail() function
        $sent = @mail($toHeader, $subject, $htmlBody, $headersString);

        return [
            'success' => $sent,
            'message' => $sent ? 'Email sent successfully via PHP mail()' : 'Failed to send email via PHP mail()',
            'method' => 'php_mail'
        ];
    }

    // Helper function to load PHPMailer
    private function loadPHPMailer()
    {
        // Check if PHPMailer is already loaded
        if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            return true;
        }

        // Based on your directory structure: includes/vendor/phpmailer/phpmailer/
        $phpmailerBase = __DIR__ . '/vendor/phpmailer/phpmailer';

        if (file_exists($phpmailerBase . '/src/PHPMailer.php')) {
            try {
                require_once $phpmailerBase . '/src/PHPMailer.php';
                require_once $phpmailerBase . '/src/SMTP.php';
                require_once $phpmailerBase . '/src/Exception.php';

                if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                    return true;
                }
            } catch (Exception $e) {
                error_log("Failed to load PHPMailer: " . $e->getMessage());
                return false;
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
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
            "https://" . $_SERVER['HTTP_HOST'] : 
            "http://" . $_SERVER['HTTP_HOST'];
    }

    // Test email configuration
    public function testEmailConfig($testEmail)
    {
        $testSubject = 'Test Email - MERQ Performance System';
        $testHtml = '<html><body><h1>Test Email</h1><p>If you receive this email, your email configuration is working correctly.</p></body></html>';
        $testText = 'Test Email - If you receive this email, your email configuration is working correctly.';

        return $this->sendEmail(
            $testEmail,
            'Test Recipient',
            $testSubject,
            $testHtml,
            $testText
        );
    }

    // Get email configuration status
    public function getConfigStatus()
    {
        $status = [
            'smtp_host' => !empty($this->smtpSettings['host']),
            'smtp_username' => !empty($this->smtpSettings['username']),
            'from_email' => !empty($this->smtpSettings['from_email']),
            'from_name' => !empty($this->smtpSettings['from_name']),
            'phpmailer_loaded' => $this->loadPHPMailer(),
            'method' => !empty($this->smtpSettings['host']) ? 'SMTP (PHPMailer)' : 'PHP mail()'
        ];

        $status['configured'] = $status['smtp_host'] && $status['smtp_username'] && $status['from_email'] && $status['phpmailer_loaded'];

        return $status;
    }
    
    // Enable debug mode
//    public function setDebug($debug)
//    {
//        $this->debug = $debug;
//    }
}
?>