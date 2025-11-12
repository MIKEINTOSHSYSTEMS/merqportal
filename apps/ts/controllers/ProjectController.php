<?php
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';

class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new Project();
    }

    public function getProjects() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        $projects = $this->projectModel->getAllProjects();
        Utils::jsonResponse(['success' => true, 'projects' => $projects]);
    }

    public function addProject() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Utils::jsonResponse(['success' => false, 'message' => 'Invalid request method'], 405);
        }

        $name = Utils::sanitizeInput($_POST['name'] ?? '');
        $allocatedHours = (float)($_POST['allocated_hours'] ?? 0);

        if (empty($name)) {
            Utils::jsonResponse(['success' => false, 'message' => 'Project name is required'], 400);
        }

        $result = $this->projectModel->addProject($name, $allocatedHours);
        if ($result) {
            Utils::jsonResponse(['success' => true, 'message' => 'Project added successfully']);
        } else {
            Utils::jsonResponse(['success' => false, 'message' => 'Failed to add project'], 500);
        }
    }

    public function updateProject() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Utils::jsonResponse(['success' => false, 'message' => 'Invalid request method'], 405);
        }

        $id = (int)($_POST['id'] ?? 0);
        $name = Utils::sanitizeInput($_POST['name'] ?? '');
        $allocatedHours = (float)($_POST['allocated_hours'] ?? 0);

        if (empty($id) || empty($name)) {
            Utils::jsonResponse(['success' => false, 'message' => 'Project ID and name are required'], 400);
        }

        $result = $this->projectModel->updateProject($id, $name, $allocatedHours);
        if ($result) {
            Utils::jsonResponse(['success' => true, 'message' => 'Project updated successfully']);
        } else {
            Utils::jsonResponse(['success' => false, 'message' => 'Failed to update project'], 500);
        }
    }

    public function deleteProject() {
        if (!SessionManager::isLoggedIn()) {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Utils::jsonResponse(['success' => false, 'message' => 'Invalid request method'], 405);
        }

        $id = (int)($_POST['id'] ?? 0);

        if (empty($id)) {
            Utils::jsonResponse(['success' => false, 'message' => 'Project ID is required'], 400);
        }

        $result = $this->projectModel->deleteProject($id);
        if ($result) {
            Utils::jsonResponse(['success' => true, 'message' => 'Project deleted successfully']);
        } else {
            Utils::jsonResponse(['success' => false, 'message' => 'Failed to delete project'], 500);
        }
    }
}
?>