<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../includes/ethiopian_date.php';

SessionManager::start();
$flashMessages = Utils::getFlashMessages();
$currentUser = SessionManager::getUser();
$currentEthDate = EthiopianDateConverter::getCurrentEthiopianDate();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'MERQ Timesheet System'; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/apps/ts/static/css/custom.css">

    <?php echo $extra_css ?? ''; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'partials/header.php'; ?>

    <?php include 'partials/flash_messages.php'; ?>

    <!-- Main Content -->
    <main class="container-fluid px-3 px-lg-4 my-4 flex-grow-1">
        <?php echo $content; ?>
    </main>

    <?php include 'partials/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php echo $extra_js ?? ''; ?>
</body>
</html>