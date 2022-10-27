SET search_path TO lbaw2286;

-- user id 5 is anonymous

CREATE FUNCTION anonymous_user() RETURNS TRIGGER AS
$BODY$
BEGIN
        UPDATE news SET id_author=5 WHERE OLD.id = id_author;
        UPDATE comment SET id_author=5 WHERE OLD.id = id_author;
        UPDATE apply_admin_request SET id_user = 5 WHERE OLD.id = id_user;
        RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS anonymous_user 
CREATE TRIGGER anonymous_user
        BEFORE DELETE ON users
        FOR EACH ROW
        EXECUTE PROCEDURE anonymous_user();