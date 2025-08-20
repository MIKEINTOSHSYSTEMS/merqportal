<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Redirect to dashboard if already logged in
redirectIfLoggedIn();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && verifyPassword($password, $user['password_hash'])) {
            // After successful login
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['last_login'] = time();

            // Update last login in database
            $pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?")->execute([$user['user_id']]);

            // Redirect to intended page or dashboard
            $redirect = $_SESSION['redirect_url'] ?? '/admin/dashboard.php';
            unset($_SESSION['redirect_url']);
            header("Location: $redirect");
            exit;
        } else {
            $error = 'Invalid email or password';
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $error = 'A system error occurred. Please try again later.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Portal - Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2a4365;
            --primary-light: #3c5a82;
            --accent-color: #4299e1;
            --text-color: #2d3748;
            --text-light: #718096;
            --bg-color: #f7fafc;
            --card-bg: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            text-align: center;
        }

        .login-logo {
            margin-bottom: 2rem;
        }

        .login-logo img {
            height: 60px;
        }

        .login-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: var(--primary-light);
        }

        .error-message {
            color: #e53e3e;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .login-footer {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-light);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="../assets/images/merq-logo.png" alt="MERQ Consultancy Logo">
        </div>
        <h1 class="login-title">Admin Portal Login</h1>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <!--
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required autofocus>
            </div>

        -->

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="login-footer">
            <p>For authorized administrators only</p>
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>