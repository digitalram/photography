<?php 
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

$username = $_POST[username];
$password = $_POST[password];


$username = rawurldecode($username);

session_start();
$_SESSION['username'] = $username;
$expire=time()+60*60*24;				// expiration time for a cookie
setcookie("user", $username, $expire, '/');
session_start();


// create the user
$query = "INSERT INTO LOGIN VALUES ('$username', '$password', 'reviewer')";
mysqli_query($con, $query);

// set user's email (create empty personal info)

$query = "INSERT INTO REVIEWER (Email) VALUES ('$username')";
mysqli_query($con, $query);	

header("location: " . $serverRoot . "/reviewer.php");	// take to reviewer page

mysql_close($con);

?>