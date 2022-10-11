-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Sep 2022 um 12:14
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `website`
--
CREATE DATABASE IF NOT EXISTS `website` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `website`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog`
--

CREATE TABLE `blog` (
                        `bid` int(255) NOT NULL,
                        `title` varchar(255) DEFAULT NULL,
                        `content` varchar(5000) DEFAULT NULL,
                        `author` varchar(255) DEFAULT NULL,
                        `created_at` varchar(255) DEFAULT NULL,
                        `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
                          `id` int(11) NOT NULL,
                          `author` varchar(255) NOT NULL,
                          `filename` varchar(255) NOT NULL,
                          `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `likes`
--

CREATE TABLE `likes` (
                         `id` int(11) NOT NULL,
                         `image_id` int(11) NOT NULL,
                         `voted_by` varchar(255) NOT NULL,
                         `voted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
                         `uid` int(255) NOT NULL,
                         `username` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `created_at` varchar(255) NOT NULL,
                         `voted` tinyint(1) DEFAULT 0,
                         `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog`
--
ALTER TABLE `blog`
    ADD UNIQUE KEY `bid` (`bid`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `likes`
--
ALTER TABLE `likes`
    ADD PRIMARY KEY (`id`),
    ADD KEY `image_id` (`image_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
    ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog`
--
ALTER TABLE `blog`
    MODIFY `bid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `likes`
--
ALTER TABLE `likes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
    MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `likes`
--
ALTER TABLE `likes`
    ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
