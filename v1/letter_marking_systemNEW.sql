-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2024 at 11:40 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letter_marking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadre`
--

DROP TABLE IF EXISTS `cadre`;
CREATE TABLE IF NOT EXISTS `cadre` (
  `cadre_id` tinyint NOT NULL AUTO_INCREMENT,
  `cadre_name` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`cadre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `desig`
--

DROP TABLE IF EXISTS `desig`;
CREATE TABLE IF NOT EXISTS `desig` (
  `desig_id` int NOT NULL AUTO_INCREMENT,
  `desig_name` varchar(50) NOT NULL,
  `desig_fullname` varchar(50) NOT NULL,
  `cadre_id` tinyint NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`desig_id`),
  KEY `fk_cadre_id` (`cadre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_id`
--

DROP TABLE IF EXISTS `emp_id`;
CREATE TABLE IF NOT EXISTS `emp_id` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gen` enum('Male','Female') COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` int NOT NULL,
  `email_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('Admin','User') COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` timestamp NULL DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `group_id` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `fk_grp_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_id`
--

INSERT INTO `emp_id` (`id`, `first_name`, `middle_name`, `last_name`, `gen`, `dob`, `mobile_no`, `email_id`, `user_type`, `username`, `password`, `status`, `is_created`, `is_deleted`, `role_id`, `group_id`) VALUES
(1, 'John', 'A', 'Doe', 'Male', '1990-01-01', 1234567890, 'john.doe@example.com', 'User', 'johndoe', 'password123', '1', '2024-05-28 16:48:01', NULL, NULL, 101),
(2, 'Jane', 'B', 'Smith', 'Female', '1985-05-15', 2147483647, 'jane.smith@example.com', 'User', 'janesmith', 'password456', '1', '2024-05-28 16:48:01', NULL, 4, 101),
(3, 'Alice', 'C', 'Johnson', 'Female', '1992-07-20', 2147483647, 'alice.johnson@example.com', 'User', 'alicejohnson', 'password789', '2', '2024-05-28 16:48:01', NULL, 4, 101),
(4, 'shaun', 'C', 'drake', 'Male', '1992-03-20', 2147482247, 'shaun.drake@example.com', 'User', 'shaundrake', 'password123', '1', '0000-00-00 00:00:00', NULL, 4, 101),
(5, 'Usha', 'Kumari', 'Saxena', 'Female', '1999-03-20', 2147482147, 'Usha.Saxena@example.com', 'User', 'ushaSaxena', 'password123', '1', '0000-00-00 00:00:00', NULL, 4, 102);

-- --------------------------------------------------------

--
-- Table structure for table `grps`
--

DROP TABLE IF EXISTS `grps`;
CREATE TABLE IF NOT EXISTS `grps` (
  `group_id` tinyint NOT NULL AUTO_INCREMENT,
  `group_name` varchar(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gh_id` int DEFAULT NULL,
  `va1_id` int NOT NULL,
  `va2_id` int NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `ad_id` int DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `gh_id` (`gh_id`),
  KEY `ad_id` (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grps`
--

INSERT INTO `grps` (`group_id`, `group_name`, `fullname`, `gh_id`, `va1_id`, `va2_id`, `is_created`, `is_deleted`, `ad_id`) VALUES
(101, 'Q', 'QRST', 1, 0, 0, '2024-06-05 05:29:55', 'no', NULL),
(102, 'W', 'WXYZ', NULL, 0, 0, '0000-00-00 00:00:00', 'no', 5);

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

DROP TABLE IF EXISTS `letters`;
CREATE TABLE IF NOT EXISTS `letters` (
  `letter_id` int NOT NULL AUTO_INCREMENT,
  `letter_mode` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `docket_number` int DEFAULT NULL,
  `docket_date` date DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `letter_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `letter_date` date DEFAULT NULL,
  `establishment_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`letter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`letter_id`, `letter_mode`, `docket_number`, `docket_date`, `category`, `letter_number`, `letter_date`, `establishment_name`, `subject`, `filename`, `uploaded_date`) VALUES
(1, 'Letter', 1023748, '2002-05-24', 'Feedback', 'FD/CFEES/23', '2002-04-24', 'CFEES', 'regarding feedback', 'Uploads/cover page.docx', '2024-06-05 06:13:36'),
(2, 'Image', 1283940, '2024-06-02', 'Complaint', 'CFEES/CM/!2', '2024-06-01', 'INMAS', 'regarding complaint', 'Uploads/ResumeParul.pdf', '2024-06-05 06:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `marked_letters`
--

DROP TABLE IF EXISTS `marked_letters`;
CREATE TABLE IF NOT EXISTS `marked_letters` (
  `mark_id` int NOT NULL AUTO_INCREMENT,
  `marked_letter_id` int DEFAULT NULL,
  `marked_by` int DEFAULT NULL,
  `marked_to` int DEFAULT NULL,
  `marked_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mark_id`),
  KEY `marked_by` (`marked_by`),
  KEY `marked_to` (`marked_to`),
  KEY `marked_letter_id` (`marked_letter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `fullname`, `is_created`, `is_deleted`) VALUES
(4, 'EMPLOYEE', 'NORMAL EMPLOYEE', '2024-06-05 05:27:29', 'no');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `desig`
--
ALTER TABLE `desig`
  ADD CONSTRAINT `fk_cadre_id` FOREIGN KEY (`cadre_id`) REFERENCES `cadre` (`cadre_id`);

--
-- Constraints for table `emp_id`
--
ALTER TABLE `emp_id`
  ADD CONSTRAINT `emp_id_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `fk_grp_id` FOREIGN KEY (`group_id`) REFERENCES `grps` (`group_id`);

--
-- Constraints for table `grps`
--
ALTER TABLE `grps`
  ADD CONSTRAINT `grps_ibfk_1` FOREIGN KEY (`gh_id`) REFERENCES `emp_id` (`id`),
  ADD CONSTRAINT `grps_ibfk_2` FOREIGN KEY (`ad_id`) REFERENCES `emp_id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
