<?php
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)


$deleteQuery = "TRUNCATE TABLE STUDENT";
mysqli_query($con, $deleteQuery);

$deleteQuery = "TRUNCATE TABLE PROFESSIONAL";
mysqli_query($con, $deleteQuery);


// reset all reviewers to not attending
$query = "UPDATE REVIEWER SET D1Morning = 0, D1Midday = 0, D1Afternoon = 0, D2Morning = 0, D2Midday = 0, D2Afternoon = 0, FeeWaiver = NULL, WorkLevel = ''";
mysqli_query($con, $query);

mysqli_close($con);

?>