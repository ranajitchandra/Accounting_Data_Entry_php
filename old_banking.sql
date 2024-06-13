-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 02:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `costing`
--

CREATE TABLE `costing` (
  `id` int(11) NOT NULL,
  `details` varchar(50) NOT NULL,
  `vandor_id` int(11) NOT NULL,
  `costing_amount` int(11) NOT NULL,
  `costing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `costing`
--

INSERT INTO `costing` (`id`, `details`, `vandor_id`, `costing_amount`, `costing_date`) VALUES
(2, 'Paint', 4, 20, '2024-02-22'),
(3, 'Woord', 1, 20, '2024-02-20'),
(4, 'Extra', 5, 40, '2024-02-15'),
(5, 'Food', 5, 45, '2024-02-15'),
(6, 'Self Buy', 5, 55, '2024-02-15'),
(8, 'Concrite', 8, 30, '2024-02-23'),
(9, 'Tiles', 4, 300, '2024-03-01'),
(12, 'Little BIT', 1, 300, '2024-02-21'),
(13, 'Wood', 11, 500, '2024-02-23'),
(14, 'color', 12, 300, '2024-02-19'),
(15, 'Flawerr Top', 7, 500, '2024-02-17'),
(16, 'Canvas', 7, 456, '2024-02-23'),
(17, 'Best Contton', 7, 300, '2024-02-16'),
(18, 'Little BIT', 7, 456, '2024-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `deposit_name` varchar(30) NOT NULL,
  `project_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `deposit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `deposit_name`, `project_id`, `amount`, `deposit_date`) VALUES
(5, 'komol', 9, 1500, '2024-02-27'),
(6, 'Ranajit', 14, 1000, '2024-02-28'),
(7, 'Sagor', 10, 2000, '2024-03-01'),
(8, 'joy', 11, 1000, '2024-02-13'),
(11, 'Sagor', 12, 500, '2024-02-21'),
(12, 'jhon', 12, 1000, '2024-02-22'),
(13, 'Sobuj', 9, 2000, '2024-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `material_name` varchar(30) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `m_amount` int(11) NOT NULL,
  `m_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `material_name`, `type`, `description`, `project_id`, `m_amount`, `m_date`) VALUES
(1, 'Melamine', 'Wood', 'Wood Naturial Thinks', 9, 100, '2024-02-26'),
(2, 'barmatik', 'Wood', 'Wood Better Feel', 10, 200, '2024-02-20'),
(4, 'Light2', 'Electronic', 'High light', 9, 100, '2024-02-22'),
(5, 'Light3', 'Electronic', 'High light', 9, 200, '2024-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `office_cost`
--

CREATE TABLE `office_cost` (
  `id` int(11) NOT NULL,
  `details` varchar(50) NOT NULL,
  `project_id` int(11) NOT NULL,
  `office_amount` int(11) NOT NULL,
  `office_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office_cost`
--

INSERT INTO `office_cost` (`id`, `details`, `project_id`, `office_amount`, `office_date`) VALUES
(1, 'KFC Food', 9, 400, '2024-02-16'),
(2, 'Casual', 9, 200, '2024-02-15'),
(11, 'baseball22', 10, 100, '2024-02-15'),
(12, 'Holder', 10, 200, '2024-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `starting_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `address`, `starting_date`) VALUES
(9, 'Mirpur', 'Mirpur', '2024-02-17'),
(10, 'Star kabab', 'Dhaka', '2024-02-16'),
(11, 'Noyakhali', 'Feni tangrood', '2024-02-14'),
(12, 'barishal', 'Sylhet', '2024-02-15'),
(14, 'Super Star', 'Dhaka', '2024-02-20'),
(16, 'Motlob', 'Super, dhaka', '2024-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_role` varchar(30) NOT NULL DEFAULT 'general',
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `user_role`, `password`) VALUES
(1, 'rono', 'rono@gmail.com', 'root_admin', '123456'),
(5, 'Mohid', 'mohid@gmail.com', 'general', '123456'),
(13, 'rono23', 'rono23@gmail.com', 'general', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `vandor`
--

CREATE TABLE `vandor` (
  `id` int(11) NOT NULL,
  `vandor_name` varchar(30) NOT NULL,
  `project_id` int(11) NOT NULL,
  `joining_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vandor`
--

INSERT INTO `vandor` (`id`, `vandor_name`, `project_id`, `joining_date`) VALUES
(1, 'kamal', 9, '2024-02-13'),
(3, 'Ranajit', 9, '2024-02-16'),
(4, 'Rana', 10, '2024-02-23'),
(5, 'Komol', 9, '2024-02-29'),
(6, 'Komol', 10, '2024-02-12'),
(7, 'Komol', 11, '2024-02-04'),
(8, 'Komol', 12, '2024-02-03'),
(11, 'Mamun', 14, '2024-02-20'),
(12, 'arafath', 14, '2024-02-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `costing`
--
ALTER TABLE `costing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new` (`vandor_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_d` (`project_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_m` (`project_id`);

--
-- Indexes for table `office_cost`
--
ALTER TABLE `office_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_o` (`project_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vandor`
--
ALTER TABLE `vandor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Test` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `costing`
--
ALTER TABLE `costing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office_cost`
--
ALTER TABLE `office_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vandor`
--
ALTER TABLE `vandor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `costing`
--
ALTER TABLE `costing`
  ADD CONSTRAINT `new` FOREIGN KEY (`vandor_id`) REFERENCES `vandor` (`id`);

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `p_d` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `p_m` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `office_cost`
--
ALTER TABLE `office_cost`
  ADD CONSTRAINT `p_o` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `vandor`
--
ALTER TABLE `vandor`
  ADD CONSTRAINT `Test` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
