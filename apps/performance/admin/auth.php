<?php
// auth.php - Authentication handler
require_once 'db_connection.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/ci-config.php';
    require_once __DIR__ . '/../../../includes/session-config.php';
    session_start();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate credentials
    $staff = verify_staff_credentials($email, $password);

    if ($staff) {
        // Authentication successful
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $staff['email'];
        $_SESSION['staff_user_id'] = $staff['staffid'];
        $_SESSION['staff_firstname'] = $staff['firstname'];
        $_SESSION['staff_lastname'] = $staff['lastname'];
        $_SESSION['staff_email'] = $staff['email'];
        $_SESSION['login_time'] = time();

        // Redirect to dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Authentication failed
        $_SESSION['error'] = 'Invalid email or password';
        header('Location: login.php');
        exit;
    }
} else {
    // If not a POST request, redirect to login
    header('Location: login.php');
    exit;
}
