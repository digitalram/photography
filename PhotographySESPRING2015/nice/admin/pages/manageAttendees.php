<h2>Manage Attendees</h2>

<div style="text-align: center">
	Search: <input type="text" id="attendee_search_query" />

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

	<select id="attendee_regPeriod">
		<option value="" selected="selected">Filter by registration period</option>
		<option value="0">Attendees not on a schedule</option>
		<?php echo $html; ?>
	</select>

	<input type="button" id="attendee_search" value="Go" />
</div>

<script type="text/javascript">
	$(function() {

		var page = 1,
			perPage = 20;

		$("input#attendee_search").click(function() {
			var text = $("#attendee_search_query").val();
			var regPd = $("#attendee_regPeriod").val();

			admin.attendeeSearch(text, page, perPage, regPd);

		});

		admin.attendeeSearch("", page, perPage, "");

	});
</script>

<table width="90%" id="attendees" class="model_table">
	<tr>
		<th>Attendee Name</th>
		<th>E-mail Address</th>
		<th>Attendee Type</th>
		<th>Registration Period</th>
		<th>Reviewer</th>
	</tr>
	<tr>

	</tr>
</table>

<div id="attendee_pagination" class="pagination"></div>