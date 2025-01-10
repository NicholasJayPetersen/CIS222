CREATE TABLE Pass(
    PW      varchar(255) NOT NULL,
    Uname   varchar(255) NOT NULL UNIQUE,

    FOREIGN KEY (Uname) REFERENCES Users(Uname)
)