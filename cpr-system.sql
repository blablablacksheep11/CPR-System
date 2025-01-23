-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 11:25 AM
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
-- Database: `cpr-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_administrator`
--

CREATE TABLE `academic_administrator` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `department` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_administrator`
--

INSERT INTO `academic_administrator` (`id`, `name`, `email`, `password`, `department`) VALUES
(1, 'SITI RUZAINA BINTI ABDUL GAFFOR', 'ruzaina@segi.edu.my', 'ruzaina@segi.edu.my', 'EBIT');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL DEFAULT 'UNDEFINED',
  `name` varchar(255) NOT NULL,
  `department` varchar(30) NOT NULL,
  `programme` varchar(30) NOT NULL,
  `credit_hour` int(11) NOT NULL DEFAULT 3,
  `level` varchar(30) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `code`, `name`, `department`, `programme`, `credit_hour`, `level`, `year`) VALUES
(1, 'DMS4024', 'BIG DATA TECHNOLOGY', 'EBIT', 'DIIT', 3, 'Diploma', 2),
(2, 'PRG4033', 'INTRODUCTION TO INTERNET PROGRAMMING', 'EBIT', 'DIIT', 3, 'Diploma', 2),
(3, 'PRG4064', 'INTRODUCTION TO PYTHON PROGRAMMING', 'EBIT', 'DIIT', 3, 'Diploma', 2),
(4, 'SDD4063', 'USER EXPERIENCE(UX) DESIGN', 'EBIT', 'DIIT', 3, 'Diploma', 2),
(5, 'ITN4023', 'APPLIED DIGITAL SKILLS', 'EBIT', 'DIIT', 3, 'Diploma', 1),
(6, 'COM4013', 'COMPUTER ORGANIZATION', 'EBIT', 'DIIT', 3, 'Diploma', 1),
(7, 'DCN4013', 'DATA COMMUNICATION AND NETWORKING', 'EBIT', 'DIIT', 3, 'Diploma', 1),
(8, 'DMS4013', 'DATABASE MANAGEMENT SYSTEM', 'EBIT', 'DIIT', 3, 'Diploma', 1),
(9, 'IOS4013', 'INTRODUCTION TO OPERATING SYSTEM', 'EBIT', 'DIIT', 3, 'Diploma', 1),
(10, 'PRG4013', 'PROGRAMMING METHODOLOGY', 'EBIT', 'DIIT', 3, 'Diploma', 1),
(11, 'AWS4023', 'ACADEMIC ENGLISH', 'GEN', '----', 3, 'Diploma', 1),
(12, 'MPU2183', 'PENGHAYATAN ETIKA DAN PERADABAN', 'GOV', '----', 3, 'Diploma', 0),
(13, 'MPU2243', 'GROWTH MINDSET', 'GOV', '----', 3, 'Diploma', 0),
(14, 'MPU2353', 'INDUSTRIAL REVOLUTION 4.0 IN MALAYSIA', 'GOV', '----', 3, 'Diploma', 0),
(15, 'MPU2432', 'CO-CURRICULUM: SUSTAINABILITY THINKING & CO-CURRICULUM MANAGEMENT', 'GOV', '----', 3, 'Diploma', 0),
(16, 'UNDEFINED', 'UNDERSTANDING THE CHILD\'S GROWTH & DEVELOPMENT', 'ECE', 'DIECE', 3, 'Diploma', 1),
(17, 'UNDEFINED', 'PLAY & LEARNING FOR YOUNG CHILDREN', 'ECE', 'DIECE', 3, 'Diploma', 1),
(18, 'UNDEFINED', 'PHYSICAL EDUCATION & HEALTH CARE FOR YOUNG CHILDREN', 'ECE', 'DIECE', 3, 'Diploma', 1),
(19, 'UNDEFINED', 'SAFETY & WELL-BEING FOR YOUNG CHILDREN', 'ECE', 'DIECE', 3, 'Diploma', 1),
(20, 'UNDEFINED', 'MATHEAMATICS FOR YOUNG CHILDREN', 'ECE', 'DIECE', 3, 'Diploma', 1),
(21, 'UNDEFINED', 'PRINCIPLES OF MANAGEMENT', 'HAT', 'DIHM', 3, 'Diploma', 1),
(22, 'UNDEFINED', 'FOOD NUTRITION, HYGIENE AND SANITATION', 'HAT', 'DIHM', 3, 'Diploma', 1),
(23, 'UNDEFINED', 'HOUSEKEEPING MANAGEMENT', 'HAT', 'DIHM', 3, 'Diploma', 1),
(24, 'UNDEFINED', 'HOTEL TECHNOPRENEURSHIP', 'HAT', 'DIHM', 3, 'Diploma', 1),
(25, 'UNDEFINED', 'INTRODUCTORY TO FRENCH', 'HAT', 'DIHM', 3, 'Diploma', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL DEFAULT 'DEF.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`id`, `code`, `name`, `department`, `image`) VALUES
(1, 'PRG', 'Programming', 'EBIT', 'PRG.jpg'),
(2, 'DMS', 'Database Management System', 'EBIT', 'DMS.jpg'),
(3, 'DCN', 'Data Communication and Networking', 'EBIT', 'DCN.jpg'),
(4, 'SDD', 'System Development Design', 'EBIT', 'SDD.jpg'),
(5, 'ITN', 'Information Technology and Networking', 'EBIT', 'ITN.jpg'),
(6, 'COM', 'Computer', 'EBIT', 'COM.jpg'),
(7, 'IOS', 'Introduction to Operating System', 'EBIT', 'IOS.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `course_offer`
--

CREATE TABLE `course_offer` (
  `id` int(11) NOT NULL,
  `course_code` varchar(15) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_offer`
--

INSERT INTO `course_offer` (`id`, `course_code`, `semester`) VALUES
(2, 'DMS4024', 1),
(3, 'ITN4023', 1),
(4, 'COM4013', 1),
(6, 'DCN4013', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `name`) VALUES
(1, 'EBIT', 'Engineering, Built Environment and Information Technology'),
(2, 'HAT', 'Hospitality and Tourism'),
(3, 'GEN', 'General'),
(4, 'GOV', 'Governance'),
(5, 'ECE', 'Early Childhood Education');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `position` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`id`, `name`, `gender`, `email`, `password`, `department`, `position`, `type`) VALUES
(1, 'ANIS NAZHIRAH BINTI MOHD ZAHARI', 'female', 'anisnazhirah@segi.edu.my', 'anisnazhirah@segi.edu.my', 'EBIT', 'lecturer', 'FT'),
(2, 'AQILAH SYAHIRAH BINTI SHAHABUDIN', 'female', 'aqilahsyahirah@segi.edu.my', 'aqilahsyahirah@segi.edu.my', 'EBIT', 'lecturer', 'FT'),
(3, 'MOHD AMIZAR BIN ABDUL MAJID', 'male', 'amizarabdulmajid@segi4u.my', 'amizarabdulmajid@segi4u.my', 'EBIT', 'lecturer', 'FT'),
(4, 'ROSMAH ISMAIL', 'female', 'rosmahismail@segi.edu.my', 'rosmahismail@segi.edu.my', 'EBIT', 'senior lecturer', 'PT');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(30) NOT NULL,
  `level` varchar(30) DEFAULT NULL,
  `program_leader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`id`, `code`, `name`, `department`, `level`, `program_leader`) VALUES
(1, 'DIIT', 'Diploma in Information Technology', 'EBIT', 'Diploma', 1),
(2, 'DIHM', 'Diploma in Hotel Management', 'HAT', 'Diploma', 0),
(3, 'DITM', 'Diploma in Tourism Management', 'HAT', 'Diploma', 0),
(4, 'DIEE', 'Diploma in Electrical and Electronics Engineering', 'EBIT', 'Diploma', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program_leader`
--

CREATE TABLE `program_leader` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_leader`
--

INSERT INTO `program_leader` (`id`, `name`, `email`, `password`, `department`) VALUES
(1, 'Kong Kok Wah', 'kongkokwah@segi.edu.my', 'kongkokwah@segi.edu.my', 'EBIT');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `detail` varchar(30) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `detail`, `start`, `end`) VALUES
(1, '2025-S1', '2025-01-13', '2025-05-04'),
(2, '2025-S2', '2025-05-19', '2025-08-24'),
(3, '2025-S3', '2025-09-08', '2025-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `programme` varchar(255) NOT NULL,
  `intake` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `name`, `gender`, `email`, `birthday`, `password`, `department`, `programme`, `intake`) VALUES
(1, 'SCPG2300128', 'LAM YONG QIN', 'male', 'scpg2300128@segi4u.my', '2005-01-11', 'scpg2300128@segi4u.my', 'EBIT', 'DIIT', 202306),
(2, 'SCPG2300080', 'LEE KAI MIN', 'male', 'scpg2300080@segi4u.my', '2004-11-17', 'scpg2300080@segi4u.my', 'EBIT', 'DIIT', 202309),
(3, 'SCPG2300152', 'CALVIN NG WEI KEONG', 'male', 'scpg2300152@segi4u.my', '2002-08-29', 'scpg2300152@segi4u.my', 'EBIT', 'DIIT', 202309),
(4, 'SCPG2300153', 'CHEONG KAI QI', 'female', 'scpg2300153@segi4u.my', '2005-10-05', 'scpg2300153@segi4u.my', 'EBIT', 'DIIT', 202309),
(5, 'SCPG2300129', 'KIVEN RAJ A/L SARAVANAN', 'male', 'scpg2300129@segi4u.my', '2005-02-18', 'scpg2300129@segi4u.my', 'EBIT', 'DIIT', 202306),
(6, 'SCPG2300042', 'LIM KAH WAI', 'male', 'scpg2300042@segi4u.my', '2002-06-28', 'scpg2300042@segi4u.my', 'HAT', 'DIHM', 202306),
(7, 'SCPG2300064', 'PUSITA SAECHEN', 'female', 'scpg2300064@segi4u.my', '2004-08-31', 'scpg2300064@segi4u.my', 'HAT', 'DITM', 202306),
(8, 'SCPG2300150', 'LEE CHI QI', 'female', 'scpg2300150@segi4u.my', '2005-08-09', 'scpg2300150@segi4u.my', 'EBIT', 'DIIT', 202309),
(9, 'SCPG2300157', 'MOHAMMAD ZAINI BIN HARUN IBURAHIM', 'male', 'scpg2300157@segi4u.my', '2003-09-22', 'scpg2300157@segi4u.my', 'EBIT', 'DIIT', 202309),
(10, 'SCPG2300056', 'AHMAD FARIS BIN MOHAMED ASRI', 'male', 'scpg2300056@segi4u.my', '2004-01-23', 'scpg2300056@segi4u.my', 'EBIT', 'DIIT', 202306);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_administrator`
--
ALTER TABLE `academic_administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_offer`
--
ALTER TABLE `course_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_leader`
--
ALTER TABLE `program_leader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_administrator`
--
ALTER TABLE `academic_administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_offer`
--
ALTER TABLE `course_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program_leader`
--
ALTER TABLE `program_leader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
