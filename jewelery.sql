-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2016 at 11:19 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

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
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `due` date NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `transaction_id`, `due`, `amount`) VALUES
(26, 66, '2016-11-22', 2000),
(27, 66, '2016-12-22', 2000),
(28, 66, '2017-01-22', 2000),
(29, 66, '2017-02-22', 2000),
(30, 66, '2017-03-22', 2000),
(31, 67, '2016-09-22', 8580.75),
(32, 67, '2016-10-22', 8580.75),
(33, 67, '2016-11-22', 8580.75),
(34, 67, '2016-12-22', 8580.75),
(41, 73, '1970-01-01', 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_limit`
--

CREATE TABLE `monthly_limit` (
  `id` int(11) NOT NULL,
  `month` enum('january','february','march','april','may','june','july','august','september','october','november','december') DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `limit_transaction` float NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) DEFAULT NULL,
  `type` enum('gold','diamond') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_limit`
--

INSERT INTO `monthly_limit` (`id`, `month`, `year`, `limit_transaction`, `transaction_id`, `type`, `created`) VALUES
(1, 'september', '2016', 10000, '#73', 'gold', '2016-09-13 13:55:57'),
(2, 'september', '2016', 70000, '#66#67', 'diamond', '2016-09-13 13:58:08'),
(4, 'october', '2016', 100000, NULL, 'diamond', '2016-09-14 03:57:14'),
(5, 'october', '2016', 100000, NULL, 'gold', '2016-09-14 04:00:00'),
(6, 'february', '2016', 1500, NULL, 'gold', '2016-09-14 14:48:54'),
(7, 'november', '2016', 123000, NULL, 'gold', '2016-09-15 02:31:30'),
(8, 'january', '2018', 10000, NULL, 'gold', '2016-09-16 01:05:23'),
(9, 'may', '2016', 1000, NULL, 'gold', '2016-09-26 03:36:35'),
(10, 'july', '2016', 1000, NULL, 'gold', '2016-09-26 03:37:08'),
(11, 'january', '2016', 20000, NULL, 'gold', '2016-09-28 02:02:42'),
(12, 'april', '2016', 12345, NULL, 'gold', '2016-09-28 07:53:00'),
(13, 'april', '2016', 6786, NULL, 'diamond', '2016-09-28 07:53:44'),
(14, 'january', '2025', 123, NULL, 'diamond', '2016-09-29 08:31:04'),
(15, 'february', '2016', 12345, NULL, 'diamond', '2016-09-29 01:55:06'),
(16, 'december', '2016', 9000, NULL, 'diamond', '2016-09-29 01:57:14'),
(17, 'january', '2016', 123123, NULL, 'diamond', '2016-09-29 08:58:43'),
(18, 'december', '2016', 80, NULL, 'gold', '2016-09-29 03:57:31');

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
(2, 'september', 2016, 100000),
(3, 'october', 2016, 999999),
(4, 'january', 2017, 2000000),
(5, 'april', 2016, 123),
(6, 'november', 2016, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `month` enum('january','february','march','april','may','june','july','august','september','october','november','december') NOT NULL,
  `year` varchar(255) NOT NULL,
  `spanning_month` int(11) DEFAULT NULL,
  `start_payment` date DEFAULT NULL,
  `amount` float NOT NULL,
  `gold_price` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `description` text,
  `type` enum('gold','diamond') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `month`, `year`, `spanning_month`, `start_payment`, `amount`, `gold_price`, `weight`, `description`, `type`, `created`) VALUES
(66, 'september', '2016', 5, '2016-11-22', 10000, 0, NULL, 'beli diamond 1', 'diamond', '2016-09-29 01:55:35'),
(67, 'september', '2016', 4, '2016-09-22', 34323, 0, NULL, 'beli diamond 2', 'diamond', '2016-09-29 02:11:19'),
(73, 'september', '2016', 1, '2016-10-14', 1000000000, 500000, 2000, 'beli 2kg emas', 'gold', '2016-09-29 10:10:46');

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
(1, 'admin', '6af345b65cb88d569108839b58ecf02f1934825ba5e9b12cd19e21deeaba81ebc1129e3a9c37fb75a0f20c649cd07ea65f63a49968d84971cb3492fa27485705', 'Ferry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `monthly_limit`
--
ALTER TABLE `monthly_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `monthly_limit_cicilan`
--
ALTER TABLE `monthly_limit_cicilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
