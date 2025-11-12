<?php
require_once __DIR__ . '/includes/session_manager.php';
require_once __DIR__ . '/includes/auth.php';

SessionManager::start();

$auth = new Auth();
$auth->logout();

Utils::addFlashMessage('success', 'You have been logged out successfully.');
Utils::redirect('login.php');