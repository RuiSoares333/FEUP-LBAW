SET search_path TO lbaw2286;

CREATE FUNCTION comment_on_comment() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (select id_comment from comment where id_comment = NEW.id) THEN-- se comentário já for resposta a comentário não pode ser comentado
        RAISE EXCEPTION 'Comments that are commented on other comment cant have comments';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER comment_on_comment
        BEFORE INSERT ON comment
        FOR EACH ROW
        EXECUTE PROCEDURE comment_on_comment();
