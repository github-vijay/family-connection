-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2017 at 04:00 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `family_connection`
--
CREATE DATABASE IF NOT EXISTS `family_connection` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `family_connection`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FilePath` varchar(1000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(50) NOT NULL,
  `FID` int(50) NOT NULL,
  `ChatID` int(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UID` (`UID`),
  KEY `FID` (`FID`),
  KEY `ChatID` (`ChatID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Public_ID` varchar(50) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Mname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` char(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Last_seen` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Public_ID`, `Fname`, `Mname`, `Lname`, `DOB`, `Gender`, `Email`, `Password`, `Last_seen`) VALUES
(1, '0', 'df', 'sd', 'sd', '2017-04-10', 'M', 'ds@fb.cvdn', '12345', '2017-04-13 09:39:10'),
(2, '0', 'df', 'sd', 'sd', '2017-04-10', 'M', 'ds@fb.cvdn', '12', '0000-00-00 00:00:00'),
(3, '0', 'ds', 'w', 'a', '2017-04-10', 'M', 'ds@d.h', '12234', '0000-00-00 00:00:00'),
(4, 'ds4', 'ds', 'w', 'a', '2017-04-10', 'M', 'ds23@d.h', 'w232', '0000-00-00 00:00:00'),
(5, 'Vi5', 'Vijay', 'Kumar', 'Gupta', '2017-04-02', 'M', 'vijay@email.com', '12345', '2017-04-14 03:56:13'),
(6, 'Vi6', 'Vivek', '', 'Panicker', '2017-04-03', 'M', 'vivek@email.com', '123', '2017-04-13 09:55:02');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`FID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friends_ibfk_3` FOREIGN KEY (`ChatID`) REFERENCES `chat` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
