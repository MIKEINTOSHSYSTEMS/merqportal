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
                return '/manager/dashboard.php'; // Adjust if you have different dashboards
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
    if (!isAdmin()) {
        $_SESSION['error'] = 'Access denied. Administrator privileges required.';
        header('Location: /admin/login.php');
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
