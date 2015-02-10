<?php
	require 'connect.inc.php';
?>
		
	

<!doctype html>
<html>
<head>
  	<link rel="stylesheet" href="main.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	
    <title>SPE National Photograph Review Schedule</title>
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body >
	<?php require 'banner.php';
		
		$query = 'SELECT `show_db` FROM `show_db` WHERE 1';
			
		$result = mysql_query($query);	
		$event = mysql_fetch_array($result);
			
			
		
		if($event[0]){
	

    echo '<div class="search">
    	<h3>To find the schedule for a specific person,<br/> type that person\'s name in the box below.</h3>
    	<form class="search" action="./?id=individual.php" method="POST">
        	<input type="text" name="search" autocomplete="off"/>
			<input type="submit" value="submit" />
        </form>
        <form class="hidden" method="POST" action="./?id=individual.php"style="display:none;">
        	<input type="text" name="first" />
            <input type="text" name="last" />
        </form>
        <div class="results">
        
        </div>
    </div>';
	
	
	
	
	

	
	
	
	include 'pdf.php';
    
	echo '<div id="wrapper">';
    
			$curPage = explode('?',$_SERVER['REQUEST_URI']);
    
			//decides which page to display
			switch($curPage[1]) {
				case 'id=master.php': 
					include 'master.php';
					break;
				case 'id=master_friday.php': 
					include 'master_friday.php';
					break;
				case 'id=master_saturday.php': 
					include 'master_saturday.php';
					break;
				case 'id=reviewer.php':
					include 'reviewer.php';
					break;
				case 'id=reviewee.php':
					include 'reviewee.php';
					break;
				case 'id=faq.php':
					include 'faq.php';
					break;
				case 'id=individual.php':
					include 'individual.php';
					break;
				default:
					include 'home.php';
			}
		}else{		
		
		if($_SERVER['REQUEST_URI'] = "/index.php" || $_SERVER['REQUEST_URI'] = ""){
		
			include 'pdf.php';
    
			echo '<div id="wrapper">';
    
					include 'home.php';
		}else{
			
			echo '<div id="wrapper">';
		
			$curPage = explode('?',$_SERVER['REQUEST_URI']);
    
			//decides which page to display
			switch($curPage[1]) {
				case 'id=faq.php':
					include 'faq.php';
					break;
				default:
					include 'notpublished.php';	
			}
		}
			
		}
		?>	
    	
    </div>
       
	<script src="js/nav.js"></script>
	<script src="js/pdf.js"></script>
    <script src="js/search.js"></script>
    <script src="js/print.preview.js"></script>
</body>
</html>