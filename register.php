<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>login</title>
  <link rel="stylesheet" href="css/login.css">

</head>
<body>

<div class="login-box">
  <h2>register</h2>
  <form method="POST" action="register_process.php">
  <div class="user-box">
    <input type="text" name="full_name" placeholder="Full Name" required>
      <label>Full Name</label>
    </div>
  <div class="user-box">
    <input type="text" name="username" placeholder="Username" required>
      <label>Username</label>
    </div>
    <div class="user-box">
    <input type="email" name="email" placeholder="Email" required>
    <label>Email</label>
    </div>
    <div class="user-box">
    <input type="tel" name="phone_number" placeholder="phone number" required>
      <label>phone number</label>
    </div>
    <div class="user-box">
    <input type="password" name="password" placeholder="Password" required>
      <label>Password</label>
    </div>
    <!-- <div class="form-group">
<input type="hidden" class="form-control" placeholder="" name="balanc" id="extra1" />
</div>
<div class="form-group">
<input type="hidden" class="form-control" placeholder="" name="wit" id="extra1" />
</div> -->

    <button type="submit">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      register
</button>
<p class="text">Already have an account? <a href="login.php">Login</a></p>
  </form>
</div>

  
</body>
</html>
