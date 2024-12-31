-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 08, 2024 at 06:01 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uov_canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `REG_NO` varchar(100) NOT NULL,
  `FEEDBACK` mediumtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `REG_NO`, `FEEDBACK`) VALUES
(1, '5846', 'Hello'),
(2, '88461', 'cmionfd c'),
(3, 'cqecq', 'xcqefved');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `UNIT_PRICE` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `NAME`, `UNIT_PRICE`) VALUES
(1, 'EGG BUN', 100),
(4, 'CHICKEN RICE', 150),
(5, 'VEGETARIAN PIZZA', 120),
(6, 'SPAGHETTI BOLOGNESE', 130),
(7, 'BEEF BURGER', 160),
(8, 'FISH TACOS', 140),
(9, 'FRUIT SALAD', 80),
(10, 'CHEESE SANDWICH', 90),
(11, 'SUSHI PLATTER', 200),
(12, 'MUSHROOM SOUP', 110);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TOTAL_PRICE` double NOT NULL,
  `PAYMENT_STATUS` int(11) NOT NULL,
  `DATE` datetime NOT NULL,
  `REG_NO` varchar(100) NOT NULL,
  `CARD_NUMBER` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MOBILE` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `TOTAL_PRICE`, `PAYMENT_STATUS`, `DATE`, `REG_NO`, `CARD_NUMBER`, `MOBILE`) VALUES
(1, 730, 0, '0000-00-00 00:00:00', '', '', 0),
(2, 930, 0, '0000-00-00 00:00:00', '', '', 0),
(3, 960, 0, '0000-00-00 00:00:00', '', '', 0),
(4, 460, 0, '0000-00-00 00:00:00', '', '', 0),
(5, 900, 0, '0000-00-00 00:00:00', '', '', 0),
(6, 870, 0, '0000-00-00 00:00:00', '', '', 0),
(7, 2630, 1, '0000-00-00 00:00:00', '45812', '1564861234484', 114454878),
(8, 720, 0, '0000-00-00 00:00:00', '', '', 0),
(9, 0, 0, '0000-00-00 00:00:00', '', '', 0),
(10, 170, 1, '0000-00-00 00:00:00', 'wwdf', '2143141', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_menu`
--

DROP TABLE IF EXISTS `orders_menu`;
CREATE TABLE IF NOT EXISTS `orders_menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ORDER_ID` int(11) NOT NULL,
  `MENU_ID` int(11) NOT NULL,
  `COUNT` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_menu`
--

INSERT INTO `orders_menu` (`ID`, `ORDER_ID`, `MENU_ID`, `COUNT`, `PRICE`) VALUES
(1, 6, 7, 1, 160),
(2, 6, 8, 3, 420),
(3, 6, 10, 2, 180),
(4, 6, 12, 1, 110),
(5, 7, 1, 1, 100),
(6, 7, 4, 1, 150),
(7, 7, 5, 1, 120),
(8, 7, 6, 2, 260),
(9, 7, 7, 2, 320),
(10, 7, 8, 3, 420),
(11, 7, 9, 3, 240),
(12, 7, 10, 3, 270),
(13, 7, 11, 1, 200),
(14, 7, 12, 5, 550),
(15, 8, 5, 1, 120),
(16, 8, 6, 2, 260),
(17, 8, 9, 2, 160),
(18, 8, 10, 2, 180),
(19, 10, 9, 1, 80),
(20, 10, 10, 1, 90);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
