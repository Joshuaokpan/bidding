<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link rel="stylesheet" href="css/user_m.css">
</head>
<body>
  <div class="header">
    <h1>User Management</h1>
    <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
  </div>
  <div class="content">
    <h2>Users List</h2>
    <table>
      <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Bid Coin Balance</th>
        <th>Actions</th>
      </tr>

      <?php
      include('db.php');

      // Query to get user data (replace with your actual SQL query)
      $sql = "SELECT id, username, bid_coin_balance FROM users";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $userId = $row['id'];
          $username = $row['username'];
          $bidCoinBalance = $row['bid_coin_balance'];

          echo "<tr>";
          echo "<td>$userId</td>";
          echo "<td>$username</td>";
          echo "<td>$bidCoinBalance</td>";
          echo "<td>";
          echo "<button class='top-up-btn' data-user-id='$userId' onclick='topUpUserBidCoinBalance($userId)'>Top-Up</button>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
      }
      mysqli_close($conn);
      ?>
    </table>
  </div>

  <script>
    function topUpUserBidCoinBalance(userId) {
      // Make an AJAX request to update the user's bid coin balance in the database
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'update_user_bid_coin_balance.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send('user_id=' + userId);

      // Once the request is successful, update the user's bid coin balance on the page
      xhr.onload = function() {
        if (xhr.status === 200) {
          var bidCoinBalance = document.querySelector('#user-' + userId + '-bid-coin-balance');
          bidCoinBalance.innerHTML = xhr.responseText;
        } else {
          // Handle error
        }
      };
    }
  </script>
</body>
</html>
