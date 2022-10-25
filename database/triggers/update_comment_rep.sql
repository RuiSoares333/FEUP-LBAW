SET search_path TO lbaw2286;

CREATE FUNCTION add_comment_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (NEW.is_liked) THEN
        UPDATE comment
        SET reputation = reputation+2
        WHERE id = NEW.id_comment;
    ELSE
        UPDATE news
        SET reputation = reputation-2
        WHERE id = NEW.id_news;
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_comment_reputation
    AFTER UPDATE ON comment_vote
    EXECUTE PROCEDURE add_comment_reputation();
