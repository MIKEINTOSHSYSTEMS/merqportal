<?php
// temp_initialize.php - Run this once then delete
require_once '../includes/config.php';
require_once '../includes/initialize_permissions.php';

$result = initializeAllUserPermissions();
echo "<pre>";
print_r($result);
echo "</pre>";
