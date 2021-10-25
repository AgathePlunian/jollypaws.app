-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2021 at 10:31 AM
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

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `title`, `content`, `main_image`, `creation_date`, `last_change_date`, `publish_date`) VALUES
(4, 1, 'azerzer', '[h2] Résumé [/h2]\r\n<a href=\"https://www.google.fr\"> Google </a>\r\n\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[h2] En savoir plus [/h2]												', 'media/25f7de5436f14207.png', '2021-10-08 07:07:52', '2021-10-14 10:15:26', '2021-10-22 16:59:47'),
(5, 2, 'azerzaerzar', '[h2] Résumé [/h2]\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[h2] En savoir plus [/h2]				', 'media/8169243f87aaeb32.png', '2021-10-08 13:19:02', '2021-10-08 13:19:02', NULL),
(6, 1, 'Ce titre ne fait aucun sens', '[h2] Résumé [/h2]\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[B]Important :[/B]\r\n\r\n[UL]\r\n   [LI] toto [/LI]\\\r\n   [LI] tata [/LI]\\\r\n[/UL]\r\n\r\n\r\n[h2] En savoir plus [/h2]												', 'media/c807391a8b0de5d1.png', '2021-10-08 14:26:39', '2021-10-21 07:50:50', '2021-10-22 16:59:48'),
(7, 1, 'Ceci est un article qui avant s\'appelait \"toto\"', '[h2] Résumé [/h2]\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[h2] En savoir plus [/h2]								', 'media/14c2b568b7acc689.png', '2021-10-10 16:49:10', '2021-10-21 07:48:56', '2021-10-22 16:59:50'),
(8, 1, 'toto', '[h2] Résumé [/h2]\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[h2] En savoir plus [/h2]												', 'media/3b607c7f1c086648.png', '2021-10-10 16:50:23', '2021-10-13 14:03:45', '2021-10-22 16:59:50'),
(9, 1, 'C\'est vraiment l\'article du désespoir', '[h2] Résumé [/h2]\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[h2] En savoir plus [/h2]								', 'media/09c40f01afd7a232.png', '2021-10-10 17:00:14', '2021-10-10 17:00:14', '2021-10-22 16:59:51'),
(10, 1, 'azertazgzertgretzefdgsdfazer', '[h2] Résumé [/h2]\r\n\r\n[h2] A retenir [/h2]\r\n\r\n[h2] En savoir plus [/h2]				', 'media/22a571a81df7cf30.png', '2021-10-22 08:16:33', '2021-10-22 08:16:33', '2021-10-22 16:59:52'),
(11, 1, 'audrey', '[h2] Résumé [/h2]\r\n\r\n\r\n[B] toto [/B]\r\ntata\r\n\r\n\r\n[h2] A retenir [/h2]\r\nJ\'ai un énorme cerveau\r\n\r\n\r\n\r\n\r\n[h2] En savoir plus [/h2]																', 'media/42d1f66536e809f1.png', '2021-10-22 19:27:27', '2021-10-22 19:39:04', '2021-10-22 19:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id_article` int(255) NOT NULL,
  `id_category` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles_categories`
--

INSERT INTO `articles_categories` (`id_article`, `id_category`) VALUES
(6, 1),
(6, 2),
(6, 3),
(9, 1),
(9, 2),
(11, 1),
(11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `articles_published`
--

CREATE TABLE `articles_published` (
  `id_article` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles_published`
--

INSERT INTO `articles_published` (`id_article`) VALUES
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'PTSD'),
(2, 'Enfant'),
(3, 'TRAUMA'),
(4, 'POMPIERS'),
(5, 'UNIFORME'),
(8, 'hvhukvvkjvk');

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
(1, 8, 1),
(2, NULL, 2),
(3, 9, 2);

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
(6, 'MANAGE_CATEGORIES');

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
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 3),
(3, 3),
(1, 4),
(2, 4),
(3, 4),
(1, 5),
(2, 5),
(3, 5),
(1, 6),
(2, 6),
(3, 6),
(4, 5),
(5, 5),
(4, 4),
(4, 4),
(4, 6),
(5, 6),
(4, 3),
(5, 3),
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(5, 7),
(1, 8),
(2, 8),
(3, 8),
(4, 8),
(5, 8),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(5, 10),
(1, 11),
(2, 11),
(3, 11),
(4, 11),
(5, 11),
(6, 1);

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
(1, 'Bastien', 'LABOUCHE', 'bastien.labouche@resileyes.com', '$2y$10$Y9wqbZMc0h0zO3emJeOwHONkDfbd6he7impU0dIH9J/8aUjTJRaHy'),
(2, 'Jean', 'Michel', 'jean.michel@resileyes.com', '$2y$10$/8gmrt8gMC85dNi/0xzH/O1WKXoWtbMAmMe4qcj/dTdkWfBlsXAJS'),
(3, 'Yannick', 'TRESCOS', 'yannick.trescos@resileyes.com', '$2y$10$PG0KlNJ3jGDEXtTrrQIz5./JlVG4qD9r8iYsFVQrZFijNNM9HHej.'),
(4, 'Annaïg', 'TRESCOS', 'annaig.trescos@resileyes.com', '$2y$10$k3YLqvn3AenAIUk62aM6XO51FyyZlMEP4LJNZRkYMfA59N4Ica1e.'),
(5, 'Agathe', 'PLUNIAN', 'agathe.plunian@resileyes.com', '$2y$10$GI/9kFMEVHmAp4sisP3/DeWKOiBabEKTraq5pEW0LRODUlQtLvKwy'),
(6, 'Paul', 'LEDESMA', 'paul.ledesma@resileyes.com', '$2y$10$PoIASwCPOh89GU7bHeDhi.7DLFXUra60JNcZqLfuO6KxQLhdnKHZe'),
(7, 'Catinca', 'GHEORGHIU', 'catinca.gheorghiu@resileyes.com', '$2y$10$0lT1eTUUl2ywX2W/srLxiO69ivzRC3FA.ieKkI2ScweOICu0PFSVa'),
(8, 'Ornella', 'Ouagazzal', 'ornella.ouagazzal@resileyes.com', '$2y$10$Yi.ankoHEPUWfuf4x.Pb2ORZBRe2FD28Nmo.IeJbNobqct6OFTy3y'),
(9, 'Marie', 'MATTHYS', 'marie.matthys@resileyes.com', '$2y$10$qeUbyx5nFYlKFpmLfOa4lOr0aE6e9Xym/9LEaBzfdIBnOxZO/YEVi'),
(10, 'Yann', 'BEMBA', 'yann.bemba@resileyes.com', '$2y$10$XoKUx5RJ594byOiJ7dvNWOeGXa8SJ0dNlwxhVHnyLR8z50Gb8iNHa'),
(11, 'Nicolas', 'VAN HEUSDEN', 'nicolas.vanheusden@resileyes.com', '$2y$10$dW3.xEbWEnJ0KIYNtGrdG.rvxGoxBgPINZ1Y1XMtXnFp6.ClpqHJK');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `front_page_articles`
--
ALTER TABLE `front_page_articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
