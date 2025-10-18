<?php
// index.php - Redirect based on user role
session_start();

// If user is already logged in, redirect to appropriate page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SESSION['role'] === 'admin' || $_SESSION['is_admin'] == 1) {
        header('Location: admin_dashboard.php');
        //header('Location: report.php');
    } else {
        header('Location: dashboard.php');
    }
    exit;
} else {
    header('Location: login.php');
    exit;
}
