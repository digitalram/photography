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
	
	/* Update registration periods to show that schedule has been published */
	$query_publish = "UPDATE registration_periods SET schedule_published = 2 WHERE year = '". $currentYear ."'";
	framework::execute($query_publish);
	
	echo json_encode(array("status" => "Schedule Published."));

?>