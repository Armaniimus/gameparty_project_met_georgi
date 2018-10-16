-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 01 okt 2018 om 00:45
-- Serverversie: 5.7.17
-- PHP-versie: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Gameplayparties`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bioscoop`
--

CREATE TABLE `bioscoop` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `adres` varchar(100) DEFAULT NULL,
  `postode` varchar(100) DEFAULT NULL,
  `stad` varchar(100) DEFAULT NULL,
  `telefoonnummer` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bioscoop`
--

INSERT INTO `bioscoop` (`id`, `naam`, `adres`, `postode`, `stad`, `telefoonnummer`, `email`) VALUES
(1, 'pathe de kuip', 'de kuipstraat 16', '2876RO', 'Rotterdam', '0108672818', 'pathe@pathe.nl'),
(2, 'pathe schouwburg', 'schouwburgplein 20', '2786SH', 'Rottedam', '010729226', 'pathe@pathe.nl'),
(3, 'cinema gouda', 'goudestraat 16', '2871GA', 'Gouda', '07102827', 'cinema@gouda.nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bioscoop_afbeeldingen`
--

CREATE TABLE `bioscoop_afbeeldingen` (
  `id` int(11) NOT NULL,
  `bioscoop_id` int(11) NOT NULL,
  `afbeelding` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `catalogus`
--

CREATE TABLE `catalogus` (
  `id` int(11) NOT NULL,
  `bioscopen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `catalogus`
--

INSERT INTO `catalogus` (`id`, `bioscopen_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `faciliteiten`
--

CREATE TABLE `faciliteiten` (
  `id` int(11) NOT NULL,
  `bioscoop_id` int(11) NOT NULL,
  `Parkeergelegenheid` tinyint(1) DEFAULT NULL,
  `meerdere_zalen` tinyint(1) DEFAULT NULL,
  `invalide_mogelijkheid` tinyint(1) DEFAULT NULL,
  `winkel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(10) UNSIGNED NOT NULL,
  `gebruikersNaam` varchar(24) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `gebruikers_rollen_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersNaam`, `passwordHash`, `gebruikers_rollen_id`) VALUES
(1, 'redacteur', '$2y$10$wmUWkfsHWeDTxKELfflTcerz7GQwP1CKFUClVe688Wh63QJZM0B5S', 1);

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
-- Gegevens worden geëxporteerd voor tabel `gebruikers_rollen`
--

INSERT INTO `gebruikers_rollen` (`id`, `rolType`, `perm_bios_toevoegen`, `perm_bios_wijzigen`, `perm_bios_verwijderen`, `perm_content_toevoegen`, `perm_content_wijzigen`, `perm_content_verwijderen`) VALUES
(1, 'redacteur', 1, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveer_tijden`
--

CREATE TABLE `reserveer_tijden` (
  `id` int(11) NOT NULL,
  `bioscopen_id` int(11) NOT NULL,
  `tijd` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bioscoop`
--
ALTER TABLE `bioscoop`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bioscoop_afbeeldingen`
--
ALTER TABLE `bioscoop_afbeeldingen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bioscoop_informatiecol_UNIQUE` (`afbeelding`),
  ADD KEY `fk_bioscoop_informatie_bioscoop1_idx` (`bioscoop_id`);

--
-- Indexen voor tabel `catalogus`
--
ALTER TABLE `catalogus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_catalogus_bioscopen1_idx` (`bioscopen_id`);

--
-- Indexen voor tabel `faciliteiten`
--
ALTER TABLE `faciliteiten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faciliteiten_bioscopen1_idx` (`bioscoop_id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers_rollen`
--
ALTER TABLE `gebruikers_rollen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reserveer_tijden`
--
ALTER TABLE `reserveer_tijden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reserveer_tijden_bioscopen1_idx` (`bioscopen_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bioscoop`
--
ALTER TABLE `bioscoop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `catalogus`
--
ALTER TABLE `catalogus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `faciliteiten`
--
ALTER TABLE `faciliteiten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `gebruikers_rollen`
--
ALTER TABLE `gebruikers_rollen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bioscoop_afbeeldingen`
--
ALTER TABLE `bioscoop_afbeeldingen`
  ADD CONSTRAINT `fk_bioscoop_informatie_bioscoop1` FOREIGN KEY (`bioscoop_id`) REFERENCES `bioscoop` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `catalogus`
--
ALTER TABLE `catalogus`
  ADD CONSTRAINT `fk_catalogus_bioscopen1` FOREIGN KEY (`bioscopen_id`) REFERENCES `bioscoop` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `faciliteiten`
--
ALTER TABLE `faciliteiten`
  ADD CONSTRAINT `fk_faciliteiten_bioscopen1` FOREIGN KEY (`bioscoop_id`) REFERENCES `bioscoop` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `reserveer_tijden`
--
ALTER TABLE `reserveer_tijden`
  ADD CONSTRAINT `fk_reserveer_tijden_bioscopen1` FOREIGN KEY (`bioscopen_id`) REFERENCES `bioscoop` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
