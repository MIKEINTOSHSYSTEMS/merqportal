<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserById($user_id)
    {
        $pdo = $this->db->getConnection();

        $stmt = $pdo->prepare("
            SELECT u.*, up.phone, up.address, up.preferred_language, up.ethiopian_calendar_preference 
            FROM users u
            LEFT JOIN user_profiles up ON u.user_id = up.user_id
            WHERE u.user_id = ?
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function updateProfile($user_id, $data)
    {
        $pdo = $this->db->getConnection();

        try {
            $pdo->beginTransaction();

            // Update users table
            $sql = "UPDATE users SET first_name = ?, middle_name = ?, last_name = ?, email = ?";
            $params = [
                $data['first_name'],
                $data['middle_name'] ?? null,
                $data['last_name'],
                $data['email']
            ];

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
            error_log("Profile update failed: " . $e->getMessage());
            return false;
        }
    }

    public function getAllUsers($role = null)
    {
        $pdo = $this->db->getConnection();

        $sql = "SELECT u.*, up.phone FROM users u LEFT JOIN user_profiles up ON u.user_id = up.user_id";
        $params = [];

        if ($role) {
            $sql .= " WHERE u.role = ?";
            $params[] = $role;
        }

        $sql .= " ORDER BY u.last_name, u.first_name";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function createUser($data)
    {
        $pdo = $this->db->getConnection();

        try {
            $pdo->beginTransaction();

            // Generate full name
            $full_name = trim($data['first_name'] . ' ' . ($data['middle_name'] ?? '') . ' ' . $data['last_name']);
            $full_name = preg_replace('/\s+/', ' ', $full_name); // Remove extra spaces

            // Insert into users table with all fields
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
            $pdo->commit();
            return $user_id;
        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log("User creation failed: " . $e->getMessage());
            throw new Exception("User creation failed: " . $e->getMessage());
        }
    }


    public function isAdmin($user_id)
    {
        $pdo = (new Database())->getConnection();
        $stmt = $pdo->prepare("SELECT role FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user && $user['role'] === 'admin';
    }

    public function updateUser($user_id, $data)
    {
        $pdo = $this->db->getConnection();

        try {
            $pdo->beginTransaction();

            // Generate full name
            $full_name = trim($data['first_name'] . ' ' . ($data['middle_name'] ?? '') . ' ' . $data['last_name']);
            $full_name = preg_replace('/\s+/', ' ', $full_name);

            // Build update query
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

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log("User update failed: " . $e->getMessage());
            throw new Exception("User update failed: " . $e->getMessage());
        }
    }

    public function getUserByEmail($email)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function createPasswordResetToken($user_id)
    {
        $pdo = $this->db->getConnection();

        // Generate a unique token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Delete any existing tokens for this user
        $stmt = $pdo->prepare("DELETE FROM password_reset_tokens WHERE user_id = ?");
        $stmt->execute([$user_id]);

        // Insert new token
        $stmt = $pdo->prepare("
            INSERT INTO password_reset_tokens (user_id, token, expires_at)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$user_id, $token, $expires]);

        return $token;
    }

    public function validatePasswordResetToken($token)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("
            SELECT * FROM password_reset_tokens 
            WHERE token = ? AND expires_at > NOW()
        ");
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    public function updatePassword($user_id, $password)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("
            UPDATE users 
            SET password_hash = ?
            WHERE user_id = ?
        ");
        return $stmt->execute([
            password_hash($password, PASSWORD_DEFAULT),
            $user_id
        ]);
    }

    public function deletePasswordResetToken($token_id)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("DELETE FROM password_reset_tokens WHERE token_id = ?");
        return $stmt->execute([$token_id]);
    }

    public function getAllUsersWithFilters($search = '', $role_filter = '', $status_filter = '', $department_filter = '', $sort_by = 'full_name', $sort_order = 'ASC', $limit = 10, $offset = 0)
    {
        $pdo = (new Database())->getConnection();

        $sql = "SELECT 
    u.user_id, 
    u.employee_id,
    u.is_doctor,
    u.full_name,
    u.first_name,
    u.middle_name,
    u.last_name,
    u.username,
    u.email,
    u.phone,
    u.alternate_phone,
    u.role,
    u.join_date,
    u.hire_date,
    u.leave_balance,
    u.last_leave_increment,
    u.is_active,
    d.department_name,        
    p.position_title,  
    u.supervisor_id,
    s.full_name AS supervisor_name,
    u.password_hash,
    u.last_login,
    u.created_at,
    u.updated_at
FROM users u
LEFT JOIN positions p 
    ON u.position_id = p.position_id
LEFT JOIN departments d 
    ON u.department_id = d.department_id
LEFT JOIN users s 
    ON u.supervisor_id = s.user_id
WHERE u.user_id NOT IN (1, 2, 3)"; // Added exclusion here

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (u.full_name LIKE ? OR u.email LIKE ? OR u.employee_id LIKE ?)";
            $searchTerm = "%$search%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        if (!empty($role_filter)) {
            $sql .= " AND u.role = ?";
            $params[] = $role_filter;
        }

        if (!empty($status_filter)) {
            $sql .= " AND u.is_active = ?";
            $params[] = ($status_filter === 'active') ? 1 : 0;
        }

        if (!empty($department_filter)) {
            $sql .= " AND u.department_id = ?";
            $params[] = $department_filter;
        }

        $sql .= " ORDER BY $sort_by $sort_order";
        $sql .= " LIMIT $limit OFFSET $offset";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUsersWithFilters($search = '', $role_filter = '', $status_filter = '', $department_filter = '')
    {
        $pdo = (new Database())->getConnection();

        $sql = "SELECT COUNT(*) as count
FROM users u
LEFT JOIN departments d ON u.department_id = d.department_id
WHERE u.user_id NOT IN (1, 2, 3)"; // Added exclusion here

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (u.full_name LIKE ? OR u.email LIKE ? OR u.employee_id LIKE ?)";
            $searchTerm = "%$search%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        if (!empty($role_filter)) {
            $sql .= " AND u.role = ?";
            $params[] = $role_filter;
        }

        if (!empty($status_filter)) {
            $sql .= " AND u.is_active = ?";
            $params[] = ($status_filter === 'active') ? 1 : 0;
        }

        if (!empty($department_filter)) {
            $sql .= " AND u.department_id = ?";
            $params[] = $department_filter;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }


}
