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

    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email and password are required';
        header('Location: ../public/login.php');
        exit;
    }

    // Create database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        $_SESSION['error'] = 'System error. Please try again later.';
        header('Location: ../public/login.php');
        exit;
    }

    // Validate credentials using users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Get user profile for additional info
        $user_profile = getEmployeeDetails($user['user_id']);

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

        $_SESSION['position_title'] = $user_profile['position_title'] ?? '';
        $_SESSION['department_name'] = $user_profile['department_name'] ?? '';
        $_SESSION['supervisor_name'] = $user_profile['supervisor_name'] ?? '';

        // Redirect based on role
        if ($user['is_admin'] == 1 || $user['role'] === 'admin') {
            header('Location: ../public/report.php');
        } else {
            header('Location: ../public/dashboard.php');
        }
        exit;
    } else {
        // Authentication failed - more specific error
        $_SESSION['error'] = 'Invalid email or password. Please check your credentials and try again.';
        header('Location: ../public/login.php');
        exit;
    }
} else {
    // If not a POST request, redirect to login
    header('Location: ../public/login.php');
    exit;
}
