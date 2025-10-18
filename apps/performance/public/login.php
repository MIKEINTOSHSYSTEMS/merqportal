<?php
// login.php - Enhanced Login page with SweetAlert
session_start();

// Update the redirect logic in login.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
        header('Location: admin_dashboard.php');
    } else {
        header('Location: dashboard.php');
    }
    exit;
}

// Check if there's an error message
$error = '';
$errorType = '';
$attemptedUsername = '';

if (isset($_SESSION['error'])) {
    $errorType = $_SESSION['error'];
    $attemptedUsername = $_SESSION['attempted_username'] ?? '';

    switch ($errorType) {
        case 'invalid_username':
            $error = 'The email or username you entered was not found.';
            break;
        case 'invalid_password':
            $error = 'The password you entered is incorrect.';
            break;
        default:
            $error = $_SESSION['error'];
    }

    unset($_SESSION['error']);
    unset($_SESSION['attempted_username']);
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
    <link href="../css/main.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #ff6b6b;
            --warning-color: #ffc107;
            --success-color: #198754;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            position: relative;
            animation: fadeInUp 0.6s ease-out;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: float 6s ease-in-out infinite;
        }

        .login-header img {
            height: 70px;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .login-header h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .login-header p {
            opacity: 0.9;
            margin: 10px 0 0;
            font-size: 1rem;
            font-weight: 300;
        }

        .login-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            padding: 15px 20px 15px 50px;
            border-radius: 12px;
            border: 2px solid #e1e5eb;
            transition: all 0.3s;
            font-size: 16px;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 102, 0.15);
            background: white;
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #8a8a8a;
            font-size: 18px;
            transition: all 0.3s;
        }

        .form-control:focus+.input-icon {
            color: var(--primary-color);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 51, 102, 0.3);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .login-footer {
            text-align: center;
            padding: 25px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8a8a8a;
            font-size: 18px;
            transition: all 0.3s;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .support-link {
            text-align: center;
            margin-top: 20px;
        }

        .support-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .support-link a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .input-error {
            border-color: var(--accent-color) !important;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 576px) {
            .login-container {
                border-radius: 15px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-form {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <img src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" alt="MERQ Consultancy">
            <h1>Performance Evaluation</h1>
            <p>Employee Access Portal</p>
        </div>

        <form class="login-form" action="../includes/auth.php" method="POST" id="loginForm">
            <div class="form-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Email Address or Username" required autofocus
                    value="<?= htmlspecialchars($attemptedUsername) ?>">
            </div>

            <div class="form-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Password" required>
                <span class="password-toggle" id="passwordToggle">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn btn-login" id="loginButton">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>

            <div class="support-link">
                <a href="support.php" target="_blank">
                    <i class="fas fa-life-ring me-1"></i>Need Help? Contact Support
                </a>
            </div>
        </form>

        <div class="login-footer">
            <p>&copy; <?php echo date('Y'); ?> MERQ Consultancy. All rights reserved.</p>
            <p class="small">For authorized personnel only. Unauthorized access prohibited.</p>
        </div>
    </div>

    <script>
        // Show SweetAlert for login errors
        <?php if (!empty($error)): ?>
            document.addEventListener('DOMContentLoaded', function() {
                const errorType = '<?= $errorType ?>';
                const errorMessage = '<?= $error ?>';
                const attemptedUsername = '<?= $attemptedUsername ?>';

                let icon = 'error';
                let title = 'Login Failed';
                let html = errorMessage;

                // Add specific guidance based on error type
                if (errorType === 'invalid_username') {
                    icon = 'warning';
                    title = 'Account Not Found';
                    html = `
                    <div class="text-start">
                        <p>${errorMessage}</p>
                        <div class="mt-3 p-3 bg-light rounded">
                            <h6 class="mb-2"><i class="fas fa-lightbulb me-2"></i>What to check:</h6>
                            <ul class="small mb-0">
                                <li>Ensure you're using your MERQ email address</li>
                                <li>Check for typos in your email/username</li>
                                <li>Contact IT support if you believe this is an error</li>
                            </ul>
                        </div>
                    </div>
                `;

                    // Highlight username field
                    document.getElementById('username').classList.add('input-error');

                } else if (errorType === 'invalid_password') {
                    icon = 'error';
                    title = 'Incorrect Password';
                    html = `
                    <div class="text-start">
                        <p>${errorMessage}</p>
                        <div class="mt-3 p-3 bg-light rounded">
                            <h6 class="mb-2"><i class="fas fa-lightbulb me-2"></i>What to try:</h6>
                            <ul class="small mb-0">
                                <li>Check your CAPS LOCK key</li>
                                <li>Make sure you're using the correct password</li>
                                <li>Use the "Forgot Password" option if available</li>
                                <li>Contact your administrator to reset your password</li>
                            </ul>
                        </div>
                    </div>
                `;

                    // Highlight password field
                    document.getElementById('password').classList.add('input-error');
                    document.getElementById('password').focus();
                }

                Swal.fire({
                    icon: icon,
                    title: title,
                    html: html,
                    confirmButtonColor: '#003366',
                    confirmButtonText: 'Try Again',
                    showCloseButton: true,
                    customClass: {
                        popup: 'animated fadeIn'
                    }
                }).then((result) => {
                    // Focus on the appropriate field after alert is closed
                    if (errorType === 'invalid_username') {
                        document.getElementById('username').focus();
                    } else if (errorType === 'invalid_password') {
                        document.getElementById('password').focus();
                    }
                });
            });
        <?php endif; ?>

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

        // Form submission loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('loginButton');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
            submitBtn.disabled = true;

            // Re-enable after 5 seconds in case of network issues
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });

        // Remove error styling on input
        document.getElementById('username').addEventListener('input', function() {
            this.classList.remove('input-error');
        });

        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('input-error');
        });

        // Focus on username field when page loads
        document.getElementById('username').focus();
    </script>
</body>

</html>