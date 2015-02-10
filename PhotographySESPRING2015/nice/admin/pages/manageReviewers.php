<h2>Manage Reviewers</h2>

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