<?php
// auth.php - Authentication handler
session_start();

// Hardcoded credentials (to be replaced with database check in the future)
$valid_username = 'admin';
$valid_password = 'merq@eval7';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Authentication successful
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = time();

        // Redirect to dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Authentication failed
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: login.php');
        exit;
    }
} else {
    // If not a POST request, redirect to login
    header('Location: login.php');
    exit;
}
