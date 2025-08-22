<?php
require_once 'config.php';
require_once 'functions.php';

// Get export format
$format = isset($_GET['format']) ? $_GET['format'] : 'csv';
$userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

// Build query based on filters
$whereConditions = [];
$params = [];

// Add the same filter logic as in get-users.php
// [Filter logic from get-users.php goes here]

$whereClause = '';
if (!empty($whereConditions)) {
    $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
}

if ($userId) {
    $whereClause = 'WHERE u.user_id = ?';
    $params = [$userId];
}

$sql = "SELECT 
            u.employee_id,
            u.full_name,
            u.username,
            u.email,
            u.phone,
            u.alternate_phone,
            u.role,
            d.department_name, 
            p.position_title, 
            s.full_name AS supervisor_name,
            u.join_date,
            u.hire_date,
            u.leave_balance,
            u.is_active,
            u.last_login
        FROM users u
        LEFT JOIN departments d ON u.department_id = d.department_id
        LEFT JOIN positions p ON u.position_id = p.position_id
        LEFT JOIN users s ON u.supervisor_id = s.user_id
        $whereClause
        ORDER BY u.full_name ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$users = $stmt->fetchAll();

// Export based on format
switch ($format) {
    case 'csv':
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=users_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'Employee ID',
            'Full Name',
            'Username',
            'Email',
            'Phone',
            'Alternate Phone',
            'Role',
            'Department',
            'Position',
            'Supervisor',
            'Join Date',
            'Hire Date',
            'Leave Balance',
            'Status',
            'Last Login'
        ]);

        foreach ($users as $user) {
            fputcsv($output, [
                $user['employee_id'],
                $user['full_name'],
                $user['username'],
                $user['email'],
                $user['phone'],
                $user['alternate_phone'],
                $user['role'],
                $user['department_name'],
                $user['position_title'],
                $user['supervisor_name'],
                $user['join_date'],
                $user['hire_date'],
                $user['leave_balance'],
                $user['is_active'] ? 'Active' : 'Inactive',
                $user['last_login']
            ]);
        }
        fclose($output);
        break;

    case 'excel':
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename=users_' . date('Y-m-d') . '.xls');

        echo "<table border='1'>";
        echo "<tr>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Alternate Phone</th>
                <th>Role</th>
                <th>Department</th>
                <th>Position</th>
                <th>Supervisor</th>
                <th>Join Date</th>
                <th>Hire Date</th>
                <th>Leave Balance</th>
                <th>Status</th>
                <th>Last Login</th>
              </tr>";

        foreach ($users as $user) {
            echo "<tr>
                    <td>{$user['employee_id']}</td>
                    <td>{$user['full_name']}</td>
                    <td>{$user['username']}</td>
                    <td>{$user['email']}</td>
                    <td>{$user['phone']}</td>
                    <td>{$user['alternate_phone']}</td>
                    <td>{$user['role']}</td>
                    <td>{$user['department_name']}</td>
                    <td>{$user['position_title']}</td>
                    <td>{$user['supervisor_name']}</td>
                    <td>{$user['join_date']}</td>
                    <td>{$user['hire_date']}</td>
                    <td>{$user['leave_balance']}</td>
                    <td>" . ($user['is_active'] ? 'Active' : 'Inactive') . "</td>
                    <td>{$user['last_login']}</td>
                  </tr>";
        }
        echo "</table>";
        break;

    case 'pdf':
        // For PDF export, you would typically use a library like TCPDF or Dompdf
        // This is a simplified example
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=users_' . date('Y-m-d') . '.pdf');

        // In a real implementation, you would generate a proper PDF here
        echo "PDF export would be implemented with a PDF library like TCPDF or Dompdf";
        break;
}

exit;
