<?php 


function SelectAdd($type, $action)
{
	include(dirname(dirname(dirname(__FILE__))) . "/config.php"); // for sql connection ($con)
	
	if ($type == "keyword")
		$query = "SELECT * FROM KEYWORDS"; 
	else
		$query = "SELECT * FROM OPPORTUNITIES"; 
	
	$result = mysqli_query($con, $query);	// run the query
	$numrows = mysqli_num_rows($result);	// get the number of tuples

	echo "<select class=\"roundedClass\" id=\"$action\" name=\"$action\" style=\"width:100%;\">\n";
	echo "<option value =\"\" disabled selected>Select " . $type . "</option>\n";
	for ($i = 0; $i < $numrows; $i++)
	{
		if($row = mysqli_fetch_array($result))	// if there is a tuple (also puts into row)
			echo "<option value=\"" . $row["$type"] . "\">" . $row["$type"] . "</option>\n";
	}
	echo "</select>\n";
	
	mysqli_close($con);
}

?>