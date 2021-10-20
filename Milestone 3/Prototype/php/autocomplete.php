<?php
require_once 'db_connect.php';
if($_POST)
{       
    $q = ($_POST['username']);    
    
    $query = "SELECT COUNT(USERNAME) AS num FROM USERS WHERE USERNAME = '$q'";
    $results = $db->query($query);
    
    $row = $results->fetch_assoc();
    
    if($row['num'])
    {
        echo "taken";
    }
    else
        echo "";
}
?>