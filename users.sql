-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Jan 2018 um 23:27
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
  `user_pwd` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user_titel`, `user_position`, `user_first`, `user_last`, `user_firm`, `user_email`, `user_telefon`, `user_uid`, `user_pic`, `user_pwd`) VALUES
(0, 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin@web.de', 12345, 'Admin', '1517177842.png', '$2y$10$gRFbd.8rntOpfmTiLDkv3erp3UDYwL9KOTX9bhmNU1Y5/uxlxgFJW');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
