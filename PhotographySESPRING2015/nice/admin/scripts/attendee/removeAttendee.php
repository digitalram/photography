<?php

	include "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$attendeeId = framework::clean($request["attendeeId"]);
	$registrationPeriodId = framework::clean($request["registrationPeriodId"]);

	/* Get attendees name for status confirmation message */
	$query = "SELECT first_name, last_name FROM users JOIN attendees as a 
	          WHERE a.attendee_id = ". $attendeeId ." and users.user_id = a.user_id";
	$names = framework::getOne($query);
	$name = $names["first_name"] . " " . $names["last_name"];
	
	
	// get session_ids
	$sessions = framework::getMany("
	SELECT
		session_id,
		attendee_id1,
		attendee_id2,
		attendee_id3,
		attendee_id4,
		attendee_id5,
		attendee_id6

	FROM
		`session`
	WHERE
		attendee_id1 = '". $attendeeId ."'
		OR
		attendee_id2 = '". $attendeeId ."'
		OR
		attendee_id3 = '". $attendeeId ."'
		OR
		attendee_id4 = '". $attendeeId ."'
		OR
		attendee_id5 = '". $attendeeId ."'
		OR
		attendee_id6 = '". $attendeeId ."'
		AND
		registration_period_id = '". $registrationPeriodId ."'
	");

	$fields = array(
		"attendee_id1",
		"attendee_id2",
		"attendee_id3",
		"attendee_id4",
		"attendee_id5",
		"attendee_id6"
	);

	/* Hold statistics to return */
	$ret = array();
	
	$remove_counter = 0;
	
	// loop, update
	foreach($sessions as $session) {
		$sessionId = $session["session_id"];

		$fieldName = "";

		foreach($fields as $field) {
			if($session[$field] == $attendeeId) {
				$fieldName = $field;
				break;
			}
		}

		// exec
		$query = "UPDATE session SET ". $fieldName ." = NULL WHERE ". $fieldName ." = ". $attendeeId ."";
		framework::execute($query);
		/*
		framework::execute("
		UPDATE
			`session`
		SET
			". $fieldName ." = NULL
		WHERE
			session_id = '". $attendeeId ."'
		");
		*/
		$remove_counter++;
	}

	$ret["status"] = "success";
	$ret["counter"] = $remove_counter;
	$ret["name"] = $name;
	
	//echo json_encode(array("status" => "success"));
	echo json_encode($ret);

?>