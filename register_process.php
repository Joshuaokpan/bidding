<?php
include("db.php"); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    
     // Set default values for bid_coin_balance and main_amount
    $bid_coin_balance = 0;
    $main_amount = 0.00;

    // Check if the username is already in use
    $checkUsernameQuery = "SELECT id FROM users WHERE username=?";
    $stmt = $conn->prepare($checkUsernameQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect back to the registration page with an error message
        header("Location: error.php");
        exit;
    } else {
        // Check if the email is already in use
        $checkEmailQuery = "SELECT id FROM users WHERE email=?";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redirect back to the registration page with an error message
            header("Location: error.php");
            exit;
        } else {
            // Insert the user into the database
            $insertQuery = "INSERT INTO users (username, password, email, phone_number, full_name) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssss", $username, $password, $email, $phone_number, $full_name );

            if ($stmt->execute()) {
                // Redirect to a success page or login page
                header("Location: login.php?registration=success");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }

    $stmt->close();
}

$conn->close();
?>