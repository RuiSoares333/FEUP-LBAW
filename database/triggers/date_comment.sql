SET search_path TO lbaw2286;

CREATE FUNCTION date_comment() RETURNS TRIGGER AS
$BODY$
BEGIN
       IF EXISTS (SELECT date FROM news WHERE NEW.date > date AND NEW.id_news = id_news) THEN
            RAISE EXCEPTION 'Incorrect date.';
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER date_comment()
        BEFORE INSERT ON comment
        FOR EACH ROW
        EXECUTE PROCEDURE date_comment();