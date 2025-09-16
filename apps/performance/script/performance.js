// Digital Clock Functionality
function updateClock() {
    const now = new Date();
    const timeElem = document.getElementById('clockTime');
    const dateElem = document.getElementById('clockDate');
    const greetingElem = document.getElementById('greeting');

    // Update time
    const timeString = now.toLocaleTimeString('en-US', {
        hour12: false
    });
    if (timeElem) timeElem.textContent = timeString;

    // Update date
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    const dateString = now.toLocaleDateString('en-US', options);
    if (dateElem) dateElem.textContent = dateString;

    // Update greeting based on time of day
    const hour = now.getHours();
    let greeting = "Good ";
    if (hour < 12) greeting += "Morning";
    else if (hour < 18) greeting += "Afternoon";
    else greeting += "Evening";

    if (greetingElem) greetingElem.textContent = greeting;
}

// Update clock immediately and then every second
updateClock();
setInterval(updateClock, 1000);