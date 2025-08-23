<?php
class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($email, $password)
    {
        $pdo = $this->db->getConnection();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_role'] = $user['role'];

            // Update last login
            $this->updateLastLogin($user['user_id']);

            return true;
        }

        return false;
    }

    private function updateLastLogin($user_id)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }

    public function register($data)
    {
        $pdo = $this->db->getConnection();

        try {
            $pdo->beginTransaction();

            // Check if email exists
            $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
            $stmt->execute([$data['email']]);
            if ($stmt->fetch()) {
                throw new Exception("Email already exists");
            }

            // Generate full name
            $full_name = trim($data['first_name'] . ' ' . ($data['middle_name'] ?? '') . ' ' . $data['last_name']);
            $full_name = preg_replace('/\s+/', ' ', $full_name);

            // Insert user with all fields
            $sql = "INSERT INTO users 
                (employee_id, first_name, middle_name, last_name, full_name, username, email, 
                 password_hash, phone, alternate_phone, role, department_id, position_id, 
                 supervisor_id, join_date, hire_date, is_doctor, is_active) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $data['employee_id'] ?? null,
                $data['first_name'],
                $data['middle_name'] ?? null,
                $data['last_name'],
                $full_name,
                $data['username'] ?? null,
                $data['email'],
                $password_hash,
                $data['phone'] ?? null,
                $data['alternate_phone'] ?? null,
                $data['role'] ?? 'employee',
                $data['department_id'] ?? null,
                $data['position_id'] ?? null,
                $data['supervisor_id'] ?? null,
                $data['join_date'] ?? null,
                $data['hire_date'] ?? null,
                $data['is_doctor'] ?? 0,
                $data['is_active'] ?? 1
            ]);

            $user_id = $pdo->lastInsertId();

            // Insert user profile
            $stmt = $pdo->prepare("
                INSERT INTO user_profiles (user_id, preferred_language, ethiopian_calendar_preference)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $user_id,
                $data['preferred_language'] ?? 'en',
                $data['ethiopian_calendar_preference'] ?? 0
            ]);

            $pdo->commit();
            return $user_id;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function logout()
    {
        session_destroy();
        session_regenerate_id(true);
    }

    public function getUser($user_id)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function updateUser($user_id, $data)
    {
        $pdo = $this->db->getConnection();

        try {
            $pdo->beginTransaction();

            // Generate full name
            $full_name = trim($data['first_name'] . ' ' . ($data['middle_name'] ?? '') . ' ' . $data['last_name']);
            $full_name = preg_replace('/\s+/', ' ', $full_name);

            // Update users table with all fields
            $sql = "UPDATE users SET 
                employee_id = ?, first_name = ?, middle_name = ?, last_name = ?, full_name = ?, 
                username = ?, email = ?, phone = ?, alternate_phone = ?, role = ?, 
                department_id = ?, position_id = ?, supervisor_id = ?, join_date = ?, 
                hire_date = ?, is_doctor = ?, is_active = ?";

            $params = [
                $data['employee_id'] ?? null,
                $data['first_name'],
                $data['middle_name'] ?? null,
                $data['last_name'],
                $full_name,
                $data['username'] ?? null,
                $data['email'],
                $data['phone'] ?? null,
                $data['alternate_phone'] ?? null,
                $data['role'],
                $data['department_id'] ?? null,
                $data['position_id'] ?? null,
                $data['supervisor_id'] ?? null,
                $data['join_date'] ?? null,
                $data['hire_date'] ?? null,
                $data['is_doctor'] ?? 0,
                $data['is_active'] ?? 1
            ];

            // Update password if provided
            if (!empty($data['password'])) {
                $sql .= ", password_hash = ?";
                $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            $sql .= " WHERE user_id = ?";
            $params[] = $user_id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            // Update user_profiles table
            $stmt = $pdo->prepare("
                UPDATE user_profiles 
                SET phone = ?, address = ?, 
                    preferred_language = ?, ethiopian_calendar_preference = ?
                WHERE user_id = ?
            ");
            $stmt->execute([
                $data['phone'] ?? null,
                $data['address'] ?? null,
                $data['preferred_language'] ?? 'en',
                $data['ethiopian_calendar_preference'] ?? 0,
                $user_id
            ]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw new Exception("Failed to update user: " . $e->getMessage());
        }
    }

    public function changePassword($user_id, $current_password, $new_password)
    {
        $pdo = $this->db->getConnection();

        // Verify current password
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($current_password, $user['password_hash'])) {
            return false;
        }

        // Update password
        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
        return $stmt->execute([$new_hash, $user_id]);
    }

    // Additional helper method to check if email exists
    public function emailExists($email, $exclude_user_id = null)
    {
        $pdo = $this->db->getConnection();

        $sql = "SELECT user_id FROM users WHERE email = ?";
        $params = [$email];

        if ($exclude_user_id) {
            $sql .= " AND user_id != ?";
            $params[] = $exclude_user_id;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return (bool) $stmt->fetch();
    }

    // Method to get user by email
    public function getUserByEmail($email)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
