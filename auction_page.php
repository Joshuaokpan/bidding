<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/auction-page.css"> 
    <link rel="stylesheet" href="./css/header.css">
    <title>Auction Page</title>
</head>
<body>
    

<div class="header">
    
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
            

            if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
                echo 'hi, ' . $_SESSION['username'] . '!';
                echo '<a href="buy_bids.php" style="text-decoration: none; color: black;">BUY BIDS</a>';
                echo '<a href="profile.php" style="text-decoration: none; color: black;">PROFILE</a>';
                echo '<a href="notifications.php" style="text-decoration: none; color: black;">NOTIFICATIONS</a>';
                echo '<a href="shop.php" style="text-decoration: none; color: black;">Shop</a>';
                
               
                if (isset($_SESSION['bid_coin_balance'])) {
                    echo '<p>Bid Coin Balance: ' . $_SESSION['bid_coin_balance'] . '</p>';
                }
           
                if (isset($_SESSION['main_amount'])) {
                    echo '<p>Main Amount: ' . $_SESSION['main_amount'] . '</p>';
                }
            } else {
                
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
           
            if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
                echo '<a href="logout.php"><button>Log out</button></a>';
            }
            ?>
        </div>
    </div>
</div>
</div>

<div class="menu-con">
    <!-- Menu content here -->
</div>

<?php

include("db.php");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_GET['id'])) {
    $auctionId = intval($_GET['id']); 
} else {
   
    $auctionId = 1; 
}

// SQL query to retrieve auction information including current_bid
$sql = "SELECT auction_title, image_path, current_bid FROM auctions WHERE id = $auctionId";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $auctionTitle = $row['auction_title'];
    $imagePath = $row['image_path'];
    $currentBid = $row['current_bid']; 
} else {
    $auctionTitle = "Auction Not Found";
    $imagePath = "default-image.jpg";
    $currentBid = 0; 
}


mysqli_close($conn);
?>

<div class="auction-container">
    <div class="auction-item">
        <img src="<?php echo $imagePath; ?>" alt="<?php echo $auctionTitle; ?>"style="width:60px">
        <h1><?php echo $auctionTitle; ?></h1>
        <p>Current Bid: $<?php echo $currentBid; ?></p>

        <button class="bid-button" data-bid-amount="1">Place Bid</button>

       
    </div>
</div>

<div class="middle">
        <!-- <div id="countdown-timer">Countdown: <span id="timer">20</span> seconds</div> -->
    <div class="head">

        <div class="current">
            <p>Current Bidder :</p>
            <div class="wrap">
            <img src="img/avatar.png" alt="avatar">
            <div class="name">
            <?php
            $username = "guess";
            echo $_SESSION['username'] ;
            ?>
            </div>
            </div>
            
        </div>
    </div>

    <div id="leaderboard">
    <h2>Leaderboard</h2>
    <ul id="leaderboard-list">
        <!-- Leaderboard data will be inserted here by JavaScript -->
    </ul>
</div>
</div>

<script>
  // Add this to your menuController.js file
document.querySelector('.bid-button').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'bid.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            alert('Bid placed successfully');
            fetchLeaderboardData();  // Fetch and update the leaderboard data
            location.reload();  // Reload the page
        } else {
            alert('Error placing bid');
        }
    };
    xhr.send('auctionId=' + this.dataset.bidAmount);
});
</script>
<script>
    function fetchLeaderboardData() {
    const auctionId = <?php echo $auctionId; ?>; // Replace with the actual auction ID

    fetch('fetch_leaderboard.php', {
        method: 'POST',
        body: JSON.stringify({ auctionId: auctionId }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            // Update the leaderboard section in your HTML
            const leaderboardList = document.getElementById('leaderboard-list');
            leaderboardList.innerHTML = ''; // Clear the existing content

            data.forEach(item => {
                const leaderboardItem = document.createElement('li');
                leaderboardItem.innerHTML = `
                    <div class="user">
                        <div class="profile">
                            <img src="img/avatar.png" alt="">
                        </div>
                        <div class="name">${item.username}</div>
                        <div class="bid">₦${item.bid_amount}</div>
                    </div>
                `;
                leaderboardList.appendChild(leaderboardItem);
            });
        }
    })
    .catch(error => {
        console.error('Error fetching leaderboard data:', error);
    });
}

</script>
<script src="./js/menuController.js"></script>


</body>
</html>
