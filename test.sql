-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2023 at 08:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `name` varchar(200) NOT NULL,
  `auther` varchar(200) NOT NULL,
  `numberPage` int(8) NOT NULL,
  `Price` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `user_id`, `name`, `auther`, `numberPage`, `Price`) VALUES
(29, 53, 'osama maree', 'osama', 13, '23'),
(30, 54, 'osama maree', 'osama', 13, '23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `gender` varchar(200) NOT NULL,
  `isAdmin` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `isAdmin`) VALUES
(50, 'ahmad', 'ahmad@gmail.com', '202cb962ac59075b964b07152d234b70', 'ahmad@gmail.com.jpg', ' male', 2),
(51, 'osama maree', 'osama@email.com', '202cb962ac59075b964b07152d234b70', 'osama@email.com.jpg', 'male', 2),
(52, 'ahmad', 'ahmad1@email.com', '202cb962ac59075b964b07152d234b70', 'ahmad1@email.com.jpg', ' male', 1),
(53, 'osama maree', 'tagreed2@gmail.com', '202cb962ac59075b964b07152d234b70', 'tagreed2@gmail.com.jpg', 'male', 2),
(54, 'osama maree', 'osamamarei2001@gmail.com', '202cb962ac59075b964b07152d234b70', 'osamamarei2001@gmail.com.jpg', 'male', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_PersonId` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_PersonId` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
