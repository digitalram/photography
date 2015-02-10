<?php

	$yr = date("Y");

	$row = framework::getOne("SELECT * FROM registration_periods WHERE year = '". $yr ."'");

if($row) {

	$dateFormat = "m/d/Y";

	$revFrom = date_create($row['reviewer_from']);
	$revFrom = date_format($revFrom, $dateFormat);
	$revTo = date_create($row['reviewer_until']);
	$revTo = date_format($revTo, $dateFormat);
	$attFrom = date_create($row['attendee_from']);
	$attFrom = date_format($attFrom, $dateFormat);
	$attTo = date_create($row['attendee_until']);
	$attTo = date_format($attTo, $dateFormat);
	$maxTables = $row['max_tables'];

	$html = "";
	$html.= "<table>";
	$html.= "	<tr>";
	$html.= "		<td style=\"text-align: right !important;\"><b>Reviewer Registration</b></td>";
	$html.= "		<td style=\"text-align: left !important;\">From " . $revFrom . " To " . $revTo . "</td>";
	$html.= "	</tr>";
	$html.= "	<tr>";
	$html.= "		<td style=\"text-align: right !important;\"><b>Attendee Registration</b></td>";
	$html.= "		<td style=\"text-align: left !important;\">From " . $attFrom . " To " . $attTo . "</td>";
	$html.= "	</tr>";
	$html.= "	<tr>";
	$html.= "		<td style=\"text-align: right !important;\"><b>Number of Tables</b></td>";
	$html.=	"		<td style=\"text-align: left !important;\" id=\"tdMaxTables\">". $maxTables ."</td>";
	$html.=	"	</tr>";
	$html.= "</table>";

	echo $html;
	
} else {
	echo "No registration periods have been set for this year.";
}

?>