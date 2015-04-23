<h2>Displaced Attendees</h2>

<style>
table#displaced tr:nth-child(even){
	background-color: #888;
table#displaced tr:nth-child(odd) {
	background-color: #555;
</style>

<table width="90%" id="displaced" class="model_table" border="0" bgcolor="#BBBBBB">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email Address</th>
		<th>Previous Table #</th>
		<th>Time</th>
		<th>Slot</th>
		<th>New Table #</th>
		<th>Time</th>
		<th>Slot</th>
		<th>is reassigned?</th>
		<th>is notified?</th>
	</tr>


<?php
	/* TODO: get current registration period? */
	$query = "SELECT u.first_name, u.last_name, u.email_address, d.prev_table_num, d.prev_time, d.prev_slot, d.new_table_num, d.new_time, d.new_slot, d.is_reassigned, d.is_notified FROM users u, attendees a, displaced_attendees d WHERE d.attendee_id = a.attendee_id and a.user_id = u.user_id ORDER BY u.last_name";
	
	$result = framework::getMany($query);
	
	foreach($result as $r ){
		echo "<tr>";
		echo "<td>".$r['first_name']."</td>";
		echo "<td>".$r['last_name']."</td>";
		echo "<td>".$r['email_address']."</td>";
		echo "<td>".$r['prev_table_num']."</td>";
		echo "<td>".$r['prev_time']."</td>";
		echo "<td>".$r['prev_slot']."</td>";
		if( $r['new_table_num'] != NULL ){
			echo "<td>".$r['new_table_num']."</td>";
		}
		else{
			echo "<td> -- </td>";
		}
		if( $r['new_time'] != NULL ){
			echo "<td>".$r['new_time']."</td>";
		}
		else{
			echo "<td> -- </td>";
		}
		if( $r['new_slot'] != NULL ){
			echo "<td>".$r['new_slot']."</td>";
		}
		else{
			echo "<td> -- </td>";
		}
		echo "<td>".$r['is_reassigned']."</td>";
		echo "<td>".$r['is_notified']."</td>";
		echo "</tr>";
	}
	
?>

</table>
	
<!--
<div style="text-align: center">
	Search: <input type="text" id="reviewer_search_query" />

	<?php

	$registrationPeriods = framework::getMany("
		SELECT
			*
		FROM
			registration_periods
		");

	$html = "";

	foreach($registrationPeriods as $regPeriod) {
		$html .= "<option value=\"". $regPeriod["registration_period_id"] ."\">". $regPeriod["year"] ."</option>";
	}

	?>

	<select id="reviewer_regPeriod">
		<option value="" selected="selected">Filter by registration period</option>
		<option value="0">Reviewers not on a schedule</option>
		<?php echo $html; ?>
	</select>

	<input type="button" id="reviewer_search" value="Go" />
</div>

<script type="text/javascript">
	$(function() {

		var page = 1,
			perPage = 20;

		$("input#reviewer_search").click(function() {
			var text = $("#reviewer_search_query").val();
			var regPd = $("#reviewer_regPeriod").val();

			admin.reviewerSearch(text, page, perPage, regPd);

		});

		admin.reviewerSearch("", page, perPage, "");

	});
</script>

<table width="90%" id="reviewers" class="model_table">
	<tr>
		<th>Reviewer Name</th>
		<th>E-mail Address</th>
		<th>Registration Period</th>
		<th>Table Number</th>
		<th>Friday Morning</th>
		<th>Friday Midday</th>
		<th>Friday Afternoon</th>
		<th>Saturday Morning</th>
		<th>Saturday Midday</th>
		<th>Saturday Afternoon</th>
	</tr>
	<tr>

	</tr>
</table>

<div id="reviewer_pagination" class="pagination"></div>
-->