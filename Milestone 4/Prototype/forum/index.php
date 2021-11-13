<?php

require_once '../php/db_connect.php'; //connects to the db
require_once '../php/functions.php'; //contains supplementary functions

//todo - update this to make sure it checks if a user is logged in
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
    $search_result = "";
}

else
{
    //find values in table that align with search text
    $query_header = 'SELECT * FROM forum_header';    
    $results_header = $db->query($query_header);         
    //no results found
    if(mysqli_num_rows($results_header)==0){
      $output = '';
    }
    //results found
    else{        
        $output = ''; //start subforum container block of html
        //loop through all headers, then loop through all posts with the header_id
        while($row_header = $results_header->fetch_assoc()){           
          $header_name = $row_header['header_name'];
          $header_id = $row_header['header_id'];
          $output .= '<div class="subforum">
                      <div class="subforum-title">
                      <h1>'.$header_name.'</h1>
                      </div>';
          //find forums within the header_id
          $query_forum = 'SELECT * FROM forums where header_id = '.$header_id;
          $results_forum = $db->query($query_forum);         
          //no results found
          if(mysqli_num_rows($results_forum)==0){}
          //results found
          else{ 
            while($row_forum = $results_forum->fetch_assoc()){   
              $forum_name = $row_forum['forum_name'];
              $forum_description = $row_forum['forum_description'];
              $forum_id = $row_forum['forum_id'];
              $output .= '<div class="subforum-row">
                            <div class="subforum-icon subforum-column center">
                            <i class="fa fa-car center"></i>
                          </div>
                          <div class="subforum-description subforum-column">
                          <h4><a href="post.php?id='.$forum_id.'">'.$forum_name.'</a></h4>
                          <p>'.$forum_description.'</p>
                          </div>
                          <div class="subforum-stats subforum-column center">
                          <span>18 Posts | 6 Topics</span>
                          </div>
                          <div class="subforum-info subforum-column">
                          <b><a href="">Last post</a></b> by <a href="">JustAUser</a>
                          <br>on <small>1 Apr 2021</small>
                        </div>
                        </div>';
            }
          }
        }
        //close out result sets
        $results_header->close();
        $results_forum->close();
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Covid Connections - Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  
        <a class="navbar-brand" href="../index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item active"><a class="nav-link" href="#">Forum</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Games</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Resources</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button type="button" class="btn btn-primary">Log In/Log Out</button></ul></li>
            </ul>
        </div>
</nav>
 <!--SearchBox Section-->
 <div class="search-box">
  <div>
      <select name="" id="">
          <option value="Everything">Everything</option>
          <option value="Titles">Titles</option>
          <option value="Descriptions">Descriptions</option>
      </select>
      <input type="text" name="q" placeholder="search ...">
      <button type="button" class="btn btn-primary">Search</button>
  </div>
</div>
  <div class="container">
    <?php 
    echo $output.PHP_EOL;
    ?>        
    <!-- Forum Info -->
    <div class="forum-info">
      <div class="chart">
        MyForum - Stats &nbsp;<i>test</i>
      </div>
      <span><u>1,234</u> Posts in <u>12</u> Topics by <u>4,321</u> Members.</span><br>
      <span>Latest post: <b><a href="">Latest_Post</a></b> on Aug 1 2021 By <a href="">LastUser</a></span>.<br>
      <span>Check <a href="">the latest posts</a> .</span><br>
    </div>

    <footer>
      <span>&copy; Boostrap 4 - FAU - Team 8</span>
    </footer>
    <script src="js/main.js"></script>

</body>

</html>