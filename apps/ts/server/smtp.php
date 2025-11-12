<?php
class SMTPConfig {
    private $config;
    private $logger;
    
    public function __construct() {
        $this->config = [
            'SMTPServer' => 'cloud.merqconsultancy.org',
            'SMTPPort' => 587,
            'SMTPUser' => 'app@cloud.merqconsultancy.org',
            'SMTPPassword' => 'MerqAppCloud',
            'UseTLS' => false
        ];
        
        $this->setupLogging();
    }
    
    private function setupLogging() {
        $logDir = __DIR__ . '/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        // Simple file logging
        $this->logger = function($message, $level = 'INFO') use ($logDir) {
            $timestamp = date('Y-m-d H:i:s');
            $logMessage = "[$timestamp] [$level] $message\n";
            file_put_contents($logDir . '/smtp.log', $logMessage, FILE_APPEND | LOCK_EX);
            echo $logMessage; // Also output to stdout
        };
    }
    
    public function getConfig() {
        return $this->config;
    }
    
    public function log($message, $level = 'INFO') {
        call_user_func($this->logger, $message, $level);
    }
}

class EmailService {
    private $smtpConfig;
    private $config;
    
    public function __construct() {
        $this->smtpConfig = new SMTPConfig();
        $this->config = $this->smtpConfig->getConfig();
    }
    
    public function sendTimesheetEmail($timesheetFilePath, $userSession, $hrUsers, $selectedMonth = null, $selectedYear = null) {
        $this->smtpConfig->log("Starting email send process");
        $this->smtpConfig->log("File path: $timesheetFilePath");
        $this->smtpConfig->log("User: " . ($userSession['full_name'] ?? 'None'));
        
        // Verify file exists
        if (!file_exists($timesheetFilePath)) {
            $this->smtpConfig->log("Timesheet file not found: $timesheetFilePath", 'ERROR');
            return false;
        }
        
        $fileSize = filesize($timesheetFilePath);
        if ($fileSize === 0) {
            $this->smtpConfig->log("Timesheet file is empty: $timesheetFilePath", 'ERROR');
            return false;
        }
        
        $this->smtpConfig->log("File exists and has size: $fileSize bytes");
        
        // Use selected month/year or current
        if ($selectedMonth && $selectedYear) {
            $monthName = $selectedMonth;
            $year = $selectedYear;
        } else {
            require_once __DIR__ . '/../includes/ethiopian_date.php';
            $currentEthDate = EthiopianDateConverter::getCurrentEthiopianDate();
            $monthName = $currentEthDate['month_name'];
            $year = $currentEthDate['year'];
        }
        
        // Create email headers
        $hrEmails = [];
        foreach ($hrUsers as $hrUser) {
            if (!empty($hrUser['email'])) {
                $hrEmails[] = $hrUser['email'];
            }
        }
        
        if (empty($hrEmails)) {
            $hrEmails = ['support@merqconsultancy.org'];
        }
        
        $to = implode(', ', $hrEmails);
        $cc = $userSession['email'] ?? 'unknown@merqconsultancy.org';
        $subject = "MERQ Timesheet for $monthName $year - " . ($userSession['full_name'] ?? 'Unknown User');
        
        // Create email body
        $body = $this->createEmailBody($userSession, $monthName, $year, $hrUsers, $timesheetFilePath);
        
        // Create safe filename
        $safeFilename = $this->createSafeFilename(basename($timesheetFilePath), $userSession, $monthName, $year);
        
        // Send email
        return $this->sendEmail($to, $cc, $subject, $body, $timesheetFilePath, $safeFilename);
    }
    
    private function createSafeFilename($originalFilename, $userSession, $monthName, $year) {
        $monthEnglishMap = [
            'መስከረም' => 'Meskerem', 'ጥቅምት' => 'Tikimt', 'ኅዳር' => 'Hidar', 
            'ታኅሣሥ' => 'Tahsas', 'ጥር' => 'Tir', 'የካቲት' => 'Yekatit',
            'መጋቢት' => 'Megabit', 'ሚያዝያ' => 'Miyazya', 'ግንቦት' => 'Ginbot',
            'ሰኔ' => 'Sene', 'ሐምሌ' => 'Hamle', 'ነሐሴ' => 'Nehase', 'ጳጉሜ' => 'Pagume'
        ];
        
        $englishMonth = $monthEnglishMap[$monthName] ?? $monthName;
        
        // Clean user name for filename
        $cleanName = 'Unknown_User';
        if (!empty($userSession['full_name'])) {
            $cleanName = preg_replace('/[^a-zA-Z0-9_ -]/', '', $userSession['full_name']);
            $cleanName = str_replace(' ', '_', trim($cleanName));
        }
        
        $timestamp = date('Ymd_His');
        return "{$cleanName}_{$englishMonth}_{$year}_MERQ_TIMESHEET_{$timestamp}.xlsx";
    }
    
    private function createEmailBody($userSession, $monthName, $year, $hrUsers, $timesheetFilePath) {
        $hrNames = array_map(function($hr) {
            return $hr['full_name'] ?? 'HR Department';
        }, $hrUsers);
        
        $hrRecipients = implode(', ', $hrNames);
        $filename = basename($timesheetFilePath);
        $timestamp = date('Y-m-d H:i:s');
        
        $userName = $userSession['full_name'] ?? 'Unknown User';
        $userPosition = $userSession['position_title'] ?? 'Unknown Position';
        $userDepartment = $userSession['department_name'] ?? 'Unknown Department';
        $userEmployeeId = $userSession['employee_id'] ?? 'Unknown ID';
        $userSupervisor = $userSession['supervisor_name'] ?? 'Unknown Supervisor';
        $userSupervisorPosition = $userSession['supervisor_position_title'] ?? 'Unknown Supervisor Position';
        
        return "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .header { background-color: #2C3E50; color: white; padding: 20px; text-align: center; }
                    .content { padding: 20px; }
                    .footer { background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #666; }
                    .details { background-color: #f8f9fa; padding: 15px; border-left: 4px solid #3498DB; margin: 10px 0; }
                    .signature { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h2>MERQ CONSULTANCY PLC</h2>
                    <h3>Timesheet Submission</h3>
                </div>
                
                <div class='content'>
                    <p>Dear <strong>$hrRecipients</strong>,</p>
                    
                    <p>Please find attached the timesheet for your review and approval.</p>
                    
                    <div class='details'>
                        <h4>Employee Details:</h4>
                        <ul>
                            <li><strong>Name:</strong> $userName</li>
                            <li><strong>Position:</strong> $userPosition</li>
                            <li><strong>Department:</strong> $userDepartment</li>
                            <li><strong>Employee ID:</strong> $userEmployeeId</li>
                            <li><strong>Supervisor:</strong> $userSupervisor</li>
                            <li><strong>Supervisor Position:</strong> $userSupervisorPosition</li>
                        </ul>
                    </div>
                    
                    <div class='details'>
                        <h4>Timesheet Information:</h4>
                        <ul>
                            <li><strong>Period:</strong> $monthName $year</li>
                            <li><strong>Attachment:</strong> $filename</li>
                            <li><strong>Generated:</strong> $timestamp</li>
                        </ul>
                    </div>
                    
                    <p>This timesheet has been generated and submitted through the MERQ Timesheet System.</p>
                    <p>The attached Excel file contains the complete timesheet details formatted according to MERQ standards using the official template.</p>
                    
                    <div class='signature'>
                        <p>Best regards,</p>
                        <p><strong>$userName</strong><br>
                        $userPosition<br>
                        MERQ Consultancy PLC</p>
                    </div>
                </div>
                
                <div class='footer'>
                    <p>---<br>
                    This is an automated email from MERQ Timesheet System.<br>
                    MERQ Consultancy PLC | Excellence In Action!</p>
                </div>
            </body>
            </html>
        ";
    }
    
    private function sendEmail($to, $cc, $subject, $body, $attachmentPath, $attachmentName) {
        $boundary = md5(time());
        
        $headers = [
            'From: ' . $this->config['SMTPUser'],
            'Reply-To: ' . $this->config['SMTPUser'],
            'Cc: ' . $cc,
            'MIME-Version: 1.0',
            'Content-Type: multipart/mixed; boundary="' . $boundary . '"',
            'X-Mailer: PHP/' . phpversion()
        ];
        
        // Email body
        $message = "--$boundary\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $message .= $body . "\r\n";
        
        // Attachment
        $fileContent = file_get_contents($attachmentPath);
        $fileContent = chunk_split(base64_encode($fileContent));
        
        $message .= "--$boundary\r\n";
        $message .= "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; name=\"$attachmentName\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-Disposition: attachment; filename=\"$attachmentName\"\r\n\r\n";
        $message .= $fileContent . "\r\n";
        $message .= "--$boundary--";
        
        // Send using PHP's mail function (you might want to use PHPMailer for better SMTP support)
        $allRecipients = $to . ', ' . $cc;
        
        try {
            $result = mail($allRecipients, $subject, $message, implode("\r\n", $headers));
            
            if ($result) {
                $this->smtpConfig->log("Email sent successfully to: $allRecipients");
                return true;
            } else {
                $this->smtpConfig->log("Failed to send email", 'ERROR');
                return false;
            }
        } catch (Exception $e) {
            $this->smtpConfig->log("Email sending error: " . $e->getMessage(), 'ERROR');
            return false;
        }
    }
}

// Global instance
$emailService = new EmailService();
?>