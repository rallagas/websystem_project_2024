-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2024 at 11:02 AM
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
(7, '20037458.jpg', 'Apple - Violet', 'Violet na Iphone', '20000.00', 'I'),
(8, 'close-up-fresh-apple.jpg', 'New Apple', 'Apple 1TB 2GB Memory', '34000.00', 'A');

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
  `shipper_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `alternate_receiver` varchar(100) DEFAULT NULL,
  `alternate_address` varchar(100) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_qty` int(11) NOT NULL,
  `order_phase` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 - Cart\r\n2 - Checkout\r\n3 - Pending\r\n4 - Confirmed\r\n5 - Delivered\r\n0 - Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_ref_number`, `payment_method`, `shipper_id`, `user_id`, `alternate_receiver`, `alternate_address`, `item_id`, `date_added`, `item_qty`, `order_phase`) VALUES
(7, 'TEST', 1, 0, 4, '', '', 3, '2024-04-24 08:08:18', 30, '5'),
(12, 'TEST', 1, 0, 4, '', '', 4, '2024-04-24 08:26:53', 10, '5'),
(13, 'TEST', 1, 0, 4, '', '', 3, '2024-04-24 08:26:56', 10, '5'),
(24, '83X8O4L1F', 1, 0, 7, '', '', 3, '2024-05-13 07:43:44', 1000, '5'),
(25, '83X8O4L1F', 1, 0, 7, '', '', 4, '2024-05-13 07:44:23', 2, '5'),
(26, '83X8O4L1F', 1, 0, 7, '', '', 6, '2024-05-13 07:57:44', 1, '5'),
(27, '83X8O4L1F', 1, 0, 7, '', '', 4, '2024-05-13 07:57:45', 1, '5'),
(28, '83X8O4L1F', 1, 0, 7, '', '', 3, '2024-05-13 07:57:46', 1, '5'),
(29, '83X8O4L1F', 1, 0, 7, '', '', 5, '2024-05-13 07:58:23', 1, '5'),
(30, '83X8O4L1F', 1, 0, 7, '', '', 4, '2024-05-13 07:58:24', 1, '5'),
(31, '83X8O4L1F', 1, 0, 7, '', '', 3, '2024-05-13 07:58:25', 1, '5'),
(32, '88V4N0A1R', 1, 0, 7, '', '', 4, '2024-05-13 07:59:08', 10, '5'),
(33, '58V0H1F4H', 1, 0, 7, '', '', 4, '2024-05-13 08:01:26', 100, '5'),
(34, '03X0G9Y0N', 1, 0, 7, '', '', 4, '2024-05-13 08:07:35', 1, '5'),
(35, '03X0G9Y0N', 1, 0, 7, '', '', 3, '2024-05-13 08:07:37', 1, '5'),
(36, '10Y9U6O4C', 1, 0, 7, '', '', 3, '2024-05-13 08:16:01', 1, '5'),
(37, '10Y9U6O4C', 1, 0, 7, '', '', 3, '2024-05-13 08:16:03', 1, '5'),
(38, '10Y9U6O4C', 1, 0, 7, '', '', 3, '2024-05-13 08:16:04', 1, '5'),
(39, '09A7F6X4Y', 2, 0, 7, '', '', 6, '2024-05-13 08:57:04', 100000, '5'),
(40, '09A7F6X4Y', 2, 0, 7, '', '', 5, '2024-05-13 08:57:34', 1, '5'),
(41, '09A7F6X4Y', 2, 0, 7, '', '', 3, '2024-05-13 08:58:08', 1, '5'),
(42, '09A7F6X4Y', 2, 0, 7, '', '', 2, '2024-05-13 08:58:12', 1, '5'),
(43, '09A7F6X4Y', 2, 0, 7, '', '', 4, '2024-05-13 08:58:16', 1, '5'),
(44, '70J9E0M2B', 2, 0, 7, '', '', 5, '2024-05-13 08:58:50', 1, '5'),
(45, '50C9T6I9H', 1, 0, 7, '', '', 5, '2024-05-13 09:17:45', 1, '5'),
(46, '50C9T6I9H', 1, 0, 7, '', '', 4, '2024-05-13 09:17:47', 1, '5'),
(47, '50C9T6I9H', 1, 0, 7, '', '', 2, '2024-05-13 09:17:49', 1, '5'),
(48, '50C9T6I9H', 1, 0, 7, '', '', 3, '2024-05-13 09:17:52', 1, '5'),
(49, '40W2N0J4N', 1, 0, 8, '', '', 8, '2024-05-14 00:26:01', 1, '5'),
(50, '40W2N0J4N', 1, 0, 8, '', '', 5, '2024-05-14 00:26:04', 1, '5'),
(51, '40W2N0J4N', 1, 0, 8, '', '', 4, '2024-05-14 00:26:07', 1, '5'),
(52, '40W2N0J4N', 1, 0, 8, '', '', 6, '2024-05-14 00:26:09', 1, '5'),
(53, '40W2N0J4N', 1, 0, 8, '', '', 6, '2024-05-14 00:26:16', 2, '5'),
(54, '07M3N0V2', 1, 0, 8, '', '', 5, '2024-05-14 00:30:27', 1, '5'),
(55, '07M3N0V2', 1, 0, 8, '', '', 6, '2024-05-14 00:45:08', 100, '5'),
(57, '90O0Q6H4', 1, 0, 8, '', '', 6, '2024-05-14 01:05:37', 1, '5'),
(58, '77W2K4X2', 1, 0, 8, 'Reymar Llagas', 'Napo Polangui Albay', 5, '2024-05-14 01:08:25', 1, '5'),
(59, '77W2K4X2', 1, 0, 8, 'Reymar Llagas', 'Napo Polangui Albay', 4, '2024-05-14 01:08:26', 1, '5'),
(60, '56G8Z9T9', 1, 1, 8, '', '', 4, '2024-05-14 01:21:14', 1, '5'),
(61, '56G8Z9T9', 1, 1, 8, '', '', 4, '2024-05-14 01:21:17', 5, '5'),
(62, '06V2S3Q2', 1, 1, 8, '', '', 8, '2024-05-15 07:19:13', 1, '5'),
(63, '06V2S3Q2', 1, 1, 8, '', '', 6, '2024-05-15 07:19:14', 1, '5'),
(64, '06V2S3Q2', 1, 1, 8, '', '', 5, '2024-05-15 07:19:15', 1, '5'),
(65, '06V2S3Q2', 1, 1, 8, '', '', 4, '2024-05-15 07:19:16', 1, '5'),
(66, '06V2S3Q2', 1, 1, 8, '', '', 2, '2024-05-15 07:22:07', 1, '5'),
(67, '39R3A8U8', 1, 1, 8, '', '', 8, '2024-05-16 07:30:55', 1, '5'),
(68, '39R3A8U8', 1, 1, 8, '', '', 6, '2024-05-16 07:30:56', 1, '5'),
(69, '39R3A8U8', 1, 1, 8, '', '', 5, '2024-05-16 07:30:57', 1, '5'),
(70, '39R3A8U8', 1, 1, 8, '', '', 4, '2024-05-16 07:30:58', 1, '5'),
(71, '39R3A8U8', 1, 1, 8, '', '', 4, '2024-05-16 07:31:01', 10, '5'),
(72, '77U3E3H4', 1, 1, 8, '', '', 6, '2024-05-16 07:37:23', 7, '5'),
(73, '25D6S3F0', 1, 1, 8, '', '', 8, '2024-05-16 07:58:42', 1, '5'),
(81, '67A0K8F4', 1, 1, 8, '', '', 4, '2024-05-16 08:07:27', 1, '5'),
(82, '67A0K8F4', 1, 1, 8, '', '', 4, '2024-05-16 08:07:31', 1000, '5'),
(83, '00C2Q8V0', 1, 1, 8, '', '', 4, '2024-05-16 08:09:58', 1, '5'),
(84, '00C2Q8V0', 1, 1, 8, '', '', 5, '2024-05-16 08:09:59', 1, '5'),
(85, '30P2X0T5', 1, 1, 9, '', '', 8, '2024-05-16 08:11:39', 1, '0'),
(86, '00S6F0O0', 1, 1, 9, '', '', 5, '2024-05-16 08:24:05', 1, '5'),
(87, '00S6F0O0', 1, 1, 9, '', '', 4, '2024-05-16 08:24:06', 1, '5');

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
(2, 'COD', 'A'),
(3, 'Debit', 'A'),
(4, 'Credit Card', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `shipper_id` int(11) NOT NULL,
  `shipping_company` varchar(55) NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_company_cd` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`shipper_id`, `shipping_company`, `shipping_address`, `shipping_company_cd`) VALUES
(1, 'J&T Express', NULL, 'JTX'),
(2, 'Flash Express', NULL, 'FX'),
(3, 'SPX', 'Shoppee Express', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_per_date`
-- (See below for the actual view)
--
CREATE TABLE `total_per_date` (
`transaction_date` date
,`total_item_qty` decimal(32,0)
,`total_amt` decimal(39,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_per_order`
-- (See below for the actual view)
--
CREATE TABLE `total_per_order` (
`order_ref_number` varchar(9)
,`total_item_qty` decimal(32,0)
,`total_amt` decimal(39,2)
);

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
(7, 'OnlyTest', '1234', 'Test Only', 'test address', '1234', 'M', '2024-05-08 07:48:09', 'A', 'C'),
(8, 'eli', '1234', 'Eligible Client', 'Barobo Jupiter', '0999999999', 'M', '2024-05-14 00:25:11', 'A', 'C'),
(9, 'elicli', '1234', 'Eligible Client', 'Polangui Albay', '09900902', 'M', '2024-05-16 08:11:25', 'A', 'C');

-- --------------------------------------------------------

--
-- Structure for view `total_per_date`
--
DROP TABLE IF EXISTS `total_per_date`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `total_per_date`  AS   (select cast(`o`.`date_added` as date) AS `transaction_date`,sum(`o`.`item_qty`) AS `total_item_qty`,sum(`i`.`item_price` * `o`.`item_qty`) AS `total_amt` from (`orders` `o` join `items` `i` on(`o`.`item_id` = `i`.`items_id`)) group by cast(`o`.`date_added` as date) order by cast(`o`.`date_added` as date) desc)  ;

-- --------------------------------------------------------

--
-- Structure for view `total_per_order`
--
DROP TABLE IF EXISTS `total_per_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `total_per_order`  AS   (select `o`.`order_ref_number` AS `order_ref_number`,sum(`o`.`item_qty`) AS `total_item_qty`,sum(`i`.`item_price` * `o`.`item_qty`) AS `total_amt` from (`orders` `o` join `items` `i` on(`o`.`item_id` = `i`.`items_id`)) group by `o`.`order_ref_number`)  ;

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
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`shipper_id`);

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
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_statuses`
--
ALTER TABLE `item_statuses`
  MODIFY `item_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `shipper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
