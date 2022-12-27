-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19 ส.ค. 2020 เมื่อ 02:45 AM
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
-- โครงสร้างตาราง `m_banks`
--

CREATE TABLE `m_banks` (
  `id` bigint(20) NOT NULL,
  `short` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name_th` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- dump ตาราง `m_banks`
--

INSERT INTO `m_banks` (`id`, `short`, `name_th`) VALUES
(1, 'bbl', 'ธ.กรุงเทพ'),
(2, 'kbank', 'ธ.กสิกรไทย'),
(3, 'ktb', 'ธ.กรุงไทย'),
(4, 'scb', 'ธ.ไทยพาณิชย์'),
(5, 'bay', 'ธ.กรุงศรีอยุธยา'),
(6, 'cimb', 'ธ.ซีไอเอ็มบี'),
(7, 'ibank', 'ธ.อิสลามแห่งประเทศไทย'),
(8, 'kiatnakin', 'ธ.เกียรตินาคิน'),
(9, 'lhbank', 'ธ.แลนด์ แอนด์ เฮ้าส์'),
(10, 'standard', 'ธ.สแตนดาร์ดชาร์เตอร์ด (ไทย)'),
(11, 'thanachart', 'ธ.ธนชาต'),
(12, 'tisco', 'ธ.ทิสโก้'),
(13, 'tmb', 'ธ.ทหารไทย'),
(14, 'uob', 'ธ.ยูโอบี');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_banks`
--
ALTER TABLE `m_banks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_banks`
--
ALTER TABLE `m_banks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
