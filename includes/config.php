<?php
// Include session configuration first
require_once __DIR__ . '/session-config.php';

// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'merq_portal');
define('DB_USER', 'merq_portal');
define('DB_PASS', 'merq_portal');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Create database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if user is admin
if (isset($_SESSION['user_role'])) {
    $is_admin = $_SESSION['user_role'] === 'admin';
} else {
    $is_admin = false;
}

// Make it available globally
define('IS_ADMIN', $is_admin);
?>