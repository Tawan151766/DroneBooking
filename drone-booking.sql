-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 08:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drone-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` date DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `drone_id` int(11) DEFAULT NULL,
  `des` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_date`, `booking_time`, `customer_id`, `drone_id`, `des`) VALUES
(2, '2023-06-05', '2023-06-08', 1, 1, ''),
(3, '2023-06-06', '2023-06-30', 1, 1, ''),
(4, '2023-06-06', '2023-06-30', 1, 1, ''),
(5, '2023-06-06', '2023-06-08', 1, 0, ''),
(6, '2023-06-07', '2023-06-08', 1, 1, ''),
(7, '2023-06-28', '2023-06-30', 1, 1, ''),
(9, '2023-06-10', '2023-06-11', 3, 1, 'คุณ ตะวัน ที่หนองบัว'),
(10, '2023-06-10', '2023-07-08', 13, 2, ''),
(12, '2023-06-06', '2023-06-07', 1, 1, ''),
(13, '2023-06-06', '2023-06-06', 1, 1, ''),
(14, '2023-06-13', '2023-06-13', 1, 1, ''),
(15, '2023-06-06', '2023-06-06', 1, 1, ''),
(16, '2023-06-13', '2023-06-13', 1, 1, ''),
(17, '2023-06-06', '2023-06-06', 1, 1, ''),
(18, '2023-06-13', '2023-06-13', 1, 1, ''),
(19, '2023-06-07', '2023-06-30', 1, 1, ''),
(20, '2023-06-06', '2023-06-06', 14, 2, 'ที่วังแรก 1 ล้านไร่'),
(21, '2023-06-06', '2023-06-06', 0, 1, 'พังงา\r\n'),
(22, '2023-06-07', '2023-06-07', 0, 1, 'พังงา\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `phone`, `address`, `comment`) VALUES
(0, 'Tawan', 123456789, 'Nongbua', 'test'),
(14, 'yoshi', 1234, 'nakhinsawan', 'no comment');

-- --------------------------------------------------------

--
-- Table structure for table `drones`
--

CREATE TABLE `drones` (
  `drone_id` int(11) NOT NULL,
  `drone_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drones`
--

INSERT INTO `drones` (`drone_id`, `drone_name`) VALUES
(1, 'UAV 50x Zoom Aerial Photography Drone'),
(3, 'DJI MINI 3 Pro.'),
(4, 'DJI MINI 3 Pro.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '1234', '2023-06-05 01:40:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `drones`
--
ALTER TABLE `drones`
  ADD PRIMARY KEY (`drone_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `drones`
--
ALTER TABLE `drones`
  MODIFY `drone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
