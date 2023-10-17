
function calculateCountdown() {
    const startDateInput = document.querySelector('start_date');
    const countdownDisplay = document.querySelector('countdown');

    if (startDateInput && countdownDisplay) {
        startDateInput.addEventListener('input', () => {
            const startDateValue = startDateInput.value;

            if (startDateValue) {
                const startDate = new Date(startDateValue).getTime();
                const now = new Date().getTime();
                const countdownInSeconds = Math.max(0, (startDate - now) / 1000);
                const days = Math.floor(countdownInSeconds / (3600 * 24));
                const hours = Math.floor((countdownInSeconds % (3600 * 24)) / 3600);
                const minutes = Math.floor((countdownInSeconds % 3600) / 60);
                const seconds = Math.floor(countdownInSeconds % 60);

                countdownDisplay.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            } else {
                // Handle invalid date input or empty input
                countdownDisplay.innerHTML = 'Invalid date';
            }
        });
    } else {
        console.error('Element not found. Check element IDs.');
    }
}

// Call the calculateCountdown function to update the countdown display
calculateCountdown();
