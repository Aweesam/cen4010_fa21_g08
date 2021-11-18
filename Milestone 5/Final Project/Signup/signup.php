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

if(isset($_POST['register']))
{
    $email = mysql_entities_fix_string($db, $_POST['email']);
    $password = mysql_entities_fix_string($db, $_POST['password']);
    $first_name = mysql_entities_fix_string($db, $_POST['firstname']);
    $last_name = mysql_entities_fix_string($db, $_POST['lastname']);
    $user_name = mysql_entities_fix_string($db, $_POST['username']);
    $token = hash('ripemd128',$salt1.$password.$salt2);

    $tablecheck = 'SELECT * FROM user WHERE user_email = \'' .$email . '\'';
    $results = $db->query($tablecheck);            
    if($results->num_rows !=0)
    {
        $alert = "<div class=\"alert alert-danger text-center\">Email already registered.</div>";        
        $results->close();
    }
    else
    {
        $alert = "";
        $insertStmt = 'INSERT INTO user (user_id, user_name, user_email, user_first_name, user_last_name, user_password) 
                        VALUES (NULL, \''.$user_name.'\',\''.$email.'\',\''.$first_name.'\',\''.$last_name.'\',\''.$token.'\')';
        //echo $insertStmt;
        $db->query($insertStmt);
        $results->close();
        session_start();
        $_SESSION['username'] = $user_name;        
        $_SESSION['useremail'] = $email;
        header('Location: ../index.php');        
    }
}   

?>


<html>
    <head>
        <title>Sign up Form</title>
        <link rel="stylesheet" href="signup.css">
    </head>
    <body>
        <div class="sign-up-form">
            <h1>Sign up now</h1>
            <form name="register" id="register" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="firstname" class="Input-box" placeholder="First Name" required pattern="\S(.*\S)?">
                <input type="text" name="lastname" class="Input-box" placeholder="Last Name" required pattern="\S(.*\S)?">
                <input type="email" name="email"  class="Input-box" placeholder="Your email" required>                
                <input type="username" name="username" class="Input-box" placeholder="Desired Username(Can be same as email)" required pattern="\S(.*\S)?">
                <input type="password" name="password" class="Input-box" placeholder="Your password" required pattern="\S(.*\S)?">
                <!--<p><span><input type="checkbox"></span>I agree to the Terms of services</p> -->
                <?php
                  echo $alert;
                ?>
                <button type="submit" name="register" class="signup-btn">Sign up</button>
                <hr>
                <p class="or">OR</p>
                <p>Do you have an account? <a href="signin.php">Sign in</a>  </p>
            </form>
        </div>
    </body>
</html>