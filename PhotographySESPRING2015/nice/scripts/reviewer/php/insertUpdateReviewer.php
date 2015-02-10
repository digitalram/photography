<?php
	
	$emailer = framework::includeModule('email');
		
	if(isset($_POST['firstName']))
	{
		$Fname = $_POST['firstName'];
		$Lname = $_POST['lastName'];
		$Email = $_POST['email'];
		$Bio = $_POST['bio'];
		
		$actionQuery = "SELECT * from users where email_address = '$Email' AND user_type = 'reviewer'";
		$q = framework::getOne($actionQuery);
		if(empty($q))
		{
			$pass = substr(md5(microtime()), 0, 8);
			$md5pass = md5($pass);
			
			$query =   "INSERT INTO users (user_type, first_name, last_name, email_address, password, bio)
						VALUES ('reviewer','$Fname', '$Lname', '$Email', '$md5pass', '$Bio')";
			framework::execute($query);
			
			$query =   "INSERT INTO reviewers (user_id, friday_morning, friday_midday, friday_afternoon, saturday_morning, saturday_midday, saturday_afternoon)
						VALUES ((select user_id from users where email_address = '$Email')";

			//set time slot information from post data
			if(!empty($_POST['timeSlot'])) 
			{
				if(isset($_POST['timeSlot']['friday_morning']))
				{
					$query = $query . ", 'x'";
				}
				else
				{
					$query = $query . ", NULL";
				}
				
				if(isset($_POST['timeSlot']['friday_midday']))
				{
					$query = $query . ", 'x'";
				}
				else
				{
					$query = $query . ", NULL";
				}
				
				if(isset($_POST['timeSlot']['friday_afternoon']))
				{
					$query = $query . ", 'x'";
				}
				else
				{
					$query = $query . ", NULL";
				}
				if(isset($_POST['timeSlot']['saturday_morning']))
				{
					$query = $query . ", 'x'";
				}
				else
				{
					$query = $query . ", NULL";
				}
				
				if(isset($_POST['timeSlot']['saturday_midday']))
				{
					$query = $query . ", 'x'";
				}
				else
				{
					$query = $query . ", NULL";
				}
				
				if(isset($_POST['timeSlot']['saturday_afternoon']))
				{
					$query = $query . ", 'x'";
				}
				else
				{
					$query = $query . ", NULL";
				}
			}
			$query = $query . ")";
			framework::execute($query);
			
			$queryReviewerID = "Select reviewer_id from reviewers JOIN users ON reviewers.user_id = users.user_id WHERE users.email_address = '$Email'";
			$reviewerID = framework::getOne($queryReviewerID);
			$reviewerID = $reviewerID["reviewer_id"];
			
			//email user/reviewer
			$emailer->sendMailToReviewer($reviewerID, "new_password", array("password" => $pass));
		}
		else
		{
			$user = framework::getOne("select user_id from users WHERE user_type ='reviewer' AND first_name = '$Fname' AND last_name = '$Lname' AND email_address = '$Email'");
			$userId = $user["user_id"];

			$query =   "UPDATE reviewers 
						SET user_id = '". $userId ."'";
						if(!empty($_POST['timeSlot'])) 
						{
							if(isset($_POST['timeSlot']['friday_morning']))
							{
								$query = $query . ", friday_morning = 'x'";
							}
							else
							{
								$query = $query . ", friday_morning = NULL";
							}
							
							if(isset($_POST['timeSlot']['friday_midday']))
							{
								$query = $query . ", friday_midday = 'x'";
							}
							else
							{
								$query = $query . ", friday_midday = NULL";
							}
							
							if(isset($_POST['timeSlot']['friday_afternoon']))
							{
								$query = $query . ", friday_afternoon = 'x'";
							}
							else
							{
								$query = $query . ", friday_afternoon = NULL";
							}
							if(isset($_POST['timeSlot']['saturday_morning']))
							{
								$query = $query . ", saturday_morning = 'x'";
							}
							else
							{
								$query = $query . ", saturday_morning = NULL";
							}
							
							if(isset($_POST['timeSlot']['saturday_midday']))
							{
								$query = $query . ", saturday_midday = 'x'";
							}
							else
							{
								$query = $query . ", saturday_midday = NULL";
							}
							
							if(isset($_POST['timeSlot']['saturday_afternoon']))
							{
								$query = $query . ", saturday_afternoon = 'x'";
							}
							else
							{
								$query = $query . ", saturday_afternoon = NULL";
							}
						}
						$query = $query . " WHERE user_id = '$userID'";
						framework::execute($query);
			
			//set time slot information from post data
			if(isset($_POST['timeSlot'])) 
			{
				if(isset($_POST['timeSlot']['friday_morning']))
				{
					$query = $query . ", friday_morning = 'x'";
				}
				else
				{
					$query = $query . ", friday_morning = NULL";
				}
				
				if(isset($_POST['timeSlot']['friday_midday']))
				{
					$query = $query . ", friday_midday = 'x'";
				}
				else
				{
					$query = $query . ", friday_midday = NULL";
				}
				
				if(isset($_POST['timeSlot']['friday_afternoon']))
				{
					$query = $query . ", friday_afternoon = 'x'";
				}
				else
				{
					$query = $query . ", friday_afternoon = NULL";
				}
				if(isset($_POST['timeSlot']['saturday_morning']))
				{
					$query = $query . ", saturday_morning = 'x'";
				}
				else
				{
					$query = $query . ", saturday_morning = NULL";
				}
				
				if(isset($_POST['timeSlot']['saturday_midday']))
				{
					$query = $query . ", saturday_midday = 'x'";
				}
				else
				{
					$query = $query . ", saturday_midday = NULL";
				}
				
				if(isset($_POST['timeSlot']['saturday_afternoon']))
				{
					$query = $query . ", saturday_afternoon = 'x'";
				}
				else
				{
					$query = $query . ", saturday_afternoon = NULL";
				}
			}
			framework::execute($query);
		}
		framework::redirect("index.php?page=submission");
	}
    
?>