<?php
require_once __DIR__ . '/../models/Timesheet.php';
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';

class TimesheetController {
    private $timesheetModel;

    public function __construct() {
        $this->timesheetModel = new Timesheet();
    }

    public function getTimesheet($userId, $year, $month) {
        return $this->timesheetModel->getUserTimesheet($userId, $year, $month);
    }

    public function saveTimesheet($userId, $year, $month, $data) {
        return $this->timesheetModel->saveUserTimesheet($userId, $year, $month, $data);
    }

    public function calculateTotals($userId, $year, $month) {
        return $this->timesheetModel->calculateTotals($userId, $year, $month);
    }

    public function previewTimesheet() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        $user = SessionManager::getUser();
        $year = (int)($_POST['year'] ?? date('Y'));
        $month = (int)($_POST['month'] ?? date('n'));

        $timesheet = $this->getTimesheet($user['user_id'], $year, $month);
        $totals = $this->calculateTotals($user['user_id'], $year, $month);

        Utils::jsonResponse([
            'success' => true,
            'preview_data' => [
                'timesheet' => $timesheet,
                'totals' => $totals,
                'user' => $user,
                'year' => $year,
                'month' => $month
            ]
        ]);
    }

    public function exportTimesheet() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        $user = SessionManager::getUser();
        $year = (int)($_POST['year'] ?? date('Y'));
        $month = (int)($_POST['month'] ?? date('n'));

        // Generate Excel file
        // This would use the ExcelFormatter from the Python code, but adapted to PHP
        // For now, return success
        Utils::jsonResponse(['success' => true, 'message' => 'Export functionality to be implemented']);
    }

    public function submitTimesheet() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        $user = SessionManager::getUser();
        $year = (int)($_POST['year'] ?? date('Y'));
        $month = (int)($_POST['month'] ?? date('n'));

        // Send email to HR
        // This would use the EmailManager
        Utils::jsonResponse(['success' => true, 'message' => 'Submit functionality to be implemented']);
    }
}
?>