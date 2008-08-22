CREATE TABLE entry ( entry_id  INTEGER PRIMARY KEY, dir_id INTEGER, entry_type INTEGER, author INTEGER, created INTEGER, body BLOB, data TEXT);
CREATE TABLE directory (dir_id INTEGER PRIMARY KEY, parent INTEGER, path TEXT(500) UNIQUE, entry_id INTEGER UNIQUE);
CREATE INDEX directory_entry_id ON directory(entry_id);
CREATE INDEX directory_parent ON directory(parent);
CREATE INDEX entry_dir_type ON entry(dir_id, entry_type);
CREATE TABLE keywords (word_checksum INTEGER PRIMARY KEY,word TEXT(30));
CREATE TABLE entry_keywords (entry_id INTEGER, word_checksum INTEGER, counter INTEGER, PRIMARY KEY( entry_id, word_checksum ));