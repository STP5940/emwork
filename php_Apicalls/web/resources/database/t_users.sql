-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19 ส.ค. 2020 เมื่อ 02:41 AM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u137062665_lotto`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `t_users`
--

CREATE TABLE `t_users` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `img` varchar(200) NOT NULL,
  `level` int(10) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `t_users`
--

INSERT INTO `t_users` (`id`, `name`, `lastname`, `username`, `password`, `email`, `img`, `level`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1909100001, 'Channel 7', 'TV', '106708610819661066656', '$2y$13$4hMxk.WwkIRJRuVSShs2p.LFdxYfJikKRQRyEebh7MZA.quUp1MlW', 'stp592540@gmail.com', 'https://lh3.googleusercontent.com/a-/AAuE7mDOoNSaA0qfeXDVRuaB0TsJh57b5rAxmbjlv8-OJA', 1, 1, '2019-09-10 23:11:04', NULL, NULL),
(1909100002, 'สมชาย', 'รักดี', 'sitthipong114', '$2y$13$PHieG..4q4R2DyepJpO3WOosisrjfSFaM8/tg7D.ss.7xepi0hLlG', 'NULL', '/OneTech/images/Users.png', 1, 1, '2019-09-10 23:27:19', NULL, NULL),
(1909110002, 'TI', 'Basics', '112968098915147423842', '$2y$13$lTifRn1iMwx94QMvc9jz8e0d1RqlwrL/I5pMDlvbcEsMGYLNj/MwW', 'sitthipong.sengdonprai@gmail.com', 'https://lh3.googleusercontent.com/a-/AAuE7mAnzFHBWXL4hOGY_Wh-ETE0qpdsOjtIw6xoberdaQ', 99, 1, '2019-09-11 01:30:36', NULL, NULL),
(1909110003, 'Ant', 'Small', 'Ant', '$2y$13$sNdTLm8WJRoRXY2YrRBwAe3T5PVH82WGVkVNB1B7SeALv8GpkCLo.', 'NULL', '/OneTech/images/Users.png', 1, 1, '2019-09-11 13:22:50', NULL, NULL),
(1909230001, 'สิทธิพงษ์', 'เส็งดอนไพร', '109644817679483589694', '$2y$13$pu.RQz0xyoG6Mq2V7ybYCOFdeeYdDxRndLf69D2aGp8LDwZ9OrqV.', 'sitthipong114@gmail.com', 'https://lh3.googleusercontent.com/a-/AAuE7mAgnneHhbxOq6s90fITrN-FfcFqUcUbVcrfH40b', 1, 1, '2019-09-23 22:01:50', NULL, NULL),
(1910120001, 'มานะ', 'สมดี', '116896554371613681393', '$2y$13$aXeTJFLio5h7K0LIdlEuWuUMwuDUwsPj4O60c3LjGDLkNG4doiWYW', 'stp0000000009@gmail.com', 'https://lh5.googleusercontent.com/-LwXe7I3I8y4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZoBnHC5F1JBs6_SPRqphsf_uRGw/photo.jpg', 1, 1, '2019-10-12 00:36:11', NULL, NULL),
(1910170001, 'Channel 7', 'TV', '115273505812114050639', '$2y$13$v2nMmltCA6PxoXexxP9XF.7tD60kLWSE.57xoijHgzQdGAWDYP5t.', 'stp5940@gmail.com', 'https://lh3.googleusercontent.com/a-/AAuE7mCpPsD-6JbZUF-iOrPfUpyqGtSwDRojNehexmf7', 1, 1, '2019-10-17 22:32:22', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1910170002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
