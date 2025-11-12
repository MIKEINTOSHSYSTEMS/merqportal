<?php
require_once __DIR__ . '/../config/constants.php';

class Utils {
    
    public static function redirect($url) {
        header("Location: $url");
        exit;
    }
    
    public static function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    public static function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    public static function normalizeEmail($email) {
        $email = strtolower(trim($email));
        
        if (strpos($email, '@') === false) {
            $email .= '@merqconsultancy.org';
        } elseif (!str_ends_with($email, '@merqconsultancy.org')) {
            $parts = explode('@', $email);
            $email = $parts[0] . '@merqconsultancy.org';
        }
        
        return $email;
    }
    
    public static function safeFloatConvert($value) {
        if ($value === '' || $value === null) {
            return 0.0;
        }
        return floatval($value);
    }
    
    public static function addFlashMessage($type, $message) {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }
        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function getFlashMessages() {
        $messages = $_SESSION['flash_messages'] ?? [];
        unset($_SESSION['flash_messages']);
        return $messages;
    }

    public static function logToFile($message, $level = 'INFO') {
        $logFile = __DIR__ . '/../logs/merqts.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] [$level] $message" . PHP_EOL;

        // Ensure log directory exists
        $logDir = dirname($logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }
    
    public static function formatEthiopianDate($day, $month, $year) {
        return sprintf("%d/%d/%d", $day, $month, $year);
    }
}

// Define constants if not already defined
if (!defined('ETHIOPIAN_MONTHS_AMHARIC')) {
    define('ETHIOPIAN_MONTHS_AMHARIC', [
        'መስከረም', 'ጥቅምት', 'ኅዳር', 'ታኅሣሥ', 
        'ጥር', 'የካቲት', 'መጋቢት', 'ሚያዝያ', 
        'ግንቦት', 'ሰኔ', 'ሐምሌ', 'ነሐሴ', 'ጳጉሜ'
    ]);
}

if (!defined('ETHIOPIAN_MONTHS_ENGLISH')) {
    define('ETHIOPIAN_MONTHS_ENGLISH', [
        'Meskerem', 'Tikimt', 'Hidar', 'Tahsas',
        'Tir', 'Yekatit', 'Megabit', 'Miyazya',
        'Ginbot', 'Sene', 'Hamle', 'Nehase', 'Pagume'
    ]);
}

if (!defined('ETHIOPIAN_WEEKDAYS_AMHARIC')) {
    define('ETHIOPIAN_WEEKDAYS_AMHARIC', [
        'ሰኞ', 'ማክሰኞ', 'ረቡዕ', 'ሐሙስ', 'ዓርብ', 'ቅዳሜ', 'እሁድ'
    ]);
}

if (!defined('ETHIOPIAN_WEEKDAYS_ENGLISH')) {
    define('ETHIOPIAN_WEEKDAYS_ENGLISH', [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
    ]);
}
?>