<?php

	require_once "../bootstrap.php";

	session_destroy();

	framework::redirect("admin/index.php");

?>