-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2017 at 06:06 PM
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
-- Table structure for table `blocked_user`
--

CREATE TABLE IF NOT EXISTS `blocked_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `From_User` int(20) NOT NULL,
  `To_User` int(20) NOT NULL,
  `Time` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FilePath` varchar(1000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`ID`, `FilePath`) VALUES
(1, 'chat_5_6_20170429102256.txt'),
(2, 'chat_5_6_20170429102330.txt'),
(3, 'chat_5_6_20170429102424.txt'),
(4, 'chat_5_6_20170429102437.txt'),
(5, 'chat_5_6_20170429102503.txt'),
(6, 'chat_5_6_20170429102532.txt'),
(7, 'chat_5_7_20170429010428.txt'),
(8, 'chat_5_8_20170429011227.txt'),
(9, 'chat_5_11_20170508062741.txt'),
(10, 'chat_5_14_20170508062949.txt'),
(11, 'chat_5_15_20170508070038.txt');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(20) DEFAULT NULL,
  `Friend_ID` int(20) DEFAULT NULL,
  `Chat_ID` int(20) DEFAULT NULL,
  `Last_Chat` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Friend_ID` (`Friend_ID`),
  KEY `Chat_ID` (`Chat_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`ID`, `User_ID`, `Friend_ID`, `Chat_ID`, `Last_Chat`) VALUES
(7, 5, 7, 7, '0000-00-00 00:00:00'),
(8, 5, 8, 8, '0000-00-00 00:00:00'),
(9, 5, 11, 9, '0000-00-00 00:00:00'),
(10, 5, 14, 10, '0000-00-00 00:00:00'),
(11, 5, 15, 11, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE IF NOT EXISTS `friend_request` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `From_User` int(20) NOT NULL,
  `To_User` int(20) NOT NULL,
  `Time_of_Request` datetime NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `From_User` (`From_User`),
  KEY `To_User` (`To_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`ID`, `From_User`, `To_User`, `Time_of_Request`, `Status`) VALUES
(3, 5, 5, '2017-04-24 09:16:10', 2),
(4, 6, 5, '2017-04-26 09:00:57', 1),
(5, 7, 5, '2017-04-29 01:02:59', 1),
(6, 8, 5, '2017-04-29 01:12:03', 1),
(7, 11, 5, '2017-05-08 05:45:17', 1),
(8, 14, 5, '2017-05-08 06:29:23', 1),
(9, 15, 5, '2017-05-08 07:00:03', 1),
(10, 16, 5, '2017-05-09 04:31:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Public_ID` varchar(50) NOT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Middle_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Gender` char(1) NOT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Last_Seen` datetime DEFAULT NULL,
  `Profile_Pic` varchar(500) NOT NULL,
  `Active` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Public_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `DOB`, `Gender`, `Phone`, `Email`, `Password`, `Last_Seen`, `Profile_Pic`, `Active`) VALUES
(1, '0', 'df', 'sd', 'sd', '2017-04-10', 'M', '0', 'ds@fb.cvdn', '12345', '2017-04-13 09:39:10', '', 0),
(2, '0', 'df', 'sd', 'sd', '2017-04-10', 'M', '0', 'ds@fb.cvdn', '12', '0000-00-00 00:00:00', '', 0),
(3, '0', 'ds', 'w', 'a', '2017-04-10', 'M', '0', 'ds@d.h', '12234', '0000-00-00 00:00:00', '', 0),
(4, 'ds4', 'ds', 'w', 'a', '2017-04-10', 'M', '0', 'ds23@d.h', 'w232', '0000-00-00 00:00:00', '', 0),
(5, 'Vi5', 'Vijay', 'Kumar', 'Gupta', '2017-04-02', 'M', '1234567890', 'vijay@email.com', '12345', '2017-05-09 04:32:06', '', 0),
(6, 'Vi6', 'Vivek', '', 'Panicker', '2017-04-03', 'M', '2147483647', 'vivek@email.com', '123', '2017-04-26 08:57:20', '/Profile/vivek.jpg', 0),
(7, 'Pr7', 'Prabind', '', 'Singh', '2017-04-03', 'M', '2147483647', 'prabind@email.com', '12345', '2017-04-29 12:45:47', 'Profile/55807_1493469839.1462_Prabind.jpg', 0),
(8, 'Vi8', 'Vivek', '', 'Panicker', '2017-04-15', 'M', '2147483647', 'viv@email.com', '12345', '2017-04-29 01:11:50', 'Profile/84753_1493471495.7501_vivek.jpg', 0),
(11, 'Sn11', 'Snehajit', '', 'Gupta', '2017-04-02', 'M', '5432154321', 'snehajt@email.com', '12345', '2017-05-08 05:44:52', 'Profile/55181_1493550086.4129_snehajit.jpg', 0),
(14, 'Su14', 'Surajit', '', 'Chawdhury', '2017-04-02', 'M', '6987451230', 'sura@rmail.com', '12345', '2017-05-08 06:28:58', 'Profile/2224_1493566489.5887_surajit.jpg', 0),
(15, 'Sh15', 'Shraddha', '', 'Gupta', '2017-05-26', 'F', '5823691470', 'shra@emai.com', '12345', '2017-05-08 06:59:51', 'Profile/44543_1494269969.9264_shraddha.jpg', 0),
(16, 'Aj16', 'Ajay', '', 'Saxena', '2017-05-01', 'M', '3216549870', 'ajay@email.com', '12345', '2017-05-09 04:31:33', 'Profile/49301_1494347478.544_786539.jpg', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`Friend_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friends_ibfk_3` FOREIGN KEY (`Chat_ID`) REFERENCES `chat` (`ID`),
  ADD CONSTRAINT `friends_ibfk_4` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friends_ibfk_5` FOREIGN KEY (`Friend_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friends_ibfk_6` FOREIGN KEY (`Chat_ID`) REFERENCES `chat` (`ID`);

--
-- Constraints for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `friend_request_ibfk_1` FOREIGN KEY (`From_User`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `friend_request_ibfk_2` FOREIGN KEY (`To_User`) REFERENCES `user` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
