<?php
// test_email.php - Test SwiftMailer installation
require_once 'config.php';
require_once 'EmailSender.php';

echo "<h1>Email System Test</h1>";

// Test SwiftMailer installation
echo "<h2>SwiftMailer Test</h2>";
$swiftPath = __DIR__ . '/vendor/swiftmailer/swiftmailer/lib/swift_required.php';
if (file_exists($swiftPath)) {
    echo "<p style='color: green;'>✓ SwiftMailer found at: $swiftPath</p>";
    
    // Test loading
    require_once $swiftPath;
    if (class_exists('Swift_Mailer')) {
        echo "<p style='color: green;'>✓ Swift_Mailer class loaded successfully</p>";
        echo "<p>SwiftMailer Version: " . (defined('SWIFT_VERSION') ? SWIFT_VERSION : 'Unknown') . "</p>";
    } else {
        echo "<p style='color: red;'>✗ Swift_Mailer class not found</p>";
    }
} else {
    echo "<p style='color: red;'>✗ SwiftMailer not found at: $swiftPath</p>";
    
    // Check alternative paths
    $altPaths = [
        __DIR__ . '/../../../includes/vendor/swiftmailer/swiftmailer/lib/swift_required.php',
        'C:\\wamp64\\www\\merqapp\\apps\\performance\\includes\\vendor\\swiftmailer\\swiftmailer\\lib\\swift_required.php'
    ];
    
    foreach ($altPaths as $path) {
        if (file_exists($path)) {
            echo "<p style='color: orange;'>⚠ Found at alternative path: $path</p>";
            break;
        }
    }
}

// Test EmailSender
echo "<h2>EmailSender Test</h2>";
try {
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
    echo "<p style='color: red;'>✗ Error creating EmailSender: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Test database settings
echo "<h2>Database Settings Test</h2>";
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        echo "<p style='color: red;'>✗ Database connection failed: " . htmlspecialchars($conn->connect_error) . "</p>";
    } else {
        echo "<p style='color: green;'>✓ Database connected successfully</p>";
        
        // Check settings table
        $sql = "SELECT COUNT(*) as count FROM evaluation_settings";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p>Settings in database: " . $row['count'] . "</p>";
            
            // Show SMTP settings
            $sql = "SELECT setting_name, setting_value FROM evaluation_settings WHERE setting_name LIKE 'smtp_%' OR setting_name LIKE 'from_%'";
            $result = $conn->query($sql);
            
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>Setting</th><th>Value</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['setting_name']) . "</td>";
                echo "<td>";
                if (strpos($row['setting_name'], 'password') !== false && !empty($row['setting_value'])) {
                    echo "••••••••";
                } else {
                    echo htmlspecialchars($row['setting_value'] ?: '(empty)');
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        $conn->close();
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>