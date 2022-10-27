SET search_path TO lbaw2286;

CREATE FUNCTION update_comment_reputation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (NEW.is_liked) THEN
        UPDATE comment
        SET reputation = reputation+2
        WHERE id = NEW.id_comment;
    ELSE
        UPDATE comment
        SET reputation = reputation-2
        WHERE id = NEW.id_comment;
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_comment_reputation
    AFTER UPDATE ON comment_vote FOR EACH ROW
    EXECUTE PROCEDURE update_comment_reputation();
