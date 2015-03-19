<?php

	require_once "../../../bootstrap.php";

	error_reporting(E_ALL);

	// params
	$currentYear = date("Y");

	// registration period check
	$regPeriod = framework::getOne("
		SELECT
			*
		FROM
			registration_periods
		WHERE
			year = '". $currentYear ."'
	");

	// check if we have a registration period to base the schedule on
	if(empty($regPeriod)) {
		echo json_encode(array("status" => "No registration periods set."));
		return;
	}

	// check that we have tables
	if($regPeriod["max_tables"] == 0) {
		echo json_encode(array("status" => "There have been no tables set for this registration period."));
		return;
	}

	// check if the schedule has been created already
	if($regPeriod["schedule_created"] == 'yes') {
		echo json_encode(array("status" => "The schedule has already been created!"));
		return;
	}

	$messages = "";

	// student
	$studentRet = app::createSchedule("student", $regPeriod["registration_period_id"]);

	// professional
	$professionalRet = app::createSchedule("professional", $regPeriod["registration_period_id"]);

	// Error message creation...
	if($studentRet !== true) {
		$messages .= $studentRet . "\n\n";
	}

	// Error message creation...
	if($professionalRet !== true) {
		$messages .= $professionalRet .= $professionalRet . "\n";
	}

	$ret = array();

	$numAttendees = app::getTotalAttendees($regPeriod["registration_period_id"]);
	$numReviewers = app::getTotalReviewers($regPeriod["registration_period_id"]);
	$numRegisteredAttendees = app::getTotalRegisteredAttendees();
	$numRegisteredReviewers = app::getTotalRegisteredReviewers();
	
	$ret["messages"] = $messages;
	$ret["attendees"] = $numAttendees;
	$ret["reviewers"] = $numReviewers;
	$ret["reg_attend"] = $numRegisteredAttendees;
	$ret["reg_reviewers"] = $numRegisteredReviewers;

	echo json_encode($ret);

?>