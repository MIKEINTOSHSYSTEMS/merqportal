<?php
require_once __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../config/constants.php';

class SessionManager {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check session timeout
        if (isset($_SESSION['last_activity']) &&
            (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
            self::destroy();
            Utils::redirect('login.php');
        }
        
        $_SESSION['last_activity'] = time();
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }
    
    public static function destroy() {
        session_unset();
        session_destroy();
        session_start(); // Start fresh session
    }
    
    public static function isLoggedIn() {
        self::start(); // Ensure session is started
        return isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    public static function requireLogin() {
        self::start(); // Ensure session is started
        if (!self::isLoggedIn()) {
            Utils::addFlashMessage('warning', 'Please log in to access this page.');
            Utils::redirect('login.php');
        }
    }
    
    public static function getUser() {
        return self::get('user_data');
    }
    
    public static function getUserId() {
        return self::get('user_id');
    }
}
?>