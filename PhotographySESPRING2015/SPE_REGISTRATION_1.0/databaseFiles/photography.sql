-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2014 at 02:03 PM
-- Server version: 5.5.35
-- PHP Version: 5.4.4-14+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photography`
--

-- --------------------------------------------------------

--
-- Table structure for table `KEYWORDS`
--

CREATE TABLE IF NOT EXISTS `KEYWORDS` (
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KEYWORDS`
--

INSERT INTO `KEYWORDS` (`keyword`) VALUES
('Alternative Processes'),
('Book Arts'),
('Collaborative'),
('Completed Portfolios'),
('Conceptual'),
('Cross Disciplinary'),
('Emerging Artists'),
('Established Artists'),
('Experimental'),
('Feminism'),
('Multiculturalism'),
('Multimedia'),
('Narrative'),
('New Media'),
('Socio-Political'),
('Time Based'),
('Video/Film'),
('Works in Progress');

-- --------------------------------------------------------

--
-- Table structure for table `LOGIN`
--

CREATE TABLE IF NOT EXISTS `LOGIN` (
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `userType` varchar(10) DEFAULT 'reviewer',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LOGIN`
--

INSERT INTO `LOGIN` (`username`, `pwd`, `userType`) VALUES
('Admin', 'photo1', 'admin'),
('cap@email.com', '11111111', 'reviewer'),
('hulk@email.com', '11111111', 'reviewer'),
('ock@email.com', '11111111', 'reviewer'),
('reviewer@email.com', '11111111', 'reviewer'),
('Shannon.Randol@mtsu.edu', 'shannon', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `OPPORTUNITIES`
--

CREATE TABLE IF NOT EXISTS `OPPORTUNITIES` (
  `opportunity` varchar(255) NOT NULL,
  PRIMARY KEY (`opportunity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OPPORTUNITIES`
--

INSERT INTO `OPPORTUNITIES` (`opportunity`) VALUES
('Artist Residencies'),
('Artist Statement Guidance'),
('Artist Talks'),
('Concept Development'),
('Exhibitions'),
('Graduate School Advice'),
('Grant Application Advice'),
('Grant Opportunities'),
('Portfolio Feedback'),
('Publication Opportunities'),
('Visiting Artist Opportunities');

-- --------------------------------------------------------

--
-- Table structure for table `PROFESSIONAL`
--

CREATE TABLE IF NOT EXISTS `PROFESSIONAL` (
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pref1` varchar(255) NOT NULL,
  `Pref2` varchar(255) NOT NULL,
  `Pref3` varchar(255) NOT NULL,
  `Pref4` varchar(255) NOT NULL,
  `Pref5` varchar(255) NOT NULL,
  `Pref6` varchar(255) NOT NULL,
  `Pref7` varchar(255) NOT NULL,
  `Pref8` varchar(255) NOT NULL,
  `Pref9` varchar(255) NOT NULL,
  `Pref10` varchar(255) NOT NULL,
  `Pref11` varchar(255) NOT NULL,
  `Pref12` varchar(255) NOT NULL,
  `Pref13` varchar(255) NOT NULL,
  `Pref14` varchar(255) NOT NULL,
  `Pref15` varchar(255) NOT NULL,
  `Pref16` varchar(255) NOT NULL,
  `Pref17` varchar(255) NOT NULL,
  `Pref18` varchar(255) NOT NULL,
  `Pref19` varchar(255) NOT NULL,
  `Pref20` varchar(255) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PROFESSIONAL`
--

INSERT INTO `PROFESSIONAL` (`Fname`, `Lname`, `Email`, `Pref1`, `Pref2`, `Pref3`, `Pref4`, `Pref5`, `Pref6`, `Pref7`, `Pref8`, `Pref9`, `Pref10`, `Pref11`, `Pref12`, `Pref13`, `Pref14`, `Pref15`, `Pref16`, `Pref17`, `Pref18`, `Pref19`, `Pref20`) VALUES
('Shannon ', 'Randol', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Tomato', 'Ketchup', 'heinz@email.com', 'Banner, Bruce', 'Octavius, Otto', 'Doe, John\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('billy', 'bob', 'hi@email.com', 'Rogers, Steve', 'Octavius, Otto', 'Doe, John\r\n', '', '', 'Octavius, Otto', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Test', 'Preference', 'order@email.com', 'Rogers, Steve', 'Holliday, Doc', 'Banner, Bruce', 'Skywalker, Luke', 'Calrisian, Lando', 'Octavius, Otto', 'Doe, John', 'Snow, John', 'Parker, Peter', 'Stark, Rob\r\n', 'Banner, Bruce', '', '', '', '', '', '', '', '', ''),
('eddie', 'brock', 'venom@email.com', 'Octavius, Otto', 'Stark, Rob\r\n', 'Calrisian, Lando', 'Skywalker, Luke', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Johnny', 'Snow', 'villain@email.com', 'Parker, Peter', 'Stark, Rob\r\n', 'Snow, John', 'Doe, John', 'Banner, Bruce', 'Holliday, Doc', 'Rogers, Steve', 'Skywalker, Luke', 'Octavius, Otto', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `REGISTRATION_PERIODS`
--

CREATE TABLE IF NOT EXISTS `REGISTRATION_PERIODS` (
  `year` year(4) NOT NULL,
  `revFrom` date NOT NULL,
  `revTo` date NOT NULL,
  `attFrom` date NOT NULL,
  `attTo` date NOT NULL,
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `REGISTRATION_PERIODS`
--

INSERT INTO `REGISTRATION_PERIODS` (`year`, `revFrom`, `revTo`, `attFrom`, `attTo`) VALUES
(2014, '2014-04-01', '2014-12-01', '2014-04-01', '2014-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `REVIEWER`
--

CREATE TABLE IF NOT EXISTS `REVIEWER` (
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Instit` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `Addr1` varchar(255) NOT NULL,
  `Addr2` varchar(255) DEFAULT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Zip` int(11) DEFAULT NULL,
  `Country` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Membership` varchar(255) NOT NULL,
  `FeeWaiver` binary(1) DEFAULT NULL,
  `D1Morning` binary(1) DEFAULT '0',
  `D1Midday` binary(1) DEFAULT '0',
  `D1Afternoon` binary(1) DEFAULT '0',
  `D2Morning` binary(1) DEFAULT '0',
  `D2Midday` binary(1) DEFAULT '0',
  `D2Afternoon` binary(1) DEFAULT '0',
  `WorkLevel` varchar(4) NOT NULL,
  `Comments` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `REVIEWER`
--

INSERT INTO `REVIEWER` (`Fname`, `Lname`, `Title`, `Instit`, `Email`, `Website`, `Addr1`, `Addr2`, `City`, `State`, `Zip`, `Country`, `Phone`, `Membership`, `FeeWaiver`, `D1Morning`, `D1Midday`, `D1Afternoon`, `D2Morning`, `D2Midday`, `D2Afternoon`, `WorkLevel`, `Comments`) VALUES
('Steve', 'Rogers', 'Capt', 'S.H.I.E.L.D.', 'cap@email.com', 'www.website.com', '1234 Street St', '', 'New York', 'NY', 12345, 'United States', '123-456-7890', 'sustaining', '0', '1', '1', '0', '0', '0', '0', 'stud', ''),
('Doc', 'Holliday', '', '', 'doc@email.com', '', '12334 St St', 'unit b', 'Spokane', 'WA', 11111, 'United States', '1234567890', 'sustaining', '0', '0', '0', '0', '0', '1', '1', 'prof', ''),
('Bruce', 'Banner', 'Dr', 'S.H.I.E.L.D.', 'hulk@email.com', 'www.website.com', '1234 Street St', '', 'New York', 'NY', 12345, 'United States', '123-456-7890', 'senior', '1', '1', '1', '1', '1', '1', '1', 'both', 'I need a calm environment.'),
('Luke', 'Skywalker', '', 'New Republic', 'jedi@email.com', 'www.website.com', '123 Tattoine Way', 'womprat B', 'New York', 'NY', 12345, 'United States', '1234567890', 'sustaining', '1', '1', '0', '1', '0', '1', '0', 'both', ''),
('Lando', 'Calrisian', '', '', 'lando@email.com', '', '134 hello st', '', 'nashville', 'TN', 37214, 'United States', '1234567890', 'sustaining', '0', '1', '1', '0', '1', '1', '0', 'both', ''),
('Otto', 'Octavius', 'Dr', 'MTSU', 'ock@email.com', 'www.website.com', '1234 Street St', 'Unit A', 'Nashville', 'TN', 37214, 'United States', '1234564789', 'senior', '0', '0', '0', '0', '1', '1', '1', 'prof', ''),
('John', 'Doe', 'Mr', 'MTSU', 'reviewer@email.com', 'www.website.com', '1234 Street St', '', 'Birmingham', 'AL', 35216, 'United States', '1234567890', 'regular', '0', '0', '1', '1', '1', '1', '0', 'both', ''),
('Shannon', 'Randol', '', 'MTSU', 'shannon.randol@mtsu.edu', 'www.shannonrandol.com', '2709 Fleet Dr', '', 'Hermitage', 'TN', 37076, 'United States', '3145987337', 'regular', '1', '1', '1', '0', '0', '0', '0', 'stud', ''),
('John', 'Snow', 'Mr', '', 'snow@email.com', '', '1235 The Wall', '', 'The North', 'AK', 11111, 'United States', '1111111111', 'sustaining', '1', '0', '0', '0', '1', '1', '1', 'prof', ''),
('Peter', 'Parker', 'Mr', 'Daily Bugle', 'spidey@email.com', 'www.website.com', '123 Web Way', '', 'New York', 'NY', 11111, 'United States', '123-456-7890', 'regular', '0', '1', '1', '0', '1', '1', '0', 'both', ''),
('Rob', 'Stark', '', '', 'stark@email.com', '', '1234 Street St', '', 'Nashville', 'TN', 37214, 'United States', '1234567890', 'student', '0', '1', '0', '1', '0', '0', '0', 'stud', '');

-- --------------------------------------------------------

--
-- Table structure for table `REV_KEYWORD`
--

CREATE TABLE IF NOT EXISTS `REV_KEYWORD` (
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Keyword` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Email`,`Keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `REV_KEYWORD`
--

INSERT INTO `REV_KEYWORD` (`Email`, `Keyword`) VALUES
('cap@email.com', 'Alternative Processes'),
('cap@email.com', 'Book Arts'),
('cap@email.com', 'Collaborative'),
('cap@email.com', 'Completed Portfolios'),
('cap@email.com', 'Conceptual'),
('cap@email.com', 'Cross Disciplinary'),
('cap@email.com', 'Emerging Artists'),
('cap@email.com', 'Established Artists'),
('cap@email.com', 'Experimental'),
('cap@email.com', 'Feminism'),
('cap@email.com', 'Multiculturalism'),
('cap@email.com', 'Multimedia'),
('cap@email.com', 'Narrative'),
('cap@email.com', 'New Media'),
('cap@email.com', 'Socio-Political'),
('cap@email.com', 'Time Based'),
('cap@email.com', 'Video/Film'),
('cap@email.com', 'Works in Progress'),
('doc@email.com', 'Book Arts'),
('doc@email.com', 'Completed Portfolios'),
('doc@email.com', 'Socio-Political'),
('doc@email.com', 'Time Based'),
('doc@email.com', 'Works in Progress'),
('hulk@email.com', 'Alternative Processes'),
('hulk@email.com', 'Completed Portfolios'),
('hulk@email.com', 'Conceptual'),
('hulk@email.com', 'Cross Disciplinary'),
('hulk@email.com', 'Experimental'),
('hulk@email.com', 'Feminism'),
('hulk@email.com', 'Multiculturalism'),
('hulk@email.com', 'Socio-Political'),
('hulk@email.com', 'Works in Progress'),
('jedi@email.com', 'Conceptual'),
('jedi@email.com', 'Cross Disciplinary'),
('jedi@email.com', 'Established Artists'),
('jedi@email.com', 'Multiculturalism'),
('jedi@email.com', 'Narrative'),
('jedi@email.com', 'New Media'),
('jedi@email.com', 'Socio-Political'),
('lando@email.com', 'Alternative Processes'),
('lando@email.com', 'Book Arts'),
('lando@email.com', 'Collaborative'),
('lando@email.com', 'Conceptual'),
('lando@email.com', 'Established Artists'),
('lando@email.com', 'Feminism'),
('lando@email.com', 'Multiculturalism'),
('lando@email.com', 'Narrative'),
('lando@email.com', 'Time Based'),
('lando@email.com', 'Works in Progress'),
('ock@email.com', 'Alternative Processes'),
('ock@email.com', 'Book Arts'),
('ock@email.com', 'Collaborative'),
('ock@email.com', 'Completed Portfolios'),
('ock@email.com', 'Conceptual'),
('ock@email.com', 'Cross Disciplinary'),
('ock@email.com', 'Emerging Artists'),
('ock@email.com', 'Established Artists'),
('ock@email.com', 'Experimental'),
('ock@email.com', 'Feminism'),
('ock@email.com', 'Multiculturalism'),
('ock@email.com', 'Multimedia'),
('ock@email.com', 'Narrative'),
('ock@email.com', 'New Media'),
('ock@email.com', 'Socio-Political'),
('ock@email.com', 'Time Based'),
('ock@email.com', 'Video/Film'),
('ock@email.com', 'Works in Progress'),
('reviewer@email.com', 'Alternative Processes'),
('reviewer@email.com', 'Book Arts'),
('reviewer@email.com', 'Collaborative'),
('reviewer@email.com', 'Completed Portfolios'),
('reviewer@email.com', 'Conceptual'),
('reviewer@email.com', 'Cross Disciplinary'),
('reviewer@email.com', 'Emerging Artists'),
('reviewer@email.com', 'Established Artists'),
('reviewer@email.com', 'Experimental'),
('reviewer@email.com', 'Feminism'),
('reviewer@email.com', 'Multiculturalism'),
('reviewer@email.com', 'Multimedia'),
('reviewer@email.com', 'Narrative'),
('reviewer@email.com', 'New Media'),
('reviewer@email.com', 'Socio-Political'),
('reviewer@email.com', 'Time Based'),
('reviewer@email.com', 'Video/Film'),
('reviewer@email.com', 'Works in Progress'),
('shannon.randol@mtsu.edu', 'Conceptual'),
('shannon.randol@mtsu.edu', 'Experimental'),
('shannon.randol@mtsu.edu', 'Narrative'),
('snow@email.com', 'Book Arts'),
('snow@email.com', 'Emerging Artists'),
('snow@email.com', 'Experimental'),
('snow@email.com', 'Socio-Political'),
('snow@email.com', 'Time Based'),
('snow@email.com', 'Works in Progress'),
('spidey@email.com', 'Alternative Processes'),
('spidey@email.com', 'Completed Portfolios'),
('spidey@email.com', 'Conceptual'),
('spidey@email.com', 'Feminism'),
('spidey@email.com', 'Multiculturalism'),
('spidey@email.com', 'Multimedia'),
('spidey@email.com', 'Narrative'),
('spidey@email.com', 'Works in Progress'),
('stark@email.com', 'Alternative Processes'),
('stark@email.com', 'Book Arts'),
('stark@email.com', 'Collaborative'),
('stark@email.com', 'Completed Portfolios'),
('stark@email.com', 'Conceptual'),
('stark@email.com', 'Cross Disciplinary'),
('stark@email.com', 'Emerging Artists'),
('stark@email.com', 'Established Artists'),
('stark@email.com', 'Experimental'),
('stark@email.com', 'Feminism'),
('stark@email.com', 'Multiculturalism'),
('stark@email.com', 'Multimedia'),
('stark@email.com', 'Narrative'),
('stark@email.com', 'New Media'),
('stark@email.com', 'Socio-Political'),
('stark@email.com', 'Time Based'),
('stark@email.com', 'Video/Film'),
('stark@email.com', 'Works in Progress');

-- --------------------------------------------------------

--
-- Table structure for table `REV_OPPORTUNITY`
--

CREATE TABLE IF NOT EXISTS `REV_OPPORTUNITY` (
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Opportunity` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Email`,`Opportunity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `REV_OPPORTUNITY`
--

INSERT INTO `REV_OPPORTUNITY` (`Email`, `Opportunity`) VALUES
('cap@email.com', 'Exhibitions'),
('cap@email.com', 'Portfolio Feedback'),
('doc@email.com', 'Artist Residencies'),
('doc@email.com', 'Artist Statement Guidance'),
('doc@email.com', 'Exhibitions'),
('doc@email.com', 'Portfolio Feedback'),
('hulk@email.com', 'Grant Application Advice'),
('hulk@email.com', 'Publication Opportunities'),
('jedi@email.com', 'Grant Opportunities'),
('jedi@email.com', 'Publication Opportunities'),
('lando@email.com', 'Artist Talks'),
('lando@email.com', 'Graduate School Advice'),
('lando@email.com', 'Visiting Artist Opportunities'),
('ock@email.com', 'Grant Application Advice'),
('ock@email.com', 'Grant Opportunities'),
('reviewer@email.com', 'Artist Residencies'),
('reviewer@email.com', 'Artist Statement Guidance'),
('reviewer@email.com', 'Artist Talks'),
('reviewer@email.com', 'Concept Development'),
('reviewer@email.com', 'Exhibitions'),
('reviewer@email.com', 'Graduate School Advice'),
('reviewer@email.com', 'Grant Application Advice'),
('reviewer@email.com', 'Grant Opportunities'),
('reviewer@email.com', 'Portfolio Feedback'),
('reviewer@email.com', 'Publication Opportunities'),
('reviewer@email.com', 'Visiting Artist Opportunities'),
('shannon.randol@mtsu.edu', 'Artist Talks'),
('shannon.randol@mtsu.edu', 'Exhibitions'),
('snow@email.com', 'Graduate School Advice'),
('spidey@email.com', 'Concept Development'),
('spidey@email.com', 'Exhibitions'),
('stark@email.com', 'Artist Talks');

-- --------------------------------------------------------

--
-- Table structure for table `STUDENT`
--

CREATE TABLE IF NOT EXISTS `STUDENT` (
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pref1` varchar(255) NOT NULL,
  `Pref2` varchar(255) NOT NULL,
  `Pref3` varchar(255) NOT NULL,
  `Pref4` varchar(255) NOT NULL,
  `Pref5` varchar(255) NOT NULL,
  `Pref6` varchar(255) NOT NULL,
  `Pref7` varchar(255) NOT NULL,
  `Pref8` varchar(255) NOT NULL,
  `Pref9` varchar(255) NOT NULL,
  `Pref10` varchar(255) NOT NULL,
  `Pref11` varchar(255) NOT NULL,
  `Pref12` varchar(255) NOT NULL,
  `Pref13` varchar(255) NOT NULL,
  `Pref14` varchar(255) NOT NULL,
  `Pref15` varchar(255) NOT NULL,
  `Pref16` varchar(255) NOT NULL,
  `Pref17` varchar(255) NOT NULL,
  `Pref18` varchar(255) NOT NULL,
  `Pref19` varchar(255) NOT NULL,
  `Pref20` varchar(255) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `STUDENT`
--

INSERT INTO `STUDENT` (`Fname`, `Lname`, `Email`, `Pref1`, `Pref2`, `Pref3`, `Pref4`, `Pref5`, `Pref6`, `Pref7`, `Pref8`, `Pref9`, `Pref10`, `Pref11`, `Pref12`, `Pref13`, `Pref14`, `Pref15`, `Pref16`, `Pref17`, `Pref18`, `Pref19`, `Pref20`) VALUES
('Vitaman', 'Dee', 'dee@email.com', 'Rogers, Steve', 'Holliday, Doc', 'Banner, Bruce', 'Skywalker, Luke', 'Calrisian, Lando', 'Octavius, Otto', 'Doe, John', 'Snow, John', 'Parker, Peter', 'Stark, Rob\r\n', '', '', '', '', '', '', '', '', '', ''),
('poison', 'ivy', 'flowers@email.com', 'Octavius, Otto', 'Holliday, Doc', 'Calrisian, Lando', 'Skywalker, Luke', '', 'Banner, Bruce', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('John', 'Jones', 'mars@email.com', 'Doe, John', 'Calrisian, Lando', 'Rogers, Steve', 'Banner, Bruce', 'Skywalker, Luke', 'Doe, John', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Shannon ', 'Randol', 'shannon.randol@mtsu.edu', 'Rogers, Steve', 'Holliday, Doc', 'Banner, Bruce', 'Skywalker, Luke', 'Calrisian, Lando', 'Octavius, Otto', 'Doe, John', 'Snow, John', 'Parker, Peter', 'Stark, Rob\r\n', '', '', '', '', '', '', '', '', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `REV_KEYWORD`
--
ALTER TABLE `REV_KEYWORD`
  ADD CONSTRAINT `REV_KEYWORD_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `REVIEWER` (`Email`);

--
-- Constraints for table `REV_OPPORTUNITY`
--
ALTER TABLE `REV_OPPORTUNITY`
  ADD CONSTRAINT `REV_OPPORTUNITY_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `REVIEWER` (`Email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
