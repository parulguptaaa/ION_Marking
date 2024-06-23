-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2024 at 11:06 AM
-- Server version: 5.5.28-log
-- PHP Version: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfees`
--

-- --------------------------------------------------------

--
-- Table structure for table `id_cadre`
--

CREATE TABLE IF NOT EXISTS `id_cadre` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_desig`
--

CREATE TABLE IF NOT EXISTS `id_desig` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desig_fullname` varchar(50) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_emp`
--

CREATE TABLE IF NOT EXISTS `id_emp` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `gen` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `internal_desig_id` int(4) NOT NULL,
  `group_id` int(5) NOT NULL,
  `user_type` char(9) NOT NULL,
  `telephone_no` varchar(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_gazetted` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=318 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_group`
--

CREATE TABLE IF NOT EXISTS `id_group` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gh_id` int(6) NOT NULL,
  `ad_id` int(5) NOT NULL,
  `va1_id` int(6) NOT NULL,
  `va2_id` int(6) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_internaldesig`
--

CREATE TABLE IF NOT EXISTS `id_internaldesig` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `shortname` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_labdesig`
--

CREATE TABLE IF NOT EXISTS `id_labdesig` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(4) NOT NULL,
  `empid` int(5) NOT NULL,
  `desig_id` tinyint(4) NOT NULL,
  `internaldesigid` tinyint(4) NOT NULL,
  `do_no` varchar(255) NOT NULL,
  `dated` date NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
