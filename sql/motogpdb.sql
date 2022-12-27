-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Erstellungszeit: 24. Apr 2022 um 18:28
-- Server-Version: 8.0.28
-- PHP-Version: 7.4.28

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
(1, 'Portimao Sprint', '2023-03-25 12:30:00', NULL, NULL, NULL),
(2, 'Portimao', '2023-03-26 12:30:00', NULL, NULL, NULL),
(3, 'Termas Sprint', '2023-04-01 19:30:00', NULL, NULL, NULL),
(4, 'Termas', '2023-04-02 19:30:00', NULL, NULL, NULL),
(5, 'Austin Sprint', '2023-04-15 19:30:00', NULL, NULL, NULL),
(6, 'Austin', '2023-04-16 19:30:00', NULL, NULL, NULL),
(7, 'Jerez Sprint', '2023-04-29 13:00:00', NULL, NULL, NULL),
(8, 'Jerez', '2023-04-30 13:00:00', NULL, NULL, NULL),
(9, 'LeMans Sprint', '2023-05-13 13:00:00', NULL, NULL, NULL),
(10, 'LeMans', '2023-05-14 13:00:00', NULL, NULL, NULL),
(11, 'Mugello Sprint', '2023-06-10 13:00:00', NULL, NULL, NULL),
(12, 'Mugello', '2023-06-11 13:00:00', NULL, NULL, NULL),
(13, 'Sachsenring Sprint', '2023-06-17 13:00:00', NULL, NULL, NULL),
(14, 'Sachsenring', '2023-06-18 13:00:00', NULL, NULL, NULL),
(15, 'Assen Sprint', '2023-06-24 13:00:00', NULL, NULL, NULL),
(16, 'Assen', '2023-06-25 13:00:00', NULL, NULL, NULL),
(17, 'Sokol Sprint', '2023-07-08 13:00:00', NULL, NULL, NULL),
(18, 'Sokol', '2023-07-09 13:00:00', NULL, NULL, NULL),
(19, 'Silverstone Sprint', '2023-08-05 13:00:00', NULL, NULL, NULL),
(20, 'Silverstone', '2023-08-06 13:00:00', NULL, NULL, NULL),
(21, 'RedBullRing Sprint', '2023-08-19 13:00:00', NULL, NULL, NULL),
(22, 'RedBullRing', '2023-08-20 13:00:00', NULL, NULL, NULL),
(23, 'Catalunya Sprint', '2023-09-02 13:00:00', NULL, NULL, NULL),
(24, 'Catalunya', '2023-09-03 13:00:00', NULL, NULL, NULL),
(25, 'San Marino Sprint', '2023-09-09 13:00:00', NULL, NULL, NULL),
(26, 'San Marino', '2023-09-10 13:00:00', NULL, NULL, NULL),
(27, 'Buddh Sprint', '2023-09-23 13:00:00', NULL, NULL, NULL),
(28, 'Buddh', '2023-09-24 13:00:00', NULL, NULL, NULL),
(29, 'Motegi Sprint', '2023-09-30 13:00:00', NULL, NULL, NULL),
(30, 'Motegi', '2023-10-01 13:00:00', NULL, NULL, NULL),
(31, 'Mandalika Sprint', '2023-10-14 13:00:00', NULL, NULL, NULL),
(32, 'Mandalika', '2023-10-15 13:00:00', NULL, NULL, NULL),
(33, 'PI Sprint', '2023-10-21 13:00:00', NULL, NULL, NULL),
(34, 'PI', '2023-10-22 13:00:00', NULL, NULL, NULL),
(35, 'Buriram Sprint', '2023-10-28 13:00:00', NULL, NULL, NULL),
(36, 'Buriram', '2023-10-29 13:00:00', NULL, NULL, NULL),
(37, 'Sepang Sprint', '2023-11-11 13:00:00', NULL, NULL, NULL),
(38, 'Sepang', '2023-11-12 13:00:00', NULL, NULL, NULL),
(39, 'Doha Sprint', '2023-11-18 13:00:00', NULL, NULL, NULL),
(40, 'Doha', '2023-11-19 13:00:00', NULL, NULL, NULL),
(41, 'Valencia Sprint', '2023-11-25 13:00:00', NULL, NULL, NULL),
(42, 'Valencia', '2023-11-26 13:00:00', NULL, NULL, NULL);

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
(41, 'Espargaro', 'Aleix'),
(42, 'Rins', 'Alex'),
(43, 'Miller', 'Jack'),
(44, 'Espargaro', 'Pol'),
(49, 'diGianantonio', 'Fabio'),
(57, 'Fernandez', 'Augusto'),
(63, 'Bagnaia', 'Francesco'),
(72, 'Bezecchi', 'Marco'),
(73, 'Marquez', 'Alex'),
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

--
-- Tabellenstruktur für Tabelle `MGP_totals`
--

DROP TABLE IF EXISTS `MGP_totals`;
CREATE TABLE `MGP_totals` (
  `UID` tinyint NOT NULL,
  `Score` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


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
-- Daten für Tabelle `MGP_users`
--

INSERT INTO `MGP_users` (`UID`, `Name`, `Vorname`, `Nickname`, `Email`, `Passwort`) VALUES
(1, 'Admin', 'Cheffe', 'Admin01', 'admin@example.com', '1234');

--
-- Indizes der exportierten Tabellen
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
