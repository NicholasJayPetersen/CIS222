USE njpetersen;

CREATE TABLE Customers  (
    CustomerID  int unsigned NOT NULL AUTO_INCREMENT,
    First       varchar(100) NOT NULL,
    Last        varchar(100) NOT NULL,
    Email       varchar(255) NOT NULL,
    Birthday    date NOT NULL,
    CountryCode smallint NOT NULL,
    Phone1      smallint NOT NULL,
    Phone2      smallint NOT NULL,
    Phone3      smallint NOT NULL,
    Street      varchar(256) NOT NULL,
    City        tinytext NOT NUll,
    State       tinytext NOT NULL,
    Country     varchar(2) NOT NULL,
    Notes       varchar(256),
    Banned      bool NOT NULL default 0,

    PRIMARY KEY (CustomerID)
);