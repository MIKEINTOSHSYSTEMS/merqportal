<?php
// autoload.php - Simple autoloader for vendor libraries

// PHPMailer autoloader
$phpmailerPath = __DIR__ . '/phpmailer/phpmailer/src/PHPMailer.php';
if (file_exists($phpmailerPath)) {
    require_once $phpmailerPath;
    require_once __DIR__ . '/phpmailer/phpmailer/src/SMTP.php';
    require_once __DIR__ . '/phpmailer/phpmailer/src/Exception.php';
}

// Function to check if PHPMailer is loaded
function isPHPMailerLoaded()
{
    return class_exists('PHPMailer\PHPMailer\PHPMailer');
}

// Function to get PHPMailer version
function getPHPMailerVersion()
{
    if (isPHPMailerLoaded()) {
        return defined('PHPMailer\PHPMailer\PHPMailer::VERSION') ?
            PHPMailer\PHPMailer\PHPMailer::VERSION : 'Unknown';
    }
    return 'Not loaded';
}
