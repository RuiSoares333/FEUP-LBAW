SET search_path TO lbaw2286;

CREATE FUNCTION update_news_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN            
    IF (NEW.is_liked) THEN
        UPDATE news
        SET reputation = reputation+2
        WHERE id = NEW.id_news;

        UPDATE users
        SET reputation = reputation+2
        WHERE id = (
            SELECT id_author FROM news WHERE id = NEW.id_news
        );
    ELSE
        UPDATE news
        SET reputation = reputation-2
        WHERE id = NEW.id_news;

        UPDATE users
        SET reputation = reputation-2
        WHERE id = (
            SELECT id_author FROM news WHERE id = NEW.id_news
        );
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_news_reputation
    AFTER UPDATE ON news_vote FOR EACH ROW
    EXECUTE PROCEDURE update_news_reputation();
