<?php
require_once __DIR__ . '/../config/database.php';

class Project {
    private $db;

    private function calculateTotalWorkingHours($year, $month)
    {
        require_once __DIR__ . '/../includes/ethiopian_date.php';
        $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
        $totalHours = 0.0;

        for ($day = 1; $day <= $monthDays; $day++) {
            $weekdayIndex = EthiopianDateConverter::getEthiopianWeekday($year, $month, $day);

            if ($weekdayIndex < 4) { // Monday-Thursday: 8 hours
                $dayHours = 8.0;
            } elseif ($weekdayIndex == 4) { // Friday: 8 hours
                $dayHours = 8.0;
            } elseif ($weekdayIndex == 5) { // Saturday: 4 hours
                $dayHours = 4.0;
            } else { // Sunday: 0 hours
                $dayHours = 0.0;
            }

            $totalHours += $dayHours;
        }

        return $totalHours;
    }

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

    public function getUserProjects($userId, $year, $month) {
        try {
            // Check if user has projects for this month/year
            $stmt = $this->db->prepare("
                SELECT up.*, p.project_name, p.project_code 
                FROM user_projects up 
                JOIN projects p ON up.project_id = p.project_id 
                WHERE up.user_id = ? AND up.year = ? AND up.month = ?
            ");
            $stmt->execute([$userId, $year, $month]);
            $userProjects = $stmt->fetchAll();

            // If no projects, create default MERQ Internal project
            if (empty($userProjects)) {
                $defaultProject = $this->addUserProject($userId, $year, $month, 'MERQ Internal', 0);
                return [$defaultProject];
            }

            return $userProjects;
        } catch (PDOException $e) {
            error_log("Error getting user projects: " . $e->getMessage());
            return [];
        }
    }

    public function addUserProject($userId, $year, $month, $projectName, $allocatedHours)
    {
        try {
            // First, check if project exists
            $stmt = $this->db->prepare("SELECT project_id FROM projects WHERE project_name = ? AND is_active = 1");
            $stmt->execute([$projectName]);
            $project = $stmt->fetch();

            $projectId = null;
            if ($project) {
                $projectId = $project['project_id'];
            } else {
                // Create new project
                $stmt = $this->db->prepare("INSERT INTO projects (project_name, is_active, created_at) VALUES (?, 1, NOW())");
                $stmt->execute([$projectName]);
                $projectId = $this->db->lastInsertId();
            }

            // For MERQ Internal project, calculate proper allocated hours
            if (strtolower($projectName) === 'merq internal') {
                require_once __DIR__ . '/../includes/ethiopian_date.php';
                $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
                $allocatedHours = $this->calculateTotalWorkingHours($year, $month);
            }

            // Add to user projects
            $stmt = $this->db->prepare("
            INSERT INTO user_projects (user_id, project_id, year, month, allocated_hours, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
            $stmt->execute([$userId, $projectId, $year, $month, $allocatedHours]);

            return [
                'project_id' => $projectId,
                'project_name' => $projectName,
                'allocated_hours' => $allocatedHours,
                'year' => $year,
                'month' => $month
            ];
        } catch (PDOException $e) {
            error_log("Error adding user project: " . $e->getMessage());
            return false;
        }
    }

    public function deleteUserProject($userId, $year, $month, $projectId) {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM user_projects 
                WHERE user_id = ? AND project_id = ? AND year = ? AND month = ?
            ");
            return $stmt->execute([$userId, $projectId, $year, $month]);
        } catch (PDOException $e) {
            error_log("Error deleting user project: " . $e->getMessage());
            return false;
        }
    }

    public function getProjectHours($userId, $year, $month, $projectId) {
        try {
            $stmt = $this->db->prepare("
                SELECT day, hours FROM project_hours 
                WHERE user_id = ? AND project_id = ? AND year = ? AND month = ?
            ");
            $stmt->execute([$userId, $projectId, $year, $month]);
            $hours = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            
            $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
            $result = [];
            for ($day = 1; $day <= $monthDays; $day++) {
                $result[$day] = floatval($hours[$day] ?? 0.0);
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Error getting project hours: " . $e->getMessage());
            $monthDays = EthiopianDateConverter::getEthiopianMonthDays($year, $month);
            return array_fill(1, $monthDays, 0.0);
        }
    }

    public function updateProjectHours($userId, $year, $month, $projectId, $day, $hours) {
        try {
            // Check if record exists
            $stmt = $this->db->prepare("
                SELECT id FROM project_hours 
                WHERE user_id = ? AND project_id = ? AND year = ? AND month = ? AND day = ?
            ");
            $stmt->execute([$userId, $projectId, $year, $month, $day]);
            $existing = $stmt->fetch();

            if ($existing) {
                // Update existing
                $stmt = $this->db->prepare("
                    UPDATE project_hours SET hours = ?, updated_at = NOW() 
                    WHERE user_id = ? AND project_id = ? AND year = ? AND month = ? AND day = ?
                ");
                return $stmt->execute([$hours, $userId, $projectId, $year, $month, $day]);
            } else {
                // Insert new
                $stmt = $this->db->prepare("
                    INSERT INTO project_hours (user_id, project_id, year, month, day, hours, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())
                ");
                return $stmt->execute([$userId, $projectId, $year, $month, $day, $hours]);
            }
        } catch (PDOException $e) {
            error_log("Error updating project hours: " . $e->getMessage());
            return false;
        }
    }

    public function updateProjectAllocatedHours($userId, $year, $month, $projectId, $allocatedHours)
    {
        try {
            $stmt = $this->db->prepare("
            UPDATE user_projects 
            SET allocated_hours = ?, updated_at = NOW() 
            WHERE user_id = ? AND project_id = ? AND year = ? AND month = ?
        ");
            return $stmt->execute([$allocatedHours, $userId, $projectId, $year, $month]);
        } catch (PDOException $e) {
            error_log("Error updating project allocated hours: " . $e->getMessage());
            return false;
        }
    }

}
?>