-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2017 at 07:50 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_item`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(6) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `account_access` tinyint(1) NOT NULL,
  `registered_at` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(128) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `reset_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `firstname`, `lastname`, `username`, `password`, `status`, `account_access`, `registered_at`, `email`, `image`, `verification_code`, `is_verified`, `reset_code`) VALUES
(1, 'test', 'test', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1, 0, 'rylee.jeff385@gmail.com', '', 'rZTKE', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(12) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_desc` text NOT NULL,
  `item_price` float(8,2) NOT NULL,
  `item_image` varchar(128) NOT NULL,
  `item_added_at` int(11) NOT NULL,
  `item_updated_at` int(11) NOT NULL,
  `item_slug` varchar(128) NOT NULL,
  `item_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `item_desc`, `item_price`, `item_image`, `item_added_at`, `item_updated_at`, `item_slug`, `item_status`) VALUES
(1, 'Strawberry', 'Stras', 15.00, '', 1505557572, 1506877358, 'strawberry', '0'),
(2, 'Banana', 'Banana', 11.00, '', 1505557581, 1506875685, 'banana-1', '0'),
(3, 'Apple', 'New desc', 12.00, '', 1505557595, 1506875428, 'apple', '0'),
(4, 'Apple', 'New desc', 12.00, '', 1505557608, 1506877349, 'apple-1', '0'),
(5, 'Apple', 'Testa', 12.00, '', 1506952432, 1508225476, 'apple-3', '1'),
(6, 'Strawberry', 'xd', 15.00, '', 1506952444, 1506954686, 'strawberry-1', '1'),
(7, 'Orange', '123a', 14.00, '', 1506952454, 1508226472, 'orange', '0'),
(8, 'Charlyn Ann', '123', 123.00, '', 1506954693, 1506954693, 'charlyn-ann', '0'),
(9, 'Apple', 'Test', 12.00, '', 1508226485, 1508564832, 'apple-2', '1'),
(10, 'test', 'test', 12.00, '', 1508563522, 1508564809, 'test', '1'),
(11, 'test', 'test', 12.00, '', 1508564933, 1508564938, 'test-2', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
