<?php

	class framework {
	
		protected static $initialized = false;
		
		protected static $con = null;
	
		public static function initialize($host, $username, $password, $db) {
			if(!self::$initialized) {
				self::$initialized = true;
			} else {
				return;	// don't need to re-connect
			}
			
			/**
			 * Database
			 */ 
			self::$con = mysqli_connect($host, $username, $password, $db);
			
			if(mysqli_errno(self::$con)) {
				throw new \Exception("Error connecting: " . mysqli_error(self::$con));
			}
			
		}

		/**
		 * Includes a module in the /module/ directory.
		 *
		 * @param string $moduleName The module's name.
		 * @return module The module.
		 */
		public static function includeModule($moduleName) {

			require_once dirname(__FILE__) . "/module/" . $moduleName .".module.php";

			// require library for module, if needed
			if($moduleName::$neededLib) {
				require_once dirname(__FILE__) . "/lib/" . $moduleName::$neededLib . "/" . $moduleName::$neededLibAL;

				$libName = $moduleName::$neededLib;
				$libInstance = new $libName();

				return new $moduleName($libInstance);
			}

			return new $moduleName();

		}


		/**
		 * Attempts to log the user in, and set some session variables if successful.
		 *
		 * @param string $emailAddress
		 * @param string $password
		 * @return bool False if the login failed; true if successful.
		 */
		public static function login($emailAddress, $password) {

			$password = md5($password);


			// query db for POST'd crds
			$user = self::getOne("
				SELECT
					*
				FROM
					users
				WHERE
					email_address = '". $emailAddress ."'
					AND
					password = '". $password ."'
			");
			var_dump($user);
			// successful login!
			if(isset($user["first_name"])) {
				// set basic session vars
				$_SESSION["email_address"]	= $emailAddress;
				$_SESSION["user_id"]		= $user["user_id"];
				$_SESSION["first_name"]		= $user["first_name"];
				$_SESSION["last_name"]		= $user["last_name"];

				// determine if the user is an admin
				if($user["user_type"] == 'admin') {
					$_SESSION["is_admin"] = true;
				} else {
					$_SESSION["is_admin"] = false;
				}

				return true;
			}

			return false;

		}

		/**
		 * Returns array of user information.
		 *
		 * @return array|null NULL if user not logged in.
		 */
		public static function getCurrentUser() {

			if(self::isLoggedIn()) {
				return framework::getOne("
				SELECT
					*
				FROM
					users

				WHERE
					user_id = '". $_SESSION["user_id"] ."'
				");
			}

			return null;

		}

		/**
		 * Checks to see if the current user is logged in or not.
		 *
		 * @return bool
		 */
		public static function isLoggedIn() {

			$email = @$_SESSION["email_address"];

			if(!empty($email)) {
				return true;
			}

			return false;

		}

		/**
		 * Checks to see if the user is an admin, granted that he/she is logged in.
		 *
		 * @return bool
		 */
		public static function isAdmin() {

			if(self::isLoggedIn()) {
				$isAdmin = $_SESSION["is_admin"];

				return $isAdmin;
			}

			return false;

		}

		/**
		 * Redirect user.
		 *
		 * Example:
		 * <code>
		 * 	framework::redirect("admin/index.php");
		 * </code>
		 *
		 * <code>
		 * 	framework::redirect("index.php?page=attendeeRegistration");
		 * </code>
		 *
		 * @param $page
		 */
		public static function redirect($page) {
			ob_start();

			if(config::$isProduction) {
				header("Location: http://". $_SERVER["HTTP_HOST"] . "/~sef14photo/nice/" . $page);
			} else {
				header("Location: http://". $_SERVER["HTTP_HOST"] . "/photography/photography/PhotographySESPRING2015/nice/" . $page);
			}

			ob_end_flush();
		}

		/**
		 * Return POST, GET, REQUEST vars in one array.
		 *
		 * @return array
		 */
		public static function getRequestVars() {

			$ret = array_merge(
				$_POST,
				$_GET,
				$_REQUEST
			);

			return $ret;

		}

		/**
		 * Clean a variable.
		 */
		public static function clean($str) {

			return mysqli_escape_string(self::$con, $str);

		}

		/**
		 * Close the MySQLi connection.
		 */
		public static function close() {
			self::$initialized = false;
			mysqli_close(self::$con);
		}

		/**
		 * Handle which page to load.
		 *
		 * @param $page
		 */
		public static function handle($page) {
			$page = trim($page); // security
			
			if(!is_file("./pages/" . $page . ".php")) {
				return;
			}
			
			require_once "./pages/" . $page . ".php";
		}

		/**
		 * Mainly just executes a query, with no return result.
		 *
		 * @param string $sql Query to execute.
		 * @param bool $debug Debug mode.
		 * @return void|int Return auto-generated (only for INSERT INTO queries).
		 */
		public static function execute($sql, $debug = false, $returnId = false) {

			$res = mysqli_query(self::$con, $sql, MYSQLI_USE_RESULT);

			if($debug) {
				self::debug($sql);
				return;
			}

			if($debug && mysqli_errno(self::$con)) {
				print_r(mysqli_error(self::$con));
			}

			if($returnId) {
				return mysqli_insert_id(self::$con);
			}

		}

		/**
		 * Returns multiple rows via SQL [mysqli].
		 *
		 * @param $sql
		 * @return array
		 */
		public static function getMany($sql, $debug = false) {

			if($debug) {
				self::debug($sql);
				return;
			}

			$res = mysqli_query(self::$con, $sql);

			$data = array();
			
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
				$data[] = $row;
			}
			
			return $data;
			
		}

		/**
		 * Returns one row; however, uses getMany.
		 * @see self::getMany()
		 *
		 * @param $sql
		 * @return array
		 */
		public static function getOne($sql, $debug = false) {
		
			$ret = array();
			
			// just revert to getMany(). appending "LIMIT 1" to a query could introduce errors
			// e.g. "HAVING 5 LIMIT 1" would produce an error
			$data = self::getMany($sql, $debug);
			
			// do we have any data at all to return?
			if(count($data)) {
				$ret = $data[0];
			} 
			
			return $ret;
		
		}

		/**
		 * Include a PHP script, or a JavaScript file dynamically.
		 *
		 * @param $category
		 * @param $type
		 * @param $name
		 */
		public static function includeScript($category, $type, $name) {
			$path = "scripts/". $category ."/". $type ."/". $name . "." . $type;
			
			switch($type) {
				case "js":
					echo "<script type=\"text/javascript\" src=\"". $path ."\"></script>";
					break;
				
				case "php";
					require_once $path;
					break;
			}
		}

		/**
		 * Print out a formatted line for debugging messages.
		 *
		 * @param string $string String to append to debug message (date/time).
		 * @return void
		 */
		public static function debug($string = "") {
			echo "<pre>";

			// prep
			$dtNow = new \DateTime();
			$message = "[DEBUG] " . $dtNow->format("Y-m-d H:i:s") . " | " . $string;

			// print
			print_r($message);

			echo "</pre>";
		}
	
	};

?>
