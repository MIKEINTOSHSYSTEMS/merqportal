<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';

class AuthController {
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Utils::jsonResponse(['success' => false, 'message' => 'Invalid request method'], 405);
        }

        $action = $_POST['action'] ?? '';
        if ($action !== 'login') {
            Utils::jsonResponse(['success' => false, 'message' => 'Invalid action'], 400);
        }

        $email = Utils::sanitizeInput($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            Utils::jsonResponse(['success' => false, 'message' => 'Email and password are required'], 400);
        }

        $user = $this->auth->validateCredentials($email, $password);

        if ($user) {
            $this->auth->login($user);
            if (Utils::isAjax()) {
                Utils::jsonResponse(['success' => true, 'message' => 'Login successful']);
            } else {
                Utils::redirect('/apps/ts/dashboard.php');
            }
        } else {
            if (Utils::isAjax()) {
                Utils::jsonResponse(['success' => false, 'message' => 'Invalid email or password'], 401);
            } else {
                Utils::addFlashMessage('error', 'Invalid email or password');
                Utils::redirect('/apps/ts/login.php');
            }
        }
    }

    public function logout() {
        $this->auth->logout();
        Utils::redirect('/apps/ts/login.php');
    }

    public function checkSession() {
        if (SessionManager::isLoggedIn()) {
            $user = SessionManager::getUser();
            Utils::jsonResponse(['success' => true, 'user' => $user]);
        } else {
            Utils::jsonResponse(['success' => false, 'message' => 'Not logged in'], 401);
        }
    }
}
?>