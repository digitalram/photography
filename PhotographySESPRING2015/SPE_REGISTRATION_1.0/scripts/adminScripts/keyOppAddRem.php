<?php 
// open the database connection file and connect to the database
include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)

$keyword = $_POST['keyword'];
$keyop = $_POST['keyop'];
$flag = $_POST['flag'];

if ($keyop == "keyword")
{
	if($flag == "add")
	{
		$query = "INSERT INTO KEYWORDS VALUES ('$keyword')";
		if (mysqli_query($con, $query))
			echo "$keyword added to genres";
	}
	else // remove
	{
		$query = "DELETE FROM KEYWORDS WHERE keyword = '$keyword'";
		if (mysqli_query($con, $query))
			echo "$keyword deleted from genres";
	}
}
else // opportunity
{
	if($flag == "add")
	{
		$query = "INSERT INTO OPPORTUNITIES VALUES ('$keyword')";
		if (mysqli_query($con, $query))
			echo "$keyword added to opportunities";
	}
	else // remove
	{
		$query = "DELETE FROM OPPORTUNITIES WHERE opportunity = '$keyword'";
		if (mysqli_query($con, $query))
			echo "$keyword deleted from opportunities";
	}
}

mysqli_close($con);

?>