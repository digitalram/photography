<?php

	# note: same thing as reviewerSchedule.php

	# fixme: pagination is fucky

	include_once "bootstrap.php";

	$registrationPeriod		= app::getCurrentRegistrationPeriod();
	$registrationPeriodId	= $registrationPeriod["registration_period_id"];

	// reqs
	$request = framework::getRequestVars();

	$typeSql = "";

	if(isset($request["day"])) {
		$typeSql = "
		AND SUBSTR(s.day_slot,1,1) = '". strtoupper(substr($request["day"], 0, 1)) ."'
		";
	}

	// pagination
	$page	= (isset($request["p"])) ? $request["p"] : 1;
	$limit	= 24 * 2;
	$offset	= $page * $limit;

	$total = framework::getMany("
	SELECT
		s.day_slot AS day_slot,
		s.table_num AS table_num,
		s.reviewer_id AS reviewer_id,
		ur.first_name AS reviewer_firstname,
		ur.last_name AS reviewer_lastname,
		ua.first_name AS attendee_firstname,
		ua.last_name AS attendee_lastname
	FROM
		`session` AS s

	JOIN reviewers AS r
	ON (
		r.reviewer_id = s.reviewer_id
	)

	JOIN attendees AS a
	ON (
		a.attendee_id = s.attendee_id1
		OR
		a.attendee_id = s.attendee_id2
		OR
		a.attendee_id = s.attendee_id3
		OR
		a.attendee_id = s.attendee_id4
		OR
		a.attendee_id = s.attendee_id5
		OR
		a.attendee_id = s.attendee_id6
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
		". $typeSql ."

	ORDER BY
		s.table_num ASC
	");

	$total = count($total);

	$sessions = framework::getMany("
		SELECT
			s.day_slot AS day_slot,
			s.table_num AS table_num,
			s.reviewer_id AS reviewer_id,
			ur.first_name AS reviewer_firstname,
			ur.last_name AS reviewer_lastname,
			ua.first_name AS attendee_firstname,
			ua.last_name AS attendee_lastname
		FROM
			`session` AS s

		JOIN reviewers AS r
		ON (
			r.reviewer_id = s.reviewer_id
		)

		JOIN attendees AS a
		ON (
			a.attendee_id = s.attendee_id1
			OR
			a.attendee_id = s.attendee_id2
			OR
			a.attendee_id = s.attendee_id3
			OR
			a.attendee_id = s.attendee_id4
			OR
			a.attendee_id = s.attendee_id5
			OR
			a.attendee_id = s.attendee_id6
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
			". $typeSql ."

		ORDER BY
			s.table_num ASC

		LIMIT ". $offset .",". $limit ."
		");

	$entries = array();

	foreach($sessions as $session) {
		$daySlot	= $session["day_slot"];
		$reviewerId	= $session["reviewer_id"];
		$tableNum	= $session["table_num"];

		$key = $reviewerId;

		$attendee	= $session["attendee_lastname"] . ", " . $session["attendee_firstname"];

		if(!isset($entries[$key])) {

			$reviewer	= $session["reviewer_lastname"] . ", " . $session["reviewer_firstname"];

			$entries[$key] = array(
				"table_num"	=> $tableNum,
				"reviewer_name" => $reviewer,
				"dayslot" => $daySlot,
				"attendees" => array(
					$attendee
				)
			);
		} else {

			$entries[$key]["attendees"][] = $attendee;

		}
	}

	$pagination	= "";
	$maxPages	= floor( $total / $limit );

	for($i = 1; $i <= $maxPages; $i++) {
		if($page == $i) {
			$pagination .= " " . $i . " ";
		} else {
			$_day = "";

			if(isset($request["day"])) {
				$_day = "&day=" . $request["day"];
			}

			$pagination .= " <a href=\"?page=masterSchedule". $_day ."&p=". $i ."\">". $i ."</a> ";
		}
	}

	$day = (isset($request["day"])) ? ucwords($request["day"]) : "";

	echo "<h1 style=\"padding-left: 15px;\">Master Schedule ". (($day == "") ? "" : " - " . $day) ."</h1>";
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
					<h2>{$entry["reviewer_name"]}</h2>
					<p class="table" style="margin-left:-20px;">Table: {$entry["table_num"]} on {$day} from {$time}</p>
					<hr/>
					<ul>
HTML;
		foreach($entry["attendees"] as $attendee) {
			echo <<< HTML
						<li>
							<p class="name">{$attendee}</p>
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

<div class="pdf">
	<a class="button" href="index.php" onclick="return false;"><</a>
	<p><a href="index.php" onclick="return false;">Print this Schedule (to download schedule, print as a PDF).</a></p>
</div>