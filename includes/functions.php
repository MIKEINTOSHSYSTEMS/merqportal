<?php
require_once 'config.php';

// Format datetime for display
function formatDateTime($dateString)
{
    if (empty($dateString)) {
        return '';
    }

    try {
        $date = new DateTime($dateString);
        $now = new DateTime();
        $diff = $now->diff($date);

        if ($diff->days === 0) {
            if ($diff->h === 0) {
                if ($diff->i < 1) {
                    return 'Just now';
                }
                return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
            }
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->days === 1) {
            return 'Yesterday at ' . $date->format('g:i A');
        } elseif ($diff->days < 7) {
            return $diff->days . ' day' . ($diff->days > 1 ? 's' : '') . ' ago';
        } else {
            return $date->format('M j, Y \a\t g:i A');
        }
    } catch (Exception $e) {
        error_log("Date formatting error: " . $e->getMessage());
        return '';
    }
}

function formatDate($dateString)
{
    if (empty($dateString)) {
        return '';
    }

    try {
        $date = new DateTime($dateString);
        return $date->format('F j, Y');
    } catch (Exception $e) {
        error_log("Date formatting error: " . $e->getMessage());
        return '';
    }
}

// Check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Redirect to login if not authenticated
function requireAuth()
{
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /admin/login.php');
        exit;
    }
}

// Redirect to dashboard if already logged in
function redirectIfLoggedIn($returnUrl = null)
{
    if (isLoggedIn()) {
        $redirect = $returnUrl ?: getDefaultRedirectUrl();
        header('Location: ' . $redirect);
        exit;
    }
}

// Get appropriate redirect URL based on user role
function getDefaultRedirectUrl()
{
    if (isset($_SESSION['user_role'])) {
        switch ($_SESSION['user_role']) {
            case 'admin':
                return '/admin/dashboard.php';
            case 'manager':
            case 'supervisor':
                return '/manager/dashboard.php';
            default:
                return '/index.php';
        }
    }
    return '/index.php';
}

// Check if user is an admin
function isAdmin()
{
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Redirect to login if not admin
function requireAdmin()
{
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /admin/login.php');
        exit;
    }

    if (!isAdmin()) {
        $_SESSION['error'] = 'Access denied. Administrator privileges required.';
        header('Location: /index.php');
        exit;
    }
}

// Generate password hash
function createPasswordHash($password)
{
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Verify password
function verifyPassword($password, $hash)
{
    return password_verify($password, $hash);
}

// Sanitize input
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate email format
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Get user notifications
function getUserNotifications($userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return [];
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            $stmt = $pdo->prepare("
                SELECT n.*, 
                       CASE WHEN nr.notification_id IS NULL THEN 0 ELSE 1 END as is_read
                FROM notifications n
                LEFT JOIN notification_reads nr ON n.id = nr.notification_id AND nr.user_id = ?
                WHERE n.is_active = TRUE
                ORDER BY n.created_at DESC
                LIMIT 10
            ");
            $stmt->execute([$userId]);
        } else {
            // Fallback if notification_reads table doesn't exist yet
            $stmt = $pdo->prepare("
                SELECT n.*, 0 as is_read
                FROM notifications n
                WHERE n.is_active = TRUE
                ORDER BY n.created_at DESC
                LIMIT 10
            ");
            $stmt->execute();
        }

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching notifications: " . $e->getMessage());
        return [];
    }
}


// Mark notification as unread
function markNotificationAsUnread($notificationId, $userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return false;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            $stmt = $pdo->prepare("DELETE FROM notification_reads WHERE user_id = ? AND notification_id = ?");
            $stmt->execute([$userId, (int)$notificationId]);
            return $stmt->rowCount() > 0;
        }
    } catch (PDOException $e) {
        error_log("Error marking notification as unread: " . $e->getMessage());
    }

    return false;
}


// Mark all notifications as unread
function markAllNotificationsAsUnread($userId = null)
{
    global $pdo;

    // Use session user_id if $userId is not provided
    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return false;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            // Delete all notifications for the user from the notification_reads table
            $stmt = $pdo->prepare("DELETE FROM notification_reads WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->rowCount() > 0;
        }
    } catch (PDOException $e) {
        error_log("Error marking all notifications as unread: " . $e->getMessage());
    }

    return false;
}



// Toggle notification read status
function toggleNotificationReadStatus($notificationId, $userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return false;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            // Check current status
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM notification_reads WHERE user_id = ? AND notification_id = ?");
            $stmt->execute([$userId, (int)$notificationId]);
            $isRead = $stmt->fetchColumn() > 0;

            if ($isRead) {
                // Mark as unread
                $stmt = $pdo->prepare("DELETE FROM notification_reads WHERE user_id = ? AND notification_id = ?");
                $stmt->execute([$userId, (int)$notificationId]);
                return 'unread';
            } else {
                // Mark as read
                $stmt = $pdo->prepare("INSERT INTO notification_reads (user_id, notification_id) VALUES (?, ?) 
                                      ON DUPLICATE KEY UPDATE read_at = CURRENT_TIMESTAMP");
                $stmt->execute([$userId, (int)$notificationId]);
                return 'read';
            }
        }
    } catch (PDOException $e) {
        error_log("Error toggling notification status: " . $e->getMessage());
    }

    return false;
}


// Get user stats
function getUserStats($userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return [];
    }

    $stats = [
        'pending_requests' => 0,
        'approved_requests' => 0,
        'rejected_requests' => 0,
        'announcements' => 0,
        'due_timesheets' => 0
    ];

    try {
        // Get leave requests stats
        $stmt = $pdo->prepare("
            SELECT status, COUNT(*) as count 
            FROM leave_requests 
            WHERE user_id = ? 
            GROUP BY status
        ");
        $stmt->execute([$userId]);
        $leaveStats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        $stats['pending_requests'] = $leaveStats['pending'] ?? 0;
        $stats['approved_requests'] = $leaveStats['approved'] ?? 0;
        $stats['rejected_requests'] = $leaveStats['rejected'] ?? 0;

        // Get active announcements count
        $stmt = $pdo->query("
            SELECT COUNT(*) as count 
            FROM announcements 
            WHERE is_active = TRUE 
            AND (end_date IS NULL OR end_date >= NOW())
        ");
        $stats['announcements'] = $stmt->fetchColumn();

        // Get due timesheets count (not submitted for current month)
        $currentMonth = date('n');
        $currentYear = date('Y');

        $stmt = $pdo->prepare("
            SELECT COUNT(*) as count 
            FROM timesheets 
            WHERE user_id = ? 
            AND month = ? 
            AND year = ? 
            AND status != 'submitted'
        ");
        $stmt->execute([$userId, $currentMonth, $currentYear]);
        $stats['due_timesheets'] = $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error fetching user stats: " . $e->getMessage());
    }

    return $stats;
}
?>