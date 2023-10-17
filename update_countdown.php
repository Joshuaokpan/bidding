<?php
// Establish a database connection (replace with your database credentials)
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

// SQL query to retrieve the current countdown timer
$sql = "SELECT countdown_timer FROM auctions WHERE id = $auctionId";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error fetching countdown timer.";
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $countdownTimer = $row['countdown_timer'];

    // Decrease the countdown timer by 1 second
    $countdownTimer = max($countdownTimer - 1, 0);

    // Update the countdown timer in the database
    $updateSql = "UPDATE auctions SET countdown_timer = $countdownTimer WHERE id = $auctionId";
    if (mysqli_query($conn, $updateSql)) {
        echo json_encode(['success' => true, 'countdownTimer' => $countdownTimer]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update countdown timer']);
    }
} else {
    echo "Auction not found.";
}

mysqli_close($conn);
?>
