<?php
// header.php - Responsive header with navigation
$currentPage = basename($_SERVER['PHP_SELF']);

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/session-config.php';
}

require_once 'auth_check.php'; // Add this line for authentication

// Get user data from session
$userName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User';
$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$avatarName = urlencode($userName);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Consultancy - Performance Evaluation System</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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
</head>

<body class="sys-sidebar-expanded">
    <!-- Mobile Overlay -->
    <div class="sys-sidebar-overlay" id="sysSidebarOverlay"></div>

    <!-- Header -->
    <header class="sys-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="sys-sidebar-toggle" id="sysSidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="sys-logo-container">
                        <img src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" alt="MERQ Consultancy" class="sys-logo">
                        <span class="sys-brand-text d-none d-md-block">Performance Evaluation System</span>
                    </div>
                </div>
                <div class="sys-nav-user-info">
                    <img src="https://ui-avatars.com/api/?name=<?= $avatarName ?>&background=random" alt="User">
                    <span class="d-none d-md-inline"><?= htmlspecialchars($userName) ?></span>
                </div>
            </div>
        </div>
    </header>

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
                <a href="employee_report.php" class="<?= $currentPage == 'employee_report.php' ? 'sys-active' : '' ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span>My Report</span>
                </a>
            </li>

            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <li class="sys-sidebar-header">Administration</li>
                <li>
                    <a href="report.php" class="<?= $currentPage == 'report.php' ? 'sys-active' : '' ?>">
                        <i class="fas fa-users"></i>
                        <span>All Reports</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="sys-sidebar-header">Account</li>
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

    <!-- Main Content -->
    <main class="sys-main-content">
        <div class="container-fluid">