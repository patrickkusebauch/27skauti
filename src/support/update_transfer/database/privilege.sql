-- fill privilege table based on user table
-- everybody has the minimal privileges

INSERT INTO `privilege` (`user_id`, `base`)
SELECT `id`, "člen"
FROM `user`