<?php
require_once __DIR__ . '/../includes/session_manager.php';
require_once __DIR__ . '/../includes/ethiopian_date.php';
require_once __DIR__ . '/../config/constants.php';
SessionManager::requireLogin();
$title = "Timesheet - MERQ Timesheet";
$currentUser = SessionManager::getUser();
$currentEthDate = EthiopianDateConverter::getCurrentEthiopianDate();

// Generate years (2010 to current year)
$years = range(2010, $currentEthDate['year']);
$months = [];
for ($i = 1; $i <= 13; $i++) {
    $months[] = [
        'number' => $i,
        'name' => ETHIOPIAN_MONTHS_AMHARIC[$i - 1]
    ];
}

ob_start();
?>
<div class="timesheet-container p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="mb-1">Timesheet Management</h2>
            <p class="text-muted">ወርሃዊ የስራ ሰዓት መከታተያ / Monthly Timesheet Tracker</p>
        </div>
    </div>

    <!-- Month Selection -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="bi bi-calendar-range me-2"></i>Select Month & Year
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">ዓመት / Year</label>
                    <select class="form-select" id="yearSelect">
                        <?php foreach ($years as $year): ?>
                        <option value="<?php echo $year; ?>" <?php echo $year == $currentEthDate['year'] ? 'selected' : ''; ?>>
                            <?php echo $year; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">ወር / Month</label>
                    <select class="form-select" id="monthSelect">
                        <?php foreach ($months as $month): ?>
                        <option value="<?php echo $month['number']; ?>" <?php echo $month['name'] == $currentEthDate['month_name'] ? 'selected' : ''; ?>>
                            <?php echo $month['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-primary w-100" id="loadTimesheet">
                        <i class="bi bi-arrow-clockwise me-2"></i>Load Timesheet
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Management -->
    <div class="card mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-folder me-2"></i>Projects Management
            </h5>
            <button type="button" class="btn btn-success btn-sm" id="addProjectBtn" disabled>
                <i class="bi bi-plus-circle me-1"></i>Add Project
            </button>
        </div>
        <div class="card-body">
            <div id="projectsContainer">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Please select a month and year, then click "Load Timesheet" to see your projects.
                </div>
            </div>
        </div>
    </div>

    <!-- Timesheet Table -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="bi bi-table me-2"></i>Timesheet Entries
            </h5>
        </div>
        <div class="card-body">
            <div id="timesheetLoading" class="text-center py-4" style="display: none;">
                <div class="loading-spinner mb-2"></div>
                <p>Loading timesheet data...</p>
            </div>
            <div class="table-responsive" id="timesheetTableContainer" style="display: none;">
                <table class="table table-bordered" id="timesheetTable">
                    <thead id="timesheetHeader">
                        <!-- Header will be populated by JavaScript -->
                    </thead>
                    <tbody id="timesheetBody">
                        <!-- Body will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div id="timesheetEmpty" class="text-center py-4">
                <i class="bi bi-calendar-x display-1 text-muted"></i>
                <h4 class="text-muted">No Timesheet Loaded</h4>
                <p class="text-muted">Please select a month and year above to load the timesheet.</p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col">
            <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="btn btn-primary" id="prefillBtn" disabled>
                    <i class="bi bi-magic me-2"></i>Prefill Default Hours
                </button>
                <button type="button" class="btn btn-info" id="previewBtn" disabled>
                    <i class="bi bi-eye me-2"></i>Preview Summary
                </button>
                <button type="button" class="btn btn-success" id="exportBtn" disabled>
                    <i class="bi bi-download me-2"></i>Export to Excel
                </button>
                <button type="button" class="btn btn-warning" id="submitBtn" disabled>
                    <i class="bi bi-send me-2"></i>Submit to HR
                </button>
                <button type="button" class="btn btn-danger" id="clearBtn" disabled>
                    <i class="bi bi-trash me-2"></i>Clear All
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project to Timesheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Select Project</label>
                    <select class="form-select" id="projectSelect" multiple>
                        <!-- Projects will be loaded here -->
                    </select>
                    <div class="form-text">Select one or more projects to add to your timesheet</div>
                </div>
                <div class="mb-3">
                    <label for="allocatedHours" class="form-label">Allocated Hours per Project</label>
                    <input type="number" class="form-control" id="allocatedHours" step="0.5" min="0" value="0.0">
                    <div class="form-text">Total hours allocated for each selected project this month</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveProjectBtn">Add Projects</button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Timesheet Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent">
                    <!-- Preview content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="exportFromPreview">
                    <i class="bi bi-download me-1"></i>Export to Excel
                </button>
                <button type="button" class="btn btn-warning" id="submitFromPreview">
                    <i class="bi bi-send me-1"></i>Submit to HR
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$extra_js = '
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
// Initialize when document is ready
$(document).ready(function() {
    // Set user data from PHP
    window.userData = ' . json_encode($currentUser) . ';
    console.log("User data loaded:", window.userData);
    window.timesheetManager = new TimesheetManager();
});
</script>
<script src="static/js/timesheet.js"></script>';
include 'base.php';