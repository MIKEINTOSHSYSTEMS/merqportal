<?php
require_once __DIR__ . '/includes/session_manager.php';
SessionManager::requireLogin();
$title = "Help - MERQ Timesheet";
$currentUser = SessionManager::getUser();

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
                <div class="row">
                    <div class="col-md-8">
                        <h5>የሰዓት ሰሌዳ አጠቃቀም / How to Use Timesheet</h5>
                        <div class="accordion" id="helpAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#gettingStarted">
                                        Getting Started / መጀመሪያ እንዴት እንደሚቀጥል
                                    </button>
                                </h2>
                                <div id="gettingStarted" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Login with your MERQ email credentials</li>
                                            <li>Navigate to the Timesheet page from the dashboard</li>
                                            <li>Select the year and month you want to work on</li>
                                            <li>Click "Load Timesheet" to start</li>
                                        </ol>
                                        <p><strong>አማርኛ:</strong> የመርቅ ኢሜይል መለያዎትን በመጠቀም ይግቡ፣ ከዳሽቦርድ ወደ ሰዓት ሰሌዳ ይሂዱ፣ ዓመት እና ወር ይምረጡ እና "Load Timesheet" ን ይጫኑ።</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addingProjects">
                                        Adding Projects / ፕሮጀክቶችን መጨመር
                                    </button>
                                </h2>
                                <div id="addingProjects" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Click "Add Project" button in the Projects Management section</li>
                                            <li>Enter project name and allocated hours</li>
                                            <li>Save the project</li>
                                            <li>The project will appear in your timesheet table</li>
                                        </ol>
                                        <p><strong>አማርኛ:</strong> "Add Project" ን ይጫኑ፣ የፕሮጀክት ስም እና የተመደበ ሰዓት ያስገቡ፣ ያስቀምጡ እና በሰዓት ሰሌዳ ሰንጠረዥ ውስጥ ያሳያል።</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#enteringHours">
                                        Entering Hours / ሰዓቶችን ማስገባት
                                    </button>
                                </h2>
                                <div id="enteringHours" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Find your project row in the timesheet table</li>
                                            <li>Click on the cell for the date you want to enter hours</li>
                                            <li>Enter the number of hours worked (e.g., 8.0)</li>
                                            <li>Hours are automatically saved</li>
                                        </ol>
                                        <p><strong>Note:</strong> You can enter decimal hours (e.g., 4.5 for 4.5 hours)</p>
                                        <p><strong>አማርኛ:</strong> በሰዓት ሰሌዳ ሰንጠረዥ ውስጥ የፕሮጀክት ረድ ያግኙ፣ ለሚሻበት ቀን ክፍል ይጫኑ እና የሰራሁበት ሰዓት ያስገቡ።</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#leaveHours">
                                        Leave Hours / የፈቃድ ሰዓቶች
                                    </button>
                                </h2>
                                <div id="leaveHours" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <p>The system supports various types of leave:</p>
                                        <ul>
                                            <li><strong>Vacation:</strong> Annual leave</li>
                                            <li><strong>Sick Leave:</strong> Medical leave</li>
                                            <li><strong>Holiday:</strong> Public holidays</li>
                                            <li><strong>Personal Leave:</strong> Personal time off</li>
                                            <li><strong>Bereavement:</strong> Bereavement leave</li>
                                            <li><strong>Other:</strong> Other types of leave</li>
                                        </ul>
                                        <p>Enter leave hours in the appropriate row for each date.</p>
                                        <p><strong>አማርኛ:</strong> የፈቃድ ሰዓቶችን በሚለያዩ የፈቃድ አይነቶች ረድ ውስጥ ለእያንዳንዱ ቀን ያስገቡ።</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#exporting">
                                        Exporting & Submitting / መላክ እና መላክ
                                    </button>
                                </h2>
                                <div id="exporting" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Click "Preview Summary" to review your timesheet</li>
                                            <li>Click "Export to Excel" to download your timesheet</li>
                                            <li>After downloading, send the file to haymanot.a@merqconsultancy.org</li>
                                            <li>Alternatively, use "Submit to HR" to send via email directly</li>
                                        </ol>
                                        <p><strong>አማርኛ:</strong> ማጠቃለያ ለማየት "Preview Summary" ን ይጫኑ፣ ለመውረድ "Export to Excel" ን ይጠቀሙ እና ወደ haymanot.a@merqconsultancy.org ይላኩ።</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Contact Support / እገዛ ለማግኘት</h5>
                        <div class="card">
                            <div class="card-body">
                                <h6>IT Support</h6>
                                <p><i class="bi bi-envelope me-2"></i>support@merqconsultancy.org</p>
                                <p><i class="bi bi-telephone me-2"></i>+251-XXX-XXXX</p>
                                <hr>
                                <h6>HR Department</h6>
                                <p><i class="bi bi-envelope me-2"></i>haymanot.a@merqconsultancy.org</p>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Quick Tips</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small">
                                    <li>Use "Prefill Default Hours" to quickly fill standard working hours</li>
                                    <li>Check your totals at the bottom of each column</li>
                                    <li>Save frequently to avoid losing your work</li>
                                    <li>Contact support if you encounter any issues</li>
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
include 'views/base.php';