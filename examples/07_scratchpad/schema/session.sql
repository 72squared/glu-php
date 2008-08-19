DROP TABLE session;
CREATE TABLE session (session_id INTEGER PRIMARY KEY, token TEXT(32) UNIQUE, created INTEGER, modified INTEGER, data TEXT);
CREATE INDEX session_modified ON session(modified);