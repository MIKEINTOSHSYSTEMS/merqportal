<?php
require_once __DIR__ . '/../server/smtp.php';

class Email {
    private $emailService;

    public function __construct() {
        $this->emailService = $email_service; // From smtp.php
    }

    public function sendTimesheetEmail($timesheetFile, $userSession, $hrUsers, $selectedMonth = null, $selectedYear = null) {
        return $this->emailService->send_timesheet_email($timesheetFile, $userSession, $hrUsers, $selectedMonth, $selectedYear);
    }

    public function sendNotificationEmail($to, $subject, $message) {
        // Send general notification email
        return $this->emailService->send_notification_email($to, $subject, $message);
    }
}
?>