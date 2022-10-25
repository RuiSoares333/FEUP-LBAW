-- SCHEMA: schema

DROP SCHEMA IF EXISTS lbaw2286 CASCADE;

CREATE SCHEMA IF NOT EXISTS lbaw2286
    AUTHORIZATION postgres;


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
DROP TABLE IF EXISTS comment CASCADE; --R08
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
    isAdmin BOOLEAN NOT NULL
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
    id_author INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE
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
CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    reputation INTEGER NOT NULL DEFAULT 0,
    content TEXT NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    id_news INTEGER NOT NULL REFERENCES news (id) ON UPDATE CASCADE,
    id_author INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    id_comment INTEGER REFERENCES comment (id) ON UPDATE CASCADE
);

--R09
CREATE TABLE comment_vote (
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comment (id) ON UPDATE CASCADE,
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
    id_author INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    id_user INTEGER REFERENCES users (id) ON UPDATE CASCADE,
    id_news INTEGER REFERENCES news (id) ON UPDATE CASCADE,
    id_comment INTEGER REFERENCES comment (id) ON UPDATE CASCADE
);

--R15
CREATE TABLE notification (
    id_notification SERIAL PRIMARY KEY,
    notification_type NotificationType NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    is_viewed BOOLEAN NOT NULL DEFAULT False,
    id_user INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    id_news INTEGER REFERENCES news (id) ON UPDATE CASCADE,
    id_comment INTEGER REFERENCES comment (id) ON UPDATE CASCADE
);

