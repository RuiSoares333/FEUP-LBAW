SET search_path TO lbaw2286;

CREATE FUNCTION remove_news_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (OLD.is_liked) THEN
        UPDATE news
        SET reputation = reputation-1
        WHERE id = OLD.id_news;
    ELSE
        UPDATE news
        SET reputation = reputation+1
        WHERE id = OLD.id_news;
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_news_reputation
    BEFORE DELETE ON news_vote
    EXECUTE PROCEDURE remove_news_reputation();
