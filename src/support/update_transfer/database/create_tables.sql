-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2014 at 12:25 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `27skauti_testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL COMMENT 'Kalendářní rok (NE školní!)',
  `yearpart` enum('jaro','podzim') COLLATE utf8_czech_ci NOT NULL COMMENT 'Kalendář na jaro nebo podzim?',
  `show` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Má se kalendář zobrazit? 0 - NE, 1 - ANO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `year_yearpart` (`year`,`yearpart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Kalendář akcí' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chronicle_photos`
--

CREATE TABLE IF NOT EXISTS `chronicle_photos` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `order` int(4) unsigned zerofill NOT NULL COMMENT 'Pořadí fotek (limit na 9999 fotek)',
  `text` text COLLATE utf8_czech_ci COMMENT 'Popisek fotky',
  `intro` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Reprezentativní fotka akce? 0 -NE, 1 - ANO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_id_order` (`event_id`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Fotky do kroniky' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chronicle_videos`
--

CREATE TABLE IF NOT EXISTS `chronicle_videos` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `input` tinytext COLLATE utf8_czech_ci NOT NULL COMMENT 'Kód pro zobrazení videa',
  `note` tinytext COLLATE utf8_czech_ci NOT NULL COMMENT 'Popisek k videu',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Videa do kroniky' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(10) unsigned NOT NULL,
  `datestart` date NOT NULL COMMENT 'Akce začala',
  `dateend` date NOT NULL COMMENT 'Akce zkončila',
  `type` varchar(20) COLLATE utf8_czech_ci NOT NULL COMMENT '(Schůzka, výprava apod.)',
  `calendarnote` varchar(80) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Poznámka pro kalendář',
  `leaders` varchar(80) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Vedoucí akce (pro kalendář)',
  `name` varchar(80) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Název akce',
  `contactperson` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Kontaktní osoba (Cizí klíč na members)',
  `text` text COLLATE utf8_czech_ci COMMENT 'Úvodní text lístečku',
  `equipment` text COLLATE utf8_czech_ci COMMENT 'S sebou na akci',
  `morse` text COLLATE utf8_czech_ci COMMENT 'Morzeovka',
  `note` text COLLATE utf8_czech_ci COMMENT 'Poznámka k lístečku',
  `chroniclewriter` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Zapsal do kroniky (Cizí klíč na members)',
  `route` tinytext COLLATE utf8_czech_ci COMMENT 'Trasa akce',
  `rangers` tinytext COLLATE utf8_czech_ci COMMENT 'Vedení přítomné na akci',
  `tucnaci` tinytext COLLATE utf8_czech_ci COMMENT 'Tučňáci přítomni na akci',
  `mloci` tinytext COLLATE utf8_czech_ci COMMENT 'Mloci přítomni na akci',
  `novacci` tinytext COLLATE utf8_czech_ci COMMENT 'Nováčci přítomni na akci',
  `content` text COLLATE utf8_czech_ci COMMENT 'Příspěvek do kroniky',
  `showevent` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Zobrazit akci (lísteček)',
  `showchronicle` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Zobrazit kroniku',
  PRIMARY KEY (`id`),
  KEY `contactperson` (`contactperson`),
  KEY `chroniclewriter` (`chroniclewriter`),
  KEY `calendarevent_id` (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Data akcí od zobrazení v kalendáři přez lísteček až po kroniku.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_meeting`
--

CREATE TABLE IF NOT EXISTS `event_meeting` (
  `event_id` int(10) NOT NULL,
  `starttime` datetime NOT NULL COMMENT 'Čas srazu',
  `endtime` datetime NOT NULL COMMENT 'Čas rozchodu',
  `startplace` varchar(40) COLLATE utf8_czech_ci NOT NULL COMMENT 'Místo srazu',
  `endplace` varchar(40) COLLATE utf8_czech_ci NOT NULL COMMENT 'Místo rozchodu',
  `comment` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Typ (Např. "Běžky" nebo "Sjezdovky")',
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Umožňuje více jak jeden sraz a rozchod (např. běžky a sjezdovky)';

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'Pokud zápis proveld přihlášený uživatel',
  `name` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Pokud zápis proveld nepřihlášený uživatel',
  `time` datetime NOT NULL COMMENT 'Čas zápisu',
  `post` text COLLATE utf8_czech_ci NOT NULL COMMENT 'Text zprávy',
  `mail` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'e-mail',
  `web` varchar(80) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'webová stránka',
  `show` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Zápisy do knihy návštěv' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `year` char(11) COLLATE utf8_czech_ci NOT NULL COMMENT 'Rok (školní formát "yyyy - yyyy")',
  `game` varchar(80) COLLATE utf8_czech_ci NOT NULL COMMENT 'Táborová hra',
  `leaders` tinytext COLLATE utf8_czech_ci NOT NULL COMMENT 'Vedoucí',
  `deputies` tinytext COLLATE utf8_czech_ci NOT NULL COMMENT 'Zástupci vedoucího',
  `oldscouts` tinytext COLLATE utf8_czech_ci NOT NULL COMMENT 'Oldskauti',
  `rangers` tinytext COLLATE utf8_czech_ci NOT NULL COMMENT 'Roveři',
  `club` varchar(60) COLLATE utf8_czech_ci NOT NULL COMMENT 'Klubovna',
  `camp` varchar(60) COLLATE utf8_czech_ci NOT NULL COMMENT 'Tábořiště',
  `mloci` tinytext COLLATE utf8_czech_ci,
  `tucnaci` tinytext COLLATE utf8_czech_ci,
  `jezevci` tinytext COLLATE utf8_czech_ci COMMENT 'Bohužel...',
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Historie oddílu';

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `nickname` varchar(20) COLLATE utf8_czech_ci NOT NULL COMMENT 'Přesdívka',
  `title` varchar(15) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Titul',
  `name` varchar(20) COLLATE utf8_czech_ci NOT NULL COMMENT 'Jméno',
  `surname` varchar(20) COLLATE utf8_czech_ci NOT NULL COMMENT 'Příjmení',
  `group` varchar(40) COLLATE utf8_czech_ci NOT NULL DEFAULT 'nečlen' COMMENT 'Družina/pozice',
  `stripe` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Frčka',
  `entered` date NOT NULL COMMENT 'Datum vstupu do oddílu',
  `note` text COLLATE utf8_czech_ci COMMENT 'Osobní poznámka',
  PRIMARY KEY (`nickname`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Pouze členové oddílu; Změnit nickaname na primary a user_id NULL';

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_czech_ci NOT NULL COMMENT 'Kronika/Akce/Zpráva',
  `posted` date NOT NULL,
  `heading` varchar(80) COLLATE utf8_czech_ci NOT NULL COMMENT 'Nadpis',
  `content` text COLLATE utf8_czech_ci NOT NULL COMMENT 'Text novinky',
  `show` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Zobrazit (0 - NE, 1 - ANO)',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Novinky' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `user_id` int(10) unsigned NOT NULL,
  `base` varchar(30) COLLATE utf8_czech_ci NOT NULL COMMENT 'Obecné',
  `registration` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Registrace',
  `privilege` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Práva',
  `chronicle` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Kronika',
  `vip` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'VIP kronika',
  `news` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Aktuality',
  `event` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Akce',
  `guestbook` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Kniha návštěv',
  `hlasinek` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Hlásínek',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Přístupová práva - NEŠAHAT (Závislé na ACL)';

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `member_nickname` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `birth_date` date NOT NULL COMMENT 'Datum narození',
  `oddil` smallint(2) NOT NULL DEFAULT '27' COMMENT 'oddíl',
  `address` tinytext COLLATE utf8_czech_ci COMMENT 'Adresa',
  `contact` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Kontaktní osoba?',
  `phone` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Telefon',
  `mobile` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Mobil',
  UNIQUE KEY `member_nickname` (`member_nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Registrace - jednou snad bude rovnou tahat z is.skaut.cz';

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_czech_ci NOT NULL COMMENT 'Uživatelské jméno',
  `password` char(128) COLLATE utf8_czech_ci NOT NULL COMMENT 'Heslo',
  `mail` varchar(40) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'e-mail',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Aktivovaný účet',
  `token` char(60) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Token pro aktivaci a zapomenuté heslo',
  `issuedate` date DEFAULT NULL COMMENT 'Kdy byl token naposledy vydán',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Příhlašování uživatelů' AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chronicle_photos`
--
ALTER TABLE `chronicle_photos`
  ADD CONSTRAINT `chronicle_photos_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chronicle_videos`
--
ALTER TABLE `chronicle_videos`
  ADD CONSTRAINT `chronicle_videos_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_5` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `event_ibfk_6` FOREIGN KEY (`chroniclewriter`) REFERENCES `member` (`nickname`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `event_ibfk_7` FOREIGN KEY (`contactperson`) REFERENCES `member` (`nickname`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `event_meeting`
--
ALTER TABLE `event_meeting`
  ADD CONSTRAINT `event_meeting_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD CONSTRAINT `guestbook_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_3` FOREIGN KEY (`member_nickname`) REFERENCES `member` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;