
<?php

include 'config/db.php'; 		// include config file
include 'config/cleardb.php'; 	// include file to clear database
$fieldseparator = ",";
$lineseparator  = "\r";
$reviewers_f    = "uploads/reviewers_f.csv";
$reviewers_s    = "uploads/reviewers_s.csv";
$attendee_f     = "uploads/attendees_f.csv";
$attendee_s     = "uploads/attendees_s.csv";


$con = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error()); // set up mysql connection
@mysql_select_db(DB_NAME) or die(mysql_error()); // database name

$lines     = 0;
$queries   = "";
$linearray = array();

// import fridays attendee file
if (!file_exists($attendee_f)) {
    echo "Attendee_F file not found. Make sure you specified the correct path.\n";
    exit;
}
$file = fopen($attendee_f, "r");
if (!$file) {
    echo "Error opening Attendee_F file.\n";
    exit;
}
$size = filesize($attendee_f);

if (!$size) {
    echo "Attendee_F file is empty.\n";
    exit;
}
$csvcontent = fread($file, $size);
fclose($file);


foreach (explode($lineseparator, $csvcontent) as $line) {
    $lines++;
	$line      = str_replace('"', "", $line);
	$line      = str_replace("'", "", $line);
    $line      = trim($line, " \t");
    $line      = trim($line, " ");
    $line      = trim($line, "'");
    $line      = trim($line, "\"");
    $line      = str_replace("\n", "", $line);
    /************************************
    This line escapes the special character. remove it if entries are already escaped in the csv file
    ************************************/
    $line      = str_replace("'", "\'", $line);
    /*************************************/
    $linearray = explode($fieldseparator, $line);
    array_splice($linearray, 3, 0, 'F');
    $linemysql = implode("','", $linearray);
    
    
    
    
    $query = "insert into attendees values('','$linemysql');";
    
    $queries .= $query . "\n";
    @mysql_query($query)or die(mysql_error());
}


// import saturday attendee file
if (!file_exists($attendee_s)) {
    echo "Attendee_S file not found. Make sure you specified the correct path.\n";
    exit;
}
$file = fopen($attendee_s, "r");
if (!$file) {
    echo "Error opening Attendee_S file.\n";
    exit;
}
$size = filesize($attendee_s);
if (!$size) {
    echo "Attendee_S file is empty.\n";
    exit;
}
$csvcontent = fread($file, $size);
fclose($file);


foreach (explode($lineseparator, $csvcontent) as $line) {
    $lines++;
	$line      = str_replace('"', "", $line);
	$line      = str_replace("'", "", $line);
    $line      = trim($line, " \t");
    $line      = trim($line, " ");
    $line      = trim($line, "\"");
    $line      = trim($line, "'");
    $line      = str_replace("\n", "", $line);
    /************************************
    This line escapes the special character. remove it if entries are already escaped in the csv file
    ************************************/
    $line      = str_replace("'", "\'", $line);
    /*************************************/
    $linearray = explode($fieldseparator, $line);
    array_splice($linearray, 3, 0, 'S');
    $linemysql = implode("','", $linearray);
    
    
    
    //try catch 3 lines on error throw e 
    $query = "insert into attendees values('','$linemysql');";
    
    $queries .= $query . "\n";
    @mysql_query($query)or die(mysql_error());
}



// import friday reviewers file
if (!file_exists($reviewers_f)) {
    echo "Reviewers file not found. Make sure you specified the correct path.\n";
    exit;
}
$file = fopen($reviewers_f, "r");
if (!$file) {
    echo "Error opening Friday reviewers file.\n";
    exit;
}
$size = filesize($reviewers_f);
if (!$size) {
    echo "Friday reviewers file is empty.\n";
    exit;
}
$csvcontent = fread($file, $size);
fclose($file);



foreach (explode($lineseparator, $csvcontent) as $line) {
    $lines++;
	$line      = str_replace('"', "", $line);
	$line      = str_replace("'", "", $line);
    $line      = trim($line, " \t");
    $line      = trim($line, " ");
    $line      = trim($line, "\"");
    $line      = trim($line, "'");
    $line      = str_replace("\n", "", $line);
    /************************************
    This line escapes the special character. remove it if entries are already escaped in the csv file
    ************************************/
    $line      = str_replace("'", "\'", $line);
    /*************************************/
    $linearray = explode($fieldseparator, $line);
    $linemysql = implode("','", $linearray);
    
    
    $query = "INSERT INTO reviewers (Last_Name, First_Name, Email, F1_id, F2_id, F3_id, Table_num) VALUES ('$linearray[0]', '$linearray[1]', '$linearray[2]', '$linearray[3]', '$linearray[4]', '$linearray[5]', $linearray[6])";
    
    $queries .= $query . "\n";
    @mysql_query($query)or die(mysql_error());
}



// import Saturday reviewers file
if (!file_exists($reviewers_s)) {
    echo "Saturday reviewers file not found. Make sure you specified the correct path.\n";
    exit;
}
$file = fopen($reviewers_s, "r");
if (!$file) {
    echo "Error opening  Saturday reviewers file.\n";
    exit;
}
$size = filesize($reviewers_s);
if (!$size) {
    echo "Saturday reviewers file is empty.\n";
    exit;
}
$csvcontent = fread($file, $size);
fclose($file);



foreach (explode($lineseparator, $csvcontent) as $line) {
    $lines++;
	$line      = str_replace('"', "", $line);
	$line      = str_replace("'", "", $line);
    $line      = trim($line, " \t");
    $line      = trim($line, " ");
    $line      = trim($line, "\"");
    $line      = trim($line, "'");
    $line      = str_replace("\n", "", $line);
    /************************************
    This line escapes the special character. remove it if entries are already escaped in the csv file
    ************************************/
    $line      = str_replace("'", "\'", $line);
    /*************************************/
    $linearray = explode($fieldseparator, $line);
    
    
    $linemysql = implode("','", $linearray);
    
    
    $query = "INSERT INTO reviewers (Last_Name, First_Name, Email, S1_id, S2_id, S3_id, Table_num) VALUES ('$linearray[0]', '$linearray[1]', '$linearray[2]', '$linearray[3]', '$linearray[4]', '$linearray[5]', $linearray[6])";
    
    
    $queries .= $query . "\n";
    @mysql_query($query)or die(mysql_error());
}

echo '<font color=\'#FFCC00\'>Files parsed into database successfully!</font><br>'; // file read into database 


// create session table by using the imported files
$AddSessions = "
INSERT INTO session (S_id,Rev_id)(
    SELECT
        'F1',reviewers.Id
    FROM
        reviewers
    WHERE
        reviewers.F1_id = 'x'
)
";
@mysql_query($AddSessions);

$AddSessions = "
INSERT INTO session (S_id,Rev_id)(
    SELECT
        'F2',reviewers.Id
    FROM
        reviewers
    WHERE
        reviewers.F2_id = 'x'
)
";
@mysql_query($AddSessions);

$AddSessions = "
INSERT INTO session (S_id,Rev_id)(
    SELECT
        'F3',reviewers.Id
    FROM
        reviewers
    WHERE
        reviewers.F3_id = 'x'
)
";
@mysql_query($AddSessions);

echo '<font color=\'#FFCC00\'>Friday sessions created successfully!</font><br>';

$AddSessions = "
INSERT INTO session (S_id,Rev_id)(
    SELECT
        'S1',reviewers.Id
    FROM
        reviewers
    WHERE
        reviewers.S1_id = 'x'
)
";
@mysql_query($AddSessions);

$AddSessions = "
INSERT INTO session (S_id,Rev_id)(
    SELECT
        'S2',reviewers.Id
    FROM
        reviewers
    WHERE
        reviewers.S2_id = 'x'
)
";
@mysql_query($AddSessions);

$AddSessions = "
INSERT INTO session (S_id,Rev_id)(
    SELECT
        'S3',reviewers.Id
    FROM
        reviewers
    WHERE
        reviewers.S3_id = 'x'
)
";

@mysql_query($AddSessions);

echo '<font color=\'#FFCC00\'>Saturday sessions created successfully!</font><br>';



// this is where the magic happens

// loop thru each attendee 20 times for every reviewer choice
for ($i = 1; $i <= 20; $i++) {

	// generate random attendee order
    $result = mysql_query("SELECT *
        FROM attendees
        ORDER BY RAND();");
    
    // go through each attendee
    while ($row = mysql_fetch_assoc($result)) {
        
        $Choice1 = array(
            $row["Choice_" . $i . "_Last"],
            $row["Choice_" . $i . "_First"]
        );
        
        $choice = "
            SELECT *
            FROM reviewers
            WHERE Last_Name = '$Choice1[0]' AND First_Name = '$Choice1[1]'";

        
        $sql_res = mysql_query($choice) or die(mysql_error());
        
		// try and schedule attendee with choice
        while ($revChoice = mysql_fetch_assoc($sql_res)) {
            
            if ($revChoice['F1_id'] == 'x') {
                
                $revquery = "SELECT * 
                    FROM `session`
                    WHERE Rev_id = $revChoice[Id] AND S_id = 'F1'";
                
                $revresults = mysql_query($revquery) or die(mysql_error());
                
                while ($sessionresults = mysql_fetch_assoc($revresults)) {
                    
                    $attqry = "
								SELECT
									MAX($row[Id] IN(`session`.Time_1)) AS T1,
									MAX($row[Id] IN(`session`.Time_2)) AS T2,
									MAX($row[Id] IN(`session`.Time_3)) AS T3,
									MAX($row[Id] IN(`session`.Time_4)) AS T4,
									MAX($row[Id] IN(`session`.Time_5)) AS T5,
									MAX($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
									`session`.S_id = 'F1'
								AND (
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
								)

                                    ";
									
					$countqry = "
													SELECT
									SUM($row[Id] IN(`session`.Time_1)) AS T1,
									SUM($row[Id] IN(`session`.Time_2)) AS T2,
									SUM($row[Id] IN(`session`.Time_3)) AS T3,
									SUM($row[Id] IN(`session`.Time_4)) AS T4,
									SUM($row[Id] IN(`session`.Time_5)) AS T5,
									SUM($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
	
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
									";				
                    
                    
                    $attres = mysql_query($attqry) or die(mysql_error());
                    $inrow = mysql_fetch_row($attres);
					
					
					$attcount = mysql_query($countqry) or die(mysql_error());
					$intablecount = mysql_fetch_row($attcount);
                    $inrowsum = $intablecount[0] + $intablecount[1] + $intablecount[2] + $intablecount[3] + $intablecount[4] + $intablecount[5];
                    
                    if ($inrowsum < 7)
						{
						if ($inrow[0] != 1) {
							$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]1'";
							
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[1] != 1) {
							$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_2 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[2] != 1) {
							$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_3 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[3] != 1) {
							$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_4 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[4] != 1) {
							$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_5 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[5] != 1) {
							$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_6 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
                    }
                    
                    
                }
            }
            
            
            
            if ($revChoice['F2_id'] == 'x') {
                
                $revquery = "SELECT * 
                    FROM `session`
                    WHERE Rev_id = $revChoice[Id] AND S_Id = 'F2'";
                
                $revresults = mysql_query($revquery) or die(mysql_error());
                
                while ($sessionresults = mysql_fetch_assoc($revresults)) {
                    
                    $attqry = "
								SELECT
									MAX($row[Id] IN(`session`.Time_1)) AS T1,
									MAX($row[Id] IN(`session`.Time_2)) AS T2,
									MAX($row[Id] IN(`session`.Time_3)) AS T3,
									MAX($row[Id] IN(`session`.Time_4)) AS T4,
									MAX($row[Id] IN(`session`.Time_5)) AS T5,
									MAX($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
									`session`.S_id = 'F2'
								AND (
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
								)
                                    ";
									
					$countqry = "
													SELECT
									SUM($row[Id] IN(`session`.Time_1)) AS T1,
									SUM($row[Id] IN(`session`.Time_2)) AS T2,
									SUM($row[Id] IN(`session`.Time_3)) AS T3,
									SUM($row[Id] IN(`session`.Time_4)) AS T4,
									SUM($row[Id] IN(`session`.Time_5)) AS T5,
									SUM($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
	
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
									";	
                    
                    $attres = mysql_query($attqry) or die(mysql_error());
                    $inrow = mysql_fetch_row($attres);
                    
					$attcount = mysql_query($countqry) or die(mysql_error());
					$intablecount = mysql_fetch_row($attcount);
                    $inrowsum = $intablecount[0] + $intablecount[1] + $intablecount[2] + $intablecount[3] + $intablecount[4] + $intablecount[5];
                    
                    if ($inrowsum < 7)
					{
						if ($inrow[0] != 1) {
							$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[1] != 1) {
							$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_2 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[2] != 1) {
							$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_3 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[3] != 1) {
							$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_4 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[4] != 1) {
							$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_5 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[5] != 1) {
							$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_6 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
                    }
                    
                    
                    
                }
            }
            
            
            if ($revChoice['F3_id'] == 'x') {
                // get session slots
                $revquery = "SELECT * 
                    FROM `session`
                    WHERE Rev_id = $revChoice[Id] AND S_id = 'F3'";
                
                $revresults = mysql_query($revquery) or die(mysql_error());
                
                while ($sessionresults = mysql_fetch_assoc($revresults)) {
                    
                    $attqry = "
								SELECT
									MAX($row[Id] IN(`session`.Time_1)) AS T1,
									MAX($row[Id] IN(`session`.Time_2)) AS T2,
									MAX($row[Id] IN(`session`.Time_3)) AS T3,
									MAX($row[Id] IN(`session`.Time_4)) AS T4,
									MAX($row[Id] IN(`session`.Time_5)) AS T5,
									MAX($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
									`session`.S_id = 'F3'
								AND (
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
								)

                                    ";
					$countqry = "
								SELECT
									SUM($row[Id] IN(`session`.Time_1)) AS T1,
									SUM($row[Id] IN(`session`.Time_2)) AS T2,
									SUM($row[Id] IN(`session`.Time_3)) AS T3,
									SUM($row[Id] IN(`session`.Time_4)) AS T4,
									SUM($row[Id] IN(`session`.Time_5)) AS T5,
									SUM($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
	
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
									";	
                    
                    $attres = mysql_query($attqry) or die(mysql_error());
                    $inrow = mysql_fetch_row($attres);
					$attcount = mysql_query($countqry) or die(mysql_error());
					$intablecount = mysql_fetch_row($attcount);
                    $inrowsum = $intablecount[0] + $intablecount[1] + $intablecount[2] + $intablecount[3] + $intablecount[4] + $intablecount[5];
                    
						if ($inrowsum < 7)
						{

						if ($inrow[0] != 1) {
							$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[1] != 1) {
							$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_2 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[2] != 1) {
							$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_3 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[3] != 1) {
							$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_4 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[4] != 1) {
							$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_5 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[5] != 1) {
							$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_6 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
                    }
                    
                    
                }
            }
            
            
            if ($revChoice['S1_id'] == 'x') {
                // get session slots
                $revquery = "SELECT * 
                    FROM `session`
                    WHERE Rev_id = $revChoice[Id] AND S_id = 'S1'";
                
                $revresults = mysql_query($revquery) or die(mysql_error());
                
                while ($sessionresults = mysql_fetch_assoc($revresults)) {
                    
                    $attqry = "
								SELECT
									MAX($row[Id] IN(`session`.Time_1)) AS T1,
									MAX($row[Id] IN(`session`.Time_2)) AS T2,
									MAX($row[Id] IN(`session`.Time_3)) AS T3,
									MAX($row[Id] IN(`session`.Time_4)) AS T4,
									MAX($row[Id] IN(`session`.Time_5)) AS T5,
									MAX($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
									`session`.S_id = 'S1'
								AND (
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
								)
								";
								
					$countqry = "
								SELECT
									SUM($row[Id] IN(`session`.Time_1)) AS T1,
									SUM($row[Id] IN(`session`.Time_2)) AS T2,
									SUM($row[Id] IN(`session`.Time_3)) AS T3,
									SUM($row[Id] IN(`session`.Time_4)) AS T4,
									SUM($row[Id] IN(`session`.Time_5)) AS T5,
									SUM($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
	
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
									";
                    
                    $attres = mysql_query($attqry) or die(mysql_error());
                    $inrow = mysql_fetch_row($attres);
                    
					$attcount = mysql_query($countqry) or die(mysql_error());
					$intablecount = mysql_fetch_row($attcount);
                    $inrowsum = $intablecount[0] + $intablecount[1] + $intablecount[2] + $intablecount[3] + $intablecount[4] + $intablecount[5];
                    
                    if ($inrowsum < 7)
					{
						if ($inrow[0] != 1) {
							$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND  Time_1 IS NULL  AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[1] != 1) {
							$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_2 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[2] != 1) {
							$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_3 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[3] != 1) {
							$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_4 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[4] != 1) {
							$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_5 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[5] != 1) {
							$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_6 IS NULL AND S_id LIKE '$row[Day]1'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
                    }
                    
                    
                    
                }
            }
            
            
            if ($revChoice['S2_id'] == 'x') {
                // get session slots
                $revquery = "SELECT * 
                    FROM `session`
                    WHERE Rev_id = $revChoice[Id] AND S_id = 'S2'";
                
                $revresults = mysql_query($revquery) or die(mysql_error());
                
                while ($sessionresults = mysql_fetch_assoc($revresults)) {
                    
                    $attqry = "
								SELECT
									MAX($row[Id] IN(`session`.Time_1)) AS T1,
									MAX($row[Id] IN(`session`.Time_2)) AS T2,
									MAX($row[Id] IN(`session`.Time_3)) AS T3,
									MAX($row[Id] IN(`session`.Time_4)) AS T4,
									MAX($row[Id] IN(`session`.Time_5)) AS T5,
									MAX($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
									`session`.S_id = 'S2'
								AND (
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
								)
								";
								
					$countqry = "
								SELECT
									SUM($row[Id] IN(`session`.Time_1)) AS T1,
									SUM($row[Id] IN(`session`.Time_2)) AS T2,
									SUM($row[Id] IN(`session`.Time_3)) AS T3,
									SUM($row[Id] IN(`session`.Time_4)) AS T4,
									SUM($row[Id] IN(`session`.Time_5)) AS T5,
									SUM($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
	
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
									";
                    
                    $attres = mysql_query($attqry) or die(mysql_error());
                    $inrow = mysql_fetch_row($attres);
                    
					$attcount = mysql_query($countqry) or die(mysql_error());
					$intablecount = mysql_fetch_row($attcount);
                    $inrowsum = $intablecount[0] + $intablecount[1] + $intablecount[2] + $intablecount[3] + $intablecount[4] + $intablecount[5];
                    
                    if ($inrowsum < 7)
					{
						if ($inrow[0] != 1) {
							$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND  Time_1 IS NULL  AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[1] != 1) {
							$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_2 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[2] != 1) {
							$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_3 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[3] != 1) {
							$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_4 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[4] != 1) {
							$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_5 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[5] != 1) {
							$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_6 IS NULL AND S_id LIKE '$row[Day]2'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
                    }
                    
                    
                    
                }
            }
            
            
            
            if ($revChoice['S3_id'] == 'x') {
                // get session slots
                $revquery = "SELECT * 
                    FROM `session`
                    WHERE Rev_id = $revChoice[Id] AND S_id = 'S3'";
                
                $revresults = mysql_query($revquery) or die(mysql_error());
                
                while ($sessionresults = mysql_fetch_assoc($revresults)) {
                    
                    $attqry = "
								SELECT
									MAX($row[Id] IN(`session`.Time_1)) AS T1,
									MAX($row[Id] IN(`session`.Time_2)) AS T2,
									MAX($row[Id] IN(`session`.Time_3)) AS T3,
									MAX($row[Id] IN(`session`.Time_4)) AS T4,
									MAX($row[Id] IN(`session`.Time_5)) AS T5,
									MAX($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
									`session`.S_id = 'S3'
								AND (
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
								)
								";
								
					$countqry = "
								SELECT
									SUM($row[Id] IN(`session`.Time_1)) AS T1,
									SUM($row[Id] IN(`session`.Time_2)) AS T2,
									SUM($row[Id] IN(`session`.Time_3)) AS T3,
									SUM($row[Id] IN(`session`.Time_4)) AS T4,
									SUM($row[Id] IN(`session`.Time_5)) AS T5,
									SUM($row[Id] IN(`session`.Time_6)) AS T6
								FROM
									`session`
								WHERE
	
									`session`.Time_1 = $row[Id]
									OR `session`.Time_2 = $row[Id]
									OR `session`.Time_3 = $row[Id]
									OR `session`.Time_4 = $row[Id]
									OR `session`.Time_5 = $row[Id]
									OR `session`.Time_6 = $row[Id]
									";
                    
                    $attres = mysql_query($attqry) or die(mysql_error());
                    $inrow = mysql_fetch_row($attres);
                    
					$attcount = mysql_query($countqry) or die(mysql_error());
					$intablecount = mysql_fetch_row($attcount);
                    $inrowsum = $intablecount[0] + $intablecount[1] + $intablecount[2] + $intablecount[3] + $intablecount[4] + $intablecount[5];
                    
                    if ($inrowsum < 7)
					{
						if ($inrow[0] != 1) {
							$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND  Time_1 IS NULL  AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[1] != 1) {
							$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_2 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
							
						}
						
						if ($inrow[2] != 1) {
							$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_3 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						if ($inrow[3] != 1) {
							$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_4 IS NULL AND S_id LIKE '$row[Day]3'";
							mysql_query($insert);
							if (mysql_affected_rows() == 1)
								goto endofwhile;
						}
						
						
                    }
                    
                    
                    
                }
            }
            
            
           
        }
        
		endofwhile: 
    }
    
    
    
    
}



@mysql_close($con); // close connection to db




?>
