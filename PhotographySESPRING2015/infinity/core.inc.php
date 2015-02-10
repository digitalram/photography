<?php
session_save_path("/home/users/web/b1615/ipg.dfannincom/cgi-bin/tmp");
session_start();
ob_start();
$current_file = $_SERVER['SCRIPT_NAME'];

if(isset($_SERVER['HTTP_REFERER'])&&!empty($_SERVER['HTTP_REFERER'])){
	$http_referer = $_SERVER['HTTP_REFERER'];
}

function logged_in(){
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
		$query = "SELECT `id` FROM `user` WHERE `hash`='".$_SESSION['user_id']."'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0){
			return true;
		}
	}
	
		return false;
		
}

?>
