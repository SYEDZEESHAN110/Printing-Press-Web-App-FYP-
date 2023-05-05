-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2022 at 09:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin123', '2022-08-18 10:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `shop_id` int NOT NULL,
  `account_number` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `account_title`, `shop_id`, `account_number`, `bank_name`) VALUES
(2, 'Current', 2, '00123456789', 'NBP');

-- --------------------------------------------------------

--
-- Table structure for table `extra_cost`
--

CREATE TABLE `extra_cost` (
  `Id` int NOT NULL,
  `RGB` float NOT NULL,
  `CMYK` float NOT NULL,
  `grayscale` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extra_cost`
--

INSERT INTO `extra_cost` (`Id`, `RGB`, `CMYK`, `grayscale`) VALUES
(1, 305, 400, 252);

-- --------------------------------------------------------

--
-- Table structure for table `print_request`
--

CREATE TABLE `print_request` (
  `id` int NOT NULL,
  `type` varchar(200) NOT NULL,
  `paper_quality` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `color_scheme` varchar(10) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `design` varchar(200) NOT NULL,
  `shop_id` int NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_reciept` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `is_done` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `print_request`
--

INSERT INTO `print_request` (`id`, `type`, `paper_quality`, `size`, `quantity`, `color_scheme`, `phone_number`, `design`, `shop_id`, `payment_method`, `created_at`, `payment_reciept`, `is_done`) VALUES
(12, 'Receipt', '60# White Smooth Offset', '15.88 × 23.50 cm', 10, 'RGB', '+923165667642', 'upload/1670687703cleaning.jpg', 2, 'bank', '2022-12-10 15:55:03', 'upload/1670687703auto-services.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `price`) VALUES
(5, 'Tax Invoice', 'upload/1662036132tax-invoice.jpg', 200),
(6, 'Receipt', 'upload/1662036159receipt.jpg', 230),
(7, 'Poster', 'upload/1662036181poster.jpg', 1000),
(8, 'Panaflex', 'upload/1662036201panaflex.jpg', 1200),
(9, 'Business Card', 'upload/1662036238busniess-card.jpg', 500),
(10, 'Brochure', 'upload/1662036274broucher.jpg', 2050);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4  NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `phone_number` varchar(100) CHARACTER SET utf8mb4  DEFAULT NULL,
  `shop_name` varchar(100) NOT NULL,
  `shop_city` varchar(100) NOT NULL,
  `shop_address` text NOT NULL,
  `shop_lat` float NOT NULL,
  `shop_lon` float NOT NULL,
  `easypaisa_number` varchar(20) CHARACTER SET utf8mb4 COLLATE DEFAULT NULL,
  `jazzcash_number` varchar(20) CHARACTER SET utf8mb4 COLLATE DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `email`, `password`, `gender`, `phone_number`, `shop_name`, `shop_city`, `shop_address`, `shop_lat`, `shop_lon`, `easypaisa_number`, `jazzcash_number`) VALUES
(2, 'Hamza', 'hamza@gmail.com', 'pak', 'Male', '+923339859475', 'Print There', 'Islamabad', '7th avenue, street 10, F8', 33.7131, 73.0919, '123456789', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'noumanhabib521@gmail.com'),
(4, 'noumanhabib5211@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_cost`
--
ALTER TABLE `extra_cost`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `print_request`
--
ALTER TABLE `print_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extra_cost`
--
ALTER TABLE `extra_cost`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `print_request`
--
ALTER TABLE `print_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
