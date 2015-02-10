<?php

	include "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$emailTemplateId = $request["emailTemplateId"];

	$template = framework::getOne("SELECT * FROM email_templates WHERE email_template_id = '". $emailTemplateId ."'");

	$ret = array();
	$ret["status"] = "success";
	$ret["data"] = $template;

	echo json_encode($ret);

?>