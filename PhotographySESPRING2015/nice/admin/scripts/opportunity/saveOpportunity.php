<?php

	include "../../../bootstrap.php";

	// request vars
	$request = framework::getRequestVars();

	// params
	$opportunityDefinitionId = framework::clean($request["opportunityDefinitionId"]);
	$newOpportunity = framework::clean($request["name"]);

	// update
	framework::execute("
	UPDATE
		opportunity_definition
	SET
		name = '". $newOpportunity ."'
	WHERE
		opportunity_definition_id = '". $opportunityDefinitionId ."'
	");

	// return status
	echo json_encode(array('status' => 'success'));

?>