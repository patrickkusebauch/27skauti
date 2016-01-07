INSERT INTO news
SELECT
 aktuality.id_aktuality,
 aktuality.id_spol,
 aktuality.sekce,
 SUBSTR(aktuality.edit, 1, 8),
 aktuality.special,
 aktuality.text,
 aktuality.zobrazit
FROM aktuality
WHERE aktuality.id_spol IN (SELECT id FROM event);

DELETE FROM aktuality
WHERE aktuality.id_aktuality IN (SELECT id FROM news);

INSERT INTO news (id, type, posted, heading, content, `show`)
SELECT
 aktuality.id_aktuality,
 aktuality.sekce,
 SUBSTR(aktuality.edit, 1, 8),
 aktuality.special,
 aktuality.text,
 aktuality.zobrazit
FROM aktuality;

DELETE FROM news WHERE news.show = 1;
UPDATE news SET news.show = 1 WHERE news.show = 2;

-- akce leftover - 20 zaznamu - more of a news
DELETE FROM akce where id_akce = 168;
INSERT INTO news (type, heading, content, posted)
  SELECT
    "Zpráva",
    akce.nazev,
    akce.text,
    akce.dnes
  FROM akce;
TRUNCATE TABLE akce;