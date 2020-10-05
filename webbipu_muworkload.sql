-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2019 at 04:15 PM
-- Server version: 5.7.28
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbipu_muworkload`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activitiesID` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `metricsID` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activitiesID`, `title`, `metricsID`, `created`, `modified`) VALUES
(22, 'Lecture - Initial', 15, '2019-11-03 14:35:06', '2019-11-03 14:35:06'),
(23, 'Lecture - Repeat', 16, '2019-11-03 14:39:20', '2019-11-03 14:39:20'),
(24, 'Workshop - Repeat', 24, '2019-11-03 14:39:33', '2019-11-03 14:39:33'),
(25, 'Workshop - Initial', 23, '2019-11-03 14:39:46', '2019-11-03 14:39:46'),
(26, 'Lab - Initial', 21, '2019-11-03 14:40:04', '2019-11-03 14:40:04'),
(27, 'Lab - Repeat', 24, '2019-11-03 14:40:14', '2019-11-03 14:40:14'),
(28, 'Tutorials - Initial', 19, '2019-11-03 14:40:32', '2019-11-03 14:40:32'),
(29, 'Tutorials - Repeat', 16, '2019-11-03 14:40:41', '2019-11-03 14:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `activitymetricsmeta`
--

CREATE TABLE `activitymetricsmeta` (
  `activityMetricsMetaID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `metricsID` int(11) NOT NULL,
  `calcMetrics` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE `allocation` (
  `allocationID` int(11) NOT NULL,
  `unitID` int(11) DEFAULT NULL,
  `courseType` varchar(255) DEFAULT NULL,
  `lecturers` varchar(255) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`allocationID`, `unitID`, `courseType`, `lecturers`, `year`, `created`, `modified`) VALUES
(3, 22, 'S1,TJA,TMA,TSA,TJD', '25,22', 0000, '0000-00-00 00:00:00', '2019-11-02 11:55:38'),
(4, 25, '', '', 0000, '2019-11-03 13:34:19', '2019-11-03 13:34:19'),
(5, 28, '', '', 0000, '2019-11-03 13:34:28', '2019-11-03 13:34:28'),
(6, 28, '', '', 0000, '2019-11-03 13:39:15', '2019-11-03 13:39:15'),
(7, 43, NULL, NULL, 2019, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(8, 39, NULL, NULL, 2019, '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(9, 39, NULL, NULL, 2019, '2019-11-04 15:56:21', '2019-11-04 15:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `allocationactlect`
--

CREATE TABLE `allocationactlect` (
  `allocationActLectID` int(11) NOT NULL,
  `allocationID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `userID` int(11) DEFAULT '1' COMMENT 'is 1 if casual',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocationactlect`
--

INSERT INTO `allocationactlect` (`allocationActLectID`, `allocationID`, `activitiesID`, `userID`, `created`, `modified`) VALUES
(7, 6, 3, 26, '2019-11-03 22:10:48', '2019-11-04 05:10:48'),
(8, 6, 4, 1, '2019-11-03 22:10:48', '2019-11-04 05:10:48'),
(9, 6, 5, 33, '2019-11-03 22:10:48', '2019-11-04 05:10:48'),
(21, 5, 4, 1, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(22, 5, 7, 32, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(23, 5, 7, 27, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(24, 5, 8, 32, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(25, 5, 8, 34, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(26, 5, 9, 31, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(27, 5, 9, 33, '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(33, 8, 22, 50, '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(34, 8, 24, 50, '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(35, 8, 24, 48, '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(36, 8, 25, 49, '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(37, 7, 22, 53, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(38, 7, 22, 55, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(39, 7, 23, 50, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(40, 7, 24, 1, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(41, 7, 25, 23, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(42, 7, 26, 54, '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(43, 9, 22, 54, '2019-11-04 15:56:21', '2019-11-04 15:56:21'),
(44, 9, 22, 50, '2019-11-04 15:56:21', '2019-11-04 15:56:21'),
(45, 9, 24, 1, '2019-11-04 15:56:21', '2019-11-04 15:56:21'),
(46, 9, 25, 1, '2019-11-04 15:56:21', '2019-11-04 15:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `allocationofferings`
--

CREATE TABLE `allocationofferings` (
  `allocationOfferingsID` int(11) NOT NULL,
  `allocationID` int(11) NOT NULL,
  `offerings` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocationofferings`
--

INSERT INTO `allocationofferings` (`allocationOfferingsID`, `allocationID`, `offerings`, `created`, `modified`) VALUES
(3, 6, 'S2', '2019-11-03 22:10:48', '2019-11-04 05:10:48'),
(4, 6, 'TSA', '2019-11-03 22:10:48', '2019-11-04 05:10:48'),
(16, 5, 'S1', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(17, 5, 'S2', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(18, 5, 'TJA', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(19, 5, 'TMA', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(20, 5, 'TSA', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(21, 5, 'TJD', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(22, 5, 'TMD', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(23, 5, 'TSD', '2019-11-04 02:50:57', '2019-11-04 09:50:57'),
(29, 8, 'S1', '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(30, 8, 'TJA', '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(31, 8, 'TMD', '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(32, 8, 'TSD', '2019-11-04 15:41:09', '2019-11-04 15:41:09'),
(33, 7, 'S2', '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(34, 7, 'TMA', '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(35, 7, 'TMD', '2019-11-04 15:54:55', '2019-11-04 15:54:55'),
(36, 9, 'TJA', '2019-11-04 15:56:21', '2019-11-04 15:56:21'),
(37, 9, 'TMA', '2019-11-04 15:56:21', '2019-11-04 15:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `budgetalloc`
--

CREATE TABLE `budgetalloc` (
  `budgetallocID` int(11) NOT NULL,
  `hoursID` int(11) NOT NULL,
  `activityID` int(11) NOT NULL,
  `totalBudget` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coursepref`
--

CREATE TABLE `coursepref` (
  `courseprefID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(32, 38, 25, '2019-11-03 16:20:07', '2019-11-03 16:20:07'),
(33, 38, 24, '2019-11-03 16:20:24', '2019-11-03 16:20:24'),
(34, 38, 25, '2019-11-03 16:20:24', '2019-11-03 16:20:24'),
(35, 38, 24, '2019-11-03 16:20:27', '2019-11-03 16:20:27'),
(36, 38, 25, '2019-11-03 16:20:27', '2019-11-03 16:20:27'),
(37, 38, 24, '2019-11-03 16:20:28', '2019-11-03 16:20:28'),
(38, 38, 25, '2019-11-03 16:20:28', '2019-11-03 16:20:28'),
(39, 38, 24, '2019-11-03 16:20:29', '2019-11-03 16:20:29'),
(40, 38, 25, '2019-11-03 16:20:29', '2019-11-03 16:20:29'),
(41, 38, 24, '2019-11-03 16:20:29', '2019-11-03 16:20:29'),
(42, 38, 25, '2019-11-03 16:20:29', '2019-11-03 16:20:29'),
(43, 38, 24, '2019-11-03 16:20:30', '2019-11-03 16:20:30'),
(44, 38, 25, '2019-11-03 16:20:30', '2019-11-03 16:20:30'),
(45, 38, 24, '2019-11-03 16:20:30', '2019-11-03 16:20:30'),
(46, 38, 25, '2019-11-03 16:20:30', '2019-11-03 16:20:30'),
(47, 38, 24, '2019-11-03 16:20:31', '2019-11-03 16:20:31'),
(48, 38, 25, '2019-11-03 16:20:31', '2019-11-03 16:20:31'),
(49, 39, 24, '2019-11-03 16:20:58', '2019-11-03 16:20:58'),
(50, 39, 25, '2019-11-03 16:20:58', '2019-11-03 16:20:58'),
(51, 39, 24, '2019-11-03 16:21:05', '2019-11-03 16:21:05'),
(52, 39, 25, '2019-11-03 16:21:05', '2019-11-03 16:21:05'),
(53, 40, 24, '2019-11-03 17:19:56', '2019-11-03 17:19:56'),
(54, 40, 25, '2019-11-03 17:19:56', '2019-11-03 17:19:56'),
(55, 24, 22, '2019-11-03 18:13:02', '2019-11-03 18:13:02'),
(56, 24, 24, '2019-11-03 18:13:02', '2019-11-03 18:13:02'),
(57, 24, 25, '2019-11-03 18:13:02', '2019-11-03 18:13:02'),
(58, 41, 24, '2019-11-03 18:16:07', '2019-11-03 18:16:07'),
(59, 41, 25, '2019-11-03 18:16:07', '2019-11-03 18:16:07'),
(60, 42, 24, '2019-11-03 18:39:18', '2019-11-03 18:39:18'),
(61, 42, 25, '2019-11-03 18:39:18', '2019-11-03 18:39:18'),
(62, 42, 24, '2019-11-03 18:40:28', '2019-11-03 18:40:28'),
(63, 42, 25, '2019-11-03 18:40:28', '2019-11-03 18:40:28'),
(64, 43, 24, '2019-11-03 18:40:50', '2019-11-03 18:40:50'),
(65, 43, 25, '2019-11-03 18:40:50', '2019-11-03 18:40:50'),
(66, 44, 24, '2019-11-03 18:52:48', '2019-11-03 18:52:48'),
(67, 44, 25, '2019-11-03 18:52:48', '2019-11-03 18:52:48'),
(68, 45, 24, '2019-11-03 18:53:09', '2019-11-03 18:53:09'),
(69, 45, 25, '2019-11-03 18:53:09', '2019-11-03 18:53:09'),
(70, 46, 42, '2019-11-03 23:01:13', '2019-11-03 23:01:13'),
(71, 47, 41, '2019-11-03 23:02:06', '2019-11-03 23:02:06'),
(72, 48, 30, '2019-11-03 23:02:44', '2019-11-03 23:02:44'),
(73, 49, 31, '2019-11-03 23:03:26', '2019-11-03 23:03:26'),
(74, 50, 32, '2019-11-03 23:03:48', '2019-11-03 23:03:48'),
(75, 51, 34, '2019-11-03 23:04:31', '2019-11-03 23:04:31'),
(76, 52, 36, '2019-11-03 23:04:50', '2019-11-03 23:04:50'),
(77, 53, 38, '2019-11-03 23:05:14', '2019-11-03 23:05:14'),
(78, 54, 36, '2019-11-03 23:05:53', '2019-11-03 23:05:53'),
(79, 54, 37, '2019-11-03 23:05:53', '2019-11-03 23:05:53'),
(80, 54, 38, '2019-11-03 23:05:53', '2019-11-03 23:05:53'),
(81, 54, 39, '2019-11-03 23:05:53', '2019-11-03 23:05:53'),
(82, 54, 40, '2019-11-03 23:05:53', '2019-11-03 23:05:53'),
(83, 54, 42, '2019-11-03 23:05:53', '2019-11-03 23:05:53'),
(84, 55, 30, '2019-11-03 23:06:36', '2019-11-03 23:06:36'),
(85, 55, 32, '2019-11-03 23:06:36', '2019-11-03 23:06:36'),
(86, 55, 35, '2019-11-03 23:06:36', '2019-11-03 23:06:36'),
(87, 55, 36, '2019-11-03 23:06:36', '2019-11-03 23:06:36'),
(88, 55, 37, '2019-11-03 23:06:36', '2019-11-03 23:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE `hours` (
  `hoursID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `metrics`
--

CREATE TABLE `metrics` (
  `met_id` int(11) UNSIGNED NOT NULL,
  `metrics_code` varchar(255) NOT NULL,
  `metrics_title` mediumtext NOT NULL,
  `formula_or_value` varchar(255) NOT NULL,
  `metrics_variable` varchar(255) DEFAULT NULL,
  `metrics_note` mediumtext,
  `formula_or_value_output` varchar(255) DEFAULT NULL,
  `associated_activity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metrics`
--

INSERT INTO `metrics` (`met_id`, `metrics_code`, `metrics_title`, `formula_or_value`, `metrics_variable`, `metrics_note`, `formula_or_value_output`, `associated_activity`) VALUES
(11, 's61', '<p><span class=\"formula__title\"><h2>Unit Coordination <br></h2><p>Independent Study Contracts</p></span></p>', '15 + (a * 2) ', '4', '<p>where a = number of ICS contracts with similar study content/material<strong><br>Question if this metric is to be removed and replaced with the general Unit Coordination metrics</strong></p>', '23', NULL),
(12, 'u21 & u28', '<h2>Unit Coordination</h2><p>Transnational<br></p>', '30 + ((k - 1) * 10)', '5', '<p>where k = number of same unit offerings in the same teaching period<br></p><p><em>the base allocation of 30 hours includes the time undertaken to write: assignments; write exams; develop deferred &amp; supplementary exams; maintain Moodles sites; LCS; develop and maintain study guides; arrange text books etc.</em><br></p>', '70', NULL),
(13, 'u31', '<h2>Unit Coordination</h2><p>Open University (OUA)<br></p>', '(n/5.25)*3.5', '5', '<p>where n = number of total enrolled students; <br>This is allocated in addition to normal unit coordination<em><br><strong>Question if this metric is to be removed and replace with the general Unit Coordination metrics</strong></em><br></p>', '3.33', NULL),
(14, 'u24', '<p><strong>Unit Coordination</strong> - 12 credit point units</p><p>Engineering <strong>INTERNSHIP</strong> unit and <strong>WIL</strong> units<br></p>', '28+(0.3*c)+(4.75*n)', '12,14', '<p>where c = number of companies and n = number of students<em><br><strong>Question if this metric is to be removed and replaced with the general Unit Coordination metrics</strong></em><br></p>', '98.1', NULL),
(15, 'u2', '<p><strong>Lecture</strong> - Initial</p>', '3', '', '', '3', NULL),
(16, 'u3', '<p><strong>Lecture</strong> - Repeat</p>', '1', '', '', '1', NULL),
(19, 'u17', '<p><strong>Tutorial</strong> - Initial</p>', '2', '', '', '2', NULL),
(20, 'u4 & u38', '<p><strong>Tutorial</strong> - Repeat/Online</p>', '1', '', '', '1', NULL),
(21, 'u18', '<p><strong>Laboratory</strong> / Clinical / Demonstration - Initial</p>', '2', '', '', '2', NULL),
(22, 'u5', '<p><strong>Laboratory</strong> / Clinical / Demonstration - Repeat</p>', '1', '', '', '1', NULL),
(23, '', '<p><strong>Workshop</strong> - Initial</p>', '3', '', '', '3', NULL),
(24, '', '<p><strong>Workshop</strong> - Repeat</p>', '1', '', '', '1', NULL),
(25, 's99', '<p><strong>Quality of Teaching and Unit Survery</strong></p>', '25', '', 'This will be applied to units in the top quartile in the School for teaching and unit surveys for the previous year<br>', '25', NULL),
(28, 's25', '<p><strong>Chair of University Committee</strong> - Standard</p>', '100', '', '', '100', NULL),
(29, 's26', '<p><strong>Chair of University Committee</strong> - Major</p>', '200', '', '', '200', NULL),
(30, 's89', '<p><strong>Deputy Chair of University Committee - complex</strong></p>', '90', '', 'On recommendation of the HoD to the Dean<br>', '90', NULL),
(31, 's27', '<p><strong>Member of University Committee<br></strong></p>', '30', '', 'All other committees not defined elsewhere<br>', '30', NULL),
(32, 's28', '<p><strong>Member of University Committee</strong> - Complex</p>', '80', '', 'Complex committee = Academic Council, Animal Ethics Committee, Human Ethics Committee<br>', '80', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(18) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  `added_date` datetime NOT NULL,
  `gsetting_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `title`, `value`, `additional`, `added_date`, `gsetting_code`) VALUES
(1, 'Total Teaching Hour per staff', '1750', '', '2019-11-03 13:37:23', 'total_teaching'),
(2, 'Casual Staff Hourly rate', '75', '', '2019-11-03 03:07:08', 'casual_hourly'),
(4, 'Total Budget', '239845', '2020', '2019-11-03 13:52:06', 'casual_2020'),
(8, 'Casual budget', '22313', '2019', '2019-11-03 14:06:30', 'casual_2019'),
(9, 'Casual budget', '200000', '2022', '2019-11-03 14:08:26', 'casual_2022'),
(10, 'Offerings', 'S1,S2,TJA,TMA,TSA,TJD,TMD,TSD', '', '2019-11-03 22:43:46', 'offerings'),
(11, 'Total Budget', '800000', '2025', '2019-11-03 17:23:49', 'casual_2025');

-- --------------------------------------------------------

--
-- Table structure for table `unitactivitiesmeta`
--

CREATE TABLE `unitactivitiesmeta` (
  `unitactivitiesmetaID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unitactivitiesmeta`
--

INSERT INTO `unitactivitiesmeta` (`unitactivitiesmetaID`, `unitID`, `activitiesID`, `created`, `modified`) VALUES
(1, 27, 7, '2019-11-03 12:09:36', '0000-00-00 00:00:00'),
(2, 27, 8, '2019-11-03 12:09:36', '0000-00-00 00:00:00'),
(3, 27, 14, '2019-11-03 12:09:36', '0000-00-00 00:00:00'),
(4, 27, 15, '2019-11-03 12:09:36', '0000-00-00 00:00:00'),
(5, 27, 16, '2019-11-03 12:09:36', '0000-00-00 00:00:00'),
(6, 27, 17, '2019-11-03 12:09:36', '0000-00-00 00:00:00'),
(7, 28, 5, '2019-11-03 12:20:05', '0000-00-00 00:00:00'),
(8, 28, 7, '2019-11-03 12:20:05', '0000-00-00 00:00:00'),
(9, 28, 8, '2019-11-03 12:20:05', '0000-00-00 00:00:00'),
(10, 28, 13, '2019-11-03 12:20:05', '0000-00-00 00:00:00'),
(11, 28, 14, '2019-11-03 12:20:05', '0000-00-00 00:00:00'),
(12, 29, 22, '2019-11-03 14:53:00', '0000-00-00 00:00:00'),
(13, 29, 26, '2019-11-03 14:53:00', '0000-00-00 00:00:00'),
(14, 30, 22, '2019-11-03 14:53:35', '0000-00-00 00:00:00'),
(15, 30, 26, '2019-11-03 14:53:35', '0000-00-00 00:00:00'),
(16, 31, 22, '2019-11-03 14:53:57', '0000-00-00 00:00:00'),
(17, 31, 25, '2019-11-03 14:53:57', '0000-00-00 00:00:00'),
(18, 32, 25, '2019-11-03 14:54:22', '0000-00-00 00:00:00'),
(19, 33, 22, '2019-11-03 14:54:59', '0000-00-00 00:00:00'),
(20, 33, 26, '2019-11-03 14:54:59', '0000-00-00 00:00:00'),
(21, 33, 27, '2019-11-03 14:54:59', '0000-00-00 00:00:00'),
(22, 34, 22, '2019-11-03 14:55:32', '0000-00-00 00:00:00'),
(23, 34, 26, '2019-11-03 14:55:32', '0000-00-00 00:00:00'),
(24, 35, 22, '2019-11-03 14:56:00', '0000-00-00 00:00:00'),
(25, 35, 24, '2019-11-03 14:56:00', '0000-00-00 00:00:00'),
(26, 35, 25, '2019-11-03 14:56:00', '0000-00-00 00:00:00'),
(27, 36, 22, '2019-11-03 14:56:32', '0000-00-00 00:00:00'),
(28, 36, 25, '2019-11-03 14:56:32', '0000-00-00 00:00:00'),
(29, 37, 25, '2019-11-03 14:56:52', '0000-00-00 00:00:00'),
(30, 38, 22, '2019-11-03 14:57:23', '0000-00-00 00:00:00'),
(31, 38, 24, '2019-11-03 14:57:23', '0000-00-00 00:00:00'),
(32, 38, 25, '2019-11-03 14:57:23', '0000-00-00 00:00:00'),
(33, 39, 22, '2019-11-03 14:58:01', '0000-00-00 00:00:00'),
(34, 39, 24, '2019-11-03 14:58:01', '0000-00-00 00:00:00'),
(35, 39, 25, '2019-11-03 14:58:01', '0000-00-00 00:00:00'),
(36, 40, 22, '2019-11-03 14:58:29', '0000-00-00 00:00:00'),
(37, 40, 26, '2019-11-03 14:58:29', '0000-00-00 00:00:00'),
(38, 41, 22, '2019-11-03 14:59:39', '0000-00-00 00:00:00'),
(39, 41, 25, '2019-11-03 14:59:39', '0000-00-00 00:00:00'),
(40, 42, 22, '2019-11-03 15:00:08', '0000-00-00 00:00:00'),
(41, 42, 24, '2019-11-03 15:00:08', '0000-00-00 00:00:00'),
(42, 42, 25, '2019-11-03 15:00:08', '0000-00-00 00:00:00'),
(43, 43, 22, '2019-11-04 15:12:46', '0000-00-00 00:00:00'),
(44, 43, 23, '2019-11-04 15:12:46', '0000-00-00 00:00:00'),
(45, 43, 24, '2019-11-04 15:12:46', '0000-00-00 00:00:00'),
(46, 43, 25, '2019-11-04 15:12:46', '0000-00-00 00:00:00'),
(47, 43, 26, '2019-11-04 15:12:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `unitmetrics`
--

CREATE TABLE `unitmetrics` (
  `unitMetricsID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `metricsID` int(11) NOT NULL,
  `calcMetrics` float DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `unit_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `activities` varchar(255) DEFAULT NULL,
  `activities_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_code`, `activities`, `activities_modified`) VALUES
(30, 'Advanced Business', 'ICT535', NULL, NULL),
(31, 'Business Analytics', 'ICT 601', NULL, NULL),
(32, 'IT Group Project', 'ICT 621', NULL, NULL),
(33, 'Wireless Data Communication', 'ICT 503', NULL, NULL),
(34, 'LAN Design & Implementation', 'ICT 546', NULL, NULL),
(35, 'Project Management', 'ICT 508', NULL, NULL),
(36, 'Data Resource Management', 'ICT 616', NULL, NULL),
(37, 'IT Professional Practice', 'ICT 521', NULL, NULL),
(38, 'Business Analysis & System Development Approach', 'ICT 501', NULL, NULL),
(39, 'Applied Information Security Management', 'ICT 502', NULL, NULL),
(40, 'Communication Skills for Post Graduates', 'TLC 501', NULL, NULL),
(41, 'Knowledge Management', 'ICT 505', NULL, NULL),
(42, 'IT Strategy', 'ICT 622', NULL, NULL),
(43, 'Advanced Routing', 'ICT 611', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_users`
--

CREATE TABLE `unit_users` (
  `user_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) UNSIGNED NOT NULL,
  `role` enum('academicstaff','casualstaff','parttimestaff','staff','admin','none') DEFAULT 'staff',
  `name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `status` enum('active','cancelled','deactive','notactivated') DEFAULT NULL,
  `allocated_hour` int(100) DEFAULT NULL,
  `remaining_hour` int(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `name`, `first_name`, `middle_name`, `last_name`, `email`, `username`, `created`, `status`, `allocated_hour`, `remaining_hour`, `password`) VALUES
(1, 'casualstaff', 'Casual Staff', 'Casual', '', 'Staff', 'casual@murdoch.edu.au', 'casual@murdoch.edu.au', '2019-11-01 16:32:43', 'active', 0, 0, '21232f297a57a5a743894a0e4a801fc3'),
(23, 'admin', 'Hamid Laga', 'Hamid', '', 'Laga', 'hamid@murdoch.edu.au', 'admin', '2019-11-01 16:32:43', 'active', 1225, 0, '21232f297a57a5a743894a0e4a801fc3'),
(46, 'academicstaff', 'Peter  Cole', 'Peter', '', 'Cole', 'peter.cole@murdoch.edu.au', 'peter.cole@murdoch.edu.au', '2019-11-03 23:01:13', 'active', 700, 700, '8e6900a069e21dc720343a0bd9cd3e2e'),
(47, 'academicstaff', 'Val  Hobbs', 'Val', '', 'Hobbs', 'val.hobbs@murdoch.edu.au', 'val.hobbs@murdoch.edu.au', '2019-11-03 23:02:06', 'active', 875, 875, '2db2d45dc237d9394cd57c0d707709f7'),
(48, 'academicstaff', 'Mark  Henry', 'Mark', '', 'Henry', 'mark.henry@murdoch.edu.au', 'mark.henry@murdoch.edu.au', '2019-11-03 23:02:44', 'active', 350, 350, '1d845ded2a3afd7f70091a1598f32882'),
(49, 'parttimestaff', 'Yi-main  Cheong', 'Yi-main', '', 'Cheong', 'yimain@murdoch.edu.au', 'yimain@murdoch.edu.au', '2019-11-03 23:03:26', 'active', 438, 438, '5e5c47054f16257f79a90aa09b1ebc2a'),
(50, 'academicstaff', 'Bipu  Bajgai', 'Bipu', '', 'Bajgai', 'bipu.bajgai@murdoch.edu.au', 'bipu.bajgai@murdoch.edu.au', '2019-11-03 23:03:48', 'active', 1400, 1397, '4acb4ab5229c385f3aef8490c5328cc1'),
(51, 'staff', 'Travis  Weerts', 'Travis', '', 'Weerts', 'travis@murdoch.edu.au', 'travis@murdoch.edu.au', '2019-11-03 23:04:31', 'active', 1488, 1488, '74dd3cbe2538a7ee2226ab83827d4998'),
(52, 'staff', 'Nabin  Gurung', 'Nabin', '', 'Gurung', 'nabin@murdoch.edu.au', 'nabin@murdoch.edu.au', '2019-11-03 23:04:50', 'active', 1138, 1138, 'df207918c0402789d6ecdbdf5d4d8e7e'),
(53, 'parttimestaff', 'Aruj  Rajbanshi', 'Aruj', '', 'Rajbanshi', 'aruj@murdoch.edu.au', 'aruj@murdoch.edu.au', '2019-11-03 23:05:14', 'active', 910, 910, '82f981fcc4bad10a4fac84ff642d94a6'),
(54, 'casualstaff', 'Swosti  Shrestha', 'Swosti', '', 'Shrestha', 'swosti@murdoch.edu.au', 'swosti@murdoch.edu.au', '2019-11-03 23:05:53', 'active', 1610, 1607, 'bfe9279e75360fd966fa184bf4e34e97'),
(55, 'casualstaff', 'Sabaharish Raya Jayachandran', 'Sabaharish', 'Raya', 'Jayachandran', 'saba@harish.com.au', 'saba@harish.com.au', '2019-11-03 23:06:36', 'active', 394, 394, '102b88963c0c2f5eb4ba0ec824ad9a00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activitiesID`);

--
-- Indexes for table `activitymetricsmeta`
--
ALTER TABLE `activitymetricsmeta`
  ADD PRIMARY KEY (`activityMetricsMetaID`);

--
-- Indexes for table `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`allocationID`);

--
-- Indexes for table `allocationactlect`
--
ALTER TABLE `allocationactlect`
  ADD PRIMARY KEY (`allocationActLectID`);

--
-- Indexes for table `allocationofferings`
--
ALTER TABLE `allocationofferings`
  ADD PRIMARY KEY (`allocationOfferingsID`);

--
-- Indexes for table `budgetalloc`
--
ALTER TABLE `budgetalloc`
  ADD PRIMARY KEY (`budgetallocID`);

--
-- Indexes for table `coursepref`
--
ALTER TABLE `coursepref`
  ADD PRIMARY KEY (`courseprefID`);

--
-- Indexes for table `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`hoursID`);

--
-- Indexes for table `metrics`
--
ALTER TABLE `metrics`
  ADD PRIMARY KEY (`met_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `unitactivitiesmeta`
--
ALTER TABLE `unitactivitiesmeta`
  ADD PRIMARY KEY (`unitactivitiesmetaID`);

--
-- Indexes for table `unitmetrics`
--
ALTER TABLE `unitmetrics`
  ADD PRIMARY KEY (`unitMetricsID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `unit_users`
--
ALTER TABLE `unit_users`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activitiesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `activitymetricsmeta`
--
ALTER TABLE `activitymetricsmeta`
  MODIFY `activityMetricsMetaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allocation`
--
ALTER TABLE `allocation`
  MODIFY `allocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `allocationactlect`
--
ALTER TABLE `allocationactlect`
  MODIFY `allocationActLectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `allocationofferings`
--
ALTER TABLE `allocationofferings`
  MODIFY `allocationOfferingsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `budgetalloc`
--
ALTER TABLE `budgetalloc`
  MODIFY `budgetallocID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coursepref`
--
ALTER TABLE `coursepref`
  MODIFY `courseprefID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `hours`
--
ALTER TABLE `hours`
  MODIFY `hoursID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metrics`
--
ALTER TABLE `metrics`
  MODIFY `met_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `unitactivitiesmeta`
--
ALTER TABLE `unitactivitiesmeta`
  MODIFY `unitactivitiesmetaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `unitmetrics`
--
ALTER TABLE `unitmetrics`
  MODIFY `unitMetricsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
