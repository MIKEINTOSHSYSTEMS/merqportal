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
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-logo">
            <div class="logo-glow"></div>
            <span class="logo-text">MERQ Consultancy</span>
        </div>
        <div class="preloader-progress">
            <div class="progress-bar"></div>
        </div>
        <div class="preloader-message">Loading Employee Portal...</div>
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

                <div class="user-profile">
                    <img src="assets/images/user-avatar.png" alt="User Profile" class="profile-img">
                    <span class="profile-name">Welcome, Employee</span>
                </div>

                <button class="notification-bell" aria-label="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count"><?= count(array_filter($notifications, fn($n) => !$n['is_read'])) ?></span>
                </button>

                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
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
                <h1>Employee Dashboard</h1>
                <div class="dashboard-actions">
                    <div class="search-box">
                        <input type="text" id="appSearch" placeholder="Search applications...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <button class="refresh-btn"><i class="fas fa-sync-alt"></i> Refresh</button>
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

            <!-- Quick Stats -->
            <div class="quick-stats">
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
                    <a href="https://merqconsultancy.org">Company Website</a>
                    <a href="https://merqconsultancy.org/contact">Help Center</a>
                    <a href="mailto:support@merqconsultancy.org">Contact IT</a>
                </div>
                <div class="link-group">
                    <h4>Resources</h4>
                    <a href="#">Employee Handbook</a>
                    <a href="#">Training Materials</a>
                    <a href="https://formapp.merqconsultancy.org/">Forms Library</a>
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
            <p>&copy; <?= date('Y') ?> MERQ Consultancy. All rights reserved.</p>
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

    <script src="assets/js/script.js"></script>
    <script src="assets/js/pwa.js"></script>
</body>

</html>