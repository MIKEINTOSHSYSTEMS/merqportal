<?php
require_once __DIR__ . '/includes/session_manager.php';
require_once __DIR__ . '/includes/utils.php';

SessionManager::start();

if (SessionManager::isLoggedIn()) {
    Utils::redirect('/apps/ts/dashboard.php');
} else {
    $title = "Login - MERQ Timesheet";
    ob_start();
?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="mb-2">MERQ CONSULTANCY</h3>
                <p class="mb-0">ወርሃዊ የስራ ሰዓት መከታተያ / Monthly Timesheet Tracker</p>
                <small>Secure Employee Login</small>
            </div>
            <div class="card-body p-4">
                <form action="/apps/ts/api/auth.php" method="POST">
                    <input type="hidden" name="action" value="login">

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">📧 Email Address / ኢሜይል አድራሻ</label>
                        <input type="text" class="form-control form-control-lg" id="email" name="email"
                               placeholder="Enter your MERQ email" required>
                        <div class="form-text">
                            You can enter: username, username@merqconsultancy.org, or full email
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">🔒 Password / የይለፍ ቃል</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password"
                               placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                        🚀 Login / ግባ
                    </button>
                </form>

                <div class="mt-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>💡 Login Instructions</strong>
                        </div>
                        <div class="card-body">
                            <p class="small mb-2"><strong>How to login:</strong></p>
                            <ul class="small mb-3">
                                <li>Use your MERQ email credentials</li>
                                <li>You can enter just your username, username with domain, or full email</li>
                                <li>The system will automatically add @merqconsultancy.org</li>
                                <li>Contact IT support if you forgot your password</li>
                            </ul>

                            <p class="small mb-2"><strong>እንዴት መግባት እንደሚቻል:</strong></p>
                            <ul class="small">
                                <li>የመርቅ ኢሜይል መለያዎትን ይጠቀሙ</li>
                                <li>የተጠቃሚ ስምዎን ብቻ ማስገባት ትችላላችሁ</li>
                                <li>ስለማስገባት ችግር ካጋጠመዎት ከአይቲ ክፍል ይጠይቁ</li>
                            </ul>
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
}