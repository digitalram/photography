<?php
	include("config.php"); // for sql connection ($con) 
	
	//session_start();
	$email = $_SESSION['username'];
	
	$query = "SELECT Keyword FROM KEYWORDS";
	$result = mysqli_query($con, $query);
	$numrows = mysqli_num_rows($result);
	
	echo "\n\t\t<table>\n";
	echo "<caption><div class=\"title\">What genres of work would you like to see? </div></caption>";

	for ($i = 0; $i < ($numrows / 4); $i++)
	{
		echo "\t\t\t<tr>\n";
		if ($i==0)
		{
			// need to check if there is an element in the REV_KEYWORD table which has matching email and given keyword
			echo "\t\t\t\t<td class='left'><input type=\"checkbox\" class=\"keyword\" onchange=\"AllGenres()\" value=\"All Genres\" >All Genres</td>\n"; 
			
			$j = 1;
		}
		else
			$j=0;
		for ($j; $j < 4; $j++)
		{
			if($row = mysqli_fetch_array($result)){
				$rkw = $row['Keyword'];
				//$queryi = "SELECT * FROM REV_KEYWORD WHERE Email = \"$email\" and Keyword = \"$rkw\"";	
				$queryi = "SELECT * FROM REV_KEYWORD WHERE Email = \"$email\" and Keyword = \"$rkw\"";	
				//echo $queryi;
				$resulti = mysqli_query($con, $queryi);
				$count = mysqli_num_rows($resulti);
				if($count)
					echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" value=\"" . $row['Keyword'] . "\" checked >" . $row['Keyword'] . "</td>\n";
				else
					echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" value=\"" . $row['Keyword'] . "\" >" . $row['Keyword'] . "</td>\n";
			}
			
		}
		echo "\t\t\t</tr>\n";		
	}
	echo "\t\t</table>";

	mysqli_close($con);
?>