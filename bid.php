<?php
// bid.php
session_start();
include("db.php");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    die("User not logged in");
}

// Get user and auction IDs
$userId = $_SESSION['user_id'];
$auctionId = $_POST['auctionId'];

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Get user
    $query = mysqli_prepare($conn, 'SELECT * FROM users WHERE id = ? FOR UPDATE');
    mysqli_stmt_bind_param($query, "i", $userId);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $user = mysqli_fetch_assoc($result);

    // Check if user has enough bids
    if ($user['bid_coin_balance'] < 1) {
        throw new Exception('Not enough bids');
    }

    // Update user bids
    $query = mysqli_prepare($conn, 'UPDATE users SET bid_coin_balance = bid_coin_balance - 1 WHERE id = ?');
    mysqli_stmt_bind_param($query, "i", $userId);
    $result = mysqli_stmt_execute($query);
    if (!$result) {
        throw new Exception('Error updating user bids: ' . mysqli_error($conn));
    }

    // Update session variable
    $_SESSION['bid_coin_balance'] = $user['bid_coin_balance'] - 1;

    // Update auction
    $query = mysqli_prepare($conn, 'UPDATE auctions SET current_bid = current_bid + 1 WHERE id = ?');
    mysqli_stmt_bind_param($query, "i", $auctionId);
    $result = mysqli_stmt_execute($query);
    if (!$result) {
        throw new Exception('Error updating auction: ' . mysqli_error($conn));
    }

    // Commit transaction
    mysqli_commit($conn);
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    die('Error: ' . $e->getMessage());
}

mysqli_close($conn);
?>