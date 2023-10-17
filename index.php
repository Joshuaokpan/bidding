<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/index.css">
    <title>php home</title>
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

<div class="oblique">
            <div class="main-block-oblique skew-block">
              <div class="skew-block-repeat">
                <a href="auction.php">
                  <div class="oblique-inner">
                    <div class="image-wrapper">
                      <div class="main-image">
                        <img class="image-img"
                          src="https://images.unsplash.com/photo-1583512603834-01a3a1e56241?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80"
                          alt="Auction">
                      </div>
                    </div>
                  </div>

                  <div class="oblique-caption caption-top">
                    <h2>Auctions</h2>
                    <button href="">join now</button>
                  </div>
                </a>
              </div>
              <div class="skew-block-repeat">
                <a href="dice.html">
                  <div class="oblique-inner">
                    <div class="image-wrapper">
                      <div class="main-image">
                        <img class="image-img"
                          src="https://images.unsplash.com/photo-1617527019968-052733f9cfe8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1856&q=80"
                          alt="dice">
                      </div>
                    </div>
                  </div>
                  <div class="oblique-caption caption-bottom">
                    <h2>Dice</h2>
                    <button href="dice.html">Play now</button>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="oblique">
            <div class="main-block-oblique skew-block">
              <div class="skew-block-repeat">
                <a href="spin.html">
                  <div class="oblique-inner">
                    <div class="image-wrapper">
                      <div class="main-image">
                        <img class="image-img"
                          src="https://media.istockphoto.com/id/1417665620/photo/wheel-of-fortune-on-red-background.jpg?s=1024x1024&w=is&k=20&c=--Ud7IjQXIhKub9vofgRAIT_gBNFr8r6ZE0VJDBfJ38="
                          alt="spin">
                      </div>
                    </div>
                  </div>

                  <div class="oblique-caption caption-top">
                    <h2>Spin</h2>
                    <button href="#">join now</button>
                  </div>
                </a>
              </div>
              <div class="skew-block-repeat">
                <a href="games.html">
                  <div class="oblique-inner">
                    <div class="image-wrapper">
                      <div class="main-image">
                        <img class="image-img"
                          src="https://images.unsplash.com/photo-1533237264985-ee62f6d342bb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80"
                          alt="games">
                      </div>
                    </div>
                  </div>
                  <div class="oblique-caption caption-bottom">
                    <h2>Games</h2>
                    <button href="#">Play now</button>
                  </div>
                </a>
              </div>
            </div>
          </div>

<!-- Your remaining HTML content here -->

<script src="./js/menuController.js"></script>
<script src="./js/wait.js"></script>
</body>
</html>
