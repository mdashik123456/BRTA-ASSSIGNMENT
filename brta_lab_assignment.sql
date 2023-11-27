-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 06:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brta_lab_assignment`
CREATE Database brta_lab_assignment;
use brta_lab_assignment;
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `password`) VALUES
('Ashik', 'ashik@admin.com', '$2y$10$fwAkeCZ5//uFSyvkYs3b1OeOiSR8ZwA2z2UNWPrj37Ryjgbjici52'),
('Md. Ashiqur Rahman', 'ashiqur35-3162@diu.edu.bd', '$2y$10$faEbIBlG4LOTeear/LeO1uIqrFJ8DkyNd4S4iwM6grrPz7zuEAMTe'),
('Md. Ashiqur Rahman', 'mdashik.main.id@gmail.com', '$2y$10$4q7GGAfzfmAtpEVn8xY/TOKKOkvN95/L2BSKVEhFwPhzNbjubxGde'),
('Rayhan', 'mdashik1401@gmail.com', '$2y$10$hGzVBfchBRney9/7kjp8kuHl9lR2/ljyBc.LuSka1bt9A9eu4ieK6'),
('Meow', 'meow@admin.com', '$2y$10$Q3VU0KxKTbHki7.QWoh4i.KmNrv1MVcFOsHgjDKj2naeeuBMMM6yu');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `name` varchar(255) NOT NULL,
  `nid_no` varchar(255) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `vehicle_chassis_no` varchar(255) NOT NULL,
  `present_addr` varchar(255) NOT NULL,
  `permanent_addr` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `nid_softcopy` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`name`, `nid_no`, `vehicle_no`, `vehicle_chassis_no`, `present_addr`, `permanent_addr`, `profile_pic`, `nid_softcopy`, `id`, `email`) VALUES
('Mehedi', 'w454356', '5435', '5424', 'BBDD', 'PREEF', './uploads/ashiqur35-3162@diu.edu.bd.jpg', './uploads/ashiqur35-3162@diu.edu.bd.pdf', 3, 'ashiqur35-3162@diu.edu.bd'),
('Md. Ashiqur Rahman', '3642', '326', '56465', 'Mitford Hospital Class-3 Staff Colony, Babu Bazar, Dhaka-1100', 'DHAKA', './uploads/mdashik.main.id@gmail.com.png', './uploads/mdashik.main.id@gmail.com.pdf', 2, 'mdashik.main.id@gmail.com'),
('Rayhan', '123456', '2546', '326', 'Dhaka', 'bd', './uploads/mdashik1401@gmail.com.png', './uploads/mdashik1401@gmail.com.pdf', 1, 'mdashik1401@gmail.com'),
('Test two', '34545756', '436456', '435f', 'dhaka', 'dhaka', './uploads/test@gmail.com.jpg', './uploads/test@gmail.com.pdf', 4, 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`email`),
  ADD KEY `INDEX` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
