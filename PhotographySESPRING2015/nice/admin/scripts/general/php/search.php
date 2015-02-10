<?php
	
	require_once "../../../bootstrap.php";

	$request = framework::getRequestVars();

	if(isset($request['search']) ){

		//for reviewers
		$my_data = $request['search'];
		$newdata = "";

		$users = framework::getMany("SELECT first_name, last_name FROM users WHERE first_name LIKE '%".$my_data."%' OR last_name LIKE '%".$my_data."%'");

		foreach($users as $user) {
			$newdata .= "<p>" . $user["last_name"] . ", " . $user["first_name"]. "</p>";
		}

		echo $newdata;
	}
?>
