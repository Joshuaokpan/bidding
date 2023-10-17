<?php
include("db.php");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the auction ID from the request (you can use GET or POST)
if (isset($_POST['auction_id'])) {
    $auctionId = intval($_POST['auction_id']); // Convert to an integer
} else {
    // Handle the case where no auction ID is provided in the request
    echo "Auction ID is required.";
    exit;
}

// SQL query to retrieve the list of users who placed bids for the specified auction
$sql = "SELECT user_id FROM bids WHERE auction_id = $auctionId GROUP BY user_id ORDER BY bid_time DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error fetching user IDs.";
    exit;
}

$positions = 1;

// Iterate through the list of users and update their positions in the leaderboard
while ($row = mysqli_fetch_assoc($result)) {
    $userId = $row['user_id'];

    // SQL query to update the user's position in the leaderboard
    $updateSql = "UPDATE leaderboard SET position = $positions WHERE user_id = $userId AND auction_id = $auctionId";
    if (mysqli_query($conn, $updateSql)) {
        $positions++;
    }
}

// Return a success response
echo json_encode(['success' => true]);

mysqli_close($conn);
?>