<h3 style="padding: 3px;">Administration - <a href="logout.php" onclick="return confirm('Are you sure?')" style="font-weight:bold; text-transform: none;">Logout</a></h3>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Overview</a></li>
		<li><a href="#tabs-2">Manage Schedule</a></li>
		<li><a href="#tabs-3">Manage Attendees</a></li>
		<li><a href="#tabs-4">Manage Reviewers</a></li>
		<li><a href="#tabs-5">Displaced Attendees</a></li>
		<li><a href="#tabs-6">Manage Keywords</a></li>
		<li><a href="#tabs-7">Manage Opportunities</a></li>
		<li><a href="#tabs-8">Manage E-mail</a></li>
		<li><a href="#tabs-9">Send E-mail</a></li>

	</ul>
	<!-- Overview -->
	<div id="tabs-1">
		<?php include "pages/overview.php"; ?>
	</div>
	<div id="tabs-2">
		<?php include "pages/manageSchedule.php"; ?>
	</div>
	<!-- Manage Attendees -->
	<div id="tabs-3">
		<?php include "pages/manageAttendees.php"; ?>
	</div>

	<!-- Manage Reviewers -->
	<div id="tabs-4">
		<?php include "pages/manageReviewers.php"; ?>
	</div>
	
	<!-- Manage Displaced Attendees -->
	<div id="tabs-5">
		<?php include "pages/manageDisplacedAttendees.php"; ?>
	</div>	
	
	
	<div id="tabs-6">
		<?php include "pages/manageKeywords.php"; ?>
	</div>
	<div id="tabs-7">
		<?php include "pages/manageOpportunities.php"; ?>
	</div>
	<div id="tabs-8">
		<?php include "pages/manageEmail.php"; ?>
	</div>
	<div id="tabs-9">
		<?php include "pages/sendEmail.php"; ?>
	</div>

</div>