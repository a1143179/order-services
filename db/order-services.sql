-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2017 at 01:22 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order-services`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `user_id`) VALUES
(2, '2017-10-09 07:30:12', 1),
(3, '2017-10-05 07:30:35', 2),
(4, '2017-10-15 10:20:16', 1),
(5, '2017-10-16 12:09:19', 2),
(6, '2017-10-16 09:09:29', 1),
(7, '2017-10-16 09:39:08', 2),
(9, '2017-10-16 13:23:54', 2),
(10, '2017-10-16 13:24:50', 2),
(13, '2017-10-16 14:34:14', 2),
(14, '2017-10-16 14:37:52', 2),
(15, '2017-10-16 14:37:59', 2),
(16, '2017-10-16 14:38:38', 2),
(17, '2017-10-16 15:01:54', 2),
(18, '2017-10-16 15:02:14', 2),
(19, '2017-10-16 15:52:17', 2),
(20, '2017-10-16 22:18:07', 2),
(21, '2017-10-16 22:18:18', 2),
(22, '2017-10-16 22:30:17', 2),
(23, '2017-10-16 22:30:58', 2),
(24, '2017-10-16 22:32:39', 2),
(25, '2017-10-16 22:33:37', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `product_id` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`product_id`, `order_id`, `quantity`) VALUES
(1, 5, 6),
(2, 2, 5),
(2, 3, 6),
(2, 4, 7),
(2, 10, 6),
(2, 13, 6),
(2, 14, 6),
(2, 15, 6),
(2, 16, 6),
(2, 17, 6),
(2, 18, 6),
(2, 19, 6),
(2, 20, 6),
(2, 21, 6),
(2, 22, 6),
(2, 23, 6),
(2, 24, 6),
(2, 25, 6),
(3, 3, 6),
(3, 6, 6),
(3, 10, 6),
(3, 13, 6),
(3, 14, 6),
(3, 15, 6),
(3, 16, 6),
(3, 17, 6),
(3, 18, 6),
(3, 19, 6),
(3, 20, 6),
(3, 21, 6),
(3, 22, 6),
(3, 23, 6),
(3, 24, 6),
(3, 25, 6),
(7, 2, 9),
(7, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `product_name` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`) VALUES
(1, 'product 1'),
(2, 'product 2'),
(3, 'product 3'),
(4, 'product 4'),
(5, 'product 5'),
(6, 'product 6'),
(7, 'product 7'),
(8, 'product 8'),
(9, 'product 9'),
(10, 'product 10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `name` varchar(300) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `address`, `name`, `phone`) VALUES
(1, 'a1143179@gmail.com', 'test address 1', 'test name 1', 'test phone number'),
(2, 'weiwangfly@hotmail.com', 'test address 2', 'test name 2', 'test phone 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD UNIQUE KEY `product_id_2` (`product_id`,`order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
