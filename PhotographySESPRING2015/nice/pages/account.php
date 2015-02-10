<?php

	require_once "bootstrap.php";

	// reqs
	$request = framework::getRequestVars();

	// not logged in?
	if(!framework::isLoggedIn()) {
		header("Location: ./?page=login");
	}

	$user = framework::getCurrentUser();

	if(isset($request["first_name"])) {
		// correct password?
		if(!framework::login($request["email_address"], $request["password"])) {
			echo "<span style=\"color: #ff0000;\">Incorrect password.</span>";
		}

		unset($request["password"]);
		unset($request["page"]);

		// new password?
		if(!empty($request["new_password"]) && !empty($request["new_password_confirm"])) {
			if($request["new_password"] != $request["new_password_confirm"]) {
				echo "<span style=\"color: #ff0000;\">New passwords do not match in confirmation.</span>";
				return;
			}

			$request["password"] = md5($request["new_password"]);
		}

		unset($request["new_password"]);
		unset($request["new_password_confirm"]);

		$update = array();

		// loop
		foreach($request as $column => $value) {
			$update[] = $column ." = '". $value ."'";
		}

		$sql = "
		UPDATE
			users
		SET ". implode(",", $update) ."
		WHERE
			user_id = '". $user["user_id"] ."'
		";

		framework::execute($sql);

		echo "<span style=\"color: #025e16;\">Account successfully saved!</span>";

	}

?>

<h1>Account</h1>
<hr/>

<style type="text/css">
	td.label {
		color: #fc0;
		font-family: GothamRegular;
		font-size: medium;
		text-align: right;
		vertical-align: top;
	}
</style>

<form method="post">
	<div id="container">
		<div class="maintitle">Modify Information</div>
	</div>
	<table>
		<tr>
			<td width="200" class="label">Title:</td>
			<td style="text-align: left;">
				<select class="roundedClass" name="title" style="width:75px;">
					<!-- fixme: dynamically select... no time -->
					<option value="Title" disabled>Title</option>
					<option value=""></option>
					<option value="Dr.">Dr.</option>
					<option value="Ms.">Ms.</option>
					<option value="Mrs.">Mrs.</option>
					<option value="Mr.">Mr.</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">First Name:</td>
			<td style="text-align: left;"><input type="text" name="first_name" value="<?= $user["first_name"] ?>"/></td>
		</tr>
		<tr>
			<td class="label">Last Name:</td>
			<td style="text-align: left;"><input type="text" name="last_name" value="<?= $user["last_name"]; ?>" /></td>
		</tr>
		<tr>
			<td class="label">Email Address:</td>
			<td style="text-align: left;"><input type="text" name="email_address" value="<?= $user["email_address"]; ?>" /></td>
		</tr>
		<tr>
			<td class="label">Password:</td>
			<td style="text-align: left;"><input type="password" name="password" /> * enter to save information</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="label">New Password:</td>
			<td style="text-align: left;"><input type="password" name="new_password" /></td>
		</tr>
		<tr>
			<td class="label">New Password:</td>
			<td style="text-align: left;"><input type="password" name="new_password_confirm" /></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="label">State:</td>
			<td style="text-align: left;">
				<select name="state">
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District Of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">Address:</td>
			<td style="text-align: left;"><input type="text" name="address" value="<?= $user["address"]; ?>" /></td>
		</tr>
		<tr>
			<td class="label">Bio:</td>
			<td style="text-align: left;">
				<textarea name="bio" cols="25" rows="10"><?= $user["bio"]; ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" value="Save" />
			</td>
		</tr>
	</table>
</form>