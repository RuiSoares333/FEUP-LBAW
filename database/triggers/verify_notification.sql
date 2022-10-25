SET search_path TO lbaw2286;

CREATE FUNCTION verify_notification() RETURNS TRIGGER AS $BODY$
BEGIN
        IF NEW.id_news IS NOT NULL AND NEW.id_comment IS NOT NULL THEN
           RAISE EXCEPTION 'Invalid notification (has more than one type).';
        END IF;
        IF NEW.id_news IS NULL AND NEW.id_comment IS NULL THEN
           RAISE EXCEPTION 'Invalid notification (has no type).';
        END IF;
        RETURN NEW;
END
$BODY$ LANGUAGE plpgsql;


CREATE TRIGGER verify_notification
    BEFORE INSERT OR UPDATE ON notification
    EXECUTE PROCEDURE verify_notification();