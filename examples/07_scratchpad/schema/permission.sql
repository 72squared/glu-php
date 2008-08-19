CREATE TABLE access (
    role TEXT(32),
    path TEXT(500),
    action TEXT(32),
    PRIMARY KEY(role,path,action)
);