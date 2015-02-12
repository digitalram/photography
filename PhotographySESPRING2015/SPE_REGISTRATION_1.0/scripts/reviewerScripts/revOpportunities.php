<?php
	include("config.php"); // for sql connection ($con) 

	//session_start();
	$email = $_SESSION['username'];
	
	$query = "SELECT Opportunity FROM OPPORTUNITIES"; // set the query (select all from table keywords)
	$result = mysqli_query($con, $query);	// run the query
	$numrows = mysqli_num_rows($result);	// get the number of tuples
	
	echo "\n\t\t<table>\n";					// start the table
	echo "<caption><div class=\"title\">What opportunities do you have to offer? </div></caption>";

	for ($i = 0; $i < ($numrows / 4); $i++)	// loop the number of rows/4 (because we are doing 4 per row in nested loop)
	{
		echo "\t\t\t<tr>\n"; 				// start a row
		for ($j = 0; $j < 4; $j++)			// loop for four columns
		{
			if($row = mysqli_fetch_array($result)){		// if there is a tuple (also puts into row)
				$rop = $row['Opportunity'];	
				$queryi = "SELECT * FROM REV_OPPORTUNITY WHERE Email = \"$email\" and Opportunity = \"$rop\"";	
				//echo $queryi;
				$resulti = mysqli_query($con, $queryi);
				$count = mysqli_num_rows($resulti);
				if($count)		// if a match is found, go ahead and check the box
					echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"opportunity[]\" class=\"opportunity\" onchange=\"UpdateFilter()\" value=\"" . $row['Opportunity'] . "\" checked >" . $row['Opportunity'] . "</td>\n";	// create checkbox in cell 
				else
					echo "\t\t\t\t<td class='left'><input type=\"checkbox\" name=\"opportunity[]\" class=\"opportunity\" onchange=\"UpdateFilter()\" value=\"" . $row['Opportunity'] . "\" >" . $row['Opportunity'] . "</td>\n";	// create checkbox in cell 
			}
		}
		echo "\t\t\t</tr>\n";				// end the row
	}
	echo "\t\t</table>";					// end the table

	mysqli_close($con);
?>