<?php
	require 'connect.inc.php';
	
	$session ='';
	$newdata = '<div class="schedule">';
	
	$query = 'SELECT `Last_Name`, `First_Name`, `S_id`, `Time_1`, `Time_2`, `Time_3`, `Time_4`, `Time_5`, `Time_6`, `Table_num`
				FROM `reviewers`, session
				WHERE
				Id=Rev_id
				ORDER BY `S_id` ASC, `Last_Name` ASC, `First_Name` ASC';
				

		
	$result = mysql_query($query);	
	
	while($event = mysql_fetch_array($result)){
		$time ='';
		
		if($event[2] != $session){
			$session = $event[2];
			
			if($session[0] == 'F'){
				$header = 'Friday ';
			}else{
				$header = 'Saturday ';
			}
			if($session[1] ==1){
				$header = $header.'9:00-11:00';
			}elseif($session[1] ==2){
				$header = $header.'11:15-1:15';
			}else{
				$header = $header.'1:30-3:30';
			}
			
			
			$newdata = $newdata.'<h1>'.$header.'</h1>';
		}
		
		switch($event[2]){
			case 'F1': 
			case 'S1': $time = '9:00';
			break;
			case 'F2': 
			case 'S2': $time = '11:15';
			break;
			case 'F3': 
			case 'S3': $time = '1:30';
			break;	
		}
		
		
		//add name
		$newdata = $newdata.'<div class="section"><h2>'.$event[0].', '.$event[1].'</h2><p class="table" style="margin-left:80px;">Table: '.$event[9].'</p><hr />';
		$newdata= $newdata.'<ul>';
		
		
		//get attendees name
		for($i=3; $i< 9; $i++){
			
			
			
			if($i!=3){
				$timeArray = explode(':', $time);
				
				$newMin = intval($timeArray[1]);
				
				$newMin = $newMin + 20;
				
				if($newMin >= 60){
					$timeArray[0] = ($timeArray[0] % 12) + 1;
					$newMin = $newMin % 60;
				}
				
				if($newMin == 0){
					$time = $timeArray[0].':00';
				}else{
					$time = $timeArray[0].':'.$newMin;
				}
			}
			
			if(!(is_null($event[$i]))){
				$query2 = 'SELECT `Last_Name`, `First_Name` FROM `attendees` WHERE `Id`='.$event[$i];
				$result2 = mysql_query($query2);	
			
				$row = mysql_fetch_array($result2);
				
				
				
				$newdata = $newdata.'<li><p class="name">'.$row[0].', '.$row[1].'</p><p class="time">'.$time.'</p></li>';	
			
			}else{
				$newdata = $newdata.'<li><p class="name"> </p><p class="time">'.$time.'</p></li>';
			}
		}
		
		'<p>'.$event[2].' '.$event[3].' '.$event[4].' '.$event[5].' '.$event[6].' '.$event[7].' '.$event[8].'</p>';
		
		
		$newdata = $newdata.'</ul></div>';
	}
	
	$newdata = $newdata.'</div class="schedule">';
	
	
	
	echo $newdata;
?>