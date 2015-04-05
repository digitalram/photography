<?php

require_once "bootstrap.php";
require_once "framework.php";
/* Table and Attendee classes defined here: */
require_once "includes/schedule.php";

class Scheduler
{
	/**
	 * Clear a schedule from the sessions table
	 *
	 * @param int $registrationPeriodId - clears all session entries with this ID
	 *							        - if NULL, then clear ALL entries.
	 * @return void 
	 */
	public static function ClearSchedule( $registrationPeriodId )
	{
		/* Need to set Schedule Created flag to 'NO' */
		if( $registrationPeriodId === NULL ){
			$sql = "UPDATE registration_periods SET schedule_created = 2 WHERE 1";
		}
		else {
			$sql = "UPDATE registration_periods SET schedule_created = 2 WHERE registration_period_id = '".$registrationPeriodId."'";
		}
		framework::execute($sql);
	
		/* Now Delete Session rows pertaining to this schedule */
		if( $registrationPeriodId === NULL ){
			$sql = "DELETE FROM session WHERE 1";
		}
		else {
			$sql = "DELETE FROM session WHERE registration_period_id = '".$registrationPeriodId."'";
		}
		framework::execute($sql);
	}

	/**
	 * Create Session Tables for intelligent assignment of reviewers
	 * Goal: Use minimum amount of tables and allow reviewers to keep their tables in back-to-back sessions
	 *
	 * @param string $sessionDay - "Friday" or "Saturday" string expected, though only "Friday" is explicitly tested
	 *
	 * @return array $Tables - an array of initialized Table objects (see class above)
	 */
	protected static function MakeTables( $sessionDay )
	{
		$Session1 = array();	//$F1 = array();
		$Session2 = array();	//$F2 = array();
		$Session3 = array();	//$F3 = array();
				
		/* Populate 1st session reviewers */
		if( $sessionDay === "Friday" ){
			$sql = "SELECT reviewer_id FROM reviewers WHERE friday_morning = 'x'";
		}
		else{ 	/* Saturday */
			$sql = "SELECT reviewer_id FROM reviewers WHERE saturday_morning = 'x'";
		}
	
		$data = framework::getMany($sql);
		foreach( $data as $d ){
			array_push($Session1, intval($d['reviewer_id']));
		}

		/* Populate 2nd session reviewers */
		if( $sessionDay === "Friday" ){
			$sql = "SELECT reviewer_id FROM reviewers WHERE friday_midday = 'x'";
		}
		else{ 	/* Saturday */
			$sql = "SELECT reviewer_id FROM reviewers WHERE saturday_midday = 'x'";
		}
		
		$data = framework::getMany($sql);
		foreach( $data as $d ){
			array_push($Session2, intval($d['reviewer_id']));
		}

		/* Populate 2nd session reviewers */
		if( $sessionDay === "Friday" ){
			$sql = "SELECT reviewer_id FROM reviewers WHERE friday_afternoon = 'x'";
		}
		else{ 	/* Saturday */
			$sql = "SELECT reviewer_id FROM reviewers WHERE saturday_afternoon = 'x'";
		}
		
		$data = framework::getMany($sql);
		foreach( $data as $d ){
			array_push($Session3, intval($d['reviewer_id']));
		}
		
		/* Create list of reviewers who will be in all 3 review periods */
		$Session123 = array(); 	//$F123 = array();
		foreach( $Session1 as $r ){
			if (in_array($r, $Session2) and in_array($r, $Session3)){
				array_push($Session123, $r);
			}
		}
		
		foreach( $Session123 as $r ){
			// Remove Reviewer from Session1 list
			$key = array_search($r, $Session1);
			if($key !== false){
				unset($Session1[$key]);
			}
			// Remove Reviewer from Session2 list
			$key = array_search($r, $Session2);
			if($key !== false){
				unset($Session2[$key]);
			}
			// Remove Reviewer from Session3 list
			$key = array_search($r, $Session3);
			if($key !== false){
				unset($Session3[$key]);
			}
		}
		
		/* Create list of reviewers who will be in sessions 1 AND 2 */
		$Session12 = array();
		foreach( $Session1 as $r ){
			if( in_array($r, $Session2) ){
				array_push($Session12, $r);
			}
		}

		foreach( $Session12 as $r ){
			// Remove Reviewer from Session1 list
			$key = array_search($r, $Session1);
			if($key !== false){
				unset($Session1[$key]);
			}
			// Remove Reviewer from Session2 list
			$key = array_search($r, $Session2);
			if($key !== false){
				unset($Session2[$key]);
			}
		}
		
		/* Create list of reviewers who will be in session 2 and 3 */
		$Session23 = array();
		foreach( $Session2 as $r ){
			if( in_array($r, $Session3) ){
				array_push($Session23, $r);
			}
		}

		foreach( $Session23 as $r ){
			// Remove Reviewer from F1 list
			$key = array_search($r, $Session2);
			if($key !== false){
				unset($Session2[$key]);
			}
			// Remove Reviewer from F2 list
			$key = array_search($r, $Session3);
			if($key !== false){
				unset($Session3[$key]);
			}
		}
		
		/* Prepare a list to hold Table objects */
		$Tables = array();
		$table_number = 1;
		if( $sessionDay === "Friday" ){
			$slot1 = "F1";
			$slot2 = "F2";
			$slot3 = "F3";
		}
		else{ /*Saturday*/
			$slot1 = "S1";
			$slot2 = "S2";
			$slot3 = "S3";		
		}
		
		/* First create tables for reviewers attending all three sessions */
		foreach( $Session123 as $r ){
			array_push($Tables, new Table($table_number, $slot1, $r));
			array_push($Tables, new Table($table_number, $slot2, $r));
			array_push($Tables, new Table($table_number, $slot3, $r));
			$table_number += 1;	
		}
		
		/* Second, create tables for reviewers in 1+2, and add Session3 at end if available */
		foreach( $Session12 as $r ){
			array_push($Tables, new Table($table_number, $slot1, $r));
			array_push($Tables, new Table($table_number, $slot2, $r));
			if( count($Session3) > 0 ){
				array_push($Tables, new Table($table_number, $slot3, array_pop($Session3)));
			}	
			$table_number += 1;
		}
		
		/* Next, create tables for reviewers in 2+3, and add Session1 at beginning if available */
		foreach( $Session23 as $r ){
			if( count($Session1) > 0 ){
				array_push($Tables, new Table($table_number, $slot1, array_pop($Session1)));
			}
			array_push($Tables, new Table($table_number, $slot2, $r));
			array_push($Tables, new Table($table_number, $slot3, $r));
			$table_number += 1;
		}
		
		/* Finally, fill remaining tables as efficiently as possible */
		if( (count($Session1) >= count($Session2)) and (count($Session1) >= count($Session3)) ){
			foreach( $Session1 as $r ){
				array_push($Tables, new Table($table_number, $slot1, $r));
				if( count($Session2) > 0 ){
					array_push($Tables, new Table($table_number, $slot2, array_pop($Session2)));
				}
				if( count($Session3) > 0 ){
					array_push($Tables, new Table($table_number, $slot3, array_pop($Session3)));
				}
				$table_number += 1;
			}
		}
		else if( (count($Session2) >= count($Session1)) and (count($Session2) >= count($Session3)) ){
			foreach( $Session2 as $r ){
				if( count($Session1) > 0 ){
					array_push($Tables, new Table($table_number, $slot1, array_pop($Session1)));
				}
				array_push($Tables, new Table($table_number, $slot2, $r));
				if( count($Session3) > 0 ){
					array_push($Tables, new Table($table_number, $slot3, array_pop($Session3)));
				}
				$table_number += 1;
			}		
		}
		else{
			foreach( $Session3 as $r ){
				if( count($Session1) > 0 ){
					array_push($Tables, new Table($table_number, $slot1, array_pop($Session1)));
				}
				if( count($Session2) > 0 ){
					array_push($Tables, new Table($table_number, $slot2, array_pop($Session2)));
				}
				array_push($Tables, new Table($table_number, $slot3, $r));
				$table_number += 1;
			}	
		}
	
		return $Tables;	
	}

	/**
	 * Create Attendees array listing Attendee ID and selected reviewers
	 *
	 * @param string $sessionDay - "Friday" or "Saturday" string expected, though only "Friday" is explicitly tested
	 *
	 * @return array $Attendees - an array of initialized Attendee objects (see class above)
	 */
	protected static function MakeAttendees( $sessionDay )
	{
		/* We will use the Attendee Class provided above */
		$Attendees = array();
		$aID = array(); 	// store array of attendees id

		if( $sessionDay === "Friday" ){
			/* Friday attendees are 'students' */
			$sql = "SELECT attendee_id FROM attendees WHERE attendee_type = 1";
		}
		else{ /* Saturday */
			/* Saturday attendees are 'professionals' */
			$sql = "SELECT attendee_id FROM attendees WHERE attendee_type = 2";
		}
		$data = framework::getMany($sql);
		foreach( $data as $d ){
			array_push($aID, intval($d['attendee_id']));
		}

		/* we need to get each attendees' reviewer list and create an array from it */
		foreach($aID as $id){
			$data = framework::getMany("
				SELECT reviewer_id1, reviewer_id2, reviewer_id3, reviewer_id4,
					   reviewer_id5, reviewer_id6, reviewer_id7, reviewer_id8,
					   reviewer_id9, reviewer_id10, reviewer_id11, reviewer_id12,
					   reviewer_id13, reviewer_id14, reviewer_id15, reviewer_id16,
					   reviewer_id17, reviewer_id18, reviewer_id19, reviewer_id20
				FROM attendees
				WHERE attendee_id = '". $id ."'");
			$tmp_array = array();	// used to temporarily store list of reviewers
			foreach( $data as $d ){				// $data holds one row of 20 reviewers
				foreach( $d as $reviewer ){		// $d is an associative array, but don't want to bother with labels, so iterate as $reviewer
					if( $reviewer !== NULL ){
						array_push($tmp_array, intval($reviewer)); 	// add each reviewer to tmp array
					}
				}
			}
			// Create a new attendee and add to Attendees list
			array_push($Attendees, new Attendee($id, $tmp_array));
		}

		return $Attendees;
	}

	
	/**
	 * Uses arrays of Tables and Attendees classes to fill Tables seats based on Attendee reviewer preferences
	 *
	 * @param array $Tables - pre-initialized array of Table Objects
	 * @param array $Attendees - pre-initialized array of Attendee objects
	 * @param bool $shortSaturdaysFlag - pass this in so that we can check for Short Saturdays
	 *
	 * @return int $matched - returns number of available table spots that were filled
	 */
	protected static function FillTables( $Tables, $Attendees, $match_limit, $shortSaturdaysFlag )
	{	
		$MAX_ASSIGNED = $match_limit;
		$matched = 0;		// keep track of number of matches for analytic reasons...
		
		/* Iterate over number of possible reviewers in attendee class (20) */
		for ($c = 0; $c < 20; $c++){
			foreach($Tables as $t){
				foreach($Attendees as $a){
					// We will only consider adding an attendee that has a preference for this choice index
					if( count($a->get_list()) > $c ){
						if( (!$t->isFull()) and ($a->get_assigned() <= min($c, $MAX_ASSIGNED-1)) and ($a->get_reviewer($c) === $t->getReviewerId()) )
						{
							/* If the special case where Short Saturdays flag is set, 
							 * and the table date ID = 'S3', then we will fill table 
							 * at 4 instead of default */
							if( $shortSaturdaysFlag and $t->getDaySlot() === "S3" ){
								if( !$t->isFull(4) ){
									$t->addAttendee($a->get_id());
									$a->bump();
									$matched++;
								}
								/* Otherwise we do not fill here */
							}
							else {
								//echo "<P>count:".$a->get_assigned()." min:".min($c, $MAX_ASSIGNED-1);
								$t->addAttendee($a->get_id());
								$a->bump();
								$matched++;
							}
						}
						//echo "<p>".strval($a->get_id())."-".strval($a->get_reviewer($c));
					}
				}
			}
		}
		
		/* The following attempted to match unassigned attendees, but it was 
         * decided to not do this
		 */
		/* Try to assign attendees who have not been assigned to empty table slots */
		/*
		foreach($Attendees as $a){
			// Look for attendees who have not been assigned 
			if( $a->get_assigned() === 0 ){
				foreach($Tables as $t){
					// Look for tables with free spaces available
					if( !$t->isFull() ){
							$t->addAttendee($a->get_id());
							$a->bump();
							$matched++;
							break;
					}
				}
			}
		}
		*/

		return $matched;
	}
	
	
	
	
	/**
	 * Insert Created Tables into sessions table in database
	 *
	 * @param array $Tables - Array of Table Objects that have been filled 
	 * @param int $registrationPeriodId - Current registration period for creating sessions
	 *
	 * @return void
	 */
	protected static function InsertTablesToSessions( $Tables, $registrationPeriodId )
	{	
		/* Iterate through all tables and insert as sessions */
		foreach($Tables as $t) {
			//$registrationPeriodId = 1;   // how is this useful??
			$sql = "INSERT INTO	`session`
			(reviewer_id, registration_period_id, day_slot, table_num, attendee_id1, attendee_id2, attendee_id3, attendee_id4, attendee_id5, attendee_id6)
			VALUES
			('". $t->getReviewerId() ."', '". $registrationPeriodId ."', '". $t->getDaySlot() ."', '". $t->getTableNumber();

			// need to get the attendees list
			$A = $t->getAttendees();
			$nullcounts = 6 - count($A);
			//echo "NEED ".$nullcounts." Nulls!  ";
			foreach($A as $a){
				$sql .= "', '".$a;
			}
			if( $nullcounts > 0 ){
				$sql .= "'";  // end quotes around previous data
				for($i = 0; $i < $nullcounts; $i++ ){
					$sql .= ", NULL";
				}
				$sql .= ")";
			}
			else{
				$sql .= "')";
			}
			
			//echo "<p>".$sql;
			// insert
			framework::execute($sql);

		}
	}
	
	
	
	/**
	 * Implementation of Scheduler Below
	 *
	 * @param int $registrationPeriodId - saves sessions under this ID
	 *
	 * @return void 
	 *****************************************************/
	public static function MakeSchedule($registrationPeriodId)
	{
		/* Need to check if short Saturdays flag is active and get maximum attendees match variable */
		$shortSaturdays = false;
		$sql = "SELECT * FROM registration_periods WHERE registration_period_id = '".$registrationPeriodId."'";
		$data = framework::getOne($sql);
		
		if( $data["short_saturdays"] === 'yes' ){
			$shortSaturdays = true;
		}
		$match_limit = $data["attendees_match_limit"];

		/* Do Friday Schedule */
		$Tables = self::makeTables("Friday");
		$Attendees = self::MakeAttendees("Friday");

		$matched = self::FillTables( $Tables, $Attendees, $match_limit, false );
		//outputing the following will break the alert box in Manage Schedule tab (admin.js)
		//echo "<p>Friday Scheduler matched ".$matched." out of ".(count($Tables)*6)."." ;
		
		self::InsertTablesToSessions( $Tables , $registrationPeriodId );
		
		/* Do Saturday Schedule */
		$Tables = self::makeTables("Saturday");
		$Attendees = self::MakeAttendees("Saturday");

		$matched = self::FillTables( $Tables, $Attendees, $match_limit, $shortSaturdays );
		//outputing the following will break the alert box in Manage Schedule tab (admin.js)
		//echo "<p>Saturday Scheduler matched ".$matched." out of ".(count($Tables)*6)."." ;
		
		self::InsertTablesToSessions( $Tables , $registrationPeriodId );
		
		/* Update registration periods to show that schedule has been created */
		$sql = "UPDATE registration_periods SET schedule_created = 1 WHERE registration_period_id = '".$registrationPeriodId."'";
		framework::execute($sql);
		
	}
}



 ?>