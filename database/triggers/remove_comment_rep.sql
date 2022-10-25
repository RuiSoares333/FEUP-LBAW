SET search_path TO lbaw2286;

CREATE FUNCTION remove_comment_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (OLD.is_liked) THEN
        UPDATE comment
        SET reputation = reputation-1
        WHERE id = OLD.id_comment;
    ELSE
        UPDATE news
        SET reputation = reputation+1
        WHERE id = OLD.id_news;
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_comment_reputation
    BEFORE DELETE ON comment_vote
    EXECUTE PROCEDURE remove_comment_reputation();
