<?php

	include "../../../bootstrap.php";

	// request vars
	$request = framework::getRequestVars();

	// params
	$keywordDefinitionId = framework::clean($request["keywordDefinitionId"]);

	// update
	framework::execute("
	DELETE FROM
		keyword_definition
	WHERE
		keyword_definition_id = '". $keywordDefinitionId ."'
	");

	// remove orphans
	framework::execute("
	DELETE FROM
		keyword
	WHERE
		keyword_definition_id = '". $keywordDefinitionId ."'
	");

	// return status
	echo json_encode(array('status' => 'success'));

?>