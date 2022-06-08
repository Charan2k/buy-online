-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2021 at 12:50 AM
-- Server version: 10.4.19-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u679696964_college`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lmsusers`
--

CREATE TABLE `lmsusers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isactivated` tinyint(1) NOT NULL,
  `resetpassword` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lmsusers`
--

INSERT INTO `lmsusers` (`id`, `name`, `mail`, `gender`, `role`, `password`, `mobile`, `isactivated`, `resetpassword`) VALUES
(1, 'Owner', 'owner@gmail.com', 'male', 0, '4c1029697ee358715d3a14a2add817c4b01651440de808371f78165ac90dc581', '9999999999', 1, 1),
(2, 'Customer', 'customer@gmail.com', 'male', 1, 'b6c45863875e34487ca3c155ed145efe12a74581e27befec5aa661b8ee8ca6dd', '8888888888', 1, 0),
(3, 'prasad', 'prasadangadi998@gmail.com', 'male', 1, '85d32f72e2b51a60ef305fdc1c884ae563d7db5df27a9383ce5a92b4c4834af2', '7019913422', 1, 0),
(4, 'charan', 'abc@abc.com', 'male', 1, 'f7a14151842dd8ca875c7c3042f24efd8c5c6d5f15099850730dc1f77741873b', '1111111111', 0, 0),
(5, 'charan', 'charancmrit@gmail.com', 'male', 1, 'f7a14151842dd8ca875c7c3042f24efd8c5c6d5f15099850730dc1f77741873b', '1111111111', 1, 0),
(6, 'suraj', 'suryarudra13@gmail.com', 'male', 0, 'f7a14151842dd8ca875c7c3042f24efd8c5c6d5f15099850730dc1f77741873b', '1111111111', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `store_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `store_id`, `created_on`, `item_name`, `item_price`, `quantity`, `store_name`, `store_address`) VALUES
(1, 2, 2, '2021-04-29 20:56:08', 'Thumsup Can', '35.00', 1, 'Ratnadeep Supermarket', 'Near Colive, Gacchibowli, Hyderabad'),
(2, 2, 1, '2021-04-29 20:56:08', 'Kurkere Chilli Chatka', '20.00', 2, 'More Supermarket', 'Madhapur, Hyderabad, 500085'),
(3, 3, 1, '2021-05-31 14:58:25', 'Kurkere Chilli Chatka', '20.00', 1, 'More Supermarket', 'Madhapur, Hyderabad, 500085'),
(4, 2, 1, '2021-08-09 23:53:29', 'Kurkere Chilli Chatka', '20.00', 1, 'More Supermarket', 'Madhapur, Hyderabad, 500085'),
(5, 2, 1, '2021-08-10 00:34:23', 'Maaza', '45.25', 1, 'More Supermarket', 'Madhapur, Hyderabad, 500085');

-- --------------------------------------------------------

--
-- Table structure for table `store_info`
--

CREATE TABLE `store_info` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_info`
--

INSERT INTO `store_info` (`store_id`, `store_name`, `store_address`) VALUES
(1, 'More Supermarket', 'Madhapur, Hyderabad, 500085'),
(2, 'Ratnadeep Supermarket', 'Near Colive, Gacchibowli, Hyderabad'),
(3, 'Wallmart', 'Sunderland Central');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_img` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`item_id`, `store_id`, `item_name`, `item_price`, `item_img`) VALUES
(1, 1, 'Kurkere Chilli Chatka', '20.00', '1kurkere.jpeg'),
(2, 2, 'Thumsup Can', '35.00', '2images (1).jpeg'),
(3, 3, 'Pizza', '2.00', '3Screenshot 2021-06-02 at 4.17.30 PM.png'),
(4, 1, 'Maaza', '45.25', '1maaza-mango-soft-drink-500x500.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `lmsusers`
--
ALTER TABLE `lmsusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `store_info`
--
ALTER TABLE `store_info`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `store_id` (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lmsusers`
--
ALTER TABLE `lmsusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `store_info`
--
ALTER TABLE `store_info`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `store_items` (`item_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `lmsusers` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `lmsusers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store_info` (`store_id`);

--
-- Constraints for table `store_items`
--
ALTER TABLE `store_items`
  ADD CONSTRAINT `store_items_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store_info` (`store_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
