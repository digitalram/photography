<?php

	include "../../../bootstrap.php";

	// request vars
	$request = framework::getRequestVars();

	// params
	$newOportunity = framework::clean($request["name"]);

	// execute
	framework::execute("INSERT INTO opportunity_definition (name) VALUES ('". $newOportunity ."')");

	// return status
	echo json_encode(array('status' => 'success'));

?>