function topUpUserBidCoinBalance(userId) {
    // Make an AJAX request to update the user's bid coin balance in the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_user_bid_coin_balance.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var bidCoinBalance = document.querySelector('#user-' + userId + '-bid-coin-balance');
          bidCoinBalance.innerHTML = xhr.responseText;
        } else {
          // Handle error
        }
      }
    };
  
    // Send the user ID as a POST parameter
    xhr.send('user_id=' + userId);
  }
  