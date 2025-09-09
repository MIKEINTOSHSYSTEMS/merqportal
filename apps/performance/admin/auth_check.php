<?php
// auth_check.php - Authentication check for protected pages
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
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
