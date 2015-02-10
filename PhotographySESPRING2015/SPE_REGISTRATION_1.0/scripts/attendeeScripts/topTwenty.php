<?php 
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)

$query = "SELECT Fname, Lname FROM REVIEWER WHERE D1Morning = 1 OR D1Midday = 1 OR D1Afternoon = 1 OR D2Morning = 1 OR D2Midday = 1 OR D2Afternoon = 1"; // set the query (select all from table keywords)
$result = mysqli_query($con, $query);	// run the query
$numrows = mysqli_num_rows($result);	// get the number of tuples

$index = 1;
echo "<table>\n";					// start table
echo "<caption><div class=\"title\">Select up to 20 reviewers in order of priority: </div></caption>";

for ($j = 0; $j < 5; $j++)			// 5 rows
{
	

	echo "\t\t\t<tr>\n";			// start table row
	for ($k = 1; $k < 5; $k++)		// 4 columns
	{	
		mysqli_data_seek($result, 0);	//reset to first line
		
		/*// goofy numbering function
		if ($k%2 == 0)
			$label = floor($index/2+1)+9;
		else 
			$label = floor($index/2+1);
		// end goofy numbering function*/
		$label=$index;
		echo "\t\t\t\t<td>" . $label . ".)</td><td><select id=\"preference" . $label . "\" name=\"preference" . $label . "\" class=\"preference\" >\n";
		echo "\t\t\t\t\t<option value=\"default\" disabled selected>Select preference</option>\n";
		for ($i = 0; $i < $numrows; $i++)
		{
			if($row = mysqli_fetch_array($result))	// if there is a tuple (also puts into row)
			echo "\t\t\t\t\t<option value=\"" . $row["Lname"] . ", " . $row["Fname"] . "\">" . $row["Lname"] . ", " . $row["Fname"] .  "</option>\n";
		}
		echo "\t\t\t\t</select></td>\n";
		$index++;	// increment labeling/numbering index
	}
	echo "\t\t\t</tr>\n";
}
echo "\t</table>\n";
mysqli_close($con);
?>