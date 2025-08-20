<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

try {
    // Load configuration and functions
    if (!file_exists('includes/config.php')) {
        throw new Exception('Configuration file not found');
    }
    require_once 'includes/config.php';

    if (!file_exists('includes/functions.php')) {
        throw new Exception('Functions file not found');
    }
    require_once 'includes/functions.php';

    // Verify database connection
    if (!isset($pdo) || !($pdo instanceof PDO)) {
        throw new Exception('Database connection not established');
    }

    // Handle login if form submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_email']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $email = sanitizeInput($_POST['login_email']);
        $password = $_POST['login_password'];

        // Validate email domain
        $domain = substr(strrchr($email, "@"), 1);
        if ($domain !== 'merqconsultancy.org') {
            $_SESSION['login_error'] = 'Only @merqconsultancy.org email addresses are allowed';
        } else {
            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user && verifyPassword($password, $user['password_hash'])) {
                    // Successful login
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['last_login'] = time();

                    // Update last login in database
                    $pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?")->execute([$user['user_id']]);

                    // Clear any error messages
                    unset($_SESSION['login_error']);

                    // Check if user is admin and redirect accordingly
                    if ($user['role'] === 'admin') {
                        header('Location: /admin/dashboard.php');
                    } else {
                        // Refresh the page to show authenticated UI
                        header('Location: ' . $_SERVER['PHP_SELF']);
                    }
                    exit;
                } else {
                    $_SESSION['login_error'] = 'Invalid credentials or account does not exist. Please contact your administrator.';
                }
            } catch (PDOException $e) {
                error_log("Login error: " . $e->getMessage());
                $_SESSION['login_error'] = 'A system error occurred. Please try again later.';
            }
        }
    }

    // Handle logout
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Get active app cards from database
    $app_cards = [];
    try {
        $stmt = $pdo->query("SELECT * FROM app_cards WHERE is_active = TRUE ORDER BY sort_order");
        $app_cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error (app_cards): " . $e->getMessage());
    }

    // Get active announcements from database
    $announcements = [];
    try {
        $stmt = $pdo->query("SELECT * FROM announcements WHERE is_active = TRUE AND (end_date IS NULL OR end_date >= NOW()) ORDER BY sort_order");
        $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error (announcements): " . $e->getMessage());
    }

    // Get notifications
    $notifications = [];
    try {
        $stmt = $pdo->query("SELECT * FROM notifications WHERE is_active = TRUE ORDER BY created_at DESC LIMIT 10");
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error (notifications): " . $e->getMessage());
    }
} catch (Exception $e) {
    // Handle critical errors
    die("System error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MERQ Consultancy Employee Portal">
    <meta name="theme-color" content="#2a4365">
    <title>MERQ Consultancy | Employee Portal</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" type="image/png" href="assets/images/icon-192.png">
    <link rel="apple-touch-icon" href="assets/images/icon-192.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>

    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-logo">
            <div class="logo-glow"></div>
            <img src="assets/images/merq-logo.png" width="200px" alt="MERQ Consultancy Logo">
            <span class="logo-text">MERQ Consultancy</span>
        </div>
        <div class="preloader-progress">
            <div class="progress-bar"></div>
        </div>
        <div class="preloader-message">Loading Employee Portal...</div>
    </div>

    <!-- Login Modal -->
    <div class="login-modal" id="loginModal">
        <div class="login-modal-content">
            <div class="login-modal-header">
                <img src="assets/images/merq-logo.png" alt="MERQ Consultancy Logo">
                <h3>Employee Portal Login</h3>
                <p>Use your @merqconsultancy.org email</p>
            </div>

            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['login_error']) ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-group">
                    <label for="login_email">Email Address</label>
                    <input type="email" id="login_email" name="login_email" class="form-control" required
                        placeholder="your.name@merqconsultancy.org" value="<?= isset($_POST['login_email']) ? htmlspecialchars($_POST['login_email']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="login_password">Password</label>
                    <input type="password" id="login_password" name="login_password" class="form-control" required
                        placeholder="Enter your password">
                </div>

                <button type="submit" class="login-btn-modal">Login</button>
            </form>

            <div class="login-modal-footer">
                <p>Don't have an account?
                    <br></br>
                    <a href="mailto:support@merqconsultancy.org"><b>Contact IT Support</b></a>
                </p>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <img src="assets/images/merq-logo.png" alt="MERQ Consultancy Logo">
                <span>Employee Portal</span>
            </div>

            <div class="header-actions">

                <button class="theme-toggle" aria-label="Toggle theme">
                    <i class="fas fa-moon"></i>
                    <i class="fas fa-sun"></i>
                </button>

                <?php if (isLoggedIn()): ?>
                    <div class="user-profile" id="userProfile">
                        <div class="profile-display">
                            <img src="assets/images/user-avatar.png" alt="User Profile" class="profile-img">
                            <span class="profile-name">
                                <?= htmlspecialchars($_SESSION['full_name']) ?>
                                <small>@<?= htmlspecialchars($_SESSION['username']) ?></small>
                            </span>
                            <i class="fas fa-chevron-down" style="margin-left: 5px; font-size: 12px;"></i>
                        </div>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="user-dropdown-item">
                                <a href="/apps/timesheet/pages/profile.php" class="user-dropdown-item">
                                    <i class="fas fa-user"></i>
                                    <span>My Profile</span>
                                </a>
                            </div>
                            <div class="user-dropdown-divider"></div>
                            <div class="user-dropdown-item">
                                <a href="/apps/timesheet/" class="user-dropdown-item">
                                    <i class="fas fa-clock"></i>
                                    <span>My Timesheets</span>
                                </a>
                            </div>
                            <div class="user-dropdown-divider"></div>
                            <a href="?logout=1" class="user-dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <button class="login-btn" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                <?php endif; ?>

                <button class="notification-bell" aria-label="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count"><?= count(array_filter($notifications, fn($n) => !$n['is_read'])) ?></span>
                </button>
                <!--
                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
                -->
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Notification Panel -->
        <aside class="notification-panel">
            <div class="notification-header">
                <h3>Notifications</h3>
                <button class="close-notifications">&times;</button>
            </div>
            <div class="notification-list">
                <?php foreach ($notifications as $notification): ?>
                    <div class="notification-item <?= $notification['is_read'] ? '' : 'unread' ?>" data-id="<?= $notification['id'] ?>">
                        <div class="notification-icon">
                            <i class="fas <?= htmlspecialchars($notification['icon_class']) ?>"></i>
                        </div>
                        <div class="notification-content">
                            <p><?= htmlspecialchars($notification['title']) ?></p>
                            <span class="notification-time"><?= formatDateTime($notification['created_at']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="notification-footer">
                <button class="mark-all-read">Mark All as Read</button>
                <button class="view-all">View All Notifications</button>
            </div>
        </aside>

        <!-- Dashboard Content -->
        <section class="dashboard">
            <div class="dashboard-header">
                <h5>
                    <span id="greeting">Good </span>
                    <span><i>👋 <?= htmlspecialchars($_SESSION['full_name']) ?></i></span>
                    <br></br>
                    <div class="digital-clock">
                        <div class="clock-time" id="clockTime">00:00:00</div>
                        <div class="clock-date" id="clockDate">Loading...</div>
                    </div>
                    <!--<span id="currentDateTime"></span>-->
                </h5>
                <div class="dashboard-actions">
                    <div class="search-box">
                        <input type="text" id="appSearch" placeholder="Search applications...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <button class="refresh-btn"><a href="/"><i class="fas fa-sync-alt"></i> Refresh</a></button>
                </div>
            </div>

            <!-- Notice Board -->
            <?php if (!empty($announcements)): ?>
                <div class="notice-board">
                    <div class="notice-header">
                        <h3><i class="fas fa-bullhorn"></i> Announcements</h3>
                        <?php if (count($announcements) > 1): ?>
                            <div class="notice-controls">
                                <button class="prev-notice"><i class="fas fa-chevron-left"></i></button>
                                <button class="next-notice"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="notice-content">
                        <?php foreach ($announcements as $index => $announcement): ?>
                            <div class="notice-item <?= $index === 0 ? 'active' : '' ?>">
                                <h4><?= htmlspecialchars($announcement['title']) ?></h4>
                                <p><?= nl2br(htmlspecialchars($announcement['content'])) ?></p>
                                <span class="notice-date">Posted: <?= formatDate($announcement['created_at']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($announcements) > 1): ?>
                        <div class="notice-indicators">
                            <?php foreach ($announcements as $index => $announcement): ?>
                                <span class="indicator <?= $index === 0 ? 'active' : '' ?>"></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Application Cards -->
            <div class="apps-grid" id="appsGrid">
                <?php foreach ($app_cards as $card): ?>
                    <a href="<?= htmlspecialchars($card['url']) ?>" target="" class="app-card"
                        data-title="<?= htmlspecialchars(strtolower($card['title'])) ?>"
                        data-desc="<?= htmlspecialchars(strtolower($card['description'])) ?>">
                        <div class="app-icon" style="background-color: <?= $card['icon_color'] ?>">
                            <i class="fas <?= htmlspecialchars($card['icon_class']) ?>"></i>
                        </div>
                        <h3><?= htmlspecialchars($card['title']) ?></h3>
                        <p><?= htmlspecialchars($card['description']) ?></p>
                        <?php if (!empty($card['badge_text'])): ?>
                            <div class="app-badge"><?= htmlspecialchars($card['badge_text']) ?></div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <h3>Quick Stats</h3>
            <!-- Quick Stats -->
            <div class="quick-stats">

                <p>
                    <small>Under Development</small>
                </p>
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Pending Requests</h4>
                        <p>3</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon approved">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Approved Requests</h4>
                        <p>12</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon rejected">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Rejected Requests</h4>
                        <p>2</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon announcements">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-info">
                        <h4>New Announcements</h4>
                        <p><?= count($announcements) ?></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="assets/images/merq-logo-white.png" alt="MERQ Consultancy Logo">
                <p>Empowering your work experience</p>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h4>Quick Links</h4>
                    <a href="https://merqconsultancy.org">Website</a>
                    <a href="https://merqconsultancy.org/contact">Help Center</a>
                    <a href="mailto:support@merqconsultancy.org">Contact IT</a>
                </div>
                <div class="link-group">
                    <h4>Resources</h4>
                    <a href="#">Employee Handbook</a>
                    <a href="https://academy.merqconsultancy.org">Training Materials</a>
                    <a href="https://formapp.merqconsultancy.org/">Forms Library</a>
                    <a href="/admin/dashboard.php">System Administration</a>
                </div>
                <div class="link-group">
                    <h4>Legal</h4>
                    <a href="https://merqconsultancy.org/privacy-policy/">Privacy Policy</a>
                    <a href="https://merqconsultancy.org/privacy-policy/">Terms of Use</a>
                    <a href="https://merqconsultancy.org/privacy-policy/">Cookie Policy</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Employee Portal - V1.0 | BUILD 1.0.3 <br></br> &copy; <?= date('Y') ?> <a href="https://merqconsultancy.org">MERQ Consultancy</a>. All rights reserved.</p>
            <div class="social-links">
                <a href="https://www.linkedin.com/company/merq-consultancy"><i class="fab fa-linkedin"></i></a>
                <a href="https://twitter.com/ConsultancyMerq"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/MERQConsultancy/"><i class="fab fa-facebook"></i></a>
            </div>
        </div>
    </footer>

    <!-- PWA Install Prompt -->
    <div class="pwa-install-prompt">
        <div class="pwa-content">
            <img src="assets/images/icon-192.png" alt="MERQ Portal Icon">
            <div class="pwa-text">
                <h3>Install MERQ Employee Portal</h3>
                <p>Add to your home screen for quick access and offline functionality.</p>
            </div>
        </div>
        <div class="pwa-actions">
            <button class="pwa-cancel">Not Now</button>
            <button class="pwa-install">Install</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Digital Clock Functionality
        function updateClock() {
            const now = new Date();
            const timeElem = document.getElementById('clockTime');
            const dateElem = document.getElementById('clockDate');
            const dateTimeElem = document.getElementById('currentDateTime');
            const greetingElem = document.getElementById('greeting');

            // Update time
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: false
            });
            if (timeElem) timeElem.textContent = timeString;

            // Update date
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('en-US', options);
            if (dateElem) dateElem.textContent = dateString;

            // Update dashboard date/time
            const dashboardDateTime = now.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            if (dateTimeElem) dateTimeElem.textContent = dashboardDateTime;

            // Update greeting based on time of day
            const hour = now.getHours();
            let greeting = "Good ";
            if (hour < 12) greeting += "Morning";
            else if (hour < 18) greeting += "Afternoon";
            else greeting += "Evening";

            if (greetingElem) greetingElem.textContent = greeting;
        }

        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);

        // Login Modal Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const loginModal = document.getElementById('loginModal');
            const loginBtn = document.getElementById('loginBtn');
            const userProfile = document.getElementById('userProfile');
            const userDropdown = document.getElementById('userDropdown');

            // Show login modal when login button is clicked
            if (loginBtn) {
                loginBtn.addEventListener('click', function() {
                    loginModal.classList.add('active');
                });
            }

            // Close modal when clicking outside
            loginModal.addEventListener('click', function(e) {
                if (e.target === loginModal) {
                    loginModal.classList.remove('active');
                }
            });

            // Toggle user dropdown
            if (userProfile) {
                userProfile.addEventListener('click', function(e) {
                    userDropdown.classList.toggle('active');
                    e.stopPropagation();
                });

                // Close dropdown when clicking elsewhere
                document.addEventListener('click', function() {
                    userDropdown.classList.remove('active');
                });
            }

            // Validate email domain before form submission
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const email = document.getElementById('login_email').value;
                    const domain = email.substring(email.lastIndexOf("@") + 1);
                    if (domain !== 'merqconsultancy.org') {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Email Domain',
                            text: 'Only @merqconsultancy.org email addresses are allowed',
                            confirmButtonColor: '#2a4365'
                        });
                    }
                });
            }

            // Show success message if logged in
            <?php if (isset($_SESSION['user_id']) && !isset($_SESSION['login_shown'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'Welcome back, <?= addslashes($_SESSION['full_name']) ?>!',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                <?php $_SESSION['login_shown'] = true; ?>
            <?php endif; ?>
        });

        document.addEventListener('DOMContentLoaded', function() {
            let progressBar = document.querySelector('.progress-bar');
            let width = 0;

            function updateProgressBar() {
                if (width < 100) {
                    width++;
                    progressBar.style.width = width + '%';
                    setTimeout(updateProgressBar, 30); // Adjust the speed of the progress bar
                }
            }

            updateProgressBar();
        });
    </script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/pwa.js"></script>

</body>

</html>