-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 07:17 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `token`, `expiry`) VALUES
(1, 'opurbopaul3@gmail.com', '$2y$10$QYtarXEsWGCKNbO6xnb76.SK1SZnmgQLg0LgZMROGlgnq8bSUfr7i', NULL, NULL);

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
(9, 'E-52', 1, 'day');

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
(67, 'Capstone Project Design', 8, 'theory', 3, '0688-400', 1),
(75, 'ghhhvvvv', 9, 'theory', 22, '1651641', 2),
(77, ' zcthshadvnfbhbdshfbfb555', 14, 'theory', 0.8, '028885455', 4);

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
(19, '506', 'theory'),
(20, '508', 'theory'),
(21, '509', 'theory'),
(27, 'Lab-1', 'lab'),
(28, 'Lab-2', 'lab'),
(29, 'Lab-3', 'lab'),
(30, 'Lab-4', 'lab'),
(31, 'Lab-5', 'lab');

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
  `end_time` time DEFAULT NULL,
  `session` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`routine_id`, `course_id`, `day`, `start_time`, `room_id`, `teacher_id`, `batch`, `semester`, `end_time`, `session`) VALUES
(236, 2, 'Saturday', '11:31:00', 16, 17, '1', '1', '12:45:00', 'Fall'),
(237, 2, 'Tuesday', '09:00:00', 16, 17, '1', '1', '10:15:00', 'Fall'),
(238, 3, 'Wednesday', '12:21:00', 29, 17, '1', '1', '14:00:00', 'Fall'),
(239, 4, 'Saturday', '09:00:00', 16, 19, '1', '1', '10:15:00', 'Fall'),
(240, 4, 'Tuesday', '11:31:00', 16, 19, '1', '1', '12:45:00', 'Fall'),
(241, 5, 'Wednesday', '09:00:00', 29, 19, '1', '1', '10:40:00', 'Fall'),
(242, 6, 'Tuesday', '12:46:00', 16, 23, '1', '1', '14:00:00', 'Fall'),
(243, 6, 'Thursday', '10:16:00', 16, 23, '1', '1', '11:30:00', 'Fall'),
(244, 7, 'Thursday', '11:31:00', 16, 30, '1', '1', '12:45:00', 'Fall'),
(245, 8, 'Wednesday', '10:41:00', 29, 29, '1', '1', '12:20:00', 'Fall'),
(246, 9, 'Saturday', '10:16:00', 16, 32, '1', '1', '11:30:00', 'Fall'),
(247, 9, 'Tuesday', '10:16:00', 16, 32, '1', '1', '11:30:00', 'Fall'),
(249, 2, 'Saturday', '14:00:00', 16, 17, '1', '1', '23:00:00', 'Fall');

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
(311, 28, 7),
(312, 28, 23),
(313, 28, 32),
(314, 28, 33),
(315, 28, 48),
(316, 28, 51),
(499, 34, 9),
(500, 34, 16),
(501, 34, 24),
(502, 34, 34),
(503, 34, 35),
(504, 34, 58),
(505, 34, 59),
(506, 13, 2),
(507, 13, 3),
(508, 13, 12),
(509, 13, 20),
(510, 13, 21),
(511, 13, 30),
(512, 13, 31),
(513, 13, 36),
(514, 13, 37),
(515, 13, 38),
(516, 13, 39),
(517, 13, 40),
(518, 13, 42),
(519, 13, 43),
(520, 37, 17),
(521, 37, 18),
(522, 37, 37),
(523, 37, 42),
(524, 37, 43),
(525, 37, 44),
(526, 37, 45),
(527, 37, 46),
(528, 37, 47),
(529, 37, 48),
(530, 37, 49),
(531, 37, 61),
(532, 37, 67),
(534, 37, 61),
(535, 37, 67),
(537, 14, 2),
(538, 14, 3),
(539, 14, 10),
(540, 14, 11),
(541, 14, 17),
(542, 14, 18),
(543, 14, 25),
(544, 14, 26),
(545, 14, 30),
(546, 14, 31),
(547, 14, 34),
(548, 14, 35),
(583, 33, 9),
(584, 33, 16),
(585, 33, 24),
(586, 33, 58),
(587, 33, 59),
(588, 33, 61),
(589, 33, 67),
(591, 33, 62),
(592, 33, 63),
(593, 33, 64),
(594, 33, 65),
(598, 33, 62),
(599, 33, 63),
(600, 33, 64),
(601, 33, 65),
(605, 33, 62),
(606, 33, 63),
(607, 33, 64),
(608, 33, 65),
(612, 33, 62),
(613, 33, 63),
(614, 33, 64),
(615, 33, 65),
(619, 33, 66),
(620, 33, 61),
(621, 33, 67),
(623, 15, 2),
(624, 15, 3),
(625, 15, 10),
(626, 15, 11),
(627, 15, 38),
(628, 15, 39),
(629, 15, 56),
(630, 15, 57),
(631, 15, 58),
(632, 15, 59),
(633, 15, 61),
(634, 15, 67),
(636, 15, 61),
(637, 15, 67),
(639, 21, 4),
(640, 21, 5),
(641, 21, 6),
(642, 21, 8),
(643, 21, 9),
(644, 21, 12),
(645, 21, 15),
(646, 21, 16),
(647, 21, 24),
(648, 21, 30),
(649, 21, 31),
(650, 21, 33),
(651, 22, 4),
(652, 22, 5),
(653, 22, 13),
(654, 22, 17),
(655, 22, 18),
(656, 22, 19),
(657, 22, 25),
(658, 22, 26),
(659, 22, 27),
(660, 22, 28),
(661, 22, 29),
(662, 23, 6),
(663, 23, 8),
(664, 23, 15),
(665, 23, 22),
(666, 23, 30),
(667, 23, 31),
(668, 23, 32),
(669, 23, 33),
(670, 23, 40),
(671, 16, 2),
(672, 16, 3),
(673, 16, 6),
(674, 16, 8),
(675, 16, 10),
(676, 16, 11),
(677, 16, 12),
(678, 16, 22),
(679, 16, 29),
(680, 16, 32),
(681, 16, 34),
(682, 16, 35),
(683, 16, 54),
(684, 16, 55),
(685, 29, 8),
(686, 29, 10),
(687, 29, 11),
(688, 29, 15),
(689, 29, 32),
(690, 29, 41),
(691, 29, 54),
(692, 29, 55),
(693, 29, 62),
(694, 29, 63),
(695, 29, 64),
(696, 29, 65),
(700, 29, 62),
(701, 29, 63),
(702, 29, 64),
(703, 29, 65),
(707, 29, 62),
(708, 29, 63),
(709, 29, 64),
(710, 29, 65),
(714, 29, 62),
(715, 29, 63),
(716, 29, 64),
(717, 29, 65),
(721, 29, 66),
(722, 30, 7),
(723, 30, 8),
(724, 30, 14),
(725, 30, 23),
(726, 30, 27),
(727, 30, 28),
(728, 30, 32),
(729, 31, 9),
(730, 31, 40),
(731, 31, 42),
(732, 31, 43),
(733, 31, 49),
(734, 31, 50),
(735, 31, 56),
(736, 31, 57),
(737, 31, 60),
(738, 31, 62),
(739, 31, 63),
(740, 31, 64),
(741, 31, 65),
(745, 31, 62),
(746, 31, 63),
(747, 31, 64),
(748, 31, 65),
(752, 31, 62),
(753, 31, 63),
(754, 31, 64),
(755, 31, 65),
(759, 31, 62),
(760, 31, 63),
(761, 31, 64),
(762, 31, 65),
(779, 32, 9),
(780, 32, 16),
(781, 32, 41),
(782, 32, 50),
(783, 32, 54),
(784, 32, 55),
(785, 32, 60),
(786, 32, 62),
(787, 32, 63),
(788, 32, 64),
(789, 32, 65),
(793, 32, 62),
(794, 32, 63),
(795, 32, 64),
(796, 32, 65),
(800, 32, 62),
(801, 32, 63),
(802, 32, 64),
(803, 32, 65),
(807, 32, 62),
(808, 32, 63),
(809, 32, 64),
(810, 32, 65),
(814, 36, 17),
(815, 36, 18),
(816, 36, 22),
(817, 36, 23),
(818, 36, 25),
(819, 36, 26),
(820, 36, 29),
(821, 36, 30),
(822, 36, 34),
(823, 36, 35),
(824, 36, 51),
(825, 38, 19),
(826, 38, 23),
(827, 38, 25),
(828, 38, 26),
(829, 38, 33),
(830, 38, 34),
(831, 38, 35),
(832, 38, 36),
(833, 38, 44),
(834, 38, 45),
(835, 27, 10),
(836, 27, 11),
(837, 27, 27),
(838, 27, 28),
(839, 27, 48),
(840, 27, 49),
(841, 27, 50),
(842, 27, 52),
(843, 27, 53),
(844, 27, 56),
(845, 27, 57),
(846, 27, 61),
(847, 27, 67),
(849, 27, 61),
(850, 27, 67),
(852, 35, 9),
(853, 35, 16),
(854, 35, 33),
(855, 35, 41),
(856, 35, 44),
(857, 35, 45),
(858, 35, 50),
(859, 35, 52),
(860, 35, 53),
(861, 35, 61),
(862, 35, 67);

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
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `mobile`, `department_id`, `position`, `mail`, `picture`, `password`, `token`, `expiry`) VALUES
(13, 'Khandaker Mohammad Mohi Uddin', '018212345**', 1, 'Professor', 'user2@gmail.com', 'uploads/jialni.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(14, 'Md. Tahzib Ul Islam', '015512345**', 1, 'Associate Professor', 'user4@gmail.com', 'uploads/thazib.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(15, 'Md. Habibullah Belali', '013712345**', 1, 'Assistant Professor', 'user7@gmail.com', 'uploads/bilali.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(16, 'Mahmudul Hasan', '014812345**', 1, 'Lecturer', 'user11@gmail.com', 'uploads/hasan.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(17, 'Md. Aminul Islam', '011912345**', 1, 'Lecturer', 'user12@gmail.com', 'uploads/animul.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(18, 'Sahab Uddin Rana', '012012345**', 1, 'Lecturer', 'user13@gmail.com', 'uploads/rana.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(19, 'Md Rakib Hossain', '010112345**', 1, 'Lecturer', 'user14@gmail.com', 'uploads/rakib.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(20, 'Syed Jamiul Alam', '017212345**', 1, 'Lecturer', 'user15@gmail.com', 'uploads/jaimul.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(21, 'Md. Ashraful Islam', '018312345**', 1, 'Assistant Professor', 'user8@gmail.com', 'uploads/ashraful.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(22, 'MD. ZAHIDUL ISLAM', '019412345**', 1, 'Assistant Professor', 'user9@gmail.com', 'uploads/zahid.jpeg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(23, 'Sraboni Barua', '015612345**', 1, 'Assistant Professor', 'user10@gmail.com', 'uploads/sraboni.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(24, 'Md. Humaun Kabir', '016712345**', 1, 'Lecturer', 'user15@gmail.com', 'uploads/humaiun.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(25, 'Mohammad Asraful Hasnat', '013812345**', 1, 'Lecturer', 'user16@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(26, 'Md. Abir Mahmud', '014912345**', 1, 'Lecturer', 'user17@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(27, 'Md. Nur -a-Alam', '016612345**', 1, 'Assistant Professor', 'user5@gmail.com', 'uploads/nur.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(28, 'Rashed Mahmud', '011112345**', 1, 'Lecturer', 'user18@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(29, 'Sayma Sultana', '019512345**', 1, 'Lecturer', 'user20@gmail.com', 'uploads/sayma.jpeg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(30, 'Sajia Akhter Airin', '017312345**', 1, 'Lecturer', 'user21@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(31, 'Md. Tipu Sultan', '014912345**', 1, 'Lecturer', 'user22@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(32, 'Hemonta Kumar Barman', '019412394**', 1, 'Lecturer', 'user23@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(33, 'Md. Sifuzzaman', '010312345**', 1, 'Associate Professor', 'user6@gmail.com', 'uploads/jaman.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(34, 'Dr. A.T.M. Mahbubur Rahman Sarker', '017112345**', 1, 'Dean', 'user1@gmail.com', 'uploads/dean.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(35, 'Md. Anisur Rahman Pramanik', '019412345**', 1, 'Associate Professor', 'user19@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(36, 'Md. Rezaul Islam', '019912345**', 1, 'Lecturer', 'user25@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(37, 'Md. Abdul Based', '019312345**', 1, 'Professor', 'user3@gmail.com', 'uploads/based.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(38, 'MD. SHARIFUL ISLAM', '014812345**', 1, 'Lecturer', 'user26@gmail.com', 'uploads/shariful.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL);

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
(2, '10:16:00', '11:30:00', 'theory'),
(3, '11:31:00', '12:45:00', 'theory'),
(4, '12:46:00', '14:00:00', 'theory'),
(5, '09:00:00', '10:40:00', 'lab'),
(6, '10:41:00', '12:20:00', 'lab'),
(7, '12:21:00', '14:00:00', 'lab'),
(43, '14:00:00', '23:00:00', 'theory');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email` (`email`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teachercourses`
--
ALTER TABLE `teachercourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=864;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
