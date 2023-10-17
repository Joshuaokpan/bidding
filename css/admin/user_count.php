<?php
Include("database/confi.php");

// Query to get the total number of users from your database
$sql = "SELECT COUNT(*) AS user_count FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userCount = $row['user_count'];
} else {
    $userCount = 0; // Set a default value if no users are found
}

// Convert the user count to JSON and echo it
echo json_encode(['userCount' => $userCount]);
?>
