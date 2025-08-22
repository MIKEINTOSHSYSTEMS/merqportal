<?php
// Include session configuration first
require_once __DIR__ . '/../includes/session-config.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

requireAdmin(); // This will redirect non-admins to login

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = 'Invalid CSRF token';
        header('Location: dashboard.php');
        exit;
    }

    // Verify admin privileges for all modifications
    if (!isAdmin()) {
        $_SESSION['error'] = 'Administrator privileges required for this action';
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
                        $_SESSION['user_id'],
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


                case 'add_department':
                    $stmt = $pdo->prepare("INSERT INTO departments (department_name, description) VALUES (?, ?)");
                    $stmt->execute([
                        sanitizeInput($_POST['department_name']),
                        sanitizeInput($_POST['description'])
                    ]);
                    $_SESSION['success'] = 'Department added successfully';
                    break;

                case 'update_department':
                    $stmt = $pdo->prepare("UPDATE departments SET department_name = ?, description = ? WHERE department_id = ?");
                    $stmt->execute([
                        sanitizeInput($_POST['department_name']),
                        sanitizeInput($_POST['description']),
                        (int)$_POST['department_id']
                    ]);
                    $_SESSION['success'] = 'Department updated successfully';
                    break;

                case 'delete_department':
                    // Check if department is in use
                    $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE department_id = ?");
                    $check->execute([(int)$_POST['department_id']]);
                    if ($check->fetchColumn() > 0) {
                        $_SESSION['error'] = 'Cannot delete department. It is assigned to users.';
                        break;
                    }

                    $stmt = $pdo->prepare("DELETE FROM departments WHERE department_id = ?");
                    $stmt->execute([(int)$_POST['department_id']]);
                    $_SESSION['success'] = 'Department deleted successfully';
                    break;

                case 'add_position':
                    $stmt = $pdo->prepare("INSERT INTO positions (position_title, department_id, job_description, is_active) VALUES (?, ?, ?, ?)");
                    $stmt->execute([
                        sanitizeInput($_POST['position_title']),
                        (int)$_POST['department_id'],
                        sanitizeInput($_POST['job_description']),
                        isset($_POST['is_active']) ? 1 : 0
                    ]);
                    $_SESSION['success'] = 'Position added successfully';
                    break;

                case 'update_position':
                    $stmt = $pdo->prepare("UPDATE positions SET position_title = ?, department_id = ?, job_description = ?, is_active = ? WHERE position_id = ?");
                    $stmt->execute([
                        sanitizeInput($_POST['position_title']),
                        (int)$_POST['department_id'],
                        sanitizeInput($_POST['job_description']),
                        isset($_POST['is_active']) ? 1 : 0,
                        (int)$_POST['position_id']
                    ]);
                    $_SESSION['success'] = 'Position updated successfully';
                    break;

                case 'delete_position':
                    // Check if position is in use
                    $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE position_id = ?");
                    $check->execute([(int)$_POST['position_id']]);
                    if ($check->fetchColumn() > 0) {
                        $_SESSION['error'] = 'Cannot delete position. It is assigned to users.';
                        break;
                    }

                    $stmt = $pdo->prepare("DELETE FROM positions WHERE position_id = ?");
                    $stmt->execute([(int)$_POST['position_id']]);
                    $_SESSION['success'] = 'Position deleted successfully';
                    break;

                case 'bulk_update_users':
                    if (!isset($_POST['user_ids']) || empty($_POST['user_ids'])) {
                        $_SESSION['error'] = 'No users selected';
                        break;
                    }

                    $userIds = is_array($_POST['user_ids']) ? $_POST['user_ids'] : explode(',', $_POST['user_ids']);
                    $field = $_POST['field'];
                    $value = $_POST['value'];

                    // Validate field
                    $allowedFields = ['department_id', 'position_id', 'supervisor_id', 'role', 'is_active', 'leave_balance'];
                    if (!in_array($field, $allowedFields)) {
                        $_SESSION['error'] = 'Invalid field';
                        break;
                    }

                    // Prepare placeholders for IN clause
                    $placeholders = implode(',', array_fill(0, count($userIds), '?'));

                    $sql = "UPDATE users SET $field = ? WHERE user_id IN ($placeholders)";
                    $params = array_merge([$value], $userIds);

                    try {
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($params);
                        $_SESSION['success'] = 'Updated ' . count($userIds) . ' user(s) successfully';
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Error updating users: ' . $e->getMessage();
                    }
                    break;

                case 'bulk_delete_users':
                    if (!isset($_POST['user_ids']) || empty($_POST['user_ids'])) {
                        $_SESSION['error'] = 'No users selected';
                        break;
                    }

                    $userIds = is_array($_POST['user_ids']) ? $_POST['user_ids'] : explode(',', $_POST['user_ids']);

                    // Prevent deleting current user
                    if (in_array($_SESSION['user_id'], $userIds)) {
                        $_SESSION['error'] = 'You cannot delete your own account';
                        break;
                    }

                    // Prepare placeholders for IN clause
                    $placeholders = implode(',', array_fill(0, count($userIds), '?'));

                    $sql = "DELETE FROM users WHERE user_id IN ($placeholders)";

                    try {
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($userIds);
                        $_SESSION['success'] = 'Deleted ' . count($userIds) . ' user(s) successfully';
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Error deleting users: ' . $e->getMessage();
                    }
                    break;


                // User Management
                case 'add_user':
                    // Check if email already exists
                    $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
                    $checkEmail->execute([sanitizeInput($_POST['email'])]);
                    if ($checkEmail->fetchColumn() > 0) {
                        $_SESSION['error'] = 'Email address already exists';
                        break;
                    }

                    // Check if username already exists
                    $checkUsername = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
                    $checkUsername->execute([sanitizeInput($_POST['username'])]);
                    if ($checkUsername->fetchColumn() > 0) {
                        $_SESSION['error'] = 'Username already exists';
                        break;
                    }

                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $_SESSION['error'] = 'Passwords do not match';
                        break;
                    }

                    $stmt = $pdo->prepare("INSERT INTO users 
                        (employee_id, is_doctor, first_name, middle_name, last_name, username, email, 
                        phone, alternate_phone, password_hash, role, department_id, position_id, 
                        supervisor_id, join_date, hire_date, leave_balance, is_active) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $stmt->execute([
                        sanitizeInput($_POST['employee_id']),
                        (int)$_POST['is_doctor'],
                        sanitizeInput($_POST['first_name']),
                        sanitizeInput($_POST['middle_name']),
                        sanitizeInput($_POST['last_name']),
                        sanitizeInput($_POST['username']),
                        sanitizeInput($_POST['email']),
                        sanitizeInput($_POST['phone']),
                        sanitizeInput($_POST['alternate_phone']),
                        createPasswordHash($_POST['password']),
                        sanitizeInput($_POST['role']),
                        !empty($_POST['department_id']) ? (int)$_POST['department_id'] : NULL,
                        !empty($_POST['position_id']) ? (int)$_POST['position_id'] : NULL,
                        !empty($_POST['supervisor_id']) ? (int)$_POST['supervisor_id'] : NULL,
                        !empty($_POST['join_date']) ? $_POST['join_date'] : NULL,
                        !empty($_POST['hire_date']) ? $_POST['hire_date'] : NULL,
                        (float)$_POST['leave_balance'],
                        (int)$_POST['is_active']
                    ]);

                    $_SESSION['success'] = 'User added successfully';
                    break;

                // Update the update_user case
                case 'update_user':
                    // Check if email already exists (excluding current user)
                    $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND user_id != ?");
                    $checkEmail->execute([
                        sanitizeInput($_POST['email']),
                        (int)$_POST['user_id']
                    ]);
                    if ($checkEmail->fetchColumn() > 0) {
                        $_SESSION['error'] = 'Email address already exists';
                        break;
                    }

                    // Check if username already exists (excluding current user)
                    $checkUsername = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND user_id != ?");
                    $checkUsername->execute([
                        sanitizeInput($_POST['username']),
                        (int)$_POST['user_id']
                    ]);
                    if ($checkUsername->fetchColumn() > 0) {
                        $_SESSION['error'] = 'Username already exists';
                        break;
                    }

                    $updateFields = [
                        'employee_id' => sanitizeInput($_POST['employee_id']),
                        'is_doctor' => (int)$_POST['is_doctor'],
                        'first_name' => sanitizeInput($_POST['first_name']),
                        'middle_name' => sanitizeInput($_POST['middle_name']),
                        'last_name' => sanitizeInput($_POST['last_name']),
                        'username' => sanitizeInput($_POST['username']),
                        'email' => sanitizeInput($_POST['email']),
                        'phone' => sanitizeInput($_POST['phone']),
                        'alternate_phone' => sanitizeInput($_POST['alternate_phone']),
                        'role' => sanitizeInput($_POST['role']),
                        'department_id' => !empty($_POST['department_id']) ? (int)$_POST['department_id'] : NULL,
                        'position_id' => !empty($_POST['position_id']) ? (int)$_POST['position_id'] : NULL,
                        'supervisor_id' => !empty($_POST['supervisor_id']) ? (int)$_POST['supervisor_id'] : NULL,
                        'join_date' => !empty($_POST['join_date']) ? $_POST['join_date'] : NULL,
                        'hire_date' => !empty($_POST['hire_date']) ? $_POST['hire_date'] : NULL,
                        'leave_balance' => (float)$_POST['leave_balance'],
                        'is_active' => (int)$_POST['is_active'],
                        'user_id' => (int)$_POST['user_id']
                    ];

                    $sql = "UPDATE users SET 
                        employee_id = :employee_id, 
                        is_doctor = :is_doctor, 
                        first_name = :first_name, 
                        middle_name = :middle_name, 
                        last_name = :last_name, 
                        username = :username, 
                        email = :email, 
                        phone = :phone, 
                        alternate_phone = :alternate_phone, 
                        role = :role, 
                        department_id = :department_id, 
                        position_id = :position_id, 
                        supervisor_id = :supervisor_id, 
                        join_date = :join_date, 
                        hire_date = :hire_date, 
                        leave_balance = :leave_balance, 
                        is_active = :is_active";

                    // Only update password if provided
                    if (!empty($_POST['password'])) {
                        if ($_POST['password'] !== $_POST['confirm_password']) {
                            $_SESSION['error'] = 'Passwords do not match';
                            break;
                        }
                        $sql .= ", password_hash = :password_hash";
                        $updateFields['password_hash'] = createPasswordHash($_POST['password']);
                    }

                    $sql .= " WHERE user_id = :user_id";

                    try {
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($updateFields);
                        $_SESSION['success'] = 'User updated successfully';
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Error updating user: ' . $e->getMessage();
                    }
                    break;

                case 'delete_user':
                    // Prevent deleting current user
                    if ((int)$_POST['user_id'] === $_SESSION['user_id']) {
                        $_SESSION['error'] = 'You cannot delete your own account';
                        break;
                    }
                    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
                    $stmt->execute([(int)$_POST['user_id']]);
                    $_SESSION['success'] = 'User deleted successfully';
                    break;

                case 'update_user_role':
                    $stmt = $pdo->prepare("UPDATE users SET role = ?, job_position = ? WHERE user_id = ?");
                    $stmt->execute([
                        sanitizeInput($_POST['role']),
                        sanitizeInput($_POST['job_position']),
                        (int)$_POST['user_id']
                    ]);
                    $_SESSION['success'] = 'User role updated successfully';
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

$users = $pdo->query("
    SELECT 
        u.user_id, 
        u.employee_id,
        u.is_doctor,
        u.full_name,
        u.first_name,
        u.middle_name,
        u.last_name,
        u.username,
        u.email,
        u.phone,
        u.alternate_phone,
        u.role,
        u.join_date,
        u.hire_date,
        u.leave_balance,
        u.last_leave_increment,
        u.is_active,
        p.position_title, 
        d.department_name, 
        u.supervisor_id,
        s.full_name AS supervisor_name,
        u.last_login,
        u.created_at,
        u.updated_at
    FROM users u
    LEFT JOIN positions p 
        ON u.position_id = p.position_id
    LEFT JOIN departments d 
        ON u.department_id = d.department_id
    LEFT JOIN users s 
        ON u.supervisor_id = s.user_id
    ORDER BY u.full_name ASC
")->fetchAll();

// Also get departments and positions for dropdowns
$departments = $pdo->query("SELECT department_id, department_name FROM departments ORDER BY department_name")->fetchAll();
$positions = $pdo->query("SELECT position_id, position_title FROM positions ORDER BY position_title")->fetchAll();
$supervisors = $pdo->query("SELECT user_id, full_name FROM users WHERE is_active = 1 ORDER BY full_name")->fetchAll();

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MERQ Portal - Admin Dashboard</title>
    <link rel="icon" type="image/png" href="/assets/images/icon-192.png">
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
            overflow-x: hidden;
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
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header img {
            height: 40px;
            margin-bottom: 0.5rem;
            align-self: center;
        }

        .sidebar-header h3 {
            font-size: 1.1rem;
            font-weight: 500;
            text-align: center;
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

        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.5rem;
            z-index: 1100;
            cursor: pointer;
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
            flex-wrap: wrap;
            gap: 1rem;
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

        .badge-info {
            background-color: rgba(66, 153, 225, 0.2);
            color: var(--accent-color);
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
            min-height: 44px;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            min-height: unset;
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
            max-height: 90vh;
            overflow-y: auto;
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

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.175);
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* App Cards Grid */
        .app-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .app-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .app-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .app-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .app-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .app-description {
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .app-badge {
            margin-top: auto;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .user-info {
                margin-top: 1rem;
            }

            .app-cards-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .modal-dialog {
                width: 95%;
                margin: 1rem auto;
            }
        }

        /* Dashboard Section Styles */
        .dashboard-section {
            display: none;
        }

        .dashboard-section.active {
            display: block;
        }

        /* Loading Spinner */
        .spinner {
            width: 40px;
            height: 40px;
            margin: 100px auto;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Custom Checkbox */
        .custom-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-right: 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Bulk Actions Container */
        .bulk-actions-container {
            display: none;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .bulk-actions-container.active {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--success-color);
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Icon Selector */
        .icon-selector {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(40px, 1fr));
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .icon-option {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .icon-option:hover,
        .icon-option.selected {
            background-color: var(--primary-color);
            color: white;
        }

        /* Search Box */
        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box input {
            padding-left: 2.5rem;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        /* Status Indicator */
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .status-active {
            background-color: var(--success-color);
        }

        .status-inactive {
            background-color: var(--error-color);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
            gap: 0.5rem;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            padding: 0.5rem 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Print Styles */
        @media print {

            .sidebar,
            .header .user-info,
            .btn,
            .action-buttons {
                display: none !important;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Additional Styles for Enhanced Functionality */
        .filter-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 150px;
        }

        .filter-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding: 0.5rem 0;
        }

        .page-info {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .view-options {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .view-option-btn {
            padding: 0.5rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-option-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .export-options {
            display: flex;
            gap: 0.5rem;
        }

        .print-only {
            display: none;
        }

        @media print {
            .print-only {
                display: block;
            }

            .no-print {
                display: none !important;
            }
        }

        .search-box {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-box input {
            padding-left: 2.5rem;
            width: 100%;
            max-width: 300px;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .sortable {
            cursor: pointer;
            position: relative;
        }

        .sortable:after {
            content: '↕';
            margin-left: 0.5rem;
            opacity: 0.3;
        }

        .sortable.asc:after {
            content: '↑';
            opacity: 1;
        }

        .sortable.desc:after {
            content: '↓';
            opacity: 1;
        }

        @media print {
            .print-header {
                text-align: center;
                margin-bottom: 1rem;
                padding-bottom: 1rem;
                border-bottom: 2px solid #000;
            }

            .print-header h1 {
                font-size: 1.5rem;
                margin: 0;
            }

            .print-header p {
                margin: 0;
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="/assets/images/icon-192.png" alt="MERQ Portal Logo">
            <h3>MERQ Portal Admin</h3>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="#" class="active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#" data-section="app-cards">
                    <i class="fas fa-th-large"></i> App Cards
                </a>
            </li>
            <li>
                <a href="#" data-section="announcements">
                    <i class="fas fa-bullhorn"></i> Announcements
                </a>
            </li>
            <li>
                <a href="#" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
            </li>
            <li>
                <a href="#" data-section="departments">
                    <i class="fas fa-building"></i> Departments
                </a>
            </li>
            <li>
                <a href="#" data-section="positions">
                    <i class="fas fa-user-tie"></i> Positions
                </a>
            </li>
            <li>
                <a href="#" data-section="user-management">
                    <i class="fas fa-users"></i> User Management
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                <form action="../includes/logout.php" method="post" style="display:inline;">
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success fade-in">
                <i class="fas fa-check-circle"></i>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger fade-in">
                <i class="fas fa-exclamation-circle"></i>
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Dashboard Overview Section -->
        <div class="dashboard-section active" id="dashboard-section">
            <div class="card">
                <div class="card-header">
                    <h2>Dashboard Overview</h2>
                </div>
                <div class="card-body">
                    <div class="app-cards-grid">
                        <div class="app-card">
                            <div class="app-icon" style="background-color: rgba(66, 153, 225, 0.2); color: #4299e1;">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="app-title">Users</h3>
                            <p class="app-description">Manage system users</p>
                            <span class="app-badge badge-info"><?php echo count($users); ?> Total</span>
                        </div>

                        <div class="app-card">
                            <div class="app-icon" style="background-color: rgba(72, 187, 120, 0.2); color: #48bb78;">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3 class="app-title">Departments</h3>
                            <p class="app-description">Manage departments</p>
                            <span class="app-badge badge-success"><?php echo count($departments); ?> Total</span>
                        </div>

                        <div class="app-card">
                            <div class="app-icon" style="background-color: rgba(246, 173, 85, 0.2); color: #f6ad55;">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3 class="app-title">Positions</h3>
                            <p class="app-description">Manage job positions</p>
                            <span class="app-badge badge-warning"><?php echo count($positions); ?> Total</span>
                        </div>

                        <div class="app-card">
                            <div class="app-icon" style="background-color: rgba(237, 100, 166, 0.2); color: #ed64a6;">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h3 class="app-title">Announcements</h3>
                            <p class="app-description">Manage announcements</p>
                            <span class="app-badge" style="background-color: rgba(237, 100, 166, 0.2); color: #ed64a6;"><?php echo count($announcements); ?> Total</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Cards Section -->
        <div class="dashboard-section" id="app-cards-section">
            <div class="card">
                <div class="card-header">
                    <h2>Application Cards</h2>
                    <button class="btn btn-primary" onclick="showModal('addAppCard')">
                        <i class="fas fa-plus"></i> Add New Card
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Icon</th>
                                    <th>Badge</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appCards as $card): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($card['title']); ?></td>
                                        <td><?php echo htmlspecialchars($card['description']); ?></td>
                                        <td><?php echo htmlspecialchars($card['url']); ?></td>
                                        <td><i class="<?php echo htmlspecialchars($card['icon_class']); ?>" style="color: <?php echo htmlspecialchars($card['icon_color']); ?>"></i></td>
                                        <td>
                                            <?php if ($card['badge_text']): ?>
                                                <span class="badge badge-info"><?php echo htmlspecialchars($card['badge_text']); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $card['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $card['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $card['sort_order']; ?></td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-outline" onclick="editAppCard(<?php echo $card['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="id" value="<?php echo $card['id']; ?>">
                                                <input type="hidden" name="action" value="delete_app_card">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this app card?')">
                                                    <i class="fas fa-trash"></i>
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
        <div class="dashboard-section" id="announcements-section">
            <div class="card">
                <div class="card-header">
                    <h2>Announcements</h2>
                    <button class="btn btn-primary" onclick="showModal('addAnnouncement')">
                        <i class="fas fa-plus"></i> Add New Announcement
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
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($announcements as $announcement): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($announcement['title']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($announcement['content'], 0, 50)) . (strlen($announcement['content']) > 50 ? '...' : ''); ?></td>
                                        <td><?php echo $announcement['start_date'] ? date('M j, Y', strtotime($announcement['start_date'])) : '-'; ?></td>
                                        <td><?php echo $announcement['end_date'] ? date('M j, Y', strtotime($announcement['end_date'])) : '-'; ?></td>
                                        <td>
                                            <span class="badge <?php echo $announcement['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $announcement['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $announcement['sort_order']; ?></td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-outline" onclick="editAnnouncement(<?php echo $announcement['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="id" value="<?php echo $announcement['id']; ?>">
                                                <input type="hidden" name="action" value="delete_announcement">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                                    <i class="fas fa-trash"></i>
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
        <div class="dashboard-section" id="notifications-section">
            <div class="card">
                <div class="card-header">
                    <h2>Notifications</h2>
                    <button class="btn btn-primary" onclick="showModal('addNotification')">
                        <i class="fas fa-plus"></i> Add New Notification
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
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notifications as $notification): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($notification['title']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($notification['message'], 0, 50)) . (strlen($notification['message']) > 50 ? '...' : ''); ?></td>
                                        <td><i class="<?php echo htmlspecialchars($notification['icon_class']); ?>"></i></td>
                                        <td>
                                            <span class="badge <?php echo $notification['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $notification['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($notification['created_at'])); ?></td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-outline" onclick="editNotification(<?php echo $notification['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="id" value="<?php echo $notification['id']; ?>">
                                                <input type="hidden" name="action" value="delete_notification">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')">
                                                    <i class="fas fa-trash"></i>
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

        <!-- Departments Section -->
        <div class="dashboard-section" id="departments-section">
            <div class="card">
                <div class="card-header">
                    <h2>Departments</h2>
                    <button class="btn btn-primary" onclick="showModal('addDepartment')">
                        <i class="fas fa-plus"></i> Add New Department
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Department Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($departments as $department): ?>
                                    <tr>
                                        <td><?php echo $department['department_id']; ?></td>
                                        <td><?php echo htmlspecialchars($department['department_name']); ?></td>
                                        <td><?php echo htmlspecialchars($department['description']); ?></td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-outline" onclick="editDepartment(<?php echo $department['department_id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="department_id" value="<?php echo $department['department_id']; ?>">
                                                <input type="hidden" name="action" value="delete_department">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this department?')">
                                                    <i class="fas fa-trash"></i>
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

        <!-- Positions Section -->
        <div class="dashboard-section" id="positions-section">
            <div class="card">
                <div class="card-header">
                    <h2>Positions</h2>
                    <button class="btn btn-primary" onclick="showModal('addPosition')">
                        <i class="fas fa-plus"></i> Add New Position
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Position Title</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($positions as $position): ?>
                                    <tr>
                                        <td><?php echo $position['position_id']; ?></td>
                                        <td><?php echo htmlspecialchars($position['position_title']); ?></td>
                                        <td>
                                            <?php
                                            $deptName = 'N/A';
                                            foreach ($departments as $dept) {
                                                if ($dept['department_id'] == $position['department_id']) {
                                                    $deptName = $dept['department_name'];
                                                    break;
                                                }
                                            }
                                            echo htmlspecialchars($deptName);
                                            ?>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $position['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $position['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-outline" onclick="editPosition(<?php echo $position['position_id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="position_id" value="<?php echo $position['position_id']; ?>">
                                                <input type="hidden" name="action" value="delete_position">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this position?')">
                                                    <i class="fas fa-trash"></i>
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
        <div class="dashboard-section" id="user-management-section">
            <div class="card">
                <div class="card-header">
                    <h2>User Management</h2>
                    <div>
                        <!-- Bulk Actions Dropdown -->
                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="bulkActionsDropdown">
                                <i class="fas fa-cogs"></i> Bulk Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                <a class="dropdown-item" href="#" onclick="showModal('bulkUpdate')">Update Fields</a>
                                <a class="dropdown-item" href="#" onclick="bulkAction('activate')">Activate Selected</a>
                                <a class="dropdown-item" href="#" onclick="bulkAction('deactivate')">Deactivate Selected</a>
                                <a class="dropdown-item" href="#" onclick="bulkAction('delete')">Delete Selected</a>
                            </div>
                        </div>

                        <!-- Export Dropdown -->
                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown">
                                <i class="fas fa-download"></i> Export
                            </button>
                            <div class="dropdown-menu" aria-labelledby="exportDropdown">
                                <a class="dropdown-item" href="#" onclick="exportData('csv')">Export to CSV</a>
                                <a class="dropdown-item" href="#" onclick="exportData('excel')">Export to Excel</a>
                                <a class="dropdown-item" href="#" onclick="exportData('pdf')">Export to PDF</a>
                            </div>
                        </div>

                        <button class="btn btn-primary" onclick="showModal('addUser')">
                            <i class="fas fa-plus"></i> Add New User
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Bulk Actions Container -->
                    <div class="bulk-actions-container" id="bulkActionsContainer">
                        <span id="selectedCount">0 users selected</span>
                        <button class="btn btn-sm btn-outline" onclick="selectAllUsers()">Select All</button>
                        <button class="btn btn-sm btn-outline" onclick="deselectAllUsers()">Deselect All</button>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th width="50">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)">
                                            <span class="checkmark"></span>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="custom-checkbox">
                                                <input type="checkbox" class="user-checkbox" value="<?php echo $user['user_id']; ?>" onchange="updateBulkActions()">
                                                <span class="checkmark"></span>
                                            </div>
                                        </td>
                                        <td><?php echo $user['employee_id']; ?></td>
                                        <td>
                                            <?php
                                            $fullName = trim($user['first_name'] . ' ' . ($user['middle_name'] ? $user['middle_name'] . ' ' : '') . $user['last_name']);
                                            echo htmlspecialchars($fullName ?: $user['full_name']);
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td>
                                            <span class="badge badge-info"><?php echo htmlspecialchars($user['role']); ?></span>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['department_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($user['position_title'] ?? 'N/A'); ?></td>
                                        <td>
                                            <span class="badge <?php echo $user['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-outline" onclick="editUser(<?php echo $user['user_id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                <input type="hidden" name="action" value="delete_user">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fas fa-trash"></i>
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
    </div>

    <!-- Add App Card Modal -->
    <div class="modal" id="addAppCardModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Add Application Card</h3>
                <button class="close" onclick="closeModal('addAppCardModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_app_card">

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
                        <div class="icon-selector" id="iconSelector">
                            <?php foreach ($iconClasses as $icon): ?>
                                <div class="icon-option" data-icon="<?php echo $icon; ?>">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" id="appCardIconClass" name="icon_class" value="fa-calendar-alt" required>
                    </div>

                    <div class="form-group">
                        <label>Icon Color</label>
                        <div class="color-picker">
                            <div class="color-option selected" style="background-color: #4299e1;" data-color="#4299e1"></div>
                            <div class="color-option" style="background-color: #48bb78;" data-color="#48bb78"></div>
                            <div class="color-option" style="background-color: #ed8936;" data-color="#ed8936"></div>
                            <div class="color-option" style="background-color: #e53e3e;" data-color="#e53e3e"></div>
                            <div class="color-option" style="background-color: #9f7aea;" data-color="#9f7aea"></div>
                            <div class="color-option" style="background-color: #ed64a6;" data-color="#ed64a6"></div>
                        </div>
                        <input type="hidden" id="appCardIconColor" name="icon_color" value="#4299e1" required>
                    </div>

                    <div class="form-group">
                        <label for="appCardBadge">Badge Text (optional)</label>
                        <input type="text" id="appCardBadge" name="badge_text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="appCardSortOrder">Sort Order</label>
                        <input type="number" id="appCardSortOrder" name="sort_order" class="form-control" value="0" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="appCardIsActive" name="is_active" class="form-check-input" checked>
                            <label for="appCardIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('addAppCardModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit App Card Modal -->
    <div class="modal" id="editAppCardModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Edit Application Card</h3>
                <button class="close" onclick="closeModal('editAppCardModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_app_card">
                    <input type="hidden" id="editAppCardId" name="id" value="">

                    <div class="form-group">
                        <label for="editAppCardTitle">Title</label>
                        <input type="text" id="editAppCardTitle" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editAppCardDescription">Description</label>
                        <textarea id="editAppCardDescription" name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editAppCardUrl">URL</label>
                        <input type="url" id="editAppCardUrl" name="url" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <div class="icon-selector" id="editIconSelector">
                            <?php foreach ($iconClasses as $icon): ?>
                                <div class="icon-option" data-icon="<?php echo $icon; ?>">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" id="editAppCardIconClass" name="icon_class" required>
                    </div>

                    <div class="form-group">
                        <label>Icon Color</label>
                        <div class="color-picker" id="editColorPicker">
                            <div class="color-option" style="background-color: #4299e1;" data-color="#4299e1"></div>
                            <div class="color-option" style="background-color: #48bb78;" data-color="#48bb78"></div>
                            <div class="color-option" style="background-color: #ed8936;" data-color="#ed8936"></div>
                            <div class="color-option" style="background-color: #e53e3e;" data-color="#e53e3e"></div>
                            <div class="color-option" style="background-color: #9f7aea;" data-color="#9f7aea"></div>
                            <div class="color-option" style="background-color: #ed64a6;" data-color="#ed64a6"></div>
                        </div>
                        <input type="hidden" id="editAppCardIconColor" name="icon_color" required>
                    </div>

                    <div class="form-group">
                        <label for="editAppCardBadge">Badge Text (optional)</label>
                        <input type="text" id="editAppCardBadge" name="badge_text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="editAppCardSortOrder">Sort Order</label>
                        <input type="number" id="editAppCardSortOrder" name="sort_order" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="editAppCardIsActive" name="is_active" class="form-check-input">
                            <label for="editAppCardIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editAppCardModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Announcement Modal -->
    <div class="modal" id="addAnnouncementModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Add Announcement</h3>
                <button class="close" onclick="closeModal('addAnnouncementModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_announcement">

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
                        <input type="date" id="announcementStartDate" name="start_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="announcementEndDate">End Date</label>
                        <input type="date" id="announcementEndDate" name="end_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="announcementSortOrder">Sort Order</label>
                        <input type="number" id="announcementSortOrder" name="sort_order" class="form-control" value="0" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="announcementIsActive" name="is_active" class="form-check-input" checked>
                            <label for="announcementIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('addAnnouncementModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Announcement Modal -->
    <div class="modal" id="editAnnouncementModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Edit Announcement</h3>
                <button class="close" onclick="closeModal('editAnnouncementModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_announcement">
                    <input type="hidden" id="editAnnouncementId" name="id" value="">

                    <div class="form-group">
                        <label for="editAnnouncementTitle">Title</label>
                        <input type="text" id="editAnnouncementTitle" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editAnnouncementContent">Content</label>
                        <textarea id="editAnnouncementContent" name="content" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editAnnouncementStartDate">Start Date</label>
                        <input type="date" id="editAnnouncementStartDate" name="start_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="editAnnouncementEndDate">End Date</label>
                        <input type="date" id="editAnnouncementEndDate" name="end_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="editAnnouncementSortOrder">Sort Order</label>
                        <input type="number" id="editAnnouncementSortOrder" name="sort_order" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="editAnnouncementIsActive" name="is_active" class="form-check-input">
                            <label for="editAnnouncementIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editAnnouncementModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Notification Modal -->
    <div class="modal" id="addNotificationModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Add Notification</h3>
                <button class="close" onclick="closeModal('addNotificationModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_notification">

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
                        <div class="icon-selector" id="notificationIconSelector">
                            <?php foreach ($iconClasses as $icon): ?>
                                <div class="icon-option" data-icon="<?php echo $icon; ?>">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" id="notificationIconClass" name="icon_class" value="fa-bell" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="notificationIsActive" name="is_active" class="form-check-input" checked>
                            <label for="notificationIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('addNotificationModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Notification Modal -->
    <div class="modal" id="editNotificationModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Edit Notification</h3>
                <button class="close" onclick="closeModal('editNotificationModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_notification">
                    <input type="hidden" id="editNotificationId" name="id" value="">

                    <div class="form-group">
                        <label for="editNotificationTitle">Title</label>
                        <input type="text" id="editNotificationTitle" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editNotificationMessage">Message</label>
                        <textarea id="editNotificationMessage" name="message" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <div class="icon-selector" id="editNotificationIconSelector">
                            <?php foreach ($iconClasses as $icon): ?>
                                <div class="icon-option" data-icon="<?php echo $icon; ?>">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" id="editNotificationIconClass" name="icon_class" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="editNotificationIsActive" name="is_active" class="form-check-input">
                            <label for="editNotificationIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editNotificationModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Department Modal -->
    <div class="modal" id="addDepartmentModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Add Department</h3>
                <button class="close" onclick="closeModal('addDepartmentModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_department">

                    <div class="form-group">
                        <label for="departmentName">Department Name</label>
                        <input type="text" id="departmentName" name="department_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="departmentDescription">Description</label>
                        <textarea id="departmentDescription" name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('addDepartmentModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Department Modal -->
    <div class="modal" id="editDepartmentModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Edit Department</h3>
                <button class="close" onclick="closeModal('editDepartmentModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_department">
                    <input type="hidden" id="editDepartmentId" name="department_id" value="">

                    <div class="form-group">
                        <label for="editDepartmentName">Department Name</label>
                        <input type="text" id="editDepartmentName" name="department_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editDepartmentDescription">Description</label>
                        <textarea id="editDepartmentDescription" name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editDepartmentModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Position Modal -->
    <div class="modal" id="addPositionModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Add Position</h3>
                <button class="close" onclick="closeModal('addPositionModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_position">

                    <div class="form-group">
                        <label for="positionTitle">Position Title</label>
                        <input type="text" id="positionTitle" name="position_title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="positionDepartment">Department</label>
                        <select id="positionDepartment" name="department_id" class="form-control form-select" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?php echo $department['department_id']; ?>"><?php echo htmlspecialchars($department['department_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="positionDescription">Job Description</label>
                        <textarea id="positionDescription" name="job_description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="positionIsActive" name="is_active" class="form-check-input" checked>
                            <label for="positionIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('addPositionModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Position Modal -->
    <div class="modal" id="editPositionModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Edit Position</h3>
                <button class="close" onclick="closeModal('editPositionModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_position">
                    <input type="hidden" id="editPositionId" name="position_id" value="">

                    <div class="form-group">
                        <label for="editPositionTitle">Position Title</label>
                        <input type="text" id="editPositionTitle" name="position_title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editPositionDepartment">Department</label>
                        <select id="editPositionDepartment" name="department_id" class="form-control form-select" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?php echo $department['department_id']; ?>"><?php echo htmlspecialchars($department['department_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editPositionDescription">Job Description</label>
                        <textarea id="editPositionDescription" name="job_description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="editPositionIsActive" name="is_active" class="form-check-input">
                            <label for="editPositionIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editPositionModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal" id="addUserModal">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-header">
                <h3>Add User</h3>
                <button class="close" onclick="closeModal('addUserModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_user">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label for="userEmployeeId">Employee ID</label>
                            <input type="text" id="userEmployeeId" name="employee_id" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userIsDoctor">Is Doctor?</label>
                            <select id="userIsDoctor" name="is_doctor" class="form-control form-select" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="userFirstName">First Name</label>
                            <input type="text" id="userFirstName" name="first_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userMiddleName">Middle Name</label>
                            <input type="text" id="userMiddleName" name="middle_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="userLastName">Last Name</label>
                            <input type="text" id="userLastName" name="last_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userUsername">Username</label>
                            <input type="text" id="userUsername" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" id="userEmail" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userPhone">Phone</label>
                            <input type="tel" id="userPhone" name="phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="userAlternatePhone">Alternate Phone</label>
                            <input type="tel" id="userAlternatePhone" name="alternate_phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="userPassword">Password</label>
                            <input type="password" id="userPassword" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userConfirmPassword">Confirm Password</label>
                            <input type="password" id="userConfirmPassword" name="confirm_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="userRole">Role</label>
                            <select id="userRole" name="role" class="form-control form-select" required>
                                <option value="employee">Employee</option>
                                <option value="consultant">Consultant</option>
                                <option value="manager">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="userDepartment">Department</label>
                            <select id="userDepartment" name="department_id" class="form-control form-select">
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?php echo $department['department_id']; ?>"><?php echo htmlspecialchars($department['department_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="userPosition">Position</label>
                            <select id="userPosition" name="position_id" class="form-control form-select">
                                <option value="">Select Position</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position['position_id']; ?>"><?php echo htmlspecialchars($position['position_title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="userSupervisor">Supervisor</label>
                            <select id="userSupervisor" name="supervisor_id" class="form-control form-select">
                                <option value="">Select Supervisor</option>
                                <?php foreach ($supervisors as $supervisor): ?>
                                    <option value="<?php echo $supervisor['user_id']; ?>"><?php echo htmlspecialchars($supervisor['full_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="userJoinDate">Join Date</label>
                            <input type="date" id="userJoinDate" name="join_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="userHireDate">Hire Date</label>
                            <input type="date" id="userHireDate" name="hire_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="userLeaveBalance">Leave Balance</label>
                            <input type="number" id="userLeaveBalance" name="leave_balance" class="form-control" step="0.5" value="0">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="userIsActive" name="is_active" class="form-check-input" checked>
                                <label for="userIsActive" class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('addUserModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="editUserModal">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button class="close" onclick="closeModal('editUserModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" id="editUserId" name="user_id" value="">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label for="editUserEmployeeId">Employee ID</label>
                            <input type="text" id="editUserEmployeeId" name="employee_id" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="editUserIsDoctor">Is Doctor?</label>
                            <select id="editUserIsDoctor" name="is_doctor" class="form-control form-select" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editUserFirstName">First Name</label>
                            <input type="text" id="editUserFirstName" name="first_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="editUserMiddleName">Middle Name</label>
                            <input type="text" id="editUserMiddleName" name="middle_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editUserLastName">Last Name</label>
                            <input type="text" id="editUserLastName" name="last_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="editUserUsername">Username</label>
                            <input type="text" id="editUserUsername" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="editUserEmail">Email</label>
                            <input type="email" id="editUserEmail" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="editUserPhone">Phone</label>
                            <input type="tel" id="editUserPhone" name="phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editUserAlternatePhone">Alternate Phone</label>
                            <input type="tel" id="editUserAlternatePhone" name="alternate_phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editUserPassword">Password (leave blank to keep current)</label>
                            <input type="password" id="editUserPassword" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editUserRole">Role</label>
                            <select id="editUserRole" name="role" class="form-control form-select" required>
                                <option value="employee">Employee</option>
                                <option value="consultant">Consultant</option>
                                <option value="manager">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editUserDepartment">Department</label>
                            <select id="editUserDepartment" name="department_id" class="form-control form-select">
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?php echo $department['department_id']; ?>"><?php echo htmlspecialchars($department['department_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editUserPosition">Position</label>
                            <select id="editUserPosition" name="position_id" class="form-control form-select">
                                <option value="">Select Position</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position['position_id']; ?>"><?php echo htmlspecialchars($position['position_title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editUserSupervisor">Supervisor</label>
                            <select id="editUserSupervisor" name="supervisor_id" class="form-control form-select">
                                <option value="">Select Supervisor</option>
                                <?php foreach ($supervisors as $supervisor): ?>
                                    <option value="<?php echo $supervisor['user_id']; ?>"><?php echo htmlspecialchars($supervisor['full_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editUserJoinDate">Join Date</label>
                            <input type="date" id="editUserJoinDate" name="join_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editUserHireDate">Hire Date</label>
                            <input type="date" id="editUserHireDate" name="hire_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editUserLeaveBalance">Leave Balance</label>
                            <input type="number" id="editUserLeaveBalance" name="leave_balance" class="form-control" step="0.5">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="editUserIsActive" name="is_active" class="form-check-input">
                                <label for="editUserIsActive" class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editUserModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bulk Update Modal -->
    <div class="modal" id="bulkUpdateModal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3>Bulk Update Users</h3>
                <button class="close" onclick="closeModal('bulkUpdateModal')">&times;</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="bulk_update_users">
                    <input type="hidden" id="bulkUserIds" name="user_ids" value="">

                    <div class="form-group">
                        <label for="bulkUpdateField">Field to Update</label>
                        <select id="bulkUpdateField" name="field" class="form-control form-select" required>
                            <option value="">Select Field</option>
                            <option value="department_id">Department</option>
                            <option value="position_id">Position</option>
                            <option value="supervisor_id">Supervisor</option>
                            <option value="role">Role</option>
                            <option value="is_active">Status</option>
                            <option value="leave_balance">Leave Balance</option>
                        </select>
                    </div>

                    <div class="form-group" id="bulkUpdateValueContainer">
                        <!-- Dynamic content based on selected field -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('bulkUpdateModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Handle section navigation
        document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Update active menu item
                document.querySelectorAll('.sidebar-menu a').forEach(function(item) {
                    item.classList.remove('active');
                });
                this.classList.add('active');

                // Show the corresponding section
                const sectionId = this.getAttribute('data-section') + '-section';
                document.querySelectorAll('.dashboard-section').forEach(function(section) {
                    section.classList.remove('active');
                });
                document.getElementById(sectionId).classList.add('active');

                // Close sidebar on mobile after selection
                if (window.innerWidth < 992) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });

        // Modal functions
        function showModal(modalId) {
            document.getElementById(modalId + 'Modal').classList.add('show');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            document.querySelectorAll('.modal').forEach(function(modal) {
                if (event.target === modal) {
                    modal.classList.remove('show');
                }
            });
        });

        // Icon selection
        document.querySelectorAll('.icon-option').forEach(function(icon) {
            icon.addEventListener('click', function() {
                const container = this.closest('.icon-selector');
                container.querySelectorAll('.icon-option').forEach(function(item) {
                    item.classList.remove('selected');
                });
                this.classList.add('selected');

                const iconClass = this.getAttribute('data-icon');
                const hiddenInput = container.nextElementSibling;
                hiddenInput.value = iconClass;
            });
        });

        // Color selection
        document.querySelectorAll('.color-option').forEach(function(color) {
            color.addEventListener('click', function() {
                const container = this.closest('.color-picker');
                container.querySelectorAll('.color-option').forEach(function(item) {
                    item.classList.remove('selected');
                });
                this.classList.add('selected');

                const colorValue = this.getAttribute('data-color');
                const hiddenInput = container.nextElementSibling;
                hiddenInput.value = colorValue;
            });
        });

        // Bulk actions
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(function(cb) {
                cb.checked = checkbox.checked;
            });
            updateBulkActions();
        }

        function updateBulkActions() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            const selectedCount = Array.from(checkboxes).filter(cb => cb.checked).length;

            if (selectedCount > 0) {
                document.getElementById('bulkActionsContainer').classList.add('active');
                document.getElementById('selectedCount').textContent = selectedCount + ' user(s) selected';
            } else {
                document.getElementById('bulkActionsContainer').classList.remove('active');
            }

            // Update select all checkbox state
            const selectAll = document.getElementById('selectAllCheckbox');
            if (selectedCount === 0) {
                selectAll.checked = false;
                selectAll.indeterminate = false;
            } else if (selectedCount === checkboxes.length) {
                selectAll.checked = true;
                selectAll.indeterminate = false;
            } else {
                selectAll.checked = false;
                selectAll.indeterminate = true;
            }
        }

        function selectAllUsers() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(function(cb) {
                cb.checked = true;
            });
            updateBulkActions();
        }

        function deselectAllUsers() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(function(cb) {
                cb.checked = false;
            });
            updateBulkActions();
        }

        function bulkAction(action) {
            const checkboxes = document.querySelectorAll('.user-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one user');
                return;
            }

            const userIds = Array.from(checkboxes).map(cb => cb.value);

            if (action === 'delete') {
                if (!confirm('Are you sure you want to delete ' + userIds.length + ' user(s)?')) {
                    return;
                }

                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'post';
                form.action = '';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = 'csrf_token';
                csrfToken.value = '<?php echo $_SESSION['csrf_token']; ?>';
                form.appendChild(csrfToken);

                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'bulk_delete_users';
                form.appendChild(actionInput);

                userIds.forEach(function(id) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'user_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            } else if (action === 'activate' || action === 'deactivate') {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'post';
                form.action = '';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = 'csrf_token';
                csrfToken.value = '<?php echo $_SESSION['csrf_token']; ?>';
                form.appendChild(csrfToken);

                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'bulk_update_users';
                form.appendChild(actionInput);

                const fieldInput = document.createElement('input');
                fieldInput.type = 'hidden';
                fieldInput.name = 'field';
                fieldInput.value = 'is_active';
                form.appendChild(fieldInput);

                const valueInput = document.createElement('input');
                valueInput.type = 'hidden';
                valueInput.name = 'value';
                valueInput.value = action === 'activate' ? '1' : '0';
                form.appendChild(valueInput);

                userIds.forEach(function(id) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'user_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        }

        function exportData(format) {
            alert('Export to ' + format.toUpperCase() + ' functionality would be implemented here');
            // This would typically redirect to an export script with appropriate parameters
        }

        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdowns
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(function(dropdown) {
                const toggle = dropdown.querySelector('.dropdown-toggle');

                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;

                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(function(m) {
                        if (m !== menu) {
                            m.classList.remove('show');
                        }
                    });

                    // Toggle this dropdown
                    menu.classList.toggle('show');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                    menu.classList.remove('show');
                });
            });

            // Prevent dropdowns from closing when clicking inside them
            document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });

        // Bulk update field change handler
        document.getElementById('bulkUpdateField').addEventListener('change', function() {
            const field = this.value;
            const container = document.getElementById('bulkUpdateValueContainer');
            container.innerHTML = '';

            if (!field) return;

            let inputHtml = '';

            switch (field) {
                case 'department_id':
                    inputHtml = `
                        <label for="bulkUpdateValue">Department</label>
                        <select id="bulkUpdateValue" name="value" class="form-control form-select" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept['department_id']; ?>"><?php echo htmlspecialchars($dept['department_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    `;
                    break;

                case 'position_id':
                    inputHtml = `
                        <label for="bulkUpdateValue">Position</label>
                        <select id="bulkUpdateValue" name="value" class="form-control form-select" required>
                            <option value="">Select Position</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?php echo $pos['position_id']; ?>"><?php echo htmlspecialchars($pos['position_title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    `;
                    break;

                case 'supervisor_id':
                    inputHtml = `
                        <label for="bulkUpdateValue">Supervisor</label>
                        <select id="bulkUpdateValue" name="value" class="form-control form-select" required>
                            <option value="">Select Supervisor</option>
                            <?php foreach ($supervisors as $sup): ?>
                                <option value="<?php echo $sup['user_id']; ?>"><?php echo htmlspecialchars($sup['full_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    `;
                    break;

                case 'role':
                    inputHtml = `
                        <label for="bulkUpdateValue">Role</label>
                        <select id="bulkUpdateValue" name="value" class="form-control form-select" required>
                                    <option value="employee">Employee</option>
                                    <option value="consultant">Consultant</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="admin">Administrator</option>
                        </select>
                    `;
                    break;

                case 'is_active':
                    inputHtml = `
                        <label for="bulkUpdateValue">Status</label>
                        <select id="bulkUpdateValue" name="value" class="form-control form-select" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    `;
                    break;

                case 'leave_balance':
                    inputHtml = `
                        <label for="bulkUpdateValue">Leave Balance</label>
                        <input type="number" id="bulkUpdateValue" name="value" class="form-control" step="0.5" required>
                    `;
                    break;
            }

            container.innerHTML = inputHtml;
        });

        // Show bulk update modal
        function showBulkUpdateModal() {
            const checkboxes = document.querySelectorAll('.user-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one user');
                return;
            }

            const userIds = Array.from(checkboxes).map(cb => cb.value);
            document.getElementById('bulkUserIds').value = userIds.join(',');

            // Reset the form
            document.getElementById('bulkUpdateField').value = '';
            document.getElementById('bulkUpdateValueContainer').innerHTML = '';

            showModal('bulkUpdate');
        }

        // Edit functions (would be implemented with AJAX or form population)
        function editAppCard(id) {
            alert('Edit app card ' + id + ' functionality would be implemented here');
            // This would typically fetch data via AJAX and populate the edit modal
        }

        function editAnnouncement(id) {
            alert('Edit announcement ' + id + ' functionality would be implemented here');
        }

        function editNotification(id) {
            alert('Edit notification ' + id + ' functionality would be implemented here');
        }

        function editDepartment(id) {
            alert('Edit department ' + id + ' functionality would be implemented here');
        }

        function editPosition(id) {
            alert('Edit position ' + id + ' functionality would be implemented here');
        }

        function editUser(id) {
            alert('Edit user ' + id + ' functionality would be implemented here');
        }
    </script>

    <script>
        // Data for all sections
        let appCardsData = <?php echo json_encode($appCards); ?>;
        let announcementsData = <?php echo json_encode($announcements); ?>;
        let notificationsData = <?php echo json_encode($notifications); ?>;
        let departmentsData = <?php echo json_encode($departments); ?>;
        let positionsData = <?php echo json_encode($positions); ?>;
        let usersData = <?php echo json_encode($users); ?>;

        // Pagination settings
        const itemsPerPage = 10;
        let currentPage = {
            'app-cards': 1,
            'announcements': 1,
            'notifications': 1,
            'departments': 1,
            'positions': 1,
            'user-management': 1
        };

        // Filter and sort settings
        let filters = {
            'app-cards': {},
            'announcements': {},
            'notifications': {},
            'departments': {},
            'positions': {},
            'user-management': {}
        };

        let sortSettings = {
            'app-cards': {
                field: 'sort_order',
                direction: 'asc'
            },
            'announcements': {
                field: 'sort_order',
                direction: 'asc'
            },
            'notifications': {
                field: 'created_at',
                direction: 'desc'
            },
            'departments': {
                field: 'department_name',
                direction: 'asc'
            },
            'positions': {
                field: 'position_title',
                direction: 'asc'
            },
            'user-management': {
                field: 'full_name',
                direction: 'asc'
            }
        };

        // Edit functions with AJAX implementation
        function editAppCard(id) {
            const card = appCardsData.find(item => item.id == id);
            if (!card) return;

            // Populate the edit form
            document.getElementById('editAppCardId').value = card.id;
            document.getElementById('editAppCardTitle').value = card.title;
            document.getElementById('editAppCardDescription').value = card.description;
            document.getElementById('editAppCardUrl').value = card.url;
            document.getElementById('editAppCardBadge').value = card.badge_text;
            document.getElementById('editAppCardSortOrder').value = card.sort_order;
            document.getElementById('editAppCardIsActive').checked = card.is_active == 1;

            // Set the icon
            const iconOptions = document.querySelectorAll('#editIconSelector .icon-option');
            iconOptions.forEach(option => {
                option.classList.remove('selected');
                if (option.getAttribute('data-icon') === card.icon_class) {
                    option.classList.add('selected');
                }
            });
            document.getElementById('editAppCardIconClass').value = card.icon_class;

            // Set the color
            const colorOptions = document.querySelectorAll('#editColorPicker .color-option');
            colorOptions.forEach(option => {
                option.classList.remove('selected');
                if (option.getAttribute('data-color') === card.icon_color) {
                    option.classList.add('selected');
                }
            });
            document.getElementById('editAppCardIconColor').value = card.icon_color;

            // Show the modal
            showModal('editAppCard');
        }

        function editAnnouncement(id) {
            const announcement = announcementsData.find(item => item.id == id);
            if (!announcement) return;

            // Populate the edit form
            document.getElementById('editAnnouncementId').value = announcement.id;
            document.getElementById('editAnnouncementTitle').value = announcement.title;
            document.getElementById('editAnnouncementContent').value = announcement.content;
            document.getElementById('editAnnouncementStartDate').value = announcement.start_date;
            document.getElementById('editAnnouncementEndDate').value = announcement.end_date;
            document.getElementById('editAnnouncementSortOrder').value = announcement.sort_order;
            document.getElementById('editAnnouncementIsActive').checked = announcement.is_active == 1;

            // Show the modal
            showModal('editAnnouncement');
        }

        function editNotification(id) {
            const notification = notificationsData.find(item => item.id == id);
            if (!notification) return;

            // Populate the edit form
            document.getElementById('editNotificationId').value = notification.id;
            document.getElementById('editNotificationTitle').value = notification.title;
            document.getElementById('editNotificationMessage').value = notification.message;
            document.getElementById('editNotificationIsActive').checked = notification.is_active == 1;

            // Set the icon
            const iconOptions = document.querySelectorAll('#editNotificationIconSelector .icon-option');
            iconOptions.forEach(option => {
                option.classList.remove('selected');
                if (option.getAttribute('data-icon') === notification.icon_class) {
                    option.classList.add('selected');
                }
            });
            document.getElementById('editNotificationIconClass').value = notification.icon_class;

            // Show the modal
            showModal('editNotification');
        }

        function editDepartment(id) {
            const department = departmentsData.find(item => item.department_id == id);
            if (!department) return;

            // Populate the edit form
            document.getElementById('editDepartmentId').value = department.department_id;
            document.getElementById('editDepartmentName').value = department.department_name;
            document.getElementById('editDepartmentDescription').value = department.description;

            // Show the modal
            showModal('editDepartment');
        }

        function editPosition(id) {
            const position = positionsData.find(item => item.position_id == id);
            if (!position) return;

            // Populate the edit form
            document.getElementById('editPositionId').value = position.position_id;
            document.getElementById('editPositionTitle').value = position.position_title;
            document.getElementById('editPositionDepartment').value = position.department_id;
            document.getElementById('editPositionDescription').value = position.job_description;
            document.getElementById('editPositionIsActive').checked = position.is_active == 1;

            // Show the modal
            showModal('editPosition');
        }

        function editUser(id) {
            const user = usersData.find(item => item.user_id == id);
            if (!user) return;

            // Populate the edit form
            document.getElementById('editUserId').value = user.user_id;
            document.getElementById('editUserEmployeeId').value = user.employee_id;
            document.getElementById('editUserIsDoctor').value = user.is_doctor;
            document.getElementById('editUserFirstName').value = user.first_name;
            document.getElementById('editUserMiddleName').value = user.middle_name || '';
            document.getElementById('editUserLastName').value = user.last_name;
            document.getElementById('editUserUsername').value = user.username;
            document.getElementById('editUserEmail').value = user.email;
            document.getElementById('editUserPhone').value = user.phone || '';
            document.getElementById('editUserAlternatePhone').value = user.alternate_phone || '';
            document.getElementById('editUserRole').value = user.role;
            document.getElementById('editUserDepartment').value = user.department_id || '';
            document.getElementById('editUserPosition').value = user.position_id || '';
            document.getElementById('editUserSupervisor').value = user.supervisor_id || '';
            document.getElementById('editUserJoinDate').value = user.join_date || '';
            document.getElementById('editUserHireDate').value = user.hire_date || '';
            document.getElementById('editUserLeaveBalance').value = user.leave_balance;
            document.getElementById('editUserIsActive').checked = user.is_active == 1;

            // Show the modal
            showModal('editUser');
        }

        // Search and filter functions
        function initSearchAndFilter() {
            // Add search boxes to each section
            const sections = ['app-cards', 'announcements', 'notifications', 'departments', 'positions', 'user-management'];

            sections.forEach(section => {
                const sectionElement = document.getElementById(section + '-section');
                if (!sectionElement) return;

                const cardBody = sectionElement.querySelector('.card-body');
                const table = sectionElement.querySelector('table');

                if (!cardBody || !table) return;

                // Create search box
                const searchBox = document.createElement('div');
                searchBox.className = 'search-box';
                searchBox.innerHTML = `
            <i class="fas fa-search"></i>
            <input type="text" id="${section}Search" placeholder="Search..." oninput="filterTable('${section}')">
        `;

                // Create filter container
                const filterContainer = document.createElement('div');
                filterContainer.className = 'filter-container';
                filterContainer.id = `${section}Filters`;

                // Create view options
                const viewOptions = document.createElement('div');
                viewOptions.className = 'view-options';
                viewOptions.innerHTML = `
            <button class="view-option-btn active" data-view="table" onclick="changeView('${section}', 'table')">
                <i class="fas fa-table"></i> Table
            </button>
            <button class="view-option-btn" data-view="grid" onclick="changeView('${section}', 'grid')">
                <i class="fas fa-th-large"></i> Grid
            </button>
        `;

                // Insert before the table
                if (section === 'app-cards') {
                    // For app cards, we have a grid view by default
                    cardBody.insertBefore(viewOptions, cardBody.firstChild);
                    cardBody.insertBefore(searchBox, cardBody.firstChild);
                } else {
                    cardBody.insertBefore(filterContainer, table);
                    cardBody.insertBefore(viewOptions, filterContainer);
                    cardBody.insertBefore(searchBox, viewOptions);
                }

                // Add specific filters based on section
                addSectionFilters(section);
            });
        }

        function addSectionFilters(section) {
            const filterContainer = document.getElementById(`${section}Filters`);
            if (!filterContainer) return;

            let filterHTML = '';

            switch (section) {
                case 'app-cards':
                    filterHTML = `
                <div class="filter-group">
                    <label for="appCardsStatusFilter">Status</label>
                    <select id="appCardsStatusFilter" class="form-control" onchange="filterTable('${section}')">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            `;
                    break;

                case 'announcements':
                    filterHTML = `
                <div class="filter-group">
                    <label for="announcementsStatusFilter">Status</label>
                    <select id="announcementsStatusFilter" class="form-control" onchange="filterTable('${section}')">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="announcementsDateFilter">Date Range</label>
                    <select id="announcementsDateFilter" class="form-control" onchange="filterTable('${section}')">
                        <option value="">All Dates</option>
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                    </select>
                </div>
            `;
                    break;

                case 'notifications':
                    filterHTML = `
                <div class="filter-group">
                    <label for="notificationsStatusFilter">Status</label>
                    <select id="notificationsStatusFilter" class="form-control" onchange="filterTable('${section}')">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            `;
                    break;

                case 'user-management':
                    filterHTML = `
                <div class="filter-group">
                    <label for="usersStatusFilter">Status</label>
                    <select id="usersStatusFilter" class="form-control" onchange="filterTable('${section}')">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="usersRoleFilter">Role</label>
                    <select id="usersRoleFilter" class="form-control" onchange="filterTable('${section}')">
                                    <option value="employee">Employee</option>
                                    <option value="consultant">Consultant</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="admin">Administrator</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="usersDepartmentFilter">Department</label>
                    <select id="usersDepartmentFilter" class="form-control" onchange="filterTable('${section}')">
                        <option value="">All Departments</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?php echo $dept['department_id']; ?>"><?php echo htmlspecialchars($dept['department_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            `;
                    break;
            }

            filterContainer.innerHTML = filterHTML;
        }

        function filterTable(section) {
            const searchTerm = document.getElementById(`${section}Search`).value.toLowerCase();
            let filteredData = [];

            switch (section) {
                case 'app-cards':
                    filteredData = appCardsData.filter(item => {
                        return item.title.toLowerCase().includes(searchTerm) ||
                            item.description.toLowerCase().includes(searchTerm) ||
                            item.url.toLowerCase().includes(searchTerm);
                    });

                    // Apply status filter
                    const statusFilter = document.getElementById('appCardsStatusFilter').value;
                    if (statusFilter === 'active') {
                        filteredData = filteredData.filter(item => item.is_active == 1);
                    } else if (statusFilter === 'inactive') {
                        filteredData = filteredData.filter(item => item.is_active == 0);
                    }
                    break;

                case 'announcements':
                    filteredData = announcementsData.filter(item => {
                        return item.title.toLowerCase().includes(searchTerm) ||
                            item.content.toLowerCase().includes(searchTerm);
                    });

                    // Apply status filter
                    const announcementsStatusFilter = document.getElementById('announcementsStatusFilter').value;
                    if (announcementsStatusFilter === 'active') {
                        filteredData = filteredData.filter(item => item.is_active == 1);
                    } else if (announcementsStatusFilter === 'inactive') {
                        filteredData = filteredData.filter(item => item.is_active == 0);
                    }

                    // Apply date filter
                    const dateFilter = document.getElementById('announcementsDateFilter').value;
                    if (dateFilter) {
                        const now = new Date();
                        filteredData = filteredData.filter(item => {
                            if (!item.created_at) return false;

                            const itemDate = new Date(item.created_at);
                            switch (dateFilter) {
                                case 'today':
                                    return itemDate.toDateString() === now.toDateString();
                                case 'this_week':
                                    const startOfWeek = new Date(now);
                                    startOfWeek.setDate(now.getDate() - now.getDay());
                                    startOfWeek.setHours(0, 0, 0, 0);
                                    return itemDate >= startOfWeek;
                                case 'this_month':
                                    return itemDate.getMonth() === now.getMonth() &&
                                        itemDate.getFullYear() === now.getFullYear();
                                default:
                                    return true;
                            }
                        });
                    }
                    break;

                case 'notifications':
                    filteredData = notificationsData.filter(item => {
                        return item.title.toLowerCase().includes(searchTerm) ||
                            item.message.toLowerCase().includes(searchTerm);
                    });

                    // Apply status filter
                    const notificationsStatusFilter = document.getElementById('notificationsStatusFilter').value;
                    if (notificationsStatusFilter === 'active') {
                        filteredData = filteredData.filter(item => item.is_active == 1);
                    } else if (notificationsStatusFilter === 'inactive') {
                        filteredData = filteredData.filter(item => item.is_active == 0);
                    }
                    break;

                case 'departments':
                    filteredData = departmentsData.filter(item => {
                        return item.department_name.toLowerCase().includes(searchTerm) ||
                            (item.description && item.description.toLowerCase().includes(searchTerm));
                    });
                    break;

                case 'positions':
                    filteredData = positionsData.filter(item => {
                        return item.position_title.toLowerCase().includes(searchTerm) ||
                            (item.job_description && item.job_description.toLowerCase().includes(searchTerm));
                    });
                    break;

                case 'user-management':
                    filteredData = usersData.filter(item => {
                        const fullName = `${item.first_name} ${item.middle_name || ''} ${item.last_name}`.toLowerCase();
                        return fullName.includes(searchTerm) ||
                            item.username.toLowerCase().includes(searchTerm) ||
                            item.email.toLowerCase().includes(searchTerm) ||
                            item.role.toLowerCase().includes(searchTerm);
                    });

                    // Apply status filter
                    const usersStatusFilter = document.getElementById('usersStatusFilter').value;
                    if (usersStatusFilter === 'active') {
                        filteredData = filteredData.filter(item => item.is_active == 1);
                    } else if (usersStatusFilter === 'inactive') {
                        filteredData = filteredData.filter(item => item.is_active == 0);
                    }

                    // Apply role filter
                    const roleFilter = document.getElementById('usersRoleFilter').value;
                    if (roleFilter) {
                        filteredData = filteredData.filter(item => item.role === roleFilter);
                    }

                    // Apply department filter
                    const departmentFilter = document.getElementById('usersDepartmentFilter').value;
                    if (departmentFilter) {
                        filteredData = filteredData.filter(item => item.department_id == departmentFilter);
                    }
                    break;
            }

            // Apply sorting
            const sortField = sortSettings[section].field;
            const sortDirection = sortSettings[section].direction;

            filteredData.sort((a, b) => {
                let valueA = a[sortField];
                let valueB = b[sortField];

                if (typeof valueA === 'string') valueA = valueA.toLowerCase();
                if (typeof valueB === 'string') valueB = valueB.toLowerCase();

                if (valueA < valueB) return sortDirection === 'asc' ? -1 : 1;
                if (valueA > valueB) return sortDirection === 'asc' ? 1 : -1;
                return 0;
            });

            // Update the table
            renderTable(section, filteredData);
        }

        function sortTable(section, field) {
            // Update sort settings
            if (sortSettings[section].field === field) {
                // Toggle direction if same field
                sortSettings[section].direction = sortSettings[section].direction === 'asc' ? 'desc' : 'asc';
            } else {
                // New field, default to ascending
                sortSettings[section].field = field;
                sortSettings[section].direction = 'asc';
            }

            // Update sort indicators
            document.querySelectorAll(`#${section}-section .sortable`).forEach(header => {
                header.classList.remove('asc', 'desc');
            });

            const header = document.querySelector(`#${section}-section th[data-field="${field}"]`);
            if (header) {
                header.classList.add(sortSettings[section].direction);
            }

            // Re-apply filters (which will also sort)
            filterTable(section);
        }

        function renderTable(section, data) {
            const tableBody = document.querySelector(`#${section}-section tbody`);
            if (!tableBody) return;

            // Calculate pagination
            const totalPages = Math.ceil(data.length / itemsPerPage);
            const currentPageNum = currentPage[section];
            const startIndex = (currentPageNum - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, data.length);
            const pageData = data.slice(startIndex, endIndex);

            // Clear existing rows
            tableBody.innerHTML = '';

            // Add new rows
            if (pageData.length === 0) {
                const colSpan = tableBody.parentElement.querySelector('thead tr').cells.length;
                tableBody.innerHTML = `<tr><td colspan="${colSpan}" class="text-center">No records found</td></tr>`;
            } else {
                switch (section) {
                    case 'app-cards':
                        pageData.forEach(card => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${escapeHtml(card.title)}</td>
                        <td>${escapeHtml(card.description)}</td>
                        <td>${escapeHtml(card.url)}</td>
                        <td><i class="${escapeHtml(card.icon_class)}" style="color: ${escapeHtml(card.icon_color)}"></i></td>
                        <td>${card.badge_text ? `<span class="badge badge-info">${escapeHtml(card.badge_text)}</span>` : ''}</td>
                        <td><span class="badge ${card.is_active ? 'badge-success' : 'badge-danger'}">${card.is_active ? 'Active' : 'Inactive'}</span></td>
                        <td>${card.sort_order}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-outline" onclick="editAppCard(${card.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="id" value="${card.id}">
                                <input type="hidden" name="action" value="delete_app_card">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this app card?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                        break;

                    case 'announcements':
                        pageData.forEach(announcement => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${escapeHtml(announcement.title)}</td>
                        <td>${escapeHtml(announcement.content.substring(0, 50))}${announcement.content.length > 50 ? '...' : ''}</td>
                        <td>${announcement.start_date ? formatDate(announcement.start_date) : '-'}</td>
                        <td>${announcement.end_date ? formatDate(announcement.end_date) : '-'}</td>
                        <td><span class="badge ${announcement.is_active ? 'badge-success' : 'badge-danger'}">${announcement.is_active ? 'Active' : 'Inactive'}</span></td>
                        <td>${announcement.sort_order}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-outline" onclick="editAnnouncement(${announcement.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="id" value="${announcement.id}">
                                <input type="hidden" name="action" value="delete_announcement">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                        break;

                    case 'notifications':
                        pageData.forEach(notification => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${escapeHtml(notification.title)}</td>
                        <td>${escapeHtml(notification.message.substring(0, 50))}${notification.message.length > 50 ? '...' : ''}</td>
                        <td><i class="${escapeHtml(notification.icon_class)}"></i></td>
                        <td><span class="badge ${notification.is_active ? 'badge-success' : 'badge-danger'}">${notification.is_active ? 'Active' : 'Inactive'}</span></td>
                        <td>${formatDate(notification.created_at)}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-outline" onclick="editNotification(${notification.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="id" value="${notification.id}">
                                <input type="hidden" name="action" value="delete_notification">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                        break;

                    case 'departments':
                        pageData.forEach(department => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${department.department_id}</td>
                        <td>${escapeHtml(department.department_name)}</td>
                        <td>${escapeHtml(department.description || '')}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-outline" onclick="editDepartment(${department.department_id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="department_id" value="${department.department_id}">
                                <input type="hidden" name="action" value="delete_department">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this department?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                        break;

                    case 'positions':
                        pageData.forEach(position => {
                            const deptName = getDepartmentName(position.department_id);
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${position.position_id}</td>
                        <td>${escapeHtml(position.position_title)}</td>
                        <td>${escapeHtml(deptName)}</td>
                        <td><span class="badge ${position.is_active ? 'badge-success' : 'badge-danger'}">${position.is_active ? 'Active' : 'Inactive'}</span></td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-outline" onclick="editPosition(${position.position_id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="position_id" value="${position.position_id}">
                                <input type="hidden" name="action" value="delete_position">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this position?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                        break;

                    case 'user-management':
                        pageData.forEach(user => {
                            const fullName = `${user.first_name} ${user.middle_name || ''} ${user.last_name}`.trim();
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>
                            <div class="custom-checkbox">
                                <input type="checkbox" class="user-checkbox" value="${user.user_id}" onchange="updateBulkActions()">
                                <span class="checkmark"></span>
                            </div>
                        </td>
                        <td>${user.employee_id}</td>
                        <td>${escapeHtml(fullName || user.full_name)}</td>
                        <td>${escapeHtml(user.username)}</td>
                        <td>${escapeHtml(user.email)}</td>
                        <td><span class="badge badge-info">${escapeHtml(user.role)}</span></td>
                        <td>${escapeHtml(user.department_name || 'N/A')}</td>
                        <td>${escapeHtml(user.position_title || 'N/A')}</td>
                        <td><span class="badge ${user.is_active ? 'badge-success' : 'badge-danger'}">${user.is_active ? 'Active' : 'Inactive'}</span></td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-outline" onclick="editUser(${user.user_id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="user_id" value="${user.user_id}">
                                <input type="hidden" name="action" value="delete_user">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                        break;
                }
            }

            // Update pagination controls
            updatePagination(section, data.length, totalPages);
        }

        function updatePagination(section, totalItems, totalPages) {
            const currentPageNum = currentPage[section];
            const paginationContainer = document.querySelector(`#${section}-section .pagination-container`);

            if (!paginationContainer) {
                // Create pagination container if it doesn't exist
                const cardBody = document.querySelector(`#${section}-section .card-body`);
                if (!cardBody) return;

                const newPaginationContainer = document.createElement('div');
                newPaginationContainer.className = 'pagination-container';
                cardBody.appendChild(newPaginationContainer);
            }

            paginationContainer.innerHTML = `
        <div class="page-info">
            Showing ${((currentPageNum - 1) * itemsPerPage) + 1} to ${Math.min(currentPageNum * itemsPerPage, totalItems)} of ${totalItems} entries
        </div>
        <div class="pagination">
            <button class="btn btn-outline btn-sm" ${currentPageNum === 1 ? 'disabled' : ''} onclick="changePage('${section}', ${currentPageNum - 1})">
                Previous
            </button>
            ${generatePageNumbers(currentPageNum, totalPages, section)}
            <button class="btn btn-outline btn-sm" ${currentPageNum === totalPages ? 'disabled' : ''} onclick="changePage('${section}', ${currentPageNum + 1})">
                Next
            </button>
        </div>
        <div class="export-options">
            <button class="btn btn-success btn-sm" onclick="exportData('${section}', 'csv')">
                <i class="fas fa-download"></i> CSV
            </button>
            <button class="btn btn-success btn-sm" onclick="exportData('${section}', 'excel')">
                <i class="fas fa-download"></i> Excel
            </button>
            <button class="btn btn-success btn-sm" onclick="exportData('${section}', 'pdf')">
                <i class="fas fa-download"></i> PDF
            </button>
            <button class="btn btn-info btn-sm" onclick="printSection('${section}')">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    `;
        }

        function generatePageNumbers(currentPage, totalPages, section) {
            let pagesHTML = '';
            const maxVisiblePages = 5;

            if (totalPages <= maxVisiblePages) {
                // Show all pages
                for (let i = 1; i <= totalPages; i++) {
                    pagesHTML += `
                <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline'}" onclick="changePage('${section}', ${i})">
                    ${i}
                </button>
            `;
                }
            } else {
                // Show limited pages with ellipsis
                if (currentPage <= 3) {
                    for (let i = 1; i <= 4; i++) {
                        pagesHTML += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline'}" onclick="changePage('${section}', ${i})">
                        ${i}
                    </button>
                `;
                    }
                    pagesHTML += `<span class="page-link">...</span>`;
                    pagesHTML += `
                <button class="btn btn-sm btn-outline" onclick="changePage('${section}', ${totalPages})">
                    ${totalPages}
                </button>
            `;
                } else if (currentPage >= totalPages - 2) {
                    pagesHTML += `
                <button class="btn btn-sm btn-outline" onclick="changePage('${section}', 1)">
                    1
                </button>
            `;
                    pagesHTML += `<span class="page-link">...</span>`;
                    for (let i = totalPages - 3; i <= totalPages; i++) {
                        pagesHTML += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline'}" onclick="changePage('${section}', ${i})">
                        ${i}
                    </button>
                `;
                    }
                } else {
                    pagesHTML += `
                <button class="btn btn-sm btn-outline" onclick="changePage('${section}', 1)">
                    1
                </button>
            `;
                    pagesHTML += `<span class="page-link">...</span>`;
                    for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                        pagesHTML += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline'}" onclick="changePage('${section}', ${i})">
                        ${i}
                    </button>
                `;
                    }
                    pagesHTML += `<span class="page-link">...</span>`;
                    pagesHTML += `
                <button class="btn btn-sm btn-outline" onclick="changePage('${section}', ${totalPages})">
                    ${totalPages}
                </button>
            `;
                }
            }

            return pagesHTML;
        }

        function changePage(section, page) {
            currentPage[section] = page;
            filterTable(section);
        }

        function changeView(section, view) {
            const viewButtons = document.querySelectorAll(`#${section}-section .view-option-btn`);
            viewButtons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-view') === view) {
                    btn.classList.add('active');
                }
            });

            const table = document.querySelector(`#${section}-section table`);
            const grid = document.querySelector(`#${section}-section .app-cards-grid`);

            if (view === 'table') {
                if (table) table.style.display = 'table';
                if (grid) grid.style.display = 'none';
            } else if (view === 'grid') {
                if (table) table.style.display = 'none';
                if (grid) grid.style.display = 'grid';
            }
        }

        function exportData(section, format) {
            // This would typically make an AJAX request to an export script
            alert(`Exporting ${section} data in ${format.toUpperCase()} format`);
            // window.location.href = `export.php?section=${section}&format=${format}`;
        }

        function printSection(section) {
            const printContent = document.getElementById(`${section}-section`).innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = `
        <div class="print-header">
            <h1>MERQ Portal - ${section.charAt(0).toUpperCase() + section.slice(1)} Report</h1>
            <p>Generated on: ${new Date().toLocaleString()}</p>
        </div>
        ${printContent}
    `;

            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        }

        // Utility functions
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function getDepartmentName(departmentId) {
            const department = departmentsData.find(dept => dept.department_id == departmentId);
            return department ? department.department_name : 'N/A';
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initSearchAndFilter();

            // Initialize each section
            const sections = ['app-cards', 'announcements', 'notifications', 'departments', 'positions', 'user-management'];
            sections.forEach(section => {
                filterTable(section);
            });

            // Make table headers sortable
            document.querySelectorAll('th[data-field]').forEach(header => {
                header.classList.add('sortable');
                header.addEventListener('click', function() {
                    const section = this.closest('.dashboard-section').id.replace('-section', '');
                    const field = this.getAttribute('data-field');
                    sortTable(section, field);
                });
            });
        });
    </script>
</body>

</html>