<?php
//require_once __DIR__ . '/../../timesheet/config/config.php';
//require_once __DIR__ . '/../../timesheet/includes/auth-check.php';
//require_once 'config.php';
require_once __DIR__ . '/employees_header.php';
//require_once __DIR__ . '/users_header.php';
//require_once __DIR__ . '/header.php';

// Only admin can access this page
/*

if (!hasRole('admin')) {
    //header('Location: ' . BASE_URL . '/pages/dashboard.php');
    header('Location: ' . BASE_URL . 'employee_management.php');
    exit;
}
*/

$user = new User();
$auth = new Auth();
$error = '';
$success = '';

// Handle user actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['create_user'])) {
            // Validate input
            if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
                throw new Exception("All required fields must be filled");
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            if (strlen($_POST['password']) < 8) {
                throw new Exception("Password must be at least 8 characters");
            }

            // Prepare user data
            $userData = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'role' => $_POST['role'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            // Add optional fields if provided
            if (!empty($_POST['employee_id'])) $userData['employee_id'] = trim($_POST['employee_id']);
            if (!empty($_POST['middle_name'])) $userData['middle_name'] = trim($_POST['middle_name']);
            if (!empty($_POST['username'])) $userData['username'] = trim($_POST['username']);
            if (!empty($_POST['phone'])) $userData['phone'] = trim($_POST['phone']);
            if (!empty($_POST['alternate_phone'])) $userData['alternate_phone'] = trim($_POST['alternate_phone']);
            if (!empty($_POST['department_id'])) $userData['department_id'] = $_POST['department_id'];
            if (!empty($_POST['position_id'])) $userData['position_id'] = $_POST['position_id'];
            if (!empty($_POST['supervisor_id'])) $userData['supervisor_id'] = $_POST['supervisor_id'];
            if (!empty($_POST['hire_date'])) $userData['hire_date'] = $_POST['hire_date'];
            if (!empty($_POST['join_date'])) $userData['join_date'] = $_POST['join_date'];
            if (isset($_POST['is_doctor'])) $userData['is_doctor'] = $_POST['is_doctor'] ? 1 : 0;

            // Create new user
            $userId = $auth->register($userData);

            $success = 'User created successfully';
        } elseif (isset($_POST['update_user'])) {
            // Validate input
            if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
                throw new Exception("All required fields must be filled");
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            if (!empty($_POST['password']) && strlen($_POST['password']) < 8) {
                throw new Exception("Password must be at least 8 characters");
            }

            // Prepare user data
            $userData = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'role' => $_POST['role'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            // Add optional fields if provided
            if (!empty($_POST['employee_id'])) $userData['employee_id'] = trim($_POST['employee_id']);
            if (!empty($_POST['middle_name'])) $userData['middle_name'] = trim($_POST['middle_name']);
            if (!empty($_POST['username'])) $userData['username'] = trim($_POST['username']);
            if (!empty($_POST['phone'])) $userData['phone'] = trim($_POST['phone']);
            if (!empty($_POST['alternate_phone'])) $userData['alternate_phone'] = trim($_POST['alternate_phone']);
            if (!empty($_POST['department_id'])) $userData['department_id'] = $_POST['department_id'];
            if (!empty($_POST['position_id'])) $userData['position_id'] = $_POST['position_id'];
            if (!empty($_POST['supervisor_id'])) $userData['supervisor_id'] = $_POST['supervisor_id'];
            if (!empty($_POST['hire_date'])) $userData['hire_date'] = $_POST['hire_date'];
            if (!empty($_POST['join_date'])) $userData['join_date'] = $_POST['join_date'];
            if (isset($_POST['is_doctor'])) $userData['is_doctor'] = $_POST['is_doctor'] ? 1 : 0;
            if (!empty($_POST['password'])) $userData['password'] = $_POST['password'];

            // Update existing user
            $auth->updateUser($_POST['user_id'], $userData);

            $success = 'User updated successfully';
        } elseif (isset($_POST['delete_user'])) {
            // Delete user (soft delete)
            $pdo = (new Database())->getConnection();
            $stmt = $pdo->prepare("UPDATE users SET is_active = ? WHERE user_id = ?");
            $currentStatus = $user->getUserById($_POST['user_id'])['is_active'];
            $newStatus = $currentStatus ? 0 : 1;
            $stmt->execute([$newStatus, $_POST['user_id']]);
            $success = $newStatus ? 'User activated successfully' : 'User deactivated successfully';
        } elseif (isset($_POST['bulk_action'])) {
            // Handle bulk actions
            if (!isset($_POST['selected_users']) || empty($_POST['selected_users'])) {
                throw new Exception("No users selected for bulk action");
            }

            $selectedUsers = $_POST['selected_users'];
            $action = $_POST['bulk_action_type'];

            if ($action === 'activate') {
                $stmt = $pdo->prepare("UPDATE users SET is_active = 1 WHERE user_id = ?");
                foreach ($selectedUsers as $userId) {
                    $stmt->execute([$userId]);
                }
                $success = count($selectedUsers) . ' user(s) activated successfully';
            } elseif ($action === 'deactivate') {
                $stmt = $pdo->prepare("UPDATE users SET is_active = 0 WHERE user_id = ?");
                foreach ($selectedUsers as $userId) {
                    $stmt->execute([$userId]);
                }
                $success = count($selectedUsers) . ' user(s) deactivated successfully';
            } elseif ($action === 'delete') {
                $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
                foreach ($selectedUsers as $userId) {
                    $stmt->execute([$userId]);
                }
                $success = count($selectedUsers) . ' user(s) deleted successfully';
            } elseif ($action === 'export') {
                // Handle export - this would typically generate a CSV or Excel file
                // For now, we'll just set a success message
                $success = 'Export functionality would be implemented here';
            }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Get filter parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$role_filter = isset($_GET['role_filter']) ? $_GET['role_filter'] : '';
$status_filter = isset($_GET['status_filter']) ? $_GET['status_filter'] : '';
$department_filter = isset($_GET['department_filter']) ? $_GET['department_filter'] : '';
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'full_name';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

// Pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 20;
$offset = ($page - 1) * $per_page;

// Get all users with filtering, sorting and pagination
try {
    $users = $user->getAllUsersWithFilters($search, $role_filter, $status_filter, $department_filter, $sort_by, $sort_order, $per_page, $offset);
    $total_users = $user->countUsersWithFilters($search, $role_filter, $status_filter, $department_filter);
    $total_pages = ceil($total_users / $per_page);
} catch (Exception $e) {
    error_log("User management error: " . $e->getMessage());
    $error = "Failed to load users. Please try again.";
    $users = [];
    $total_users = 0;
    $total_pages = 1;
}

// Get departments for dropdown
$pdo = (new Database())->getConnection();
$departments = $pdo->query("SELECT department_id, department_name FROM departments ORDER BY department_name")->fetchAll(PDO::FETCH_ASSOC);

// Get positions for dropdown
$positions = $pdo->query("SELECT position_id, position_title FROM positions ORDER BY position_title")->fetchAll(PDO::FETCH_ASSOC);

// Get supervisors for dropdown
$supervisors = $pdo->query("SELECT user_id, full_name FROM users WHERE is_active = 1 ORDER BY full_name")->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .mb-4 {
        margin-top: 70px;
        margin-bottom: 1.5rem !important;
    }
</style>
<div class="container-fluid">
    <h1 class="mb-4">Employees Management</h1>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= e($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= e($success) ?></div>
    <?php endif; ?>

    <!-- Filters and Search -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filters & Search</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" class="form-control" name="search" value="<?= e($search) ?>" placeholder="Search users...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role_filter">
                        <option value="">All Roles</option>
                        <option value="employee" <?= $role_filter === 'employee' ? 'selected' : '' ?>>Employee</option>
                        <option value="consultant" <?= $role_filter === 'consultant' ? 'selected' : '' ?>>Consultant</option>
                        <option value="manager" <?= $role_filter === 'manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="admin" <?= $role_filter === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status_filter">
                        <option value="">All Status</option>
                        <option value="active" <?= $status_filter === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $status_filter === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Department</label>
                    <select class="form-select" name="department_filter">
                        <option value="">All Departments</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['department_id'] ?>" <?= $department_filter == $dept['department_id'] ? 'selected' : '' ?>>
                                <?= e($dept['department_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sort By</label>
                    <select class="form-select" name="sort_by">
                        <option value="full_name" <?= $sort_by === 'full_name' ? 'selected' : '' ?>>Name</option>
                        <option value="email" <?= $sort_by === 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="role" <?= $sort_by === 'role' ? 'selected' : '' ?>>Role</option>
                        <option value="department_name" <?= $sort_by === 'department_name' ? 'selected' : '' ?>>Department</option>
                        <option value="hire_date" <?= $sort_by === 'hire_date' ? 'selected' : '' ?>>Hire Date</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label">Order</label>
                    <select class="form-select" name="sort_order">
                        <option value="ASC" <?= $sort_order === 'ASC' ? 'selected' : '' ?>>ASC</option>
                        <option value="DESC" <?= $sort_order === 'DESC' ? 'selected' : '' ?>>DESC</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="employee_management.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Create New User Form -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create New User</h5>
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#createUserForm">
                Toggle Form
            </button>
        </div>
        <div class="collapse show" id="createUserForm">
            <div class="card-body">
                <form method="POST" id="createUserForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" name="employee_id">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Alternate Phone</label>
                            <input type="text" class="form-control" name="alternate_phone">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select" name="role" required>
                                <option value="employee">Employee</option>
                                <option value="consultant">Consultant</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Department</label>
                            <select class="form-select" name="department_id">
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['department_id'] ?>"><?= e($dept['department_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Position</label>
                            <select class="form-select" name="position_id">
                                <option value="">Select Position</option>
                                <?php foreach ($positions as $pos): ?>
                                    <option value="<?= $pos['position_id'] ?>"><?= e($pos['position_title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Supervisor</label>
                            <select class="form-select" name="supervisor_id">
                                <option value="">Select Supervisor</option>
                                <?php foreach ($supervisors as $sup): ?>
                                    <option value="<?= $sup['user_id'] ?>"><?= e($sup['full_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Join Date</label>
                            <input type="date" class="form-control" name="join_date">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Hire Date</label>
                            <input type="date" class="form-control" name="hire_date">
                        </div>
                        <div class="col-md-3">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input" type="checkbox" name="is_doctor" id="is_doctor" value="1">
                                <label class="form-check-label" for="is_doctor">Is Doctor</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="create_user" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>

    <!-- User List with Bulk Actions -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User List (<?= $total_users ?> users found)</h5>
            <div class="d-flex">
                <select class="form-select me-2" id="per_page" onchange="updatePerPage(this.value)">
                    <option value="5" <?= $per_page == 5 ? 'selected' : '' ?>>5 per page</option>
                    <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10 per page</option>
                    <option value="15" <?= $per_page == 15 ? 'selected' : '' ?>>15 per page</option>
                    <option value="20" <?= $per_page == 20 ? 'selected' : '' ?>>20 per page</option>
                    <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50 per page</option>
                    <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100 per page</option>
                    <option value="9999" <?= $per_page > 100 ? 'selected' : '' ?>>All</option>
                </select>

                <form method="POST" class="d-flex bulk-action-form">
                    <input type="hidden" name="selected_users" id="selectedUsers">
                    <select class="form-select me-2" name="bulk_action_type" id="bulkActionType">
                        <option value="">Bulk Actions</option>
                        <option value="activate">Activate</option>
                        <option value="deactivate">Deactivate</option>
                        <option value="delete">Delete</option>
                        <option value="export">Export</option>
                    </select>
                    <button type="submit" name="bulk_action" class="btn btn-outline-secondary" id="bulkActionBtn" disabled>
                        Apply
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="30">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Supervisor</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="11" class="text-center">No users found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="user-checkbox" value="<?= $u['user_id'] ?>">
                                    </td>
                                    <td><?= e($u['employee_id'] ?? 'N/A') ?></td>
                                    <td>
                                        <?= e($u['full_name']) ?>
                                        <?php if ($u['is_doctor']): ?>
                                            <span class="badge bg-info">Dr</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= e($u['email']) ?></td>
                                    <td><?= e($u['phone'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="badge bg-<?=
                                                                $u['role'] == 'admin' ? 'danger' : ($u['role'] == 'manager' ? 'warning' : ($u['role'] == 'consultant' ? 'info' : 'secondary')) ?>">
                                            <?= ucfirst(e($u['role'])) ?>
                                        </span>
                                    </td>
                                    <td><?= e($u['department_name'] ?? 'N/A') ?></td>
                                    <td><?= e($u['position_title'] ?? 'N/A') ?></td>
                                    <td><?= e($u['supervisor_name'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="badge bg-<?= $u['is_active'] ? 'success' : 'danger' ?>">
                                            <?= $u['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary edit-user"
                                                data-user-id="<?= $u['user_id'] ?>"
                                                data-employee-id="<?= e($u['employee_id'] ?? '') ?>"
                                                data-first-name="<?= e($u['first_name']) ?>"
                                                data-middle-name="<?= e($u['middle_name'] ?? '') ?>"
                                                data-last-name="<?= e($u['last_name']) ?>"
                                                data-username="<?= e($u['username'] ?? '') ?>"
                                                data-email="<?= e($u['email']) ?>"
                                                data-phone="<?= e($u['phone'] ?? '') ?>"
                                                data-alternate-phone="<?= e($u['alternate_phone'] ?? '') ?>"
                                                data-role="<?= e($u['role']) ?>"
                                                data-department-id="<?= e($u['department_id'] ?? '') ?>"
                                                data-position-id="<?= e($u['position_id'] ?? '') ?>"
                                                data-supervisor-id="<?= e($u['supervisor_id'] ?? '') ?>"
                                                data-join-date="<?= e($u['join_date'] ?? '') ?>"
                                                data-hire-date="<?= e($u['hire_date'] ?? '') ?>"
                                                data-is-doctor="<?= $u['is_doctor'] ?>"
                                                data-is-active="<?= $u['is_active'] ?>">
                                                Edit
                                            </button>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="user_id" value="<?= $u['user_id'] ?>">
                                                <button type="submit" name="delete_user" class="btn btn-sm btn-outline-<?= $u['is_active'] ? 'danger' : 'success' ?>">
                                                    <?= $u['is_active'] ? 'Deactivate' : 'Activate' ?>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <nav aria-label="User pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= generatePaginationLink(1, $per_page) ?>">First</a>
                        </li>
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= generatePaginationLink($page - 1, $per_page) ?>">Previous</a>
                        </li>

                        <?php
                        $start_page = max(1, $page - 2);
                        $end_page = min($total_pages, $start_page + 4);
                        $start_page = max(1, $end_page - 4);

                        for ($i = $start_page; $i <= $end_page; $i++):
                        ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="<?= generatePaginationLink($i, $per_page) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= generatePaginationLink($page + 1, $per_page) ?>">Next</a>
                        </li>
                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= generatePaginationLink($total_pages, $per_page) ?>">Last</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editUserForm">
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="edit_user_id">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" name="employee_id" id="edit_employee_id">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="edit_first_name" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" id="edit_middle_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" id="edit_last_name" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="edit_username">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="edit_email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="edit_phone">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Alternate Phone</label>
                            <input type="text" class="form-control" name="alternate_phone" id="edit_alternate_phone">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" name="password" id="edit_password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select" name="role" id="edit_role" required>
                                <option value="employee">Employee</option>
                                <option value="consultant">Consultant</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Department</label>
                            <select class="form-select" name="department_id" id="edit_department_id">
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['department_id'] ?>"><?= e($dept['department_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Position</label>
                            <select class="form-select" name="position_id" id="edit_position_id">
                                <option value="">Select Position</option>
                                <?php foreach ($positions as $pos): ?>
                                    <option value="<?= $pos['position_id'] ?>"><?= e($pos['position_title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Supervisor</label>
                            <select class="form-select" name="supervisor_id" id="edit_supervisor_id">
                                <option value="">Select Supervisor</option>
                                <?php foreach ($supervisors as $sup): ?>
                                    <option value="<?= $sup['user_id'] ?>"><?= e($sup['full_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Join Date</label>
                            <input type="date" class="form-control" name="join_date" id="edit_join_date">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Hire Date</label>
                            <input type="date" class="form-control" name="hire_date" id="edit_hire_date">
                        </div>
                        <div class="col-md-3">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input" type="checkbox" name="is_doctor" id="edit_is_doctor" value="1">
                                <label class="form-check-label" for="edit_is_doctor">Is Doctor</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                                <label class="form-check-label" for="edit_is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_user" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit user button clicks
        document.querySelectorAll('.edit-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const modal = new bootstrap.Modal(document.getElementById('editUserModal'));

                // Show loading state
                document.getElementById('editUserForm').querySelectorAll('input, select').forEach(el => {
                    el.disabled = true;
                });

                // Fetch user data via AJAX
                fetch(`get_employee_data.php?user_id=${userId}`)
                    .then(response => response.json())
                    .then(user => {
                        // Populate form fields with user data
                        document.getElementById('edit_user_id').value = user.user_id;
                        document.getElementById('edit_employee_id').value = user.employee_id || '';
                        document.getElementById('edit_first_name').value = user.first_name;
                        document.getElementById('edit_middle_name').value = user.middle_name || '';
                        document.getElementById('edit_last_name').value = user.last_name;
                        document.getElementById('edit_username').value = user.username || '';
                        document.getElementById('edit_email').value = user.email;
                        document.getElementById('edit_phone').value = user.phone || '';
                        document.getElementById('edit_alternate_phone').value = user.alternate_phone || '';
                        document.getElementById('edit_role').value = user.role;

                        // Set department selection
                        if (user.department_id) {
                            document.getElementById('edit_department_id').value = user.department_id;
                        }

                        // Set position selection
                        if (user.position_id) {
                            document.getElementById('edit_position_id').value = user.position_id;
                        }

                        // Set supervisor selection
                        if (user.supervisor_id) {
                            document.getElementById('edit_supervisor_id').value = user.supervisor_id;
                        }

                        // Set date fields
                        document.getElementById('edit_join_date').value = user.join_date || '';
                        document.getElementById('edit_hire_date').value = user.hire_date || '';

                        // Set checkboxes
                        document.getElementById('edit_is_doctor').checked = user.is_doctor == 1;
                        document.getElementById('edit_is_active').checked = user.is_active == 1;

                        // Enable form fields
                        document.getElementById('editUserForm').querySelectorAll('input, select').forEach(el => {
                            el.disabled = false;
                        });

                        modal.show();
                    })
                    .catch(error => {
                        console.error('Error fetching user data:', error);
                        alert('Error loading user data. Please try again.');
                    });
            });
        });

        // Select all checkbox functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActionButton();
        });

        // Update bulk action button when checkboxes change
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActionButton);
        });

        // Bulk action form submission
        document.querySelector('.bulk-action-form').addEventListener('submit', function(e) {
            const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedUsers.length === 0) {
                e.preventDefault();
                alert('Please select at least one user');
                return;
            }

            document.getElementById('selectedUsers').value = JSON.stringify(selectedUsers);
        });
    });

    function updateBulkActionButton() {
        const selectedCount = document.querySelectorAll('.user-checkbox:checked').length;
        const bulkActionBtn = document.getElementById('bulkActionBtn');
        const bulkActionType = document.getElementById('bulkActionType');

        if (selectedCount > 0 && bulkActionType.value) {
            bulkActionBtn.disabled = false;
            bulkActionBtn.textContent = `Apply to ${selectedCount} user(s)`;
        } else {
            bulkActionBtn.disabled = true;
            bulkActionBtn.textContent = 'Apply';
        }
    }

    function updatePerPage(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        url.searchParams.set('page', '1'); // Reset to first page
        window.location.href = url.toString();
    }

    // Update bulk action button when action type changes
    document.getElementById('bulkActionType').addEventListener('change', updateBulkActionButton);
</script>

<?php
// Helper function to generate pagination links
function generatePaginationLink($page, $per_page)
{
    $params = $_GET;
    $params['page'] = $page;
    $params['per_page'] = $per_page;
    return 'employee_management.php?' . http_build_query($params);
}

require_once __DIR__ . '/footer.php';
