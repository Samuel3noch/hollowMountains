-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 sep 2025 om 01:46
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hollowdata`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `attractie`
--

CREATE TABLE `attractie` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `locatie` varchar(100) NOT NULL,
  `type` enum('achtbaan','carrousel','waterattractie','overig') NOT NULL DEFAULT 'overig',
  `technische_specs` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `onderhoudschema`
--

CREATE TABLE `onderhoudschema` (
  `id` int(11) NOT NULL,
  `attractie_id` int(11) NOT NULL,
  `taak_omschrijving` varchar(255) NOT NULL,
  `frequentie_dagen` int(11) NOT NULL DEFAULT 7
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `onderhoudstaak`
--

CREATE TABLE `onderhoudstaak` (
  `id` int(11) NOT NULL,
  `attractie_id` int(11) NOT NULL,
  `monteur_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `status` enum('In Behandeling','Voltooid') NOT NULL DEFAULT 'In Behandeling',
  `opmerkingen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personeel`
--

CREATE TABLE `personeel` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rol` enum('beheerder','monteur','manager') NOT NULL DEFAULT 'monteur',
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `adres` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `attractie`
--
ALTER TABLE `attractie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `onderhoudschema`
--
ALTER TABLE `onderhoudschema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attractie_id` (`attractie_id`);

--
-- Indexen voor tabel `onderhoudstaak`
--
ALTER TABLE `onderhoudstaak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attractie_id` (`attractie_id`),
  ADD KEY `monteur_id` (`monteur_id`);

--
-- Indexen voor tabel `personeel`
--
ALTER TABLE `personeel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `attractie`
--
ALTER TABLE `attractie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `onderhoudschema`
--
ALTER TABLE `onderhoudschema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `onderhoudstaak`
--
ALTER TABLE `onderhoudstaak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `personeel`
--
ALTER TABLE `personeel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `onderhoudschema`
--
ALTER TABLE `onderhoudschema`
  ADD CONSTRAINT `onderhoudschema_ibfk_1` FOREIGN KEY (`attractie_id`) REFERENCES `attractie` (`id`);

--
-- Beperkingen voor tabel `onderhoudstaak`
--
ALTER TABLE `onderhoudstaak`
  ADD CONSTRAINT `onderhoudstaak_ibfk_1` FOREIGN KEY (`attractie_id`) REFERENCES `attractie` (`id`),
  ADD CONSTRAINT `onderhoudstaak_ibfk_2` FOREIGN KEY (`monteur_id`) REFERENCES `personeel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
