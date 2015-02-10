<?php
	include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
	

	$query = "SELECT Fname, Lname FROM REVIEWER WHERE D1Morning = 1 OR D1Midday = 1 OR D1Afternoon = 1 OR D2Morning = 1 OR D2Midday = 1 OR D2Afternoon = 1";

	$result = mysqli_query($con, $query); // OR Die("died");
	$numRows = mysqli_num_rows($result);
	

	if ($numRows > 0)
	{
		for ($i=0; $i < $numRows; $i++)
		{
			if ($i != 0 && $i < $numRows)
				echo "|";

			$row = mysqli_fetch_array($result);
			
			echo $row['Lname'] . ", " . $row['Fname'];					
		}
	}
	else
	{
		return false;
	}

	mysqli_close($con);

?>

