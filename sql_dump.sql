-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2020 at 09:38 PM
-- Server version: 5.7.30-0ubuntu0.16.04.1
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE `exchange` (
  `exchange_id` int(11) NOT NULL,
  `from_country` varchar(100) NOT NULL,
  `to_country` varchar(100) NOT NULL,
  `from_currency` varchar(5) NOT NULL,
  `to_currency` varchar(5) NOT NULL,
  `rate_of_exchange` decimal(10,4) NOT NULL,
  `rate_of_exchange_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`exchange_id`, `from_country`, `to_country`, `from_currency`, `to_currency`, `rate_of_exchange`, `rate_of_exchange_date`) VALUES
(1, 'Indian Rupee', 'US Dollar', 'INR', 'USD', '75.9619', '2020-05-11 18:07:00'),
(2, 'Indian Rupee', 'Euro', 'INR', 'EUR', '82.1162', '2020-05-11 18:13:40'),
(3, 'Indian Rupee', 'British Pound', 'INR', 'GBP', '93.7028', '2020-05-11 18:07:00'),
(4, 'Indian Rupee', 'Australian Dollar', 'INR', 'AUD', '49.2389', '2020-05-11 18:13:40'),
(5, 'Indian Rupee', 'Canadian Dollar', 'INR', 'CAD', '54.1489', '2020-05-11 18:13:40'),
(17, 'US Dollar', 'Indian Rupee', 'USD', 'INR', '0.0132', '2020-05-11 18:07:00'),
(18, 'US Dollar', 'Euro', 'USD', 'EUR', '1.0807', '2020-05-11 18:13:40'),
(19, 'US Dollar', 'British Pound', 'USD', 'GBP', '1.2331', '2020-05-11 18:07:00'),
(20, 'US Dollar', 'Australian Dollar', 'USD', 'AUD', '0.6482', '2020-05-11 18:13:40'),
(21, 'US Dollar', 'Canadian Dollar', 'USD', 'CAD', '0.7128', '2020-05-11 18:13:40'),
(22, 'British Pound', 'Indian Rupee', 'GBP', 'INR', '0.0107', '2020-05-11 18:07:00'),
(23, 'British Pound', 'Euro', 'GBP', 'EUR', '0.8764', '2020-05-11 18:13:40'),
(24, 'British Pound', 'US Dollar', 'GBP', 'USD', '0.8110', '2020-05-11 18:07:00'),
(25, 'British Pound', 'Australian Dollar', 'GBP', 'AUD', '0.5259', '2020-05-11 18:13:40'),
(26, 'British Pound', 'Canadian Dollar', 'GBP', 'CAD', '0.5782', '2020-05-11 18:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_email` varchar(60) DEFAULT NULL,
  `user_gender` enum('0','1') NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_favorite` varchar(50) DEFAULT NULL,
  `user_picture` varchar(100) DEFAULT NULL,
  `user_registration_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_gender`, `user_phone`, `user_favorite`, `user_picture`, `user_registration_date`) VALUES
(1, 'Chinnappan2008', '7bdea2463cfcb23f92c9b1d13879a776', 'chinnappan2008@gmail.com', '1', '9833063407', '1,2,3', NULL, NULL),
(2, 'Arshia', '7bdea2463cfcb23f92c9b1d13879a776', 'chinnapan.muthu@gmail.com', '0', '9082032440', '1,2,3,4,5,19,20,21,22,23,24', '', '2013-07-19 12:00:00');

--
-- Indexes for table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`exchange_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);



--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `exchange_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;