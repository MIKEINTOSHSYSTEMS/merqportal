<?php
// feedback.php - Enhanced CEO Feedback display
require_once '../includes/config.php';
require_once '../includes/header.php';

// Get employee ID from query parameter or use logged-in user's ID
$requestedEmployeeId = $_GET['employee'] ?? $_SESSION['user_id'];
$loggedInUserId = $_SESSION['user_id'];

// Enhanced authorization check
function canViewFeedback($loggedInUserId, $requestedEmployeeId)
{
    // Users can always view their own feedback
    if ($loggedInUserId == $requestedEmployeeId) {
        return true;
    }

    // Admin, CEO (35), and HR Admin (15) can view all feedback
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
        return true;
    }

    if ($loggedInUserId == 35 || $loggedInUserId == 15) {
        return true;
    }

    // Check if user has permission to access feedback module
    if (!hasPermission($loggedInUserId, 'feedback')) {
        return false;
    }

    return false;
}

function canSubmitResponse($loggedInUserId, $feedbackEmployeeId)
{
    // ONLY the employee who received the feedback can submit responses
    return $loggedInUserId == $feedbackEmployeeId;
}

// Check if user has permission to view this feedback
if (!canViewFeedback($loggedInUserId, $requestedEmployeeId)) {
    header('Location: dashboard.php?error=access_denied');
    exit;
}

// Get CEO feedback for employee (only published)
$ceoFeedback = getCEOFeedback($requestedEmployeeId, false);
$feedbackCount = count($ceoFeedback);

// Get employee details
$employeeDetails = getEmployeeDetails($requestedEmployeeId);

// Handle employee response submission with enhanced security
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_response'])) {
    $feedbackId = intval($_POST['feedback_id']);
    $responseText = trim($_POST['response_text']);

    // Additional security: Verify the feedback belongs to the logged-in user
    $feedbackItem = getCEOFeedbackItem($feedbackId);

    if (!$feedbackItem) {
        echo "<script>Swal.fire('Error!', 'Invalid feedback item.', 'error');</script>";
    } elseif (!canSubmitResponse($loggedInUserId, $feedbackItem['employee_id'])) {
        echo "<script>Swal.fire('Error!', 'You are not authorized to respond to this feedback.', 'error');</script>";
    } elseif (empty($responseText)) {
        echo "<script>Swal.fire('Error!', 'Please enter your response.', 'error');</script>";
    } else {
        $result = saveFeedbackResponse($feedbackId, $loggedInUserId, $responseText);

        if ($result['success']) {
            echo "<script>
                Swal.fire('Success!', 'Response submitted successfully.', 'success')
                    .then(() => {
                        window.location.href = 'feedback.php?employee=' + $loggedInUserId;
                    });
            </script>";
        } else {
            echo "<script>Swal.fire('Error!', 'Failed to submit response.', 'error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEO Feedback - MERQ Performance Evaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <script src="../js/interactive.js"></script>
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #07cae9;
            --light-bg: #f8f9fa;
            --bg-color: #f7fafc;
            --card-bg: #ffffff;
            --header-bg: #ffffff77;
            /*rgba(255, 255, 255, 0.95);*/
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 12px;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --error-color: #f56565;
            --info-color: #4299e1;
            --border-color: #e2e8f0;
            --neon-green: #00ddff;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            --card-hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            color: #343a40;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .card-dashboard {
            transition: var(--transition);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            border: none;
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        .card-dashboard:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-hover-shadow);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #d9d9d9 100%);
            color: white;
            border-bottom: none;
            padding: 1.2rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        .performance-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .bg-needs-improvement {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .bg-developing {
            background: linear-gradient(135deg, #fd7e14 0%, #e76505 100%);
            color: white;
        }

        .bg-meets-expectations {
            background: linear-gradient(135deg, #ffc107 0%, #e6ac00 100%);
            color: black;
        }

        .bg-exceeds-expectations {
            background: linear-gradient(135deg, #20c997 0%, #19a97d 100%);
            color: white;
        }

        .bg-outstanding {
            background: linear-gradient(135deg, #198754 0%, #136b3f 100%);
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            animation: slideIn 0.5s ease-out;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .progress {
            height: 12px;
            border-radius: 10px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .list-group-item {
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px !important;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .accordion-button {
            border-radius: 8px !important;
            font-weight: 500;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-score {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 250px;
            }

            .stats-number {
                font-size: 1.8rem;
            }

            .card-dashboard {
                margin-bottom: 15px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 15px rgba(0, 51, 102, 0.4);
            z-index: 1000;
            cursor: pointer;
            transition: var(--transition);
        }

        .floating-action-btn:hover {
            transform: scale(1.1);
            background: #00264d;
        }

        .no-print {
            display: flex;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
            }
        }

        .tooltip-btn {
            cursor: pointer;
            color: var(--primary-color);
            margin-left: 5px;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .card-dashboard {
            transition: transform 0.3s;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .performance-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .bg-needs-improvement {
            background-color: #dc3545;
            color: white;
        }

        .bg-developing {
            background-color: #fd7e14;
            color: white;
        }

        .bg-meets-expectations {
            background-color: #ffc107;
            color: black;
        }

        .bg-exceeds-expectations {
            background-color: #20c997;
            color: white;
        }

        .bg-outstanding {
            background-color: #198754;
            color: white;
        }

        .sidebar {
            margin-top: 66px;
            background-color: #f8f9fa;
            height: 100vh;
            position: sticky;
            top: 100px;
            padding-top: 70px;
        }

        .main-content {
            padding: 20px;
        }

        .evaluation-table th {
            background-color: #003366;
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto;
                position: relative;
            }

            .chart-container {
                height: 250px;
            }
        }

        .mb-4 {
            margin-top: 55px !important;
            margin-bottom: 1.5rem !important;
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 15px;
        }

        .chart-legend-item {
            display: flex;
            align-items: center;
            margin: 5px 10px;
        }

        .chart-legend-color {
            width: 15px;
            height: 15px;
            margin-right: 5px;
            border-radius: 3px;
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: rgb(7 34 71) !important;
        }

        .btn-link {
            --bs-btn-font-weight: 400;
            --bs-btn-color: #f79b1f;
            --bs-btn-bg: transparent;
            --bs-btn-border-color: transparent;
            --bs-btn-hover-color: var(--bs-link-hover-color);
            --bs-btn-hover-border-color: transparent;
            --bs-btn-active-color: var(--bs-link-hover-color);
            --bs-btn-active-border-color: transparent;
            --bs-btn-disabled-color: #6c757d;
            --bs-btn-disabled-border-color: transparent;
            --bs-btn-box-shadow: 0 0 0 #000;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
            text-decoration: underline;
        }

        .btn-link:hover {
            color: #fafafa;
        }

        /* Digital Clock Styles */
        .digital-clock {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--neon-green);
            padding: 10px 15px;
            border-radius: var(--border-radius);
            display: inline-block;
            margin-right: 15px;
            box-shadow: var(--shadow);
        }

        .clock-time {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .clock-date {
            font-size: 0.9rem;
            text-align: center;
            margin-top: 5px;
            opacity: 0.9;
        }


        .feedback-hero {
            background: linear-gradient(135deg, #003366 0%, #004080 100%);
            color: white;
            padding: 1rem 0;
            margin-top: 50px;
            margin-bottom: 1rem;
            border-radius: 0 0 20px 20px;
        }

        .feedback-count-badge {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            animation: pulse 2s infinite;
        }

        .feedback-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .feedback-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .feedback-header {
            background: linear-gradient(135deg, #20c997 0%, #198754 100%);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }

        .priority-badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .feedback-content {
            padding: 2rem;
        }

        .response-card {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .no-feedback-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .no-feedback-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }

        .feedback-stats {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #003366;
            display: block;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .ceo-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #20c997;
        }

        .feedback-meta {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .feedback-hero {
                padding: 2rem 0;
            }

            .feedback-content {
                padding: 1rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="feedback-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-user-tie me-3"></i>
                        <?= $loggedInUserId == $requestedEmployeeId ?
                            'CEO Feedback & Guidance' :
                            'CEO Feedback for ' . htmlspecialchars($employeeDetails['full_name']) ?>
                    </h1>
                    <p class="lead mb-4">
                        <?php if ($loggedInUserId == $requestedEmployeeId): ?>
                            Personalized feedback and development guidance from the CEO to help you grow professionally.
                        <?php else: ?>
                            Viewing CEO feedback for <?= htmlspecialchars($employeeDetails['full_name']) ?>.
                        <?php endif; ?>
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($employeeDetails['full_name']) ?>&background=007bff&color=fff&size=64"
                                alt="<?= htmlspecialchars($employeeDetails['full_name']) ?>"
                                class="rounded-circle me-3" width="64" height="64">
                        </div>
                        <div>
                            <h5 class="mb-1"><?= htmlspecialchars($employeeDetails['full_name']) ?></h5>
                            <p class="mb-1"><?= htmlspecialchars($employeeDetails['position_title']) ?></p>
                            <p class="mb-0"><?= htmlspecialchars($employeeDetails['department_name'] ?? '') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <?php if ($feedbackCount > 0): ?>
                        <div class="mb-3">
                            <span class="badge bg-warning text-dark feedback-count-badge fs-6">
                                <i class="fas fa-comment-dots me-2"></i>
                                <?= $feedbackCount ?> Feedback Item(s)
                            </span>
                        </div>
                    <?php endif; ?>
                    <a href="dashboard.php" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Feedback Statistics -->
        <?php if ($feedbackCount > 0): ?>
            <div class="feedback-stats">
                <div class="row text-center">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number"><?= $feedbackCount ?></span>
                            <span class="stat-label">Total Feedback</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <?php
                            $highPriorityCount = array_reduce($ceoFeedback, function ($count, $feedback) {
                                return $count + ($feedback['priority'] === 'high' || $feedback['priority'] === 'critical' ? 1 : 0);
                            }, 0);
                            ?>
                            <span class="stat-number text-danger"><?= $highPriorityCount ?></span>
                            <span class="stat-label">High Priority</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <?php
                            $withTargetDate = array_reduce($ceoFeedback, function ($count, $feedback) {
                                return $count + (!empty($feedback['target_completion_date']) ? 1 : 0);
                            }, 0);
                            ?>
                            <span class="stat-number text-info"><?= $withTargetDate ?></span>
                            <span class="stat-label">With Deadlines</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <?php
                            $responseCount = 0;
                            foreach ($ceoFeedback as $feedback) {
                                $responses = getFeedbackResponses($feedback['id']);
                                $responseCount += count($responses);
                            }
                            ?>
                            <span class="stat-number text-success"><?= $responseCount ?></span>
                            <span class="stat-label">Your Responses</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Feedback Items -->
        <div class="row">
            <div class="col-12">
                <?php if (empty($ceoFeedback)): ?>
                    <!-- No Feedback State -->
                    <div class="no-feedback-state">
                        <div class="no-feedback-icon">
                            <i class="fas fa-comment-slash"></i>
                        </div>
                        <h3 class="h4 text-muted mb-3">No CEO Feedback Yet</h3>
                        <p class="text-muted mb-4">
                            You haven't received any CEO feedback at the moment. <br>
                            Continue your great work and check back later for personalized guidance.
                        </p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="dashboard.php" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                            </a>
                            <a href="my_report.php" class="btn btn-outline-primary">
                                <i class="fas fa-chart-bar me-2"></i>View My Report
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Feedback Accordion -->
                    <div class="accordion" id="ceoFeedbackAccordion">
                        <?php foreach ($ceoFeedback as $index => $feedback): ?>
                            <?php
                            $responses = getFeedbackResponses($feedback['id']);
                            $hasResponded = !empty($responses);
                            ?>

                            <div class="card feedback-card">
                                <div class="card-header feedback-header" id="feedbackHeading<?= $index ?>">
                                    <button class="accordion-button collapsed text-white bg-transparent border-0 p-0"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#feedbackCollapse<?= $index ?>"
                                        aria-expanded="false"
                                        aria-controls="feedbackCollapse<?= $index ?>">
                                        <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                            <div class="d-flex align-items-center">
                                                <span class="badge priority-badge bg-<?=
                                                                                        $feedback['priority'] == 'low' ? 'success' : ($feedback['priority'] == 'medium' ? 'warning' : ($feedback['priority'] == 'high' ? 'danger' : 'dark'))
                                                                                        ?> me-3">
                                                    <?= ucfirst($feedback['priority']) ?> Priority
                                                </span>
                                                <div>
                                                    <h6 class="mb-1"><?= htmlspecialchars($feedback['category_name'] ?? 'General Feedback') ?></h6>
                                                    <small>
                                                        <i class="fas fa-calendar me-1"></i>
                                                        <?= date('M j, Y', strtotime($feedback['created_at'])) ?>
                                                        <?php if (!empty($feedback['target_completion_date'])): ?>
                                                            • <i class="fas fa-flag me-1"></i>
                                                            Target: <?= date('M j, Y', strtotime($feedback['target_completion_date'])) ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <?php if ($hasResponded): ?>
                                                    <span class="badge bg-success me-2">
                                                        <i class="fas fa-check me-1"></i>Responded
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark me-2">
                                                        <i class="fas fa-clock me-1"></i>Awaiting Response
                                                    </span>
                                                <?php endif; ?>
                                                <i class="fas fa-chevron-down accordion-arrow"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="feedbackCollapse<?= $index ?>"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="feedbackHeading<?= $index ?>"
                                    data-bs-parent="#ceoFeedbackAccordion">
                                    <div class="card-body feedback-content">
                                        <!-- Feedback Meta -->
                                        <div class="feedback-meta">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Category:</strong>
                                                    <?= htmlspecialchars($feedback['category_name'] ?? 'General Feedback') ?>
                                                    <?php if (!empty($feedback['category_description'])): ?>
                                                        <br><small class="text-muted"><?= htmlspecialchars($feedback['category_description']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Priority:</strong>
                                                    <span class="badge bg-<?=
                                                                            $feedback['priority'] == 'low' ? 'success' : ($feedback['priority'] == 'medium' ? 'warning' : ($feedback['priority'] == 'high' ? 'danger' : 'dark'))
                                                                            ?>">
                                                        <?= ucfirst($feedback['priority']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Feedback Text -->

                                        <!-- CEO Signature -->
                                        <div class="text-muted small mt-4 pt-3 border-top">
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=CEO&background=20c997&color=fff&size=40"
                                                    alt="CEO"
                                                    class="ceo-avatar me-3">
                                                <div>
                                                    <strong>From: <?= htmlspecialchars($feedback['ceo_name']) ?></strong><br>
                                                    <span>Chief Executive Officer</span><br>
                                                    <span>Posted on <?= date('F j, Y g:i A', strtotime($feedback['created_at'])) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h6 class="text-primary mb-3">
                                                <i class="fas fa-comment me-2"></i>Feedback Message:
                                            </h6>
                                            <div class="p-3 bg-light rounded border">
                                                <?= nl2br(htmlspecialchars($feedback['feedback_text'])) ?>
                                            </div>
                                        </div>

                                        <?php if (!empty($feedback['target_completion_date'])): ?>
                                            <div class="alert alert-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-flag me-3 fs-4"></i>
                                                    <div>
                                                        <strong>Target Completion Date:</strong>
                                                        <span class="ms-2 fw-bold"><?= date('F j, Y', strtotime($feedback['target_completion_date'])) ?></span>
                                                        <?php
                                                        $today = new DateTime();
                                                        $targetDate = new DateTime($feedback['target_completion_date']);
                                                        $daysRemaining = $today->diff($targetDate)->days;
                                                        $isOverdue = $today > $targetDate;

                                                        // Check if employee has responded
                                                        $hasResponded = !empty($responses);
                                                        $lastResponseDate = null;
                                                        if ($hasResponded && !empty($responses[0]['submitted_at'])) {
                                                            $lastResponseDate = new DateTime($responses[0]['submitted_at']);
                                                        }

                                                        // Determine status
                                                        $statusClass = 'bg-success';
                                                        $statusText = '';

                                                        if ($hasResponded && $lastResponseDate && $lastResponseDate <= $targetDate) {
                                                            $statusText = 'Responded In Time';
                                                        } elseif ($hasResponded && $lastResponseDate && $lastResponseDate > $targetDate) {
                                                            $statusText = 'Responded Late by ' . $lastResponseDate->diff($targetDate)->days . ' days';
                                                            $statusClass = 'bg-warning text-dark';
                                                        } elseif (!$hasResponded && $isOverdue) {
                                                            $statusText = 'Overdue by ' . $daysRemaining . ' days';
                                                            $statusClass = 'bg-danger';
                                                        } elseif (!$hasResponded && !$isOverdue) {
                                                            $statusText = $daysRemaining . ' days remaining';
                                                            $statusClass = 'bg-success';
                                                        }
                                                        ?>
                                                        <?php if (!empty($statusText)): ?>
                                                            <span class="badge <?= $statusClass ?> ms-2"><?= $statusText ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Previous Responses -->
                                        <?php if (!empty($responses)): ?>
                                            <div class="mb-4">
                                                <h6 class="text-success mb-3">
                                                    <i class="fas fa-reply me-2"></i>
                                                    <?= canSubmitResponse($loggedInUserId, $feedback['employee_id']) ? 'Your Previous Responses' : 'Employee Responses' ?>:
                                                </h6>
                                                <?php foreach ($responses as $response): ?>
                                                    <div class="response-card">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <strong>
                                                                <?= canSubmitResponse($loggedInUserId, $feedback['employee_id']) ?
                                                                    'Your Response:' :
                                                                    htmlspecialchars($response['employee_name'] ?? 'Employee') . "'s Response:" ?>
                                                            </strong>
                                                            <small class="text-muted">
                                                                <?= date('M j, Y g:i A', strtotime($response['submitted_at'])) ?>
                                                            </small>
                                                        </div>
                                                        <p class="mb-0"><?= nl2br(htmlspecialchars($response['response_text'])) ?></p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Response Form -->
                                        <?php if (canSubmitResponse($loggedInUserId, $feedback['employee_id'])): ?>
                                            <div class="border rounded p-4 bg-white">
                                                <h6 class="text-primary mb-3">
                                                    <i class="fas fa-edit me-2"></i>
                                                    <?= $hasResponded ? 'Add Another Response' : 'Submit Your Response' ?>
                                                </h6>
                                                <form method="post" class="mt-2">
                                                    <input type="hidden" name="feedback_response" value="1">
                                                    <input type="hidden" name="feedback_id" value="<?= $feedback['id'] ?>">

                                                    <div class="mb-3">
                                                        <label for="responseText<?= $index ?>" class="form-label">
                                                            Your Response <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control"
                                                            id="responseText<?= $index ?>"
                                                            name="response_text"
                                                            rows="4"
                                                            placeholder="Share your thoughts, action plan, or any questions you have about this feedback..."
                                                            required></textarea>
                                                        <div class="form-text">
                                                            Please provide a thoughtful response to the CEO's feedback.
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            Your response will be visible to the CEO and HR.
                                                        </small>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-paper-plane me-2"></i>
                                                            <?= $hasResponded ? 'Update Response' : 'Submit Response' ?>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <!-- Message for users who cannot respond -->
                                            <?php if ($loggedInUserId != $feedback['employee_id']): ?>
                                                <div class="alert alert-info mt-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-info-circle me-3 fs-5"></i>
                                                        <div>
                                                            <strong>View Only:</strong> This feedback is for
                                                            <strong><?= htmlspecialchars(getEmployeeDetails($feedback['employee_id'])['full_name']) ?></strong>.
                                                            Only they can submit responses.
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php require_once '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced feedback page functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-expand the first feedback item if there are any
            const firstFeedbackItem = document.querySelector('.accordion-button');
            if (firstFeedbackItem && !firstFeedbackItem.classList.contains('collapsed')) {
                firstFeedbackItem.click();
            }

            // Add smooth scrolling to feedback items
            const urlParams = new URLSearchParams(window.location.search);
            const feedbackId = urlParams.get('feedback_id');
            if (feedbackId) {
                const feedbackElement = document.getElementById('feedbackHeading' + feedbackId);
                if (feedbackElement) {
                    const collapseElement = feedbackElement.querySelector('.accordion-button');
                    if (collapseElement) {
                        collapseElement.click();
                        setTimeout(() => {
                            feedbackElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }, 500);
                    }
                }
            }

            // Auto-resize textareas
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });

            // Add animation to cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.feedback-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add print functionality
            const printButton = document.getElementById('printFeedback');
            if (printButton) {
                printButton.addEventListener('click', function() {
                    window.print();
                });
            }
        });

        // Real-time character count for response textareas
        document.querySelectorAll('textarea[name="response_text"]').forEach(textarea => {
            const charCount = document.createElement('div');
            charCount.className = 'form-text text-end';
            charCount.textContent = '0 characters';
            textarea.parentNode.insertBefore(charCount, textarea.nextSibling);

            textarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count + ' characters';
                charCount.className = 'form-text text-end ' +
                    (count < 10 ? 'text-danger' :
                        count < 50 ? 'text-warning' : 'text-success');
            });
        });
    </script>
</body>

</html>