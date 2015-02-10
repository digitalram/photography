<?php

	require_once "../bootstrap.php";

	/**
	 * We don't want them to execute this if they're using the software while it's live. This file is particularly
	 * for developers only. If you haven't worked on this project or are not currently working on it, it's advised
	 * that you do not touch this file.
	 */

	if(!isset($_POST["passwd"])) {

		?>

		<html>
		<form method="post">
			Enter password (Developers Only): <input type="password" name="passwd" />
		</form>
		</html>

		<?php

	} else {

		$request = framework::getRequestVars();
		$passwd = $request["passwd"];

		if($passwd != "suchdoge.w0w") {
			die("Incorrect password");
		}

		// generate data

		// first names
		$arrFirstNames = array(
			"Keith",
			"Adam",
			"Josh",
			"Jean Luc",
			"Greg",
			"Robert",
			"Billy",
			"Walter",
			"William",
			"Mario",
			"Luigi",
			"Cory",
			"Brian",
			"Peter",
			"Cole",
			"Gage",
			"Joe"
		);

		// last names
		$arrLastNames = array(
			"Smith",
			"Mario",
			"Smithers",
			"Parker",
			"Black",
			"White",
			"House",
			"Picard",
			"Riker",
			"Moore",
			"Pickett",
			"Shaw",
			"Tuckett",
			"Tucker",
			"Gates"
		);

		// reviewer/attendee types
		$arrTypes = array(
			"student",
			"professional"
		);

		// user types
		$arrUserTypes = array(
			"attendee",
			"reviewer"
		);

		// insert basics
		foreach($arrFirstNames as $firstName) {
			foreach($arrLastNames as $lastName) {
				foreach($arrUserTypes as $userType) {
					foreach($arrTypes as $type) {

						//if($maxReviewers[$userType] == 0 || $$userType < $maxReviewers[$userType]) {
							// email address
							$userStr	= strtolower(str_replace(" ", "", $firstName) . "." . $lastName . "." . $userType . "." . $type);
							$email_addr	= $userStr . "@mail.com";

							// passwd
							$passwd = md5($userStr);

							framework::debug("Creating user '". $firstName ." ". $lastName ." (Email: ". $email_addr .").");

							// insert user
							$userId = framework::execute("
									INSERT INTO
										users
									(user_type, first_name, last_name, email_address, password)
									VALUES
									('". $userType ."', '". ucwords($type) ." ". $firstName ."', '". $lastName ."', '". $email_addr ."', '". $passwd ."')
								", false, true);



							framework::debug("Creating ". $userType ." for '". $firstName ." ". $lastName ."'.");

							// insert associated usertype
							framework::execute("
								INSERT INTO
									". $userType ."s
									(user_id, ". $userType ."_type)
								VALUES
									('". $userId ."', '". $type ."')
							");

							//$$userType++;
						//}

					}
				}
			}
		}

		// 1) get all attendees and select reviewers for them
		// 2) select days for reviewers
		// keep in mind: student reviewers for student attendees
		// keep in mind: professional reviewers for professional attendees
		foreach($arrTypes as $type) {
			$attendees = framework::getMany("
			SELECT
				*
			FROM
				attendees
			WHERE
				attendee_type = '". $type ."'
			");

			$reviewers = framework::getMany("
			SELECT
				*
			FROM
				reviewers
			WHERE
				reviewer_type = '". $type ."'
			");

			$days = array();

			// depict days to select for reviewers
			switch($type) {
				case "professional":
					$days[] = "saturday_morning";
					$days[] = "saturday_midday";
					$days[] = "saturday_afternoon";
					break;

				case "student":
					$days[] = "friday_morning";
					$days[] = "friday_midday";
					$days[] = "friday_afternoon";
					break;
			}

			// choose days for reviewers
			foreach($reviewers as $reviewer) {
				$arrUpdate = array();

				// simulate "reality" - some reviewers may not be available for all times
				foreach($days as $day) {
					$isChecked = (bool)rand(0, 1);
					$arrUpdate[] = $day . " = " . (($isChecked) ? "'x'" : "NULL");
				}

				// update reviewer
				framework::execute("
				UPDATE
					reviewers
				SET
					". implode(",", $arrUpdate) ."
				WHERE
					reviewer_id = '". $reviewer["reviewer_id"] ."'
				", false, true);
			}

			// update attendee choices
			foreach($attendees as $attendee) {
				$numChoices = rand(1, 20);
				$numReviewers = count($reviewers);
				$arrChoices = array();

				for($i = 1; $i <= $numChoices; $i++) {
					$reviewer = $reviewers[array_rand($reviewers)];
					$arrChoices[] = "reviewer_id" . $i . " = '". $reviewer["reviewer_id"] ."'";
				}

				// update attendee
				framework::execute("
				UPDATE
					attendees
				SET
					". implode(",", $arrChoices) ."
				WHERE
					attendee_id = '". $attendee["attendee_id"] ."'
				", false, true);
			}

		}


	}

?>