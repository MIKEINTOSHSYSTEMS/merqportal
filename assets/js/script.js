document.addEventListener('DOMContentLoaded', function () {
    // Preloader Simulation
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

    // Theme Toggle
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

    // Notification Panel Toggle
    const notificationBell = document.querySelector('.notification-bell');
    const notificationPanel = document.querySelector('.notification-panel');
    const closeNotifications = document.querySelector('.close-notifications');

    notificationBell.addEventListener('click', () => {
        notificationPanel.classList.toggle('active');
    });

    closeNotifications.addEventListener('click', () => {
        notificationPanel.classList.remove('active');
    });

    // Mark notifications as read when clicked
    document.querySelectorAll('.notification-item.unread').forEach(item => {
        item.addEventListener('click', function () {
            const notificationId = this.getAttribute('data-id');
            if (notificationId) {
                // Send AJAX request to mark as read
                fetch('/mark-notification-read.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: notificationId })
                })
                    .then(response => response.json())
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
        countElement.textContent = unreadCount;
        countElement.style.display = unreadCount > 0 ? 'flex' : 'none';
    }

    // Mark all notifications as read
    const markAllRead = document.querySelector('.mark-all-read');
    markAllRead.addEventListener('click', () => {
        fetch('/mark-all-notifications-read.php', {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.classList.remove('unread');
                    });
                    updateNotificationCount();
                }
            });
    });


    // Notification functions
    function markNotificationAsRead(notificationId) {
        if (!notificationId) return;

        fetch('/includes/mark-notification-read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: notificationId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationItem = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
                    if (notificationItem) {
                        notificationItem.classList.remove('unread');
                        updateNotificationCount();
                    }
                }
            });
    }

    function markAllNotificationsAsRead() {
        fetch('/includes/mark-all-notifications-read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                    });
                    updateNotificationCount();
                }
            });
    }

    function updateNotificationCount() {
        const unreadCount = document.querySelectorAll('.notification-item.unread').length;
        const countElement = document.querySelector('.notification-count');
        if (countElement) {
            countElement.textContent = unreadCount;
            countElement.style.display = unreadCount > 0 ? 'flex' : 'none';
        }
    }

    // Initialize notifications
    document.addEventListener('DOMContentLoaded', function () {
        // Mark notification as read when clicked
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function () {
                const notificationId = this.getAttribute('data-id');
                if (notificationId && this.classList.contains('unread')) {
                    markNotificationAsRead(notificationId);
                }
            });
        });

        // Mark all as read button
        const markAllReadBtn = document.querySelector('.mark-all-read');
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', markAllNotificationsAsRead);
        }

        // Update notification count on page load
        updateNotificationCount();
    });


    // Notice Board Carousel
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
    let noticeInterval;
    if (noticeItems.length > 1) {
        noticeInterval = setInterval(() => {
            let newIndex = currentNotice + 1;
            if (newIndex >= noticeItems.length) newIndex = 0;
            showNotice(newIndex);
        }, 5000);

        // Pause auto-rotation on hover
        const noticeBoard = document.querySelector('.notice-board');
        noticeBoard.addEventListener('mouseenter', () => {
            clearInterval(noticeInterval);
        });

        noticeBoard.addEventListener('mouseleave', () => {
            noticeInterval = setInterval(() => {
                let newIndex = currentNotice + 1;
                if (newIndex >= noticeItems.length) newIndex = 0;
                showNotice(newIndex);
            }, 5000);
        });
    }

    // Click on indicators to go to specific notice
    noticeIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showNotice(index);
        });
    });

    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const headerActions = document.querySelector('.header-actions');

    mobileMenuToggle.addEventListener('click', () => {
        headerActions.classList.toggle('active');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!headerActions.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
            headerActions.classList.remove('active');
        }
    });

    // Refresh Button Animation
    const refreshBtn = document.querySelector('.refresh-btn');

    refreshBtn.addEventListener('click', function () {
        this.disabled = true;
        const icon = this.querySelector('i');
        icon.style.transform = 'rotate(360deg)';

        // Simulate refresh action
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    });

    // Search Functionality
    const appSearch = document.getElementById('appSearch');
    const appsGrid = document.getElementById('appsGrid');

    if (appSearch && appsGrid) {
        appSearch.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const appCards = appsGrid.querySelectorAll('.app-card');

            appCards.forEach(card => {
                const title = card.getAttribute('data-title');
                const desc = card.getAttribute('data-desc');

                if (title.includes(searchTerm) || desc.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Initialize all elements with fade-in animation
    const elementsToAnimate = document.querySelectorAll('.dashboard-header, .notice-board, .apps-grid, .quick-stats');
    elementsToAnimate.forEach((element, index) => {
        element.style.opacity = '0';
        setTimeout(() => {
            element.classList.add('fade-in');
        }, index * 100);
    });

    // Handle PWA install prompt
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        const installPrompt = document.querySelector('.pwa-install-prompt');
        const installBtn = document.querySelector('.pwa-install');
        const cancelBtn = document.querySelector('.pwa-cancel');

        // Show the install prompt
        setTimeout(() => {
            installPrompt.classList.add('active');
        }, 10000); // Show after 10 seconds

        installBtn.addEventListener('click', () => {
            e.prompt();
            installPrompt.classList.remove('active');

            e.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }
            });
        });

        cancelBtn.addEventListener('click', () => {
            installPrompt.classList.remove('active');
            // Don't show again for a week
            localStorage.setItem('pwaPromptDismissed', Date.now());
        });
    });

    // Check if we should show the PWA prompt
    const lastDismissed = localStorage.getItem('pwaPromptDismissed');
    if (lastDismissed && (Date.now() - lastDismissed < 7 * 24 * 60 * 60 * 1000)) {
        document.querySelector('.pwa-install-prompt').style.display = 'none';
    }

    // Check if the app is running as PWA
    if (window.matchMedia('(display-mode: standalone)').matches) {
        document.querySelector('.pwa-install-prompt').style.display = 'none';
    }


});