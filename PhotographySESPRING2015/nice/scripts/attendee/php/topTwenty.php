<?php 
if(isset($_POST['fromJs']))
{
	require_once"../../../bootstrap.php";
}
else
{
	require_once "bootstrap.php";
}

$query = "  SELECT 
				reviewer_id, first_name, last_name
			FROM 
				users JOIN reviewers
				on users.user_id = reviewers.user_id
			WHERE 
				friday_morning = 'x' 
				OR friday_midday = 'x' 
				OR friday_afternoon = 'x' 
				OR saturday_morning = 'x' 
				OR saturday_midday = 'x' 
				OR saturday_afternoon = 'x'";
$result = framework::getMany($query);
$numrows = count($result);

$label = 1;
echo "<table >";
for( $i = 0; $i < 5; $i++ )
{
	echo "\t\t\t<tr>";
	
	for( $j = 0; $j < 4; $j++ )
	{
		echo "\t\t\t\t<td align=\"right\">" . $label . ".)</td><td><select id=\"preference" . $label . "\" name=\"preference" . $label . "\" class=\"preference\" >\n";
		echo "\t\t\t\t\t<option value=\"default\" disabled selected>Select preference</option>\n";
		foreach($result as $row)
		{
			echo "\t\t\t\t\t<option value=\"" . $row["reviewer_id"] . "\">" . $row["last_name"] . ", " . $row["first_name"] .  "</option>\n";
		}
		echo "\t\t\t\t</select></td>\n";
		$label++;
	}
	echo "\t\t\t</tr>\n";
}
echo "\t</table>\n";
/**********************/
?>