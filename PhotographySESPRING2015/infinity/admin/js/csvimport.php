<?php

include '/config/db.php';
$fieldseparator = ",";
$lineseparator = "\n";
$reviewers_f = "uploads/reviewers_f.csv";
$reviewers_s = "uploads/reviewers_s.csv";
$attendee_f = "uploads/attendees_f.csv";
$attendee_s = "uploads/attendees_s.csv";


$con = @mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
@mysql_select_db(DB_NAME) or die(mysql_error());
$lines = 0;
$queries = "";
$linearray = array();


if (!file_exists($attendee_f)) {
        echo "Attendee_F file not found. Make sure you specified the correct path.\n";
        exit;
}
$file = fopen($attendee_f,"r");
if (!$file) {
        echo "Error opening Attendee_F file.\n";
        exit;
}
$size = filesize($attendee_f);

if (!$size) {
        echo "Attendee_F file is empty.\n";
        exit;
}
$csvcontent = fread($file,$size);
fclose($file);


foreach(explode($lineseparator,$csvcontent) as $line) {
        $lines++;
        $line = trim($line," \t");
        $line = trim($line," ");
        $line = trim($line,"'");
        $line = str_replace("\r","",$line);
        /************************************
        This line escapes the special character. remove it if entries are already escaped in the csv file
        ************************************/
         $line = str_replace("'","\'",$line);
        /*************************************/
        $linearray = explode($fieldseparator,$line);
        array_splice($linearray, 3, 0, 'F');
        $linemysql = implode("','",$linearray);

        
        

        $query = "insert into attendees values('','$linemysql');";

        $queries .= $query . "\n";
        @mysql_query($query);
}



if (!file_exists($attendee_s)) {
        echo "Attendee_S file not found. Make sure you specified the correct path.\n";
        exit;
}
$file = fopen($attendee_s,"r");
if (!$file) {
        echo "Error opening Attendee_S file.\n";
        exit;
}
$size = filesize($attendee_s);
if (!$size) {
        echo "Attendee_S file is empty.\n";
        exit;
}
$csvcontent = fread($file,$size);
fclose($file);


foreach(explode($lineseparator,$csvcontent) as $line) {
        $lines++;
        $line = trim($line," \t");
        $line = trim($line," ");
        $line = trim($line,"'");
        $line = str_replace("\r","",$line);
        /************************************
        This line escapes the special character. remove it if entries are already escaped in the csv file
        ************************************/
         $line = str_replace("'","\'",$line);
        /*************************************/
        $linearray = explode($fieldseparator,$line);
        array_splice($linearray, 3, 0, 'S');
        $linemysql = implode("','",$linearray);

        
        
        //try catch 3 lines on error throw e 
        $query = "insert into attendees values('','$linemysql');";

        $queries .= $query . "\n";
        @mysql_query($query);
}


/* REVIEWERS FRI */
///////////////////////////////////////////////////////////////////////////////////////////////

if (!file_exists($reviewers_f)) {
        echo "Reviewers file not found. Make sure you specified the correct path.\n";
        exit;
}
$file = fopen($reviewers_f,"r");
if (!$file) {
        echo "Error opening Friday reviewers file.\n";
        exit;
}
$size = filesize($reviewers_f);
if (!$size) {
        echo "Friday reviewers file is empty.\n";
        exit;
}
$csvcontent = fread($file,$size);
fclose($file);



foreach(explode($lineseparator,$csvcontent) as $line) {
        $lines++;
        $line = trim($line," \t");
        $line = trim($line," ");
        $line = trim($line,"'");
        $line = str_replace("\r","",$line);
        /************************************
        This line escapes the special character. remove it if entries are already escaped in the csv file
        ************************************/
         $line = str_replace("'","\'",$line);
        /*************************************/
        $linearray = explode($fieldseparator,$line);
        array_push($linearray, '','','');
        $linemysql = implode("','",$linearray);
        
        

        $query = "insert into reviewers values('','$linemysql');";

        $queries .= $query . "\n";
        @mysql_query($query);
}



// reviewers sat
//////////////////////////////////////////////////////////////////////////////////////////////
if (!file_exists($reviewers_s)) {
        echo "Saturday reviewers file not found. Make sure you specified the correct path.\n";
        exit;
}
$file = fopen($reviewers_s,"r");
if (!$file) {
        echo "Error opening  Saturday reviewers file.\n";
        exit;
}
$size = filesize($reviewers_s);
if (!$size) {
        echo "Saturday reviewers file is empty.\n";
        exit;
}
$csvcontent = fread($file,$size);
fclose($file);



foreach(explode($lineseparator,$csvcontent) as $line) {
        $lines++;
        $line = trim($line," \t");
        $line = trim($line," ");
        $line = trim($line,"'");
        $line = str_replace("\r","",$line);
        /************************************
        This line escapes the special character. remove it if entries are already escaped in the csv file
        ************************************/
         $line = str_replace("'","\'",$line);
        /*************************************/
        $linearray = explode($fieldseparator,$line);
        $arr = array('','','');
        array_splice($linearray, 3, 0, $arr);
        $linemysql = implode("','",$linearray);

        

        $query = "insert into reviewers values('','$linemysql');";

        $queries .= $query . "\n";
        @mysql_query($query);
}

echo '<font color=\'green\'>Files parsed into database successfully!</font><br>';



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

echo '<font color=\'green\'>Friday sessions created successfully!</font><br>';

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

echo '<font color=\'green\'>Saturday sessions created successfully!</font><br>';

@mysql_close($con);



?>