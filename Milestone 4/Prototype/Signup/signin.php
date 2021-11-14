<?php
require_once '../php/db_connect.php';
require_once '../php/functions.php';

//salt phrases
$salt1 = 'awdaw#1';
$salt2 = '!@#45';

if(empty($_POST))
{
    $alert = "";
}

if(isset($_POST['login']))
{
    $username = mysql_entities_fix_string($db, $_POST['username']);
    $password = mysql_entities_fix_string($db, $_POST['password']);

    //combine password with salt values
    $token = hash('ripemd128',$salt1.$password.$salt2);
    
    //check if the name is already in the table
    $getStmt = 'SELECT user_name, user_password FROM user WHERE user_name = \'' . $username .'\' OR user_email = \'' .$username . '\'';
    $results = $db->query($getStmt);
    
    if($results->num_rows){        
        $row = $results->fetch_array(MYSQLI_NUM);
        $results->close();
        if($token == $row[1]){
            session_start();
            $_SESSION['username'] = $row[0];
            $_SESSION['password'] = $row[1];
            if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
			} 
            else 
            {
                if(isset($_COOKIE["member_login"])) 
                {
					setcookie ("member_login","");
				}
			}
            //$alert = "<div class=\"alert alert-success text-center\">Logged in as ".$row[1].".</div>";       
            header('Location: ../index.php');
        }
        else
            $alert = "<div class=\"alert alert-danger text-center\">Invalid username or password.</div>";       
    }
    else {
        $alert = "<div class=\"alert alert-danger text-center\">Invalid username or password.</div>";       
    }       
}

//if register button was pressed
elseif(isset($_POST['register']))
{
    $username = mysql_entities_fix_string($db, $_POST['reg_username']);
    $password = mysql_entities_fix_string($db, $_POST['reg_password']);    
    
    $token = hash('ripemd128',$salt1.$password.$salt2);
    
    $tablecheck = 'SELECT * FROM USERS WHERE USERNAME = \'' .$username . '\'';
    
    $results = $db->query($tablecheck);    
    
    if($results->num_rows !=0){
        //work on getting this implemented with AJAX instead so form doesn't reload.
        $alert = "";
        $results->close();
    }
    else{
        $insertStmt = 'INSERT INTO USERS (ID, USERNAME, PASSWORD) VALUES (NULL, \''.$username.'\',\''.$token.'\')';
        $db->query($insertStmt);
        $alert = "<div class=\"alert alert-success text-center\">User created. Please login.</div>";
        $results->close();
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
            <input type="text" name="username" id="username" placeholder="Enter email/username">
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password">
        </div>
        <div class="form-element">
            <input type="checkbox" id="remember">
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