// TODO: remove this function; keep here for now for referencing.
function ExportDatabase()
{
	$(document).ready(function()
	{
		$.post("scripts/adminScripts/FridayAttendeeExport.php");
		$.post("scripts/adminScripts/SaturdayAttendeeExport.php");
		$.post("scripts/adminScripts/FridayReviewerExport.php");
		$.post("scripts/adminScripts/SaturdayReviewerExport.php");
		$.post("scripts/adminScripts/OutputReviewers.php", function(data,success)
    	{
    		if (success)
    		{
    			alert("the data has been saved to the server.");
    			location.reload();
			}
    	});
    });
}


var admin = {

	createSchedule: function() {
	
		/* Disable create schedule button after pressing */
		$("#btnCreateSchedule").prop("value", "Please wait...");
		$("#btnCreateSchedule").prop("disabled", true);
		
		/* Creation of schedule enables Publish and Clear Buttons */
		$("#btnPublishSchedule").prop("disabled", false);
		$("#btnClearAttendees").prop("disabled", false);

		$.post("scripts/general/createSchedule.php", {}, function(json) {
			
			/* Grab any data returned from function(json) call */
			var data = $.parseJSON(json);

			/* Display some statistics / messages */
			alert(data.status );
		});

	},
	
	/* Clears current registration year schedule */
	clearSchedule: function() {
		if(confirm("This will clear the current generated schedule.\n\nAre you sure you want to clear the schedule?"))
		{
			/* Disable create schedule button after pressing */
			$("#btnClearAttendees").prop("value", "Please wait...");
			$("#btnClearAttendees").prop("disabled", true);
			
			/* Clearing Schedule re-enables Create Schedule Button */
			$("#btnCreateSchedule").prop("disabled", false); 

			/* Wipe them out... all of them */
			$.post("scripts/general/clearSchedule.php", {}, function(json) {
			
				/* Grab any data returned from function(json) call */
				var data = $.parseJSON(json);
				
				/* Display some statistics / messages */
				alert("Schedule cleared " + data.count + " session entries.\n" + data.status);
			});
		}
		
	},
	
	/* Publishes current registration year's schedule for all to view */
	publishSchedule: function() {
		if(confirm("Publishing Schedule will make the schedule active to all users.\n\nAre you sure you would like to publish?"))
		{
			/* Disable publish schedule button after pressing */
			$("#btnPublishSchedule").prop("value", "Please wait...");
			$("#btnPublishSchedule").prop("disabled", true);
			
			/* Enable Clear Schedule Button after pressing */
			$("#btnClearAttendees").prop("disabled", false);

			/* Flag this thing published */
			$.post("scripts/general/publishSchedule.php", {}, function(json) {
			
				/* Grab any data returned from function(json) call */
				var data = $.parseJSON(json);
				
				/* Display some statistics / messages */
				alert(data.status);
			});
		}
		
	},

	setMaxTables: function() {

		var tables = $("#max_tables").val();

		var data = {
			max_tables: tables
		};

		$.post("scripts/general/saveMaxTables.php", data, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				$("#tdMaxTables").html(tables);
			} else {
				alert(result.status);
			}
		});

	},

	getMaxTables: function() {
		$.post("scripts/general/getMaxTables.php", {}, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				var maxTables = result.data;

				$("#tdMaxTables").html(maxTables);
				$("#max_tables").val(maxTables);
			}
		});

	},

	/* Set 'attendees_match_limit' column in 'registration_periods' table */
	setMaxAttendees: function() {
		/* Get data from form post */
		var attendees = $("#max_attendees").val();

		var data = {
			/* Column Name: Value */
			attendees_match_limit: attendees
		};

		$.post("scripts/general/saveMaxAttendees.php", data, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				$("#tdMaxAttendees").html(attendees);
			} else {
				alert(result.status);
			}
		});

	},	
	
	getMaxAttendees: function() {
		$.post("scripts/general/getMaxAttendees.php", {}, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				var maxAttendees = result.data;

				$("#tdMaxAttendees").html(maxAttendees);
				$("#max_attendees").val(maxAttendees);
			}
		});

	},	
	
	/* Set 'short_saturdays' column in 'registration_periods' table */
	setShortSaturdays: function() {

		/* Get data from form post */
		var saturdayStatus = $("#short_sats").val();

		var data = {
			/* Column Name: Value */
			short_saturdays: saturdayStatus
		};

		$.post("scripts/general/saveShortSaturdays.php", data, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				$("#tdShortSaturdays").html(saturdayStatus);
			} else {
				alert(result.status);
			}
		});

	},		
	
	
	
	
	clearPeriods: function() {

		if(confirm("This will clear the current registration periods.\n\nAre you sure you want to do this?"))
		{
			$(document).ready(function()
			{
				$.post("scripts/ClearPeriods.php", function(data, success)
				{
					location.reload();
				});
			});
		}

	},

	setPeriods: function() {

		var revFrom = document.getElementById("revFrom").value;
		var revTo = document.getElementById("revTo").value;
		var attFrom = document.getElementById("attFrom").value;
		var attTo = document.getElementById("attTo").value;

		if (revFrom == '' || revTo =='' || attTo == '' || attFrom == '') {
			alert("Please fill out all of the dates for the registration periods.");
		} else {
			$(function() {

				var data = {
					revFrom : revFrom,
					revTo : revTo,
					attFrom : attFrom,
					attTo : attTo
				};

				$.post("scripts/SetRegPeriods.php", data, function(data, success) {
					alert("The registration periods have been changed.");
				});

			});
		}

	},

	attendeeSearch: function(query, currentPage, resultsPerPage, regPeriodId) {

		var data = {
			search: query,
			page: currentPage,
			perPage: resultsPerPage,
			registrationPeriodId: regPeriodId
		};

		$.post("scripts/attendee/attendeeSearch.php", data).done(function(data) {

			// remove all table rows
			$("#attendees").find("tr:gt(0)").remove();

			// convert data to JSON
			var data = $.parseJSON(data);

			// basics
			var total = data.total;
			var attendees = data.data;

			// loop through data
			if(attendees.length) {
				$.each(attendees, function(i, attendee) {
					var firstName = attendee.first_name,
						lastName = attendee.last_name,
						emailAddr = attendee.email_address,
						userType = attendee.attendee_type,
						attendeeId = attendee.attendee_id,
						regPeriod = attendee.year,
						regPeriodId = attendee.registration_period_id,
						reviewer = attendee.reviewer;

					if(reviewer == null) {
						reviewer = "N/A";
					}

					if(regPeriod == null) {
						regPeriod = "N/A";
					}

					userType += '';
					userType = userType.charAt(0).toUpperCase() + userType.substr(1);

					// append to table
					$('#attendees tr:last').after(
						'<tr id="attendee_row_'+ attendeeId +'" style="background-color: '+ ((i % 2 == 0) ? '#888' : '#666') +' !important;">' +
							'<td>' + firstName + ' ' + lastName + '</td>' +
							'<td>' + emailAddr + '</td>' +
							'<td>' + userType + '</td>' +
							'<td>' + regPeriod + '</td>' +
							'<td>' + reviewer + '</td>' +
							'<td><a href="javascript:;" onclick="javascript:admin.deleteAttendee('+ attendeeId +', '+ regPeriodId +');">remove</a></td>' +
						'</tr>'
					);

					// pagination
					var totalPages = Math.ceil(total / resultsPerPage);
					var html = '';

					for(var i = 1; i <= totalPages; i++) {
						if(i != currentPage) {
							html += ' <a href="javascript:;" onclick="admin.attendeeSearch(\''+ query +'\', \''+ i +'\', \''+ resultsPerPage +'\', \''+ regPeriodId +'\');">'+ i +'</a> ';
						} else {
							html += ' '+ i + ' ';
						}
					}

					$("#attendee_pagination").html(html);

				});
			} else {
				$('#attendees tr:last').after(
					'<tr>' +
						'<td colspan="5">There are no attendees.</td>' +
					'</tr>'
				);
			}

		});

	},

	reviewerSearch: function(query, currentPage, resultsPerPage, regPeriodId) {

		var data = {
			search: query,
			page: currentPage,
			perPage: resultsPerPage,
			registrationPeriodId: regPeriodId
		};

		$.post("scripts/reviewer/reviewerSearch.php", data).done(function(data) {

			// remove all table rows
			$("#reviewers").find("tr:gt(0)").remove();

			// convert data to JSON
			var data = $.parseJSON(data);

			// basics
			var total = data.total;
			var attendees = data.data;

			// loop through data
			if(attendees.length) {
				$.each(attendees, function(i, reviewer) {
					var firstName = reviewer.first_name,
						lastName = reviewer.last_name,
						emailAddr = reviewer.email_address,
						reviewerId = reviewer.reviewer_id,
						regPeriod = reviewer.year,
						regPeriodId = reviewer.registration_period_id,
						tableNum = reviewer.table_num,
						fridayMorning = admin.evalCheck(reviewer.friday_morning),
						fridayMidday = admin.evalCheck(reviewer.friday_midday),
						fridayAfternoon = admin.evalCheck(reviewer.friday_afternoon),
						satMorning = admin.evalCheck(reviewer.saturday_morning),
						satMidday = admin.evalCheck(reviewer.saturday_midday),
						satAfternoon = admin.evalCheck(reviewer.saturday_afternoon);

					if(regPeriod == null) {
						regPeriod = "N/A";
					}

					if(tableNum == null) {
						tableNum = "N/A";
					}

					// append to table
					$('#reviewers tr:last').after(
						'<tr id="reviewer_row_'+ reviewerId +'" style="background-color: '+ ((i % 2 == 0) ? '#888' : '#666') +' !important;">' +
							'<td>' + firstName + ' ' + lastName + '</td>' +
							'<td>' + emailAddr + '</td>' +
							'<td>' + regPeriod + '</td>' +
							'<td>' + tableNum + '</td>' +
							'<td>' + fridayMorning + '</td>' +
							'<td>' + fridayMidday + '</td>' +
							'<td>' + fridayAfternoon + '</td>' +
							'<td>' + satMorning + '</td>' +
							'<td>' + satMidday + '</td>' +
							'<td>' + satAfternoon + '</td>' +
							'<td><a href="javascript:;" onclick="javascript:admin.deleteReviewer('+ reviewerId +', '+ regPeriodId +');">remove</a></td>' +
						'</tr>'
					);

					// pagination
					var totalPages = Math.ceil(total / resultsPerPage);
					var html = '';

					for(var i = 1; i <= totalPages; i++) {
						if(i != currentPage) {
							html += ' <a href="javascript:;" onclick="admin.reviewerSearch(\''+ query +'\', \''+ i +'\', \''+ resultsPerPage +'\', \''+ regPeriodId +'\');">'+ i +'</a> ';
						} else {
							html += ' '+ i + ' ';
						}
					}

					$("#reviewer_pagination").html(html);

				});
			} else {
				$('#reviewers tr:last').after(
					'<tr>' +
						'<td colspan="5">There are no reviewers.</td>' +
					'</tr>'
				);
			}

		});

	},

	deleteReviewer: function(reviewerId, regPeriodId) {

		if(!regPeriodId) {
			alert(
				"Cannot remove reviewer from this entry due to no associated registration period." +
				"\n\nNote: Reviewers (some may be repeated per row, due to their registration period [scheduled year]) can " +
				"only be deleted if they are on a schedule, which is related to the associated registration period."
			);

			return;
		}

		if(!confirm("Are you sure you want to remove this reviewer from the schedule?")) {
			return;
		}

		var data = {
			registrationPeriodId: regPeriodId,
			reviewerId: reviewerId
		};

		$.post("scripts/reviewer/removeReviewer.php", data, function(json) {
			var result = $.parseJSON(json);
			
			/* Now working properly */
			alert("Successfully deleted " + result.name + ":"  + result.counter + " attendees displaced.\n" + result.debug + "\n");

			if(result.status == "success") {
				$("tr#reviewer_row_" + reviewerId).find("td").each(function(i, td) {
					$(td).css({
						backgroundColor: "#ff0000",
						padding: "0px"
					});

					$(td).fadeOut(1000, function(here) {
						var tr = $(here).parents('tr:first');

						$(tr).css({
							padding: "0px",
							margin: "0px"
						});

						$(tr).remove();
					});
				});
			}
		});

	},

	deleteAttendee: function(attendeeId, regPeriodId) {

		if(!regPeriodId) {
			alert(
				"Cannot remove attendee from this entry due to no associated registration period." +
					"\n\nNote: Attendee (some may be repeated per row, due to their registration period [scheduled year]) can " +
					"only be deleted if they are on a schedule, which is related to the associated registration period."
			);

			return;
		}

		if(!confirm("Are you sure you want to remove this attendee from the schedule?")) {
			return;
		}

		var data = {
			registrationPeriodId: regPeriodId,
			attendeeId: attendeeId
		};

		$.post("scripts/attendee/removeAttendee.php", data, function(json) {
			var result = $.parseJSON(json);
			
			/* Now working properly */
			alert("Successfully deleted " + result.name + " from " + result.counter + " tables.\n");

			/* Fancy fade-out effect on current listed table */
			if(result.status == "success") {
				$("tr#attendee_row_" + attendeeId).find("td").each(function(i, td) {
					$(td).css({
						backgroundColor: "#ff0000",
						padding: "0px"
					});

					$(td).fadeOut(1000, function(here) {
						var tr = $(here).parents('tr:first');

						$(tr).css({
							padding: "0px",
							margin: "0px"
						});

						$(tr).remove();
					});
				});
			}
		});

	},

	evalCheck: function(input) {
		return (input == 'x') ? 'Yes' : 'No';
	},

	saveKeyword: function(keywordDefinitionId) {

		var keywordText = $("input#keyword_text_" + keywordDefinitionId).val();

		var data = {
			keywordDefinitionId: keywordDefinitionId,
			name: keywordText
		};

		$.post("scripts/keyword/saveKeyword.php", data, function(json) {
			var ret = $.parseJSON(json);

			if(ret.status == "success") {
				alert("Keyword successfully updated!");

				$("td#keyword_definition_" + keywordDefinitionId).html(keywordText);
			}
		});

	},

	editKeyword: function(keywordDefinitionId, state) {

		var cell = $("td#keyword_definition_" + keywordDefinitionId);

		var keywordText = $("input#keyword_text_"+keywordDefinitionId).val() || cell.html();

		switch(state) {
			case "edit":
			default:
				var html = '<input type="text" value="'+ keywordText +'" id="keyword_text_'+ keywordDefinitionId +'" /> ' +
					'<input type="button" value="Cancel" onclick="javascript:admin.editKeyword(\''+ keywordDefinitionId +'\', \'cancel\');" /> ' +
					'<input type="button" value="Save" onclick="javascript:admin.saveKeyword(\''+ keywordDefinitionId +'\');" />';

				cell.html(html);
				break;

			case "cancel":
				cell.html(keywordText);
				break;
		}

	},

	addKeyword: function() {

		var newKeyword = $("input#new_keyword").val();

		var data = {
			name: newKeyword
		};

		$.post("scripts/keyword/addKeyword.php", data, function(json) {
			var ret = $.parseJSON(json);

			if(ret.status == "success") {
				alert("New keyword added!");
				window.location = "index.php#tabs-6";
				if(window.location.hash != "") {
					window.location.reload();
				}
			}
		});

	},

	deleteKeyword: function(keywordDefinitionId) {

		var msg = "Warning: This will remove all keyword relationships with attendees and reviewers" +
			"- meaning, attendees or reviewers that have chosen this keyword, will no longer have" +
			"this keyword associated with them.\n\nAre you sure you want to delete this keyword?";

		if(confirm(msg)) {

			var data = {
				keywordDefinitionId: keywordDefinitionId
			};

			$.post("scripts/keyword/deleteKeyword.php", data, function(json) {

				var ret = $.parseJSON(json);

				if(ret.status == "success") {
					$("tr#keyword_definition_row_" + keywordDefinitionId).find("td").each(function(i, td) {
						$(td).css({
							backgroundColor: "#ff0000",
							padding: "0px"
						});

						$(td).fadeOut(1000, function(here) {
							var tr = $(here).parents('tr:first');

							$(tr).css({
								padding: "0px",
								margin: "0px"
							});

							$(tr).remove();
						});
					});
				}

			});

		}

	},

	saveOpportunity: function(definitionId) {

		var oppText = $("input#opportunity_text_" + definitionId).val();

		var data = {
			opportunityDefinitionId: definitionId,
			name: oppText
		};

		$.post("scripts/opportunity/saveOpportunity.php", data, function(json) {
			var ret = $.parseJSON(json);

			if(ret.status == "success") {
				alert("Opportunity successfully updated!");

				$("td#opportunity_definition_" + definitionId).html(oppText);
			}
		});

	},

	editOpportunity: function(definitionId, state) {

		var cell = $("td#opportunity_definition_" + definitionId);

		var oppText = $("input#opportunity_text_"+definitionId).val() || cell.html();

		switch(state) {
			case "edit":
			default:
				var html = '<input type="text" value="'+ oppText +'" id="opportunity_text_'+ definitionId +'" /> ' +
					'<input type="button" value="Cancel" onclick="javascript:admin.editOpportunity(\''+ definitionId +'\', \'cancel\');" /> ' +
					'<input type="button" value="Save" onclick="javascript:admin.saveOpportunity(\''+ definitionId +'\');" />';

				cell.html(html);
				break;

			case "cancel":
				cell.html(oppText);
				break;
		}

	},

	addOpportunity: function() {

		var newOpportunity = $("input#new_opportunity").val();

		var data = {
			name: newOpportunity
		};

		$.post("scripts/opportunity/addOpportunity.php", data, function(json) {
			var ret = $.parseJSON(json);

			if(ret.status == "success") {
				alert("New opportunity added!");
				window.location = "index.php#tabs-7";
				if(window.location.hash != "") {
					window.location.reload();
				}
			}
		});

	},

	deleteOpportunity: function(definitionId) {

		var msg = "Warning: This will remove all opportunity relationships with attendees and reviewers" +
			"- meaning, attendees or reviewers that have chosen this opportunity, will no longer have" +
			"this opportunity associated with them.\n\nAre you sure you want to delete this opportunity?";

		if(confirm(msg)) {

			var data = {
				opportunityDefinitionId: definitionId
			};

			$.post("scripts/opportunity/deleteOpportunity.php", data, function(json) {

				var ret = $.parseJSON(json);

				if(ret.status == "success") {
					$("tr#opportunity_definition_row_" + definitionId).find("td").each(function(i, td) {
						$(td).css({
							backgroundColor: "#ff0000",
							padding: "0px"
						});

						$(td).fadeOut(1000, function(here) {
							var tr = $(here).parents('tr:first');

							$(tr).css({
								padding: "0px",
								margin: "0px"
							});

							$(tr).remove();
						});
					});
				}

			});

		}

	},

	addEmailTemplate: function() {

		var data = {
			identifier: $("input#identifier").val(),
			subject: $("input#subject").val(),
			message: $("textarea#message").val(),
			useConfirmationCode: $("select#use_confirmation_code").val(),
			confirmExpire: $("input#confirm_expire").val()
		};

		$.post("scripts/email/addEmailTemplate.php", data, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				// alert
				alert("Template added successfully!");

				// clear values
				$("input#identifier").val('');
				$("input#subject").val('');
				$("textarea#message").val('');
				$("select#use_confirmation_code").val('');
				$("input#confirm_expire").val('');
				$("input#template_id").val('');
			}
		});

	},

	editEmailTemplate: function(templateId) {

		// aesthetics
		$("form#template_form").show();
		$("input#template_button").val("Save");
		$("input#cancel_button").show();

		// basics
		var data = {
			emailTemplateId: templateId
		};

		// load
		$.post("scripts/email/getEmailTemplate.php", data, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				var data = result.data;

				// set fields
				$("input#identifier").val(data.identifier);
				$("input#subject").val(data.subject);
				$("textarea#message").val(data.message);
				$("select#use_confirmation_code").val(data["use_confirmation_code"]);
				$("input#confirm_expire").val(data["confirm_expire"]);
				$("input#template_id").val(templateId);
			}
		});

	},

	saveEmailTemplate: function() {

		var templateId = $("input#template_id").val();

		if(templateId == "") {
			admin.addEmailTemplate();
			return;
		}

		var data = {
			emailTemplateId: templateId,
			identifier: $("input#identifier").val(),
			subject: $("input#subject").val(),
			message: $("textarea#message").val(),
			useConfirmationCode: $("select#use_confirmation_code").val(),
			confirmExpire: $("input#confirm_expire").val()
		};

		$.post("scripts/email/saveEmailTemplate.php", data, function(json) {
			var result = $.parseJSON(json);

			if(result.status == "success") {
				// alert
				alert("Template saved successfully!");

				// clear values
				$("input#identifier").val('');
				$("input#subject").val('');
				$("textarea#message").val('');
				$("select#use_confirmation_code").val('');
				$("input#confirm_expire").val('');
				$("input#template_id").val('');

				// reset button
				$("input#template_button").val("Add");
			}
		});

	},

	cancelEditTemplate: function() {

		// clear values
		$("input#identifier").val('');
		$("input#subject").val('');
		$("textarea#message").val('');
		$("select#use_confirmation_code").val('');
		$("input#confirm_expire").val('');
		$("input#template_id").val('');

		// reset button
		$("input#cancel_button").hide();
		$("input#template_button").val("Add");

	},

	deleteEmailTemplate: function(templateId) {

		if(confirm("Are you sure you want to delete this e-mail template?")) {
			var data = {
				emailTemplateId: templateId
			};

			$.post("scripts/email/deleteEmailTemplate.php", data, function(json) {
				var result = $.parseJSON(json);

				if(result.status == "success") {
					$("tr#email_template_row_" + templateId).find("td").each(function(i, td) {
						$(td).css({
							backgroundColor: "#ff0000",
							padding: "0px"
						});

						$(td).fadeOut(1000, function(here) {
							var tr = $(here).parents('tr:first');

							$(tr).css({
								padding: "0px",
								margin: "0px"
							});

							$(tr).remove();
						});
					});
				}
			});
		}

	}

};