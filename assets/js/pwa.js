// Register Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
            .then(registration => {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(err => {
                console.log('ServiceWorker registration failed: ', err);
            });
    });
}

// Listen for controller change (when new service worker takes over)
navigator.serviceWorker.addEventListener('controllerchange', () => {
    window.location.reload();
});

// Function to check for updates
function checkForUpdates() {
    if (!navigator.serviceWorker || !navigator.serviceWorker.controller) return;

    navigator.serviceWorker.controller.postMessage({ type: 'CHECK_FOR_UPDATES' });
}

// Check for updates every hour
setInterval(checkForUpdates, 60 * 60 * 1000);

// Initial check after page load
window.addEventListener('load', () => {
    setTimeout(checkForUpdates, 5000);
});

// Handle messages from service worker
navigator.serviceWorker.addEventListener('message', event => {
    if (event.data.type === 'UPDATE_AVAILABLE') {
        // Show update notification to user
        const updateNotification = document.createElement('div');
        updateNotification.className = 'update-notification';
        updateNotification.innerHTML = `
            <p>A new version of MERQ Portal is available.</p>
            <button id="refreshApp">Refresh</button>
        `;
        document.body.appendChild(updateNotification);

        document.getElementById('refreshApp').addEventListener('click', () => {
            window.location.reload();
        });
    }
});