<?php

	include "../../../bootstrap.php";

	// request vars
	$request = framework::getRequestVars();

	// params
	$opportunityDefinitionId = framework::clean($request["opportunityDefinitionId"]);

	// update
	framework::execute("
	DELETE FROM
		opportunity_definition
	WHERE
		opportunity_definition_id = '". $opportunityDefinitionId ."'
	");

	// remove orphans
	framework::execute("
	DELETE FROM
		opportunity
	WHERE
		opportunity_definition_id = '". $opportunityDefinitionId ."'
	");

	// return status
	echo json_encode(array('status' => 'success'));

?>