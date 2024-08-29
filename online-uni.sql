-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 10:30 AM
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
-- Database: `online-uni`
--
CREATE DATABASE IF NOT EXISTS `online-uni` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `online-uni`;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `dob` datetime DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `bio` mediumtext DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'lecturer',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `email`, `password`, `username`, `dob`, `gender`, `address`, `department`, `faculty`, `bio`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Daniel Botchway', 'admin@gmail.com', '$2y$10$pfmPlX4ZxZE8bgubGJf5K..CDIr0kduZHnERVf2.mnXKiWmwEQdU6', '12345', '0000-00-00 00:00:00', 'Male', 'Hello there', 'BIT', 'FOCIS', 'Professor of Computer Science with 10 years of experience.', 'lecturer', '2024-08-29 01:15:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `dob` datetime DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `bio` mediumtext DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'student',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `username`, `dob`, `gender`, `address`, `department`, `faculty`, `bio`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Daniel Botchway', 'student@gmail.com', '$2y$10$J0H9aY0McuqGfwLO/1790uv.SyIjH1PtAt59F9CkbZC3vZHdyaigu', '12345', '2024-08-07 08:02:38', 'Male', 'Ghana Accra', 'BIT', 'FOCIS', 'Hello', 'student', '2024-08-29 10:02:38', '2024-08-29 10:02:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
