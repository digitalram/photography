<?php

	require_once "../../../bootstrap.php";

	// current year
	$currentYear = date("Y");

	$registrationPeriod = framework::getOne("SELECT * FROM registration_periods WHERE year = '". $currentYear ."'");

	$maxAttendees = 0;

	if(!empty($registrationPeriod)) {
		$maxAttendees = $registrationPeriod["attendees_match_limit"];
		if( $maxAttendees == '' ){
			$maxAttendees = "None";
		}
	}
	
	echo json_encode(array(
		"status" => "success",
		"data" => $maxAttendees
	));

?>