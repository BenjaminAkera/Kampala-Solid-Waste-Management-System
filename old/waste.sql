-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2012 at 06:41 
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `waste`
--

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_site` varchar(100) NOT NULL,
  `dumping_site` varchar(100) NOT NULL,
  `vehicle_id` varchar(100) NOT NULL,
  `mileage` varchar(20) NOT NULL,
  `load_weight` varchar(32) NOT NULL,
  `fuel_gauge` varchar(32) NOT NULL,
  `collection_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`collection_id`, `collection_site`, `dumping_site`, `vehicle_id`, `mileage`, `load_weight`, `fuel_gauge`, `collection_date_time`) VALUES
(6, '3 ', '4 ', 'Amuria_st', '764', '2', '1', '2012-05-22 16:32:05'),
(7, 'null ', 'null ', 'null', 'null', 'null', 'null', '2012-05-22 16:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `login`, `role`, `passwd`) VALUES
(1, 'kat', 'jmc', 'jmckat', 'truck_driver', 'a96d41c420a150ffd17c581e18c523be'),
(2, 'kat', 'jmc', 'admin', 'truck_driver', 'a96d41c420a150ffd17c581e18c523be'),
(5, 'kkkk', 'jjjj', 'opss', 'truck_driver', 'a96d41c420a150ffd17c581e18c523be'),
(6, 'kkkk', 'jjjj', 'opsss', 'admin', 'a96d41c420a150ffd17c581e18c523be');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
