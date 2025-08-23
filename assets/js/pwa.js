// Register Service Worker and set up listeners on page load
window.addEventListener('load', () => {
    if ('serviceWorker' in navigator) {
        // Register the Service Worker
        navigator.serviceWorker.register('/service-worker.js')
            .then(registration => {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(err => {
                console.log('ServiceWorker registration failed: ', err);
            });

        // Initial check for updates after a short delay
        setTimeout(checkForUpdates, 5000);
    }
});

// Listen for controller change (when a new service worker takes over)
navigator.serviceWorker.addEventListener('controllerchange', () => {
    // Reload the page to activate the new Service Worker immediately
    // This provides a smooth update flow
    window.location.reload();
});

// Function to check for updates by messaging the Service Worker
function checkForUpdates() {
    if (!navigator.serviceWorker || !navigator.serviceWorker.controller) {
        return;
    }
    // Send a message to the Service Worker to trigger the update check
    navigator.serviceWorker.controller.postMessage({ type: 'CHECK_FOR_UPDATES' });
}

// Check for updates every hour
setInterval(checkForUpdates, 60 * 60 * 1000);

// Handle messages from the Service Worker
navigator.serviceWorker.addEventListener('message', event => {
    if (event.data.type === 'UPDATE_AVAILABLE') {
        showUpdateNotification(event.data.message);
    }
});

// Function to display the modern update notification
function showUpdateNotification(message) {
    // Check if a notification already exists to prevent duplicates
    if (document.querySelector('.update-notification')) {
        return;
    }

    const updateNotification = document.createElement('div');
    updateNotification.className = 'update-notification';
    updateNotification.innerHTML = `
        <div class="notification-content">
            <p>${message}</p>
            <div class="notification-actions">
                <button id="refreshApp" class="refresh-button">Refresh</button>
                <button id="dismissNotification" class="dismiss-button">&times;</button>
            </div>
        </div>
    `;

    document.body.appendChild(updateNotification);

    // Add event listener to the refresh button
    document.getElementById('refreshApp').addEventListener('click', () => {
        window.location.reload();
    });

    // Add event listener to the dismiss button
    document.getElementById('dismissNotification').addEventListener('click', () => {
        updateNotification.remove();
    });
}