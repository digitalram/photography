/*
Navicat MySQL Data Transfer

Source Server         : infinity
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : infinity

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2013-11-14 12:28:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for attendees
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of attendees
-- ----------------------------
INSERT INTO `attendees` VALUES ('17', 'Aguar', ' Forrest', 'email', 'F', 'Abramowski', ' Nate', 'Craig', ' Ashley', 'Harkins', ' Kim', 'Lange', ' Alicia', 'Phelps', ' Brent', 'Strembicki', ' Stan', 'Allen', ' Liz', 'Hallock', ' Patti', 'Jost', ' Scott', 'Lewis', ' Phillip Andrew', 'Phipps', ' Sandra-Lee', 'Taylor', ' Mark', 'Anand', ' Julie', 'Dalglish', ' Mia', 'Hiatt', ' Akemi', 'Long', ' Jonathan', 'Pickering', ' Walker', 'Thalken', ' Constance', 'Anderton', ' Jeanne', 'Dowda', ' Stephanie');
INSERT INTO `attendees` VALUES ('18', 'Albertson', ' Nick', 'email', 'F', 'Allen', ' Liz', 'Curto', ' Jeff', 'Hassell', ' Ken', 'Lewis', ' Phillip Andrew', 'Phipps', ' Sandra-Lee', 'Taylor', ' Mark', 'Anand', ' Julie', 'Dalglish', ' Mia', 'Hiatt', ' Akemi', 'Long', ' Jonathan', 'Pickering', ' Walker', 'Thalken', ' Constance', 'Hallock', ' Patti', 'Dowda', ' Stephanie', 'Hochhalter', ' Aspen', 'Malloy', ' Mark', 'Pishnery', ' Judith', 'Toalson', ' Chris', 'Avram', ' Danielle', 'Dunlap', ' Paul');
INSERT INTO `attendees` VALUES ('19', 'Alborno', ' Shireen', 'email', 'F', 'Taylor', ' Mark', 'Dalglish', ' Mia', 'Hiatt', ' Akemi', 'Long', ' Jonathan', 'Pickering', ' Walker', 'Taylor', ' Mark', 'Anderton', ' Jeanne', 'Dowda', ' Stephanie', 'Hochhalter', ' Aspen', 'Malloy', ' Mark', 'Pishnery', ' Judith', 'Toalson', ' Chris', 'Avram', ' Danielle', 'Dunlap', ' Paul', 'Hoffman', ' Kenneth', 'Mann', ' Paho', 'Politzer', ' David', 'Todd-Raque', ' Susan', 'Babcox', ' Wendy', 'Dusseault', ' Ruth');
INSERT INTO `attendees` VALUES ('20', 'Alonzo', ' Elle', 'email', 'F', 'Avram', ' Danielle', 'Dunlap', ' Paul', 'Craig', ' Ashley', 'Mann', ' Paho', 'Politzer', ' David', 'Todd-Raque', ' Susan', 'Babcox', ' Wendy', 'Dusseault', ' Ruth', 'Hogan', ' Annie', 'Millard', ' Patrick', 'Pritchard', ' Janet', 'Tomasek', ' Aimee', 'Bagus', ' Iwan', 'Fincannon', ' Rod', 'Holm', ' Anni', 'Miller', ' Amy', 'Reisert', ' Rachel', 'Tomberlin', ' Carrie', 'Blakely', ' George', 'Floyd', ' Nancy');
INSERT INTO `attendees` VALUES ('21', 'Alter', ' Jennifer', 'email', 'F', 'Babcox', ' Wendy', 'Dusseault', ' Ruth', 'Hogan', ' Annie', 'Millard', ' Patrick', 'Abramowski', ' Nate', 'Tomasek', ' Aimee', 'Bagus', ' Iwan', 'Fincannon', ' Rod', 'Holm', ' Anni', 'Miller', ' Amy', 'Reisert', ' Rachel', 'Tomberlin', ' Carrie', 'Blakely', ' George', 'Floyd', ' Nancy', 'Holmgren', ' John', 'Mullins', ' Colleen', 'Rowe', ' Libby', 'Tomberlin', ' Eric', 'Bogre', ' Michelle', 'Fox', ' Pam');
INSERT INTO `attendees` VALUES ('22', 'Anderson', ' Lynn', 'email', 'F', 'Bagus', ' Iwan', 'Fincannon', ' Rod', 'Abramowski', ' Nate', 'Miller', ' Amy', 'Reisert', ' Rachel', 'Tomberlin', ' Carrie', 'Blakely', ' George', 'Floyd', ' Nancy', 'Holmgren', ' John', 'Mullins', ' Colleen', 'Rowe', ' Libby', 'Tomberlin', ' Eric', 'Bogre', ' Michelle', 'Fox', ' Pam', 'Holsopple', ' Jerry', 'Nolan', ' Rebecca', 'Russell', ' Jacinda', 'Turk', ' Elizabeth', 'Bright', ' Sheila Pree', 'Francisco', ' Jason');
INSERT INTO `attendees` VALUES ('23', 'Angeletti', ' Giordano', 'email', 'F', 'Blakely', ' George', 'Floyd', ' Nancy', 'Holmgren', ' John', 'Mullins', ' Colleen', 'Rowe', ' Libby', 'Jost', ' Scott', 'Craig', ' Ashley', 'Fox', ' Pam', 'Holsopple', ' Jerry', 'Nolan', ' Rebecca', 'Russell', ' Jacinda', 'Turk', ' Elizabeth', 'Bright', ' Sheila Pree', 'Francisco', ' Jason', 'Houghton', ' Barbara', 'North', ' Kenda', 'Sell', ' Michael', 'Veasey-Cullors', ' Colette', 'Bugg', ' Peter', 'Goldchain', ' Rafael');
INSERT INTO `attendees` VALUES ('24', 'Aoyama', ' Takashi', 'email', 'F', 'Bogre', ' Michelle', 'Fox', ' Pam', 'Holsopple', ' Jerry', 'Nolan', ' Rebecca', 'Russell', ' Jacinda', 'Turk', ' Elizabeth', 'Bright', ' Sheila Pree', 'Francisco', ' Jason', 'Houghton', ' Barbara', 'North', ' Kenda', 'Sell', ' Michael', 'Veasey-Cullors', ' Colette', 'Bugg', ' Peter', 'Goldchain', ' Rafael', 'Jacono', ' Adam', 'OBrien', ' Andrew', 'Shank', ' Christine ', 'Visser', ' Deirdre', 'Carmona', ' Javier', 'Gomez', ' Emily');
INSERT INTO `attendees` VALUES ('25', 'Apostolacus', ' Theodore', 'email', 'S', 'Bright', ' Sheila Pree', 'Abramowski', ' Nate', 'Houghton', ' Barbara', 'North', ' Kenda', 'Sell', ' Michael', 'Veasey-Cullors', ' Colette', 'Bugg', ' Peter', 'Goldchain', ' Rafael', 'Jacono', ' Adam', 'OBrien', ' Andrew', 'Shank', ' Christine ', 'Visser', ' Deirdre', 'Carmona', ' Javier', 'Gomez', ' Emily', 'Jayaswal', ' Leena', 'ONeil', ' Rob', 'Shaw', ' Tate', 'Waligore', ' Marilyn', 'Chen', ' Jamason', 'Gootee', ' Marita');
INSERT INTO `attendees` VALUES ('26', 'Appleton', ' Kalee', 'email', 'S', 'Bugg', ' Peter', 'Goldchain', ' Rafael', 'Jacono', ' Adam', 'OBrien', ' Andrew', 'Shank', ' Christine ', 'Jost', ' Scott', 'Carmona', ' Javier', 'Gomez', ' Emily', 'Jayaswal', ' Leena', 'ONeil', ' Rob', 'Shaw', ' Tate', 'Waligore', ' Marilyn', 'Chen', ' Jamason', 'Gootee', ' Marita', 'Johnson', ' Steven', 'Owen Murakami', ' Ginger', 'Sherwin', ' Michael', 'Warpinski', ' Terri', 'Christiansen Erb', ' Joy', 'Grenberg', ' Elizabeth');
INSERT INTO `attendees` VALUES ('27', 'Arden', ' Ellen', 'email', 'S', 'Carmona', ' Javier', 'Gomez', ' Emily', 'Jayaswal', ' Leena', 'ONeil', ' Rob', 'Shaw', ' Tate', 'Waligore', ' Marilyn', 'Chen', ' Jamason', 'Gootee', ' Marita', 'Johnson', ' Steven', 'Owen Murakami', ' Ginger', 'Sherwin', ' Michael', 'Craig', ' Ashley', 'Christiansen Erb', ' Joy', 'Grenberg', ' Elizabeth', 'Johnstone', ' Mary Shannon', 'Peroni', ' Kristen Fecker', 'Slemmons', ' Rod', 'Weber', ' Scott', 'Clark', ' Doug', 'Hallock', ' Patti');
INSERT INTO `attendees` VALUES ('28', 'Baker', ' Elizabeth', 'email', 'S', 'Chen', ' Jamason', 'Gootee', ' Marita', 'Johnson', ' Steven', 'Owen Murakami', ' Ginger', 'Sherwin', ' Michael', 'Warpinski', ' Terri', 'Christiansen Erb', ' Joy', 'Grenberg', ' Elizabeth', 'Johnstone', ' Mary Shannon', 'Peroni', ' Kristen Fecker', 'Slemmons', ' Rod', 'Weber', ' Scott', 'Clark', ' Doug', 'Hallock', ' Patti', 'Jost', ' Scott', 'Petranek', ' Stefan', 'Smith', ' Stafford', 'Wrangle', ' Anderson', 'Clowney', ' Matthew', 'Hamrick', ' Frank');
INSERT INTO `attendees` VALUES ('29', 'Bakken', ' Patrick', 'email', 'S', 'Christiansen Erb', ' Joy', 'Grenberg', ' Elizabeth', 'Johnstone', ' Mary Shannon', 'Peroni', ' Kristen Fecker', 'Slemmons', ' Rod', 'Taylor', ' Mark', 'Clark', ' Doug', 'Hallock', ' Patti', 'Jost', ' Scott', 'Petranek', ' Stefan', 'Smith', ' Stafford', 'Wrangle', ' Anderson', 'Clowney', ' Matthew', 'Hamrick', ' Frank', 'Kariko', ' Daniel', 'Petry', ' Ric', 'Stone ', ' LaNola', 'Wyatt', ' Laine', 'Cooper', ' Wendy', 'Happel Christian', ' Peter');
INSERT INTO `attendees` VALUES ('30', 'Ballout', ' NourAlHoda', 'email', 'S', 'Abramowski', ' Nate', 'Hallock', ' Patti', 'Jost', ' Scott', 'Petranek', ' Stefan', 'Smith', ' Stafford', 'Wrangle', ' Anderson', 'Clowney', ' Matthew', 'Hamrick', ' Frank', 'Kariko', ' Daniel', 'Petry', ' Ric', 'Stone ', ' LaNola', 'Wyatt', ' Laine', 'Cooper', ' Wendy', 'Happel Christian', ' Peter', 'Keough', ' Patrick', 'Peven', ' Michael', 'Strelecki', ' Greg', 'Weber', ' Scott', 'Craig', ' Ashley', 'Harkins', ' Kim');
INSERT INTO `attendees` VALUES ('31', 'Banuelos', ' Yair', 'email', 'S', 'Clowney', ' Matthew', 'Hamrick', ' Frank', 'Kariko', ' Daniel', 'Petry', ' Ric', 'Stone ', ' LaNola', 'Wyatt', ' Laine', 'Cooper', ' Wendy', 'Happel Christian', ' Peter', 'Keough', ' Patrick', 'Peven', ' Michael', 'Strelecki', ' Greg', 'Abramowski', ' Nate', 'Craig', ' Ashley', 'Harkins', ' Kim', 'Lange', ' Alicia', 'Phelps', ' Brent', 'Strembicki', ' Stan', 'Allen', ' Liz', 'Curto', ' Jeff', 'Hassell', ' Ken');
INSERT INTO `attendees` VALUES ('32', 'Barner', ' Zach', 'email', 'S', 'Cooper', ' Wendy', 'Happel Christian', ' Peter', 'Keough', ' Patrick', 'Peven', ' Michael', 'Strelecki', ' Greg', 'Abramowski', ' Nate', 'Craig', ' Ashley', 'Hallock', ' Patti', 'Lange', ' Alicia', 'Phelps', ' Brent', 'Strembicki', ' Stan', 'Allen', ' Liz', 'Curto', ' Jeff', 'Hassell', ' Ken', 'Lewis', ' Phillip Andrew', 'Phipps', ' Sandra-Lee', 'Taylor', ' Mark', 'Anand', ' Julie', 'Dalglish', ' Mia', 'Hiatt', ' Akemi');

-- ----------------------------
-- Table structure for reviewers
-- ----------------------------
DROP TABLE IF EXISTS `reviewers`;
CREATE TABLE `reviewers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Last_Name` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `F1_id` char(1) NOT NULL,
  `F2_id` char(1) NOT NULL,
  `F3_id` char(1) NOT NULL,
  `S1_id` char(1) NOT NULL,
  `S2_id` char(1) NOT NULL,
  `S3_id` char(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reviewers
-- ----------------------------
INSERT INTO `reviewers` VALUES ('49', 'Long', ' Jonathan', '54@email.com', '', 'x', '', '', '', '');
INSERT INTO `reviewers` VALUES ('50', 'Malloy', ' Mark', '55@email.com', '', '', 'x', '', '', '');
INSERT INTO `reviewers` VALUES ('51', 'Mann', ' Paho', '56@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('52', 'Millard', ' Patrick', '57@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('53', 'Miller', ' Amy', '58@email.com', '', '', 'x', '', '', '');
INSERT INTO `reviewers` VALUES ('54', 'Mullins', ' Colleen', '59@email.com', '', '', 'x', '', '', '');
INSERT INTO `reviewers` VALUES ('55', 'Nolan', ' Rebecca', '60@email.com', '', '', 'x', '', '', '');
INSERT INTO `reviewers` VALUES ('56', 'North', ' Kenda', '61@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('57', 'OBrien', ' Andrew', '62@email.com', '', 'x', '', '', '', '');
INSERT INTO `reviewers` VALUES ('58', 'ONeil', ' Rob', '63@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('59', 'Owen Murakami', ' Ginger', '64@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('60', 'Peroni', ' Kristen Fecker', '65@email.com', '', 'x', '', '', '', '');
INSERT INTO `reviewers` VALUES ('61', 'Petranek', ' Stefan', '66@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('62', 'Petry', ' Ric', '67@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('63', 'Peven', ' Michael', '68@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('64', 'Phelps', ' Brent', '69@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('65', 'Phipps', ' Sandra-Lee', '70@email.com', '', '', 'x', '', '', '');
INSERT INTO `reviewers` VALUES ('66', 'Pickering', ' Walker', '71@email.com', '', 'x', '', '', '', '');
INSERT INTO `reviewers` VALUES ('67', 'Pishnery', ' Judith', '72@email.com', '', '', 'x', '', '', '');
INSERT INTO `reviewers` VALUES ('68', 'Politzer', ' David', '73@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('69', 'Pritchard', ' Janet', '74@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('70', 'Reisert', ' Rachel', '75@email.com', 'x', '', '', '', '', '');
INSERT INTO `reviewers` VALUES ('71', 'Rowe', ' Libby', '76@email.com', '', '', '', '', '', 'x');
INSERT INTO `reviewers` VALUES ('72', 'Russell', ' Jacinda', '77@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('73', 'Sell', ' Michael', '78@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('74', 'Shank', ' Christine ', '79@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('75', 'Shaw', ' Tate', '80@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('76', 'Sherwin', ' Michael', '81@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('77', 'Slemmons', ' Rod', '82@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('78', 'Smith', ' Stafford', '83@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('79', 'Stone ', ' LaNola', '84@email.com', '', '', '', '', '', 'x');
INSERT INTO `reviewers` VALUES ('80', 'Strelecki', ' Greg', '85@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('81', 'Strembicki', ' Stan', '86@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('82', 'Taylor', ' Mark', '87@email.com', '', '', '', '', '', 'x');
INSERT INTO `reviewers` VALUES ('83', 'Thalken', ' Constance', '88@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('84', 'Toalson', ' Chris', '89@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('85', 'Todd-Raque', ' Susan', '90@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('86', 'Tomasek', ' Aimee', '91@email.com', '', '', '', '', '', 'x');
INSERT INTO `reviewers` VALUES ('87', 'Tomberlin', ' Carrie', '92@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('88', 'Tomberlin', ' Eric', '93@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('89', 'Turk', ' Elizabeth', '94@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('90', 'Veasey-Cullors', ' Colette', '95@email.com', '', '', '', '', 'x', '');
INSERT INTO `reviewers` VALUES ('91', 'Visser', ' Deirdre', '96@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('92', 'Waligore', ' Marilyn', '97@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('93', 'Warpinski', ' Terri', '98@email.com', '', '', '', 'x', '', '');
INSERT INTO `reviewers` VALUES ('94', 'Weber', ' Scott', '99@email.com', '', '', '', '', '', 'x');
INSERT INTO `reviewers` VALUES ('95', 'Wrangle', ' Anderson', '100@email.com', '', '', '', '', '', 'x');
INSERT INTO `reviewers` VALUES ('96', 'Wyatt', ' Laine', '101@email.com', '', '', '', 'x', '', '');

-- ----------------------------
-- Table structure for session
-- ----------------------------
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

-- ----------------------------
-- Records of session
-- ----------------------------
INSERT INTO `session` VALUES ('F1', '51', '20', null, null, null, null, null);
INSERT INTO `session` VALUES ('F1', '52', '21', null, '20', null, null, null);
INSERT INTO `session` VALUES ('F1', '56', '25', null, null, null, null, null);
INSERT INTO `session` VALUES ('F1', '58', '27', null, '26', null, null, '25');
INSERT INTO `session` VALUES ('F1', '59', '28', null, null, null, '26', null);
INSERT INTO `session` VALUES ('F1', '61', '30', null, null, null, '29', null);
INSERT INTO `session` VALUES ('F1', '62', '31', null, null, null, null, null);
INSERT INTO `session` VALUES ('F1', '63', '32', null, null, null, null, null);
INSERT INTO `session` VALUES ('F1', '64', '17', null, '32', null, null, null);
INSERT INTO `session` VALUES ('F1', '68', null, '20', null, null, null, null);
INSERT INTO `session` VALUES ('F1', '69', null, null, null, '20', null, null);
INSERT INTO `session` VALUES ('F1', '70', null, '22', null, '21', null, null);
INSERT INTO `session` VALUES ('F2', '49', null, null, null, null, '17', null);
INSERT INTO `session` VALUES ('F2', '57', '26', null, '25', null, null, null);
INSERT INTO `session` VALUES ('F2', '60', '29', null, null, '28', null, null);
INSERT INTO `session` VALUES ('F2', '66', null, null, null, null, '18', '17');
INSERT INTO `session` VALUES ('F3', '50', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('F3', '53', '22', null, '21', null, null, '20');
INSERT INTO `session` VALUES ('F3', '54', '23', null, null, null, '21', null);
INSERT INTO `session` VALUES ('F3', '55', '24', null, null, null, null, null);
INSERT INTO `session` VALUES ('F3', '65', '18', null, '17', null, '32', null);
INSERT INTO `session` VALUES ('F3', '67', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S1', '73', null, '25', null, null, null, null);
INSERT INTO `session` VALUES ('S1', '74', null, '26', null, '25', null, null);
INSERT INTO `session` VALUES ('S1', '76', null, '28', null, null, '27', '26');
INSERT INTO `session` VALUES ('S1', '77', null, '29', null, null, null, null);
INSERT INTO `session` VALUES ('S1', '80', null, '32', null, null, null, null);
INSERT INTO `session` VALUES ('S1', '81', null, '17', null, '32', null, null);
INSERT INTO `session` VALUES ('S1', '83', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S1', '91', null, null, null, null, '25', null);
INSERT INTO `session` VALUES ('S1', '92', null, '27', null, '26', null, null);
INSERT INTO `session` VALUES ('S1', '93', null, null, '28', null, null, null);
INSERT INTO `session` VALUES ('S1', '96', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '72', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '75', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '78', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '84', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '85', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '87', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '88', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '89', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S2', '90', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S3', '71', null, null, null, null, '22', '21');
INSERT INTO `session` VALUES ('S3', '79', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S3', '82', '23', '18', '29', '17', '19', '32');
INSERT INTO `session` VALUES ('S3', '86', null, '21', null, null, '20', null);
INSERT INTO `session` VALUES ('S3', '94', null, null, null, null, null, null);
INSERT INTO `session` VALUES ('S3', '95', null, null, null, null, null, '29');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '$2y$10$yyYLCC2uOOs7aZ93aVwONu0ovqDv.8B.xgm9zOUxB6tTi3zxZW5/i', 'email@mail.com');
