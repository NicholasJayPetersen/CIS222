USE njpetersen;

CREATE TABLE Posts (
    PostID      bigint unsigned AUTO_INCREMENT NOT NULL,
    Username    tinytext NOT NULL,
    Title       text NOT NULL,
    Content     mediumtext NOT NULL,

    PRIMARY KEY (PostID)
);