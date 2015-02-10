<?php
	/*
	$conn_error = 'There was a connection error. Please try again later';
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass = '';
	
	$mysql_db = 'infinity';
	
	if (@!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db)){
		die(mysql_error());
	}
	else{}
    */
?>

<?php
	$conn_error = 'There was a connection error. Please try again later';
	$mysql_host = 'dfannincom.ipagemysql.com';
	$mysql_user = 'csci4700c';
	$mysql_pass = '1.Password';
	
	$mysql_db = 'csci4700c';


	
	if (@!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db)){
		die(mysql_error());
	}
	else{}
?>