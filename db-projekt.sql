-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Jan 2018 um 00:09
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db-projekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_angebote`
--

CREATE TABLE `tbl_angebote` (
  `angebot_id` int(11) NOT NULL,
  `angebot_user_id` int(11) NOT NULL,
  `angebot_titel` varchar(256) NOT NULL,
  `angebot_beschreibung` varchar(256) NOT NULL,
  `angebot_position` varchar(256) NOT NULL,
  `angebot_fachbereich` varchar(256) NOT NULL,
  `angebot_beginn` date NOT NULL,
  `angebot_url` varchar(256) NOT NULL,
  `angebot_pdf` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tbl_angebote`
--

INSERT INTO `tbl_angebote` (`angebot_id`, `angebot_user_id`, `angebot_titel`, `angebot_beschreibung`, `angebot_position`, `angebot_fachbereich`, `angebot_beginn`, `angebot_url`, `angebot_pdf`) VALUES
(11, 0, 'Einzelhandelskaufmann', 'Unterstütze unser Team in einer der größten Filialen Deutschlands!', 'Angestellter', 'Einzelhandel', '2018-02-04', 'http://rewe.de', '1517267222.pdf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_titel` varchar(256) NOT NULL,
  `user_position` varchar(256) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_firm` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_telefon` int(50) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pic` varchar(256) DEFAULT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_rang` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user_titel`, `user_position`, `user_first`, `user_last`, `user_firm`, `user_email`, `user_telefon`, `user_uid`, `user_pic`, `user_pwd`, `user_rang`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin@web.de', 12345, 'Admin', '1517223777.png', '$2y$10$gRFbd.8rntOpfmTiLDkv3erp3UDYwL9KOTX9bhmNU1Y5/uxlxgFJW', ''),
(2, 'Herr', 'Angestellter', 'Viktor', 'Lau', 'Compuserv', 'info@lauviktor.de', 2147483647, 'Vito875', '0', '$2y$10$8JFETbcJWRZHSAfs5YnZrOC92tBU95IGKiltOWoqPit.8w.oTesB.', 'User');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_angebote`
--
ALTER TABLE `tbl_angebote`
  ADD PRIMARY KEY (`angebot_id`) USING BTREE;

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_angebote`
--
ALTER TABLE `tbl_angebote`
  MODIFY `angebot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
