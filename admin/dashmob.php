<?php
// Include session configuration first
require_once __DIR__ . '/../includes/session-config.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

requireAdmin(); // This will redirect non-admins to login

//requireAuth(true); // true means admin only

/*
// At the top of any admin page
require_once 'config.php';
require_once 'functions.php';

// Check if user is admin
if (!IS_ADMIN) {
    $_SESSION['error'] = 'Administrator privileges required';
    header('Location: login.php');
    exit;
}
*/

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

//$users = $pdo->query("SELECT user_id, username, full_name, email, last_login FROM users ORDER BY username")->fetchAll();
//$users = $pdo->query("SELECT user_id, username, full_name, email, role, job_position, last_login FROM users ORDER BY username")->fetchAll();

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
            padding: 0 4.5rem 1.5rem;
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
            align-items: flex-start;
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


        /* Digital Clock Styles */
        .digital-clock {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--neon-green);
            padding: 10px 15px;
            border-radius: var(--border-radius);
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 7px;
            box-shadow: var(--shadow);
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


            /* Override earlier mobile rule that hid labels when sidebar collapsed */
            .sidebar-header h3,
            .sidebar-menu span {
                display: inline !important;
            }

            .sidebar-menu i {
                margin-right: 0.75rem !important;
                font-size: 1rem;
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
            justify-content: flex-start;
                padding: 1rem;
            }

            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {

            .digital-clock {
                display: contents;
                font-family: 'Courier New', monospace;
                background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
                color: var(--neon-green);
                padding: 10px 15px;
                border-radius: var(--border-radius);
                display: inline-block;
                margin-right: 15px;
                margin-bottom: 7px;
                box-shadow: var(--shadow);
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                margin-bottom: 1.5rem;
            }

            .sidebar-menu {
                display: contents;
                overflow-x: auto;
            }

            .sidebar-menu li {
                flex: 0 0 auto;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Mobile Optimization */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                margin-bottom: 1.5rem;
            }



            .sidebar-menu li {
                flex: 0 0 auto;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                min-width: 600px;
            }

            .modal-dialog {
                margin: 1rem;
                width: auto;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .user-info {
                justify-content: center;
            }
        }

        /* Advanced User Management Styles */

        /* Hide the dropdown menus by default */
        .dropdown-menu {
            display: none;
            /* Ensure the dropdowns are hidden by default */
            min-width: 200px;
            z-index: 1000;
            padding: 0;
            border-radius: 4px;
        }

        /* Show the dropdown when the 'active' class is added */
        .dropdown.active .dropdown-menu {
            display: block;
            /* This makes the dropdown visible when the button is clicked */
        }

        .pagination {
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
        }

        .page-item {
            display: inline-block;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .page-link {
            color: var(--primary-color);
            padding: 5px 10px;
            border: 1px solid var(--primary-color);
            border-radius: 4px;
            text-decoration: none;
        }

        .page-link:hover {
            color: var(--primary-light);
            border-color: var(--primary-light);
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sort-icon {
            cursor: pointer;
            margin-left: 5px;
            font-size: 12px;
        }

        .detail-group {
            margin-bottom: 1rem;
        }

        .detail-group label {
            font-weight: 500;
            display: block;
            margin-bottom: 0.25rem;
            color: var(--text-light);
        }

        .detail-group span {
            display: block;
        }

        /* Bulk Actions Dropdown */
        #bulkActionsDropdown,
        #exportDropdown {
            min-width: 180px;
            font-size: 14px;
        }

        .dropdown-menu {
            z-index: 1000;
        }

        #filtersSection {
            background-color: rgba(0, 0, 0, 0.02);
            border-radius: var(--border-radius);
            padding: 1rem;
        }

        .user-checkbox {
            margin: 0;
        }

        #usersTable th {
            position: relative;
            cursor: pointer;
        }

        #usersTable th:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Make the bulk actions and export dropdowns responsive */
        .dropdown-toggle {
            min-width: 120px;
            font-size: 14px;
        }

        /* Print styles for user details */
        @media print {
            body * {
                visibility: hidden;
            }

            #userDetailsContent,
            #userDetailsContent * {
                visibility: visible;
            }

            #userDetailsContent {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            padding: 10px 0;
        }

        .page-link {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            border: 1px solid var(--primary-color);
            border-radius: 4px;
            text-align: center;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            color: white;
        }

        .page-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .page-item.disabled .page-link {
            color: #ccc;
            pointer-events: none;
        }

        /* Bulk Actions Dropdown Styling */
        #bulkActionsDropdown,
        #exportDropdown {
            min-width: 180px;
        }

        .dropdown-item {
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .dropdown-menu {
            min-width: 200px;
            z-index: 1000;
            padding: 0;
            border-radius: 4px;
        }

        .dropdown-menu.show {
            display: block !important;
        }

        /* Improved Dropdown for Small Screens */
        @media (max-width: 768px) {

            #bulkActionsDropdown,
            #exportDropdown {
                width: 100%;
            }

            .dropdown-item {
                padding: 8px 12px;
            }

            .dropdown-menu {
                width: 100%;
            }
        }

        /* Modify the dropdown to handle mobile properly */
        @media (max-width: 576px) {

            #bulkActionsDropdown,
            #exportDropdown {
                width: 100%;
            }

            .dropdown-item {
                padding: 10px;
                text-align: left;
            }
        }

        /* Styles for active dropdowns when clicked */
        #bulkActionsDropdown.active .dropdown-menu,
        #exportDropdown.active .dropdown-menu {
            display: block;
        }

        /* Mobile Styles for Bulk Actions and Pagination */
        @media (max-width: 768px) {
            .pagination {
                flex-wrap: wrap;
                gap: 10px;
            }

            .pagination .page-link {
                font-size: 12px;
                padding: 5px 8px;
            }

            .dropdown {
                display: block;
                margin-bottom: 10px;
            }

            .dropdown-menu {
                width: 100%;
                padding: 5px;
            }

            .btn,
            .dropdown-toggle {
                font-size: 12px;
                padding: 8px 10px;
                width: 100%;
                margin: 0;
                text-align: left;
            }
        }

        /* Small screen styling for action buttons */
        @media (max-width: 576px) {
            .btn {
                font-size: 12px;
                padding: 8px;
                width: 100%;
            }

            .dropdown-menu {
                width: 100%;
            }
        }

        /* Styling for per-page select dropdown */
        #perPage {
            max-width: 150px;
            font-size: 14px;
        }

        #paginationInfo,
        #paginationInfoBottom {
            font-size: 14px;
        }

        /* Improved Table Responsiveness */
        @media (max-width: 992px) {

            #usersTable th,
            #usersTable td {
                font-size: 12px;
                padding: 8px;
            }

            #usersTable {
                font-size: 14px;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }



        /* Touch-friendly buttons for mobile */
        .btn {
            min-height: 44px;
            min-width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Prevent zoom on input focus */
        @media (max-width: 768px) {

            input,
            select,
            textarea {
                font-size: 16px !important;
            }
        }

        /* === Mobile-friendly sidebar & navbar toggle (added) === */
        .menu-toggle {

            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            margin-right: 0.75rem;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        .menu-toggle i {
            font-size: 1.25rem;
            line-height: 1;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            opacity: 0;
            visibility: hidden;
            transition: all .25s ease;
            z-index: 1090;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Mobile close button inside sidebar */
        .sidebar-close {
            display: none;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.25rem;
            position: absolute;
            top: 10px;
            right: 12px;
            cursor: pointer;
        }

        /* Off-canvas behavior for small screens */
        @media (max-width: 992px) {

            /* Make header show the toggle */
            .menu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            /* Turn sidebar into an off-canvas drawer */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 260px;
                transform: translateX(-100%);
                z-index: 1100;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }

            .sidebar.open {
                transform: translateX(0);
                overflow-y: auto;
            }

            .sidebar-close {
                display: block;
            }

            /* Let content take full width when sidebar is hidden */

            .main-content {
                margin-left: 0 !important;
                overflow: scroll;
            }

        }

        /* Modal sizing tweaks for small screens */
        @media (max-width: 768px) {
            .modal-dialog {
                width: 95%;
                max-width: none;
                max-height: 92vh;
            }

            .modal-body {
                max-height: calc(92vh - 140px);
                overflow-y: auto;
            }
        }

        /* Improve table scrollability on small screens */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }


        /* Desktop collapsible sidebar (via body.sidebar-collapsed) */
        body.sidebar-collapsed .sidebar {
            width: 90px;
        }

        body.sidebar-collapsed .main-content {
            margin-left: 70px !important;
        }

        body.sidebar-collapsed .sidebar-header h3,
        body.sidebar-collapsed .sidebar-menu span {
            display: none !important;
        }

        body.sidebar-collapsed .sidebar-menu i {
            margin-right: 0 !important;
            font-size: 1.25rem !important;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar" aria-label="Sidebar Navigation">
        <div class="sidebar-header">
            <a href="/">
                <img src="../assets/images/merq-logo-white.png" alt="MERQ Consultancy">
            </a>
            <h3>Admin Portal</h3>
            <button type="button" class="sidebar-close" id="sidebarClose" aria-label="Close sidebar"><i class="fas fa-times"></i></button>

            <!--<a href="/"><i class="fas fa-home"></i> <span>Portal</span></a></li>-->

        </div>
        <ul class="sidebar-menu">
            <li><a href="#dashboard" class="active"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <?php if (isAdmin()): ?>
                <li><a href="#app-cards"><i class="fas fa-th"></i> <span>App Cards</span></a></li>
                <li><a href="#announcements"><i class="fas fa-bullhorn"></i> <span>Announcements</span></a></li>
                <li><a href="#notifications"><i class="fas fa-bell"></i> <span>Notifications</span></a></li>
                <li><a href="#departments"><i class="fas fa-building"></i> <span>Departments</span></a></li>
                <li><a href="#positions"><i class="fas fa-briefcase"></i> <span>Positions</span></a></li>
                <li><a href="#users"><i class="fas fa-users"></i> <span>User Management</span></a></li>
            <?php else: ?>
                <li><a href="#app-cards"><i class="fas fa-th"></i> <span>App Cards</span></a></li>
                <li><a href="#announcements"><i class="fas fa-bullhorn"></i> <span>Announcements</span></a></li>
                <li><a href="#notifications"><i class="fas fa-bell"></i> <span>Notifications</span></a></li>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Sidebar overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" tabindex="-1" aria-hidden="true"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <button type="button" class="menu-toggle" id="sidebarToggle" aria-label="Toggle sidebar" aria-controls="sidebar" aria-expanded="false"><i class="fas fa-bars"></i></button>
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <img src="../assets/images/user-avatar.png" alt="User Avatar">
                <div class="user-name">
                    <?= htmlspecialchars($_SESSION['full_name']) ?>
                    <small>(<?= htmlspecialchars($_SESSION['user_role']) ?>)</small>
                </div>
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

            <div class="digital-clock">
                <div class="clock-time" id="clockTime">00:00:00</div>
                <div class="clock-date" id="clockDate">Loading...</div>
            </div>

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
                                <h4>Announcements</h4>
                                <p><?= count(array_filter($announcements, fn($ann) => $ann['is_active'])) ?></p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: rgba(237, 100, 166, 0.2); color: #ed64a6;">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Notifications</h4>
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

                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #ffa512; color: var(--primary-color);">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Departments</h4>
                                <p><?= count($departments) ?></p>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: rgba(72, 187, 120, 0.2); color: var(--info-color);">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Positions</h4>
                                <p><?= count($positions) ?></p>
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


        <!-- Departments Section -->
        <div id="departments" style="display: none;">
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
        <div id="positions" style="display: none;">
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
        <div id="users" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h2>User Management</h2>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-primary" onclick="showModal('addUser')">
                            <i class="fas fa-plus"></i> Add New User
                        </button>
                        <button class="btn btn-info" onclick="showFilters()">
                            <i class="fas fa-filter"></i> Filters
                        </button>

                        <!-- Bulk Actions Dropdown -->
                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="bulkActionsDropdown" onclick="toggleDropdown('bulkActionsDropdown')">
                                <i class="fas fa-cogs"></i> Bulk Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                <a class="dropdown-item" href="#" onclick="bulkAction('activate')">Activate Selected</a>
                                <a class="dropdown-item" href="#" onclick="bulkAction('deactivate')">Deactivate Selected</a>
                                <a class="dropdown-item" href="#" onclick="showModal('bulkUpdate')">Update Fields</a>
                                <a class="dropdown-item" href="#" onclick="bulkAction('delete')">Delete Selected</a>
                            </div>
                        </div>

                        <!-- Export Dropdown -->
                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" onclick="toggleDropdown('exportDropdown')">
                                <i class="fas fa-download"></i> Export
                            </button>
                            <div class="dropdown-menu" aria-labelledby="exportDropdown">
                                <a class="dropdown-item" href="#" onclick="exportData('csv')">Export to CSV</a>
                                <a class="dropdown-item" href="#" onclick="exportData('excel')">Export to Excel</a>
                                <a class="dropdown-item" href="#" onclick="exportData('pdf')">Export to PDF</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Filters Section -->
                <div class="card-body" id="filtersSection" style="display: none; border-bottom: 1px solid #eee; padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem;">
                        <div class="form-group">
                            <label for="filterSearch">Search</label>
                            <input type="text" id="filterSearch" class="form-control" placeholder="Search name, email, username...">
                        </div>
                        <div class="form-group">
                            <label for="filterRole">Role</label>
                            <select id="filterRole" class="form-control">
                                <option value="">All Roles</option>
                                <option value="admin">Administrator</option>
                                <option value="manager">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="employee">Employee</option>
                                <option value="consultant">Consultant</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterDepartment">Department</label>
                            <select id="filterDepartment" class="form-control">
                                <option value="">All Departments</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['department_id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterPosition">Position</label>
                            <select id="filterPosition" class="form-control">
                                <option value="">All Positions</option>
                                <?php foreach ($positions as $pos): ?>
                                    <option value="<?= $pos['position_id'] ?>"><?= htmlspecialchars($pos['position_title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterStatus">Status</label>
                            <select id="filterStatus" class="form-control">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterSupervisor">Supervisor</label>
                            <select id="filterSupervisor" class="form-control">
                                <option value="">All Supervisors</option>
                                <?php foreach ($supervisors as $sup): ?>
                                    <option value="<?= $sup['user_id'] ?>"><?= htmlspecialchars($sup['full_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterJoinDateFrom">Join Date From</label>
                            <input type="date" id="filterJoinDateFrom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="filterJoinDateTo">Join Date To</label>
                            <input type="date" id="filterJoinDateTo" class="form-control">
                        </div>
                    </div>
                    <div style="margin-top: 1rem; display: flex; gap: 10px;">
                        <button class="btn btn-primary" onclick="applyFilters()">
                            <i class="fas fa-check"></i> Apply Filters
                        </button>
                        <button class="btn btn-outline" onclick="clearFilters()">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Pagination Controls -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div>
                            <select id="perPage" onchange="changePerPage()" class="form-control" style="width: auto; display: inline-block;">
                                <option value="5">5 per page</option>
                                <option value="10" selected>10 per page</option>
                                <option value="15">15 per page</option>
                                <option value="20">20 per page</option>
                                <option value="50">50 per page</option>
                                <option value="100">100 per page</option>
                                <option value="0">All</option>
                            </select>
                        </div>
                        <div id="paginationInfo" style="font-weight: 500;"></div>
                        <div id="paginationControls"></div>
                    </div>

                    <div class="table-responsive">
                        <table id="usersTable">
                            <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)">
                                    </th>
                                    <th>Emp ID
                                        <span class="sort-icon" onclick="sortTable('employee_id')">↕</span>
                                    </th>
                                    <th>Full Name
                                        <span class="sort-icon" onclick="sortTable('full_name')">↕</span>
                                    </th>
                                    <th>Username
                                        <span class="sort-icon" onclick="sortTable('username')">↕</span>
                                    </th>
                                    <th>Email
                                        <span class="sort-icon" onclick="sortTable('email')">↕</span>
                                    </th>
                                    <th>Role
                                        <span class="sort-icon" onclick="sortTable('role')">↕</span>
                                    </th>
                                    <th>Department
                                        <span class="sort-icon" onclick="sortTable('department_name')">↕</span>
                                    </th>
                                    <th>Position
                                        <span class="sort-icon" onclick="sortTable('position_title')">↕</span>
                                    </th>
                                    <th>Supervisor
                                        <span class="sort-icon" onclick="sortTable('supervisor_name')">↕</span>
                                    </th>
                                    <th>Status
                                        <span class="sort-icon" onclick="sortTable('is_active')">↕</span>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                <!-- Users will be loaded here via JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Controls (Bottom) -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                        <div id="paginationInfoBottom"></div>
                        <div id="paginationControlsBottom"></div>
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


        <!-- Add Department Modal -->
        <div class="modal" id="addDepartmentModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_department">
                    <div class="modal-header">
                        <h3>Add New Department</h3>
                        <button type="button" class="close" onclick="hideModal('addDepartment')">&times;</button>
                    </div>
                    <div class="modal-body">
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
                        <button type="button" class="btn btn-outline" onclick="hideModal('addDepartment')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Department</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Department Modal -->
        <div class="modal" id="editDepartmentModal">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h3>Edit Department</h3>
                    <button class="close" onclick="hideModal('editDepartmentModal')">&times;</button>
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
                        <button type="button" class="btn btn-outline" onclick="hideModal('editDepartmentModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Position Modal -->
        <div class="modal" id="addPositionModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_position">
                    <div class="modal-header">
                        <h3>Add New Position</h3>
                        <button type="button" class="close" onclick="hideModal('addPosition')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="positionTitle">Position Title</label>
                            <input type="text" id="positionTitle" name="position_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="positionDepartment">Department</label>
                            <select id="positionDepartment" name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['department_id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="positionDescription">Job Description</label>
                            <textarea id="positionDescription" name="job_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="positionActive" name="is_active" class="form-check-input" checked>
                            <label for="positionActive" class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('addPosition')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Position</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Position Modal -->
        <div class="modal" id="editPositionModal">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h3>Edit Position</h3>
                    <button type="button" class="close" onclick="hideModal('editPositioModal')">&times;</button>
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
                        <button type="button" class="btn btn-outline" onclick="hideModal('editPositionModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Add User Modal -->
        <div class="modal" id="addUserModal">
            <div class="modal-dialog" style="max-width: 800px;">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="add_user">
                    <div class="modal-header">
                        <h3>Add New User</h3>
                        <button type="button" class="close" onclick="hideModal('addUser')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label for="userEmployeeId">Employee ID</label>
                                <input type="text" id="userEmployeeId" name="employee_id" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="userIsDoctor">Is Doctor?</label>
                                <select id="userIsDoctor" name="is_doctor" class="form-control">
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
                                <label for="userEmail">Email Address</label>
                                <input type="email" id="userEmail" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="userPhone">Phone</label>
                                <input type="tel" id="userPhone" name="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="userAltPhone">Alternate Phone</label>
                                <input type="tel" id="userAltPhone" name="alternate_phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="userDepartment">Department</label>
                                <select id="userDepartment" name="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['department_id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="userPosition">Position</label>
                                <select id="userPosition" name="position_id" class="form-control">
                                    <option value="">Select Position</option>
                                    <?php foreach ($positions as $pos): ?>
                                        <option value="<?= $pos['position_id'] ?>"><?= htmlspecialchars($pos['position_title']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="userSupervisor">Supervisor</label>
                                <select id="userSupervisor" name="supervisor_id" class="form-control">
                                    <option value="">Select Supervisor</option>
                                    <?php foreach ($supervisors as $sup): ?>
                                        <option value="<?= $sup['user_id'] ?>"><?= htmlspecialchars($sup['full_name']) ?></option>
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
                                <label for="userRole">Role</label>
                                <select id="userRole" name="role" class="form-control" required>
                                    <option value="employee">Employee</option>
                                    <option value="consultant">Consultant</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="userIsActive">Status</label>
                                <select id="userIsActive" name="is_active" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('addUser')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal" id="editUserModal">
            <div class="modal-dialog" style="max-width: 800px;">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" name="user_id" id="editUserId">
                    <div class="modal-header">
                        <h3>Edit User</h3>
                        <button type="button" class="close" onclick="hideModal('editUser')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Content loaded via JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('editUser')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- User View Modal -->
        <div class="modal" id="viewUserModal">
            <div class="modal-dialog" style="max-width: 800px;">
                <div class="modal-header">
                    <h3>User Details</h3>
                    <div>
                        <button class="btn btn-sm btn-info" onclick="printUserDetails()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button class="btn btn-sm btn-success" onclick="exportUserDetails()">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <button type="button" class="close" onclick="hideModal('viewUser')">&times;</button>
                    </div>
                </div>
                <div class="modal-body" id="userDetailsContent">
                    <!-- User details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="hideModal('viewUser')">Close</button>
                </div>
            </div>
        </div>


        <!-- Bulk Update Modal -->
        <div class="modal" id="bulkUpdateModal">
            <div class="modal-dialog">
                <form action="" method="POST" id="bulkUpdateForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="bulk_update_users">
                    <input type="hidden" name="user_ids" id="bulkUserIds">
                    <div class="modal-header">
                        <h3>Bulk Update Users</h3>
                        <button type="button" class="close" onclick="hideModal('bulkUpdate')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bulkField">Field to Update</label>
                            <select id="bulkField" name="field" class="form-control" onchange="toggleBulkValueField()">
                                <option value="">Select Field</option>
                                <option value="department_id">Department</option>
                                <option value="position_id">Position</option>
                                <option value="supervisor_id">Supervisor</option>
                                <option value="role">Role</option>
                                <option value="is_active">Status</option>
                                <option value="leave_balance">Leave Balance</option>
                            </select>
                        </div>
                        <div class="form-group" id="bulkValueGroup" style="display: none;">
                            <label for="bulkValue">New Value</label>
                            <div id="bulkValueContainer">
                                <!-- Dynamic field will be inserted here -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('bulkUpdate')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Users</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- User Role Management Modal -->
        <div class="modal" id="userRoleModal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="update_user_role">
                    <input type="hidden" name="user_id" id="userRoleId">
                    <div class="modal-header">
                        <h3>Update User Role</h3>
                        <button type="button" class="close" onclick="hideModal('userRole')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userRole">Role</label>
                            <select id="userRole" name="role" class="form-control" required>
                                <option value="employee">Employee</option>
                                <option value="consultant">Consultant</option>
                                <option value="manager">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <!--

                        <div class="form-group">
                            <label for="userPosition">Job Position</label>
                            <input type="text" id="userPosition" name="job_position" class="form-control">
                        </div>
                        -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="hideModal('userRole')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Role</button>
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

        // Modal functions
        function showModal(modalType, id = null) {
            const modal = document.getElementById(`${modalType}Modal`);
            modal.classList.add('show');

            // Set the ID for edit modals
            if (id && modalType.startsWith('edit')) {
                const idField = modal.querySelector('input[name="id"], input[name="user_id"]');
                if (idField) {
                    idField.value = id;
                }

                // Load data for edit modals
                const dataType = modalType.replace('edit', '').toLowerCase();
                fetch(`../includes/get-data.php?type=${dataType}&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert('Error loading data: ' + data.error);
                            return;
                        }

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
                        <input type="hidden" name="id" value="${data.id}">
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
                        <input type="hidden" name="id" value="${data.id}">
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
                        <input type="hidden" name="id" value="${data.id}">
                    `;
                        } else if (modalType === 'editUser') {
                            modalBody.innerHTML = `
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label for="editUserEmployeeId">Employee ID</label>
                                <input type="text" id="editUserEmployeeId" name="employee_id" class="form-control" value="${escapeHtml(data.employee_id || '')}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserIsDoctor">Is Doctor?</label>
                                <select id="editUserIsDoctor" name="is_doctor" class="form-control">
                                    <option value="0" ${data.is_doctor == 0 ? 'selected' : ''}>No</option>
                                    <option value="1" ${data.is_doctor == 1 ? 'selected' : ''}>Yes</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserFirstName">First Name</label>
                                <input type="text" id="editUserFirstName" name="first_name" class="form-control" value="${escapeHtml(data.first_name || '')}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserMiddleName">Middle Name</label>
                                <input type="text" id="editUserMiddleName" name="middle_name" class="form-control" value="${escapeHtml(data.middle_name || '')}">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserLastName">Last Name</label>
                                <input type="text" id="editUserLastName" name="last_name" class="form-control" value="${escapeHtml(data.last_name || '')}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserUsername">Username</label>
                                <input type="text" id="editUserUsername" name="username" class="form-control" value="${escapeHtml(data.username || '')}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserEmail">Email Address</label>
                                <input type="email" id="editUserEmail" name="email" class="form-control" value="${escapeHtml(data.email || '')}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserPhone">Phone</label>
                                <input type="tel" id="editUserPhone" name="phone" class="form-control" value="${escapeHtml(data.phone || '')}">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserAltPhone">Alternate Phone</label>
                                <input type="tel" id="editUserAltPhone" name="alternate_phone" class="form-control" value="${escapeHtml(data.alternate_phone || '')}">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserDepartment">Department</label>
                                <select id="editUserDepartment" name="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    ${generateDepartmentOptions(data.department_id)}
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserPosition">Position</label>
                                <select id="editUserPosition" name="position_id" class="form-control">
                                    <option value="">Select Position</option>
                                    ${generatePositionOptions(data.position_id)}
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserSupervisor">Supervisor</label>
                                <select id="editUserSupervisor" name="supervisor_id" class="form-control">
                                    <option value="">Select Supervisor</option>
                                    ${generateSupervisorOptions(data.supervisor_id)}
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserJoinDate">Join Date</label>
                                <input type="date" id="editUserJoinDate" name="join_date" class="form-control" value="${data.join_date ? data.join_date.split(' ')[0] : ''}">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserHireDate">Hire Date</label>
                                <input type="date" id="editUserHireDate" name="hire_date" class="form-control" value="${data.hire_date ? data.hire_date.split(' ')[0] : ''}">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserLeaveBalance">Leave Balance</label>
                                <input type="number" id="editUserLeaveBalance" name="leave_balance" class="form-control" step="0.5" value="${data.leave_balance || 0}">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserRole">Role</label>
                                <select id="editUserRole" name="role" class="form-control" required>
                                    <option value="employee" ${data.role === 'employee' ? 'selected' : ''}>Employee</option>
                                    <option value="consultant" ${data.role === 'consultant' ? 'selected' : ''}>Consultant</option>
                                    <option value="manager" ${data.role === 'manager' ? 'selected' : ''}>Manager</option>
                                    <option value="supervisor" ${data.role === 'supervisor' ? 'selected' : ''}>Supervisor</option>
                                    <option value="admin" ${data.role === 'admin' ? 'selected' : ''}>Administrator</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserIsActive">Status</label>
                                <select id="editUserIsActive" name="is_active" class="form-control">
                                    <option value="1" ${data.is_active == 1 ? 'selected' : ''}>Active</option>
                                    <option value="0" ${data.is_active == 0 ? 'selected' : ''}>Inactive</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserPassword">New Password (leave blank to keep current)</label>
                                <input type="password" id="editUserPassword" name="password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="editUserConfirmPassword">Confirm New Password</label>
                                <input type="password" id="editUserConfirmPassword" name="confirm_password" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="${data.user_id}">
                    `;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading data:', error);
                        alert('Error loading data. Please try again.');
                    });
            }

            // ADDED THE NEW userRole CASE HERE
            else if (modalType === 'userRole' && id) {
                // Set the user ID
                document.getElementById('userRoleId').value = id;

                // Fetch user data to pre-fill the form
                fetch(`../includes/get-data.php?type=user&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert('Error loading data: ' + data.error);
                            return;
                        }

                        // Set the current role
                        const roleSelect = document.getElementById('userRole');
                        if (roleSelect) {
                            // Set the current role as selected
                            for (let i = 0; i < roleSelect.options.length; i++) {
                                if (roleSelect.options[i].value === data.role) {
                                    roleSelect.selectedIndex = i;
                                    break;
                                }
                            }
                        }

                        // Set the job position if available
                        const positionInput = document.getElementById('userPosition');
                        if (positionInput && data.job_position) {
                            positionInput.value = data.job_position;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading user data:', error);
                        alert('Error loading user data. Please try again.');
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


        // Helper functions for generating dropdown options
        function generateDepartmentOptions(selectedId) {
            const departments = <?= json_encode($departments) ?>;
            return departments.map(dept =>
                `<option value="${dept.department_id}" ${dept.department_id == selectedId ? 'selected' : ''}>${escapeHtml(dept.department_name)}</option>`
            ).join('');
        }

        function generatePositionOptions(selectedId) {
            const positions = <?= json_encode($positions) ?>;
            return positions.map(pos =>
                `<option value="${pos.position_id}" ${pos.position_id == selectedId ? 'selected' : ''}>${escapeHtml(pos.position_title)}</option>`
            ).join('');
        }

        function generateSupervisorOptions(selectedId) {
            const supervisors = <?= json_encode($supervisors) ?>;
            return supervisors.map(sup =>
                `<option value="${sup.user_id}" ${sup.user_id == selectedId ? 'selected' : ''}>${escapeHtml(sup.full_name)}</option>`
            ).join('');
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


        // Close modals when clicking outside
        window.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal')) {
                e.target.classList.remove('show');
            }
        });






        // User Management Advanced Features
        let currentPage = 1;
        let perPage = 10;
        let totalUsers = 0;
        let totalPages = 0;
        let currentSortField = 'full_name';
        let currentSortOrder = 'asc';
        let currentFilters = {};

        // Initialize user management
        function initUserManagement() {
            loadUsers();
            updatePaginationInfo();
        }

        // Load users with pagination, sorting, and filtering
        function loadUsers() {
            const params = new URLSearchParams({
                page: currentPage,
                per_page: perPage,
                sort: currentSortField,
                order: currentSortOrder,
                ...currentFilters
            });

            fetch(`../includes/get-users.php?${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error loading users: ' + data.error);
                        return;
                    }

                    totalUsers = data.total;
                    totalPages = Math.ceil(totalUsers / perPage);

                    const tbody = document.getElementById('usersTableBody');
                    tbody.innerHTML = '';

                    data.users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>
                        <input type="checkbox" class="user-checkbox" value="${user.user_id}" onchange="updateBulkActions()">
                    </td>
                    <td>${escapeHtml(user.employee_id || 'N/A')}</td>
                    <td>
                        ${escapeHtml(user.full_name)}
                        ${user.is_doctor ? '<span class="badge badge-info">Dr</span>' : ''}
                    </td>
                    <td>${escapeHtml(user.username)}</td>
                    <td>${escapeHtml(user.email)}</td>
                    <td>
                        <span class="badge ${getRoleBadgeClass(user.role)}">
                            ${escapeHtml(ucfirst(user.role))}
                        </span>
                    </td>
                    <td>${escapeHtml(user.department_name || 'N/A')}</td>
                    <td>${escapeHtml(user.position_title || 'N/A')}</td>
                    <td>${escapeHtml(user.supervisor_name || 'None')}</td>
                    <td>
                        <span class="badge ${user.is_active ? 'badge-success' : 'badge-danger'}">
                            ${user.is_active ? 'Active' : 'Inactive'}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewUser(${user.user_id})" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline" onclick="showModal('editUser', ${user.user_id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline" onclick="showModal('userRole', ${user.user_id})" title="Change Role">
                            <i class="fas fa-user-cog"></i>
                        </button>
                        ${user.user_id !== <?= $_SESSION['user_id'] ?> ? `
                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="delete_user">
                            <input type="hidden" name="user_id" value="${user.user_id}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        ` : ''}
                    </td>
                `;
                        tbody.appendChild(row);
                    });

                    updatePaginationInfo();
                    updatePaginationControls();
                })
                .catch(error => {
                    console.error('Error loading users:', error);
                    alert('Error loading users. Please try again.');
                });
        }

        // Pagination functions
        function changePage(page) {
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            loadUsers();
        }

        function changePerPage() {
            perPage = parseInt(document.getElementById('perPage').value);
            currentPage = 1;
            loadUsers();
        }

        function updatePaginationInfo() {
            const start = totalUsers > 0 ? ((currentPage - 1) * perPage) + 1 : 0;
            const end = Math.min(currentPage * perPage, totalUsers);

            document.getElementById('paginationInfo').textContent =
                `Showing ${start} to ${end} of ${totalUsers} users`;
            document.getElementById('paginationInfoBottom').textContent =
                `Showing ${start} to ${end} of ${totalUsers} users`;
        }

        function updatePaginationControls() {
            const controlsTop = document.getElementById('paginationControls');
            const controlsBottom = document.getElementById('paginationControlsBottom');

            controlsTop.innerHTML = generatePaginationHTML();
            controlsBottom.innerHTML = generatePaginationHTML();
        }

        function generatePaginationHTML() {
            if (totalPages <= 1) return '';

            let html = '<nav><ul class="pagination">';

            // Previous button
            html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">Previous</a>
    </li>`;

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, startPage + 4);

            for (let i = startPage; i <= endPage; i++) {
                html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
            <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
        </li>`;
            }

            // Next button
            html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">Next</a>
    </li>`;

            html += '</ul></nav>';
            return html;
        }

        // Sorting
        function sortTable(field) {
            if (currentSortField === field) {
                currentSortOrder = currentSortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                currentSortField = field;
                currentSortOrder = 'asc';
            }
            currentPage = 1;
            loadUsers();
        }

        // Filtering
        function showFilters() {
            const filtersSection = document.getElementById('filtersSection');
            filtersSection.style.display = filtersSection.style.display === 'none' ? 'block' : 'none';
        }

        function applyFilters() {
            currentFilters = {};

            const search = document.getElementById('filterSearch').value;
            if (search) currentFilters.search = search;

            const role = document.getElementById('filterRole').value;
            if (role) currentFilters.role = role;

            const department = document.getElementById('filterDepartment').value;
            if (department) currentFilters.department_id = department;

            const position = document.getElementById('filterPosition').value;
            if (position) currentFilters.position_id = position;

            const status = document.getElementById('filterStatus').value;
            if (status !== '') currentFilters.is_active = status;

            const supervisor = document.getElementById('filterSupervisor').value;
            if (supervisor) currentFilters.supervisor_id = supervisor;

            const joinDateFrom = document.getElementById('filterJoinDateFrom').value;
            if (joinDateFrom) currentFilters.join_date_from = joinDateFrom;

            const joinDateTo = document.getElementById('filterJoinDateTo').value;
            if (joinDateTo) currentFilters.join_date_to = joinDateTo;

            currentPage = 1;
            loadUsers();
        }

        function clearFilters() {
            document.getElementById('filterSearch').value = '';
            document.getElementById('filterRole').value = '';
            document.getElementById('filterDepartment').value = '';
            document.getElementById('filterPosition').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterSupervisor').value = '';
            document.getElementById('filterJoinDateFrom').value = '';
            document.getElementById('filterJoinDateTo').value = '';

            currentFilters = {};
            currentPage = 1;
            loadUsers();
        }

        // Bulk actions
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = checkbox.checked;
            });
            updateBulkActions();
        }

        function updateBulkActions() {
            const selectedCount = document.querySelectorAll('.user-checkbox:checked').length;
            const bulkDropdown = document.getElementById('bulkActionsDropdown');

            if (selectedCount > 0) {
                bulkDropdown.textContent = `${selectedCount} selected`;
            } else {
                bulkDropdown.innerHTML = '<i class="fas fa-cogs"></i> Bulk Actions';
            }
        }

        function bulkAction(action) {
            const selectedIds = Array.from(document.querySelectorAll('.user-checkbox:checked'))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert('Please select at least one user.');
                return;
            }

            if (action === 'delete') {
                if (!confirm(`Are you sure you want to delete ${selectedIds.length} user(s)?`)) {
                    return;
                }

                // Submit bulk delete form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = 'csrf_token';
                csrfInput.value = '<?= $_SESSION['csrf_token'] ?>';
                form.appendChild(csrfInput);

                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'bulk_delete_users';
                form.appendChild(actionInput);

                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'user_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            } else if (action === 'activate' || action === 'deactivate') {
                const status = action === 'activate' ? 1 : 0;

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = 'csrf_token';
                csrfInput.value = '<?= $_SESSION['csrf_token'] ?>';
                form.appendChild(csrfInput);

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
                valueInput.value = status;
                form.appendChild(valueInput);

                selectedIds.forEach(id => {
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

        function showBulkUpdateModal() {
            const selectedIds = Array.from(document.querySelectorAll('.user-checkbox:checked'))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert('Please select at least one user.');
                return;
            }

            document.getElementById('bulkUserIds').value = selectedIds.join(',');
            showModal('bulkUpdate');
        }

        function toggleBulkValueField() {
            const field = document.getElementById('bulkField').value;
            const valueGroup = document.getElementById('bulkValueGroup');
            const valueContainer = document.getElementById('bulkValueContainer');

            if (!field) {
                valueGroup.style.display = 'none';
                return;
            }

            valueGroup.style.display = 'block';

            let html = '';
            switch (field) {
                case 'department_id':
                    html = `<select name="value" class="form-control" required>
                <option value="">Select Department</option>
                ${generateDepartmentOptions('')}
            </select>`;
                    break;
                case 'position_id':
                    html = `<select name="value" class="form-control" required>
                <option value="">Select Position</option>
                ${generatePositionOptions('')}
            </select>`;
                    break;
                case 'supervisor_id':
                    html = `<select name="value" class="form-control" required>
                <option value="">Select Supervisor</option>
                ${generateSupervisorOptions('')}
            </select>`;
                    break;
                case 'role':
                    html = `<select name="value" class="form-control" required>
                <option value="">Select Role</option>
                <option value="employee">Employee</option>
                <option value="consultant">Consultant</option>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="admin">Administrator</option>
            </select>`;
                    break;
                case 'is_active':
                    html = `<select name="value" class="form-control" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>`;
                    break;
                case 'leave_balance':
                    html = `<input type="number" name="value" class="form-control" step="0.5" required>`;
                    break;
            }

            valueContainer.innerHTML = html;
        }

        // Export functions
        function exportData(format) {
            const params = new URLSearchParams({
                format: format,
                ...currentFilters
            });

            window.open(`../includes/export-users.php?${params}`, '_blank');
        }

        function exportUserDetails() {
            const userId = document.getElementById('viewUserModal').getAttribute('data-user-id');
            window.open(`../includes/export-users.php?format=pdf&user_id=${userId}`, '_blank');
        }

        // View user details
        function viewUser(userId) {
            fetch(`../includes/get-user-details.php?user_id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error loading user details: ' + data.error);
                        return;
                    }

                    const content = document.getElementById('userDetailsContent');
                    content.innerHTML = `
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="detail-group">
                        <label>Employee ID:</label>
                        <span>${escapeHtml(data.employee_id || 'N/A')}</span>
                    </div>
                    <div class="detail-group">
                        <label>Full Name:</label>
                        <span>${escapeHtml(data.full_name)} ${data.is_doctor ? '(Dr)' : ''}</span>
                    </div>
                    <div class="detail-group">
                        <label>Username:</label>
                        <span>${escapeHtml(data.username)}</span>
                    </div>
                    <div class="detail-group">
                        <label>Email:</label>
                        <span>${escapeHtml(data.email)}</span>
                    </div>
                    <div class="detail-group">
                        <label>Phone:</label>
                        <span>${escapeHtml(data.phone || 'N/A')}</span>
                    </div>
                    <div class="detail-group">
                        <label>Alternate Phone:</label>
                        <span>${escapeHtml(data.alternate_phone || 'N/A')}</span>
                    </div>
                    <div class="detail-group">
                        <label>Role:</label>
                        <span class="badge ${getRoleBadgeClass(data.role)}">${escapeHtml(ucfirst(data.role))}</span>
                    </div>
                    <div class="detail-group">
                        <label>Department:</label>
                        <span>${escapeHtml(data.department_name || 'N/A')}</span>
                    </div>
                    <div class="detail-group">
                        <label>Position:</label>
                        <span>${escapeHtml(data.position_title || 'N/A')}</span>
                    </div>
                    <div class="detail-group">
                        <label>Supervisor:</label>
                        <span>${escapeHtml(data.supervisor_name || 'None')}</span>
                    </div>
                    <div class="detail-group">
                        <label>Join Date:</label>
                        <span>${data.join_date ? formatDate(data.join_date) : 'N/A'}</span>
                    </div>
                    <div class="detail-group">
                        <label>Hire Date:</label>
                        <span>${data.hire_date ? formatDate(data.hire_date) : 'N/A'}</span>
                    </div>
                    <div class="detail-group">
                        <label>Leave Balance:</label>
                        <span>${data.leave_balance || 0} days</span>
                    </div>
                    <div class="detail-group">
                        <label>Status:</label>
                        <span class="badge ${data.is_active ? 'badge-success' : 'badge-danger'}">
                            ${data.is_active ? 'Active' : 'Inactive'}
                        </span>
                    </div>
                    <div class="detail-group">
                        <label>Last Login:</label>
                        <span>${data.last_login ? formatDateTime(data.last_login) : 'Never'}</span>
                    </div>
                </div>
            `;

                    document.getElementById('viewUserModal').setAttribute('data-user-id', userId);
                    showModal('viewUser');
                })
                .catch(error => {
                    console.error('Error loading user details:', error);
                    alert('Error loading user details. Please try again.');
                });
        }

        function printUserDetails() {
            const content = document.getElementById('userDetailsContent').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
        <html>
        <head>
            <title>User Details</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .detail-group { margin-bottom: 10px; }
                .detail-group label { font-weight: bold; display: inline-block; width: 150px; }
                .badge { padding: 3px 8px; border-radius: 4px; font-size: 12px; }
                .badge-success { background-color: #d4edda; color: #155724; }
                .badge-danger { background-color: #f8d7da; color: #721c24; }
                .badge-info { background-color: #d1ecf1; color: #0c5460; }
            </style>
        </head>
        <body>
            <h2>User Details</h2>
            ${content}
        </body>
        </html>
    `);
            printWindow.document.close();
            printWindow.print();
        }

        // Helper functions
        function getRoleBadgeClass(role) {
            switch (role) {
                case 'admin':
                    return 'badge-danger';
                case 'manager':
                    return 'badge-warning';
                case 'supervisor':
                    return 'badge-warning';
                default:
                    return 'badge-success';
            }
        }

        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString();
        }

        function formatDateTime(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleString();
        }

        // Initialize user management when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            initUserManagement();
        });

        // Function to toggle the visibility of the dropdown
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);

            // Close all dropdowns before opening the new one
            const allDropdowns = document.querySelectorAll('.dropdown');
            allDropdowns.forEach(dropdown => dropdown.classList.remove('active'));

            // Toggle the 'active' class for the clicked dropdown
            dropdown.classList.toggle('active');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                const openDropdowns = document.querySelectorAll('.dropdown.active');
                openDropdowns.forEach(dropdown => dropdown.classList.remove('active'));
            }
        });

        // Digital Clock Functionality
        function updateClock() {
            const now = new Date();
            const timeElem = document.getElementById('clockTime');
            const dateElem = document.getElementById('clockDate');
            const greetingElem = document.getElementById('greeting');

            // Update time
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: false
            });
            if (timeElem) timeElem.textContent = timeString;

            // Update date
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('en-US', options);
            if (dateElem) dateElem.textContent = dateString;

            // Update greeting based on time of day
            const hour = now.getHours();
            let greeting = "Good ";
            if (hour < 12) greeting += "Morning";
            else if (hour < 18) greeting += "Afternoon";
            else greeting += "Evening";

            if (greetingElem) greetingElem.textContent = greeting;
        }

        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>





    <script>
        // Data for all sections
        let appCardsData = <?php echo json_encode($appCards); ?>;
        let announcementsData = <?php echo json_encode($announcements); ?>;
        let notificationsData = <?php echo json_encode($notifications); ?>;
        let departmentsData = <?php echo json_encode($departments); ?>;
        let positionsData = <?php echo json_encode($positions); ?>;
        let usersData = <?php echo json_encode($users); ?>;

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

    <!-- Sidebar Toggle Script -->
    <script>
        (function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('sidebarClose');
            const overlay = document.getElementById('sidebarOverlay');

            function isMobile() {
                return window.matchMedia('(max-width: 992px)').matches;
            }

            function openSidebar() {
                if (!sidebar) return;
                sidebar.classList.add('open');
                if (overlay) overlay.classList.add('show');
                if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
                // Prevent background scroll on mobile
                if (isMobile()) document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                if (!sidebar) return;
                sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('show');
                if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }

            function toggleSidebar() {
                if (!sidebar) return;
                if (isMobile()) {
                    if (sidebar.classList.contains('open')) closeSidebar();
                    else openSidebar();
                } else {
                    // Desktop: toggle collapsed state on body
                    document.body.classList.toggle('sidebar-collapsed');
                }
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);

            // Close on ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar && sidebar.classList.contains('open')) {
                    closeSidebar();
                }
            });

            // Close after navigating (mobile only)
            document.querySelectorAll('.sidebar-menu a').forEach(a => {
                a.addEventListener('click', () => {
                    if (isMobile()) closeSidebar();
                });
            });

            // Ensure correct state on resize
            window.addEventListener('resize', () => {
                if (!isMobile()) {
                    // Desktop: keep sidebar visible by default, no overlay
                    if (sidebar) sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('show');
                    document.body.style.overflow = '';
                    if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
                }
            });
        })();
    </script>



</body>

</html>