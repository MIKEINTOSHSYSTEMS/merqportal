<?php
// dashboard.php - Employee dashboard showing only their data
require_once '../includes/config.php';
require_once '../includes/header.php';


// Get employee ID from query parameter or use logged-in user's ID
$employeeId = $_GET['employee'] ?? $_SESSION['user_id'];

// Get the logged-in user's ID
$userId = $_SESSION['user_id'];

// Fetch and process data for this user only
$submissions = getSubmissions();
// Count them
$totalSubmissions = count($submissions);
$employeeEvaluations = calculateWeightedScores($submissions);

$employeeData = $employeeEvaluations[$employeeId];

// Filter to show only the current user's data
$userData = isset($employeeEvaluations[$userId]) ? $employeeEvaluations[$userId] : null;

// Get employee details
$employeeDetails = getEmployeeDetails($userId);
$strengthsAndImprovements = $userData ? getStrengthsAndImprovements($userData['evaluations']) : ['strengths' => [], 'improvements' => []];

// Prepare data for charts
$categoryLabels = [];
$categoryScores = [];

if ($userData && isset($userData['category_scores']) && is_array($userData['category_scores'])) {
    foreach ($userData['category_scores'] as $category => $scoreData) {
        if (isset($scoreData['count']) && $scoreData['count'] > 0) {
            $categoryLabels[] = substr($category, 0, 15) . (strlen($category) > 15 ? '...' : '');
            $categoryScores[] = round($scoreData['percentage'], 1);
        }
    }
}

// Get CEO feedback for employee (only published)
$ceoFeedback = getCEOFeedback($employeeId, false);

// Handle employee response submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_response'])) {
    $feedbackId = intval($_POST['feedback_id']);
    $responseText = trim($_POST['response_text']);

    if (empty($responseText)) {
        echo "<script>Swal.fire('Error!', 'Please enter your response.', 'error');</script>";
    } else {
        $result = saveFeedbackResponse($feedbackId, $employeeId, $responseText);

        if ($result['success']) {
            echo "<script>
        Swal.fire('Success!', 'Response submitted successfully.', 'success')
            .then(() => {
                // Change the page location to dashboard.php
                window.location.href = 'dashboard.php';
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
    <title>MERQ Performance Evaluation Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="../script/performance.js"></script>
    <link href="../css/main.css" rel="stylesheet">
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
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <!-- CEO Feedback Section (Visible to Employee) -->
                    <?php if (!empty($ceoFeedback)): ?>
                        <div class="card card-report">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-user-tie me-2"></i>CEO Feedback & Guidance</h5>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="ceoFeedbackAccordion">
                                    <?php foreach ($ceoFeedback as $index => $feedback): ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="feedbackHeading<?= $index ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#feedbackCollapse<?= $index ?>" aria-expanded="false">
                                                    <div class="d-flex justify-content-between w-100 me-3">
                                                        <span>
                                                            <span class="badge bg-<?=
                                                                                    $feedback['priority'] == 'low' ? 'success' : ($feedback['priority'] == 'medium' ? 'warning' : ($feedback['priority'] == 'high' ? 'danger' : 'dark'))
                                                                                    ?> me-2"><?= ucfirst($feedback['priority']) ?></span>
                                                            <?= htmlspecialchars($feedback['category_name'] ?? 'General Feedback') ?>
                                                        </span>
                                                        <small class="text-muted"><?= date('M j, Y', strtotime($feedback['created_at'])) ?></small>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="feedbackCollapse<?= $index ?>" class="accordion-collapse collapse"
                                                aria-labelledby="feedbackHeading<?= $index ?>" data-bs-parent="#ceoFeedbackAccordion">
                                                <div class="accordion-body">
                                                    <div class="mb-3">
                                                        <strong>Category:</strong> <?= htmlspecialchars($feedback['category_name'] ?? 'General Feedback') ?><br>
                                                        <strong>Priority:</strong> <span class="badge bg-<?=
                                                                                                            $feedback['priority'] == 'low' ? 'success' : ($feedback['priority'] == 'medium' ? 'warning' : ($feedback['priority'] == 'high' ? 'danger' : 'dark'))
                                                                                                            ?>"><?= ucfirst($feedback['priority']) ?></span>
                                                    </div>

                                                    <div class="mb-3">
                                                        <strong>Feedback:</strong>
                                                        <p class="mt-2 p-3 bg-light rounded"><?= nl2br(htmlspecialchars($feedback['feedback_text'])) ?></p>
                                                    </div>

                                                    <?php if (!empty($feedback['target_completion_date'])): ?>
                                                        <div class="mb-3">
                                                            <strong>Target Completion Date:</strong>
                                                            <span class="ms-2"><?= date('F j, Y', strtotime($feedback['target_completion_date'])) ?></span>
                                                        </div>
                                                    <?php endif; ?>



                                                    <!-- Existing Responses -->
                                                    <?php $responses = getFeedbackResponses($feedback['id']); ?>
                                                    <?php if (!empty($responses)): ?>
                                                        <div class="mt-4">
                                                            <h6>Your Previous Responses:</h6>
                                                            <?php foreach ($responses as $response): ?>
                                                                <div class="card mb-2">
                                                                    <div class="card-body">
                                                                        <p class="mb-2"><?= nl2br(htmlspecialchars($response['response_text'])) ?></p>
                                                                        <small class="text-muted">
                                                                            Submitted on <?= date('M j, Y g:i A', strtotime($response['submitted_at'])) ?>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Response Form -->
                                                    <div class="mt-4 p-3 border rounded">
                                                        <h6>Your Response:</h6>
                                                        <form method="post" class="mt-2">
                                                            <input type="hidden" name="feedback_response" value="1">
                                                            <input type="hidden" name="feedback_id" value="<?= $feedback['id'] ?>">

                                                            <div class="mb-3">
                                                                <textarea class="form-control" name="response_text" rows="3"
                                                                    placeholder="Enter your response to this feedback..." required></textarea>
                                                            </div>

                                                            <button type="submit" class="btn btn-info btn-sm">
                                                                <i class="fas fa-reply me-1"></i> Submit Response
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <div class="text-muted small mt-3">
                                                        <strong>From CEO:</strong> <?= htmlspecialchars($feedback['ceo_name']) ?>
                                                        on <?= date('F j, Y g:i A', strtotime($feedback['created_at'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Animate elements on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats cards
            anime({
                targets: '.stats-card',
                translateY: [50, 0],
                opacity: [0, 1],
                delay: anime.stagger(100),
                duration: 800,
                easing: 'easeOutQuart'
            });

            // Animate progress bars
            setTimeout(function() {
                document.querySelectorAll('.progress-bar').forEach(function(bar) {
                    bar.style.transition = 'width 1.5s ease-in-out';
                });
            }, 500);
        });

        // Category Performance Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($categoryLabels) ?>,
                datasets: [{
                    label: 'Score (%)',
                    data: <?= json_encode($categoryScores) ?>,
                    backgroundColor: '#00799BFF',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw + '%';
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value) {
                            return value + '%';
                        },
                        color: '#343a40',
                        font: {
                            weight: 'bold',
                            size: 11
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            },
            plugins: [ChartDataLabels]
        });

        // Refresh data function
        function refreshData() {
            const refreshBtn = document.getElementById('refreshBtn');
            const originalHtml = refreshBtn.innerHTML;

            // Show loading state
            refreshBtn.innerHTML = '<span class="loading-spinner"></span> Refreshing...';
            refreshBtn.disabled = true;

            // Simulate refresh (in a real app, this would be an AJAX call)
            setTimeout(function() {
                // Reload the page
                window.location.reload();
            }, 1500);
        }

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Add event listener for scroll to show/hide floating button
        window.addEventListener('scroll', function() {
            const floatingBtn = document.querySelector('.floating-action-btn');
            if (window.scrollY > 300) {
                floatingBtn.style.display = 'flex';
                anime({
                    targets: '.floating-action-btn',
                    opacity: 1,
                    scale: [0.8, 1],
                    duration: 500,
                    easing: 'easeOutQuart'
                });
            } else {
                floatingBtn.style.display = 'none';
            }
        });

        // CEO Feedback Form Enhancement
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-resize textareas
            const textareas = document.querySelectorAll('textarea[name="feedback_text"]');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });

            // Priority color coding
            const priorityBadges = document.querySelectorAll('.badge.bg-success, .badge.bg-warning, .badge.bg-danger, .badge.bg-dark');
            priorityBadges.forEach(badge => {
                const text = badge.textContent.toLowerCase().trim();
                if (text === 'low') badge.classList.add('bg-success');
                else if (text === 'medium') badge.classList.add('bg-warning');
                else if (text === 'high') badge.classList.add('bg-danger');
                else if (text === 'critical') badge.classList.add('bg-dark');
            });
        });

        // Form validation
        function validateFeedbackForm() {
            const form = document.getElementById('ceoFeedbackForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const textarea = form.querySelector('textarea[name="feedback_text"]');
                    if (textarea.value.trim().length < 10) {
                        e.preventDefault();
                        Swal.fire('Validation Error', 'Please enter at least 10 characters of feedback.', 'warning');
                        textarea.focus();
                    }
                });
            }
        }

        validateFeedbackForm();
    </script>

    <script>
        // Enhanced CEO Feedback functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-resize textareas
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
                // Trigger initial resize
                textarea.dispatchEvent(new Event('input'));
            });

            // Form validation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const textareas = this.querySelectorAll('textarea[required]');
                    for (let textarea of textareas) {
                        if (textarea.value.trim().length < 5) {
                            e.preventDefault();
                            Swal.fire('Validation Error', 'Please enter at least 5 characters.', 'warning');
                            textarea.focus();
                            return;
                        }
                    }
                });
            });

            // Priority badge coloring
            document.querySelectorAll('.badge').forEach(badge => {
                const text = badge.textContent.toLowerCase().trim();
                if (text === 'low') badge.classList.add('bg-success');
                else if (text === 'medium') badge.classList.add('bg-warning');
                else if (text === 'high') badge.classList.add('bg-danger');
                else if (text === 'critical') badge.classList.add('bg-dark');
                else if (text === 'draft') badge.classList.add('bg-secondary');
                else if (text === 'published') badge.classList.add('bg-success');
                else if (text === 'archived') badge.classList.add('bg-dark');
            });
        });
    </script>

    <?php require_once '../includes/footer.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>