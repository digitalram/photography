<?php
	
	$query = "SELECT name FROM keyword_definition";
	$result = framework::getMany($query);
	$numrows = count($result);
	
	echo "\t\t<table>";
	echo "<caption><div class=\"title\">What genres of work would you like to see? </div></caption>";

	$i = 0;
	
	foreach($result as $row)
	{
		if($i == 0)
		{
			echo "\t\t\t\t<td class='left'><input type=\"checkbox\" class=\"keyword\" onchange=\"AllGenres()\" value=\"All Genres\" >All Genres</td>\n";
			$i = 1;
			continue;
		}
		if($i % 4 == 0)
		{
			echo "\t\t\t<tr>\n"; 
		}
		
		if(isset($_POST['email'])) //if email isset the user may have checked something before thus we look up any checked boxes and check appropriately
		{
			$rkw = $row['name'];
			$queryi = "SELECT * FROM REV_KEYWORD WHERE Email = \"$Email\" and Keyword = \"$rkw\"";	
			$resulti = framework::getMany($queryi);
			$count = count($resulti);
			if($count)
				echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" value=\"" . $resulti['name'] . "\" checked >" . $resulti['name'] . "</td>\n";
			else
				echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" value=\"" . $resulti['name'] . "\" >" . $resulti['name'] . "</td>\n";
		}
		else
			echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" value=\"" . $row['name'] . "\" >" . $row['name'] . "</td>\n";
		
		$i++;
		
		if($i % 4 == 0)
		{
			echo "\t\t\t</tr>"; 
		}
	}
	echo "\t\t</table>";
?>