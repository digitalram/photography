<?php
require_once "bootstrap.php";
	
	$query = "SELECT opportunity_definition_id, name FROM opportunity_definition"; // set the query (select all from table keywords)
	$result = framework::getMany($query);	// run the query
	$numrows = count($result);	// get the number of tuples
	
	echo "\n\t\t<table>\n";					// start the table
	echo "<caption><div class=\"title\">Which opportunities would you be interested in?</div></caption>";

	$i = 0;
	foreach($result as $row)
	{
		if ($i % 4 == 0)
		{
			echo "\t\t\t<tr>\n"; 				// start a row
		}

		echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"opportunity[]\" class=\"opportunity\" onchange=\"UpdateFilter()\" value=\"" . $row['opportunity_definition_id'] . "\" >" . $row['name'] . "</td>\n";	// create checkbox in cell 
	
		$i++;
		
		if ($i % 4 == 0)
		{
			echo "\t\t\t</tr>\n";				// end the row
		} 
		
	}
	echo "\t\t</table>";					// end the table

	//mysqli_close($con);						// close the database connection
?>