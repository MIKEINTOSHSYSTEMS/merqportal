<?php
require_once __DIR__ . '/../config/database.php';

class Project {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    public function getAllProjects() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM projects WHERE is_active = 1 ORDER BY project_name");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error getting projects: " . $e->getMessage());
            return [];
        }
    }

    public function getProjectById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM projects WHERE project_id = ? AND is_active = 1");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error getting project: " . $e->getMessage());
            return null;
        }
    }

    public function addProject($name, $allocatedHours) {
        try {
            $stmt = $this->db->prepare("INSERT INTO projects (project_name, allocated_hours, is_active, created_at) VALUES (?, ?, 1, NOW())");
            return $stmt->execute([$name, $allocatedHours]);
        } catch (PDOException $e) {
            error_log("Error adding project: " . $e->getMessage());
            return false;
        }
    }

    public function updateProject($id, $name, $allocatedHours) {
        try {
            $stmt = $this->db->prepare("UPDATE projects SET project_name = ?, allocated_hours = ?, updated_at = NOW() WHERE project_id = ?");
            return $stmt->execute([$name, $allocatedHours, $id]);
        } catch (PDOException $e) {
            error_log("Error updating project: " . $e->getMessage());
            return false;
        }
    }

    public function deleteProject($id) {
        try {
            $stmt = $this->db->prepare("UPDATE projects SET is_active = 0, updated_at = NOW() WHERE project_id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting project: " . $e->getMessage());
            return false;
        }
    }

    public function getUserProjects($userId) {
        // This would get projects assigned to a user
        // For now, return all projects
        return $this->getAllProjects();
    }

    public function addUserProject($userId, $year, $month, $projectName, $allocatedHours) {
        // This would add a project to user's timesheet
        // For now, just return true
        return true;
    }

    public function deleteUserProject($userId, $year, $month, $projectId) {
        // This would remove a project from user's timesheet
        // For now, just return true
        return true;
    }

    public function getProjectHours($userId, $year, $month, $projectId) {
        // This would get hours for a project in user's timesheet
        // For now, return empty array
        return array_fill(1, 30, 0.0);
    }

    public function updateProjectHours($userId, $year, $month, $projectId, $day, $hours) {
        // This would update hours for a project in user's timesheet
        // For now, just return true
        return true;
    }
}
?>