-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 02:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `userid` int(11) NOT NULL,
  `favoriteid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`userid`, `favoriteid`) VALUES
(500, 500),
(15, 0),
(25, 20),
(21, 22),
(20, 21),
(22, 23),
(24, 25),
(25, 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phonenumber` varchar(25) NOT NULL,
  `password` varchar(300) NOT NULL,
  `about` text NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `phonenumber`, `password`, `about`, `picture`) VALUES
(20, 'Ali', 'ali@gmail.com', '+1 574578688', '1234', 'Simple and Determined!', 'assets/images/image1.jpg'),
(21, 'Shnaya', 'shnaya@gmail.com', '+! 5466745866', '1234', 'Simple and Loving', 'assets/images/image2.jpg'),
(22, 'John', 'john@gmail.com', '+1  5675488567', '1234', 'Helpful', 'assets/images/image3.jpg'),
(23, 'Veena', 'veena@gmail.com', '+1 54577457', '1234', 'Loving and Caring', 'assets/images/image4.jpg'),
(24, 'Grek', 'grek@gmail.com', '+1 456476657', '1234', 'Spreading love!', 'assets/images/image5.jpg'),
(25, 'Aaya', 'aaya@gmail.com', '+1 54554676', '1234', 'Simply the best!', 'assets/images/image6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
