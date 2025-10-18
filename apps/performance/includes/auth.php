<?php
// auth.php - Authentication handling
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Please enter both email and password.';
        header('Location: ../login.php');
        exit;
    }

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        $_SESSION['error'] = 'Database connection failed. Please try again.';
        header('Location: ../login.php');
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
        
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
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

            // Redirect based on user role
            if ($user['is_admin'] == 1 || $user['user_id'] == 35 || $user['user_id'] == 15) {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: dashboard.php');
            }
            exit;
        } else {
            // Password is incorrect
            $_SESSION['error'] = 'invalid_password';
            $_SESSION['attempted_username'] = $username;
        }
    } else {
        // User not found
        $_SESSION['error'] = 'invalid_username';
        $_SESSION['attempted_username'] = $username;
    }

    $stmt->close();
    $conn->close();
    header('Location: ../public/login.php');
    exit;
} else {
    header('Location: ../public/login.php');
    exit;
}
?>