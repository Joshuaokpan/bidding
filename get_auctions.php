<?php
include("db.php");

// Query to retrieve all auctions
$sql = "SELECT * FROM auctions";
$result = $conn->query($sql);

$auctions = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $auctions[] = $row;
    }
}

echo json_encode($auctions);
$conn->close();
?>
