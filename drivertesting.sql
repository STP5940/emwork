-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 11:08 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivertesting`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_customers`
--

CREATE TABLE `t_customers` (
  `Customers_id` bigint(20) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0:รอพิจารณา, 1:ผ่านการทดสอบ, 2:ไม่ผ่านการทดสอบ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_customers`
--

INSERT INTO `t_customers` (`Customers_id`, `firstname`, `lastname`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2212270001, 'สมชาย', 'รักดี', 0, '2022-12-27 22:54:12', '2022-12-27 22:58:51', '2022-12-27 22:58:51'),
(2212270002, 'มานะ', 'ชูใจ', 0, '2022-12-27 22:54:32', '2022-12-27 22:54:32', NULL),
(2212270003, 'demo', 'dev03', 0, '2022-12-27 22:54:45', '2022-12-27 22:59:30', NULL),
(2212270004, 'สมหมาย', 'ทรงกิต', 0, '2022-12-27 22:54:56', '2022-12-27 22:54:56', NULL),
(2212270005, 'ชายเล็ก', 'ทรงกรต', 0, '2022-12-27 22:55:08', '2022-12-27 22:55:08', NULL),
(2212270006, 'มาคิด', 'ไทยน้อย', 0, '2022-12-27 22:55:23', '2022-12-27 22:55:23', NULL),
(2212270007, 'นาน้อย', 'คอยรัก', 0, '2022-12-27 22:55:51', '2022-12-27 22:55:51', NULL),
(2212270008, 'น้าค้อม', 'คิดดี', 0, '2022-12-27 22:56:08', '2022-12-27 22:56:08', NULL),
(2212270009, 'สมหวัง', 'คิดมาก', 0, '2022-12-27 22:56:19', '2022-12-27 22:56:19', NULL),
(2212270010, 'รักดี', 'มาลา', 0, '2022-12-27 22:56:31', '2022-12-27 22:56:31', NULL),
(2212270011, 'มานา', 'ลาพัก', 0, '2022-12-27 22:56:44', '2022-12-27 22:56:44', NULL),
(2212270012, 'มาใหม', 'ลาก่อน', 0, '2022-12-27 22:56:55', '2022-12-27 22:56:55', NULL),
(2212270013, 'คิดมาก', 'ถามก่อน', 0, '2022-12-27 22:57:05', '2022-12-27 22:57:05', NULL),
(2212270014, 'คิดดี', 'ไปก่อน', 0, '2022-12-27 22:57:16', '2022-12-27 22:57:16', NULL),
(2212270015, 'สมหวัง', 'รักดี', 0, '2022-12-27 22:57:25', '2022-12-27 22:57:25', NULL),
(2212270016, 'มามาก', 'มาอยู่', 0, '2022-12-27 22:57:40', '2022-12-27 22:57:40', NULL),
(2212270017, 'ไทยรัก', 'รักชาติ', 0, '2022-12-27 22:57:56', '2022-12-27 22:57:56', NULL),
(2212270018, 'สรลาม', 'สามรัก', 0, '2022-12-27 22:58:13', '2022-12-27 22:58:13', NULL),
(2212270019, 'สมหวัง', 'เป็นไทย', 0, '2022-12-27 22:58:25', '2022-12-27 22:58:25', NULL),
(2212270020, 'สมชาย', 'คิดเกิด', 0, '2022-12-27 22:58:35', '2022-12-27 22:58:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_testbody`
--

CREATE TABLE `t_testbody` (
  `Testbody_id` int(11) NOT NULL,
  `Customers_id` bigint(20) DEFAULT NULL,
  `colorblindness` int(11) DEFAULT 0 COMMENT '(ทดสอบตาบอดสี)\r\n0:ยังไม่ทดสอบ, 1:ผ่าน, 2:ไม่ผ่าน',
  `farsightedness` int(11) DEFAULT 0 COMMENT '(ทดสอบสายตายาว)\r\n0:ยังไม่ทดสอบ, 1:ผ่าน, 2:ไม่ผ่าน',
  `astigmatism` int(11) DEFAULT 0 COMMENT '(ทดสอบสายตาเอียง)\r\n0:ยังไม่ทดสอบ, 1:ผ่าน, 2:ไม่ผ่าน	',
  `bodyresponse` int(11) DEFAULT 0 COMMENT '(ทดสอบการตอบสนองของร่างการ)\r\n0:ยังไม่ทดสอบ, 1:ผ่าน, 2:ไม่ผ่าน	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_testbody`
--

INSERT INTO `t_testbody` (`Testbody_id`, `Customers_id`, `colorblindness`, `farsightedness`, `astigmatism`, `bodyresponse`) VALUES
(9, 2212270001, 0, 0, 0, 0),
(10, 2212270002, 0, 0, 0, 0),
(11, 2212270003, 1, 1, 1, 1),
(12, 2212270004, 0, 0, 0, 0),
(13, 2212270005, 0, 0, 0, 0),
(14, 2212270006, 0, 0, 0, 0),
(15, 2212270007, 0, 0, 0, 0),
(16, 2212270008, 0, 0, 0, 0),
(17, 2212270009, 0, 0, 0, 0),
(18, 2212270010, 0, 0, 0, 0),
(19, 2212270011, 0, 0, 0, 0),
(20, 2212270012, 0, 0, 0, 0),
(21, 2212270013, 0, 0, 0, 0),
(22, 2212270014, 0, 0, 0, 0),
(23, 2212270015, 0, 0, 0, 0),
(24, 2212270016, 0, 0, 0, 0),
(25, 2212270017, 0, 0, 0, 0),
(26, 2212270018, 0, 0, 0, 0),
(27, 2212270019, 0, 0, 0, 0),
(28, 2212270020, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_testpractical`
--

CREATE TABLE `t_testpractical` (
  `Testpractical_id` int(11) NOT NULL,
  `Customers_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'สอบภาคปฏิบัติ ผ่าน หรือไม่ผ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_testpractical`
--

INSERT INTO `t_testpractical` (`Testpractical_id`, `Customers_id`, `status`) VALUES
(7, 2212270001, 0),
(8, 2212270002, 0),
(9, 2212270003, 1),
(10, 2212270004, 0),
(11, 2212270005, 0),
(12, 2212270006, 0),
(13, 2212270007, 0),
(14, 2212270008, 0),
(15, 2212270009, 0),
(16, 2212270010, 0),
(17, 2212270011, 0),
(18, 2212270012, 0),
(19, 2212270013, 0),
(20, 2212270014, 0),
(21, 2212270015, 0),
(22, 2212270016, 0),
(23, 2212270017, 0),
(24, 2212270018, 0),
(25, 2212270019, 0),
(26, 2212270020, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_testtheory`
--

CREATE TABLE `t_testtheory` (
  `Testtheory_id` int(11) NOT NULL,
  `Customers_id` bigint(20) DEFAULT NULL,
  `trafficsign` int(11) DEFAULT NULL COMMENT 'ป้ายจราจร',
  `trafficline` int(11) DEFAULT NULL COMMENT ' เส้นจราจร',
  `givingway` int(11) DEFAULT NULL COMMENT 'การให้ทาง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_testtheory`
--

INSERT INTO `t_testtheory` (`Testtheory_id`, `Customers_id`, `trafficsign`, `trafficline`, `givingway`) VALUES
(6, 2212270001, 0, 0, 0),
(7, 2212270002, 0, 0, 0),
(8, 2212270003, 15, 50, 25),
(9, 2212270004, 0, 0, 0),
(10, 2212270005, 0, 0, 0),
(11, 2212270006, 0, 0, 0),
(12, 2212270007, 0, 0, 0),
(13, 2212270008, 0, 0, 0),
(14, 2212270009, 0, 0, 0),
(15, 2212270010, 0, 0, 0),
(16, 2212270011, 0, 0, 0),
(17, 2212270012, 0, 0, 0),
(18, 2212270013, 0, 0, 0),
(19, 2212270014, 0, 0, 0),
(20, 2212270015, 0, 0, 0),
(21, 2212270016, 0, 0, 0),
(22, 2212270017, 0, 0, 0),
(23, 2212270018, 0, 0, 0),
(24, 2212270019, 0, 0, 0),
(25, 2212270020, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `Users_id` bigint(20) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`Users_id`, `fullname`, `username`, `password`) VALUES
(2112270001, 'sitthipong sengdonprai', 'admin', '$2y$13$nwyfN05V3w1iJwArB09ymO3IDuhNHoMskuRvbYzo/MafViPeyafMO');

-- --------------------------------------------------------

--
-- Table structure for table `xrequests`
--

CREATE TABLE `xrequests` (
  `id` int(11) NOT NULL,
  `originip` varchar(45) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Requests from remote IPs';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_customers`
--
ALTER TABLE `t_customers`
  ADD PRIMARY KEY (`Customers_id`);

--
-- Indexes for table `t_testbody`
--
ALTER TABLE `t_testbody`
  ADD PRIMARY KEY (`Testbody_id`);

--
-- Indexes for table `t_testpractical`
--
ALTER TABLE `t_testpractical`
  ADD PRIMARY KEY (`Testpractical_id`);

--
-- Indexes for table `t_testtheory`
--
ALTER TABLE `t_testtheory`
  ADD PRIMARY KEY (`Testtheory_id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`Users_id`);

--
-- Indexes for table `xrequests`
--
ALTER TABLE `xrequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ts` (`ts`),
  ADD KEY `originip` (`originip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_testbody`
--
ALTER TABLE `t_testbody`
  MODIFY `Testbody_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `t_testpractical`
--
ALTER TABLE `t_testpractical`
  MODIFY `Testpractical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `t_testtheory`
--
ALTER TABLE `t_testtheory`
  MODIFY `Testtheory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `xrequests`
--
ALTER TABLE `xrequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1090232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
