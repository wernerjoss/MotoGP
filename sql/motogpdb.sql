-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Erstellungszeit: 01. Jan 2025 um 09:24
-- Server-Version: 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
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
-- Tabellenstruktur für Tabelle `MGP_champ`
--

DROP TABLE IF EXISTS `MGP_champ`;
CREATE TABLE `MGP_champ` (
  `Deadline` datetime NOT NULL,
  `P1` tinyint(4) NOT NULL,
  `P2` tinyint(4) NOT NULL,
  `P3` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `MGP_champ`
--

INSERT INTO `MGP_champ` (`Deadline`, `P1`, `P2`, `P3`) VALUES
('2025-02-23 16:30:00', 63, 12, 93);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_comments`
--

DROP TABLE IF EXISTS `MGP_comments`;
CREATE TABLE `MGP_comments` (
  `CID` int(11) NOT NULL COMMENT 'Comment ID',
  `EID` tinyint(4) NOT NULL COMMENT 'Event ID',
  `UID` tinyint(4) NOT NULL COMMENT 'User ID',
  `Date` datetime DEFAULT NULL,
  `Comment` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_events`
--

DROP TABLE IF EXISTS `MGP_events`;
CREATE TABLE `MGP_events` (
  `EID` tinyint(4) NOT NULL,
  `Ort` varchar(64) NOT NULL,
  `Deadline` datetime NOT NULL,
  `P1` tinyint(4) DEFAULT NULL,
  `P2` tinyint(4) DEFAULT NULL,
  `P3` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `MGP_events`
--

INSERT INTO `MGP_events` (`EID`, `Ort`, `Deadline`, `P1`, `P2`, `P3`) VALUES
(1, 'Mandalika Sprint', '2025-03-01 16:30:00', NULL, NULL, NULL),
(2, 'Mandalika', '2025-03-02 17:00:00', NULL, NULL, NULL),
(3, 'Termas Sprint', '2025-03-15 15:00:00', NULL, NULL, NULL),
(4, 'Termas', '2025-03-16 14:00:00', NULL, NULL, NULL),
(5, 'Austin Sprint', '2025-04-29 21:00:00', NULL, NULL, NULL),
(6, 'Austin', '2025-03-30 20:00:00', NULL, NULL, NULL),
(7, 'Doha Sprint', '2025-04-12 14:00:00', NULL, NULL, NULL),
(8, 'Doha', '2025-04-13 14:00:00', NULL, NULL, NULL),
(9, 'Jerez Sprint', '2025-04-26 14:00:00', NULL, NULL, NULL),
(10, 'Jerez', '2025-04-27 13:00:00', NULL, NULL, NULL),
(11, 'LeMans Sprint', '2025-05-10 14:00:00', NULL, NULL, NULL),
(12, 'LeMans', '2025-05-11 14:00:00', NULL, NULL, NULL),
(13, 'Silverstone Sprint', '2025-05-24 14:00:00', NULL, NULL, NULL),
(14, 'Silverstone', '2025-05-25 13:00:00', NULL, NULL, NULL),
(15, 'Aragon Sprint', '2025-06-07 15:00:00', NULL, NULL, NULL),
(16, 'Aragon', '2025-06-08 13:00:00', NULL, NULL, NULL),
(17, 'Mugello Sprint', '2025-06-21 14:00:00', NULL, NULL, NULL),
(18, 'Mugello', '2025-06-22 13:00:00', NULL, NULL, NULL),
(19, 'Assen Sprint', '2025-06-28 14:00:00', NULL, NULL, NULL),
(20, 'Assen', '2025-06-29 13:00:00', NULL, NULL, NULL),
(21, 'Sachsenring Sprint', '2025-07-13 15:00:00', NULL, NULL, NULL),
(22, 'Sachsenring', '2025-07-14 13:00:00', NULL, NULL, NULL),
(23, 'Bruenn Sprint', '2025-07-19 14:00:00', NULL, NULL, NULL),
(24, 'Bruenn', '2025-07-20 13:00:00', NULL, NULL, NULL),
(25, 'A1-Ring Sprint', '2025-08-16 14:00:00', NULL, NULL, NULL),
(26, 'A1-Ring', '2025-08-17 13:00:00', NULL, NULL, NULL),
(27, 'Ungarn Sprint', '2025-08-23 13:00:00', NULL, NULL, NULL),
(28, 'Ungarn', '2025-08-24 13:00:00', NULL, NULL, NULL),
(29, 'Catalunya Sprint', '2025-09-06 11:00:00', NULL, NULL, NULL),
(30, 'Catalunya', '2025-09-07 11:00:00', NULL, NULL, NULL),
(31, 'San Marino Sprint', '2025-09-13 08:00:00', NULL, NULL, NULL),
(32, 'San Marino', '2025-09-14 08:00:00', NULL, NULL, NULL),
(33, 'Motegi Sprint', '2025-09-27 07:30:00', NULL, NULL, NULL),
(34, 'Motegi', '2025-09-28 07:30:00', NULL, NULL, NULL),
(35, 'Indonesien Sprint', '2025-10-04 05:10:00', NULL, NULL, NULL),
(36, 'Indonesien', '2025-10-05 03:00:00', NULL, NULL, NULL),
(37, 'PI Sprint', '2025-10-18 09:00:00', NULL, NULL, NULL),
(38, 'PI', '2025-10-19 08:00:00', NULL, NULL, NULL),
(39, 'Sepang Sprint', '2025-10-25 07:30:00', NULL, NULL, NULL),
(40, 'Sepang', '2025-10-26 07:30:00', NULL, NULL, NULL),
(41, 'Portimao Sprint', '2025-11-08 07:30:00', NULL, NULL, NULL),
(42, 'Portimao', '2025-11-09 07:30:00', NULL, NULL, NULL),
(43, 'Valencia Sprint', '2025-11-15 14:00:00', NULL, NULL, NULL),
(44, 'Valencia', '2025-11-16 14:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_riders`
--

DROP TABLE IF EXISTS `MGP_riders`;
CREATE TABLE `MGP_riders` (
  `RID` tinyint(4) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Vorname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `MGP_riders`
--

INSERT INTO `MGP_riders` (`RID`, `Name`, `Vorname`) VALUES
(5, 'Zarco', 'Johann'),
(10, 'Marini', 'Luca'),
(12, 'Vinales', 'Maverick'),
(20, 'Quartararo', 'Fabio'),
(21, 'Morbidelli', 'Franco'),
(23, 'Bastianini', 'Enea'),
(25, 'Fernandez', 'Raul'),
(30, 'Nakagami', 'Takaaki'),
(31, 'Acosta', 'Pedro'),
(33, 'Binder', 'Brad'),
(35, 'Chantra', 'Somkiat'),
(36, 'Mir', 'Joan'),
(37, 'Fernandez', 'Augusto'),
(41, 'Espargaro', 'Aleix'),
(42, 'Rins', 'Alex'),
(43, 'Miller', 'Jack'),
(44, 'Espargaro', 'Pol'),
(49, 'diGianantonio', 'Fabio'),
(54, 'Aldeguer', 'Fermin'),
(63, 'Bagnaia', 'Francesco'),
(72, 'Bezecchi', 'Marco'),
(73, 'Marquez', 'Alex'),
(79, 'Ogura', 'Ai'),
(88, 'Oliveira', 'Miguel'),
(89, 'Martin', 'Jorge'),
(93, 'Marquez', 'Marc');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_scores`
--

DROP TABLE IF EXISTS `MGP_scores`;
CREATE TABLE `MGP_scores` (
  `UID` tinyint(4) NOT NULL,
  `EID` tinyint(4) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_tips`
--

DROP TABLE IF EXISTS `MGP_tips`;
CREATE TABLE `MGP_tips` (
  `TID` smallint(6) NOT NULL,
  `EID` tinyint(4) NOT NULL,
  `UID` tinyint(4) NOT NULL,
  `P1` tinyint(4) DEFAULT NULL,
  `P2` tinyint(4) DEFAULT NULL,
  `P3` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_totals`
--

DROP TABLE IF EXISTS `MGP_totals`;
CREATE TABLE `MGP_totals` (
  `UID` tinyint(4) NOT NULL,
  `Score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_users`
--

DROP TABLE IF EXISTS `MGP_users`;
CREATE TABLE `MGP_users` (
  `UID` tinyint(4) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Vorname` varchar(64) NOT NULL,
  `Nickname` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Passwort` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `MGP_users`
--

INSERT INTO `MGP_users` (`UID`, `Name`, `Vorname`, `Nickname`, `Email`, `Passwort`) VALUES
(1, 'Admin', 'Cheffe', 'Admin01', 'admin@example.com', '1234');
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MGP_wmtips`
--

DROP TABLE IF EXISTS `MGP_wmtips`;
CREATE TABLE `MGP_wmtips` (
  `UID` tinyint(4) NOT NULL,
  `P1` tinyint(4) DEFAULT NULL,
  `P2` tinyint(4) DEFAULT NULL,
  `P3` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `MGP_champ`
--
ALTER TABLE `MGP_champ`
  ADD PRIMARY KEY (`Deadline`);

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
-- Indizes für die Tabelle `MGP_tips`
--
ALTER TABLE `MGP_tips`
  ADD PRIMARY KEY (`TID`);

--
-- Indizes für die Tabelle `MGP_users`
--
ALTER TABLE `MGP_users`
  ADD PRIMARY KEY (`UID`);

--
-- Indizes für die Tabelle `MGP_wmtips`
--
ALTER TABLE `MGP_wmtips`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `MGP_comments`
--
ALTER TABLE `MGP_comments`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Comment ID';

--
-- AUTO_INCREMENT für Tabelle `MGP_users`
--
ALTER TABLE `MGP_users`
  MODIFY `UID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
