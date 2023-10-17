<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get the number of bids and the price from the AJAX request
$bidCount = $_POST['bidCount'];
$price = $_POST['price'];

// Calculate the new bid coin balance
$newBalance = $_SESSION['bid_coin_balance'] + $bidCount;

// Update the user's bid coin balance in the database (you should have a users table)
include('db.php');

$userId = $_SESSION['user_id'];
$updateQuery = "UPDATE users SET bid_coin_balance = ? WHERE id = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param('ii', $newBalance, $userId);

if ($stmt->execute()) {
    $_SESSION['bid_coin_balance'] = $newBalance;
    echo json_encode(['success' => true, 'message' => 'Bid purchase successful']);
} else {
    echo json_encode(['success' => false, 'message' => 'Bid purchase failed']);
}

$stmt->close();
$conn->close();
?>
