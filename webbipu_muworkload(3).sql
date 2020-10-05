-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 10:18 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webbipu_muworkload`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `activitiesID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `activitiesCode` varchar(255) DEFAULT NULL,
  `metricsID` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activitiesID`),
  KEY `unit_id` (`activitiesCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activitiesID`, `title`, `activitiesCode`, `metricsID`, `created`, `modified`) VALUES
(3, 'Lecture-Initial', 'LECT-Initial', 4, '2019-11-02 06:56:04', '2019-11-02 13:56:04'),
(4, 'Workshop-Initial', 'WS-I', 5, '2019-11-02 06:56:39', '2019-11-02 13:56:39'),
(5, 'Tutorial', 'TUT01', 5, '2019-11-02 06:57:18', '2019-11-02 13:57:18'),
(6, 'Lab', 'LAB01', 6, '2019-11-02 06:57:34', '2019-11-02 13:57:34'),
(7, 'Coordination', 'CORD01', 4, '2019-11-02 06:58:51', '2019-11-02 13:58:51'),
(8, 'Lecture-Repeat', 'LECT-R', 4, '2019-11-02 21:59:13', '2019-11-03 04:59:13'),
(9, 'Workshop-Repeat', 'WS-R', 5, '2019-11-02 21:59:54', '2019-11-03 04:59:54'),
(13, 'Lab-Repeat', 'LAB-R', 4, '2019-11-02 23:14:01', '2019-11-03 06:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `activitymetricsmeta`
--

CREATE TABLE IF NOT EXISTS `activitymetricsmeta` (
  `activityMetricsMetaID` int(11) NOT NULL AUTO_INCREMENT,
  `activitiesID` int(11) NOT NULL,
  `metricsID` int(11) NOT NULL,
  `calcMetrics` float NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activityMetricsMetaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE IF NOT EXISTS `allocation` (
  `allocationID` int(11) NOT NULL AUTO_INCREMENT,
  `unitID` int(11) DEFAULT NULL,
  `courseType` varchar(255) DEFAULT NULL,
  `lecturers` varchar(255) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`allocationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`allocationID`, `unitID`, `courseType`, `lecturers`, `year`, `created`, `modified`) VALUES
(3, 22, 'S1,TJA,TMA,TSA,TJD', '25,22', 2019, '0000-00-00 00:00:00', '2019-11-02 11:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `budgetalloc`
--

CREATE TABLE IF NOT EXISTS `budgetalloc` (
  `budgetallocID` int(11) NOT NULL AUTO_INCREMENT,
  `hoursID` int(11) NOT NULL,
  `activityID` int(11) NOT NULL,
  `totalBudget` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`budgetallocID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coursepref`
--

CREATE TABLE IF NOT EXISTS `coursepref` (
  `courseprefID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`courseprefID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `coursepref`
--

INSERT INTO `coursepref` (`courseprefID`, `userID`, `unitID`, `created`, `modified`) VALUES
(7, 33, 22, '2019-11-03 16:17:27', '2019-11-03 16:17:27'),
(8, 33, 24, '2019-11-03 16:17:27', '2019-11-03 16:17:27'),
(9, 33, 25, '2019-11-03 16:17:27', '2019-11-03 16:17:27'),
(10, 33, 22, '2019-11-03 16:17:36', '2019-11-03 16:17:36'),
(11, 33, 24, '2019-11-03 16:17:36', '2019-11-03 16:17:36'),
(12, 33, 25, '2019-11-03 16:17:36', '2019-11-03 16:17:36'),
(13, 34, 22, '2019-11-03 16:17:39', '2019-11-03 16:17:39'),
(14, 34, 24, '2019-11-03 16:17:39', '2019-11-03 16:17:39'),
(15, 34, 25, '2019-11-03 16:17:39', '2019-11-03 16:17:39'),
(16, 35, 22, '2019-11-03 16:18:12', '2019-11-03 16:18:12'),
(17, 35, 24, '2019-11-03 16:18:12', '2019-11-03 16:18:12'),
(18, 35, 25, '2019-11-03 16:18:12', '2019-11-03 16:18:12'),
(19, 35, 22, '2019-11-03 16:18:19', '2019-11-03 16:18:19'),
(20, 35, 24, '2019-11-03 16:18:19', '2019-11-03 16:18:19'),
(21, 35, 25, '2019-11-03 16:18:19', '2019-11-03 16:18:19'),
(22, 36, 22, '2019-11-03 16:18:24', '2019-11-03 16:18:24'),
(23, 36, 24, '2019-11-03 16:18:24', '2019-11-03 16:18:24'),
(24, 36, 25, '2019-11-03 16:18:24', '2019-11-03 16:18:24'),
(25, 36, 22, '2019-11-03 16:19:21', '2019-11-03 16:19:21'),
(26, 36, 24, '2019-11-03 16:19:21', '2019-11-03 16:19:21'),
(27, 36, 25, '2019-11-03 16:19:21', '2019-11-03 16:19:21'),
(28, 37, 24, '2019-11-03 16:19:34', '2019-11-03 16:19:34'),
(29, 37, 25, '2019-11-03 16:19:34', '2019-11-03 16:19:34'),
(30, 37, 26, '2019-11-03 16:19:34', '2019-11-03 16:19:34'),
(31, 38, 24, '2019-11-03 16:20:07', '2019-11-03 16:20:07'),
(53, 26, 22, '2019-11-03 09:55:49', '2019-11-03 09:55:49'),
(54, 26, 24, '2019-11-03 09:55:50', '2019-11-03 09:55:50'),
(55, 26, 26, '2019-11-03 09:55:50', '2019-11-03 09:55:50'),
(56, 26, 33, '2019-11-03 09:55:50', '2019-11-03 09:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE IF NOT EXISTS `general_settings` (
  `settings_id` int(18) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE IF NOT EXISTS `hours` (
  `hoursID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hoursID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `metrics`
--

CREATE TABLE IF NOT EXISTS `metrics` (
  `met_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `metrics_code` varchar(255) NOT NULL,
  `metrics_title` mediumtext NOT NULL,
  `formula_or_value` varchar(255) NOT NULL,
  `metrics_variable` varchar(255) DEFAULT NULL,
  `metrics_note` mediumtext,
  `formula_or_value_output` varchar(255) DEFAULT NULL,
  `associated_activity` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`met_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `metrics`
--

INSERT INTO `metrics` (`met_id`, `metrics_code`, `metrics_title`, `formula_or_value`, `metrics_variable`, `metrics_note`, `formula_or_value_output`, `associated_activity`) VALUES
(3, 'MetCode1', 'Test Met', '30+((k-1)*10)', '2', 'this is test met note', '40', 'lecture'),
(4, 'MyCode2', 'Mymet1', '(n/5.25)*3.5', '5.25', 'myNote1', '3.5', 'tuts'),
(5, 'YOURCODE3', 'YourMet3', '28+ (0.3 * c) + (4.75 * n)', '10,10', 'Your note 3', '78.5', 'workshop'),
(6, '4444', '1111', '3333', '', '2222', 'Variables not defined', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(18) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  `added_date` datetime NOT NULL,
  `gsetting_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `title`, `value`, `additional`, `added_date`, `gsetting_code`) VALUES
(1, 'Total Teaching Hour per staff', '1750', '', '2019-11-03 13:37:23', 'total_teaching'),
(2, 'Casual Staff Hourly rate', '75', '', '2019-11-03 03:07:08', 'casual_hourly'),
(4, 'Total Budget', '239845', '2020', '2019-11-03 13:52:06', 'casual_2020'),
(8, 'Casual budget', '22313', '2019', '2019-11-03 14:06:30', 'casual_2019'),
(9, 'Casual budget', '200000', '2022', '2019-11-03 14:08:26', 'casual_2022'),
(10, 'Offerings', 'S1,S2,TJA,TMA,TSA,TJD,TMD,TSD', '2019', '0000-00-00 00:00:00', 'Offerings');

-- --------------------------------------------------------

--
-- Table structure for table `unitactivitiesmeta`
--

CREATE TABLE IF NOT EXISTS `unitactivitiesmeta` (
  `unitactivitiesmetaID` int(11) NOT NULL AUTO_INCREMENT,
  `unitID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`unitactivitiesmetaID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `unitactivitiesmeta`
--

INSERT INTO `unitactivitiesmeta` (`unitactivitiesmetaID`, `unitID`, `activitiesID`, `created`, `modified`) VALUES
(1, 32, 4, '2019-11-02 23:07:06', '2019-11-03 06:07:06'),
(2, 32, 5, '2019-11-02 23:07:06', '2019-11-03 06:07:06'),
(3, 32, 7, '2019-11-02 23:07:06', '2019-11-03 06:07:06'),
(4, 32, 8, '2019-11-02 23:07:06', '2019-11-03 06:07:06'),
(5, 33, 3, '2019-11-02 23:17:18', '2019-11-03 06:17:18'),
(6, 33, 4, '2019-11-02 23:17:18', '2019-11-03 06:17:18'),
(7, 33, 5, '2019-11-02 23:17:18', '2019-11-03 06:17:18'),
(8, 34, 4, '2019-11-02 23:20:17', '2019-11-03 06:20:17'),
(9, 34, 7, '2019-11-02 23:20:17', '2019-11-03 06:20:17'),
(10, 34, 8, '2019-11-02 23:20:17', '2019-11-03 06:20:17'),
(11, 34, 9, '2019-11-02 23:20:17', '2019-11-03 06:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `unitmetrics`
--

CREATE TABLE IF NOT EXISTS `unitmetrics` (
  `unitMetricsID` int(11) NOT NULL AUTO_INCREMENT,
  `activitiesID` int(11) NOT NULL,
  `metricsID` int(11) NOT NULL,
  `calcMetrics` float DEFAULT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`unitMetricsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) DEFAULT NULL,
  `unit_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `activities` int(11) DEFAULT NULL,
  `activities_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_code`, `activities`, `activities_modified`) VALUES
(22, 'IT Group Project', 'ICT 621', 0, '2019-11-01 02:39:41'),
(24, 'IT Strategy', 'ICT 622', 0, '2019-11-01 02:07:28'),
(25, 'Knowledge Management', 'ICT 505', 0, '2019-11-01 05:48:10'),
(26, 'IT Group Projectaa', 'ICT 621', 0, '2019-11-01 02:04:43'),
(32, '111', '2222', NULL, '2019-11-03 06:07:06'),
(33, 'Business Analytics', 'ICT601', NULL, '2019-11-03 06:17:18'),
(34, 'Businees in IT', 'ITBSC102', NULL, '2019-11-03 06:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `unit_users`
--

CREATE TABLE IF NOT EXISTS `unit_users` (
  `user_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('academicstaff','casualstaff','parttimestaff','staff','admin','none') DEFAULT 'staff',
  `name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `status` enum('active','cancelled','deactive','notactivated') DEFAULT NULL,
  `allocated_hour` int(100) NOT NULL,
  `remaining_hour` int(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `name`, `first_name`, `middle_name`, `last_name`, `email`, `username`, `created`, `status`, `allocated_hour`, `remaining_hour`, `password`) VALUES
(22, 'staff', 'Bipu Bajgai', 'Bipu', '', 'Bajgai', 'bipubajgai@gmail.com', 'admin', '2019-11-01 12:23:40', 'deactive', 100, 0, 'admin'),
(25, 'academicstaff', 'John   Doe', 'John ', '', 'Doe', 'johndoe@email.com', 'johndoe@email.com', '2019-11-01 19:00:21', 'active', 1400, 0, ''),
(26, 'academicstaff', 'Prof01  Last name01', 'Prof01', '', 'Last name01', 'Prof01@email.com', 'Prof01@email.com', '2019-11-03 09:55:49', 'active', 875, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
