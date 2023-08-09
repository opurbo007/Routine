-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 01:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `routine`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `batch_number` varchar(10) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch_shift` enum('day','evening') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `batch_number`, `department_id`, `batch_shift`) VALUES
(1, 'D-50', 1, 'day'),
(2, 'D-51', 1, 'day'),
(3, 'D-52', 1, 'day'),
(4, 'D-54', 1, 'day'),
(5, 'D-55', 1, 'day'),
(6, 'D-56', 1, 'day'),
(7, 'E-50', 1, 'evening'),
(8, 'E-51', 1, 'evening'),
(9, 'E-52', 1, 'evening');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `course_type` varchar(10) NOT NULL,
  `credits` float NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `semester_id`, `course_type`, `credits`, `course_code`, `department_id`) VALUES
(2, 'Structured Programming Languages', 1, 'theory', 3, '0613-101', 1),
(3, 'Structured Programming Languages Lab', 1, 'lab', 1, '0613-102', 1),
(4, 'Physics', 1, 'theory', 3, '0533-101', 1),
(5, 'Physics Lab', 1, 'lab', 1, '0533-102', 1),
(6, 'Engineering Economics', 1, 'theory', 3, '0311-101', 1),
(7, 'Communicative English', 1, 'theory', 3, '0231-101', 1),
(8, 'Engineering Drawing Lab', 1, 'lab', 1, '0211-102', 1),
(9, 'Linear Algebra and Coordinate Geometry', 1, 'theory', 3, '0541-101', 1),
(10, 'Data Structures', 2, 'theory', 3, '0613-103', 1),
(11, 'Data Structures Lab', 2, 'lab', 1, '0613-104', 1),
(12, 'Discrete Mathematics', 2, 'theory', 3, '0613-105', 1),
(13, 'Electrical Circuits', 2, 'theory', 3, '0713-101', 1),
(14, 'Bangladesh Studies', 2, 'theory', 3, '0222-101', 1),
(15, 'Financial and Managerial Accounting', 2, 'theory', 3, '0413-102', 1),
(16, 'Differential and Integral Calculus', 2, 'theory', 3, '0541-102', 1),
(17, 'Object-Oriented Programming Languages', 3, 'theory', 3, '0613-201', 1),
(18, 'Object-Oriented Programming Languages Lab', 3, 'lab', 1, '0613-202', 1),
(19, 'Computer Architecture', 3, 'theory', 3, '0613-203', 1),
(20, 'Electronic Devices and Circuit', 3, 'theory', 3, '0713-201', 1),
(21, 'Electronic Devices and Circuit Lab', 3, 'lab', 1, '0713-202', 1),
(22, 'Chemistry', 3, 'theory', 3, '0531-201', 1),
(23, 'Professional Ethics and Environmental Protection', 3, 'theory', 3, '0223-201', 1),
(24, 'Differential Equations and Vector Analysis', 3, 'theory', 3, '0541-201', 1),
(25, 'Algorithms', 4, 'theory', 3, '0613-205', 1),
(26, 'Algorithms Lab', 4, 'lab', 1, '0613-206', 1),
(27, 'Microprocessor and Assembly Language', 4, 'theory', 3, '0613-207', 1),
(28, 'Microprocessor and Assembly Language Lab', 4, 'lab', 1, '0613-208', 1),
(29, 'Compiler Design', 4, 'theory', 3, '0613-209', 1),
(30, 'Digital Logic Design', 4, 'theory', 3, '0713-203', 1),
(31, 'Digital Logic Design Lab', 4, 'lab', 1, '0713-204', 1),
(32, 'Business Strategy Management', 4, 'theory', 1.5, '0413-202', 1),
(33, 'Statistical Methods and Probability', 4, 'theory', 3, '0542-202', 1),
(34, 'Operating System', 5, 'theory', 3, '0613-301', 1),
(35, 'Operating System Lab', 5, 'lab', 1, '0613-302', 1),
(36, 'Data Communication', 5, 'theory', 3, '0612-302', 1),
(37, 'Software Engineering', 5, 'theory', 1.5, '0613-303', 1),
(38, 'Database Management System', 5, 'theory', 3, '0612-303', 1),
(39, 'Database Management Systems Lab', 5, 'lab', 1, '0612-304', 1),
(40, 'Information System Management', 5, 'theory', 1.5, '0612-301', 1),
(41, 'Complex Variables and Transforms', 5, 'theory', 3, '0541-301', 1),
(42, 'Computer Networking', 6, 'theory', 3, '0612-305', 1),
(43, 'Computer Networking Lab', 6, 'lab', 1, '0612-306', 1),
(44, 'Markup and Scripting Languages', 6, 'theory', 3, '0613-305', 1),
(45, 'Markup and Scripting Languages Lab', 6, 'lab', 1, '0613-306', 1),
(46, '	Software Development Management', 6, 'theory', 1.5, '0613-307', 1),
(47, 'Software Development Management Lab', 6, 'lab', 0.5, '0613-308', 1),
(48, 'Computer and Cyber security', 6, 'theory', 3, '0613-309', 1),
(49, 'System Configuration and Performance Evaluation Lab', 6, 'lab', 1, '0613-310', 1),
(50, 'Technical Writing and Presentation', 6, 'theory', 1, '0232-302', 1),
(51, 'Numerical Analysis', 6, 'theory', 1.5, '0541-302', 1),
(52, 'Artificial Intelligence', 7, 'theory', 3, '0613-401', 1),
(53, 'Artificial Intelligence Lab', 7, 'lab', 1, '0613-402', 1),
(54, 'Computer Graphics and Multimedia', 7, 'theory', 3, '0613-403', 1),
(55, 'Computer Graphics and Multimedia Lab', 7, 'lab', 1, '0613-404', 1),
(56, 'Software Testing and Quality Assurance', 7, 'theory', 1.5, '0613-405', 1),
(57, 'Software Testing and Quality Assurance Lab', 7, 'lab', 0.5, '0613-406', 1),
(58, 'Mobile Application and Development', 7, 'theory', 3, '0613-409', 1),
(59, 'Mobile Application and Development Lab', 7, 'lab', 1, '0613-410', 1),
(60, 'Software Integration and Maintenance', 7, 'theory', 3, '0613-412', 1),
(61, 'Capstone Project Design', 7, 'theory', 3, '0688-400', 1),
(62, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(63, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(64, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(65, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(66, 'Entrepreneurship: Innovation and Commercialization', 8, 'theory', 3, '0413-401', 1),
(67, 'Capstone Project Design', 8, 'theory', 3, '0688-400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'CSE'),
(2, 'EEE'),
(3, 'Law'),
(4, 'Pharmacy'),
(5, 'Civil Engg'),
(6, 'Sociology'),
(7, 'Political Science'),
(8, 'Economic'),
(9, 'Business'),
(10, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `room_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_number`, `room_type`) VALUES
(14, '507', 'theory'),
(15, '502', 'theory'),
(16, '503', 'theory'),
(17, '504', 'theory'),
(18, '505', 'theory'),
(19, '506', 'lab'),
(20, '508', 'theory'),
(21, '509', 'lab');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`, `department_id`) VALUES
(1, 'CSE-1', 1),
(2, 'CSE-2', 1),
(3, 'CSE-3', 1),
(4, 'CSE-4', 1),
(5, 'CSE-5', 1),
(6, 'CSE-6', 1),
(7, 'CSE-7', 1),
(8, 'CSE-8', 1),
(9, 'EEE-1', 2),
(10, 'EEE-2', 2),
(11, 'EEE-3', 2),
(12, 'EEE-4', 2),
(13, 'EEE-5', 2),
(14, 'EEE-6', 2),
(15, 'EEE-7', 2),
(16, 'EEE-8', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachercourses`
--

CREATE TABLE `teachercourses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachercourses`
--

INSERT INTO `teachercourses` (`id`, `teacher_id`, `course_id`) VALUES
(1, 3, 2),
(2, 3, 3),
(3, 3, 17),
(4, 3, 18),
(5, 3, 34),
(6, 3, 35),
(7, 3, 44),
(8, 3, 45),
(9, 3, 56),
(10, 3, 57),
(11, 4, 2),
(12, 4, 3),
(13, 4, 23),
(14, 4, 24),
(15, 4, 25),
(16, 4, 26),
(17, 5, 2),
(18, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `mobile`, `department_id`, `position`, `mail`, `picture`) VALUES
(2, 'Opurbo', '01900000000', 1, 'Professor', 'opurbo***@gmail.com', NULL),
(3, 'Opurbo', '01900000000', 1, 'Professor', 'opurbo***@gmail.com', NULL),
(4, 'Opurbo', '01900000000', 1, 'Professor', 'opurbo***@gmail.com', 'uploads/drop.png'),
(5, 'Opurbo', '01900000000', 1, 'Professor', 'opurbo***@gmail.com', 'uploads/drop.png');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` varchar(20) NOT NULL,
  `class_type` enum('theory','lab') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `start_time`, `end_time`, `day`, `class_type`) VALUES
(1, '09:00:00', '10:15:00', 'Saturday', 'theory'),
(2, '10:15:00', '11:30:00', 'Saturday', 'theory'),
(3, '11:30:00', '12:45:00', 'Saturday', 'theory'),
(4, '12:45:00', '02:00:00', 'Saturday', 'theory'),
(5, '09:00:00', '10:15:00', 'Sunday', 'theory'),
(6, '10:15:00', '11:30:00', 'Sunday', 'theory'),
(7, '11:30:00', '12:45:00', 'Sunday', 'theory'),
(8, '12:45:00', '02:00:00', 'Sunday', 'theory'),
(9, '09:00:00', '10:15:00', 'Tuesday', 'theory'),
(10, '10:15:00', '11:30:00', 'Tuesday', 'theory'),
(11, '11:30:00', '12:45:00', 'Tuesday', 'theory'),
(12, '12:45:00', '02:00:00', 'Tuesday', 'theory'),
(13, '09:00:00', '10:15:00', 'Wednesday', 'theory'),
(14, '10:15:00', '11:30:00', 'Wednesday', 'theory'),
(15, '11:30:00', '12:45:00', 'Wednesday', 'theory'),
(16, '12:45:00', '02:00:00', 'Wednesday', 'theory'),
(17, '09:00:00', '10:15:00', 'Thursday', 'theory'),
(18, '10:15:00', '11:30:00', 'Thursday', 'theory'),
(19, '11:30:00', '12:45:00', 'Thursday', 'theory'),
(20, '12:45:00', '02:00:00', 'Thursday', 'theory'),
(21, '09:00:00', '10:40:00', 'Saturday', 'lab'),
(22, '10:40:00', '12:20:00', 'Saturday', 'lab'),
(23, '12:20:00', '02:00:00', 'Saturday', 'lab'),
(24, '09:00:00', '10:40:00', 'Thursday', 'lab'),
(25, '10:40:00', '12:20:00', 'Thursday', 'lab'),
(26, '12:20:00', '02:00:00', 'Thursday', 'lab'),
(28, '09:00:00', '10:40:00', 'Sunday', 'lab'),
(29, '10:40:00', '12:20:00', 'Sunday', 'lab'),
(30, '12:20:00', '02:00:00', 'Sunday', 'lab'),
(34, '09:00:00', '10:40:00', 'Wednesday', 'lab'),
(35, '10:40:00', '12:20:00', 'Wednesday', 'lab'),
(36, '12:20:00', '02:00:00', 'Wednesday', 'lab'),
(37, '09:00:00', '10:40:00', 'Tuesday', 'lab'),
(38, '10:40:00', '12:20:00', 'Tuesday', 'lab'),
(39, '12:20:00', '02:00:00', 'Tuesday', 'lab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `teachercourses`
--
ALTER TABLE `teachercourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teachercourses`
--
ALTER TABLE `teachercourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `teachercourses`
--
ALTER TABLE `teachercourses`
  ADD CONSTRAINT `teachercourses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `teachercourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
