-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2016 at 03:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stjudes_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `liturgy_dates`
--

CREATE TABLE IF NOT EXISTS `liturgy_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `liturgy_dates`
--

INSERT INTO `liturgy_dates` (`id`, `dates`) VALUES
(6, '2016-02-28'),
(7, '2016-03-06'),
(8, '2016-03-13'),
(9, '2016-03-20'),
(10, '2016-03-27'),
(11, '2016-04-03'),
(12, '2016-04-10'),
(13, '2016-04-17'),
(14, '2016-04-24'),
(15, '2016-05-01'),
(16, '2016-05-08'),
(17, '2016-05-15'),
(18, '2016-05-22'),
(19, '2016-05-29'),
(20, '2016-06-05'),
(21, '2016-06-12'),
(22, '2016-06-19'),
(23, '2016-06-26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
