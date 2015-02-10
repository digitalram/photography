<?php

	// pre-req
	require_once "bootstrap.php";
	
	// ref to get var 'page' (e.g. '?page=viewSchedule')
	$controller = @$_GET['page'];
	
	require_once "includes/header.php";

	if(!$controller) {
		$controller = "home";
	}

	// handle it!
	framework::handle($controller);
	
	// close framework/mysqli connection
	framework::close();

?>
