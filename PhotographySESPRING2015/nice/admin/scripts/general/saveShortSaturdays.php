<?php
	/* This script updates the short_saturdays column on 
	 * registration_periods table for the current year 
	 */

	require_once "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$shortSaturdays = $request["short_saturdays"];
	$currentYear = date("Y");

	$registrationPeriod = framework::getOne("SELECT * FROM registration_periods WHERE year = '". $currentYear ."'");

	if(!empty($registrationPeriod)) {
		framework::execute("
		UPDATE
			registration_periods
		SET
			short_saturdays = '". $shortSaturdays ."'
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