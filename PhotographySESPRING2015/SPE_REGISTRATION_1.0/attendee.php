<?php
include("config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname($_SERVER['PHP_SELF']); // path to url root directory

$year = date("Y");
$date = date("Y-m-d");

$query = "SELECT attFrom, attTo FROM REGISTRATION_PERIODS WHERE year = $year";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if (strtotime($date) < strtotime($row['attFrom']) || strtotime($row['attTo']) < strtotime($date))   // if not in registration period
    header("location: " . $serverRoot . "/notRegPeriod.php");                                              // redirect

?>       



<!DOCTYPE html>
<html lang = "en">

<head>
        <title>Attendee Registration :: SPE</title>
		<link rel="icon" href="images/spe_Fav.ico" /> <!-- The icon in the browser tab -->
		<link type = "text/css" rel = "stylesheet" href = "style/photo.css" />

        <script type = "text/javascript" src = "scripts/attendeeScripts/attendee.js">
		</script><!-- for regex -->
		<script type="text/javascript" src="scripts/attendeeScripts/prefFilter.js">
		</script><!-- for filter -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
		</script><!-- for jquery -->
</head>

<body>
	<a href="<a href=https://www.spenational.org/https://www.spenational.org/">
		<img src="https://www.spenational.org/images/logo.gif" title="Return to home page" width="92">
	</a>

	<form action = "scripts/attendeeScripts/InsertAttendee.php" method="post">
		<div class="container">
			<div class="maintitle">Attendee Registration</div><br /><br />
			<table>
			<caption><div class="title">Are you a student or a professional?</div></caption>
				<tr>
					<td>
						<input type = "radio" name = "attendee" onClick="UpdateFilter()" value = "Student" />Student
						<input type = "radio" name = "attendee" onClick="UpdateFilter()" value = "Professional" />Professional						
						<br />
					</td>
				</tr>
				<tr>
					<td><input class="roundedClass" type = "text" id = "firstName" name="firstName" required="required" placeholder="First Name" /></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type = "text" id = "lastName" name = "lastName" required="required" placeholder="Last Name" /></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type = "text" id = "email" name = "email" required="required" placeholder="Email Address" /></td>
				</tr>
			</table>
		</div>
		<div class="container">
			<center>In the selections below, you are currently <span id="filterLabel">not filtering Reviewers.<br><b>Select student or professional above.</b><input type="checkbox" id="filter" name="filter" checked onClick="UpdateFilter()"></span> Click to toggle filter</center>
			<div id="filterFeedback"></div>
			
			<!-- insert filter feedback here. -->
		</div>
		<div class="container">	<!-- filter genres(keywords) -->				
				<center><?php include("scripts/attendeeScripts/keywordAttendee.php"); ?></center>
		</div>
		<div class="container">	<!-- filter opportunities -->
			    <center><?php include("scripts/attendeeScripts/attOpportunities.php"); ?></center>
		</div>
		<div class="container">	<!-- 20 preference selectboxes -->
					<?php include("scripts/attendeeScripts/topTwenty.php") ?>
		</div>
		<table>
			<tr>
				<center>
				<td><input class="roundedClass" type = "reset" value = "Reset" style="width: 75px;"></td>
				<td><input class="roundedClass" type = "submit" value = "Submit" style="width: 75px;"></td>
				</center>
			</tr>
		</table>
	</div>
		</form>

		<script type = "text/javascript" src = "studentr.js"></script>

</body>

</html>