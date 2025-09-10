<?php
// includes/session-config.php

// Start output buffering to prevent headers already sent error
if (session_status() === PHP_SESSION_NONE) {
    ob_start();
}

// Include our custom config instead of the CodeIgniter one
require_once 'ci-config.php';

// Set the same session settings as CodeIgniter
session_name(defined('APP_SESSION_COOKIE_NAME') ? APP_SESSION_COOKIE_NAME : 'sp_session');
session_set_cookie_params([
    'lifetime' => defined('APP_SESSION_EXPIRATION') ? APP_SESSION_EXPIRATION : 28800,
    'path' => defined('APP_COOKIE_PATH') ? APP_COOKIE_PATH : '/',
    'domain' => defined('APP_COOKIE_DOMAIN') ? APP_COOKIE_DOMAIN : '',
    'secure' => defined('APP_COOKIE_SECURE') ? APP_COOKIE_SECURE : false,
    'httponly' => defined('APP_COOKIE_HTTPONLY') ? APP_COOKIE_HTTPONLY : false,
    'samesite' => defined('APP_SESSION_COOKIE_SAME_SITE') ? APP_SESSION_COOKIE_SAME_SITE : 'Strict'
]);

// Database session handler (if using database sessions)
if (defined('SESS_DRIVER') && SESS_DRIVER === 'database') {
    // Create database connection
    $db_host = defined('APP_DB_HOSTNAME') ? APP_DB_HOSTNAME : '127.0.0.1';
    $db_user = defined('APP_DB_USERNAME') ? APP_DB_USERNAME : 'merq_portal';
    $db_pass = defined('APP_DB_PASSWORD') ? APP_DB_PASSWORD : 'merq_portal';
    $db_name = defined('APP_DB_NAME') ? APP_DB_NAME : 'merq_portal';
    $db_charset = defined('APP_DB_CHARSET') ? APP_DB_CHARSET : 'utf8mb4';
    $db_prefix = defined('APP_DB_PREFIX') ? APP_DB_PREFIX : 'tbl';

    try {
        $pdo = new PDO(
            "mysql:host=$db_host;dbname=$db_name;charset=$db_charset",
            $db_user,
            $db_pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        // Custom session handler using the same database
        class DBSessionHandler implements SessionHandlerInterface
        {
            private $pdo;
            private $table;

            public function __construct(PDO $pdo, $table = 'sessions')
            {
                $this->pdo = $pdo;
                $this->table = $table;
            }

            public function open(string $savePath, string $sessionName): bool
            {
                return true;
            }

            public function close(): bool
            {
                return true;
            }

            public function read(string $sessionId): string|false
            {
                $stmt = $this->pdo->prepare("SELECT data FROM {$this->table} WHERE id = :id");
                $stmt->execute([':id' => $sessionId]);

                if ($row = $stmt->fetch()) {
                    // CodeIgniter stores session data in a special serialized format
                    // We need to handle both regular and CodeIgniter's session data
                    $data = $row['data'];

                    // Check if it's CodeIgniter's session format (starts with __ci|)
                    if (strpos($data, '__ci|') === 0) {
                        // Extract the actual session data from CodeIgniter's format
                        $parts = explode('|', $data, 2);
                        if (count($parts) > 1) {
                            // The session data is base64 encoded and serialized
                            $session_data = base64_decode($parts[1]);
                            return $session_data;
                        }
                    }

                    return $data;
                }

                return '';
            }

            public function write(string $sessionId, string $data): bool
            {
                $timestamp = time();

                // For CodeIgniter compatibility, we need to store in their format
                $ci_data = '__ci|' . base64_encode($data);

                $stmt = $this->pdo->prepare(
                    "REPLACE INTO {$this->table} (id, ip_address, timestamp, data) 
                     VALUES (:id, :ip, :timestamp, :data)"
                );

                return $stmt->execute([
                    ':id' => $sessionId,
                    ':ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                    ':timestamp' => $timestamp,
                    ':data' => $ci_data
                ]);
            }

            public function destroy(string $sessionId): bool
            {
                $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
                return $stmt->execute([':id' => $sessionId]);
            }

            public function gc(int $maxlifetime): int|false
            {
                $old = time() - $maxlifetime;
                $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE timestamp < :old");
                $stmt->execute([':old' => $old]);
                return $stmt->rowCount();
            }
        }

        // Set custom session handler BEFORE session_start()
        $handler = new DBSessionHandler($pdo, SESS_SAVE_PATH);
        session_set_save_handler($handler, true);
    } catch (PDOException $e) {
        // Fall back to default session handling if DB connection fails
        error_log("Session DB connection failed: " . $e->getMessage());
    }
}

// Start the session with the same settings
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to check if user is logged in
function is_logged_in()
{
    return isset($_SESSION['client_user_id']) || isset($_SESSION['staff_user_id']);
}

// Function to get user data from session
function get_session_user_data()
{
    if (isset($_SESSION['client_user_id'])) {
        return [
            'user_id' => $_SESSION['client_user_id'],
            'username' => $_SESSION['client_username'] ?? '',
            'email' => $_SESSION['client_email'] ?? '',
            'firstname' => $_SESSION['client_firstname'] ?? '',
            'lastname' => $_SESSION['client_lastname'] ?? '',
            'user_type' => 'client'
        ];
    } elseif (isset($_SESSION['staff_user_id'])) {
        return [
            'user_id' => $_SESSION['staff_user_id'],
            'username' => $_SESSION['staff_username'] ?? '',
            'email' => $_SESSION['staff_email'] ?? '',
            'firstname' => $_SESSION['staff_firstname'] ?? '',
            'lastname' => $_SESSION['staff_lastname'] ?? '',
            'user_type' => 'staff'
        ];
    }

    return null;
}

// Function to get full user details from database
function get_user_full_details($user_id, $user_type = 'staff')
{
    global $pdo;

    $db_prefix = defined('APP_DB_PREFIX') ? APP_DB_PREFIX : 'tbl';

    if ($user_type === 'staff') {
        $table = $db_prefix . 'staff';
        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE staffid = :user_id");
    } else {
        $table = $db_prefix . 'clients';
        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE userid = :user_id");
    }

    $stmt->execute([':user_id' => $user_id]);

    if ($user = $stmt->fetch()) {
        return $user;
    }

    return null;
}

// Function to get current user with full details
function get_current_user_full_details()
{
    $session_data = get_session_user_data();

    if ($session_data) {
        $full_details = get_user_full_details($session_data['user_id'], $session_data['user_type']);

        if ($full_details) {
            return array_merge($session_data, $full_details);
        }
    }

    return $session_data;
}

// CSRF token functions (if needed)
function get_csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Clean output buffer
if (ob_get_length() > 0) {
    ob_end_flush();
}
