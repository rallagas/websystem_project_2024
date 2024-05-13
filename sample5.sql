-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2024 at 11:12 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample5`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `item_img` varchar(255) DEFAULT NULL,
  `item_name` varchar(55) NOT NULL,
  `item_desc` text NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `item_img`, `item_name`, `item_desc`, `item_price`, `item_status`) VALUES
(1, 'apple-red.jpg', 'Apple - Red', 'Test Only', '100.00', 'I'),
(2, 'green_apple.jpg', 'Apple - Green', 'Apol pradaks', '40000.00', 'A'),
(3, 'apple-hilaw.jpg', 'Apple - Hilaw', 'Mango', '30000.00', 'A'),
(4, 'kamote_apple.jpg', 'Apple - Kamote', '1TB M1 Processor', '65000.00', 'A'),
(5, 'fuji_apple.jpg', 'Apple - Fuji', 'New release', '30000.00', 'A'),
(6, 'apple_orange.jpg', 'Apple - Orange', '1 TB M1', '35000.00', 'A'),
(7, '20037458.jpg', 'Apple - Violet', 'Violet na Iphone', '20000.00', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `item_statuses`
--

CREATE TABLE `item_statuses` (
  `item_status_id` int(11) NOT NULL,
  `item_status_cd` char(1) NOT NULL,
  `item_status_desc` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_statuses`
--

INSERT INTO `item_statuses` (`item_status_id`, `item_status_cd`, `item_status_desc`) VALUES
(1, 'A', 'Active'),
(2, 'I', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `order_ref_number` varchar(9) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_qty` int(11) NOT NULL,
  `order_phase` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 - Cart\r\n2 - Checkout\r\n3 - Pending\r\n4 - Confirmed\r\n5 - Delivered\r\n0 - Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_ref_number`, `payment_method`, `user_id`, `item_id`, `date_added`, `item_qty`, `order_phase`) VALUES
(7, 'TEST', 1, 4, 3, '2024-04-24 08:08:18', 30, '2'),
(12, 'TEST', 1, 4, 4, '2024-04-24 08:26:53', 10, '2'),
(13, 'TEST', 1, 4, 3, '2024-04-24 08:26:56', 10, '2'),
(24, '83X8O4L1F', 1, 7, 3, '2024-05-13 07:43:44', 1000, '2'),
(25, '83X8O4L1F', 1, 7, 4, '2024-05-13 07:44:23', 2, '2'),
(26, '83X8O4L1F', 1, 7, 6, '2024-05-13 07:57:44', 1, '2'),
(27, '83X8O4L1F', 1, 7, 4, '2024-05-13 07:57:45', 1, '2'),
(28, '83X8O4L1F', 1, 7, 3, '2024-05-13 07:57:46', 1, '2'),
(29, '83X8O4L1F', 1, 7, 5, '2024-05-13 07:58:23', 1, '2'),
(30, '83X8O4L1F', 1, 7, 4, '2024-05-13 07:58:24', 1, '2'),
(31, '83X8O4L1F', 1, 7, 3, '2024-05-13 07:58:25', 1, '2'),
(32, '88V4N0A1R', 1, 7, 4, '2024-05-13 07:59:08', 10, '2'),
(33, '58V0H1F4H', 1, 7, 4, '2024-05-13 08:01:26', 100, '2'),
(34, '03X0G9Y0N', 1, 7, 4, '2024-05-13 08:07:35', 1, '2'),
(35, '03X0G9Y0N', 1, 7, 3, '2024-05-13 08:07:37', 1, '2'),
(36, '10Y9U6O4C', 1, 7, 3, '2024-05-13 08:16:01', 1, '2'),
(37, '10Y9U6O4C', 1, 7, 3, '2024-05-13 08:16:03', 1, '2'),
(38, '10Y9U6O4C', 1, 7, 3, '2024-05-13 08:16:04', 1, '2'),
(39, '09A7F6X4Y', 2, 7, 6, '2024-05-13 08:57:04', 100000, '2'),
(40, '09A7F6X4Y', 2, 7, 5, '2024-05-13 08:57:34', 1, '2'),
(41, '09A7F6X4Y', 2, 7, 3, '2024-05-13 08:58:08', 1, '2'),
(42, '09A7F6X4Y', 2, 7, 2, '2024-05-13 08:58:12', 1, '2'),
(43, '09A7F6X4Y', 2, 7, 4, '2024-05-13 08:58:16', 1, '2'),
(44, '70J9E0M2B', 2, 7, 5, '2024-05-13 08:58:50', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `order_phase`
--

CREATE TABLE `order_phase` (
  `order_phase_id` int(11) NOT NULL,
  `order_phase_desc` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_phase`
--

INSERT INTO `order_phase` (`order_phase_id`, `order_phase_desc`) VALUES
(1, 'Cart'),
(2, 'Checkout'),
(3, 'Pending'),
(4, 'Confirmed'),
(5, 'Delivered'),
(0, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_desc` varchar(55) NOT NULL,
  `payment_method_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method_desc`, `payment_method_status`) VALUES
(1, 'GCASH', 'A'),
(2, 'COD', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_status` char(1) NOT NULL DEFAULT 'A',
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `username`, `password`, `fullname`, `address`, `contact_no`, `gender`, `date_added`, `user_status`, `user_type`) VALUES
(1, 'sample1', '12345', 'sample lang po', 'Sample Albay', '1234566788', 'X', '2024-02-22 06:26:40', 'A', 'A'),
(2, 'sample2', '1234', 'Sample Din Po', 'Sample Albay', '87000', 'X', '2024-02-22 06:27:20', 'A', 'C'),
(4, 'rllagas', '12345', 'Reymar', 'Polangui Albay', '09985518206', 'M', '2024-04-24 07:04:59', 'A', 'C'),
(5, 'rllagas01', '12345', 'Reymar Again', 'pol', '0999999', 'M', '2024-04-24 07:06:15', 'A', 'C'),
(6, 'rllagas02', '123', 'Reymar Again', 'aknskjsdksjd', '982398293', 'M', '2024-04-24 07:07:17', 'A', 'C'),
(7, 'OnlyTest', '1234', 'Test Only', 'test address', '1234', 'M', '2024-05-08 07:48:09', 'A', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`),
  ADD KEY `item_status_items` (`item_status`);

--
-- Indexes for table `item_statuses`
--
ALTER TABLE `item_statuses`
  ADD PRIMARY KEY (`item_status_id`),
  ADD KEY `item_status_cd` (`item_status_cd`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `user_id_orders` (`user_id`),
  ADD KEY `item_id_orders` (`item_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_statuses`
--
ALTER TABLE `item_statuses`
  MODIFY `item_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_status_items` FOREIGN KEY (`item_status`) REFERENCES `item_statuses` (`item_status_cd`) ON DELETE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_id_orders` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_info_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
