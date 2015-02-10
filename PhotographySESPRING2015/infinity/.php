<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
		<title>Administrator Login</title>
		<link rel="stylesheet" id="myCSS" href="main.css"/>
		<?php include 'core.php'; ?>
		
</head>
	
	
<body>
	<div id="wrapper">
	
		<!-- TOP BAR BEGINS	-->
        <?php
            include 'banner.php';
        ?>
        <!-- TOP BAR ENDS	-->
		
		<!-- NAV BAR BEGINS	-->
        <!-- NAV BAR ENDS	-->
		
		<!-- LOGIN FORM BEGINS	-->
        <div id="blogspot" style="float:none;">
            <section class="blog">
			
				<h1>Login</h1>
				
				<form action="">
				
					<label>Username:<br />
					<input type="text" name="user" /></label>
					
					<br /><br />
					
					<label>Password:<br />
					<input type="password" name="password" /></label>
					
					<br /><br />
					
					<input type="submit" value="Login"/>
				</form>
				
			</section>
		</div>
		<!--LOGIN FORM ENDS-->
		
		<hr />
		
	</div>
	</body>
</html>