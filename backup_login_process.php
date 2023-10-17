<?php
include("db.php"); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    $sql = "SELECT id, username, password, bid_coin_balance, main_amount FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($input_password, $row["password"])) {
            // Start a session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            // Set session variables to indicate that the user is logged in
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $row["id"];
            $_SESSION['username'] = $row["username"];
            
            // Set additional session variables
            $_SESSION['bid_coin_balance'] = $row["bid_coin_balance"];
            $_SESSION['main_amount'] = $row["main_amount"];

            header("Location: index.php"); // Redirect to the dashboard or another page upon successful login
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
}

$conn->close();
?>
