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

else //not logged in
{
  $login_logout = '<a href="../Signup/signin.php" target="_parent"><button type="button" class="btn btn-primary">Login</button></ul></li></a>';
  $profile_url = '../Signup/signin.php';
  $edit_profile = '';
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
    $user_fullname = $row_profile['user_first_name'].' '.$row_profile['user_last_name'];
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
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <!-- Webpage HTML source for Team8 CovidConnections Profile Page -->
  <title>CC Profile Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
  
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
        <li class="nav-item disabled"><a class="nav-link" href="#!">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="../gms/games.php">Games</a></li>
        <li class="nav-item"><a class="nav-link" href="../Resources/index.php">Resources</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php echo $login_logout.PHP_EOL; ?>
      </ul>
      </ul>
    </div>
  </nav>
  <!-- Page header with logo and tagline-->
  <header class="py-5 bg-light border-bottom mb-4" style="background-image: url(./img/profilebanner.png); background-size: contain;">
    <div class="container">
      <div class="text-center my-5" id="banner">
        <h1 class="fw-bolder" style="font-size:xx-large;"> Your Personal Covid Connections Homepage</h1>
        <p class="lead mb-0" style="font-size: large;"><i>Get creative and stay updated with a personalized page</i></p>
      </div>
    </div>
  </header>
  <!-- Page content-->
  <div class="container">
    <div class="row">
      <!-- Blog entries-->
      <div class="col-8 col-md-8">
        <!-- Featured blog post-->
        <div class="card mb-4" id="covidstats">
          <h2 style="text-align: center;">Current Covid Stats</h2>
          <div class="card-body">
  
            <iframe src="https://public.domo.com/cards/YE040" width="700" height="450" marginheight="0" marginwidth="0" frameborder="0"></iframe>
          </div>
        </div>
         <!-- Nested row for non-featured blog posts-->
         <div class="row">
          <div class="col-lg-6">
            <!-- Blog post-->
            <div class="card mb-4" id="row1">
              <iframe src="https://www.health.gov/myhealthfinder?widget=true" 
              name="myhealthfinderframe" 
              frameborder="0" id="myhealthfinderframe"
               scrolling="yes" height="100%" width="100%" 
               marginheight="0" title="myhealthfinder widget"
                marginwidth="0">
                <p>Your browser does not support iframes.</p></iframe>
            </div>
            <!-- Blog post-->
            <div class="card mb-4" style="width:700px; background-color: khaki; height:800px"> 
              <script src='https://redditjs.com/subreddit.js' data-subreddit='COVID19' data-sort='hot' data-theme='dark' data-height='800' data-width='700'></script>
            </div>
          </div>
          <div class="col-lg-6">
            <!-- Blog post-->
            <div class="card mb-4" style="width: 20rem; background-color: antiquewhite; height:600px;" >
              <div class="card-body">
                <div data-mediatype='widget' data-mediaid='426456' data-apiroot='tools.cdc.gov/api' data-cdc-widget='syndicationIframe'></div><script src='https://www.cdc.gov/TemplatePackage/contrib/widgets/tp-widget-external-loader.js' ></script><noscript>You need javascript enabled to view this content or go to <a href='https://tools.cdc.gov/api/v2/resources/media/426456/noscript'>source URL</a>.</noscript>
              </div>
            </div>
            
            
          </div>
        </div>
        
      </div>
      <!-- Side widgets-->
      <div class="col-6 col-md-4">
        <!-- User Profile and bio-->
        <div class="card" style="width: 25rem;">
          <img class="card-img-top" src="..<?php echo $user_pic.PHP_EOL; ?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Bio</h5>
            <p class="card-text"><?php echo $user_bio.PHP_EOL; ?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <strong>Full Name</strong>
                </div>
                <div class="col text-secondary">
                <?php echo $user_fullname.PHP_EOL; ?>
                </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <strong>Age</strong>
                </div>
                <div class="col text-secondary">
                <?php echo $user_age.PHP_EOL; ?>
                </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <strong>Country</strong>
                </div>
                <div class="col text-secondary">
                <?php echo $user_country.PHP_EOL; ?>
                </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <strong>State</strong>
                </div>
                <div class="col text-secondary">
                <?php echo $user_state.PHP_EOL; ?>
                </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <strong>ZIP</strong>
                </div>
                <div class="col text-secondary">
                <?php echo $user_zip.PHP_EOL; ?>
                </div>
            </li>
          </ul>
          <div class="card-body">
            <a href="<?php echo $user_linkedin.PHP_EOL; ?>" class="card-link">LinkedIn</a>
            <a href="<?php echo $user_git.PHP_EOL; ?>" class="card-link">GitHub</a>
            <?php echo $edit_profile.PHP_EOL; ?> <!-- display or hide edit button -->
          </div>
        </div>

        <!-- Categories widget-->
        <div class="card mb-4">
          <div class="card-header">Favorite Things?</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                  <li><a href="#!">Web Design</a></li>
                  <li><a href="#!">Apples</a></li>
                  <li><a href="#!">Freebies</a></li>
                </ul>
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                  <li><a href="#!">JavaScript</a></li>
                  <li><a href="#!">Pizza</a></li>
                  <li><a href="#!">Math</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Side widget-->
        <div class="card mb-4">
          <div class="card-header">Weather</div>
          <div class="card-body">

            <div id="openweathermap-widget-15"></div>
            <!-- TODO: Update cityid by value of user's city id-->
            <script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = []; window.myWidgetParam.push({ id: 15, cityid: '4148411', appid: '9be281727026afb148d17e2ddab9bf30', units: 'metric', containerid: 'openweathermap-widget-15', }); (function () { var script = document.createElement('script'); script.async = true; script.charset = "utf-8"; script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js"; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(script, s); })();</script>
          </div>
        </div>
      </div>
    </div>

  </div>
  
  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <span>&copy; Boostrap 4 - FAU - Team 8</span>
  </footer>
  <script src="js/main.js"></script>
  <script src="js/weather.js"></script>
  

</body>

</html>