<?php
// login_test.php
require_once 'db_connection.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/ci-config.php';
    require_once __DIR__ . '/../../../includes/session-config.php';
    session_start();
}

// Test with a known user
$email = 'admin@merqconsultancy.org';
$password = 'merq@eval7'; // Use the actual password from your database

$staff = verify_staff_credentials($email, $password);

if ($staff) {
    // Set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $staff['email'];
    $_SESSION['staff_user_id'] = $staff['staffid'];
    $_SESSION['staff_firstname'] = $staff['firstname'];
    $_SESSION['staff_lastname'] = $staff['lastname'];
    $_SESSION['staff_email'] = $staff['email'];
    $_SESSION['login_time'] = time();

    echo "Login successful!<br>";
    echo "User: " . $staff['firstname'] . " " . $staff['lastname'] . "<br>";
    echo "Session ID: " . session_id() . "<br>";
    echo "<a href='test.php'>Test session</a>";
} else {
    echo "Login failed!";
}
