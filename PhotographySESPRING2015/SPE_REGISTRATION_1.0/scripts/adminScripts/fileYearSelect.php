<?php 

echo "<select id='adminSelect' name='year' style='width: 150px;'>\n";

$firstyear = 2013;
$thisyear = date("Y");

for ($i = $firstyear; $i <= $thisyear; $i++)
	if ($i == date("Y"))
		echo "<option value='$thisyear' selected>$thisyear</option>\n";
	else
		echo "<option value='$i'>$i</option>\n";


echo "</select>\n";


?>