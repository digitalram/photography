<?php
	include "../../bootstrap.php";

	$request = framework::getRequestVars();

	$revFrom	= $request["revFrom"];
	$revTo		= $request["revTo"];
	$attFrom	= $request["attFrom"];
	$attTo		= $request["attTo"];

	$dtRevFrom = new \DateTime($revFrom);
	$yr = $dtRevFrom->format("Y");

	$regPeriod = framework::getOne("
	SELECT
		*
	FROM
		registration_periods
	WHERE
		year = '". $yr ."'
	");

	if(!empty($regPeriod)) {
		framework::execute("
		UPDATE
			registration_periods
		SET
			attendee_from = '". $attFrom ."',
			attendee_until = '". $attTo ."',
			reviewer_from = '". $revFrom ."',
			reviewer_until = '". $revTo ."'
		");
	} else {
		$query = "
			INSERT INTO
				registration_periods
			(`year`, attendee_from, attendee_until, reviewer_from, reviewer_until)
			VALUES ('$yr', '$attFrom', '$attTo', '$revFrom', '$revTo')
		";

		framework::execute($query);
	}

?>