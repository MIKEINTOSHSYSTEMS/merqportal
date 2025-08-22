<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if (!isset($_GET['user_id'])) {
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

$userId = (int)$_GET['user_id'];

$sql = "SELECT 
            u.user_id, 
            u.employee_id,
            u.is_doctor,
            u.full_name,
            u.first_name,
            u.middle_name,
            u.last_name,
            u.username,
            u.email,
            u.phone,
            u.alternate_phone,
            u.role,
            u.join_date,
            u.hire_date,
            u.leave_balance,
            u.is_active,
            u.last_login,
            d.department_name, 
            p.position_title, 
            u.supervisor_id,
            s.full_name AS supervisor_name
        FROM users u
        LEFT JOIN departments d ON u.department_id = d.department_id
        LEFT JOIN positions p ON u.position_id = p.position_id
        LEFT JOIN users s ON u.supervisor_id = s.user_id
        WHERE u.user_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo json_encode(['error' => 'User not found']);
    exit;
}

echo json_encode($user);
