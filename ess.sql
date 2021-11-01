-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2021 at 12:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ess`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Muhammad Mohsin Khan', 'mohsinkhanzda@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchant_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `credit` float NOT NULL DEFAULT 50,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `image` varchar(50) NOT NULL,
  `token` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `name`, `email`, `password`, `credit`, `join_date`, `image`, `token`) VALUES
(1, 'mohsin', '12345', '12345', 50, '2021-10-22', '', '245'),
(2, 'khan', 'mohsinkhanzda@gmail.com', '6666', 49.9511, '2021-10-22', 'Screenshot_2.png', '245'),
(13, 'kashif', 'mohsinnaveed094@gmail.com', '5555', 50, '2021-10-23', '', '245'),
(15, 'kashi', 'ggggg@gmail.com', '9999', 49.8533, '2021-10-23', 'IMG_20210509_143644.jpg', NULL),
(20, '', 'mohsinkzda@gmail.com', '6666', 50, '2021-10-25', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` varchar(11) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `payment_for` int(11) NOT NULL,
  `payer_name` varchar(50) NOT NULL,
  `payment_amount` varchar(50) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payer_id`, `payment_for`, `payer_name`, `payment_amount`, `payment_date`) VALUES
('0', 0, 2, 'khan', '100', '2021-10-26 19:00:00'),
('1', 0, 13, 'kashif', '50', '2021-10-27 13:04:38'),
('ch_3JpBt2KD', 0, 13, 'kashif', '50', '2021-10-27 13:10:02'),
('ch_3JpCXeKD', 22, 15, 'Kashif kham', '50', '2021-10-27 13:51:59'),
('ch_3JpCYXKD', 2, 2, 'khan', '50', '2021-10-27 13:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `email_from` varchar(50) NOT NULL,
  `email_to` varchar(50) NOT NULL,
  `cc` varchar(50) DEFAULT NULL,
  `bcc` varchar(50) DEFAULT NULL,
  `email_subject` varchar(50) DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `requester_id`, `email_from`, `email_to`, `cc`, `bcc`, `email_subject`, `body`, `time`) VALUES
(1, 2, 'mohsinkhanzda@gmail.com', 'mohsinnaveed094@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'Khan', '2021-10-25 08:43:20'),
(2, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 09:03:24'),
(3, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 09:05:15'),
(4, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 09:43:01'),
(5, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:08:23'),
(6, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:09:12'),
(7, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:09:32'),
(8, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:11:19'),
(9, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:14:08'),
(10, 2, 'mohsinkhanzda@gmail.com', 'hkhurshid95@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:14:51'),
(11, 2, 'mohsinkhanzda@gmail.com', '@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:15:08'),
(12, 2, 'mohsinkhanzda@gmail.com', 'mohsinkhanzda@gmail.com', '', '', 'Khan', 'this mail is sent via jetmail', '2021-10-25 10:16:12'),
(13, 2, 'mohsinkhanzda@gmail.com', 'muhammadatifrizwan@gmail.com', '', '', 'Khan', 'hy atif', '2021-10-25 10:18:21'),
(14, 2, 'mohsinkhanzda@gmail.com', 'mohsinkhanzdagmail.com', '', '', 'Khan', 'hy atif', '2021-10-25 10:20:36'),
(15, 2, 'mohsinkhanzda@gmail.com', 'mohsinkhanzdagmail.com', '', '', 'Khan', 'hy atif', '2021-10-25 10:21:36'),
(16, 2, 'mohsinkhanzda@gmail.com', 'mohsinkhanzda@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 10:23:19'),
(17, 2, 'mohsinkhanzda@gmail.com', 'mohsinkhanzda@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 10:39:34'),
(18, 2, 'mohsinkhanzda@gmail.com', 'mohsinkhanzda@gmail.com', '17221598-094@uog.edu.pk', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 11:49:27'),
(19, 2, 'mohsinkhanzda@gmail.com', 'nabeeltariq261@gmail.com', 'nabeeltariq261@gmail.com', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 11:50:47'),
(20, 2, 'mohsinkhanzda@gmail.com', 'nabeeltariq261@gmail.com', 'nabeeltariq261@gmail.com', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 17:00:47'),
(21, 2, 'mohsinkhanzda@gmail.com', 'musharrafatique29@gmail.com', 'nabeeltariq261@gmail.com', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 17:06:16'),
(22, 2, 'mohsinkhanzda@gmail.com', 'musharrafatique29@gmail.com', 'nabeeltariq261@gmail.com', 'hdhhd@gmail.com', 'jy', 'hy', '2021-10-25 17:07:38'),
(23, 13, 'kahif@gmail.com', 'musharrafatique29@gmail.com', 'nabeeltariq261@gmail.com', 'hdhhd@gmail.com', 'jy', 'hy', '2021-10-25 17:09:36'),
(24, 13, 'kahif@gmail.com', 'musharrafatique29@gmail.com', 'nabeeltariq261@gmail.com', 'hmusharrafatique29@gmail.com', 'jy', 'hy', '2021-10-25 17:11:34'),
(25, 13, 'kahif@gmail.com', 'mohsinkhanzda@gmail.com', 'nabeeltariq261@gmail.com', 'hmusharrafatique29@gmail.com', 'jy', 'hy', '2021-10-25 17:12:48'),
(26, 13, 'mohsinnaveed094@gmail.com', 'musharrafatique29@gmail.com', 'nabeeltariq261@gmail.com', 'mohsinkhanzda@gmail.com', 'jy', 'hy', '2021-10-25 17:15:43'),
(27, 13, 'ggggg@gmail.com', 'musharrafatique29@gmail.com', 'nabee@gmail.com', 'mohsi@gmail.com', 'Hi', 'Hi', '2021-10-26 09:55:26'),
(28, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-26 15:24:19'),
(29, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-26 15:26:44'),
(30, 2, 'mohsinkhanzda@gmail.com', 'usharrafatique29@gmail.com', 'nabeeltariq261@gmail.com', 'mohsinkhanzda@gmail.com', 'by', 'gggg', '2021-10-27 14:00:58'),
(31, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:09:43'),
(32, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:10:46'),
(33, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:11:02'),
(34, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:11:28'),
(35, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:11:57'),
(36, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:12:29'),
(37, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:13:44'),
(38, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:17:05'),
(39, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:17:54'),
(40, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:19:26'),
(41, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:20:30'),
(42, 22, 'kashifkhan@gmail.com', 'msjdhf@gmail.com', 'hfhf@gmail.com', 'fggfg@gmail.com', 'Hy man', 'check email', '2021-10-27 14:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sec_merchant`
--

CREATE TABLE `sec_merchant` (
  `sec_merchant_id` int(50) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email_send_role` tinyint(1) NOT NULL DEFAULT 1,
  `email_list_role` tinyint(1) NOT NULL DEFAULT 1,
  `payment_role` tinyint(1) NOT NULL DEFAULT 1,
  `join_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sec_merchant`
--

INSERT INTO `sec_merchant` (`sec_merchant_id`, `merchant_id`, `name`, `email`, `password`, `email_send_role`, `email_list_role`, `payment_role`, `join_date`) VALUES
(1, 13, 'ali', 'ali@gmail.com', '2222', 1, 0, 0, '2021-10-23'),
(3, 13, 'hsn', 'hsn@gmail.com', '333', 1, 1, 1, '2021-10-23'),
(4, 2, 'dua', 'dua@gmail.com', '555', 0, 1, 1, '2021-10-23'),
(5, 2, 'nim', 'nim@gmail.com', '555', 0, 1, 1, '2021-10-23'),
(7, 2, 'Nabeel', 'nabeeltariq261@gmail.com', '12345', 0, 1, 1, '2021-10-25'),
(8, 2, 'Atif', 'muhammadatifrizan@gmail.com', '5555', 0, 1, 1, '2021-10-25'),
(9, 2, 'Atif', 'muhammadatifrizwan@gmail.com', '5555', 0, 1, 1, '2021-10-25'),
(10, 13, 'Sona', 'muhammadrizwan@gmail.com', '5555', 0, 0, 0, '2021-10-26'),
(13, 13, 'Sona', 'muhfdrizwan@gmail.com', '5555', 0, 0, 0, '2021-10-26'),
(15, 13, 'fff', 'ff@gmail.com', '5555', 0, 0, 0, '2021-10-26'),
(16, 13, 'rrr', 'dfff@gmail.com', '5643', 0, 0, 0, '2021-10-26'),
(17, 13, '555', 'fffrr@gmail.com', '5643', 0, 0, 0, '2021-10-26'),
(18, 13, '555', 'rrrr@gmail.com', '5643', 0, 0, 0, '2021-10-26'),
(19, 13, 'dhhdf', 'fhhfhfhhf@gmail.com', '5643', 0, 0, 0, '2021-10-26'),
(21, 13, 'dhhdf', 'fff@gmail.com', '5643', 0, 0, 0, '2021-10-26'),
(22, 15, 'Kashif kham', 'kashifkhan@gmail.com', 'kashif', 1, 1, 1, '2021-10-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchant_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payer_id` (`payment_for`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `sec_merchant`
--
ALTER TABLE `sec_merchant`
  ADD PRIMARY KEY (`sec_merchant_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `merchant_id` (`merchant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sec_merchant`
--
ALTER TABLE `sec_merchant`
  MODIFY `sec_merchant_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`payment_for`) REFERENCES `merchant` (`merchant_id`);

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`request_id`);

--
-- Constraints for table `sec_merchant`
--
ALTER TABLE `sec_merchant`
  ADD CONSTRAINT `sec_merchant_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`merchant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
