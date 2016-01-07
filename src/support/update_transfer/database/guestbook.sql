--  Pro pihlasene uzivatele
INSERT IGNORE INTO `guestbook` (`id`,  `user_id`, `post`, `time`, `web`, `show`)
SELECT 
`kniha_navstev`.`id_kniha` as `id`,
`member`.`user_id` as `user_id`,
`kniha_navstev`.`vzkaz` as `post`,
`kniha_navstev`.`timestamp` as `time`,
`kniha_navstev`.`web` as `web`,
`kniha_navstev`.`zobrazit` as `show`
FROM `kniha_navstev`, `member`
  WHERE `kniha_navstev`.`potvrdit` = '1'
  AND `kniha_navstev`.`jmeno` = `member`.`nickname`;

-- Zkopiruje knihu navstev pro neprihlasene uzivatele
INSERT IGNORE INTO `guestbook` (`id`, `name`, `post`, `time`, `mail`, `web`, `show`)
SELECT 
`id_kniha` as `id`,
`jmeno` as `name`,
`vzkaz` as `post`,
`timestamp` as `time`,
`email` as `mail`,
`web` as `web`,
`zobrazit` as `show`
FROM `kniha_navstev` WHERE `potvrdit` = '0';
  
-- 1 means deleted post by admin
DELETE FROM guestbook WHERE guestbook.show = 1;
-- 2 means visible posts
UPDATE guestbook SET guestbook.show = 1 WHERE guestbook.show = 2;