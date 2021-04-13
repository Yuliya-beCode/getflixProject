-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : lordofqchicken.mysql.db
-- Généré le :  mar. 13 avr. 2021 à 11:36
-- Version du serveur :  5.6.50-log
-- Version de PHP :  7.2.34

CREATE DATABASE IF NOT EXISTS GetFlix;
USE GetFlix;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lordofqchicken`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id2` int(50) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` int(50) DEFAULT NULL,
  `moovieid` int(10) DEFAULT NULL,
  `userid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id2`, `comment`, `parent_id`, `moovieid`, `userid`) VALUES
(10, 'jkdfskjjkdsjkf', NULL, NULL, '33'),
(11, 'bloups', NULL, NULL, '33'),
(12, 'dmllmdfslms', NULL, NULL, '33'),
(13, 'qeDFSFDVD', NULL, NULL, '33'),
(15, 'blip', NULL, NULL, '33'),
(16, 'hhgdchcd', NULL, 399566, '33'),
(17, 'dsfsd', NULL, 399566, '33'),
(18, 'qfdsfgdfh', NULL, 399566, '33'),
(19, 'dsqdSQd', NULL, 36727, '35'),
(20, 'qsqf', NULL, 36727, '35'),
(21, 'qsfqf', NULL, 36727, '35'),
(22, 'sdQFFDSFD', NULL, 36727, '35'),
(23, 'pala', NULL, 36727, '35'),
(24, 'hallo', NULL, 36727, '35'),
(25, '1x ou 2?', NULL, 36727, '35'),
(26, 'jdsjkjkdf', NULL, 121875, '33'),
(29, 'qdfsjkvqfJZQLRHG JZETKG', NULL, 443802, '33'),
(30, 'qfezf', NULL, 443802, '33'),
(31, 'sqgqdh', NULL, 443802, '33'),
(32, 'hahah', NULL, 443802, '33'),
(46, 'sdfkllkkds', NULL, 527774, '33'),
(47, 'qfklklfdgkl', NULL, 527774, '33'),
(48, 'ejdfsjkjkjkf', NULL, 527774, '33'),
(49, 'edledklld', NULL, 527774, '33'),
(50, 'edledklld', NULL, 527774, '33'),
(51, 'edledklld', NULL, 527774, '33'),
(52, 'edledklld', NULL, 527774, '33'),
(53, 'qdfzrfg', NULL, 527774, '33'),
(54, 'qdfzrfg', NULL, 527774, '33'),
(55, 'ezfLKKLDF', NULL, 527774, '33'),
(56, 'ezfLKKLDF', NULL, 527774, '33'),
(57, 'qfefaF', NULL, 399566, '33'),
(58, 'qfefaF', NULL, 399566, '33'),
(59, 'SDZSG', NULL, 412656, '33'),
(60, 'SDZSG', NULL, 412656, '33'),
(61, 'jkdsjkdsjkdsjk', NULL, 412656, '33'),
(62, 'jkdsjkdsjkdsjk', NULL, 412656, '33'),
(63, 'lkdkldksl', NULL, 64362, '33'),
(64, 'lkdkldksl', NULL, 64362, '33'),
(65, 'jkdqfjks', NULL, NULL, NULL),
(66, 'kjdjkjdksjkd', NULL, 399566, NULL),
(67, '', NULL, 221548, '33');

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
(34, 'gael', 'gael.layeux@gmail.com', '$2y$10$tyhyBwdXMqJ3DwZPebNwieDnA7IURCkV6FPsKkzqKm2vhGBIwB6re', NULL, NULL),
(35, 'becode', 'gael.layeux@icloud.com', '$2y$10$g9SIsLwdyWcjk85THo3xtO4TscnHhmUyaaQpmUeY68rLFQMDtkxju', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id2`);

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
  MODIFY `id2` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
