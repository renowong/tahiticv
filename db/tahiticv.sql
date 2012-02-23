-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2012 at 11:05 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `renowong_tahiticv`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_ver`
--

DROP TABLE IF EXISTS `db_ver`;
CREATE TABLE IF NOT EXISTS `db_ver` (
  `version` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_ver`
--

INSERT INTO `db_ver` (`version`) VALUES
(25);
