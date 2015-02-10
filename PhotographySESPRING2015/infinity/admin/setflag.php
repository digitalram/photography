    <?php
	include 'config/db.php';
	$con = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
	@mysql_select_db(DB_NAME) or die(mysql_error());
    mysql_query("UPDATE show_db SET show_db = 1;")or die(mysql_error());
	echo "<h3>Schedule is now viewable to all</h3>";

?>
