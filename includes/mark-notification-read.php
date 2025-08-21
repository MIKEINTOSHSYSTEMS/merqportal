<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id'])) {
        echo json_encode(['success' => false, 'error' => 'Notification ID required']);
        exit;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            $stmt = $pdo->prepare("INSERT INTO notification_reads (user_id, notification_id) VALUES (?, ?) 
                                  ON DUPLICATE KEY UPDATE read_at = CURRENT_TIMESTAMP");
            $stmt->execute([$_SESSION['user_id'], (int)$data['id']]);
        }

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
