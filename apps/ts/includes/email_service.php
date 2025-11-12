<?php
require_once __DIR__ . '/../server/smtp.php';

class EmailService {
    private $smtpService;

    public function __construct() {
        global $emailService;
        $this->smtpService = $emailService; // Use the global instance from smtp.php
    }

    public function sendTimesheetEmail($excelFile, $userData, $hrUsers, $selectedMonth = null, $selectedYear = null) {
        try {
            $subject = "MERQ Timesheet Submission";
            $monthYear = $selectedMonth && $selectedYear ?
                " for " . ETHIOPIAN_MONTHS_AMHARIC[$selectedMonth - 1] . " " . $selectedYear : "";

            $body = "
Dear HR Team,

Please find attached the timesheet submission{$monthYear} from {$userData['full_name']} (Employee ID: {$userData['employee_id']}).

Employee Details:
- Name: {$userData['full_name']}
- Employee ID: {$userData['employee_id']}
- Position: {$userData['position_title']}
- Department: {$userData['department_name']}
" . (isset($userData['supervisor_name']) && $userData['supervisor_name'] ? "- Supervisor: {$userData['supervisor_name']}\n" : "") . "

Please review and process this timesheet submission.

Best regards,
MERQ Timesheet System
";

            $to = array_column($hrUsers, 'email');
            $cc = [$userData['email']]; // CC the employee

            return $this->smtpService->sendTimesheetEmail($excelFile, $userData, $hrUsers, $selectedMonth, $selectedYear);

        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }

    public function sendPasswordResetEmail($email, $resetToken) {
        try {
            $subject = "MERQ Timesheet - Password Reset";
            $resetLink = BASE_URL . "/reset-password.php?token=" . $resetToken;

            $body = "
Dear User,

You have requested a password reset for your MERQ Timesheet account.

Please click the following link to reset your password:
{$resetLink}

This link will expire in 1 hour.

If you did not request this password reset, please ignore this email.

Best regards,
MERQ Timesheet System
";

            return $this->smtpService->sendEmail($email, $subject, $body);

        } catch (Exception $e) {
            error_log("Password reset email failed: " . $e->getMessage());
            return false;
        }
    }
}
?>