USE njpetersen;

CREATE TABLE Comments (
    CommentID       bigint unsigned AUTO_INCREMENT NOT NULL,
    Comment         mediumtext NOT NULL,
    Username        tinytext NOT NULL,
    PostID          bigint unsigned NOT NULL,

    PRIMARY KEY (CommentID),
    FOREIGN KEY (PostID) REFERENCES Posts(PostID)
);