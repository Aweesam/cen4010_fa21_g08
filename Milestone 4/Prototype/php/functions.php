<?php
require_once "db_connect.php";

//salt phrases - to be used in the real site when we need to encrypt passwords
//$salt1 = "^a2d";
//$salt2 = "*1j@";
//combine password with salt values
//$token = hash('ripemd128',$salt1.$password.$salt2);

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

?>