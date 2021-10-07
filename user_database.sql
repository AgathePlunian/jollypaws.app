-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 07 oct. 2021 à 21:41
-- Version du serveur :  10.3.31-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `user_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `approbations`
--

CREATE TABLE `approbations` (
  `id_approbation_request` int(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
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
-- Structure de la table `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id_article` int(255) NOT NULL,
  `id_category` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `articles_published`
--

CREATE TABLE `articles_published` (
  `id` int(255) NOT NULL,
  `id_article` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'PTSD'),
(2, 'Enfant'),
(3, 'TRAUMA'),
(4, 'POMPIERS');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'CREATE_ARTICLE'),
(2, 'DEL_ARTICLE'),
(3, 'APPROVE_ARTICLE'),
(4, 'PUBLISH_ARTICLE'),
(5, 'CREATE_ACCOUNT');

-- --------------------------------------------------------

--
-- Structure de la table `permissions_users`
--

CREATE TABLE `permissions_users` (
  `id_permission` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `permissions_users`
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
(5, 11);

-- --------------------------------------------------------

--
-- Structure de la table `trash`
--

CREATE TABLE `trash` (
  `id_article` int(255) NOT NULL,
  `trashed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
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
-- Structure de la table `waiting_approval`
--

CREATE TABLE `waiting_approval` (
  `id` int(255) NOT NULL,
  `id_article` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `approbations`
--
ALTER TABLE `approbations`
  ADD KEY `id approbation request` (`id_approbation_request`),
  ADD KEY `id user` (`id_user`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Saving author id for article` (`author_id`);

--
-- Index pour la table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `articles_published`
--
ALTER TABLE `articles_published`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id article` (`id_article`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD KEY `permissions` (`id_permission`) USING BTREE,
  ADD KEY `users` (`id_user`);

--
-- Index pour la table `trash`
--
ALTER TABLE `trash`
  ADD KEY `trashed_article` (`id_article`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article waiting approval` (`id_article`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `articles_published`
--
ALTER TABLE `articles_published`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `approbations`
--
ALTER TABLE `approbations`
  ADD CONSTRAINT `id approbation request` FOREIGN KEY (`id_approbation_request`) REFERENCES `waiting_approval` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `Saving author id for article` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD CONSTRAINT `id_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_category` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles_published`
--
ALTER TABLE `articles_published`
  ADD CONSTRAINT `id article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD CONSTRAINT `permissions` FOREIGN KEY (`id_permission`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `trash`
--
ALTER TABLE `trash`
  ADD CONSTRAINT `trashed_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `waiting_approval`
--
ALTER TABLE `waiting_approval`
  ADD CONSTRAINT `article waiting approval` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
