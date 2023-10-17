<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid Shop</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/shop.css">
</head>
<body>
<div class="header">
    <div class="first">
        <div class="left">
            <div class="menu">
                <img src="./img/icon/menu.png" alt="menu" class="open-nav">
            </div>
        </div>
        <div class="right">
            <div class="log">
                <img src="./img/logo2.png" alt="logo" />
            </div>
        </div>
    </div>

    <div class="second">
        <div class="links">
            <?php
            session_start(); // Start the session

            // Check if the user is logged in
            if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
                // User is logged in, display user-specific content
                echo '<a href="buy_bids.php" style="text-decoration: none; color: black;">BUY BIDS</a>';
                echo '<a href="profile.php" style="text-decoration: none; color: black;">PROFILE</a>';
                echo '<a href="notifications.php" style="text-decoration: none; color: black;">NOTIFICATIONS</a>';
                echo '<a href="shop.php" style="text-decoration: none; color: black;">Shop</a>';
                
                // Check if 'bid_coin_balance' session variable is set
                if (isset($_SESSION['bid_coin_balance'])) {
                    echo '<p>Bid Coin Balance: ' . $_SESSION['bid_coin_balance'] . '</p>';
                }
                
                // Check if 'main_amount' session variable is set
                if (isset($_SESSION['main_amount'])) {
                    echo '<p>Main Amount: ' . $_SESSION['main_amount'] . '</p>';
                }
            } else {
                // User is not logged in, display "Sign Up" and "Login" buttons
                echo '<a href="register.php"><button style="color: #00013d;">Sign Up</button></a>';
                echo '<a href="login.php"><button style="color: #56b2b7;">Login</button></a>';
            }
            ?>
        </div>
    </div>
</div>


<div class="menu-con">
    <div class="top">
        <img src="./img/logo-colored.png" alt="" />
        <div class="close">&times;</div>
    </div>
    <div class="content">
        <div class="list">
            <a href="#" style="text-decoration: none; color: black;"><p>Auctions</p></a>
            <a href="#" style="text-decoration: none; color: black;"><p>Spin</p></a>
            <a href="#" style="text-decoration: none; color: black;"><p>Games</p></a>
            <a href="#" style="text-decoration: none; color: black;"><p>dice</p></a>
        </div>
        <div class="btn">
            <?php
            // Check if the user is logged in to display the "Log out" button
            if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
                echo '<a href="logout.php"><button>Log out</button></a>';
            }
            ?>
        </div>
    </div>
</div>
    <div class="content">
        <h2>Choose a Bid Pack:</h2>
        <div class="bid-packs">
            <div class="bid-pack">
                <h3>5 Bids</h3>
                <p>Price: ₦500</p>
                <button onclick="buyBids(5, 500)">Buy Now</button>
            </div>
            <div class="bid-pack">
                <h3>10 Bids</h3>
                <p>Price: ₦1,000</p>
                <button onclick="buyBids(10, 1000)">Buy Now</button>
            </div>
            <div class="bid-pack">
                <h3>20 Bids</h3>
                <p>Price: ₦2,000</p>
                <button onclick="buyBids(20, 2000)">Buy Now</button>
            </div>
            <div class="bid-pack">
                <h3>25 Bids</h3>
                <p>Price: ₦2,500</p>
                <button onclick="buyBids(20, 2000)">Buy Now</button>
            </div>
            <!-- Add more bid packs with different quantities and prices here -->
        </div>
    </div>
    <script src="js/shop.js"></script>
    <script src="./js/menuController.js"></script>
    <script src="./js/wait.js"></script>
</body>
</html>
