CREATE TABLE contribers
(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(128) NOT NULL,
    email VARCHAR(256) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    addr VARCHAR(256) NOT NULL,
    country VARCHAR(20) NOT NULL,
    state VARCHAR(50),
    zip VARCHAR(25) NOT NULL,
    company VARCHAR(50) NOT NULL,
    svg VARCHAR(10000) NOT NULL,
    github_user VARCHAR(128),
    sign_time INTEGER NOT NULL,
    UNIQUE(email)
);
