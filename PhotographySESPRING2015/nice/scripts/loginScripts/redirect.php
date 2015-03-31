<?php  //Start the Session
include($_SERVER['DOCUMENT_ROOT'] . "/spe/admin". "/connect.inc.php"); // for sql connection ($con)
$serverRoot = "http://" . $_SERVER['HTTP_HOST']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory
$adminRoot =  "http://" . $_SERVER['HTTP_HOST'] . '/spe/admin';
//echo dirname(dirname(dirname($_SERVER['PHP_SELF']))) . "/config.php" . "<br>";

if (session_status() == PHP_SESSION_NONE) 
	session_start();	// this allows for subsequent pages to retain some information (username)

// if the fields have been submitted
if (isset($_POST['username']) and isset($_POST['password']))
{
	// Assigning posted values to variables.
	$username = $_POST['username'];
	$password = $_POST['password'];

	// set the query. if username & password are in database and in same row, returns 1 row
	$query = "SELECT * FROM LOGIN WHERE username = \"$username\" and pwd = \"$password\"";
	
	$result = mysqli_query($con,$query) ;	// run the query
	$row = mysqli_fetch_array($result);		// one dimensional array containing user's record
	$count = mysqli_num_rows($result);		// should only ever be 0 or 1

	if ($count==1)
	{
		$_SESSION['username'] = $username;
		$expire=time()+60*60*24;				// expiration time for a cookie
		
		setcookie("user", $username, $expire, '/');
		session_start();
		if($row['userType'] == "admin"){
			header("location: " . $adminRoot . "/admin.php");	// take to admin page
		}
		else if($row['userType'] == "reviewer") {
			header("location: " . $serverRoot . "/reviewer.php");	// take to reviewer page
		}
		
	} 
	else 
	{
		header("location: " . $serverRoot . "/relogin.php");  	// take to invalid login page
	}
}
mysqli_close($con);
?>



