-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2015 at 05:20 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spe`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS registration_periods;

--
-- Table structure for table `registration_periods`
--

CREATE TABLE IF NOT EXISTS `registration_periods` (
  `registration_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `attendee_from` date NOT NULL,
  `attendee_until` date NOT NULL,
  `reviewer_from` date NOT NULL,
  `reviewer_until` date NOT NULL,
  `max_tables` int(11) NOT NULL,
  `attendees_match_limit` int(10) unsigned DEFAULT NULL COMMENT 'Set maximum limit an attendee can be matched to a reviewer',
  `schedule_created` enum('yes','no') NOT NULL DEFAULT 'no',
  `schedule_published` enum('no','yes') NOT NULL DEFAULT 'no',
  `short_saturdays` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`registration_period_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `registration_periods`
--

INSERT INTO `registration_periods` (`registration_period_id`, `year`, `attendee_from`, `attendee_until`, `reviewer_from`, `reviewer_until`, `max_tables`, `attendees_match_limit`, `schedule_created`, `schedule_published`, `short_saturdays`) VALUES
(1, 2015, '2015-02-23', '2015-03-28', '2015-02-22', '2015-03-27', 45, NULL, 'yes', 'no', 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
