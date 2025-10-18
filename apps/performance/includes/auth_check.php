<?php
// auth_check.php - Authentication check for protected pages

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/ci-config.php';
    require_once __DIR__ . '/../../../includes/session-config.php';
    session_start();
}

// Check if user is logged in using our custom session variable
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

// Check if user is trying to access someone else's data (for employee pages)
$currentUserId = $_SESSION['user_id'];
$requestedUserId = $_GET['employee'] ?? $currentUserId;

// Allow admins OR user_id = 35 (CEO) OR user_id = 15 (HR Admin) to bypass restrictions
$isPrivilegedUser = (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) ||
    ($_SESSION['user_id'] == 35) ||
    ($_SESSION['user_id'] == 15);

if (!$isPrivilegedUser) {
    if (isset($_GET['employee']) && $_GET['employee'] != $currentUserId) {
        header('Location: dashboard.php');
        exit;
    }
}

// Check page-specific permissions
$currentPage = basename($_SERVER['PHP_SELF']);
$menuItemMap = [
    'dashboard.php' => 'dashboard',
    'my_report.php' => 'my_report',
    'supervisor_dashboard.php' => 'supervisor_dashboard',
    'supervisor_report.php' => 'supervisor_report',
    'admin_dashboard.php' => 'admin_dashboard',
    'report.php' => 'report',
    'feedback.php' => 'feedback',
    'permissions.php' => 'permissions',
    'help.php' => 'help'
];

$currentMenuItem = $menuItemMap[$currentPage] ?? 'dashboard';

// Check if user has permission to access the current page
if (!hasPermission($currentUserId, $currentMenuItem)) {
    header('Location: dashboard.php?error=access_denied');
    exit;
}

// Optional: Check session expiration (e.g., 1 hour)
$session_duration = 3600; // 1 hour in seconds
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $session_duration)) {
    // Session expired
    session_unset();
    session_destroy();
    header('Location: login.php?expired=1');
    exit;
}

// Optional: Refresh login time on each request to keep session alive
$_SESSION['login_time'] = time();
