-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 02:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

CREATE TABLE `cadre` (
  `cadre_id` tinyint(4) NOT NULL,
  `cadre_name` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `desig`
--

CREATE TABLE `desig` (
  `desig_id` int(4) NOT NULL,
  `desig_name` varchar(50) NOT NULL,
  `desig_fullname` varchar(50) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_id`
--

CREATE TABLE `emp_id` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gen` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `user_type` enum('Admin','User') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` timestamp NULL DEFAULT NULL,
  `role_id` int(4) DEFAULT NULL,
  `group_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_id`
--

INSERT INTO `emp_id` (`id`, `first_name`, `middle_name`, `last_name`, `gen`, `dob`, `mobile_no`, `email_id`, `user_type`, `username`, `password`, `status`, `is_created`, `is_deleted`, `role_id`, `group_id`) VALUES
(1, 'John', 'A', 'Doe', 'Male', '1990-01-01', 1234567890, 'john.doe@example.com', 'Admin', 'johndoe', 'password123', '1', '2024-05-28 16:48:01', NULL, NULL, NULL),
(2, 'Jane', 'B', 'Smith', 'Female', '1985-05-15', 2147483647, 'jane.smith@example.com', 'User', 'janesmith', 'password456', '1', '2024-05-28 16:48:01', NULL, NULL, NULL),
(3, 'Alice', 'C', 'Johnson', 'Female', '1992-07-20', 2147483647, 'alice.johnson@example.com', 'User', 'alicejohnson', 'password789', '2', '2024-05-28 16:48:01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grps`
--

CREATE TABLE `grps` (
  `group_id` tinyint(4) NOT NULL,
  `group_name` varchar(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gh_id` int(6) NOT NULL,
  `ad_id` int(5) NOT NULL,
  `va1_id` int(6) NOT NULL,
  `va2_id` int(6) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `letter_id` int(11) NOT NULL,
  `letter_mode` varchar(50) DEFAULT NULL,
  `docket_number` int(11) DEFAULT NULL,
  `docket_date` date DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `letter_number` varchar(50) DEFAULT NULL,
  `letter_date` date DEFAULT NULL,
  `establishment_name` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`letter_id`, `letter_mode`, `docket_number`, `docket_date`, `category`, `letter_number`, `letter_date`, `establishment_name`, `subject`, `filename`) VALUES
(1, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', '', 'Uploads/cover page.docx'),
(2, 'Select Mode', 0, '0000-00-00', '', '', '0000-00-00', '', 'complaint', 'Uploads/ResumeParul.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(4) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `desig_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadre`
--
ALTER TABLE `cadre`
  ADD PRIMARY KEY (`cadre_id`);

--
-- Indexes for table `desig`
--
ALTER TABLE `desig`
  ADD PRIMARY KEY (`desig_id`),
  ADD KEY `fk_cadre_id` (`cadre_id`);

--
-- Indexes for table `emp_id`
--
ALTER TABLE `emp_id`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `fk_grp_id` (`group_id`);

--
-- Indexes for table `grps`
--
ALTER TABLE `grps`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`letter_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `fk_desig_id` (`desig_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadre`
--
ALTER TABLE `cadre`
  MODIFY `cadre_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `desig`
--
ALTER TABLE `desig`
  MODIFY `desig_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `emp_id`
--
ALTER TABLE `emp_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grps`
--
ALTER TABLE `grps`
  MODIFY `group_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `letter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_desig_id` FOREIGN KEY (`desig_id`) REFERENCES `desig` (`desig_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
