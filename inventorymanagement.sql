-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 09:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorymanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Event_DateTime` datetime NOT NULL,
  `Event_ID` int(11) NOT NULL,
  `Event_StockChange` int(11) NOT NULL,
  `Event_Type` text NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` text NOT NULL,
  `Product_StockIn` int(11) NOT NULL,
  `Product_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userlogindetails`
--

CREATE TABLE `userlogindetails` (
  `User_ID` int(11) NOT NULL,
  `User_Pass` text NOT NULL,
  `User_Permission` text NOT NULL,
  `User_Username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogindetails`
--

INSERT INTO `userlogindetails` (`User_ID`, `User_Pass`, `User_Permission`, `User_Username`) VALUES
(1, '921443c5e72aac9f10321d52f095edd5ed04ab8deeca8cd0eb425ad46c135c14', 'Admin', 'Administrator'),
(2, '32ccf5889dcae26d988e57e9d9c9abea9ce9eb2cc541153b18c6ee9ef8855182', 'Manager', 'Manager'),
(3, '54b08450a9dc275c13b7d032beb3080e9e87783f1d6afe69a2cd1fad81acf466', 'User', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `userlogindetails`
--
ALTER TABLE `userlogindetails`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlogindetails`
--
ALTER TABLE `userlogindetails`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `events_ibfk_10` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_11` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_12` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_13` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_14` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_15` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_16` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_17` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_18` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_4` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_5` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_6` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_7` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `events_ibfk_8` FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_9` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
