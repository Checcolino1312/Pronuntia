-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 30, 2023 alle 17:33
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `speakwell`
--
CREATE DATABASE IF NOT EXISTS `speakwell` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `speakwell`;

-- --------------------------------------------------------

--
-- Struttura della tabella `assegnazione`
--

CREATE TABLE `assegnazione` (
  `id` int(11) NOT NULL,
  `id_assistito` int(11) NOT NULL,
  `id_esercizio` int(11) NOT NULL,
  `eseguito` tinyint(1) DEFAULT 0,
  `valutazione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `assistito`
--

CREATE TABLE `assistito` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `eta` int(11) NOT NULL,
  `id_logopedista` int(11) UNSIGNED NOT NULL,
  `id_caregiver` int(11) UNSIGNED NOT NULL,
  `diagnosi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `caregiver`
--

CREATE TABLE `caregiver` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cellulare` varchar(255) NOT NULL,
  `id_logopedista` int(11) UNSIGNED NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizio`
--

CREATE TABLE `esercizio` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `immagine` varchar(255) DEFAULT NULL,
  `immagine_filepath` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `audio_filepath` varchar(255) DEFAULT NULL,
  `id_logopedista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `logopedista`
--

CREATE TABLE `logopedista` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cellulare` varchar(255) NOT NULL,
  `indirizzo_studio` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `assegnazione`
--
ALTER TABLE `assegnazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bambino` (`id_assistito`,`id_esercizio`),
  ADD KEY `id_assistito` (`id_assistito`),
  ADD KEY `id_esercizio` (`id_esercizio`);

--
-- Indici per le tabelle `assistito`
--
ALTER TABLE `assistito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assistito_logopedista` (`id_logopedista`),
  ADD KEY `fk_assistito_caregiver` (`id_caregiver`);

--
-- Indici per le tabelle `caregiver`
--
ALTER TABLE `caregiver`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_logopedista` (`id_logopedista`);

--
-- Indici per le tabelle `esercizio`
--
ALTER TABLE `esercizio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_logopedista` (`id_logopedista`) USING BTREE;

--
-- Indici per le tabelle `logopedista`
--
ALTER TABLE `logopedista`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `assegnazione`
--
ALTER TABLE `assegnazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `assistito`
--
ALTER TABLE `assistito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `caregiver`
--
ALTER TABLE `caregiver`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `esercizio`
--
ALTER TABLE `esercizio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `logopedista`
--
ALTER TABLE `logopedista`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `assistito`
--
ALTER TABLE `assistito`
  ADD CONSTRAINT `assistito_ibfk_1` FOREIGN KEY (`id_caregiver`) REFERENCES `caregiver` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assistito_ibfk_2` FOREIGN KEY (`id_logopedista`) REFERENCES `logopedista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `caregiver`
--
ALTER TABLE `caregiver`
  ADD CONSTRAINT `fk_id_logopedista` FOREIGN KEY (`id_logopedista`) REFERENCES `logopedista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
