-- cleans up after transfering databases
-- deletes tables from the old database

DELETE FROM `privilege` WHERE `user_id` IN
    (SELECT `id` FROM `user` WHERE `id` NOT IN
        (SELECT `user_id` FROM `member` WHERE `user_id` IS NOT NULL)
    );

DELETE FROM `user` WHERE `id` NOT IN
        (SELECT `user_id` FROM `member` WHERE `user_id` IS NOT NULL);

DROP TABLE IF EXISTS `akce`;
DROP TABLE IF EXISTS `aktuality`;
DROP TABLE IF EXISTS `cleny`;
DROP TABLE IF EXISTS `kalendar`;
DROP TABLE IF EXISTS `kniha_navstev`;
DROP TABLE IF EXISTS `kronika`;
DROP TABLE IF EXISTS `kronika_fotky`;
DROP TABLE IF EXISTS `online`;
DROP TABLE IF EXISTS `prava`;
DROP TABLE IF EXISTS `reg_podklady`;
DROP TABLE IF EXISTS `transfer`;


-- start creating foreing keys
INSERT INTO `user` (`id`, `username`)
SELECT user_id as id,
  nickname as username
FROM `member` WHERE `user_id` NOT IN (SELECT `id` FROM `user`);

ALTER TABLE `chronicle_photos`
ADD FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `chronicle_videos`
ADD FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `event`
ADD FOREIGN KEY (`chroniclewriter`) REFERENCES `member` (`nickname`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `event`
ADD FOREIGN KEY (`contactperson`) REFERENCES `member` (`nickname`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `event_meeting`
ADD FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `guestbook`
ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `member`
ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `news`
ADD FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `privilege`
ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `registration`
ADD FOREIGN KEY (`member_nickname`) REFERENCES `member` (`nickname`) ON DELETE RESTRICT ON UPDATE RESTRICT;