<?php
include("db.php"); // Include the database connection script

// Function to fetch leaderboard data for a specific auction
function fetchLeaderboardData($auctionId) {
    global $conn;

    $leaderboardData = array();

    // Query to retrieve the top bidders for the specified auction
    $sql = "SELECT username, bid_amount FROM bids
            WHERE auction_id = $auctionId
            ORDER BY bid_time DESC
            LIMIT 10"; // Adjust the limit as needed

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $leaderboardData[] = array(
                'username' => $row['username'],
                'bid_amount' => $row['bid_amount']
            );
        }
    }

    return $leaderboardData;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['auctionId'])) {
        $auctionId = intval($_POST['auctionId']);
        $leaderboardData = fetchLeaderboardData($auctionId);

        // Return the leaderboard data as JSON
        header('Content-Type: application/json');
        echo json_encode($leaderboardData);
    }
}
?>