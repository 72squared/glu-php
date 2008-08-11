CREATE TABLE directory ( 
    dir_id INTEGER PRIMARY KEY,
    parent INTEGER,
    path TEXT(500) UNIQUE,
    entry_id INTEGER UNIQUE
);

CREATE TABLE entry (
    entry_id  INTEGER PRIMARY KEY,
    dir_id INTEGER,
    author INTEGER,
    created INTEGER,
    body TEXT,
    data TEXT
);

CREATE INDEX directory_entry_id ON directory(entry_id);
CREATE INDEX directory_parent ON directory(parent);
CREATE INDEX entry_dir_id ON entry(dir_id);
CREATE INDEX entry_author ON entry(author);