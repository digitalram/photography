<?php

	require_once "bootstrap.php";

	$request = framework::getRequestVars();

	if(framework::isLoggedIn()) {
		header("Location: ./index.php");
	}

	if(isset($request["txtEmail"])) {

		$res = framework::login($request["txtEmail"], $request["txtPassword"]);

		$location	= "./";
		$referer	= $_SERVER["HTTP_REFERER"];

		if(strpos($referer, "attendeeRegistration")) {
			$location = "./?page=attendeeRegistration";
		}

		if(strpos($referer, "reviewerRegistration")) {
			$location = "./?page=reviewerRegistration";
		}

		if($res) {
			header("Location: ./". $location);
		}

	}

?>

<h1>Login</h1>
<hr>

<form method="post">
<table cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td>Email:</td>
		<td><input type="text" name="txtEmail" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="txtPassword" /></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" value="Login" />
		</td>
	</tr>
</table>
</form>
