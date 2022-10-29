SET search_path TO lbaw2286;

CREATE FUNCTION delete_comment() RETURNS TRIGGER AS
$BODY$
BEGIN
       IF EXISTS (SELECT * FROM comment WHERE id_comment = OLD.id ) THEN
            RAISE EXCEPTION 'You cant delete a comment with comments in it';
    END IF;
        IF NOT (OLD.reputation = 0) THEN 
            RAISE EXCEPTION 'You cant delete a comment with votes in it.';
        END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER delete_comment
        BEFORE DELETE ON comment
        FOR EACH ROW
        EXECUTE PROCEDURE delete_comment();
