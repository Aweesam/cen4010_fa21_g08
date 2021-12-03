<?php

require_once '../php/db_connect.php'; //connects to the db
require_once '../php/functions.php'; //contains supplementary functions

session_start();

if(!(isset($_SESSION['username'])))
{
  header('Location: ../index.php');  
}

else
{  
  //if the new post button was pressed
  if(isset($_POST['createPost']))
  {
      $comment = mysql_entities_fix_string($db, $_POST['discussion_text']);
      $title = mysql_entities_fix_string($db, $_POST['title_text']); 
      $forum_id = $_SESSION['forum_id'];
      $user_id = $_SESSION['userid'];  
      if(trim($comment) == '' || trim($title) == '')
      {
          header('Location: '.$_SERVER['PHP_SELF'].'?id='.$forum_id);    
      }
      else
      {
          $insertStmt = 'INSERT INTO post (post_id, forum_id, user_id, title, content, created_date, modified_date)
                      VALUES (NULL, '.$forum_id.','.$user_id.',\''.$title.'\',\''.$comment.'\',NOW(), NOW())';
          //echo $insertStmt;
          $db->query($insertStmt);
          header('Location: '.$_SERVER['PHP_SELF'].'?id='.$forum_id);        
      }
  }  

  $login_logout = '<a href="../php/logout.php" target="_parent"><button type="button" class="btn btn-primary">Logout</button></ul></li></a>';
  //using the forum id passed to the URL, check for posts within this forum
  $forum_id = $_GET['id'];
  $_SESSION['forum_id'] = $forum_id;
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
                          <td>';
          ////get reply counts //////
          $query_extra_data = 'SELECT count(reply_id) as replies
                                FROM reply                                  
                                WHERE post_id = '.$post_id;
          $results_extra = $db->query($query_extra_data);
          if(mysqli_num_rows($results_extra)==0)
          {
            $replies = "0";
          }
          else
          {
            while($row_extra = $results_extra->fetch_assoc())
            {
              $replies = $row_extra['replies'];
            }
          }
          $results_extra->close();
          $output .= $replies.' replies <br>
                          </td>';
          ////get lastest reply details //////
          $query_extra_data = 'SELECT reply.created_date,
                                      user.user_name                                        
                                FROM reply                                  
                                JOIN user on reply.user_id = user.user_id                                  
                                WHERE reply.created_date = (SELECT max(created_date)
                                                            FROM reply
                                                            WHERE post_id = '.$post_id.')
                                      AND reply.post_id = '.$post_id;
          $results_extra = $db->query($query_extra_data);
          if(mysqli_num_rows($results_extra)==0)
          {
            $user_name = "No Replies Yet";
            $created_date = '1900-01-01';              
          }
          else
          {
            while($row_extra = $results_extra->fetch_assoc())
            {
              $user_name = $row_extra['user_name'];
              $created_date = $row_extra['created_date'];                
            }
          }
          $created_date = date('Y-m-d', strtotime($created_date));
          $output .= '<td>'.$created_date.'
                      <br>By <b><a href="">'.$user_name.'</a></b>
                      </td>
                      </tr>';
          $results_extra->close();
                          
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
  
        <a class="navbar-brand" href="../index.php"><img src="../images/New Project.png" alt="CC Pic" style="width:52px;height:52px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../profile/index.html">Home</a></li>
                <li class="nav-item active"><a class="nav-link" href="../forum/index.php">Forum</a></li>
                <li class="nav-item disabled"><a class="nav-link" href="#!">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="../gms/games.php">Games</a></li>
                <li class="nav-item"><a class="nav-link" href="../Resources/index.html">Resources</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <?php
                    echo $login_logout.PHP_EOL;
                  ?>
                </li>
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
      <button type="button" class="btn btn-primary" onclick="createPost()">Create New Post</button>
            <form name="create" id="createPost" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">   
            <div class="create-area" id="create-area" style="display: none;">
                <input type="text"  name="title_text" id="title_text" placeholder="Title your post..." required></textarea>
                <textarea name="discussion_text" id="discussion_text" placeholder="Create your post..." required></textarea>
                <input type="submit" name="createPost" value="submit">
            </div>
        </form>
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