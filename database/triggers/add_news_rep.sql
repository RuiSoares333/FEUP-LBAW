SET search_path TO lbaw2286;

CREATE FUNCTION add_news_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (NEW.is_liked) THEN
        UPDATE news
        SET reputation = reputation+1
        WHERE id = NEW.id_news;
    ELSE
        UPDATE news
        SET reputation = reputation-1
        WHERE id = NEW.id_news;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_news_reputation
    AFTER INSERT ON news_vote FOR EACH ROW
    EXECUTE PROCEDURE add_news_reputation();
