<?php 
	include_once "bootstrap.php"; 
?>

<!doctype html>
<html>
	<head>
	  	<link rel="stylesheet" href="css/main.css"/>
	  	<link rel="stylesheet" href="css/photo.css"/>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	
		<title>SPE National Photograph Review Schedule</title>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	</head>
	<body>
		<div id="top_header">
			<div id="usercp" style="margin: 5px;">
				<?php

				if(framework::isLoggedIn()) {
					echo "<a href=\"./?page=account\">Account</a> | <a href=\"./?page=logout\" onclick=\"return confirm('Are you sure?');\">Logout</a>";
				} else {
					echo "<a href=\"./?page=login\">Login</a>";
				}

				?>
			</div>
		    <header>
		    	<a href="index.php"><img src="img/logo.gif" /></a>
		        <h1>portfolio review schedule</h1>
		    </header>
		    <nav id="top_nav">
		        <ul>
		        	<!--<li <?= ($controller == 'reviewerSchedule') ? "id=\"active\"" : "" ?>>
		        		<a href="./index.php?page=reviewerSchedule">Reviewer Schedule</a>
		        	</li>
		        	<li <?= ($controller == 'attendeeSchedule') ? "id=\"active\"" : "" ?>>
		        		<a href="./index.php?page=attendeeSchedule">Attendee Schedule</a>
		        	</li>-->
		        	<li <?= ($controller == 'masterSchedule') ? "id=\"active\"" : "" ?>>
		        		<a href="./index.php?page=masterSchedule">Master Schedule</a>
		        		<ul>
		        			<li><a href="./index.php?page=masterSchedule&session=F1">friday morning</a></li>
							<li><a href="./index.php?page=masterSchedule&session=F2">friday midday</a></li>
							<li><a href="./index.php?page=masterSchedule&session=F3">friday afternoon</a></li>
		                    <li><a href="./index.php?page=masterSchedule&session=S1">saturday morning</a></li>
							<li><a href="./index.php?page=masterSchedule&session=S2">saturday midday</a></li>
							<li><a href="./index.php?page=masterSchedule&session=S3">saturday afternoon</a></li>
		        		</ul>
		        	</li>
					<li <?= ($controller == 'individualSchedule') ? "id=\"active\"" : "" ?>>
						<a href="./index.php?page=individualSchedule" <?php if(!isset($_SESSION["user_id"])) { ?>class="inactive"<?php } ?>>Individual Schedule</a>
		        	</li>
		        </ul>
	        </nav>
		</div>