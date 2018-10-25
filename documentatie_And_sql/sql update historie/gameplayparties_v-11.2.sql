

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
  `informatie` text,
  `openingstijden` varchar(100) DEFAULT NULL,
  `bereikbaarheid_auto` text,
  `bereikbaarheid_ov` text,
  `bereikbaarheid_fiets` text,
  `rolstoeltoegankelijkheid` text,
  PRIMARY KEY (`bioscoopID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `bioscopen` (`bioscoopID`, `bioscoop_naam`, `straatnaam`, `postcode`, `plaats`, `provincie`, `informatie`, `openingstijden`, `bereikbaarheid_auto`, `bereikbaarheid_ov`, `bereikbaarheid_fiets`, `rolstoeltoegankelijkheid`) VALUES
(1, 'Kinepolis Almere', 'Forum 16', '1315 TH ', 'Almere', 'Flevoland', 'Kinepolis Almere is sinds 2004 gevestigd in het levendige centrum van Almere. Het ontwerp van het imposante gebouw is van de bekroonde architect Rem Koolhaas. De megabioscoop telt 8 zalen met in totaal 2137 comfortabele stoelen. Bij binnenkomst is de trap die diagonaal door het gebouw loopt, de eerste blikvanger. Kinepolis Almere is sinds november 2017 verbouwd om meer aan te sluiten bij de look-and-feel van Kinepolis. Dit betekent dat alle zetels zijn vernieuwd,  dat er automatische ticket machines (ATM’s) op de trap zijn geplaatst en er een volledige nieuwe shop met een ruimer assortiment is gekomen.\r\n', NULL, 'Met de auto bereikt u Kinepolis Almere door richting \'Centrum\' te volgen. Rondom Kinepolis Almere is volop parkeergelegenheid. De P6 Hospitaalgarage of P7 Schippersgarage zijn het gunstigst gelegen t.o.v. de bioscoop. Parkeert u na 18:00 uur, dan geldt het maximale avondtarief van €5,25 voor de hele avond. \r\n', 'U kunt ons met de trein en bus zeer makkelijk bereiken. Vanaf station Almere Centrum loopt u in circa 5 minuten in zuidelijke richting richting naar Almere Citymall. Kinepolis Almere is tevens goed bereikbaar per bus via haltes Passage (buslijn M1 & M4) en Flevoziekenhuis (buslijn M5 en M7). Voor actuele bustijden kijkt u op 9292.nl.\r\n', 'Citymall Almere heeft diverse (bewaakte) fietsenstallingen, bijvoorbeeld aan de Hospitaaldreef.\r\n', 'Kinepolis Almere heeft in elke zaal mindervalide plaatsen. Tevens zijn er mindervalide toiletten en een lift aanwezig.\r\n'),
(2, 'Kinepolis Breda\r\n', 'Westblaak 18Bavelseparklaan 4\r\n', '4817 ZX\r\n\r\n', 'Breda', 'Brabant', 'Kinepolis Breda op het Breepark is dé plek waar een filmbezoek een ware beleving wordt. Alle 10 de zalen hebben luxe bioscoopstoelen met extra brede armleuningen en royale beenruimte. Voor nog meer comfort zijn er speciale Cosy Seats te boeken. Bovendien is Kinepolis Breda de eerste volledige laserprojectie-bioscoop van Europa, wat betekent dat de beeldkwaliteit in elke zaal superscherp is. Uniek voor Nederland is dat de grootste zaal is uitgerust met Kinepolis Laser ULTRA, een exclusieve combinatie van spectaculair laserbeeld en het ruimtelijke geluid van Dolby Atmos. Parkeren is GRATIS. \r\n', NULL, 'Met de auto kunt u de bioscoop makkelijk bereiken. LET OP: stel uw navigatiesysteem in op het adres \'Minervum, Breda\'. Zodra u vanuit Breda-centrum de A27 kruist of vanaf de snelweg afslag 15-Breda hebt genomen, zet u uw navigatie uit en volgt u de gele bordjes richting \'Breepark\'. Houd de borden richting \'Mc Donalds\' aan en neem op de rotonde de rechterbaan. De bioscoop bevindt zich aan uw rechterzijde. De parkeergarage zit onder de bioscoop. U kunt bij Kinepolis Breda GRATIS parkeren!\r\n', 'Kinepolis Breda is goed bereikbaar met het openbaar vervoer. De bussen stoppen direct naast de bioscoop (bushalte Breepark). Plan uw reis op www.9292.nl of bekijk hier de actuele vertrektijden vanaf halte Breepark. De laatste bus naar Station Breda vertrekt om 00:16 uur. Vanaf 9 december 2018 vertrekt de laatste bus zaterdagnacht om 00:46 uur. Reis met uw eigen OV-Chipkaart óf pin uw kaartje bij de buschauffeur. Let op: contant geld wordt niet geaccepteerd.\r\n', 'De gratis en overdekte parkeergarage heeft tevens een zeer grote fietsenstalling.\r\n', 'Kinepolis Breda heeft rolstoelplaatsen in elke zaal. Lift en mindervalidentoilet zijn ook aanwezig.\r\n'),
(3, 'Kinepolis CineMagnus Schagen\r\n\r\n', 'Grotewallerweg 2\r\n\r\n', '1742 NM', 'Schagen\r\n', 'Noord-holland', 'De naam is een samenvoeging van de woorden \'Cinema\' en \'Magnus\'. Schagen wordt ook wel \'Magnusveste\' genoemd. De geschiedenis om deze naam komt voort uit de heldendaden van ridder Magnus, vroegere inwoner van het stadje Schagen. De bioscoop bestaat uit 5 zalen, deze zijn gesitueerd om de grote foyer. Een sterk punt van de bioscoop is dat alles gelijkvloers te bereiken is, een groot voordeel voor minder validen en ouderen.  \r\n', NULL, 'Vanuit alle richtingen volgt u de ANWB borden richting Witte Paal, de bioscoop bevindt zich aan het begin van het bedrijventerrein. De ingang naar het parkeerterrein van de bioscoop zit aan de Grotewallerweg. Voor wie met de auto wil komen; CineMagnus beschikt over eigen (gratis) parkeerplaatsen. Mochten deze vol zijn, dan kunt u uw auto parkeren op de gratis parkeerplaatsen van onze overburen, de Gamma.\r\n', 'Het NS- station is op 3 minuten lopen van de bioscoop en de bus stopt voor de deur.\r\n', 'CineMagnus is goed bereikbaar per fiets. Volg hiervoor de borden ‘Witte Paal’. Voor de bioscoop zijn fietsenrekken aanwezig.\r\n', 'Onze bioscoop is rolstoelvriendelijk. U kunt vlak voor de deur parkeren op de invalide parkeerplaatsen. Er is een invalidentoilet aanwezig en zowel de foyer als de zalen zijn gelijkvloers. Daarbij beschikt elke zaal over speciale plaatsen voor rolstoelgebruikers. Mocht u deze zogeheten invalidenplaatsen willen reserveren of als u nog vragen heeft dan kan dat via telefoonnummer: 0224-224060.\r\n'),
(4, 'Kinepolis CineMeerse Hoofddorp\r\n', 'Raadhuisplein 12\r\n', '2132 TZ', 'Hoofddorp\r\n', 'Noord-holland\r\n', 'CineMeerse heeft 8 zalen met in totaal liefst 1115 luxe stoelen. Vier zalen zijn gesitueerd aan de voorzijde van het pand en de andere 4 zalen zijn achterin het pand gesitueerd. Beide gedeeltes beschikken over een eigen bar/lounge om voor de film en in de pauze jezelf te voorzien van een versnapering. CineMeerse vertoont naast alle topfilms ook Live opera, ballet en diverse live-concerten van de grootste artiesten. Ook worden er regelmatig LadiesNights, MannenAvonden en andere events georganiseerd. De zalen zijn ruim opgezet en beschikken allemaal over een wall-to-wall scherm, digitaal beeld en een 7.1 Dolby geluidssysteem. Naast alle techniek voor de films is het zitcomfort ook niet onbelangrijk en daarom hebben alle zalen extra ruime stoelen en veel beenruimte om zo optimaal van de film te kunnen genieten. Naast de normale stoelen beschikken alle zalen ook over een zo geheten twin seats rij.', NULL, 'Met de auto bereikt u CineMeerse door de borden richting \'Centrum\' te volgen. Rondom CineMeerse is volop parkeergelegenheid. U kunt uw auto bij Q-Park Polderplein in Hoofddorp parkeren en aan de kassa van CineMeerse een waardekaart kopen. Met deze waardekaart kunt u 3 uur parkeren voor maar € 1,50*!\r\n', '-', 'CineMeerse is goed bereikbaar per fiets. Voor de bioscoop zijn fietsenrekken aanwezig.\r\n', 'Onze bioscoop is rolstoelvriendelijk. Ons gebouw beschikt over meerdere liften waarmee u gemakkelijk de zalen en de foyers kunt bereiken. Op de twee etages waar de zalen zich bevinden zijn invalidentoiletten aanwezig. Zowel de foyers als de zalen zijn gelijkvloers en beschikken over speciale plaatsen voor rolstoelgebruikers. Mocht u deze zogeheten invalideplaatsen willen reserveren of als u nog vragen heeft dan kan dat via telefoonnummer: 023-3031030.\r\n'),
(5, 'Kinepolis Den Bosch\r\n', 'Bordeslaan 510\r\n', '5223 MX', 'Den Bosch\r\n', 'Noord-brabant\r\n', 'Op 25 juni 2018 opent Kinepolis in het Paleiskwartier van Den Bosch een gloednieuwe bioscoop met 7 zalen en zo\'n 1000 stoelen. Het leukste uitje in het donker is uitstekend te bereiken met het OV en de auto, want we bieden sterk gereduceerde tarieven voor de Paleisgarage. Kinepolis Den Bosch is een volledige laserprojectie bioscoop wat resulteert in haarscherp beeld. De grootste zaal is uitgerust met Laser ULTRA, een exclusieve combinatie van spectaculair laserbeeld (4K projectie) en het ruimtelijke geluid van Dolby Atmos (uit maar liefst 64 speakers!). De rest van de zalen hebben Dolby 7.1 Geluid. 3D ontbreekt natuurlijk ook niet!  \r\n', NULL, '\"Met de auto kunt u de bioscoop makkelijk bereiken. Let op: stel uw navigatie in op Spiegeltuin 1, Den Bosch. Hiermee komt u uit bij de Paleisgarage. In deze garage krijgt u tot 50% korting op het reguliere tarief tot maximaal 4 uur. U betaalt dan overdag tot 18.00 uur nog maar € 1,15 per uur en na 18.00 uur nog maar € 0.50 per uur. Aan de kassa’s in de bioscoop kunt u deze korting verkrijgen. Na het parkeren neemt u de uitgang “Belvedere” U zult ons vinden naast de Happy Italy. De parkeergarage is voorzien van parkeren voor minder validen en een lift. Er zijn tevens plaatsen om uw elektrische auto weer op te laden.\r\n\r\nVia de randweg/vlijmenseweg en magistratenlaan komt u makkelijk in het Paleiskwartier uit. Volg de borden naar JBZ ziekenhuis vanaf de A2, A76, A59 en neem de afslag naar het JB ziekenhuis via de randweg.\"\r\n', 'De bioscoop ligt op 5 minuten loopafstand van het centraal station. Met de bus kunt u ook in- en uitstappen bij de halte aan de onderwijsboulevard. Hier vindt u buslijnen: 8-9-121-135-136-203-207-239- 300-301-600-621-628-639-643. U kunt dus ook makkelijk vanaf de omliggende steden en dorpen met openbaar vervoer naar de bioscoop.\r\n', 'Voor de bioscoop is er plaats voor bijna 400 fietsen. Wij vragen u vriendelijk om uw fiets in de rekken te plaatsen zodat er genoeg loop- en fietsruimte is voor iedereen. Dank u voor uw medewerking. \r\n', 'Kinepolis Den Bosch heeft mindervaliden plaatsen in elke zaal. Een lift en mindervaliden toilet zijn tevens aanwezig.\r\n'),
(6, 'Kinepolis Den Helder\r\n', 'Willemsoord 51\r\n', '1781AS\r\n', 'Den Helder\r\n', 'Noord-Holland\r\n', 'Kinepolis Den Helder opende in 2003 haar deuren in gebouw 51 op Willemsoord, de voormalige scheeps- en onderhoudswerf voor de Koninklijke Marine. Verschillende details van de Oude Rijkswerf zijn intact gelaten; twee van de zalen zijn nieuw tegen de Scheepswerkerplaats aangebouwd. De bioscoop in de kop van Noord-Holland heeft in totaal 6 moderne bioscoopzalen en 776 stoelen.\r\n', NULL, 'In Den Helder volgt u de ANWB borden richting Willemsoord, de bioscoop bevindt zich op dit terrein. De ingang van Willemsoord zit aan de route voor de veerboot naar Texel. Parkeren kan gratis op het Willemsoord terrein.\r\n', 'Kinepolis Den Helder is vanaf het trein- en busstation van CS Den Helder op 10-15 minuten loopafstand. Volg hiervoor de borden \'Willemsoord\'. \r\n', 'Willemsoord is goed bereikbaar per fiets. Volg hiervoor de borden \'Willemsoord\'. Voor de bioscoop zijn fietsenrekken aanwezig.\r\n', 'Kinepolis Den Helder is grotendeels rolstoeltoegankelijk, neem contact op met de bioscoop voor meer informatie. Er is een lift en mindervalidentoilet aanwezig.\r\n'),
(7, 'Kinepolis Dordrecht\r\n', 'Lijnbaan 200\r\n', '3311 RL\r\n', 'Dordrecht\r\n', 'South-Holland\r\n', 'Kinepolis Dordrecht aan het Wantij is dé bioscoop voor de Drechtsteden. Met 6 moderne zalen kunt u optimaal genieten van perfect beeld en geluid. Eén van de zalen is zelfs voorzien van het nieuwe geluidssysteem Dolby Atmos, wat de filmbeleving nog intenser maakt. Voor een hapje of drankje kunt u terecht in ons Cafe+ met geweldig uitzicht over het water. Kinepolis Dordrecht is makkelijk bereikbaar met openbaar vervoer, fiets en met de auto. Er is een parkeergarage naast de bioscoop. Vraagt u bij de kassa gerust naar gereduceerde parkeertarieven bij uw filmkaartje. Ook voor uw evenementen kunt u bij ons terecht, neem daarvoor contact met ons op via bovenstaand telefoonnummer en/of het contactformulier.\r\n', NULL, 'Met de auto kunt u ons bereiken via de Noordendijk. U volgt de borden voor parkeergarage “Energiehuis” De parkeergarage staat naast de bioscoop. Parkeren in Garage Energiehuis: €3,- voor 4 uur. Afwaarderen aan onze kassa\'s.\r\n', 'U kunt Kinepolis Dordrecht bereiken met buslijn 10, halte Energiehuis. Voor actuele bustijden kijkt u op www.arriva.nl\r\n', 'De parkeergarage heeft ook een zeer grote fietsenstalling.\r\n', 'Kinepolis Dordrecht heeft rolstoelplaatsen in elke zaal. Wilt u deze boeken? Bel of mail dan met de bioscoop. Lift en minder validentoilet zijn aanwezig. \r\n'),
(8, 'Kinepolis Emmen\r\n', 'Westeind 70\r\n', '7811 ME\r\n', 'Emmen\r\n', 'South-Holland\r\n', 'Kinepolis Emmen is een ware blikvanger als u Emmen via de Frieslandroute (N381) filevrij binnenrijdt. Vanaf de weg valt met name de schuin aflopende onderzijde van het gebouw op die bijna over de weg zweeft. Met meer dan voldoende parkeerplaatsen en op loopafstand van Emmen-centrum een uitstekende locatie. De moderne bioscoop met 7 zalen heeft plaats voor 1249 bezoekers in comfortabele bioscoopstoelen.\r\n', NULL, 'De bioscoop is makkelijk te bereiken met de auto via de afrit van de N381. Volg de borden \'P Wildlands\' of \'Centrum Noord\'. Voor de bioscoop is er parkeergelegenheid voor € 1,70 per 58 minuten. Na 18:00u en op donderdag na 21:00 is parkeren gratis.\r\n', 'Kinepolis Emmen is per trein en bus bereikbaar. Vanaf station Emmen is de bioscoop op 10 minuten loopfastand. Met de bus is de bioscoop zeer makkelijk bereiken via halte \'Centrum Emmen\' of \'Frieslandweg\'. Vanaf hier loopt u in enkele minuten naar de bioscoop.\r\n', 'De bioscoop is per fiets bereikbaar. De fietsenstalling staat tegenover de bioscoop.\r\n', 'Kinepolis Emmen is rolstoeltoegankelijk, elke zaal heeft 2 rolstoelplaatsen. Tevens is er een lift en een mindervalidentoilet aanwezig.\r\n');

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
-- Tabelstructuur voor tabel `gebruikers`
--
CREATE TABLE IF NOT EXISTS `gebruikers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `gebruikersNaam` VARCHAR(24) NOT NULL UNIQUE,
  `passwordHash` VARCHAR(255) NOT NULL,
  `gebruikers_rollen_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);

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
  `perm_bios_foto_toevoegen` tinyint(4) DEFAULT NULL,
  `perm_reserverings_overzicht_bios` tinyint(4) DEFAULT NULL,
  `perm_reserverings_overzicht_totaal` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `gebruikers_rollen` (
    `rolType`,
    `perm_bios_toevoegen`,
    `perm_bios_wijzigen`,
    `perm_bios_verwijderen`,
    `perm_content_toevoegen`,
    `perm_content_wijzigen`,
    `perm_content_verwijderen`,
    `perm_bios_foto_toevoegen`,
    `perm_reserverings_overzicht_bios`,
    `perm_reserverings_overzicht_totaal`
)
VALUES
('redacteur', 1, 0, 0, 1, 1, 1, 0, 0, 0),
('bioscoop', 0, 1, 0, 0, 0, 0, 1, 1, 0);

--
-- Tabelstructuur voor tabel `zalen`
--
CREATE TABLE IF NOT EXISTS `zalen` (
  `zaalID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bioscoop_id` INT NOT NULL,
  `zaal` INT NULL,
  `aantal stoelen` INT NULL,
  `rolstoelplaatsen` INT NULL,
  `schermgroote` VARCHAR(45) NULL,
  `facaliteiten` VARCHAR(100) NULL,
  `versies` VARCHAR(45) NULL,
  PRIMARY KEY (`zaalID`)
);

INSERT INTO `zalen` (`zaalID`, `bioscoop_id`, `zaal`, `aantal stoelen`, `rolstoelplaatsen`, `schermgroote`, `facaliteiten`, `versies`) VALUES
(1, 1, 1, 517, 2, '21.00m X 9.00m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1, 3D'),
(2, 1, 2, 369, 2, '17.20m X 9.00m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1, 3D'),
(3, 1, 3, 197, 2, '15.90m X 6.80m', 'Toegankelijk voor andersvaliden', 'Dolby 5.1'),
(4, 1, 4, 217, 2, '16.90m X 7.20m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1'),
(5, 1, 5, 175, 2, '16.90m X 7.20m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1'),
(6, 1, 6, 328, 2, '19.70m X 8.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1'),
(7, 1, 7, 159, 2, '12.10m X 5.20m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1, 3D'),
(8, 1, 8, 175, 2, '10.80m X 4.70m', 'Toegankelijk voor andersvaliden', 'Dolby 7.1, 3D'),
(9, 2, 1, 186, 4, '5.19m X 12.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1'),
(10, 2, 2, 186, 4, '5.19m X 12.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1'),
(11, 2, 3, 102, 4, '5.19m X 12.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1'),
(12, 2, 4, 102, 4, '5.19m X 12.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1, 3D'),
(13, 2, 5, 186, 4, '6.28m x 12.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1, 3D'),
(14, 2, 6, 186, 4, '6.28m x 15.00m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1'),
(15, 2, 7, 318, 8, '8.41m x 20.10m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser Ultra,Laser, Atmos, 3D'),
(16, 2, 8, 186, 4, '6.28m x 15.00m', 'Toegankelijk voor andersvaliden Cosy zone', 'Laser,Dolby 7.1, 3D'),
(17, 2, 9, 102, 4, '6.28m x 15.00m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1'),
(18, 2, 10, 102, 4, '6.28m x 15.00m', 'Toegankelijk voor andersvaliden Cosy zone', '"Laser,Dolby 7.1'),
(19, 3, 1, 139, 4, '4.90m x 8.70m', 'Toegankelijk voor andersvaliden Twinseat', 'Dolby 7.1, 3D'),
(20, 3, 2, 139, 4, '4.20m x 10.00m', 'Toegankelijk voor andersvaliden Twinseat', 'Dolby 7.1, 3D'),
(21, 3, 3, 91, 2, '3.80m x 8.90m', 'Toegankelijk voor andersvaliden Twinseat', 'Dolby 5.1, 3D'),
(22, 3, 4, 91, 2, '4.00m x 9.60m', 'Toegankelijk voor andersvaliden Twinseat', 'Dolby 5.1, 3D'),
(23, 3, 5, 72, 2, '3.60m x 8.60m', 'Toegankelijk voor andersvaliden Twinseat', 'Dolby 5.1, 3D'),
(24, 4, 1, 126, 4, '3.90m x 9.90m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1'),
(25, 4, 2, 132, 4, '3.90m x 9.90m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1, 3D'),
(26, 4, 3, 143, 4, '4.10m x 10.00m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1, 3D'),
(27, 4, 4, 147, 4, '4.10m x 10.00m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1'),
(28, 4, 5, 120, 4, '4.40m x 10.00m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1, 3D'),
(29, 4, 6, 120, 4, '4.70m x 10.00m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1, 3D'),
(30, 4, 7, 148, 4, '4.50m x 11.00m', 'Toegankelijk voor andersvaliden Twinseat', 'HFR, Dolby 7.1, 3D'),
(31, 5, 1, 136, 2, '5.30m x 12.60m', 'Toegankelijk voor andersvaliden', 'Laser, Dolby 7.1'),
(32, 5, 2, 120, 2, '5.15m x 12.30m', 'Toegankelijk voor andersvaliden', 'Laser, Dolby 7.1'),
(33, 5, 3, 120, 2, '5.30m x 12.70m', 'Toegankelijk voor andersvaliden', 'Laser, Dolby 7.1'),
(34, 5, 4, 136, 2, '5.30m x 12.70m', 'Toegankelijk voor andersvaliden', 'Laser, Dolby 7.1, 3D'),
(35, 5, 5, 116, 2, '5.15m x 12.30m', 'Toegankelijk voor andersvaliden', 'Laser, Dolby 7.1'),
(36, 5, 6, 116, 2, '5.00m x 12.00m', 'Toegankelijk voor andersvaliden', 'Laser, Dolby 7.1'),
(37, 5, 7, 268, 2, '7.30m x 17.50m', 'Toegankelijk voor andersvaliden', 'Laser Ultra, 3D'),
(38, 6, 1, 291, 0, '15.70m x 6.80m', 'Toegankelijk voor andersvaliden', 'Dolby 5.1, 3D'),
(39, 6, 2, 121, 0, '11.00m x 4.90m', '-', 'Dolby 5.1, 3D'),
(40, 6, 3, 89, 2, '10.10m x 4.50m', 'Toegankelijk voor andersvaliden', 'Dolby 5.1, 3D'),
(41, 6, 4, 89, 2, '10.10m x 4.50m', 'Toegankelijk voor andersvaliden', 'Dolby 5.1'),
(42, 6, 5, 89, 2, '10.10m x 4.50m', 'Toegankelijk voor andersvaliden', 'Dolby 5.1'),
(43, 6, 6, 89, 2, '10.10m x 4.50m', 'Toegankelijk voor andersvaliden', 'Dolby 5.1'),
(44, 7, 1, 105, 2, '11.37m x 4.75m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1, 3D'),
(45, 7, 2, 105, 2, '11.37m x 4.75m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1'),
(46, 7, 3, 262, 2, '15.20m x 6.36m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1, 3D'),
(47, 7, 4, 262, 2, '15.20m x 6.36m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1, 3D'),
(48, 7, 5, 178, 2, '13.34m x 5.58m', 'Toegankelijk voor andersvaliden Cosy zone', 'Atmos'),
(49, 8, 1, 301, 2, '16.60m x 7.10m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1, 3D'),
(50, 8, 2, 193, 2, '12.25m x 5.40m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 7.1, 3D'),
(51, 8, 3, 193, 2, '14.25m x 6.25m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1'),
(52, 8, 4, 114, 2, '11.25m x 4.95m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1, 3D'),
(53, 8, 5, 114, 2, '11.25m x 4.95m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1, 3D'),
(54, 8, 6, 114, 2, '11.25m x 4.95m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1'),
(55, 8, 7, 114, 2, '11.25m x 4.95m', 'Toegankelijk voor andersvaliden Cosy zone', 'Dolby 5.1');

--
-- Tabelstructuur voor tabel `beschikbaarheid_bioscopen`
--
CREATE TABLE IF NOT EXISTS `beschikbaarheid_bioscopen` (
  `Beschikbaarheid_bioscopenID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `zalen_zaalID` INT UNSIGNED NOT NULL,
  `beginDatum` DATETIME NULL,
  `eindDatum` DATETIME NULL,
  PRIMARY KEY (`Beschikbaarheid_bioscopenID`)
);

--
-- Tabelstructuur voor tabel `reserveringen`
--
CREATE TABLE IF NOT EXISTS `reserveringen` (
  `reserveringenID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Beschikbaarheid_bioscopenID` INT UNSIGNED NOT NULL,
  `betalingen_betalingenID` INT UNSIGNED NOT NULL,
  `TotaalVerschuldigd` DECIMAL(8,2) NULL,
  PRIMARY KEY (`reserveringenID`)
);

--
-- Tabelstructuur voor tabel `betalingen`
--
CREATE TABLE IF NOT EXISTS `betalingen` (
  `betalingenID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `BetaaldBedrag` DECIMAL(8,2) NULL,
  `BetaalDatum` DATETIME NULL,
  `BetalingsMethode` VARCHAR(45) NULL,
  PRIMARY KEY (`betalingenID`)
);

--
-- Tabelstructuur voor tabel `bioscoop_afbeeldingen`
--
CREATE TABLE IF NOT EXISTS `bioscoop_afbeeldingen` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bioscoop_id` INT NOT NULL,
  `afbeelding` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `bioscoop_afbeeldingen`(`bioscoop_id`, `afbeelding`)
VALUES
(1, "View/images/bioscoop_images/almere1"),
(1, "View/images/bioscoop_images/almere2"),
(1, "View/images/bioscoop_images/almere3"),
(2, "View/images/bioscoop_images/breda1"),
(2, "View/images/bioscoop_images/breda2"),
(2, "View/images/bioscoop_images/breda3"),
(2, "View/images/bioscoop_images/breda4"),
(3, "View/images/bioscoop_images/schagen1"),
(4, "View/images/bioscoop_images/hoofddorp1"),
(5, "View/images/bioscoop_images/denbosch1"),
(5, "View/images/bioscoop_images/denbosch2"),
(5, "View/images/bioscoop_images/denbosch3"),
(5, "View/images/bioscoop_images/denbosch4"),
(5, "View/images/bioscoop_images/denbosch5"),
(5, "View/images/bioscoop_images/denbosch6"),
(5, "View/images/bioscoop_images/denbosch7"),
(5, "View/images/bioscoop_images/denbosch8"),
(6, "View/images/bioscoop_images/denhelder1"),
(6, "View/images/bioscoop_images/denhelder2"),
(6, "View/images/bioscoop_images/denhelder3"),
(6, "View/images/bioscoop_images/denhelder4"),
(7, "View/images/bioscoop_images/dordrecht1"),
(7, "View/images/bioscoop_images/dordrecht2"),
(7, "View/images/bioscoop_images/dordrecht3"),
(7, "View/images/bioscoop_images/dordrecht4"),
(8, "View/images/bioscoop_images/emmen1");

--
-- Tabelstructuur voor tabel `tarieven`
--
CREATE TABLE IF NOT EXISTS `tarieven` (
  `tariefID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(100) NULL,
  `prijsPerPersoon` DECIMAL(5,2) NULL,
  `bioscopen_id` INT NOT NULL,
  PRIMARY KEY (`tariefID`)
);

INSERT INTO `tarieven` (`tariefID`, `naam`, `prijsPerPersoon`, `bioscopen_id`) VALUES
(1, 'normaal', '10.50', 1),
(2, 'kinderen t/m 11 jaar', '8.00', 1),
(3, '65+', '8.70', 1),
(4, 'studenten. Cjp & bankgiro', '8.70', 1),
(5, 'normaal', '10.80', 2),
(6, 'kinderen t/m 11 jaar', '6.50', 2),
(7, '65+', '9.00', 2),
(8, 'studenten. Cjp & bankgiro', '9.00', 2),
(9, 'normaal', '9.00', 3),
(10, 'kinderen t/m 11 jaar', '6.50', 3),
(11, '65+', '8.00', 3),
(12, 'studenten. Cjp & bankgiro', '8.00', 3),
(13, 'Vroege Vogel Voorstellingen (aanvang voor 12:00 uur)', '7.00', 4),
(14, 'Middagvoorstelling (aanvang na 12:00 uur en voor 18:00 ', '8.00', 4),
(15, 'Avondvoorstelling (aanvang na 18:00 uur)', '9.90', 4),
(16, 'normaal', '10.50', 5),
(17, 'Kinderen t/m 11 jaar', '6.50', 5),
(18, 'Jeugd 12 t/m 17 jaar', '8.50', 5),
(19, 'Studenten, CJP, 65+', '8.50', 5),
(20, 'normaal', '9.90', 6),
(21, 'Kinderen t/m 11 jaar', '7.50', 6),
(22, 'Studenten, CJP, 65+', '8.50', 6),
(23, 'normaal', '10.80', 7),
(24, 'Kinderen t/m 11 jaar', '6.50', 7),
(25, 'Studenten, CJP, 65+', '8.50', 7),
(26, 'normaal', '10.00', 8),
(27, 'Kinderen t/m 11 jaar', '7.50', 8),
(28, '65+, Studenten, CJP & BankGiro Loterij VIP-KAART', '8.50', 8);


--
-- Tabelstructuur voor tabel `toeslagen`
--
CREATE TABLE IF NOT EXISTS `toeslagen` (
  `toeslagenID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bioscopen_id` INT NOT NULL,
  `naam` VARCHAR(100) NULL,
  `prijs` DECIMAL(5,2) NULL,
  PRIMARY KEY (`toeslagenID`)
);

INSERT INTO `toeslagen` (`toeslagenID`, `bioscopen_id`, `naam`, `prijs`) VALUES
(1, 1, '3d-toeslag excl bril', '1.50'),
(2, 1, '3d-toeslag incl bril', '2.60'),
(3, 1, 'dolby atmos', '0.00'),
(4, 1, 'laser ultra', '0.00'),
(5, 1, 'cosy', '2.50'),
(6, 2, '3d-toeslag excl bril', '1.50'),
(7, 2, 'kinderen t/m 11 jaar', '6.50'),
(8, 2, '3d-toeslag incl bril', '2.60'),
(9, 2, 'dolby atmos', '0.00'),
(10, 2, 'laser ultra', '2.50'),
(11, 2, 'cosy', '2.50'),
(12, 3, '3d-toeslag excl bril', '1.00'),
(13, 3, '3d-toeslag incl bril', '2.00'),
(14, 3, 'dolby atmos', '0.00'),
(15, 3, 'laser ultra', '0.00'),
(16, 4, '3d-toeslag excl bril', '1.00'),
(17, 4, '3d-toeslag incl bril', '2.00'),
(18, 4, 'Love-/VIP-seats', '1.50'),
(19, 5, '3d-toeslag excl bril', '1.50'),
(20, 5, '3d-toeslag incl bril', '2.60'),
(21, 5, 'Laser ULTRA', '2.50'),
(22, 6, '3d-toeslag excl bril', '1.50'),
(23, 6, '3d-toeslag incl bril', '2.60'),
(24, 7, '3d-toeslag excl bril', '1.50'),
(25, 7, '3d-toeslag incl bril', '2.60'),
(26, 7, 'Dolby Atmos', '1.50'),
(27, 8, '3d-toeslag excl bril', '1.50'),
(28, 8, '3d-toeslag incl bril', '2.60');


--
-- Tabelstructuur voor tabel `facturen`
--
CREATE TABLE IF NOT EXISTS facturen (
  `FactuurNummer` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `klantnaam` VARCHAR(45) NULL,
  `klantadres` VARCHAR(60) NULL,
  `postcode` VARCHAR(10) NULL,
  `plaats` VARCHAR(45) NULL,
  `provincie` VARCHAR(45) NULL,
  `telefoonnummer` VARCHAR(45) NULL,
  `factuurDatum` DATETIME NULL,
  PRIMARY KEY (`FactuurNummer`)
)
