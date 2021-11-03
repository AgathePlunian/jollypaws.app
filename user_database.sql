-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2021 at 03:31 PM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `approbations`
--

CREATE TABLE `approbations` (
  `id_approbation_request` int(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(255) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT current_timestamp(),
  `last_change_date` timestamp NULL DEFAULT current_timestamp(),
  `publish_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id_article` int(255) NOT NULL,
  `id_category` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `articles_published`
--

CREATE TABLE `articles_published` (
  `id_article` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `front_page_articles`
--

CREATE TABLE `front_page_articles` (
  `id` int(255) NOT NULL,
  `id_article` int(255) DEFAULT NULL,
  `importance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_page_articles`
--

INSERT INTO `front_page_articles` (`id`, `id_article`, `importance`) VALUES
(1, NULL, 1),
(2, NULL, 2),
(3, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'CREATE_ARTICLE'),
(2, 'DEL_ARTICLE'),
(3, 'APPROVE_ARTICLE'),
(4, 'PUBLISH_ARTICLE'),
(5, 'CREATE_ACCOUNT'),
(6, 'MANAGE_CATEGORIES'),
(7, 'ADD_REMOVE_PERM'),
(8, 'REMOVE_ACCOUNT'),
(9, 'RESET_PASSWORD');

-- --------------------------------------------------------

--
-- Table structure for table `permissions_users`
--

CREATE TABLE `permissions_users` (
  `id_permission` int(11) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions_users`
--

INSERT INTO `permissions_users` (`id_permission`, `id_user`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id_article` int(255) NOT NULL,
  `trashed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Bastien', 'LABOUCHE', 'bastien.labouche@resileyes.com', '$2y$10$Okn5f9hxwUKQ9IBZC1WE3umqOzB2JQTAnS7U/Cmhp8c/tJvUi9dQe');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_approval`
--

CREATE TABLE `waiting_approval` (
  `id` int(255) NOT NULL,
  `id_article` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approbations`
--
ALTER TABLE `approbations`
  ADD KEY `id approbation request` (`id_approbation_request`),
  ADD KEY `id user` (`id_user`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Saving author id for article` (`author_id`);

--
-- Indexes for table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `articles_published`
--
ALTER TABLE `articles_published`
  ADD KEY `id article` (`id_article`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_page_articles`
--
ALTER TABLE `front_page_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id article front page article` (`id_article`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD KEY `permissions` (`id_permission`) USING BTREE,
  ADD KEY `users` (`id_user`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD KEY `trashed_article` (`id_article`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article waiting approval` (`id_article`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_page_articles`
--
ALTER TABLE `front_page_articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approbations`
--
ALTER TABLE `approbations`
  ADD CONSTRAINT `id approbation request` FOREIGN KEY (`id_approbation_request`) REFERENCES `waiting_approval` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `Saving author id for article` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD CONSTRAINT `id_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_category` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles_published`
--
ALTER TABLE `articles_published`
  ADD CONSTRAINT `id article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `front_page_articles`
--
ALTER TABLE `front_page_articles`
  ADD CONSTRAINT `id article front page article` FOREIGN KEY (`id_article`) REFERENCES `articles_published` (`id_article`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD CONSTRAINT `permissions` FOREIGN KEY (`id_permission`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trash`
--
ALTER TABLE `trash`
  ADD CONSTRAINT `trashed_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  ADD CONSTRAINT `article waiting approval` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
