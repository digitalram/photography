<?php

require_once("Scheduling/Scheduling Code/code/admin/classes/Login.php");

$login = new Login();

if(!$login->isUserLoggedIn())
{
	die('You are not logged in.');
}
else
{
	$target_dir = "uploads/";
	$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
	$uploadOk=1;

	if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) 
	{
		echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
		
		$mysqli = new mysqli("localhost", "root", "password", "spe");

		$sql_file = "db-backup-2014.10.22.sql";
		$templine = '';
			// Read in entire file
			$lines = file($sql_file);
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					$mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');
					// Reset temp variable to empty
					$templine = '';
				}
			}
			 echo '</br>Tables imported successfully. <button onclick="window.history.back();">Go Back</button>';
	} 
	else 
	{
		echo "Sorry, there was an error uploading your file.";
	}
}
?>