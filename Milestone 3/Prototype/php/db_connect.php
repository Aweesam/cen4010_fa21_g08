<?php
// Do not change the following two lines.
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

$dbhost = 'localhost';  
$dbname = 'cen4010_fa21_g08';   // DB name on server
$dbuser = 'cen4010_fa21_g08';   // LAMP name 
$dbpass = '3HS6xkk8y3'; // LAMP password

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}