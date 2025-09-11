<?php
// includes/ci-config.php
// Extract only the necessary constants from CodeIgniter config

// Database constants
define('APP_DB_HOSTNAME', '127.0.0.1');
define('APP_DB_USERNAME', 'merq_portal');
define('APP_DB_PASSWORD', 'merq_portal');
define('APP_DB_NAME', 'merq_portal');
define('APP_DB_CHARSET', 'utf8mb4');
define('APP_DB_COLLATION', 'utf8mb4_unicode_ci');

// Session constants - MUST MATCH CodeIgniter's internal app config
define('SESS_DRIVER', 'database');
define('SESS_SAVE_PATH', 'tblsessions');
define('APP_SESSION_COOKIE_NAME', 'sp_session'); // Must match CodeIgniter's config
define('APP_SESSION_EXPIRATION', 28800); // 8 hours
define('APP_SESSION_REGENERATE_DESTROY', true);
define('APP_SESSION_COOKIE_SAME_SITE', 'Lax');

// Environment-based configuration for sessions and cookies
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'merqapp') {
    // Development environment
    define('APP_COOKIE_DOMAIN', '');  // Empty for localhost
    define('APP_COOKIE_SECURE', false);
} else {
    // Production environment - MUST MATCH CodeIgniter's config
    define('APP_COOKIE_DOMAIN', '.merqconsultancy.org');  // Share cookies across subdomains
    define('APP_COOKIE_SECURE', true);  // Use Secure flag for production (HTTPS only)
}

// Cookie constants - MUST MATCH CodeIgniter's config
define('APP_COOKIE_PATH', '/');
define('APP_COOKIE_HTTPONLY', false); // Match CodeIgniter's default

// Encryption key (MUST match CodeIgniter's config)
define('APP_ENC_KEY', '128cbd12780fecc24842b90d717efa2b');

// Database prefix
define('APP_DB_PREFIX', 'tbl');

/**
 * Enables CSRF Protection
 */
define('APP_CSRF_PROTECTION', true);
