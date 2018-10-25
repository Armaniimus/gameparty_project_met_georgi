-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 13 okt 2018 om 16:49
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
-- Database: `gameplayparty`
--
-- DROP Database IF EXISTS GameplayParties;
-- DROP Database IF EXISTS GameplayParty;
CREATE Database IF NOT EXISTS gameplayparty;
USE gameplayparty;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bioscopen`
--

CREATE TABLE IF NOT EXISTS `bioscopen` (
  `bioscoopID` int(11) NOT NULL AUTO_INCREMENT,
  `bioscoop_naam` varchar(100) DEFAULT NULL,
  `straatnaam` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `plaats` varchar(100) DEFAULT NULL,
  `provincie` varchar(100) DEFAULT NULL,
  `informatie` tinytext,
  `openingstijden` varchar(100) DEFAULT NULL,
  `bereikbaarheid_auto` tinytext,
  `bereikbaarheid_ov` tinytext,
  `bereikbaarheid_fiets` tinytext,
  `rolstoeltoegankelijkheid` tinytext,
  PRIMARY KEY (`bioscoopID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `bioscopen`
--

INSERT INTO `bioscopen` (`bioscoop_naam`, `straatnaam`, `postcode`, `plaats`, `provincie`, `informatie`, `openingstijden`, `bereikbaarheid_auto`, `bereikbaarheid_ov`, `bereikbaarheid_fiets`, `rolstoeltoegankelijkheid`) VALUES
('Cineast', 'Bolwerkstraat 4', '7511 GP ', 'Enschede', 'Overrijssel', '', NULL, NULL, NULL, NULL, NULL),
('Cinerama', 'Westblaak 18', '3012 KL ', 'Rotterdam', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Huizen', 'Plein 2000 nr. 5', '1271 KK', 'Huizen', 'Noord-holland', 'Voor de schoolvakantie\'s en feestdagen gelden aangepaste openingstijden. De kassa van Wolff Huizen is een half uur voor aanvang van de eerste film open.', NULL, NULL, NULL, NULL, NULL),
('Kinepolis Almere', 'Forum 16', '1315 TH ', 'Almere', 'Flevoland', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `contentID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_naam` VARCHAR(80) NOT NULL UNIQUE,
  `tab_titel` VARCHAR(60) NOT NULL,
  `pagina_titel` VARCHAR(60) NOT NULL,
  `content` VARCHAR(400) NULL,
  `pagina_beschrijving` VARCHAR(400) NOT NULL,
  `steekwoorden` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`contentID`)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `diensten`
--

CREATE TABLE IF NOT EXISTS `diensten` (
  `dienstID` int(11) NOT NULL,
  `dienstnaam` varchar(100) DEFAULT NULL,
  `tarieven_tariefID` int(11) NOT NULL,
  `toeslagen_toeslagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--
CREATE TABLE IF NOT EXISTS `gebruikers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `gebruikersNaam` VARCHAR(24) NOT NULL UNIQUE,
  `passwordHash` VARCHAR(255) NOT NULL,
  `gebruikers_rollen_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);
--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`gebruikersNaam`, `passwordHash`, `gebruikers_rollen_id`) VALUES
('redacteur', '$2y$10$wmUWkfsHWeDTxKELfflTcerz7GQwP1CKFUClVe688Wh63QJZM0B5S', 1),
('bioscoop', '$2y$10$oGURIQ5MD1KaHO46HVkxLOCWGAYn6fS/ITyoxVL4kcBw/ZNy/KFiO', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers_rollen`
--

CREATE TABLE `gebruikers_rollen` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rolType` varchar(45) NOT NULL UNIQUE,
  `perm_bios_toevoegen` tinyint(4) DEFAULT NULL,
  `perm_bios_wijzigen` tinyint(4) DEFAULT NULL,
  `perm_bios_verwijderen` tinyint(4) DEFAULT NULL,
  `perm_content_toevoegen` tinyint(4) DEFAULT NULL,
  `perm_content_wijzigen` tinyint(4) DEFAULT NULL,
  `perm_content_verwijderen` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers_rollen`
--

INSERT INTO `gebruikers_rollen` (`rolType`, `perm_bios_toevoegen`, `perm_bios_wijzigen`, `perm_bios_verwijderen`, `perm_content_toevoegen`, `perm_content_wijzigen`, `perm_content_verwijderen`) VALUES
('redacteur', 1, 0, 0, 1, 1, 1),
('bioscoop', 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantID` int(11) NOT NULL,
  `aanhef` varchar(10) DEFAULT NULL,
  `voornaam` varchar(100) DEFAULT NULL,
  `achternaam` varchar(100) DEFAULT NULL,
  `straatnaam` varchar(100) DEFAULT NULL,
  `huisnummer` int(11) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `plaats` varchar(100) DEFAULT NULL,
  `provincie` varchar(100) DEFAULT NULL,
  `telefoonnummer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveer_regels`
--

CREATE TABLE `reserveer_regels` (
  `reserveer_regelID` int(11) NOT NULL,
  `reserveringID` int(11) NOT NULL,
  `zaalID` int(11) NOT NULL,
  `dienstID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveer_tijden`
--

CREATE TABLE `reserveer_tijden` (
  `tijdID` int(11) NOT NULL,
  `bioscoopID` int(11) NOT NULL,
  `zaalID` int(11) NOT NULL,
  `datum` timestamp(6) NULL DEFAULT NULL,
  `reserveringsdatum` date DEFAULT NULL,
  `reserveringstijd` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringen`
--

CREATE TABLE `reserveringen` (
  `reserveringID` int(11) NOT NULL,
  `klanten_klantID` int(11) NOT NULL,
  `bioscopen_bioscoopID` int(11) NOT NULL,
  `tijdID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tarieven`
--

CREATE TABLE `tarieven` (
  `tariefID` int(11) NOT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `prijs` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toeslagen`
--

CREATE TABLE `toeslagen` (
  `toeslagID` int(11) NOT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `prijs` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `zalen`
--

CREATE TABLE `zalen` (
  `zaalID` int(11) NOT NULL,
  `zaal` varchar(45) DEFAULT NULL,
  `aantal_stoelen` int(11) DEFAULT NULL,
  `rolstoelplaaten` int(11) DEFAULT NULL,
  `schermgrootte` varchar(10) DEFAULT NULL,
  `facaliteiten` tinytext,
  `versies` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--


--
-- Indexen voor tabel `diensten`
--
ALTER TABLE `diensten`
  ADD PRIMARY KEY (`dienstID`),
  ADD KEY `fk_diensten_tarieven1_idx` (`tarieven_tariefID`),
  ADD KEY `fk_diensten_toeslagen1_idx` (`toeslagen_toeslagID`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantID`);

--
-- Indexen voor tabel `reserveer_regels`
--
ALTER TABLE `reserveer_regels`
  ADD PRIMARY KEY (`reserveer_regelID`),
  ADD KEY `fk_reserveer_regels_reserveringen1_idx` (`reserveringID`),
  ADD KEY `fk_reserveer_regels_zalen1_idx` (`zaalID`),
  ADD KEY `fk_reserveer_regels_diensten1_idx` (`dienstID`);

--
-- Indexen voor tabel `reserveer_tijden`
--
ALTER TABLE `reserveer_tijden`
  ADD PRIMARY KEY (`tijdID`),
  ADD KEY `fk_reserveer_tijden_bioscopen1_idx` (`bioscoopID`),
  ADD KEY `fk_reserveer_tijden_zalen1_idx` (`zaalID`);

--
-- Indexen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`reserveringID`),
  ADD KEY `fk_reserveringen_klanten1_idx` (`klanten_klantID`),
  ADD KEY `fk_reserveringen_bioscopen1_idx` (`bioscopen_bioscoopID`),
  ADD KEY `fk_reserveringen_reserveer_tijden1_idx` (`tijdID`);

--
-- Indexen voor tabel `tarieven`
--
ALTER TABLE `tarieven`
  ADD PRIMARY KEY (`tariefID`);

--
-- Indexen voor tabel `toeslagen`
--
ALTER TABLE `toeslagen`
  ADD PRIMARY KEY (`toeslagID`);

--
-- Indexen voor tabel `zalen`
--
ALTER TABLE `zalen`
  ADD PRIMARY KEY (`zaalID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `diensten`
--
ALTER TABLE `diensten`
  MODIFY `dienstID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reserveer_regels`
--
ALTER TABLE `reserveer_regels`
  MODIFY `reserveer_regelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reserveer_tijden`
--
ALTER TABLE `reserveer_tijden`
  MODIFY `tijdID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `reserveringID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tarieven`
--
ALTER TABLE `tarieven`
  MODIFY `tariefID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `toeslagen`
--
ALTER TABLE `toeslagen`
  MODIFY `toeslagID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `zalen`
--
ALTER TABLE `zalen`
  MODIFY `zaalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `diensten`
--
ALTER TABLE `diensten`
  ADD CONSTRAINT `fk_diensten_tarieven1` FOREIGN KEY (`tarieven_tariefID`) REFERENCES `tarieven` (`tariefID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diensten_toeslagen1` FOREIGN KEY (`toeslagen_toeslagID`) REFERENCES `toeslagen` (`toeslagID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `reserveer_regels`
--
ALTER TABLE `reserveer_regels`
  ADD CONSTRAINT `fk_reserveer_regels_diensten1` FOREIGN KEY (`dienstID`) REFERENCES `diensten` (`dienstID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserveer_regels_reserveringen1` FOREIGN KEY (`reserveringID`) REFERENCES `reserveringen` (`reserveringID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserveer_regels_zalen1` FOREIGN KEY (`zaalID`) REFERENCES `zalen` (`zaalID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `reserveer_tijden`
--
ALTER TABLE `reserveer_tijden`
  ADD CONSTRAINT `fk_reserveer_tijden_bioscopen1` FOREIGN KEY (`bioscoopID`) REFERENCES `bioscopen` (`bioscoopID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserveer_tijden_zalen1` FOREIGN KEY (`zaalID`) REFERENCES `zalen` (`zaalID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD CONSTRAINT `fk_reserveringen_bioscopen1` FOREIGN KEY (`bioscopen_bioscoopID`) REFERENCES `bioscopen` (`bioscoopID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserveringen_klanten1` FOREIGN KEY (`klanten_klantID`) REFERENCES `klanten` (`klantID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserveringen_reserveer_tijden1` FOREIGN KEY (`tijdID`) REFERENCES `reserveer_tijden` (`tijdID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
