// Lock the user out after 5 minutes of inactivity
const lockTimeout = 5 * 60 * 1000; // 5 minutes in milliseconds
let timeoutId;

function resetTimer() {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(logout, lockTimeout);
}

function logout() {
    // Redirect the user to the login page
    window.location.href = "login.html";
}

// Reset timer on any interaction
document.addEventListener("mousemove", resetTimer);
document.addEventListener("keypress", resetTimer);

// Start the timer initially
resetTimer();
