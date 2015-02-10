<?php
	session_save_path("/home/users/web/b1615/ipg.dfannincom/cgi-bin/tmp");
	session_start();
	ob_start();
	require 'connect.inc.php';
	
	
	if(isset($_POST['user']) && isset($_POST['pass'])){
		if(!empty($_POST['user']) && !empty($_POST['pass'])){
			$error = '';
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			
			
			$query = "SELECT `hash` FROM `user` WHERE `username`='".$user."' AND `password`='".$pass."'";
			
			$query_run = mysql_query($query);
			
			if(	$query_run){
				if(mysql_num_rows($query_run) > 0)
				{
					$result = mysql_fetch_array($query_run);
					$_SESSION['user_id'] = $result[0];
					
					
					header('location: admin/index.php');
				}else{
					$error = 'Invalid Username or Password.';	
				}
			}else{
				echo 'query fail';	
			}
		}
		
	}
?>

<!DOCTYPE html>
<head>

	
   	
	<title>SPE National Photograph Review Schedule</title>

</head>
<body >
	<?php require 'banner.php';?>
	<div id="wrapper">

		<section class="login">
        	<h1>Login to the ExperienceCC Admin Page</h1>
            
        	<form  action="login.php" method="POST" id="login">
            	<h2>Username:</h2>
            	<div class="user_error"><span id="user_error"><?php echo $error; ?></span>
            	<input type="text" name="user" value=""/></div>
                <h2>Password:</h2>
                <div class="pass_error"><span id="pass_error"></span>
                <input type="password" name="pass" value=""/><br/>
                <input type="submit" value="Login"/></div>
            </form>
        	
        </section>
</div>
            
                
</body>
</html>
