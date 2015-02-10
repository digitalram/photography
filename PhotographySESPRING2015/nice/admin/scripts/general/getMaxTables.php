<?php

	require_once "../../../bootstrap.php";

	// current year
	$currentYear = date("Y");

	$registrationPeriod = framework::getOne("SELECT * FROM registration_periods WHERE year = '". $currentYear ."'");

	$maxTables = 0;

	if(!empty($registrationPeriod)) {
		$maxTables = $registrationPeriod["max_tables"];
	}

	echo json_encode(array(
		"status" => "success",
		"data" => $maxTables
	));

?>