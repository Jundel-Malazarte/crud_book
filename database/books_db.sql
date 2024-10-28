-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 08:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `books_db`

-- --------------------------------------------------------

-- Table structure for table `books`
CREATE TABLE `books` (
  `ISBN` varchar(13) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Copyright` int NOT NULL,
  `Edition` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int NOT NULL,
  `Total` float GENERATED ALWAYS AS (Price * Quantity) STORED,
  PRIMARY KEY (`ISBN`)
);

COMMIT;
