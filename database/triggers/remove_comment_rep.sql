SET search_path TO lbaw2286;

CREATE FUNCTION remove_comment_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (OLD.is_liked) THEN
        UPDATE comment
        SET reputation = reputation-1
        WHERE id = OLD.id_comment;

        UPDATE users
        SET reputation = reputation-1
        WHERE id = (
            SELECT id_author FROM comment WHERE id = NEW.id_comment
        );
    ELSE
        UPDATE comment
        SET reputation = reputation+1
        WHERE id = OLD.id_comment;

        UPDATE users
        SET reputation = reputation+1
        WHERE id = (
            SELECT id_author FROM comment WHERE id = NEW.id_comment
        );
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_comment_reputation
    BEFORE DELETE ON comment_vote FOR EACH ROW
    EXECUTE PROCEDURE remove_comment_reputation();
