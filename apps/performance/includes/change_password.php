<?php
// change_password.php - Handle password change requests

// Check if session is started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/ci-config.php';
    require_once __DIR__ . '/../../../includes/session-config.php';
    require_once 'db_connection.php';
}

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Validate inputs
if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if ($new_password !== $confirm_password) {
    echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
    exit;
}

// Validate password strength
if (strlen($new_password) < 8) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
    exit;
}

if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $new_password)) {
    echo json_encode(['success' => false, 'message' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&)']);
    exit;
}

try {
    // Create database connection using your config.php credentials
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Get user current password from database
    $stmt = $conn->prepare("SELECT user_id, email, password_hash FROM users WHERE user_id = ? AND is_active = 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'User not found or inactive']);
        exit;
    }

    // Verify current password
    $currentPasswordValid = false;

    if (isset($user['password_hash']) && password_verify($current_password, $user['password_hash'])) {
        $currentPasswordValid = true;
    }

    if (!$currentPasswordValid) {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
        exit;
    }

    // Hash new password using PHP's password_hash
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in database
    $stmt = $conn->prepare("UPDATE users SET password_hash = ?, updated_at = CURRENT_TIMESTAMP WHERE user_id = ?");
    $stmt->bind_param("si", $hashed_password, $user_id);
    $result = $stmt->execute();
    $stmt->close();

    if (!$result) {
        throw new Exception('Failed to update password in database');
    }

    // Log the password change activity
    logPasswordChange($conn, $user_id, $user['email']);

    // Close connection
    $conn->close();

    echo json_encode([
        'success' => true,
        'message' => 'Password changed successfully. You will be logged out and redirected to login page.',
        'redirect' => '../public/login.php'
    ]);
} catch (Exception $e) {
    error_log("Password change error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred while changing password. Please try again.']);
}

/**
 * Log password change activity for security auditing
 */
function logPasswordChange($conn, $user_id, $email)
{
    try {
        // Check if audit_log table exists
        $tableCheck = $conn->query("SHOW TABLES LIKE 'audit_log'");

        if ($tableCheck && $tableCheck->num_rows > 0) {
            $stmt = $conn->prepare("
                INSERT INTO audit_log (user_id, action, description, ip_address, user_agent) 
                VALUES (?, 'password_change', ?, ?, ?)
            ");

            $description = "User changed their password: $email";
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

            $stmt->bind_param("isss", $user_id, $description, $ip_address, $user_agent);
            $stmt->execute();
            $stmt->close();
        }
    } catch (Exception $e) {
        // Don't fail the password change if logging fails
        error_log("Failed to log password change: " . $e->getMessage());
    }
}
