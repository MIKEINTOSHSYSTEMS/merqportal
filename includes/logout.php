<?php
// Include the shared session config first
require_once __DIR__ . '/session-config.php';
require_once 'config.php';
require_once 'functions.php';

// Destroy all session data
$_SESSION = array();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: /admin/login.php');
exit;
