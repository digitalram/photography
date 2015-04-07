<?php
	require_once "bootstrap.php";
	
	framework::includeScript("attendee", "php", "insertUpdateAttendee");
?>

<form method="post">
		<div class="container">
			<div class="maintitle">Attendee Registration</div><br /><br />
			<table>
			<?php
			if(!framework::isLoggedIn()){?>
				<caption><div class="title">Are you a student or a professional?</div></caption>
				<tr>
					<td>
						<input required="required" checked="true" type = "radio" name = "attendee" onClick="UpdateFilter()" value = "student" />Student
						<input required="required" type = "radio" name = "attendee" onClick="UpdateFilter()" value = "professional" />Professional
						<br />
					</td>
				</tr>
			<?php } ?>
				<tr>
					<td><input class="roundedClass" type = "text" id = "firstName" name="firstName" required="required" placeholder="First Name" /></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type = "text" id = "lastName" name = "lastName" required="required" placeholder="Last Name" /></td>
				</tr>
				<?php if(!framework::isLoggedIn()){ ?>
					<tr>
						<td><input class="roundedClass" type = "text" id = "email" name = "email" required="required" placeholder="Email Address" /></td>
					</tr>
					<?php } ?>
			</table>
		</div>
		
			<div class="container">	<!-- filter genres(keywords) -->
				<center><?php framework::includeScript("attendee", "php", "keywordAttendee"); ?>
			</center>
		</div>
		<div class="container">	<!-- filter opportunities -->
			<center><?php framework::includeScript("attendee", "php", "attOpportunities"); ?></center>
		</div>
		<div class="container">	<!-- 20 preference selectboxes -->
			<center><span id="topTwenty"><?php framework::includeScript("attendee", "php", "createPrefList"); ?></span></center>
		</div>
		<table>
			<tr>
				<center>
				<td><input class="roundedClass" type = "reset" value = "Reset" style="width: 75px;"></td>
				<td><input class="roundedClass" type = "submit" value = "Submit" style="width: 75px;"></td>
				</center>
			</tr>
		</table>
	</div>
		</form>

		<script type = "text/javascript" src = "studentr.js"></script>
