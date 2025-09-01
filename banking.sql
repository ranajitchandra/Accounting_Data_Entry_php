-- phpMyAdmin SQL Dump (Fixed with Proper Primary Keys)
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `banking`;
CREATE DATABASE `banking` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banking`;

-- -------------------------
-- Table structure for costing
-- -------------------------
CREATE TABLE `costing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(50) NOT NULL,
  `vandor_id` int(11) NOT NULL,
  `costing_amount` int(11) NOT NULL,
  `costing_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `new` (`vandor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- -------------------------
-- Table structure for deposit
-- -------------------------
CREATE TABLE `deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deposit_name` varchar(30) NOT NULL,
  `project_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `deposit_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `p_d` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `deposit` (`id`, `deposit_name`, `project_id`, `amount`, `deposit_date`) VALUES
(5, 'komol', 9, 1500, '2024-02-27'),
(6, 'Ranajit', 14, 1000, '2024-02-28'),
(7, 'Sagor', 10, 2000, '2024-03-01'),
(8, 'joy', 11, 1000, '2024-02-13'),
(11, 'Sagor', 12, 500, '2024-02-21'),
(12, 'jhon', 12, 1000, '2024-02-22'),
(13, 'Sobuj', 9, 2000, '2024-02-22');

-- -------------------------
-- Table structure for dev_tool
-- -------------------------
CREATE TABLE `dev_tool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `big_title` varchar(12) NOT NULL,
  `mini_title` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dev_tool` (`id`, `big_title`, `mini_title`) VALUES
(1, 'South11', 'C');

-- -------------------------
-- Table structure for materials
-- -------------------------
CREATE TABLE `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(30) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `m_amount` int(11) NOT NULL,
  `m_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `p_m` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `materials` (`id`, `material_name`, `type`, `description`, `project_id`, `m_amount`, `m_date`) VALUES
(1, 'Melamine', 'Wood', 'Wood Naturial Thinks', 9, 100, '2024-02-26'),
(2, 'barmatik', 'Wood', 'Wood Better Feel', 10, 200, '2024-02-20'),
(4, 'Light2', 'Electronic', 'High light', 9, 100, '2024-02-22'),
(5, 'Light3', 'Electronic', 'High light', 9, 200, '2024-02-21');

-- -------------------------
-- Table structure for office_cost
-- -------------------------
CREATE TABLE `office_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(50) NOT NULL,
  `project_id` int(11) NOT NULL,
  `office_amount` int(11) NOT NULL,
  `office_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `p_o` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `office_cost` (`id`, `details`, `project_id`, `office_amount`, `office_date`) VALUES
(1, 'KFC Food', 9, 400, '2024-02-16'),
(2, 'Casual', 9, 200, '2024-02-15'),
(11, 'baseball22', 10, 100, '2024-02-15'),
(12, 'Holder', 10, 200, '2024-02-21');

-- -------------------------
-- Table structure for project
-- -------------------------
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `starting_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `project` (`id`, `project_name`, `address`, `starting_date`) VALUES
(9, 'Mirpur', 'Mirpur', '2024-02-17'),
(10, 'Star kabab', 'Dhaka', '2024-02-16'),
(11, 'Noyakhali', 'Feni tangrood', '2024-02-14'),
(12, 'barishal', 'Sylhet', '2024-02-15'),
(14, 'Super Star', 'Dhaka', '2024-02-20'),
(16, 'Motlob', 'Super, dhaka', '2024-02-23');

-- -------------------------
-- Table structure for user
-- -------------------------
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_role` varchar(30) NOT NULL DEFAULT 'general',
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `user_name`, `email`, `user_role`, `password`) VALUES
(1, 'rono', 'rono@gmail.com', 'root_admin', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'rono23', 'rono23@gmail.com', 'root_admin', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Mohid', 'mohid@gmail.com', 'general', 'e10adc3949ba59abbe56e057f20f883e'),
(14, 'maya', 'bini@gmail.com', 'general', 'e10adc3949ba59abbe56e057f20f883e');

-- -------------------------
-- Table structure for vandor
-- -------------------------
CREATE TABLE `vandor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vandor_name` varchar(30) NOT NULL,
  `project_id` int(11) NOT NULL,
  `joining_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Test` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- -------------------------
-- Foreign Keys
-- -------------------------
ALTER TABLE `costing`
  ADD CONSTRAINT `new` FOREIGN KEY (`vandor_id`) REFERENCES `vandor` (`id`);

ALTER TABLE `deposit`
  ADD CONSTRAINT `p_d` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

ALTER TABLE `materials`
  ADD CONSTRAINT `p_m` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

ALTER TABLE `office_cost`
  ADD CONSTRAINT `p_o` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

ALTER TABLE `vandor`
  ADD CONSTRAINT `Test` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

COMMIT;
