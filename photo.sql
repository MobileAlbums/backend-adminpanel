-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2015 at 08:44 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `user_pass` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin_login`
--


-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `date` varchar(40) NOT NULL,
  `filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `date`, `filename`) VALUES
(189, 'dfd', '02-16-15', 'image-189.png'),
(175, 'vvvv', '02-15-15', 'image-175.png'),
(172, 'ggggggg', '02-15-15', 'image-172.png'),
(187, 'sdf', '02-16-15', 'image-182.png'),
(188, 'xx', '02-16-15', 'image-188.png'),
(181, 'ttt', '02-15-15', 'image-181.png'),
(167, 'bbb', '02-15-15', 'image-167.png'),
(176, 'lll', '02-15-15', 'image-176.png'),
(178, 'jjj', '02-15-15', 'image-178.png'),
(179, 'hhh', '02-15-15', 'image-179.png'),
(190, 'New Album', '02-16-15', 'image-190.png'),
(191, 'ert', '02-16-15', 'image-191.png');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` varchar(225) NOT NULL,
  `filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `album_id`, `name`, `date`, `filename`) VALUES
(140, 189, 'New Picture', '02-16-15', 'image-189-133.png'),
(128, 175, 'New Picture', '02-16-15', 'image-175-128.png'),
(127, 175, 'New Picture', '02-16-15', 'image-175-112.png'),
(111, 182, 'v5', '02-15-15', 'image-182-111.png'),
(110, 182, 'a1', '02-15-15', 'image-182-110.png'),
(106, 172, 'bbbbb', '02-15-15', 'image-172-106.png'),
(100, 172, 'dd', '02-15-15', 'image-172-173.png'),
(103, 172, 'ff', '02-15-15', 'image-172-101.png'),
(104, 168, 'gg', '02-15-15', 'image-168-104.png'),
(105, 172, 'New Picture', '02-15-15', 'image-172-105.png'),
(141, 189, 'qeertu', '02-16-15', 'image-189-141.png'),
(132, 175, 'New Picture', '02-16-15', 'image-175-130.png'),
(142, 192, 'zzz', '02-16-15', 'image-192-142.png'),
(143, 192, 'ss', '02-16-15', 'image-192-143.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(10) NOT NULL AUTO_INCREMENT,
  `groupid` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `loginid` varchar(75) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `firstname` varchar(75) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `lastname` varchar(75) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `pwd` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `emailpass` varchar(20) CHARACTER SET latin1 NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'Yes',
  `master` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=100005 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `groupid`, `loginid`, `firstname`, `lastname`, `pwd`, `email`, `emailpass`, `lastlogin`, `status`, `master`) VALUES
(100000, '', 'alanbolsh', 'alan', 'bolsh', 'pass', 'alanbolsh@hotmail.com', '', '2015-02-08 23:10:19', 'Yes', 'No'),
(100001, '', 'omc', 'o', 'mc', 'oomc', 'omc@hotmail.com', '', '2015-02-16 11:25:17', 'Yes', 'No'),
(100002, '', 'aaaa', 'aa', 'aa', 'asas', 'asas@hotmail.com', '', '2015-02-16 12:25:42', 'Yes', 'No');
