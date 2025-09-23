<?php
// header.php - Responsive header with navigation
$currentPage = basename($_SERVER['PHP_SELF']);

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/session-config.php';
}

require_once 'auth_check.php'; // Add this line for authentication

// Get user data from session
$userName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User';
$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$avatarName = urlencode($userName);

// Get employee ID from query parameter or use logged-in user's ID
$employeeId = $_GET['employee'] ?? $_SESSION['user_id'];

// Get the logged-in user's ID
$userId = $_SESSION['user_id'];

// Get employee details
$employeeDetails = getEmployeeDetails($userId);

// Check if we're showing the evaluation iframe
$showEvaluation = isset($_GET['evaluation']) && $_GET['evaluation'] == 'true';

// Determine if the evaluation menu item should be active
$isEvaluationActive = $showEvaluation;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Consultancy - Performance Evaluation System</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Add this after Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Header and Sidebar Specific Styles Only */
        .sys-header {
            background-color: #072247D4;
            height: 70px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
        }

        .sys-sidebar-expanded .sys-header {
            left: 250px;
        }

        .sys-sidebar-collapsed .sys-header {
            left: 70px;
        }

        @media (max-width: 768px) {

            .sys-sidebar-expanded .sys-header,
            .sys-sidebar-collapsed .sys-header {
                left: 0;
            }
        }

        .sys-logo-container {
            display: flex;
            align-items: center;
            padding: 0 15px;
            height: 70px;
        }

        .sys-logo {
            height: 40px;
            margin-right: 10px;
        }

        .sys-brand-text {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            white-space: nowrap;
        }

        .sys-nav-user-info {
            color: white;
            display: flex;
            align-items: center;
        }

        .sys-nav-user-info img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* Sidebar Styles */
        .sys-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: #072247;
            z-index: 1020;
            transition: all 0.3s ease;
            overflow-y: auto;
            padding-top: 70px;
        }

        .sys-sidebar-collapsed .sys-sidebar {
            width: 70px;
        }

        .sys-sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .sys-sidebar-menu li {
            margin-bottom: 5px;
            position: relative;
        }

        .sys-sidebar-menu a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            transition: all 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }

        .sys-sidebar-menu a:hover,
        .sys-sidebar-menu a.sys-active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid #20c997;
        }

        .sys-sidebar-menu i {
            margin-right: 15px;
            font-size: 1.1rem;
            min-width: 25px;
            text-align: center;
        }

        .sys-sidebar-collapsed .sys-sidebar-menu span {
            display: none;
        }

        .sys-sidebar-collapsed .sys-sidebar-menu i {
            margin-right: 0;
        }

        .sys-sidebar-header {
            color: rgba(255, 255, 255, 0.6);
            padding: 15px 15px 5px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            overflow: hidden;
        }

        .sys-sidebar-collapsed .sys-sidebar-header {
            display: none;
        }

        /* Development Badges */
        .dev-badge {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.65rem;
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: 600;
        }

        .dev-badge-in-development {
            background-color: #fd7e14;
            color: white;
        }

        .dev-badge-coming-soon {
            background-color: #6f42c1;
            color: white;
        }

        .sys-sidebar-collapsed .dev-badge {
            display: none;
        }

        /* Main Content Area */
        .sys-main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 70px);
            padding-top: 20px;
        }

        .sys-sidebar-collapsed .sys-main-content {
            margin-left: 70px;
        }

        @media (max-width: 768px) {
            .sys-sidebar {
                transform: translateX(-100%);
                width: 250px;
            }

            .sys-sidebar-expanded .sys-sidebar {
                transform: translateX(0);
            }

            .sys-main-content {
                margin-left: 0 !important;
            }
        }

        /* Toggle Button */
        .sys-sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0 15px;
        }

        /* Mobile overlay */
        .sys-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1010;
            display: none;
        }

        .sys-sidebar-expanded .sys-sidebar-overlay {
            display: block;
        }

        @media (min-width: 769px) {
            .sys-sidebar-overlay {
                display: none !important;
            }
        }

        /* Evaluation Iframe Styles */
        .evaluation-container {
            position: fixed;
            top: 70px;
            left: 250px;
            right: 0;
            bottom: 0;
            z-index: 1000;
            background: white;
            transition: all 0.3s ease;
        }

        .sys-sidebar-collapsed .evaluation-container {
            left: 70px;
        }

        @media (max-width: 768px) {
            .evaluation-container {
                left: 0 !important;
            }
        }

        .evaluation-header {
            background: #072247;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .evaluation-iframe {
            width: 100%;
            height: calc(100% - 50px);
            /*height: calc(100% - 100px);*/
            border: none;
        }

        .close-evaluation {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .close-evaluation:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Blur effect for main content when iframe is open */
        .content-blur {
            filter: blur(3px);
            pointer-events: none;
            user-select: none;
        }

        /* Loading indicator */
        .iframe-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #FF7700FF;
            border-top: 4px solid #007FC7FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        /* Dropdown Styles */
        .sys-nav-user-info .dropdown-toggle {
            color: white !important;
            text-decoration: none;
        }

        .sys-nav-user-info .dropdown-toggle:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .sys-nav-user-info .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .sys-nav-user-info .dropdown-item {
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .sys-nav-user-info .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .sys-nav-user-info .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        /* Modal enhancements */
        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Password strength indicator */
        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .password-weak {
            background-color: #dc3545;
            width: 25%;
        }

        .password-medium {
            background-color: #ffc107;
            width: 50%;
        }

        .password-strong {
            background-color: #28a745;
            width: 100%;
        }
    </style>
</head>

<body class="sys-sidebar-expanded">
    <!-- Mobile Overlay -->
    <div class="sys-sidebar-overlay" id="sysSidebarOverlay"></div>

    <!-- Header -->
    <header class="sys-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="sys-sidebar-toggle" id="sysSidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="sys-logo-container">
                        <img src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" alt="MERQ Consultancy" class="sys-logo">
                        <span class="sys-brand-text d-none d-md-block">Performance Evaluation System</span>
                    </div>
                </div>
                <div class="sys-nav-user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none text-white"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=<?= $avatarName ?>&background=random" alt="User">
                            <span class="d-none d-md-inline ms-2"><?= htmlspecialchars($userName) ?></span>
                            <!--<i class="fas fa-caret-down ms-1"></i>-->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    <i class="fas fa-user me-2"></i>My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sys-sidebar">
        <ul class="sys-sidebar-menu">
            <li class="sys-sidebar-header">Main Navigation</li>
            <li>
                <a href="dashboard.php" class="<?= $currentPage == 'dashboard.php' && !$isEvaluationActive ? 'sys-active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>My Dashboard</span>
                </a>
            </li>
            <li>
                <a href="my_report.php" class="<?= $currentPage == 'my_report.php' && !$isEvaluationActive ? 'sys-active' : '' ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span>My Report</span>
                </a>
            </li>

            <?php if ((isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) || ($_SESSION['user_id'] == 35)): ?>
                <li class="sys-sidebar-header">Administration</li>
                <li>
                    <a href="admin_dashboard.php" class="<?= $currentPage == 'admin_dashboard.php' && !$isEvaluationActive ? 'sys-active' : '' ?>">
                        <i class="fas fa-chart-pie"></i>
                        <span>Admin Dashboard</span>
                    </a>
                    <a href="report.php" class="<?= $currentPage == 'report.php' && !$isEvaluationActive ? 'sys-active' : '' ?>">
                        <i class="fas fa-users"></i>
                        <span>All Employees Reports</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="sys-sidebar-header">Account</li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            <hr>
            <li>
                <a href="#" id="openEvaluation" class="<?= $isEvaluationActive ? 'sys-active' : '' ?>">
                    <i class="fas fa-pen-alt"></i>
                    <span>Go to Evaluation</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="https://ui-avatars.com/api/?name=<?= $avatarName ?>&background=007bff&color=fff&size=150"
                                alt="Profile" class="rounded-circle mb-3" width="150" height="150">
                            <h5><?= htmlspecialchars($userName) ?></h5>
                            <p class="text-muted"><?= htmlspecialchars($_SESSION['role'] ?? 'User') ?></p>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Employee ID:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= htmlspecialchars($_SESSION['user_id'] ?? 'N/A') ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Email:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= htmlspecialchars($userEmail) ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Position:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= htmlspecialchars($employeeDetails['position_title'] ?? 'N/A') ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Department:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= htmlspecialchars($employeeDetails['department_name'] ?? 'N/A') ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Supervisor:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= htmlspecialchars($employeeDetails['supervisor_name'] ?? 'N/A') ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Last Login:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= isset($_SESSION['login_time']) ? date('M j, Y g:i A', $_SESSION['login_time']) : 'N/A' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePasswordForm" method="POST" action="../includes/change_password.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                            <div class="invalid-feedback" id="currentPasswordError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                title="Password must be at least 8 characters including: 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character (@$!%*?&)">
                            <div class="form-text">
                                <strong>Password must contain:</strong>
                                <ul class="small mb-0 mt-1">
                                    <li>Minimum 8 characters</li>
                                    <li>At least one uppercase letter (A-Z)</li>
                                    <li>At least one lowercase letter (a-z)</li>
                                    <li>At least one number (0-9)</li>
                                    <li>At least one special character: @ $ ! % * ? &</li>
                                </ul>
                            </div>
                            <div class="invalid-feedback" id="newPasswordError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                            <div class="invalid-feedback" id="confirmPasswordError"></div>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            After changing your password, you'll be logged out and need to login again.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning" id="changePasswordBtn">
                            <i class="fas fa-key me-1"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Evaluation Iframe Container (Initially Hidden) -->
    <?php if ($showEvaluation): ?>
        <div class="evaluation-container" id="evaluationContainer">
            <div class="evaluation-header">
                <h5 class="mb-0">Performance Evaluation Form</h5>
                <button class="close-evaluation" id="closeEvaluation">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <iframe src="../index.php" class="evaluation-iframe" id="evaluationIframe"
                onload="document.getElementById('iframeLoading').style.display='none';"></iframe>
            <div class="iframe-loading" id="iframeLoading">
                <div class="loading-spinner">
                    <img src="/assets/images/merq-logo.png" width="100%"></img>
                </div>
                <p>Loading evaluation form...</p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="sys-main-content">
        <div class="container-fluid">

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const body = document.body;
                    const openEvaluationBtn = document.getElementById('openEvaluation');
                    const closeEvaluationBtn = document.getElementById('closeEvaluation');
                    const evaluationContainer = document.getElementById('evaluationContainer');
                    const mainContent = document.getElementById('mainContent');
                    // Check if sidebar state is saved in localStorage
                    const sidebarState = localStorage.getItem('sysSidebarState');
                    if (sidebarState === 'collapsed') {
                        body.classList.remove('sys-sidebar-expanded');
                        body.classList.add('sys-sidebar-collapsed');
                    }

                    // Open evaluation iframe
                    if (openEvaluationBtn) {
                        openEvaluationBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            window.location.href = '<?php echo $currentPage; ?>?evaluation=true';
                        });
                    }

                    // Close evaluation iframe
                    if (closeEvaluationBtn) {
                        closeEvaluationBtn.addEventListener('click', function() {
                            window.location.href = '<?php echo $currentPage; ?>';
                        });
                    }

                    // Handle iframe messages (for potential communication between iframe and parent)
                    window.addEventListener('message', function(event) {
                        // You can add communication logic here if needed
                        console.log('Message received from iframe:', event.data);

                        // Example: Close iframe when evaluation is completed
                        if (event.data === 'evaluation_completed') {
                            window.location.href = '<?php echo $currentPage; ?>';
                        }
                    });

                    // Adjust iframe container position when sidebar is toggled
                    const observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.attributeName === 'class') {
                                // If evaluation container is visible, adjust its position
                                if (evaluationContainer && evaluationContainer.style.display !== 'none') {
                                    const leftPosition = body.classList.contains('sys-sidebar-collapsed') ? '70px' : '250px';
                                    evaluationContainer.style.left = leftPosition;
                                }
                            }
                        });
                    });

                    observer.observe(body, {
                        attributes: true,
                        attributeFilter: ['class']
                    });

                    // Add keyboard shortcut to close iframe (ESC key)
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape' && evaluationContainer && evaluationContainer.style.display !== 'none') {
                            window.location.href = '<?php echo $currentPage; ?>';
                        }
                    });
                });


                // Password change form handling
                document.addEventListener('DOMContentLoaded', function() {
                    const changePasswordForm = document.getElementById('changePasswordForm');
                    if (changePasswordForm) {
                        changePasswordForm.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const submitBtn = document.getElementById('changePasswordBtn');
                            const originalText = submitBtn.innerHTML;

                            // Show loading state
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Changing...';
                            submitBtn.disabled = true;

                            // Clear previous errors
                            document.querySelectorAll('.is-invalid').forEach(el => {
                                el.classList.remove('is-invalid');
                            });

                            // Validate form
                            const currentPassword = document.getElementById('currentPassword').value;
                            const newPassword = document.getElementById('newPassword').value;
                            const confirmPassword = document.getElementById('confirmPassword').value;

                            let isValid = true;

                            if (!currentPassword) {
                                document.getElementById('currentPassword').classList.add('is-invalid');
                                document.getElementById('currentPasswordError').textContent = 'Current password is required';
                                isValid = false;
                            }

                            if (!newPassword) {
                                document.getElementById('newPassword').classList.add('is-invalid');
                                document.getElementById('newPasswordError').textContent = 'New password is required';
                                isValid = false;
                            } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/.test(newPassword)) {
                                document.getElementById('newPassword').classList.add('is-invalid');
                                document.getElementById('newPasswordError').textContent = 'Password must meet all requirements: 8+ characters, uppercase, lowercase, number, and special character (@$!%*?&)';
                                isValid = false;
                            }

                            if (!confirmPassword) {
                                document.getElementById('confirmPassword').classList.add('is-invalid');
                                document.getElementById('confirmPasswordError').textContent = 'Please confirm your password';
                                isValid = false;
                            } else if (newPassword !== confirmPassword) {
                                document.getElementById('confirmPassword').classList.add('is-invalid');
                                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
                                isValid = false;
                            }

                            if (!isValid) {
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                                return;
                            }

                            // Submit via AJAX
                            const formData = new FormData(changePasswordForm);

                            fetch('../includes/change_password.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: data.message,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            // Close modal and reset form
                                            const modal = bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'));
                                            modal.hide();
                                            changePasswordForm.reset();

                                            // Redirect after successful password change
                                            if (data.redirect) {
                                                // Small delay to show success message
                                                setTimeout(() => {
                                                    window.location.href = data.redirect;
                                                }, 1000);
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: data.message,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while changing password. Please try again.',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    });
                                })
                                .finally(() => {
                                    submitBtn.innerHTML = originalText;
                                    submitBtn.disabled = false;
                                });
                        });
                    }

                    // Real-time password validation
                    const newPasswordInput = document.getElementById('newPassword');
                    const confirmPasswordInput = document.getElementById('confirmPassword');

                    if (newPasswordInput && confirmPasswordInput) {
                        confirmPasswordInput.addEventListener('input', function() {
                            if (newPasswordInput.value !== this.value && this.value.length > 0) {
                                this.classList.add('is-invalid');
                                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
                            } else {
                                this.classList.remove('is-invalid');
                            }
                        });

                        newPasswordInput.addEventListener('input', function() {
                            if (this.value && !/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/.test(this.value)) {
                                this.classList.add('is-invalid');
                                document.getElementById('newPasswordError').textContent = 'Password must meet all requirements';
                            } else {
                                this.classList.remove('is-invalid');
                            }

                            // Also validate confirmation password in real-time
                            if (confirmPasswordInput.value && this.value !== confirmPasswordInput.value) {
                                confirmPasswordInput.classList.add('is-invalid');
                                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
                            } else if (confirmPasswordInput.value) {
                                confirmPasswordInput.classList.remove('is-invalid');
                            }
                        });
                    }

                    // Clear validation on modal hide
                    const changePasswordModal = document.getElementById('changePasswordModal');
                    if (changePasswordModal) {
                        changePasswordModal.addEventListener('hidden.bs.modal', function() {
                            changePasswordForm.reset();
                            document.querySelectorAll('.is-invalid').forEach(el => {
                                el.classList.remove('is-invalid');
                            });
                        });
                    }
                });
            </script>