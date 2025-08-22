<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if (!isset($_GET['type']) || !isset($_GET['id'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$type = $_GET['type'];
$id = (int)$_GET['id'];

try {
    switch ($type) {
        case 'appcard':
            $stmt = $pdo->prepare("SELECT * FROM app_cards WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            break;

        case 'announcement':
            $stmt = $pdo->prepare("SELECT * FROM announcements WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            break;

        case 'notification':
            $stmt = $pdo->prepare("SELECT * FROM notifications WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            break;

        case 'user':
            $stmt = $pdo->prepare("
        SELECT 
            u.user_id, 
            u.employee_id,
            u.is_doctor,
            u.first_name,
            u.middle_name,
            u.last_name,
            u.username,
            u.email,
            u.phone,
            u.alternate_phone,
            u.role,
            u.department_id,
            u.position_id,
            u.supervisor_id,
            u.join_date,
            u.hire_date,
            u.leave_balance,
            u.is_active,
            u.last_login,
            u.created_at,
            u.updated_at
        FROM users u
        WHERE u.user_id = ?
    ");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            break;

        default:
            $data = ['error' => 'Invalid data type'];
    }

    if (empty($data)) {
        echo json_encode(['error' => 'No data found']);
        exit;
    }

    echo json_encode($data);
} catch (PDOException $e) {
    error_log("Database error in get-data.php: " . $e->getMessage());
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
