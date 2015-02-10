<!DOCTYPE html>
<html>
  <head>
    <title>SPE National Photograph Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css"/>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $("button").click(function(){
        $.ajax({url:"csvimport.php",success:function(result){
        $("#div1").html(result);
        }});
        });
    });
</script>

<script>
$(document).ready(function(){
    $("button").disabled = false;
    $(document).on('click','button',function(){
        this.disabled = true
    })
})
</script>
    <script type="text/javascript">
        function initUpload() {

            /*set the target of the form to the iframe and display the status
             message on form submit.
             */
            document.getElementById('uploadform').onsubmit=function() {
                document.getElementById('uploadform').target = 'target_iframe';
                document.getElementById('status').style.display="block";

            }

            document.getElementById('uploadform2').onsubmit=function() {
                document.getElementById('uploadform2').target = 'target_iframe2';
                document.getElementById('status2').style.display="block";

            }

            document.getElementById('uploadform3').onsubmit=function() {
                document.getElementById('uploadform3').target = 'target_iframe3';
                document.getElementById('status3').style.display="block";

            }

            document.getElementById('uploadform4').onsubmit=function() {
                document.getElementById('uploadform4').target = 'target_iframe4';
                document.getElementById('status4').style.display="block";

            }        

        }

        //This function will be called when the upload completes for friday reviers.
        function uploadComplete(status){
            //set the status message to that returned by the server
            document.getElementById('status').innerHTML=status;
        }
        //This function will be called when the upload completes for saturday attendees.
        function uploadComplete2(status2){
            //set the status message to that returned by the server
            document.getElementById('status2').innerHTML=status2;
        }

        //This function will be called when the upload completes for reviewers.
        function uploadComplete3(status3){
            //set the status message to that returned by the server
            document.getElementById('status3').innerHTML=status3;
        }

        //This function will be called when the upload completes for reviewers.
        function uploadComplete4(status4){
            //set the status message to that returned by the server
            document.getElementById('status4').innerHTML=status4;
        }



        window.onload=initUpload;
    </script>

  </head>
  <body>
   <div id="top_header">
	<header>
		<h1>spe<span>administration</span></h1>
	</header>
 <nav id="top_nav">   
<ul>
    <li class="active"><a href="#">Home</a></li>
    <li><a href="reviewschedule.php">Review Schedule</a></li>
    <li><a href="backup.php">Backup Schedule DB</a></li>
    <li><a href="register.php">Add User</a></li>
	<li><a href="editusers.php">Edit User</a></li>
    <li><a href="index.php?logout">Logout</a></li>
</ul>
</nav> 
</div>  

<div id="froms">
      <form id="uploadform" method="post"
          enctype="multipart/form-data"
          action="uploadform.php">

        <p><strong>Select file containing friday attendees.</strong></p>
        <input name="file" id="file" size="27" type="file" /><br />
        <input type="submit" name="action" value="Upload" class="button"/>
        <span id="status" style="display:none">uploading...</span>
        <iframe id="target_iframe" name="target_iframe" src="" style="width:0;height:0;border:0px"></iframe>

    </form>

    <br><br>

    <form id="uploadform2" method="post"
          enctype="multipart/form-data"
          action="uploadform2.php">

        <p><strong>Select file containing saturday attendees.</strong></p>
        <input name="file2" id="file2" size="27" type="file" /><br />
        <input type="submit" name="action" value="Upload" class="button"/>
        <span id="status2" style="display:none">uploading...</span>
        <iframe id="target_iframe2" name="target_iframe2" src="" style="width:0;height:0;border:0px"></iframe>

    </form>

    <br><br>

    <form id="uploadform3" method="post"
          enctype="multipart/form-data"
          action="uploadform3.php">

        <p><strong></span>Select file containing fridays reviewers.</strong></p>
        <input name="file3" id="file3" size="27" type="file" /><br />
        <input type="submit" name="action" value="Upload" class="button"/>
        <span id="status3" style="display:none">uploading...</span>
        <iframe id="target_iframe3" name="target_iframe3" src="" style="width:0;height:0;border:0px"></iframe>

    </form>

    <br><br>
 

    <form id="uploadform4" method="post"
          enctype="multipart/form-data"
          action="uploadform4.php">

        <p><strong></span>Select file containing  saturdays reviewers.</strong></p>
        <input name="file4" id="file4" size="27" type="file" /><br />
        <input type="submit" name="action" value="Upload" class="button"/>
        <span id="status4" style="display:none">uploading...</span>
        <iframe id="target_iframe4" name="target_iframe4" src="" style="width:0;height:0;border:0px"></iframe>

    </form>

    <br><br>   

    <div id="div1"><h2></h2></div>
    <button >Create Schedule</button>

    </div>

  </body>
</html>