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
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    error_log("Login attempt for: " . $username);

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Please enter both email and password.';
        error_log("Empty username or password");
        header('Location: ../public/login.php');
        exit;
    }

    // Create database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        $_SESSION['error'] = 'Database connection failed. Please try again.';
        error_log("DB Connection failed: " . $conn->connect_error);
        header('Location: ../public/login.php');
        exit;
    }

    // Prepare statement to prevent SQL injection
    $sql = "SELECT user_id, username, email, password_hash, full_name, role, is_admin, is_active, 
                   position_id, department_id, supervisor_id, employee_id
            FROM users 
            WHERE (email = ? OR username = ?) AND is_active = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        error_log("User found: " . $user['email']);

        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            error_log("Password verified successfully");

            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['employee_id'] = $user['employee_id'];
            $_SESSION['position_id'] = $user['position_id'];
            $_SESSION['department_id'] = $user['department_id'];
            $_SESSION['supervisor_id'] = $user['supervisor_id'];
            $_SESSION['login_time'] = time();

            // Update last_login timestamp
            $updateSql = "UPDATE users SET last_login = NOW() WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $user['user_id']);
            $updateStmt->execute();
            $updateStmt->close();

            $stmt->close();
            $conn->close();

            error_log("Login successful, redirecting to dashboard");

            // Redirect based on role
            if ($user['is_admin'] == 1 || $user['role'] === 'admin') {
                header('Location: ../public/admin_dashboard.php');
                //header('Location: ../public/report.php');
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
}
