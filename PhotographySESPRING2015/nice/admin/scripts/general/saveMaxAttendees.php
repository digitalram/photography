<?php

	require_once "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$maxAttendees = $request["attendees_match_limit"];
	$currentYear = date("Y");

	$registrationPeriod = framework::getOne("SELECT * FROM registration_periods WHERE year = '". $currentYear ."'");

	if(!empty($registrationPeriod)) {
		framework::execute("
		UPDATE
			registration_periods
		SET
			attendees_match_limit = '". $maxAttendees ."'
		WHERE
			year = '". $currentYear ."'
		");
	} else {
		echo json_encode(array(
			"status" => "There is no registration period for this year - please set one below."
		));
	}

	echo json_encode(array(
		"status" => "success"
	));

?>