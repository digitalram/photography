<?php

	/**
	 * Essentially everything SPE-related goes here.
	 */
	class app {

		public static $daySlots = array();

		/**
		 * Initialize app.
		 * 
		 * @return void
		 */ 
		public static function initialize() {
			self::$daySlots = array(
				'F1' => 'friday_morning',
				'F2' => 'friday_midday',
				'F3' => 'friday_afternoon',
				'S1' => 'saturday_morning',
				'S2' => 'saturday_midday',
				'S3' => 'saturday_afternoon'
			);
		}

		/**
		 * Check to see if registration is open via registration.flag file.
		 *
		 * @return bool
		 */
		public static function isRegistrationOpen() {
			$fp = @fopen(__DIR__ . "/registration.flag", "a+");

			@$flag = fread($fp, 1);

			@fclose($fp);

			if($flag == "y") {
				return true;
			}

			return false;
		}

		public static function openRegistration() {
			$fp = @fopen(__DIR__ . "/registration.flag", "w+");

			fwrite($fp, "y");

			fclose($fp);
		}

		public static function closeRegistration() {
			$fp = @fopen("registration.flag", "w+");

			fwrite($fp, "n");

			fclose($fp);
		}

		public static function getCurrentRegistrationPeriod() {

			return framework::getOne("
			SELECT
				*
			FROM
				registration_periods
			WHERE
				year = '". date("Y") ."'
			");

		}

		/**
		 * Return number of attendees for a registration period.
		 *
		 * @param string $registrationPeriodId
		 * @param string $type
		 *
		 * @return int Number of attendees total.
		 */
		public static function getTotalAttendees($registrationPeriodId, $type = "all") {

			$typeSql = "";

			if($type != "all") {
				$typeSql = "
				WHERE
					a.attendee_type = '". $type ."'
				";
			}


			$count = framework::getOne("
			SELECT
				COUNT(*) AS count
			FROM
				attendees AS a

			JOIN session AS s
			ON (
				(
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
				AND
				registration_period_id = '". $registrationPeriodId ."'
			)

			". $typeSql ."
			");

			return $count["count"];

		}

		/**
		 * Return number of reviewers for a registration period.
		 *
		 * @param string $registrationPeriodId
		 * @param string $type
		 *
		 * @return int
		 */
		public static function getTotalReviewers($registrationPeriodId, $type = "all") {

			$typeSql = "";

			if($type != "all") {
				$typeSql = "r.reviewer_type = '". $type ."' AND";
			}

			$count = framework::getOne("
			SELECT
				COUNT(*) AS count
			FROM
				session AS s

			JOIN reviewers AS r
			ON (
				". $typeSql ."
				r.reviewer_id = s.reviewer_id
			)

			WHERE
				s.registration_period_id = '". $registrationPeriodId ."'
			");

			return $count["count"];

		}

		/**
		 * Interpret code (i.e. F1, S2, etc.) to a readable time.
		 *
		 * @param $code
		 * @return array
		 */
		public static function scheduleTime($code) {

			$ret = array(
				"start" => "",
				"end"	=> "",
				"day"	=> ""
			);

			// ensure our code is correct
			if(strlen($code) != 2) {
				return array();
			}

			$dayCode = $code[0];
			$timeCode = $code[1];

			// determine day
			switch($dayCode) {
				case "F":
					$ret["day"] = "Friday";
					break;

				case "S":
					$ret["day"] = "Saturday";
					break;
			}

			// determine time
			switch($timeCode) {
				case "1":

					break;

				case "2":

					break;

				case "3":

					break;
			}

		}
		
		/**
		 * Create the schedule.
		 * 
		 * @param string $type Reviewer and attendee type; e.g. "student" and "professional".
		 * @param string|int $registrationPeriodId Registration period corresponding ID.
		 * @param bool $enforceChoices TRUE if yes, FALSE if no.
		 * 
		 * @return string|bool String implies failure. FALSE = unknown failure (not used). TRUE = success.
		 */ 
		public static function createSchedule($type, $registrationPeriodId, $enforceChoices = true) {

			// todo: implement keyword

			// determine day from type
			$day = "friday";
			
			if($type == "professional") {
				$day = "saturday";
			}

			$attendees = framework::getMany("
			SELECT
				a.*,
				(
				SELECT
					COUNT(*)
				FROM
					`session` AS s
				WHERE
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
				) AS num_counts
			FROM
				attendees AS a
			WHERE
				a.attendee_type = '". $type ."'
			");
			
			$reviewers = framework::getMany("
			SELECT
				*
			FROM
				reviewers AS r
			WHERE
				r.reviewer_type = '". $type ."'
			");
			
			// registration period
			$registrationPeriod = framework::getOne("
			SELECT
				*
			FROM
				registration_periods AS r
			WHERE
				r.registration_period_id = '". $registrationPeriodId ."'
			");

			// get last table
			$lastTableNumber = framework::getOne("
			SELECT
				table_num
			FROM
				`session` AS s

			WHERE
				SUBSTR(s.day_slot, 1, 1) = '". strtoupper(substr($day, 0, 1)) ."'
				AND
				s.registration_period_id = '". $registrationPeriodId ."'

			ORDER BY
				table_num DESC

			LIMIT 1
			");
			
			$tableNumber = 1;

			if(!empty($lastTableNumber)) {
				$tableNumber = $lastTableNumber["table_num"] + 1;
			}

			$maxTables = $registrationPeriod["max_tables"];

			$attendeeIndex 	= 0;
			$toInsert 		= array();
			$attendeeCache	= array();

			// loop through attendees
			foreach($reviewers as $_reviewerKey => $reviewer) {

				if($tableNumber > $maxTables) {
					break;
				}

				// loop through reviewers
				foreach($attendees as $_attendeeKey => $attendee) {

					$attendeeId = $attendee["attendee_id"];

					if(!isset($attendeeCache[$attendeeId])) {
						$attendeeCache[$attendeeId] = $attendee["num_counts"];
					}

					if($attendeeCache[$attendeeId] > 2) {
						break 1;
					}

					// go through the attendee's 20 choices of reviewers
					for($i = 1; $i <= 20; $i++) {

						// has this attendee checked this reviewer; if not, do we want to be strict about it?
						if($reviewer["reviewer_id"] == $attendee["reviewer_id" . $i] || !$enforceChoices ) {

							// grab timeSlot (i.e. 'F1', 'F2', 'S3', etc.) from reviewer_id if that reviewer isn't filled, yet.
							if(($timeSlot = self::reviewerFilled($reviewer["reviewer_id"], $day, $registrationPeriodId)) !== true) {

								$attendeeCache[$attendeeId]++;

								if(isset($toInsert[$attendeeIndex])) {
									if(count($toInsert[$attendeeIndex]["attendees"]) > 5) {
										$attendeeIndex++;
										$tableNumber++;
										continue 3;
									}

									$toInsert[$attendeeIndex]["attendees"][] = $attendee["attendee_id"];

								} else {
									$toInsert[$attendeeIndex] = array(
										"reviewer_id" => $reviewer["reviewer_id"],
										"day_slot" => array_search($timeSlot, self::$daySlots),
										"attendees" => array(
											$attendee["attendee_id"]
										),
										"table_number" => $tableNumber
									);

								}

								// unset this attendee since they're now in the queue to be inserted
								unset($attendees[$_attendeeKey]);

								// we're done inserting attendees; break out
								continue 2;


							}
						}
					}
				}

			}

			// now, we insert them
			foreach($toInsert as $session) {

				$arrAttendees = array();

				// get attendees
				for($i = 0; $i < 6; $i++) {
					$arrAttendees[$i] = 'NULL';

					if(isset($session["attendees"][$i])) {
						$arrAttendees[$i] = "'".$session["attendees"][$i]."'";
					}
				}

				$sql = "INSERT INTO
					`session`
				(reviewer_id, registration_period_id, day_slot, table_num, attendee_id1, attendee_id2, attendee_id3, attendee_id4, attendee_id5, attendee_id6)
				VALUES
				('". $session["reviewer_id"] ."', '". $registrationPeriodId ."', '". $session["day_slot"] ."', '". $session["table_number"] ."', ". implode(",", $arrAttendees) .")";

				// insert
				framework::execute($sql);

			}

			// check for maximum table numbers
			if($tableNumber > $registrationPeriod["max_tables"]) {
				return "[1] [Schedule Creation] The maximum number of tables for ". ucwords($day) ." has been reached.";
			}

			// go through to check attendees that aren't on the schedule
			$unassignedAttendees = framework::getMany("
			SELECT
				a.*
			FROM
				attendees AS a

			LEFT JOIN `session` AS s
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

			WHERE
				a.attendee_type = '". $type ."'
				AND
				s.session_id IS NULL
			");

			$unassignedReviewers = framework::getMany("
			SELECT
				r.*
			FROM
				reviewers AS r

			LEFT JOIN `session` AS s
			ON (
				r.reviewer_id = s.reviewer_id
			)

			WHERE
				r.reviewer_type = '". $type. "'
				AND
				s.session_id IS NULL
			");

			$lastAttendees = array();

			foreach($unassignedReviewers as $key => $reviewer) {
				if(empty($unassignedAttendees)) {
					// can't continue
					break;
				}

				if($tableNumber > $maxTables) {
					return "[2] [Schedule Creation] The maximum number of tables (". $maxTables .") for ". ucwords($day) ." has been reached.";
				}

				$arrAttendees = array();

				if(empty($lastAttendees)) {
					for($i = 1; $i <= 6; $i++) {
						$arrAttendees[$i] = 'NULL';

						if(count($unassignedAttendees) > 0) {
							$attendee = array_pop($unassignedAttendees);
							$arrAttendees[$i] = "'".$attendee["attendee_id"]."'";
						} else {
							break;
						}
					}
				} else {
					$arrAttendees = $lastAttendees;
				}

				$timeSlot = self::reviewerFilled($reviewer["reviewer_id"], $day, $registrationPeriodId);

				// skip this reviewer, but keep the attendees for the next one
				if($timeSlot === true) {
					$lastAttendees = $arrAttendees;
					continue;
				} else {
					$lastAttendees = array();
				}

				$sql = "INSERT INTO
					`session`
				(reviewer_id, registration_period_id, day_slot, table_num, attendee_id1, attendee_id2, attendee_id3, attendee_id4, attendee_id5, attendee_id6)
				VALUES
				('". $reviewer["reviewer_id"] ."', '". $registrationPeriodId ."', '". array_search($timeSlot, self::$daySlots) ."', '". $tableNumber ."', ". implode(",", $arrAttendees) .")";

				framework::execute($sql);

				$tableNumber++;

				unset($unassignedReviewers[$key]);

			}

			if(count($unassignedReviewers)) {
				if(count($unassignedAttendees)) {
					return self::createSchedule($type, $registrationPeriodId, false);
				}
			}

			return true;
			
		}

		/**
		 * Essentially checks to see if a reviewer or attendee have a 'keyword' or 'opportunity' in common.
		 *
		 * @param $reviewerId
		 * @param $attendeeId
		 *
		 * @return bool TRUE if yes; FALSE if no.
		 */
		public static function areInCommon($reviewerId, $attendeeId) {

			// todo: make these queries a join... too tired/lazy atm

			// check keywords/genres
			$reviewerKeywords = framework::getMany("
			SELECT
				*
			FROM
				keyword
			WHERE
				reviewer_id = '". $reviewerId ."'
			");

			$attendeeKeywords = framework::getMany("
			SELECT
				*
			FROM
				keyword
			WHERE
				attendee_id = '". $attendeeId ."'
			");

			if(count($reviewerKeywords) == 0 || count($attendeeKeywords) == 0) {
				return false;
			}

			foreach($reviewerKeywords as $reviewerKeyword) {
				foreach($attendeeKeywords as $attendeeKeyword) {
					if($reviewerKeyword["keyword_definition_id"] == $attendeeKeyword["keyword_definition_id"]) {
						return true;
					}
				}
			}

			// check opportunities
			// fixme: nvm... opportunities aren't used w/ attendees.


			return false;

		}
		
		/**
		 * Checks to see if a reviewer's schedule is filled up to a corresponding registration period and day. For
		 * example, on Saturday and she/he has morning and midday checked (saturday_midday|morning), it will check
		 * for those days being in session for the registration period.
		 * 
		 * @param string|int $reviewerId Reviewer's corresponding ID via reviewers table.
		 * @param string $day "friday" or "saturday"
		 * @param string|int $registrationPeriodId Registration period's corresponding ID.
		 * 
		 * @return bool|(int|string) FALSE if reviewer is filled; returns code (i.e. 'F1', 'S2') for
		 * corresponding day_slots if not filled.
		 */ 
		public static function reviewerFilled($reviewerId, $day, $registrationPeriodId) {
			
			// ref
			$daySlots = array_flip(self::$daySlots);
			$checkDays = array();
			
			// grab the reviewer
			$reviewer = framework::getOne("
			SELECT
				*
			FROM
				reviewers AS r
			WHERE
				r.reviewer_id = '". $reviewerId ."'
			");

			// check to see what days are available
			foreach($reviewer as $column => $value) {
				if(count($checkDays) > 2) {
					break;
				}
				
				foreach($daySlots as $_day => $slot) {
					if($column == $_day && $value == 'x') {
						$checkDays[] = $_day;
					}
				}
			}
			
			// if the reviewer for some reason doesn't have any
			// days selected... for some reason
			// TODO: email admin???
			if(count($checkDays) < 1) {
				return true;
			}
			
			// query the session table
			$sessions = framework::getMany("
			SELECT
				*
			FROM
				session AS s
			WHERE
				s.reviewer_id = '". $reviewerId ."'
				AND
				day_slot IN ('". implode("','", $checkDays) ."')
			");
		
			// check
			if(count($sessions) == count($checkDays)) {
				return true;
			}
			
			return $checkDays[array_rand($checkDays)];
			
		}

	};

?>
