<?php
// Set a consistent session name and path across all applications
$sessionName = 'MERQ_PORTAL_SESSION';
$sessionPath = '/';
$sessionDomain = $_SERVER['HTTP_HOST'];
$sessionSecure = isset($_SERVER['HTTPS']);
$sessionHttpOnly = true;
$sessionSameSite = 'Strict';

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    // Session not started yet, set parameters and start
    session_set_cookie_params([
        'lifetime' => 3600, // 1 hour
        'path' => $sessionPath,
        'domain' => $sessionDomain,
        'secure' => $sessionSecure,
        'httponly' => $sessionHttpOnly,
        'samesite' => $sessionSameSite
    ]);

    // Set session name
    session_name($sessionName);
    
    // Start session
    session_start();
    
    // Regenerate session ID for security
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
    
} else {
    // Session already started, just check for regeneration
    if (!isset($_SESSION['last_regeneration'])) {
        $_SESSION['last_regeneration'] = time();
    } elseif (time() - $_SESSION['last_regeneration'] > 1800) { // 30 minutes
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
?>