<?php
// login.php - Login page
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Check if there's an error message
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MERQ Performance Evaluation System</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #ff6b6b;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .login-header img {
            height: 60px;
            margin-bottom: 15px;
        }

        .login-header h1 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 600;
        }

        .login-header p {
            opacity: 0.8;
            margin: 5px 0 0;
            font-size: 0.9rem;
        }

        .login-form {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            padding: 12px 15px 12px 45px;
            border-radius: 8px;
            border: 2px solid #e1e5eb;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 102, 0.25);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8a8a8a;
        }

        .btn-login {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #00264d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.3);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border-radius: 8px;
            padding: 10px 15px;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8a8a8a;
        }

        @media (max-width: 576px) {
            .login-container {
                border-radius: 10px;
            }

            .login-header {
                padding: 20px 15px;
            }

            .login-form {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <img src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" alt="MERQ Consultancy">
            <h1>Performance Evaluation</h1>
            <p>Administrator Access Portal</p>
        </div>

        <form class="login-form" action="auth.php" method="POST">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" class="form-control" id="username" name="username" placeholder="Email Address" required autofocus>
            </div>

            <div class="form-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <span class="password-toggle" id="passwordToggle">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
        </form>

        <div class="login-footer">
            <p>&copy; <?php echo date('Y'); ?> MERQ Consultancy. All rights reserved.</p>
            <p class="small">For authorized personnel only. Unauthorized access prohibited.</p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('passwordToggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Focus on email field when page loads
        document.getElementById('username').focus();
    </script>
</body>

</html>