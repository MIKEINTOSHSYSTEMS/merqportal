<?php
// help.php - MERQ Employees Performance Evaluation System Help Page
// Place this file where your application can serve it, and wrap with auth includes if needed.
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Employees Performance Evaluation System — Help</title>
    <meta name="description" content="User Guide — MERQ Consultancy Employees Performance Evaluation System (EPES)">

    <!-- Basic modern styling (self-contained) -->
    <style>
        :root {
            --bg: #f6f8fb;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #0f172a;
            --primary: #0b5fff;
            --glass: rgba(255, 255, 255, 0.6);
            --radius: 12px;
            --max-width: 100%;
            /*1100px;*/
            --sidebar-w: 300px;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color: var(--accent);
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(180deg, var(--bg), #eef2f7);
            -webkit-font-smoothing: antialiased
        }

        a {
            color: var(--primary);
            text-decoration: none
        }

        .container {
            max-width: var(--max-width);
            margin: 28px auto;
            padding: 18px
        }

        /* Layout */
        .app {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .sidebar {
            width: var(--sidebar-w);
            min-width: 220px;
            background: var(--card);
            border-radius: var(--radius);
            padding: 18px;
            box-shadow: 0 6px 20px rgba(12, 15, 30, 0.06);
            position: sticky;
            top: 20px;
            height: calc(100vh - 40px);
            overflow: auto;
        }

        .main {
            flex: 1;
            background: transparent;
            min-width: 0;
        }

        header.app-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .brand {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .brand h1 {
            margin: 0;
            font-size: 18px;
            letter-spacing: 0.2px
        }

        .brand .sub {
            font-size: 12px;
            color: var(--muted)
        }

        .cover {
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 12px 40px rgba(12, 15, 30, 0.06);
            margin-bottom: 18px;
        }

        /* TOC and sidebar list */
        .toc-title {
            font-weight: 700;
            margin-bottom: 8px
        }

        .toc {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .toc li {
            margin: 8px 0
        }

        .toc a {
            display: block;
            padding: 8px;
            border-radius: 8px;
            color: var(--accent)
        }

        .toc a:hover {
            background: #f1f7ff
        }

        /* Search input */
        .search-wrap {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 12px
        }

        .search {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #e6e9ef;
            background: transparent;
            outline: none;
            font-size: 14px
        }

        .search:focus {
            box-shadow: 0 6px 18px rgba(11, 95, 255, 0.08);
            border-color: rgba(11, 95, 255, 0.15)
        }

        /* Content area */
        .content {
            background: var(--card);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: 0 10px 30px rgba(12, 15, 30, 0.05);
        }

        .section {
            margin-bottom: 22px;
            padding-bottom: 6px;
            border-bottom: 1px solid #eef2f5;
        }

        .section h2 {
            margin: 0 0 8px 0;
            font-size: 18px
        }

        .muted {
            color: var(--muted);
            font-size: 13px
        }

        .lead {
            font-size: 15px;
            line-height: 1.55;
            color: #0f172a
        }

        .small {
            font-size: 13px;
            color: var(--muted)
        }

        .kbd {
            background: #f1f5f9;
            border-radius: 6px;
            padding: 4px 8px;
            font-family: monospace;
            font-size: 12px
        }

        /* Collapsible */
        .collapsible {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-radius: 8px
        }

        .collapsible:hover {
            background: #fbfcff
        }

        .panel {
            max-height: 2000px;
            overflow: hidden;
            transition: max-height .28s ease;
            padding-top: 8px
        }

        /* anchors */
        .anchor-link {
            font-size: 12px;
            color: var(--muted);
            margin-left: 6px;
            text-decoration: none
        }

        .meta {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px
        }

        /* Responsive */
        @media (max-width:980px) {
            .app {
                flex-direction: column
            }

            .sidebar {
                position: relative;
                height: auto;
                order: 2
            }

            .main {
                order: 1
            }
        }

        /* Mobile topbar & hamburger */
        .mobile-top {
            display: none;
            background: var(--card);
            border-radius: 12px;
            padding: 8px;
            margin-bottom: 12px;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 6px 20px rgba(12, 15, 30, 0.06);
        }

        .hamburger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer
        }

        .hamburger .line {
            width: 22px;
            height: 2px;
            background: var(--accent);
            display: block;
            border-radius: 2px
        }

        @media (max-width:720px) {
            .mobile-top {
                display: flex
            }

            .sidebar {
                display: none
            }

            .sidebar.open {
                display: block;
                position: fixed;
                left: 12px;
                right: 12px;
                top: 72px;
                z-index: 50;
                height: auto;
                max-height: 66vh;
                overflow: auto
            }
        }

        /* highlight match */
        mark.match {
            background: #fff04d;
            color: #0b0b00;
            padding: 0 2px;
            border-radius: 2px
        }

        /* small helpers */
        .muted-block {
            background: #fbfbfd;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #f0f2f7
        }

        .contact {
            display: flex;
            gap: 12px;
            align-items: center
        }

        footer {
            margin-top: 18px;
            color: var(--muted);
            font-size: 13px;
            padding: 8px
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="mobile-top" role="region" aria-label="Mobile top controls">
            <div style="display:flex;align-items:center;gap:12px">
                <div class="hamburger" id="hamburger" aria-expanded="false" aria-controls="sidebar" title="Toggle menu">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
                <div>
                    <strong>Employees Performance Evaluation System</strong>
                    <div class="small">EPES • Help</div>
                </div>
            </div>

            <div style="width:50%">
                <input id="searchMobile" class="search" type="search" placeholder="Search help..." aria-label="Search help" />
            </div>
        </div>

        <div class="app" role="main">
            <!-- SIDEBAR -->
            <aside id="sidebar" class="sidebar" role="navigation" aria-label="Help table of contents">
                <div class="app-header">
                    <div class="brand">
                        <h1>Employees Performance Evaluation System</h1>
                        <div class="sub">EPES • User Guide — Version 1.0 • September 2025</div>
                    </div>
                </div>

                <div class="cover">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div>
                            <div style="font-weight:700">Prepared By</div>
                            <div class="small">Michael Kifle Teferra<br />Information Systems & Digital Health Unit Manager</div>
                        </div>
                        <div style="text-align:right">
                            <div class="small">v1.0</div>
                        </div>
                    </div>
                    <div class="meta">A concise guide to accessing, using, and administering the MERQ performance evaluation platform.</div>
                </div>

                <div style="margin-bottom:10px">
                    <div class="toc-title">Table of Contents</div>
                    <input id="searchSidebar" class="search" type="search" placeholder="Search in help..." aria-label="Search help sidebar" />
                </div>

                <ul class="toc" id="tocList">
                    <li><a href="#introduction">1. Introduction</a></li>
                    <li><a href="#accessing">2. Accessing the System</a></li>
                    <li><a href="#logging">3. Logging In</a></li>
                    <li><a href="#password">4. Changing Your Password</a></li>
                    <li><a href="#dashboard">5. Main Dashboard Overview</a></li>
                    <li><a href="#reports">6. Viewing Your Reports</a></li>
                    <li><a href="#evaluations">7. Conducting Evaluations</a></li>
                    <li><a href="#admin">8. Admin & CEO Guide</a></li>
                    <li><a href="#privacy">9. Privacy & Security Notes</a></li>
                    <li><a href="#faq">10. Troubleshooting & FAQs</a></li>
                    <li><a href="#support">11. Support & Contact</a></li>
                </ul>

                <div style="height:12px"></div>
                <div class="muted small">
                    Tip: Use the search box to quickly find a topic. Click any heading to expand/collapse it.
                </div>
            </aside>

            <!-- MAIN -->
            <div class="main">
                <div class="content" id="content">
                    <header class="app-header" style="margin-bottom:8px">
                        <div class="brand" style="gap:4px">
                            <h1 style="font-size:20px;margin:0">Employees Performance Evaluation System — Help</h1>
                            <div class="sub">EPES • User Guide • Version 1.0 — September 2025</div>
                        </div>
                        <div style="margin-left:auto" class="contact">
                            <div class="small">Prepared by: <strong>ISDHU</strong></div>
                        </div>
                    </header>

                    <!-- Global search (desktop) -->
                    <div style="display:flex;gap:10px;margin-bottom:16px;align-items:center">
                        <input id="globalSearch" class="search" type="search" placeholder="Search all help content (press ESC to clear)..." aria-label="Search help content" />
                        <div class="small muted">Matches: <span id="matchCount">0</span></div>
                    </div>

                    <!-- Sections -->
                    <section id="introduction" class="section">
                        <div class="collapsible" role="button" aria-expanded="true" tabindex="0" data-target="panel-intro">
                            <div>
                                <h2>1. Introduction</h2>
                                <div class="small muted">What this guide contains</div>
                            </div>
                            <a class="anchor-link" href="#introduction">#</a>
                        </div>
                        <div id="panel-intro" class="panel" style="max-height:1200px">
                            <p class="lead">
                                The MERQ Consultancy Employees Performance Evaluation System is designed to provide a transparent,
                                structured, and interactive way for employees and leadership to engage in performance reviews.
                                This guide explains how to access, navigate, and use the system effectively.
                            </p>
                        </div>
                    </section>

                    <section id="accessing" class="section">
                        <div class="collapsible" role="button" aria-expanded="true" tabindex="0" data-target="panel-accessing">
                            <div>
                                <h2>2. Accessing the System</h2>
                                <div class="small muted">Where to open the application</div>
                            </div>
                            <a class="anchor-link" href="#accessing">#</a>
                        </div>
                        <div id="panel-accessing" class="panel" style="max-height:400px">
                            <ol class="lead">
                                <li>Open your web browser.</li>
                                <li>Go to: <a href="https://app.merqconsultancy.org/apps/performance/public/" target="_blank" rel="noopener">https://app.merqconsultancy.org/apps/performance/public/</a></li>
                            </ol>
                            <p class="small muted">After opening the above URL enter your credentials to login.</p>
                        </div>
                    </section>

                    <section id="logging" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-logging">
                            <div>
                                <h2>3. Logging In</h2>
                                <div class="small muted">Credentials and first-time login</div>
                            </div>
                            <a class="anchor-link" href="#logging">#</a>
                        </div>
                        <div id="panel-logging" class="panel" style="max-height:0">
                            <p class="lead">
                                Use your MERQ organizational email (e.g., <span class="kbd">firstname.lastname@merqconsultancy.org</span>).
                            </p>
                            <ul class="lead">
                                <li>Enter the initial temporary password: <span class="kbd">01234567</span>.</li>
                                <li>You will be prompted to change your password after the first login for security.</li>
                            </ul>
                            <img src="assets/pictures/login.jpg" width="25%">
                            <p class="small muted">After opening the URL, enter your credentials to login.</p>
                        </div>
                    </section>

                    <section id="password" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-password">
                            <div>
                                <h2>4. Changing Your Password</h2>
                                <div class="small muted">Keep your account secure</div>
                            </div>
                            <a class="anchor-link" href="#password">#</a>
                        </div>
                        <div id="panel-password" class="panel" style="max-height:0">
                            <ol class="lead">
                                <li>After login, click your profile name in the top navigation menu.</li>
                                <img src="assets/pictures/user_dropdown_menu.png" width="25%">
                                <li>Select <strong>Change Password</strong>.</li>
                                <img src="assets/pictures/change_password.png" width="25%">
                                <li>Enter a secure password and confirm.</li>
                            </ol>
                            <p class="small muted">Which you need to change to stay secured by clicking on your profile name after logging in on the top navigation menu.</p>
                        </div>
                    </section>

                    <section id="dashboard" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-dashboard">
                            <div>
                                <h2>5. Main Dashboard Overview</h2>
                                <div class="small muted">What you see after login</div>
                            </div>
                            <a class="anchor-link" href="#dashboard">#</a>
                        </div>
                        <div id="panel-dashboard" class="panel" style="max-height:0">
                            <p class="lead">
                                Once logged in, you will see <strong>'My Dashboard'</strong>, which includes:
                            </p>
                            <img src="assets/pictures/main_dashboard.png" width="25%">
                            <ul class="lead">
                                <li>Overview of your evaluations.</li>
                                <li>Performance scores by category.</li>
                                <li>Key performance highlights.</li>
                            </ul>
                            <p class="small muted">
                                In the dashboard you can see all the evaluation criteria and details of your performance overview.
                                (Insert screenshot placeholder)
                            </p>
                        </div>
                    </section>

                    <section id="reports" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-reports">
                            <div>
                                <h2>6. Viewing Your Reports</h2>
                                <div class="small muted">My Report & CEO feedback</div>
                            </div>
                            <a class="anchor-link" href="#reports">#</a>
                        </div>
                        <div id="panel-reports" class="panel" style="max-height:0">
                            <p class="lead">
                                Navigate to <strong>'My Report'</strong>. You will see:
                            </p>
                            <ul class="lead">
                                <img src="assets/pictures/reports.png" width="25%">

                                <li>Detailed scores by criteria.</li>
                                <li>Strengths and improvement areas.</li>
                                <li>Suggested improvements.</li>
                                <li>CEO feedback (with priorities).</li>
                            </ul>

                            <p class="lead">
                                You can reply to feedback and acknowledge receipt.
                            </p>

                            <p class="small muted">
                                For detailed report on all criteria as well as given feedback you can click on My Report and view all evaluation details
                                given to you including scores for each question grouped in category as well as your strengths and your improvements
                                as well as suggested improvements based on categories you have gotten low scores.
                            </p>

                            <p class="small muted">
                                Additionally you will also find a section at the bottom of My Report page which includes feedback from your CEO categorized by priorities.
                                In addition to these you can reply to the feedback you got from your CEO and acknowledge the recipient of the given feedback.
                            </p>
                        </div>
                    </section>

                    <section id="evaluations" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-evaluations">
                            <div>
                                <h2>7. Conducting Evaluations</h2>
                                <div class="small muted">How to submit evaluations</div>
                            </div>
                            <a class="anchor-link" href="#evaluations">#</a>
                        </div>
                        <div id="panel-evaluations" class="panel" style="max-height:0">
                            <ol class="lead">
                                <li>Click <strong>'Go to Evaluation'</strong> from the left menu.</li>
                                <li>Complete the evaluation form.</li>
                                <li>Submit your evaluation.</li>
                            </ol>

                            <p class="lead">You can conduct different types of evaluations:</p>
                            <ul class="lead">
                                <li>Self-Evaluation – evaluating yourself.</li>
                                <li>Supervisor Evaluation – evaluating your subordinates.</li>
                                <li>Subordinate Evaluation – evaluating your supervisor.</li>
                                <li>Colleague Evaluation – evaluating peers.</li>
                            </ul>

                            <p class="small muted">
                                To evaluate another employee after you have successfully submitted your evaluation click on Go to evaluation and it will launch another session
                                for you to evaluate as a Colleague, as a Subordinate (Evaluating your Supervisor), as a Supervisor (Evaluating your Subordinates) and Self-evaluation to evaluate yourself.
                            </p>
                        </div>
                    </section>

                    <section id="admin" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-admin">
                            <div>
                                <h2>8. Admin & CEO Guide</h2>
                                <div class="small muted">Admin Dashboard & CEO feedback</div>
                            </div>
                            <a class="anchor-link" href="#admin">#</a>
                        </div>
                        <div id="panel-admin" class="panel" style="max-height:0">
                            <div class="lead">
                                <strong>Admin Dashboard:</strong>
                                <p>
                                    <img src="assets/pictures/admin_dashboard.png" width="25%">
                                </p>
                                <ul>
                                    <li>View overall evaluation scores.</li>
                                    <li>Access individual reports under 'All Employees Reports.'</li>
                                </ul>
                            </div>

                            <p class="small muted">NOTE: For privacy and sensitive data presence here in the dashboard demo screenshots are omitted. There are many features and functionalities not listed here.</p>

                            <div style="margin-top:12px">
                                <strong>CEO Feedback & Comments:</strong>
                                <p> <img src="assets/pictures/ceo_feedback.png" width="25%"></p>
                                <ul class="lead">
                                    <li>CEOs can add feedback by selecting:</li>
                                    <ul class="lead">
                                        <li>Feedback Category</li>
                                        <li>Priority</li>
                                        <li>Status (Published or Draft)</li>
                                    </ul>
                                </ul>
                                <p class="lead">Employees will see feedback and can respond.</p>
                                <img src="assets/pictures/ceo_feedback_comments.png" width="25%">
                                <p class="small muted">
                                    To add new feedback you can click on to select feedback category, priority and Status (Published/ Draft) to be posted on the employee’s page
                                    so that the employee will be able to see the comments and feedback and respond accordingly.
                                </p>
                            </div>
                        </div>
                    </section>

                    <section id="privacy" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-privacy">
                            <div>
                                <h2>9. Privacy & Security Notes</h2>
                                <div class="small muted">Confidentiality & access</div>
                            </div>
                            <a class="anchor-link" href="#privacy">#</a>
                        </div>
                        <div id="panel-privacy" class="panel" style="max-height:0">
                            <ul class="lead">
                                <li>All evaluation data is confidential.</li>
                                <li>Employees only see their own reports and CEO feedback.</li>
                                <li>Admins/CEOs have broader access for reporting purposes.</li>
                            </ul>
                        </div>
                    </section>

                    <section id="faq" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-faq">
                            <div>
                                <h2>10. Troubleshooting & FAQs</h2>
                                <div class="small muted">Common issues & solutions</div>
                            </div>
                            <a class="anchor-link" href="#faq">#</a>
                        </div>
                        <div id="panel-faq" class="panel" style="max-height:0">
                            <div class="muted-block">
                                <p><strong>Q:</strong> I forgot my password. What should I do?</p>
                                <p><strong>A:</strong> Contact IT support.</p>
                            </div>

                            <div style="margin-top:8px" class="muted-block">
                                <p><strong>Q:</strong> I cannot see my evaluations.</p>
                                <p><strong>A:</strong> Ensure the evaluation period is active. If issues persist, contact your supervisor.</p>
                            </div>

                            <div style="margin-top:8px" class="muted-block">
                                <p><strong>Q:</strong> My dashboard looks blank.</p>
                                <p><strong>A:</strong> Refresh the page or log out and back in. If still blank, contact IT support.</p>
                            </div>
                        </div>
                    </section>

                    <section id="support" class="section">
                        <div class="collapsible" role="button" aria-expanded="false" tabindex="0" data-target="panel-support">
                            <div>
                                <h2>11. Support & Contact</h2>
                                <div class="small muted">Who to contact for help</div>
                            </div>
                            <a class="anchor-link" href="#support">#</a>
                        </div>
                        <div id="panel-support" class="panel" style="max-height:0">
                            <p class="lead">
                                For questions or technical issues, please contact:
                            </p>

                            <p class="lead">
                                <strong>MERQ Information Systems & Digital Health Unit</strong><br />
                                Email: <a href="mailto:support@merqconsultancy.org">support@merqconsultancy.org</a><br />
                                Phone: <a href="tel:+251913391985">+251 913 391 985</a>
                            </p>

                            <p class="small muted">Developed by: MERQ Information Systems & Digital Health Unit</p>
                        </div>
                    </section>

                    <footer>
                        © MERQ Consultancy • Employees Performance Evaluation System (EPES) • Version 1.0 — September 2025
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../includes/footer.php'; ?>

    <!-- Scripts: search, highlight, accordion, mobile toggle -->
    <script>
        // Utilities
        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        // Accordion behavior: toggle panels
        document.querySelectorAll('.collapsible').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                // Support keyboard 'Enter' / 'Space' 
                if (e.type === 'click' || (e.type === 'keydown' && (e.key === 'Enter' || e.key === ' '))) {
                    const targetId = btn.getAttribute('data-target');
                    const panel = document.getElementById(targetId);
                    const isOpen = btn.getAttribute('aria-expanded') === 'true' || btn.getAttribute('aria-expanded') === '1';
                    btn.setAttribute('aria-expanded', !isOpen);
                    if (!isOpen) {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                    } else {
                        panel.style.maxHeight = '0';
                    }
                }
            });
            // Allow keyboard access
            btn.addEventListener('keydown', function(ev) {
                if (ev.key === 'Enter' || ev.key === ' ') {
                    ev.preventDefault();
                    btn.click();
                }
            });
        });

        // Global search + highlight
        const globalSearch = document.getElementById('globalSearch');
        const searchSidebar = document.getElementById('searchSidebar');
        const searchMobile = document.getElementById('searchMobile');
        const matchCountEl = document.getElementById('matchCount');
        const contentEl = document.getElementById('content');

        // Helper to clear highlights
        function clearHighlights() {
            const marks = contentEl.querySelectorAll('mark.match');
            marks.forEach(m => {
                const parent = m.parentNode;
                parent.replaceChild(document.createTextNode(m.textContent), m);
                parent.normalize && parent.normalize();
            });
        }

        function doSearch(term) {
            clearHighlights();
            if (!term || term.trim().length === 0) {
                // show all sections
                document.querySelectorAll('.section').forEach(s => s.style.display = '');
                matchCountEl.textContent = 0;
                return;
            }
            const q = term.trim();
            const re = new RegExp('(' + escapeRegExp(q) + ')', 'ig');
            let totalMatches = 0;
            // search each section text and highlight
            document.querySelectorAll('.section').forEach(function(section) {
                const textNodes = [];
                // gather paragraphs and list items only (keep markup)
                const targets = section.querySelectorAll('p, li, .lead, .small, .muted, .muted-block');
                let sectionText = '';
                targets.forEach(t => {
                    sectionText += ' ' + t.textContent;
                });
                if (re.test(sectionText)) {
                    // show this section
                    section.style.display = '';
                    // highlight inside the section: replace innerHTML safe-ish for limited tags
                    targets.forEach(t => {
                        // Skip elements that are links or contain anchors
                        const original = t.innerHTML;
                        const replaced = original.replace(re, '<mark class="match">$1</mark>');
                        if (replaced !== original) {
                            t.innerHTML = replaced;
                            totalMatches += (original.match(re) || []).length;
                        }
                    });
                    // expand panel
                    const panel = section.querySelector('.panel');
                    if (panel) {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                    }
                } else {
                    // hide section
                    section.style.display = 'none';
                }
            });
            matchCountEl.textContent = totalMatches;
        }

        [globalSearch, searchSidebar, searchMobile].forEach(function(el) {
            if (!el) return;
            el.addEventListener('input', function() {
                doSearch(this.value);
            });
            el.addEventListener('keydown', function(ev) {
                if (ev.key === 'Escape') {
                    this.value = '';
                    doSearch('');
                }
            });
        });

        // Sidebar search sync (typing in top boxes should reflect in the others)
        function syncSearchInputs(value) {
            [globalSearch, searchSidebar, searchMobile].forEach(function(i) {
                if (i && i.value !== value) i.value = value;
            });
        }
        [globalSearch, searchSidebar, searchMobile].forEach(function(i) {
            if (!i) return;
            i.addEventListener('input', function() {
                syncSearchInputs(this.value);
            });
        });

        // Mobile hamburger toggle
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        if (hamburger && sidebar) {
            hamburger.addEventListener('click', function() {
                const open = sidebar.classList.toggle('open');
                hamburger.setAttribute('aria-expanded', open);
            });
        }

        // Smoothly scroll to anchors and focus
        document.querySelectorAll('a[href^="#"]').forEach(function(a) {
            a.addEventListener('click', function(e) {
                const id = this.getAttribute('href').substring(1);
                const el = document.getElementById(id);
                if (el) {
                    e.preventDefault();
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // expand the panel for that section
                    const panel = el.querySelector('.panel');
                    if (panel) {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                    }
                }
            });
        });

        // On load: set panels heights for those with aria-expanded true
        window.addEventListener('load', function() {
            document.querySelectorAll('.collapsible').forEach(function(btn) {
                const targetId = btn.getAttribute('data-target');
                const panel = document.getElementById(targetId);
                const isOpen = btn.getAttribute('aria-expanded') === 'true' || btn.getAttribute('aria-expanded') === '1';
                if (isOpen) {
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                } else {
                    panel.style.maxHeight = '0';
                }
            });
        });
    </script>
</body>

</html>