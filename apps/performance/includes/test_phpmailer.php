<?php
// test_phpmailer.php - Test PHPMailer installation
require_once 'config.php';

echo "<h1>PHPMailer Test</h1>";

// Test PHPMailer paths
echo "<h2>PHPMailer Paths</h2>";

$paths = [
    __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php',
    __DIR__ . '/../../../includes/vendor/phpmailer/phpmailer/src/PHPMailer.php',
    'D:/Installed_Apps/wamp64/www/merqapp/apps/performance/includes/vendor/phpmailer/phpmailer/src/PHPMailer.php',
];

$phpmailerFound = false;
foreach ($paths as $path) {
    if (file_exists($path)) {
        echo "<p style='color: green;'>✓ PHPMailer found at: " . htmlspecialchars($path) . "</p>";
        
        // Try to load it
        try {
            require_once $path;
            require_once dirname($path) . '/SMTP.php';
            require_once dirname($path) . '/Exception.php';
            
            if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                echo "<p style='color: green;'>✓ PHPMailer classes loaded successfully</p>";
                
                // Test creating PHPMailer instance
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                echo "<p style='color: green;'>✓ PHPMailer instance created successfully</p>";
                
                // Test SMTP settings
                $mail->isSMTP();
                $mail->Host = 'cloud.merqconsultancy.org';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'internal@cloud.merqconsultancy.org';
                $mail->Password = 'internal@merq';
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                
                echo "<p style='color: green;'>✓ SMTP settings configured</p>";
                $phpmailerFound = true;
                break;
            } else {
                echo "<p style='color: red;'>✗ PHPMailer classes not found after loading</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Error loading PHPMailer: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠ PHPMailer not found at: " . htmlspecialchars($path) . "</p>";
    }
}

if (!$phpmailerFound) {
    echo "<p style='color: red;'>✗ PHPMailer not found in any of the expected locations</p>";
    echo "<p>Please download PHPMailer from: <a href='https://github.com/PHPMailer/PHPMailer' target='_blank'>https://github.com/PHPMailer/PHPMailer</a></p>";
    echo "<p>And extract it to: apps/performance/includes/vendor/phpmailer/</p>";
}

// Test EmailSender
echo "<h2>EmailSender Test</h2>";

try {
    require_once 'EmailSender.php';
    $emailSender = new EmailSender();
    $configStatus = $emailSender->getConfigStatus();
    
    echo "<table border='1' cellpadding='5'>";
    foreach ($configStatus as $key => $value) {
        echo "<tr>";
        echo "<td><strong>" . htmlspecialchars($key) . "</strong></td>";
        echo "<td>";
        if (is_bool($value)) {
            echo $value ? "<span style='color: green;'>✓ True</span>" : "<span style='color: red;'>✗ False</span>";
        } else {
            echo htmlspecialchars($value);
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Test sending
    echo "<h3>Send Test Email</h3>";
    echo "<form method='POST'>";
    echo "<input type='email' name='test_email' placeholder='test@example.com' required>";
    echo "<input type='submit' name='send_test' value='Send Test'>";
    echo "</form>";
    
    if (isset($_POST['send_test']) && !empty($_POST['test_email'])) {
        $testEmail = $_POST['test_email'];
        if (filter_var($testEmail, FILTER_VALIDATE_EMAIL)) {
            $result = $emailSender->testEmailConfig($testEmail);
            
            echo "<h4>Test Result:</h4>";
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            
            if ($result['success']) {
                echo "<p style='color: green;'>✓ Test email sent successfully via {$result['method']}</p>";
            } else {
                echo "<p style='color: red;'>✗ Failed to send test email: {$result['message']}</p>";
            }
        } else {
            echo "<p style='color: red;'>✗ Invalid email address</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>