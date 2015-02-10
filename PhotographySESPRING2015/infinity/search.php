<?php


	
	require 'connect.inc.php';
if(isset($_POST['search']) ){
	
	
	//for reviewers
	$my_data = $_POST['search'];
	$query = 'SELECT `Last_Name`, `First_Name`
			FROM `reviewers`
			 WHERE First_Name LIKE "%'.$my_data.'%" OR Last_Name LIKE "%'.$my_data.'%" LIMIT 0,10';
				

	
	$result = mysql_query($query);	
	
	while($event = mysql_fetch_array($result)){
	
		$newdata = $newdata.'<p>'.$event[0].', '.$event[1].'</p>';
		
	}
	
	
	//for attendees
	$my_data = $_POST['search'];
	$query = 'SELECT `Last_Name`, `First_Name`
			FROM `attendees`
			 WHERE First_Name LIKE "%'.$my_data.'%" OR Last_Name LIKE "%'.$my_data.'%" LIMIT 0,10';
				

	
	$result = mysql_query($query);	
	
	while($event = mysql_fetch_array($result)){
	
		$newdata = $newdata.'<p>'.$event[0].', '.$event[1].'</p>';
		
	}

	
	
	echo $newdata;
}
?>