<!DOCTYPE html>
<html>
  <head>
    <title>SPE National Photograph Register</title>
    
	<link rel="stylesheet" href="css/main.css"/>


</head>
<body>
<div id="top_header">
<header>
 <h1>spe<span>review add new admin</span></h1>
</header>    
<nav id="top_nav">
<ul>
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="reviewschedule.php">Review Schedule</a></li>
    <li><a href="backup.php">Backup Schedule DB</a></li>
    <li><a href="#">Add User</a></li>
	<li><a href="editusers.php">Edit User</a></li>
    <li><a href="index.php?logout">Logout</a></li>
</ul>
</nav>
</div>
<div id="wrapper">
    
<!-- errors & messages --->
<?php

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}

?>
<!-- errors & messages --->

<!-- register form -->
<form method="post" action="register.php" name="registerform">   
<table border="1" class="regtable">    
	<tr>
<td><label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label></td>
<td><input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /></td>
</tr>
<tr>
<td><label for="login_input_email">User's email</label>  </td>
<td><input id="login_input_email" class="login_input" type="email" name="user_email" required />  </td>
</tr>
<tr>
<td><label for="login_input_password_new">Password (min. 6 characters)</label></td>
<td><input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /> </td>
</tr>
<tr>
<td><label for="login_input_password_repeat">Repeat password</label></td>
<td><input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /> </td>
</tr>
<tr>
<td><input type="submit"  name="register" value="Register" /></td>
</tr>
</table>
</form>

    </div>

</body>
</html>