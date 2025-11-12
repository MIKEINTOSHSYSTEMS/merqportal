<!-- Navigation Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="/apps/ts/dashboard.php">
            <img src="/apps/ts/static/images/merq.png" alt="MERQ Consultancy" width="40" height="40" class="d-inline-block align-text-top me-2">
            <span>MERQ Timesheet</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if (SessionManager::isLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="/apps/ts/dashboard.php">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="/apps/ts/timesheet.php">
                        <i class="bi bi-table me-2"></i>
                        <span>Timesheet</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if (SessionManager::isLoggedIn() && $currentUser): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i>
                        <span><?php echo htmlspecialchars($currentUser['full_name']); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/apps/ts/profile.php">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/apps/ts/help.php">
                                <i class="bi bi-question-circle me-2"></i>Help
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-danger" href="/apps/ts/logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="/apps/ts/login.php">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>