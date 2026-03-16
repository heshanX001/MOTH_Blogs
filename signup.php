<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT_BLOGGERS</title>
    <link rel="stylesheet" href="./css/signup.css">

</head>
<body>
    <div class="signup-wrapper">
    <form class="signup-card" action="./backend-logics/signup-logic.php" method="post">
      <h2>Create Account</h2>
      <p class="subtitle">Join with IT BLOGGERS and get started</p>

      <div class="input-group">
        <input type="text" placeholder="First Name" name="fname" required />
        <input type="text" placeholder="Last Name" name="lname" required />
      </div>

      <input type="text" placeholder="Username" name="username" required />
      <input type="email" placeholder="Email" name="email" required>
      <input type="password" placeholder="Password" name="password" required />
      <input type="password" placeholder="Confirm Password" name="cpassword" required />

      <select name="role" required>
        <option value="" disabled selected>-- Select Role --</option>
        <option value="author">Author</option>
        <option value="viewer">Viewer</option>
      </select>

      <button type="submit" name="signup">Sign Up</button>

      <p class="login-text">
        Already have an account ?
        <a href="./login.php">Login</a>
      </p>
    </form>
  </div>
</body>
</html>