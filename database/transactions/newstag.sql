SET search_path TO lbaw2286;

BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

-- Insert news
INSERT INTO news (title, content, picture, id_author)
 VALUES ($title, $content, $picture, $id_author);

-- Insert news_tag
INSERT INTO news_tag (id_news, id_tag)
 VALUES (currval('news_id_seq'), $id_tag);

END TRANSACTION;