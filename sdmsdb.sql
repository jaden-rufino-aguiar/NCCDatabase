-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 07:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `attendance` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`att_id`, `member_id`, `date`, `attendance`) VALUES
(125, 66, '2023-04-02', 1),
(126, 66, '2023-04-03', 1),
(127, 66, '2023-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `studentno` varchar(255) NOT NULL,
  `studentName` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `regtno` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `bld` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `aadh` varchar(35) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `studentImage` varchar(255) DEFAULT NULL,
  `father` varchar(255) DEFAULT NULL,
  `mother` varchar(255) DEFAULT NULL,
  `s1` date DEFAULT NULL,
  `s2` date DEFAULT NULL,
  `s3` date DEFAULT NULL,
  `s4` date DEFAULT NULL,
  `tally` varchar(30) DEFAULT NULL,
  `f1` date DEFAULT NULL,
  `f2` date DEFAULT NULL,
  `f3` date DEFAULT NULL,
  `f4` date DEFAULT NULL,
  `ftally` varchar(30) NOT NULL,
  `c1` varchar(20) DEFAULT NULL,
  `c2` varchar(20) DEFAULT NULL,
  `c3` varchar(20) DEFAULT NULL,
  `c4` varchar(20) DEFAULT NULL,
  `c5` varchar(20) DEFAULT NULL,
  `year` int(10) NOT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `class`, `studentno`, `studentName`, `rank`, `regtno`, `age`, `dept`, `phone`, `bld`, `dob`, `aadh`, `gender`, `email`, `address`, `studentImage`, `father`, `mother`, `s1`, `s2`, `s3`, `s4`, `tally`, `f1`, `f2`, `f3`, `f4`, `ftally`, `c1`, `c2`, `c3`, `c4`, `c5`, `year`, `postingDate`, `updationDate`) VALUES
(66, '6BTCS-C', '2060354', 'Jaden Rufino Aguiar', 'CDT', 'KA/20/SD/F/1003509', 0, 'CSE', '9623984534', 'O+', '2002-07-19', '328763985049', 'Male', 'jaden.rufino@gmail.com', 'India, Goa, Divar, 403403', 'IMG_4255.HEIC', 'Johnson James Aguiar', 'Loveline Catherine Aguiar', '2023-04-06', '2023-03-10', NULL, NULL, NULL, '2023-04-01', NULL, NULL, NULL, '', 'CATC 1 2022-23', 'VSC 1', NULL, NULL, NULL, 2024, '2023-04-02 17:39:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `userimage` varchar(255) NOT NULL DEFAULT 'but.jpg',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `name`, `lastname`, `username`, `email`, `sex`, `permission`, `password`, `mobile`, `userimage`, `status`) VALUES
(15, 'Admin', '     ', 'admin', 'jaden.rufino@gmail.com', 'Male', 'Super User', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'christ.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `userEmail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `username`, `name`, `lastname`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(244, 'admin', 'Admin', '    ', 'jaden.rufino@btech.christuniversity.in', 0x3a3a3100000000000000000000000000, '2023-04-02 17:33:15', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
