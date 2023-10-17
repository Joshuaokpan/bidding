<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Establish a database connection (replace with your database credentials)
include("db.php");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the auction ID from the URL parameter
if (isset($_GET['id'])) {
    $auctionId = intval($_GET['id']);
} else {
    $auctionId = 1; // Default auction ID
}

// SQL query to retrieve the current bid for the given auction
$sql = "SELECT current_bid FROM auctions WHERE id = $auctionId";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $currentBid = $row['current_bid'];
} else {
    $currentBid = 0;
}

// Return the current bid as JSON
echo json_encode(["currentBid" => $currentBid]);

mysqli_close($conn);
?>
