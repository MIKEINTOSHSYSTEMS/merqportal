const DYNAMIC_CACHE_NAME = 'merq-portal-dynamic-v1';
const ASSETS_TO_CACHE = [
    '/',
    '/index.php',
    '/assets/css/styles.css',
    '/assets/js/script.js',
    '/assets/js/pwa.js',
    '/assets/images/merq-logo.png',
    '/assets/images/merq-logo-white.png',
    '/assets/images/user-avatar.png',
    '/assets/images/icon-192.png',
    '/assets/images/icon-512.png',
    'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
];

// Install Service Worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(DYNAMIC_CACHE_NAME)
            .then((cache) => {
                console.log('Caching app shell');
                return cache.addAll(ASSETS_TO_CACHE);
            })
            .then(() => self.skipWaiting())
            .catch((error) => {
                console.error('Error caching assets during install:', error);
            })
    );
});

// Activate Service Worker
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(
                keyList.map((key) => {
                    if (key !== DYNAMIC_CACHE_NAME) {
                        console.log('Removing old cache', key);
                        return caches.delete(key);
                    }
                })
            );
        })
            .catch((error) => {
                console.error('Error during cache cleanup:', error);
            })
    );
    return self.clients.claim();
});

// Fetch Event
self.addEventListener('fetch', (event) => {
    // Skip cross-origin requests
    if (!event.request.url.startsWith(self.location.origin)) {
        return;
    }

    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            // If the request is cached, return it
            if (cachedResponse) {
                return cachedResponse;
            }

            // Otherwise, fetch the request from the network
            const fetchRequest = event.request.clone();
            return fetch(fetchRequest).then((fetchResponse) => {
                if (!fetchResponse || fetchResponse.status !== 200 || fetchResponse.type !== 'basic') {
                    return fetchResponse;
                }

                // Cache the dynamic response
                const responseToCache = fetchResponse.clone();
                caches.open(DYNAMIC_CACHE_NAME).then((cache) => {
                    cache.put(event.request, responseToCache);
                });

                return fetchResponse;
            }).catch((error) => {
                // Return a fallback response for HTML pages if offline
                if (event.request.headers.get('accept').includes('text/html')) {
                    return caches.match('/offline.html');
                }
            });
        })
    );
});

// Message Event
self.addEventListener('message', (event) => {
    if (event.data.type === 'CHECK_FOR_UPDATES') {
        checkForUpdates();
    }
});

// Function to check for updates to the app
function checkForUpdates() {
    fetch('/index.php', { cache: 'no-store' })
        .then((response) => {
            if (!response.ok) throw new Error('Network response was not ok');

            return response.text();
        })
        .then((html) => {
            caches.match('/index.php').then((cachedResponse) => {
                if (!cachedResponse) return;

                cachedResponse.text().then((cachedHtml) => {
                    if (html !== cachedHtml) {
                        self.clients.matchAll().then((clients) => {
                            clients.forEach((client) => {
                                client.postMessage({
                                    type: 'UPDATE_AVAILABLE',
                                    message: 'A new version of MERQ Portal is available. Refresh to update.'
                                });
                            });
                        });
                    }
                });
            });
        })
        .catch((error) => {
            console.log('Update check failed:', error);
        });
}