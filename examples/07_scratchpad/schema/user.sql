CREATE TABLE user (user_id INTEGER PRIMARY KEY,email TEXT(250) UNIQUE,nickname TEXT(25) UNIQUE,passhash TEXT(32),created INTEGER,modified INTEGER);
CREATE TABLE user_attribute (user_id INTEGER,label TEXT(25),data TEXT(500),PRIMARY KEY (user_id, label));
