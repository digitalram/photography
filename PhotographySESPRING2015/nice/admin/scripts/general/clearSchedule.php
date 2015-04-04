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

	//  check whether schedule has been created first
	if( $regPeriod["schedule_created"] === "no" ){
		echo json_encode(array("status" => "Schedule hasn't been created yet!"));
		return;
	}
	
	/* Get Current Registration Period ID */
	$reg_id = $regPeriod["registration_period_id"];
	
	/* Count the number of sessions for this registration period id before deleting */
	$count_query = "SELECT COUNT(*) AS count FROM session WHERE registration_period_id = ". $reg_id ."";
	
	/* Hold statistics to return */
	$ret = array();
	
	/* Count how many session entries are created for this registration year */
	$count = framework::getOne($count_query);
	$ret["count"] = $count["count"];
	$ret["status"] = "";
	
	/* Clear the schedule for given year */
	Scheduler::ClearSchedule($reg_id);
	
	/* The schedule is now NOT published after cleared */
	$sql = "UPDATE registration_periods SET schedule_published = 1 WHERE year = '". $currentYear ."'";
	framework::execute($sql);

	echo json_encode($ret);

?>



	