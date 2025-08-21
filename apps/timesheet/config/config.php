<?php

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once __DIR__ . '/database.php';

// Include session configuration (session start is handled here)
require_once __DIR__ . '/../../../includes/session-config.php';

// Application settings
define('APP_NAME', 'MERQ Timesheet');
define('APP_VERSION', '1.0.0');
//define('BASE_URL', 'https://timesheet.merqconsultancy.org/timesheet');
//define('BASE_URL', 'https://app.merqconsultancy.org/apps/timesheet');
define('BASE_URL', 'http://merqapp/apps/timesheet');

// Default calendar preference (will be handled with session-config.php)
$_SESSION['ethiopian_calendar'] = $_SESSION['ethiopian_calendar'] ?? false;

// Include necessary classes
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/Timesheet.php';
require_once __DIR__ . '/../classes/Translation.php';
require_once __DIR__ . '/../functions/helpers.php';

// Google Auth constants
define('GOOGLE_OAUTH_CLIENT_ID', getSetting('GOOGLE_OAUTH_CLIENT_ID'));
define('GOOGLE_OAUTH_CLIENT_SECRET', getSetting('GOOGLE_OAUTH_CLIENT_SECRET'));

// Get settings function
function getSetting($key)
{
    static $settings;
    if (!$settings) {
        $pdo = (new Database())->getConnection();
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM system_settings");
        $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    return $settings[$key] ?? null;
}
