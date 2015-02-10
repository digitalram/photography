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
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass = 'password';
	
	$mysql_db = 'spe';

	// TODO: Change to MySQLi driver
	if (!($con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db)) ){
		die(mysqli_error($con));
	}

?>