-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 02:58 PM
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
-- Database: `electro`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Laptops'),
(2, 'PC\'s');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_name`, `created_at`, `category_id`) VALUES
(5, 'dwdq', 'ewqeqwewq', 21.00, '1744472439_9b65d8cd25d33c08deae.png', 'Laptops', '2025-04-12 15:40:39', 1),
(6, 'testuser', 'ewqe w', 12.00, '1744472463_51c85277df09ad8c009c.png', 'PC\'s', '2025-04-12 15:41:03', 2),
(7, 'sasda', 'dasda', 21.00, '1744474042_345d2c861befd3277e05.png', 'Laptops', '2025-04-12 16:07:22', 1),
(8, 'Hp', 'fsdfsrr', 32.00, '1744474117_dfb79021d312630b749a.png', 'Laptops', '2025-04-12 16:08:37', 1),
(9, 'fre', 'dsadsad', 21.00, '1744476266_8a931d6732fd9538366f.png', 'Laptops', '2025-04-12 16:44:26', 1),
(10, 'test1', 'dasdas', 21.00, '1744476633_9081523f3791113e4b14.png', 'Laptops', '2025-04-12 16:50:33', 1),
(11, 'Thinker', 'Lenovo Thinkerpad', 150.00, '1744511414_bb5aad2e1f82c4fe872b.jpeg', 'Laptops', '2025-04-13 02:30:14', 1),
(12, 'wqeqwe', 'ewqewqe', 123.00, '1744720644_9da512d87a8fee0e653a.png', 'Laptops', '2025-04-15 12:37:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_specs`
--

CREATE TABLE `product_specs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `spec_key` varchar(100) NOT NULL,
  `spec_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_specs`
--

INSERT INTO `product_specs` (`id`, `product_id`, `spec_key`, `spec_value`) VALUES
(1, 9, 'Screen Size', 'dasdas'),
(2, 10, 'Brand', 'HP'),
(3, 10, 'Model', 'dasdas'),
(4, 10, 'Processor', 'dasd'),
(5, 10, 'RAM', '12GB'),
(6, 10, 'Storage', 'dsadsa'),
(7, 10, 'Graphics Card', 'dasda'),
(8, 10, 'Screen Size', 'asdasd'),
(9, 11, 'Brand', 'Lenovo'),
(10, 11, 'Model', 'Lenovo M3'),
(11, 11, 'Processor', 'I7'),
(12, 11, 'RAM', '16GB'),
(13, 11, 'Storage', '1TB'),
(14, 11, 'Graphics Card', '4GB'),
(15, 11, 'Screen Size', '15'),
(16, 12, 'Brand', 'ewqewq'),
(17, 12, 'Model', 'wedwqedwq'),
(18, 12, 'Processor', 'ewqedwq'),
(19, 12, 'RAM', 'dqwedqwed'),
(20, 12, 'Storage', 'wqewqewq'),
(21, 12, 'Graphics Card', 'ewqewqe'),
(22, 12, 'Screen Size', 'wqewqewq');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'udara_nilupul', 'udaranilupul02@gmail.com', '$2y$10$ay/jBiCUiMy3iwzDEf3ixejDK10ZxTMKEEEyShh9LTqsXcSVviXVy', '2025-04-11 19:35:24', '2025-04-12 01:05:24'),
(3, 'devid009', 'udadwqqranilupul02@gmail.com', '$2y$10$NY1Oa2JhgWc2TbwXtPkL8O3lSrBYoypM8agZslQJa02HX1dvVxfHG', '2025-04-11 19:50:33', '2025-04-12 01:20:33'),
(5, '2132132', 'ufdasdadaranilfdsfsfupul01@gmail.com', '$2y$10$14j9ujdKnjLn9mQvNQ1deulbAQ2sikrj72roDg6wz.z6Mo3kd7FsO', '2025-04-11 19:51:39', '2025-04-12 01:21:39'),
(6, 'udara01', 'udara@gmail.com', '$2y$10$YfUuy6FH716p5/ixV1IXM.fz0/ZWWTRcHOs0/vIW5ljfCRGm1Ch8m', '2025-04-11 20:35:00', '2025-04-12 02:05:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_specs`
--
ALTER TABLE `product_specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD CONSTRAINT `product_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
