<?php

	// put any other constants/config vars in here
	class config {
	
		// database config vars
		public static $hostname = "localhost";
		public static $username = "root";
		public static $password = "vagrant";
		public static $dbname	= "spe";

		public static $isProduction = false;

		// override variables for production config
		public static function productionOverride() {
			self::$hostname = "mysql.cs.mtsu.edu";
			self::$username = "jds9a";
			self::$password = "sef14photo";
			self::$dbname = "jds9a";

			self::$isProduction = true;
		}
	
	};

?>
