SET search_path TO lbaw2286;

CREATE FUNCTION comment_count() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF ((SELECT COUNT(*) FROM comment WHERE id_comment = NEW.id_comment) >= 10) THEN
        RAISE();
    END IF;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_count 
CREATE TRIGGER comment_count
        BEFORE INSERT ON comment
        FOR EACH ROW
        EXECUTE PROCEDURE comment_count();