<?php

	include "../../../bootstrap.php";

	// request vars
	$request = framework::getRequestVars();

	// params
	$newKeyword = framework::clean($request["name"]);

	// execute
	framework::execute("INSERT INTO keyword_definition (name) VALUES ('". $newKeyword ."')");

	// return status
	echo json_encode(array('status' => 'success'));

?>