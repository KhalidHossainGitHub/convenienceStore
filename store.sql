-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2024 at 04:34 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout_info`
--

DROP TABLE IF EXISTS `checkout_info`;
CREATE TABLE IF NOT EXISTS `checkout_info` (
  `Customer_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `Phone_Number` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_name`, `quantity`, `price`) VALUES
(1001, 'Pringles', 45, '2'),
(1002, 'Hershey Bar', 50, '2'),
(1003, 'Lays Chips', 40, '4'),
(1004, 'Coca-Cola', 50, '2'),
(1005, 'Red Bull', 40, '4'),
(1006, 'Sparkling Water', 50, '3'),
(1007, 'iPhone Charger', 50, '25'),
(1008, 'Cigarettes', 80, '20'),
(1009, 'Chapstick', 30, '6');

-- --------------------------------------------------------

--
-- Table structure for table `passport_picture_bookings`
--

DROP TABLE IF EXISTS `passport_picture_bookings`;
CREATE TABLE IF NOT EXISTS `passport_picture_bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bookingDate` date NOT NULL,
  `bookingTime` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
