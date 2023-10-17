<?php
include('db.php');

// Get the user ID from the POST request
$userId = $_POST['user_id'];

// Update the user's bid coin balance in the database
$sql = "UPDATE users SET bid_coin_balance = bid_coin_balance + 10 WHERE id = $userId";
mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);

// Return the user's new bid coin balance
echo '100';
