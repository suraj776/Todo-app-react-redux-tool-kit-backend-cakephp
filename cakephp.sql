-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 09, 2024 at 01:08 PM
-- Server version: 5.6.36
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_todo`
--

CREATE TABLE `daily_todo` (
  `id` int(11) NOT NULL,
  `day` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `saved` tinyint(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_todo`
--

INSERT INTO `daily_todo` (`id`, `day`, `story`, `saved`, `user_id`, `created_on`, `completed`) VALUES
(1, 'monday', 'Hello', 1, 3, '2024-01-09 10:27:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `created_on`) VALUES
(3, 'SUraj', 'test@test.com', '$2y$10$YMxRetZ071zwmEdBSR8i9uAkuq2IJxSGaU3oXAuOlpY1/cfB1nyM.', '2024-01-09 10:26:07'),
(4, 'SUraj', 'test1@test.com', '$2y$10$zquqMn9ptAzm8ogccS/cH.dCjiSrWAPw.tnOclwvl90PpUEbQQM.6', '2024-01-09 10:26:32'),
(5, 'Ashish', 'ashish@test.com', '$2y$10$r77hOo8UxJjRiSVr01B9XujjZL1o.DGkkEoWxapqkN3S76FK/p772', '2024-01-09 11:55:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_todo`
--
ALTER TABLE `daily_todo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day` (`day`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_daily_todo_user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `name` (`name`(191));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_todo`
--
ALTER TABLE `daily_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_todo`
--
ALTER TABLE `daily_todo`
  ADD CONSTRAINT `fk_daily_todo_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
