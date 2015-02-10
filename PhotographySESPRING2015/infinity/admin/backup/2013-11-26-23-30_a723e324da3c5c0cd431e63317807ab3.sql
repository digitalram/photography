
DROP TABLE IF EXISTS `reviewers`;

CREATE TABLE `reviewers` (
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
  `Table_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`,`Last_Name`,`First_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `attendees`;

CREATE TABLE `attendees` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

INSERT INTO users VALUES('1','admin','$2y$10$..ULO1Lk/E5KqZgOW1u8Oe7J1wy.IgMALT.oHMQoUnESVNieeyGyu','email@mail.com','1');
INSERT INTO users VALUES('2','user1','$2y$10$5U.DZbgQT18NcPkAt/VW8.ViKF/.o9afhUbN9ptd/wTGzjU/pvZa.','user@mail.com','0');
