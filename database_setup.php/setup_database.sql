CREATE TABLE sources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    date_last_scraped DATETIME,
    UNIQUE (url)
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    url VARCHAR(255) NOT NULL,
    author VARCHAR(50),
    date_published DATETIME,
    date_scraped DATETIME,
    FOREIGN KEY (source_id) REFERENCES sources(id) ON DELETE RESTRICT,
    INDEX (url)
);
 
 