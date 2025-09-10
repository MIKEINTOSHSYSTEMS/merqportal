<?php
require_once 'includes/session-config.php';

header('Content-Type: application/json');

$response = [];

if (is_logged_in()) {
    $user = get_current_user_full_details();

    $response['status'] = 'success';
    $response['logged_in'] = true;
    $response['user'] = $user;
    $response['session_data'] = $_SESSION;
} else {
    $response['status'] = 'error';
    $response['logged_in'] = false;
    $response['message'] = 'Not logged in';
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
