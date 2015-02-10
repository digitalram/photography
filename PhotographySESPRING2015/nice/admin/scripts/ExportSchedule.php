<?php

include("connect.inc.php");

require_once( "../Scheduling/Scheduling\ Code/code/admin/classes/Login.php");

$serverRoot =  $_SERVER['DOCUMENT_ROOT']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

$login = new Login();

if(!$login->isUserLoggedIn())
{
	die('You are not logged in.');
}
else
{
	/* export the tables that are valuable to the schedule */

	//return holds the final data
	$return = "";
	//holds session only data
	$returnSession = "";
	
	//get tables related to the schedule
	$tables = array("session", "reviewers", "attendees");

	//special variable so delay the printing of the session tables data. Because foreign keys.
	$skipSessionData = true;
	
	//cycle through putting info in return in a sql style format
	foreach($tables as $table)
	{
		$result = mysqli_query($con,'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		if($table == "session")
		{
			$return.= "\n";
			$row2 = mysqli_fetch_row(mysqli_query($con,'SHOW CREATE TABLE '.$table));
			$returnSession.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysqli_fetch_row($result))
				{
					$returnSession.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","/\\n/",$row[$j]);
						if (isset($row[$j])) { $returnSession.= '"'.$row[$j].'"' ; } else { $returnSession.= '""'; }
						if ($j<($num_fields-1)) { $returnSession.= ','; }
					}
					$returnSession.= ");\n";
				}
			}
			$returnSession.="\n\n\n";
		}
		else
		{
			$row2 = mysqli_fetch_row(mysqli_query($con,'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysqli_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","/\\n/",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
	}
	//combine results
	$return = $return . $returnSession;
	
	//save file
	$handle = fopen($serverRoot . '/admin/download/db-backup-'.date('Y.m.d').'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	
}

?>