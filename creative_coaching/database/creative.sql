-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 04:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `creative`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `eid` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `timing` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `batch` varchar(255) CHARACTER SET latin1 NOT NULL,
  `teacher` varchar(255) CHARACTER SET latin1 NOT NULL,
  `year` varchar(255) CHARACTER SET latin1 NOT NULL,
  `course` varchar(255) CHARACTER SET latin1 NOT NULL,
  `timing` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `batch`, `teacher`, `year`, `course`, `timing`) VALUES
(8, 'B001', 'E1002', '2021', 'HSC', '05.00 pm - 06.00 pm'),
(9, 'B002', 'E1002', '2021', 'HSC', '03.00 pm - 04.00 pm'),
(10, 'B003', 'E1003', '2021', 'HSC', '04.00 pm - 05.00 pm'),
(11, 'B004', 'E1003', '2021', 'HSC', '02:00 pm - 03:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `sid` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fathername` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fathermob` varchar(255) CHARACTER SET latin1 NOT NULL,
  `class` varchar(255) CHARACTER SET latin1 NOT NULL,
  `course` varchar(255) CHARACTER SET latin1 NOT NULL,
  `batch` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fee` varchar(255) CHARACTER SET latin1 NOT NULL,
  `dateofreg` varchar(255) CHARACTER SET latin1 NOT NULL,
  `teacher` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `sid`, `name`, `address`, `fathername`, `fathermob`, `class`, `course`, `batch`, `fee`, `dateofreg`, `teacher`, `mobile`, `subject`) VALUES
(21, 'S1001', 'Munshi Faysal', 'Namapara', 'Md momin', '+8801303132459', 'XII', 'HSC', 'B001', '1000', '2020-12-27 ', 'E1002', '+8801303132459', 'ICT');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `eid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `dateofjoining` date NOT NULL,
  `batchmentor` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `eid`, `name`, `email`, `mobile`, `address`, `salary`, `course`, `dateofjoining`, `batchmentor`, `position`, `subject`) VALUES
(1, 'E1001', 'Mst Shopna Akter', 'shopna@gmail.com', '01624124125', 'Khilkhet, Dhaka', '50000', 'HSC', '2020-12-01', 'ALl', 'admin', 'nothing'),
(7, 'E1002', 'Munshi Faysal', '18203036@iubat.edu', '01303132459', 'Namapara', '6000', 'HSC', '2020-12-28', '', 'teacher', 'ICT'),
(8, 'E1003', 'Md Sifat Ahmed', 'sifat@gmail.com', '01987654321', 'Khilkhet, Bot Tola', '5000', 'HSC', '2020-12-28', '', 'teacher', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `tea_attendance`
--

CREATE TABLE `tea_attendance` (
  `id` int(11) NOT NULL,
  `eid` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `timetocome` varchar(255) NOT NULL,
  `timetogo` varchar(255) NOT NULL,
  `bywhom` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tea_attendance`
--

INSERT INTO `tea_attendance` (`id`, `eid`, `date`, `timetocome`, `timetogo`, `bywhom`, `status`, `course`) VALUES
(3, 'E1002', '2020-12-28', '10:00am', '1:00pm', 'E1001', 'p', 'HSC'),
(4, 'E1003', '2020-12-28', '10:00am', '1:00pm', 'E1001', 'p', 'HSC'),
(5, 'E1002', '2020-12-27', '10:00 am', '01:00 pm', 'E1001', 'p', 'HSC');

-- --------------------------------------------------------

--
-- Table structure for table `tea_batch`
--

CREATE TABLE `tea_batch` (
  `id` int(11) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `eid` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tea_batch`
--

INSERT INTO `tea_batch` (`id`, `batch`, `eid`, `course`, `subject`) VALUES
(8, 'B001', 'E1002', 'HSC', 'ICT'),
(9, 'B002', 'E1002', 'HSC', 'ICT'),
(10, 'B003', 'E1003', 'HSC', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `timing` varchar(255) NOT NULL,
  `eid` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `batch`, `course`, `timing`, `eid`, `day`, `year`, `subject`) VALUES
(6, 'B001', 'HSC', '05.00 pm - 06.00 pm', 'E1002', 'sat-mon-wed', '', 'ICT'),
(7, 'B002', 'HSC', '03.00 pm - 04.00 pm', 'E1002', 'sun-tue-thu', '', 'ICT'),
(8, 'B003', 'HSC', '04.00 pm - 05.00 pm', 'E1003', 'sun-tue-thu', '', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`) VALUES
(3, 'E1001', 'admin', 'admin'),
(8, 'E1002', 'E1002', 'teacher'),
(9, 'E1003', 'E1003', 'teacher'),
(16, 'S1001', 'student', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch` (`batch`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `tea_attendance`
--
ALTER TABLE `tea_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tea_batch`
--
ALTER TABLE `tea_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tea_attendance`
--
ALTER TABLE `tea_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tea_batch`
--
ALTER TABLE `tea_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
