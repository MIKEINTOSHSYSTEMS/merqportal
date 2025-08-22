<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

// Get pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'full_name';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Validate sort field
$allowedSorts = [
    'user_id',
    'employee_id',
    'full_name',
    'username',
    'email',
    'role',
    'department_name',
    'position_title',
    'supervisor_name',
    'is_active'
];
if (!in_array($sort, $allowedSorts)) {
    $sort = 'full_name';
}

// Validate order
$order = strtolower($order) === 'desc' ? 'DESC' : 'ASC';

// Build WHERE clause for filters
$whereConditions = [];
$params = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $whereConditions[] = "(u.full_name LIKE ? OR u.username LIKE ? OR u.email LIKE ? OR u.employee_id LIKE ?)";
    array_push($params, $search, $search, $search, $search);
}

if (isset($_GET['role']) && !empty($_GET['role'])) {
    $whereConditions[] = "u.role = ?";
    $params[] = $_GET['role'];
}

if (isset($_GET['department_id']) && !empty($_GET['department_id'])) {
    $whereConditions[] = "u.department_id = ?";
    $params[] = (int)$_GET['department_id'];
}

if (isset($_GET['position_id']) && !empty($_GET['position_id'])) {
    $whereConditions[] = "u.position_id = ?";
    $params[] = (int)$_GET['position_id'];
}

if (isset($_GET['is_active']) && $_GET['is_active'] !== '') {
    $whereConditions[] = "u.is_active = ?";
    $params[] = (int)$_GET['is_active'];
}

if (isset($_GET['supervisor_id']) && !empty($_GET['supervisor_id'])) {
    $whereConditions[] = "u.supervisor_id = ?";
    $params[] = (int)$_GET['supervisor_id'];
}

if (isset($_GET['join_date_from']) && !empty($_GET['join_date_from'])) {
    $whereConditions[] = "u.join_date >= ?";
    $params[] = $_GET['join_date_from'];
}

if (isset($_GET['join_date_to']) && !empty($_GET['join_date_to'])) {
    $whereConditions[] = "u.join_date <= ?";
    $params[] = $_GET['join_date_to'];
}

$whereClause = '';
if (!empty($whereConditions)) {
    $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
}

// Get total count
$countSql = "SELECT COUNT(*) as total 
             FROM users u
             LEFT JOIN departments d ON u.department_id = d.department_id
             LEFT JOIN positions p ON u.position_id = p.position_id
             LEFT JOIN users s ON u.supervisor_id = s.user_id
             $whereClause";

$stmt = $pdo->prepare($countSql);
$stmt->execute($params);
$total = $stmt->fetchColumn();

// Get users with pagination
$offset = ($page - 1) * $perPage;
$limit = $perPage > 0 ? "LIMIT $offset, $perPage" : '';

$sql = "SELECT 
            u.user_id, 
            u.employee_id,
            u.is_doctor,
            u.full_name,
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
        $whereClause
        ORDER BY $sort $order
        $limit";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$users = $stmt->fetchAll();

echo json_encode([
    'users' => $users,
    'total' => $total,
    'page' => $page,
    'per_page' => $perPage,
    'total_pages' => $perPage > 0 ? ceil($total / $perPage) : 1
]);
