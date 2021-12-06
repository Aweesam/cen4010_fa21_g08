<?php

require_once '../php/db_connect.php'; //connects to the db
require_once '../php/functions.php'; //contains supplementary functions

session_start();

//login/logout button
if((isset($_SESSION['userid']))) //logged in
{
  $login_logout = '<a href="../php/logout.php" target="_parent"><button type="button" class="btn btn-primary">Logout</button></ul></li></a>';  
  $profile_url = '../profile/index.php?id='.$_SESSION['userid'];
  
  //edit profile button
  if($_SESSION['userid'] == $_GET['id']) //if user logged in matches profile
  {
    $edit_profile = '<a href="editprofile.php?id='.$_SESSION['userid'].'" type="button" class="btn btn-secondary" style="margin-left: 20px;" >Edit Profile</a>';
  }
  else
  {
    $edit_profile = '';
  }
}

else //not logged in - send home
{
  header('Location: ../index.php');  
}

//begin getting profile details
$query_profile = 'SELECT * FROM user where user_id = '.$_GET['id'];    
$results_profile = $db->query($query_profile);    

//no results found
if(mysqli_num_rows($results_profile)==0)
{
  $output = '';
}
//results found
else
{        
  while($row_profile = $results_profile->fetch_assoc())
  {           
    $user_id = $row_profile['user_id'];
    $user_first_name = $row_profile['user_first_name'];
    $user_last_name = $row_profile['user_last_name'];
    $user_age = $row_profile['user_age'];
    $user_country = $row_profile['user_country'];
    $user_state = $row_profile['user_state'];
    $user_zip = $row_profile['user_zip'];
    $user_linkedin = $row_profile['user_linkedin'];
    $user_git = $row_profile['user_git'];
    $user_bio = $row_profile['user_bio'];
    $user_pic = $row_profile['user_pic'];
  }
}   
//close out result sets
$results_profile->close();

//get data to update database
if(isset($_POST['back_to_profile']))
{
  header('Location: '.$profile_url);  
}


//get data to update database
if(isset($_POST['user_data']))
{
  $user_id = mysql_entities_fix_string($db, $_POST['user_id']);
  $user_bio = mysql_entities_fix_string($db, $_POST['bio']);
  $user_first_name = mysql_entities_fix_string($db, $_POST['first_name']);
  $user_last_name = mysql_entities_fix_string($db, $_POST['last_name']);
  $user_age = mysql_entities_fix_string($db, $_POST['age']);
  $user_country = mysql_entities_fix_string($db, $_POST['country']);
  $user_state = mysql_entities_fix_string($db, $_POST['state']);
  $user_zip = mysql_entities_fix_string($db, $_POST['zip']);
  $user_linkedin = mysql_entities_fix_string($db, $_POST['linkedin']);
  $user_git = mysql_entities_fix_string($db, $_POST['git']);

  $check = getimagesize($_FILES['profilepic']['tmp_name']);
  if($check !== false)
  {
    $temp_file_name = $_FILES['profilepic']['name'];
    $dstFolder = '../images/user_pics';
    $file_name = $_SESSION['username'].'.jpg';
    move_uploaded_file($_FILES['profilepic']['tmp_name'], $dstFolder.DIRECTORY_SEPARATOR.$file_name);
    $user_pic = '/images/user_pics/'.$_SESSION['username'].'.jpg';
  }

  $updateStmt = 'UPDATE user 
                 SET user_bio = "'.$user_bio.'",
                     user_first_name = "'.$user_first_name.'",
                     user_last_name = "'.$user_last_name.'",
                     user_age = "'.$user_age.'",
                     user_country = "'.$user_country.'",
                     user_state = "'.$user_state.'",
                     user_zip = "'.$user_zip.'",
                     user_linkedin = "'.$user_linkedin.'",
                     user_git = "'.$user_git.'",
                     user_pic = "'.$user_pic.'"
                 WHERE user_id = '.$user_id;
  $db->query($updateStmt);
  //echo $updateStmt;
  header('Location: '.$profile_url);  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>CC Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <a class="navbar-brand" href="../index.php"><img src="./img/cclogo.png" alt="CC Pic" style="width:52px;height:52px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
        class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?php echo $profile_url.PHP_EOL;?>">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="../forum/index.php">Forum</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="../gms/games.php">Games</a></li>
        <li class="nav-item"><a class="nav-link" href="../Resources/index.php">Resources</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php
          echo $login_logout.PHP_EOL;
          ?>
      </ul>
      </ul>
    </div>
  </nav>
  <div class="container">
  <form name="user_info" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$user_id?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Bio</label>
        <textarea class="form-control" name="bio" id="bioid" rows="3"><?php echo $user_bio;?></textarea>
      </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">First Name</label>
      <input type="text" class="form-control" name="first_name" id="nameid" value="<?php echo $user_first_name.PHP_EOL;?>">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Last Name</label>
      <input type="text" class="form-control" name="last_name" id="nameid" value="<?php echo $user_last_name.PHP_EOL;?>">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Age</label>
        <input type="text" class="form-control" name="age" id="ageid" value="<?php echo $user_age.PHP_EOL;?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Country</label>
        <input type="text" class="form-control" name="country" id="countryid" value="<?php echo $user_country.PHP_EOL;?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">State</label>
        <input type="text" class="form-control" name="state" id="stateid" value="<?php echo $user_state.PHP_EOL;?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">ZIP</label>
        <input type="text" class="form-control" name="zip" id="zipid" value="<?php echo $user_zip.PHP_EOL;?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">LinkedIn Link</label>
        <input type="text" class="form-control" name="linkedin" id="linkedinid" value="<?php echo $user_linkedin.PHP_EOL;?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Github Link</label>
        <input type="text" class="form-control" name="git" id="githubid" value="<?php echo $user_git.PHP_EOL;?>">
      </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Profile Picture</label>
        <input type="file" class="form-control-file" name="profilepic" id="profilepicid" accept="image/*">
      </div> 
      <input name="user_id" value="<?php echo $user_id.PHP_EOL;?>" style="display: none">     
      <button type="submit" name="user_data" class="btn btn-primary" id="form_submit_button">Save Changes</button>  
      <button type="submit" name="back_to_profile" class="btn btn-primary" id="saveButton">Back to Profile Page</button>
  </form>
      </div>      
    </div>
</div>
      <footer class="py-5 bg-dark">
        <span>&copy; Boostrap 4 - FAU - Team 8</span>
      </footer>
      <script src="js/main.js"></script>
    <script src="js/main.js"></script>
    
</body>

</html>