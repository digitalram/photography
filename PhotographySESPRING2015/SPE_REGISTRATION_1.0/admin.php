<?php
include("config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname($_SERVER['PHP_SELF']); // path to url root directory


if (session_status() == PHP_SESSION_NONE) 
    session_start();
        

if(isset($_SESSION['username']))
{
    if (isset($_COOKIE['user'])){
              
        $username = $_SESSION['username'];
        
        $query = "SELECT * FROM LOGIN WHERE username = '$username'";
        $result = mysqli_query($con,$query);    // run the query
        $row = mysqli_fetch_array($result);

        if ($row[userType] == "reviewer")
 			header("location: " . $serverRoot . "/reviewer.php");	// change to address on server

 		mysqli_close($con);
    }
}
else{
    header("location: " . $serverRoot . "/login.php");	// change to address on server
}

?>

<!DOCTYPE HTML>

	<head>
		<title>Administration :: SPE</title>
		<link rel="icon" href="images/spe_Fav.ico" /> <!-- The icon in the browser tab -->
		<link type = "text/css" rel = "stylesheet" href = "style/photo.css" />
      
        <script type="text/javascript" src="scripts/adminScripts/admin.js">
        </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
		</script>

        <!-- Date picker from http://jqueryui.com/datepicker/#default -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script>
			$(function() {
				$( ".datepicker" ).datepicker({ showAnim: "clip" , dateFormat: "yy-mm-dd"});
			});
		</script>
		<!-- end Date picker -->
	</head>
	
	<body>
		<a href="https://www.spenational.org/https://www.spenational.org/">
		   <img src="https://www.spenational.org/images/logo.gif" title="Return to home page" width="92"></a>
		
		<div class="maintitle">Administration</div>
		<div class="container">
			<table>
				<tr>
					<th><center style="color: #fc0;">The current registrations periods are: <center></th>
				</tr>
				<tr>
					<td id="thisRegPeriod"><?php include("scripts/adminScripts/GetRegPeriods.php"); ?><br /></td>
				<tr>
			</table>
			<table>
				<caption class = "title">Set Registration Periods</caption>
				<tr>
					<th>Reviewer Registration: </th>
					<th>From</th><td><input type="text" id="revFrom" class="datepicker"></td><th>To</th><td><input type="text" id="revTo" class="datepicker"></td>
				</tr>
				<tr>
					<th>Attendee Registration: </th>
					<th>From</th><td><input type="text" id="attFrom" class="datepicker"></td><th>To</th><td><input type="text" id="attTo" class="datepicker"></td>
				</tr>
				<tr>
					<td align="center" colspan="5">
						<button type="button" class="roundedClass" onclick="ClearPeriods()">Clear Periods</button>
						<button type="button" class="roundedClass" onclick="SetRegPeriods()">Set Periods</button>
					</td>
				</tr>
			</table>
		</div>

		<div class="container" style="text-align:left;">
			<table>
			<caption class="title">End of Registration</caption>
				<tr>
					<th>Export Database To .CSV Files?</th><td><button class="roundedClass" type = "button" onclick="ExportDatabase()" style="width:100%;">Export Database</button></td>
				</tr>
				<tr>
						<form name="dlyear" action="scripts/adminScripts/downloadYear.php" method="post">
							<th><span style="float: left;">Download whole year:</span><span style="float: right;"><?php include("scripts/adminScripts/fileYearSelect.php"); ?></span></th>
							<td><input class="roundedClass" type="submit" value="Download" style="width:100%;"></td>
						</form>
				</tr>
				<tr>
						<form name="dlfile" action="scripts/adminScripts/downloadFile.php" method="post">
							<th><span style="float: left; padding-right: 10px;">Download specific csv:</span><span style="float: right;"><?php include("scripts/adminScripts/createDownloadSelect.php"); ?></span></th>
							<td><input class="roundedClass" type="submit" value="Download" style="width:100%;"></td>
						</form>
				<tr>
					<th>Clear Attendee Data From Database?</th><td><button class="roundedClass" type = "button" onclick="ClearAttendees()" style="width:100%;">Clear Attendees</button></td>
				</tr>
			</table>
		</div>
				

		<div class="container" style="text-align:left;">
			<table>
				<caption class="title">Add Keywords</caption>
				<tr>
					<th>Genre</th><td><input class="roundedClass" type = "text" id="keyAdd" name="keyAdd"></td><td><button type="button" class="roundedClass" onclick="AddKeyword()" style="width:100%;">Add Genre</button></td>
				</tr>
				<tr>
					<th>Opportunity</th><td><input class="roundedClass" type = "text" id="oppAdd" name="oppAdd"></td><td><button type="button" class="roundedClass" onclick="AddOpportunity()" style="width:100%;">Add Opportunity</button></td>
				</tr>
			</table>
		</div>
							
		<div class="container" style="text-align:left;">
			<table>
				<caption class="title">Remove Keywords</caption>
				<tr>
					<th>Genre</th><td><?php include("scripts/adminScripts/adminKeyOppSelect.php"); SelectAdd("keyword", "keyRem"); ?></td><td><button type="button" class="roundedClass" onclick="RemKeyword()" style="width:100%;">Remove Genre</button></td>
				</tr>
				<tr>
					<th>Opportunity</th><td><?php SelectAdd("opportunity", "oppRem"); ?></td><td><button type="button" class="roundedClass" onclick="RemOpportunity()" style="width:100%;">Remove Opportunity</button></td>
				</tr>
			</table>
		</div>	
		<div class="container">
			<center><a href="scripts/loginScripts/logout.php">Logout</a><center>
		</div>
	</body>
</html>