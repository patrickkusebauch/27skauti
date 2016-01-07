-- partially fills user table from prava table
--
-- all of those users will be dead users as they have no e-mail
-- the e-mail will be filled for essential users and for non essetial
-- the users will be deleted
--
-- ingnores 7 diplicate entries of non-essential users

INSERT IGNORE INTO `user` (`id`, `username`, `password`, `active`)
SELECT
  `id_prava` as `id`,
  `prezd` as `username`,
  `heslo` as `password`,
  0 as `active`
FROM `prava`;