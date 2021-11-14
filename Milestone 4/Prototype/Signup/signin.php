<?php
require_once '../php/db_connect.php';
require_once '../php/functions.php';

session_start();
if(empty($_POST))
{    
    $alert = "";
}

if(isset($_COOKIE["member_login"]) || !empty($_COOKIE["member_login"]))
{
    $user_email_text = 'value="'.$_COOKIE["member_login"].'"';
}
else
{
    $user_email_text = 'placeholder="Enter email"';
}

if(isset($_POST['login']))
{
    $user_email = mysql_entities_fix_string($db, $_POST['email']);
    $password = mysql_entities_fix_string($db, $_POST['password']);

    //combine password with salt values
    $token = hash('ripemd128',$salt1.$password.$salt2);
    
    //check if the name is already in the table
    $getStmt = 'SELECT user_name, user_email, user_id, user_password FROM user WHERE user_email = \'' .$user_email . '\'';
    $results = $db->query($getStmt);
    
    if($results->num_rows)
    {        
        $row = $results->fetch_array(MYSQLI_NUM);
        $results->close();
        if($token == $row[3])
        {
            $_SESSION['username'] = $row[0];
            $_SESSION['useremail'] = $row[1];
            $_SESSION['userid'] = $row[2];
            if(isset($_POST["remember"])) 
            {
				setcookie("member_login",$row[1],time()+ (10 * 365 * 24 * 60 * 60));
			} 
            else 
            {
                setcookie("member_login");				
			}
            //$alert = "<div class=\"alert alert-success text-center\">Logged in as ".$row[1].".</div>";       
            header('Location: ../index.php');
        }
        else
            $alert = "<div class=\"alert alert-danger text-center\">Invalid username or password.</div>";       
    }
    else 
    {
        $alert = "<div class=\"alert alert-danger text-center\">Invalid username or password.</div>";       
    }
}
?>

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
    <form name="login" id="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">   
    <div class="form">        
        <h2>Log In</h2>
        <div class="form-element">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" <?php echo $user_email_text ?>>
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required pattern="\S(.*\S)?">
        </div>
        <div class="form-element">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember-me">Remember me</label>
        </div>
        <?php
            echo $alert;
        ?>
        <div class="form-element">
            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
            
        </div>
    </form>
<!--       <div class="forgot-pass">
            <a href="#">Forgot password</a>
        </div>
    -->
        <div class="signup-link">Not a member? <a href="signup.php"> Signup now</a>        </div>
    </div>
</div>
</html>