<?php
require_once 'includes/session-config.php';

// Now you can use session functions
if (is_logged_in()) {
    $user = get_current_user_full_details();

    echo "<h1>Welcome!</h1>";
    echo "<h2>Session Data:</h2>";
    echo "<pre>";
    print_r($user);
    echo "</pre>";

    echo "<h2>All Session Variables:</h2>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    echo "<h2>User Details:</h2>";
    if ($user) {
        echo "<p><strong>User ID:</strong> " . ($user['user_id'] ?? 'N/A') . "</p>";
        echo "<p><strong>Username:</strong> " . ($user['username'] ?? 'N/A') . "</p>";
        echo "<p><strong>Email:</strong> " . ($user['email'] ?? 'N/A') . "</p>";
        echo "<p><strong>First Name:</strong> " . ($user['firstname'] ?? 'N/A') . "</p>";
        echo "<p><strong>Last Name:</strong> " . ($user['lastname'] ?? 'N/A') . "</p>";
        echo "<p><strong>User Type:</strong> " . ($user['user_type'] ?? 'N/A') . "</p>";

        // Display additional staff details if available
        if (isset($user['staffid'])) {
            echo "<p><strong>Staff ID:</strong> " . $user['staffid'] . "</p>";
            echo "<p><strong>Phone:</strong> " . ($user['phonenumber'] ?? 'N/A') . "</p>";
            echo "<p><strong>Role:</strong> " . ($user['role'] ?? 'N/A') . "</p>";
        }
    }
} else {
    echo "<h2>Not logged in</h2>";
    echo "<p>Please log in through the CodeIgniter application first.</p>";
}
