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
    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            // Get all unread notifications for this user
            $notifications = getUserNotifications($_SESSION['user_id']);

            foreach ($notifications as $notification) {
                if (!$notification['is_read']) {
                    $stmt = $pdo->prepare("INSERT INTO notification_reads (user_id, notification_id) VALUES (?, ?) 
                                          ON DUPLICATE KEY UPDATE read_at = CURRENT_TIMESTAMP");
                    $stmt->execute([$_SESSION['user_id'], $notification['id']]);
                }
            }
        }

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
