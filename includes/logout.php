<?php
require_once 'config.php';
require_once 'functions.php';

// Destroy the session
$_SESSION = array();
session_destroy();

// Redirect to login page
header('Location: /admin/login.php');
exit;
