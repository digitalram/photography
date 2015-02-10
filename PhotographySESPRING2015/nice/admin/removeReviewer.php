<?php

  require_once '../config.php';

  if(isset($_GET)) {
  
    // basics
    $reviewerId = $_GET['reviewer_id'];
    
    // obtain attendees
    $sql = "
    SELECT
      a.Id AS attendee_id
    FROM
      session AS s
    
    JOIN attendees AS a
    ON (
        a.Id = s.Time_1
        OR
        a.Id = s.Time_2
        OR
        a.Id = s.Time_3
        OR
        a.Id = s.Time_4
        OR
        a.Id = s.Time_5
        OR
        a.Id = s.Time_6
    )

    WHERE 
      s.Rev_Id = '". $reviewerId ."' 
    ";
    
    $res = mysqli_query($con, $sql);
    
    // placeholder for attendees to be re-propogated
    $attendees = array();
  
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
      if($row["attendee_id"] != null) {
        $attendees[] = $row["attendee_id"];
      }
    }
  
    // find null entries to place attendees
    $sql = "
    SELECT
      *
    FROM
      session AS s
    WHERE
      s.Time_1 IS NULL
      OR
      s.Time_2 IS NULL
      OR
      s.Time_3 IS NULL
      OR
      s.Time_4 IS NULL
      OR
      s.Time_5 IS NULL
      OR
      s.Time_6 IS NULL
    ";
    
    $res = mysqli_query($con, $sql);
    
    echo "<pre>";
    
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
      
      // reference to new reviewer
      $_reviewerId = $row["Rev_id"];
      
      // check to see if we're finished propagating attendees
      if(empty($attendees)) {
        break;
      }
      
      // reference for timeslots to check which ones are null (and dynamically check which ones are null/available)
      $timeSlots = array(
        "Time_1"  => $row["Time_1"],
        "Time_2"  => $row["Time_2"],
        "Time_3"  => $row["Time_3"],
        "Time_4"  => $row["Time_4"],
        "Time_5"  => $row["Time_5"],
        "Time_6"  => $row["Time_6"],
      );
      
      $arrFieldValues = array();
      
      foreach($timeSlots as $fieldName => $value) {
        if($value == null) {
          $arrFieldValues[] = "s." . $fieldName . " = '". array_pop($attendees) ."'";
        }
      }
      
      $fieldValues = implode(",\n", $arrFieldValues);
      
      $_sql = "
        UPDATE
          session AS s
        SET
          ".$fieldValues."
        WHERE
          s.Rev_id = '". $_reviewerId ."'
      ";
      
      $_res = mysqli_query($con, $_sql);
      
    }
    
  }
  
  // finally, remove the attendees from the related session
  /*$sql = "
  UPDATE
    session AS s
  SET
    s.Time_1 = NULL,
    s.Time_2 = NULL,
    s.Time_3 = NULL,
    s.Time_4 = NULL,
    s.Time_5 = NULL,
    s.Time_6 = NULL
  WHERE
    s.Rev_id = '". $reviewerId ."'
  ";*/
  
  $sql = "
  DELETE FROM
    session
  WHERE
    Rev_id = '". $reviewerId ."'
  ";
  
  $res = mysqli_query($con, $sql);
  
  echo "Reviewer removed successfully!";

?>
