<?php

	require_once "../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$emailTemplateId = framework::clean($request["emailTemplateId"]);
	$identifier = framework::clean($request["identifier"]);
	$subject = framework::clean($request["subject"]);
	$message = framework::clean($request["message"]);
	$useConfirmationCode = framework::clean($request["useConfirmationCode"]);
	$confirmExpire = framework::clean($request["confirmExpire"]);

	// save
	framework::execute("
	UPDATE
		email_templates
	SET
		identifier = '". $identifier ."',
		subject = '". $subject ."',
		message = '". $message ."',
		use_confirmation_code = '". $useConfirmationCode ."',
		confirm_expire = '". $confirmExpire ."'
	");

	// return
	$ret = array("status" => "success");

	echo json_encode($ret);
?>