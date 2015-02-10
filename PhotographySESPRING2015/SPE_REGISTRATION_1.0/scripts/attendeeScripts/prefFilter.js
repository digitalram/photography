//Created By Lee Jones 4-9-14
// updated heavily on 4-11-14

//__________________________________________________________________
// filter selectboxes(Reviewers) based on selected checkboxes (Keywords & Opportunities)
function UpdateFilter()
{
  if (document.getElementById("filter").checked)
  {
    document.getElementById("filterLabel").innerHTML="filtering reviewers.<input type=\"checkbox\" id=\"filter\" name=\"filter\" checked onClick=\"UpdateFilter()\">"; // set filtering status label
    
    var attendee = document.getElementsByName("attendee");
    var userType;
    for (var i = 0; i < attendee.length; i++)
    {
      if (attendee[i].checked)
        userType = attendee[i].value;
    }
      


    // create arrays of kewords and opportunities to send for query    
  	var keywords = new Array();	                            // set an array with all active Keywords
  	dom = document.getElementsByClassName("keyword");
  	
    for(var i = 0; i< dom.length; i++)
  		if(dom[i].checked)
  			keywords.push(dom[i].value);
    
    var opportunity = new Array();                          // set an array with all active Opportunities
    dom = document.getElementsByClassName("opportunity");
    
    for(var i = 0; i< dom.length; i++)
      if(dom[i].checked)
        opportunity.push(dom[i].value);
    
    if (keywords.length==0 && opportunity.length==0)  // if no selectboxes checked revert to no filter
    {
      document.getElementById("filterFeedback").innerHTML="";
      RevertFilter();
    }
    else
    {
      // use jQuery to call FilterResults.php and return database query results in variable "data" 
      $(document).ready(function()
      {
        $.post("scripts/attendeeScripts/FilterResults.php", {'keywords[]' : keywords, 'opportunity[]' : opportunity, userType : userType}, function(data, success)
        {
          if (data)                                             // if query returned results
          {
            var revArray = data.split("|");                     //split returned string into an array
            revArray.reverse();                                 // reverse sort the array
            
            document.getElementById("filterFeedback").innerHTML="Your filter returned " + revArray.length + " reviewers. You may refine your filter in the below checkboxes or uncheck the checkbox above to show all reviewers.";

            for (var i = 1; i <= 20; i++)
            { 
                var dom = document.getElementById("preference" + i);    // set the dom object for which select box we are on

                if (dom.selectedIndex == 0)                     // empty the selecboxes that don't have a selection
                  dom.options.length=0;
          
                var tempArray = revArray.slice();              // copy the array for use in this iteration

                for (var j = 0; j <= revArray.length; j++)  // go through the temp array entering new data options
                {
                  var token = tempArray.pop();                 // get first element
                  if (token)                                   // if properly popped (the stack isn't empty)
                  {
                    if (dom.options.length==0 && j==0)         // if the selectbox was emptied, write over it
                    {
                      dom.options[j] = new Option ("Select preference", "default", true);   // set first option to default value
                      dom.options[j].disabled = true;
                      j++;                                      // make unselectable
                      dom.options[j] = new Option (token, token);                        // set first data option
                    }
                    else if (j==0)
                    {
                      //alert("error in selectbox population: 1");
                      break;
                    }
                    else if (j > 0)
                      dom.options[j] = new Option (token, token);                        // enter next data option
                    else
                      alert("error in selectbox population: 2");
                  }
                }
            }
          }
          else
          {
            //actually should put in only one entry in the selectbox that is "no results" and display a message saying that filter 
            // yeilded no results and that if you want to reset the filter click here or revise your selections, regardless, this 
            // function call needs to work right
            document.getElementById("filterFeedback").innerHTML="Your filter returned 0 results. Please refine your filter in the below checkboxes or uncheck the checkbox above to show all reviewers."
            EmptyFilter(); // otherwise the query returned no matches, unfilter the selectboxes
          }
        });
      });
    }
  }
  else
  {
    document.getElementById("filterFeedback").innerHTML="";
    document.getElementById("filterLabel").innerHTML="not filtering Reviewers.<input type=\"checkbox\" id=\"filter\" name=\"filter\" onClick=\"UpdateFilter()\">"; // set filtering status label
    RevertFilter();
  }
}

//__________________________________________________________________
// revert a filter to original values
function RevertFilter()
{
  $(document).ready(function()
  {
    $.post("scripts/attendeeScripts/RevertFilter.php", function(data, success)
    {
      if (data)                                             // if query returned results
      {
        var revArray = data.split("|");                     //split returned string into an array
        revArray.reverse();                                 // reverse sort the array
           
        for (var i = 1; i <= 20; i++)
        { 
            var dom = document.getElementById("preference" + i);    // set the dom object for which select box we are on

            if (dom.selectedIndex == 0)                     // empty the selecboxes that don't have a selection
              dom.options.length=0;
      
            var tempArray = revArray.slice();              // copy the array for use in this iteration
            for (var j = 0; j <= revArray.length; j++)  // go through the temp array entering new data options
            {

              var token = tempArray.pop();                 // get first element

              if (token)                                   // if properly popped (the stack isn't empty)
              {
                if (dom.options.length==0 && j==0)         // if the selectbox was emptied, write over it
                {
                  dom.options[j] = new Option ("Select preference", "default", true);   // set first option to default value
                  dom.options[j].disabled = true;                                      // make unselectable
                  j++;
                  dom.options[j] = new Option (token, token);                        // set first data option
                }
                else if (j==0)
                {
                  break;
                  //alert("error in selectbox population: 1");
                }
                else if (j > 0)
                  dom.options[j] = new Option (token, token);                        // enter next data option
                else
                  alert("error in selectbox population: 2");
              }
              else
              {
                alert("stack empty");
              }
            }
        }
      }
      else
      {
        alert("Error: No attending reviewers.");
      }
    });
  });
}

function EmptyFilter()
{
  for (var i = 1; i <= 20; i++)
  { 
    var dom = document.getElementById("preference" + i);    // set the dom object for which select box we are on

    if (dom.selectedIndex == 0)                     // empty the selecboxes that don't have a selection
      dom.options.length=0;

    dom.options[0] = new Option ("No results", "default", true);   // set first option to default value
    dom.options[0].disabled = true;
  }                                
                  
}


