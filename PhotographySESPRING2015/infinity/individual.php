<?php
if(isset($_POST['first']) && isset($_POST['last'])){
		
	
	$session ='';
	$newdata = '<div class="schedule">';
	
	
	
	//for reviewers
	
	$query = 'SELECT `Last_Name`, `First_Name`, `S_id`, `Time_1`, `Time_2`, `Time_3`, `Time_4`, `Time_5`, `Time_6`
				FROM `reviewers`, `session`
				WHERE
				`Id`=`Rev_id` AND `First_Name` = "'.$_POST['first'].'" AND `Last_Name` = "'.$_POST['last'].'"
				ORDER BY `S_id` ASC, `Last_Name` ASC';
				

		
	$result = mysql_query($query);	
	
	if(mysql_num_rows($result)){
		while($event = mysql_fetch_array($result)){
			$time ='';
			
			if($event[2][0] != $header[0]){
				$session = $event[2];
				
				if($session[0] == 'F'){
					$header = 'Friday ';
				}else{
					$header = 'Saturday ';
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
			$newdata = $newdata.'<div class="section"><h2>'.$event[0].', '.$event[1].'</h2><hr />';
			
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
		
		
	}
		
		
		
		
		//for attendees
		$query = 'SELECT `Id`, `Last_Name`, `First_Name` FROM `attendees` 
				WHERE 
				`First_Name` = "'.$_POST['first'].'" AND `Last_Name` = "'.$_POST['last'].'"';
	
	
				
		$result = mysql_query($query);	
		
	if(mysql_num_rows($result)){
		while($event = mysql_fetch_array($result)){
			
			//add name
			$newdata = $newdata.'<div class="section"><h2>'.$event[1].', '.$event[2].'</h2><hr />';
			
			$newdata= $newdata.'<ul>';
				
				
			$query2 = 'SELECT `Last_Name`, `First_Name`, `S_id`, `Time_1`, `Time_2`, `Time_3`, `Time_4`, `Time_5`, `Time_6`
					FROM `reviewers`, `session`
					WHERE
					Id=Rev_id AND (`Time_1`='.$event[0].' OR `Time_2`='.$event[0].'  OR `Time_3`='.$event[0].'
					 OR `Time_4`='.$event[0].' OR `Time_5`='.$event[0].' OR `Time_6`='.$event[0].')
					ORDER BY `S_id` ASC';
					
			$result2 = mysql_query($query2);	
		
			while($row = mysql_fetch_array($result2)){
				
				
				if($event[2][0]== 'F'){
					$day = 'Friday';	
				}elseif($event[2][0]== 'S'){
					$day = 'Saturday';
				}
			
				switch($row[2]){
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
				
				//get attendees name
				for($i=3; $i< 9; $i++){
					
					//updates the time
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
						
					if($row[$i] == $event[0]){
						
						$newdata = $newdata.'<li><p class="name">'.$row[0].','.$row[1].'</p><p class="time">'.$time.'</p></li>';	
					
					}
				}
				
				
			}
			
			
			
			
			$newdata = $newdata.'</ul></div>';
		}	
	}
		
		
		
		
	$newdata = $newdata.'</div class="schedule">';
	
	
	
	
	
	
	
	
	
	echo $newdata;
	

}





if(isset($_POST['search'])){
		
	
	$session ='';
	$newdata = '<div class="schedule">';
	
	
	
	//for reviewers
	$query = 'SELECT `Last_Name`, `First_Name`, `S_id`, `Time_1`, `Time_2`, `Time_3`, `Time_4`, `Time_5`, `Time_6`
				FROM `reviewers`, `session`
				WHERE
				`Id`=`Rev_id` AND (`First_Name` = "'.$_POST['search'].'" OR `Last_Name` = "'.$_POST['search'].'")
				ORDER BY `S_id` ASC, `Last_Name` ASC';
				

		
	$result = mysql_query($query);	
	
	if(mysql_num_rows($result)){
		while($event = mysql_fetch_array($result)){
			$time ='';
			
			if($event[2][0] != $header[0]){
				$session = $event[2];
				
				if($session[0] == 'F'){
					$header = 'Friday ';
				}else{
					$header = 'Saturday ';
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
			$newdata = $newdata.'<div class="section"><h2>'.$event[0].', '.$event[1].'</h2><hr />';
			
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
		
		
	}
		
		
		
		
		//for attendees
		$query = 'SELECT `Id`, `Last_Name`, `First_Name` FROM `attendees` 
				WHERE 
				`First_Name` = "'.$_POST['search'].'" OR `Last_Name` = "'.$_POST['search'].'"';
	
	
				
		$result = mysql_query($query);	
		
	if(mysql_num_rows($result)){
		while($event = mysql_fetch_array($result)){
			
			//add name
			$newdata = $newdata.'<div class="section"><h2>'.$event[1].', '.$event[2].'</h2><hr />';
			
			$newdata= $newdata.'<ul>';
				
				
			$query2 = 'SELECT `Last_Name`, `First_Name`, `S_id`, `Time_1`, `Time_2`, `Time_3`, `Time_4`, `Time_5`, `Time_6`
					FROM `reviewers`, `session`
					WHERE
					Id=Rev_id AND (`Time_1`='.$event[0].' OR `Time_2`='.$event[0].'  OR `Time_3`='.$event[0].'
					 OR `Time_4`='.$event[0].' OR `Time_5`='.$event[0].' OR `Time_6`='.$event[0].')
					ORDER BY `S_id` ASC';
					
			$result2 = mysql_query($query2);	
		
			while($row = mysql_fetch_array($result2)){
				
				
				if($event[2][0]== 'F'){
					$day = 'Friday';	
				}elseif($event[2][0]== 'S'){
					$day = 'Saturday';
				}
			
				switch($row[2]){
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
				
				//get attendees name
				for($i=3; $i< 9; $i++){
					
					//updates the time
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
						
					if($row[$i] == $event[0]){
						
						$newdata = $newdata.'<li><p class="name">'.$row[0].','.$row[1].'</p><p class="time">'.$time.'</p></li>';	
					
					}
				}
				
				
			}
			
			
			
			
			$newdata = $newdata.'</ul></div>';
		}	
	}
		
		
		
		
	$newdata = $newdata.'</div class="schedule">';
	
	
	
	
	
	
	
	
	
	echo $newdata;
	
}

?>