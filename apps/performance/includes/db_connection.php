<?php
// db_connection.php - Database connection helper

// Include the configuration file that defines the constants
require_once __DIR__ . '/../../../includes/ci-config.php';
require_once 'config.php';

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


// Function to verify user credentials
/*
function verify_user_credentials($email, $password)
{
    $pdo = get_db_connection();
    if (!$pdo) return false;

    $table = 'users';
    $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE email = :email AND is_active = 1");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    }

    return false;
}
*/

// Add this Database class to your existing db_connection.php
class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . DB_HOST .
                        ";dbname=" . DB_NAME .
                        ";charset=" . APP_DB_CHARSET,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                    ]
                );
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                throw new Exception("Database connection failed");
            }
        }
        return self::$connection;
    }
}

// Function to verify user credentials
function verify_user_credentials($email, $password)
{
    $pdo = get_db_connection();
    if (!$pdo) return false;

    $table = 'users';
    $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE email = :email AND is_active = 1");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch();

    if ($user) {
        // Check password_hash column first (primary)
        if (isset($user['password_hash']) && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        // Fallback to password column
        else if (isset($user['password']) && password_verify($password, $user['password'])) {
            return $user;
        }
        // Final fallback: plain text (legacy)
        else if (isset($user['password_hash']) && $user['password_hash'] === $password) {
            return $user;
        } else if (isset($user['password']) && $user['password'] === $password) {
            return $user;
        }
    }

    return false;
}



// get complete user profile
function get_user_profile($user_id)
{
    global $pdo;

    $sql = "SELECT u.*, p.position_title, d.department_name, s.full_name as supervisor_name
            FROM users u 
            LEFT JOIN positions p ON u.position_id = p.position_id 
            LEFT JOIN departments d ON u.department_id = d.department_id 
            LEFT JOIN users s ON u.supervisor_id = s.user_id 
            WHERE u.user_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}