<h2>Manage Keywords</h2>

<div style="text-align: center">
	Add New Keyword: <input type="text" id="new_keyword" /> <input type="button" value="Add Keyword" onclick="javascript:admin.addKeyword();" />
</div>

<table width="90%" id="keywords" class="model_table">
	<tr>
		<th>Keyword</th>
		<th>Actions</th>
	</tr>
	<?php

	$keywords = framework::getMany("SELECT * FROM keyword_definition");

	$html = "";

	foreach($keywords as $i => $keyword) {
		$html .= "<tr style=\"background-color: ". (($i % 2 == 0) ? "#888" : "#666") ." !important;\" id=\"keyword_definition_row_". $keyword["keyword_definition_id"] ."\">";
		$html .= " <td old-keyword=\"". $keyword["name"] ."\" id=\"keyword_definition_". $keyword["keyword_definition_id"] ."\">" . $keyword["name"] ."</td>";
		$html .= " <td><a href=\"javascript:;\" onclick=\"javascript:admin.editKeyword('". $keyword["keyword_definition_id"] ."', '". $keyword["name"] ."');\">Edit</a> | <a href=\"javascript:;\" onclick=\"javascript:admin.deleteKeyword('". $keyword["keyword_definition_id"] ."');\">Delete</a></td>";
		$html .= "</tr>";
	}

	echo $html;

	?>
</table>

<!-- todo -->
<div id="keyword_pagination" class="pagination"></div>