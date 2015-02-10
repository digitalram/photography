<?php
// output.php BY Lee Jones ON 2/26/14
// Purpose: outputs a query to a csv file and forces download
// open the database connection file and connect to the database
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
$serverRoot =  $_SERVER['DOCUMENT_ROOT']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

// set output filename 
$filename = $serverRoot . "/outputFiles/SaturdayReviewers_" . date("Y") . ".csv";


//$con=mysqli_connect("127.0.0.1","photography","photogroup", "photography");
// all reviewers for the current year attending day 1
$query = "SELECT CONCAT(Lname, ', ', Fname), Email, D2Morning, D2Midday, D2Afternoon FROM REVIEWER WHERE (D2Morning = 1 OR D2Midday = 1 OR D2Afternoon = 1)";

$result = mysqli_query($con, $query);
$numrows = mysqli_num_rows($result);		// get the number of rows

if($numrows != 0)						// make sure the db isn't empty
{
	$fp = fopen($filename, "w+") or die ("Unable to open file.");		// file pointer to filename for writing

	$row = mysqli_fetch_assoc($result);	// get array headings

	// --get the data----------
	mysqli_data_seek($result, 0);	//start at first line
	
	// get the tuples
	while($row = mysqli_fetch_assoc($result))	// while getting tuples
	{
		$sep = "";		// seperator
		$comma = "";	// comma

		//get each value into $sep and comma seperate, end with line break
		foreach($row as $name => $value)
		{
			if ($value == 1)
				$value = "x";	
			else if ($value == "0")
				$value = "";
			
			$sep .= $comma . '' . '"' . str_replace('', '""', $value) . '"';
			$comma = ",";
		}
		$sep .= "\n";
		
		fwrite($fp, $sep);
	}

	fclose($fp) or die ("couldn't close file.");
	mysqli_close($con);

	

}
else
{
	echo "Error: The database has no entries.";
}
?>