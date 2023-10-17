<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Form</title>
    <link rel="stylesheet" href="../css/add_auction.css">
</head>
<body>
    <h1>Add New Auction</h1>
    
    <form method="POST" action="add_auction.php" enctype="multipart/form-data">
    <label for="auction_title">Auction Title:</label>
    <input type="text" name="auction_title" id="auction_title" required><br>

    <label for="start_date">Start Date:</label>
    <input type="datetime-local" name="start_date" id="start_date" required><br>

    
    <label for="end_date_time">End Date and Time:</label>
    <input type="datetime-local" name="end_date_time" id="end_date_time" required><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4" required></textarea><br>


    <label for="image">Upload Image:</label>
    <input type="file" name="image" id="image" required><br>

    <button type="submit">Submit</button>
</form>


<?php
include("../database/confi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auction_title = $_POST["auction_title"];
    $start_date = $_POST["start_date"];
    $description = $_POST["description"];

    
    if (isset($_POST["end_date_time"])) {
        $end_date_time = $_POST["end_date_time"];
        
    } else {
        // Handle the case where "end_date_time" is not set in the form
        echo "End Date and Time is not set in the form.";
    }
    

    // Handle file upload
    $target_directory = "../../auction_uploads/";
    $target_file = $target_directory . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Check file size (adjust the size limit as needed)
        if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            echo "Sorry, your file is too large.";
        } else {
            // Allow only certain file formats (adjust as needed)
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            } else {
                // Generate a unique filename to prevent overwriting
                $unique_filename = uniqid() . "." . $imageFileType;
                $file_destination = $target_directory . $unique_filename;

                // Move the uploaded file to its final destination
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_destination)) {
                    // Generate the relative path based on the filename
                    $relative_path = "/copup/auction_uploads/" . $unique_filename;

                    $sql = "INSERT INTO auctions (auction_title, start_date, end_date_time, image_path, description) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $auction_title, $start_date, $end_date_time, $relative_path, $description);
                    

                    // Execute the query and handle any errors
                    if ($stmt->execute()) {
                        echo "Auction added successfully!";
                    } else {
                        echo "Error adding auction: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "File is not an image.";
    }
}

$conn->close();
?>

         <script src="../js/countdown.js"></script>
</body>
</html>
