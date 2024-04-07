-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2024 at 07:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alphatech`
--
DROP DATABASE IF EXISTS `alphatech`;
CREATE DATABASE IF NOT EXISTS `alphatech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `alphatech`;
--
-- Database: `kabarak_b2b`
--
DROP DATABASE IF EXISTS `kabarak_b2b`;
CREATE DATABASE IF NOT EXISTS `kabarak_b2b` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kabarak_b2b`;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
CREATE TABLE `Admin` (
  `AdminID` int(11) NOT NULL,
  `AdminFirstName` char(255) NOT NULL,
  `AdminLastName` char(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Passphrase` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`AdminID`, `AdminFirstName`, `AdminLastName`, `Email`, `Telephone`, `Passphrase`) VALUES
(1, 'Agoi', 'Sharif', 'sharifagoi99@gmail.com', '+254769320092', '$2y$10$uHxaizaIoOIWvZJzsiNgjejgtnmG/njGZ11O8u7QJLLvzcOZZ.Npi'),
(2, 'Maxwell', 'Wafula', 'maxwellwafula884@gmail.com', '+254104945962', '$2y$10$9cN5balgv1w5LYC44lUG7.jfouBaseLi8OIfKYl40Ouews4DTNy7O'),
(3, 'Silas', 'Angera', 'angerasilas@gmail.com', '+254797630228', '$2y$10$MNcG8ovoCNWYKRkoaNHXs.lS7OHwjfpxCkl.8QeeqUdHQrq/Yy/qu'),
(4, 'Sharon', 'Lukela', 'lukelasharon02@gmail.com', '+254794603900', '$2y$10$pBukdF1UgosIiTQdsZdKteVFkwCYGNj8T7MasCH2ZTwxFu75BW0VW');

-- --------------------------------------------------------

--
-- Table structure for table `MySecurity`
--

DROP TABLE IF EXISTS `MySecurity`;
CREATE TABLE `MySecurity` (
  `Telephone` varchar(15) NOT NULL,
  `Passphrase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MySecurity`
--

INSERT INTO `MySecurity` (`Telephone`, `Passphrase`) VALUES
('+254110085273', '$2y$10$NJwIo49UhRpCM3qdx.sOqeSIPdadMT5.JEhE8EIvMYO4nxuAX8Joy'),
('+254702200425', '$2y$10$kg7YrBJ3LBz0ThAmd6Gqg.nyQaD.lFy8lQSgLb1h8BXnj/2gB9LGO'),
('+254710929729  ', '$2y$10$B8jgoOpDLeMR8bbwZhxTrOWRvbHkl6UMvinCFyxNtnA1jku5fA9ZG'),
('+254712900950', '$2y$10$bCEbgSI3fLSujD.gCR7vSuFbDE/wwxcIU4iNw/w8nT3YOiqIOkbDe'),
('+254719201213 ', '$2y$10$OOHryLnPL5kP3U60q4Rm.OOFg9KE.g5GCqwMokgsiVnKEZcxbV7XW'),
('+254720931406', '$2y$10$eDNAjeKtmi.8etLOpqKXieL1MbvOI3vJTpm40s.6kDw7WdaSKDfGO'),
('+254723572853 ', '$2y$10$RbxOxg5jT7YJLZ6ha021Mu4/5F7JdIDg1xOYYnUKxMRQ4iYfV31jq'),
('+254727048128', '$2y$10$hzvX0co8vnoALyrfNejSQ.4Pa1fk7esAgpaBZRnIrziS/TSNQ0iei'),
('+254727309538', '$2y$10$zJh4WXkCEef85HWAfnsszuIOEDgzKXHX8/G9OXALEI9gzY/MVNjMK'),
('+254727642727', '$2y$10$Y940.l.FQeWN5Yd2cakdoudqdNEIK2KWqWUW4YpYAj2ZE6oXDMjT.'),
('+254729078400', '$2y$10$52rKmpWpB.uHglMLLhE8lu8GnDbUX64HU8IClFsctyyrnbaRtQp3a'),
('+2547515283662 ', '$2y$10$.9g0qavXluK5sEMeGfin7OcbFyZBQa/CIzCCHZR4rVW2hdsQoTEXy'),
('+254757548278', '$2y$10$juUBOcSZZ2HypAhCu3a06erhViVyMg9mxmBLmcU9BlbXLoTtnUDMi'),
('+254794742925', '$2y$10$L8cDuyE.B3Jm51OwVfcDtOvUj37GQhMUy93PP20lSaVD.Gn83pDaa'),
('+254794985744', '$2y$10$4.e6rQfWr9tqFrhJNre/iuxJsYGxWom86xQn1wqCWWk6cLYn3Ztbq'),
('+254799426210  ', '$2y$10$tbwrINxdBk2KbH0/zFTN9eFiJnu3Vzsbt6h4LAav0rXx.fLv.YHsm');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
CREATE TABLE `Products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductDescription` varchar(255) NOT NULL DEFAULT 'The best Quality ever',
  `Price` decimal(8,2) NOT NULL DEFAULT 1.00,
  `Brand` varchar(255) NOT NULL DEFAULT 'unknown',
  `Category` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `DayOfUpload` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `ProductName`, `ProductDescription`, `Price`, `Brand`, `Category`, `image_path`, `DayOfUpload`) VALUES
(4, 'hardware', 'The best Quality ever', 1.00, 'hardware', 'Hardware', 'uploads/service_65f0691706110.jpeg', '2024-03-12'),
(5, 'cement', 'The best Quality ever', 800.00, 'simba cement', 'Hardware', 'uploads/service_65f069de3e98a.jpeg', '2024-03-12'),
(6, 'Wholesale', 'The best Quality ever', 1.00, 'generalstore', 'General Stores', 'uploads/service_65f06b4202d0e.jpeg', '2024-03-12'),
(8, 'Cereals', 'The best Quality ever', 1.00, 'cereals', 'General Stores', 'uploads/service_65f06b7c7e4c7.jpeg', '2024-03-12'),
(11, 'Nails', 'The best Quality ever', 1000.00, 'Pedicure & Manicure', 'Beauty & Cosmetics', 'uploads/service_65f06c49e18dc.jpg', '2024-03-12'),
(12, 'Nails', 'The best Quality ever', 1000.00, 'Pedicure & Manicure', 'Beauty & Cosmetics', 'uploads/service_65f06c68e2065.jpg', '2024-03-12'),
(13, 'Oilibya Mpishi', 'The best Quality ever', 1200.00, 'Oilibya company', 'Gas Services', 'uploads/service_65f0af4d2c00c.jpg', '2024-03-12'),
(14, 'K-gas', '3kgs , 6kgs & 13kgs all available', 1200.00, 'K-gas', 'Gas Services', 'uploads/service_65f0b2805cdb5.jpg', '2024-03-12'),
(15, 'Pro gas', '6kgs & 13kgs all available', 1200.00, 'Oilibya', 'Gas Services', 'uploads/service_65f0b3995933a.jpg', '2024-03-12'),
(16, 'Total gas', '6kgs & 13kgs all available', 1200.00, 'Total energies', 'Gas Services', 'uploads/service_65f0b405c0622.jpg', '2024-03-12'),
(17, 'Afri gas', '6kgs & 13kgs all available', 1200.00, 'Afrigas', 'Gas Services', 'uploads/service_65f0b456e7069.jpg', '2024-03-12'),
(18, 'supa gas', '3kgs , 6kgs & 13kgs all available', 1200.00, 'National', 'Gas Services', 'uploads/service_65f0b4a42c528.jpg', '2024-03-12'),
(19, 'ola energy mapishi', '3kgs , 6kgs & 13kgs all available', 1200.00, 'Ola energies', 'Gas Services', 'uploads/service_65f0b520f02bf.jpg', '2024-03-12'),
(20, 'MenGas', '6kgs & 13kgs all available', 1250.00, 'mengas', 'Gas Services', 'uploads/service_65f0b57e06525.jpg', '2024-03-12'),
(21, 'K-gas', '3kgs , 6kgs & 13kgs all available', 3600.00, 'K-gas', 'Gas Services', 'uploads/service_65f0b5c389cf2.jpg', '2024-03-12'),
(22, 'Total gas', '6kgs & 13kgs all available', 3600.00, 'Total energies', 'Gas Services', 'uploads/service_65f0b5fb6cb77.jpg', '2024-03-12'),
(23, 'supa gas', '3kgs , 6kgs & 13kgs all available', 3600.00, 'Oilibya', 'Gas Services', 'uploads/service_65f0b64a62980.jpg', '2024-03-12'),
(24, 'Gasses', '3kgs , 6kgs & 13kgs all available', 1200.00, 'All brands', 'Gas Services', 'uploads/service_65f0b6bd6d3f6.jpg', '2024-03-12'),
(25, 'Cereals', 'All sort of grpceries', 1.00, 'Cereals', 'General Stores', 'uploads/service_65f0b76dbff59.jpg', '2024-03-12'),
(26, 'Groceries', 'All sort of grpceries', 1.00, 'groceries', 'General Stores', 'uploads/service_65f0b7ce05e71.jpg', '2024-03-12'),
(28, 'Wholesale', 'Groceries + Cereals + Wholesale', 20.00, 'Joynamily', 'General Stores', 'uploads/service_65f0be6c784ff.jpg', '2024-03-12'),
(29, 'Mali Mali utensils', 'Get Cups, water bottles, Thermos, Plates', 50.00, 'Adix', 'Households', 'uploads/service_65f0bef88e3fc.jpg', '2024-03-12'),
(30, 'Mali Mali utensils', 'Fill your kitchen', 50.00, 'Malimali', 'Households', 'uploads/service_65f0bf588ee98.jpg', '2024-03-12'),
(31, 'Mali Mali Pan', 'Get all in one place', 200.00, 'Utensils', 'Households', 'uploads/service_65f0cc0d69203.jpg', '2024-03-13'),
(32, 'Mali Mali Shoe collection', 'All in one', 300.00, 'Malimali', 'Clothing & Aparels', 'uploads/service_65f0cc99868be.jpg', '2024-03-13'),
(33, 'Mali Mali utensils collection', 'All in one', 200.00, 'Malimali', 'Households', 'uploads/service_65f0ccf70c0bc.jpg', '2024-03-13'),
(34, 'Mali Mali buckets collection', 'All in one', 1.00, 'Malimali', 'Households', 'uploads/service_65f0cd4567e92.jpg', '2024-03-13'),
(35, 'Mali Mali & Hardware', 'All in one', 1.00, 'Malimali', 'General Stores', 'uploads/service_65f0d0480f4b1.jpg', '2024-03-13'),
(36, 'Mali Mali collection', 'All sandals in one', 100.00, 'Malimali', 'Clothing & Aparels', 'uploads/service_65f0d092c4903.jpg', '2024-03-13'),
(37, 'Mattress', '', 4500.00, 'HD', 'Beddings', 'uploads/service_65f0d0ee39892.jpg', '2024-03-13'),
(38, 'Mat', 'All in one', 1.00, 'Obbitty', 'Households', 'uploads/service_65f0d141e85cf.jpg', '2024-03-13'),
(39, 'Beddings', 'Get all pilows, Nets and all beddings at one place', 3500.00, 'Obbitty', 'Beddings', 'uploads/service_65f0d1c90017d.jpg', '2024-03-13'),
(40, 'Obity', 'home', 1.00, 'Obbitty', 'Clothing & Aparels', 'uploads/service_65f0d231b0880.jpg', '2024-03-13'),
(41, 'Womens Wear', 'All in one', 1000.00, 'Obbitty', 'Clothing & Aparels', 'uploads/service_65f0d28441a01.jpg', '2024-03-13'),
(42, 'Pillows', '', 300.00, '', 'Beddings', 'uploads/service_65f0d2c99f6b1.jpg', '2024-03-13'),
(43, 'Mens & Womens wears', '', 1.00, '', 'Clothing & Aparels', 'uploads/service_65f0d30aba7db.jpg', '2024-03-13'),
(44, 'Obitty Shoe Collection', '', 1.00, '', 'Clothing & Aparels', 'uploads/service_65f0d3532c996.jpg', '2024-03-13'),
(45, 'Obitty Shoe Collection', '', 1.00, '', 'Clothing & Aparels', 'uploads/service_65f0d3cbf2447.jpg', '2024-03-13'),
(46, 'Womens Wear', '', 1.00, 'Julies', 'Clothing & Aparels', 'uploads/service_65f3f5bab6224.jpg', '2024-03-15'),
(47, 'Mens & Womens Wear', 'The best for you', 1.00, 'Julies Wears', 'Clothing & Aparels', 'uploads/service_65f3f6be76b50.jpg', '2024-03-15'),
(48, 'Julies Sweaters & Hoodies Collection', 'The best sweaters for you', 1.00, 'Julies Wears', 'Clothing & Aparels', 'uploads/service_65f3f7506cf3a.jpg', '2024-03-15'),
(49, 'Pants Collection', '', 200.00, 'Julies Wears', 'Clothing & Aparels', 'uploads/service_65f3f7987323e.jpg', '2024-03-15'),
(50, 'Dress Collections', 'All in one', 1.00, 'Julies Wears', 'Clothing & Aparels', 'uploads/service_65f3f7cf2523d.jpg', '2024-03-15'),
(51, 'Electronic Appliances Collection', 'The best electronics for you', 1.00, 'Oraimo, JBL, HP, Techno', 'Electronics', 'uploads/service_65f3f85c81b91.jpg', '2024-03-15'),
(52, 'Cheregei Medicines', 'All Medicine available', 1.00, 'Cheregei Medicine', 'Health Services', 'uploads/service_65f3f8f8cca55.jpg', '2024-03-15'),
(53, 'Perfumes, Jewelaries & Make ups', 'The best Cosmetics for you', 1.00, '', 'Beauty & Cosmetics', 'uploads/service_65f3f975b27df.jpg', '2024-03-15'),
(54, 'Beauclasy Jewelaries', 'The best jewelaries for you', 1.00, '', 'Beauty & Cosmetics', 'uploads/service_65f3f9d62ffec.jpg', '2024-03-15'),
(56, 'Furniture ', 'Available at affordable prices', 1500.00, 'Dobiri', 'Furniture', 'uploads/service_65faec9ac9db0.png', '2024-03-20'),
(57, 'Furniture ', 'Available at affordable prices', 1500.00, 'Dobiri', 'Furniture', 'uploads/service_65faed08bcdf9.png', '2024-03-20'),
(58, 'Books', 'Twiga stationaries', 1.00, 'Kasuku', 'Bookshop & Stationary', 'uploads/service_65faf4153614d.jpg', '2024-03-20'),
(59, 'Books', 'Twiga stationaries', 1.00, 'Kasuku', 'Bookshop & Stationary', 'uploads/service_65faf428ceb05.jpg', '2024-03-20'),
(60, 'Books ', 'Kasuku ', 1.00, 'Twiga stationaries ', 'Bookshop & Stationary', 'uploads/service_65faf490817d8.jpg', '2024-03-20'),
(61, 'Books ', 'Kasuku ', 1.00, 'Twiga stationaries ', 'Bookshop & Stationary', 'uploads/service_65faf4973a6cc.jpg', '2024-03-20'),
(62, 'Kasuku', 'Kasuku', 1.00, 'Kasuku', 'Bookshop & Stationary', 'uploads/service_65faf4d3ae8d5.jpg', '2024-03-20'),
(63, 'Royalty free pencil ', 'Teepee', 1.00, 'Royalty free pencil ', 'Bookshop & Stationary', 'uploads/service_65faf70067c95.jpg', '2024-03-20'),
(64, 'Coloured free pencil ', 'Teepee', 1.00, 'Kasuku ', 'Bookshop & Stationary', 'uploads/service_65faf75962524.jpg', '2024-03-20'),
(65, 'Crayons', 'Teepee ', 1.00, 'Kasuku ', 'Bookshop & Stationary', 'uploads/service_65faf78be2c3a.jpg', '2024-03-20'),
(66, 'Ball paint pen', 'Teepee ', 1.00, 'Kasuku ', 'Bookshop & Stationary', 'uploads/service_65faf7e06c6ee.jpg', '2024-03-20'),
(67, 'Beifa pen', 'Teepee ', 1.00, 'Beifa', 'Bookshop & Stationary', 'uploads/service_65faf810a6095.jpg', '2024-03-20'),
(68, 'Big', 'Big', 1.00, 'Big', 'Bookshop & Stationary', 'uploads/service_65faf83f4ebfb.jpg', '2024-03-20'),
(69, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafaaaa44a9.jpg', '2024-03-20'),
(70, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafb2715d02.jpg', '2024-03-20'),
(71, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafb5f5b6b3.jpg', '2024-03-20'),
(72, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafb7da950d.jpg', '2024-03-20'),
(73, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafb9542afd.jpg', '2024-03-20'),
(74, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafb9a478b5.jpg', '2024-03-20'),
(75, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafb9e630fd.jpg', '2024-03-20'),
(76, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafbbf883cf.jpg', '2024-03-20'),
(77, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafbe2d912d.jpg', '2024-03-20'),
(78, 'Bedding', 'Available at affordable prices', 4500.00, 'OBBITY', 'Beddings', 'uploads/service_65fafc094702a.jpg', '2024-03-20'),
(79, 'Big wheel wheelbarrow ', 'big wheel ', 1500.00, 'Juakali', 'Hardware', 'uploads/service_65fafc396ed9f.jpg', '2024-03-20'),
(80, 'wheelbarrow ', 'Medium sized wheel ', 1300.00, 'Jua kali', 'Hardware', 'uploads/service_65fafc9c6f3d4.jpg', '2024-03-20'),
(81, 'Wheelbarrow ', 'Medium sized wheel ', 1300.00, 'Jua kali ', 'Hardware', 'uploads/service_65fafcda09647.jpg', '2024-03-20'),
(82, 'Normal mabati ', 'Cage 30', 1200.00, 'MRM', 'Hardware', 'uploads/service_65fafd183b94f.jpg', '2024-03-20'),
(83, 'Corrugated mabati', 'All cage available ', 1400.00, 'MBM', 'Hardware', 'uploads/service_65fafd6566b5c.jpg', '2024-03-20'),
(84, 'Corrugated mabati', 'All cage available ', 1400.00, 'MBM', 'Hardware', 'uploads/service_65fafd67cb249.jpg', '2024-03-20'),
(85, 'Knapsack sprayer ', '15 litters ', 1500.00, 'Kenpoly', 'Hardware', 'uploads/service_65fafda6b2d4b.jpg', '2024-03-20'),
(86, 'Knapsack sprayer ', '20 litters ', 1700.00, 'Kenpoly ', 'Hardware', 'uploads/service_65fafdf58a59d.jpg', '2024-03-20'),
(87, 'Knapsack sprayer ', '20 litters ', 1700.00, 'Kenpoly ', 'Hardware', 'uploads/service_65fafdfb506d8.jpg', '2024-03-20'),
(88, 'Underground vs normal tank ', 'All  size available of your choice ', 1.00, 'Kenpoly ', 'Hardware', 'uploads/service_65fb3ed017b0d.jpg', '2024-03-20'),
(89, 'KenTank', 'All size available ', 1.00, 'Kenpoly ', 'Hardware', 'uploads/service_65fb3f1a8b150.jpg', '2024-03-20'),
(90, 'New Apple products ', 'product of your choice ', 1.00, 'Apple', 'Electronics', 'uploads/service_65fb40702bfb9.jpg', '2024-03-20'),
(91, 'Consumer electronics ', 'Product of your choice ', 1.00, 'LG', 'Electronics', 'uploads/service_65fb40df57938.jpg', '2024-03-20'),
(92, 'Best electronic royalty', 'Product of your choice ', 1.00, 'LG', 'Electronics', 'uploads/service_65fb41488696c.jpg', '2024-03-20'),
(93, 'Computer,Ipods,and smartphone ', 'Product of your choice ', 1.00, 'Vitron', 'Electronics', 'uploads/service_65fb41c11b4da.jpg', '2024-03-20'),
(94, 'Stock photos ', 'Product of your choice available ', 1.00, 'LG', 'Electronics', 'uploads/service_65fb423b8322f.jpg', '2024-03-20'),
(95, 'Laptop, Tablates, and smartphone ', 'Product of your choice available ', 1.00, 'LG', 'Electronics', 'uploads/service_65fb42b265798.jpg', '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `sellerProducts`
--

DROP TABLE IF EXISTS `sellerProducts`;
CREATE TABLE `sellerProducts` (
  `SellerID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellerProducts`
--

INSERT INTO `sellerProducts` (`SellerID`, `ProductID`) VALUES
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(8, 19),
(8, 20),
(8, 21),
(8, 22),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 28),
(8, 64),
(9, 52),
(10, 29),
(10, 30),
(10, 31),
(10, 32),
(10, 33),
(10, 34),
(10, 35),
(10, 36),
(13, 11),
(13, 12),
(13, 54),
(16, 53),
(17, 6),
(17, 8),
(18, 37),
(18, 38),
(18, 39),
(18, 40),
(18, 41),
(18, 42),
(18, 43),
(18, 44),
(18, 45),
(18, 69),
(18, 70),
(18, 71),
(18, 72),
(18, 73),
(18, 74),
(18, 75),
(18, 76),
(18, 77),
(18, 78),
(19, 46),
(19, 47),
(19, 48),
(19, 49),
(19, 50),
(20, 51),
(20, 90),
(20, 91),
(20, 92),
(20, 93),
(20, 94),
(20, 95),
(21, 4),
(21, 5),
(21, 79),
(21, 80),
(21, 81),
(21, 82),
(21, 83),
(21, 84),
(21, 85),
(21, 86),
(21, 87),
(21, 88),
(21, 89),
(23, 56),
(23, 57),
(25, 58),
(25, 59),
(25, 60),
(25, 61),
(25, 62),
(25, 63),
(25, 65),
(25, 66),
(25, 67),
(25, 68);

-- --------------------------------------------------------

--
-- Table structure for table `Sellers`
--

DROP TABLE IF EXISTS `Sellers`;
CREATE TABLE `Sellers` (
  `SellerID` int(11) NOT NULL,
  `SellerFirstName` char(255) NOT NULL,
  `SellerLastName` char(255) NOT NULL,
  `Gender` char(255) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL DEFAULT 'N/A',
  `WhatsAppNumber` varchar(15) NOT NULL DEFAULT 'unknown',
  `BusinessType` char(255) NOT NULL,
  `BusinessName` varchar(255) NOT NULL DEFAULT 'N/A',
  `DoR` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Sellers`
--

INSERT INTO `Sellers` (`SellerID`, `SellerFirstName`, `SellerLastName`, `Gender`, `Telephone`, `Email`, `WhatsAppNumber`, `BusinessType`, `BusinessName`, `DoR`) VALUES
(8, 'MILCENT', 'ROTICH', 'Female', '+254729078400', 'millicentrotich@gmail.com', '+254729078400', 'Gas Services', 'Joynamily Enterprises', '2024-03-12'),
(9, 'KELVIN', 'KOSGEI', 'Male', '+254727309538', 'chergeihealthcare@gmail.com', '+254727309538', 'Health Services', 'Chergei Healthcare', '2024-03-12'),
(10, 'BENJAMIN', 'MAINA', 'Male', '+254757548278', 'maina@gmail.com', '+254757548278', 'Households', 'Malimali  and Hardware ', '2024-03-12'),
(11, 'TITUS', 'KETER', 'Male', '+254710929729  ', 'titvanket@gmail.com', '+254710929729', 'Electronics Repair', 'Titotech Technologies', '2024-03-12'),
(12, 'JACOB', 'TANUI', 'Male', '+254727048128', 'jacobtanui@gmail.com', '+254727048128', 'Haircut', 'Tanui Shaves', '2024-03-12'),
(13, 'HEMISTONE', 'MWINGISI', 'Male', '+254799426210  ', 'hmwingisi@gmail.com', '+254799426210', 'Beauty & Cosmetics', 'Beauclassy Beauty & Cosmetics', '2024-03-12'),
(14, 'FESTUS', 'KIPSEBA', 'Male', '+254727642727 ', 'ravinegloryhealthcare@gmail.com', '+254727642727', 'Health Services', 'Ravine Glory Healthcare', '2024-03-12'),
(16, 'ABIGAEL', 'CHEPKEMEI', 'Female', '+2547515283662 ', 'abigaelchepkemei@gmail.com', '+2547515283662', 'Beauty & Cosmetics', 'Abbys Salon & Beauty Spa', '2024-03-12'),
(17, 'PETER', 'KIPTOO', 'Male', '+254720931406', 'peterkiptoo@gmail.com', '+254720931406', 'General Stores', 'R-K shoppers store', '2024-03-12'),
(18, 'FAITH', 'JERUTO', 'Female', '+254723572853 ', 'jerutochangwony@gmail.com', '+254723572853', 'Beddings', 'OBITTY HOME DECOR', '2024-03-12'),
(19, 'JUDY', 'BARKEN', 'Female', '+254719201213 ', 'judyjepchirchir10@gmail.com', '+254719201213', 'Clothing & Aparels', 'Julies', '2024-03-12'),
(20, 'JUSTUS', 'CHERUIYOT', 'Male', '+254702200425', 'justuscheruiyot633@gmail.com', '+254702200425', 'Electronics', 'Digital Collection Center ', '2024-03-12'),
(21, 'DOROTHY', 'KIPSANG', 'Female', '+254794985744', 'ronohpkimutai@gmail.com', '+254794985744', 'Hardware', 'Kesuyo Contractors Limitted', '2024-03-12'),
(23, 'GREGORY', 'NICHOLAS', 'Male', '+254794742925', 'dobirilimited@gmail.com', '+254794742925', 'Furniture', 'Dobiri Furnitures', '2024-03-20'),
(24, 'WILLIAM', 'KENIE', 'Male', '+254110085273', '', '+254110085273', 'Shoe Repair', 'Chonjo Chonjo Enterprises', '2024-03-20'),
(25, 'SILAS', 'ANGERA', 'Male', '+254712900950', 'silasangera@gmail.com', '+254712900950', 'Bookshop & Stationary', 'Db254 Books', '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `sellerServices`
--

DROP TABLE IF EXISTS `sellerServices`;
CREATE TABLE `sellerServices` (
  `SellerID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellerServices`
--

INSERT INTO `sellerServices` (`SellerID`, `ServiceID`) VALUES
(9, 13),
(11, 15),
(12, 12),
(13, 10),
(14, 3),
(16, 11),
(23, 16),
(24, 14);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sellersProducts`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `sellersProducts`;
CREATE TABLE `sellersProducts` (
`ProductName` varchar(255)
,`Price` decimal(8,2)
,`Brand` varchar(255)
,`image_path` varchar(255)
,`ProductDescription` varchar(255)
,`Category` varchar(255)
,`Seller` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sellersServices`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `sellersServices`;
CREATE TABLE `sellersServices` (
`ServiceType` varchar(255)
,`Price` decimal(8,2)
,`image_path` varchar(255)
,`ServiceDescription` varchar(255)
,`Seller` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `Services`
--

DROP TABLE IF EXISTS `Services`;
CREATE TABLE `Services` (
  `ServiceID` int(11) NOT NULL,
  `ServiceType` varchar(255) NOT NULL,
  `ServiceDescription` varchar(255) NOT NULL DEFAULT 'We have the Best for you',
  `Price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `image_path` varchar(255) NOT NULL,
  `DayOfUpload` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Services`
--

INSERT INTO `Services` (`ServiceID`, `ServiceType`, `ServiceDescription`, `Price`, `image_path`, `DayOfUpload`) VALUES
(3, 'Health Services', 'We have the Best for you', 300.00, 'uploads/service_65f05c62abb56.jpg', '2024-03-12'),
(5, 'Health Services', 'We have the Best for you', 300.00, 'uploads/service_65f05d6e21758.jpg', '2024-03-12'),
(10, 'Hairdressing', 'We have the Best for you', 1000.00, 'uploads/service_65f06995aa884.jpg', '2024-03-12'),
(11, 'Hairdressing', 'We have the Best for you', 1500.00, 'uploads/service_65f06a91d3b51.jpg', '2024-03-12'),
(12, 'Haircut', 'Your favourite styles', 1.00, 'uploads/service_65f1d2e427fdf.jpg', '2024-03-13'),
(13, 'Health Services', 'We have the best doctors for you', 1.00, 'uploads/service_65f3fa61d8ad7.jpg', '2024-03-15'),
(14, 'Shoe Repair', 'Available at affordable prices', 60.00, 'uploads/service_65faf16522f15.jpg', '2024-03-20'),
(15, 'Electronics Repair', 'Available at affordable prices', 1500.00, 'uploads/service_65faf2d735740.jpg', '2024-03-20'),
(16, 'Carrier Services', 'Available at affordable prices', 750.00, 'uploads/service_65faf5abaded7.jpg', '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `Subscribers`
--

DROP TABLE IF EXISTS `Subscribers`;
CREATE TABLE `Subscribers` (
  `SNO` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Subscribers`
--

INSERT INTO `Subscribers` (`SNO`, `Email`) VALUES
(1, 'angerasilas@gmail.com'),
(2, 'maxwellwafula884@gmail.com'),
(5, 'millicentrotich@gmail.com'),
(3, 'modedo@kabarak.ac.ke');

-- --------------------------------------------------------

--
-- Structure for view `sellersProducts`
--
DROP TABLE IF EXISTS `sellersProducts`;

DROP VIEW IF EXISTS `sellersProducts`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sellersProducts`  AS   (select `Products`.`ProductName` AS `ProductName`,`Products`.`Price` AS `Price`,`Products`.`Brand` AS `Brand`,`Products`.`image_path` AS `image_path`,`Products`.`ProductDescription` AS `ProductDescription`,`Products`.`Category` AS `Category`,`Sellers`.`BusinessName` AS `Seller` from ((`Sellers` join `sellerProducts` on(`Sellers`.`SellerID` = `sellerProducts`.`SellerID`)) join `Products` on(`Products`.`ProductID` = `sellerProducts`.`ProductID`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `sellersServices`
--
DROP TABLE IF EXISTS `sellersServices`;

DROP VIEW IF EXISTS `sellersServices`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sellersServices`  AS   (select `Services`.`ServiceType` AS `ServiceType`,`Services`.`Price` AS `Price`,`Services`.`image_path` AS `image_path`,`Services`.`ServiceDescription` AS `ServiceDescription`,`Sellers`.`BusinessName` AS `Seller` from ((`Sellers` join `sellerServices` on(`Sellers`.`SellerID` = `sellerServices`.`SellerID`)) join `Services` on(`Services`.`ServiceID` = `sellerServices`.`ServiceID`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Telephone` (`Telephone`);

--
-- Indexes for table `MySecurity`
--
ALTER TABLE `MySecurity`
  ADD PRIMARY KEY (`Telephone`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `sellerProducts`
--
ALTER TABLE `sellerProducts`
  ADD PRIMARY KEY (`SellerID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `Sellers`
--
ALTER TABLE `Sellers`
  ADD PRIMARY KEY (`SellerID`),
  ADD UNIQUE KEY `Telephone` (`Telephone`);

--
-- Indexes for table `sellerServices`
--
ALTER TABLE `sellerServices`
  ADD PRIMARY KEY (`SellerID`,`ServiceID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Indexes for table `Services`
--
ALTER TABLE `Services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `Subscribers`
--
ALTER TABLE `Subscribers`
  ADD PRIMARY KEY (`SNO`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `Sellers`
--
ALTER TABLE `Sellers`
  MODIFY `SellerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `Services`
--
ALTER TABLE `Services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Subscribers`
--
ALTER TABLE `Subscribers`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `MySecurity`
--
ALTER TABLE `MySecurity`
  ADD CONSTRAINT `fk_seller` FOREIGN KEY (`Telephone`) REFERENCES `Sellers` (`Telephone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellerProducts`
--
ALTER TABLE `sellerProducts`
  ADD CONSTRAINT `sellerProducts_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `Sellers` (`SellerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellerProducts_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellerServices`
--
ALTER TABLE `sellerServices`
  ADD CONSTRAINT `sellerServices_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `Sellers` (`SellerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellerServices_ibfk_2` FOREIGN KEY (`ServiceID`) REFERENCES `Services` (`ServiceID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
