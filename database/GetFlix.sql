-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database:3306
-- Généré le :  ven. 09 avr. 2021 à 13:00
-- Version du serveur :  10.4.2-MariaDB-1:10.4.2+maria~bionic
-- Version de PHP :  7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `GetFlix`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uid` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `message` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `uid`, `date`, `message`) VALUES
(16, 'anon', '2021-04-07 00:00:00', 'edited comment'),
(63, NULL, '2021-04-08 05:52:44', 'test'),
(64, NULL, '2021-04-09 08:06:06', 'ss'),
(65, NULL, '2021-04-09 08:06:11', 'qzdqdaefef'),
(66, NULL, '2021-04-09 08:06:33', 'dflkdqkklds'),
(67, NULL, '2021-04-09 08:08:15', 'eeafe'),
(68, NULL, '2021-04-09 08:08:22', 'dsqlksqcklkqs');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirmation_token`, `confirmed_at`) VALUES
(33, 'lordofchicken', 'gael.layeux@poulet.org', '$2y$10$QJq6//fZZeUhrcedi8FSB.RPfrprMXYdFX4AAauCK7AWBdgwFwhea', NULL, NULL),
(34, 'gael', 'gael.layeux@gmail.com', '$2y$10$tyhyBwdXMqJ3DwZPebNwieDnA7IURCkV6FPsKkzqKm2vhGBIwB6re', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
