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
define('APP_SESSION_COOKIE_SAME_SITE', 'Strict');

// Cookie constants
define('APP_COOKIE_PATH', '/');
define('APP_COOKIE_DOMAIN', '');
define('APP_COOKIE_SECURE', false);
define('APP_COOKIE_HTTPONLY', false);

// Encryption key (if needed by your app)
define('APP_ENC_KEY', '128cbd12780fecc24842b90d717efa2b');

// Database prefix (optional, not used in session handler directly)
define('APP_DB_PREFIX', 'tbl');
