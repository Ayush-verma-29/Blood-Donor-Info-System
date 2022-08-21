-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 08:23 AM
-- Server version: 5.7.29-log
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bi`
--

CREATE TABLE `bi` (
  `S.no` int(4) NOT NULL,
  `Blood Group` varchar(10) NOT NULL,
  `First name` varchar(15) NOT NULL,
  `Last name` varchar(15) NOT NULL,
  `Date of Birth` date NOT NULL,
  `Gender` text NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `City` text NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rd`
--

CREATE TABLE `rd` (
  `S.no` int(4) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Patient name` text NOT NULL,
  `Your name` text NOT NULL,
  `Your email` varchar(30) NOT NULL,
  `phone no` varchar(12) NOT NULL,
  `Blood group` varchar(10) NOT NULL,
  `Unit required` int(3) NOT NULL,
  `City` text NOT NULL,
  `Message` text NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` varchar(10) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bi`
--
ALTER TABLE `bi`
  ADD PRIMARY KEY (`S.no`);

--
-- Indexes for table `rd`
--
ALTER TABLE `rd`
  ADD PRIMARY KEY (`S.no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bi`
--
ALTER TABLE `bi`
  MODIFY `S.no` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rd`
--
ALTER TABLE `rd`
  MODIFY `S.no` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
