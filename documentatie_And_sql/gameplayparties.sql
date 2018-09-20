-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 sep 2018 om 13:55
-- Serverversie: 10.1.30-MariaDB
-- PHP-versie: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameplayparties`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bioscopen`
--

CREATE TABLE `bioscopen` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bioscopen`
--

INSERT INTO `bioscopen` (`id`, `name`, `phone`, `email`, `location`) VALUES
(1, 'Pathe', 683370613, '@pathe.com', 'pathelaan3'),
(2, 'cinemec', 683357109, '@awsome.nl', 'somewhere'),
(3, 'bios3', 38329729, '@groots.com', 'somewhere'),
(4, 'bios589903', 38329729, '@grootser.com', 'somewheres');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Username` varchar(24) NOT NULL,
  `UserHash` varchar(255) NOT NULL,
  `UserRolls_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers_rollen`
--

CREATE TABLE `gebruikers_rollen` (
  `id` int(10) UNSIGNED NOT NULL,
  `rolType` varchar(45) NOT NULL,
  `perm_bios_toevoegen` tinyint(4) DEFAULT NULL,
  `perm_bios_wijzigen` tinyint(4) DEFAULT NULL,
  `perm_bios_verwijderen` tinyint(4) DEFAULT NULL,
  `perm_content_toevoegen` tinyint(4) DEFAULT NULL,
  `perm_content_wijzigen` tinyint(4) DEFAULT NULL,
  `perm_content_verwijderen` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bioscopen`
--
ALTER TABLE `bioscopen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `gebruikers_rollen`
--
ALTER TABLE `gebruikers_rollen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bioscopen`
--
ALTER TABLE `bioscopen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gebruikers_rollen`
--
ALTER TABLE `gebruikers_rollen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
