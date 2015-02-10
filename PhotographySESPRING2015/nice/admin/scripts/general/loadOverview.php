<?php

	require_once "../../../bootstrap.php";

	$ret = array();

	// registration period ref
	$registrationPeriod = framework::getOne("
	SELECT
		*
	FROM
		registration_periods
	WHERE
		year = '". date("Y") ."'
	");

	// schedule creation
	$count = framework::getOne("
	SELECT
		COUNT(*) AS count
	FROM
		session AS s

	WHERE
		registration_period_id = '". $registrationPeriod["registration_period_id"] ."'
	");

	$ret["publish_schedule"] = true;
	$ret["create_schedule"] = true;

	if($count["count"] > 0) {
		$ret["create_schedule"] = false;
	}

	if(app::isRegistrationOpen()) {
		$ret["publish_schedule"] = false;
	}

	echo json_encode($ret);

?>