<?php
// index.php - Redirect to login page
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
