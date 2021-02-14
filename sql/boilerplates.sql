-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 13. Feb 2021 um 20:41
-- Server-Version: 10.4.15-MariaDB
-- PHP-Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `boilerplates`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boilerplates`
--

CREATE TABLE `boilerplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `boilerplates`
--

INSERT INTO `boilerplates` (`id`, `category`, `name`, `code`, `sorting`) VALUES
(1, 'php', 'php a', 'php 1', 1),
(2, 'php', 'php b', 'php 2', 2),
(3, 'php', 'php c', 'php 3', 3),
(4, 'js', 'js a', 'js 1', 1),
(5, 'js', 'js b', 'js 2', 2),
(6, 'js', 'js c', 'js 3', 3),
(7, 'html', 'html a', 'html 1', 1),
(8, 'html', 'html b', 'html 2', 2),
(9, 'html', 'html c', 'html 3', 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `boilerplates`
--
ALTER TABLE `boilerplates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `boilerplates`
--
ALTER TABLE `boilerplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
