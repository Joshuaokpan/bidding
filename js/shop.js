// Function to handle buying bids
function buyBids(bidCount, price) {
    const confirmPurchase = confirm(`Buy ${bidCount} Bids for ₦${price}?`);
    
    if (confirmPurchase) {
        // Send an AJAX request to the server to process the purchase
        fetch('purchase_bids.php', {
            method: 'POST',
            body: JSON.stringify({ bidCount, price }),
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Purchase was successful, update the UI
                alert(data.message);
                const userCountElement = document.getElementById('user-count');
                userCountElement.textContent = data.userCount; // Update the user count (if needed)
            } else {
                // Purchase failed, show an error message
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error processing bid purchase:', error);
            alert('Error processing bid purchase. Please try again later.');
        });
    }
}
