<?php

//salt phrases
$salt1 = 'awdaw#1';
$salt2 = '!@#45';

function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}


// function SavePostToDB($_db, $_user, $_title, $_text, $_time, $_file_name, $_filter)
// {   
    
// 	/* Prepared statement, stage 1: prepare query */
// 	if (!($stmt = $_db->prepare("INSERT INTO WALL(USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, IMAGE_FILTER) VALUES (?, ?, ?, ?, ?, ?)")))
// 	{
// 		echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
// 	}

// 	/* Prepared statement, stage 2: bind parameters*/
// 	if (!$stmt->bind_param('ssssss', $_user, $_title, $_text, $_time, $_file_name, $_filter))
// 	{
// 		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
// 	}

// 	/* Prepared statement, stage 3: execute*/
// 	if (!$stmt->execute())
// 	{
// 		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
// 	}
// }

function mysql_entities_fix_string($connection, $string){
    return htmlentities(mysql_fix_string($connection, $string));
}	

function mysql_fix_string($connection, $string)  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
}

function get_nav_bar($forum_name = '', $forum_id = '', $post_name = '', $post_id = '')
{
    $navbar = '<span>
                    <a href="../forum/index.php">Forum Home</a> ';
    if($forum_name != '')
        $navbar .= '>> <a href="../forum/post.php?id='.$forum_id.'">'.$forum_name.'</a>';    
    if($post_name != '')    
        $navbar .= ' >> <a href="../forum/details.php?id='.$post_id.'">'.$post_name.'</a>';

    $navbar .= '</span>';
    return $navbar;
}

function get_forum_stats($db)
{
    ////get forum stats //////
    $query_extra_data = 'SELECT count(distinct post.post_id) as topics,
                                count(distinct reply.reply_id) + count(distinct post.post_id) as posts,                                
                                count(distinct user.user_id) as members
                         FROM (SELECT DISTINCT user_id FROM user) user
                         JOIN (SELECT DISTINCT reply_id FROM reply) reply on 1 = 1
                         JOIN (SELECT DISTINCT post_id FROM post) post on 1 = 1';    
    $results_extra = $db->query($query_extra_data);
    if(mysqli_num_rows($results_extra)==0)
    {
        $topics = "0";
        $posts = "0";
        $members = "0";
    }
    else
    {
        while($row_extra = $results_extra->fetch_assoc())
        {
            $topics = $row_extra['topics'];
            $posts = $row_extra['posts'];
            $members = $row_extra['members'];                       
        }
    }    
    $output = '<span><u>'.$posts.'</u> Posts in <u>'.$topics.'</u> Topics by <u>'.$members.'</u> Members.</span><br>';
    $results_extra->close();
    ////get lastest post details //////
    $query_extra_data = 'SELECT post_id,
                                user_name,
                                title,
                                post.created_date,
                                user.user_id
                         FROM post
                         JOIN user on post.user_id = user.user_id                  
                         WHERE post.post_id = (SELECT DISTINCT post_id
                                               FROM post
                                               WHERE created_date = (SELECT MAX(created_date)
                                                                     FROM post)
                                               LIMIT 1
                                               )';
    $results_extra = $db->query($query_extra_data);
    if(mysqli_num_rows($results_extra)==0)
    {
        $post_id = "";
        $user_name = "";
        $title = "";
        $created_date = '1900-01-01'; 
        $user_id = ""; 
    }
    else
    {
        while($row_extra = $results_extra->fetch_assoc())
        {
            $post_id = $row_extra['post_id'];
            $user_name = $row_extra['user_name'];
            $title = $row_extra['title'];
            $created_date = $row_extra['created_date'];                       
            $user_id = $row_extra['user_id'];
        }
    }
    $created_date = date('Y-m-d', strtotime($created_date));    
    $output .= '<span>Latest post: <b><a href="details.php?id='.$post_id.'">'.$title.'</a></b> on '.$created_date.' By <a href="../profile/index.php?id='.$user_id.'">'.$user_name.'</a></span>.<br>';
    $results_extra->close();
    return $output;
}

?>