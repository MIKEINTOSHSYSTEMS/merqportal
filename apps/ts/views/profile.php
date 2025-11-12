<?php
require_once __DIR__ . '/../includes/session_manager.php';
SessionManager::requireLogin();
$title = "Profile - MERQ Timesheet";
$currentUser = SessionManager::getUser();

ob_start();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="bi bi-person-circle me-2"></i>User Profile
                </h4>
            </div>
            <div class="card-body">
                <?php if ($currentUser): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Personal Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Full Name:</th>
                                    <td><?php echo htmlspecialchars($currentUser['full_name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo htmlspecialchars($currentUser['email']); ?></td>
                                </tr>
                                <tr>
                                    <th>Employee ID:</th>
                                    <td><?php echo htmlspecialchars($currentUser['employee_id']); ?></td>
                                </tr>
                                <tr>
                                    <th>Position:</th>
                                    <td><?php echo htmlspecialchars($currentUser['position_title']); ?></td>
                                </tr>
                                <tr>
                                    <th>Department:</th>
                                    <td><?php echo htmlspecialchars($currentUser['department_name']); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Supervisor Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Supervisor Name:</th>
                                    <td><?php echo htmlspecialchars($currentUser['supervisor_name'] ?? 'Not assigned'); ?></td>
                                </tr>
                                <tr>
                                    <th>Supervisor Position:</th>
                                    <td><?php echo htmlspecialchars($currentUser['supervisor_position_title'] ?? 'Not assigned'); ?></td>
                                </tr>
                                <tr>
                                    <th>Supervisor Email:</th>
                                    <td><?php echo htmlspecialchars($currentUser['supervisor_email'] ?? 'Not assigned'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        User information not available.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'base.php';
?>