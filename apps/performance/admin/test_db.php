<?php
// test_db.php - Test database connection
require_once 'db_connection.php';

header('Content-Type: application/json');

$response = [];

try {
    $pdo = get_db_connection();

    if ($pdo) {
        $response['status'] = 'success';
        $response['message'] = 'Database connection successful';

        // Test query to staff table
        $table = APP_DB_PREFIX . 'staff';
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM {$table}");
        $result = $stmt->fetch();

        $response['staff_count'] = $result['count'];
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Database connection failed';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Exception: ' . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
