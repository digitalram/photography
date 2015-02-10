<!DOCTYPE html>
<html>

	<head>
		<title>Login :: SPE</title>
		<link rel="icon" href="images/spe_Fav.ico" /> <!-- The icon in the browser tab -->
		<link type = "text/css" rel = "stylesheet" href = "style/photo.css" />
	</head>
	
	<body>
		<a href="https://www.spenational.org/https://www.spenational.org/">
		<img src="https://www.spenational.org/images/logo.gif"  title="Return to home page" width="92"></a>
		
		<form class="auth_form" name="login" id="loginform" action="scripts/loginScripts/redirect.php" method="post">
		<div class="maintitle">Society for Photographic Education</div>
		<div class=container>
			<table>
				<tr>
					<td><input class="roundedClass" type="text" name="username" id="username" class="inputtext" required="required" maxlength="50" pattern="[A-Za-z0-9_?@.]{1,50}" autofocus="autofocus" placeholder="Username" /></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type="password" name="password" id="password" class="inputtext" required="required" maxlength="100"  placeholder="Password" /></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type="submit" name="submit" value="Login" style="width:75px;"/></td>
				</tr>
				<tr>
					<td>
						<p style="text-align: center; color: red;">Invalid Email and Password</p>
						<a href="register.php">Sign up for a password</a>
					</td>
				</tr>
			</table>	
	</body>
</html>