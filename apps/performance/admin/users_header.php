<?php
// Include session configuration to ensure consistent session settings across the application
//require_once __DIR__ . '/../../timesheet/includes/session-config.php';

// Now the session is already started with the correct settings, no need to call session_start() here

if (!headers_sent()) {
    ob_start(); // Start output buffering if headers are not sent
}
?>
<?php
require_once __DIR__ . '/../../timesheet/config/config.php';

// Initialize calendar preference
$ethiopianCalendar = $_SESSION['ethiopian_calendar'] ?? false;

// Initialize language switcher variables
$translation = new Translation();
$languages = [
    'en' => 'English',
    'am' => 'አማርኛ'
];
$currentLanguage = $_SESSION['language'] ?? 'en';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - <?= $pageTitle ?? 'Employees Management' ?></title>

    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="icon" type="image/png" href="/assets/images/icon-192.png">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Ethiopic&display=swap" rel="stylesheet">
    <script src="../assets/js/script.js"></script>
    <style>
        .ethiopian-text {
            font-family: 'Noto Sans Ethiopic', sans-serif;
        }

        .icon-shape {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
    </style>
    <style>
        /* Header and Sidebar Specific Styles Only */
        .sys-header {
            background-color: #072247D4;
            height: 70px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
        }

        .sys-sidebar-expanded .sys-header {
            left: 250px;
        }

        .sys-sidebar-collapsed .sys-header {
            left: 70px;
        }

        @media (max-width: 768px) {

            .sys-sidebar-expanded .sys-header,
            .sys-sidebar-collapsed .sys-header {
                left: 0;
            }
        }

        .sys-logo-container {
            display: flex;
            align-items: center;
            padding: 0 15px;
            height: 70px;
        }

        .sys-logo {
            height: 40px;
            margin-right: 10px;
        }

        .sys-brand-text {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            white-space: nowrap;
        }

        .sys-nav-user-info {
            color: white;
            display: flex;
            align-items: center;
        }

        .sys-nav-user-info img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* Sidebar Styles */
        .sys-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: #072247;
            z-index: 1020;
            z-index: 1020;
            transition: all 0.3s ease;
            overflow-y: auto;
            padding-top: 70px;
        }

        .sys-sidebar-collapsed .sys-sidebar {
            width: 70px;
        }

        .sys-sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .sys-sidebar-menu li {
            margin-bottom: 5px;
            position: relative;
        }

        .sys-sidebar-menu a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            transition: all 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }

        .sys-sidebar-menu a:hover,
        .sys-sidebar-menu a.sys-active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid #20c997;
        }

        .sys-sidebar-menu i {
            margin-right: 15px;
            font-size: 1.1rem;
            min-width: 25px;
            text-align: center;
        }

        .sys-sidebar-collapsed .sys-sidebar-menu span {
            display: none;
        }

        .sys-sidebar-collapsed .sys-sidebar-menu i {
            margin-right: 0;
        }

        .sys-sidebar-header {
            color: rgba(255, 255, 255, 0.6);
            padding: 15px 15px 5px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            overflow: hidden;
        }

        .sys-sidebar-collapsed .sys-sidebar-header {
            display: none;
        }


        /* Development Badges */
        .dev-badge {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.65rem;
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: 600;
        }

        .dev-badge-in-development {
            background-color: #fd7e14;
            color: white;
        }

        .dev-badge-coming-soon {
            background-color: #6f42c1;
            color: white;
        }

        .sys-sidebar-collapsed .dev-badge {
            display: none;
        }


        /* Main Content Area */
        .sys-main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 70px);
            padding-top: 20px;
        }

        .sys-sidebar-collapsed .sys-main-content {
            margin-left: 70px;
        }

        @media (max-width: 768px) {
            .sys-sidebar {
                transform: translateX(-100%);
                width: 250px;
            }

            .sys-sidebar-expanded .sys-sidebar {
                transform: translateX(0);
            }

            .sys-main-content {
                margin-left: 0 !important;
            }
        }

        /* Toggle Button */
        .sys-sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0 15px;
        }

        /* Mobile overlay */
        .sys-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1010;
            display: none;
        }

        .sys-sidebar-expanded .sys-sidebar-overlay {
            display: block;
        }

        @media (min-width: 769px) {
            .sys-sidebar-overlay {
                display: none !important;
            }
        }
    </style>
    <?php if ($ethiopianCalendar): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/calendar.css">
        <script src="<?= BASE_URL ?>/assets/js/calendar.js"></script>
        <script>
            // Complete conversion functions as shown above
            /*
                        function convertToEthiopian(dateStr) {
                            const date = new Date(dateStr);
                            const ec = new EthiopianCalendar(date);
                            return {
                                date: ec.GetECDate('Y-m-d'),
                                year: ec.EC_year,
                                month: ec.EC_month,
                                day: ec.EC_day
                            };
                        }

                        function convertToGregorian(ethDateStr) {
                            const parts = ethDateStr.split('-');
                            const ecYear = parseInt(parts[0]);
                            const ecMonth = parseInt(parts[1]);
                            const ecDay = parseInt(parts[2]);

                            const ec = new EthiopianCalendar(new Date());
                            const gcDate = ec.ethiopianToGregorian(ecYear, ecMonth, ecDay);

                            // Format as YYYY-MM-DD
                            const gcDateStr = `${gcDate.year}-${gcDate.month.toString().padStart(2, '0')}-${gcDate.day.toString().padStart(2, '0')}`;
                            return {
                                date: gcDateStr,
                                year: gcDate.year,
                                month: gcDate.month,
                                day: gcDate.day
                            };
                        }

                        */
            // Helper function to update all date displays on the page
            function updateDateDisplays() {
                document.querySelectorAll('[data-date]').forEach(element => {
                    const dateStr = element.getAttribute('data-date');
                    if (document.body.classList.contains('ethiopian-calendar')) {
                        const ethDate = convertToEthiopian(dateStr);
                        element.textContent = ethDate.date;
                        element.classList.add('ethiopian-text');
                    } else {
                        // For Gregorian, just display as-is
                        element.textContent = dateStr;
                        element.classList.remove('ethiopian-text');
                    }
                });
            }

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateDateDisplays();

                // Update when calendar switch is toggled
                const calendarSwitch = document.getElementById('calendarSwitch');
                if (calendarSwitch) {
                    calendarSwitch.addEventListener('change', function() {
                        updateDateDisplays();
                    });
                }
            });

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateDateDisplays();

                // Update when calendar switch is toggled
                const calendarSwitch = document.getElementById('calendarSwitch');
                if (calendarSwitch) {
                    calendarSwitch.addEventListener('change', function() {
                        if (this.checked) {
                            document.body.classList.add('ethiopian-calendar');
                        } else {
                            document.body.classList.remove('ethiopian-calendar');
                        }
                        updateDateDisplays();
                    });
                }
            });
        </script>
    <?php endif; ?>
</head>

<!-- Sidebar -->
<aside class="sys-sidebar">
    <ul class="sys-sidebar-menu">
        <li class="sys-sidebar-header">Main Navigation</li>
        <li>
            <a href="dashboard.php" class="<?= $currentPage == 'dashboard.php' ? 'sys-active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="report.php" class="<?= $currentPage == 'report.php' ? 'sys-active' : '' ?>">
                <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
            </a>
        </li>
        <li class="sys-sidebar-header">Management</li>
        <li>
            <a href="employee_report.php" class="<?= $currentPage == 'employee_report.php' ? 'sys-active' : '' ?>">
                <i class="fas fa-users"></i>
                <span>Employee Reports</span>
            </a>
        </li>
        <li>
            <a href="export.php" class="<?= $currentPage == 'export.php' ? 'sys-active' : '' ?>">
                <i class="fas fa-file-export"></i>
                <span>Data Export</span>
            </a>
        </li>
        <li>
            <a href="employee_management.php" class="<?= $currentPage == 'employee_management.php' ? 'sys-active' : '' ?>">
                <i class="fas fa-user-cog"></i>
                <span>Employees Management</span>
                <span class="dev-badge dev-badge-coming-soon">Coming Soon</span>
            </a>
        </li>
        <li class="sys-sidebar-header">Account</li>
        <li>
            <a href="#">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
                <span class="dev-badge dev-badge-in-development">In Development</span>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
        <hr>
        <li>
            <a href="../index.php"> <i class="fas fa-pen-alt"></i>

                <span>Go to Evaluation</span>

            </a>
        </li>
    </ul>
</aside>



<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>">
                <i class="bi bi-calendar-check"></i>
                <span class="d-none d-sm-inline"><?= APP_NAME ?></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="bi bi-house"></i> <span class="d-none d-md-inline"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/pages/dashboard.php">
                                <i class="bi bi-speedometer2"></i> <span class="d-none d-md-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/pages/timesheet.php">
                                <i class="bi bi-journal-text"></i> <span class="d-none d-md-inline">Timesheet</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/pages/leave.php">
                                <i class="bi bi-person-walking"></i> <span class="d-none d-md-inline">Leave Request</span>
                            </a>
                        </li>

                        <?php if (hasRole('admin', 'manager')): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear"></i> <span class="d-none d-md-inline">Admin</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                    <?php if (hasRole('admin')): ?>
                                        <li>Admin Management
                                            <hr class="dropdown-divider">
                                            Reports & Projects
                                        </li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/projects.php"><i class="bi bi-folder"></i> Projects</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/leave-management.php"><i class="bi bi-person-walking"></i>Leave Management</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/reports.php"><i class="bi bi-graph-up"></i>Timesheet Reports</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                            System Management
                                        </li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/users.php"><i class="bi bi-people"></i> Users</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/roles.php"><i class="bi bi-key"></i> Roles</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/permissions.php"><i class="bi bi-check"></i>Permissions</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/settings.php"><i class="bi bi-sliders"></i> System Settings</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                            Administrations
                                        </li>
                                    <?php endif; ?>

                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/admin/"><i class="bi bi-speedometer2"></i> Admin Dashboard</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Language Switcher - made more compact -->
                        <!-- Remove this entire language switcher section from header.php -->
                        <!-- <li class="nav-item me-2">
    <div class="language-switcher">
        <form method="post" action="<?= BASE_URL ?>/process/language-process.php" class="d-flex">
            <select name="language" class="form-select form-select-sm" onchange="this.form.submit()">
                <?php foreach ($languages as $code => $name): ?>
                    <option value="<?= $code ?>" <?= $currentLanguage === $code ? 'selected' : '' ?>>
                        <?= strtoupper($code) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI'] ?>">
        </form>
    </div>
</li> -->

                        <!-- Calendar Switcher - made more compact -->
                        <li class="nav-item me-2">
                            <div class="calendar-switcher">
                                <form method="post" action="<?= BASE_URL ?>/process/calendar-process.php" class="d-flex align-items-center">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" id="calendarSwitch"
                                            name="ethiopian_calendar" value="1"
                                            <?= $ethiopianCalendar ? 'checked' : '' ?> onchange="this.form.submit()">
                                        <label class="form-check-label text-white" for="calendarSwitch">
                                            <img src="<?= BASE_URL ?>/assets/images/ethcal.png" alt="Ethiopian Calendar" style="height: 20px;">
                                        </label>

                                    </div>
                                    <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                </form>
                            </div>
                        </li>

                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>

                                <span class="d-none d-lg-inline"><?= e($user['first_name'] . ' ' . $user['last_name']) ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/profile.php"><i class="bi bi-person"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/change-password.php"><i class="bi bi-key"></i> Change Password</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/pages/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/pages/login.php">
                                <i class="bi bi-box-arrow-in-right"></i> <span class="d-none d-md-inline">Login</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/pages/register.php">
                                <i class="bi bi-person-plus"></i> <span class="d-none d-md-inline">Register</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-3 px-lg-4 py-3">
        <?php displayFlashMessages();

        ?>
    </div>
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

    </script>

                    -->