<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Auction</title>
</head>
<body>
    <h1>Edit Auction</h1>

    <?php
    // Include your database connection code here
    include("../database/confi.php");

    // Check if an auction ID is provided via GET request
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $auction_id = $_GET['id'];

        // Retrieve auction details from the database
        $sql = "SELECT * FROM auctions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $auction_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $auction = $result->fetch_assoc();
        $stmt->close();

        if ($auction) {
            // Display the edit form
            ?>
            <form method="POST" action="update_auction.php">
                <input type="hidden" name="auction_id" value="<?php echo $auction['id']; ?>">
                <label for="auction_title">Auction Title:</label>
                <input type="text" name="auction_title" id="auction_title" value="<?php echo $auction['auction_title']; ?>" required><br>

                <label for="start_date">Start Date:</label>
                <input type="datetime-local" name="start_date" id="start_date" value="<?php echo date('Y-m-d\TH:i', strtotime($auction['start_date'])); ?>" required><br>

                <!-- You can add more fields here for editing other auction details -->

                <button type="submit">Update Auction</button>
            </form>
            <?php
        } else {
            echo "Auction not found.";
        }
    } else {
        echo "Invalid auction ID.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
