<?php

	include "../../bootstrap.php";

	// request vars
	$request = framework::getRequestVars();

	// params
	$keywordDefinitionId = framework::clean($request["keywordDefinitionId"]);
	$newKeyword = framework::clean($request["name"]);

	// update
	framework::execute("
	UPDATE
		keyword_definition
	SET
		name = '". $newKeyword ."'
	WHERE
		keyword_definition_id = '". $keywordDefinitionId ."'
	");

	// return status
	echo json_encode(array('status' => 'success'));

?>