-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 24 sep. 2021 à 11:51
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
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` timestamp NULL DEFAULT current_timestamp(),
  `last_change_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `creation_date`, `last_change_date`) VALUES
(2, 'Mon super article !', '[h1] Résumé [/h1]\r\nEn fait, j\'ai écris un article, mais j\'ai oublié ce que je voulais mettre dedans\r\n\r\n\r\n\r\n\r\n\r\n\r\n[h1] Résumé [/h1]\r\nEn fait, j\'ai écris un article, mais j\'ai oublié ce que je voulais mettre dedans\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n[h1] A retenir [/h1]\r\nPas grand chose du coup\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n[h1] En savoir plus [/h1]\r\n...\r\n		\r\n\r\n\r\n\r\n\r\n\r\n\r\n[h1] A retenir [/h1]\r\nPas grand chose du coup\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n[h1] En savoir plus [/h1]\r\n...\r\n		', '2021-09-18 22:00:00', '2021-09-18 22:00:00'),
(3, 'toto', '[h1] Résumé [/h1]\r\nEncore un article\r\n\r\n\r\n\r\n[h1] A retenir [/h1]\r\nMa fonction marche trop bien\r\n\r\n\r\n\r\n[h1] En savoir plus [/h1]\r\nJe suis vraiment exceptionnel\r\n		', '2021-09-18 22:00:00', '2021-09-18 22:00:00'),
(4, '', '[h1] Résumé [/h1]\r\n\r\n[h1] A retenir [/h1]\r\n\r\n[h1] En savoir plus [/h1]\r\n			', '2021-09-23 22:00:00', '2021-09-23 22:00:00'),
(5, '', '[h1] Résumé [/h1]\r\n\r\n[h1] A retenir [/h1]\r\n\r\n[h1] En savoir plus [/h1]\r\n			', '2021-09-23 22:00:00', '2021-09-23 22:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'CREATE_ARTICLE');

-- --------------------------------------------------------

--
-- Structure de la table `permissions_users`
--

CREATE TABLE `permissions_users` (
  `id` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `permissions_users`
--

INSERT INTO `permissions_users` (`id`, `id_permission`, `id_user`) VALUES
(6, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(2, 'Bastien', 'LABOUCHE', 'bastien.labouche@resileyes.com', '$2y$10$Y9wqbZMc0h0zO3emJeOwHONkDfbd6he7impU0dIH9J/8aUjTJRaHy');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions` (`id_permission`) USING BTREE,
  ADD KEY `users` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `permissions_users`
--
ALTER TABLE `permissions_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD CONSTRAINT `permissions` FOREIGN KEY (`id_permission`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
