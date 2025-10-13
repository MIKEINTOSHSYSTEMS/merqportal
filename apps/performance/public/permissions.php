<?php
// permissions.php - User Permission Management System
require_once '../includes/config.php';
require_once '../includes/header.php';

// Check if user has permission to access this page
if (!hasPermission($_SESSION['user_id'], 'permissions') || !canManagePermissions($_SESSION['user_id'])) {
    header('Location: dashboard.php?error=access_denied');
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_permissions'])) {
        $userId = intval($_POST['user_id']);
        $permissions = [];

        $menuItems = getAvailableMenuItems();
        foreach ($menuItems as $menuItem => $menuLabel) {
            $permissions[$menuItem] = [
                'menu_label' => $menuLabel,
                'can_access' => isset($_POST['permissions'][$menuItem]['can_access']) ? 1 : 0,
                'can_view' => isset($_POST['permissions'][$menuItem]['can_view']) ? 1 : 0,
                'can_edit' => isset($_POST['permissions'][$menuItem]['can_edit']) ? 1 : 0,
                'can_delete' => isset($_POST['permissions'][$menuItem]['can_delete']) ? 1 : 0,
                'can_manage' => isset($_POST['permissions'][$menuItem]['can_manage']) ? 1 : 0
            ];
        }

        $result = updateUserPermissions($userId, $permissions);

        if ($result['success']) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Permissions updated successfully!',
                    confirmButtonColor: '#3085d6'
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update permissions: " . addslashes($result['message']) . "',
                    confirmButtonColor: '#3085d6'
                });
            </script>";
        }
    }

    if (isset($_POST['initialize_permissions'])) {
        $userId = intval($_POST['user_id']);
        $result = initializeDefaultPermissions($userId);

        if ($result) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Default permissions initialized successfully!',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.reload();
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to initialize permissions!',
                    confirmButtonColor: '#3085d6'
                });
            </script>";
        }
    }
}

// Get all users with their permissions
$users = getAllUsersWithPermissions();
$menuItems = getAvailableMenuItems();

// Get selected user for editing (from GET parameter or first user)
$selectedUserId = isset($_GET['user_id']) ? intval($_GET['user_id']) : (count($users) > 0 ? array_key_first($users) : 0);
$selectedUserPermissions = $selectedUserId ? getUserPermissions($selectedUserId) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Management - MERQ Performance Evaluation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <style>
        .permission-table {
            font-size: 0.9rem;
        }

        .permission-table th {
            background-color: #707e9b;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .user-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .user-item {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .user-item:hover {
            background-color: #f8f9fa;
        }

        .user-item.active {
            border-left-color: #007bff;
            background-color: #e3f2fd;
        }

        .permission-checkbox {
            transform: scale(0.9);
        }

        .permission-badge {
            font-size: 0.7em;
        }

        .table-responsive {
            max-height: 70vh;
            overflow: auto;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            background: white;
            z-index: 100;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="h3 mb-1"><i class="fas fa-user-shield me-2"></i>Permission Management</h3>
                        <p class="text-muted mb-0">Manage user access and permissions for the performance evaluation system</p>
                    </div>
                    <div class="d-flex">
                        <button onclick="window.print()" class="btn btn-light me-2 no-print">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#helpModal">
                            <i class="fas fa-question-circle me-1"></i> Help
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- User List -->
            <div class="col-lg-3 mb-4">
                <div class="card card-report">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-users me-2"></i>Users</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="user-list">
                            <?php if (empty($users)): ?>
                                <div class="p-3 text-center text-muted">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <p>No users found</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($users as $user): ?>
                                    <a href="?user_id=<?= $user['user_id'] ?>"
                                        class="list-group-item list-group-item-action user-item <?= $user['user_id'] == $selectedUserId ? 'active' : '' ?>">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><?= htmlspecialchars($user['full_name']) ?></h6>
                                            <span class="badge bg-primary permission-badge">
                                                <?= $user['permission_count'] ?> perms
                                            </span>
                                        </div>
                                        <p class="mb-1 small text-muted"><?= htmlspecialchars($user['email']) ?></p>
                                        <small class="text-muted">
                                            <?= htmlspecialchars($user['position_title'] ?? 'No Position') ?> •
                                            <?= htmlspecialchars($user['department_name'] ?? 'No Department') ?>
                                        </small>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permission Management -->
            <div class="col-lg-9">
                <?php if ($selectedUserId && isset($users[$selectedUserId])): ?>
                    <?php $selectedUser = $users[$selectedUserId]; ?>
                    <div class="card card-report">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i>
                                Permissions for: <?= htmlspecialchars($selectedUser['full_name']) ?>
                            </h5>
                            <div>
                                <form method="post" class="d-inline">
                                    <input type="hidden" name="user_id" value="<?= $selectedUserId ?>">
                                    <input type="hidden" name="initialize_permissions" value="1">
                                    <button type="submit" class="btn btn-warning btn-sm"
                                        onclick="return confirm('Initialize default permissions for this user?')">
                                        <i class="fas fa-sync-alt me-1"></i> Initialize Defaults
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- User Information -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="120">Name:</th>
                                            <td><?= htmlspecialchars($selectedUser['full_name']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td><?= htmlspecialchars($selectedUser['email']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Role:</th>
                                            <td><?= htmlspecialchars($selectedUser['role']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="120">Position:</th>
                                            <td><?= htmlspecialchars($selectedUser['position_title'] ?? 'N/A') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Department:</th>
                                            <td><?= htmlspecialchars($selectedUser['department_name'] ?? 'N/A') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Permissions:</th>
                                            <td>
                                                <?php
                                                $activePermissions = array_filter($selectedUserPermissions, function ($perm) {
                                                    return $perm['can_access'];
                                                });
                                                ?>
                                                <span class="badge bg-success"><?= count($activePermissions) ?> Active</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Permissions Form -->
                            <form method="post" id="permissionsForm">
                                <input type="hidden" name="user_id" value="<?= $selectedUserId ?>">
                                <input type="hidden" name="update_permissions" value="1">

                                <div class="sticky-header bg-white p-3 border rounded mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h6 class="mb-0">Menu Permissions</h6>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="selectAllAccess">
                                                <label class="form-check-label small" for="selectAllAccess">Access All</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="selectAllView">
                                                <label class="form-check-label small" for="selectAllView">View All</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="selectAllEdit">
                                                <label class="form-check-label small" for="selectAllEdit">Edit All</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover permission-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="25%">Menu Item</th>
                                                <th width="15%" class="text-center">Access</th>
                                                <th width="15%" class="text-center">View</th>
                                                <th width="15%" class="text-center">Edit</th>
                                                <th width="15%" class="text-center">Delete</th>
                                                <th width="15%" class="text-center">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menuItems as $menuItem => $menuLabel): ?>
                                                <?php
                                                $userPerm = $selectedUserPermissions[$menuItem] ?? [
                                                    'can_access' => 0,
                                                    'can_view' => 0,
                                                    'can_edit' => 0,
                                                    'can_delete' => 0,
                                                    'can_manage' => 0
                                                ];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= htmlspecialchars($menuLabel) ?></strong>
                                                        <br>
                                                        <small class="text-muted"><?= $menuItem ?></small>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input permission-checkbox access-checkbox"
                                                                type="checkbox"
                                                                name="permissions[<?= $menuItem ?>][can_access]"
                                                                value="1"
                                                                <?= $userPerm['can_access'] ? 'checked' : '' ?>
                                                                data-menu="<?= $menuItem ?>">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input permission-checkbox view-checkbox"
                                                                type="checkbox"
                                                                name="permissions[<?= $menuItem ?>][can_view]"
                                                                value="1"
                                                                <?= $userPerm['can_view'] ? 'checked' : '' ?>
                                                                <?= !$userPerm['can_access'] ? 'disabled' : '' ?>>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input permission-checkbox edit-checkbox"
                                                                type="checkbox"
                                                                name="permissions[<?= $menuItem ?>][can_edit]"
                                                                value="1"
                                                                <?= $userPerm['can_edit'] ? 'checked' : '' ?>
                                                                <?= !$userPerm['can_access'] ? 'disabled' : '' ?>>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input permission-checkbox delete-checkbox"
                                                                type="checkbox"
                                                                name="permissions[<?= $menuItem ?>][can_delete]"
                                                                value="1"
                                                                <?= $userPerm['can_delete'] ? 'checked' : '' ?>
                                                                <?= !$userPerm['can_access'] ? 'disabled' : '' ?>>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input permission-checkbox manage-checkbox"
                                                                type="checkbox"
                                                                name="permissions[<?= $menuItem ?>][can_manage]"
                                                                value="1"
                                                                <?= $userPerm['can_manage'] ? 'checked' : '' ?>
                                                                <?= !$userPerm['can_access'] ? 'disabled' : '' ?>>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4 p-3 bg-light rounded">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6><i class="fas fa-info-circle me-2"></i>Permission Levels:</h6>
                                            <ul class="small mb-0">
                                                <li><strong>Access:</strong> Can see and access the menu item</li>
                                                <li><strong>View:</strong> Can view data/content within the module</li>
                                                <li><strong>Edit:</strong> Can modify data/content within the module</li>
                                                <li><strong>Delete:</strong> Can delete data/content within the module</li>
                                                <li><strong>Manage:</strong> Full administrative control over the module</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-1"></i> Save Permissions
                                            </button>
                                            <a href="permissions.php" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card card-report">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                            <h4>No User Selected</h4>
                            <p class="text-muted">Please select a user from the list to manage their permissions.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="helpModalLabel">
                        <i class="fas fa-question-circle me-2"></i>Permission Management Help
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Permission Levels:</h6>
                            <ul>
                                <li><strong>Access:</strong> User can see and click on the menu item</li>
                                <li><strong>View:</strong> User can view data but not modify it</li>
                                <li><strong>Edit:</strong> User can create and modify data</li>
                                <li><strong>Delete:</strong> User can delete data</li>
                                <li><strong>Manage:</strong> User has full administrative control</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Best Practices:</h6>
                            <ul>
                                <li>Grant minimum required permissions</li>
                                <li>Regularly review and update permissions</li>
                                <li>Use "Initialize Defaults" for new users</li>
                                <li>Test permissions after changes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3 p-3 bg-light rounded">
                        <h6>Default Roles:</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Regular User:</strong><br>
                                Access + View for personal modules
                            </div>
                            <div class="col-md-4">
                                <strong>Supervisor:</strong><br>
                                Access + View + Edit for team modules
                            </div>
                            <div class="col-md-4">
                                <strong>Administrator:</strong><br>
                                All permissions for all modules
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle dependent checkboxes when access is changed
            document.querySelectorAll('.access-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const menuItem = this.getAttribute('data-menu');
                    const isChecked = this.checked;

                    // Enable/disable dependent checkboxes
                    const viewCheckbox = document.querySelector(`input[name="permissions[${menuItem}][can_view]"]`);
                    const editCheckbox = document.querySelector(`input[name="permissions[${menuItem}][can_edit]"]`);
                    const deleteCheckbox = document.querySelector(`input[name="permissions[${menuItem}][can_delete]"]`);
                    const manageCheckbox = document.querySelector(`input[name="permissions[${menuItem}][can_manage]"]`);

                    [viewCheckbox, editCheckbox, deleteCheckbox, manageCheckbox].forEach(cb => {
                        cb.disabled = !isChecked;
                        if (!isChecked) {
                            cb.checked = false;
                        }
                    });
                });
            });

            // Select All functionality
            document.getElementById('selectAllAccess').addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.access-checkbox').forEach(checkbox => {
                    checkbox.checked = isChecked;
                    checkbox.dispatchEvent(new Event('change'));
                });
            });

            document.getElementById('selectAllView').addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.view-checkbox:not(:disabled)').forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });

            document.getElementById('selectAllEdit').addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.edit-checkbox:not(:disabled)').forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });

            // Form validation
            document.getElementById('permissionsForm').addEventListener('submit', function(e) {
                let hasAccess = false;
                document.querySelectorAll('.access-checkbox:checked').forEach(checkbox => {
                    hasAccess = true;
                });

                if (!hasAccess) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Permissions Selected',
                        text: 'Please grant at least one access permission before saving.',
                        confirmButtonColor: '#3085d6'
                    });
                }
            });

            // Auto-save indicator
            let saveTimeout;
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    clearTimeout(saveTimeout);
                    // Show saving indicator
                    const submitBtn = document.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Saving...';

                    saveTimeout = setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                    }, 1000);
                });
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 's') {
                    e.preventDefault();
                    document.getElementById('permissionsForm').dispatchEvent(new Event('submit'));
                }
            });
        });

        // Print functionality
        function printPermissions() {
            const printContent = document.querySelector('.card-report').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Permissions Report - <?= htmlspecialchars($selectedUser['full_name'] ?? 'User') ?></title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body { padding: 20px; }
                        .no-print { display: none; }
                        .table { font-size: 0.8rem; }
                    </style>
                </head>
                <body>
                    <h3>Permission Report: <?= htmlspecialchars($selectedUser['full_name'] ?? 'User') ?></h3>
                    <p>Generated on: ${new Date().toLocaleString()}</p>
                    ${printContent}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>

</html>