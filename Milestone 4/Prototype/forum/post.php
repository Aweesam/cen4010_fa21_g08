<?php

require_once '../php/db_connect.php'; //connects to the db
require_once '../php/functions.php'; //contains supplementary functions

//page just opened or nothing entered in search box
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
    $search_result = "";
}

//if search button was pressed
else
{
    //using the forum id passed to the URL, check for posts within this forum
    $forum_id = $_GET['id'];
    $query_post = 'SELECT * 
                   FROM post
                   JOIN forums on post.forum_id = forums.forum_id
                   JOIN user on post.user_id = user.user_id
                   WHERE post.forum_id = '.$forum_id;
    $results_post = $db->query($query_post);
    //no results found
    if(mysqli_num_rows($results_post)==0){
      $output = '<tr>
                    <td>
                    Nothing here yet
                    </td>
                    <td>
                    Nothing here yet
                    </td>
                    <td>
                    Nothing here yet
                    </td>
                </tr>';
        //get navbar data
        $navbar = get_nav_bar();
    }
    //results found
    else
    {        
        $output = ''; //start post container block of html
        //loop through all posts
        while($row_post = $results_post->fetch_assoc())
        {   
            $forum_name = $row_post['forum_name'];   
            $title = $row_post['title'];
            $user_name = $row_post['user_name'];
            $post_id = $row_post['post_id'];
            $output .= '<tr>
                            <td>
                                <a href="details.php?id='.$post_id.'">'.$title.'</a>
                                <br>
                                <span>Started by <b><a href="">'.$user_name.'</a></b> .</span>
                            </td>
                            <td>
                                5 replies <br> 200 views
                            </td>
                            <td>
                                Apr 1 2021
                                <br>By <b><a href="">User</a></b>
                            </td>
                        </tr>';
        }
        //get navbar data
        $navbar = get_nav_bar($forum_name, $forum_id);
    }
    //close out result sets
    $results_post->close();    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Samuel Adkins - Project 4</title>
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
                <li class="nav-item active"><a class="nav-link" href="../forum/index.php">Forum</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Games</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Resources</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button type="button" class="btn btn-primary">Log In/Log Out</button></ul>/li>
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
<!--Navigation-->
<div class="navigate">
        <?php
            echo $navbar
        ?>
</div>

<!--Display posts table-->
<table class="table">
    <thead class="thead-light">
        <tr>
        <th scpe="col">Subjects</th>
        <th scope="col">Replies/Views</th>
        <th scope="col">Last Reply</th>
     </tr>
    </thead>
    <tbody> 
        <?php
        echo $output.PHP_EOL;
        ?>
</tbody>
</table>

    <footer>
      <span>&copy; Boostrap 4 - FAU - Team 8</span>
    </footer>
    <script src="js/main.js"></script>

</body>

</html>