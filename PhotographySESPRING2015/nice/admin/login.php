<?php

	$request = framework::getRequestVars();
	$incorrect = @$request["incorrect"];

	if($incorrect == 1) {
		echo "<h2 style=\"color: #FF8986;text-align:center;\">Incorrect email/password combination! Try again.</h2>";
	}

?>

<form class="auth_form" name="login" id="loginform" action="scripts/login.php" method="post">
	<table>
		<tr>
			<td><input class="roundedClass" type="text" name="email_address" id="email_address" autofocus="autofocus" placeholder="Email" /></td>
		</tr>
		<tr>
			<td><input class="roundedClass" type="password" name="password" id="password" class="inputtext" maxlength="100" placeholder="Password" /></td>
		</tr>
		<tr>
			<td><input class="roundedClass" type="submit" name="submit" value="Login" style="width:75px;"/></td>
		</tr>
	</table>
</form>
