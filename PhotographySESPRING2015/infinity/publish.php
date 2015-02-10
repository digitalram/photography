<?php
	require 'connect.inc.php';
	
	
	$query = 'SELECT `show_db` FROM `show_db` WHERE 1';
		
	$result = mysql_query($query);	
	$event = mysql_fetch_array($result);
		
	echo $event[0];
?>