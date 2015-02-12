<?php
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory


$Attendee = $_POST['attendee'];
$Fname = $_POST['firstName'];
$Lname = $_POST['lastName'];
$Email = $_POST['email'];
$Keywords = $_POST['keyword'];



if ($Attendee == "Student")
	$query = "INSERT INTO STUDENT VALUES ('$Fname', '$Lname', '$Email'";
else
	$query = "INSERT INTO PROFESSIONAL VALUES ('$Fname', '$Lname', '$Email'";

var_dump($Keywords);
$max = sizeof($Keywords);

for ($i=0; $i<max; $i++)
{
	if($preference = $_POST['preference' . $i])
		$query = $query . ", '" . $preference . "'";
	else
		$query = $query . ", ''";
}
$query = $query . ")";

//echo $query;

mysqli_query($con, $query);
mysqli_close($con);

	header("location: " . $serverRoot . "/submission.php");
?>