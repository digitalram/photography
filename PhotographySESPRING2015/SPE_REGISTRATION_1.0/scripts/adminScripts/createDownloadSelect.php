<?php 
$serverRoot =  $_SERVER['DOCUMENT_ROOT']  . dirname($_SERVER['PHP_SELF']); // path to url root directory

$dir = $serverRoot . "/outputFiles/";
$files = scandir($dir);


$numrows = count($files);

echo "<select id='adminSelect' name='download' style='width: 150px;'>\n";

echo "<option value=\"default\" disabled selected>Select Filename</option>\n";

foreach ($files as $filename=>$value)
	if ($value != '.' && $value != '..')
		echo "<option value=\"" . $value . "\">" . $value .  "</option>\n";


echo "</select>\n";


?>