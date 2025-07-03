-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 03:56 PM
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
-- Database: `swep_students`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin@ful.com', '$2y$10$LuyjUvED0jjG4k1w8A1Mcu5AaTjhpOZtv2J4/6PL5WNqdFdZGEDai', '2025-07-03 12:54:41'),
(2, 'admin', '$2y$10$VNJH2qDrzJie6lpbJZtQb.v/FXZVp2k/rO9pmhKDYzrvKf1ScHlki', '2025-07-03 13:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `session` varchar(20) NOT NULL,
  `CA` int(11) DEFAULT 0,
  `exam` int(11) DEFAULT 0,
  `total` int(11) GENERATED ALWAYS AS (`CA` + `exam`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `matric_no`, `name`, `department`, `level`, `session`, `CA`, `exam`) VALUES
(1, 'SCI22BTC001', 'Saminu Isah ', 'Computer Engineering', '100L', '2025/2026', 35, 55),
(2, 'SCI22BTC002', 'Fatima Usman', 'Electrical Engineering', '100L', '2025/2026', 34, 52),
(3, 'SCI22BTC003', 'Haruna Garba', 'Electrical Engineering', '100L', '2025/2026', 30, 58),
(5, 'SCI22BTC005', 'Abu Yau', 'Computer Science', '300L', '2025/2026', 15, 70),
(6, 'SCI22BTC006', 'Jane Audu', 'Mathematics', '200L', '2025/2026', 18, 65),
(7, 'SCI22BTC007', 'Abubakar Musa', 'Computer Science', '300L', '2025/2026', 15, 70),
(8, 'SCI22BTC008', 'Jamalu Smith', 'Mathematics', '200L', '2025/2026', 18, 60),
(9, 'SCI22BTC009', 'Abu Yau', 'Physics', '300L', '2025/2026', 15, 70),
(10, 'SCI22BTC010', 'John Smith', 'Chemistry', '200L', '2025/2026', 18, 50),
(11, 'SCI22BTC011', 'Abu Yau', 'Computer Science', '300L', '2025/2026', 15, 70),
(12, 'SCI22BTC012', 'Joy Smith', 'Mathematics', '200L', '2025/2026', 18, 65),
(13, 'SCI22BTC013', 'Abubakar Adamu', 'Computer Engineering', '100L', '2025/2026', 46, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matric_no` (`matric_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
