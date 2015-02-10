<?php
	include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)

	$keywords = $_POST['keywords'];
	$opportunity = $_POST['opportunity'];
	$userType = $_POST['userType'];

	// construct the query
	// query will need to join opportunities and keywords tables.
	$i=0;
	$keyLength = count($keywords);
	

	if ($userType == "Student")
		$query = "SELECT Fname, Lname FROM REVIEWER WHERE (D1Morning = 1 OR D1Midday = 1 OR D1Afternoon = 1) AND ";
	else if ($userType == "Professional")
		$query = "SELECT Fname, Lname FROM REVIEWER WHERE (D2Morning = 1 OR D2Midday = 1 OR D2Afternoon = 1) AND ";
	else
		$query = "SELECT Fname, Lname FROM REVIEWER WHERE (D1Morning = 1 OR D1Midday = 1 OR D1Afternoon = 1 OR D2Morning = 1 OR D2Midday = 1 OR D2Afternoon = 1) AND ";


	foreach ($keywords as $word => $value)
	{
		$kwString = "Email IN (SELECT Email FROM REV_KEYWORD WHERE Keyword = '$value')";
		$query = $query . $kwString;
		if (++$i < $keyLength)
			$query = $query . " AND ";	
	}

	$oppLength = count($opportunity);
	if ($keyLength > 0 && $oppLength > 0)	// if there are keywords
		$query = $query . " AND ";	

	$i=0;	
	foreach ($opportunity as $word => $value)
	{
		$query = $query . "Email IN (Select Email FROM REV_OPPORTUNITY WHERE Opportunity = '$value')";
		if (++$i < $oppLength)
			$query = $query . " AND ";	
	}
	
	//echo $query . "\n";


	// there is an issue past this point
	// conduct the query and
	// output the results back to prefFilter for reconstruction of select options.
	
	
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

