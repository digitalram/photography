<?php

	require_once "../../../bootstrap.php";
	require_once "../../../scheduler.php";
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
	
	Scheduler::ClearSchedule($regPeriod["registration_period_id"]);
	
	$ret = array();
	/*
	$numAttendees = app::getTotalAttendees($regPeriod["registration_period_id"]);
	$numReviewers = app::getTotalReviewers($regPeriod["registration_period_id"]);
	$numRegisteredAttendees = app::getTotalRegisteredAttendees();
	$numRegisteredReviewers = app::getTotalRegisteredReviewers();
	
	$ret["messages"] = $messages;
	$ret["attendees"] = $numAttendees;
	$ret["reviewers"] = $numReviewers;
	$ret["reg_attend"] = $numRegisteredAttendees;
	$ret["reg_reviewers"] = $numRegisteredReviewers;
	*/
	echo json_encode($ret);

?>