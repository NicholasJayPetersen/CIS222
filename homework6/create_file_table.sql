USE njpetersen;

CREATE TABLE FileList (
    FileNumber  int unsigned not null AUTO_INCREMENT,
    Filename    varchar(255),
    Location    varchar(255),

    PRIMARY KEY (FileNumber)
);