-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Gegenereerd op: 07 apr 2021 om 08:30
-- Serverversie: 10.4.2-MariaDB-1:10.4.2+maria~bionic
-- PHP-versie: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GetFlix`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uid` varchar(128) CHARACTER SET latin1 NOT NULL,
  `date` datetime NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `uid`, `date`, `message`) VALUES
(1, 'anon', '2021-04-06 19:33:16', 'test'),
(2, 'anon', '2021-04-06 19:33:53', 'i like this video, very funny!\r\n');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` enum('guest','admin','user','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `role`) VALUES
(7, 'Layeux', 'Gael', 'lordofchicken', 'gael.layeux@poulet.org', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'guest'),
(16, 'Rob', 'Klockaerts', 'rob', 'rob.klockaerts@hotmail.com', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'admin'),
(18, 'john', 'doe', 'john', 'john.doe@mail.com', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'guest'),
(20, 'jane', 'doe', 'jane', 'jane.doe@mail.com', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'guest');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `user`
--
... (8 lines left)