<?php 
if(isset($_POST['fromJs']))
{
	require_once"../../../bootstrap.php";
}
else
{
	require_once "bootstrap.php";
}

$label = 1;
echo "<table >";
for( $i = 0; $i < 5; $i++ )
{
	echo "\t\t\t<tr>";
	
	for( $j = 0; $j < 4; $j++ )
	{
		echo "\t\t\t\t<td align=\"right\">" . $label . ".)</td><td><select id=\"preference" . $label . "\" name=\"preference" . $label . "\" class=\"preference\" >\n";
		echo "\t\t\t\t\t<option value=\"default\" disabled selected>No results</option>\n";
		echo "\t\t\t\t</select></td>\n";
		$label++;
	}
	echo "\t\t\t</tr>\n";
}
echo "\t</table>\n";
/**********************/
?>