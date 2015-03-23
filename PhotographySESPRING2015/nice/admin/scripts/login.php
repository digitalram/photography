<?php

	require_once "../../bootstrap.php";

	if(isset($_POST)) {
		$request = framework::getRequestVars();

		$email		= framework::clean($request["email_address"]);
		$password	= framework::clean($request["password"]);

		$redirect = "http://" . $_SERVER["HTTP_HOST"] . "/photography/photography/PhotographySESPRING2015/";

		// user has entered correct credentials
		if(framework::login($email, $password)) {
			framework::redirect("admin/index.php");
		} else { // user has entered incorrect - redirect
			framework::redirect("admin/index.php?incorrect=1");
		}

	} else {
		framework::redirect("admin/index.php");
	}