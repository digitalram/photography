<?php 
	include_once "bootstrap.php"; 
	
	// Redirect if there is no user
	if( !isset($_SESSION["user_id"]) )
		header("Location: index.php");
	
	$user_id = $_SESSION["user_id"];
?>

<!-- Write schedule header -->
<h1 style="padding-left: 15px;"><?php echo "Master Schedule ". (($session == "") ? "" : " - " . $session); ?></h1>
<p style="padding-left: 15px;"><a href="" onclick="window.print();">Print this Schedule (to download schedule, print as a PDF).</a></p>
<hr />
<div class="schedule">

<?php
	$registrationPeriod		= app::getCurrentRegistrationPeriod();
	$registrationPeriodId	= $registrationPeriod["registration_period_id"];

	$request = framework::getRequestVars();

	$session_sql = 
	"SELECT
		session.table_num,
		session.day_slot,
		CONCAT(r.first_name,' ',r.last_name) AS reviewer,
		CONCAT(au1.first_name,' ',au1.last_name) AS attendee1,
		CONCAT(au2.first_name,' ',au2.last_name) AS attendee2,
		CONCAT(au3.first_name,' ',au3.last_name) AS attendee3,
		CONCAT(au4.first_name,' ',au4.last_name) AS attendee4,
		CONCAT(au5.first_name,' ',au5.last_name) AS attendee5,
		CONCAT(au6.first_name,' ',au6.last_name) AS attendee6
	FROM
		session
		JOIN reviewers ON session.reviewer_id = reviewers.reviewer_id
		JOIN users r ON reviewers.user_id = r.user_id
		LEFT JOIN attendees a1 ON session.attendee_id1 = a1.attendee_id
		LEFT JOIN users au1 ON a1.user_id = au1.user_id
		LEFT JOIN attendees a2 ON session.attendee_id2 = a2.attendee_id
		LEFT JOIN users au2 ON a2.user_id = au2.user_id
		LEFT JOIN attendees a3 ON session.attendee_id3 = a3.attendee_id
		LEFT JOIN users au3 ON a3.user_id = au3.user_id
		LEFT JOIN attendees a4 ON session.attendee_id4 = a4.attendee_id
		LEFT JOIN users au4 ON a4.user_id = au4.user_id
		LEFT JOIN attendees a5 ON session.attendee_id5 = a5.attendee_id
		LEFT JOIN users au5 ON a5.user_id = au5.user_id
		LEFT JOIN attendees a6 ON session.attendee_id6 = a6.attendee_id
		LEFT JOIN users au6 ON a6.user_id = au6.user_id
	WHERE
		session.registration_period_id = 1
		AND r.user_id = '" . $user_id . "'
		OR au1.user_id = '" . $user_id . "'
		OR au2.user_id = '" . $user_id . "'
		OR au3.user_id = '" . $user_id . "'
		OR au4.user_id = '" . $user_id . "'
		OR au5.user_id = '" . $user_id . "'
		OR au6.user_id = '" . $user_id . "'
	ORDER BY
		session.day_slot,
		session.table_num";
	
	$sessions = framework::getMany($session_sql);
	
	foreach($sessions as $session)
	{
		// Build friendly descriptions for day time slot
		$day = substr($session["day_slot"], 0, 1);
		$time = substr($session["day_slot"], 1);
		
		if($day == "F") {
			$day = "Friday";
		} else {
			$day = "Saturday";
		}
		
		switch($time) {
			case "1":
				$time = "9:00am - 11:00am";
				break;

			case "2":
				$time = "11:15am - 1:15pm";
				break;

			case "3":
				$time = "1:30pm - 3:30pm";
				break;

			default:
				$time = "TBD";
				break;
		}
		
		// Write out this session entry
		?>
		<div class="section">
		<h2><?php echo $session["reviewer"]; ?></h2>
		<p class="table" style="margin-left:-20px;">
			<?php echo "Table: " . $session["table_num"] . " on " . $day . " from " . $time; ?>
		</p>
		<hr/>
		<ul>
			<li><p class="name"><?php echo $session["attendee1"] ?></p></li>
			<li><p class="name"><?php echo $session["attendee2"] ?></p></li>
			<li><p class="name"><?php echo $session["attendee3"] ?></p></li>
			<li><p class="name"><?php echo $session["attendee4"] ?></p></li>
			<li><p class="name"><?php echo $session["attendee5"] ?></p></li>
			<li><p class="name"><?php echo $session["attendee6"] ?></p></li>
		</ul>
		</div>
		<?php
	};
?>
</div>