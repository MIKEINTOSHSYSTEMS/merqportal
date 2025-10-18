// Add this to your existing JavaScript or create a new file
document.addEventListener('DOMContentLoaded', function () {
    // Initialize all tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add click effects to CEO feedback badges
    document.querySelectorAll('.ceo-feedback-badge, .ceo-feedback-pulse').forEach(badge => {
        badge.addEventListener('click', function (e) {
            e.stopPropagation();
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('feedback-ripple');
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Enhanced table row interactions
    document.querySelectorAll('.evaluation-table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function () {
            this.style.backgroundColor = '#f8f9fa';
        });

        row.addEventListener('mouseleave', function () {
            this.style.backgroundColor = '';
        });
    });

    // Auto-refresh data every 5 minutes
    setInterval(() => {
        const refreshBtn = document.getElementById('refreshData');
        if (refreshBtn && !refreshBtn.disabled) {
            console.log('Auto-refreshing data...');
            // You can add AJAX call here to refresh data without page reload
        }
    }, 300000); // 5 minutes

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
        .feedback-ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.7);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .ceo-feedback-badge, .ceo-feedback-pulse {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});

// Real-time updates for CEO feedback counts
function updateCEOFeedbackCounts() {
    // This function can be called when new feedback is added
    document.querySelectorAll('.ceo-feedback-badge').forEach(badge => {
        badge.classList.add('pulse');
        setTimeout(() => {
            badge.classList.remove('pulse');
        }, 2000);
    });
}