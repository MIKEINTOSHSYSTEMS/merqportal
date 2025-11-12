<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/utils.php';

SessionManager::start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'login') {
        $email = Utils::sanitizeInput($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            Utils::jsonResponse([
                'success' => false,
                'message' => 'Please enter both email and password'
            ], 400);
        }
        
        $auth = new Auth();
        $user = $auth->validateCredentials($email, $password);
        
        if ($user) {
            $auth->login($user);
            if (Utils::isAjax()) {
                Utils::jsonResponse([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $user
                ]);
            } else {
                // Regular form submission - redirect to dashboard
                Utils::redirect('../dashboard.php');
            }
        } else {
            if (Utils::isAjax()) {
                Utils::jsonResponse([
                    'success' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            } else {
                // Regular form submission - redirect back to login with error
                Utils::addFlashMessage('error', 'Invalid email or password');
                Utils::redirect('../login.php');
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'logout') {
    $auth = new Auth();
    $auth->logout();
    
    Utils::jsonResponse([
        'success' => true,
        'message' => 'Logout successful'
    ]);
} else {
    Utils::jsonResponse([
        'success' => false,
        'message' => 'Invalid request method'
    ], 405);
}
?>