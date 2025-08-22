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
            --primary-color: #072247;
            --primary-light: #3c5a82;
            --accent-color: #07cae9;
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
            --neon-green: #00ddff;
            --transition: all 0.3s ease;
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

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding: 1.5rem 0;
            position: fixed;
            height: 100vh;
            transition: var(--transition);
            z-index: 999;
            overflow-y: auto;
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
            transition: var(--transition);
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
            transition: var(--transition);
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
            transition: var(--transition);
        }

        .logout-btn:hover {
            color: var(--error-color);
        }

        /* Apps Grid Styles */
        .apps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
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
            transition: var(--transition);
            text-decoration: none;
            color: var(--text-color);
            position: relative;
            overflow: hidden;
        }

        .app-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .app-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: var(--accent-color);
            transition: var(--transition);
        }

        .app-card:hover::after {
            height: 6px;
        }

        .app-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            color: white;
            transition: var(--transition);
        }

        .app-icon.timesheet {
            background-color: #4299e1;
            background-image: linear-gradient(135deg, #4299e1, #3182ce);
        }

        .app-icon.performance {
            background-color: #9f7aea;
            background-image: linear-gradient(135deg, #9f7aea, #805ad5);
        }

        .app-icon.hr {
            background-color: #f6ad55;
            background-image: linear-gradient(135deg, #f6ad55, #ed8936);
        }

        .app-icon.purchases {
            background-color: #48bb78;
            background-image: linear-gradient(135deg, #48bb78, #38a169);
        }

        .app-icon.finance {
            background-color: #f56565;
            background-image: linear-gradient(135deg, #f56565, #e53e3e);
        }

        .app-icon.it {
            background-color: #667eea;
            background-image: linear-gradient(135deg, #667eea, #5a67d8);
        }

        .app-icon.roster {
            background-color: #ed64a6;
            background-image: linear-gradient(135deg, #ed64a6, #d53f8c);
        }

        .app-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
        }

        .app-card p {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .app-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: var(--accent-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* Quick Stats Styles */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .stat-icon.pending {
            background-color: rgba(246, 173, 85, 0.2);
            color: var(--warning-color);
        }

        .stat-icon.approved {
            background-color: rgba(72, 187, 120, 0.2);
            color: var(--success-color);
        }

        .stat-icon.rejected {
            background-color: rgba(245, 101, 101, 0.2);
            color: var(--error-color);
        }

        .stat-icon.announcements {
            background-color: rgba(66, 153, 225, 0.2);
            color: var(--accent-color);
        }

        .stat-info h4 {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .stat-info p {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
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
            gap: 10px;
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
            width: 100%;
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
            transition: var(--transition);
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
            min-height: auto;
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

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(7, 34, 71, 0.1);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(-20px);
            transition: var(--transition);
            position: relative;
        }

        .modal-overlay.active .modal {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--error-color);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Alert Styles */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert-success {
            background-color: rgba(72, 187, 120, 0.2);
            color: var(--success-color);
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .alert-error {
            background-color: rgba(245, 101, 101, 0.2);
            color: var(--error-color);
            border: 1px solid rgba(245, 101, 101, 0.3);
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: inherit;
        }

        /* Bulk Actions Styles */
        .bulk-actions {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .bulk-select {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 1rem;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 1024px) {
            .apps-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .apps-grid {
                grid-template-columns: 1fr;
            }

            .quick-stats {
                grid-template-columns: 1fr;
            }

            .table-responsive {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }
        }

        /* Animation for modals */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }

            to {
                transform: translateY(0);
            }
        }

        /* Utility Classes */
        .d-none {
            display: none;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .text-center {
            text-align: center;
        }

        /* Custom checkbox styles */
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }

        /* Custom select styles */
        select.form-control {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23072247' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }

        /* Tabs for different sections */
        .tabs {
            display: flex;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .tab {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: var(--transition);
        }

        .tab.active {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 500;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Icon selector styles */
        .icon-selector {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(40px, 1fr));
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .icon-option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 4px;
            background-color: rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: var(--transition);
        }

        .icon-option:hover,
        .icon-option.selected {
            background-color: var(--primary-color);
            color: white;
        }

        /* Color picker styles */
        .color-options {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .color-option.selected {
            border-color: var(--text-color);
            transform: scale(1.1);
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Print styles for export */
        @media print {

            .sidebar,
            .header,
            .card-header,
            .btn,
            .bulk-actions {
                display: none !important;
            }

            .main-content {
                margin-left: 0;
                padding: 0;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>MERQ Portal</h3>
            <p>Admin Dashboard</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-users"></i> User Management</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Help</a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                <a href="../logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <span><?php echo htmlspecialchars($_SESSION['success']);
                        unset($_SESSION['success']); ?></span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <span><?php echo htmlspecialchars($_SESSION['error']);
                        unset($_SESSION['error']); ?></span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        <?php endif; ?>

        <!-- Tabs for different sections -->
        <div class="tabs">
            <div class="tab active" data-tab="dashboard">Dashboard</div>
            <div class="tab" data-tab="users">User Management</div>
            <div class="tab" data-tab="app-cards">App Cards</div>
            <div class="tab" data-tab="announcements">Announcements</div>
            <div class="tab" data-tab="notifications">Notifications</div>
        </div>

        <!-- Dashboard Tab -->
        <div class="tab-content active" id="dashboard-tab">
            <!-- Quick Stats -->
            <div class="quick-stats mb-3">
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Pending Requests</h4>
                        <p>12</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon approved">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Approved Requests</h4>
                        <p>24</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon rejected">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Rejected Requests</h4>
                        <p>5</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon announcements">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Active Announcements</h4>
                        <p><?php echo count($announcements); ?></p>
                    </div>
                </div>
            </div>

            <!-- Apps Grid -->
            <div class="card">
                <div class="card-header">
                    <h2>Applications</h2>
                </div>
                <div class="card-body">
                    <div class="apps-grid">
                        <?php foreach ($appCards as $app): ?>
                            <?php if ($app['is_active']): ?>
                                <a href="<?php echo htmlspecialchars($app['url']); ?>" class="app-card">
                                    <div class="app-icon" style="background-color: <?php echo htmlspecialchars($app['icon_color']); ?>">
                                        <i class="fas <?php echo htmlspecialchars($app['icon_class']); ?>"></i>
                                    </div>
                                    <h3><?php echo htmlspecialchars($app['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($app['description']); ?></p>
                                    <?php if (!empty($app['badge_text'])): ?>
                                        <span class="app-badge"><?php echo htmlspecialchars($app['badge_text']); ?></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="card">
                <div class="card-header">
                    <h2>Announcements</h2>
                    <button class="btn btn-primary" id="addAnnouncementBtn">
                        <i class="fas fa-plus"></i> Add Announcement
                    </button>
                </div>
                <div class="card-body">
                    <?php if (count($announcements) > 0): ?>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($announcements as $announcement): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($announcement['title']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($announcement['content'], 0, 50)); ?>...</td>
                                            <td>
                                                <span class="badge <?php echo $announcement['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?php echo $announcement['is_active'] ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo $announcement['start_date'] ? date('M j, Y', strtotime($announcement['start_date'])) : '-'; ?></td>
                                            <td><?php echo $announcement['end_date'] ? date('M j, Y', strtotime($announcement['end_date'])) : '-'; ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline view-announcement" data-id="<?php echo $announcement['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline edit-announcement" data-id="<?php echo $announcement['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form method="POST" style="display:inline;">
                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                        <input type="hidden" name="id" value="<?php echo $announcement['id']; ?>">
                                                        <input type="hidden" name="action" value="delete_announcement">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">No announcements found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Notifications -->
            <div class="card">
                <div class="card-header">
                    <h2>Notifications</h2>
                    <button class="btn btn-primary" id="addNotificationBtn">
                        <i class="fas fa-plus"></i> Add Notification
                    </button>
                </div>
                <div class="card-body">
                    <?php if (count($notifications) > 0): ?>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notifications as $notification): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($notification['title']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($notification['message'], 0, 50)); ?>...</td>
                                            <td><i class="fas <?php echo htmlspecialchars($notification['icon_class']); ?>"></i></td>
                                            <td>
                                                <span class="badge <?php echo $notification['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?php echo $notification['is_active'] ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M j, Y H:i', strtotime($notification['created_at'])); ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline view-notification" data-id="<?php echo $notification['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline edit-notification" data-id="<?php echo $notification['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form method="POST" style="display:inline;">
                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                        <input type="hidden" name="id" value="<?php echo $notification['id']; ?>">
                                                        <input type="hidden" name="action" value="delete_notification">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this notification?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">No notifications found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- User Management Tab -->
        <div class="tab-content" id="users-tab">
            <div class="card">
                <div class="card-header">
                    <h2>User Management</h2>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" id="addUserBtn">
                            <i class="fas fa-plus"></i> Add User
                        </button>
                        <button class="btn btn-success" id="exportUsersBtn">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Bulk Actions -->
                    <div class="bulk-actions">
                        <div class="bulk-select">
                            <input type="checkbox" id="selectAllUsers">
                            <label for="selectAllUsers">Select All</label>
                        </div>
                        <select id="bulkAction" class="form-control" style="width: auto;">
                            <option value="">Bulk Actions</option>
                            <option value="activate">Activate</option>
                            <option value="deactivate">Deactivate</option>
                            <option value="update_department">Update Department</option>
                            <option value="update_position">Update Position</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-primary" id="applyBulkAction">Apply</button>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
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
                                        <td><input type="checkbox" class="user-checkbox" value="<?php echo $user['user_id']; ?>"></td>
                                        <td><?php echo htmlspecialchars($user['employee_id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        <td><?php echo htmlspecialchars($user['department_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($user['position_title'] ?? 'N/A'); ?></td>
                                        <td>
                                            <span class="badge <?php echo $user['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-outline view-user" data-id="<?php echo $user['user_id']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline edit-user" data-id="<?php echo $user['user_id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                    <input type="hidden" name="action" value="delete_user">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Cards Tab -->
        <div class="tab-content" id="app-cards-tab">
            <div class="card">
                <div class="card-header">
                    <h2>Application Cards</h2>
                    <button class="btn btn-primary" id="addAppCardBtn">
                        <i class="fas fa-plus"></i> Add App Card
                    </button>
                </div>
                <div class="card-body">
                    <div class="apps-grid">
                        <?php foreach ($appCards as $app): ?>
                            <div class="app-card">
                                <div class="app-icon" style="background-color: <?php echo htmlspecialchars($app['icon_color']); ?>">
                                    <i class="fas <?php echo htmlspecialchars($app['icon_class']); ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($app['title']); ?></h3>
                                <p><?php echo htmlspecialchars($app['description']); ?></p>
                                <?php if (!empty($app['badge_text'])): ?>
                                    <span class="app-badge"><?php echo htmlspecialchars($app['badge_text']); ?></span>
                                <?php endif; ?>
                                <div class="mt-3 d-flex gap-2">
                                    <button class="btn btn-sm btn-outline edit-app-card" data-id="<?php echo $app['id']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $app['id']; ?>">
                                        <input type="hidden" name="action" value="delete_app_card">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this app card?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Announcements Tab -->
        <div class="tab-content" id="announcements-tab">
            <div class="card">
                <div class="card-header">
                    <h2>Announcements</h2>
                    <button class="btn btn-primary" id="addAnnouncementBtn2">
                        <i class="fas fa-plus"></i> Add Announcement
                    </button>
                </div>
                <div class="card-body">
                    <?php if (count($announcements) > 0): ?>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Sort Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($announcements as $announcement): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($announcement['title']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($announcement['content'], 0, 50)); ?>...</td>
                                            <td>
                                                <span class="badge <?php echo $announcement['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?php echo $announcement['is_active'] ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo $announcement['start_date'] ? date('M j, Y', strtotime($announcement['start_date'])) : '-'; ?></td>
                                            <td><?php echo $announcement['end_date'] ? date('M j, Y', strtotime($announcement['end_date'])) : '-'; ?></td>
                                            <td><?php echo $announcement['sort_order']; ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline view-announcement" data-id="<?php echo $announcement['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline edit-announcement" data-id="<?php echo $announcement['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form method="POST" style="display:inline;">
                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                        <input type="hidden" name="id" value="<?php echo $announcement['id']; ?>">
                                                        <input type="hidden" name="action" value="delete_announcement">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">No announcements found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Notifications Tab -->
        <div class="tab-content" id="notifications-tab">
            <div class="card">
                <div class="card-header">
                    <h2>Notifications</h2>
                    <button class="btn btn-primary" id="addNotificationBtn2">
                        <i class="fas fa-plus"></i> Add Notification
                    </button>
                </div>
                <div class="card-body">
                    <?php if (count($notifications) > 0): ?>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notifications as $notification): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($notification['title']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($notification['message'], 0, 50)); ?>...</td>
                                            <td><i class="fas <?php echo htmlspecialchars($notification['icon_class']); ?>"></i></td>
                                            <td>
                                                <span class="badge <?php echo $notification['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?php echo $notification['is_active'] ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M j, Y H:i', strtotime($notification['created_at'])); ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline view-notification" data-id="<?php echo $notification['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline edit-notification" data-id="<?php echo $notification['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form method="POST" style="display:inline;">
                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                        <input type="hidden" name="id" value="<?php echo $notification['id']; ?>">
                                                        <input type="hidden" name="action" value="delete_notification">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this notification?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">No notifications found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Add User Modal -->
    <div class="modal-overlay" id="addUserModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Add New User</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_user">

                    <div class="form-group">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="employee_id" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Is Doctor?</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_doctor" value="1">
                            <label class="form-check-label">Yes</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alternate Phone</label>
                        <input type="text" class="form-control" name="alternate_phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select class="form-control" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Administrator</option>
                            <option value="manager">Manager</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <select class="form-control" name="department_id">
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept['department_id']; ?>"><?php echo htmlspecialchars($dept['department_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Position</label>
                        <select class="form-control" name="position_id">
                            <option value="">Select Position</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?php echo $pos['position_id']; ?>"><?php echo htmlspecialchars($pos['position_title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Supervisor</label>
                        <select class="form-control" name="supervisor_id">
                            <option value="">Select Supervisor</option>
                            <?php foreach ($supervisors as $sup): ?>
                                <option value="<?php echo $sup['user_id']; ?>"><?php echo htmlspecialchars($sup['full_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Join Date</label>
                        <input type="date" class="form-control" name="join_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Hire Date</label>
                        <input type="date" class="form-control" name="hire_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Leave Balance</label>
                        <input type="number" step="0.5" class="form-control" name="leave_balance" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal-overlay" id="editUserModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" name="user_id" id="edit_user_id">

                    <div class="form-group">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="employee_id" id="edit_employee_id" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Is Doctor?</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_doctor" id="edit_is_doctor" value="1">
                            <label class="form-check-label">Yes</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="edit_first_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" id="edit_middle_name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="edit_last_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="edit_username" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="edit_phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alternate Phone</label>
                        <input type="text" class="form-control" name="alternate_phone" id="edit_alternate_phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select class="form-control" name="role" id="edit_role" required>
                            <option value="user">User</option>
                            <option value="admin">Administrator</option>
                            <option value="manager">Manager</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <select class="form-control" name="department_id" id="edit_department_id">
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept['department_id']; ?>"><?php echo htmlspecialchars($dept['department_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Position</label>
                        <select class="form-control" name="position_id" id="edit_position_id">
                            <option value="">Select Position</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?php echo $pos['position_id']; ?>"><?php echo htmlspecialchars($pos['position_title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Supervisor</label>
                        <select class="form-control" name="supervisor_id" id="edit_supervisor_id">
                            <option value="">Select Supervisor</option>
                            <?php foreach ($supervisors as $sup): ?>
                                <option value="<?php echo $sup['user_id']; ?>"><?php echo htmlspecialchars($sup['full_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Join Date</label>
                        <input type="date" class="form-control" name="join_date" id="edit_join_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Hire Date</label>
                        <input type="date" class="form-control" name="hire_date" id="edit_hire_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Leave Balance</label>
                        <input type="number" step="0.5" class="form-control" name="leave_balance" id="edit_leave_balance" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" id="edit_is_active" value="1">
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View User Modal -->
    <div class="modal-overlay" id="viewUserModal">
        <div class="modal">
            <div class="modal-header">
                <h3>User Details</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Employee ID</label>
                    <p id="view_employee_id"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Is Doctor?</label>
                    <p id="view_is_doctor"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <p id="view_full_name"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <p id="view_username"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <p id="view_email"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <p id="view_phone"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Alternate Phone</label>
                    <p id="view_alternate_phone"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <p id="view_role"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Department</label>
                    <p id="view_department"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Position</label>
                    <p id="view_position"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Supervisor</label>
                    <p id="view_supervisor"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Join Date</label>
                    <p id="view_join_date"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Hire Date</label>
                    <p id="view_hire_date"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Leave Balance</label>
                    <p id="view_leave_balance"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <p id="view_status"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Last Login</label>
                    <p id="view_last_login"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline modal-close">Close</button>
            </div>
        </div>
    </div>

    <!-- Add App Card Modal -->
    <div class="modal-overlay" id="addAppCardModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Add Application Card</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_app_card">

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control" name="url" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Class</label>
                        <select class="form-control" name="icon_class" id="icon_class_select" required>
                            <option value="">Select an icon</option>
                            <?php foreach ($iconClasses as $icon): ?>
                                <option value="<?php echo $icon; ?>"><?php echo $icon; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Preview</label>
                        <div id="icon_preview" style="font-size: 2rem; text-align: center; padding: 1rem; background: #f7fafc; border-radius: 8px;">
                            <i class="fas"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Color</label>
                        <input type="color" class="form-control" name="icon_color" value="#4299e1" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Badge Text (optional)</label>
                        <input type="text" class="form-control" name="badge_text">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add App Card</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit App Card Modal -->
    <div class="modal-overlay" id="editAppCardModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Edit Application Card</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_app_card">
                    <input type="hidden" name="id" id="edit_app_card_id">

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="edit_app_card_title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_app_card_description" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control" name="url" id="edit_app_card_url" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Class</label>
                        <select class="form-control" name="icon_class" id="edit_app_card_icon_class" required>
                            <option value="">Select an icon</option>
                            <?php foreach ($iconClasses as $icon): ?>
                                <option value="<?php echo $icon; ?>"><?php echo $icon; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Preview</label>
                        <div id="edit_icon_preview" style="font-size: 2rem; text-align: center; padding: 1rem; background: #f7fafc; border-radius: 8px;">
                            <i class="fas"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Color</label>
                        <input type="color" class="form-control" name="icon_color" id="edit_app_card_icon_color" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Badge Text (optional)</label>
                        <input type="text" class="form-control" name="badge_text" id="edit_app_card_badge_text">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="edit_app_card_sort_order" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" id="edit_app_card_is_active" value="1">
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update App Card</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Announcement Modal -->
    <div class="modal-overlay" id="addAnnouncementModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Add Announcement</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_announcement">

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Start Date (optional)</label>
                        <input type="date" class="form-control" name="start_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date (optional)</label>
                        <input type="date" class="form-control" name="end_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Announcement</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Announcement Modal -->
    <div class="modal-overlay" id="editAnnouncementModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Edit Announcement</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_announcement">
                    <input type="hidden" name="id" id="edit_announcement_id">

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="edit_announcement_title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="edit_announcement_content" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Start Date (optional)</label>
                        <input type="date" class="form-control" name="start_date" id="edit_announcement_start_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date (optional)</label>
                        <input type="date" class="form-control" name="end_date" id="edit_announcement_end_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="edit_announcement_sort_order" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" id="edit_announcement_is_active" value="1">
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Announcement</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Announcement Modal -->
    <div class="modal-overlay" id="viewAnnouncementModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Announcement Details</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <p id="view_announcement_title"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Content</label>
                    <p id="view_announcement_content" style="white-space: pre-wrap;"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <p id="view_announcement_start_date"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <p id="view_announcement_end_date"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <p id="view_announcement_sort_order"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <p id="view_announcement_status"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline modal-close">Close</button>
            </div>
        </div>
    </div>

    <!-- Add Notification Modal -->
    <div class="modal-overlay" id="addNotificationModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Add Notification</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="add_notification">

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Class</label>
                        <select class="form-control" name="icon_class" required>
                            <option value="fa-bell">Default (fa-bell)</option>
                            <option value="fa-info-circle">Info (fa-info-circle)</option>
                            <option value="fa-exclamation-circle">Warning (fa-exclamation-circle)</option>
                            <option value="fa-check-circle">Success (fa-check-circle)</option>
                            <option value="fa-times-circle">Error (fa-times-circle)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Notification</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Notification Modal -->
    <div class="modal-overlay" id="editNotificationModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Edit Notification</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="update_notification">
                    <input type="hidden" name="id" id="edit_notification_id">

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="edit_notification_title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" id="edit_notification_message" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icon Class</label>
                        <select class="form-control" name="icon_class" id="edit_notification_icon_class" required>
                            <option value="fa-bell">Default (fa-bell)</option>
                            <option value="fa-info-circle">Info (fa-info-circle)</option>
                            <option value="fa-exclamation-circle">Warning (fa-exclamation-circle)</option>
                            <option value="fa-check-circle">Success (fa-check-circle)</option>
                            <option value="fa-times-circle">Error (fa-times-circle)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" id="edit_notification_is_active" value="1">
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Notification</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Notification Modal -->
    <div class="modal-overlay" id="viewNotificationModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Notification Details</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <p id="view_notification_title"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Message</label>
                    <p id="view_notification_message" style="white-space: pre-wrap;"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Icon</label>
                    <p><i class="fas" id="view_notification_icon"></i> <span id="view_notification_icon_class"></span></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <p id="view_notification_status"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Created At</label>
                    <p id="view_notification_created_at"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline modal-close">Close</button>
            </div>
        </div>
    </div>

    <!-- Bulk Update Modal -->
    <div class="modal-overlay" id="bulkUpdateModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Bulk Update Users</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST" id="bulkUpdateForm">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="bulk_update_users">
                    <input type="hidden" name="user_ids" id="bulk_user_ids">

                    <div class="form-group">
                        <label class="form-label">Field to Update</label>
                        <select class="form-control" name="field" id="bulk_field" required>
                            <option value="">Select Field</option>
                            <option value="department_id">Department</option>
                            <option value="position_id">Position</option>
                            <option value="supervisor_id">Supervisor</option>
                            <option value="role">Role</option>
                            <option value="is_active">Status</option>
                            <option value="leave_balance">Leave Balance</option>
                        </select>
                    </div>

                    <div class="form-group" id="bulk_value_container">
                        <label class="form-label">New Value</label>
                        <!-- This will be populated dynamically based on the selected field -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Users</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bulk Delete Modal -->
    <div class="modal-overlay" id="bulkDeleteModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Confirm Bulk Delete</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="bulk_delete_users">
                    <input type="hidden" name="user_ids" id="bulk_delete_user_ids">

                    <p>Are you sure you want to delete <span id="bulk_delete_count">0</span> selected users? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline modal-close">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Users</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
                    if (!sidebar.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Tab functionality
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabName = this.getAttribute('data-tab');

                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Show corresponding content
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === `${tabName}-tab`) {
                            content.classList.add('active');
                        }
                    });
                });
            });

            // Modal functionality
            const modals = document.querySelectorAll('.modal-overlay');
            const modalCloseButtons = document.querySelectorAll('.modal-close');

            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    // Close any other open modals first
                    modals.forEach(m => m.classList.remove('active'));

                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeModals() {
                modals.forEach(modal => {
                    modal.classList.remove('active');
                });
                document.body.style.overflow = 'auto';
            }

            modalCloseButtons.forEach(button => {
                button.addEventListener('click', closeModals);
            });

            modals.forEach(modal => {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeModals();
                    }
                });
            });

            // User management modals
            const addUserBtn = document.getElementById('addUserBtn');
            if (addUserBtn) {
                addUserBtn.addEventListener('click', function() {
                    openModal('addUserModal');
                });
            }

            // Edit user buttons
            const editUserButtons = document.querySelectorAll('.edit-user');
            editUserButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    // Fetch user data and populate the form
                    fetchUserData(userId).then(user => {
                        if (user) {
                            document.getElementById('edit_user_id').value = user.user_id;
                            document.getElementById('edit_employee_id').value = user.employee_id;
                            document.getElementById('edit_is_doctor').checked = user.is_doctor == 1;
                            document.getElementById('edit_first_name').value = user.first_name;
                            document.getElementById('edit_middle_name').value = user.middle_name || '';
                            document.getElementById('edit_last_name').value = user.last_name;
                            document.getElementById('edit_username').value = user.username;
                            document.getElementById('edit_email').value = user.email;
                            document.getElementById('edit_phone').value = user.phone || '';
                            document.getElementById('edit_alternate_phone').value = user.alternate_phone || '';
                            document.getElementById('edit_role').value = user.role;
                            document.getElementById('edit_department_id').value = user.department_id || '';
                            document.getElementById('edit_position_id').value = user.position_id || '';
                            document.getElementById('edit_supervisor_id').value = user.supervisor_id || '';
                            document.getElementById('edit_join_date').value = user.join_date || '';
                            document.getElementById('edit_hire_date').value = user.hire_date || '';
                            document.getElementById('edit_leave_balance').value = user.leave_balance;
                            document.getElementById('edit_is_active').checked = user.is_active == 1;

                            openModal('editUserModal');
                        }
                    });
                });
            });

            // View user buttons
            const viewUserButtons = document.querySelectorAll('.view-user');
            viewUserButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    // Fetch user data and populate the view
                    fetchUserData(userId).then(user => {
                        if (user) {
                            document.getElementById('view_employee_id').textContent = user.employee_id;
                            document.getElementById('view_is_doctor').textContent = user.is_doctor ? 'Yes' : 'No';
                            document.getElementById('view_full_name').textContent = user.full_name;
                            document.getElementById('view_username').textContent = user.username;
                            document.getElementById('view_email').textContent = user.email;
                            document.getElementById('view_phone').textContent = user.phone || 'N/A';
                            document.getElementById('view_alternate_phone').textContent = user.alternate_phone || 'N/A';
                            document.getElementById('view_role').textContent = user.role;
                            document.getElementById('view_department').textContent = user.department_name || 'N/A';
                            document.getElementById('view_position').textContent = user.position_title || 'N/A';
                            document.getElementById('view_supervisor').textContent = user.supervisor_name || 'N/A';
                            document.getElementById('view_join_date').textContent = user.join_date ? new Date(user.join_date).toLocaleDateString() : 'N/A';
                            document.getElementById('view_hire_date').textContent = user.hire_date ? new Date(user.hire_date).toLocaleDateString() : 'N/A';
                            document.getElementById('view_leave_balance').textContent = user.leave_balance;
                            document.getElementById('view_status').textContent = user.is_active ? 'Active' : 'Inactive';
                            document.getElementById('view_last_login').textContent = user.last_login ? new Date(user.last_login).toLocaleString() : 'Never';

                            openModal('viewUserModal');
                        }
                    });
                });
            });

            // App card modals
            const addAppCardBtn = document.getElementById('addAppCardBtn');
            if (addAppCardBtn) {
                addAppCardBtn.addEventListener('click', function() {
                    openModal('addAppCardModal');
                });
            }

            // Edit app card buttons
            const editAppCardButtons = document.querySelectorAll('.edit-app-card');
            editAppCardButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const cardId = this.getAttribute('data-id');
                    // Fetch app card data and populate the form
                    fetchAppCardData(cardId).then(card => {
                        if (card) {
                            document.getElementById('edit_app_card_id').value = card.id;
                            document.getElementById('edit_app_card_title').value = card.title;
                            document.getElementById('edit_app_card_description').value = card.description;
                            document.getElementById('edit_app_card_url').value = card.url;
                            document.getElementById('edit_app_card_icon_class').value = card.icon_class;
                            document.getElementById('edit_app_card_icon_color').value = card.icon_color;
                            document.getElementById('edit_app_card_badge_text').value = card.badge_text || '';
                            document.getElementById('edit_app_card_sort_order').value = card.sort_order;
                            document.getElementById('edit_app_card_is_active').checked = card.is_active == 1;

                            // Update icon preview
                            const iconPreview = document.getElementById('edit_icon_preview');
                            iconPreview.innerHTML = `<i class="fas ${card.icon_class}" style="color: ${card.icon_color};"></i>`;

                            openModal('editAppCardModal');
                        }
                    });
                });
            });

            // Announcement modals
            const addAnnouncementBtn = document.getElementById('addAnnouncementBtn');
            const addAnnouncementBtn2 = document.getElementById('addAnnouncementBtn2');

            if (addAnnouncementBtn) {
                addAnnouncementBtn.addEventListener('click', function() {
                    openModal('addAnnouncementModal');
                });
            }

            if (addAnnouncementBtn2) {
                addAnnouncementBtn2.addEventListener('click', function() {
                    openModal('addAnnouncementModal');
                });
            }

            // Edit announcement buttons
            const editAnnouncementButtons = document.querySelectorAll('.edit-announcement');
            editAnnouncementButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const announcementId = this.getAttribute('data-id');
                    // Fetch announcement data and populate the form
                    fetchAnnouncementData(announcementId).then(announcement => {
                        if (announcement) {
                            document.getElementById('edit_announcement_id').value = announcement.id;
                            document.getElementById('edit_announcement_title').value = announcement.title;
                            document.getElementById('edit_announcement_content').value = announcement.content;
                            document.getElementById('edit_announcement_start_date').value = announcement.start_date || '';
                            document.getElementById('edit_announcement_end_date').value = announcement.end_date || '';
                            document.getElementById('edit_announcement_sort_order').value = announcement.sort_order;
                            document.getElementById('edit_announcement_is_active').checked = announcement.is_active == 1;

                            openModal('editAnnouncementModal');
                        }
                    });
                });
            });

            // View announcement buttons
            const viewAnnouncementButtons = document.querySelectorAll('.view-announcement');
            viewAnnouncementButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const announcementId = this.getAttribute('data-id');
                    // Fetch announcement data and populate the view
                    fetchAnnouncementData(announcementId).then(announcement => {
                        if (announcement) {
                            document.getElementById('view_announcement_title').textContent = announcement.title;
                            document.getElementById('view_announcement_content').textContent = announcement.content;
                            document.getElementById('view_announcement_start_date').textContent = announcement.start_date ? new Date(announcement.start_date).toLocaleDateString() : 'Not set';
                            document.getElementById('view_announcement_end_date').textContent = announcement.end_date ? new Date(announcement.end_date).toLocaleDateString() : 'Not set';
                            document.getElementById('view_announcement_sort_order').textContent = announcement.sort_order;
                            document.getElementById('view_announcement_status').textContent = announcement.is_active ? 'Active' : 'Inactive';

                            openModal('viewAnnouncementModal');
                        }
                    });
                });
            });

            // Notification modals
            const addNotificationBtn = document.getElementById('addNotificationBtn');
            const addNotificationBtn2 = document.getElementById('addNotificationBtn2');

            if (addNotificationBtn) {
                addNotificationBtn.addEventListener('click', function() {
                    openModal('addNotificationModal');
                });
            }

            if (addNotificationBtn2) {
                addNotificationBtn2.addEventListener('click', function() {
                    openModal('addNotificationModal');
                });
            }

            // Edit notification buttons
            const editNotificationButtons = document.querySelectorAll('.edit-notification');
            editNotificationButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const notificationId = this.getAttribute('data-id');
                    // Fetch notification data and populate the form
                    fetchNotificationData(notificationId).then(notification => {
                        if (notification) {
                            document.getElementById('edit_notification_id').value = notification.id;
                            document.getElementById('edit_notification_title').value = notification.title;
                            document.getElementById('edit_notification_message').value = notification.message;
                            document.getElementById('edit_notification_icon_class').value = notification.icon_class;
                            document.getElementById('edit_notification_is_active').checked = notification.is_active == 1;

                            openModal('editNotificationModal');
                        }
                    });
                });
            });

            // View notification buttons
            const viewNotificationButtons = document.querySelectorAll('.view-notification');
            viewNotificationButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const notificationId = this.getAttribute('data-id');
                    // Fetch notification data and populate the view
                    fetchNotificationData(notificationId).then(notification => {
                        if (notification) {
                            document.getElementById('view_notification_title').textContent = notification.title;
                            document.getElementById('view_notification_message').textContent = notification.message;
                            document.getElementById('view_notification_icon').className = `fas ${notification.icon_class}`;
                            document.getElementById('view_notification_icon_class').textContent = notification.icon_class;
                            document.getElementById('view_notification_status').textContent = notification.is_active ? 'Active' : 'Inactive';
                            document.getElementById('view_notification_created_at').textContent = new Date(notification.created_at).toLocaleString();

                            openModal('viewNotificationModal');
                        }
                    });
                });
            });

            // Icon preview functionality
            const iconClassSelect = document.getElementById('icon_class_select');
            const iconPreview = document.getElementById('icon_preview');

            if (iconClassSelect && iconPreview) {
                iconClassSelect.addEventListener('change', function() {
                    const iconClass = this.value;
                    if (iconClass) {
                        iconPreview.innerHTML = `<i class="fas ${iconClass}"></i>`;
                    } else {
                        iconPreview.innerHTML = '<i class="fas"></i>';
                    }
                });
            }

            const editIconClassSelect = document.getElementById('edit_app_card_icon_class');
            const editIconPreview = document.getElementById('edit_icon_preview');
            const editIconColor = document.getElementById('edit_app_card_icon_color');

            if (editIconClassSelect && editIconPreview && editIconColor) {
                editIconClassSelect.addEventListener('change', updateEditIconPreview);
                editIconColor.addEventListener('change', updateEditIconPreview);

                function updateEditIconPreview() {
                    const iconClass = editIconClassSelect.value;
                    const iconColor = editIconColor.value;

                    if (iconClass) {
                        editIconPreview.innerHTML = `<i class="fas ${iconClass}" style="color: ${iconColor};"></i>`;
                    } else {
                        editIconPreview.innerHTML = '<i class="fas"></i>';
                    }
                }
            }

            // Bulk actions functionality
            const selectAllCheckbox = document.getElementById('selectAllUsers');
            const userCheckboxes = document.querySelectorAll('.user-checkbox');
            const bulkActionSelect = document.getElementById('bulkAction');
            const applyBulkActionBtn = document.getElementById('applyBulkAction');
            const exportUsersBtn = document.getElementById('exportUsersBtn');

            if (selectAllCheckbox && userCheckboxes.length > 0) {
                selectAllCheckbox.addEventListener('change', function() {
                    userCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            if (applyBulkActionBtn && bulkActionSelect && userCheckboxes.length > 0) {
                applyBulkActionBtn.addEventListener('click', function() {
                    const selectedUserIds = Array.from(userCheckboxes)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => checkbox.value);

                    if (selectedUserIds.length === 0) {
                        alert('Please select at least one user.');
                        return;
                    }

                    const action = bulkActionSelect.value;
                    if (!action) {
                        alert('Please select a bulk action.');
                        return;
                    }

                    if (action === 'delete') {
                        document.getElementById('bulk_delete_user_ids').value = selectedUserIds.join(',');
                        document.getElementById('bulk_delete_count').textContent = selectedUserIds.length;
                        openModal('bulkDeleteModal');
                    } else {
                        document.getElementById('bulk_user_ids').value = selectedUserIds.join(',');

                        // Set up the bulk update form based on the selected action
                        const bulkField = document.getElementById('bulk_field');
                        const bulkValueContainer = document.getElementById('bulk_value_container');

                        // Clear previous content
                        bulkValueContainer.innerHTML = '';

                        // Set the field to update
                        bulkField.value = action;

                        // Create appropriate input based on the field
                        let inputHtml = '';

                        switch (action) {
                            case 'department_id':
                                inputHtml = `
                                    <select class="form-control" name="value" required>
                                        <option value="">Select Department</option>
                                        <?php foreach ($departments as $dept): ?>
                                            <option value="<?php echo $dept['department_id']; ?>"><?php echo htmlspecialchars($dept['department_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                `;
                                break;

                            case 'position_id':
                                inputHtml = `
                                    <select class="form-control" name="value" required>
                                        <option value="">Select Position</option>
                                        <?php foreach ($positions as $pos): ?>
                                            <option value="<?php echo $pos['position_id']; ?>"><?php echo htmlspecialchars($pos['position_title']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                `;
                                break;

                            case 'supervisor_id':
                                inputHtml = `
                                    <select class="form-control" name="value" required>
                                        <option value="">Select Supervisor</option>
                                        <?php foreach ($supervisors as $sup): ?>
                                            <option value="<?php echo $sup['user_id']; ?>"><?php echo htmlspecialchars($sup['full_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                `;
                                break;

                            case 'role':
                                inputHtml = `
                                    <select class="form-control" name="value" required>
                                        <option value="user">User</option>
                                        <option value="admin">Administrator</option>
                                        <option value="manager">Manager</option>
                                        <option value="hr">HR</option>
                                    </select>
                                `;
                                break;

                            case 'is_active':
                                inputHtml = `
                                    <select class="form-control" name="value" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                `;
                                break;

                            case 'leave_balance':
                                inputHtml = `
                                    <input type="number" step="0.5" class="form-control" name="value" required>
                                `;
                                break;

                            default:
                                inputHtml = `<input type="text" class="form-control" name="value" required>`;
                        }

                        bulkValueContainer.innerHTML = `<label class="form-label">New Value</label>${inputHtml}`;

                        openModal('bulkUpdateModal');
                    }
                });
            }

            if (exportUsersBtn) {
                exportUsersBtn.addEventListener('click', function() {
                    // Get all selected user IDs or all users if none selected
                    const selectedUserIds = Array.from(userCheckboxes)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => checkbox.value);

                    let url = '../includes/export-users.php';
                    if (selectedUserIds.length > 0) {
                        url += '?user_ids=' + selectedUserIds.join(',');
                    }

                    window.location.href = url;
                });
            }

            // Close alert buttons
            const alertCloseButtons = document.querySelectorAll('.alert-close');
            alertCloseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.style.display = 'none';
                });
            });

            // Helper functions to fetch data
            async function fetchUserData(userId) {
                try {
                    const response = await fetch(`/includes/get-data.php?id=${userId}`);
                    if (response.ok) {
                        return await response.json();
                    }
                } catch (error) {
                    console.error('Error fetching user data:', error);
                }
                return null;
            }

            async function fetchAppCardData(cardId) {
                try {
                    const response = await fetch(`../api/get_app_card.php?id=${cardId}`);
                    if (response.ok) {
                        return await response.json();
                    }
                } catch (error) {
                    console.error('Error fetching app card data:', error);
                }
                return null;
            }

            async function fetchAnnouncementData(announcementId) {
                try {
                    const response = await fetch(`../api/get_announcement.php?id=${announcementId}`);
                    if (response.ok) {
                        return await response.json();
                    }
                } catch (error) {
                    console.error('Error fetching announcement data:', error);
                }
                return null;
            }

            async function fetchNotificationData(notificationId) {
                try {
                    const response = await fetch(`../api/get_notification.php?id=${notificationId}`);
                    if (response.ok) {
                        return await response.json();
                    }
                } catch (error) {
                    console.error('Error fetching notification data:', error);
                }
                return null;
            }
        });
    </script>
</body>

</html>