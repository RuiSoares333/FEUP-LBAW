-----------------------------------------
-- Types
-----------------------------------------


-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE authenticated_user (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    reputation INTEGER NOT NULL DEFAULT 0,
    country TEXT,
    picture TEXT,
    isAdmin BOOLEAN NOT NULL
)

CREATE TABLE news (
    id 
)