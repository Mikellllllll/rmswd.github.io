-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2023 at 09:56 PM
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
-- Database: `peace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(999) DEFAULT NULL,
  `username` varchar(999) NOT NULL,
  `password` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`) VALUES
(1, NULL, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `household_data`
--

CREATE TABLE `household_data` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `sexM` varchar(255) NOT NULL,
  `household_id_number` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `child_dob` varchar(10) DEFAULT NULL,
  `attending_school` varchar(255) NOT NULL,
  `reason_for_not_attending` varchar(255) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `sexC` varchar(255) DEFAULT NULL,
  `child1_name` varchar(255) DEFAULT NULL,
  `child1_address` varchar(255) DEFAULT NULL,
  `child1_school_name` varchar(255) DEFAULT NULL,
  `child1_school_address` varchar(255) DEFAULT NULL,
  `child1_grade_level` varchar(255) DEFAULT NULL,
  `child2_name` varchar(255) DEFAULT NULL,
  `child2_address` varchar(255) DEFAULT NULL,
  `child2_school_name` varchar(255) DEFAULT NULL,
  `child2_school_address` varchar(255) DEFAULT NULL,
  `child2_grade_level` varchar(255) DEFAULT NULL,
  `child3_name` varchar(255) DEFAULT NULL,
  `child3_address` varchar(255) DEFAULT NULL,
  `child3_school_name` varchar(255) DEFAULT NULL,
  `child3_school_address` varchar(255) DEFAULT NULL,
  `child3_grade_level` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household_data`
--
ALTER TABLE `household_data`
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
-- AUTO_INCREMENT for table `household_data`
--
ALTER TABLE `household_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
