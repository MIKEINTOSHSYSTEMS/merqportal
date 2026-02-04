<?php
require_once 'EmailTemplates.php';
// check_phpmailer.php - Check if PHPMailer is installed correctly
echo "<h1>PHPMailer Installation Check</h1>";

$vendorDir = __DIR__ . '/vendor/phpmailer/phpmailer';
echo "<p>Checking directory: " . htmlspecialchars($vendorDir) . "</p>";

if (file_exists($vendorDir)) {
    echo "<p style='color: green;'>✓ PHPMailer directory exists</p>";
    
    // Check for required files
    $requiredFiles = [
        'src/PHPMailer.php',
        'src/SMTP.php',
        'src/Exception.php'
    ];
    
    $allFilesExist = true;
    foreach ($requiredFiles as $file) {
        $filePath = $vendorDir . '/' . $file;
        if (file_exists($filePath)) {
            echo "<p style='color: green;'>✓ " . htmlspecialchars($file) . " exists</p>";
        } else {
            echo "<p style='color: red;'>✗ " . htmlspecialchars($file) . " NOT found</p>";
            $allFilesExist = false;
        }
    }
    
    if ($allFilesExist) {
        echo "<p style='color: green;'>✓ All required PHPMailer files are present</p>";
        
        // Try to load PHPMailer
        try {
            require_once $vendorDir . '/src/PHPMailer.php';
            require_once $vendorDir . '/src/SMTP.php';
            require_once $vendorDir . '/src/Exception.php';
            
            if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                echo "<p style='color: green;'>✓ PHPMailer class loaded successfully</p>";
                
                // Test creating an instance
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                echo "<p style='color: green;'>✓ PHPMailer instance created successfully</p>";
                
                // Test SMTP configuration
                $mail->isSMTP();
                echo "<p style='color: green;'>✓ SMTP mode set successfully</p>";
                
                echo "<hr>";
                echo "<p style='color: green; font-weight: bold;'>✅ PHPMailer is installed correctly and ready to use!</p>";
                
            } else {
                echo "<p style='color: red;'>✗ PHPMailer class not found after loading</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Error loading PHPMailer: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Some PHPMailer files are missing</p>";
        echo "<p>Please ensure you have the complete PHPMailer installation. You can download it from: ";
        echo "<a href='https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip' target='_blank'>PHPMailer ZIP</a></p>";
        echo "<p>After downloading, extract the contents so that the directory structure looks like:</p>";
        echo "<pre>";
        echo "vendor/phpmailer/phpmailer/src/PHPMailer.php\n";
        echo "vendor/phpmailer/phpmailer/src/SMTP.php\n";
        echo "vendor/phpmailer/phpmailer/src/Exception.php\n";
        echo "</pre>";
    }
} else {
    echo "<p style='color: red;'>✗ PHPMailer directory not found</p>";
    echo "<p>To install PHPMailer:</p>";
    echo "<ol>";
    echo "<li>Download PHPMailer from: <a href='https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip' target='_blank'>https://github.com/PHPMailer/PHPMailer</a></li>";
    echo "<li>Extract the ZIP file</li>";
    echo "<li>Copy the 'phpmailer' folder to: " . htmlspecialchars(__DIR__ . '/vendor/') . "</li>";
    echo "</ol>";
    echo "<p>The final path should be: " . htmlspecialchars(__DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php') . "</p>";
}

// Test EmailSender
echo "<h2>EmailSender Test</h2>";
try {
    require_once 'EmailSender.php';
    $emailSender = new EmailSender();
    
    echo "<p>EmailSender class loaded successfully</p>";
    
    // Test PHPMailer loading
    $phpmailerLoaded = $emailSender->loadPHPMailer();
    if ($phpmailerLoaded) {
        echo "<p style='color: green;'>✓ PHPMailer loaded via EmailSender</p>";
    } else {
        echo "<p style='color: red;'>✗ PHPMailer NOT loaded via EmailSender</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error loading EmailSender: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>