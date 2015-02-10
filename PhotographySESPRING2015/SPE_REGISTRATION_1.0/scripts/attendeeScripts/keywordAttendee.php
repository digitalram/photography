<?php
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

	
	$query = "SELECT Keyword FROM KEYWORDS";
	$result = mysqli_query($con, $query);
	$numrows = mysqli_num_rows($result);
	
	echo "\n\t\t<table>\n";
	echo "<caption><div class=\"title\">What genres describe your work? </div></caption>";
	
	//while($row = mysqli_fetch_array($result))
	for ($i = 0; $i < ($numrows / 4); $i++)
	{
		echo "\t\t\t<tr>\n"; 		
		
		for ($j=0; $j < 4; $j++)
		{
			if($row = mysqli_fetch_array($result))
				echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" onchange=\"UpdateFilter()\" value=\"" . $row['Keyword'] . "\" >" . $row['Keyword'] . "</td>\n"; 
			
		}
		echo "\t\t\t</tr>\n";		
	}
	echo "\t\t</table>";

	mysqli_close($con);
?>