<?php
include("confi.php"); // Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auction_id = $_POST["auction_id"];
    $auction_title = $_POST["auction_title"];
    $start_date = $_POST["start_date"];

    // Update auction details in the database
    $sql = "UPDATE auctions SET auction_title = ?, start_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $auction_title, $start_date, $auction_id);

    if ($stmt->execute()) {
        echo "Auction updated successfully!";
    } else {
        echo "Error updating auction: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
