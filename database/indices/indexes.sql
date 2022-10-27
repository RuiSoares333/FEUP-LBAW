CREATE INDEX news_comments ON comment USING hash (id_news);

CREATE INDEX news_by_popularity ON news USING btree (reputation);

CREATE INDEX user_notifications ON notification USING hash (id_user);