-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2016 at 09:26 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewelery`
--

-- --------------------------------------------------------

--
-- Table structure for table `monthly_limit`
--

CREATE TABLE `monthly_limit` (
  `id` int(11) NOT NULL,
  `month` enum('january','february','march','april','may','june','july','august','september','october','november','december') DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `limit_transaction` float NOT NULL DEFAULT '0',
  `limit_cicilan` varchar(255) NOT NULL,
  `gold_price` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `type` enum('gold','diamond') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_limit`
--

INSERT INTO `monthly_limit` (`id`, `month`, `year`, `limit_transaction`, `limit_cicilan`, `gold_price`, `transaction_id`, `type`, `created`) VALUES
(1, 'september', '2016', 140000, '', NULL, '#51', 'gold', '2016-09-13 13:55:57'),
(2, 'september', '2016', 120000, '', NULL, '#50', 'diamond', '2016-09-13 13:58:08'),
(4, 'october', '2016', 100000, '', NULL, NULL, 'diamond', '2016-09-14 03:57:14'),
(5, 'october', '2016', 100000, '', NULL, NULL, 'gold', '2016-09-14 04:00:00'),
(6, 'february', '2016', 150000, '', NULL, NULL, 'gold', '2016-09-14 14:48:54'),
(7, 'november', '2016', 123000, '', NULL, NULL, 'gold', '2016-09-15 02:31:30'),
(8, 'january', '2018', 10000, '', NULL, NULL, 'gold', '2016-09-16 01:05:23'),
(9, 'may', '2016', 1000, '', 100, NULL, 'gold', '2016-09-26 03:36:35'),
(10, 'july', '2016', 1000, '', 777, NULL, 'gold', '2016-09-26 03:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_limit_cicilan`
--

CREATE TABLE `monthly_limit_cicilan` (
  `id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_limit_cicilan`
--

INSERT INTO `monthly_limit_cicilan` (`id`, `month`, `year`, `amount`) VALUES
(1, 'january', 2016, 1000),
(2, 'september', 2016, 120);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `month` enum('january','february','march','april','may','june','july','august','september','october','november','december') NOT NULL,
  `year` varchar(255) NOT NULL,
  `spanning_month` int(11) NOT NULL,
  `start_payment` date NOT NULL,
  `amount` float NOT NULL,
  `type` enum('gold','diamond') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `month`, `year`, `spanning_month`, `start_payment`, `amount`, `type`, `created`) VALUES
(50, 'september', '2016', 7, '2016-09-17', 100000, 'diamond', '2016-09-15 04:13:41'),
(51, 'september', '2016', 9, '2016-09-28', 10000, 'gold', '2016-09-27 07:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`) VALUES
(1, 'john', 'asdf', 'Jonathan Hosea');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monthly_limit`
--
ALTER TABLE `monthly_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_limit_cicilan`
--
ALTER TABLE `monthly_limit_cicilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `monthly_limit`
--
ALTER TABLE `monthly_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `monthly_limit_cicilan`
--
ALTER TABLE `monthly_limit_cicilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
