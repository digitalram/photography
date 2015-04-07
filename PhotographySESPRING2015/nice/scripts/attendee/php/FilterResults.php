<?php 
	require_once "../../../bootstrap.php";

$keywords = $_POST['keywords'];
$opportunity = $_POST['opportunity'];
$userType = $_POST['userType'];

$revList = array();

/*Probably need what was the REV_xxxxx tables to find the reviewer choices
	-then just select that stuff based on what was given in the $keywords
		and $opportunity and print it.*/
		
$keyword_query = "SELECT r.reviewer_id, k.keyword_id, u.first_name, u.last_name
				from users u
				join reviewer_genre k
				on u.user_id = k.user_id
				join keyword_definition kd
				on k.keyword_id = kd.keyword_definition_id
				join reviewers r
				on u.user_id = r.user_id";

if ($userType == "student") {
		$keyword_query = $keyword_query . " WHERE r.friday_morning = 'x' OR r.friday_midday = 'x' OR r.friday_afternoon = 'x'";
} else if ($userType == "professional") {
		$keyword_query = $keyword_query . " WHERE r.saturday_morning = 'x' OR r.saturday_midday = 'x' OR r.saturday_afternoon = 'x'";
}

$keyword_result = framework::getMany($keyword_query);

$opp_query = "SELECT r.reviewer_id, k.opp_id, u.first_name, u.last_name
				from users u
				join reviewer_opps k
				on u.user_id = k.user_id
				join opportunity_definition od
				on k.opp_id = od.opportunity_definition_id
				join reviewers r
				on u.user_id = r.user_id";

if ($userType == "student") {
		$opp_query = $opp_query . " WHERE r.friday_morning = 'x' OR r.friday_midday = 'x' OR r.friday_afternoon = 'x'";
} else if ($userType == "professional") {
		$opp_query = $opp_query . " WHERE r.saturday_morning = 'x' OR r.saturday_midday = 'x' OR r.saturday_afternoon = 'x'";
}

$opp_result = framework::getMany($opp_query);

$label = 1;
echo "<table >";
for( $i = 0; $i < 5; $i++ )
{
	echo "\t\t\t<tr>";
	
	for( $j = 0; $j < 4; $j++ )
	{
		echo "\t\t\t\t<td>" . $label . ".)</td><td><select id=\"preference" . $label . "\" name=\"preference" . $label . "\" class=\"preference\" >\n";
		echo "\t\t\t\t\t<option value=\"default\" disabled selected>Select Preference</option>\n";

		// Add all Reviewers based on genres
		foreach($keyword_result as $row)
		{
			if (in_array($row["keyword_id"], $keywords) && !in_array($row["reviewer_id"], $revList)) {
				array_push($revList, $row["reviewer_id"]);
				echo "\t\t\t\t\t<option value=\"" . $row["reviewer_id"] . "\">" . $row["last_name"] . ", " . $row["first_name"] . "</option>\n";
			}
		}
		
		// Add all Reviewers based on opps
		foreach($opp_result as $row)
		{
			if (in_array($row["opp_id"], $opportunity) && !in_array($row["reviewer_id"], $revList)) {
				array_push($revList, $row["reviewer_id"]);
				echo "\t\t\t\t\t<option value=\"" . $row["reviewer_id"] . "\">" . $row["last_name"] . ", " . $row["first_name"] . "</option>\n";
			}
		}
		echo "\t\t\t\t</select></td>\n";

		unset($revList);
		$revList = array();

		$label++;
	}
	echo "\t\t\t</tr>\n";
}
echo "\t</table>\n";

return $numrows;

?>

