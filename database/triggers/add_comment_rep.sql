SET search_path TO lbaw2286;

CREATE FUNCTION add_comment_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (NEW.is_liked) THEN
        UPDATE comment
        SET reputation = reputation+1
        WHERE id = NEW.id_comment;

        UPDATE users
        SET reputation = reputation+1
        WHERE id = (
            SELECT id_author FROM comment WHERE id = NEW.id_comment
        );
    ELSE
        UPDATE comment
        SET reputation = reputation-1
        WHERE id = NEW.id_comment;

        UPDATE users
        SET reputation = reputation-1
        WHERE id = (
            SELECT id_author FROM comment WHERE id = NEW.id_comment
        );
        
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_comment_reputation
    AFTER INSERT ON comment_vote FOR EACH ROW
    EXECUTE PROCEDURE add_comment_reputation();
