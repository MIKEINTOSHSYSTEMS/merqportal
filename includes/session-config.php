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

                        // Handle CodeIgniter-style prefix (__ci|)
                        if ($data && strpos($data, '__ci|') === 0) {
                            $parts = explode('|', $data, 2);
                            if (count($parts) > 1) {
                                return base64_decode($parts[1]) ?: '';
                            }
                        }

                        return $data;
                    }

                    return '';
                }

                public function write(string $sessionId, string $data): bool
                {
                    $timestamp = time();
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
                    $old = time() - (APP_SESSION_EXPIRATION ?? $maxlifetime);
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
        }
    }

    // Start PHP session
    session_start();
    ob_end_flush();
}
