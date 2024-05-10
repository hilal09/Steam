-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Mai 2024 um 17:04
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `steam`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `default_series`
--

CREATE TABLE `default_series` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `year` int(4) NOT NULL,
  `seasons` int(11) DEFAULT NULL,
  `genre` varchar(30) NOT NULL,
  `platform` varchar(30) DEFAULT NULL,
  `picture_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `default_series`
--

INSERT INTO `default_series` (`id`, `title`, `year`, `seasons`, `genre`, `platform`, `picture_url`) VALUES
(1, 'Breaking Bad', 2008, 5, 'Drama', 'Netflix', '../uploads/default_series/BreakingBad.jpg'),
(2, 'Friends', 1994, 10, 'Comedy', 'HBO Max', '../uploads/default_series/Friends.jpg'),
(3, 'Stranger Things', 2016, 4, 'Sci-fi', 'Netflix', '../uploads/default_series/StrangerThings.jpg'),
(4, 'BoJack Horseman', 2014, 6, 'Animation', 'Netflix', '../uploads/default_series/BoJackJorseman.jpg'),
(5, 'Game of Thrones', 2011, 8, 'Action', 'HBO', '../uploads/default_series/GameofThrones.jpg'),
(6, 'The Mandalorian', 2019, 2, 'Sci-fi', 'Disney+', '../uploads/default_series/TheMandalorian.jpg'),
(7, 'The Haunting of Hill House', 2018, 2, 'Horror', 'Netflix', '../uploads/default_series/TheHauntingofHillHouse.jpg'),
(8, 'The Handmaid`s Tale', 2017, 4, 'Drama', 'Hulu', '../uploads/default_series/TheHandmaidsTale.jpg'),
(9, 'The Witcher', 2019, 2, 'Fantasy', 'Netflix', '../uploads/default_series/TheWitcher.jpg'),
(10, 'Westworld', 2016, 3, 'Sci-fi', 'HBO', '../uploads/default_series/Westworld.jpg'),
(11, 'Brooklyn Nine-Nine', 2013, 8, 'Comedy', 'NBC', '../uploads/default_series/BrooklynNineNine.jpg'),
(12, 'Loki', 2021, 1, 'Action', 'Disney+', '../uploads/default_series/Loki.jpg'),
(13, 'Rick and Morty', 2013, 5, 'Animation', 'Adult Swim', '../uploads/default_series/RickandMorty.jpg'),
(14, 'The Boys', 2019, 2, 'Action', 'Amazon Prime', '../uploads/default_series/TheBoys.jpg'),
(15, 'Money Heist', 2017, 5, 'Thriller', 'Netflix', '../uploads/default_series/MoneyHeist.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `my_playlists`
--

CREATE TABLE `my_playlists` (
  `playlist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `playlist_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `my_playlists`
--

INSERT INTO `my_playlists` (`playlist_id`, `user_id`, `playlist_name`) VALUES
(4, 6, 'Watched'),
(5, 6, 'Currently watching'),
(6, 6, 'Wishlist'),
(7, 7, 'Watched'),
(8, 7, 'Currently watching'),
(9, 7, 'Wishlist');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `my_series`
--

CREATE TABLE `my_series` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `title` varchar(40) NOT NULL,
  `year` int(4) NOT NULL,
  `seasons` int(11) DEFAULT NULL,
  `genre` varchar(30) NOT NULL,
  `platform` varchar(30) DEFAULT NULL,
  `picture` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `name`, `email`, `password`, `avatar`) VALUES
(6, 'Hilal', 'hallo@hallo.de', '$2y$10$ASdlVFyzB2cm0n7kNN4am.SKeMIPDxK5xSv0/2aqWW0tO.dOoYgJS', NULL),
(7, 'Hilal', 'h.cub@web.de', '$2y$10$wFkYt3Gd1iqwWqJ4YA5UiecOLg5Z2vtJTo8LkqnxlW.ne4GX0mCkO', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `my_playlists`
--
ALTER TABLE `my_playlists`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `my_series`
--
ALTER TABLE `my_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indizes für die Tabelle `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `my_playlists`
--
ALTER TABLE `my_playlists`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `my_series`
--
ALTER TABLE `my_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `my_playlists`
--
ALTER TABLE `my_playlists`
  ADD CONSTRAINT `my_playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`);

--
-- Constraints der Tabelle `my_series`
--
ALTER TABLE `my_series`
  ADD CONSTRAINT `my_series_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`),
  ADD CONSTRAINT `my_series_ibfk_3` FOREIGN KEY (`playlist_id`) REFERENCES `my_playlists` (`playlist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
