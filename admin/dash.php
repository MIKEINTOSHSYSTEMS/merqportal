<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireAuth();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = 'Invalid CSRF token';
        header('Location: dashboard.php');
        exit;
    }

    // Handle different actions
    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                // App Cards CRUD
                case 'add_app_card':
                    $stmt = $pdo->prepare("INSERT INTO app_cards (title, description, url, icon_class, icon_color, is_active, badge_text, sort_order) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        sanitizeInput($_POST['title']),
                        sanitizeInput($_POST['description']),
                        sanitizeInput($_POST['url']),
                        sanitizeInput($_POST['icon_class']),
                        sanitizeInput($_POST['icon_color']),
                        isset($_POST['is_active']) ? 1 : 0,
                        sanitizeInput($_POST['badge_text']),
                        (int)$_POST['sort_order']
                    ]);
                    $_SESSION['success'] = 'Application card added successfully';
                    break;

                case 'update_app_card':
                    $stmt = $pdo->prepare("UPDATE app_cards SET 
                                          title = ?, description = ?, url = ?, icon_class = ?, icon_color = ?, 
                                          is_active = ?, badge_text = ?, sort_order = ? 
                                          WHERE id = ?");
                    $stmt->execute([
                        sanitizeInput($_POST['title']),
                        sanitizeInput($_POST['description']),
                        sanitizeInput($_POST['url']),
                        sanitizeInput($_POST['icon_class']),
                        sanitizeInput($_POST['icon_color']),
                        isset($_POST['is_active']) ? 1 : 0,
                        sanitizeInput($_POST['badge_text']),
                        (int)$_POST['sort_order'],
                        (int)$_POST['id']
                    ]);
                    $_SESSION['success'] = 'Application card updated successfully';
                    break;

                case 'delete_app_card':
                    $stmt = $pdo->prepare("DELETE FROM app_cards WHERE id = ?");
                    $stmt->execute([(int)$_POST['id']]);
                    $_SESSION['success'] = 'Application card deleted successfully';
                    break;

                // Announcements CRUD
                case 'add_announcement':
                    $stmt = $pdo->prepare("INSERT INTO announcements (title, content, is_active, start_date, end_date, sort_order) 
                                          VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        sanitizeInput($_POST['title']),
                        sanitizeInput($_POST['content']),
                        isset($_POST['is_active']) ? 1 : 0,
                        $_POST['start_date'] ?: NULL,
                        $_POST['end_date'] ?: NULL,
                        (int)$_POST['sort_order']
                    ]);
                    $_SESSION['success'] = 'Announcement added successfully';
                    break;

                case 'update_announcement':
                    $stmt = $pdo->prepare("UPDATE announcements SET 
                                          title = ?, content = ?, is_active = ?, start_date = ?, end_date = ?, sort_order = ? 
                                          WHERE id = ?");
                    $stmt->execute([
                        sanitizeInput($_POST['title']),
                        sanitizeInput($_POST['content']),
                        isset($_POST['is_active']) ? 1 : 0,
                        $_POST['start_date'] ?: NULL,
                        $_POST['end_date'] ?: NULL,
                        (int)$_POST['sort_order'],
                        (int)$_POST['id']
                    ]);
                    $_SESSION['success'] = 'Announcement updated successfully';
                    break;

                case 'delete_announcement':
                    $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
                    $stmt->execute([(int)$_POST['id']]);
                    $_SESSION['success'] = 'Announcement deleted successfully';
                    break;

                // Notifications CRUD
                case 'add_notification':
                    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon_class, is_active) 
                                          VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([
                        NULL, // NULL means notification for all users
                        sanitizeInput($_POST['title']),
                        sanitizeInput($_POST['message']),
                        sanitizeInput($_POST['icon_class']),
                        isset($_POST['is_active']) ? 1 : 0
                    ]);
                    $_SESSION['success'] = 'Notification added successfully';
                    break;

                case 'update_notification':
                    $stmt = $pdo->prepare("UPDATE notifications SET 
                                          title = ?, message = ?, icon_class = ?, is_active = ? 
                                          WHERE id = ?");
                    $stmt->execute([
                        sanitizeInput($_POST['title']),
                        sanitizeInput($_POST['message']),
                        sanitizeInput($_POST['icon_class']),
                        isset($_POST['is_active']) ? 1 : 0,
                        (int)$_POST['id']
                    ]);
                    $_SESSION['success'] = 'Notification updated successfully';
                    break;

                case 'delete_notification':
                    $stmt = $pdo->prepare("DELETE FROM notifications WHERE id = ?");
                    $stmt->execute([(int)$_POST['id']]);
                    $_SESSION['success'] = 'Notification deleted successfully';
                    break;

                // User Management
                case 'add_user':
                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $_SESSION['error'] = 'Passwords do not match';
                        break;
                    }
                    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, full_name, email) 
                                          VALUES (?, ?, ?, ?)");
                    $stmt->execute([
                        sanitizeInput($_POST['username']),
                        createPasswordHash($_POST['password']),
                        sanitizeInput($_POST['full_name']),
                        sanitizeInput($_POST['email'])
                    ]);
                    $_SESSION['success'] = 'User added successfully';
                    break;

                case 'update_user':
                    $updateFields = [
                        'username' => sanitizeInput($_POST['username']),
                        'full_name' => sanitizeInput($_POST['full_name']),
                        'email' => sanitizeInput($_POST['email']),
                        'id' => (int)$_POST['id']
                    ];

                    $sql = "UPDATE users SET username = :username, full_name = :full_name, email = :email";

                    // Only update password if provided
                    if (!empty($_POST['password'])) {
                        if ($_POST['password'] !== $_POST['confirm_password']) {
                            $_SESSION['error'] = 'Passwords do not match';
                            break;
                        }
                        $sql .= ", password_hash = :password_hash";
                        $updateFields['password_hash'] = createPasswordHash($_POST['password']);
                    }

                    $sql .= " WHERE id = :id";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($updateFields);
                    $_SESSION['success'] = 'User updated successfully';
                    break;

                case 'delete_user':
                    // Prevent deleting current user
                    if ((int)$_POST['id'] === $_SESSION['user_id']) {
                        $_SESSION['error'] = 'You cannot delete your own account';
                        break;
                    }

                    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                    $stmt->execute([(int)$_POST['id']]);
                    $_SESSION['success'] = 'User deleted successfully';
                    break;
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        }

        header('Location: dashboard.php');
        exit;
    }
}

// Get data for display
$appCards = $pdo->query("SELECT * FROM app_cards ORDER BY sort_order")->fetchAll();
$announcements = $pdo->query("SELECT * FROM announcements ORDER BY sort_order")->fetchAll();
$notifications = $pdo->query("SELECT * FROM notifications ORDER BY created_at DESC")->fetchAll();
$users = $pdo->query("SELECT id, username, full_name, email, last_login FROM users ORDER BY username")->fetchAll();

// Common icon classes for selection
$iconClasses = [
    'fa-calendar-alt',
    'fa-chart-line',
    'fa-users',
    'fa-shopping-cart',
    'fa-money-bill-wave',
    'fa-laptop',
    'fa-address-book',
    'fa-bell',
    'fa-envelope',
    'fa-exclamation-circle',
    'fa-check-circle',
    'fa-times-circle',
    'fa-info-circle',
    'fa-cog',
    'fa-user-tie',
    'fa-file-alt'
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Portal - Admin Dashboard</title>
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
            --sidebar-bg: #2d3748;
            --sidebar-text: #e2e8f0;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --error-color: #f56565;
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
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding: 1.5rem 0;
            position: fixed;
            height: 100vh;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-header img {
            height: 40px;
            margin-bottom: 0.5rem;
        }

        .sidebar-header h3 {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            position: relative;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu i {
            width: 24px;
            margin-right: 0.75rem;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 1.75rem;
            color: var(--primary-color);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.75rem;
        }

        .user-name {
            font-weight: 500;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            margin-left: 1rem;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            color: var(--error-color);
        }

        /* Card Styles */
        .card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Table Styles */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: rgba(0, 0, 0, 0.05);
            font-weight: 500;
            color: var(--primary-color);
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Badge Styles */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: rgba(72, 187, 120, 0.2);
            color: var(--success-color);
        }

        .badge-warning {
            background-color: rgba(246, 173, 85, 0.2);
            color: var(--warning-color);
        }

        .badge-danger {
            background-color: rgba(245, 101, 101, 0.2);
            color: var(--error-color);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #38a169;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #e53e3e;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--text-color);
        }

        .btn-outline:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 0.5rem;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-dialog {
            width: 100%;
            max-width: 600px;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transform: translateY(-50px);
            transition: all 0.3s ease;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
        }

        .modal-header .close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background-color: rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        /* Alert Styles */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .alert i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        .alert-success {
            background-color: rgba(72, 187, 120, 0.2);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background-color: rgba(245, 101, 101, 0.2);
            color: var(--error-color);
            border-left: 4px solid var(--error-color);
        }

        /* Color Picker */
        .color-picker {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .color-option.selected {
            border-color: var(--text-color);
            transform: scale(1.1);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h3,
            .sidebar-menu span {
                display: none;
            }

            .sidebar-menu i {
                margin-right: 0;
                font-size: 1.25rem;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 1rem;
            }

            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                margin-bottom: 1.5rem;
            }

            .sidebar-menu {
                display: flex;
                overflow-x: auto;
            }

            .sidebar-menu li {
                flex: 0 0 auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="../assets/images/merq-logo-white.png" alt="MERQ Consultancy">
            <h3>Admin Portal</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#dashboard" class="active"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li><a href="#app-cards"><i class="fas fa-th"></i> <span>App Cards</span></a></li>
            <li><a href="#announcements"><i class="fas fa-bullhorn"></i> <span>Announcements</span></a></li>
            <li><a href="#notifications"><i class="fas fa-bell"></i> <span>Notifications</span></a></li>
            <li><a href="#users"><i class="fas fa-users"></i> <span>User Management</span></a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <img src="../assets/images/user-avatar.png" alt="User Avatar">
                <div class="user-name"><?= htmlspecialchars($_SESSION['full_name']) ?></div>
                <form action="../includes/logout.php" method="post" class="logout-form">
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Alerts -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Dashboard Overview -->
        <div id="dashboard">
            <div class="card">
                <div class="card-header">
                    <h2>System Overview</h2>
                </div>
                <div class="card-body">
                    <div class="quick-stats" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: rgba(66, 153, 225, 0.2); color: var(--accent-color);">
                                <i class="fas fa-th"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Active App Cards</h4>
                                <p><?= count(array_filter($appCards, fn($card) => $card['is_active'])) ?></p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: rgba(246, 173, 85, 0.2); color: var(--warning-color);">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Active Announcements</h4>
                                <p><?= count(array_filter($announcements, fn($ann) => $ann['is_active'])) ?></p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: rgba(237, 100, 166, 0.2); color: #ed64a6;">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Unread Notifications</h4>
                                <p><?= count(array_filter($notifications, fn($notif) => !$notif['is_read'])) ?></p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: rgba(72, 187, 120, 0.2); color: var(--success-color);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h4>System Users</h4>
                                <p><?= count($users) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Cards Section -->
        <div id="app-cards" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h2>Application Cards</h2>
                    <button class="btn btn-primary" onclick="showModal('addAppCard')">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Sort Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appCards as $card): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($card['title']) ?></td>
                                        <td><?= htmlspecialchars($card['description']) ?></td>
                                        <td><i class="fas <?= htmlspecialchars($card['icon_class']) ?>"></i></td>
                                        <td>
                                            <span class="badge <?= $card['is_active'] ? 'badge-success' : 'badge-warning' ?>">
                                                <?= $card['is_active'] ? 'Active' : 'Inactive' ?>
                                            </span>
                                        </td>
                                        <td><?= $card['sort_order'] ?></td>
                                        <td>
                                            <button class="btn btn-outline btn-sm" onclick="showModal('editAppCard', <?= $card['id'] ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="" method="POST" style="display: inline;">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action" value="delete_app_card">
                                                <input type="hidden" name="id" value="<?= $card['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this card?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Announcements Section -->
        <div id="announcements" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h2>Announcements</h2>
                    <button class="btn btn-primary" onclick="showModal('addAnnouncement')">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($announcements as $announcement): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($announcement['title']) ?></td>
                                        <td><?= strlen($announcement['content']) > 50 ? htmlspecialchars(substr($announcement['content'], 0, 50)) . '...' : htmlspecialchars($announcement['content']) ?></td>
                                        <td><?= $announcement['start_date'] ? formatDate($announcement['start_date']) : 'Immediate' ?></td>
                                        <td><?= $announcement['end_date'] ? formatDate($announcement['end_date']) : 'No end date' ?></td>
                                        <td>
                                            <span class="badge <?= $announcement['is_active'] ? 'badge-success' : 'badge-warning' ?>">
                                                <?= $announcement['is_active'] ? 'Active' : 'Inactive' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline btn-sm" onclick="showModal('editAnnouncement', <?= $announcement['id'] ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="" method="POST" style="display: inline;">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action" value="delete_announcement">
                                                <input type="hidden" name="id" value="<?= $announcement['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div id="notifications" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h2>Notifications</h2>
                    <button class="btn btn-primary" onclick="showModal('addNotification')">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notifications as $notification): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($notification['title']) ?></td>
                                        <td><?= strlen($notification['message']) > 50 ? htmlspecialchars(substr($notification['message'], 0, 50)) . '...' : htmlspecialchars($notification['message']) ?></td>
                                        <td><i class="fas <?= htmlspecialchars($notification['icon_class']) ?>"></i></td>
                                        <td>
                                            <span class="badge <?= $notification['is_active'] ? 'badge-success' : 'badge-warning' ?>">
                                                <?= $notification['is_active'] ? 'Active' : 'Inactive' ?>
                                            </span>
                                        </td>
                                        <td><?= formatDate($notification['created_at']) ?></td>
                                        <td>
                                            <button class="btn btn-outline btn-sm" onclick="showModal('editNotification', <?= $notification['id'] ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="" method="POST" style="display: inline;">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action" value="delete_notification">
                                                <input type="hidden" name="id" value="<?= $notification['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this notification?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Section -->
        <div id="users" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h2>User Management</h2>
                    <button class="btn btn-primary" onclick="showModal('addUser')">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['username']) ?></td>
                                        <td><?= htmlspecialchars($user['full_name']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= $user['last_login'] ? formatDateTime($user['last_login']) : 'Never' ?></td>
                                        <td>
                                            <button class="btn btn-outline btn-sm" onclick="showModal('editUser', <?= $user['id'] ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                    <input type="hidden" name="action" value="delete_user">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add App Card Modal -->
        <div class="modal" id="addAppCardModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_app_card">
                    <div class="modal-header">
                        <h3>Add Application Card</h3>
                        <button type="button" class="close" onclick="hideModal('addAppCard')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="appCardTitle">Title</label>
                            <input type="text" id="appCardTitle" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="appCardDescription">Description</label>
                            <textarea id="appCardDescription" name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appCardUrl">URL</label>
                            <input type="url" id="appCardUrl" name="url" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <select name="icon_class" class="form-control form-select" required>
                                <?php foreach ($iconClasses as $icon): ?>
                                    <option value="<?= $icon ?>"><?= $icon ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Icon Color</label>
                            <input type="color" name="icon_color" value="#4299e1" class="form-control" style="height: 40px; padding: 0.25rem;">
                        </div>
                        <div class="form-group">
                            <label for="appCardBadge">Badge Text (optional)</label>
                            <input type="text" id="appCardBadge" name="badge_text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="appCardSort">Sort Order</label>
                            <input type="number" id="appCardSort" name="sort_order" class="form-control" value="0">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="appCardActive" name="is_active" class="form-check-input" checked>
                            <label for="appCardActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('addAppCard')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit App Card Modal -->
        <div class="modal" id="editAppCardModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="update_app_card">
                    <input type="hidden" name="id" id="editAppCardId">
                    <div class="modal-header">
                        <h3>Edit Application Card</h3>
                        <button type="button" class="close" onclick="hideModal('editAppCard')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Content loaded via JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('editAppCard')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Announcement Modal -->
        <div class="modal" id="addAnnouncementModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_announcement">
                    <div class="modal-header">
                        <h3>Add Announcement</h3>
                        <button type="button" class="close" onclick="hideModal('addAnnouncement')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="announcementTitle">Title</label>
                            <input type="text" id="announcementTitle" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="announcementContent">Content</label>
                            <textarea id="announcementContent" name="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="announcementStartDate">Start Date</label>
                            <input type="datetime-local" id="announcementStartDate" name="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="announcementEndDate">End Date (optional)</label>
                            <input type="datetime-local" id="announcementEndDate" name="end_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="announcementSort">Sort Order</label>
                            <input type="number" id="announcementSort" name="sort_order" class="form-control" value="0">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="announcementActive" name="is_active" class="form-check-input" checked>
                            <label for="announcementActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('addAnnouncement')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Announcement Modal -->
        <div class="modal" id="editAnnouncementModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="update_announcement">
                    <input type="hidden" name="id" id="editAnnouncementId">
                    <div class="modal-header">
                        <h3>Edit Announcement</h3>
                        <button type="button" class="close" onclick="hideModal('editAnnouncement')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Content loaded via JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('editAnnouncement')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Notification Modal -->
        <div class="modal" id="addNotificationModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_notification">
                    <div class="modal-header">
                        <h3>Add Notification</h3>
                        <button type="button" class="close" onclick="hideModal('addNotification')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="notificationTitle">Title</label>
                            <input type="text" id="notificationTitle" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="notificationMessage">Message</label>
                            <textarea id="notificationMessage" name="message" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <select name="icon_class" class="form-control form-select" required>
                                <?php foreach ($iconClasses as $icon): ?>
                                    <option value="<?= $icon ?>"><?= $icon ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="notificationActive" name="is_active" class="form-check-input" checked>
                            <label for="notificationActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('addNotification')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Notification Modal -->
        <div class="modal" id="editNotificationModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="update_notification">
                    <input type="hidden" name="id" id="editNotificationId">
                    <div class="modal-header">
                        <h3>Edit Notification</h3>
                        <button type="button" class="close" onclick="hideModal('editNotification')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Content loaded via JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('editNotification')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal" id="addUserModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_user">
                    <div class="modal-header">
                        <h3>Add User</h3>
                        <button type="button" class="close" onclick="hideModal('addUser')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userUsername">Username</label>
                            <input type="text" id="userUsername" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userFullName">Full Name</label>
                            <input type="text" id="userFullName" name="full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" id="userEmail" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userPassword">Password</label>
                            <input type="password" id="userPassword" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userConfirmPassword">Confirm Password</label>
                            <input type="password" id="userConfirmPassword" name="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('addUser')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal" id="editUserModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="modal-header">
                        <h3>Edit User</h3>
                        <button type="button" class="close" onclick="hideModal('editUser')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Content loaded via JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('editUser')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Navigation between sections
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Hide all sections
                document.querySelectorAll('#dashboard, #app-cards, #announcements, #notifications, #users').forEach(section => {
                    section.style.display = 'none';
                });

                // Show selected section
                const sectionId = this.getAttribute('href').substring(1);
                document.getElementById(sectionId).style.display = 'block';

                // Update active link
                document.querySelectorAll('.sidebar-menu a').forEach(a => {
                    a.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Show the dashboard by default
        document.getElementById('dashboard').style.display = 'block';

        // Modal functions
        function showModal(modalType, id = null) {
            const modal = document.getElementById(`${modalType}Modal`);
            modal.classList.add('show');

            if (id && modalType.startsWith('edit')) {
                // Load data for edit modals
                fetch(`../includes/get-data.php?type=${modalType.replace('edit', '').toLowerCase()}&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const modalBody = modal.querySelector('.modal-body');

                        if (modalType === 'editAppCard') {
                            modalBody.innerHTML = `
                                <div class="form-group">
                                    <label for="editAppCardTitle">Title</label>
                                    <input type="text" id="editAppCardTitle" name="title" class="form-control" value="${escapeHtml(data.title)}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editAppCardDescription">Description</label>
                                    <textarea id="editAppCardDescription" name="description" class="form-control" rows="3" required>${escapeHtml(data.description)}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="editAppCardUrl">URL</label>
                                    <input type="url" id="editAppCardUrl" name="url" class="form-control" value="${escapeHtml(data.url)}" required>
                                </div>
                                <div class="form-group">
                                    <label>Icon</label>
                                    <select name="icon_class" class="form-control form-select" required>
                                        ${generateIconOptions(data.icon_class)}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Icon Color</label>
                                    <input type="color" name="icon_color" value="${data.icon_color}" class="form-control" style="height: 40px; padding: 0.25rem;">
                                </div>
                                <div class="form-group">
                                    <label for="editAppCardBadge">Badge Text (optional)</label>
                                    <input type="text" id="editAppCardBadge" name="badge_text" class="form-control" value="${escapeHtml(data.badge_text || '')}">
                                </div>
                                <div class="form-group">
                                    <label for="editAppCardSort">Sort Order</label>
                                    <input type="number" id="editAppCardSort" name="sort_order" class="form-control" value="${data.sort_order}">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="editAppCardActive" name="is_active" class="form-check-input" ${data.is_active ? 'checked' : ''}>
                                    <label for="editAppCardActive" class="form-check-label">Active</label>
                                </div>
                            `;
                        } else if (modalType === 'editAnnouncement') {
                            const startDate = data.start_date ? new Date(data.start_date).toISOString().slice(0, 16) : '';
                            const endDate = data.end_date ? new Date(data.end_date).toISOString().slice(0, 16) : '';

                            modalBody.innerHTML = `
                                <div class="form-group">
                                    <label for="editAnnouncementTitle">Title</label>
                                    <input type="text" id="editAnnouncementTitle" name="title" class="form-control" value="${escapeHtml(data.title)}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editAnnouncementContent">Content</label>
                                    <textarea id="editAnnouncementContent" name="content" class="form-control" rows="5" required>${escapeHtml(data.content)}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="editAnnouncementStartDate">Start Date</label>
                                    <input type="datetime-local" id="editAnnouncementStartDate" name="start_date" class="form-control" value="${startDate}">
                                </div>
                                <div class="form-group">
                                    <label for="editAnnouncementEndDate">End Date (optional)</label>
                                    <input type="datetime-local" id="editAnnouncementEndDate" name="end_date" class="form-control" value="${endDate}">
                                </div>
                                <div class="form-group">
                                    <label for="editAnnouncementSort">Sort Order</label>
                                    <input type="number" id="editAnnouncementSort" name="sort_order" class="form-control" value="${data.sort_order}">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="editAnnouncementActive" name="is_active" class="form-check-input" ${data.is_active ? 'checked' : ''}>
                                    <label for="editAnnouncementActive" class="form-check-label">Active</label>
                                </div>
                            `;
                        } else if (modalType === 'editNotification') {
                            modalBody.innerHTML = `
                                <div class="form-group">
                                    <label for="editNotificationTitle">Title</label>
                                    <input type="text" id="editNotificationTitle" name="title" class="form-control" value="${escapeHtml(data.title)}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editNotificationMessage">Message</label>
                                    <textarea id="editNotificationMessage" name="message" class="form-control" rows="3" required>${escapeHtml(data.message)}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Icon</label>
                                    <select name="icon_class" class="form-control form-select" required>
                                        ${generateIconOptions(data.icon_class)}
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="editNotificationActive" name="is_active" class="form-check-input" ${data.is_active ? 'checked' : ''}>
                                    <label for="editNotificationActive" class="form-check-label">Active</label>
                                </div>
                            `;
                        } else if (modalType === 'editUser') {
                            modalBody.innerHTML = `
                                <div class="form-group">
                                    <label for="editUserUsername">Username</label>
                                    <input type="text" id="editUserUsername" name="username" class="form-control" value="${escapeHtml(data.username)}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editUserFullName">Full Name</label>
                                    <input type="text" id="editUserFullName" name="full_name" class="form-control" value="${escapeHtml(data.full_name)}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editUserEmail">Email</label>
                                    <input type="email" id="editUserEmail" name="email" class="form-control" value="${escapeHtml(data.email)}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editUserPassword">New Password (leave blank to keep current)</label>
                                    <input type="password" id="editUserPassword" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="editUserConfirmPassword">Confirm New Password</label>
                                    <input type="password" id="editUserConfirmPassword" name="confirm_password" class="form-control">
                                </div>
                            `;
                        }
                    });
            }
        }

        function hideModal(modalType) {
            const modal = document.getElementById(`${modalType}Modal`);
            modal.classList.remove('show');
        }

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function generateIconOptions(selectedIcon) {
            const icons = <?= json_encode($iconClasses) ?>;
            return icons.map(icon =>
                `<option value="${icon}" ${icon === selectedIcon ? 'selected' : ''}>${icon}</option>`
            ).join('');
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal')) {
                e.target.classList.remove('show');
            }
        });
    </script>
</body>

</html>