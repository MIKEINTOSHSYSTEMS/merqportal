<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../models/Project.php';

SessionManager::requireLogin();
header('Content-Type: application/json');

$currentUser = SessionManager::getUser();
$userId = $currentUser['user_id'];
$projectModel = new Project();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $all = isset($_GET['all']) && $_GET['all'] == '1';

    if ($all) {
        // Return all available projects
        $projects = $projectModel->getAllProjects();
        Utils::jsonResponse(['projects' => $projects]);
    } else {
        // Return user projects for specific month/year
        $year = intval($_GET['year'] ?? 0);
        $month = intval($_GET['month'] ?? 0);

        if (!$year || !$month) {
            Utils::jsonResponse(['error' => 'Year and month are required'], 400);
        }

        $projects = $projectModel->getUserProjects($userId, $year, $month);
        Utils::jsonResponse(['projects' => $projects]);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $projectName = trim($input['name'] ?? '');
    $allocatedHours = floatval($input['allocated_hours'] ?? 0);
    $year = intval($input['year'] ?? 0);
    $month = intval($input['month'] ?? 0);

    if (empty($projectName)) {
        Utils::jsonResponse(['error' => 'Project name is required'], 400);
    }

    if (!$year || !$month) {
        Utils::jsonResponse(['error' => 'Year and month are required'], 400);
    }

    $newProject = $projectModel->addUserProject($userId, $year, $month, $projectName, $allocatedHours);

    if ($newProject) {
        Utils::jsonResponse([
            'success' => true,
            'project' => $newProject,
            'message' => 'Project added successfully'
        ]);
    } else {
        Utils::jsonResponse(['error' => 'Failed to add project'], 500);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $projectId = intval($_GET['project_id'] ?? 0);
    $year = intval($_GET['year'] ?? 0);
    $month = intval($_GET['month'] ?? 0);

    if (!$projectId) {
        Utils::jsonResponse(['error' => 'Project ID is required'], 400);
    }

    if (!$year || !$month) {
        Utils::jsonResponse(['error' => 'Year and month are required'], 400);
    }

    $projects = $projectModel->getUserProjects($userId, $year, $month);

    // Ensure at least one project remains
    if (count($projects) <= 1) {
        Utils::jsonResponse(['error' => 'At least one project must remain'], 400);
    }

    $success = $projectModel->deleteUserProject($userId, $year, $month, $projectId);

    if ($success) {
        Utils::jsonResponse([
            'success' => true,
            'message' => 'Project deleted successfully'
        ]);
    } else {
        Utils::jsonResponse(['error' => 'Failed to delete project'], 500);
    }

    Utils::jsonResponse([
        'success' => true,
        'message' => 'Project deleted successfully'
    ]);
} else {
    Utils::jsonResponse(['error' => 'Invalid request method'], 405);
}

?>