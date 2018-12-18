-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2018 at 01:58 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `sb_clients`
--

CREATE TABLE IF NOT EXISTS `sb_clients` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNo` int(11) NOT NULL,
  `projectName` varchar(255) NOT NULL,
  PRIMARY KEY (`clientID`),
  UNIQUE KEY `Email` (`email`,`contactNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sb_clients`
--

INSERT INTO `sb_clients` (`clientID`, `name`, `email`, `contactNo`, `projectName`) VALUES
(6, 'teju', 'teju@gmail', 123456789, 'testing now'),
(7, 'prerna paul', 'prerna@gmail.com', 947652345, 'testing'),
(13, 'rahul111', 'rahul@gmail.com', 9876546, 'hgfvbhyty'),
(15, 'Ajay', 'ajay@123', 1234567890, 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `sb_daily_worklog`
--

CREATE TABLE IF NOT EXISTS `sb_daily_worklog` (
  `worklogID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `totalTime` varchar(20) NOT NULL,
  PRIMARY KEY (`worklogID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sb_departments`
--

CREATE TABLE IF NOT EXISTS `sb_departments` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`departmentID`),
  UNIQUE KEY `Name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sb_departments`
--

INSERT INTO `sb_departments` (`departmentID`, `name`) VALUES
(1, '.net'),
(4, 'Android'),
(5, 'IOS'),
(3, 'Mean Stack'),
(2, 'PHP'),
(6, 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `sb_employee`
--

CREATE TABLE IF NOT EXISTS `sb_employee` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`employeeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sb_employee`
--

INSERT INTO `sb_employee` (`employeeID`, `name`, `email`, `departmentID`, `roleID`, `username`, `password`) VALUES
(1, 'Ravi Choudhary', 'ravichoudhary@gmail.com', 2, 1, 'ravi', 'ravi@123'),
(2, 'shaini paul', 'shaini@gmail.com', 2, 5, 'shaini', 'shaini@123'),
(3, 'Kirti Sharma', 'kirti@gmail.com', 1, 6, 'kirti123', 'kirti@123');

-- --------------------------------------------------------

--
-- Table structure for table `sb_employees`
--

CREATE TABLE IF NOT EXISTS `sb_employees` (
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sb_employees`
--

INSERT INTO `sb_employees` (`password`) VALUES
(''),
('neha@123'),
('admin@123'),
('admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `sb_projects`
--

CREATE TABLE IF NOT EXISTS `sb_projects` (
  `projectID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `projectCode` int(11) NOT NULL,
  `startDate` varchar(20) NOT NULL,
  `clientID` int(11) NOT NULL,
  `Attachment` varchar(100) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `projectStatus` varchar(100) NOT NULL,
  `departmentID` int(11) NOT NULL,
  PRIMARY KEY (`projectID`),
  UNIQUE KEY `Title` (`title`,`projectCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sb_projects`
--

INSERT INTO `sb_projects` (`projectID`, `title`, `description`, `projectCode`, `startDate`, `clientID`, `Attachment`, `employeeID`, `projectStatus`, `departmentID`) VALUES
(1, 'testing', 'jhggfthjbdf', 301, '98775', 0, '<br /><b>Notice</b>:  Undefined variable: Attachment in <b>/opt/lampp/htdocs/PMS/add-project.php</b>', 0, '', 0),
(2, 'new test', 'kjjhhgfdfggjjjbbvghjnj', 801, '9 aug 2018', 0, '', 0, '', 2),
(3, '', '', 0, '', 0, '', 0, '', 1),
(4, 'bhagi', 'vhhhjhcxhyftftf', 876, '876gjikg', 6, '', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sb_role`
--

CREATE TABLE IF NOT EXISTS `sb_role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sb_role`
--

INSERT INTO `sb_role` (`roleID`, `name`) VALUES
(1, 'pm'),
(2, 'apm'),
(3, 'tl'),
(4, 'atl'),
(5, 'jd'),
(6, 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `sb_subprojects`
--

CREATE TABLE IF NOT EXISTS `sb_subprojects` (
  `projectID` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `attachment` varchar(5000) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `deadlineTime` varchar(40) NOT NULL,
  `estimatedTime` varchar(40) NOT NULL,
  PRIMARY KEY (`projectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
