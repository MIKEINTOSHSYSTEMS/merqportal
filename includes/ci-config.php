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

// Session constants
define('SESS_DRIVER', 'database');
define('SESS_SAVE_PATH', 'tblsessions'); // <-- matches your table name
define('APP_SESSION_COOKIE_NAME', 'sp_session');
define('APP_SESSION_EXPIRATION', 28800); // 8 hours
define('APP_SESSION_REGENERATE_DESTROY', true);  // Ensure this is set in both apps

// Environment-based configuration for sessions and cookies
//if ($_SERVER['HTTP_HOST'] == 'merqapp') {
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // Development environment (http://localhost/)
    define('APP_COOKIE_DOMAIN', 'localhost');  // Local testing domain
    define('APP_COOKIE_SECURE', false);  // Don't use Secure flag for development (HTTP)
    define('APP_SESSION_COOKIE_SAME_SITE', 'Lax');  // More lenient SameSite for development
} else {
    // Production environment (https://app.merqconsultancy.org/)
    define('APP_COOKIE_DOMAIN', '.merqconsultancy.org');  // Same for production (share cookies across subdomains)
    define('APP_COOKIE_SECURE', true);  // Use Secure flag for production (HTTPS only)
    define('APP_SESSION_COOKIE_SAME_SITE', 'Lax');  // Or 'Strict' for higher security in production
}

// Cookie constants
define('APP_COOKIE_PATH', '/');  // Path for the cookie

// Cookie constants for domains
//define('APP_COOKIE_DOMAIN', '');

// Encryption key (if needed by your app)
define('APP_ENC_KEY', '128cbd12780fecc24842b90d717efa2b');

// Database prefix (optional, not used in session handler directly)
define('APP_DB_PREFIX', 'tbl');

/**
 * Enables CSRF Protection
 */
define('APP_CSRF_PROTECTION', true);