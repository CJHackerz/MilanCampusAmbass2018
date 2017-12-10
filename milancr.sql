-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2017 at 09:17 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milancr`
--

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `id` int(11) NOT NULL,
  `user_id` varchar(128) COLLATE utf8_bin NOT NULL,
  `venue` varchar(1024) COLLATE utf8_bin NOT NULL,
  `address` varchar(512) COLLATE utf8_bin NOT NULL,
  `contact_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `contact_number` varchar(64) COLLATE utf8_bin NOT NULL,
  `remarks` varchar(1024) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `user_id`, `venue`, `address`, `contact_name`, `contact_number`, `remarks`, `timestamp`) VALUES
(1, '1809461805744073', 'test', '', 'test', '', 'test', '2017-12-05 05:57:21'),
(2, '1809461805744073', 'test', '', 'test', '9176045101', 'test', '2017-12-05 05:57:30'),
(3, '1809461805744073', 'test', '', 'test', 'undefined', 'test', '2017-12-05 06:01:27'),
(4, '1809461805744073', 'test', '', 'tes', '9176045101', 'test', '2017-12-05 06:03:50'),
(5, '1809461805744073', 'test', 'ets', 'tes', '9176045101', 'test', '2017-12-05 06:04:36'),
(7, '1809461805744073', 'testtest', 'tetetetetetetetetetetetetetetetetetetetetetetete', 'testtest', '9176045101', 'testtesttestetstestestestestestte', '2017-12-05 06:37:10'),
(8, '1809461805744073', 'testetste', 'tetetetetetetetetetetetetetetetetetetetetetetete', 'tests', '9176045101', 'testtesttestetstestestestestestte', '2017-12-05 06:43:30'),
(9, '1809461805744073', 'testetste', 'tetetetetetetetetetetetetetetetetetetetetetetete', 'tests', '9176045101', 'testtesttestetstestestestestestte', '2017-12-05 07:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `fb_id` varchar(64) COLLATE utf8_bin NOT NULL,
  `user_name` varchar(128) COLLATE utf8_bin NOT NULL,
  `score` int(11) NOT NULL,
  `shares` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `user_id` varchar(128) COLLATE utf8_bin NOT NULL,
  `post_id` varchar(128) COLLATE utf8_bin NOT NULL,
  `share_post_id` varchar(128) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `user_id`, `post_id`, `share_post_id`, `timestamp`) VALUES
(11, '1809461805744073', '527811900648870_1558795974217119', '1814460145244239', '2017-12-04 11:57:21'),
(12, '1245_341', '1231023_0123', '12345', '2017-12-09 14:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(64) COLLATE utf8_bin NOT NULL,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `mobile_number` varchar(16) COLLATE utf8_bin NOT NULL,
  `whatsapp_number` varchar(16) COLLATE utf8_bin NOT NULL,
  `city` varchar(64) COLLATE utf8_bin NOT NULL,
  `college` varchar(128) COLLATE utf8_bin NOT NULL,
  `address` varchar(256) COLLATE utf8_bin NOT NULL,
  `zipcode` varchar(8) COLLATE utf8_bin NOT NULL,
  `year_of_study` varchar(11) COLLATE utf8_bin NOT NULL,
  `status` varchar(8) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
