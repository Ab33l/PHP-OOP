-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 04:03 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dot_operating_authority`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `records_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(70) NOT NULL,
  `marks` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`records_id`, `first_name`, `last_name`, `email_address`, `marks`, `status_id`, `created`, `modified`, `image`) VALUES
(1, 'Bernd', 'Leno', 'berndleno@gmail.com', 90, 1, '2019-08-06 13:06:53', '2019-08-06 11:06:53', 'cdf3484ca113662738b0be0a7b8f796d82b1e856-bernd.png'),
(2, 'Spenser', 'Alex', 'spenceralex@yahoo.com', 32, 3, '2019-08-06 13:23:18', '2019-08-06 11:23:18', 'c14156525b8173dd8fb3f411df0704526e4343e7-rigo.png'),
(3, 'Leon', 'Panther', 'leonpanthers@co.usa', 56, 2, '2019-08-06 13:25:28', '2019-08-06 11:25:28', '420cf9498769fdd142aa21d61b80fd2a9bc1a84a-newton.png'),
(4, 'Serena', 'Williams', 'serenawilliams@yahoo.com', 91, 1, '2019-08-06 13:28:09', '2019-08-06 11:28:09', '9c55357da976f741a847469d3b96fc05e04cab90-serena.jpeg'),
(5, 'Tom', 'Brady', 'tombrady12@patriots.ke', 50, 3, '2019-08-06 13:31:17', '2019-08-06 11:31:17', 'a52e6335812fe315889f2a04b59020af77cd9cc1-brady.jpeg'),
(6, 'Kosovare', 'Asslani', 'kosovareasslani@org.se', 81, 1, '2019-08-06 13:35:23', '2019-08-06 11:35:23', '645c7a275007fe15512af55c87a09f6d486ce031-kosovare.jpeg'),
(7, 'Amanda', 'Sampedro', 'amandasampedro@yahoo.com', 88, 1, '2019-08-06 13:39:45', '2019-08-06 11:39:45', 'dd72ceff08a1f565a5483634add5ec92a3354079-amanda.jpeg'),
(8, 'Jenna ', 'Fife', 'jennafife21@co.scot', 70, 2, '2019-08-06 13:50:44', '2019-08-06 11:50:44', '89247abb9ce5ddac49eb85a572531f1da9718a52-jenna.jpeg'),
(9, 'Lucas', 'Moura', 'lucasmoura@spurs.edu', 97, 3, '2019-08-06 13:53:29', '2019-08-06 11:53:29', '3f64e1dabaa5f8d9f8ca9cdb6bf46467170687a9-lucas.png'),
(10, 'Desiree', 'Scott', 'desireescott@co.th', 78, 2, '2019-08-06 13:56:37', '2019-08-06 11:56:37', 'd6278eb091b501057820cc1fb7e7ce684d41d29f-desiree.png'),
(11, 'Lewis', 'Hamilton', 'lewishamilton01@yahoo.com', 63, 1, '2019-08-06 13:59:28', '2019-08-06 11:59:28', '21eb9eceb13d7b5de538b60f60bc60452d958bf3-lewis.jpeg'),
(12, 'Ashleigh', 'Shim', 'asleighshim88@co.jm', 99, 3, '2019-08-06 14:01:50', '2019-08-06 12:01:50', 'd01ad80577743f903eaa6eda57db8411c9c2b61b-ash.png'),
(13, 'Lee', 'Mina', 'leemina1010@yahoo.com', 88, 3, '2019-08-06 14:06:01', '2019-08-06 12:06:01', 'f82a43035e07630609e0af373b255c17cf832c48-lee.jpeg'),
(14, 'Heung-Min', 'Son', 'heung-minson@gmail.com', 100, 3, '2019-08-06 14:10:29', '2019-08-06 12:10:29', 'b27c1212818c2e2e9826d1d39005b76a65f0ed0b-son.png'),
(15, 'Becky ', 'Hammon', 'beckyhammon12@spurs.org', 93, 1, '2019-08-06 14:13:39', '2019-08-06 12:13:39', '35387c8551fd4adf2c64024b9c875f5787519075-hammon.jpeg'),
(16, 'Alvin', 'Kamara', 'alvinkamara41@saints.org', 41, 2, '2019-08-06 14:27:30', '2019-08-06 12:27:30', '5f24243744be537f75177f67359eae19a3f9b046-kamara.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `created`, `modified`) VALUES
(1, 'Active', '2019-08-05 12:00:00', '2019-08-06 09:55:12'),
(2, 'Dormant', '2019-08-05 17:53:41', '2019-08-06 09:55:12'),
(3, 'Deactivated', '2019-08-06 06:27:45', '2019-08-06 09:55:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`records_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `records_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
