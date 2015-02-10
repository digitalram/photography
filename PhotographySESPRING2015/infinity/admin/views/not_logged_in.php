<!doctype html>
<html lang="en-US">
<head>

	<meta charset="utf-8">

	<title>Login</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
	<link rel="stylesheet" href="/admin/css/login.css">

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>

	<div id="login">

		<h2><span class="fontawesome-lock"></span>Sign In</h2>

		<form method="post" action="index.php" name="loginform">

			<fieldset>
				<label for="login_input_username">Username</label>
				<input id="login_input_username" class="login_input" type="user_name" name="user_name" onFocus="if(this.value=='user_name')this.value='';" value="user_name" required />

				<label for="login_input_password">Password</label>
				<input id="login_input_password" class="login_input" type="password" name="user_password" onFocus="if(this.value=='password')this.value='';" value="password" autocomplete="off" required />

				<input type="submit"  name="login" value="Log in" />
			</fieldset>

		</form>

	</div> <!-- end login -->

</body>	
</html>
<!-- errors & messages --->
<?php

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo "<div class='message'>".$error."</div>";    
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo "<div class='message'>".$message."</div>";    
    }
}

?>
<!-- errors & messages --->

