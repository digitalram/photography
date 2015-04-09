<?php

	ob_start();
	session_start();

	set_include_path(dirname(__FILE__));

	$config = dirname(__FILE__) . "/includes/database.config.php";

	// include database config
	if(is_file($config)) {

		require_once $config;

	} else {

		echo "Someone forgot to rename their database.config.php file.";
		die();
	}
	
	// pre-reqs
	require_once dirname(__FILE__) . "/framework.php";
	require_once dirname(__FILE__) . "/app.php";

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
	
	// init app
	app::initialize();

?>
