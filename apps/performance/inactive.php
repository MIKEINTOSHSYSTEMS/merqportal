<?php
// inactive.php
require_once 'admin/config.php';

$settingsManager = new SettingsManager(new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME));
$settings = $settingsManager->getAllSettings();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Unavailable - MERQ Consultancy</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #072247 0%, #2c3e50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .status-icon {
            font-size: 4rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }


        h1 {
            font-size: 2.5em;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .highlight {
            color: #FFB300FF;
            font-weight: bold;
            animation: glow 2s ease-in-out infinite alternate;
        }

        .emoji {
            font-size: 4em;
            display: block;
            animation: bounce 2s infinite;
        }

        .clock {
            font-size: 3em;
            margin-top: 15px;
            animation: rotate 4s linear infinite;
            display: inline-block;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                color: #ffdddd;
            }

            50% {
                color: #ff6b6b;
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #ffd369, 0 0 10px #ffd369;
            }

            to {
                text-shadow: 0 0 15px #ffeb99, 0 0 25px #ffd369;
            }
        }

        footer {
            margin-top: 20px;
            font-size: 0.9em;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <span class="clock"><img src="/assets/images/merq-logo.png" width="47px"></img></span>
                        <div class="status-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h2 class="card-title text-danger">Evaluation Unavailable</h2>
                        <span class="emoji">😢</span>
                        <p class="card-text lead">
                            The performance evaluation system is currently unavailable.
                        </p>

                        <?php if ($settings['evaluation_start_date']['value'] && strtotime($settings['evaluation_start_date']['value']) > time()): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-clock me-2"></i>
                                The evaluation period will begin on:<br>
                                <strong><?= date('F j, Y g:i A', strtotime($settings['evaluation_start_date']['value'])) ?></strong>
                            </div>
                        <?php elseif ($settings['evaluation_end_date']['value'] && strtotime($settings['evaluation_end_date']['value']) < time()): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-calendar-check me-2"></i>
                                The evaluation period ended on:<br>
                                <strong><?= date('F j, Y g:i A', strtotime($settings['evaluation_end_date']['value'])) ?></strong>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-secondary">
                                <i class="fas fa-info-circle me-2"></i>
                                The evaluation system is temporarily disabled.
                            </div>
                        <?php endif; ?>

                        <p class="highlight">💡 You will still be getting evaluation feedback and comments from your CEO.</p>

                        <div class="mt-4">
                            <a href="/apps/performance/public/" target="_blank" class="btn btn-primary me-2">
                                <i class="fas fa-home me-1"></i> Return to Home
                            </a>
                            <!--
                            <a href="admin/dashboard.php" class="btn btn-outline-secondary">
                                <i class="fas fa-tachometer-alt me-1"></i> Admin Dashboard
                            </a>
                        -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>