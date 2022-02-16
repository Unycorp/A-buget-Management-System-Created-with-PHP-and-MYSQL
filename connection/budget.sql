-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 09:16 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `budget_id` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `month_id` varchar(10) DEFAULT NULL,
  `year_id` varchar(10) DEFAULT NULL,
  `date_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `budget_id`, `user_id`, `name`, `amount`, `month_id`, `year_id`, `date_id`) VALUES
(2, '60d27a867b851', '1', 'transportation', '5000', '05', '2021', '2021-06-23 00:04:22'),
(4, '60d27bc8dad79', '1', 'Food', '2500', '05', '2021', '2021-06-23 00:09:44'),
(5, '60d27c3f3a242', '1', 'Waste Management', '5000', '05', '2021', '2021-06-23 00:11:43'),
(6, '60d5a02159dd9', '1', 'tax', '1000', '06', '2021', '2021-06-25 09:21:37'),
(7, '60d7200356008', '1', 'Entertainment', '6000', '06', '2021', '2021-06-26 12:39:31'),
(8, '60d7339e66c85', '1', 'Lunch', '3000', '06', '2021', '2021-06-26 14:03:10'),
(9, '60d91a5157e4a', '60d9170fc8087', 'phone Charging', '2000', '06', '2021', '2021-06-28 00:39:45'),
(10, '60e46e81879dc', '60e46e8173d70', 'Food', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(11, '60e46e81950b8', '60e46e8173d70', 'Transportation', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(12, '60e46e81a75b4', '60e46e8173d70', 'Lunch', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(13, '60e46e81b5c2f', '60e46e8173d70', 'Electricity', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(14, '60e46e81c812c', '60e46e8173d70', 'Stationaries', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(15, '60e46e81d82ff', '60e46e8173d70', 'Housing', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(16, '60e46e81e07d1', '60e46e8173d70', 'Electronics', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(17, '60e46e81e88bb', '60e46e8173d70', 'Entertainment', '10000', 'none', '2021', '2021-07-06 14:53:53'),
(18, '60e46e82009ce', '60e46e8173d70', 'Tax', '10000', 'none', '2021', '2021-07-06 14:53:54'),
(19, '60e46e820cd21', '60e46e8173d70', 'Waste Management', '10000', 'none', '2021', '2021-07-06 14:53:54'),
(20, '60e46fa158aca', '60e46fa149c7e', 'Food', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(21, '60e46fa167145', '60e46fa149c7e', 'Transportation', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(22, '60e46fa16f22f', '60e46fa149c7e', 'Lunch', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(23, '60e46fa177319', '60e46fa149c7e', 'Electricity', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(24, '60e46fa18366c', '60e46fa149c7e', 'Stationaries', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(25, '60e46fa197e90', '60e46fa149c7e', 'Housing', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(26, '60e46fa1aa38d', '60e46fa149c7e', 'Electronics', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(27, '60e46fa1b2477', '60e46fa149c7e', 'Entertainment', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(28, '60e46fa1ba561', '60e46fa149c7e', 'Tax', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(29, '60e46fa1c2a32', '60e46fa149c7e', 'Waste Management', '10000', 'none', '2021', '2021-07-06 14:58:41'),
(30, '61201e7555f90', '1', 'Cable Tv', '50000', 'none', '2021', '2021-08-20 21:28:21'),
(31, '61e1cb25ee228', '1', 'Housing', '50000', 'none', '2022', '2022-01-14 19:12:37'),
(32, '61e1cb3072f0e', '1', 'Clothing', '5000', 'none', '2022', '2022-01-14 19:12:48'),
(33, '61e1cb3a3f136', '1', 'Phones', '5000', 'none', '2022', '2022-01-14 19:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `budget_limit`
--

CREATE TABLE `budget_limit` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL DEFAULT '0',
  `user_id` varchar(255) NOT NULL,
  `date_id` varchar(255) NOT NULL DEFAULT '0',
  `start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_limit`
--

INSERT INTO `budget_limit` (`id`, `amount`, `user_id`, `date_id`, `start`, `end`) VALUES
(2, '88', '1', '1', '2021-07-02 21:31:19', '2021-07-21 00:00:00'),
(3, '10000', '1', '2', '2021-07-02 21:31:19', '2021-07-13 00:00:00'),
(4, '200', '1', '0', '2021-07-02 21:39:34', '2021-07-20 00:00:00'),
(7, '10000000', '1', '60df7c31bdf7b', '2021-07-02 21:50:57', '2021-07-14 00:00:00'),
(8, '0', '1', '60df8a141f094', '2021-07-02 22:50:12', '2021-07-13 00:00:00'),
(9, '50000', '1', '60df8abcbf40a', '2021-07-02 22:53:00', '2021-07-05 00:00:00'),
(10, '0', '1', '60df8acc70c18', '2021-07-02 22:53:16', '2021-07-05 00:00:00'),
(11, '0', '1', '60df8b4b46d36', '2021-07-02 22:55:23', '2021-07-07 00:00:00'),
(12, '600', '1', '60df8b699afd6', '2021-07-02 22:55:53', '2021-07-08 00:00:00'),
(13, '688', '1', '60df8ba4e7fd7', '2021-07-02 22:56:52', NULL),
(14, '200', '60e46fa149c7e', '0', '2021-07-06 16:13:47', NULL),
(15, '19800', '60e46fa149c7e', '60e475217499b', '2021-07-06 16:22:09', NULL),
(16, '4400', '1', '611ec024ee662', '2021-08-19 21:33:40', NULL),
(17, '27500', '1', '61366698a4d17', '2021-09-06 20:06:00', NULL),
(18, '0', '1', '6158aec2d525c', '2021-10-02 20:10:58', NULL),
(19, '31700', '1', '61e1cb05ba6a6', '2022-01-14 20:12:05', NULL),
(20, '18300', '1', '61e1cbd48807f', '2022-01-14 20:15:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expenses_id` varchar(50) DEFAULT NULL,
  `budget_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `item` varchar(255) NOT NULL DEFAULT 'items',
  `amount` varchar(255) DEFAULT NULL,
  `month_id` varchar(10) DEFAULT NULL,
  `year_id` varchar(10) DEFAULT NULL,
  `date_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `budget_limit_id` varchar(255) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expenses_id`, `budget_id`, `user_id`, `item`, `amount`, `month_id`, `year_id`, `date_id`, `budget_limit_id`) VALUES
(40, '60df811b51ba3', '60d7339e66c85', '1', 'Rice and egg', '100', '07', '2021', '2021-07-02 21:11:55', '60df7c31bdf7b'),
(41, '60df8183a5373', '60d27bc8dad79', '1', 'Guuci Palm', '400', '07', '2021', '2021-07-02 21:13:39', '60df7c31bdf7b'),
(42, '60df8b8e61275', '60d7339e66c85', '1', 'Rice and egg', '400', '07', '2021', '2021-07-02 21:56:30', '60df8b699afd6'),
(43, '60df8b9b45fd6', '60d7339e66c85', '1', 'clothes', '200', '07', '2021', '2021-07-02 21:56:43', '60df8b699afd6'),
(52, '60dfa468541a5', '60d7339e66c85', '1', 'shoe', '400', '07', '2021', '2021-07-02 23:42:32', '60df8ba4e7fd7'),
(56, '60dfa4ee42ed0', '60d7339e66c85', '1', 'mayn', '88', '07', '2021', '2021-07-02 23:44:46', '60df8ba4e7fd7'),
(58, '60dfa8adc607b', '60d5a02159dd9', '1', 'goatee', '200', '07', '2021', '2021-07-03 00:00:45', '60df8ba4e7fd7'),
(59, '60e4738e496f9', '60e46fa158aca', '60e46fa149c7e', 'rice', '200', '07', '2021', '2021-07-06 15:15:26', '0'),
(60, '60e475ee9cf4e', '60e46fa1c2a32', '60e46fa149c7e', 'Rice and egg', '600', '07', '2021', '2021-07-06 15:25:34', '60e475217499b'),
(61, '611ecbf5a0522', '60d7200356008', '1', 'Rice and egg', '100', '08', '2021', '2021-08-19 21:24:05', '611ec024ee662'),
(62, '60df811b51ba3', '60d7339e66c85', '1', 'Plantain', '300', '07', '2021', '2021-07-03 21:11:55', '60df7c31bdf7b'),
(63, '60df8183a5373', '60d27bc8dad79', '1', 'Shoes', '400', '07', '2021', '2021-07-03 21:13:39', '60df7c31bdf7b'),
(64, '60df8b8e61275', '60d7339e66c85', '1', 'Rice and egg', '400', '07', '2021', '2021-07-02 21:56:30', '60df8b699afd6'),
(65, '60df8b9b45fd6', '60d7339e66c85', '1', 'clothes', '200', '07', '2021', '2021-07-02 21:56:43', '60df8b699afd6'),
(66, '60dfa468541a5', '60d7339e66c85', '1', 'shoe', '400', '07', '2021', '2021-07-02 23:42:32', '60df8ba4e7fd7'),
(67, '60dfa4ee42ed0', '60d7339e66c85', '1', 'mayn', '88', '07', '2021', '2021-07-02 23:44:46', '60df8ba4e7fd7'),
(68, '60dfa8adc607b', '60d5a02159dd9', '1', 'goatee', '200', '07', '2021', '2021-07-03 00:00:45', '60df8ba4e7fd7'),
(69, '60e4738e496f9', '60e46fa158aca', '60e46fa149c7e', 'rice', '200', '07', '2021', '2021-07-06 15:15:26', '0'),
(70, '60e475ee9cf4e', '60e46fa1c2a32', '60e46fa149c7e', 'Rice and egg', '600', '07', '2021', '2021-07-06 15:25:34', '60e475217499b'),
(71, '611ecbf5a0522', '60d7200356008', '1', 'Rice and egg', '100', '08', '2021', '2021-08-19 21:24:05', '611ec024ee662'),
(72, '6136660bd0fed', '61201e7555f90', '1', 'data', '400', '09', '2021', '2021-09-06 19:03:39', '611ec024ee662'),
(73, '6136661e094c5', '60d27bc8dad79', '1', 'Foodstuff', '500', '09', '2021', '2021-09-06 19:03:58', '611ec024ee662'),
(74, '61366631ee497', '60d7200356008', '1', 'Shoes', '400', '09', '2021', '2021-09-06 19:04:17', '611ec024ee662'),
(75, '61366642ba84f', '60d27bc8dad79', '1', 'Foodstuff', '700', '09', '2021', '2021-09-06 19:04:34', '611ec024ee662'),
(76, '613666555efb8', '61201e7555f90', '1', 'Subscription', '700', '09', '2021', '2021-09-06 19:04:53', '611ec024ee662'),
(77, '613666703a0d6', '60d7200356008', '1', 'Data', '1000', '09', '2021', '2021-09-06 19:05:20', '611ec024ee662'),
(78, '6136668d6667b', '60d27bc8dad79', '1', 'Rice and egg', '500', '09', '2021', '2021-09-06 19:05:49', '611ec024ee662'),
(79, '6158ae3959418', '60d27bc8dad79', '1', 'Rice and egg', '400', '10', '2021', '2021-10-02 19:08:41', '61366698a4d17'),
(80, '6158ae4257ac3', '61201e7555f90', '1', 'data', '700', '10', '2021', '2021-10-02 19:08:50', '61366698a4d17'),
(81, '6158ae5181a1f', '60d27bc8dad79', '1', 'Foodstuff', '500', '10', '2021', '2021-10-02 19:09:05', '61366698a4d17'),
(82, '6158ae64165ef', '60d7200356008', '1', 'Shoes and Bags', '2400', '10', '2021', '2021-10-02 19:09:24', '61366698a4d17'),
(83, '6158ae8524812', '61201e7555f90', '1', 'School fees', '12000', '10', '2021', '2021-10-02 19:09:57', '61366698a4d17'),
(84, '6158aea0b859d', '61201e7555f90', '1', 'Decoder', '10000', '10', '2021', '2021-10-02 19:10:24', '61366698a4d17'),
(85, '6158aeb1664ee', '60d7200356008', '1', 'Crocs', '1000', '10', '2021', '2021-10-02 19:10:41', '61366698a4d17'),
(86, '6158aebd2a2b6', '60d27bc8dad79', '1', 'Food', '500', '10', '2021', '2021-10-02 19:10:53', '61366698a4d17'),
(87, '61e1cb51b4d5d', '60d27a867b851', '1', 'Transport fare', '1000', '01', '2022', '2022-01-14 19:13:21', '61e1cb05ba6a6'),
(88, '61e1cb5c65e20', '61e1cb25ee228', '1', 'Rent', '12000', '01', '2022', '2022-01-14 19:13:32', '61e1cb05ba6a6'),
(89, '61e1cb6c1b651', '60d27bc8dad79', '1', 'Rice and beans', '500', '01', '2022', '2022-01-14 19:13:48', '61e1cb05ba6a6'),
(90, '61e1cb7c54fea', '61e1cb3072f0e', '1', 'T Shirts', '2000', '01', '2022', '2022-01-14 19:14:04', '61e1cb05ba6a6'),
(91, '61e1cb8ef2f85', '61201e7555f90', '1', 'Phone screen', '10000', '01', '2022', '2022-01-14 19:14:22', '61e1cb05ba6a6'),
(92, '61e1cb9f3f43f', '60d27c3f3a242', '1', 'Waste Collection', '200', '01', '2022', '2022-01-14 19:14:39', '61e1cb05ba6a6'),
(93, '61e1cbb420cb9', '61e1cb25ee228', '1', 'Light Bills', '3000', '01', '2022', '2022-01-14 19:15:00', '61e1cb05ba6a6'),
(94, '61e1cbc843be9', '61e1cb25ee228', '1', 'Foodstuff', '3000', '01', '2022', '2022-01-14 19:15:20', '61e1cb05ba6a6');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notification_id` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `budget_id` varchar(30) DEFAULT NULL,
  `expenses_id` varchar(30) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `status_id` varchar(10) DEFAULT NULL,
  `date_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notification_id`, `user_id`, `budget_id`, `expenses_id`, `message`, `status_id`, `date_id`) VALUES
(2, '60d777bf5599b', '1', '60d27a867b851', '60d777bf40d8e', 'You have reach the center mark of your budget. Please spend wisely', 'false', '2021-06-26 18:53:51'),
(3, '60d7791a443a6', '1', '60d27a867b851', '60d7791a35173', 'You have reach the center mark of your budget. Please spend wisely', 'false', '2021-06-26 18:59:38'),
(5, '60d77b4162241', '1', '60d27a867b851', '60d77b414f95c', 'Please, do not spend any money again', 'false', '2021-06-26 19:08:49'),
(6, '60d77d58dc9be', '1', '60d27a867b851', '60d77d58c1fef', 'You have reach the center mark. You have spend 50% of your budget. Please spend wisely', 'false', '2021-06-26 19:17:44'),
(7, '60d77dbcaee23', '1', '60d27a867b851', '60d77dbc9406c', 'You have reach the center mark. You have spend 50% of your budget. Henceforth, you are advice to spend wisely', 'false', '2021-06-26 19:19:24'),
(8, '60dc7d59b2f78', '60d9170fc8087', '60d91a5157e4a', '60dc7d59a54b4', 'You have exceeded the limit of your budget on phone Charging', 'false', '2021-06-30 14:19:05'),
(9, '60dc89278182f', '60d9170fc8087', '60d91a5157e4a', '60dc8927706bb', 'You have exceeded the limit of your budget on phone Charging', 'false', '2021-06-30 15:09:27'),
(10, '60dc893fb2b9d', '60d9170fc8087', '60d91a5157e4a', '60dc893f9bc68', 'You have exceeded the limit of your budget on phone Charging', 'false', '2021-06-30 15:09:51'),
(11, '60dfa3ed0bc7c', '1', '60d7339e66c85', '60dfa3ed02421', 'You have reach the center mark. You have spend 50% of your budget on Lunch. Henceforth, you are advice to spend wisely', 'false', '2021-07-02 23:40:29'),
(12, '60dfa3ed3d57f', '1', '60d7339e66c85', '60dfa3ed319fc', 'You have reach the center mark. You have spend 50% of your budget on Lunch. Henceforth, you are advice to spend wisely', 'false', '2021-07-02 23:40:29'),
(13, '60dfa3ed6fa3b', '1', '60d7339e66c85', '60dfa3ed64688', 'You have spend 75% of your budget on Lunch. Be very careful on how you spend. Be advice!!!', 'false', '2021-07-02 23:40:29'),
(14, '60dfa3ed9e45e', '1', '60d7339e66c85', '60dfa3ed9404c', 'Please, do not spend any money again. You have spent 87.5% of your budgeted amount on Lunch', 'false', '2021-07-02 23:40:29'),
(15, '6136668d7319e', '1', '60d27bc8dad79', '6136668d6667b', 'You have reach the center mark. You have spend 50% of your budget on Food. Henceforth, you are advice to spend wisely', 'false', '2021-09-06 19:05:49'),
(16, '6158aeb172459', '1', '60d7200356008', '6158aeb1664ee', 'You have reach the center mark. You have spend 50% of your budget on Entertainment. Henceforth, you are advice to spend wisely', 'false', '2021-10-02 19:10:41'),
(17, '6158aebd342e1', '1', '60d27bc8dad79', '6158aebd2a2b6', 'You have reach the center mark. You have spend 50% of your budget on Food. Henceforth, you are advice to spend wisely', 'false', '2021-10-02 19:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `budget_id` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `user_id`, `budget_id`, `name`, `email`, `password`, `occupation`, `photo`, `date_id`) VALUES
(1, '60d9170fc8087', '0', 'John Joe', 'John@gmail.com', 'john1234', 'student', '60d9170fc8087IMG-20180429-WA0002.jpg', '2021-06-28 00:25:51'),
(2, '1', '61e1cbd48807f', 'Test Taker', '1', '1', '', 'images/1.png', '2021-06-28 00:25:51'),
(4, '60e46fa149c7e', '60e475217499b', 'Goodness Gad', 'goodcsmart@gmail.com', '00000000', 'programmer', 'images/60e46fa149c7e.png', '2021-07-06 14:58:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_limit`
--
ALTER TABLE `budget_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `budget_limit`
--
ALTER TABLE `budget_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
