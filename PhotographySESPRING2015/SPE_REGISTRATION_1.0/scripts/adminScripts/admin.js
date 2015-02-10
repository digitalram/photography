function SetRegPeriods()
{

	var revFrom = document.getElementById("revFrom").value;
	var revTo = document.getElementById("revTo").value;
	var attFrom = document.getElementById("attFrom").value;
	var attTo = document.getElementById("attTo").value;

	/*alert(revFrom);
	alert(revTo);
	alert(attFrom);
	alert(attTo);*/

	if (revFrom == '' || revTo =='' || attTo == '' || attFrom == '')
		alert("Please fill out all of the dates for the registration periods.");
	else
	{	
		$(document).ready(function()
      	{
        	$.post("scripts/adminScripts/SetRegPeriods.php", {revFrom : revFrom, revTo : revTo, attFrom : attFrom, attTo : attTo}, function(data, success)
    		{
    			alert("The registration periods have been changed.");
    			location.reload();
    		});
		});
	}
}

function ClearPeriods()
{
	if(confirm("This will clear the current registration periods.\n\nAre you sure you want to do this?"))
	{
		$(document).ready(function()
	  	{
	    	$.post("scripts/adminScripts/ClearPeriods.php", function(data, success)
			{
				location.reload();
			});
		});
	}
}

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


function ClearAttendees()
{
	if (confirm("This will remove all the students and professionals from the database.\nThis should only be done at the end of a convention after you have exported your files.\n\nAre you really sure you want to do this?"))
	{
		$(document).ready(function()
	  	{
	    	$.post("scripts/adminScripts/ClearAttendees.php", function(data, success)
	    	{
				alert("The attendees have been cleared from the database.");
			});
		});
	}
}


function AddKeyword()
{
	var keyword = document.getElementById("keyAdd").value;

	$(document).ready(function()
  	{
    	$.post("scripts/adminScripts/keyOppAddRem.php", {keyword : keyword, keyop : "keyword", flag : "add"}, function(data, success)
		{
			location.reload();
		});
	});
}

function AddOpportunity()
{
	var keyword = document.getElementById("oppAdd").value;

	$(document).ready(function()
  	{
    	$.post("scripts/adminScripts/keyOppAddRem.php", {keyword : keyword, keyop : "opportunity", flag : "add"}, function(data, success)
		{
			location.reload();
		});
	});
}

function RemKeyword()
{
	var keyword = document.getElementById("keyRem").value;

	$(document).ready(function()
  	{
    	$.post("scripts/adminScripts/keyOppAddRem.php", {keyword : keyword, keyop : "keyword", flag : "rem"}, function(data, success)
		{
			location.reload();
		});
	});
}

function RemOpportunity()
{
	var keyword = document.getElementById("oppRem").value;

	$(document).ready(function()
  	{
    	$.post("scripts/adminScripts/keyOppAddRem.php", {keyword : keyword, keyop : "opportunity", flag : "rem"}, function(data, success)
		{
			location.reload();
		});
	});
}