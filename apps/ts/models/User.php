<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = getDBConnection();
    }
    
    public function findById($userId) {
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
                WHERE u.user_id = ? AND u.is_active = 1
            ");
            
            $stmt->execute([$userId]);
            return $stmt->fetch();
            
        } catch (PDOException $e) {
            error_log("Error finding user: " . $e->getMessage());
            return null;
        }
    }
}
?>