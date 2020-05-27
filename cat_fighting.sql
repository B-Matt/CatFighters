-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2020 at 02:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cat_fighting`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_fighters`
--

CREATE TABLE `cf_fighters` (
  `id` int(11) NOT NULL,
  `image_uri` text NOT NULL,
  `name` varchar(64) NOT NULL,
  `age` int(11) NOT NULL,
  `skills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cf_fighters`
--

INSERT INTO `cf_fighters` (`id`, `image_uri`, `name`, `age`, `skills`) VALUES
(1, './img/cat1.png', 'Cat McTerror', 3, 'Very loud'),
(2, './img/cat2.png', 'Caterson CatSpyder Silva', 5, 'Slim, broke leg in past years'),
(3, './img/cat3.png', 'Firko Cro Cat', 5, 'Past his prime, doing seminars'),
(4, './img/cat4.png', 'Catbib Furwmagomedov', 3, 'Current champion, wrestle and catmbo is his style'),
(5, './img/cat5.png', 'Kit Kitty Kones', 3, 'Bad kitty, loves to use dog food better strength'),
(6, './img/cat6.png', 'Coy BigCat Meowson', 5, 'Big kitty, loves to fight');

-- --------------------------------------------------------

--
-- Table structure for table `cf_fighter_stats`
--

CREATE TABLE `cf_fighter_stats` (
  `id` int(11) NOT NULL,
  `fighter_id` int(11) NOT NULL,
  `wins` int(10) UNSIGNED NOT NULL,
  `loss` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cf_fighter_stats`
--

INSERT INTO `cf_fighter_stats` (`id`, `fighter_id`, `wins`, `loss`) VALUES
(1, 1, 11, 24),
(2, 2, 34, 10),
(3, 3, 41, 12),
(4, 4, 28, 0),
(5, 5, 26, 1),
(6, 6, 23, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cf_fighters`
--
ALTER TABLE `cf_fighters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cf_fighter_stats`
--
ALTER TABLE `cf_fighter_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fighter_id` (`fighter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cf_fighters`
--
ALTER TABLE `cf_fighters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cf_fighter_stats`
--
ALTER TABLE `cf_fighter_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cf_fighter_stats`
--
ALTER TABLE `cf_fighter_stats`
  ADD CONSTRAINT `cf_fighter_stats_ibfk_1` FOREIGN KEY (`fighter_id`) REFERENCES `cf_fighters` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
