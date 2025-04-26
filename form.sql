-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 07:35 PM
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
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` int(50) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `pname`, `image`, `cost`, `category`) VALUES
(1, 479031312, 'PayPal Logs\n', '1.png', 10, 'shopping'),
(3, 862847387, 'Visa Prepaid +Cvv', '2.png', 20, 'shopping'),
(4, 696876897, 'G2A Logs', '6.png', 8, 'cashout'),
(5, 679679576, 'Valorant Logs', '10.png', 10, 'food'),
(6, 676768968, 'OTP BOT', '13.png', 20, 'pleasure'),
(7, 676768969, 'CONFIGS OB/SVB', '14.png', 20, 'pleasure'),
(8, 676768970, 'COMBOLIST', '15.png', 20, 'pleasure'),
(10, 578876769, 'Amazon Logs', '3.png', 10, 'shopping'),
(11, 678576859, 'Binance Logs', '4.png', 30, 'shopping'),
(12, 678678587, 'Coinbase Logs', '5.png', 30, 'hot'),
(13, 678567867, 'Netflix Logs', '7.png', 15, 'cashout'),
(16, 678687679, 'Crunchyroll Logs', '8.png', 5, 'cashout'),
(17, 678687623, 'Spotify Logs', '9.png', 10, 'cashout'),
(18, 25184723, 'Amazon Store-Card', '11.png', 20, 'food'),
(19, 58667213, 'Yahoo Logs', '12.png', 10, 'food');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unique_id` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(50) NOT NULL,
  `verification_status` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `username`, `email`, `password`, `otp`, `verification_status`, `Role`) VALUES
(1, 479031312, 'Malahim', 'malahimtech@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'Verified', 'user'),
(2, 989148980, 'Ayan', 'ayangamingdelight@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'Verified', 'user'),
(3, 658274038, 'vishal', 'vishaltalreja000@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'Verified', 'user'),
(37, 895984517, 'vishal', 'vishaltalreja01@gmail.com', '8b64d2451b7a8f3fd17390f88ea35917', 0, 'Verified', 'user'),
(44, 715157848, 'hunain', 'hunain29.mem@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'Verified', 'user'),
(45, 1407217438, 'vishalkumar', 'vishal.kumar25913@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'Verified', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
