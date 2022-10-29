SET search_path TO lbaw2286;

CREATE FUNCTION delete_news() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM comment WHERE id_news = OLD.id ) THEN
        RAISE EXCEPTION 'You cant delete news with comments in it';
    END IF;
    IF NOT (OLD.reputation = 0) THEN 
        RAISE EXCEPTION 'You cant delete news with votes in it';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER delete_news
        BEFORE DELETE ON news
        FOR EACH ROW
        EXECUTE PROCEDURE delete_news();
