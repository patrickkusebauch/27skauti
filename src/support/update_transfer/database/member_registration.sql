-- populates table member and registration
-- read from prava(110), reg_podklady(125) and cleny(110)
--
-- both cleny and prava have the same amount of rows (namely 110), and 
-- `id_clena` correspond prefectly with `id_prava`


START TRANSACTION;
BEGIN;
-- clean tables for transaction
SET foreign_key_checks = 0;
TRUNCATE TABLE `member`;
TRUNCATE TABLE `registration`;
DROP TABLE IF EXISTS `transfer`;

-- create Transfer table
CREATE TABLE `transfer` (
  `user_id` int(10) unsigned NULL,
  `nickname` varchar(20) NOT NULL,
  `title` varchar(15) NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `group` varchar(40) NOT NULL,
  `stripe` varchar(20) NULL,
  `entered` date NOT NULL,
  `note` text NULL,
  `birth_date` date NOT NULL,
  `oddil` smallint(2) NOT NULL,
  `address` tinytext NULL
) COMMENT='';

-- add constrains
ALTER TABLE `transfer` ADD UNIQUE `nickname` (`nickname`);
ALTER TABLE `transfer` ADD UNIQUE `user_id` (`user_id`);

-- get data for tranfer table (members with registration)
-- for people with records in cleny, reg_podklady and prava
-- SELECTS 43 entries
-- INSERTS 43 entries
INSERT INTO `transfer`(`user_id`, `oddil`, `nickname`, `title`, `name`, `surname`, `entered`, `note`, `address`, `birth_date`, `group`, `stripe`)
SELECT
`cleny`.`id_clena` as `user_id`,
`cleny`.`oddil` as `oddil`,
`cleny`.`prezdivka` as `nickname`,
`cleny`.`titul` as `title`,
`cleny`.`jmeno` as `name`,
`cleny`.`prijmeni` as `surname`,
`cleny`.`vstup` as `entered`,
`cleny`.`poznamka` as `note`,
CONCAT_WS('\n', `reg_podklady`.`Adresa - Ulice`, 
  `reg_podklady`.`Adresa - Místo`,
  `reg_podklady`.`Adresa - PSČ`) as `address`,
CONCAT_WS('-', SUBSTR(`cleny`.`rc`, 1, 2),  -- year
  CASE WHEN SUBSTR(`cleny`.`rc`, 3, 2)>50 -- is it female
    THEN SUBSTR(`cleny`.`rc`, 3, 2)-50    -- month for female
    ELSE SUBSTR(`cleny`.`rc`, 3, 2) END,  -- month for male
  SUBSTR(`cleny`.`rc`, 5, 2)) as `birth_date`, -- day as 'yy-mm-dd'
CASE
 WHEN `prava`.`status` = 000000000001 THEN "jiný oddíl"
 WHEN `prava`.`status` = 000000000010 THEN "nečlen"
 WHEN `prava`.`status` = 000000000100 THEN "nováček"
 WHEN `prava`.`status` = 000000001000 THEN "tučňák"
 WHEN `prava`.`status` = 000000010000 THEN "mlok"
 WHEN `prava`.`status` = 000000101000 THEN "podrádce, tučňák"
 WHEN `prava`.`status` = 000000110000 THEN "podrádce, mlok"
 WHEN `prava`.`status` = 000001001000 THEN "rádce, tučňák"
 WHEN `prava`.`status` = 000001010000 THEN "rádce, mlok"
 WHEN `prava`.`status` = 000010000000 THEN "oldskaut"
 WHEN `prava`.`status` = 000100000000 THEN "rover"
 WHEN `prava`.`status` = 001000000000 THEN "rádce oddílové družiny, rover"
 WHEN `prava`.`status` = 010000000000 THEN "zástupce vedoucího"
 WHEN `prava`.`status` = 100000000000 THEN "vedoucí oddílu"
END as `group`,
CASE
 WHEN `prava`.`status` = 000000101000 THEN "podradce.gif"
 WHEN `prava`.`status` = 000000110000 THEN "podradce.gif"
 WHEN `prava`.`status` = 000001001000 THEN "radce.gif"
 WHEN `prava`.`status` = 000001010000 THEN "radce.gif"
 WHEN `prava`.`status` = 000100000000 THEN "rover.gif"
 WHEN `prava`.`status` = 001000000000 THEN "radce_oddilu.gif"
 WHEN `prava`.`status` = 010000000000 THEN "zastupce.gif"
 WHEN `prava`.`status` = 100000000000 THEN "vedouci.gif"
END as `stripe`
FROM `cleny`, `reg_podklady`, `prava`
WHERE `prava`.`id_prava` = `cleny`.`id_clena` 
  AND `prava`.`id_prava` = `reg_podklady`.`Reg.č.`
  AND `cleny`.`id_clena` = `reg_podklady`.`Reg.č.`;

-- get data for transfer table (members without registration)
-- for people with records in cleny and prava
-- ignores duplicate entries
-- SELECTS 67 entries
-- INSERTS 60 entries
-- DUPLICATES 7 - expected based on user.sql
INSERT IGNORE INTO `transfer`(`user_id`, `nickname`, `title`, `name`, `surname`, `entered`, `note`, `group`, `stripe`) 
SELECT
`cleny`.`id_clena` as `user_id`,
`cleny`.`prezdivka` as `nickname`,
`cleny`.`titul` as `title`,
`cleny`.`jmeno` as `name`,
`cleny`.`prijmeni` as `surname`,
`cleny`.`vstup` as `entered`,
`cleny`.`poznamka` as `note`,
CASE
 WHEN `prava`.`status` = 000000000001 THEN "jiný oddíl"
 WHEN `prava`.`status` = 000000000010 THEN "nečlen"
 WHEN `prava`.`status` = 000000000100 THEN "nováček"
 WHEN `prava`.`status` = 000000001000 THEN "tučňák"
 WHEN `prava`.`status` = 000000010000 THEN "mlok"
 WHEN `prava`.`status` = 000000101000 THEN "podrádce, tučňák"
 WHEN `prava`.`status` = 000000110000 THEN "podrádce, mlok"
 WHEN `prava`.`status` = 000001001000 THEN "rádce, tučňák"
 WHEN `prava`.`status` = 000001010000 THEN "rádce, mlok"
 WHEN `prava`.`status` = 000010000000 THEN "oldskaut"
 WHEN `prava`.`status` = 000100000000 THEN "rover"
 WHEN `prava`.`status` = 001000000000 THEN "rádce oddílové družiny, rover"
 WHEN `prava`.`status` = 010000000000 THEN "zástupce vedoucího"
 WHEN `prava`.`status` = 100000000000 THEN "vedoucí oddílu"
END as `group`,
CASE
 WHEN `prava`.`status` = 000000101000 THEN "podradce.gif"
 WHEN `prava`.`status` = 000000110000 THEN "podradce.gif"
 WHEN `prava`.`status` = 000001001000 THEN "radce.gif"
 WHEN `prava`.`status` = 000001010000 THEN "radce.gif"
 WHEN `prava`.`status` = 000100000000 THEN "rover.gif"
 WHEN `prava`.`status` = 001000000000 THEN "radce_oddilu.gif"
 WHEN `prava`.`status` = 010000000000 THEN "zastupce.gif"
 WHEN `prava`.`status` = 100000000000 THEN "vedouci.gif"
END as `stripe`
FROM `cleny`, `prava`
WHERE `cleny`.`id_clena` NOT IN (SELECT `transfer`.`user_id` FROM `transfer`)
  AND `cleny`.`id_clena` = `prava`.`id_prava`;
  
-- right now there are 103 entries in `transfer`
UPDATE transfer SET nickname = "parsifal" WHERE nickname = "Honzík";

-- INSERT 103 entries
INSERT INTO `member` (`user_id`, `nickname`, `title`, `name`, `surname`, `entered`, `note`, `group`, `stripe`)
SELECT
`transfer`.`user_id`,
`transfer`.`nickname`,
`transfer`.`title`,
`transfer`.`name`,
`transfer`.`surname`,
`transfer`.`entered`,
`transfer`.`note`,
`transfer`.`group`,
`transfer`.`stripe`
FROM `transfer`;

-- INSERT 43 entries
INSERT INTO `registration` (`member_nickname`, `oddil`, `birth_date`, `address`)
SELECT
`transfer`.`nickname`,
`transfer`.`oddil`,
`transfer`.`birth_date`,
`transfer`.`address`
FROM `transfer`
WHERE `transfer`.`address` IS NOT NULL;

-- drop transfer table
DROP TABLE  `transfer`;

COMMIT;