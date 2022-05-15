-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Erstellungszeit: 05. Mai 2022 um 11:18
-- Server-Version: 8.0.27
-- PHP-Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `motogpdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_comments`
--

DROP TABLE IF EXISTS `MGP_comments`;
CREATE TABLE `MGP_comments` (
  `CID` int NOT NULL COMMENT 'Comment ID',
  `EID` tinyint NOT NULL COMMENT 'Event ID',
  `UID` tinyint NOT NULL COMMENT 'User ID',
  `Date` datetime DEFAULT NULL,
  `Comment` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_events`
--

DROP TABLE IF EXISTS `MGP_events`;
CREATE TABLE `MGP_events` (
  `EID` tinyint NOT NULL,
  `Ort` varchar(64) NOT NULL,
  `Deadline` datetime NOT NULL,
  `P1` tinyint DEFAULT NULL,
  `P2` tinyint DEFAULT NULL,
  `P3` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `MGP_events`
--

INSERT INTO `MGP_events` (`EID`, `Ort`, `Deadline`, `P1`, `P2`, `P3`) VALUES
(1, 'Doha', '2022-03-06 10:00:00', 23, 33, 44),
(2, 'Mandalika', '2022-03-20 10:00:00', 88, 20, 5),
(3, 'Termas', '2022-04-03 10:00:00', 41, 89, 42),
(4, 'Austin', '2022-04-10 10:00:00', 23, 42, 43),
(5, 'Portimao', '2022-04-24 13:00:00', 20, 5, 41),
(6, 'Jerez', '2022-05-01 13:00:00', 63, 20, 41),
(7, 'LeMans', '2022-05-15 13:00:00', NULL, NULL, NULL),
(8, 'Mugello', '2022-05-29 13:00:00', NULL, NULL, NULL),
(9, 'Catalunya', '2022-06-05 13:00:00', NULL, NULL, NULL),
(10, 'Sachsenring', '2022-06-19 13:00:00', NULL, NULL, NULL),
(11, 'Assen', '2022-06-26 13:00:00', NULL, NULL, NULL),
(12, 'Kymiring', '2022-07-10 13:00:00', NULL, NULL, NULL),
(13, 'Silverstone', '2022-08-07 13:00:00', NULL, NULL, NULL),
(14, 'RedBullRing', '2022-08-21 13:00:00', NULL, NULL, NULL),
(15, 'Misano', '2022-09-04 13:00:00', NULL, NULL, NULL),
(16, 'Aragon', '2022-09-18 13:00:00', NULL, NULL, NULL),
(17, 'Motegi', '2022-09-25 07:00:00', NULL, NULL, NULL),
(18, 'Buriram', '2022-10-02 07:00:00', NULL, NULL, NULL),
(19, 'PI', '2022-10-16 06:00:00', NULL, NULL, NULL),
(20, 'Sepang', '2022-10-23 07:00:00', NULL, NULL, NULL),
(21, 'Valencia', '2022-11-06 13:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_riders`
--

DROP TABLE IF EXISTS `MGP_riders`;
CREATE TABLE `MGP_riders` (
  `RID` tinyint NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Vorname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `MGP_riders`
--

INSERT INTO `MGP_riders` (`RID`, `Name`, `Vorname`) VALUES
(5, 'Zarco', 'Johann'),
(6, 'Bradl', 'Stefan'),
(10, 'Marini', 'Luca'),
(12, 'Vinales', 'Maverick'),
(20, 'Quartararo', 'Fabio'),
(21, 'Morbidelli', 'Franco'),
(23, 'Bastianini', 'Enea'),
(25, 'Fernandez', 'Raul'),
(30, 'Nakagami', 'Takaaki'),
(33, 'Binder', 'Brad'),
(36, 'Mir', 'Joan'),
(40, 'Binder', 'Darryn'),
(41, 'Espargaro', 'Aleix'),
(42, 'Rins', 'Alex'),
(43, 'Miller', 'Jack'),
(44, 'Espargaro', 'Pol'),
(49, 'diGianantonio', 'Fabio'),
(63, 'Bagnaia', 'Francesco'),
(72, 'Bezecchi', 'Marco'),
(73, 'Marquez', 'Alex'),
(87, 'Gardner', 'Remy'),
(88, 'Oliveira', 'Miguel'),
(89, 'Martin', 'Jorge'),
(93, 'Marquez', 'Marc');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_scores`
--

DROP TABLE IF EXISTS `MGP_scores`;
CREATE TABLE `MGP_scores` (
  `UID` tinyint NOT NULL,
  `EID` tinyint NOT NULL,
  `Score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_tips`
--

DROP TABLE IF EXISTS `MGP_tips`;
CREATE TABLE `MGP_tips` (
  `TID` smallint DEFAULT NULL,
  `EID` tinyint NOT NULL,
  `UID` tinyint NOT NULL,
  `P1` tinyint DEFAULT NULL,
  `P2` tinyint DEFAULT NULL,
  `P3` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_totals`
--

DROP TABLE IF EXISTS `MGP_totals`;
CREATE TABLE `MGP_totals` (
  `UID` tinyint NOT NULL,
  `Score` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_users`
--

DROP TABLE IF EXISTS `MGP_users`;
CREATE TABLE `MGP_users` (
  `UID` tinyint NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Vorname` varchar(64) NOT NULL,
  `Nickname` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Passwort` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `MGP_comments`
--
ALTER TABLE `MGP_comments`
  ADD PRIMARY KEY (`CID`);

--
-- Indizes für die Tabelle `MGP_events`
--
ALTER TABLE `MGP_events`
  ADD PRIMARY KEY (`EID`);

--
-- Indizes für die Tabelle `MGP_riders`
--
ALTER TABLE `MGP_riders`
  ADD PRIMARY KEY (`RID`);

--
-- Indizes für die Tabelle `MGP_users`
--
ALTER TABLE `MGP_users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `MGP_comments`
--
ALTER TABLE `MGP_comments`
  MODIFY `CID` int NOT NULL AUTO_INCREMENT COMMENT 'Comment ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `MGP_users`
--
ALTER TABLE `MGP_users`
  MODIFY `UID` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
