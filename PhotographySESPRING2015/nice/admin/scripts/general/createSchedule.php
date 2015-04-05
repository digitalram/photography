<?php

	require_once "../../../bootstrap.php";
	require_once "../../../scheduler.php";
	error_reporting(E_ALL);

	/* Get Current Year */
	$currentYear = date("Y");
	$query = "SELECT * FROM registration_periods WHERE year = '". $currentYear ."'";

	/* Get Current Registration Period Information */
	$regPeriod = framework::getOne($query);

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

	/* Create the Schedule */
	Scheduler::MakeSchedule($regPeriod["registration_period_id"]);
	
	/* Let's grab some statistics */
	$count_query = "SELECT COUNT(*) AS count FROM session WHERE registration_period_id = ". $regPeriod["registration_period_id"] ."";
	$count = framework::getOne($count_query);
	$message = "The schedule has been successfully created.\n" . (string)$count["count"] . " sessions created.";

	echo json_encode(array("status" => $message));
	//echo json_encode($ret);

?>