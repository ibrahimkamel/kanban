-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 09:23 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kanban`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `taskID` int(11) NOT NULL AUTO_INCREMENT,
  `taskName` varchar(45) NOT NULL,
  `taskDescription` varchar(200) NOT NULL,
  `taskPriority` enum('1','2','3') NOT NULL,
  `taskStatus` enum('todo','inprogress','testing','done') NOT NULL,
  `taskDue` date DEFAULT NULL,
  `taskOwnerID` int(11) NOT NULL,
  PRIMARY KEY (`taskID`),
  UNIQUE KEY `taskID_UNIQUE` (`taskID`),
  KEY `taskOwnerID` (`taskOwnerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskID`, `taskName`, `taskDescription`, `taskPriority`, `taskStatus`, `taskDue`, `taskOwnerID`) VALUES
(59, 'roma1', 'rrrrrrrr', '1', 'done', '1111-11-11', 1),
(73, 'roma1', 'rrrrrrrr', '1', 'done', '1111-11-11', 1),
(74, 'roma1', 'rrrrrrrr', '1', 'todo', '1111-11-11', 1),
(77, 'roma1uuuuuuuu ', 'rrrrrrrr', '1', 'done', '1111-11-11', 1),
(93, 'flk', 'lzafska;lfk', '1', 'testing', '2017-04-23', 1),
(98, '2734', '.AEF,M', '1', 'todo', '1992-03-01', 1),
(101, 'radio', 'model', '2', 'testing', '1999-09-09', 1),
(103, 'reset', 'formmm', '2', 'inprogress', '2009-09-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `userEmail` varchar(45) NOT NULL,
  `userPhone` varchar(11) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `usereEmail_UNIQUE` (`userEmail`),
  UNIQUE KEY `userID_UNIQUE` (`userID`),
  UNIQUE KEY `userPhone_UNIQUE` (`userPhone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userEmail`, `userPhone`, `birthDate`, `password`) VALUES
(1, 'Reham', 'rtammam@gmail.com', '1555', '1995-05-27', 'kimo'),
(3, 'newname', 'kimo@kimo.coma', '11111144171', '1992-12-14', 'ghjghgghdasda'),
(20, 'ibrahasd', 'lo@lo.com', '11111111111', '1992-12-12', 'lo'),
(24, 'ki', 'se@Gh.com', '23455678000', '0000-11-11', 'dcv'),
(32, 'ki', 'sea@Gh.com', '23455678001', '0000-11-11', 'dcv'),
(35, 'ki', 'seah@Gh.com', '23455677001', '0000-11-11', 'dcv'),
(39, 'ki', 'asd@Gh.com', '23455677022', '0000-11-11', 'dcv'),
(42, 'ki', 'asdsad@Gh.com', '23455677026', '0000-11-11', 'dcv'),
(45, 'ki', 'asdsad@ah.com', '23451677026', '0000-11-11', 'dcv'),
(46, 'ki', 'asdsaasdd@ah.com', '23451117026', '0000-11-11', 'dcv'),
(49, 'ki', 'asdd@ah.com', '23453317026', '0000-11-11', 'dcv'),
(51, 'ki', 'asjdd@ah.com', '23459317026', '0000-11-11', 'dcv'),
(53, 'ki', 'asjdd@h.com', '23489317026', '0000-11-11', 'dcv'),
(55, 'ki', 'as@h.com', '23487317026', '0000-11-11', 'dcv'),
(58, 'ki', 'as@hj.com', '23487317826', '0000-11-11', 'dcv'),
(59, 'aber', 'aber@lobna.com', '01010000000', '1992-12-12', 'aber'),
(60, 'fdgff', 'gfkhfklh@ojdfsdfkl.com', '', '1234-03-03', '23432342');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`taskOwnerID`) REFERENCES `user` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
