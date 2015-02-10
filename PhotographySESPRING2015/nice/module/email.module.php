<?php

	class email {

		public static $neededLib = "PHPMailer";
		public static $neededLibAL = "class.phpmailer.php";

		/** @var PHPMailer $mailer Essentially a placeholder/reference to the PHPMailer module. */
		protected $mailer = null;

		public function __construct($mailer) {

			$this->mailer = $mailer;
			$this->mailer->From = 'noreply@spenational.org';
			$this->mailer->FromName = 'SPE National';

		}

		/**
		 * Sends a mail, based on template name (via email_templates table) to a attendee's associated
		 * user via their e-mail address.
		 *
		 * @param string $attendeeId Attendee ID.
		 * @param string $templateName Template identifier.
		 * @param array $vars Custom variables.
		 *
		 * @return bool False if mail failed, True if successful.
		 */
		public function sendMailToAttendee($attendeeId, $templateName, $vars = array()) {

			$reviewer = framework::getOne("SELECT user_id FROM attendees WHERE attendee_id = '". $attendeeId ."'");

			return $this->sendMailToUser($reviewer["user_id"], $templateName, $vars);

		}

		/**
		 * Sends a mail, based on template name (via email_templates table) to a reviewer's associated
		 * user via their e-mail address.
		 *
		 * @param string $reviewerId Reviewer ID.
		 * @param string $templateName Template identifier.
		 * @param array $vars Custom variables.
		 *
		 * @return bool False if mail failed, True if successful.
		 */
		public function sendMailToReviewer($reviewerId, $templateName, $vars = array()) {

			$reviewer = framework::getOne("SELECT user_id FROM reviewers WHERE reviewer_id = '". $reviewerId ."'");

			return $this->sendMailToUser($reviewer["user_id"], $templateName, $vars);

		}

		/**
		 * @param string|array $emailAddress Array of e-mail addresses, or a single e-mail (string).
		 * @param string $subject Email subject.
		 * @param string $message Email body.
		 *
		 * @return bool TRUE if email sent; FALSE if not.
		 */
		public function sendCustomEmail($emailAddress, $subject, $message) {

			$mailer = $this->mailer;

			// array of emails
			if(is_array($emailAddress)) {
				foreach($emailAddress as $_email) {
					$mailer->addAddress($_email);
				}
			} else {
				// string
				$mailer->addAddress($emailAddress);
			}

			$mailer->Subject = $subject;
			$mailer->Body = $message;

			return $mailer->send();

		}

		/**
		 * Sends a mail, based on template name (via email_templates table) to a user via their e-mail address.
		 *
		 * @param string $userId User ID.
		 * @param string $templateName Template identifier.
		 * @param array $vars Custom variables.
		 * @return bool False if mail failed, True if successful.
		 */
		public function sendMailToUser($userId, $templateName, $vars = array()) {

			$user = framework::getOne("SELECT first_name, last_name, email_address FROM users WHERE user_id = '". $userId ."'");
			$template = framework::getOne("SELECT * FROM email_templates WHERE identifier = '". $templateName ."'");

			$mailer = $this->mailer;

			$mailer->addAddress($user["email_address"], $user["first_name"] . " " . $user["last_name"]);
			$mailer->Subject = $template["subject"];
			$mailer->Body = $this->parseBody($user, $template["message"], $vars);

			// confirmation code depiction
			if($template["use_confirmation_code"] == 'yes') {
				$code = substr(md5(microtime()), 0, 5);

				$mailer->Body = $mailer->Body . "\n\n" .
					"Your confirmation code: <b>" . $code . "</b>";

				// determine expiry datetime
				$dtExpire = new \DateTime();
				$dtInt = new \DateInterval("PT". $template["confirm_expire"] ."M");
				$dtExpire->add($dtInt);

				// insert
				framework::execute("
				INSERT INTO
					confirmation_codes (user_id, code, expire_date)
				VALUES
					('". $userId ."', '". $code ."', '". $dtExpire->format("Y-m-d H:i:s") ."')
				");
			}

			// send mail
			return $mailer->send();

		}

		/**
		 * Parses the 'message' of an email_template model.
		 *
		 * @param array $userModel An array of user information.
		 * @param string $body Unparsed message of an email_template model.
		 * @param array $vars Custom variables.
		 * @return string $result Parsed message.
		 */
		public function parseBody($userModel, $body, $vars = array()) {

			$parseArray = array();

			// http/https
			$protocol = "http://";

			if(!empty($_SERVER["HTTPS"]) || $_SERVER["SERVER_PORT"] == '433') {
				$protocol = "https://";
			}

			// custom vars
			foreach($vars as $key => $var) {
				$parseArray["{". $key ."}"] = $var;
			}

			// user
			$parseArray["{user.first_name}"]		= $userModel["first_name"];
			$parseArray["{user.last_name}"]			= $userModel["last_name"];
			$parseArray["{user.full_name}"]			= $userModel["first_name"] . " " . $userModel["last_name"];
			$parseArray["{user.formal_full_name}"]	= $userModel["last_name"] . ", " . $userModel["first_name"];
			$parseArray["{user.email_address}"]		= $userModel["email_address"];

			// basics
			$attendeeStudentReg = "/index.php?page=attendeeRegistration&type=student";
			$attendeeProfReg = "/index.php?page=attendeeRegistration&type=professional";

			// web
			$parseArray["{web.webroot}"]								= $protocol . $_SERVER["HTTP_HOST"];
			$parseArray["{attendee.student.registration_page}"]			= $protocol . $_SERVER["HTTP_HOST"] . $attendeeStudentReg;
			$parseArray["{attendee.professional.registration_page}"]	= $protocol . $_SERVER["HTTP_HOST"] . $attendeeProfReg;

			return str_replace(array_keys($parseArray), $parseArray, $body);

		}

	}

?>