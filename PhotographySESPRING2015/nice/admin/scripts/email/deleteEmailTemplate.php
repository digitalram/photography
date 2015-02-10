<?php

	require_once "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$emailTemplateId = framework::clean($request["emailTemplateId"]);

	// execute
	framework::execute("DELETE FROM email_templates WHERE email_template_id = '". $emailTemplateId ."'");

	// result
	echo json_encode(array("status" => "success"));

?>