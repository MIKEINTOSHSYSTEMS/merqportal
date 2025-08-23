<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../includes/auth-check.php';

// Only admin can access this data
if (!hasRole('admin')) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Access denied']);
    exit;
}

if (!isset($_GET['user_id'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'User ID required']);
    exit;
}

$user_id = (int)$_GET['user_id'];

try {
    $pdo = (new Database())->getConnection();

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
        u.last_leave_increment,
        u.is_active,
        u.department_id,
        u.position_id,
        u.supervisor_id,
        d.department_name,        
        p.position_title,  
        s.full_name AS supervisor_name,
        u.password_hash,
        u.last_login,
        u.created_at,
        u.updated_at
    FROM users u
    LEFT JOIN positions p ON u.position_id = p.position_id
    LEFT JOIN departments d ON u.department_id = d.department_id
    LEFT JOIN users s ON u.supervisor_id = s.user_id
    WHERE u.user_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
        exit;
    }

    header('Content-Type: application/json');
    echo json_encode($user);
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
