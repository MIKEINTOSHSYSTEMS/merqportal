<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/utils.php';

class Auth {
    
    private $db;
    
    public function __construct() {
        $this->db = getDBConnection();
    }
    
    public function validateCredentials($email, $password) {
        $normalizedEmail = Utils::normalizeEmail($email);
        
        $user = $this->getUserByEmail($normalizedEmail);
        if (!$user) {
            return null;
        }
        
        $storedHash = $user['password_hash'];
        if (!$storedHash) {
            return null;
        }
        
        // Handle PHP bcrypt format
        if (strpos($storedHash, '$2y$') === 0) {
            $storedHash = '$2b$' . substr($storedHash, 4);
        }
        
        if (password_verify($password, $storedHash)) {
            return $user;
        }
        
        return null;
    }
    
    public function getUserByEmail($email) {
        try {
            $stmt = $this->db->prepare("
                SELECT u.*, 
                    p.position_title, 
                    d.department_name, 
                    sup.full_name AS supervisor_name, 
                    sup.email AS supervisor_email, 
                    sup_pos.position_title AS supervisor_position_title
                FROM users u
                LEFT JOIN positions p ON u.position_id = p.position_id
                LEFT JOIN departments d ON u.department_id = d.department_id
                LEFT JOIN users sup ON u.supervisor_id = sup.user_id
                LEFT JOIN positions sup_pos ON sup.position_id = sup_pos.position_id
                WHERE u.email = ? AND u.is_active = 1
            ");
            
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            return $user ?: null;
            
        } catch (PDOException $e) {
            error_log("Error getting user by email: " . $e->getMessage());
            return null;
        }
    }
    
    public function getHRUsers() {
        try {
            $stmt = $this->db->prepare("
                SELECT u.*, p.position_title, d.department_name
                FROM users u
                JOIN positions p ON u.position_id = p.position_id
                JOIN departments d ON u.department_id = d.department_id
                WHERE u.position_id = 18 AND u.is_active = 1
            ");
            
            $stmt->execute();
            return $stmt->fetchAll();
            
        } catch (PDOException $e) {
            error_log("Error getting HR users: " . $e->getMessage());
            return [];
        }
    }
    
    public function login($user) {
        SessionManager::set('user_id', $user['user_id']);
        SessionManager::set('user_data', $user);
        SessionManager::set('logged_in', true);
        SessionManager::set('last_activity', time());
    }
    
    public function logout() {
        SessionManager::destroy();
    }
}
?>