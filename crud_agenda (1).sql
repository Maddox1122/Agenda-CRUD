-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 16 feb 2024 om 11:54
-- Serverversie: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- PHP-versie: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_89667`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `crud_agenda`
--

CREATE TABLE `crud_agenda` (
  `ID` int(11) NOT NULL,
  `onderwerp` varchar(30) NOT NULL,
  `inhoud` text NOT NULL,
  `begindatum` date NOT NULL,
  `einddatum` date NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `status` enum('n','b','a') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `crud_agenda`
--

INSERT INTO `crud_agenda` (`ID`, `onderwerp`, `inhoud`, `begindatum`, `einddatum`, `priority`, `status`) VALUES
(4, 'Engels HW', 'Opdracht 1-31', '2023-11-29', '2023-12-14', 2, 'b'),
(8, 'test', 'test', '2023-12-06', '2023-12-23', 4, 'n');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `crud_agenda`
--
ALTER TABLE `crud_agenda`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `crud_agenda`
--
ALTER TABLE `crud_agenda`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
