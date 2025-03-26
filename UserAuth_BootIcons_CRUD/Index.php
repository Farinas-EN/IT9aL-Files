<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication</title>

    <!-- 🔹 Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/styleindex.css"> <!-- Custom CSS file -->

    <!-- 🔹 FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- 🔹 Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body> 

<?php
// Determine which form to display
$formType = isset($_GET['form']) ? $_GET['form'] : 'signIn'; // Default to sign-in
?>

<!-- Sign Up Form -->
<div class="container form-container" id="signUp" style="<?php echo ($formType === 'signUp') ? 'display: block;' : 'display: none;'; ?>">
  <h1 class="form-title">SIGN UP</h1>
  <form method="post" action="Handlers/Register.php"> 

    <div class="input-group">
      <i class="fas fa-user"></i>
      <input type="text" name="fName" id="fNameSignUp" placeholder="First Name" required>
      <label for="fNameSignUp">First Name</label>
    </div>

    <div class="input-group">
      <i class="fas fa-user"></i>
      <input type="text" name="lName" id="lNameSignUp" placeholder="Last Name" required>
      <label for="lNameSignUp">Last Name</label>
    </div>

    <div class="input-group">
      <i class="fas fa-calendar-alt"></i>
      <input type="date" name="dob" id="dobSignUp" required>
    </div>

    <div class="input-group">
      <i class="fas fa-phone"></i>
      <input type="tel" name="number" id="PNumberSignUp" placeholder="Phone Number" required>
      <label for="PNumberSignUp">Phone Number</label>
    </div>

    <div class="input-group"> 
      <i class="fas fa-user"></i>
      <input type="text" name="username" id="usernameSignUp" placeholder="Username" required>
      <label for="usernameSignUp">Username</label> 
    </div>
    
    <div class="input-group"> 
      <i class="fas fa-envelope"></i>
      <input type="email" name="email" id="emailSignUp" placeholder="Email Address" required>
      <label for="emailSignUp">Email Address</label>
    </div>

    <div class="input-group"> 
      <i class="fas fa-lock"></i>
      <input type="password" name="password" id="passwordSignUp" placeholder="Password" required>
      <label for="passwordSignUp">Password</label>
    </div>

    <input type="submit" name="signUp" value="Register" class="btn">
  </form>

  <p class="or"> -------------- or ----------------</p>

  <div class="social-icons">
    <a href="#" class="social-icon google"><i class="fab fa-google"></i></a>
    <a href="#" class="social-icon apple"><i class="fab fa-apple"></i></a>
  </div>

  <div class="links">
    <p>Already have an account?</p>
    <a href="?form=signIn">Log In</a>
  </div>
</div>

<!-- Sign In Form -->
<div class="container form-container" id="signIn" style="<?php echo ($formType === 'signIn') ? 'display: block;' : 'display: none;'; ?>">
  <h1 class="form-title">SIGN IN</h1>
  <form action="Handlers/Login.php" method="POST">

    <div class="input-group"> 
      <i class="fas fa-user"></i>
      <input type="text" name="username" id="usernameSignIn" placeholder="Username" required>
      <label for="usernameSignIn">Please input your Username!</label> 
    </div>

    <div class="input-group"> 
      <i class="fas fa-lock"></i>
      <input type="password" name="password" id="passwordSignIn" placeholder="Password" required>
      <label for="passwordSignIn">Please input your Password!</label>
    </div>

    <p class="recover">
      <a href="#">Forgot Password?</a>
    </p>

    <input type="submit" name="submit" value="Log In" class="btn">
  </form>

  <p class="or"> -------------- or ----------------</p>

  <div class="social-login">
    <button class="social-btn google">
        <i class="fab fa-google"></i>
    </button>
    <button class="social-btn apple">
        <i class="fab fa-apple"></i>
    </button>
  </div>

  <div class="links">
    <p>Don't have an account yet?</p>
    <a href="?form=signUp">Register</a>
  </div>
</div>

</body>
</html>
