<h2>Manage Email Templates</h2>

<style>
	.morecontent span {
		display: none;
	}
	.morelink {
		display: block;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {

		// http://code-tricks.com/jquery-read-more-less-example/
		var showChar = 100;
		var ellipsestext = "...";
		var moretext = "[more]";
		var lesstext = "[less]";


		$('.more').each(function() {
			var content = $(this).html();

			if(content.length > showChar) {

				var c = content.substr(0, showChar);
				var h = content.substr(showChar, content.length - showChar);

				var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

				$(this).html(html);
			}

		});

		$(".morelink").click(function(){
			if($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});

	});
</script>

<form id="template_form">
	<input type="hidden" id="template_id" value="" />
	<!-- form -->
	<table align="center">
		<tr>
			<td style="text-align: right !important;">Identifier:</td>
			<td style="text-align: left !important;"><input type="text" id="identifier" /> (no spaces or capital letters; e.g. password_reset)</td>
		</tr>
		<tr>
			<td style="text-align: right !important;">Subject:</td>
			<td style="text-align: left !important;"><input type="text" id="subject" /></td>
		</tr>
		<tr>
			<td style="text-align: right !important; vertical-align: top;">Message:</td>
			<td style="text-align: left !important;"><textarea type="text" style="min-height: 100px;min-width: 400px;" id="message"></textarea> <br> <a href="javascript:;">Template Variables</a></td>
		</tr>
		<tr>
			<td style="text-align: right !important;">Use Confirmation Codes:</td>
			<td style="text-align: left !important;">
				<select id="use_confirmation_code">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Code Expire (in minutes)</td>
			<td style="text-align: left !important;"><input type="text" id="confirm_expire" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input id="template_button" type="button" value="Add" onclick="javascript:admin.saveEmailTemplate();" />
				<input id="cancel_button" type="button" value="Cancel" style="display:none;" onclick="javascript:admin.cancelEditTemplate();" />
			</td>
		</tr>
	</table>
</form>

<table width="100%" id="opportunities" class="model_table">
	<tr>
		<th>Name</th>
		<th>Identifier</th>
		<th>Subject</th>
		<th width="40%">Message</th>
		<th>Uses Confirmation Codes</th>
		<th>Code Expires (minutes)</th>
		<th width="10%">Actions</th>
	</tr>
	<?php

	$templates = framework::getMany("
	SELECT
		*
	FROM
		email_templates
	");

	$html = "";

	foreach($templates as $template) {

		$html .= "<tr id=\"email_template_row_". $template["email_template_id"] ."\">";

		$html .= " <td>" . ucwords(str_replace("_", " ", $template["identifier"])) . "</td>";
		$html .= " <td>" . $template["identifier"] . "</td>";
		$html .= " <td>" . $template["subject"] . "</td>";
		$html .= " <td> <p class=\"more\">" . $template["message"] . "</p></td>";
		$html .= " <td>" . ucwords($template["use_confirmation_code"]) ."</td>";
		$html .= " <td>" . $template["confirm_expire"] . "</td>";
		$html .= " <td><a href=\"javascript:;\" onclick=\"javascript:admin.editEmailTemplate('". $template["email_template_id"] ."');\">edit</a> | <a href=\"javascript:;\" onclick=\"javascript:admin.deleteEmailTemplate('". $template["email_template_id"] ."');\">delete</a>";

		$html .= "</tr>";

	}

	echo $html;

	?>
</table>

<!-- todo -->
<div id="opportunity_pagination" class="pagination"></div>