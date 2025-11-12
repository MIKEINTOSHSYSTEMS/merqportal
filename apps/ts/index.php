<?php
// MERQ Timesheet System - Main Entry Point
// Redirect to login or dashboard based on session

require_once __DIR__ . '/includes/session_manager.php';
require_once __DIR__ . '/includes/utils.php';

SessionManager::start();

if (SessionManager::isLoggedIn()) {
    Utils::redirect('/apps/ts/dashboard.php');
} else {
    Utils::redirect('/apps/ts/login.php');
}
?>