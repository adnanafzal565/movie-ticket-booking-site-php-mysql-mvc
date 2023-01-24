-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 17, 2020 at 02:37 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviepoint_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$BqCGHI7Tr1nWxX5p.4RleeKPshxUv6WFpf25fWZCkyClA.N6TVjTm');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `id` int(11) NOT NULL,
  `name` text,
  `picture` text,
  `description` text,
  `height` text,
  `weight` text,
  `eye_color` text,
  `hair_color` text,
  `birthday` date DEFAULT NULL,
  `facebook` text,
  `twitter` text,
  `youtube` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`id`, `name`, `picture`, `description`, `height`, `weight`, `eye_color`, `hair_color`, `birthday`, `facebook`, `twitter`, `youtube`) VALUES
(2, 'Brie Larson', 'uploads/celebrities/1608172320-1598558810-MV5BMjExODkxODU3NF5BMl5BanBnXkFtZTgwNTM0MTk3NjE@._V1_UY317_CR7,0,214,317_AL_.jpg', 'Brie Larson', '5.7\"', '59 kg', 'Black', 'Blonde', '2020-12-08', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`) VALUES
(2, 'iMax');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` text,
  `description` text,
  `writer` text,
  `director` text,
  `duration` text,
  `release_date` datetime DEFAULT NULL,
  `languages` text,
  `price_per_ticket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `writer`, `director`, `duration`, `release_date`, `languages`, `price_per_ticket`) VALUES
(1, 'Captain Marvel', 'Carol Danvers becomes one of the universe\'s most powerful heroes when Earth is caught in the middle of a galactic war between two alien races.', 'Anna Boden', 'Anna Boden', '45m', '2020-12-09 00:00:00', 'English', 678);

-- --------------------------------------------------------

--
-- Table structure for table `movie_cast`
--

CREATE TABLE `movie_cast` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `cast_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_cast`
--

INSERT INTO `movie_cast` (`id`, `movie_id`, `cast_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `movie_categories`
--

CREATE TABLE `movie_categories` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_categories`
--

INSERT INTO `movie_categories` (`id`, `movie_id`, `category_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `movie_cinemas`
--

CREATE TABLE `movie_cinemas` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `movie_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_cinemas`
--

INSERT INTO `movie_cinemas` (`id`, `movie_id`, `cinema_id`, `movie_time`) VALUES
(1, 1, 2, '2020-12-17 08:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `movie_thumbnails`
--

CREATE TABLE `movie_thumbnails` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `file_path` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_thumbnails`
--

INSERT INTO `movie_thumbnails` (`id`, `movie_id`, `file_path`) VALUES
(1, 1, 'uploads/movie_thumbnails/1608172386-1598559032-wp3948722.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trailers`
--

CREATE TABLE `trailers` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `file_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trailers`
--

INSERT INTO `trailers` (`id`, `movie_id`, `file_path`) VALUES
(1, 1, 'uploads/movie_trailers/1608172386-1598562542-Marvel-Studios-Captain-Marvel---Official-Trailer.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `mobile_number` text NOT NULL,
  `verification_code` text NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `reset_password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile_number`, `verification_code`, `verified_at`, `reset_password`) VALUES
(7, 'Adnan Afzal', 'adnan@gmail.com', '$2y$10$HUi/noe1BHjR967b3t08junj5Kl0ZJ6VisGUYhtMAOyKc//GJvinC', '1233', '183898', '2020-08-27 00:48:47', 'd882a17502cdc2bdf4848e6a553d18e4'),
(8, 'Ali', 'ali@gmail.com', '$2y$10$fs2vVOunF7VEddTqvzH5JOPCbe/gTo9RyhgY53iN4kL27FGxy13PC', '123456', '952753', '2020-08-29 11:03:19', NULL),
(9, 'Ahmad', 'ahmad@gmail.com', '$2y$10$yeVfM3yz.jSQYIe3gO20ZeY2nt6cLxKTl4EWS9KyFStOg5waNe2DS', '123456', '316037', '2020-08-29 11:03:51', NULL),
(10, 'Yasir', 'yasir@gmail.com', '$2y$10$7gWks2rF/99/Esc1YqbLDOI1kzPQN71A31UAnU4j3.tfKS4DcsZAW', '123456', '302568', '2020-08-29 11:05:19', NULL),
(11, 'Jinnah', 'jinnah@gmail.com', '$2y$10$uolwHENemBrUhkIPogymT.ZaziF5klBPe7FWwF9O0d3c8hdNaDZoG', '1234567', '250193', '2020-08-29 11:05:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_cast`
--
ALTER TABLE `movie_cast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_cast_cast_id` (`cast_id`),
  ADD KEY `movie_cast_movie_id` (`movie_id`);

--
-- Indexes for table `movie_categories`
--
ALTER TABLE `movie_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie_categories_category_id` (`category_id`),
  ADD KEY `fk_movie_categories_movie_id` (`movie_id`);

--
-- Indexes for table `movie_cinemas`
--
ALTER TABLE `movie_cinemas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie_cinemas_cinema_id` (`cinema_id`),
  ADD KEY `fk_movie_cinemas_movie_id` (`movie_id`);

--
-- Indexes for table `movie_thumbnails`
--
ALTER TABLE `movie_thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie_thumbnails_movie_id` (`movie_id`);

--
-- Indexes for table `trailers`
--
ALTER TABLE `trailers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trailers_movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `celebrities`
--
ALTER TABLE `celebrities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie_cast`
--
ALTER TABLE `movie_cast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie_categories`
--
ALTER TABLE `movie_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie_cinemas`
--
ALTER TABLE `movie_cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie_thumbnails`
--
ALTER TABLE `movie_thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trailers`
--
ALTER TABLE `trailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_cast`
--
ALTER TABLE `movie_cast`
  ADD CONSTRAINT `movie_cast_cast_id` FOREIGN KEY (`cast_id`) REFERENCES `celebrities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_cast_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_categories`
--
ALTER TABLE `movie_categories`
  ADD CONSTRAINT `fk_movie_categories_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movie_categories_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_cinemas`
--
ALTER TABLE `movie_cinemas`
  ADD CONSTRAINT `fk_movie_cinemas_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movie_cinemas_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_thumbnails`
--
ALTER TABLE `movie_thumbnails`
  ADD CONSTRAINT `fk_movie_thumbnails_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trailers`
--
ALTER TABLE `trailers`
  ADD CONSTRAINT `fk_trailers_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
