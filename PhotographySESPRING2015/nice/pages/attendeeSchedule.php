<?php

	include_once "bootstrap.php";

	$registrationPeriod		= app::getCurrentRegistrationPeriod();
	$registrationPeriodId	= $registrationPeriod["registration_period_id"];

	// reqs
	$request = framework::getRequestVars();

	$searchSql = "";

	if(isset($request["first"]) && isset($request["last"])) {
		# fixme: why the fuck does this work this way? fix it.
		$searchSql = "AND ((ua.first_name = '". $request["first"] ."' AND ua.last_name = '". $request["last"] ."') OR (ur.first_name = '". $request["first"] ."' AND ur.last_name = '". $request["last"] ."'))";

	}

	// pagination
	$page	= (isset($request["p"])) ? $request["p"] : 1;
	$limit	= 24;
	$offset	= $page * $limit;

	$total = framework::getMany("
	SELECT
		s.day_slot AS day_slot,
		s.table_num AS table_num,
		a.attendee_id AS attendee_id,
		ur.first_name AS reviewer_firstname,
		ur.last_name AS reviewer_lastname,
		ua.first_name AS attendee_firstname,
		ua.last_name AS attendee_lastname
	FROM
		attendees AS a

	JOIN session AS s
	ON (
		s.attendee_id1 = a.attendee_id
		OR
		s.attendee_id2 = a.attendee_id
		OR
		s.attendee_id3 = a.attendee_id
		OR
		s.attendee_id4 = a.attendee_id
		OR
		s.attendee_id5 = a.attendee_id
		OR
		s.attendee_id6 = a.attendee_id
	)

	JOIN reviewers AS r
	ON (
		r.reviewer_id = s.reviewer_id
	)

		JOIN users AS ur
		ON (
			ur.user_id = r.user_id
		)

	JOIN users AS ua
	ON (
		ua.user_id = a.user_id
	)

	WHERE
		s.registration_period_id = '". $registrationPeriodId ."'
		". $searchSql ."

	ORDER BY
		s.table_num ASC
	");

	$total = count($total);

	$attendees = framework::getMany("
	SELECT
		s.day_slot AS day_slot,
		s.table_num AS table_num,
		a.attendee_id AS attendee_id,
		ur.first_name AS reviewer_firstname,
		ur.last_name AS reviewer_lastname,
		ua.first_name AS attendee_firstname,
		ua.last_name AS attendee_lastname
	FROM
		attendees AS a

	JOIN session AS s
	ON (
		s.attendee_id1 = a.attendee_id
		OR
		s.attendee_id2 = a.attendee_id
		OR
		s.attendee_id3 = a.attendee_id
		OR
		s.attendee_id4 = a.attendee_id
		OR
		s.attendee_id5 = a.attendee_id
		OR
		s.attendee_id6 = a.attendee_id
	)

	JOIN reviewers AS r
	ON (
		r.reviewer_id = s.reviewer_id
	)

		JOIN users AS ur
		ON (
			ur.user_id = r.user_id
		)

	JOIN users AS ua
	ON (
		ua.user_id = a.user_id
	)

	WHERE
		s.registration_period_id = '". $registrationPeriodId ."'
		". $searchSql ."

	ORDER BY
		s.table_num ASC

	". ((!empty($searchSql)) ? "LIMIT ". $offset .",". $limit : "" )."
	");

	$entries = array();

	foreach($attendees as $attendee) {
		$daySlot		= $attendee["day_slot"];
		$attendeeId		= $attendee["attendee_id"];
		$tableNum		= $attendee["table_num"];

		$key = $attendeeId;

		$reviewer = $attendee["reviewer_lastname"] . ", " . $attendee["reviewer_firstname"];

		if(!isset($entries[$key])) {

			$attendee = $attendee["attendee_lastname"] . ", " . $attendee["attendee_firstname"];

			$entries[$key] = array(
				"table_num" 	=> $tableNum,
				"attendee_name"	=> $attendee,
				"dayslot"		=> $daySlot,
				"reviewers"		=> array(
					$reviewer
				)
			);

		} else {

			$entries[$key]["reviewers"][] = $reviewer;

		}
	}

	$pagination	= "";
	$maxPages	= floor( $total / $limit );

	for($i = 1; $i <= $maxPages; $i++) {
		if($page == $i) {
			$pagination .= " " . $i . " ";
		} else {
			$pagination .= " <a href=\"?page=attendeeSchedule&p=". $i ."\">". $i ."</a> ";
		}
	}

	echo "<h1 style=\"padding-left: 15px;\">Attendee Schedule</h1>";
	echo "<div style=\"text-align:center;\">". $pagination ."</div>";
	echo "<hr />";
	echo "<div class=\"schedule\">";

	foreach($entries as $entry) {

		$day = substr($entry["dayslot"], 0, 1);
		$time = substr($entry["dayslot"], 1);

		// determine day
		if($day == "F") {
			$day = "Friday";
		} else {
			$day = "Saturday";
		}

		// determine time
		switch($time) {
			case "1":
				$time = "9:00am - 11:00am";
				break;

			case "2":
				$time = "11:15am - 1:15pm";
				break;

			case "3":
				$time = "1:30pm - 3:30pm";
				break;

			default:
				$time = "TBD";
				break;
		}


		echo <<< HTML

				<div class="section">
					<h2>{$entry["attendee_name"]}</h2>
					<p class="table" style="margin-left:-20px;">Table: {$entry["table_num"]} on {$day} from {$time}</p>
					<hr/>
					<ul>
HTML;
		foreach($entry["reviewers"] as $reviewer) {
			echo <<< HTML
						<li>
							<p class="name">{$reviewer}</p>
							<!--<p class="time">1:00pm</p>-->
						</li>
HTML;
		}

		echo <<< HTML
					</ul>
				</div>
HTML;

	}

	echo "</div>";



?>