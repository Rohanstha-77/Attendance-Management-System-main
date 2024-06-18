-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 02:58 PM
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
-- Database: `attendancemanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL DEFAULT 'admin',
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Rohan Shrestha', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `app_id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `application_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`app_id`, `student_id`, `date`, `subject`, `message`, `application_status`) VALUES
(2, 13, '2024/May/21 Tuesday', ' sick leave', ' i have  a big problem', 'approved'),
(3, 13, '2024/May/21 Tuesday', 'application for sick leave', 'I am writing to request a leave of absence from [start date] to [end date] due to [reason for leave]. \r\n\r\nDuring this period, I will ensure to keep up with my studies and submit any pending assignments upon my return. I will coordinate with my classmates ', 'approved'),
(5, 12, '2024/May/21 Tuesday', 'Leave Application for Medical Reasons', '\r\nI am writing to request a leave of absence from June 1, 2024, to June 15, 2024, due to medical reasons. I have been advised by my doctor to undergo a minor surgical procedure and will require time to recover post-surgery.\r\n\r\nDuring this period, I will m', 'pending'),
(6, 12, '2024/May/21 Tuesday', 'Leave Application for Medical Reasons', '\r\nI am writing to formally request a leave of absence from June 1, 2024, to June 15, 2024, due to medical reasons. I have been advised by my doctor to undergo a minor surgical procedure and will require time to recover post-surgery.\r\n\r\nDuring this period,', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `a_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`a_id`, `s_id`, `date`, `faculty`, `semester`, `status`) VALUES
(35, 12, '2024/May/17 Friday', 'BCA', 'Four', 'present'),
(36, 13, '2024/May/17 Friday', 'BCA', 'Four', 'present'),
(37, 15, '2024/May/17 Friday', 'BCA', 'Four', 'absent'),
(39, 14, '2024/May/17 Friday', 'CSIT', 'Four', 'present'),
(40, 12, '2024/May/18 Saturday', 'BCA', 'Four', 'present'),
(41, 13, '2024/May/18 Saturday', 'BCA', 'Four', 'present'),
(42, 15, '2024/May/18 Saturday', 'BCA', 'Four', 'present'),
(43, 14, '2024/May/18 Saturday', 'CSIT', 'Four', 'present'),
(44, 12, '2024/May/19 Sunday', 'BCA', 'Four', 'present'),
(45, 13, '2024/May/19 Sunday', 'BCA', 'Four', 'absent'),
(46, 15, '2024/May/19 Sunday', 'BCA', 'Four', 'present'),
(47, 12, '2024/May/21 Tuesday', 'BCA', 'Four', 'present'),
(48, 13, '2024/May/21 Tuesday', 'BCA', 'Four', 'absent'),
(49, 15, '2024/May/21 Tuesday', 'BCA', 'Four', 'absent');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_roll` int(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_email`, `student_roll`, `faculty`, `semester`) VALUES
(12, 'gokarna chaudhary', 'bca22061002_gokarna@achsnepal.edu.np', 22061002, 'BCA', 'Four'),
(13, 'Bishesh Limbu', 'bca22061024_bishesh@achsnepal.edu.np', 22061024, 'BCA', 'Four'),
(14, 'Damudar Pandey', 'bca22061048_sandesh@achsnepal.edu.np', 22061001, 'CSIT', 'Four'),
(15, 'Rohan Shrestha', 'bca22061003_nikesh@achsnepal.edu.np', 22061003, 'BCA', 'Four');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `teacher_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_name`, `teacher_email`, `teacher_password`) VALUES
(1, 'Bimal Kumar Chaudhary', 'bimal@gmail.com', 'bimal123'),
(3, 'Birendra Yadav', 'birendra@gmail.com', 'birendra123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
