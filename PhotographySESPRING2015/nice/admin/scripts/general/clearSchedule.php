<?php
	// MCM - Attempting to Clear schedule ...
	
	// Don't know what this does...
	require_once "../../../bootstrap.php";

	// Report all PHP errors (see changelog)
	error_reporting(E_ALL);
	
	/* MCM - hack to clear schedule... 
	 * This deletes all rows in session table.  Too drastic???
	 * Also: no checks or warning prompts.... */
	framework::execute("DELETE FROM session WHERE 1");
?>