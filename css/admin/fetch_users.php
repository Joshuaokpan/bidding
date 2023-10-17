<?php

include('database/confi.php');

// Fetch user data from the database
$sql = "SELECT id, username, email, bid_coin_balance FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>User ID</th><th>Username</th><th>Email</th><th>Bid Coin Balance</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['bid_coin_balance'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No users found.';
}

// Close the database connection
$conn->close();
?>
