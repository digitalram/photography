<?php
	require_once "bootstrap.php";

	$query = "SELECT keyword_definition_id, name FROM keyword_definition";
	$result = framework::getMany($query);
	$numrows = count($result);
	
	echo "\n\t\t<table>\n";
	echo "<caption><div class=\"title\">What genres describe your work? </div></caption>";
	
	//while($row = mysqli_fetch_array($result))
	
	// init i = 0
	// loop
	// - new row check
	// -- <tr>
	// - <td></td>
	// - increment i
	// -- </tr>
	// end
	
	$i = 0;
	foreach($result as $row)
	{
		if($i % 5 == 0)
		{
			echo "\t\t\t<tr>\n"; 
		}
	
		echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"keyword[]\" class=\"keyword\" onchange=\"UpdateFilter()\" value=\"" . $row['keyword_definition_id'] . "\" >" . $row['name'] . "</td>\n"; 
		
		$i++;
		
		if($i % 5 == 0)
		{
			echo "\t\t\t<tr>\n"; 
		}
	}
	echo "\t\t</table>";

?>
