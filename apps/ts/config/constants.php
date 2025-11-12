<?php
// MERQ Timesheet System Constants
define('APP_NAME', 'MERQ Timesheet System');
define('APP_VERSION', '1.0.0.0');
define('APP_AUTHOR', 'Michael Kifle Teferra');
define('APP_YEAR', '2025');

// Session Configuration
define('SESSION_TIMEOUT', 24 * 60 * 60); // 24 hours

// Path Constants
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']));
define('UPLOAD_PATH', __DIR__ . '/../uploads/');

// Ethiopian Date Constants
define('ETHIOPIAN_MONTHS_AMHARIC', [
    'መስከረም', 'ጥቅምት', 'ኅዳር', 'ታኅሣሥ', 
    'ጥር', 'የካቲት', 'መጋቢት', 'ሚያዝያ', 
    'ግንቦት', 'ሰኔ', 'ሐምሌ', 'ነሐሴ', 'ጳጉሜ'
]);

define('ETHIOPIAN_MONTHS_ENGLISH', [
    'Meskerem', 'Tikimt', 'Hidar', 'Tahsas',
    'Tir', 'Yekatit', 'Megabit', 'Miyazya',
    'Ginbot', 'Sene', 'Hamle', 'Nehase', 'Pagume'
]);

define('ETHIOPIAN_WEEKDAYS_AMHARIC', [
    'ሰኞ', 'ማክሰኞ', 'ረቡዕ', 'ሐሙስ', 'ዓርብ', 'ቅዳሜ', 'እሁድ'
]);

define('ETHIOPIAN_WEEKDAYS_ENGLISH', [
    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
]);
?>