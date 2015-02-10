<h2>Manage Opportunities</h2>

<div style="text-align: center">
	Add New Opportunity: <input type="text" id="new_opportunity" /> <input type="button" value="Add Opportunity" onclick="javascript:admin.addOpportunity();" />
</div>

<table width="90%" id="opportunities" class="model_table">
	<tr>
		<th>Opportunity</th>
		<th>Actions</th>
	</tr>
	<?php

	$opportunities = framework::getMany("SELECT * FROM opportunity_definition");

	$html = "";

	foreach($opportunities as $i => $opportunity) {
		$html .= "<tr style=\"background-color: ". (($i % 2 == 0) ? "#888" : "#666") ." !important;\" id=\"opportunity_definition_row_". $opportunity["opportunity_definition_id"] ."\">";
		$html .= " <td id=\"opportunity_definition_". $opportunity["opportunity_definition_id"] ."\">" . $opportunity["name"] ."</td>";
		$html .= " <td><a href=\"javascript:;\" onclick=\"javascript:admin.editOpportunity('". $opportunity["opportunity_definition_id"] ."', '". $opportunity["name"] ."');\">Edit</a> | <a href=\"javascript:;\" onclick=\"javascript:admin.deleteOpportunity('". $opportunity["opportunity_definition_id"] ."');\">Delete</a></td>";
		$html .= "</tr>";
	}

	echo $html;

	?>
</table>

<!-- todo -->
<div id="opportunity_pagination" class="pagination"></div>