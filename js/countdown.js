// Function to fetch and display auctions
function displayAuctions() {
    fetch('get_auctions.php')
        .then(response => response.json())
        .then(data => {
            const auctionContainer = document.getElementById('auction-container');

            // Clear the current content in the container
            auctionContainer.innerHTML = '';

            data.forEach(auction => {
                // Create a div for each auction
                const auctionDiv = document.createElement('div');
                auctionDiv.classList.add('bid-box');

                // Create HTML for each auction item
                auctionDiv.innerHTML = `
                    <div class="title">
                        <p>${auction.auction_title}</p>
                    </div>
                    <div class="content">
                        <div class="img">
                            <img src="${auction.image_path}" alt="${auction.auction_title}">
                        </div>
                        <div class="start-date">
                            <p>Start Date: ${auction.start_date}</p>
                        </div>
                        <div class="start-time" id="start-time-${auction.id}">
                            <!-- Start time will be displayed here -->
                        </div>
                        <div class="countdown-timer" id="countdown-timer-${auction.id}">
                            <!-- Countdown timer will be displayed here -->
                        </div>
                        <div class="action-button" id="action-button-${auction.id}">
                            <button class="waitlist-button" data-auction-id="${auction.id}">Waitlist</button>
                            <button class="bid-now-button" style="display: none;">Bid Now</button>
                        </div>
                    </div>
                `;

                // Append the auction item to the container
                auctionContainer.appendChild(auctionDiv);

                // Calculate the countdown for each auction
                calculateCountdown(auction.start_date, auction.id);
            });
        })
        .catch(error => {
            console.error('Error fetching auctions:', error);
        });
}

// Function to calculate and display countdown for an auction
function calculateCountdown(startTime, auctionId) {
    const startTimeStamp = new Date(startTime).getTime();
    const countdownElement = document.getElementById(`countdown-timer-${auctionId}`);
    const waitlistButton = document.querySelector(`#auction-container #action-button-${auctionId} .waitlist-button`);
    const bidNowButton = document.querySelector(`#auction-container #action-button-${auctionId} .bid-now-button`);

    // Update the countdown every second
    const countdownInterval = setInterval(() => {
        const now = new Date().getTime();
        const timeRemaining = startTimeStamp - now;

        if (timeRemaining <= 0) {
            clearInterval(countdownInterval);
            countdownElement.innerHTML = "Auction has started!";

            // Show the "Bid Now" button and hide the "Waitlist" button
            waitlistButton.style.display = "none";
            bidNowButton.style.display = "block";

            // Set the link for the "Bid Now" button
            bidNowButton.addEventListener('click', () => {
                window.location.href = `auction_page.php?id=${auctionId}`;
            });
        } else {
            const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `Time Left: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
}

// Call the function to display auctions when the page loads
displayAuctions();

// Add an event listener to the document to handle the "Waitlist" button clicks
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('waitlist-button')) {
        const auctionId = event.target.getAttribute('data-auction-id');
        // Call a function to add the auction to the user's notifications
        addToNotifications(auctionId);
    }
});

// Function to add an auction to the user's notifications
function addToNotifications(auctionId) {
    // Send an AJAX request to a PHP script (add_to_notifications.php) to add the auction to notifications
    // You can use the Fetch API or XMLHttpRequest to send the request
    // Include the auctionId as data in the request

    // Example using Fetch API:
    fetch('add_to_notifications.php', {
        method: 'POST',
        body: JSON.stringify({ auctionId }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Optionally, you can update the UI to indicate that the auction was added to notifications
                alert('Auction added to notifications successfully!');
            } else {
                alert('Failed to add auction to notifications.');
            }
        })
        .catch(error => {
            console.error('Error adding auction to notifications:', error);
        });
}
