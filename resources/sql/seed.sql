-- SCHEMA: lbaw2286

DROP SCHEMA IF EXISTS lbaw2286 CASCADE;

CREATE SCHEMA IF NOT EXISTS lbaw2286;

SET search_path TO lbaw2286;


-----------------------------------------
-- Drop old schema
-----------------------------------------

DROP TABLE IF EXISTS users CASCADE; --R01
DROP TABLE IF EXISTS follows CASCADE; --R02
DROP TABLE IF EXISTS apply_admin_request CASCADE; --R03
DROP TABLE IF EXISTS news CASCADE; --R04
DROP TABLE IF EXISTS news_favorite CASCADE; --R05
DROP TABLE IF EXISTS news_vote CASCADE; --RO6
DROP TABLE IF EXISTS news_tag CASCADE; --R07
DROP TABLE IF EXISTS comments CASCADE; --R08
DROP TABLE IF EXISTS comment_vote CASCADE; --R09
DROP TABLE IF EXISTS tag CASCADE; --R10
DROP TABLE IF EXISTS tag_follow CASCADE; --R11
DROP TABLE IF EXISTS tag_proposal CASCADE; --R12
DROP TABLE IF EXISTS tag_proposal_user CASCADE; --R13
DROP TABLE IF EXISTS report CASCADE; --R14
DROP TABLE IF EXISTS notification CASCADE; --R15

-----------------------------------------
-- Types
-----------------------------------------
DROP TYPE IF EXISTS ReportType CASCADE;
DROP TYPE IF EXISTS NotificationType CASCADE;

CREATE TYPE ReportType AS ENUM ('UserReport', 'NewsReport', 'CommentReport');
CREATE TYPE NotificationType AS ENUM ('NewsVote', 'CommentVote', 'NewsComment');

-----------------------------------------
-- Tables
-----------------------------------------

-- Note that a plural 'users' name was adopted because user is a reserved word in PostgreSQL.

--R01
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    reputation INTEGER NOT NULL DEFAULT 0,
    country TEXT,
    picture TEXT,
    is_admin BOOLEAN NOT NULL,
    remember_token VARCHAR
);

--R02
CREATE TABLE follows (
    id1 INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id2 INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id1, id2)
);

--R03
CREATE TABLE apply_admin_request (
    id SERIAL PRIMARY KEY,
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    description TEXT NOT NULL,
    is_handled BOOL NOT NULL DEFAULT False
);

--R10
CREATE TABLE tag(
    id SERIAL PRIMARY KEY,
    tag_name TEXT UNIQUE NOT NULL
);

--R04
CREATE TABLE news (
    id SERIAL PRIMARY KEY,
    reputation INTEGER NOT NULL DEFAULT 0,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    picture TEXT,
    user_id INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE
);

--R05
CREATE TABLE news_favorite (
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_news INTEGER NOT NULL REFERENCES news (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_news)
);

--R06
CREATE TABLE news_vote (
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_news INTEGER NOT NULL REFERENCES news (id) ON UPDATE CASCADE,
    is_liked BOOL NOT NULL,
    PRIMARY KEY (id_user, id_news)
);

--R07
CREATE TABLE news_tag (
    id_news INTEGER NOT NULL REFERENCES news (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_tag INTEGER NOT NULL REFERENCES tag (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_news, id_tag)
);

--R08
CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    reputation INTEGER NOT NULL DEFAULT 0,
    content TEXT NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    id_news INTEGER NOT NULL REFERENCES news (id) ON UPDATE CASCADE,
    user_id INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    id_comment INTEGER REFERENCES comments (id) ON UPDATE CASCADE
);

--R09
CREATE TABLE comment_vote (
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id) ON UPDATE CASCADE,
    is_liked BOOL NOT NULL,
    PRIMARY KEY (id_user, id_comment)
);

--R11
CREATE TABLE tag_follow (
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_tag INTEGER NOT NULL REFERENCES tag (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_tag)
);

--R12
CREATE TABLE tag_proposal (
    id SERIAL PRIMARY KEY,
    tag_name TEXT UNIQUE NOT NULL,
    description TEXT NOT NULL,
    is_handled BOOLEAN DEFAULT False
);

--R13
CREATE TABLE tag_proposal_user (
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_tag INTEGER NOT NULL REFERENCES tag_proposal (id) ON UPDATE CASCADE,
    PRIMARY KEY (id_user, id_tag)
);

--R14
CREATE TABLE report (
    id_report SERIAL PRIMARY KEY,
    report_type ReportType NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    report_text TEXT,
    is_handled BOOLEAN DEFAULT False,
    user_id INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    id_user INTEGER REFERENCES users (id) ON UPDATE CASCADE,
    id_news INTEGER REFERENCES news (id) ON UPDATE CASCADE,
    id_comment INTEGER REFERENCES comments (id) ON UPDATE CASCADE,
    CHECK((id_user IS NOT NULL AND id_news IS NULL AND id_comment IS NULL) OR (id_user IS NULL AND id_news IS NOT NULL AND id_comment IS NULL) OR (id_user IS NULL AND id_news IS NULL AND id_comment IS NOT NULL))
);

--R15
CREATE TABLE notification (
    id_notification SERIAL PRIMARY KEY,
    notification_type NotificationType NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    is_viewed BOOLEAN NOT NULL DEFAULT False,
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    id_news INTEGER REFERENCES news (id) ON UPDATE CASCADE,
    id_comment INTEGER REFERENCES comments (id) ON UPDATE CASCADE,
    CHECK((id_news IS NOT NULL AND id_comment IS NULL) OR (id_news IS NULL AND id_comment IS NOT NULL))
);

-------------------------------
-- Users
-------------------------------

SET search_path TO lbaw2286;

INSERT INTO users (id, username, email, password, country, picture, is_admin) VALUES(1, 'André Morais', 'andre@legitmail.com', 'legitandre', 'Portugal', './path/to/picture.png', true);
INSERT INTO users (id, username, email, password, country, picture, is_admin) VALUES(2, 'João Teixeira', 'joao@legitmail.com', 'legitjoao', 'Portugal', './path/to/picture.png', true);
INSERT INTO users (id, username, email, password, country, picture, is_admin) VALUES(3, 'Lucas Sousa', 'lucas@legitmail.com', 'legitlucas', 'Portugal', './path/to/picture.png', true);
INSERT INTO users (id, username, email, password, country, picture, is_admin) VALUES(4, 'Rui Soares', 'rui@legitmail.com', 'legitrui', 'Portugal', './path/to/picture.png', true);
INSERT INTO users (id, username, email, password, country, picture, is_admin) VALUES(5, '[redacted]', 'redac@legitmail.com', 'legitredac', 'Zimbabue', './path/to/default.png', false); --id 5 is deleted user
INSERT INTO users (id, username, email, password, country, picture, is_admin) VALUES (6,'John Doe','admin@example.com','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','Doeee','./path/to/picture.png',true);

-------------------------------
-- Follows
-------------------------------
INSERT INTO follows (id1, id2) VALUES (1, 2);
INSERT INTO follows (id1, id2) VALUES (1, 3);
INSERT INTO follows (id1, id2) VALUES (1, 4);
INSERT INTO follows (id1, id2) VALUES (2, 1);
INSERT INTO follows (id1, id2) VALUES (2, 3);
INSERT INTO follows (id1, id2) VALUES (2, 4);
INSERT INTO follows (id1, id2) VALUES (3, 1);
INSERT INTO follows (id1, id2) VALUES (3, 2);

-------------------------------
-- Apply admin request
-------------------------------
INSERT INTO apply_admin_request(description, is_handled, id_user) VALUES ('I would like to be an admin to help manage news',false,1);
INSERT INTO apply_admin_request(description, is_handled, id_user) VALUES ('I would like to be an admin please!',true,2);
INSERT INTO apply_admin_request(description, is_handled, id_user) VALUES ('I would like to be an admin to manage reports',false,3);
INSERT INTO apply_admin_request(description, is_handled, id_user) VALUES ('I would like to be an admin to help manage ags',false,4);

-------------------------------
-- tag
-------------------------------
INSERT INTO tag(id, tag_name) VALUES (1, 'Gaming'); -- 1
INSERT INTO tag(id, tag_name) VALUES (2, 'Politics'); -- 2
INSERT INTO tag(id,tag_name) VALUES (3, 'Academia'); -- 3
INSERT INTO tag(id, tag_name) VALUES (4, 'Memes'); -- 4
INSERT INTO tag(id, tag_name) VALUES (5, 'Food'); -- 5
INSERT INTO tag(id, tag_name) VALUES (6, 'Animals'); -- 6
INSERT INTO tag(id, tag_name) VALUES (7, 'Celebrities'); -- 7
INSERT INTO tag(id, tag_name) VALUES (8, 'Movies'); -- 8
INSERT INTO tag(id, tag_name) VALUES (9, 'TV'); -- 9
INSERT INTO tag(id, tag_name) VALUES (10, 'Books'); -- 10
INSERT INTO tag(id, tag_name) VALUES (11, 'Technology'); -- 11
INSERT INTO tag(id, tag_name) VALUES (12, 'Hardware'); -- 12
INSERT INTO tag(id, tag_name) VALUES (13, 'Software'); -- 13
INSERT INTO tag(id, tag_name) VALUES (14, 'Sci-Fi'); -- 14
INSERT INTO tag(id, tag_name) VALUES (15, 'Fantasy'); -- 15
INSERT INTO tag(id, tag_name) VALUES (16, 'Sports'); -- 16
INSERT INTO tag(id, tag_name) VALUES (17, 'Photography'); -- 17
INSERT INTO tag(id, tag_name) VALUES (18, 'Science'); -- 18
INSERT INTO tag(id, tag_name) VALUES (19, 'DIY'); -- 19
INSERT INTO tag(id, tag_name) VALUES (20, 'Music'); -- 20
INSERT INTO tag(id, tag_name) VALUES (21, 'Anime'); -- 21

-------------------------------
-- News
-------------------------------
INSERT INTO news (id, title, content, date, picture, user_id) VALUES (1, 'Overwatch Fan Makes LEGO Bastion Figure for Their Brother', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut.
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus.
Erat velit scelerisque in dictum non consectetur a.', '2022.10.20', './path/to/picture.png', 1);

INSERT INTO news (id, title, content, date, picture, user_id) VALUES (2, 'Here’s What to Expect from Season 3 of The Witcher', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut.
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus.
Erat velit scelerisque in dictum non consectetur a.', '2022.10.20', './path/to/picture.png', 2);

INSERT INTO news (id, title, content, date, picture, user_id) VALUES (3, 'The State Of Destiny 2s Festival Of The Lost Is Unacceptable','Lorem ipsum dolor sit amet, consectetur adipiscing elit,
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut.
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus.
Erat velit scelerisque in dictum non consectetur a.', '2022.10.20', './path/to/picture.png', 3);

INSERT INTO news (id, title, content, date, picture, user_id) VALUES (4, 'Bleach TYBW shocks fans with brutal character deaths in episode 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut.
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus.
Erat velit scelerisque in dictum non consectetur a.', '2022.10.20', './path/to/picture.png', 4);

-------------------------------
-- news_favorite
-------------------------------
INSERT INTO news_favorite(id_user, id_news) VALUES (1, 1);
INSERT INTO news_favorite(id_user, id_news) VALUES (2, 2);
INSERT INTO news_favorite(id_user, id_news) VALUES (3, 4);
INSERT INTO news_favorite(id_user, id_news) VALUES (4, 3);

-------------------------------
-- news_vote
-------------------------------
INSERT INTO news_vote(id_user, id_news, is_liked) VALUES (1, 1, true);
INSERT INTO news_vote(id_user, id_news, is_liked) VALUES (1, 2, false);
INSERT INTO news_vote(id_user, id_news, is_liked) VALUES (2, 2, true);
INSERT INTO news_vote(id_user, id_news, is_liked) VALUES (2, 3, false);
INSERT INTO news_vote(id_user, id_news, is_liked) VALUES (3, 1, true);
INSERT INTO news_vote(id_user, id_news, is_liked) VALUES (3, 4, false);

-------------------------------
-- news_tag
-------------------------------
INSERT INTO news_tag (id_news, id_tag) VALUES (1, 1); -- gaming
INSERT INTO news_tag (id_news, id_tag) VALUES (2, 9); -- TV
INSERT INTO news_tag (id_news, id_tag) VALUES (2, 7); -- Celebrities
INSERT INTO news_tag (id_news, id_tag) VALUES (2, 1); -- Gaming
INSERT INTO news_tag (id_news, id_tag) VALUES (3, 1); -- Gaming
INSERT INTO news_tag (id_news, id_tag) VALUES (4, 8); -- Movies
INSERT INTO news_tag (id_news, id_tag) VALUES (4, 9); -- TV
INSERT INTO news_tag (id_news, id_tag) VALUES (4, 21); -- Anime

-------------------------------
-- comment
-------------------------------
INSERT INTO comments(id, content, id_news, id_comment, user_id) VALUES (1, 'Fake news!', 1, NULL, 1);
INSERT INTO comments(id, content, id_news, id_comment, user_id) VALUES (2, 'Very informative', 2, NULL, 2);
INSERT INTO comments(id, content, id_news, id_comment, user_id) VALUES (3, 'Loved it!', 2, 1, 3);
INSERT INTO comments(id, content, id_news, id_comment, user_id) VALUES (4, 'Source?', 3, 2, 4);

-------------------------------
-- comment_vote
-------------------------------
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (1, 1, true);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (1, 2, false);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (1, 3, true);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (2, 2, true);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (3, 1, false);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (4, 1, true);

-------------------------------
-- tag_follow
-------------------------------
INSERT INTO tag_follow(id_user, id_tag) VALUES (1,1);
INSERT INTO tag_follow(id_user, id_tag) VALUES (2,2);
INSERT INTO tag_follow(id_user, id_tag) VALUES (3,3);
INSERT INTO tag_follow(id_user, id_tag) VALUES (4,4);
INSERT INTO tag_follow(id_user, id_tag) VALUES (1,4);
INSERT INTO tag_follow(id_user, id_tag) VALUES (2,5);

-------------------------------
-- tag_proposal
-------------------------------
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ('Wholesome','I want to tag my cat pictures',false);
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ('Mystery','I want to tag some books with this tag',false);
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ('Manga','I want to tag my favorite manga without using the "books" tag',false);
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ('Cars','This important tag is missing',false);
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ('Anime','I want to tag my favorite anime shows without using the "TV" tag', true);

---------------------INSERT INTO report(report_type, report_text, is_handled, user_id, id_user, id_news, id_comment) VALUES ('UserReport','User insulted me', false,1,1,NULL, NULL);
----------
-- tag_proposal_user
-------------------------------
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (1, 1);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (2, 1);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (3, 1);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (1, 2);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (2, 2);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (3, 3);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (4, 3);

-------------------------------
-- report --
--'UserReport', 'NewsReport', 'CommentReport'
-------------------------------
INSERT INTO report(report_type, report_text, is_handled, user_id, id_user, id_news, id_comment) VALUES ('UserReport','User insulted me', false,1,1,NULL, NULL);
INSERT INTO report(report_type, report_text, is_handled, user_id, id_user, id_news, id_comment) VALUES ('NewsReport','Wrong use of tags', true,2,NULL,2, NULL);
INSERT INTO report(report_type, report_text, is_handled, user_id, id_user, id_news, id_comment) VALUES ('CommentReport','Offensive comment', false,3,NULL,NULL,1);
INSERT INTO report(report_type, report_text, is_handled, user_id, id_user, id_news, id_comment) VALUES ('CommentReport','Spam', false,4, NULL, NULL, 2);

-------------------------------
-- notification
-- 'NewsVote', 'CommentVote', 'NewsComment'
-------------------------------
INSERT INTO notification(notification_type, is_viewed, id_user, id_news, id_comment) VALUES ('NewsVote', false, 1, 1, NULL);
INSERT INTO notification(notification_type, is_viewed, id_user, id_news, id_comment) VALUES ('CommentVote', false, 2, NULL, 3);
INSERT INTO notification(notification_type, date, is_viewed, id_user, id_news, id_comment) VALUES ('NewsComment', '2022.10.20', true, 2, NULL, 1);
INSERT INTO notification(notification_type, date, is_viewed, id_user, id_news, id_comment) VALUES ('NewsVote', '2022.10.20', true, 4, 4, NULL);

