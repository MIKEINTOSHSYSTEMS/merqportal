document.addEventListener('DOMContentLoaded', function () {
    // ====================
    // Preloader Simulation
    // ====================
    const preloader = document.querySelector('.preloader');
    const progressBar = document.querySelector('.progress-bar');

    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 10;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);

            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }, 500);
            }, 300);
        }
        progressBar.style.width = `${progress}%`;
    }, 200);

    // ====================
    // Theme Toggle
    // ====================
    const themeToggle = document.querySelector('.theme-toggle');
    const html = document.documentElement;

    const savedTheme = localStorage.getItem('theme') ||
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    html.setAttribute('data-theme', savedTheme);

    themeToggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    });

    // ====================
    // Notification Panel
    // ====================
    const notificationBell = document.querySelector('.notification-bell');
    const notificationPanel = document.querySelector('.notification-panel');
    const closeNotifications = document.querySelector('.close-notifications');

    if (notificationBell && notificationPanel) {
        notificationBell.addEventListener('click', () => {
            notificationPanel.classList.toggle('active');
        });
    }

    if (closeNotifications) {
        closeNotifications.addEventListener('click', () => {
            notificationPanel.classList.remove('active');
        });
    }

    // Mark notifications as read
    document.querySelectorAll('.notification-item.unread').forEach(item => {
        item.addEventListener('click', function () {
            const notificationId = this.getAttribute('data-id');
            if (notificationId) {
                fetch('/mark-notification-read.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: notificationId })
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.remove('unread');
                            updateNotificationCount();
                        }
                    });
            }
        });
    });

    function updateNotificationCount() {
        const unreadCount = document.querySelectorAll('.notification-item.unread').length;
        const countElement = document.querySelector('.notification-count');
        if (countElement) {
            countElement.textContent = unreadCount;
            countElement.style.display = unreadCount > 0 ? 'flex' : 'none';
        }
    }

    const markAllRead = document.querySelector('.mark-all-read');
    if (markAllRead) {
        markAllRead.addEventListener('click', () => {
            fetch('/mark-all-notifications-read.php', { method: 'POST' })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('.notification-item').forEach(i => {
                            i.classList.remove('unread');
                        });
                        updateNotificationCount();
                    }
                });
        });
    }

    // ====================
    // Notice Board Carousel
    // ====================
    const noticeItems = document.querySelectorAll('.notice-item');
    const prevNotice = document.querySelector('.prev-notice');
    const nextNotice = document.querySelector('.next-notice');
    const noticeIndicators = document.querySelectorAll('.notice-indicators .indicator');
    let currentNotice = 0;

    function showNotice(index) {
        noticeItems.forEach((item, i) => {
            item.classList.toggle('active', i === index);
        });
        noticeIndicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
        currentNotice = index;
    }

    if (prevNotice && nextNotice) {
        prevNotice.addEventListener('click', () => {
            let newIndex = currentNotice - 1;
            if (newIndex < 0) newIndex = noticeItems.length - 1;
            showNotice(newIndex);
        });

        nextNotice.addEventListener('click', () => {
            let newIndex = currentNotice + 1;
            if (newIndex >= noticeItems.length) newIndex = 0;
            showNotice(newIndex);
        });
    }

    // Auto-rotate notices
    if (noticeItems.length > 1) {
        let noticeInterval = setInterval(() => {
            let newIndex = currentNotice + 1;
            if (newIndex >= noticeItems.length) newIndex = 0;
            showNotice(newIndex);
        }, 5000);

        const noticeBoard = document.querySelector('.notice-board');
        if (noticeBoard) {
            noticeBoard.addEventListener('mouseenter', () => clearInterval(noticeInterval));
            noticeBoard.addEventListener('mouseleave', () => {
                noticeInterval = setInterval(() => {
                    let newIndex = currentNotice + 1;
                    if (newIndex >= noticeItems.length) newIndex = 0;
                    showNotice(newIndex);
                }, 5000);
            });
        }
    }

    noticeIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => showNotice(index));
    });

    // ====================
    // Mobile Menu
    // ====================
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const headerActions = document.querySelector('.header-actions');

    if (mobileMenuToggle && headerActions) {
        mobileMenuToggle.addEventListener('click', () => {
            headerActions.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!headerActions.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                headerActions.classList.remove('active');
            }
        });
    }

    // ====================
    // Refresh Button
    // ====================
    const refreshBtn = document.querySelector('.refresh-btn');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function () {
            this.disabled = true;
            const icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'rotate(360deg)';
            }
            setTimeout(() => window.location.reload(), 1000);
        });
    }

    // ====================
    // Search Apps
    // ====================
    const appSearch = document.getElementById('appSearch');
    const appsGrid = document.getElementById('appsGrid');
    if (appSearch && appsGrid) {
        appSearch.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            appsGrid.querySelectorAll('.app-card').forEach(card => {
                const title = card.getAttribute('data-title');
                const desc = card.getAttribute('data-desc');
                card.style.display = (title.includes(searchTerm) || desc.includes(searchTerm)) ? 'flex' : 'none';
            });
        });
    }

    // ====================
    // Fade-in on load
    // ====================
    const elementsToAnimate = document.querySelectorAll('.dashboard-header, .notice-board, .apps-grid, .quick-stats');
    elementsToAnimate.forEach((element, index) => {
        element.style.opacity = '0';
        setTimeout(() => element.classList.add('fade-in'), index * 100);
    });

    // ====================
    // Enhanced PWA Install
    // ====================
    let deferredPrompt;
    const pwaInstallPrompt = document.getElementById('pwaInstallPrompt');
    const pwaHeaderInstall = document.getElementById('pwaHeaderInstall');
    const pwaFooterInstall = document.getElementById('pwaFooterInstall');
    const installBtn = document.querySelector('.pwa-install');
    const cancelBtn = document.querySelector('.pwa-cancel');
    const closeBtn = document.querySelector('.pwa-close');
    const manualBtn = document.getElementById('manualInstallBtn');

    function isAppInstalled() {
        return window.matchMedia('(display-mode: standalone)').matches ||
            window.navigator.standalone ||
            document.referrer.includes('android-app://');
    }

    function showInstallPrompt() {
        if (!isAppInstalled() && deferredPrompt) {
            pwaInstallPrompt.classList.add('active');
            if (installBtn) {
                installBtn.classList.add('pulse');
                setTimeout(() => installBtn.classList.remove('pulse'), 6000);
            }
        }
    }

    function hideInstallPrompt() {
        pwaInstallPrompt.classList.remove('active');
        localStorage.setItem('pwaPromptDismissed', Date.now());
    }

    function showManualInstallButton() {
        if (manualBtn && deferredPrompt && !isAppInstalled()) {
            // Check remind later (1 day)
            const lastDismissed = localStorage.getItem('pwaPromptDismissed');
            const oneDayAgo = Date.now() - (24 * 60 * 60 * 1000);
            if (lastDismissed && lastDismissed > oneDayAgo) return;

            manualBtn.style.display = 'block';
            manualBtn.classList.add('animated');
            setTimeout(() => manualBtn.classList.remove('animated'), 30000);
        }
    }

    // beforeinstallprompt event
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Show header install button for logged out users
        if (pwaHeaderInstall && !isAppInstalled()) {
            pwaHeaderInstall.style.display = 'flex';
        }

        // Show footer install button for all users
        if (pwaFooterInstall && !isAppInstalled()) {
            pwaFooterInstall.style.display = 'flex';
        }

        const lastDismissed = localStorage.getItem('pwaPromptDismissed');
        const oneWeekAgo = Date.now() - (7 * 24 * 60 * 60 * 1000);

        if (!lastDismissed || lastDismissed < oneWeekAgo) {
            setTimeout(showInstallPrompt, 3000);
        }

        showManualInstallButton();
    });

    // Install button in prompt
    if (installBtn) {
        installBtn.addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choice) => {
                    if (choice.outcome === 'accepted') {
                        hideInstallPrompt();
                        if (pwaHeaderInstall) pwaHeaderInstall.style.display = 'none';
                        if (pwaFooterInstall) pwaFooterInstall.style.display = 'none';
                        if (manualBtn) manualBtn.style.display = 'none';
                    }
                    deferredPrompt = null;
                });
            }
        });
    }

    // Header install button
    if (pwaHeaderInstall) {
        pwaHeaderInstall.addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choice) => {
                    if (choice.outcome === 'accepted') {
                        pwaHeaderInstall.style.display = 'none';
                        if (pwaFooterInstall) pwaFooterInstall.style.display = 'none';
                        if (manualBtn) manualBtn.style.display = 'none';
                    }
                    deferredPrompt = null;
                });
            }
        });
    }

    // Footer install button
    if (pwaFooterInstall) {
        pwaFooterInstall.addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choice) => {
                    if (choice.outcome === 'accepted') {
                        pwaFooterInstall.style.display = 'none';
                        if (pwaHeaderInstall) pwaHeaderInstall.style.display = 'none';
                        if (manualBtn) manualBtn.style.display = 'none';
                    }
                    deferredPrompt = null;
                });
            }
        });
    }

    // Manual floating button
    if (manualBtn) {
        manualBtn.addEventListener('click', async () => {
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const choice = await deferredPrompt.userChoice;
            if (choice.outcome === 'accepted') {
                manualBtn.style.display = 'none';
                if (pwaHeaderInstall) pwaHeaderInstall.style.display = 'none';
                if (pwaFooterInstall) pwaFooterInstall.style.display = 'none';
                localStorage.removeItem('pwaPromptDismissed');
            } else {
                localStorage.setItem('pwaPromptDismissed', Date.now()); // remind later
            }
            deferredPrompt = null;
        });
    }

    // Cancel / Close buttons
    if (cancelBtn) cancelBtn.addEventListener('click', hideInstallPrompt);
    if (closeBtn) closeBtn.addEventListener('click', hideInstallPrompt);

    // Already installed - hide all prompts
    if (isAppInstalled()) {
        if (pwaInstallPrompt) pwaInstallPrompt.style.display = 'none';
        if (pwaHeaderInstall) pwaHeaderInstall.style.display = 'none';
        if (pwaFooterInstall) pwaFooterInstall.style.display = 'none';
        if (manualBtn) manualBtn.style.display = 'none';
    }

    // appinstalled event
    window.addEventListener('appinstalled', () => {
        if (pwaInstallPrompt) pwaInstallPrompt.style.display = 'none';
        if (pwaHeaderInstall) pwaHeaderInstall.style.display = 'none';
        if (pwaFooterInstall) pwaFooterInstall.style.display = 'none';
        if (manualBtn) manualBtn.style.display = 'none';
        deferredPrompt = null;

        Swal.fire({
            icon: 'success',
            title: 'App Installed!',
            text: 'MERQ Employee Portal has been successfully installed.',
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true
        });
    });
});