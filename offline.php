<?php
// offline.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Mode</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #072247;
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 400px;
        }

        .icon {
            font-size: 80px;
            color: #ff6347;
            animation: bounce 1s infinite;
        }

        .message {
            font-size: 24px;
            margin-top: 20px;
            color: #444;
            animation: fadeIn 1.5s ease-out;
        }

        .retry {
            margin-top: 30px;
            padding: 12px 20px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: none;
            animation: fadeIn 1.5s ease-out;
        }

        .retry:hover {
            background-color: #218838;
        }

        .offline-img,
        .online-img {
            width: 100px;
            height: 100px;
            margin-top: 20px;
            display: none;
            /* Initially hidden */
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Image to be displayed when offline -->
        <img id="offlineImage" class="offline-img" src="/assets/images/icon-192.png" alt="Offline Icon">

        <!-- Image to be displayed when online -->
        <img id="onlineImage" class="online-img" src="/assets/images/icon-192.png" alt="Online Icon">

        <div id="message" class="message">
            You are currently offline. Please check your internet connection.
        </div>
        <button id="retryButton" class="retry">Retry</button>
    </div>

    <script>
        // Detect if the user is online or offline
        function updateStatus() {
            const messageElement = document.getElementById("message");
            const retryButton = document.getElementById("retryButton");
            const offlineImage = document.getElementById("offlineImage");
            const onlineImage = document.getElementById("onlineImage");

            if (navigator.onLine) {
                messageElement.textContent = "Internet connection restored! Trying to load the application...";
                retryButton.style.display = "none";
                offlineImage.style.display = "none"; // Hide offline image
                onlineImage.style.display = "block"; // Show online image

                // Attempt to reload the application after a short delay
                setTimeout(() => {
                    window.location.href = '/'; // Replace with your app's entry point
                }, 3000);
            } else {
                messageElement.textContent = "You are currently offline. Please check your internet connection.";
                retryButton.style.display = "inline-block"; // Show retry button
                offlineImage.style.display = "block"; // Show offline image
                onlineImage.style.display = "none"; // Hide online image
            }
        }

        // Listen for the online and offline events
        window.addEventListener('online', updateStatus);
        window.addEventListener('offline', updateStatus);

        // Retry button functionality
        document.getElementById('retryButton').addEventListener('click', () => {
            window.location.reload(); // Reload page to check internet again
        });

        // Run status check on initial load
        updateStatus();
    </script>
</body>

</html>