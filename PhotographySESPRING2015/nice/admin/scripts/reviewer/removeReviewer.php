<?php

	include "../../../bootstrap.php";

	// include modules
	/** @var email $email */
	$email = framework::includeModule("email");

	// reqs
	$request = framework::getRequestVars();

	// params
	$reviewerId = framework::clean($request["reviewerId"]);
	$registrationPeriodId = framework::clean($request["registrationPeriodId"]);

	// basic
	$fields = array(
		"attendee_id1",
		"attendee_id2",
		"attendee_id3",
		"attendee_id4",
		"attendee_id5",
		"attendee_id6"
	);

	// get attendee ids
	$attendees = framework::getMany("
	SELECT
		attendee_id1,
		attendee_id2,
		attendee_id3,
		attendee_id4,
		attendee_id5,
		attendee_id6,
		day_slot,
		table_num
	FROM
		`session`
	WHERE
		reviewer_id = '". $reviewerId ."'
		AND
		registration_period_id = '". $registrationPeriodId ."'
	");

	$attendeeIds = array();

	$tableNum = null;
	$daySlot = "";

	foreach($attendees as $attendee) {
		if($tableNum == null) {
			$tableNum = $attendee["table_num"];
		}

		if($daySlot == "") {
			$daySlot = $attendee["day_slot"];
		}

		foreach($fields as $field) {
			if($attendee[$field] != null) {
				$attendeeIds[] = $attendee[$field];
			}
		}

	}

	// check to see if we have any reviewers not on the schedule
	$reviewers = framework::getMany("
	SELECT
		r.reviewer_id
	FROM
		reviewers AS r

	LEFT JOIN `session` AS s
	ON (
		s.reviewer_id = r.reviewer_id
		AND
		s.registration_period_id = '". $registrationPeriodId ."'
	)

	JOIN attendees AS a
	ON (
		a.reviewer_id1 = r.reviewer_id OR
		a.reviewer_id2 = r.reviewer_id OR
		a.reviewer_id3 = r.reviewer_id OR
		a.reviewer_id4 = r.reviewer_id OR
		a.reviewer_id5 = r.reviewer_id OR
		a.reviewer_id6 = r.reviewer_id OR
		a.reviewer_id7 = r.reviewer_id OR
		a.reviewer_id8 = r.reviewer_id OR
		a.reviewer_id9 = r.reviewer_id OR
		a.reviewer_id10 = r.reviewer_id OR
		a.reviewer_id11 = r.reviewer_id OR
		a.reviewer_id12 = r.reviewer_id OR
		a.reviewer_id13 = r.reviewer_id OR
		a.reviewer_id14 = r.reviewer_id OR
		a.reviewer_id15 = r.reviewer_id OR
		a.reviewer_id16 = r.reviewer_id OR
		a.reviewer_id17 = r.reviewer_id OR
		a.reviewer_id18 = r.reviewer_id OR
		a.reviewer_id19 = r.reviewer_id OR
		a.reviewer_id20 = r.reviewer_id
	)

	WHERE
		s.reviewer_id IS NULL
		AND
		a.attendee_id IN ('". implode("','", $attendeeIds) ."')
	");

	$reviewerIds = array();

	foreach($reviewers as $reviewer) {
		$reviewerIds[] = $reviewer["reviewer_id"];
	}

	if(count($reviewerIds) > 0) {
		// we do have a reviewer, at least - insert she/he and the remaining attendees
		foreach($reviewerIds as $reviewerId) {

			if(empty($attendeeIds)) {
				// done
				break;
			}

			// Text from Josh @ 10:15pm: Ready for tomororw?
			// My response: NULL
			for($i = 0; $i < 6; $i++) {
				$attendeeId = null;

				if(is_array($attendeeIds)) {
					$attendeeId = array_pop($attendeeIds);
				}

				if($attendeeId == null) {
					break;
				}

				$_attendeeIds[] = $attendeeId;

				$email->sendMailToAttendee($attendeeId, "new_reviewer");
			}

			$fieldsUpdating = array();

			$i = 1;

			foreach($_attendeeIds as $_attendeeId) {
				$fieldsUpdating[] = "attendee_id" . $i;

				$i++;
			}

			framework::execute("
			INSERT INTO `session` (
				table_num,
				day_slot,
				reviewer_id,
				registration_period_id,
				". implode(",", $fieldsUpdating) ."
			)

			VALUES (
				'". $tableNum ."',
				'". $daySlot ."',
				'". $reviewerId ."',
				'". $registrationPeriodId ."',
				'". implode("', '", $_attendeeIds) ."'
			)
			");

			$tableNum++;

		}
	}

	if(count($attendeeIds) > 0) {
		// we still have attendees... check to see if we can insert
		// them in the schedule anywhere..

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
			attendee_id1 IS NULL
			OR
			attendee_id2 IS NULL
			OR
			attendee_id3 IS NULL
			OR
			attendee_id4 IS NULL
			OR
			attendee_id5 IS NULL
			OR
			attendee_id6 IS NULL
			AND
			registration_period_id = '". $registrationPeriodId ."'
		");

		foreach($sessions as $session) {

			$fieldsToUpdate = array();

			if(empty($attendeeIds)) {
				break;
			}

			foreach($fields as $field) {
				if($session[$field] == null) {

					if(!is_array($attendeeIds)) {
						break;
					}

					$attendeeId = array_pop($attendeeIds);

					if($attendeeId == null) {
						break;
					}

					$arrUpdate[] = $field . " = '" . $attendeeId ."'";

					$email->sendMailToAttendee($attendeeId, "new_reviewer");

				}
			}

			framework::execute("
			UPDATE
				`session`
			SET
				". implode(",", $arrUpdate) ."
			WHERE
				session_id = '". $session["session_id"] ."'
			");
		}

	}

	echo json_encode(array("status" => "success"));

?>