comm<h2>Send Email</h2>

	<?php
		/** @var email $emailer */
		$emailer = framework::includeModule("email");

		$request = framework::getRequestVars();

		echo '<form method="post">
             Email: <div class="search">
			<h3>To find the schedule for a specific person,<br/> type that person\'s name in the box below.</h3>
			<form class="search" action="./?page=individual" method="POST">
				<input type="text" name="search" autocomplete="off"/>
				<input type="submit" value="submit" />
			</form>
			<form class="hidden" method="POST" action="./?page=individual" style="display:none;">
				<input type="text" name="first" />
				<input type="text" name="last" />
			</form>
			<div class="results">

			</div>
			</div>
             Subject: <input name="subject" type="text" /><br />
             Message:<br />
             <textarea name="comment" rows="15" cols="40"></textarea><br />
             <input type="submit" value="Submit" />
             </form>';
			 
			 
			 
		/* if "email" variable is filled out, send email
		if (isset($request['email']))  {

			var_dump($emailer->sendCustomEmail($request["email"], $request["subject"], $request["comment"]));

		}
		if else(true){
           	echo '<form method="post">
             Email: <input name="email" type="text" /><br />
             Subject: <input name="subject" type="text" /><br />
             Message:<br />
             <textarea name="comment" rows="15" cols="40"></textarea><br />
             <input type="submit" value="Submit" />
             </form>'
		}
		else {
		*/
	
		//framework::includeScript("general", "js", "search");
?>

	<script type="text/javascript" src="../scripts/general/js/search.js"></script>

