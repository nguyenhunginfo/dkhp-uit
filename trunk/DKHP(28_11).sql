-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2012 at 10:33 AM
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
-- Table structure for table `ctdt_cnpm`
--

CREATE TABLE IF NOT EXISTS `ctdt_cnpm` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `HK` int(1) DEFAULT NULL,
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_cnpm`
--

INSERT INTO `ctdt_cnpm` (`MaMH`, `HK`) VALUES
('CARC1', 2),
('CNET1', 4),
('CSC21', 1),
('DBSS1', 3),
('DSAL1', 2),
('ENG01', 1),
('ENG02', 2),
('ENG03', 3),
('ENG04', 4),
('HCMT1', 4),
('ITEM1', 3),
('ITEW1', 4),
('LIA01', 1),
('MAT04', 4),
('MAT21', 1),
('MAT22', 2),
('MEDU1', 1),
('OOPT1', 3),
('OSYS1', 3),
('PEDU1', 1),
('PEDU2', 2),
('PHIL2', 2),
('PHY01', 1),
('PHY02', 2),
('SE101', 5),
('SE102', 5),
('SE103', 5),
('SE104', 5),
('SE105', 5),
('SE106', 6),
('SE207', 6),
('SE208', 6),
('SE209', 6),
('SE210', 7),
('SE211', 7),
('SE212', 7),
('SE213', 7),
('SE31*', 6),
('SE32*', 7),
('SE417', 7),
('STA01', 5),
('VCPL1', 3),
('WINP1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_httt`
--

CREATE TABLE IF NOT EXISTS `ctdt_httt` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `HK` int(1) DEFAULT NULL,
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_httt`
--

INSERT INTO `ctdt_httt` (`MaMH`, `HK`) VALUES
('CARC1', 2),
('CNET1', 4),
('CSC21', 1),
('DBSS1', 3),
('DSAL1', 2),
('ENG01', 1),
('ENG02', 2),
('ENG03', 3),
('ENG04', 4),
('HCMT1', 4),
('ITEM1', 3),
('ITEW1', 4),
('LIA01', 1),
('MAT04', 4),
('MAT21', 1),
('MAT22', 2),
('MEDU1', 1),
('OOPT1', 3),
('OSYS1', 3),
('PEDU1', 1),
('PEDU2', 2),
('PHIL2', 2),
('PHY01', 1),
('PHY02', 2),
('VCPL1', 3),
('WINP1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_khmt`
--

CREATE TABLE IF NOT EXISTS `ctdt_khmt` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `HK` int(1) DEFAULT NULL,
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_khmt`
--

INSERT INTO `ctdt_khmt` (`MaMH`, `HK`) VALUES
('CARC1', 2),
('CNET1', 4),
('CSC21', 1),
('DBSS1', 3),
('DSAL1', 2),
('ENG01', 1),
('ENG02', 2),
('ENG03', 3),
('ENG04', 4),
('HCMT1', 4),
('ITEM1', 3),
('ITEW1', 4),
('LIA01', 1),
('MAT04', 4),
('MAT21', 1),
('MAT22', 2),
('MEDU1', 1),
('OOPT1', 3),
('OSYS1', 3),
('PEDU1', 1),
('PEDU2', 2),
('PHIL2', 2),
('PHY01', 1),
('PHY02', 2),
('VCPL1', 3),
('WINP1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_ktmt`
--

CREATE TABLE IF NOT EXISTS `ctdt_ktmt` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `HK` int(1) DEFAULT NULL,
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_ktmt`
--

INSERT INTO `ctdt_ktmt` (`MaMH`, `HK`) VALUES
('CARC1', 2),
('CNET1', 4),
('CSC21', 1),
('DBSS1', 3),
('DSAL1', 2),
('ENG01', 1),
('ENG02', 2),
('ENG03', 3),
('ENG04', 4),
('HCMT1', 4),
('ITEM1', 3),
('ITEW1', 4),
('LIA01', 1),
('MAT04', 4),
('MAT21', 1),
('MAT22', 2),
('MEDU1', 1),
('OOPT1', 3),
('OSYS1', 3),
('PEDU1', 1),
('PEDU2', 2),
('PHIL2', 2),
('PHY01', 1),
('PHY02', 2),
('VCPL1', 3),
('WINP1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_mmt`
--

CREATE TABLE IF NOT EXISTS `ctdt_mmt` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `HK` int(1) DEFAULT NULL,
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ctdt_mmt`
--

INSERT INTO `ctdt_mmt` (`MaMH`, `HK`) VALUES
('CARC1', 2),
('CNET1', 4),
('CSC21', 1),
('DBSS1', 3),
('DSAL1', 2),
('ENG01', 1),
('ENG02', 2),
('ENG03', 3),
('ENG04', 4),
('HCMT1', 4),
('ITEM1', 3),
('ITEW1', 4),
('LIA01', 1),
('MAT04', 4),
('MAT21', 1),
('MAT22', 2),
('MEDU1', 1),
('NT101', 7),
('NT102', 6),
('NT103', 5),
('NT104', 5),
('NT105', 5),
('NT106', 5),
('NT107', 6),
('NT108', 8),
('NT109', 6),
('NT110', 5),
('NT111', 6),
('NT112', 7),
('NT113', 8),
('NT201', 6),
('NT202', 7),
('NT203', 8),
('NT301', 7),
('NT302', 8),
('NT40', 8),
('NT501', 8),
('NT502', 9),
('NT503', 9),
('NT504', 9),
('NT505', 9),
('OOPT1', 3),
('OSYS1', 3),
('PEDU1', 1),
('PEDU2', 2),
('PHIL2', 2),
('PHY01', 1),
('PHY02', 2),
('SMET2', 7),
('VCPL1', 3),
('WINP1', 4);

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
('09520032', 'CARC1.C11', '2012-11-21 21:44:07'),
('09520032', 'CSDL.C11', '2012-11-26 20:52:12'),
('09520032', 'NT102.C11', '2012-11-21 21:44:07'),
('09520032', 'NT201.C11', '2012-11-21 21:44:07'),
('09520032', 'THDC.C11', '2012-11-21 21:44:07'),
('09520032', 'THDC.TH1', '2012-11-21 21:44:07'),
('09520032', 'VCPL1.C11', '2012-11-21 21:44:07'),
('09520034', 'CARC1.C11', '2012-11-21 21:44:07'),
('09520034', 'NT102.C11', '2012-11-21 21:44:07'),
('09520034', 'NT201.C11', '2012-11-21 21:44:07'),
('09520034', 'THDC.C11', '2012-11-21 21:44:07'),
('09520034', 'THDC.TH1', '2012-11-21 21:44:07'),
('09520034', 'VCPL1.C11', '2012-11-21 21:44:07'),
('09520036', 'CARC1.C11', '2012-11-21 21:44:07'),
('09520036', 'NT102.C11', '2012-11-21 21:44:07'),
('09520036', 'NT201.C11', '2012-11-21 21:44:07'),
('09520036', 'THDC.C11', '2012-11-21 21:44:07'),
('09520036', 'THDC.TH1', '2012-11-21 21:44:07'),
('09520036', 'VCPL1.C11', '2012-11-21 21:44:07');

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


-- --------------------------------------------------------

--
-- Table structure for table `diem_cnpm`
--

CREATE TABLE IF NOT EXISTS `diem_cnpm` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaMH`)
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
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaMH`)
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
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaMH`)
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
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaMH`)
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
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Diem` int(2) DEFAULT NULL,
  PRIMARY KEY (`MaSV`,`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diem_mmt`
--

INSERT INTO `diem_mmt` (`MaSV`, `MaMH`, `Diem`) VALUES
('09520001', 'HCMT1', 4),
('09520001', 'ITEM1', 6),
('09520001', 'MAT22', 6),
('09520001', 'PHY01', 6),
('09520001', 'SE101', 4),
('09520001', 'SE102', 5),
('09520001', 'SE103', 6),
('09520001', 'SE104', 6),
('09520001', 'SE105', 7),
('09520001', 'SE106', 3),
('09520002', 'SE101', 6),
('09520032', 'CARC1', 8),
('09520032', 'DBSS1', 7),
('09520032', 'DSAL1', 4),
('09520032', 'HCMT1', 6),
('09520032', 'ITEM1', 7),
('09520032', 'MAT22', 5),
('09520032', 'NT104', 4),
('09520032', 'NT105', 8),
('09520032', 'NT106', 8),
('09520032', 'NT110', 5),
('09520032', 'OOPT1', 6),
('09520032', 'OSYS1', 8),
('09520032', 'PHY02', 6),
('09520044', 'CARC1', 5),
('09520044', 'DBSS1', 6),
('09520044', 'DSAL1', 7),
('09520044', 'HCMT1', 3),
('09520044', 'ITEM1', 5),
('09520044', 'MAT22', 6),
('09520044', 'NT103', 7),
('09520044', 'NT104', 4),
('09520044', 'NT105', 6),
('09520044', 'NT106', 4),
('09520044', 'NT110', 5),
('09520044', 'OOPT1', 5),
('09520044', 'OSYS1', 6),
('09520044', 'PHY02', 7),
('09520044', 'VCPL1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE IF NOT EXISTS `giaovien` (
  `MaGV` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `TenGV` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaGV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`MaGV`, `TenGV`) VALUES
('GV01', 'Mai Xuân Hùng'),
('GV02', 'Ngô Hán Chiêu'),
('GV03', 'Tô Nguyễn Nhật Quang'),
('GV04', 'Trần Bá Nhiệm'),
('GV05', 'Thiều Xuân Khánh'),
('GV06', 'Mai Thị Loan'),
('GV07', 'Thái Thị Thu Hà');

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
(7, 'K7 (2012)');

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
('CNPM04', 'CNPM', 4),
('CNPM05', 'CNPM', 5),
('CNPM06', 'CNPM', 6),
('CNPM07', 'CNPM', 7),
('HTTT04', 'HTTT', 4),
('HTTT05', 'HTTT', 5),
('HTTT06', 'HTTT', 6),
('HTTT07', 'HTTT', 7),
('KHMT04', 'KHMT', 4),
('KHMT05', 'KHMT', 5),
('KHMT06', 'KHMT', 6),
('KHMT07', 'KHMT', 7),
('KTMT04', 'KTMT', 4),
('KTMT05', 'KTMT', 5),
('KTMT06', 'KTMT', 6),
('KTMT07', 'KTMT', 7),
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
('ATMMT.C11', 'GV04', 'NT101', '102', 2, 1, 30, 100, 0),
('ATMMT.C12', 'GV03', 'NT101', '101', 6, 1, 30, 100, 0),
('CARC1.C11', 'GV05', 'CARC1', '308', 6, 2, 30, 150, 150),
('CSDL.C11', 'GV01', 'DBSS1', '101', 6, 2, 30, 100, 1),
('DBSS1.C11', 'GV05', 'DBSS1', '208', 3, 1, 6, 70, 8),
('ENG.C11', 'GV07', 'ENG01', '102', 2, 3, 30, 100, 0),
('ENG02.C11', 'GV01', 'ENG02', 'PM2', 4, 2, 6, 70, 8),
('ENG02.C122', 'GV05', 'ENG02', '101', 4, 2, 6, 70, 9),
('HCM.C11', 'GV07', 'HCMT1', '103', 2, 2, 30, 100, 0),
('HCMT1.C11', 'GV05', 'HCMT1', '108', 2, 2, 32, 100, 1),
('ITEM1.C11', 'GV02', 'ITEM1', '308', 3, 1, 6, 70, 8),
('KTMT.C11', 'GV01', 'CARC1', '101', 2, 1, 10, 20, 1),
('KTMT.C12', 'GV01', 'CARC1', '102', 3, 2, 30, 100, 0),
('MAT22.C11', 'GV02', 'MAT22', 'PM1', 5, 3, 30, 150, 150),
('NMCTKS.C11', 'GV01', 'ITEW1', '101', 3, 3, 30, 100, 1),
('NT101.C11', 'GV02', 'NT101', '101', 5, 2, 6, 70, 9),
('NT102.C11', 'GV03', 'NT108', '203', 3, 2, 6, 70, 9),
('NT104.C11', 'GV03', 'NT104', '101', 5, 4, 6, 70, 9),
('NT104.C122', 'GV02', 'NT104', '101', 3, 4, 6, 70, 8),
('NT109.C11', 'GV03', 'NT109', '302', 5, 3, 6, 5, 8),
('NT111.C11', 'GV07', 'NT111', '205', 6, 3, 50, 150, 54),
('NT201.C11', 'GV04', 'NT201', '102', 4, 2, 50, 150, 150),
('OSYS1.C11', 'GV06', 'OSYS1', '307', 6, 2, 50, 150, 150),
('PEDU1.C11', 'GV04', 'PEDU1', '102', 5, 3, 6, 70, 9),
('PHY02.C11', 'GV04', 'PHY02', 'PM1', 5, 2, 30, 150, 150),
('THDC.C11', 'GV01', 'CSC21', '101', 4, 1, 30, 100, 1),
('THDC.C13', 'GV01', 'CSC21', '101', 4, 3, 30, 100, 0),
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
('DAUDM.TH1', 'GV05', 'NT202', '105', 4, 3, 30, 100, 0),
('DAUDM.TH2', 'GV04', 'NT202', '104', 6, 3, 30, 100, 0),
('DTS.C11', 'GV02', 'NT102', '102', 4, 1, 30, 100, 0),
('DTS.C12', 'GV01', 'NT102', '101', 4, 4, 30, 100, 0),
('ENG03.C11', 'GV06', 'ENG03', '308', 4, 1, 20, 100, 0),
('GAME.C11', 'GV04', 'SE102', '102', 5, 1, 30, 100, 0),
('LINUX.TH1', 'GV06', 'NT103', '103', 3, 3, 30, 100, 0),
('LINUX.TH2', 'GV03', 'NT103', '105', 3, 3, 30, 100, 0),
('LTMCB.TH1', 'GV06', 'NT106', '102', 6, 1, 30, 100, 0),
('LTMCB.TH2', 'GV07', 'NT106', '103', 2, 4, 30, 100, 0),
('MAT.C11', 'GV01', 'MAT21', '101', 5, 1, 10, 100, 0),
('THDC.TH1', 'GV01', 'CSC21', '101', 3, 1, 20, 60, 1),
('THDC.TH2', 'GV01', 'CSC21', '203', 6, 1, 50, 100, 0),
('XLTHS.TH1', 'GV06', 'NT107', '103', 4, 4, 30, 100, 0),
('XLTHS.TH2', 'GV07', 'NT107', '102', 3, 4, 30, 100, 0);

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


-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE IF NOT EXISTS `monhoc` (
  `MaMH` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenMH` varchar(62) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoTC` int(2) DEFAULT NULL,
  `TCLT` int(1) DEFAULT NULL,
  `TCTH` int(1) DEFAULT NULL,
  `Loai` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DC',
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`MaMH`, `TenMH`, `SoTC`, `TCLT`, `TCTH`, `Loai`) VALUES
('CARC1', 'Kiến trúc máy tính', 3, 3, 0, 'CN'),
('CNET1', 'Quản trị hệ thống mạng', 4, 4, 0, 'CN'),
('CSC21', 'Tin học đại cương', 4, 3, 1, 'DC'),
('DBSS1', 'Cơ sở dữ liệu', 4, 4, 0, 'DC'),
('DSAL1', 'Cấu trúc dữ liệu và giải thuật', 3, 3, 0, 'DC'),
('ENG01', 'Anh văn 1', 5, 5, 0, 'DC'),
('ENG02', 'Anh văn 2', 5, 5, 0, 'DC'),
('ENG03', 'Anh văn 3', 2, 3, 0, 'DC'),
('ENG04', 'Anh văn 4', 3, 3, 0, 'DC'),
('HCMT1', 'Tư tưởng hồ chí minh', 2, 2, 0, 'DC'),
('ITEM1', 'Nhập Môn Quản Trị Doanh Nghiệp', 2, 2, 0, 'DC'),
('ITEW1', 'Nhập Môn Công Tác Kỹ Sư', 2, 2, 0, 'DC'),
('LIA01', 'Đại Số Tuyến Tính', 3, 3, 0, 'DC'),
('MAT04', 'Cấu Trúc Rời Rạc', 4, 3, 1, 'DC'),
('MAT21', 'Toán cao cấp A1', 3, 3, 0, 'DC'),
('MAT22', 'Toán cao cấp A2', 3, 3, 0, 'DC'),
('MEDU1', 'Giáo Dục Quốc Phòng', 4, 4, 0, 'DC'),
('NT101', 'An Toàn Mạng Máy Tính', 4, 3, 1, 'CN'),
('NT102', 'Điện Tử Trong Công Nghệ Thông Tin', 4, 3, 1, 'CN'),
('NT103', 'Hệ Điều Hành Linux', 4, 3, 1, 'CN'),
('NT104', 'Lý Thuyết Thông Tin', 3, 3, 0, 'CN'),
('NT105', 'Truyền Dữ Liệu', 4, 3, 1, 'CN'),
('NT106', 'Lập Trình Mạng Căn Bản', 3, 2, 1, 'CN'),
('NT107', 'Xử Lý Tín Hiệu Số', 4, 3, 1, 'CN'),
('NT108', 'Mạng Truyền Thông & Di Động', 3, 2, 1, 'CN'),
('NT109', 'Lập Trình Ứng Dụng Mạng', 3, 2, 1, 'CN'),
('NT110', 'Tín hiệu & Mạch', 3, 3, 0, 'CN'),
('NT111', 'Thiết Bị Mạng', 4, 3, 1, 'CN'),
('NT112', 'Công Nghệ Mạng Viễn Thông', 4, 3, 1, 'CN'),
('NT113', 'Thiết kế mạng', 3, 2, 1, 'CN'),
('NT201', 'Phân tích và thiết kế hệ thống', 3, 3, 0, 'CN'),
('NT202', 'Đồ Án Lập Trình Ứng Dụng Mạng', 2, 0, 2, 'CN'),
('NT203', 'Đồ Án Chuyên Nghành', 2, 0, 2, 'CN'),
('NT301', 'Hai Chuyên Nghành', 4, 4, 2, 'CN'),
('NT302', 'Học Phần Chuyên Nghành 3', 3, 2, 1, 'CN'),
('NT40', 'Hai Học phần chuyên nghành', 6, 4, 2, 'CN'),
('NT501', 'Thực tập doanh nghiệp', 3, 0, 0, 'CN'),
('NT502', 'Môn tốt nghiệp 1', 3, 0, 0, 'CN'),
('NT503', 'Môn tốt nghiệp 2', 3, 0, 0, 'CN'),
('NT504', 'Đồ án ', 4, 0, 4, 'CN'),
('NT505', 'Khóa Luận Tốt Nghiệp', 10, 0, 0, 'CN'),
('OOPT1', 'Lập Trình Di Động', 4, 3, 1, 'CN'),
('OSYS1', 'Hệ điều hành', 4, 3, 1, 'CN'),
('PEDU1', 'Giáo Dục Thể Chất 1', 0, 0, 0, 'CN'),
('PEDU2', 'Giáo Dục Thể Chất 2', 5, 0, 5, 'CN'),
('PHIL2', 'Những Nguyên Lý Cơ Bản Mac-Lenin', 5, 5, 0, 'CN'),
('PHY01', 'Vật lý đại cương A1', 3, 3, 0, 'CN'),
('PHY02', 'Vật lý đại cương A2', 3, 3, 0, 'CN'),
('SE101', 'Phương Pháp Mô Hình Hóa', 3, 3, 0, 'CN'),
('SE102', 'Nhập Môn Phát Triển Game', 3, 2, 1, 'CN'),
('SE103', 'Các Phương Pháp Lập Trình', 3, 2, 1, 'CN'),
('SE104', 'Nhập Môn Phần Mềm', 4, 3, 1, 'CN'),
('SE105', 'Lập Trình Nhúng Căn Bản', 3, 2, 1, 'CN'),
('SE106', 'Đồ Án môn học', 4, 4, 0, 'CN'),
('SE207', 'Phân tích thiết kế HT', 4, 3, 1, 'CN'),
('SE208', 'Kiểm Chứng Phần Mềm', 3, 2, 1, 'CN'),
('SE209', 'Phát triển, bảo hành phần mềm', 3, 3, 0, 'CN'),
('SE210', 'Quản lý dự án', 4, 3, 1, 'CN'),
('SE211', 'Phát triển phần mềm di động', 4, 3, 1, 'CN'),
('SE212', 'Phát triển phần mềm mã nguồn mở', 3, 2, 1, 'CN'),
('SE213', 'Xử lý phân bố', 3, 2, 1, 'CN'),
('SE31*', 'Đồ án 1', 4, 3, 1, 'CN'),
('SE321', 'Đồ án 2', 4, 3, 1, 'CN'),
('SE417', 'Mã nguồn mở 1', 2, 2, 0, 'CN'),
('SMET2', 'Phương Pháp Luận', 2, 2, 0, 'CN'),
('STA01', 'Xác suất thống kê', 3, 3, 0, 'CN'),
('VCPL1', 'Đường Lối Đảng Cộng Sản Việt Nam', 3, 3, 0, 'CN');

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
-- Table structure for table `sinhvien`
--

CREATE TABLE IF NOT EXISTS `sinhvien` (
  `MaSV` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenSV` varchar(27) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Khoa` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lop` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `K` int(2) NOT NULL,
  `NgaySinh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSV`),
  KEY `Khoa` (`Khoa`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `TenSV`, `Khoa`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`) VALUES
('07520001', 'Nguyễn Trần Tiến', 'CNPM', 'CNPM01', 3, '', 'Vũng Tàu', '01699938919', 'rinodung.uit@gmail.com'),
('07520002', 'Thái Bình', 'HTTT', 'HTTT03', 3, '', 'Hà Nội', '271888141', ''),
('08520001', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '27/02/1992', 'Vũng Tàu\n', '271941112', 'alo@yahoo.com.vn'),
('08520003', 'Nguyễn Quý Hóa', 'MMT', 'MMT04', 3, '03/10/1991', 'Quản Trị', '661114331', ''),
('08520004', 'Đinh Tiến Đạt', 'KHMT', 'KHMT02', 2, '20/10/2010', 'Nha Trang', '0990113422', 'rinodung.uit@gmail.com'),
('08520005', 'Thái Thu Thủy', 'CNPM', 'CNPM02', 3, '10/12/1990', 'Vũng Tàu', '271899100', ''),
('08520031', 'Nguyên Phúc', 'HTTT', 'HTTT03', 3, '27/02/1986', 'Đồng Nai', '271918441', ''),
('08520032', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 3, '03/12/2012', 'Hà Nội', '999111999', ''),
('08520041', 'Nguyễn Minh Tùng', 'MMT', 'MMT03', 3, '28/09/1992', 'Đắc Lắc', '222911221', ''),
('08520042', 'Đồng Đại Bảo', 'HTTT', 'HTTT03', 3, '17/02/1991', 'Vũng Tàu', '123456668', ''),
('08520044', 'Đồng Hào', 'MMT', 'MMT04', 3, '18/07/1993', 'Nha Trang', '229199121', ''),
('08520045', 'Bình Nhu', 'KHMT', 'KHMT04', 1, '', '', '', ''),
('08520046', 'Nguyễn Minh Dũng', 'MMT', 'MMT04', 3, '28/08/1993', 'Đồng Nai', '888111446', ''),
('08520047', 'Minh Trí', 'KHMT', 'KHMT03', 1, '', '', '', ''),
('08520055', 'Nguyễn Văn Ninh', 'KHMT', 'KHMT01', 3, '18/08/1992', 'Bình Dương', '222288181', ''),
('08520056', 'Nguyễn Văn AB', 'KHMT', 'KHMT01', 3, '12/01/1992', 'Hà Nam', '261556445', ''),
('08520066', 'Nguyễn Hồ Minh Nhí', 'MMT', 'MMT04', 4, '20/04/1881', 'Hà Nội\n', '271999888', ''),
('08520111', 'Hà Tú', 'KTMT', 'KTMT04', 3, '29/2/2000', 'Hà Tĩnh', '881228991', ''),
('08520112', 'Âu Đình Phong', 'KTMT', 'KTMT04', 3, '*', 'Hải Phòng', '727112994', ''),
('08520115', 'Hải Hùng', 'KTMT', 'KTMT04', 3, '', 'Nha Trang', '991221218', ''),
('08520130', 'Trần Văn Khang', 'MMT', 'MMT04', 4, '*', '*', '271999334', ''),
('08520131', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('08520137', 'Võ Đoàn Như Khánh1', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('08520221', 'Phan Thiên Quốc', 'CNPM', 'CNPM03', 4, '*', '*', '491881111', ''),
('08520234', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', '*', '*', ''),
('08520235', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', 'Vinh', '009113313', ''),
('08520460', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('08520462', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '900881134', ''),
('08524566', 'Nguyễn Văn Bình', 'KHMT', 'KHMT01', 3, '20/02/1881', 'Bình Thuận', '888122134', ''),
('09520002', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520005', 'Hải Hưng ', 'CNPM', 'CNPM04', 4, '', '', '', 'abc.uit@gmail.com'),
('09520006', 'Trần Tiến', 'HTTT', 'HTTT03', 5, '', '', '', ''),
('09520008', 'Quách Minh', 'CNPM', 'CNPM01', 1, '', 'Đồng Nai', '271991441', ''),
('09520011', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520032', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520033', 'Hàn Thái Tú', 'MMT', 'MMT04', 4, '20/10/2012', 'Đà Nẵng', '01688817782', 'Alo.abc@gmail.com'),
('09520035', 'Mai Tiến Hoài', 'CNPM', 'CNPM02', 4, '18/02/1989', 'Khánh Hòa', '288179919', ''),
('09520040', 'Nguyễn Trần Anh Dũng', 'MMT', 'MMT04', 4, '*', '*', '', 'anhdung@gmail.com'),
('09520041', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520044', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 4, '17/03/1991', 'Vũng Tàu', '01699938919', 'rinodung.uit@gmail.com'),
('09520045', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520048', 'Đồng Minh', 'HTTT', 'HTTT03', 1, '', '', '', ''),
('09520052', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('09520055', 'Hàn Minh Tú', 'KHMT', 'KHMT03', 3, '10/12/2012', '*', '281991441', ''),
('09520056', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('09520111', 'Lê Quốc Hưng2', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('09520112', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('09520113', 'Hà Minh', 'HTTT', 'HTTT04', 1, '', '', '', ''),
('09520115', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('09520130', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520131', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520137', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('09520221', 'Phan Thiên Quốc', 'HTTT', 'HTTT03', 4, '*', '*', '271881331', ''),
('09520234', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', '*', '*', ''),
('09520235', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', '*', '*', ''),
('09520460', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('09520462', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('09520478', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('10520002', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520003', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520011', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520032', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520033', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520040', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520041', 'Nguyễn Quý Danh2', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520044', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520045', 'Hồ Hoài Anh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520052', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('10520055', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('10520056', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('10520111', 'Nguyễn Vũ', 'KTMT', 'KTMT04', 4, '*', '*', '016888989', ''),
('10520112', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('10520115', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('10520130', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520131', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('10520137', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '0', 'rinodung.uit@gmail.com'),
('10520221', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', '*', '987777113', ''),
('10520234', 'Phan Quốc Vinh', 'CNPM', 'CNPM04', 4, '*', '*', '991922415', ''),
('10520235', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', '*', '*', ''),
('10520460', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('10520462', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('10520478', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('11520001', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520002', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520011', 'Hồ Trần Bắc An', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520032', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520033', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520040', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 5, '*', '*', '311129913', ''),
('11520041', 'Nguyễn Quý Danh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520044', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520045', 'Đồng Tiến Dũng', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520052', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('11520055', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('11520056', 'Nguyễn Văn A', 'KHMT', 'KHMT04', 4, '*', '*', '*', ''),
('11520111', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 6, '*', '*', '271953112', ''),
('11520112', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('11520115', 'Lê Quốc Hưng', 'KTMT', 'KTMT04', 4, '*', '*', '*', ''),
('11520130', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520132', 'Võ Đoàn Như Khánh', 'MMT', 'MMT04', 4, '*', '*', '*', ''),
('11520137', 'Nguyễn Hoài Bão', 'MMT', 'MMT04', 6, '*', '*', '881922144', ''),
('11520221', 'Phan Thiên Quốc', 'CNPM', 'CNPM04', 4, '*', '*', '*', ''),
('11520235', 'Phan Mạnh Tiến', 'CNPM', 'CNPM04', 4, '*', '*', '271999411', ''),
('11520460', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*', '*', ''),
('11520462', 'Trương Hoàng An', 'HTTT', 'HTTT04', 5, '*', '*', '881922144', ''),
('11520478', 'Trương Hoàng An', 'HTTT', 'HTTT04', 4, '*', '*3', '818811243', ''),
('09520001', 'Trần Khoa', 'CNPM', 'CNPM03', 3, '', '', '', ''),
('07520015', 'Hà Hạnh', 'HTTT', 'HTTT01', 1, '', '', '', '');

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
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_cnpm`
--

INSERT INTO `sv_cnpm` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`) VALUES
('09520026', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '0121001110', ''),
('10520001', 'Đồng Tiến Dũng', 'CNPM05', 5, '*', '*', '06188893891', ''),
('10520002', 'Võ Đoàn Như Khánh', 'CNPM05', 5, '*', '*', '0', 'rinodung.uit@gmail.com'),
('10520003', 'Trương Hoàng An', 'CNPM05', 5, '*', '*', '900881134', ''),
('10520004', 'Phan Thiên Quốc', 'CNPM05', 5, '*', '*', '01699999913', ''),
('10520005', 'Quách Minh', 'CNPM05', 5, '', 'Đồng Nai', '', ''),
('10520011', 'Hồ Trần Bắc An', 'CNPM04', 4, '*', '*', '0121112333', ''),
('10520032', 'Nguyễn Quý Danh', 'CNPM03', 3, '*', '*', '016888919', ''),
('10520033', 'Nguyễn Quý Danh', 'CNPM04', 4, '*', '*', '01699938919', ''),
('10520221', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '987777113', ''),
('10520234', 'Phan Quốc Vinh', 'CNPM04', 4, '*', '*', '991922415', ''),
('10520235', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '*', ''),
('11520221', 'Phan Thiên Quốc', 'CNPM04', 4, '*', '*', '*', ''),
('11520235', 'Phan Mạnh Tiến', 'CNPM04', 4, '*', '*', '271999411', '');

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
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_httt`
--

INSERT INTO `sv_httt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`) VALUES
('07520001', 'Nguyễn Trần Tiến', 'HTTT01', 3, '', 'Vũng Tàu', '01699938919', 'rinodung.uit@gmail.com'),
('07520002', 'Thái Bình', 'HTTT03', 3, '', 'Hà Nội', '271888141', ''),
('08520042', 'Đồng Đại Bảo', 'HTTT03', 3, '17/02/1991', 'Vũng Tàu', '123456668', ''),
('08521001', 'Âu Minh Trí', 'HTTT03', 3, '', '', '', ''),
('09520006', 'Trần Tiến', 'HTTT03', 5, '', '', '', ''),
('09520045', 'Hà Tú Anh', 'HTTT03', 3, '*', '*', '01699938918', ''),
('09520113', 'Hà Minh', 'HTTT04', 4, '', '', '', ''),
('09520460', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('09520462', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('09520478', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('10520460', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('10520462', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('10520478', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('11520460', 'Trương Hoàng An', 'HTTT04', 4, '*', '*', '*', ''),
('11520462', 'Trương Hoàng An', 'HTTT04', 5, '*', '*', '881922144', ''),
('11520478', 'Trương Hoàng An', 'HTTT04', 4, '*', '*3', '818811243', '');

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
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_khmt`
--

INSERT INTO `sv_khmt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`) VALUES
('08520031', 'Nguyên Phúc', 'KHMT04', 3, '27/02/1986', 'Đồng Nai', '271918441', ''),
('08520047', 'Minh Trí', 'KHMT03', 1, '', '', '', ''),
('08520055', 'Nguyễn Văn Ninh', 'KHMT01', 3, '18/08/1992', 'Bình Dương', '222288181', ''),
('08524566', 'Nguyễn Văn Bình', 'KHMT01', 3, '20/02/1881', 'Bình Thuận', '888122134', ''),
('09520005', 'Hải Hưng ', 'KHMT04', 4, '', '', '', 'abc.uit@gmail.com'),
('09520052', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', ''),
('09520055', 'Nguyễn Văn A', 'KHMT01', 4, '*', '*', '281991441', ''),
('09520056', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '01688838111', 'rinodung.uit@gmail.com'),
('10520052', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', ''),
('10520055', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', ''),
('10520056', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', ''),
('11520052', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', ''),
('11520055', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', ''),
('11520056', 'Nguyễn Văn A', 'KHMT04', 4, '*', '*', '*', '');

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
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_ktmt`
--

INSERT INTO `sv_ktmt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`) VALUES
('08520011', 'Phan Thiên Quốc', 'KTMT03', 3, '*', '*', '01699938999', ''),
('08520012', 'Phan Thiên Quốc', 'KTMT04', 4, '*', 'Vinh', '009113313', ''),
('08520013', 'Âu Đình Phong', 'KTMT04', 3, '*', 'Hải Phòng', '727112994', ''),
('08520014', 'Hải Hùng', 'KTMT03', 3, '', 'Nha Trang', '991221218', ''),
('08520015', 'Lê Quốc B', 'KTMT03', 3, '29/2/2000', 'Hà Tĩnh', '881228991', 'B@gmail.com'),
('08520016', 'Trương Hoàng An', 'KTMT03', 3, '*', '*', '098113441', ''),
('08520018', 'Hà Bảo Nam', 'KTMT04', 6, '*', '*', '271953112', 'habanam@gmail.com'),
('08520019', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '01699938899', ''),
('09520017', 'Hồ Trần Bắc Minh', 'KTMT04', 4, '*', '*', '01699939881', ''),
('09520111', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '016888388', ''),
('09520112', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '', '0169930011', ''),
('09520115', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', ''),
('10520111', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', ''),
('10520112', 'Lê Quốc Hưng', 'KTMT05', 5, '*', '*', '0188831881', ''),
('10520115', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '016777111', ''),
('11520115', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', ''),
('11520215', 'Lê Quốc Hưng', 'KTMT04', 4, '*', '*', '*', ''),
('8520001', 'Lê Quốc Bảo', 'KTMT04', 3, '29/2/2000', 'Hà Tĩnh', '881228991', '');

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
  PRIMARY KEY (`MaSV`),
  KEY `K` (`K`),
  KEY `Lop` (`Lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sv_mmt`
--

INSERT INTO `sv_mmt` (`MaSV`, `TenSV`, `Lop`, `K`, `NgaySinh`, `NoiSinh`, `SDT`, `email`) VALUES
('08520001', 'Hồ Trần Bắc An', 'MMT04', 4, '27/02/1992', 'Hà Nội', '271941112', 'alo@yahoo.com.vn'),
('08520008', 'Trần Văn Khang', 'MMT04', 4, '*', 'Hà Nội', '271999334', 'khangnv@gmail.com'),
('08520010', 'Phan Thiên Quốc', 'MMT04', 4, '*', '*', '491881111', ''),
('09520031', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '06199938919', ''),
('09520032', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '01699938919', 'danh@gmail.com'),
('09520034', 'Nguyễn Trần Anh Dũng', 'MMT04', 4, '*', '*', '', 'anhdung@gmail.com'),
('09520035', 'Võ Đoàn Như Loan', 'MMT04', 4, '*', '*', '0168889991', ''),
('09520036', 'Hà Đoàn Như Khánh', 'MMT04', 4, '*', '*', '01699938888', ''),
('09520037', 'Phan Thiên Quốc', 'MMT04', 4, '*', '*', '271881331', ''),
('09520038', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '01699938919', ''),
('09520039', 'Hồ Trần Hải Nam', 'MMT04', 4, '*', '*', '01699938999', ''),
('09520044', 'Đồng Tiến Dũng', 'MMT04', 4, '17/03/1991', 'Vũng Tàu', '01699938919', 'rinodung.uit@gmail.com'),
('10520041', 'Nguyễn Quý Danh2', 'MMT04', 4, '*', '*', '*', ''),
('10520044', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '*', ''),
('10520045', 'Hồ Hoài Anh', 'MMT04', 4, '*', '*', '*', ''),
('10520130', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', ''),
('10520131', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', ''),
('11520001', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', ''),
('11520002', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', ''),
('11520011', 'Hồ Trần Bắc An', 'MMT04', 4, '*', '*', '*', ''),
('11520032', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', ''),
('11520033', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', ''),
('11520040', 'Đồng Tiến Dũng', 'MMT04', 5, '*', '*', '311129913', ''),
('11520041', 'Nguyễn Quý Danh', 'MMT04', 4, '*', '*', '*', ''),
('11520044', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '*', ''),
('11520045', 'Đồng Tiến Dũng', 'MMT04', 4, '*', '*', '*', ''),
('11520130', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', ''),
('11520132', 'Võ Đoàn Như Khánh', 'MMT04', 4, '*', '*', '*', '');

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
-- Constraints for table `dangky_mmt`
--
ALTER TABLE `dangky_mmt`
  ADD CONSTRAINT `dangky_mmt_ibfk_2` FOREIGN KEY (`MaSV`) REFERENCES `sv_mmt` (`MaSV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `denghi`
--
ALTER TABLE `denghi`
  ADD CONSTRAINT `denghi_ibfk_1` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lophoc`
--
ALTER TABLE `lophoc`
  ADD CONSTRAINT `lophoc_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loplt`
--
ALTER TABLE `loplt`
  ADD CONSTRAINT `loplt_ibfk_1` FOREIGN KEY (`MaGV`) REFERENCES `giaovien` (`MaGV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loplt_ibfk_2` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lopth`
--
ALTER TABLE `lopth`
  ADD CONSTRAINT `lopth_ibfk_1` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lopth_ibfk_2` FOREIGN KEY (`MaGV`) REFERENCES `giaovien` (`MaGV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `molop`
--
ALTER TABLE `molop`
  ADD CONSTRAINT `FK_ml_mh` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sv_mmt`
--
ALTER TABLE `sv_mmt`
  ADD CONSTRAINT `sv_mmt_ibfk_1` FOREIGN KEY (`K`) REFERENCES `k` (`MaK`) ON DELETE CASCADE ON UPDATE CASCADE;
