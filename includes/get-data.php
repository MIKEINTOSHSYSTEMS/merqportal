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
            // Updated to use user_id instead of id
            $stmt = $pdo->prepare("SELECT user_id, username, full_name, email, last_login FROM users WHERE user_id = ?");
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
