-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 07:21 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movieforumdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(8) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'comedy', 'comedy movies'),
(2, 'Horror', 'Horror Movie'),
(5, 'Romantic Movie', 'Romance and Love');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(8) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(4, '123', '2021-11-25 10:18:30', 6, 2),
(5, '123', '2021-11-25 10:18:33', 7, 2),
(6, 'It is a bad movie', '2021-11-27 13:33:33', 8, 2),
(7, '123', '2021-11-28 18:39:47', 6, 2),
(8, '123', '2021-11-28 18:43:05', 6, 3),
(9, 'is it working', '2021-11-28 18:49:00', 6, 3),
(10, 'i can reply to this', '2021-11-28 18:52:21', 6, 1),
(11, 'i can reply to this', '2021-11-28 18:52:33', 6, 1),
(12, '32', '2021-11-28 18:52:41', 6, 1),
(13, '32', '2021-11-28 18:52:43', 6, 1),
(14, 'They are the best type of movies', '2021-11-28 18:54:04', 9, 1),
(15, 'scary movies are fine', '2021-11-28 18:54:26', 9, 2),
(16, 'I hate scary movies', '2021-11-28 18:54:48', 9, 3),
(17, 'no they are not you are just a coward', '2021-11-28 18:56:57', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(8) NOT NULL,
  `reply_content` varchar(255) NOT NULL,
  `reply_date` datetime NOT NULL,
  `reply_topic` int(8) NOT NULL,
  `reply_by` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(8) NOT NULL,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(6, 'Horror movies meh', '2021-11-25 10:18:30', 1, 2),
(7, 'Horror movies meh', '2021-11-25 10:18:33', 1, 2),
(8, 'Avengers is boring', '2021-11-27 13:33:33', 1, 2),
(9, 'I love watching scary movies', '2021-11-28 18:54:04', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(7) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `usertype`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'lquinto', 'lancegabriel.quinto.iics@ust.edu.ph', '13cf7f49665088098ecf43e96067066d', 1),
(3, 'ysa', 'ysa@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(5, 'conken', 'ckent@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(6, 'newuser', 'newuser@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(7, '234', 'po@gmail.com', '76d80224611fc919a5d54f0ff9fba446', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name_unique` (`cat_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_topic` (`post_topic`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_cat` (`topic_cat`),
  ADD KEY `topic_by` (`topic_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`userID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
