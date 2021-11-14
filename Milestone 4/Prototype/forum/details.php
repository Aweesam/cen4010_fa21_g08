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
    $login_logout = '<a href="../php/logout.php" target="_parent"><button type="button" class="btn btn-primary">Logout</button></ul></li></a>';
    //using the post id passed to the URL, check for the post and replies
    $post_id = $_GET['id'];
    $query_post = 'SELECT * 
                   FROM post
                   JOIN forums on post.forum_id = forums.forum_id 
                   JOIN user on post.user_id = user.user_id
                   WHERE post_id = '.$post_id;
    $results_post = $db->query($query_post);
    //no results found
    if(mysqli_num_rows($results_post)==0)
    {
      $original_post = '';
    }
    //results found
    else
    {        
        $original_post = ''; //start post container block of html
        //loop through all posts
        while($row_post = $results_post->fetch_assoc())
        {           
            $title = $row_post['title'];
            $forum_name = $row_post['forum_name'];
            $forum_id = $row_post['forum_id'];
            $user_name = $row_post['user_name'];
            $post_id = $row_post['post_id'];
            $content = $row_post['content'];
            $original_post .= '<div class="head">
                        <div class="authors">Author</div>
                        <div class="content">Topic: '.$title.'</div>
                       </div>
                       <div class="body">
                        <div class="authors">
                            <div class="username"><a href="">'.$user_name.'</a></div>
                            <div>Role</div>
                            <img src="https://cdn.pixabay.com/photo/2016/11/08/15/21/user-1808597_960_720.png" alt="">
                            <div>Posts: <u>36</u></div>
                        </div>
                        <div class="content">
                           '.$content.'
                            <div class="comment">
                                <button onclick="showComment()">Comment</button>
                            </div>
                        </div>
                    </div>';
        }

        //get navbar data
        $navbar = get_nav_bar($forum_name, $forum_id, $title, $post_id);

        //check for replies and parse accordingly
        $post_id = $_GET['id'];
        $query_reply = 'SELECT * 
                        FROM reply
                        JOIN user on reply.user_id = user.user_id
                        WHERE post_id = '.$post_id;
        $results_reply = $db->query($query_reply);
        //no results found
        if(mysqli_num_rows($results_reply)==0)
        {
            $replies = '';
        }
        //results found
        else
        {        
            $replies = ''; //start post container block of html
            //loop through all posts
            while($row_reply = $results_reply->fetch_assoc())
            {           
                $user_name = $row_reply['user_name'];
                $reply_id = $row_reply['reply_id'];
                $content = $row_reply['content'];
                $replies .= '<div class="comments-container">
                                <div class="body">
                                    <div class="authors">
                                        <div class="username"><a href="">'.$user_name.'</a></div>
                                        <div>Role</div>
                                        <img src="https://cdn.pixabay.com/photo/2016/11/08/15/21/user-1808597_960_720.png" alt="">
                                        <div>Posts: <u>345</u></div>
                                    </div>
                                    <div class="content">
                                        '.$content.'
                                        <div class="comment">
                                            <button onclick="showReply()">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
        }        
    }
    //close out result sets
    $results_post->close();
    $results_reply->close();   
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">

        <a class="navbar-brand" href="../index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item active"><a class="nav-link" href="../forum/index.php">Forum</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Games</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Resources</a></li>
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
        </div>
    </div>


    <div class="navigate">
        <?php
            echo $navbar
        ?>
    </div>

    <!--Topic Section-->
    <div class="topic-container">
        <!--Original thread-->
        <?php
            echo $original_post.PHP_EOL;
        ?>
        <!--Comment Area-->
        <div class="comment-area" id="comment-area" style="display: none;">
            <textarea name="comment" id="" placeholder="comment here ... "></textarea>
            <input type="submit" value="submit">
        </div>
        <!--Comments Section-->
        <?php
            echo $replies.PHP_EOL;
        ?>        
        <!--Reply Area-->
        <div class="comment-area" id="reply-area" style="display: none;">
            <textarea name="reply" id="" placeholder="reply here ... "></textarea>
            <input type="submit" value="submit">
        </div>

    </div>

    <footer>
        <span>&copy; Boostrap 4 - FAU - Team 8</span>
    </footer>
    <script src="js/main.js"></script>
</body>

</html>