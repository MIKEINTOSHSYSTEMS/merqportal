<?php
// db_connection.php - Database connection helper

// Include the configuration file that defines the constants
require_once __DIR__ . '/../../../includes/ci-config.php';

function get_db_connection()
{
    static $pdo = null;

    if ($pdo === null) {
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
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            return false;
        }
    }

    return $pdo;
}

// Function to verify staff credentials
function verify_staff_credentials($email, $password)
{
    $pdo = get_db_connection();
    if (!$pdo) return false;

    $table = APP_DB_PREFIX . 'staff';
    $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE email = :email AND active = 1");
    $stmt->execute([':email' => $email]);

    $staff = $stmt->fetch();

    if ($staff && password_verify($password, $staff['password'])) {
        return $staff;
    }

    return false;
}
