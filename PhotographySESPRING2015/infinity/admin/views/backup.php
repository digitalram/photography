<html>
    <head>
	    <title>SPE National Photograph Backup DB</title>
    
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
    <li><a href="#">Backup Schedule DB</a></li>
    <li><a href="register.php">Add User</a></li>
	<li><a href="editusers.php">Edit User</a></li>
    <li><a href="index.php?logout">Logout</a></li>
</ul>
</nav>
</div>
<div id="wrapper">


<?php

define('PATH','backup/');		// Backup Directory



class DBBackup
{
  private $con;
  private $tables = array();
  private $path;

  function __construct($host = null, $username = null, $password = null, $database = null)
  {
    /*
    Connect and select MySQL DB
    */
    if( is_null($host) || is_null($username) || is_null($password) || is_null($database) ) throw new Exception("The host, username, password and database name arguments must be specified!");
    if( ! $this->con = @mysql_connect($host, $username, $password) ) throw new Exception("Could not connect MySQL server {$username}@{$host}");
    if( ! @mysql_select_db($database, $this->con) )throw new Exception("Could not select database: {$database}");
  }


  public function table( $table = 'all' )
  {
    /*
    Get defined tables
    */
  	if( is_array( $table )){
      // Cheque table validity
      foreach($table as $t){
        if(in_array($t , $this->getAllTables())){
          $this->tables[] = $t;
        }
        else{
          throw new Exception("Table `{$t}` not exists in the DB");
        }
      }
  	}
  	elseif( $table == 'all' ){
  		$this->tables = $this->getAllTables();
  	}
  	else{
  		throw new Exception("Please enter tables name as array");
  	}
  }

  public function path($path = '')
  { 
    /*
    Set upload path
    */
    $this->path = $path;
  }

  public function backUp()
  {
    /*
    Done backup
    */
  	$return = '';
  	foreach($this->tables as $table){
  		$return .= $this->tableStracture($table);

  		foreach ($this->recode($table) as $result) {
  			$return .= $result;
  		}
  	}
	//echo $return;
  	$this->writeToFile($return);
  
    return true;
  }

  private function getAllTables()
  {
    /*
    Get tables list name from DB
    */
  	$sql = mysql_query("SHOW TABLES");
  	while ($row = mysql_fetch_row($sql) )
    {
      foreach ($row as $key => $value)
      {
        $table[]  = $value;
      }
  	}
	return $table;
  }

  private function tableStracture($table)
  {
    /*
    Get table stracture
    */
  	$return = "\nDROP TABLE IF EXISTS `{$table}`;\n\n";
    $row = ( mysql_fetch_row(mysql_query("SHOW CREATE TABLE {$table}")) );
    $return .= $row[1].";\n\n";

    return $return;
  }

  private function recode($table)
  {
    /*
    Get data recodes
    */
  	$query = mysql_query("SELECT * FROM {$table} LIMIT 0, 1000");
  	$num_fields = mysql_num_fields($query);
  	$num_rows = mysql_num_rows($query);
  	$results = array();
  	if ($num_rows){
  		
  		while($row = mysql_fetch_row($query))
  		{
  			$return = "INSERT INTO {$table} VALUES(";
  			for($i=0; $i<$num_fields; $i++) 
  			{
          $row[$i] = addslashes($row[$i]);
          $row[$i] = str_replace("\n","\\n",$row[$i]);
          $row[$i] = str_replace("\r","\\r",$row[$i]);

  				$return .= ( isset($row[$i]) ) ? "'{$row[$i]}'" : "''";
  				if ($i<($num_fields-1)) { $return.= ','; }
  			}
  			$return.= ");\n";
  			$results[] = $return;
  		}

  	}
  	return $results;
  }

  private function writeToFile($str)
  {
    /*
    Write down backup file
    */
    $path = (isset($this->path))? $this->path : '';
    $backupPath = $path . date('Y-m-d-H-i').'_'.md5(uniqid()).'.sql';
  	if( ! $handle = @fopen( $backupPath ,'w+') ) throw new Exception("Could not save backup file at {$backupPath}");  
    fwrite($handle, $str);
    fclose($handle);
	echo "<H1>"."Database successfully backedup file will be found in the backup directory on the server, and by downloading file below."."</H1>"; // download file
	echo "<h3><a href='$backupPath'>Right Click to save file</a></h3>"; // download file
  }

  public function close()
  {
    /*
    Close MySQL connection
    */
    mysql_close($this->con);
  }
}

try {
	$db = new DBBackup(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$db->table(array('reviewers', 'attendees', 'session', 'users'));
	$db->path(PATH);
	$db->backUp();
	$db->close();
	
	
} catch (Exception $e) {
	die($e->getMessage());
}
?>
</div>
    </body>
</html>