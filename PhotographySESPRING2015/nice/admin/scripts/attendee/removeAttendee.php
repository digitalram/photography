<?php

	include "../../../bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// params
	$attendeeId = framework::clean($request["attendeeId"]);
	$registrationPeriodId = framework::clean($request["registrationPeriodId"]);

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
		framework::execute("
		UPDATE
			`session`
		SET
			". $fieldName ." = NULL
		WHERE
			session_id = '". $attendeeId ."'
		");
	}

	echo json_encode(array("status" => "success"));

?>