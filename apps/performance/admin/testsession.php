<?php
// test-session.php

require_once __DIR__ . '/../../../includes/session-config.php';

// Write something to session (only once per visit)
if (!isset($_SESSION['test_counter'])) {
    $_SESSION['test_counter'] = 1;
    $_SESSION['test_message'] = "Hello, your session is stored in tblsessions ✅";
} else {
    $_SESSION['test_counter']++;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Session Test</title>
</head>

<body>
    <h2>PHP Session Test</h2>
    <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
    <p><strong>Test Counter:</strong> <?php echo $_SESSION['test_counter']; ?></p>
    <p><strong>Test Message:</strong> <?php echo htmlspecialchars($_SESSION['test_message']); ?></p>

    <p>Refresh this page multiple times — the counter should increase.
        Then check your <code>tblsessions</code> table: you should see the <code>data</code> BLOB growing as PHP updates the session.</p>
</body>

</html>