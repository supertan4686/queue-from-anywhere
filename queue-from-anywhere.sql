-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 08:03 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queue-from-anywhere`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password'),
(2, 'melon', 'melon');

-- --------------------------------------------------------

--
-- Table structure for table `admin_session`
--

CREATE TABLE `admin_session` (
  `admin_id` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(20) NOT NULL,
  `employee_name_title` varchar(10) NOT NULL,
  `employee_firstname` varchar(50) NOT NULL,
  `employee_lastname` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name_title`, `employee_firstname`, `employee_lastname`, `position`) VALUES
('XXXX01', 'นาย', 'ก', 'จงรักภักดี', 'พนักงานชำระค่าไฟฟ้า'),
('XXXX02', 'นาย', 'ข', 'อกตัญญู', 'พนักงานชำระค่าไฟฟ้า');

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `login_log_id` int(11) NOT NULL,
  `counter_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_time` time NOT NULL,
  `logout_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`login_log_id`, `counter_id`, `employee_id`, `timestamp`, `login_time`, `logout_time`) VALUES
(1, 1, 'XXXX01', '2018-05-31 17:00:00', '09:01:15', '11:59:04'),
(2, 2, 'XXXX02', '2018-05-31 17:00:00', '08:57:44', '11:57:01'),
(3, 1, 'XXXX02', '2018-05-31 17:00:00', '13:05:45', '15:58:09'),
(4, 2, 'XXXX01', '2018-05-31 17:00:00', '13:03:42', '16:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `queue_log`
--

CREATE TABLE `queue_log` (
  `queue_log_id` int(11) NOT NULL,
  `queue_type` varchar(2) NOT NULL,
  `queue_number` varchar(3) NOT NULL,
  `counter_id` int(11) NOT NULL,
  `ca` varchar(30) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `queue_create_time` time NOT NULL,
  `start_service_time` time NOT NULL,
  `end_service_time` time DEFAULT NULL,
  `score` tinyint(5) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queue_log`
--

INSERT INTO `queue_log` (`queue_log_id`, `queue_type`, `queue_number`, `counter_id`, `ca`, `employee_id`, `queue_create_time`, `start_service_time`, `end_service_time`, `score`, `timestamp`) VALUES
(1, 'A', '001', 1, 'XXXXXXXXXX201', 'XXXX01', '09:10:01', '09:10:03', '09:11:00', 5, '2018-05-31 17:00:00'),
(2, 'A', '002', 2, 'XXXXXXXXXX203', 'XXXX02', '09:11:10', '09:11:15', '09:11:59', 4, '2018-05-31 17:00:00'),
(3, 'A', '003', 2, 'XXXXXXXXXX204', 'XXXX02', '09:12:05', '09:12:10', '09:12:59', 3, '2018-05-31 17:00:00'),
(4, 'B', '001', 1, 'XXXXXXXXXX202', 'XXXX01', '09:11:09', '09:11:15', NULL, 0, '2018-05-31 17:00:00'),
(5, 'B', '002', 2, 'XXXXXXXXXX205', 'XXXX02', '09:16:03', '09:19:09', '09:20:11', 5, '2018-05-31 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` varchar(1) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_start_queue` int(11) NOT NULL,
  `service_end_queue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_start_queue`, `service_end_queue`) VALUES
('A', 'คิวปกติที่เดินเข้ามาเอง', 1, 699),
('B', 'Mobile', 700, 899),
('C', 'บริการอื่นๆ', 900, 999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`login_log_id`);

--
-- Indexes for table `queue_log`
--
ALTER TABLE `queue_log`
  ADD PRIMARY KEY (`queue_log_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `login_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `queue_log`
--
ALTER TABLE `queue_log`
  MODIFY `queue_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
