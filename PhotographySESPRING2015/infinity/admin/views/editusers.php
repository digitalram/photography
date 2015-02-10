<?php
$con = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
@mysql_select_db(DB_NAME) or die(mysql_error());
$user = $_SESSION['user_name'];
$user_info = mysql_query("SELECT * FROM users WHERE user_name = '$user'") or  die(mysql_error());
$user_row = mysql_fetch_assoc($user_info);


?>
<?php
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
     $email=$_POST['email'];
	 $password=$_POST['password'];
	 $password2=$_POST['password2'];
	 $delete_user = $_POST['deluser'];
	 
	 
	 
	 if (($password == $password2) && ($password != NULL) && ($password != '')) // change password
	 {
		$password_hash = password_hash($password, PASSWORD_DEFAULT); // hash password
		mysql_query("Update users SET user_password_hash = '$password_hash' WHERE user_name = '$user'") or  die(mysql_error()); // update password
		goto here;
	 }
	 if (($email != NULL) && ($email != ''))
	 {
		mysql_query("Update users SET user_email = '$email' WHERE user_name = '$user'") or  die(mysql_error()); // update email
		goto here;
	 }
	 
	 if (($delete_user != NULL) && ($delete_user != ''))
	 {
		mysql_query("DELETE FROM users where user_name = '$delete_user'") or  die(mysql_error()); // delete_user
		goto here;
	 }
	 
     
     }
	 
else {  
		here:
        ?>
		
<html>
    <head>
	    <title>SPE National Photograph Edit User Info</title>
    
	<link rel="stylesheet" href="css/main.css"/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>

    <body>
	
	<div id="top_header">
<header>
 <h1>spe<span>review schedule</span></h1>

</header>   
	<nav id="top_nav">
<ul>
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="reviewschedule.php">Review Schedule</a></li>
    <li><a href="backup.php">Backup Schedule DB</a></li>
    <li><a href="register.php">Add User</a></li>
	<li><a href="#">Edit User</a></li>
    <li><a href="index.php?logout">Logout</a></li>
</ul>
</nav>
</div>
<div id="wrapper">
<form method="POST" action="<?=$_SERVER["PHP_SELF"]?>">
		<h2>To change account details just enter the new email or password you wish to use and hit submit.</h2>
		<table border='0' class='regtable'>
		<tr>
        <td>New Email: </td><td><input type="text" name="email" /></td>
		</tr>
		
		<tr>
		<td>New Password: </td><td><input type="text" name="password" /></td>
		</tr>
		
		<tr>
		<td>Retype New Password: </td><td><input type="text" name="password2" /></td>
		</tr>
		</table>
		
		
		<?php
		if ($user_row['admin'] == 1)
		{
			echo "<h2>Select a user to delete<h2>";
			echo "<table border='0' class='regtable'>";
			$users = mysql_query("Select * From users WHERE user_name <> '$user'") or  die(mysql_error());		
			while ($row = mysql_fetch_assoc($users))
			{
				echo "<tr>";
				echo "<td>Delete User:  $row[user_name] </td><td><input type='radio' name='deluser' value='$row[user_name]'></td>";
				echo "</tr>";
			}
			
			echo "</table>";
		}
		
		?>
		<input type="submit" name="submit" value="Submit"/>
        
</form>
</div>
    </body>
</html>
<?php } ?>