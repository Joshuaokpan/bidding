        // Function to fetch user count from the server
        function fetchUserCount() {
            fetch('user_count.php') 
                .then(response => response.json())
                .then(data => {
                    const userCountElement = document.getElementById('user-count');
                    userCountElement.textContent = data.userCount;
                })
                .catch(error => {
                    console.error('Error fetching user count:', error);
                });
        }

        // Fetch the initial user count when the page loads
        fetchUserCount();

        // Set up an interval to periodically update the user count
        setInterval(fetchUserCount, 60000);