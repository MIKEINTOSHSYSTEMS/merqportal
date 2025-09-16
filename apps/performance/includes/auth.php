<?php
// auth.php - Authentication handler
require_once 'db_connection.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/ci-config.php';
    require_once __DIR__ . '/../../../includes/session-config.php';
    //session_start();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate credentials using users table
    $user = verify_user_credentials($email, $password);

    if ($user) {
        // Authentication successful
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['position_id'] = $user['position_id'];
        $_SESSION['department_id'] = $user['department_id'];
        $_SESSION['supervisor_id'] = $user['supervisor_id'];
        $_SESSION['employee_id'] = $user['employee_id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['login_time'] = time();

        // Redirect based on role
        if ($user['is_admin'] == 1 || $user['role'] === 'admin') {
            header('Location: ../public/report.php');
        } else {
            header('Location: ../public/dashboard.php');
        }
        exit;
    } else {
        // Authentication failed
        $_SESSION['error'] = 'Invalid email or password';
        header('Location: ../public/login.php');
        exit;
    }
} else {
    // If not a POST request, redirect to login
    header('Location: ../public/login.php');
    exit;
}
