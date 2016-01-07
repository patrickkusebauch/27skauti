-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
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

INSERT INTO `history` (`year`, `game`, `leaders`, `deputies`, `oldscouts`, `rangers`, `club`, `camp`, `mloci`, `tucnaci`, `jezevci`) VALUES
  ('2001 - 2002',	'Starověké Řecko',	'Zip\n',	'Jack, Svišť\n',	'Medvěd, Kiwi, Muf\n',	'Krab, Pavouk, Kim, Poletuška, Akela, Hugo\n',	'Hanychov',	'Vápno - Vyvěračka',	'\nJ.R\nLišák\nKlokan\nČili\nHonza\nMamut\nKlíšťák (Vojtěch Dlask)\nOrel (Jiří Fanta)\nDale (Jakub Trsek)',	'Křižák\nKrálík\nBobr\nRadar\nKobra\nOpic (Antonín Picek)\nCvrček (Marek Jarisch)\nTygr (Robert Bayer)\nChip (Filip Tylichtr)',	''),
  ('2002 - 2003',	'Osidlování planety',	'Zip',	'Jack, Svišť\n',	'Medvěd, Kiwi, Muf\n',	'Krab, Pavouk, Kim, Poletuška, Akela, Klokan, Chechta\n',	'Hanychov',	'Vápno - Vyvěračka',	'J.R.\nLišák\nČili\nHonza\nMamut\nKlíšťák\nOrel\nDale\nLuňák (Antonín Dománek)\nŠíp (Tomáš Richtr)\nRoxtidy (Josef Kryštof)\n',	'Radar\nKrálík\nKřižák\nBobr\nKobra\nOpic\nCvrček\nTygr\nRak (Václav Dlask)\nAleš (Aleš Vaníček)\nTomáš (Tomáš Štěpánek)\nBeebob (Josef Kovačič)',	''),
  ('2003 - 2004',	'Rallye Paris - Dakar',	'Zip',	'Kim, Krab, Pavouk\n',	'Medvěd, Kiwi, Muf, Jack, Svist\n',	'Chechta, Akéla, Poletuška, J.R., Křižák, Radar, Bobr\n',	'Hanychov',	'Vápno - Vyvěračka',	'Lišák\nDale\nHonza\nOpic\nCvrček\nRak\nLuňák\nLuck (Patrick Kusebauch)',	'Mamut\nKrálík\nČili\nKlíšťák\nOrel\nŠíp\nPompo (Vlastimil Petera)\n',	''),
  ('2004 - 2005',	'Piráti',	'Zip',	'Kim, Krab, Pavouk\n',	'Medvěd, Kiwi, Muf, Jack, Svist\n',	'Chechta, Akéla, Poletuška, J.R., Křižák, Radar, Bobr, Lišák, Mamut, Králik\n',	'Hanychov',	'Vápno - Vyvěračka',	'Dale\nKlíšťák\nCvrček\nOpic\nLuňák\nRak\nLuck\nKája (Karel Šťovíček)',	'Honza\nRoxtidy\nBeebob\nŠíp\nPompo\nKryton (Kryštof Stieber)\nMarek (Marek Šťovíček)\n',	''),
  ('2005 - 2006',	'Kelti',	'Zip',	'Kim',	'Medvěd, Kiwi, Muf, Jack, Svišť, Akéla\n',	'J.R., Křižák, Radar, Bobr, Lišák, Mamut, Honza, Dale, Krab, Králík\n',	'Hanychov',	'Vápno - Vyvěračka',	'Cvrček\nŠíp\nOpic\nRak\nLuňák\nKája\nLukáš (Lukáš Deszö)\nLuboš (Luboš Šimek)',	'Roxtidy\nKlíšťák\nBeebob\nLuck\nPompo\nKryton\nChip (Jakub Štula)\n',	''),
  ('2006 - 2007',	'Po stopách ztracené expedice',	'Kim',	'Zip, Krab\n',	'Medvěd, Kiwi, Muf, Jack, Svišť, Akéla, Potetuška, Kobra\n',	'J.R., Křižák, Radar, Bobr, Lišák, Mamut, parsifal (Honza), Dale, Cvrček, Králík\n',	'Hanychov',	'Vápno - Vyvěračka',	'Klíšták\nŠíp\nOpic\nLuck\nLuňák\nMarek (Marek Šťovíček)\nChip\nMatěj (Matěj Štula)\nPepa (Josef Nohýnek)\nguliso (??? Jandík)',	'Roxtidy\nBeebob\nKája\nPompo\nKryton\nRak (Václav Dlask)\nHolly (Lukáš Deszö)\nTomáš0 (Tomáš ???)\nNet (Tomáš Fogl)\n',	''),
  ('2007 - 2008',	'Persie',	'Zip',	'Kim, Krab\n',	'Medvěd, Kiwi, Muf, Jack, Svišť, Akéla, Potetuška, Kobra, Dale\n',	'J.R., Křižák, Radar, Bobr, Lišák, parsifal, Cvrček, Klíšťák, Opic, Roxtidy, Beebob, Králík\n',	'Hanychov',	'Vápno - Vyvěračka',	'Luck\nLuňák\nRak\nChip\nMatěj\nNet\nDavid (David Křeček)',	'Kája\nŠíp\nKryton\nPompo\nHolly\nguliso',	''),
  ('2008 - 2009',	'Divoký západ',	'Zip',	'Kim',	'Medvěd, Kiwi, Muf, Jack, Svišť, Potetuška, Kobra, Dale, Krab\n',	'J.R., Křižák, Radar, Bobr, Lišák, parsifal, Cvrček, Klíšťák, Opic, Roxtidy, Beebob, Králík\n',	'Hanychov',	'Vápno - Vyvěračka',	'Luck\nLuňák\nRak\nChip\nNet\nDavid\nBanán (Filip Durdis)\nTornádo (David Folwarczny)\nSoptík (Jiří Vosáhlo)\nLevhart (Vladimír Kopejska)\nHurikán (Tomáš Hanyk)',	'Kája\nŠíp\nKryton\nPompo\nKuba (Jakub Janků)\nRychlík (Vít Kratochvíl)\nMarvin (Matyáš Špringl)\nBlesk (Richard Medlík)\nGepard (Jan Svatuška)',	''),
  ('2009 - 2010',	'Obsazování ČR - Armáda',	'Zip',	'Kim',	'Medvěd, Kiwi, Muf, Jack, Svišť, Potetuška, Kobra, Dale, Krab\n',	'J.R., Křižák, Radar, Bobr, Lišák, parsifal, Cvrček, Klíšťák, Opic, Roxtidy, Beebob, Luck, Luňák, Rak, Kája, Šíp, Králík\n',	'Hanychov',	'Vápno - Vyvěračka',	'Chip\nMarvin\nTornádo\nSoptík\nBanán\nDavid\nDominik (Dominik Wieser)\nDominik 2 (Dominik Pafumi)\nLukáš (Lukáš Kubíček)\nVojta (Vojtěch Blažek)\nKuba 2 (Jakub Blažek)\n',	'Net\nBlesk\nGepard\nLevhart\nKuba\nPompo\nMarek (Marek Dědek)\nMarián (Marián Mierny)\n',	''),
  ('2010 - 2011',	'NASA - dobývání Měsíce',	'Zip',	'Kim',	'J.R., Křižák, Lišák, Radar, Medvěd, Kiwi, Muf, Jack, Svišť, Potetuška, Kobra, Krab, Roxtidy\n',	'Bobr, parsifal, Klíšťák, Opic, Beebob, Luck, Luňák, Rak, Kája, Šíp, Chip, Králík, Dale\n',	'Hanychov',	'Vápno - Vyvěračka',	'Blesk\nMarvin\nTornádo\nSoptík\nMarián\nVojta\nKuba 2\nBárt (Dominik Zolák)\nBizon (František Janda)\nVašek (Václav Pavlů)\nMichal 2 (Michal Šubrt)',	'Net\nGepard\nLevhart\nBanán\nKuba\nMarek\nRadim (Radim Neumann)\nRoland (Roland Neumann)\nMichal (Michal Květ)\n',	''),
  ('2011 - 2012',	'Hollywood',	'Zip',	'Kim',	'J.R., Křižák, Lišák, Radar, Medvěd, Kiwi, Muf, Jack, Svišť, Potetuška, Kobra, Krab, Roxtidy',	'Bobr, parsifal, Klíšťák, Opic, Beebob, Luck, Luňák, Rak, Kája, Šíp, Chip, Králík, Dale\n',	'Hanychov',	'Vápno - Vyvěračka',	'Blesk\nMarvin\nMarián\nSoptík\nBárt\nVašek\nBizon\nPoletuška (Josef Šidlo)\nŽabák (Matyáš Řádek)',	'Net\nGepard\nLevhart\nBanán\nKuba\nMarek\nRadim\nRoland\nJožka\nOrel (Matěj Vorlíček)\nTomáš (Tomáš Kabátek)',	''),
  ('2012 - 2013',	'Ztraceni',	'Zip, Klíšťák, Beebob',	'Kim',	'J.R., Křižák, Lišák, Radar, Medvěd, Kiwi, Muf, Jack, Svišť, Potetuška, Kobra, Krab, Roxtidy',	'Bobr, parsifal, Opic, Luck, Luňák, Rak, Kája, Šíp, Chip, Králík, Dale',	'Hanychov',	'Vápno - Vyvěračka',	'Blesk\nMarvin\nSoptík\nBárt\nŽabák\nBizon\nPoletuška\nPetr (Petr Vašák)\nHonza (Jan Kánský)\nJenda (Jan Matějčík)\nSokol (Petr Dlouhý)\nPepa (Josef Podzemský)',	'Net\nGepard\nLevhart\nMarek\nKuba\nVašek\nOrel\nTomáš\nDiablo (Filip Grundza)\nGrizzly (Matyáš Neckář)\nPiškot (Jakub Ištok)',	''),
  ('2013 - 2014',	'???',	'Zip, Klíšťák, Beebob',	'Kim',	'J.R., Křižák, Lišák, Radar, Medvěd, Kiwi, Muf, Jack, Svišť, Potetuška, Kobra, Krab, Roxtidy\n',	'Bobr, parsifal, Opic, Luck, Luňák, Rak, Kája, Šíp, Chip, Králík, Dale, Net\n',	'Hanychov',	'???',	'Marvin\nBizon\nSoptík\nBárt\nShrek\nJenda\nSmíšek (Petr Vašák)\nHoney (Jan Kánský)\nPepa\nMajkl (Michael Hádek)\n',	'Gepard\nLevhart\nMarek\nGrizzly\nPiškot\nOrel\nTomáš\nOndra (Ondřej Dědek)\nVašek (Václav Štěch)',	'');

-- 2014-11-10 17:25:13