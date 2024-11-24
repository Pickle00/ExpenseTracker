-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 06:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expensetracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `eid` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `modified` datetime NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`eid`, `uid`, `category`, `amount`, `date`, `modified`, `note`) VALUES
(1, 1, 'Transport', 5000, '2024-08-18', '2024-09-20 14:44:13', 'bus'),
(7, 1, 'Healthcare', 20000, '2024-09-20', '0000-00-00 00:00:00', 'Medicine'),
(12, 1, 'Food', 200, '2024-09-21', '0000-00-00 00:00:00', 'Momo'),
(13, 1, 'Transport', 200, '2024-09-23', '0000-00-00 00:00:00', 'Bus'),
(14, 1, 'Entertainment', 600, '2024-09-23', '0000-00-00 00:00:00', 'Movie'),
(15, 1, 'Healthcare', 1500, '2024-09-23', '0000-00-00 00:00:00', 'Medicine'),
(16, 1, 'Food', 500, '2024-09-23', '0000-00-00 00:00:00', 'Momo'),
(17, 1, 'Utilities', 600, '2024-09-23', '0000-00-00 00:00:00', 'Cleaning Supplies'),
(19, 1, 'Entertainment', 500, '2024-09-23', '0000-00-00 00:00:00', 'Cinema'),
(20, 1, 'Entertainment', 1000, '2024-09-23', '0000-00-00 00:00:00', 'Cinema');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `uid`, `amount`, `date`, `modified`) VALUES
(1, '1', 20000, '2024-09-18', '2024-09-20 14:46:18'),
(2, '1', 10000, '2024-08-18', '2024-09-21 09:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`) VALUES
(1, 'Bikal', 'bikal@gmail.com', '123'),
(2, 'Pickle', 'rumba803@gmail.com', '123'),
(3, 'Raju', 'raju@gmail.com', 'Raju@1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `eid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
