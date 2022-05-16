-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 06:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contactbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactID` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `groupName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `firstName`, `lastName`, `email`, `phone`, `address`, `city`, `groupName`) VALUES
(1, 'Janez', 'Novak', 'janez@gmail.com', '041123456', 'Staničeva 3', 'Ljubljana', 'Friends'),
(2, 'Micka', 'Novak', 'micka@gmail.com', '041234876', NULL, NULL, NULL),
(3, 'Lojze', 'Kovac', 'lojze@gmail.com', '123456789', NULL, NULL, NULL),
(4, 'Zdravko', 'Pahor', 'micka@gmail.com', NULL, NULL, NULL, NULL),
(5, 'Policija', '', NULL, '113', NULL, NULL, NULL),
(6, 'Gasilci', '', NULL, '112', NULL, NULL, NULL),
(7, 'Reševalci', '', NULL, '112', NULL, NULL, NULL),
(8, 'Matej', 'Krajnc', 'matej@gmail.com', '556677', NULL, NULL, NULL),
(23, 'Lan', 'Praprot', 'kujkuj@gmail.com', '051345654', NULL, NULL, NULL),
(24, 'Rok', 'Razor', 'peter@gmail.com', '031234876', NULL, NULL, NULL),
(25, 'Pipa', 'Novak', NULL, '031276678', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `password`) VALUES
('ana', '$2y$10$1iosEnJWHPyuVitQ4puJu.5Qg2vU.KQe1Rg7sANRxA81DG/5lVu/C'),
('anonymous', ''),
('david', '$2y$10$1JXw6sN1Ah7i7AqdbWO7Q.aWLB3usKhHY4d6AOcXHqpusePaf00Uy'),
('jan', '$2y$10$9czKapEYrpzTMxVk7spAJ.1VhzTTFakQ2E15w6TTCsyV0Rg17Lx8y'),
('nik', '$2y$10$Jtzw/cnLycnGjHd5nPNZpuZuGm.ycCWD0ED1G5ezst7vwna2RwbnO'),
('tim', '$2y$10$NN2d2tBKkMbqWEU3qRvsfO4mva7D8GMM67DKZcwlul2BOuMSLIDsW'),
('vida', '$2y$10$N//Dr02dALrtabcOaVznI.E4FNmhCaZ2pzziUrtf1iCCqxA1igy32');

-- --------------------------------------------------------

--
-- Table structure for table `users_contacts`
--

CREATE TABLE `users_contacts` (
  `user` varchar(20) NOT NULL,
  `contactID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_contacts`
--

INSERT INTO `users_contacts` (`user`, `contactID`) VALUES
('anonymous', 5),
('anonymous', 6),
('anonymous', 7),
('jan', 3),
('jan', 8),
('tim', 1),
('tim', 2),
('tim', 4),
('tim', 23),
('tim', 24),
('vida', 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactID`),
  ADD UNIQUE KEY `contactID` (`contactID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `users_contacts`
--
ALTER TABLE `users_contacts`
  ADD PRIMARY KEY (`user`,`contactID`),
  ADD KEY `contactID` (`contactID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_contacts`
--
ALTER TABLE `users_contacts`
  ADD CONSTRAINT `users_contacts_ibfk_1` FOREIGN KEY (`contactID`) REFERENCES `contacts` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_contacts_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
