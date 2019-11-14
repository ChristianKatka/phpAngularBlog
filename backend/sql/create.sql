
-- 
-- 
CREATE DATABASE
IF NOT EXISTS phpblog;
USE phpblog;

DROP TABLE IF EXISTS Blog;
DROP TABLE IF EXISTS Users;



CREATE TABLE Users (
Usersid INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
username VARCHAR (40) NOT NULL,
password VARCHAR (200) NOT NULL,
date DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

CREATE TABLE Blog (
Blogid INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
Usersid INT NOT NULL,
heading VARCHAR (200) NOT NULL,
content VARCHAR (4000) NOT NULL,
FOREIGN KEY	(Usersid) REFERENCES Users(Usersid)
ON UPDATE CASCADE ON DELETE CASCADE,
date DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;


INSERT INTO Users (username, password)
VALUES ("Tuhnu", "salainen");


INSERT INTO blog (Usersid ,heading, content)
VALUES (1, "matka", "Olin saaressa retkellä ja tapasin onki madon.");

INSERT INTO blog (Usersid ,heading, content)
VALUES (1, "Toine matka", "Olin uimassa.");



SELECT *
FROM Blog
LEFT JOIN Users
ON Blog.Blogid = Users.Usersid;

SELECT *
FROM Users
RIGHT JOIN Blog
ON Users.Usersid = Blog.Blogid;
