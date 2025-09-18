-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 06:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `curr_date` date NOT NULL,
  `attendance_month` text NOT NULL,
  `attendance_year` int(11) NOT NULL,
  `attendance` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `curr_date`, `attendance_month`, `attendance_year`, `attendance`) VALUES
(36, 1, '0000-00-00', 'Jan', 1970, 'P'),
(37, 1, '0000-00-00', 'Jan', 1970, 'P'),
(38, 1, '0000-00-00', 'Jan', 1970, 'P'),
(39, 1, '2025-03-13', 'Mar', 2025, 'P'),
(40, 1, '2025-04-24', 'Apr', 2025, 'P'),
(41, 17, '2025-04-25', 'Apr', 2025, 'P'),
(42, 18, '2025-04-25', 'Apr', 2025, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_files`
--

CREATE TABLE `pdf_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL DEFAULT 'NOT NULL',
  `file_path` varchar(255) NOT NULL DEFAULT 'NOT NULL',
  `uploaded_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pdf_files`
--

INSERT INTO `pdf_files` (`id`, `file_name`, `file_path`, `uploaded_by`) VALUES
(1, '2104010202196_B.pdf', 'uploads/2104010202196_B.pdf', 0),
(2, 'CS-CSE_Assignment.pdf', 'uploads/CS-CSE_Assignment.pdf', 0),
(3, 'javathecompletereference-161011163754 (1).pdf', 'uploads/javathecompletereference-161011163754 (1).pdf', 2),
(4, '7th-final-spring2024.pdf', '../uploads/7th-final-spring2024.pdf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `saikats`
--

CREATE TABLE `saikats` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `image`, `location`, `password`, `role`) VALUES
(15, 'Anik Sen', 'anik@gmail.com', '', '1745554454_cover_image.jpg', '', '$2y$10$.UA0SnLsOfauNJL46TuBN./eh.n3HGdkiV5qqA9WwOPAdMeRp/B0C', 1),
(16, 'Admin', 'admin@gmail.com', '', '1745557759_cover_image.jpg', '', '$2y$10$y0N5Rh0y8e03KEHfFRkyJOErhPnjtJRgpoAeWs8SaFVRca9yCaL/y', 2),
(17, 'tanbir', 'tanbir_@gmail.com', '', 'Adobe Express - file.png', '', '$2y$10$XJ7dujwmHga/hMP.BO/xneKBjaOpjuaWnX9h/kjIt1pfhooR32yee', 0),
(18, 'Badhon', 'badhon@gmail.com', '', 'puc_logo.png', '', '$2y$10$36Ond/4xUsu7rJbjvvc6UO4RZ03ojCaBOojVU/H54HIiFqe42b8xW', 0),
(19, 'Teacher', 'teacher@gmail.com', '', '', '', '$2y$10$Hs375BJrJCwXBZnq7QT1aeM6Dtu5jdToJ69WlKdFSC8ckk8cRhBtS', 1),
(20, 'Saikat', 'saikat@gmail.com', '', '', '', '$2y$10$avNNlmi7qnP4nc28SMzdu.mCF8axqfHvpistNWWnY1f5qimjYEScy', 0),
(21, 'Abc', 'abc@gmail.com', '', '', '', '$2y$10$SK/pbODQ21FChw5VHX03..sZOtbcN485TjZHKYndSTthzFk0z5eV6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_files`
--
ALTER TABLE `pdf_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saikats`
--
ALTER TABLE `saikats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pdf_files`
--
ALTER TABLE `pdf_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saikats`
--
ALTER TABLE `saikats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
