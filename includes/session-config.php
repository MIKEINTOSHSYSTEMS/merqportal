<?php
// includes/session-config.php

if (session_status() === PHP_SESSION_NONE) {
    ob_start();

    require_once 'ci-config.php';

    // Configure PHP session cookie (must be done before session_start)
    if (!headers_sent()) {
        session_name(APP_SESSION_COOKIE_NAME);
        session_set_cookie_params([
            'lifetime' => APP_SESSION_EXPIRATION,
            'path'     => APP_COOKIE_PATH,
            'domain'   => APP_COOKIE_DOMAIN,
            'secure'   => APP_COOKIE_SECURE,
            'httponly' => APP_COOKIE_HTTPONLY,
            'samesite' => APP_SESSION_COOKIE_SAME_SITE
        ]);
    }

    // Database-backed sessions
    if (SESS_DRIVER === 'database') {
        try {
            $pdo = new PDO(
                "mysql:host=" . APP_DB_HOSTNAME .
                    ";dbname=" . APP_DB_NAME .
                    ";charset=" . APP_DB_CHARSET,
                APP_DB_USERNAME,
                APP_DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );

            class DBSessionHandler implements SessionHandlerInterface
            {
                private $pdo;
                private $table;

                public function __construct(PDO $pdo, string $table)
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
                    $stmt = $this->pdo->prepare(
                        "SELECT data FROM {$this->table} WHERE id = :id LIMIT 1"
                    );
                    $stmt->execute([':id' => $sessionId]);

                    if ($row = $stmt->fetch()) {
                        $data = $row['data'] ?? '';

                        // Handle CodeIgniter's session format: __ci|base64_encoded_data
                        if ($data && strpos($data, '__ci|') === 0) {
                            $parts = explode('|', $data, 2);
                            if (count($parts) > 1) {
                                $decoded = base64_decode($parts[1]);
                                return $decoded !== false ? $decoded : '';
                            }
                        }

                        return $data;
                    }

                    return '';
                }

                public function write(string $sessionId, string $data): bool
                {
                    $timestamp = time();

                    // Use CodeIgniter's format for consistency: __ci|base64_encoded_data
                    $ci_data = '__ci|' . base64_encode($data);

                    $stmt = $this->pdo->prepare(
                        "REPLACE INTO {$this->table} (id, ip_address, timestamp, data)
                         VALUES (:id, :ip, :timestamp, :data)"
                    );

                    return $stmt->execute([
                        ':id'        => $sessionId,
                        ':ip'        => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                        ':timestamp' => $timestamp,
                        ':data'      => $ci_data
                    ]);
                }

                public function destroy(string $sessionId): bool
                {
                    $stmt = $this->pdo->prepare(
                        "DELETE FROM {$this->table} WHERE id = :id"
                    );
                    return $stmt->execute([':id' => $sessionId]);
                }

                public function gc(int $maxlifetime): int|false
                {
                    $old = time() - $maxlifetime;
                    $stmt = $this->pdo->prepare(
                        "DELETE FROM {$this->table} WHERE timestamp < :old"
                    );
                    $stmt->execute([':old' => $old]);
                    return $stmt->rowCount();
                }
            }

            $handler = new DBSessionHandler($pdo, SESS_SAVE_PATH);
            session_set_save_handler($handler, true);
        } catch (PDOException $e) {
            error_log("Session DB connection failed: " . $e->getMessage());
            // Fallback to default session handler
        }
    }

    // Start PHP session
    session_start();

    // CRITICAL: Ensure session variables use CodeIgniter-compatible format
    // Convert integer user IDs to strings to match CodeIgniter's format
    if (isset($_SESSION['staff_user_id']) && is_int($_SESSION['staff_user_id'])) {
        $_SESSION['staff_user_id'] = (string)$_SESSION['staff_user_id'];
    }

    if (isset($_SESSION['client_user_id']) && is_int($_SESSION['client_user_id'])) {
        $_SESSION['client_user_id'] = (string)$_SESSION['client_user_id'];
    }

    // Add CodeIgniter-specific session variables if they don't exist
    if (!isset($_SESSION['__ci_last_regenerate'])) {
        $_SESSION['__ci_last_regenerate'] = time();
    }

    // Function to check if user is logged in - CodeIgniter compatible
    function is_logged_in()
    {
        return isset($_SESSION['staff_logged_in']) && $_SESSION['staff_logged_in'] === true;
    }

    // Function to get user data from session - CodeIgniter compatible
    function get_session_user_data()
    {
        if (isset($_SESSION['staff_user_id']) && isset($_SESSION['staff_logged_in']) && $_SESSION['staff_logged_in'] === true) {
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

    // CSRF token functions - CodeIgniter compatible
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

    ob_end_flush();
}
