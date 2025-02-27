-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 12:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productivity`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`uid`, `name`, `email`, `message`) VALUES
(1, 'dfgfhg', 'Sisaydejenu@0028gmail.com', 'sdfghfgjhredghssdgf'),
(2, 'AYELE', 'AAA@GMAIL.COM', 'your app as a begginner is good but it needs improvement on the ,,,,,,,');

-- --------------------------------------------------------

--
-- Table structure for table `personalinfor`
--

CREATE TABLE `personalinfor` (
  `uid` int(150) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personalinfor`
--

INSERT INTO `personalinfor` (`uid`, `firstname`, `lastname`, `email`, `password`, `department`) VALUES
(1, 'dxfcgvhbjnkm', 'dfcvbnm', 'fcgvhbn@gmail.com', 'cvbnm,', 'cvbnmnmn '),
(2, 'dxfcgvhbjnkm', 'dfcvbnm', 'fcgvhbn@gmail.com', 'cvbnm,', 'cvbnmnmn '),
(3, 'abebe', 'kebede', 'aaa@gmail.com', 'abcd1234', 'mechatronics engineering'),
(4, 'Sisay', 'kebede', 'cici@gmail.com', '1234', 'electrical engineering'),
(5, 'CHALA', 'df', 'abc@bbb.com', '123', 'electrical engineering'),
(6, 'SAMUEL', 'TAFESE', 'SAMI@gmail.com', '123', 'medicine');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `personalinfor`
--
ALTER TABLE `personalinfor`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personalinfor`
--
ALTER TABLE `personalinfor`
  MODIFY `uid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
