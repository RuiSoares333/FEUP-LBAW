SET search_path TO lbaw2286;

CREATE FUNCTION comment_on_comment() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (select id_comment from comment where id_comment = NEW.id)-- se comentário já for resposta a comentário não pode ser comentado
        RAISE("Comments that are commented on other comment can't have comments");
    END IF;
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_on_comment
CREATE TRIGGER comment_on_comment
        BEFORE INSERT ON comment
        FOR EACH ROW
        EXECUTE PROCEDURE comment_on_comment();