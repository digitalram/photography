CREATE DATABASE SPE_CONVENTION;

CREATE TABLE SPE_CONVENTION.REVIEWER
(
Fname varchar (255) NOT NULL,
Lname varchar (255) NOT NULL,
Title varchar (255) NOT NULL,
Instit varchar (255) NOT NULL,
Email varchar (255) NOT NULL,
Website varchar (255) NOT NULL,
Addr1 varchar (255) NOT NULL,
Addr2 varchar (255),
City varchar (255) NOT NULL,
State varchar (2) NOT NULL,
Zip int,
Country varchar (255) NOT NULL,
Phone varchar (255) NOT NULL,
Membership varchar (255) NOT NULL,
FeeWaiver BINARY(1), # 0=no 1=yes
D1Morning BINARY(1) DEFAULT 0,
D1Midday BINARY(1) DEFAULT 0,
D1Afternoon BINARY(1) DEFAULT 0,
D2Morning BINARY(1) DEFAULT 0,
D2Midday BINARY(1) DEFAULT 0,
D2Afternoon BINARY(1) DEFAULT 0,
WorkLevel varchar(4) NOT NULL, # stud, prof, both
Comments varchar(300),
PRIMARY KEY (Email)
);

CREATE TABLE SPE_CONVENTION.REV_KEYWORD
(
Email varchar(255),
Keyword varchar(255),
PRIMARY KEY (Email, Keyword),
FOREIGN KEY (Email) REFERENCES REVIEWER (Email)
);

CREATE TABLE SPE_CONVENTION.REV_OPPORTUNITY
(
Email varchar(255),
Opportunity varchar(255),
PRIMARY KEY (Email, Opportunity),
FOREIGN KEY (Email) REFERENCES REVIEWER (Email)
);

CREATE TABLE SPE_CONVENTION.STUDENT
(
Fname varchar(255) NOT NULL,
Lname varchar(255) NOT NULL,
Email varchar(255) PRIMARY KEY,
Pref1 varchar(255) NOT NULL,
Pref2 varchar(255) NOT NULL,
Pref3 varchar(255) NOT NULL,
Pref4 varchar(255) NOT NULL,
Pref5 varchar(255) NOT NULL,
Pref6 varchar(255) NOT NULL,
Pref7 varchar(255) NOT NULL,
Pref8 varchar(255) NOT NULL,
Pref9 varchar(255) NOT NULL,
Pref10 varchar(255) NOT NULL,
Pref11 varchar(255) NOT NULL,
Pref12 varchar(255) NOT NULL,
Pref13 varchar(255) NOT NULL,
Pref14 varchar(255) NOT NULL,
Pref15 varchar(255) NOT NULL,
Pref16 varchar(255) NOT NULL,
Pref17 varchar(255) NOT NULL,
Pref18 varchar(255) NOT NULL,
Pref19 varchar(255) NOT NULL,
Pref20 varchar(255) NOT NULL
);

CREATE TABLE SPE_CONVENTION.PROFESSIONAL
(
Fname varchar(255) NOT NULL,
Lname varchar(255) NOT NULL,
Email varchar(255) PRIMARY KEY,
Pref1 varchar(255) NOT NULL,
Pref2 varchar(255) NOT NULL,
Pref3 varchar(255) NOT NULL,
Pref4 varchar(255) NOT NULL,
Pref5 varchar(255) NOT NULL,
Pref6 varchar(255) NOT NULL,
Pref7 varchar(255) NOT NULL,
Pref8 varchar(255) NOT NULL,
Pref9 varchar(255) NOT NULL,
Pref10 varchar(255) NOT NULL,
Pref11 varchar(255) NOT NULL,
Pref12 varchar(255) NOT NULL,
Pref13 varchar(255) NOT NULL,
Pref14 varchar(255) NOT NULL,
Pref15 varchar(255) NOT NULL,
Pref16 varchar(255) NOT NULL,
Pref17 varchar(255) NOT NULL,
Pref18 varchar(255) NOT NULL,
Pref19 varchar(255) NOT NULL,
Pref20 varchar(255) NOT NULL
);


CREATE TABLE SPE_CONVENTION.LOGIN
(
username varchar(255) PRIMARY Key,
pwd varchar(255) NOT NULL,
userType varchar(10) DEFAULT 'reviewer'
);


INSERT INTO SPE_CONVENTION.LOGIN VALUES ('Admin', 'photo1', 'admin');


CREATE TABLE SPE_CONVENTION.KEYWORDS(
	Id int PRIMARY KEY,
	Keyword varchar(255)
);

CREATE TABLE SPE_CONVENTION.OPPORTUNITIES(
	Id int PRIMARY KEY,
	Opportunity varchar(255)
);

INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (1, "All Genres");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (2, "Alternative Processes");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (3, "Book Arts");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (4, "Collaborative");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (5, "Completed Portfolios");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (6, "Conceptual");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (7, "Cross Disciplinary");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (8, "Emerging Artists");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (9, "Established Artists");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (10, "Experimental");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (11, "Feminism");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (12, "Multiculturalism");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (13, "Multimedia");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (14, "Narrative");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (15, "New Media");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (16, "Socio-Political");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (17, "Time Based");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (18, "Video/Film");
INSERT INTO SPE_CONVENTION.KEYWORDS VALUES (19, "Works in Progress");


INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (1, "Artist Residencies");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (2, "Artist Statement Guidance");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (3, "Artist Talks");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (4, "Concept Development");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (5, "Exhibitions");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (6, "Graduate School Advice");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (7, "Grant Application Advice");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (8, "Grant Opportunities");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (9, "Portfolio Feedback");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (10, "Publication Opportunities");
INSERT INTO SPE_CONVENTION.OPPORTUNITIES VALUES (11, "Visiting Artist Opportunities");