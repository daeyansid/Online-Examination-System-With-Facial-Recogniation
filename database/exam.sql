-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2021 at 07:35 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `s_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `cnic` varchar(30) NOT NULL,
  `phone` int(15) NOT NULL,
  `sec_phone` int(15) NOT NULL COMMENT 'Secondary number',
  `father_name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `p_address` varchar(255) NOT NULL COMMENT 'Permeant Address',
  `user_image` varchar(255) NOT NULL DEFAULT '0',
  `online_status` varchar(7) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`s_no`, `name`, `email`, `cnic`, `phone`, `sec_phone`, `father_name`, `username`, `password`, `address`, `p_address`, `user_image`, `online_status`) VALUES
(1, 'daeyan', 'lk', '09', 909, 909, '', 'daeyan', 'op', 'jkbjkbbjkbjk', 'nklnklnklnklnklnkl', '../profile_img/admin/admin-daeyan-1-cat2.jfif', '');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(255) NOT NULL,
  `ans` text NOT NULL,
  `type` varchar(15) NOT NULL,
  `st_name` varchar(50) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `q_id` int(255) NOT NULL,
  `mcq_id` int(255) NOT NULL,
  `exam_id` int(100) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `marks_obtained` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `ans`, `type`, `st_name`, `subject`, `roll_no`, `q_id`, `mcq_id`, `exam_id`, `exam_name`, `marks_obtained`) VALUES
(22, 'qw', 'MCQ', 'op', 'english', '9-q', 0, 14, 8, '', '20'),
(23, 'po', 'MCQ', 'op', 'english', '9-q', 0, 15, 8, '', '20'),
(24, 'ANS_!\r\n', 'QUE', 'op', 'english', '9-q', 11, 0, 8, '', '25'),
(25, 'Ans-2', 'QUE', 'op', 'english', '9-q', 12, 0, 8, '', '10'),
(26, 'qe', 'MCQ', 'sid', 'english', '20-q', 0, 14, 8, '', '12'),
(27, 'pi', 'MCQ', 'sid', 'english', '20-q', 0, 15, 8, '', '20'),
(28, 'kl\r\n', 'QUE', 'sid', 'english', '20-q', 11, 0, 8, '', '8'),
(29, 'as', 'QUE', 'sid', 'english', '20-q', 12, 0, 8, '', '8'),
(32, 'p', 'MCQ', 'op', 'final', '9-q', 0, 16, 9, '', '25'),
(33, 'q', 'MCQ', 'op', 'final', '9-q', 0, 17, 9, '', '8'),
(34, 'Here', 'QUE', 'op', 'final', '9-q', 13, 0, 9, '', '10'),
(35, 'WHAT ISJKNSJNJSNKNnknklnklnknklnknkn', 'QUE', 'op', 'final', '9-q', 15, 0, 9, '', '25'),
(36, 'pp', 'MCQ', 'sid', 'final', '20-q', 0, 16, 9, '', '18'),
(37, 'qq', 'MCQ', 'sid', 'final', '20-q', 0, 17, 9, '', '19'),
(38, 'NNNNNN-091309034 0 9  089489 hpu9huhk  hi:DFKDF:KF:K', 'QUE', 'sid', 'final', '20-q', 13, 0, 9, '', '17'),
(39, 'edbeldekldeklednkl', 'QUE', 'sid', 'final', '20-q', 15, 0, 9, '', '18'),
(40, 'op', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, '', '47'),
(41, 'nnn', 'QUE', 'op', 'math', '9-q', 16, 0, 11, '', '34'),
(42, 'po', 'MCQ', 'daeyan', 'math', '10-q', 0, 18, 11, '', '50'),
(43, 'jkjkj', 'QUE', 'daeyan', 'math', '10-q', 16, 0, 11, '', '49'),
(44, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', '30'),
(45, '\r\n            lkfnlfnrnklf', 'QUE', 'op', 'math', '9-q', 16, 0, 11, '', 'un-checked'),
(46, '\r\nklenklnekl', 'QUE', 'op', 'math', '9-q', 16, 0, 11, '', 'un-checked'),
(47, 'op', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(48, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(49, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(50, 'kllklkll78787', 'QUE', 'op', 'math', '9-q', 16, 0, 11, 'MATH', 'un-checked'),
(51, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(52, '\r\n            90', 'QUE', 'op', 'math', '9-q', 16, 0, 11, 'MATH', 'un-checked'),
(53, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(54, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(55, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(56, 'kllklo', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(57, '\r\n            jj\r\n', 'QUE', 'op', 'math', '9-q', 16, 0, 11, 'MATH', 'un-checked'),
(58, 'kllklo', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(59, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(60, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(61, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(62, 'kllklo', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(63, 'jo', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(64, 'po', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(65, 'jo', 'MCQ', 'op', 'math', '9-q', 0, 18, 11, 'MATH', 'un-checked'),
(66, 'pup', 'MCQ', 'op', 'phy', '9-q', 0, 22, 13, 'phy', '40'),
(67, '123', 'QUE', 'op', 'phy', '9-q', 19, 0, 13, 'phy', '40'),
(68, 'po', 'MCQ', 'sid', 'phy', '20-q', 0, 22, 13, 'phy', '47'),
(69, '098', 'QUE', 'sid', 'phy', '20-q', 19, 0, 13, 'phy', '47'),
(70, 'ui', 'MCQ', 'op', 'math', '9-q', 0, 23, 14, 'phy', '50'),
(71, 'ui', 'MCQ', 'sid', 'math', '20-q', 0, 23, 14, 'phy', '40'),
(72, '90090', 'QUE', 'sid', 'math', '20-q', 20, 0, 14, 'phy', '26'),
(73, 'kj', 'MCQ', 'op', 'Maths', '9-q', 0, 24, 16, '10-i', '40'),
(74, 'ANS-1', 'QUE', 'op', 'Maths', '9-q', 21, 0, 16, '10-i', '40'),
(75, 'lkkl', 'QUE', 'op', 'Maths', '9-q', 21, 0, 16, '10-i', 'un-checked'),
(76, 'kkjjk', 'QUE', 'op', 'Maths', '9-q', 21, 0, 16, '10-i', 'un-checked'),
(77, 'qt', 'MCQ', 'op', 'Maths', '9-q', 0, 24, 16, '10-i', 'un-checked'),
(78, '08', 'MCQ', 'st-1', 'Math', 'st-1', 0, 25, 17, '2021-9-p', '40'),
(79, 'ANS-st1', 'QUE', 'st-1', 'Math', 'st-1', 22, 0, 17, '2021-9-p', '40'),
(80, 'ans-phy1', 'QUE', 'st-1', 'Phys', 'st-1', 23, 0, 18, '2021-9-p', '60'),
(81, '90', 'MCQ', 'st-2', 'Math', 'st-2', 0, 25, 17, '2021-9-p', '30'),
(82, 'ans-st2', 'QUE', 'st-2', 'Math', 'st-2', 22, 0, 17, '2021-9-p', '30'),
(83, 'ans-phy2\r\n', 'QUE', 'st-2', 'Phys', 'st-2', 23, 0, 18, '2021-9-p', '60'),
(84, '90', 'MCQ', 'st-1', 'math', 'st-1', 0, 25, 21, '9-p', 'un-checked'),
(85, 'm', 'QUE', 'st-1', 'math', 'st-1', 22, 0, 22, '9-p-m', 'un-checked');

-- --------------------------------------------------------

--
-- Table structure for table `assingments`
--

CREATE TABLE `assingments` (
  `ass_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `file` text NOT NULL COMMENT 'file location',
  `class` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `section` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `t_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assingments`
--

INSERT INTO `assingments` (`ass_id`, `title`, `file`, `class`, `subject`, `section`, `date`, `time`, `t_id`) VALUES
(1, 'jj', 'jklnjnknl', '0', '', 'klnkl', '0000-00-00', '0000-00-00 00:00:00.000000', 'mn,m'),
(2, 'jkljkjknjnkjnk', '../assingments/teacher Assingment-t-91-klnnkl-klnkln', '0', '', 'klnkln', '2021-08-17', '2021-08-16 20:37:16.646562', 't-91'),
(3, '10', '../assingments/teacher Assingment-t-91-10-0', '10', '', '0', '2021-08-17', '2021-08-16 20:38:57.399003', 't-91'),
(4, '', '../assingments/teacher Assingment---', '0', '', '', '2021-08-17', '2021-08-16 20:44:43.589938', ''),
(5, '10', '../assingments/teacher Assingment-t-91-20-30', '20', '', '30', '2021-08-17', '2021-08-16 20:51:56.079666', 't-91'),
(6, 'kl', '../assingments/teacher Assingment-t-91-op-90', '0', '', '90', '2021-08-17', '2021-08-16 20:57:29.009757', 't-91'),
(7, 'lk;lk', '../assingments/teacher Assingment-t-91-l;;kl;kl-;l;kl;kl', '0', '', ';l;kl;kl', '2021-08-17', '2021-08-16 20:57:53.971474', 't-91'),
(8, 'jkn', '../assingments/teacher Assingment-t-91-jknjnnkl-klnnkl', '0', '', 'klnnkl', '2021-08-17', '2021-08-16 20:59:15.774979', 't-91'),
(9, 'jknjk', '../assingments/teacher Assingment-t-91-klkln-klnkln', 'klkln', '', 'klnkln', '2021-08-17', '2021-08-16 21:00:32.759068', 't-91'),
(10, 'PL/SQL', '../assingments/teacher Assingment-t-91-9-p', '9', 'op', 'p', '2021-08-17', '2021-08-16 21:05:55.014675', 't-91'),
(11, 'kjjk', '../assingments/teacher Assingment-t-91-9-p', '9', '90', 'p', '2021-08-17', '2021-08-16 21:15:14.955414', 't-91'),
(12, 'PL/SQL', '../assingments/teacher Assingment-t-92-9-p', '9', 'test_sub', 'p', '2021-08-17', '2021-08-17 05:29:33.421653', 't-92');

-- --------------------------------------------------------

--
-- Table structure for table `exam_data`
--

CREATE TABLE `exam_data` (
  `exam_id` int(255) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `t_id` varchar(100) NOT NULL,
  `section` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `time` varchar(4) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unactive' COMMENT 'Active Exam Or Not',
  `created` datetime(6) DEFAULT current_timestamp(6),
  `admin_approval` int(2) NOT NULL DEFAULT 0 COMMENT 'admin approve of exams or not(testing phase)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_data`
--

INSERT INTO `exam_data` (`exam_id`, `exam_name`, `subject`, `t_id`, `section`, `class`, `time`, `status`, `created`, `admin_approval`) VALUES
(1, 'test', 'test_sub', '10-q-t', 'i', '10', '', 'Done', '2021-07-09 16:35:00.000000', 0),
(2, 'che', '8999', '10-q', 'i', '10', '', 'Done', '2021-07-09 16:35:50.000000', 0),
(3, 'che', 'che', '10-q', 'i', '20', '', 'Done', '2021-07-30 02:09:16.000000', 0),
(4, 'che', '8999', '10-q', 'q', '10', '', 'Done', '2021-07-30 02:10:21.000000', 0),
(6, 'test_official', 'test_officail', '10-q', 'i', '10', '1', 'active', '2021-07-31 00:32:05.000000', 0),
(8, 'test2', 'english', '10-q', 'i', '10', '10', 'active', '2021-08-01 20:18:21.000000', 0),
(9, 'test_FINAL', 'final', '10-q', 'i', '10', '2', 'Done', '2021-08-02 00:29:17.000000', 0),
(10, 'n', 'klnkln', 'klnkln', 'klnkl', 'knkln', 'klnk', 'Done', '0000-00-00 00:00:00.000000', 0),
(11, 'MATH', 'math', '10-q-t', 'i', '10', '1', 'Done', '2021-08-02 01:14:11.000000', 0),
(12, 'che', 'test_sub', '10-q', 'i', '10', '10', 'Done', '2021-08-02 01:53:57.000000', 0),
(13, 'phy', 'phy', '10-q-t', 'i', '10', '1', 'Done', '2021-08-02 16:46:48.000000', 0),
(14, 'phy', 'math', '10-q', 'i', '10', '1', 'active', '2021-08-02 16:52:59.000000', 0),
(15, 'test', 'test_sub', '10-q-t', 'i', '10', '2', 'Done', '2021-08-02 18:28:45.000000', 0),
(16, '10-i', 'Maths', '10-q', 'i', '10', '1', 'Done', '2021-08-02 21:00:20.000000', 0),
(17, '2021-9-p', 'Math', 't-91', 'p', '9', '1', 'active', '2021-08-11 02:14:39.000000', 0),
(18, '2021-9-p', 'Phys', 't-92', 'p', '9', '1', 'Done', '2021-08-11 02:23:51.000000', 0),
(19, 'jdKLNL', 'KLNKLN', '10-q', 'KLNKLN', 'KLNKL', '0', 'unactive', '2021-08-13 04:13:02.000000', 0),
(20, 'op', 'op', 't-92', 'p', '9', '1', 'active', '2021-08-17 02:31:59.000000', 0),
(21, '9-p', 'math', 't-92', 'p', '9', '1', 'Done', '2021-08-17 11:54:44.000000', 0),
(22, '9-p-m', 'math', 't-92', 'p', '9', '1', 'active', '2021-08-17 12:31:30.000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `face_marks`
--

CREATE TABLE `face_marks` (
  `x_variable_0` varchar(25) NOT NULL,
  `x_variable_1` varchar(25) NOT NULL,
  `x_variable_2` varchar(25) NOT NULL,
  `x_variable_3` varchar(25) NOT NULL,
  `x_variable_4` varchar(25) NOT NULL,
  `x_variable_5` varchar(25) NOT NULL,
  `x_variable_6` varchar(25) NOT NULL,
  `x_variable_7` varchar(25) NOT NULL,
  `x_variable_8` varchar(25) NOT NULL,
  `x_variable_9` varchar(25) NOT NULL,
  `x_variable_10` varchar(25) NOT NULL,
  `x_variable_11` varchar(25) NOT NULL,
  `x_variable_12` varchar(25) NOT NULL,
  `x_variable_13` varchar(25) NOT NULL,
  `x_variable_14` varchar(25) NOT NULL,
  `x_variable_15` varchar(25) NOT NULL,
  `x_variable_16` varchar(25) NOT NULL,
  `y_variable_0` varchar(25) NOT NULL,
  `y_variable_1` varchar(25) NOT NULL,
  `y_variable_2` varchar(25) NOT NULL,
  `y_variable_3` varchar(25) NOT NULL,
  `y_variable_4` varchar(25) NOT NULL,
  `y_variable_5` varchar(25) NOT NULL,
  `y_variable_6` varchar(25) NOT NULL,
  `y_variable_7` varchar(25) NOT NULL,
  `y_variable_8` varchar(25) NOT NULL,
  `y_variable_9` varchar(25) NOT NULL,
  `y_variable_10` varchar(25) NOT NULL,
  `y_variable_11` varchar(25) NOT NULL,
  `y_variable_12` varchar(25) NOT NULL,
  `y_variable_13` varchar(25) NOT NULL,
  `y_variable_14` varchar(25) NOT NULL,
  `y_variable_15` varchar(25) NOT NULL,
  `y_variable_16` varchar(25) NOT NULL,
  `roll_no` varchar(255) NOT NULL COMMENT 'Srudent roll_no',
  `facemark_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--

CREATE TABLE `marksheet` (
  `result_id` int(255) NOT NULL,
  `roll_no` varchar(255) NOT NULL COMMENT 'Student Roll no',
  `subject` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `t_id` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `exam_time_complete` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `total_marks_obtained` varchar(20) NOT NULL COMMENT 'Marks',
  `paper_status` varchar(20) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `remarks` varchar(20) DEFAULT NULL COMMENT 'cheating or something'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marksheet`
--

INSERT INTO `marksheet` (`result_id`, `roll_no`, `subject`, `class`, `section`, `t_id`, `exam_id`, `exam_time_complete`, `total_marks_obtained`, `paper_status`, `exam_name`, `remarks`) VALUES
(132, '9-q', 'english', '10', 'i', '10-q', '8', '2021-08-01 21:24:35.000000', '75', 'Checked', '', NULL),
(134, '20-q', 'english', '10', 'i', '10-q', '8', '2021-08-01 21:26:43.000000', '48', 'Checked', '', NULL),
(139, '9-q', 'final', '10', 'i', '10-q', '9', '2021-08-02 00:55:03.000000', '68', 'Checked', '', NULL),
(141, '20-q', 'final', '10', 'i', '10-q', '9', '2021-08-02 00:56:59.000000', '72', 'Checked', '', NULL),
(144, '10-q', 'final', '10', 'i', '10-q', '9', '2021-08-02 00:58:48.000000', 'Cheating Case', 'FAIL', '', 'Cheating Case'),
(146, '10-q', 'math', '10', 'i', '10-q-t', '11', '2021-08-02 01:16:55.000000', '99', 'Checked', '', NULL),
(147, '9-q', 'math', '10', 'i', '10-q-t', '11', '2021-08-02 16:37:46.000000', 'Un-Checked Yet', 'Un-Checked Yet', 'MATH', NULL),
(148, '9-q', 'phy', '10', 'i', '10-q-t', '13', '2021-08-02 16:50:25.000000', '80', 'Checked', 'phy', NULL),
(149, '20-q', 'phy', '10', 'i', '10-q-t', '13', '2021-08-02 16:51:45.000000', '94', 'Checked', 'phy', NULL),
(150, '9-q', 'math', '10', 'i', '10-q', '14', '2021-08-02 16:59:53.000000', '50', 'Checked', 'phy', NULL),
(151, '20-q', 'math', '10', 'i', '10-q', '14', '2021-08-02 17:00:52.000000', '66', 'Checked', 'phy', NULL),
(152, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:43.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(153, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:44.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(154, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:45.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(155, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:46.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(156, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:47.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(157, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:49.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(158, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:50.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(159, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:52.000000', 'Cheating Case', 'FAIL', '', 'Cheating Case'),
(160, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:53.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(161, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:54.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(162, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:55.000000', 'Cheating Case', 'FAIL', '', 'Cheating Case'),
(163, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:57.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(164, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:58.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(165, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:27:59.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(166, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:00.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(167, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:01.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(168, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:03.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(169, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:04.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(170, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:05.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(171, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:07.000000', 'Un-Checked Yet', 'Un-Checked Yet', '', NULL),
(172, '10-q', 'test_sub', '10', 'i', '10-q-t', '1', '2021-08-02 18:28:07.000000', 'Cheating Case', 'FAIL', '', 'Cheating Case'),
(173, '10-q', 'test_sub', '10', 'i', '10-q-t', '15', '2021-08-02 18:29:34.000000', 'Cheating Case', 'FAIL', '', 'Cheating Case'),
(179, '9-q', 'Maths', '10', 'i', '10-q', '16', '2021-08-02 21:15:06.000000', 'Cheating Case', 'FAIL', '', 'Cheating Case'),
(180, '9-q', 'Maths', '10', 'i', '10-q', '16', '2021-08-02 21:15:11.000000', 'Cheating Case', 'Checked', '10-i', 'Cheating Case'),
(204, 'st-1', 'Phys', '9', 'p', 't-92', '18', '2021-08-13 22:29:53.000000', '60', 'Checked', '2021-9-p', NULL),
(210, 'st-1', 'op', '9', 'p', 't-92', '20', '2021-08-17 02:45:42.000000', '0', 'Checked', 'op', 'Cheating Case'),
(217, 'st-1', 'math', '9', 'p', 't-92', '21', '2021-08-17 12:21:21.000000', 'Un-Checked Yet', 'Un-Checked Yet', '9-p', NULL),
(218, 'st-1', 'math', '9', 'p', 't-92', '22', '2021-08-17 12:32:37.000000', 'Un-Checked Yet', 'Un-Checked Yet', '9-p-m', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mcq`
--

CREATE TABLE `mcq` (
  `mcq_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `option_1` varchar(100) NOT NULL,
  `option_2` varchar(100) NOT NULL,
  `option_3` varchar(100) NOT NULL,
  `option_4` varchar(100) NOT NULL,
  `marks` int(20) NOT NULL,
  `t_id` varchar(100) NOT NULL,
  `section` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Techaer Name',
  `exam_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mcq`
--

INSERT INTO `mcq` (`mcq_id`, `title`, `option_1`, `option_2`, `option_3`, `option_4`, `marks`, `t_id`, `section`, `class`, `exam_name`, `name`, `exam_id`) VALUES
(1, 'PL/SQL', 'qwkk`kj', 'kj', 'kj', 'kj', 10, '10-q-t', 'i', '10', '', 'ali', 1),
(2, 'PL/SQL', 'iv', 'kj', 'kj', 'klnkl', 10, '10-q', 'i', '10', '', 'qazi', 2),
(3, 'PL/SQL', 'qwkk`kj', 'kj', 'kj', 'kj', 90, '10-q', 'q', '10', '', 'qazi', 2),
(4, 'java', 'knlwkln', 'ihil', 'klnkl', 'kj', 90, '10-q', 'q', '21', '', 'qazi', 2),
(5, 'java', 'knlwkln', 'ihil', 'klnkl', 'kj', 90, '10-q', 'q', '21', '', 'qazi', 2),
(6, 'lklkllk', 'knlwkln', 'ihil', 'kj', 'klnln', 55, '10-q', '0', '10', '', 'qazi', 2),
(7, 'lklkllk', 'knlwkln', 'ihil', 'kj', 'klnln', 55, '10-q', '0', '10', '', 'qazi', 2),
(8, 'MCQ-1', 'op', 'oi', 'oo', 'ou', 25, '10-q', 'i', '10', '', 'qazi', 6),
(10, 'MCQ-2', 'pp', 'po', 'pip', 'pu', 25, '10-q', 'i', '10', '', 'qazi', 6),
(14, 'MCQ-1', 'qw', 'qe', 'qr', 'qt', 25, '10-q', 'i', '10', '', 'qazi', 8),
(15, 'Ans-2', 'po', 'pi', 'pu', 'py', 25, '10-q', 'i', '10', '', 'qazi', 8),
(16, 'MCQ-1', 'p', 'pp', 'ppp', 'pppp', 25, '10-q', 'i', '10', '', 'qazi', 9),
(17, 'MCQ-1', 'q', 'qq', 'qqq', 'qqqq', 25, '10-q', 'i', '10', '', 'qazi', 9),
(18, 'm-1', 'kllklo', 'po', 'jo', 'lp', 50, '10-q-t', 'i', '10', '', 'ali', 11),
(19, 'jnj', 'k ', 'klnnk', 'kln', 'kln', 90, '10-q', 'i', '10', '', 'qazi', 9),
(20, 'jnj', 'k ', 'klnnk', 'kln', 'kln', 90, '10-q', 'i', '10', '', 'qazi', 9),
(21, 'j', 'lkn', 'klnlk', 'nlkn', 'kln', 0, '10-q', 'kln', 'klnkn', 'test_FINAL', 'qazi', 9),
(22, 'n-2', 'po', 'pi', 'pup', 'u', 50, '10-q-t', 'i', '10', 'phy', 'ali', 13),
(23, 'qazi-2', 'ui', 'ui', 'ui', 'ui', 50, '10-q', 'i', '10', 'phy', 'qazi', 14),
(24, 'PL/SQL', 'po', 'kj', 'klnkl', 'qt', 50, '10-q', 'i', '10', '10-i', 'qazi', 16),
(25, '91-2', '90', '09', '08', '07', 50, 't-91', 'p', '9', '2021-9-p', 't-91', 17),
(26, 'PL/SQL', 'qwkk`kj', 'klnnk', 'klnkl', 'kj', 50, 't-92', 'p', '10', '9-p', 't-92', 21);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(255) NOT NULL,
  `question` text NOT NULL COMMENT 'Question',
  `marks` int(20) NOT NULL,
  `t_id` varchar(100) NOT NULL COMMENT 'Techer Id',
  `name` varchar(30) NOT NULL,
  `section` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `exam_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `question`, `marks`, `t_id`, `name`, `section`, `class`, `exam_name`, `exam_id`) VALUES
(1, 'n', 10, '10-q-t', 'ali', 'i', '10', '', 1),
(2, 'New question from rahim', 10, '10-q', 'qazi', 'i', '10', '', 2),
(3, 'New question from rahim', 10, '10-q', 'qazi', 'i', '10', '', 2),
(4, 'New question from rahim', 10, '10-q', 'qazi', 'i', '10', '', 2),
(5, 'This is from frontEnd baby!!!', 10, '10-q', 'qazi', 'i', '20', '', 2),
(6, 'This is from frontEnd baby!!!', 10, '10-q', 'qazi', 'i', '20', '', 2),
(9, 'Que-1', 25, '10-q', 'qazi', 'i', '10', '', 6),
(10, 'Que-2', 25, '10-q', 'qazi', 'i', '10', '', 6),
(11, 'Que-1', 25, '10-q', 'qazi', 'i', '10', '', 8),
(12, 'Que-2', 25, '10-q', 'qazi', 'i', '10', '', 8),
(13, 'Que-1', 25, '10-q', 'qazi', 'i', '10', '', 9),
(14, 'Que-2', 25, '10-q', 'qazi', '10', 'i', '', 9),
(15, 'what is what is', 40, '10-q', 'qazi', 'i', '10', '', 9),
(16, 'q-1', 50, '10-q-t', 'ali', 'i', '10', '', 11),
(17, 'jkcnjk', 90, '10-q', 'qazi', 'i', '10', '', 9),
(18, 'jkn', 0, '10-q', 'qazi', 'kln', 'klnkl', 'test_FINAL', 9),
(19, 'n-1', 50, '10-q-t', 'ali', 'i', '10', 'phy', 13),
(20, 'qazi-1', 50, '10-q', 'qazi', 'i', '10', 'phy', 14),
(21, 'Que-1', 50, '10-q', 'qazi', 'i', '10', '10-i', 16),
(22, '91-1', 50, 't-91', 't-91', 'p', '9', '2021-9-p', 17),
(23, '92-1', 100, 't-92', 't-91', 'p', '9', '2021-9-p', 18),
(24, 'New question from rahim', 10, 't-92', 't-92', 'p', '9', 'op', 20),
(25, 'Que-1', 50, 't-92', 't-92', 'p', '9', '9-p', 21),
(26, 'New question from rahim', 100, 't-92', 't-92', 'p', '9', '9-p-m', 22);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `st_ans_d` int(255) NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `percentage` varchar(10) DEFAULT NULL,
  `Grade` varchar(20) NOT NULL DEFAULT 'pending',
  `paper_status` varchar(20) NOT NULL DEFAULT 'pending',
  `exam_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`st_ans_d`, `roll_no`, `class`, `section`, `percentage`, `Grade`, `paper_status`, `exam_name`) VALUES
(104, '20-q', '10', 'i', '80', 'A-1', 'Result Annouced', '90'),
(117, '9-q', '10', 'i', '65', 'B', 'Result Annouced', 'test'),
(150, 'st-2', '9', 'p', '60', 'B', 'Result Annouced', '2021-9-p'),
(156, 'st-1', '9', 'p', '0', 'Fail', 'Result Annouced', 'op');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `roll_no` varchar(255) NOT NULL COMMENT 'Roll Number of student',
  `name` varchar(50) NOT NULL,
  `class` varchar(10) NOT NULL,
  `section` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `st_cnic` varchar(30) NOT NULL,
  `st_phone` int(15) NOT NULL,
  `father_phone` int(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `p_address` varchar(255) NOT NULL COMMENT 'Permeant Address',
  `father_name` varchar(50) NOT NULL,
  `father_cnic` varchar(30) NOT NULL,
  `father_occupation` varchar(30) NOT NULL,
  `acc_approval` int(2) NOT NULL DEFAULT 0,
  `user_image` varchar(255) NOT NULL DEFAULT '0',
  `online_status` varchar(7) NOT NULL DEFAULT '',
  `profile_lock` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`roll_no`, `name`, `class`, `section`, `email`, `st_cnic`, `st_phone`, `father_phone`, `username`, `password`, `address`, `p_address`, `father_name`, `father_cnic`, `father_occupation`, `acc_approval`, `user_image`, `online_status`, `profile_lock`) VALUES
('10-q', 'daeyan', '10', 'i', 'io', '90', 90, 90, 'q', 'q', 'jkhkjhhj', 'jkhjkhjk', '', '', '', 1, '0', '', 0),
('20-q', 'sid', '10', 'i', 'lkl', '', 75785578, 2147483647, 'h', 'h', 'klbj.l', 'klbj.l', '', 'jkk', 'm m,jkjkl', 1, '../profile_img/student/student-sid-20-q-self.PNG', '', 0),
('9-q', 'op', '10', 'i', 'kl@g.m', '42401-697897879', 8239823, 738347, 'hi', 'kl', 'E-142, Latifabad Hyderabaf', 'E-142, Latifabad Hyderabaf', 'JSIO', '67', 'kl', 1, '../profile_img/student/student-op-9-q-ans.PNG', '', 0),
('r-1', 'r-1', '10', 's', '', '', 0, 0, 'r-1', 'r-1', '', '', '', '', '', 1, '0', '', 0),
('r-2', 'r-2', '2', 'p', '', '', 0, 0, 'r-2', 'r-2', '', '', '', '', '', 1, '0', '', 0),
('r-3', 'r-3', '6', 'q', '', '', 0, 0, 'r-3', 'r-3', '', '', '', '', '', 0, '0', '', 0),
('st-1', 'st-1', '9', 'p', ';llkkj', '', 0, 0, 'st-1', 'qwe', '', '', '', '', '', 1, '../profile_img/student/student-st-1-st-1-io.jpg', '', 0),
('st-101', 'st-101', '10', 'p', '', '', 0, 0, 'st-101', 'st-101', '', '', '', '', '', 1, '0', '', 0),
('st-102', 'st-102', '10', 'p', '', '', 0, 0, 'st-102', 'st-102', '', '', '', '', '', 1, '0', '', 0),
('st-103', 'st-103', '10', 'p', '', '', 0, 0, 'st-103', 'st-103', '', '', '', '', '', 1, '0', '', 0),
('st-104', 'st-104', '10', 'p', '', '', 0, 0, 'st-104', 'st-104', '', '', '', '', '', 1, '0', '', 0),
('st-105', 'st-105', '10', 'p', '', '', 0, 0, 'st-105', 'st-105', '', '', '', '', '', 1, '0', '', 0),
('st-106', 'st-106', '10', 'q', '', '', 0, 0, 'st-106', 'st-106', '', '', '', '', '', 1, '0', '', 0),
('st-2', 'st-2', '9', 'p', '', '', 0, 0, 'st-2', 'st-2', '', '', '', '', '', 0, '0', '', 0),
('st-3', 'st-3', '9', 'p', '', '', 0, 0, 'st-3', 'st-3', '', '', '', '', '', 1, '0', '', 0),
('st-4', 'st-4', '9', 'p', '', '', 0, 0, 'st-4', 'st-4', '', '', '', '', '', 0, '0', '', 0),
('st-5', 'st-5', '9', 'p', '', '', 0, 0, 'st-5', 'st-5', '', '', '', '', '', 0, '0', '', 0),
('st-6', 'st-6', '9', 'p', '', '', 0, 0, 'st-6', 'st-6', '', '', '', '', '', 0, '0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` varchar(100) NOT NULL COMMENT 'Roll Number/Gr.Number of Teacher',
  `name` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `t_cnic` int(30) NOT NULL,
  `t_phone` int(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `p_address` varchar(255) NOT NULL COMMENT 'Parament Address',
  `acc_approval` int(1) NOT NULL DEFAULT 0,
  `class_teacher` varchar(20) NOT NULL DEFAULT 'none',
  `user_image` varchar(255) NOT NULL DEFAULT '0',
  `online_status` varchar(10) NOT NULL,
  `profile_lock` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `name`, `class`, `subject`, `section`, `username`, `email`, `password`, `t_cnic`, `t_phone`, `address`, `p_address`, `acc_approval`, `class_teacher`, `user_image`, `online_status`, `profile_lock`) VALUES
('', 'k;l', '9', '\'l\'k\'', 'lm;lm', ';lm;l', 'k;lk', ';lk;lk', 89, 9, '', '', 0, 'none', '0', '', 0),
('10-q', 'qazi', '10', 'islamiyat', 'i', 'qazi', 'i', 't', 0, 0, '', '', 1, '10-i', '../profile_img/teacher/teacher-qazi-10-q-cat2.jfif', '', 0),
('10-q-t', 'ali', '10', 'Maths', 'i', 't', 't', 't', 0, 0, '', '', 1, '10-i', '../profile_img/teacher/teacher-ali-10-q-t-cat2.jfif', '', 0),
(';jj;jo', 'nm', '9', 'kklklj', 'jklkljklj', 'kljklj', '', '', 0, 0, '', '', 1, 'none', '0', '', 0),
('jkjnk', 'jknjk', '2', 'lklkn', 'klnkln', 'lknklnklkn', 'klnnkl', 'lknkl', 0, 0, '', '', 0, 'none', '0', '', 0),
('q-9-t', 'op', '10', 'computer', 'i', '9', '9', '9', 0, 0, '', '', 0, 'none', '0', '', 0),
('t-101', 't-101', '10', 'Math', 'p', 't-101', '', 't-101', 0, 0, '', '', 1, '10-p', '0', '', 0),
('t-102', 't-102', '10', 'Chemistry', 'p', 't-102', '', 't-102', 0, 0, '', '', 0, 'none', '0', '', 0),
('t-103', 't-103', '10', 'Physics', 'p', 't-101', '', 't-101', 0, 0, '', '', 1, 'none', '0', '', 0),
('t-104', 't-104', '10', 'Urdu', 'p', 't-104', '', 't-104', 0, 0, '', '', 0, 'none', '0', '', 0),
('t-105', 't-105', '10', 'Islamiyat', 'p', 't-105', '', 't-105', 0, 0, '', '', 1, 'none', '0', '', 0),
('t-106', 't-106', '10', 'Computer', 'p', 't-106', '', 't-106', 0, 0, '', '', 1, 'none', '0', '', 0),
('t-107', 't-107', '10', 'Random', 'q', 't-107', '', 't-107', 0, 0, '', '', 0, 'none', '0', '', 0),
('t-91', 't-91', '9', 'Math', 'p', 't-91', '', 't-91', 0, 0, '        jkjkjkjnk', '        ', 0, 'none', '0', '', 0),
('t-92', 't-92', '9', 'Chemistry', 'p', 't-92', '', 't-92', 0, 0, '', '', 1, '9-p', '0', '', 0),
('t-93', 't-93', '9', 'Physics', 'p', 't-93', '', 't-93', 0, 0, '', '', 0, '9-p', '0', '', 0),
('t-94', 't-94', '10', 'Urdu', 'p', 't-94', '', 't-94', 0, 0, '', '', 1, 'none', '0', '', 0),
('t-95', 't-95', '10', 'Islamiyat', 'p', 't-95', '', 't-95', 0, 0, '', '', 1, 'none', '0', '', 0),
('t-96', 't-96', '10', 'Computer', 'p', 't-96', '', 't-96', 0, 0, '', '', 0, 'none', '0', '', 0),
('t-97', 't-97', '10', 'Random', 'q', 't-97', '', 't-97', 0, 0, '', '', 1, 'none', '0', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `assingments`
--
ALTER TABLE `assingments`
  ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `exam_data`
--
ALTER TABLE `exam_data`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `face_marks`
--
ALTER TABLE `face_marks`
  ADD PRIMARY KEY (`facemark_id`);

--
-- Indexes for table `marksheet`
--
ALTER TABLE `marksheet`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `mcq`
--
ALTER TABLE `mcq`
  ADD PRIMARY KEY (`mcq_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`st_ans_d`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`roll_no`) COMMENT 'Roll Number',
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ans_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `assingments`
--
ALTER TABLE `assingments`
  MODIFY `ass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exam_data`
--
ALTER TABLE `exam_data`
  MODIFY `exam_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `face_marks`
--
ALTER TABLE `face_marks`
  MODIFY `facemark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marksheet`
--
ALTER TABLE `marksheet`
  MODIFY `result_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `mcq`
--
ALTER TABLE `mcq`
  MODIFY `mcq_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `st_ans_d` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
