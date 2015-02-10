<?php

// TODO: NEVER GIVE A FILENAME AS INPUT
// TODO: SEE: LFI VULNERABILITIES...

$serverRoot =  $_SERVER['DOCUMENT_ROOT']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

//$filename = $_SERVER['DOCUMENT_ROOT'] . "/spe/outputFiles/OrginizationalData_" . date("m-d-y") . ".csv";

$filename = $_POST['download'];
$filepath = $serverRoot . "/outputFiles/" . $filename;

if (file_exists($filepath)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: text/csv');
	    header('Content-Disposition: attachment; filename='. $filename);
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($filepath));
	    ob_clean();
	    flush();
	    readfile($filepath);
	    exit;
	}
	else
		echo ('cant find file');
	?>