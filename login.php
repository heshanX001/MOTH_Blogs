<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="./css/login.css" />
</head>
<body>

  <div class="login-wrapper">
    <form class="login-card" action="./backend-logics/login-logic.php" method="post">
      <h2>Welcome Back</h2>
      <p class="subtitle">Login to your account</p>

      <input type="text" placeholder="Username" name="username" required />
      <input type="password" placeholder="Password" name="password" required />

      <button type="submit" name="login" >Login</button>

      <p class="signup-text">
          Don’t have an account ?
          <a href="./signup.php">Sign Up</a>
      </p>
    </form>
  </div>

</body>
</html>
