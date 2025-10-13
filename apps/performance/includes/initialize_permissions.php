<?php
// initialize_permissions.php - Initialize permissions for existing users
require_once 'config.php';

function initializeAllUserPermissions()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return ['success' => false, 'message' => 'Database connection failed'];
    }

    // Get all active users (excluding system users 1,2,3)
    $sql = "SELECT user_id FROM users WHERE user_id NOT IN (1, 2, 3) AND is_active = 1";
    $result = $conn->query($sql);

    $initialized = 0;
    $errors = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $userId = $row['user_id'];
            if (initializeDefaultPermissions($userId)) {
                $initialized++;
            } else {
                $errors[] = $userId;
            }
        }
    }

    $conn->close();

    return [
        'success' => true,
        'message' => "Initialized permissions for $initialized users" .
            (count($errors) ? ". Errors with users: " . implode(', ', $errors) : '')
    ];
}

// Run this script once to initialize permissions for all existing users
// $result = initializeAllUserPermissions();
// echo json_encode($result);
