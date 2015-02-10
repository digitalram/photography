<?php
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)



$yr = date("Y");	
$deleteQuery = "DELETE FROM REGISTRATION_PERIODS WHERE year = $yr";
mysqli_query($con, $deleteQuery);
	
mysqli_close($con);

?>