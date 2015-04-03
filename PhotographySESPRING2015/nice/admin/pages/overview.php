<h2>Overview</h2>

<script type="text/javascript">
	$(function() {
		$.post("scripts/general/loadOverview.php", {}, function(json) {
			var data = $.parseJSON(json);

			if(data.publish_schedule == false) {
				$("#btnPublishSchedule").prop("value", "Unpublish Schedule");
			}

			// disable the button; also disable any table modification
			if(data.create_schedule == false) {
				$("#btnCreateSchedule").prop("disabled", true);
			}

			admin.getMaxTables();
			admin.getMaxAttendees();

		});
	});
</script>

<!-- Moved to manageSchedule.php
<table>
	<tr>
		<td><button class="bigAButton" id="btnCreateSchedule" type="button" onclick="javascript:admin.createSchedule();">Create Schedule</button></td>
		<td><button class="bigAButton" id="btnPublishSchedule" type="button" onclick="javascript:admin.publishSchedule();">Publish Schedule</button></td>
	</tr>
	<tr>
		<td><button class="bigAButton" id="btnClearAttendees" type="button" onclick="javascript:admin.clearSchedule();">Clear Schedule</button></td>
		<td>
			for
			<select id="registration_period">
 
				<?php
					$periods = framework::getMany("
					SELECT
						*
					FROM
						registration_periods
					");

					foreach($periods as $period) {
						echo "<option value=\"". $period["registration_period_id"] ."\">". $period["year"] ."</option>";
					}
				?> 
			</select>
		</td>
	</tr>
</table>
-->

<table>
	<caption class="title">Information</caption>
	<tr>
		<td id="thisRegPeriod"><?php require_once "scripts/admin/GetRegPeriods.php"; ?><br /></td>
	<tr>
</table>

<table>
	<caption class="title">Maximum Number of Tables</caption>
	<tr>
		<th>Enter Number:</th>
		<th><input type="text" id="max_tables" /></th>
		<th><button type="button" class="roundedClass" onclick="javascript:admin.setMaxTables();">Save</button></th>
	</tr>
</table>

<br/>
<table>
	<caption class="title">Maximum Attendee Matches</caption>
	<tr>
		<th>Enter Number:</th>
		<th><input type="text" id="max_attendees" /></th>
		<th><button type="button" class="roundedClass" onclick="javascript:admin.setMaxAttendees();">Save</button></th>
	</tr>
</table>

<br/>
<table width="150">
	<caption class="title">Set Short Saturdays</caption>
	<tr>
		<th><select id="short_sats">
					<option value="no">No</option>
					<option value="yes">Yes</option>
			</select></th>
		<th><button type="button" class="roundedClass" onclick="javascript:admin.setShortSaturdays();">Save</button></th>
	</tr>
</table>

<br/>
<table>
	<caption class="title">Set Registration Periods</caption>
	<tr>
		<th>Reviewer Registration: </th>
		<th>From</th><td><input type="text" id="revFrom" class="datepicker"></td><th>To</th><td><input type="text" id="revTo" class="datepicker"></td>
	</tr>
	<tr>
		<th>Attendee Registration: </th>
		<th>From</th><td><input type="text" id="attFrom" class="datepicker"></td><th>To</th><td><input type="text" id="attTo" class="datepicker"></td>
	</tr>
	<tr>
		<td align="center" colspan="5">
			<button type="button" class="roundedClass" onclick="javascript:admin.clearPeriods()">Clear Periods</button>
			<button type="button" class="roundedClass" onclick="javascript:admin.setPeriods()">Set Periods</button>
		</td>
	</tr>
</table>