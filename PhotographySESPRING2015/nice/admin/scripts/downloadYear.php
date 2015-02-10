<?php

// TODO: IS THIS NEEDED?

$serverRoot =  $_SERVER['DOCUMENT_ROOT']  . dirname(dirname(dirname($_SERVER['PHP_SELF']))); // path to url root directory

$year = $_POST['year'];

$dir = $serverRoot . "/outputFiles/";
$files = scandir($dir);

$zipname = $year ."_SPE_Conv.zip";
$zippathname= $serverRoot . "/outputFiles/" . $zipname;

$zip = new ZipArchive;
$myZip = $zip->open($zippathname, ZipArchive::CREATE);

if ($myZip === TRUE)
{
	foreach ($files as $file=>$value)
	{
		if ($value != '.' && $value != '..')
		{
			if ($year == substr($value, -8, -4)) // if the selected year
			{
				$filepath = $dir . $value;
				$zip->addFile($filepath, $value);
			}
		}
	}	
}
else
	echo "zip not created.";

$zip->close();


	header('Content-Description: File Transfer');
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename=' . $zipname);
	header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
	header('Content-Length: ' . filesize($zippathname));
	ob_clean();
    flush();	
	readfile($zippathname);
	exit;


?>