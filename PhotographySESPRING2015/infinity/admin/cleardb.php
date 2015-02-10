<?php

include 'config/db.php';


$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SET FOREIGN_KEY_CHECKS=0;";
$sql .= "DROP TABLE IF EXISTS `attendees`;";
$sql .= "CREATE TABLE `attendees` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Last_Name` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Day` char(255) DEFAULT NULL,
  `Choice_1_Last` varchar(255) DEFAULT NULL,
  `Choice_1_First` varchar(255) DEFAULT NULL,
  `Choice_2_Last` varchar(255) DEFAULT NULL,
  `Choice_2_First` varchar(255) DEFAULT NULL,
  `Choice_3_Last` varchar(255) DEFAULT NULL,
  `Choice_3_First` varchar(255) DEFAULT NULL,
  `Choice_4_Last` varchar(255) DEFAULT NULL,
  `Choice_4_First` varchar(255) DEFAULT NULL,
  `Choice_5_Last` varchar(255) DEFAULT NULL,
  `Choice_5_First` varchar(255) DEFAULT NULL,
  `Choice_6_Last` varchar(255) DEFAULT NULL,
  `Choice_6_First` varchar(255) DEFAULT NULL,
  `Choice_7_Last` varchar(255) DEFAULT NULL,
  `Choice_7_First` varchar(255) DEFAULT NULL,
  `Choice_8_Last` varchar(255) DEFAULT NULL,
  `Choice_8_First` varchar(255) DEFAULT NULL,
  `Choice_9_Last` varchar(255) DEFAULT NULL,
  `Choice_9_First` varchar(255) DEFAULT NULL,
  `Choice_10_Last` varchar(255) DEFAULT NULL,
  `Choice_10_First` varchar(255) DEFAULT NULL,
  `Choice_11_Last` varchar(255) DEFAULT NULL,
  `Choice_11_First` varchar(255) DEFAULT NULL,
  `Choice_12_Last` varchar(255) DEFAULT NULL,
  `Choice_12_First` varchar(255) DEFAULT NULL,
  `Choice_13_Last` varchar(255) DEFAULT NULL,
  `Choice_13_First` varchar(255) DEFAULT NULL,
  `Choice_14_Last` varchar(255) DEFAULT NULL,
  `Choice_14_First` varchar(255) DEFAULT NULL,
  `Choice_15_Last` varchar(255) DEFAULT NULL,
  `Choice_15_First` varchar(255) DEFAULT NULL,
  `Choice_16_Last` varchar(255) DEFAULT NULL,
  `Choice_16_First` varchar(255) DEFAULT NULL,
  `Choice_17_Last` varchar(255) DEFAULT NULL,
  `Choice_17_First` varchar(255) DEFAULT NULL,
  `Choice_18_Last` varchar(255) DEFAULT NULL,
  `Choice_18_First` varchar(255) DEFAULT NULL,
  `Choice_19_Last` varchar(255) DEFAULT NULL,
  `Choice_19_First` varchar(255) DEFAULT NULL,
  `Choice_20_Last` varchar(255) DEFAULT NULL,
  `Choice_20_First` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
";
$sql .= "DROP TABLE IF EXISTS `reviewers`;
";
$sql .= "CREATE TABLE `reviewers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Last_Name` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `F1_id` char(1) DEFAULT NULL,
  `F2_id` char(1) DEFAULT NULL,
  `F3_id` char(1) DEFAULT NULL,
  `S1_id` char(1) DEFAULT NULL,
  `S2_id` char(1) DEFAULT NULL,
  `S3_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`Id`,`Last_Name`,`First_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";
$sql .= "DROP TABLE IF EXISTS `session`;";
$sql .= "CREATE TABLE `session` (
  `S_id` varchar(255) NOT NULL,
  `Rev_id` int(255) NOT NULL,
  `Time_1` int(11) DEFAULT NULL,
  `Time_2` int(11) DEFAULT NULL,
  `Time_3` int(11) DEFAULT NULL,
  `Time_4` int(11) DEFAULT NULL,
  `Time_5` int(11) DEFAULT NULL,
  `Time_6` int(11) DEFAULT NULL,
  PRIMARY KEY (`S_id`,`Rev_id`),
  KEY `Rev_id` (`Rev_id`),
  CONSTRAINT `session_ibfk_1` FOREIGN KEY (`Rev_id`) REFERENCES `reviewers` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_multi_query($con,$sql);

mysqli_close($con);


?>