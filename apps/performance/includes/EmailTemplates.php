<?php
// EmailTemplates.php - Email templates for the system
class EmailTemplates
{
    private $settingsManager;

    public function __construct($settingsManager = null)
    {
        $this->settingsManager = $settingsManager;
    }

    // Performance report email template
    public function getPerformanceReportTemplate($employee, $reportData, $ceoFeedback = [], $loginUrl = '')
    {
        $employeeName = $employee['full_name'] ?? 'Employee';
        $position = $employee['position_title'] ?? '';
        $department = $employee['department_name'] ?? '';
        $supervisorName = $employee['supervisor_name'] ?? '';
        
        $overallScore = $reportData['weighted_score'] ?? 0;
        $category = $reportData['performance_category'] ?? 'Not Rated';
        
        // Prepare category scores
        $categoryScoresHtml = '';
        if (isset($reportData['category_scores'])) {
            foreach ($reportData['category_scores'] as $catName => $scoreData) {
                if (($scoreData['count'] ?? 0) > 0) {
                    $percentage = round($scoreData['percentage'] ?? 0, 1);
                    $categoryScoresHtml .= "<tr>
                        <td style='padding: 8px; border-bottom: 1px solid #eee;'>{$catName}</td>
                        <td style='padding: 8px; border-bottom: 1px solid #eee; text-align: center;'>
                            <div style='background: #e9ecef; height: 10px; border-radius: 5px; margin: 5px 0;'>
                                <div style='background: #007bff; width: {$percentage}%; height: 100%; border-radius: 5px;'></div>
                            </div>
                            {$percentage}%
                        </td>
                    </tr>";
                }
            }
        }

        // Prepare CEO feedback
        $ceoFeedbackHtml = '';
        if (!empty($ceoFeedback)) {
            foreach ($ceoFeedback as $index => $feedback) {
                $priority = ucfirst($feedback['priority'] ?? 'medium');
                $categoryName = $feedback['category_name'] ?? 'General Feedback';
                $feedbackText = nl2br(htmlspecialchars($feedback['feedback_text'] ?? ''));
                $targetDate = !empty($feedback['target_completion_date']) ? 
                    date('F j, Y', strtotime($feedback['target_completion_date'])) : 'No deadline';
                $createdDate = date('F j, Y', strtotime($feedback['created_at']));
                
                $priorityColor = $this->getPriorityColor($feedback['priority'] ?? 'medium');
                
                $ceoFeedbackHtml .= "<div style='margin-bottom: 20px; padding: 15px; border-left: 4px solid {$priorityColor}; background: #f8f9fa; border-radius: 4px;'>
                    <div style='margin-bottom: 10px;'>
                        <strong style='color: {$priorityColor};'>{$priority} Priority</strong> • 
                        <strong>{$categoryName}</strong> • 
                        Created: {$createdDate}
                    </div>
                    <div style='margin-bottom: 10px;'>{$feedbackText}</div>
                    <div>
                        <strong>Target Completion:</strong> {$targetDate}
                    </div>
                </div>";
            }
        }

        $subject = "Your Performance Evaluation Report - {$employeeName} CONFIDENTIAL";

        $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$subject}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 700px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #004080 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 10px 10px; }
        .card { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .score-badge { display: inline-block; padding: 10px 20px; border-radius: 20px; font-weight: bold; color: white; margin: 10px 0; }
        .btn-primary { background: #30E0FF; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 0; }
        .btn-secondary { background: #FF9500; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 0; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table th { background: #f8f9fa; padding: 10px; text-align: left; border-bottom: 2px solid #dee2e6; }
        .table td { padding: 10px; border-bottom: 1px solid #dee2e6; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #6c757d; font-size: 0.9em; }
        .category-progress { background: #e9ecef; height: 10px; border-radius: 5px; margin: 5px 0; }
        .category-bar { background: #007bff; height: 100%; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            
            <h1 style="margin: 0; font-size: 24px;">Performance Evaluation Report</h1>
            <p style="margin: 10px 0 0; opacity: 0.9;">MERQ Consultancy Employee Performance Management System</p>
        </div>
        
        <div class="content">
            <p>Dear <strong>{$employeeName}</strong>,</p>
            
            <p>Your performance evaluation for the current period has been completed. Below is a summary of your results:</p>
            
            <div class="card">
                <h3 style="margin-top: 0; color: #003366;">Employee Information</h3>
                <p><strong>Position:</strong> {$position}</p>
                <p><strong>Department:</strong> {$department}</p>
                <p><strong>Supervisor:</strong> {$supervisorName}</p>
                <p><strong>Evaluation Period:</strong> Current Performance Cycle</p>
            </div>
            
            <div class="card">
                <h3 style="margin-top: 0; color: #003366;">Overall Performance Score</h3>
                <div style="text-align: center;">
                    <div class="score-badge" style="background: {$this->getCategoryColor($category)};">
                        {$overallScore}%
                    </div>
                    <h2 style="margin: 10px 0;">{$category}</h2>
                    <div style="background: #e9ecef; height: 20px; border-radius: 10px; margin: 20px 0;">
                        <div style="background: {$this->getScoreColor($overallScore)}; width: {$overallScore}%; height: 100%; border-radius: 10px;"></div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <h3 style="margin-top: 0; color: #003366;">Category Performance Details</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th style="text-align: center;">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        {$categoryScoresHtml}
                    </tbody>
                </table>
            </div>

HTML;

        if (!empty($ceoFeedbackHtml)) {
            $html .= <<<HTML
            <div class="card">
                <h3 style="margin-top: 0; color: #003366;">CEO Feedback & Guidance</h3>
                <p>You have received feedback from the CEO. Please review and respond when possible:</p>
                {$ceoFeedbackHtml}
            </div>
HTML;
        }

        $html .= <<<HTML
            <div style="text-align: center; margin: 30px 0;">
                <h3>Access Your Full Report</h3>
                <p>For complete details, interactive charts, and to respond to feedback:</p>
                <a href="{$loginUrl}" class="btn-primary">View Full Report Dashboard</a>
                <br>
                <a href="{$loginUrl}?page=feedback" class="btn-secondary">Go to Feedback Section</a>
            </div>
            
            <div class="footer">
                <p>This is an automated message from MERQ Consultancy Performance Management System.</p>
                <p>Please do not reply to this email. For questions, contact HR Department. <a href="mailto:hr@merqconsultancy.org">(hr@merqconsultancy.org)</a></p>
                <p>© <?= date('Y') ?> MERQ Consultancy. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
HTML;

        return [
            'subject' => $subject,
            'html' => $html,
            'text' => $this->generateTextVersion($employee, $reportData, $ceoFeedback, $loginUrl)
        ];
    }

    // CEO feedback notification template
    public function getCEOFeedbackTemplate($employee, $feedback, $ceoName)
    {
        $employeeName = $employee['full_name'] ?? 'Employee';
        $priority = ucfirst($feedback['priority'] ?? 'medium');
        $categoryName = $feedback['category_name'] ?? 'General Feedback';
        $feedbackText = $feedback['feedback_text'] ?? '';
        $targetDate = !empty($feedback['target_completion_date']) ? 
            date('F j, Y', strtotime($feedback['target_completion_date'])) : 'No specific deadline';
        
        $subject = "New CEO Feedback - {$categoryName}";

        $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$subject}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #003366; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 10px 10px; }
        .priority-badge { display: inline-block; padding: 5px 15px; border-radius: 15px; font-weight: bold; color: white; }
        .btn { background: #007bff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 0; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #6c757d; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 22px;">CEO Feedback Notification</h1>
        </div>
        
        <div class="content">
            <p>Dear <strong>{$employeeName}</strong>,</p>
            
            <p>You have received new feedback from the CEO. This feedback is intended to support your professional development and growth.</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <div style="margin-bottom: 15px;">
                    <span class="priority-badge" style="background: {$this->getPriorityColor($feedback['priority'] ?? 'medium')};">
                        {$priority} Priority
                    </span>
                    <span style="margin-left: 10px; font-weight: bold;">{$categoryName}</span>
                </div>
                
                <div style="background: white; padding: 15px; border-radius: 5px; border: 1px solid #dee2e6;">
                    <p style="margin: 0;">{$feedbackText}</p>
                </div>
                
                <div style="margin-top: 15px;">
                    <p><strong>From:</strong> {$ceoName} (CEO)</p>
                    <p><strong>Target Completion Date:</strong> {$targetDate}</p>
                </div>
            </div>
            
            <div style="text-align: center; margin: 30px 0;">
                <p>Please review this feedback and provide your response through the performance system.</p>
                <a href="{$this->getBaseUrl()}/apps/performance/public/feedback.php" class="btn">View & Respond to Feedback</a>
            </div>
            
            <div class="footer">
                <p>This feedback is confidential and intended for your professional development.</p>
                <p>© " . date('Y') . " MERQ Consultancy. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
HTML;

        return [
            'subject' => $subject,
            'html' => $html,
            'text' => "New CEO Feedback for {$employeeName}\n\nCategory: {$categoryName}\nPriority: {$priority}\n\nFeedback: {$feedbackText}\n\nFrom: {$ceoName}\nTarget Date: {$targetDate}\n\nPlease log in to view and respond: {$this->getBaseUrl()}/apps/performance/public/feedback.php"
        ];
    }

    // Employee response notification template
    public function getResponseNotificationTemplate($employee, $feedback, $responseText, $respondentName)
    {
        $ceoName = $feedback['ceo_name'] ?? 'CEO';
        $categoryName = $feedback['category_name'] ?? 'General Feedback';
        $originalFeedback = $feedback['feedback_text'] ?? '';
        
        $subject = "Response to CEO Feedback - {$employee['full_name']}";

        $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$subject}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #20c997; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 10px 10px; }
        .feedback-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #003366; }
        .response-box { background: #e8f4fd; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #007bff; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #6c757d; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 22px;">Feedback Response Notification</h1>
        </div>
        
        <div class="content">
            <p>Dear <strong>{$ceoName}</strong>,</p>
            
            <p><strong>{$employee['full_name']}</strong> has responded to your feedback.</p>
            
            <div class="feedback-box">
                <h4 style="margin-top: 0; color: #003366;">Your Original Feedback:</h4>
                <p><strong>Category:</strong> {$categoryName}</p>
                <p>{$originalFeedback}</p>
            </div>
            
            <div class="response-box">
                <h4 style="margin-top: 0; color: #007bff;">Employee's Response:</h4>
                <p><strong>From:</strong> {$employee['full_name']}</p>
                <p>{$responseText}</p>
            </div>
            
            <div style="text-align: center; margin: 20px 0;">
                <p>You can view and manage all feedback responses in the performance system.</p>
                <a href="{$this->getBaseUrl()}/apps/performance/public/admin_dashboard.php" style="color: #007bff; text-decoration: none; font-weight: bold;">Go to Admin Dashboard →</a>
            </div>
            
            <div class="footer">
                <p>This is an automated notification from the Performance Management System.</p>
                <p>© " . date('Y') . " MERQ Consultancy. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
HTML;

        return [
            'subject' => $subject,
            'html' => $html,
            'text' => "Feedback Response from {$employee['full_name']}\n\nOriginal Feedback (Category: {$categoryName}):\n{$originalFeedback}\n\nResponse from {$employee['full_name']}:\n{$responseText}\n\nView in system: {$this->getBaseUrl()}/apps/performance/public/admin_dashboard.php"
        ];
    }

    // Helper methods
    private function getCategoryColor($category)
    {
        $colors = [
            'Needs Significant Improvement' => '#dc3545',
            'Developing' => '#fd7e14',
            'Meets Expectations' => '#ffc107',
            'Exceeds Expectations' => '#20c997',
            'Outstanding' => '#198754',
            'Not Rated' => '#6c757d'
        ];
        return $colors[$category] ?? '#6c757d';
    }

    private function getScoreColor($score)
    {
        if ($score < 30) return '#dc3545';
        if ($score < 60) return '#fd7e14';
        if ($score < 75) return '#ffc107';
        if ($score < 90) return '#20c997';
        return '#198754';
    }

    private function getPriorityColor($priority)
    {
        $colors = [
            'critical' => '#dc3545',
            'high' => '#fd7e14',
            'medium' => '#ffc107',
            'low' => '#20c997'
        ];
        return $colors[$priority] ?? '#6c757d';
    }

    private function getBaseUrl()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
            "https://" . $_SERVER['HTTP_HOST'] : 
            "http://" . $_SERVER['HTTP_HOST'];
    }

    private function generateTextVersion($employee, $reportData, $ceoFeedback, $loginUrl)
    {
        $text = "PERFORMANCE EVALUATION REPORT\n";
        $text .= "=============================\n\n";
        $text .= "Employee: {$employee['full_name']}\n";
        $text .= "Position: {$employee['position_title']}\n";
        $text .= "Department: {$employee['department_name']}\n\n";
        
        $text .= "OVERALL SCORE: {$reportData['weighted_score']}%\n";
        $text .= "Performance Category: {$reportData['performance_category']}\n\n";
        
        $text .= "CATEGORY SCORES:\n";
        if (isset($reportData['category_scores'])) {
            foreach ($reportData['category_scores'] as $catName => $scoreData) {
                if (($scoreData['count'] ?? 0) > 0) {
                    $percentage = round($scoreData['percentage'] ?? 0, 1);
                    $text .= "- {$catName}: {$percentage}%\n";
                }
            }
        }
        
        if (!empty($ceoFeedback)) {
            $text .= "\nCEO FEEDBACK:\n";
            foreach ($ceoFeedback as $feedback) {
                $text .= "- {$feedback['category_name']} ({$feedback['priority']} priority)\n";
                $text .= "  Feedback: {$feedback['feedback_text']}\n";
                if (!empty($feedback['target_completion_date'])) {
                    $text .= "  Target Date: " . date('F j, Y', strtotime($feedback['target_completion_date'])) . "\n";
                }
                $text .= "\n";
            }
        }
        
        $text .= "\nVIEW FULL REPORT:\n";
        $text .= "Login to the performance system to view interactive charts and respond to feedback:\n";
        $text .= $loginUrl . "\n\n";
        
        $text .= "---\n";
        $text .= "MERQ Consultancy Performance Management System\n";
        $text .= "This is an automated message. Please do not reply.\n";
        
        return $text;
    }
}
?>