-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-01-02 02:11:46
-- 服务器版本： 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ahegao`
--
CREATE DATABASE IF NOT EXISTS `db_ahegao` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_ahegao`;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_forms`
--

CREATE TABLE IF NOT EXISTS `tbl_forms` (
  `nFormID` int(11) NOT NULL AUTO_INCREMENT,
  `txtFormName` varchar(150) NOT NULL,
  `nPostTime` int(11) NOT NULL,
  `txtDescription` varchar(1500) NOT NULL,
  `txtThumbnail` varchar(50) NOT NULL,
  `nFields` int(11) NOT NULL,
  `txtAuthor` varchar(30) NOT NULL,
  `txtEmail` varchar(50) NOT NULL,
  `isAvaliable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nFormID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
