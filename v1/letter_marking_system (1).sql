-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 31, 2024 at 10:17 AM
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
-- Table structure for table `emp_id`
--

DROP TABLE IF EXISTS `emp_id`;
CREATE TABLE IF NOT EXISTS `emp_id` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile_no` int NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `cadre_id` int NOT NULL,
  `desig_id` int NOT NULL,
  `group_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `emp_id`
--

INSERT INTO `emp_id` (`id`, `first_name`, `middle_name`, `last_name`, `mobile_no`, `email_id`, `cadre_id`, `desig_id`, `group_id`, `username`, `password`, `user_type`) VALUES
(1, 'jane', 'smith', 'mary', 2147483647, 'janesmith@gmail.com', 102, 5, 2, 'janemary', 'password345', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `grps`
--

DROP TABLE IF EXISTS `grps`;
CREATE TABLE IF NOT EXISTS `grps` (
  `group_id` int NOT NULL AUTO_INCREMENT,
  `ad_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gh_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

DROP TABLE IF EXISTS `letters`;
CREATE TABLE IF NOT EXISTS `letters` (
  `letter_id` int NOT NULL AUTO_INCREMENT,
  `letter_mode` varchar(50) DEFAULT NULL,
  `docket_number` int DEFAULT NULL,
  `docket_date` date DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `letter_number` varchar(50) DEFAULT NULL,
  `letter_date` date DEFAULT NULL,
  `establishment_name` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `file_size` bigint DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`letter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`letter_id`, `letter_mode`, `docket_number`, `docket_date`, `category`, `letter_number`, `letter_date`, `establishment_name`, `subject`, `file_size`, `visibility`, `filename`) VALUES
(123, 'Letter', 355, '2024-05-01', 'feedback', '45368', '2024-05-31', 'drdo', 'form', NULL, 'General', NULL),
(129, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, NULL, NULL),
(130, 'Letter', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, NULL, '  '),
(131, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'General', ''),
(132, '$letter_mode', 0, '0000-00-00', '$category', '$letter_number', '0000-00-00', '$establishment_name', '$subject', NULL, '$visibilit', '$filename'),
(133, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'General', 'Uploads/feedback Complaint.docx'),
(134, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'Select Typ', 'Uploads/Check points_ rajbhasha_ hindi cell.pdf'),
(135, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'General', 'Uploads/Check points_ rajbhasha_ hindi cell.pdf'),
(136, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'General', 'Uploads/Performance Quaretrly Data(1).docx'),
(137, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'General', ''),
(138, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', NULL, 'General', 'Authority Letter.docx'),
(139, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', 'abc', NULL, 'Select Typ', 'Uploads/Check points_ rajbhasha_ hindi cell.pdf'),
(140, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', 'abc', NULL, 'General', 'Uploads/Check points_ rajbhasha_ hindi cell.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `marking`
--

DROP TABLE IF EXISTS `marking`;
CREATE TABLE IF NOT EXISTS `marking` (
  `mark_id` int NOT NULL,
  `marked_letter_id` int DEFAULT NULL,
  `marked_to` char(30) DEFAULT NULL,
  `marked_by` char(30) DEFAULT NULL,
  `mark_date` date DEFAULT NULL,
  PRIMARY KEY (`mark_id`),
  KEY `fk_letter_id` (`marked_letter_id`),
  KEY `fk_user_id` (`marked_to`),
  KEY `fk_marked_by_id` (`marked_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
