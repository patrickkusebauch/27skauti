-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Ned 07. dub 2013, 01:20
-- Verze MySQL: 5.1.41-3ubuntu12.10
-- Verze PHP: 5.3.2-1ubuntu4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `27skauti_cz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `calendar`
--
-- Vytvořeno: Sob 06. dub 2013, 23:16
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `yearpart` enum('jaro','podzim') CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `show` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `year_yearpart` (`year`,`yearpart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `chronicle_photos`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `chronicle_photos` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `order` int(4) NOT NULL,
  `text` text COLLATE utf8_czech_ci,
  `intro` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `chronicle_videos`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `chronicle_videos` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `input` tinytext COLLATE utf8_czech_ci NOT NULL,
  `note` tinytext COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `event`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(10) unsigned NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `type` varchar(20) NOT NULL COMMENT '(Schůzka, výprava apod.)',
  `calendarnote` varchar(80) DEFAULT NULL,
  `leaders` varchar(80) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Název akce',
  `contactperson` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Cizí klíč na members',
  `text` text CHARACTER SET utf8 COLLATE utf8_czech_ci COMMENT 'Úvodní text lístečku',
  `equipment` text CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `morse` text CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `chroniclewriter` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Cizí klíč na members',
  `route` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `rangers` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci COMMENT 'Vedení přítomné na akci',
  `tucnaci` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `mloci` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `novacci` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_czech_ci COMMENT 'Příspěvek do kroniky',
  `showevent` tinyint(1) NOT NULL DEFAULT '0',
  `showchronicle` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contactperson` (`contactperson`),
  KEY `chroniclewriter` (`chroniclewriter`),
  KEY `calendarevent_id` (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `event_meeting`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `event_meeting` (
  `event_id` int(10) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `startplace` varchar(40) NOT NULL,
  `endplace` varchar(40) NOT NULL,
  `comment` varchar(60) DEFAULT NULL,
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `guestbook`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `time` datetime NOT NULL,
  `post` text NOT NULL,
  `mail` varchar(60) DEFAULT NULL,
  `web` varchar(80) DEFAULT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `history`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `history` (
  `year` char(11) COLLATE utf8_czech_ci NOT NULL,
  `game` varchar(80) COLLATE utf8_czech_ci NOT NULL,
  `leaders` tinytext COLLATE utf8_czech_ci NOT NULL,
  `deputies` tinytext COLLATE utf8_czech_ci NOT NULL,
  `oldscouts` tinytext COLLATE utf8_czech_ci NOT NULL,
  `rangers` tinytext COLLATE utf8_czech_ci NOT NULL,
  `club` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `camp` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `mloci` tinytext COLLATE utf8_czech_ci,
  `tucnaci` tinytext COLLATE utf8_czech_ci,
  `jezevci` tinytext COLLATE utf8_czech_ci,
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `member`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `member` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `nickname` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(15) COLLATE utf8_czech_ci DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `group` varchar(40) CHARACTER SET utf8 NOT NULL,
  `stripe` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `entered` date NOT NULL,
  `note` text COLLATE utf8_czech_ci,
  PRIMARY KEY (`nickname`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `news`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `posted` date NOT NULL,
  `heading` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `privilege`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `user_id` int(10) unsigned NOT NULL,
  `base` varchar(30) NOT NULL,
  `registration` varchar(30) NOT NULL,
  `privilege` varchar(30) NOT NULL,
  `chronicle` varchar(30) NOT NULL,
  `vip` varchar(30) NOT NULL,
  `news` varchar(30) NOT NULL,
  `event` varchar(30) NOT NULL,
  `guestbook` varchar(30) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `registration`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `registration` (
  `member_nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `birth_date` date NOT NULL,
  `oddíl` smallint(2) NOT NULL,
  `adress` varchar(40) CHARACTER SET latin1 NOT NULL,
  `contact` varchar(20) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(20) CHARACTER SET latin1 NOT NULL,
  UNIQUE KEY `member_nickname` (`member_nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--
-- Vytvořeno: Stř 16. kvě 2012, 00:03
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` char(128) CHARACTER SET latin1 NOT NULL,
  `mail` varchar(40) CHARACTER SET latin1 NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `chronicle_photos`
--
ALTER TABLE `chronicle_photos`
  ADD CONSTRAINT `chronicle_photos_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Omezení pro tabulku `chronicle_videos`
--
ALTER TABLE `chronicle_videos`
  ADD CONSTRAINT `chronicle_videos_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Omezení pro tabulku `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`contactperson`) REFERENCES `member` (`nickname`),
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`chroniclewriter`) REFERENCES `member` (`nickname`);

--
-- Omezení pro tabulku `event_meeting`
--
ALTER TABLE `event_meeting`
  ADD CONSTRAINT `event_meeting_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Omezení pro tabulku `guestbook`
--
ALTER TABLE `guestbook`
  ADD CONSTRAINT `guestbook_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Omezení pro tabulku `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Omezení pro tabulku `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Omezení pro tabulku `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Omezení pro tabulku `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`member_nickname`) REFERENCES `member` (`nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
