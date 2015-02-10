<?php
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

	session_start();
	//unset($_COOKIE['user']);			// this function does not work for some reason.... sooooo,
	setcookie("user", "bsValue", 1);	// this sets the cookie at the time in the past, forcing it to be disabled in current time.
	session_destroy();
	header('Location: ' . $serverRoot . '/login.php');
	exit;
?>