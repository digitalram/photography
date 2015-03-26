-- This script should initialize the system to a state where scheduling is ready to take place

-- Wipe the system clean
TRUNCATE TABLE attendees;
TRUNCATE TABLE reviewers;
TRUNCATE TABLE session;
TRUNCATE TABLE registration_periods;
TRUNCATE TABLE keyword;
TRUNCATE TABLE opportunity;
DELETE FROM users WHERE user_id > 1; -- I'm leaving only the administrator here; change if you need more


-- Create registration period
INSERT INTO registration_periods( registration_period_id, year, attendee_from, attendee_until, reviewer_from, reviewer_until, max_tables, schedule_created ) VALUES
( 1, 2015, '20150301', '20150401', '20150201', '20150301', 4, 'no' );


-- Create users
INSERT INTO users(user_id, user_type, first_name, last_name, email_address, password, state, address, title, bio) 
VALUES 
(10,3,'Master','Splinter','test10@test.com','pw','TN','home','',''),
(11,3,'Leonardo','T.','test11@test.com','pw','TN','home','',''),
(12,3,'Michaelangelo','T.','test12@test.com','pw','TN','home','',''),
(13,3,'Donatello','T.','test13@test.com','pw','TN','home','',''),
(14,3,'Raphael','T.','test14@test.com','pw','TN','home','',''),
(15,3,'April','ONeil','test15@test.com','pw','TN','home','',''),

(16,3,'James','Kirk','test16@test.com','pw','TN','home','',''),
(17,3,'Iam','Spock','test17@test.com','pw','TN','home','',''),
(18,3,'Bones','McCoy','test18@test.com','pw','TN','home','',''),
(19,3,'Great','Scott','test19@test.com','pw','TN','home','',''),
(20,3,'Mr.','Sulu','test20@test.com','pw','TN','home','',''),

(21,2,'Anna','A','test21@test.com','pw','TN','home','',''),
(22,2,'Brian','B','test22@test.com','pw','TN','home','',''),
(23,2,'Carrie','C','test23@test.com','pw','TN','home','',''),
(24,2,'Dawn','D','test24@test.com','pw','TN','home','',''),
(25,2,'Ernie','E','test25@test.com','pw','TN','home','',''),
(26,2,'Frank','F','test26@test.com','pw','TN','home','',''),
(27,2,'Garry','G','test27@test.com','pw','TN','home','',''),
(28,2,'Harry','H','test28@test.com','pw','TN','home','',''),
(29,2,'Iam','I','test29@test.com','pw','TN','home','',''),
(30,2,'John','J','test30@test.com','pw','TN','home','',''),
(31,2,'Kevin','K','test31@test.com','pw','TN','home','',''),
(32,2,'Laura','L','test32@test.com','pw','TN','home','',''),
(33,2,'Maggie','M','test33@test.com','pw','TN','home','',''),
(34,2,'Norris','N','test34@test.com','pw','TN','home','',''),
(35,2,'Otto','O','test35@test.com','pw','TN','home','',''),
(36,2,'Peter','P','test36@test.com','pw','TN','home','',''),
(37,2,'Quincy','Q','test37@test.com','pw','TN','home','',''),
(38,2,'Rosanne','R','test38@test.com','pw','TN','home','',''),
(39,2,'Sally','S','test39@test.com','pw','TN','home','',''),
(40,2,'Tully','T','test40@test.com','pw','TN','home','',''),

(41,2,'xAnna','A','test41@test.com','pw','TN','home','',''),
(42,2,'xBrian','B','test42@test.com','pw','TN','home','',''),
(43,2,'xCarrie','C','test43@test.com','pw','TN','home','',''),
(44,2,'xDawn','D','test44@test.com','pw','TN','home','',''),
(45,2,'xErnie','E','test45@test.com','pw','TN','home','',''),
(46,2,'xFrank','F','test46@test.com','pw','TN','home','',''),
(47,2,'xGarry','G','test47@test.com','pw','TN','home','',''),
(48,2,'xHarry','H','test48@test.com','pw','TN','home','',''),
(49,2,'xIam','I','test49@test.com','pw','TN','home','',''),
(50,2,'xJohn','J','test50@test.com','pw','TN','home','',''),
(51,2,'xKevin','K','test51@test.com','pw','TN','home','',''),
(52,2,'xLaura','L','test52@test.com','pw','TN','home','',''),
(53,2,'xMaggie','M','test53@test.com','pw','TN','home','',''),
(54,2,'xNorris','N','test54@test.com','pw','TN','home','',''),
(55,2,'xOtto','O','test55@test.com','pw','TN','home','',''),
(56,2,'xPeter','P','test56@test.com','pw','TN','home','',''),
(57,2,'xQuincy','Q','test57@test.com','pw','TN','home','',''),
(58,2,'xRosanne','R','test58@test.com','pw','TN','home','',''),
(59,2,'xSally','S','test59@test.com','pw','TN','home','',''),
(60,2,'xTully','T','test60@test.com','pw','TN','home','','');


-- Insert reviewers
INSERT INTO reviewers(reviewer_id, user_id, reviewer_type, friday_morning, friday_midday, friday_afternoon, saturday_morning, saturday_midday, saturday_afternoon) 
VALUES 
(1,10,2,'x','x',NULL,NULL,NULL,NULL), 
(2,11,2,'x','x',NULL,NULL,NULL,NULL),
(3,12,2,NULL,'x','x',NULL,NULL,NULL),
(4,13,2,NULL,'x','x',NULL,NULL,NULL),
(5,14,2,'x',NULL,'x',NULL,NULL,NULL),
(6,15,2,'x',NULL,'x',NULL,NULL,NULL),
(7,16,1,NULL,NULL,NULL,'x','x',NULL),
(8,17,1,NULL,NULL,NULL,'x','x',NULL),
(9,18,1,NULL,NULL,NULL,NULL,'x','x'),
(10,19,1,NULL,NULL,NULL,NULL,'x','x'),
(11,20,1,NULL,NULL,NULL,'x',NULL,'x');


-- Insert reviewer keywords
-- *Had to change keyword table to allow null for attendee_id
INSERT INTO keyword( keyword_id, reviewer_id, keyword_definition_id ) VALUES
(1,1,1),
(2,2,2),
(3,2,3),
(4,3,1),
(5,4,4),
(6,4,5),
(7,5,7),
(8,6,2),
(9,6,8),

(10,7,9),
(11,8,1);


-- Insert reviewer opportunities
-- *Had to change opportunity table to allow null for attendee_id
INSERT INTO opportunity( opportunity_id, reviewer_id, opportunity_definition_id ) VALUES
(1,1,1),
(2,2,2),
(3,2,3),
(4,3,3),
(5,3,4),

(6,7,5),
(7,8,6);



-- Insert attendees
INSERT INTO attendees(attendee_id, user_id, attendee_type, reviewer_id1, reviewer_id2, reviewer_id3, reviewer_id4, reviewer_id5, reviewer_id6, reviewer_id7, reviewer_id8, reviewer_id9, reviewer_id10, reviewer_id11, reviewer_id12, reviewer_id13, reviewer_id14, reviewer_id15, reviewer_id16, reviewer_id17, reviewer_id18, reviewer_id19, reviewer_id20) VALUES 
(1,21,1,10,11,12,13,14,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,22,1,15,14,13,12,11,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,23,1,10,12,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,24,1,10,11,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(5,25,1,11,10,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(6,26,1,12,11,10,13,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(7,27,1,12,10,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(8,28,1,13,15,11,10,12,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(9,29,1,15,10,12,13,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(10,30,1,10,13,12,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(11,31,1,12,11,10,13,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(12,32,1,10,14,12,13,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(13,33,1,11,12,13,10,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(14,34,1,12,10,11,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(15,35,1,10,15,11,13,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(16,36,1,11,14,10,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(17,37,1,10,15,12,13,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(18,38,1,13,10,11,12,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(19,39,1,12,11,13,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(20,40,1,10,11,14,13,12,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),

(21,41,2,16,19,17,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(22,42,2,17,16,19,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(23,43,2,16,20,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(24,44,2,17,18,16,19,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(25,45,2,20,19,17,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(26,46,2,16,18,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(27,47,2,19,16,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(28,48,2,17,18,16,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(29,49,2,20,17,19,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(30,50,2,18,16,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(31,51,2,16,17,19,18,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(32,52,2,17,16,18,19,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(33,53,2,17,19,18,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(34,54,2,20,16,18,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(35,55,2,16,17,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(36,56,2,18,16,17,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(37,57,2,17,20,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(38,58,2,19,16,18,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(39,59,2,16,18,17,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(40,60,2,18,17,19,16,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


-- Insert attendee keywords
-- *Had to change keyword table to allow null for reviewer_id
INSERT INTO keyword( keyword_id, attendee_id, keyword_definition_id ) VALUES
(100,1,1),
(101,2,2),
(102,2,6),
(103,3,5),
(104,3,6),
(105,4,7),

(106,21,1),
(107,22,8),
(108,22,3),
(109,23,4);


-- Insert attendee opportunities
-- *Had to change opportunity table to allow null for reviewer_id
INSERT INTO opportunity( opportunity_id, attendee_id, opportunity_definition_id ) VALUES
(101,1,1),
(102,2,5),
(103,2,2),
(104,3,3),
(105,4,1),
(106,4,4),

(107,21,1),
(108,21,3),
(109,22,5),
(110,23,5);

