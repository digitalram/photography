<?php

class Table
{
	const MAX_ATTENDEES = 6;
	
	// Protected members
	protected $number;
	protected $date;
	protected $reviewer;
	protected $attendees;
	
	public function __construct( $number, $date, $reviewer ) 
	{
		$this->number = $number;
		$this->date = $date;
		$this->reviewer = $reviewer;
		$this->attendees = array();
	}
	
	public function isFull( $max_override = self::MAX_ATTENDEES )
	{
		//return count($this->attendees) >=  self::MAX_ATTENDEES;
		return count($this->attendees) >=  $max_override;
	}
	
	public function getReviewerId()
	{
		return $this->reviewer;
	}
	
	public function getDaySlot()
	{
		return $this->date;
	}
	
	public function getTableNumber()
	{
		return $this->number;
	}
	
	public function getAttendees()
	{
		return $this->attendees;
	}
	
	public function addAttendee( $attendee_id )
	{
		array_push( $this->attendees, $attendee_id );
	}
	
	public function removeAttendee( $attendee_id )
	{
		if(($key = array_search($attendee_id, $this->attendees)) !== false) {
			unset($this->attendees[$key]);
		}
	}
	
	/* Not sure if we need this?
	public function removeReviewer()
	{
		$this.reviewer
	}
	*/
}

class Attendee
{
	// Protected members
	protected $id;
	protected $reviewer_list;
	protected $assigned;
	
	public function __construct( $id, $reviewer_list ) 
	{
		$this->id = $id;
		$this->reviewer_list = $reviewer_list;
		$this->assigned = 0;
	}
	
	public function get_id()
	{
		return $this->id;
	}
	
	public function get_assigned()
	{
		return $this->assigned;
	}
	
	public function get_list()
	{
		return $this->reviewer_list;
	}
	
	public function get_reviewer( $index )
	{
		return $this->reviewer_list[$index];
	
	}
	
	public function bump()
	{
		$this->assigned += 1;
	}

}

 ?>