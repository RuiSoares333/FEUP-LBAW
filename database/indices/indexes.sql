CREATE INDEX news_comments ON comment USING hash (id_news);

CREATE INDEX news_by_popularity ON news USING btree (reputation);

CREATE INDEX user_notifications ON notification USING hash (id_user);

--FTS USERS
-- Add column to work to store computed ts_vectors.
ALTER TABLE users
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
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

-- Create a trigger before insert or update on work.
CREATE TRIGGER users_search_update
 BEFORE INSERT OR UPDATE ON users
 FOR EACH ROW
 EXECUTE PROCEDURE users_search_update();


-- Finally, create a GIN index for ts_vectors.
CREATE INDEX search_username ON users USING GiST (tsvectors);

