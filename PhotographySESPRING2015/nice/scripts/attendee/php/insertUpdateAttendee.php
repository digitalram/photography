<?php
	$request = framework::getRequestVars();

	@$attendeeType = $request["type"];
	
	//to email the attendee
	$emailer = framework::includeModule('email');
	
	framework::includeScript("attendee", "js", "student");
	framework::includeScript("attendee", "js", "studentr");
	framework::includeScript("attendee", "js", "prefFilter");

	if(isset($_POST['firstName'])) {
		$Attendee = $_POST['attendee'];
		$Fname = $_POST['firstName'];
		$Lname = $_POST['lastName'];
		$Email = $_POST['email'];

		//IF user does not exists then insert ELSE update...
		$actionQuery = "SELECT * from users where email_address = '$Email' AND user_type = 'attendee'";
		$user = framework::getOne($actionQuery);
		if(empty($user))
		{
			$pass = substr(md5(microtime()), 0, 8);
			$md5pass = md5($pass);
			
			$query =   "INSERT INTO users (user_type, first_name, last_name, email_address, password)
						VALUES ('attendee','$Fname', '$Lname', '$Email', '$md5pass')";
			framework::execute($query);
		
			$query =   "INSERT INTO attendees (user_id, attendee_type, reviewer_id1, reviewer_id2, reviewer_id3, reviewer_id4, reviewer_id5, reviewer_id6, reviewer_id7, reviewer_id8, reviewer_id9, reviewer_id10, reviewer_id11, reviewer_id12, reviewer_id13, reviewer_id14, reviewer_id15, reviewer_id16, reviewer_id17, reviewer_id18, reviewer_id19, reviewer_id20)
						VALUES ((select user_id from users where email_address = '$Email'), '$Attendee'";	

			for ($i=1; $i<21; $i++)
			{
				if($preference = @$_POST['preference' . $i])
					$query = $query . ", '" . $preference . "'";
				else
					$query = $query . ", NULL";
			}
			$query = $query . ")";

			framework::execute($query);
			
			$queryAttendeeID = "Select attendee_id from attendees JOIN users ON attendees.user_id = users.user_id WHERE users.email_address = '$Email'";
			$attendeeID = framework::getOne($queryAttendeeID);
			$attendeeID = $attendeeID["attendee_id"];
			
			//email user/attendee
			$emailer->sendMailToAttendee($attendeeID, "new_password", array("password" => $pass));
		}
		else
		{
			$user = framework::getOne("select user_id from users WHERE user_type ='attendee' AND first_name = '$Fname' AND last_name = '$Lname' AND email_address = '$Email'");
			$userId = $user["user_id"];

			$query =   "UPDATE attendees 
						SET user_id = (select user_id from users where email_address = '$Email')";
			
			for ($i=1; $i<21; $i++)
			{
				if($preference = @$_POST['preference' . $i])
					$query = $query . ", reviewer_id" . $i . "='" . $preference . "'";
				else
					$query = $query . ", reviewer_id" . $i . "=" . "NULL";
			}
			$query = $query ." WHERE user_id = '$userID'";
			framework::execute($query);
		}
		
		framework::redirect("index.php?page=submission");

	}
?>