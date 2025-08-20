<?php
// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'merq_portal');
define('DB_USER', 'merq_portal');
define('DB_PASS', 'merq_portal');

// Session configuration
define('SESSION_TIMEOUT', 3600); // 1 hour

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

// Start session with secure settings
session_set_cookie_params([
    'lifetime' => SESSION_TIMEOUT,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

if (isset($_SESSION['user_role'])) {
    $is_admin = $_SESSION['user_role'] === 'admin';
} else {
    $is_admin = false;
}

// Make it available globally
define('IS_ADMIN', $is_admin);

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
