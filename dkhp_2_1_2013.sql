-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2013 at 09:45 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dkhp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ca`
--

CREATE TABLE IF NOT EXISTS `ca` (
  `TenCa` int(1) NOT NULL,
  PRIMARY KEY (`TenCa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ca`
--

INSERT INTO `ca` (`TenCa`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `cauhinh`
--

CREATE TABLE IF NOT EXISTS `cauhinh` (
  `DK` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GiaTri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cauhinh`
--

INSERT INTO `cauhinh` (`DK`, `GiaTri`) VALUES
('TCTD', 30);

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE IF NOT EXISTS `chuyennganh` (
  `MaCN` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MaKhoa` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MaK` int(2) NOT NULL,
  `TenCN` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaCN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`MaCN`, `MaKhoa`, `MaK`, `TenCN`) VALUES
('CNPM_4_1', 'CNPM', 4, 'Lập Trình'),
('CNPM_4_2', 'CNPM', 4, 'Quản Lý'),
('CNPM_5_1', 'CNPM', 5, 'Quản trị phần mềm'),
('CNPM_5_2', 'CNPM', 5, 'Lập trình và ứng dụng phần mềm'),
('CNPM_5_3', 'CNPM', 5, 'Bảo mật phần mềm'),
('CNPM_6_1', 'CNPM', 6, 'Lập Trình'),
('CNPM_6_2', 'CNPM', 6, 'Quản Lý'),
('HTTT_4_1', 'HTTT', 4, '1'),
('HTTT_4_2', 'HTTT', 4, '2'),
('MMT_4_1', 'MMT', 4, 'Lập trình và quản trị'),
('MMT_4_2', 'MMT', 4, 'An ninh mạng và bảo mật'),
('MMT_5_1', 'MMT', 5, 'Lập trình và quản trị'),
('MMT_5_2', 'MMT', 5, 'An ninh mạng và bảo mật'),
('MMT_6_1', 'MMT', 6, 'Phát triển hệ thống mạng'),
('MMT_6_2', 'MMT', 6, 'An ninh mạng và bảo mật');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `ctdt`
--

CREATE TABLE IF NOT EXISTS `ctdt` (
  `MaKhoa` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MaK` int(2) NOT NULL,
  `SoHK` int(2) NOT NULL,
  PRIMARY KEY (`MaKhoa`,`MaK`),
  KEY `MaK` (`MaK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctdt`
--

INSERT INTO `ctdt` (`MaKhoa`, `MaK`, `SoHK`) VALUES
('CNPM', 4, 9),
('CNPM', 5, 9),
('CNPM', 6, 9),
('CNPM', 7, 9),
('CNPM', 8, 9),
('CNPM', 9, 9),
('CNPM', 10, 9),
('HTTT', 4, 9),
('HTTT', 5, 9),
('KHMT', 4, 8),
('KHMT', 5, 8),
('KHMT', 6, 8),
('KHMT', 7, 8),
('KTMT', 4, 9),
('KTMT', 5, 9),
('KTMT', 6, 9),
('KTMT', 7, 7),
('KTMT', 8, 8),
('MMT', 4, 9),
('MMT', 5, 9),
('MMT', 6, 9),
('MMT', 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_cnpm`
--

CREATE TABLE IF NOT EXISTS `ctdt_cnpm` (
  `ID` int(3) NOT NULL,
  `HK` int(1) NOT NULL DEFAULT '0',
  `K` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`K`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_cnpm`
--

INSERT INTO `ctdt_cnpm` (`ID`, `HK`, `K`) VALUES
(6, 9, 4),
(6, 9, 5),
(6, 9, 6),
(6, 9, 7),
(6, 9, 8),
(6, 9, 10),
(7, 7, 4),
(7, 7, 5),
(7, 7, 6),
(7, 7, 7),
(7, 7, 8),
(7, 7, 10),
(8, 7, 4),
(8, 7, 5),
(8, 7, 6),
(8, 7, 7),
(8, 7, 8),
(8, 7, 10),
(9, 8, 4),
(9, 8, 5),
(9, 8, 6),
(9, 8, 7),
(9, 8, 8),
(9, 8, 10),
(10, 9, 4),
(10, 9, 5),
(10, 9, 6),
(10, 9, 7),
(10, 9, 8),
(10, 9, 10),
(14, 1, 4),
(14, 1, 10),
(15, 9, 4),
(15, 9, 5),
(15, 9, 6),
(15, 9, 7),
(15, 9, 8),
(15, 9, 10),
(16, 9, 4),
(16, 9, 5),
(16, 9, 6),
(16, 9, 7),
(16, 9, 8),
(16, 9, 10),
(27, 8, 4),
(27, 8, 5),
(27, 8, 6),
(27, 8, 7),
(27, 8, 8),
(27, 8, 10),
(28, 8, 4),
(28, 8, 5),
(28, 8, 6),
(28, 8, 7),
(28, 8, 8),
(28, 8, 10),
(29, 8, 4),
(29, 8, 5),
(29, 8, 6),
(29, 8, 7),
(29, 8, 8),
(29, 8, 10),
(37, 7, 4),
(37, 7, 5),
(37, 7, 6),
(37, 7, 7),
(37, 7, 8),
(37, 7, 10),
(38, 7, 4),
(38, 7, 5),
(38, 7, 6),
(38, 7, 7),
(38, 7, 8),
(38, 7, 10),
(39, 6, 4),
(39, 6, 5),
(39, 6, 6),
(39, 6, 7),
(39, 6, 8),
(39, 6, 10),
(40, 8, 4),
(40, 8, 5),
(40, 8, 6),
(40, 8, 7),
(40, 8, 8),
(40, 8, 10),
(41, 7, 4),
(41, 7, 5),
(41, 7, 6),
(41, 7, 7),
(41, 7, 8),
(42, 5, 4),
(42, 5, 5),
(42, 5, 6),
(42, 5, 7),
(42, 5, 8),
(42, 5, 10),
(43, 5, 4),
(43, 5, 5),
(43, 5, 6),
(43, 5, 7),
(43, 5, 8),
(43, 5, 10),
(44, 6, 4),
(44, 6, 5),
(44, 6, 6),
(44, 6, 7),
(44, 6, 8),
(44, 6, 10),
(45, 5, 4),
(45, 5, 5),
(45, 5, 6),
(45, 5, 7),
(45, 5, 8),
(45, 5, 10),
(46, 8, 4),
(46, 8, 5),
(46, 8, 6),
(46, 8, 7),
(46, 8, 8),
(46, 8, 10),
(47, 6, 4),
(47, 6, 5),
(47, 6, 6),
(47, 6, 7),
(47, 6, 8),
(47, 6, 10),
(48, 6, 4),
(48, 6, 5),
(48, 6, 6),
(48, 6, 7),
(48, 6, 8),
(48, 6, 10),
(49, 8, 4),
(49, 8, 5),
(49, 8, 6),
(49, 8, 7),
(49, 8, 8),
(49, 8, 10),
(50, 5, 4),
(50, 5, 5),
(50, 5, 6),
(50, 5, 7),
(50, 5, 8),
(50, 5, 10),
(51, 5, 4),
(51, 5, 5),
(51, 5, 6),
(51, 5, 7),
(51, 5, 8),
(51, 5, 10),
(52, 6, 4),
(52, 6, 5),
(52, 6, 6),
(52, 6, 7),
(52, 6, 8),
(52, 6, 10),
(53, 1, 4),
(53, 1, 5),
(53, 1, 6),
(53, 1, 7),
(53, 1, 8),
(53, 1, 10),
(54, 2, 4),
(54, 2, 5),
(54, 2, 6),
(54, 2, 7),
(54, 2, 8),
(54, 2, 10),
(55, 3, 4),
(55, 3, 5),
(55, 3, 6),
(55, 3, 7),
(55, 3, 8),
(55, 3, 10),
(56, 4, 4),
(56, 4, 5),
(56, 4, 6),
(56, 4, 7),
(56, 4, 8),
(56, 4, 10),
(57, 2, 4),
(57, 2, 5),
(57, 2, 6),
(57, 2, 7),
(57, 2, 8),
(57, 2, 10),
(58, 4, 4),
(58, 4, 5),
(58, 4, 6),
(58, 4, 7),
(58, 4, 8),
(58, 4, 10),
(59, 3, 4),
(59, 3, 5),
(59, 3, 6),
(59, 3, 7),
(59, 3, 8),
(59, 3, 10),
(60, 1, 4),
(60, 1, 5),
(60, 1, 6),
(60, 1, 7),
(60, 1, 8),
(60, 1, 10),
(61, 3, 4),
(61, 3, 5),
(61, 3, 6),
(61, 3, 7),
(61, 3, 8),
(62, 1, 5),
(62, 1, 6),
(62, 1, 7),
(62, 1, 8),
(63, 1, 5),
(63, 1, 6),
(63, 1, 7),
(63, 1, 8),
(64, 2, 4),
(64, 2, 5),
(64, 2, 6),
(64, 2, 7),
(64, 2, 8),
(65, 3, 4),
(65, 3, 5),
(65, 3, 6),
(65, 3, 7),
(65, 3, 8),
(66, 2, 4),
(66, 2, 5),
(66, 2, 6),
(66, 2, 7),
(66, 2, 8),
(66, 2, 10),
(67, 3, 4),
(67, 3, 5),
(67, 3, 6),
(67, 3, 7),
(67, 3, 8),
(67, 3, 10),
(68, 4, 4),
(68, 4, 5),
(68, 4, 6),
(68, 4, 7),
(68, 4, 8),
(68, 4, 10),
(69, 4, 4),
(69, 4, 5),
(69, 4, 6),
(69, 4, 7),
(69, 4, 8),
(69, 4, 10),
(70, 4, 4),
(70, 4, 5),
(70, 4, 6),
(70, 4, 7),
(70, 4, 8),
(70, 4, 10),
(71, 3, 4),
(71, 3, 5),
(71, 3, 6),
(71, 3, 7),
(71, 3, 8),
(71, 3, 10),
(72, 2, 4),
(72, 2, 5),
(72, 2, 6),
(72, 2, 7),
(72, 2, 8),
(73, 7, 4),
(73, 7, 5),
(73, 7, 6),
(73, 7, 7),
(73, 7, 8),
(73, 7, 10),
(74, 1, 4),
(74, 1, 5),
(74, 1, 6),
(74, 1, 7),
(74, 1, 8),
(74, 1, 10),
(75, 1, 5),
(75, 1, 6),
(75, 1, 7),
(75, 1, 8),
(75, 1, 10),
(76, 2, 4),
(76, 2, 5),
(76, 2, 6),
(76, 2, 7),
(76, 2, 8),
(77, 4, 4),
(77, 4, 5),
(77, 4, 6),
(77, 4, 7),
(77, 4, 8),
(77, 4, 10),
(78, 1, 5),
(78, 1, 6),
(78, 1, 7),
(78, 1, 8),
(79, 2, 4),
(79, 2, 5),
(79, 2, 6),
(79, 2, 7),
(79, 2, 8),
(79, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_httt`
--

CREATE TABLE IF NOT EXISTS `ctdt_httt` (
  `ID` int(3) NOT NULL,
  `HK` int(1) NOT NULL DEFAULT '0',
  `K` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`K`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_httt`
--


-- --------------------------------------------------------

--
-- Table structure for table `ctdt_khmt`
--

CREATE TABLE IF NOT EXISTS `ctdt_khmt` (
  `ID` int(3) NOT NULL,
  `HK` int(1) NOT NULL DEFAULT '0',
  `K` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`K`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_khmt`
--

INSERT INTO `ctdt_khmt` (`ID`, `HK`, `K`) VALUES
(7, 7, 4),
(8, 7, 4),
(23, 2, 4),
(30, 7, 4),
(31, 7, 4),
(42, 6, 4),
(43, 5, 4),
(44, 5, 4),
(45, 5, 4),
(46, 3, 4),
(48, 6, 4),
(50, 6, 4),
(51, 5, 4),
(52, 3, 4),
(54, 1, 4),
(55, 1, 4),
(56, 1, 4),
(57, 2, 4),
(58, 2, 4),
(59, 1, 4),
(65, 4, 4),
(66, 3, 4),
(67, 4, 4),
(69, 3, 4),
(71, 4, 4),
(74, 4, 4),
(75, 2, 4),
(76, 2, 4),
(77, 1, 4),
(86, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_ktmt`
--

CREATE TABLE IF NOT EXISTS `ctdt_ktmt` (
  `ID` int(3) NOT NULL,
  `HK` int(1) NOT NULL DEFAULT '0',
  `K` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`K`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_ktmt`
--


-- --------------------------------------------------------

--
-- Table structure for table `ctdt_mmt`
--

CREATE TABLE IF NOT EXISTS `ctdt_mmt` (
  `ID` int(3) NOT NULL,
  `HK` int(1) NOT NULL DEFAULT '0',
  `K` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`K`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_mmt`
--

INSERT INTO `ctdt_mmt` (`ID`, `HK`, `K`) VALUES
(6, 9, 4),
(6, 9, 5),
(6, 9, 6),
(6, 9, 7),
(7, 7, 4),
(7, 7, 5),
(7, 7, 6),
(7, 7, 7),
(8, 7, 4),
(8, 7, 5),
(8, 7, 6),
(8, 7, 7),
(9, 8, 4),
(9, 8, 5),
(9, 8, 6),
(9, 8, 7),
(10, 9, 4),
(10, 9, 5),
(10, 9, 6),
(10, 9, 7),
(15, 9, 4),
(15, 9, 5),
(15, 9, 6),
(15, 9, 7),
(16, 9, 4),
(16, 9, 5),
(16, 9, 6),
(16, 9, 7),
(27, 8, 4),
(27, 8, 5),
(27, 8, 6),
(27, 8, 7),
(28, 8, 4),
(28, 8, 5),
(28, 8, 6),
(28, 8, 7),
(29, 8, 4),
(29, 8, 5),
(29, 8, 6),
(29, 8, 7),
(37, 7, 4),
(37, 7, 5),
(37, 7, 6),
(37, 7, 7),
(38, 7, 4),
(38, 7, 5),
(38, 7, 6),
(38, 7, 7),
(39, 6, 4),
(39, 6, 5),
(39, 6, 6),
(39, 6, 7),
(40, 8, 4),
(40, 8, 5),
(40, 8, 6),
(40, 8, 7),
(41, 7, 4),
(41, 7, 5),
(41, 7, 6),
(41, 7, 7),
(42, 5, 4),
(42, 5, 5),
(42, 5, 6),
(42, 5, 7),
(43, 5, 4),
(43, 5, 5),
(43, 5, 6),
(43, 5, 7),
(44, 6, 4),
(44, 6, 5),
(44, 6, 6),
(44, 6, 7),
(45, 5, 4),
(45, 5, 5),
(45, 5, 6),
(45, 5, 7),
(46, 8, 4),
(46, 8, 5),
(46, 8, 6),
(46, 8, 7),
(47, 6, 4),
(47, 6, 5),
(47, 6, 6),
(47, 6, 7),
(48, 6, 4),
(48, 6, 5),
(48, 6, 6),
(48, 6, 7),
(49, 8, 4),
(49, 8, 5),
(49, 8, 6),
(49, 8, 7),
(50, 5, 4),
(50, 5, 5),
(50, 5, 6),
(50, 5, 7),
(51, 5, 4),
(51, 5, 5),
(51, 5, 6),
(51, 5, 7),
(52, 6, 4),
(52, 6, 5),
(52, 6, 6),
(52, 6, 7),
(53, 1, 4),
(53, 1, 5),
(53, 1, 6),
(53, 1, 7),
(54, 2, 4),
(54, 2, 5),
(54, 2, 6),
(54, 2, 7),
(55, 3, 4),
(55, 3, 5),
(55, 3, 6),
(55, 3, 7),
(56, 4, 4),
(56, 4, 5),
(56, 4, 6),
(56, 4, 7),
(57, 2, 4),
(57, 2, 5),
(57, 2, 6),
(57, 2, 7),
(58, 4, 4),
(58, 4, 5),
(58, 4, 6),
(58, 4, 7),
(59, 3, 4),
(59, 3, 5),
(59, 3, 6),
(59, 3, 7),
(60, 1, 4),
(60, 1, 5),
(60, 1, 6),
(60, 1, 7),
(61, 3, 4),
(61, 3, 5),
(61, 3, 6),
(61, 3, 7),
(62, 1, 4),
(62, 1, 5),
(62, 1, 6),
(62, 1, 7),
(63, 1, 4),
(63, 1, 5),
(63, 1, 6),
(63, 1, 7),
(64, 2, 4),
(64, 2, 5),
(64, 2, 6),
(64, 2, 7),
(65, 3, 4),
(65, 3, 5),
(65, 3, 6),
(65, 3, 7),
(66, 2, 4),
(66, 2, 5),
(66, 2, 6),
(66, 2, 7),
(67, 3, 4),
(67, 3, 5),
(67, 3, 6),
(67, 3, 7),
(68, 4, 4),
(68, 4, 5),
(68, 4, 6),
(68, 4, 7),
(69, 4, 4),
(69, 4, 5),
(69, 4, 6),
(69, 4, 7),
(70, 4, 4),
(70, 4, 5),
(70, 4, 6),
(70, 4, 7),
(71, 3, 4),
(71, 3, 5),
(71, 3, 6),
(71, 3, 7),
(72, 2, 4),
(72, 2, 5),
(72, 2, 6),
(72, 2, 7),
(73, 7, 4),
(73, 7, 5),
(73, 7, 6),
(73, 7, 7),
(74, 1, 4),
(74, 1, 5),
(74, 1, 6),
(74, 1, 7),
(75, 1, 4),
(75, 1, 5),
(75, 1, 6),
(75, 1, 7),
(76, 2, 4),
(76, 2, 5),
(76, 2, 6),
(76, 2, 7),
(77, 4, 4),
(77, 4, 5),
(77, 4, 6),
(77, 4, 7),
(78, 1, 4),
(78, 1, 5),
(78, 1, 6),
(78, 1, 7),
(79, 2, 4),
(79, 2, 5),
(79, 2, 6),
(79, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `dangky_cnpm`
--

CREATE TABLE IF NOT EXISTS `dangky_cnpm` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `GioDK` datetime DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaLop`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangky_cnpm`
--


-- --------------------------------------------------------

--
-- Table structure for table `dangky_httt`
--

CREATE TABLE IF NOT EXISTS `dangky_httt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `GioDK` datetime DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaLop`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangky_httt`
--


-- --------------------------------------------------------

--
-- Table structure for table `dangky_khmt`
--

CREATE TABLE IF NOT EXISTS `dangky_khmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `GioDK` datetime DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaLop`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangky_khmt`
--


-- --------------------------------------------------------

--
-- Table structure for table `dangky_ktmt`
--

CREATE TABLE IF NOT EXISTS `dangky_ktmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `GioDK` datetime DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaLop`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangky_ktmt`
--

INSERT INTO `dangky_ktmt` (`MaSV`, `MaLop`, `GioDK`) VALUES
('09520032', 'VCPL1.C11', '2012-11-30 23:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `dangky_mmt`
--

CREATE TABLE IF NOT EXISTS `dangky_mmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `GioDK` datetime DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaLop`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangky_mmt`
--

INSERT INTO `dangky_mmt` (`MaSV`, `MaLop`, `GioDK`) VALUES
('09520032', 'NT101.C11', '2013-02-01 09:56:20'),
('09520032', 'NT108.C11', '2013-02-01 09:55:21'),
('09520032', 'PEDU1.C11', '2013-02-01 15:07:36'),
('09520032', 'PHY02.C11', '2013-02-01 14:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `denghi`
--

CREATE TABLE IF NOT EXISTS `denghi` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `GioDK` datetime DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaMH`),
  KEY `MaLop` (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `denghi`
--

INSERT INTO `denghi` (`MaSV`, `MaMH`, `GioDK`) VALUES
('09520032', 'NT106', '2013-02-01 15:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `diem_cnpm`
--

CREATE TABLE IF NOT EXISTS `diem_cnpm` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ID` int(3) NOT NULL,
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diem_cnpm`
--


-- --------------------------------------------------------

--
-- Table structure for table `diem_httt`
--

CREATE TABLE IF NOT EXISTS `diem_httt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ID` int(3) NOT NULL,
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diem_httt`
--


-- --------------------------------------------------------

--
-- Table structure for table `diem_khmt`
--

CREATE TABLE IF NOT EXISTS `diem_khmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ID` int(3) NOT NULL,
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diem_khmt`
--


-- --------------------------------------------------------

--
-- Table structure for table `diem_ktmt`
--

CREATE TABLE IF NOT EXISTS `diem_ktmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ID` int(3) NOT NULL,
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diem_ktmt`
--


-- --------------------------------------------------------

--
-- Table structure for table `diem_mmt`
--

CREATE TABLE IF NOT EXISTS `diem_mmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Diem` int(2) DEFAULT NULL,
  `ID` int(3) NOT NULL,
  PRIMARY KEY (`MaSV`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diem_mmt`
--

INSERT INTO `diem_mmt` (`MaSV`, `Diem`, `ID`) VALUES
('09520001', 6, 1),
('09520001', 3, 5),
('09520001', 7, 13),
('09520001', 6, 17),
('09520001', 5, 18),
('09520001', 4, 24),
('09520001', 6, 71),
('09520001', 6, 76),
('09520001', 4, 77),
('09520001', 6, 78),
('09520002', 6, 24),
('09520032', 8, 43),
('09520032', 4, 45),
('09520032', 5, 50),
('09520032', 8, 51),
('09520032', 4, 57),
('09520032', 7, 59),
('09520032', 8, 65),
('09520032', 8, 66),
('09520032', 6, 67),
('09520032', 7, 71),
('09520032', 5, 76),
('09520032', 6, 77),
('09520032', 6, 79),
('09520044', 7, 42),
('09520044', 4, 43),
('09520044', 4, 45),
('09520044', 5, 50),
('09520044', 6, 51),
('09520044', 7, 57),
('09520044', 6, 59),
('09520044', 4, 61),
('09520044', 6, 65),
('09520044', 5, 66),
('09520044', 5, 67),
('09520044', 5, 71),
('09520044', 6, 76),
('09520044', 3, 77),
('09520044', 7, 79);

-- --------------------------------------------------------

--
-- Table structure for table `dkcn`
--

CREATE TABLE IF NOT EXISTS `dkcn` (
  `MaSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `IDnhom` int(11) NOT NULL,
  `MaLop` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`,`IDnhom`,`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dkcn`
--


-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE IF NOT EXISTS `giaovien` (
  `MaGV` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `TenGV` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SoDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaGV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`MaGV`, `TenGV`, `NgaySinh`, `NoiSinh`, `SoDT`, `email`) VALUES
('GV01', 'Mai Xuân Hùng', '11/01/1985', 'Hà Nội', '0168888991', 'hung@gmail.com'),
('GV02', 'Ngô Hán Chiêu', '', '', '', 'chieung@gmail.com'),
('GV03', 'Tô Nguyễn Nhật Quang', '', '', '', ''),
('GV04', 'Trần Bá Nhiệm', '', '', '', ''),
('GV05', 'Thiều Xuân Khánh', '', '', '', ''),
('GV06', 'Mai Thị Loan', '17/03/1991', '', '', ''),
('GV07', 'Thái Thị Thu Hà', '', '', '', ''),
('GV08', 'Hồ Quang Hiếu', '11/11/1980', 'Vũng Tàu', '0168889991', 'hoquanghieu@gmail.com'),
('GV09', 'Mai Tiến Dũng', '', '', '', ''),
('GV10', 'Lê Tuấn Nam', '17/3/1981', '', '', ''),
('GV11', 'Lê Hồng Nghi', '26/01/1986', '', '', ''),
('GV12', 'Lê Mạnh', '', '', '', ''),
('GV13', 'Vũ Đức Lung', '22/11/1981', '', '', ''),
('GV14', 'Hà Tuấn Nam', '', '', '', ''),
('GV15', 'Trần Mạnh Hùng', '', '', '', ''),
('GV16', 'Nguyễn Trần Minh Khuê', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inphieu`
--

CREATE TABLE IF NOT EXISTS `inphieu` (
  `MaSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SL` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MaSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inphieu`
--

INSERT INTO `inphieu` (`MaSV`, `SL`) VALUES
('09520001', 0),
('09520002', 0),
('09520005', 0),
('09520008', 0),
('09520009', 0),
('09520032', 2),
('09520044', 0);

-- --------------------------------------------------------

--
-- Table structure for table `k`
--

CREATE TABLE IF NOT EXISTS `k` (
  `MaK` int(2) NOT NULL,
  `TenK` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `k`
--

INSERT INTO `k` (`MaK`, `TenK`) VALUES
(4, 'K4 (2009)'),
(5, 'K5 (2010)'),
(6, 'K6 (2011)'),
(7, 'K7 (2012)'),
(8, 'K8(2013)'),
(9, 'K9(2014)'),
(10, 'K10(2015)');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE IF NOT EXISTS `khoa` (
  `MaKhoa` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TenKhoa` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('CNPM', 'Công Nghệ Phần Mềm'),
('HTTT', 'Hệ Thống Thông Tin'),
('KHMT', 'Khoa Học Máy Tính'),
('KTMT', 'Kỹ Thuật Máy Tính'),
('MMT', 'Mạng Máy Tính & Truyền Thông');

-- --------------------------------------------------------

--
-- Table structure for table `loai_monhoc`
--

CREATE TABLE IF NOT EXISTS `loai_monhoc` (
  `STT` int(1) NOT NULL,
  `MaLoai` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TenLoai` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaLoai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loai_monhoc`
--

INSERT INTO `loai_monhoc` (`STT`, `MaLoai`, `TenLoai`) VALUES
(3, 'CN', 'Chuyên Nghành'),
(2, 'CSN', 'Cơ Sở Nghành'),
(1, 'DC', 'Đại Cương'),
(4, 'TC', 'Tự Chọn');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE IF NOT EXISTS `lop` (
  `MaLop` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaGV` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `MaMH` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phong` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Thu` int(1) DEFAULT NULL,
  `Ca` int(1) DEFAULT NULL,
  `Min` int(2) DEFAULT NULL,
  `Max` int(3) DEFAULT NULL,
  `SLHT` int(3) DEFAULT NULL,
  PRIMARY KEY (`MaLop`),
  KEY `FK_lop_mh` (`MaMH`),
  KEY `FK_lop_gv` (`MaGV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`MaLop`, `MaGV`, `MaMH`, `Phong`, `Thu`, `Ca`, `Min`, `Max`, `SLHT`) VALUES
('CARC1.C11', 'GV05', 'CARC1', 'PM', 6, 2, 30, 150, 149),
('DBSS1.C11', 'GV05', 'DBSS1', '102', 2, 3, 6, 7, 8),
('ENG02.C11', 'GV02', 'ENG02', '101', 3, 3, 6, 7, 8),
('ENG02.C122', 'GV02', 'ENG02', '101', 4, 2, 6, 7, 8),
('HCMT1.C11', 'GV05', 'HCMT1', '108', 2, 2, 32, 100, 0),
('ITEM1.C11', 'GV01', 'ITEM1', '308', 6, 3, 6, 7, 8),
('MAT22.C11', 'GV03', 'MAT22', 'PM', 4, 1, 30, 150, 150),
('NT101.C11', 'GV01', 'NT101', '101', 2, 1, 6, 7, 8),
('NT104.C11', 'GV03', 'NT104', '101', 5, 3, 6, 7, 8),
('NT104.C122', 'GV02', 'NT104', '101', 3, 4, 6, 7, 8),
('NT108.C11', 'GV02', 'NT108', '203', 3, 2, 6, 7, 8),
('NT109.C11', 'GV01', 'NT109', '302', 2, 4, 6, 7, 8),
('NT111.C11', 'GV03', 'NT111', '204', 5, 1, 50, 150, 54),
('NT201.C11', 'GV04', 'NT201', '205', 4, 4, 50, 150, 149),
('NT203.C11', 'GV02', 'NT203', '102', 4, 3, 6, 7, 8),
('OSYS1.C11', 'GV03', 'OSYS1', '208', 3, 1, 50, 150, 150),
('PEDU1.C11', 'GV04', 'PEDU1', '102', 5, 3, 6, 7, 8),
('PHY02.C11', 'GV04', 'PHY02', 'PM', 5, 2, 30, 150, 150),
('VCPL1.C11', 'GV05', 'VCPL1', '301', 6, 4, 50, 150, 47);

-- --------------------------------------------------------

--
-- Table structure for table `lophoc`
--

CREATE TABLE IF NOT EXISTS `lophoc` (
  `TenLop` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MaKhoa` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MaK` int(2) NOT NULL,
  PRIMARY KEY (`TenLop`),
  KEY `MaKhoa` (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `lophoc`
--

INSERT INTO `lophoc` (`TenLop`, `MaKhoa`, `MaK`) VALUES
('CNPM01', 'CNPM', 1),
('CNPM02', 'CNPM', 2),
('CNPM03', 'CNPM', 3),
('CNPM04', 'CNPM', 4),
('CNPM05', 'CNPM', 5),
('CNPM06', 'CNPM', 6),
('CNPM07', 'CNPM', 7),
('HTTT01', 'HTTT', 1),
('HTTT02', 'HTTT', 2),
('HTTT03', 'HTTT', 3),
('HTTT04', 'HTTT', 4),
('HTTT05', 'HTTT', 5),
('HTTT06', 'HTTT', 6),
('HTTT07', 'HTTT', 7),
('KHMT01', 'KHMT', 1),
('KHMT02', 'KHMT', 2),
('KHMT03', 'KHMT', 3),
('KHMT04', 'KHMT', 4),
('KHMT05', 'KHMT', 5),
('KHMT06', 'KHMT', 6),
('KHMT07', 'KHMT', 7),
('KTMT01', 'KTMT', 1),
('KTMT02', 'KTMT', 2),
('KTMT03', 'KTMT', 3),
('KTMT04', 'KTMT', 4),
('KTMT05', 'KTMT', 5),
('KTMT06', 'KTMT', 6),
('KTMT07', 'KTMT', 7),
('MMT01', 'MMT', 1),
('MMT02', 'MMT', 2),
('MMT03', 'MMT', 3),
('MMT04', 'MMT', 4),
('MMT05', 'MMT', 5),
('MMT06', 'MMT', 6),
('MMT07', 'MMT', 7);

-- --------------------------------------------------------

--
-- Table structure for table `loplt`
--

CREATE TABLE IF NOT EXISTS `loplt` (
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaGV` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `MaMH` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phong` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Thu` int(1) DEFAULT NULL,
  `Ca` int(1) DEFAULT NULL,
  `Min` int(2) DEFAULT NULL,
  `Max` int(3) DEFAULT NULL,
  `SLHT` int(3) DEFAULT NULL,
  PRIMARY KEY (`MaLop`),
  KEY `FK_lop_mh` (`MaMH`),
  KEY `FK_lop_gv` (`MaGV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loplt`
--

INSERT INTO `loplt` (`MaLop`, `MaGV`, `MaMH`, `Phong`, `Thu`, `Ca`, `Min`, `Max`, `SLHT`) VALUES
('CARC1.C11', 'GV05', 'CARC1', 'PM', 6, 2, 30, 150, 149),
('DBSS1.C11', 'GV05', 'DBSS1', '102', 2, 3, 30, 100, 8),
('ENG02.C11', 'GV02', 'ENG02', '101', 3, 3, 30, 80, 8),
('ENG02.C122', 'GV02', 'ENG02', '101', 4, 2, 20, 70, 8),
('HCMT1.C11', 'GV05', 'HCMT1', '108', 2, 2, 32, 100, 0),
('ITEM1.C11', 'GV01', 'ITEM1', '308', 6, 3, 20, 100, 8),
('MAT22.C11', 'GV03', 'MAT22', 'PM', 4, 1, 30, 150, 100),
('NT101.C11', 'GV01', 'NT101', '101', 2, 1, 20, 70, 9),
('NT103.C11', 'GV04', 'NT103', '102', 2, 1, 30, 100, 0),
('NT103.C12', 'GV04', 'NT103', '101', 2, 2, 30, 100, 0),
('NT104.C11', 'GV03', 'NT104', '101', 5, 3, 20, 120, 8),
('NT104.C122', 'GV02', 'NT104', '101', 6, 1, 30, 120, 8),
('NT105.C13', 'GV01', 'NT105', '102', 2, 2, 30, 100, 14),
('NT108.C11', 'GV02', 'NT108', '203', 5, 2, 15, 70, 9),
('NT109.C11', 'GV01', 'NT109', '302', 2, 4, 20, 70, 8),
('NT111.C11', 'GV03', 'NT111', '204', 5, 1, 50, 150, 54),
('NT201.C11', 'GV04', 'NT201', '205', 4, 4, 50, 150, 149),
('NT203.C11', 'GV02', 'NT203', '102', 4, 3, 20, 100, 8),
('NT301.C11', 'GV11', 'NT301', '101', 3, 1, 30, 100, 0),
('NT301.C12', 'GV11', 'NT301', '101', 3, 2, 30, 100, 0),
('NT303.C11', 'GV08', 'NT303', '102', 3, 1, 30, 100, 0),
('NT303.C12', 'GV05', 'NT303', '101', 3, 4, 30, 100, 0),
('NT305.C11', 'GV10', 'NT305', '103', 2, 1, 30, 100, 0),
('NT307.C11', 'GV09', 'NT307', '101', 2, 3, 30, 100, 0),
('NT401.C11', 'GV02', 'NT401', '104', 2, 1, 30, 100, 0),
('NT402.C11', 'GV07', 'NT402', '102', 6, 1, 30, 100, 1),
('NT403.C11', 'GV03', 'NT403', '101', 4, 3, 30, 100, 0),
('OSYS1.C11', 'GV03', 'OSYS1', '208', 4, 2, 50, 150, 149),
('PEDU1.C11', 'GV04', 'PEDU1', '102', 5, 3, 20, 80, 9),
('PHY02.C11', 'GV04', 'PHY02', 'PM', 5, 2, 30, 150, 150),
('VCPL1.C11', 'GV05', 'VCPL1', '301', 6, 4, 50, 150, 48);

-- --------------------------------------------------------

--
-- Table structure for table `lopth`
--

CREATE TABLE IF NOT EXISTS `lopth` (
  `MaLop` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaGV` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `MaMH` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phong` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Thu` int(1) DEFAULT NULL,
  `Ca` int(1) DEFAULT NULL,
  `Min` int(2) DEFAULT NULL,
  `Max` int(3) DEFAULT NULL,
  `SLHT` int(3) DEFAULT NULL,
  PRIMARY KEY (`MaLop`),
  KEY `FK_lop_mh` (`MaMH`),
  KEY `FK_lop_gv` (`MaGV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lopth`
--

INSERT INTO `lopth` (`MaLop`, `MaGV`, `MaMH`, `Phong`, `Thu`, `Ca`, `Min`, `Max`, `SLHT`) VALUES
('CARC1.C11.1', 'GV05', 'CARC1', 'PM', 5, 2, 30, 150, 149),
('DBSS1.C11.1', 'GV04', 'DBSS1', '102', 3, 3, 6, 7, 8),
('NT401.TH1', 'GV02', 'NT401', '101', 4, 1, 30, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mhtuongduong`
--

CREATE TABLE IF NOT EXISTS `mhtuongduong` (
  `ID_OLD` int(3) NOT NULL,
  `ID_NEW` int(3) NOT NULL,
  PRIMARY KEY (`ID_OLD`,`ID_NEW`),
  KEY `MaMHMoi` (`ID_NEW`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhtuongduong`
--

INSERT INTO `mhtuongduong` (`ID_OLD`, `ID_NEW`) VALUES
(58, 58),
(60, 61);

-- --------------------------------------------------------

--
-- Table structure for table `molop`
--

CREATE TABLE IF NOT EXISTS `molop` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `NgayDK` datetime NOT NULL,
  `MSSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaMH`,`MSSV`),
  KEY `FK_ml_sv` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `molop`
--

INSERT INTO `molop` (`MaMH`, `NgayDK`, `MSSV`) VALUES
('MAT22', '2012-05-29 21:43:15', '09520044');

-- --------------------------------------------------------

--
-- Table structure for table `moncn`
--

CREATE TABLE IF NOT EXISTS `moncn` (
  `ID` int(11) NOT NULL,
  `MaCN` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`MaCN`),
  KEY `MaCN` (`MaCN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moncn`
--

INSERT INTO `moncn` (`ID`, `MaCN`) VALUES
(2, 'CNPM_4_1'),
(26, 'CNPM_4_1'),
(35, 'CNPM_4_1'),
(1, 'CNPM_4_2'),
(12, 'CNPM_4_2'),
(13, 'CNPM_4_2'),
(33, 'CNPM_4_2'),
(26, 'CNPM_6_2'),
(35, 'CNPM_6_2'),
(22, 'MMT_4_1'),
(26, 'MMT_4_1'),
(32, 'MMT_4_1'),
(2, 'MMT_4_2'),
(33, 'MMT_4_2'),
(35, 'MMT_4_2');

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE IF NOT EXISTS `monhoc` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenMH` varchar(62) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SoTC` int(2) DEFAULT NULL,
  `TCLT` int(2) DEFAULT NULL,
  `TCTH` int(2) DEFAULT NULL,
  `Loai` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DC',
  `KieuMH` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DON',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`ID`, `MaMH`, `TenMH`, `SoTC`, `TCLT`, `TCTH`, `Loai`, `KieuMH`) VALUES
(1, 'SE103', 'Các Phương Pháp Lập Trình', 3, 2, 1, 'CN', 'DON'),
(2, 'NT303', 'Công nghệ thoại IP', 3, 2, 1, 'CN', 'DON'),
(3, 'SE323', 'Đồ án 1', 4, 3, 1, 'CN', 'DON'),
(4, 'SE321', 'Đồ án 2', 4, 3, 1, 'CN', 'DON'),
(5, 'SE106', 'Đồ Án môn học', 4, 4, 0, 'CN', 'DON'),
(6, 'NT504', 'Đồ án tốt nghiệp', 4, 0, 4, 'CN', 'DON'),
(7, 'NT30*', 'Học Phần Chuyên Nghành 1', 3, 2, 1, 'CN', 'NHOM'),
(8, 'NT30*', 'Học phần chuyên nghành 2', 3, 2, 1, 'CN', 'NHOM'),
(9, 'NT30*', 'Học phần chuyên nghành 3', 3, 2, 1, 'CN', 'NHOM'),
(10, 'NT505', 'Khóa luận tốt nghiệp', 10, 0, 10, 'CN', 'DON'),
(11, 'SE208', 'Kiểm Chứng Phần Mềm', 3, 2, 1, 'CN', 'DON'),
(12, 'NT306', 'Kỹ thuật lập trình trên Linux', 3, 2, 1, 'CN', 'DON'),
(13, 'SE105', 'Lập Trình Nhúng Căn Bản', 3, 2, 1, 'CN', 'DON'),
(14, 'SE417', 'Mã nguồn mở 1', 2, 2, 0, 'CN', 'DON'),
(15, 'NT502', 'Môn tốt nghiệp 1', 3, 0, 3, 'CN', 'DON'),
(16, 'NT503', 'Môn tốt nghiệp 2', 3, 0, 0, 'CN', 'DON'),
(17, 'SE104', 'Nhập Môn Phần Mềm', 4, 3, 1, 'CN', 'DON'),
(18, 'SE102', 'Nhập môn phát triển game', 3, 2, 1, 'CN', 'DON'),
(19, 'SE207', 'Phân tích thiết kế HT', 4, 3, 1, 'CN', 'DON'),
(20, 'SE211', 'Phát triển phần mềm di động', 4, 3, 1, 'CN', 'DON'),
(21, 'SE212', 'Phát triển phần mềm mã nguồn mở', 3, 2, 1, 'CN', 'DON'),
(22, 'NT305', 'Phát triển ứng dụng di động', 3, 2, 1, 'CN', 'DON'),
(23, 'SE209', 'Phát triển, bảo hành phần mềm', 3, 3, 0, 'CN', 'DON'),
(24, 'SE101', 'Phương pháp mô hình hóa', 3, 3, 0, 'CN', 'DON'),
(25, 'SE210', 'Quản lý dự án', 4, 3, 1, 'CN', 'DON'),
(26, 'NT301', 'Quản trị hệ thống mạng', 3, 2, 1, 'CN', 'DON'),
(27, 'NT501', 'Thực tập doanh nghiệp', 3, 0, 3, 'CN', 'DON'),
(28, 'NT40*', 'Tự chọn 1', 3, 2, 1, 'TC', 'NHOM'),
(29, 'NT40*', 'Tự chọn 2', 3, 2, 1, 'TC', 'NHOM'),
(30, 'NT40*', 'Tự chọn 3', 3, 2, 1, 'TC', 'NHOM'),
(31, 'NT40*', 'Tự chọn 5', 3, 2, 1, 'TC', 'NHOM'),
(32, 'NT307', 'Ứng dụng lập trình web', 3, 2, 1, 'CN', 'DON'),
(33, 'NT304', 'Ứng dụng truyền thông và an ninh thông tin', 3, 2, 1, 'CN', 'DON'),
(34, 'STA01', 'Xác suất thống kê', 3, 3, 0, 'CN', 'DON'),
(35, 'NT302', 'Xây dựng chuẩn chính sách', 3, 2, 1, 'CN', 'DON'),
(36, 'SE213', 'Xử lý phân bố', 3, 2, 1, 'CN', 'DON'),
(37, 'NT101', 'An Toàn Mạng Máy Tính', 4, 3, 1, 'CSN', 'DON'),
(38, 'NT112', 'Công Nghệ Mạng Viễn Thông', 4, 3, 1, 'CSN', 'DON'),
(39, 'NT102', 'Điện Tử Trong Công Nghệ Thông Tin', 4, 3, 1, 'CSN', 'DON'),
(40, 'NT203', 'Đồ Án Chuyên Nghành', 2, 0, 2, 'CSN', 'DON'),
(41, 'NT202', 'Đồ Án Lập Trình Ứng Dụng Mạng', 2, 0, 2, 'CSN', 'DON'),
(42, 'NT103', 'Hệ Điều Hành Linux', 4, 3, 1, 'CSN', 'DON'),
(43, 'NT106', 'Lập Trình Mạng Căn Bản', 3, 2, 1, 'CSN', 'DON'),
(44, 'NT109', 'Lập Trình Ứng Dụng Mạng', 3, 2, 1, 'CSN', 'DON'),
(45, 'NT104', 'Lý Thuyết Thông Tin', 3, 3, 0, 'CSN', 'DON'),
(46, 'NT108', 'Mạng Truyền Thông & Di Động', 3, 2, 1, 'CSN', 'DON'),
(47, 'NT201', 'Phân tích và thiết kế hệ thống', 3, 3, 0, 'CSN', 'DON'),
(48, 'NT111', 'Thiết Bị Mạng và Truyền Thông', 4, 3, 1, 'CSN', 'DON'),
(49, 'NT113', 'Thiết kế mạng', 3, 2, 1, 'CSN', 'DON'),
(50, 'NT110', 'Tín hiệu & Mạch', 3, 3, 0, 'CSN', 'DON'),
(51, 'NT105', 'Truyền Dữ Liệu', 4, 3, 1, 'CSN', 'DON'),
(52, 'NT107', 'Xử Lý Tín Hiệu Số', 4, 3, 1, 'CSN', 'DON'),
(53, 'ENG01', 'Anh văn 1', 5, 5, 0, 'DC', 'DON'),
(54, 'ENG02', 'Anh văn 2', 5, 5, 0, 'DC', 'DON'),
(55, 'ENG03', 'Anh văn 3', 2, 3, 0, 'DC', 'DON'),
(56, 'ENG04', 'Anh văn 4', 3, 3, 0, 'DC', 'DON'),
(57, 'DSAL1', 'Cấu trúc dữ liệu và giải thuật', 3, 3, 0, 'DC', 'DON'),
(58, 'MAT04', 'Cấu Trúc Rời Rạc', 4, 3, 1, 'DC', 'DON'),
(59, 'DBSS1', 'Cơ sở dữ liệu', 4, 4, 0, 'DC', 'DON'),
(60, 'LIA01', 'Đại Số Tuyến Tính', 3, 3, 0, 'DC', 'DON'),
(61, 'VCPL1', 'Đường Lối Đảng Cộng Sản Việt Nam', 3, 3, 0, 'DC', 'DON'),
(62, 'MEDU1', 'Giáo Dục Quốc Phòng', 4, 4, 0, 'DC', 'DON'),
(63, 'PEDU1', 'Giáo Dục Thể Chất 1', 5, 0, 5, 'DC', 'DON'),
(64, 'PEDU2', 'Giáo Dục Thể Chất 2', 5, 0, 5, 'DC', 'DON'),
(65, 'OSYS1', 'Hệ điều hành', 4, 3, 1, 'DC', 'DON'),
(66, 'CARC1', 'Kiến trúc máy tính', 3, 3, 0, 'DC', 'DON'),
(67, 'OOPT1', 'Lập Trình Hướng Đối Tượng', 4, 3, 1, 'DC', 'DON'),
(68, 'WINP1', 'Lập Trình Windows', 4, 3, 1, 'DC', 'DON'),
(69, 'CNET1', 'Mạng Máy Tính', 4, 4, 0, 'DC', 'DON'),
(70, 'ITEW1', 'Nhập môn công tác kỹ sư', 2, 2, 0, 'DC', 'DON'),
(71, 'ITEM1', 'Nhập môn quảng trị doanh nghiệp', 2, 2, 0, 'DC', 'DON'),
(72, 'PHIL2', 'Những Nguyên Lý Cơ Bản Mac-Lenin', 5, 5, 0, 'DC', 'DON'),
(73, 'SMET1', 'Phương pháp luận sáng tạo', 2, 2, 0, 'DC', 'DON'),
(74, 'CSC21', 'Tin học đại cương', 4, 3, 1, 'DC', 'DON'),
(75, 'MAT21', 'Toán cao cấp A1', 3, 3, 0, 'DC', 'DON'),
(76, 'MAT22', 'Toán cao cấp A2', 3, 3, 0, 'DC', 'DON'),
(77, 'HCMT1', 'Tư tưởng hồ chí minh', 2, 2, 0, 'DC', 'DON'),
(78, 'PHY01', 'Vật lý đại cương A1', 3, 3, 0, 'DC', 'DON'),
(79, 'PHY02', 'Vật lý đại cương A2', 3, 3, 0, 'DC', 'DON'),
(83, 'NT401', 'An toàn mạng nâng cao', 3, 2, 1, 'TC', 'DON'),
(84, 'NT406', 'Hệ thống thời gian thực', 3, 2, 1, 'TC', 'DON'),
(85, 'NT402', 'Thiết kế phần mềm diệt virus', 3, 2, 1, 'TC', 'DON'),
(86, 'NT403', 'Tính toán lưới', 3, 2, 1, 'TC', 'DON'),
(87, 'NT405', 'Truyền thông quang', 3, 2, 1, 'TC', 'DON'),
(88, 'NT404', 'Truyền thông vệ tin', 3, 2, 1, 'TC', 'DON');

-- --------------------------------------------------------

--
-- Table structure for table `monhoc_nhom`
--

CREATE TABLE IF NOT EXISTS `monhoc_nhom` (
  `ID` int(3) NOT NULL,
  `MaNhom` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`MaNhom`),
  KEY `MaNhom` (`MaNhom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monhoc_nhom`
--

INSERT INTO `monhoc_nhom` (`ID`, `MaNhom`) VALUES
(2, 'NT30*'),
(12, 'NT30*'),
(22, 'NT30*'),
(26, 'NT30*'),
(32, 'NT30*'),
(33, 'NT30*'),
(35, 'NT30*'),
(2, 'NT40*'),
(12, 'NT40*'),
(22, 'NT40*'),
(26, 'NT40*'),
(32, 'NT40*'),
(33, 'NT40*'),
(35, 'NT40*'),
(83, 'NT40*'),
(84, 'NT40*'),
(85, 'NT40*'),
(86, 'NT40*'),
(87, 'NT40*'),
(88, 'NT40*'),
(6, 'NT50*'),
(10, 'NT50*'),
(15, 'NT50*'),
(16, 'NT50*');

-- --------------------------------------------------------

--
-- Table structure for table `monhoc_nhom_info`
--

CREATE TABLE IF NOT EXISTS `monhoc_nhom_info` (
  `MaNhom` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TenNhom` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaNhom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monhoc_nhom_info`
--

INSERT INTO `monhoc_nhom_info` (`MaNhom`, `TenNhom`) VALUES
('NT30*', 'Nhóm chuyên nghành khoa MMT'),
('NT40*', 'Nhóm tự chọn khoa MMT'),
('NT50*', 'Khóa Luận');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE IF NOT EXISTS `phong` (
  `TenPhong` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TenPhong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`TenPhong`) VALUES
('101'),
('102'),
('103'),
('104'),
('105'),
('106'),
('107'),
('108'),
('201'),
('202'),
('203'),
('204'),
('205'),
('206'),
('207'),
('208'),
('301'),
('302'),
('303'),
('304'),
('305'),
('306'),
('307'),
('308'),
('PM1'),
('PM2');

-- --------------------------------------------------------

--
-- Table structure for table `sv_cnpm`
--

CREATE TABLE IF NOT EXISTS `sv_cnpm` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenSV` varchar(27) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lop` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `K` int(2) NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `MaCN` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_cnpm`
--

INSERT INTO `sv_cnpm` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`, `MaCN`) VALUES
('08520005', 'Thái Thu Thủy', 'CNPM05', 5, '10/12/1990', 'Vũng Tàu', '271899100', '', ''),
('08520221', 'Phan Thiên Quốc', 'CNPM03', 4, '*', '*', '491881111', '', ''),
('08520234', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '*', '', ''),
('08520235', 'Phan Thiên Quốc', 'CNPM04', 4, '*', 'Vinh', '009113313', '', ''),
('08520462', 'Trương Hoàng An', 'CNPM04', 4, '*', '*', '900881134', '', ''),
('09520008', 'Quách Minh', 'CNPM04', 4, '', 'Đồng Nai', '', '', ''),
('09520035', 'Mai Tiến Hoài', 'CNPM02', 4, '18/02/1989', 'Khánh Hòa', '288179919', '', ''),
('09520234', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '*', '', ''),
('10520221', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '987777113', '', ''),
('10520234', 'Phan Quốc Vinh', 'CNPM04', 4, '*', '*', '991922415', '', ''),
('10520235', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '*', '', ''),
('11520221', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '*', '', ''),
('11520235', 'Phan Mạnh Tiến', 'CNPM04', 4, '*', '*', '271999411', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sv_httt`
--

CREATE TABLE IF NOT EXISTS `sv_httt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenSV` varchar(27) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lop` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `K` int(2) NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `MaCN` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_httt`
--

INSERT INTO `sv_httt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`, `MaCN`) VALUES
('09520045', 'Hà Tú Anh', 'HTTT04', 4, '*', '*', '01699938918', '', '0'),
('09520048', 'Đồng Minh', 'HTTT03', 1, '', '', '', '', '0'),
('09520113', 'Hà Minh', 'HTTT04', 1, '', '', '', '', '0'),
('09520460', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('09520462', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('09520478', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('10520460', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('10520462', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('10520478', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('11520460', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', '', '0'),
('11520462', 'Trương Hoàng An', 'HTTT04', 5, '*', '*', '881922144', '', '0'),
('11520478', 'Trương Hoàng An', 'HTTT04', 4, '*', '*3', '818811243', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sv_khmt`
--

CREATE TABLE IF NOT EXISTS `sv_khmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenSV` varchar(27) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lop` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `K` int(2) NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `MaCN` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_khmt`
--

INSERT INTO `sv_khmt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`, `MaCN`) VALUES
('08520004', 'Đinh Tiến Đạt', 'KHMT04', 4, '20/10/2010', 'Nha Trang', '0990113422', 'rinodung.uit@gmail.com', ''),
('08520031', 'Nguyên Phúc', 'KHMT04', 4, '27/02/1986', 'Đồng Nai', '271918441', '', ''),
('08520047', 'Minh Trí', 'KHMT04', 4, '', '', '', '', ''),
('08520055', 'Nguyễn Văn Ninh', 'KHMT04', 4, '18/08/1992', 'Bình Dương', '222288181', '', ''),
('08520056', 'Nguyễn Văn AB', 'KHMT04', 4, '12/01/1992', 'Hà Nam', '261556445', '', ''),
('08524566', 'Nguyễn Văn Bình', 'KHMT04', 4, '20/02/1881', 'Bình Thuận', '888122134', '', ''),
('09520005', 'Hải Hưng ', 'KHMT04', 4, '', '', '', 'abc.uit@gmail.com', ''),
('09520052', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('09520055', 'Nguyễn Văn A', 'KHMT01', 4, '*', '*', '281991441', '', ''),
('09520056', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('10520052', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('10520055', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('10520056', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('11520052', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('11520055', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', ''),
('11520056', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sv_ktmt`
--

CREATE TABLE IF NOT EXISTS `sv_ktmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenSV` varchar(27) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lop` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `K` int(2) NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `MaCN` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_ktmt`
--

INSERT INTO `sv_ktmt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`, `MaCN`) VALUES
('08520001', 'Lê Quốc Bảo', 'KTMT04', 4, '29/2/2000', 'Hà Tĩnh', '881228991', '', ''),
('08520112', 'Âu Đình Phong', 'KTMT04', 4, '*', 'Hải Phòng', '727112994', '', ''),
('08520115', 'Hải Hùng', 'KTMT04', 4, '', 'Nha Trang', '991221218', '', ''),
('08520211', 'Lê Quốc B', 'KTMT04', 4, '29/2/2000', 'Hà Tĩnh', '881228991', '', ''),
('08520460', 'Trương Hoàng An', 'KTMT04', 4, '*', '*', '098113441', '', ''),
('09520111', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '016888388', '', ''),
('09520112', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('09520115', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('10520111', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('10520112', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('10520115', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('11520111', 'Hà Bảo Nam', 'KTMT04', 6, '*', '*', '271953112', '', ''),
('11520112', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('11520115', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', ''),
('11520215', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sv_mmt`
--

CREATE TABLE IF NOT EXISTS `sv_mmt` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenSV` varchar(27) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lop` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `K` int(2) NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `MaCN` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_mmt`
--

INSERT INTO `sv_mmt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`, `MaCN`) VALUES
('09520032', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '0121113331', '', ''),
('09520044', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '01699938919', '', ''),
('09520221', 'Phan Thiên Quốc', 'MMT04', 4, '*', '*', '271881331', '', ''),
('10520002', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', '', ''),
('10520003', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', '', ''),
('10520011', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', '', ''),
('10520032', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', '', ''),
('10520033', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', '', ''),
('10520040', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '*', '', ''),
('10520041', 'Nguyễn Quý Danh2', 'MMT04', 4, '*', '*', '*', '', ''),
('10520045', 'Hồ Hoài Anh', 'MMT04', 4, '*', '*', '*', '', ''),
('10520130', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', '', ''),
('10520131', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', '', ''),
('10520137', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '0', 'rinodung.uit@gmail.com', ''),
('11520001', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', '', ''),
('11520002', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', '', ''),
('11520011', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', '', ''),
('11520033', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', '', ''),
('11520040', 'Đồng Tiến Dũng', 'MMT04', 5, '*', '*', '311129913', '', ''),
('11520041', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', '', ''),
('11520044', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '*', '', ''),
('11520045', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '*', '', ''),
('11520130', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', '', ''),
('11520132', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE IF NOT EXISTS `taikhoan` (
  `Username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Khoa` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `MXT` int(11) NOT NULL,
  `Status` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`Username`, `Password`, `Khoa`, `MXT`, `Status`) VALUES
('09520032', 'e10adc3949ba59abbe56e057f20f883e', 'mmt', 0, '1'),
('09520044', 'e10adc3949ba59abbe56e057f20f883e', 'mmt', 0, '1'),
('admin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '1'),
('admin', 'e10adc3949ba59abbe56e057f20f883e', '', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `thongbao`
--

CREATE TABLE IF NOT EXISTS `thongbao` (
  `id` int(1) NOT NULL DEFAULT '0',
  `title` varchar(93) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `content` varchar(404) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attach` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thongbao`
--

INSERT INTO `thongbao` (`id`, `title`, `date`, `content`, `attach`) VALUES
(1, 'Thông báo lịch thi và danh sách phòng thi HK(2011-2012)', '2012-03-01 00:00:00', 'Dựa vào kế hoạch học tập của trường Đại Học Công Nghệ Thông. Nay Phòng Đào Tạo chính thức đưa ra lịch thi và danh sách phòng thi Học Kỳ 2(2011-2012).\nĐề nghị sinh viên theo dõi và thực thi, tránh những trường hợp đáng tiếc.\nThông tin chi tiết có trong tập tin đính kèm.', ''),
(2, 'Thông Báo Mở Lớp:CARC1.C27', '2012-04-01 12:36:40', 'PDT thông báo Lớp:CARC1.C27 bắt đầu học ngày 12/04/2012 tại lầu 1 toà nhà mới của trường (sáng thứ 5).\nĐồng thời sinh viên xem danh sách lớp học trong tập tin đính kèm ', ''),
(3, 'Thông báo đóng tiền các môn học chính trị.', '2012-04-04 11:33:00', 'Trung tâm lý luận Chính trị - ĐHQGHCM thông báo:Các sinh viên khóa 1 và khóa 2 học lại các môn chính trị yêu cầu hoàn tất học phí  đầy đủ trước khi dự thi.\nĐịa điểm đóng học phí: phòng 707 -  Nhà Điều hành ĐHQG HCM', ''),
(4, 'Lich học lớp Bổ túc kiến thức năm 2012', '2012-04-26 12:36:40', 'Nhà trường thông báo đến các anh/chị đăng ký học Ôn lớp Bổ túc kiến thức lịch học năm 2012.\nRất mong các anh chị sắp xếp, tham dự lớp học đầy đủ.Phòng Đào tạo SĐH,KHCN&QHĐN.', 'danh sach on tap.xls');

-- --------------------------------------------------------

--
-- Table structure for table `thu`
--

CREATE TABLE IF NOT EXISTS `thu` (
  `TenThu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thu`
--

INSERT INTO `thu` (`TenThu`) VALUES
(2),
(3),
(4),
(5),
(6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ctdt`
--
ALTER TABLE `ctdt`
  ADD CONSTRAINT `ctdt_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctdt_ibfk_2` FOREIGN KEY (`MaK`) REFERENCES `k` (`MaK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ctdt_cnpm`
--
ALTER TABLE `ctdt_cnpm`
  ADD CONSTRAINT `ctdt_cnpm_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ctdt_httt`
--
ALTER TABLE `ctdt_httt`
  ADD CONSTRAINT `ctdt_httt_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ctdt_khmt`
--
ALTER TABLE `ctdt_khmt`
  ADD CONSTRAINT `ctdt_khmt_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ctdt_mmt`
--
ALTER TABLE `ctdt_mmt`
  ADD CONSTRAINT `ctdt_mmt_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dangky_mmt`
--
ALTER TABLE `dangky_mmt`
  ADD CONSTRAINT `dangky_mmt_ibfk_2` FOREIGN KEY (`MaSV`) REFERENCES `sv_mmt` (`MaSV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lophoc`
--
ALTER TABLE `lophoc`
  ADD CONSTRAINT `lophoc_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhtuongduong`
--
ALTER TABLE `mhtuongduong`
  ADD CONSTRAINT `mhtuongduong_ibfk_2` FOREIGN KEY (`ID_NEW`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhtuongduong_ibfk_1` FOREIGN KEY (`ID_OLD`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moncn`
--
ALTER TABLE `moncn`
  ADD CONSTRAINT `moncn_ibfk_1` FOREIGN KEY (`MaCN`) REFERENCES `chuyennganh` (`MaCN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monhoc_nhom`
--
ALTER TABLE `monhoc_nhom`
  ADD CONSTRAINT `monhoc_nhom_ibfk_1` FOREIGN KEY (`MaNhom`) REFERENCES `monhoc_nhom_info` (`MaNhom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monhoc_nhom_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `monhoc` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sv_mmt`
--
ALTER TABLE `sv_mmt`
  ADD CONSTRAINT `sv_mmt_ibfk_1` FOREIGN KEY (`K`) REFERENCES `k` (`MaK`) ON DELETE CASCADE ON UPDATE CASCADE;
