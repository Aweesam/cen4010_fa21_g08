<html>
<head>
    <title>Log in Pop up</title>
    <link rel="stylesheet" href="login.css" />
    <script src="login.js"></script> 
</head>

<div class="center">
    <button id="show-login">Login</button>
</div>
<div class="popup">
    <!-- <div class="active">&times;</div> -->
    <script src="login.js"></script>
    <div class="close-btn">&times;</div>
    <div class="form">
        <h2>Log In</h2>
        <div class="form-element">
            <label for="email">Email</label>
            <input type="text" id="email" placeholder="Enter email">
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter password">
        </div>
        <div class="form-element">
            <input type="checkbox" id="remember-me">
            <label for="remember-me">Remember me</label>
        </div>
        <div class="form-element">
            <button>Sign in</button>
        </div>
        <div class="forgot-pass">
            <a href="#">Forgot password</a>
        </div>
        <div class="signup-link">Not a member? <a href="signup.php"> Signup now</a></div>
    </div>
</div>
</html>