-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2018 at 10:41 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'hoda mosaad', '$2y$10$EuPV4srqMhPunVBQZEBi1e1PyZ9r8IP4TuBi7k3uv5Rv5/ROAgTS.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `status` enum('ACCEPTED','BLOCKED') CHARACTER SET utf8 DEFAULT 'BLOCKED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `email`, `password`, `birthdate`, `status`) VALUES
(4, 'anas mosaaddd', '1234567890', 'hoda@mosaad.com', '1234', '2010-02-04', 'BLOCKED'),
(8, 'mosaad', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(9, 'anas mosaad', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(10, 'amal', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(11, 'hoda', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(12, 'somaia', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'BLOCKED'),
(13, 'mosaad', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(14, 'anas', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(15, 'amal', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(16, 'hoda', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(17, 'somaia', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'BLOCKED'),
(18, 'mosaad', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'BLOCKED'),
(19, 'anas', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(20, 'amal', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(21, 'amal', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(22, 'hoda', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(23, 'somaia', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'BLOCKED'),
(24, 'mosaad', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(25, 'anas', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(26, 'amal', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(27, 'hoda', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'ACCEPTED'),
(28, 'somaia', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'BLOCKED'),
(29, 'mosaad', '1234567890', 'hoda@mosaad.com', '1234', '2018-12-11', 'BLOCKED'),
(30, 'hoda', '01011055939', 'hodamosaad0@gmail.com', '$2y$10$4Eu2C2vUdqw5/6QzGMhvIOT5G0jr4t35jFtA/V6Br8Q2lQkrsIVYu', '2018-12-12', 'ACCEPTED'),
(32, 'hoda', '01011055939', 'hodamosaad0@gmail.com', '$2y$10$J2rUaN.SpuH7bCFwnfFNxuo47786wfpm.vUI9sp7xENgB/mSbKMl2', '2018-12-12', 'ACCEPTED'),
(34, 'hoda mosaad', '01011055939', 'hodamosaad0@gmail.com', '$2y$10$EuPV4srqMhPunVBQZEBi1e1PyZ9r8IP4TuBi7k3uv5Rv5/ROAgTS.', '2018-12-11', 'ACCEPTED'),
(35, 'hoda mosaad', '01011055939', 'hodamosaad0@gmail.com', '$2y$10$2PB5KG2WbppXZXEQ1GSAbedUznaBOUE8LVnGy.K6zulE0p75jDz7e', '2018-12-26', 'ACCEPTED'),
(36, 'hoda mosaad', '01011055939', 'gfalcon996@gmail.com', '$2y$10$7JpAvr9.zQzI8vtkLwLUJetlWPFlulkJF6ffNLcYKBB49T2jbbEme', '2018-12-18', 'BLOCKED'),
(37, 'hoda mosaad', '01011055939', 'hoda.mosaad@femto15.com', '$2y$10$ApJIwBEh.to8ltQ3O8Uucu8m0fLFqnLketCsGKe3rnf0tuIyu8eeW', '2018-12-12', 'ACCEPTED'),
(38, 'hoda mosaad', '01011055939', 'gfalcojkjkn996@gmail.com', '$2y$10$.B5VjaOlT91moAZjiW3DROcVvsPGtBOL5o8iv9862iwuoT71xseCW', '2018-12-19', 'ACCEPTED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
