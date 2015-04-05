<h2>Manage Schedule</h2>

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

		});
	});
</script>

<table>
	<tr>
		<?php 
		// scripts below are in admin\scripts\admin.js
		?>
		
		<td><button class="bigAButton" id="btnCreateSchedule" type="button" onclick="javascript:admin.createSchedule();">Create Schedule</button></td>
		<td><button class="bigAButton" id="btnPublishSchedule" type="button" onclick="javascript:admin.publishSchedule();">Publish Schedule</button></td>
		<td><button class="bigAButton" id="btnClearAttendees" type="button" onclick="javascript:admin.clearSchedule();">Clear Schedule
		</button></td>
	</tr>
</table>

<h3>Schedule Below...</h3>
