<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';

SessionManager::requireLogin();
header('Content-Type: application/json');

$currentUser = SessionManager::getUser();
$currentEthDate = EthiopianDateConverter::getCurrentEthiopianDate();

Utils::jsonResponse([
    'status' => 'ok',
    'message' => 'Debug API working',
    'user' => $currentUser,
    'ethiopian_date' => $currentEthDate,
    'server_time' => date('Y-m-d H:i:s'),
    'session_id' => session_id()
]);
?>