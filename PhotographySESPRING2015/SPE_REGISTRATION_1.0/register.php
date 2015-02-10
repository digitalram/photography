<!DOCTYPE html>
<html>

	<head>
		<title>Register :: SPE</title>
		<link rel="icon" href="images/spe_Fav.ico" /> <!-- The icon in the browser tab -->
		<link type = "text/css" rel = "stylesheet" href = "style/photo.css" />
		<script src="scripts/registerScripts/registration.js"></script>
	</head>
	
	<body>		
		<a href="https://www.spenational.org/https://www.spenational.org/">
		<img src="https://www.spenational.org/images/logo.gif"  title="Return to home page" width="92"></a>
		
		<form class="auth_form" name="login" id="loginform" action="scripts/registerScripts/completeRegistration.php" method="post">
		<div class="maintitle">Society for Photographic Education</div>
		<div class=container>
			<table>
				<tr>
					<td><input class="roundedClass" type="text" name="username" id="iemail" class="inputtext" required="true" maxlength="50" pattern="[A-Za-z0-9_?@.]{1,50}" autofocus="autofocus" placeholder="Email" oninput="checkemail(this)" /></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type="text" id="cemail" class="inputtext" required="true" maxlength="50" pattern="[A-Za-z0-9_?@.]{1,50}" autofocus="autofocus" placeholder="Confirm Email" oninput="confirmemail(this)"/></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type="password" name="password" id="ipass" class="inputtext" required="true" maxlength="100"  placeholder="Password" oninput="checkpass1(this)"/></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type="password" id="cpass" class="inputtext" required="true" maxlength="100"  placeholder="Confirm Password" oninput="confirmpass(this)"/></td>
				</tr>
				<tr>
					<td><input class="roundedClass" type="submit" name="submit" value="Register" style="width:75px;"/></td>
				</tr>
			</table>
		</div>
	</body>
</html>