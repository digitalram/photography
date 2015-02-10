<?php

	require_once "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$identifier = framework::clean($request["identifier"]);
	$subject = framework::clean($request["subject"]);
	$message = framework::clean($request["message"]);
	$useConfirmationCode = framework::clean($request["useConfirmationCode"]);
	$confirmExpire = framework::clean($request["confirmExpire"]);

	// insert
	framework::execute("
	INSERT INTO
		email_templates
		(identifier, subject, message, use_confirmation_code, confirm_expire)
	VALUES
		('". $identifier ."', '". $subject ."', '". $message ."', '". $useConfirmationCode ."', '". $confirmExpire ."')
	");

	// result
	echo json_encode(array("status" => "success"));

?>