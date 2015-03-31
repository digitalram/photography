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
			//password_reset needs to change to something else
			$emailer->sendMailToReviewer($reviewerID, "password_reset", array("password" => $pass));
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
						$query = $query . " WHERE user_id = '$userId'";
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

		//insert the keyword information
		$actionQuery = "SELECT user_id from users where email_address = '$Email' AND user_type = 'reviewer'";
		//we will use the user id to insert and remove from our genres and opportunity tables.
		$q = framework::getOne($actionQuery);
		$user_ID = $q['user_id'];
		//if the user is already in here we should remove them from the genres and opportunity tables becase
		//	we are going to re insert them.
		$remove = "delete from reviewer_genre where user_id = $user_ID";
		framework::execute($remove);
		$remove = "delete from reviewer_opps where user_id = $user_ID";
		framework::execute($remove);

		//$_POST['keyword'] holds an array of our genres selected by our reviewer
		//die($q['user_id']);
		$keywords = $_POST['keyword'];
		//gets last element of array to compare so we can format our query
		$last_key = end($keywords);

		$query = "Insert into reviewer_genre (user_id, keyword_id) values";
		foreach($keywords as $key ){
			//checks if last element in array so we can format query
			if($key == $last_key){
				$query .= "($user_ID, '$key');";
			}
			else{
				$query .= "($user_ID, '$key'),";
			}
		}
		framework::execute($query);

		//this code is the same as above just with opporutnities
		$opps = $_POST['opportunity'];
		$last_key = end($opps);
		$query = "Insert into reviewer_opps (user_id, opp_id) values";
		foreach($opps as $key ){
			//checks if last element in array so we can format query
			if($key == $last_key){
				$query .= "($user_ID, '$key');";
			}
			else{
				$query .= "($user_ID, '$key'),";
			}
		}		
		framework::execute($query);


		framework::redirect("index.php?page=submission");
	}
    
?>