-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Apr 2024 um 21:48
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
  `title` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `seasons` int(11) DEFAULT NULL,
  `summary` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `default_series`
--

INSERT INTO `default_series` (`id`, `title`, `year`, `seasons`, `summary`) VALUES
(1, 'Breaking Bad', 2008, 5, 'A high school chemistry teacher turned methamphetamine manufacturer.'),
(2, 'Game of Thrones', 2011, 8, 'Seven noble families fight for control of the mythical land of Westeros.'),
(3, 'Stranger Things', 2016, 4, 'A group of kids uncover a series of supernatural occurrences in their small town.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `my_playlists`
--

CREATE TABLE `my_playlists` (
  `playlist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `playlist_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `my_series`
--

CREATE TABLE `my_series` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `series_id` int(11) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `title` varchar(40) NOT NULL,
  `year` int(4) NOT NULL,
  `seasons` int(11) DEFAULT NULL,
  `genre` varchar(30) NOT NULL,
  `platform` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `name`, `email`, `password`) VALUES
(1, 'Hilal', 'h.cub@web.de', '$2y$10$1grTDt65zzfq7n0ucR8K4OT23dUWDYVnRW8BOY8vv3Zfuj0Fq3xXC');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `default_series`
--
ALTER TABLE `default_series`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `series_id` (`series_id`),
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
-- AUTO_INCREMENT für Tabelle `default_series`
--
ALTER TABLE `default_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `my_playlists`
--
ALTER TABLE `my_playlists`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `my_series`
--
ALTER TABLE `my_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `my_series_ibfk_2` FOREIGN KEY (`series_id`) REFERENCES `default_series` (`id`),
  ADD CONSTRAINT `my_series_ibfk_3` FOREIGN KEY (`playlist_id`) REFERENCES `my_playlists` (`playlist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
