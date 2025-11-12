<?php
$title = "Help - MERQ Timesheet";
ob_start();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="bi bi-question-circle me-2"></i>Help & Support
                </h4>
            </div>
            <div class="card-body">
                <div class="accordion" id="helpAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#gettingStarted">
                                Getting Started
                            </button>
                        </h2>
                        <div id="gettingStarted" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <p>Welcome to the MERQ Timesheet system. Here's how to get started:</p>
                                <ol>
                                    <li>Log in using your MERQ email credentials</li>
                                    <li>Navigate to the Timesheet page to create or edit your timesheet</li>
                                    <li>Add projects and enter your working hours</li>
                                    <li>Preview and submit your timesheet</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addingProjects">
                                Adding Projects
                            </button>
                        </h2>
                        <div id="addingProjects" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <p>To add projects to your timesheet:</p>
                                <ol>
                                    <li>Go to the Timesheet page</li>
                                    <li>Click "Add Projects" button</li>
                                    <li>Select projects from the list or create a new one</li>
                                    <li>Enter the allocated hours for each project</li>
                                    <li>Save your changes</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#enteringHours">
                                Entering Hours
                            </button>
                        </h2>
                        <div id="enteringHours" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <p>How to enter your working hours:</p>
                                <ul>
                                    <li>Click on the cell for the specific day and project</li>
                                    <li>Enter the number of hours worked (e.g., 8.0)</li>
                                    <li>Use decimal points for partial hours</li>
                                    <li>The system will automatically calculate totals</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#submittingTimesheet">
                                Submitting Your Timesheet
                            </button>
                        </h2>
                        <div id="submittingTimesheet" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <p>To submit your timesheet:</p>
                                <ol>
                                    <li>Review your entries and totals</li>
                                    <li>Click the "Preview" button to check your timesheet</li>
                                    <li>If everything looks correct, click "Submit"</li>
                                    <li>Your timesheet will be sent to HR for approval</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactSupport">
                                Contact Support
                            </button>
                        </h2>
                        <div id="contactSupport" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <p>If you need help:</p>
                                <ul>
                                    <li>Contact IT Support at it@merqconsultancy.org</li>
                                    <li>Call the IT Helpdesk at extension 123</li>
                                    <li>Visit the IT department for in-person assistance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'base.php';
?>