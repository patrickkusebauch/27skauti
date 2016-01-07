  -- from akce(245), kalendar(596), kronika(969), kronika_fotky(21126)
  -- to event, event_meeting, chonicle_photos

  DELETE FROM akce WHERE id_akce = 122; -- duplicate entry (keep 133)
  DELETE FROM akce WHERE id_akce IN (165, 166, 167); -- quadruple entry (keep 168)
  DELETE FROM akce WHERE id_akce = 254; -- duplicate netry (keep 253)
  -- delete jednu akci z kombinace Běžky/Sjezdovky. Lísteček se stejně nezobrazuje
  -- 139 (keep 138), 141 (keep 140), 143 (keep 142), 172 (keep 171),
  -- 174 (keep 171), 201 (keep 200), 338 (keep 337)
  DELETE FROM akce WHERE id_akce IN (139, 141, 143, 172, 174, 201, 338);
  DELETE FROM akce WHERE id_akce IN (179, 180); -- registration 2007
  -- UPDATE 5 - neni to opravdova schuzka, ma jine parametry
  UPDATE akce SET typ = 'VIP' WHERE (nazev LIKE '%rodič%' OR nazev like '%Rodič%')
    AND typ = 'Schůzka';
  UPDATE akce SET typ = 'Výprava' WHERE id_akce = 60; -- had NULL
  UPDATE akce SET typ = 'Vícedeňka' WHERE id_akce = 61; -- had NULL
  UPDATE akce SET typ = 'Výprava' WHERE id_akce = 121; -- had NULL
  UPDATE akce SET typ = 'Vícedeňka' WHERE id_akce = 123; -- should be the same
  UPDATE akce SET typ = 'VIP' WHERE id_akce = 133; -- rada s radci a podradci
  UPDATE akce SET typ = 'Vícedeňka' WHERE id_akce = 223; -- had Vyprava
  -- ensures chronicle writers
  INSERT IGNORE INTO member (nickname, name, surname, entered) VALUES
  ("Aleš",        "Aleš",     "Kocourek",     1988-09-01),
  ("Monty",       "Jiří",     "Rylich",       1990-09-01),
  ("Mýval",       "Martin",   "Čepela",       1988-09-01),
  ("Polednice",   "Dana",     "Šindelářová",  1983-09-07),
  ("Vítek",       "Vít",      "Bělohradský",  1989-09-01);
  -- fixes messed up chroniclewriter
  UPDATE kronika SET zapsal = "Klíšťák" WHERE zapsal = "Klíšťák a Kim";
  UPDATE kronika SET zapsal = "Zip" WHERE zapsal = "Blesk, Net, Marvin";
  UPDATE kronika SET zapsal = "parsifal" WHERE zapsal = "Honza";
  UPDATE kronika SET zapsal = NULL, zapis = "" WHERE zapsal = "James Kent";
  UPDATE kronika SET zapsal = "Kim" WHERE zapsal = "Kim - Luck";
  UPDATE kronika SET zapsal = "Zip" WHERE zapsal = "Klíšťák a Zip";
  UPDATE kronika SET zapsal = "Zip" WHERE zapsal = "Krab, Chechta, Zip";
  UPDATE kronika SET zapsal = "Zip" WHERE zapsal = "Marvin + Luck";
  UPDATE kronika SET zapsal = "Zip" WHERE zapsal = "Marvin, Net";
  UPDATE kronika SET zapsal = "Zip" WHERE zapsal = "Marvin, Net, Luck";
  UPDATE kronika SET zapsal = "Medvěd" WHERE zapsal = "Medvěd a Vítek";
  UPDATE kronika SET zapsal = "Opic" WHERE zapsal = "Opina";
  UPDATE kronika SET zapsal = "Vítek" WHERE zapsal = "Vítek + Muf";
  UPDATE kronika SET zapsal = "Vítek" WHERE zapsal = "Einstein";
  UPDATE kronika SET zapsal = "Luck" WHERE zapsal = "";
  -- calendar corrections
  UPDATE kalendar SET akce = "Družinovka", poznamka = ""
    WHERE id_kalendar in (430, 425, 290); -- druzinovky zapsane jako schuzky
  UPDATE kalendar SET datum_k = datum_z WHERE id_kalendar = 264; -- simplify
  UPDATE kalendar SET datum_z = 20081121 WHERE id_kalendar = 225; -- simplify
  UPDATE kalendar SET akce = 'VIP' WHERE id_kalendar = 482; -- schuzka pro rodice
  -- kronika corrections
  DELETE FROM kronika WHERE id_kr in (912, 913); -- delete tests
  UPDATE kronika SET typ = 'VIP' WHERE id_kr = 793; -- naborovka
  UPDATE kronika SET navrat = 200606251445 WHERE id_kr = 642; -- correct typo
  UPDATE kronika SET navrat = 201104251400 WHERE id_kr = 910; -- correct typo
  UPDATE kronika set typ = 'Vícedeňka' WHERE id_kr = 155; -- wrong type by date
  -- fixes of non-campatiable entries (makes them connect with akce and kalendar)
  UPDATE kronika SET datum = "20071128", sraz = "200711281700",
    navrat = "200711281830" WHERE id_kr = 691;
  UPDATE kronika SET datum = "20060908", sraz = "200609080800",
    typ = "VIP" WHERE id_kr = 646;
  UPDATE kronika SET navrat = "200907241545" WHERE id_kr = 791;
  UPDATE kronika SET typ = "Schůzka" WHERE id_kr = 1085;
  UPDATE kronika SET typ = "VIP" WHERE id_kr IN (757, 679, 678, 645);
  UPDATE kronika SET typ = "Družinovka"
    WHERE id_kr IN (1054, 1049, 999, 764, 754, 782);
  -- merge over 100 photos event (Tabor 2010)
  UPDATE kronika_fotky SET id_kr = 856, poradi = poradi+99 WHERE id_kr = 855;
  DELETE FROM kronika WHERE id_kr = 855;
  -- merge over 100 photos event (Jarnasy 2011)
  UPDATE kronika_fotky SET id_kr = 896, poradi = poradi+99 WHERE id_kr = 897;
  DELETE FROM kronika WHERE id_kr = 897;
  -- merge over 200 photos event (Tabor 2011)
  UPDATE kronika_fotky SET id_kr = 940, poradi = poradi+99 WHERE id_kr = 941;
  UPDATE kronika_fotky SET id_kr = 940, poradi = poradi+198 WHERE id_kr = 942;
  DELETE FROM kronika WHERE id_kr IN (941, 942);
  -- merge over 200 photos event (Tabor 2012)
  UPDATE kronika_fotky SET id_kr = 994, poradi = poradi+99 WHERE id_kr = 995;
  UPDATE kronika_fotky SET id_kr = 994, poradi = poradi+198 WHERE id_kr = 996;
  DELETE FROM kronika WHERE id_kr IN (995, 996);
  -- merge over 200 photos event (Tabor 2013)
  UPDATE kronika_fotky SET id_kr = 1074, poradi = poradi+99 WHERE id_kr = 1075;
  UPDATE kronika_fotky SET id_kr = 1074, poradi = poradi+198 WHERE id_kr = 1076;
  DELETE FROM kronika WHERE id_kr IN (1075, 1076);
  -- merge over 100 photos event (Podzimky 2008)
  UPDATE kronika_fotky SET id_kr = 730, poradi = poradi+99 WHERE id_kr = 731;
  DELETE FROM kronika WHERE id_kr = 731;
  -- merge over 100 photos event (Tabor 2009)
  UPDATE kronika_fotky SET id_kr = 791, poradi = poradi+99 WHERE id_kr = 792;
  DELETE FROM kronika WHERE id_kr = 792;
  -- try to separate event into 2 part for photos, original still exists (729)
  DELETE FROM kronika_fotky WHERE id_kr IN (730, 731);
  DELETE FROM kronika WHERE id_kr IN (730, 731);
  -- try to separate event into 3 part for photos, original still exists (720)
  DELETE FROM kronika_fotky WHERE id_kr IN (741, 742, 743);
  DELETE FROM kronika_fotky WHERE id_kr = 720 AND poradi BETWEEN 225 AND 316;
  DELETE FROM kronika WHERE id_kr IN (741, 742, 743);
  DELETE FROM kronika WHERE id_kr = 673; -- excesive event

  -- akce(231), kalendar(596), kronika(952), kronika_fotky(20668)

  -- transfer
  DROP TABLE IF EXISTS transfer;
  CREATE TABLE `transfer` (
    `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_kalendar` int(5) unsigned NULL,
    `id_akce` int(5) unsigned NULL,
    `id_kronika` int(5) unsigned NULL,
    `type` varchar(20) COLLATE 'utf8_czech_ci' NULL,
    `year_kalendar` varchar(4) COLLATE 'utf8_czech_ci' NULL,
    `year_akce` varchar(9) COLLATE 'utf8_czech_ci' NULL,
    `year_kronika` varchar(9) COLLATE 'utf8_czech_ci' NULL,
    `yearpart` varchar(10) COLLATE 'utf8_czech_ci' NULL,
    `start_kalendar` varchar(8) COLLATE 'utf8_czech_ci' NULL,
    `start_akce` varchar(12) COLLATE 'utf8_czech_ci' NULL,
    `start_kronika` varchar(12) COLLATE 'utf8_czech_ci' NULL,
    `end_kalendar` varchar(8) COLLATE 'utf8_czech_ci' NULL,
    `end_akce` varchar(12) COLLATE 'utf8_czech_ci' NULL,
    `end_kronika` varchar(12) COLLATE 'utf8_czech_ci' NULL,
    `date_kronika` varchar(8) COLLATE 'utf8_czech_ci' NULL,
    `calendarnote` varchar(100) COLLATE 'utf8_czech_ci' NULL,
    `startplace` varchar(100) COLLATE 'utf8_czech_ci' NULL,
    `name_akce` varchar(100) COLLATE 'utf8_czech_ci' NULL,
    `name_kronika` varchar(30) COLLATE 'utf8_czech_ci' NULL,
    `endplace` varchar(100) COLLATE 'utf8_czech_ci' NULL,
    `note` text COLLATE 'utf8_czech_ci' NULL,
    `calendarleaders` varchar(100) COLLATE 'utf8_czech_ci' NULL,
    `equipment` text COLLATE 'utf8_czech_ci' NULL,
    `text` text COLLATE 'utf8_czech_ci' NULL,
    `route` text COLLATE 'utf8_czech_ci' NULL,
    `members` text COLLATE 'utf8_czech_ci' NULL,
    `stezky` text COLLATE 'utf8_czech_ci' NULL,
    `nalejvarny` text COLLATE 'utf8_czech_ci' NULL,
    `content` text COLLATE 'utf8_czech_ci' NULL,
    `hry` text COLLATE 'utf8_czech_ci' NULL,
    `chroniclewriter` varchar(20) COLLATE 'utf8_czech_ci' NULL,
    `leaders` text COLLATE 'utf8_czech_ci' NULL
  ) COMMENT='' ENGINE='MyISAM' COLLATE 'utf8_czech_ci';
  ALTER TABLE `transfer` ADD `showchronicle` tinyint(1) NOT NULL DEFAULT '0',
  COMMENT='';

  -- MANUAL INSERT FOR INCONSISTENT ENTRY
  UPDATE kalendar SET poznamka = "" WHERE id_kalendar = 133; -- merged event split
  -- INSERT 1 entry
  -- SELECT 1 entry
  INSERT INTO transfer (id_kalendar, id_akce, type, year_kalendar, year_akce,
   yearpart, start_kalendar, start_akce, end_kalendar, end_akce, calendarnote,
   startplace, name_akce, endplace, note, calendarleaders, equipment, text)
  SELECT kalendar.id_kalendar, akce.id_akce, akce.typ, kalendar.rok, akce.sk_rok,
   kalendar.obdobi, kalendar.datum_z, akce.sraz, kalendar.datum_k, akce.navrat,
   kalendar.poznamka, akce.sraz_pozn, akce.nazev, akce.navrat_pozn, akce.poznamka,
   kalendar.vede, akce.sebou, akce.text
  FROM kalendar, akce
  WHERE kalendar.id_kalendar = 133 AND akce.id_akce = 188;
  DELETE FROM kalendar WHERE id_kalendar = 133;
  DELETE FROM akce WHERE id_akce = 188;
  -- INSERT 1 entry
  -- SELECT 1 entry
  INSERT INTO event (id, calendar_id, datestart, dateend, type, calendarnote,
   leaders, name, text, equipment, note, showevent, showchronicle)
  SELECT
   1 as id, calendar.id as calendar_id, transfer.start_kalendar as datestart,
   transfer.end_kalendar as dateend, transfer.type as type,
   transfer.calendarnote as calendarnote, transfer.calendarleaders as leaders,
   transfer.name_akce as name, transfer.text as text,
   transfer.equipment as equipment, transfer.note as note, 1 as showevent,
    0 as showchronicle
  FROM transfer LEFT JOIN calendar
  ON transfer.year_kalendar = calendar.year
   AND transfer.yearpart = calendar.yearpart
  WHERE transfer.yearpart IS NOT NULL AND transfer.id_kalendar IS NOT NULL
    AND transfer.id_akce IS NOT NULL;
  -- INSERT 1 entry
  -- SELECT 1 entry
  INSERT INTO event_meeting (event_id, starttime, endtime, startplace, endplace)
  SELECT 1, CONCAT(start_akce, "00"), CONCAT(end_akce, "00"), startplace,
  endplace FROM transfer;
  TRUNCATE TABLE transfer;


  -- akce(230), kalendar(595), kronika(952), kronika_fotky(20668)

  -- events that have calendar entry, event entry and chronicle entry
  -- SELECT 199
  -- INSERT 199
  INSERT INTO transfer (id_kalendar, id_akce, id_kronika, type, year_kalendar,
    year_akce, year_kronika, yearpart, start_kalendar, start_akce, start_kronika,
    end_kalendar, end_akce, end_kronika, date_kronika, calendarnote, startplace,
    name_akce, name_kronika, endplace, note, calendarleaders, equipment, text,
    route, members, stezky, nalejvarny, content, hry, chroniclewriter, leaders,
    showchronicle)
  SELECT kalendar.id_kalendar, akce.id_akce, kronika.id_kr, akce.typ,
   kalendar.rok, akce.sk_rok, kronika.sk_rok, kalendar.obdobi, kalendar.datum_z,
   akce.sraz, kronika.sraz, kalendar.datum_k, akce.navrat, kronika.navrat,
   kronika.datum, kalendar.poznamka, akce.sraz_pozn, akce.nazev, kronika.nazev,
   akce.navrat_pozn, akce.poznamka, kalendar.vede, akce.sebou, akce.text,
   kronika.trasa, kronika.clenove, kronika.stezky, kronika.nalejvarny,
   kronika.zapis, kronika.hry, kronika.zapsal,
   CONCAT_WS(', ', kronika.vedouci, kronika.vedarov),
   kronika.zobrazit
  FROM akce, kronika, kalendar
  WHERE SUBSTR(akce.sraz, 1, 8) = SUBSTR(kronika.sraz, 1, 8)
   AND SUBSTR(akce.navrat, 1, 8) = SUBSTR(kronika.navrat, 1, 8)
   AND kalendar.datum_z = SUBSTR(akce.sraz, 1, 8)
   AND kalendar.datum_k = SUBSTR(akce.navrat, 1, 8) AND akce.typ = kronika.typ
   AND kalendar.id_kalendar <> 264;

  -- SPLIT_STR: http://blog.fedecarg.com/2009/02/22/mysql-split-string-function/
  DROP FUNCTION IF EXISTS SPLIT_STR;
  CREATE FUNCTION SPLIT_STR(
    x VARCHAR(255),
    delim VARCHAR(12),
    pos INT
  )
    RETURNS VARCHAR(255)
    RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
      CHAR_LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),delim, '');

  -- Event Insert
  -- SELECT 199
  -- INSERT 199
  INSERT INTO event (id, calendar_id, datestart, dateend, type, calendarnote,
    leaders, name, text, equipment, note, chroniclewriter, route, rangers, mloci,
    tucnaci, novacci, content, showevent, showchronicle)
  SELECT
   transfer.id_kronika as id, calendar.id as calendar_id,
   transfer.start_kalendar as datestart, transfer.end_kalendar as dateend,
   transfer.type as type, transfer.calendarnote as calendarnote,
   transfer.calendarleaders as leaders, transfer.name_akce as name,
   transfer.text as text, transfer.equipment as equipment, transfer.note as note,
   transfer.chroniclewriter as chroniclewriter, transfer.route as route,
   transfer.leaders as rangers,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 1), ":", 2)), "<br/>", 1) as mloci,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 2), ":", 2)), "<br/>", 1) as tucnaci,
   LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 3), "ováčci:", 2)) as novacci,
   transfer.content as content, 1 as showevent, transfer.showchronicle as showchronicle
  FROM transfer LEFT JOIN calendar
  ON transfer.year_kalendar = calendar.year
   AND transfer.yearpart = calendar.yearpart
  WHERE transfer.yearpart IS NOT NULL AND transfer.id_kalendar IS NOT NULL
    AND transfer.id_akce IS NOT NULL AND transfer.id_kronika IS NOT NULL;

  -- PHOTOS INSERT
  -- SELECT 9596
  -- INSERT 9596
  INSERT INTO `chronicle_photos` (`id`, `event_id`, `order`, `text`, `intro`)
  SELECT `id_foto` as `id`, `id_kr` as `event_id`, `poradi` as `order`,
  `text` as `text`, `fotoprvni` as `intro` FROM `kronika_fotky`
  WHERE id_kr IN (SELECT id_kronika FROM transfer);

  -- Meeting insert
  -- SELECT 199
  -- INSERT 199
  INSERT INTO event_meeting (event_id, starttime, endtime, startplace, endplace)
  SELECT id_kronika, CONCAT(start_akce, "00"), CONCAT(end_akce, "00"),
   startplace, endplace FROM transfer;

  -- clean up tables after the insert
  DELETE FROM akce WHERE akce.id_akce IN (SELECT transfer.id_akce FROM transfer);
  DELETE FROM kronika WHERE kronika.id_kr IN
    (SELECT transfer.id_kronika FROM transfer);
  DELETE FROM kalendar WHERE kalendar.id_kalendar IN
    (SELECT transfer.id_kalendar FROM transfer);
  TRUNCATE TABLE transfer;

  -- akce(32), kalendar(397), kronika(753), kronika_fotky(20668)

  -- akce, ktere maji zapis z kroniky, ale nemaji zapis do kalendar
  -- musi se kalendar manualne dodedukovat z ostatnich informaci
  -- SELECT 2
  -- INSERT 2
  INSERT INTO transfer (id_akce, id_kronika, type, year_akce, year_kronika,
    start_akce, start_kronika, end_akce, end_kronika, date_kronika, startplace,
    name_akce, name_kronika, endplace, note, equipment, text, route, members,
    stezky, nalejvarny, content, hry, chroniclewriter, leaders, showchronicle)
  SELECT
   akce.id_akce, kronika.id_kr, akce.typ, akce.sk_rok, kronika.sk_rok, akce.sraz,
   kronika.sraz, akce.navrat, kronika.navrat, kronika.datum, akce.sraz_pozn,
   akce.nazev, kronika.nazev, akce.navrat_pozn, akce.poznamka, akce.sebou,
   akce.text, kronika.trasa, kronika.clenove, kronika.stezky, kronika.nalejvarny,
   kronika.zapis, kronika.hry, kronika.zapsal,
   CONCAT_WS(', ', kronika.vedouci, kronika.vedarov), kronika.zobrazit
  FROM akce, kronika
  WHERE SUBSTR(akce.sraz, 1, 8) = SUBSTR(kronika.sraz, 1, 8)
   AND SUBSTR(akce.navrat, 1, 8) = SUBSTR(kronika.navrat, 1, 8)
   AND akce.typ = kronika.typ;

  -- insert event
  -- SELECT 2
  -- INSERT 2
  INSERT INTO event (id, calendar_id, datestart, dateend, type, name, text,
    equipment, note, chroniclewriter, route, rangers, mloci, tucnaci, novacci,
    content, showevent, showchronicle)
  SELECT
   transfer.id_kronika as id, calendar.id as calendar_id,
   SUBSTR(transfer.start_akce, 1, 8) as datestart,
   SUBSTR(transfer.end_akce, 1, 8) as dateend, transfer.type as type,
   transfer.name_kronika as name, transfer.text as text,
   transfer.equipment as equipment, transfer.note as note,
   transfer.chroniclewriter as chroniclewriter, transfer.route as route,
   transfer.leaders as rangers,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 1), ":", 2)), "<br/>", 1) as mloci,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 2), ":", 2)), "<br/>", 1) as tucnaci,
   LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 3), "ováčci:", 2)) as novacci,
   transfer.content as content, 1 as showevent,
   transfer.showchronicle as showchronicle
  FROM transfer LEFT JOIN calendar
  ON SUBSTR(date_kronika, 1, 4) = calendar.year AND CASE
    WHEN CAST(SUBSTR(date_kronika, 5, 2) AS UNSIGNED)>7 THEN "podzim"
    WHEN CAST(SUBSTR(date_kronika, 5, 2) AS UNSIGNED)<8 THEN "jaro"
   END = calendar.yearpart
  WHERE transfer.id_kronika IS NOT NULL AND transfer.id_akce IS NOT NULL;

  -- Photos
  -- SELECT 27
  -- INSERT 27
  INSERT INTO `chronicle_photos` (`id`, `event_id`, `order`, `text`, `intro`)
  SELECT `id_foto` as `id`, `id_kr` as `event_id`, `poradi` as `order`,
  `text` as `text`, `fotoprvni` as `intro` FROM `kronika_fotky`
  WHERE id_kr IN (SELECT id_kronika FROM transfer);

  -- Meetings
  -- SELECT 2
  -- INSERT 2
  INSERT INTO event_meeting (event_id, starttime, endtime, startplace, endplace)
  SELECT id_kronika, CONCAT(start_akce, "00"), CONCAT(end_akce, "00"),
   startplace, endplace FROM transfer;

  -- clean up tables after the insert
  DELETE FROM akce WHERE akce.id_akce IN (SELECT transfer.id_akce FROM transfer);
  DELETE FROM kronika WHERE kronika.id_kr IN
    (SELECT transfer.id_kronika FROM transfer);
  TRUNCATE TABLE transfer;

  -- akce(30), kalendar(397), kronika(751), kronika_fotky(20668)

  -- kalendarni akce, co maji kroniku, ale nemaji listecek na akci
  -- obvykle se jedna o schuzky, tabor, smrk atd.
  -- SELECT 273
  -- INSERT 273
  INSERT INTO transfer (id_kalendar, id_kronika, type, year_kalendar,
    year_kronika, yearpart, start_kalendar, start_kronika, end_kalendar,
    end_kronika, date_kronika, calendarnote, name_kronika, calendarleaders,
    route, members, stezky, nalejvarny, content, hry, chroniclewriter, leaders,
    showchronicle)
  SELECT
   kalendar.id_kalendar, kronika.id_kr, kronika.typ, kalendar.rok, kronika.sk_rok,
   kalendar.obdobi, kalendar.datum_z, kronika.sraz, kalendar.datum_k,
   kronika.navrat, kronika.datum, kalendar.poznamka, kronika.nazev, kalendar.vede,
   kronika.trasa, kronika.clenove, kronika.stezky, kronika.nalejvarny,
   kronika.zapis, kronika.hry, kronika.zapsal,
   CONCAT_WS(', ', kronika.vedouci, kronika.vedarov), kronika.zobrazit
  FROM kronika, kalendar
  WHERE kalendar.datum_z = SUBSTR(kronika.sraz, 1, 8)
   AND kalendar.datum_k = SUBSTR(kronika.navrat, 1, 8)
   AND kalendar.akce = kronika.typ;

  -- insert event
  -- SELECT 273
  -- INSERT 273
  INSERT INTO event (id, calendar_id, datestart, dateend, type, calendarnote,
    name, chroniclewriter, route, rangers, mloci, tucnaci, novacci, content,
    showevent, showchronicle)
  SELECT
   transfer.id_kronika as id, calendar.id as calendar_id,
   transfer.start_kalendar as datestart, transfer.end_kalendar as dateend,
   transfer.type as type, transfer.calendarnote as calendarnote,
   transfer.name_kronika as name, transfer.chroniclewriter as chroniclewriter,
   transfer.route as route, transfer.leaders as rangers,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 1), ":", 2)), "<br/>", 1) as mloci,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 2), ":", 2)), "<br/>", 1) as tucnaci,
   LTRIM(SPLIT_STR(SPLIT_STR(transfer.members, "<br />", 3), "ováčci:", 2)) as novacci,
   transfer.content as content, 0 as showevent, transfer.showchronicle as showchronicle
  FROM transfer
  LEFT JOIN calendar ON transfer.year_kalendar = calendar.year
   AND transfer.yearpart = calendar.yearpart
  WHERE transfer.yearpart IS NOT NULL AND transfer.id_kalendar IS NOT NULL
    AND transfer.id_kronika IS NOT NULL;

  -- insert photos
  -- SELECT 7087
  -- INSERT 7087
  INSERT INTO `chronicle_photos` (`id`, `event_id`, `order`, `text`, `intro`)
  SELECT `id_foto` as `id`, `id_kr` as `event_id`, `poradi` as `order`,
  `text` as `text`, `fotoprvni` as `intro` FROM `kronika_fotky`
  WHERE id_kr IN (SELECT id_kronika FROM transfer);
  -- clean up tables after the insert
  DELETE FROM kronika WHERE kronika.id_kr IN
    (SELECT transfer.id_kronika FROM transfer);
  DELETE FROM kalendar WHERE kalendar.id_kalendar IN
    (SELECT transfer.id_kalendar FROM transfer);
  TRUNCATE TABLE transfer;

  -- akce(30), kalendar(127), kronika(478), kronika_fotky(20668)

  -- kronika leftover - 478 zaznamu
  INSERT INTO event (id, calendar_id, datestart, dateend, type, name,
   chroniclewriter, route, content, rangers, mloci, tucnaci, novacci, showevent,
   showchronicle)
  SELECT kronika.id_kr as id, calendar.id as calendar_id,
   SUBSTR(kronika.sraz, 1, 8) as datestart,
   SUBSTR(kronika.navrat, 1, 8) as dateend, kronika.typ as type,
   kronika.nazev as name, kronika.zapsal as chroniclewriter,
   kronika.trasa as route, kronika.zapis as content,
   CONCAT_WS(', ', kronika.vedouci, kronika.vedarov) as rangers,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(kronika.clenove, "<", 1), ":", 2)), "<", 1) as mloci,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(kronika.clenove, ">", 2), ":", 2)), "<", 1) as tucnaci,
   SPLIT_STR(LTRIM(SPLIT_STR(SPLIT_STR(kronika.clenove, ">", 3), "ováčci:", 2)), "<", 1) as novacci,
   0 as showevent,
   kronika.zobrazit as showchronicle
  FROM kronika LEFT JOIN calendar ON SUBSTR(datum, 1, 4) = calendar.year AND CASE
   WHEN CAST(SUBSTR(datum, 5, 2) AS UNSIGNED)>7 THEN "podzim"
   WHEN CAST(SUBSTR(datum, 5, 2) AS UNSIGNED)<8 THEN "jaro"
   END = calendar.yearpart;

  -- SELECT 3551
  INSERT INTO `chronicle_photos` (`id`, `event_id`, `order`, `text`, `intro`)
  SELECT `id_foto` as `id`, `id_kr` as `event_id`, `poradi` as `order`,
  `text` as `text`, `fotoprvni` as `intro` FROM `kronika_fotky`
  WHERE id_kr IN (SELECT id_kr FROM kronika);
  TRUNCATE TABLE kronika;

  -- akce(30), kalendar(127), kronika(0), kronika_fotky(20668)

  -- Akce co jsou jak v kalendari, tak maji pozvanku, ale nikdy z nich nebyla
  -- vytvorena kronika
  -- SELECT 5
  -- INSERT 5
  INSERT INTO transfer (id_kalendar, id_akce, type, year_kalendar, year_akce,
    yearpart, start_kalendar, start_akce, end_kalendar, end_akce, calendarnote,
    startplace, name_akce, endplace, note, calendarleaders, equipment, text)
  SELECT
   kalendar.id_kalendar, akce.id_akce, akce.typ, kalendar.rok, akce.sk_rok,
   kalendar.obdobi, kalendar.datum_z, akce.sraz, kalendar.datum_k, akce.navrat,
   kalendar.poznamka, akce.sraz_pozn, akce.nazev, akce.navrat_pozn, akce.poznamka,
   kalendar.vede, akce.sebou, akce.text
  FROM kalendar, akce
  WHERE kalendar.datum_z = SUBSTR(akce.sraz, 1, 8)
   AND kalendar.datum_k = SUBSTR(akce.navrat, 1, 8) AND kalendar.akce = akce.typ;

  -- insert event
  -- SELECT 5
  -- INSERT 5
  INSERT INTO event (calendar_id, datestart, dateend, type, calendarnote,
    leaders, name, text, equipment, note, showevent, showchronicle)
  SELECT calendar.id as calendar_id, transfer.start_kalendar as datestart,
   transfer.end_kalendar as dateend, transfer.type as type,
   transfer.calendarnote as calendarnote, transfer.calendarleaders as leaders,
   transfer.name_akce as name, transfer.text as text,
   transfer.equipment as equipment, transfer.note as note, 1 as showevent,
   0 as showchronicle
  FROM transfer LEFT JOIN calendar
  ON transfer.year_kalendar = calendar.year
    AND transfer.yearpart = calendar.yearpart
  WHERE transfer.yearpart IS NOT NULL AND transfer.id_kalendar IS NOT NULL
    AND transfer.id_akce IS NOT NULL;

  -- backselect, to get ids for event_meeting,
  -- SELECT 5
  -- INSERT 5
  INSERT INTO event_meeting (event_id, starttime, endtime, startplace, endplace)
  SELECT event.id, CONCAT(transfer.start_akce, "00"),
   CONCAT(transfer.end_akce, "00"), transfer.startplace, transfer.endplace
  FROM event, transfer WHERE event.datestart = transfer.start_kalendar
   AND event.dateend = transfer.end_kalendar AND event.type = transfer.type
   AND transfer.yearpart IS NOT NULL AND transfer.id_kalendar IS NOT NULL
   AND transfer.id_kronika IS NULL AND transfer.id_akce IS NOT NULL;

  -- clean up tables after the insert
  DELETE FROM akce WHERE akce.id_akce IN (SELECT transfer.id_akce FROM transfer);
  DELETE FROM kalendar WHERE kalendar.id_kalendar IN
    (SELECT transfer.id_kalendar FROM transfer);
  TRUNCATE TABLE transfer;

  -- akce(25), kalendar(122), kronika(0), kronika_fotky(20668)


  -- kalendar leftover - 122 zaznamu
  INSERT INTO event (calendar_id, datestart, dateend, type, calendarnote, leaders)
  SELECT calendar.id as calendar_id, kalendar.datum_z as datestart,
   kalendar.datum_k as dateend, kalendar.akce as type,
   kalendar.poznamka as calendarnote, kalendar.vede as leaders
  FROM kalendar LEFT JOIN calendar
  ON kalendar.rok = calendar.year AND kalendar.obdobi = calendar.yearpart;
  TRUNCATE TABLE kalendar;

  -- akce leftover - 20 zaznamu - more of a news
  -- are delt with in news.sql, since they need the IDs first
