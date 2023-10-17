<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/auction.css">
    <link rel="stylesheet" href="./css/header.css">

    <title>Auction</title>
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
            session_start();

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
    <div class="auction-wrap">
        <h2>Auctions</h2>
        <div class="container" id="auction-container">
        </div>
    </div>

    <script>
            const userBidCoinBalance = <?php echo isset($_SESSION['bid_coin_balance']) ? $_SESSION['bid_coin_balance'] : 0; ?>;
            const auctionId = <?php echo isset($_GET['id']) ? $_GET['id'] : 1; ?>;
    </script>
    <script src="js/countdown.js"></script>
    <script src="./js/menuController.js"></script>
</body>
</html>
