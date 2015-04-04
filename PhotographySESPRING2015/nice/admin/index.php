<?php

	// include bootstrap
	require_once "../bootstrap.php";
	
	// mcm - add scheduler classes for testing
	require_once "../includes/schedule.php";

	// dynamically depict environment we're currently in
	if(strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {
		error_reporting(E_ALL);
	} else {
		config::productionOverride();
	}

	// init framework
	framework::initialize(
		config::$hostname,	// hostname (e.g. localhost)
		config::$username,	// username (e.g. root)
		config::$password,	// password
		config::$dbname		// database name
	);

	// ref to get var 'page' (e.g. '?page=viewSchedule')
	$controller = @$_GET['page'];

	require_once "includes/header.php";

	if(framework::isLoggedIn() && framework::isAdmin()) {
		require_once "admin.php";
	} else {
		require_once "login.php";
	}

	// handle it!
	framework::handle($controller);

	// close framework/mysqli connection
	framework::close();

?>