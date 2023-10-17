<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="header">
        <h1>Admin Panel</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="content">
        <div class="user-count">
            <h2>Total Users</h2>
            <p id="user-count">Loading...</p>
        </div>
    </div>
    <a href="user_list.html" target="_blank"> user list </a>
    <div class="admin-links">
        <ul>
            <li>
            <a href="auctions/add_auction.php">Add Auction</a>
            </li>
            <li>
            <a href="auctions/edit_auction.php">Edit Auction</a>
            </li>
            <li>
            <a href="auctions/delete_auction.php">Delete Auction</a>
            </li>
          
        </ul>
   
        </div>
        </ hr>
        <a href="user_management.php">user_management</a>
       
    <script src="js/admin.js"></script>
</body>
</html>
