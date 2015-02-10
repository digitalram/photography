<?php
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory



// set variables for post data
	$Fname = $_POST['firstName'];
	$Lname = $_POST['lastName'];
	$Title = $_POST['title'];
	$Instit = $_POST['institution'];
	$Email = $_POST['email'];
	$Website = $_POST['website'];
	$Addr1 = $_POST['address1'];
	$Addr2 = $_POST['address2'];
	$City = $_POST['city'];
	$State = $_POST['state'];
	$Zip = $_POST['zip'];
	$Country =$_POST['country'];
	$Phone = $_POST['phoneNumber'];
	$Membership = $_POST['membership'];
	$FeeWaiver = $_POST['fee'];
	$Comments = $_POST['comments'];

// set values for the days that are being attended
	$Time = $_POST['time'];
	$fri1 = 0;
	$fri2 = 0;
	$fri3 = 0;
	$sat1 = 0;
	$sat2 = 0;
	$sat3 = 0;
	foreach($Time as $value)
	{
		if ($value == "fri1")
			$fri1 = 1;
		if ($value == "fri2")
			$fri2 = 1;
		if ($value == "fri3")
			$fri3 = 1;
		if ($value == "sat1")
			$sat1 = 1;
		if ($value == "sat2")
			$sat2 = 1;
		if ($value == "sat3")
			$sat3 = 1;		
	} 

// set work levels that the reviewer wants to view
	
	if (($fri1 == 1 || $fri2 == 1 || $fri3 == 1) && ($sat1 == 1 || $sat2 == 1 || $sat3 == 1))
		$WorkLevel = "both";
	else if ($fri1 == 1 || $fri2 == 1 || $fri3 == 1)
		$WorkLevel = "student";
	else if ($sat1 == 1 || $sat2 == 1 || $sat3 == 1)
		$WorkLevel = "professional";


// get the reviewer's data from the database
	$query= "SELECT * FROM REVIEWER WHERE Email = '$Email'";
	$result = mysqli_query($con, $query);
	$numRows = mysqli_num_rows($result);

// update existing reviewer
	if($numRows > 0)	
	{
		$query = "UPDATE REVIEWER SET Fname = '$Fname', Lname = '$Lname', Title = '$Title', Instit = '$Instit', Email = '$Email', 
				 Website =  '$Website', Addr1 = '$Addr1', Addr2 = '$Addr2', City =  '$City', State = '$State', Zip = '$Zip', 
				 Country = '$Country', Phone = '$Phone', Membership = '$Membership', FeeWaiver = '$FeeWaiver', D1Morning = '$fri1', 
				 D1Midday = '$fri2', D1Afternoon = '$fri3', D2Morning = '$sat1', D2Midday = '$sat2', D2Afternoon = '$sat3', 
				 WorkLevel = '$WorkLevel', Comments = '$Comments' WHERE Email = '$Email'";
	}
// or, insert new reviewer
	else 	
	{
		$query = "INSERT INTO REVIEWER VALUES ('$Fname', '$Lname', '$Title', '$Instit', '$Email', '$Website', '$Addr1', '$Addr2', '$City',
				 '$State', '$Zip', '$Country', '$Phone', '$Membership', '$FeeWaiver', '$fri1', '$fri2',
				 '$fri3', '$sat1', '$sat2',  '$sat3', '$WorkLevel', '$Comments')";
	}
	mysqli_query($con, $query);


// deletes all values previously in the REV_KEYWORD
	$query = "DELETE FROM REV_KEYWORD WHERE Email = \"$Email\"";
	mysqli_query($con, $query);

// then put in all newly selected values
	$basequery = "INSERT INTO REV_KEYWORD (Email, Keyword) VALUES ('$Email', '" ;
	$keywords= $_POST['keyword'];
	if(!empty($keywords))
	{
		foreach($keywords as $value)
		{	
			$query = $basequery . "$value')";
			mysqli_query($con, $query);
		}
	}

// deletes all values previously in the REV_OPPORTUNITY
	$query = "DELETE FROM REV_OPPORTUNITY WHERE Email = \"$Email\"";
	mysqli_query($con, $query);

// then put in all newly selected values
	$basequery = "INSERT INTO REV_OPPORTUNITY (Email, Opportunity) VALUES ('$Email', '" ;
	$opportunities= $_POST['opportunity'];
	if(!empty($opportunities))
	{
		foreach($opportunities as $value)
		{	
			$query = $basequery . "$value')";
			mysqli_query($con, $query);
		}
	}

	mysqli_close($con);

	header("location: " . $serverRoot . "/submission.php");
?>