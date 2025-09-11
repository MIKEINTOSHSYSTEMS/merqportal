<?php
// session_test.php
require_once __DIR__ . '/../../../includes/ci-config.php';
require_once __DIR__ . '/../../../includes/session-config.php';

header('Content-Type: application/json');

$response = [
    'session_status' => session_status(),
    'session_id' => session_id(),
    'session_data' => $_SESSION,
    'cookie_params' => session_get_cookie_params()
];

echo json_encode($response, JSON_PRETTY_PRINT);
