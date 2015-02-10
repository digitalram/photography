<?php
// open the database connection file and connect to the database
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)

$revFrom = $_POST['revFrom'];
$revTo = $_POST['revTo'];
$attFrom = $_POST['attFrom'];
$attTo = $_POST['attTo'];

for ($i=0; $i<4; $i++)	// get the year from one of the dates
	$yr .= $attTo[$i];

$query = "INSERT INTO REGISTRATION_PERIODS VALUES ('$yr', '$revFrom', '$revTo', '$attFrom', '$attTo')";


	
if (!mysqli_query($con, $query))
{
	$deleteQuery = "DELETE FROM REGISTRATION_PERIODS WHERE year = $yr";
	mysqli_query($con, $deleteQuery);
	mysqli_query($con, $query) OR die("error deleting old registration periods and inserting the new ones.");
}
	
mysqli_close($con);

?>