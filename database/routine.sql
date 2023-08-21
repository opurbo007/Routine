-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 06:20 PM
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
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `day_name`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

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
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `routine_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `batch` varchar(50) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(17, 'EEE-7', 2),
(18, 'EEE-8', 2);

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
(129, 13, 2),
(130, 13, 3),
(131, 13, 12),
(132, 13, 20),
(133, 13, 21),
(134, 13, 30),
(135, 13, 31),
(136, 13, 36),
(137, 13, 37),
(138, 13, 38),
(139, 13, 39),
(140, 13, 40),
(141, 13, 42),
(142, 13, 43),
(143, 14, 2),
(144, 14, 3),
(145, 14, 10),
(146, 14, 11),
(147, 14, 17),
(148, 14, 18),
(149, 14, 25),
(150, 14, 26),
(151, 14, 30),
(152, 14, 31),
(153, 14, 34),
(154, 14, 35),
(155, 15, 2),
(156, 15, 3),
(157, 15, 10),
(158, 15, 11),
(159, 15, 38),
(160, 15, 39),
(161, 15, 56),
(162, 15, 57),
(163, 15, 58),
(164, 15, 59),
(165, 15, 61),
(166, 15, 67),
(168, 16, 2),
(169, 16, 3),
(170, 16, 6),
(171, 16, 8),
(172, 16, 10),
(173, 16, 11),
(174, 16, 12),
(175, 16, 22),
(176, 16, 29),
(177, 16, 32),
(178, 16, 34),
(179, 16, 35),
(180, 16, 54),
(181, 16, 55),
(182, 17, 2),
(183, 17, 3),
(184, 17, 13),
(185, 17, 20),
(186, 17, 21),
(187, 17, 34),
(188, 17, 35),
(189, 17, 41),
(190, 17, 42),
(191, 17, 43),
(192, 17, 49),
(193, 17, 62),
(194, 17, 63),
(195, 17, 64),
(196, 17, 65),
(200, 17, 66),
(201, 18, 12),
(202, 18, 13),
(203, 18, 15),
(204, 18, 19),
(205, 18, 22),
(206, 18, 29),
(207, 18, 34),
(208, 18, 35),
(209, 18, 38),
(210, 18, 39),
(211, 18, 50),
(212, 18, 60),
(213, 18, 62),
(214, 18, 63),
(215, 18, 64),
(216, 18, 65),
(220, 18, 66),
(221, 19, 4),
(222, 19, 5),
(223, 19, 20),
(224, 19, 21),
(225, 19, 41),
(226, 19, 46),
(227, 19, 47),
(228, 19, 48),
(229, 19, 50),
(230, 19, 58),
(231, 19, 59),
(232, 20, 4),
(233, 20, 5),
(234, 20, 20),
(235, 20, 21),
(236, 20, 36),
(237, 20, 37),
(238, 20, 44),
(239, 20, 45),
(240, 20, 50),
(241, 21, 4),
(242, 21, 5),
(243, 21, 6),
(244, 21, 8),
(245, 21, 9),
(246, 21, 12),
(247, 21, 15),
(248, 21, 16),
(249, 21, 24),
(250, 21, 30),
(251, 21, 31),
(252, 21, 33),
(253, 22, 4),
(254, 22, 5),
(255, 22, 13),
(256, 22, 17),
(257, 22, 18),
(258, 22, 19),
(259, 22, 25),
(260, 22, 26),
(261, 22, 27),
(262, 22, 28),
(263, 22, 29),
(264, 23, 6),
(265, 23, 8),
(266, 23, 15),
(267, 23, 22),
(268, 23, 30),
(269, 23, 31),
(270, 23, 32),
(271, 23, 33),
(272, 23, 40),
(273, 24, 2),
(274, 24, 3),
(275, 24, 6),
(276, 24, 10),
(277, 24, 11),
(278, 24, 13),
(279, 24, 40),
(280, 24, 41),
(281, 24, 54),
(282, 24, 55),
(283, 25, 6),
(284, 25, 13),
(285, 25, 15),
(286, 25, 19),
(287, 25, 40),
(288, 25, 41),
(289, 25, 50),
(290, 26, 4),
(291, 26, 5),
(292, 26, 14),
(293, 26, 15),
(294, 26, 16),
(295, 26, 41),
(296, 26, 66),
(297, 27, 9),
(298, 27, 16),
(299, 27, 33),
(300, 27, 41),
(301, 27, 44),
(302, 27, 45),
(303, 27, 50),
(304, 27, 52),
(305, 27, 53),
(306, 27, 54),
(307, 27, 55),
(308, 27, 61),
(309, 27, 67),
(311, 28, 7),
(312, 28, 23),
(313, 28, 32),
(314, 28, 33),
(315, 28, 48),
(316, 28, 51),
(317, 29, 8),
(318, 29, 10),
(319, 29, 11),
(320, 29, 15),
(321, 29, 32),
(322, 29, 41),
(323, 29, 54),
(324, 29, 55),
(325, 29, 62),
(326, 29, 63),
(327, 29, 64),
(328, 29, 65),
(332, 29, 66),
(333, 30, 7),
(334, 30, 8),
(335, 30, 14),
(336, 30, 23),
(337, 30, 27),
(338, 30, 28),
(339, 30, 32),
(340, 31, 9),
(341, 31, 40),
(342, 31, 42),
(343, 31, 43),
(344, 31, 49),
(345, 31, 50),
(346, 31, 56),
(347, 31, 57),
(348, 31, 60),
(349, 31, 62),
(350, 31, 63),
(351, 31, 64),
(352, 31, 65),
(356, 32, 9),
(357, 32, 16),
(358, 32, 41),
(359, 32, 50),
(360, 32, 54),
(361, 32, 55),
(362, 32, 60),
(363, 32, 62),
(364, 32, 63),
(365, 32, 64),
(366, 32, 65),
(370, 33, 9),
(371, 33, 16),
(372, 33, 24),
(373, 33, 58),
(374, 33, 59),
(375, 33, 62),
(376, 33, 63),
(377, 33, 64),
(378, 33, 65),
(382, 33, 66),
(383, 33, 61),
(384, 33, 67),
(386, 34, 9),
(387, 34, 16),
(388, 34, 24),
(389, 34, 34),
(390, 34, 35),
(391, 34, 58),
(392, 34, 59),
(393, 35, 10),
(394, 35, 11),
(395, 35, 27),
(396, 35, 28),
(397, 35, 48),
(398, 35, 49),
(399, 35, 51),
(400, 35, 52),
(401, 35, 53),
(402, 35, 56),
(403, 35, 57),
(404, 35, 58),
(405, 35, 59),
(406, 36, 17),
(407, 36, 18),
(408, 36, 22),
(409, 36, 23),
(410, 36, 25),
(411, 36, 26),
(412, 36, 29),
(413, 36, 30),
(414, 36, 34),
(415, 36, 35),
(416, 36, 51),
(417, 37, 17),
(418, 37, 18),
(419, 37, 37),
(420, 37, 42),
(421, 37, 43),
(422, 37, 44),
(423, 37, 45),
(424, 37, 46),
(425, 37, 47),
(426, 37, 48),
(427, 37, 49),
(428, 37, 61),
(429, 37, 67),
(431, 38, 19),
(432, 38, 23),
(433, 38, 25),
(434, 38, 26),
(435, 38, 33),
(436, 38, 34),
(437, 38, 35),
(438, 38, 36),
(439, 38, 44),
(440, 38, 45);

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
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `mobile`, `department_id`, `position`, `mail`, `picture`, `password`) VALUES
(13, 'Khandaker Mohammad Mohi Uddin', '019******', 1, 'Professor', 'opurbo***@gmail.com', 'uploads/jialni.jpg', '123'),
(14, 'Md. Tahzib Ul Islam', '017******', 1, 'Associate Professor', 'opurbo***1@gmail.com', 'uploads/thazib.jpg', '123'),
(15, 'Md. Habibullah Belali', '019***', 1, 'Assistant Professor', 'opurbo***2@gmail.com', 'uploads/bilali.jpg', '123'),
(16, 'Mahmudul Hasan', '013****', 1, 'Lecturer', 'opurbo***3@gmail.com', 'uploads/hasan.jpg', '123'),
(17, 'Md. Aminul Islam', '013*******', 1, 'Lecturer', 'opurbo***4@gmail.com', 'uploads/animul.jpg', '123'),
(18, 'Sahab Uddin Rana', '018******', 1, 'Lecturer', 'opurbo***5@gmail.com', 'uploads/rana.jpg', '123'),
(19, 'Md Rakib Hossain', '019*********', 1, 'Lecturer', 'opurbo***6@gmail.com', 'uploads/rakib.jpg', '123'),
(20, 'Syed Jamiul Alam', '017*********', 1, 'Lecturer', 'opurbo***7@gmail.com', 'uploads/jaimul.jpg', '123'),
(21, 'Md. Ashraful Islam', '017**********', 1, 'Assistant Professor', 'opurbo***8@gmail.com', 'uploads/ashraful.jpg', '123'),
(22, 'MD. ZAHIDUL ISLAM', '015*******', 1, 'Assistant Professor', 'opurbo***8@gmail.com', 'uploads/zahid.jpeg', '123'),
(23, 'Sraboni Barua', '018****', 1, 'Assistant Professor', 'opurbo***9@gmail.com', 'uploads/sraboni.jpg', '123'),
(24, 'Md. Humaun Kabir', '01', 1, 'Lecturer', 'opurbo***10@gmail.com', 'uploads/humaiun.jpg', '123'),
(25, 'Mohammad Asraful Hasnat', '02', 1, 'Lecturer', 'opurbo***12@gmail.com', 'uploads/dum.png', '123'),
(26, 'Md. Abir Mahmud', '013', 1, 'Lecturer', 'opurbo***13@gmail.com', 'uploads/dum.png', '123'),
(27, 'Md. Anisur Rahman Pramanik', '014****', 1, 'Associate Professor', 'opurbo***13@gmail.com', 'uploads/dum.png', '123'),
(28, 'Rashed Mahmud', '015*', 1, 'Lecturer', 'opurbo***14@gmail.com', 'uploads/dum.png', '123'),
(29, 'Sayma Sultana', '016*', 1, 'Lecturer', 'opurbo***15@gmail.com', 'uploads/sayma.jpeg', '123'),
(30, 'Sajia Akhter Airin', '0177', 1, 'Lecturer', 'opurbo***16@gmail.com', 'uploads/dum.png', '123'),
(31, 'Md. Tipu Sultan', '0121', 1, 'Lecturer', 'opurbo***17@gmail.com', 'uploads/dum.png', '123'),
(32, 'Hemonta Kumar Barman', '0155', 1, 'Lecturer', 'opurbo***18@gmail.com', 'uploads/dum.png', '123'),
(33, 'Md. Sifuzzaman', '001****', 1, 'Associate Professor', 'opurbo***18@gmail.com', 'uploads/jaman.jpg', '123'),
(34, 'Dr. A.T.M. Mahbubur Rahman Sarker', '018******7', 1, 'Professor', 'opurbo***19@gmail.com', 'uploads/dean.jpg', '123'),
(35, 'Md. Nur -a-Alam', '018******2', 1, 'Lecturer', 'opurbo***20@gmail.com', 'uploads/nur.jpg', '123'),
(36, 'Md. Rezaul Islam', '018******4', 1, 'Lecturer', 'opurbo***21@gmail.com', 'uploads/dum.png', '123'),
(37, 'Md. Abdul Based', '018******9', 1, 'Professor', 'opurbo***22@gmail.com', 'uploads/based.jpg', '123'),
(38, 'MD. SHARIFUL ISLAM', '018*****78', 1, 'Lecturer', 'opurbo***23@gmail.com', 'uploads/shariful.jpg', '123');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timetable_id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timetable_id`, `start_time`, `end_time`, `class_type`) VALUES
(1, '09:00:00', '10:15:00', 'theory'),
(2, '10:15:00', '11:30:00', 'theory'),
(3, '11:30:00', '12:45:00', 'theory'),
(4, '12:45:00', '02:00:00', 'theory'),
(5, '09:00:00', '10:40:00', 'lab'),
(6, '10:40:00', '12:20:00', 'lab'),
(7, '12:20:00', '02:00:00', 'lab');

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
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

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
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`routine_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `teacher_id` (`teacher_id`);

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
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
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
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teachercourses`
--
ALTER TABLE `teachercourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Constraints for table `routine`
--
ALTER TABLE `routine`
  ADD CONSTRAINT `routine_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `routine_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `routine_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

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
