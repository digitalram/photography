<?php
    require_once "bootstrap.php";
	
    framework::includeScript("reviewer", "js", "reviewer");
    framework::includeScript("reviewer", "js", "revSelect");
	framework::includeScript("reviewer", "js", "reviewerr");
	framework::includeSCript("reviewer", "php", "insertUpdateReviewer"); 
?>

<div class="maintitle">Reviewer Registration</div>
    <form method="post">
    <div class="container">
       <table>
            <tr>
                <td>
                    <span style="float: left;">
                    <select class="roundedClass" id = "title" name = "title" style="width:75px;" onchange="SelectColor()" >
                        <option value="Title" selected  disabled > Title </option>
                        <option value=“”>  </option>
                        <option value=“Dr”> Dr </option>
                        <option value=“Ms”> Ms </option>
                        <option value=“Mrs”> Mrs </option>
                        <option value=“Mr”> Mr </option>
                    </select>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedClass" type = "text" id = "firstName" name="firstName" required="true" placeholder="First Name" />
                </td>
                <td>
                    <input class="roundedClass" type = "text" id = "lastName" name="lastName" required="true" placeholder="Last Name" />
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedClass" type = "text" id = "email" name="email" required="true" oninput="checkEmail(this)" placeholder="Email Address"  />
                </td>
                <td>
                    <input class="roundedClass" type = "text" id = "phoneNumber" name="phoneNumber" oninput="checkPhone(this)" required="true" placeholder="Phone Number"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedClass" type = "text" id = "institution" name = "institution" placeholder="Instutution" />
                </td>
                <td>
                    <input class="roundedClass" type = "text" id = "website" name = "website" placeholder="Website" />
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedClass" type = "text" id = "address1" name="address1" required="true" placeholder="Address 1" />
                </td>
                <td>
                    <input class="roundedClass" type = "text" id = "address2" name="address2" placeholder="Address 2" />
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedClass" type = "text" id = "city" name="city" required="true" placeholder="City" />
                </td>
                <td>
                    <select class="roundedClass" id="state" name="state" required="true" style="width:100%;" onchange="SelectColor()">
                        <option value ="Select State" selected disabled>Select State</option>
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
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input class="roundedClass" type = "text" id = "zip" name="zip" required="true" placeholder="Zip Code" />
            </td>
            <td>
                <input class="roundedClass" type = "text" id = "country" name = "country" required="true" placeholder="Country" value = "United States" />
            <td>
            </tr>
    </table>
    </div>
    <div class="container">
        <div class="title">SPE Membership Level : </div>
            <input type = "radio" name = "membership" value = "sustaining" required="true" />Sustaining
            <input type = "radio" name = "membership" value = "regular" required="true" />Regular
            <input type = "radio" name = "membership" value = "adpt" required="true" />Adjunct/Part-Time
            <input type = "radio" name = "membership" value = "senior" required="true" />Senior
            <input type = "radio" name = "membership" value = "non-member" required="true" />Non-Member
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
                    <td class="left"><input type = "checkbox" name = "timeSlot[friday_morning]" id = "friday_morning" value = "friday_morning" />Fri : 9 - 11</td>
                    <td class="left"><input type = "checkbox" name = "timeSlot[saturday_morning]" id = "saturday_morning" value = "saturday_morning" />Sat : 9 - 11</td>
                </tr>
                <tr>
                    <td class="left"><input type = "checkbox" name = "timeSlot[friday_midday]" id = "friday_midday" value = "friday_midday" />Fri : 11:15 - 1:15</td>
                    <td class="left"><input type = "checkbox" name = "timeSlot[saturday_midday]" id = "saturday_midday" value = "saturday_midday" />Sat : 11:15 - 1:15</td>
                </tr>
                <tr>
                    <td class="left"><input type = "checkbox" name = "timeSlot[friday_afternoon]" id = "friday_afternoon" value = "friday_afternoon" />Fri : 1:30 - 3:30</td>
                    <td class="left"><input type = "checkbox" name = "timeSlot[saturday_afternoon]" id = "saturday_afternoon" value = "saturday_afternoon" />Sat : 1:30 - 2:50</td>
                </tr>
            </table>
        </div>
    <div class="container">
        <center>
            <?php framework::includeScript("reviewer","php","keywordReviewer");?>
        </center>
    </div>
    <div class="container">
    <center>
        <?php framework::includeScript("reviewer","php","revOpportunities"); ?>
    </center>
    </div>
    <div class="container">
    <center>
        <label>
            <div class="title">Area for General Bio</div>
        </label>
        <br/>
        <textarea class="roundedClass" id = "bio" name="bio" rows = "5" cols = "60"></textarea>
    </div>
    <table>
        <tr>
            <center>
                <td>
                    <input class="roundedClass" type = "reset" value = "Reset" style="width: 75px;">
                </td>
                <td>
                    <input class="roundedClass" type = "submit" value = "Submit" style="width: 75px;">
                </td>
                <td>
                    <a href="scripts/loginScripts/logout.php">Logout</a>
                </td>
            </center>
        </tr>
    </table>
</form>
</body>








