SET search_path TO lbaw2286;

CREATE INDEX news_comments ON comment USING hash (id_news);

CREATE INDEX news_by_popularity ON news USING btree (reputation);

CREATE INDEX user_notifications ON notification USING hash (id_user);

---------------------------FTS USERS--------------------------
/*
ALTER TABLE users
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION users_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         to_tsvector('english', NEW.username));
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.username <> OLD.username) THEN
           NEW.tsvectors = (
             to_tsvector('english', NEW.username));
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER users_search_update
 BEFORE INSERT OR UPDATE ON users
 FOR EACH ROW
 EXECUTE PROCEDURE users_search_update();

CREATE INDEX search_username ON users USING GiST (tsvectors);


----------------------------------FTS TAG-----------------------------------

ALTER TABLE tag
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION tag_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         to_tsvector('english', NEW.tag_name));
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.tag_name <> OLD.tag_name) THEN
           NEW.tsvectors = (
            to_tsvector('english', NEW.tag_name));
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER tag_search_update
 BEFORE INSERT OR UPDATE ON tag
 FOR EACH ROW
 EXECUTE PROCEDURE tag_search_update();

CREATE INDEX tag_search ON tag USING GIN (tsvectors);

*/
-------------------------------------------FTS NEWS------------------

ALTER TABLE news
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION news_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.title), 'A') ||
         setweight(to_tsvector('english', NEW.content), 'B')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.title <> OLD.title OR NEW.content <> OLD.content) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.title), 'A') ||
             setweight(to_tsvector('english', NEW.content), 'B')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER news_search_update
 BEFORE INSERT OR UPDATE ON news
 FOR EACH ROW
 EXECUTE PROCEDURE news_search_update();

CREATE INDEX search_news ON news USING GiST (tsvectors);