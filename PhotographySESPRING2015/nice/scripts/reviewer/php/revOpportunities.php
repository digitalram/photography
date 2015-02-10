<?php
	
	$query = "SELECT name FROM opportunity_definition";
	$result = framework::getMany($query);
	$numrows = count($result);
	echo "\n\t\t<table>\n";					// start the table
	echo "<caption><div class=\"title\">What opportunities do you have to offer? </div></caption>";

	$i = 0;
	foreach($result as $row)
	{
		if($i % 4 == 0)
		{
			echo "\t\t\t<tr align=\"left\">\n"; 
		}
		
		if(isset($_POST['email'])) //if email isset the user may have checked something before thus we look up any checked boxes and check appropriately
		{
			$rop = $row['name'];
			$queryi = "SELECT * FROM REV_OPPORTUNITY WHERE Email = \"$Email\" and Opportunity = \"$rop\"";	
			$resulti = framework::getMany($queryi);
			$count = count($resulti);
			if($count)		// if a match is found, check the box
				echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"opportunity[]\" class=\"opportunity\" onchange=\"UpdateFilter()\" value=\"" . $resulti['name'] . "\" checked >" . $resulti['name'] . "</td>\n";
			else
				echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"opportunity[]\" class=\"opportunity\" onchange=\"UpdateFilter()\" value=\"" . $resulti['name'] . "\" >" . $resulti['name'] . "</td>\n";
		}
		else
			echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"opportunity[]\" class=\"opportunity\" onchange=\"UpdateFilter()\" value=\"" . $row['name'] . "\" >" . $row['name'] . "</td>\n"; 
		
		$i++;
		
		if($i % 4 == 0)
		{
			echo "\t\t\t</tr>"; 
		}
	}
	echo "\t\t</table>";

?>