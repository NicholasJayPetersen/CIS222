USE njpetersen;

CREATE TABLE Contacts(
    ContactID   int unsigned NOT NULL AUTO_INCREMENT,
    First       varchar(100) NOT NULL,
    Last        varchar(100) NOT NULL,
    Email       varchar(255) NOT NULL,
    Inquiry     longtext NOT NULL,

    PRIMARY KEY (ContactID)
             );