<?php
include("config.php"); // for sql connection ($con)
$serverRoot =  "http://" . $_SERVER['HTTP_HOST']  . dirname($_SERVER['PHP_SELF']); // path to url root directory


$year = date("Y");
$date = date("Y-m-d");

$query = "SELECT revFrom, revTo FROM REGISTRATION_PERIODS WHERE year = $year";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if (strtotime($date) < strtotime($row[revFrom]) || strtotime($row[revTo]) < strtotime($date))   // if not in registration period
    header("location: " . $serverRoot . "/notRegPeriod.php");                                              // redirect
else                                                                                            // else in current registration period
{           
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if(isset($_SESSION['username']))    // is a session started for the username?
    {
        if (isset($_COOKIE['user']))    // is a cookie set for the user?
        {     
            $username = $_SESSION['username'];
            $query = "SELECT * FROM REVIEWER WHERE Email = '$username'";
            $result = mysqli_query($con,$query) ;    // run the query
            $row = mysqli_fetch_array($result);

            mysqli_close($con);
        }
    }
    else{                                                                                       // if no valid session redirect
        header("location: " . $serverRoot . "/login.php"); // change to address on server
    }
}

?>

<!DOCTYPE html>
<head>
    <title>Reviewer Registration :: SPE</title>
    <link rel="icon" href="images/spe_Fav.ico" /> <!-- The icon in the browser tab -->
    <link type = "text/css" rel = "stylesheet" href = "style/photo.css" />
    
    <script type = "text/javascript" src = "scripts/reviewerScripts/reviewer.js">
    </script>
    <script type = "text/javascript" src = "scripts/reviewerScripts/revSelect.js">
    </script>	
</head>
<body>
	<a href="<a href=https://www.spenational.org/https://www.spenational.org/">
        <img src="https://www.spenational.org/images/logo.gif" class="auto-style1" title="Return to home page" width="92">
    </a>
	
	<div class="maintitle">Reviewer Registration</div>
    <form action = "scripts/reviewerScripts/InsertUpdateReviewer.php" method="post">
        <div class="container">
            <table>
                <tr>
                    <td><span style="float: left;"><input class="roundedClass" type = "text" id = "title" name = "title" placeholder="Title" value = "<?php echo $row[Title]; ?>" style="width:75px;"/></span></td>            
                </tr>
                <tr>
                    <td><input class="roundedClass" type = "text" id = "firstName" name="firstName" required="true" placeholder="First Name" value = "<?php echo $row[Fname]; ?>" /></td> 
                    <td><input class="roundedClass" type = "text" id = "lastName" name="lastName" required="true" placeholder="Last Name" value = "<?php echo $row[Lname]; ?>" /></td>
                </tr>
                <tr>
                    <td><input class="roundedClass" type = "text" id = "email" name="email" required="true" oninput="checkEmail(this)" placeholder="Email Address" value = "<?php echo $row[Email]; ?>" /></td>
                    <td><input class="roundedClass" type = "text" id = "phoneNumber" name="phoneNumber" oninput="checkPhone(this)" required="true" placeholder="Phone Number" value = "<?php echo $row[Phone]; ?>" /></td>
                </tr>
                <tr>
                    <td><input class="roundedClass" type = "text" id = "institution" name = "institution" placeholder="Instutution" value = "<?php echo $row[Instit]; ?>" /></td>
                    <td><input class="roundedClass" type = "text" id = "website" name = "website" placeholder="Website" value = "<?php echo $row[Website]; ?>" /></td>
                </tr>
                <tr>
                    <td><input class="roundedClass" type = "text" id = "address1" name="address1" required="true" placeholder="Address 1" value = "<?php echo $row[Addr1]; ?>" /></td>
                    <td><input class="roundedClass" type = "text" id = "address2" name="address2" placeholder="Address 2" value = "<?php echo $row[Addr2]; ?>" /></td>                
                </tr>
                <tr>
                    <td><input class="roundedClass" type = "text" id = "city" name="city" required="true" placeholder="City" value = "<?php echo $row[City]; ?>" /></td>
                    <td><select class="roundedClass" id="state" name="state" required="true" style="width:100%;" onchange="SelectColor()">
                        <option value=<?php if ($row[State]!= ""){echo $row[State];}else{echo "";}?> selected <?php if($row[State]==""){echo " disabled";}?> > <?php if($row[State]!=""){echo $row[State];}else{echo "Select State";} ?></option>
                        <option value="AL">AL</option>
                        <option value="AK">AK</option>
                        <option value="AZ">AZ</option>
                        <option value="AR">AR</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DE">DE</option>
                        <option value="DC">DC</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="IA">IA</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="ME">ME</option>
                        <option value="MD">MD</option>
                        <option value="MA">MA</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MS">MS</option>
                        <option value="MO">MO</option>
                        <option value="MT">MT</option>
                        <option value="NE">NE</option>
                        <option value="NV">NV</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NY">NY</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VT">VT</option>
                        <option value="VA">VA</option>
                        <option value="WA">WA</option>
                        <option value="WV">WV</option>
                        <option value="WI">WI</option>
                        <option value="WY">WY</option>
                    </select></td>
                </tr>
                <tr>
                    <td><input class="roundedClass" type = "text" id = "zip" name="zip" required="true" placeholder="Zip Code" value = "<?php echo $row[Zip]; ?>" /></td>
                    <td><input class="roundedClass" type = "text" id = "country" name = "country" required="true" placeholder="Country" value = "<?php if ($row[Country] != ""){echo $row[Country];}else{echo "United States";} ?>" /><td>
                </tr>
            </table>
        </div>
        <div class="container">
            <div class="title">SPE Membership Level : </div>
            <input type = "radio" name = "membership" value = "sustaining" required="true" <?php echo ($row[Membership] == "sustaining") ? 'checked' : ''; ?> />Sustaining
            <input type = "radio" name = "membership" value = "regular" required="true" <?php echo ($row[Membership] == "regular") ? 'checked' : ''; ?> />Regular
            <input type = "radio" name = "membership" value = "adpt" required="true" <?php echo ($row[Membership] == "adpt") ? 'checked' : ''; ?> />Adjunct/Part-Time
            <input type = "radio" name = "membership" value = "senior" required="true" <?php echo ($row[Membership] == "senior") ? 'checked' : ''; ?> />Senior
            <input type = "radio" name = "membership" value = "student" required="true" <?php echo ($row[Membership] == "student") ? 'checked' : ''; ?> />Student
        </div> 
        <div class="container">
            <div class="title">Do you need a fee waiver?</div>
            <input type = "radio" name = "fee" value = "1" required="true" />Yes
            <input type = "radio" name = "fee" value = "0" required="true" />No
        </div>       
        <div class="container">
            <div class="title">What session(s) would you like to sign up for? (Check all that apply)</div>
            <table>
                <tr>
                    <td>Student Work:</td>
                    <td>Professional Work:</td>
                </tr>
                <tr>
                    <td class="left"><input type = "checkbox" name = "time[]" value = "fri1" <?php echo ($row[D1Morning]) ? 'checked' : ''; ?> />Fri : 9 - 11</td>
                    <td class="left"><input type = "checkbox" name = "time[]" value = "sat1" <?php echo ($row[D2Morning]) ? 'checked' : ''; ?> />Sat : 9 - 11</td>
                </tr>
                <tr>
                    <td class="left"><input type = "checkbox" name = "time[]" value = "fri2" <?php echo ($row[D1Midday]) ? 'checked' : ''; ?> />Fri : 11:15 - 1:15</td>
                    <td class="left"><input type = "checkbox" name = "time[]" value = "sat2" <?php echo ($row[D2Midday]) ? 'checked' : ''; ?> />Sat : 11:15 - 1:15</td>
                </tr>
                <tr>
                    <td class="left"><input type = "checkbox" name = "time[]" value = "fri3" <?php echo ($row[D1Afternoon]) ? 'checked' : ''; ?> />Fri : 1:30 - 3:30</td>
                    <td class="left"><input type = "checkbox" name = "time[]" value = "sat3" <?php echo ($row[D2Afternoon]) ? 'checked' : ''; ?> />Sat : 1:30 - 2:50</td>
                </tr>
            </table>
        </div>
        <div class="container">
            <center><?php include("scripts/reviewerScripts/keywordReviewer.php"); ?></center>
        </div>
        <div class="container">
            <center><?php include("scripts/reviewerScripts/revOpportunities.php"); ?></center>
        </div>
        <div class="container">
            <center><label><div class="title">Area for general comments/questions</div></label><br />
            <textarea class="roundedClass" name="comments" rows = "5" cols = "60"></textarea>
        </div>
        <table>
            <tr>
                <center>
                    <td><input class="roundedClass" type = "reset" value = "Reset" style="width: 75px;"></td>
                    <td><input class="roundedClass" type = "submit" value = "Submit" style="width: 75px;"></td>
                    <td><a href="scripts/loginScripts/logout.php">Logout</a></td>
                </center>
            </tr>
        </table>
    </form>

    <script type = "text/javascript" src = "scripts/reviewerScripts/reviewerr.js" ></script>
<?php //mysqli_close($con); ?>
</body>
