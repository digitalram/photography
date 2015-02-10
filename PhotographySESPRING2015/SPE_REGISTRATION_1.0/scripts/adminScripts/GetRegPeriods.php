<?php
// open the database connection file and connect to the database
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)

$yr = date("Y");
$query = "SELECT * FROM REGISTRATION_PERIODS WHERE year = $yr";

//$con=mysqli_connect("127.0.0.1", "photography", "photogroup", "photography");

$result = mysqli_query($con, $query);
	
if ($row = mysqli_fetch_array($result))
{
	$revFrom = date_create($row['revFrom']);
	$revFrom = date_format($revFrom, 'M-j-Y');
	$revTo = date_create($row['revTo']);
	$revTo = date_format($revTo, 'M-j-Y');
	$attFrom = date_create($row['attFrom']);
	$attFrom = date_format($attFrom, 'M-j-Y');
	$attTo = date_create($row['attTo']);
	$attTo = date_format($attTo, 'M-j-Y');

	echo "Reviewer Registration: From " . $revFrom . " To " . $revTo . "<br>";
	echo "Attendee Registration: From " . $attFrom . " To " . $attTo . "<br>";
	
}
else
{
	echo "No registration periods have been set for this year.";
}
mysqli_close($con);

?>