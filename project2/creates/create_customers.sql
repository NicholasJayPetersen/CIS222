USE njpetersen;

CREATE TABLE Customers  (
    CustomerID  int unsigned NOT NULL AUTO_INCREMENT,
    First       varchar(100) NOT NULL,
    Last        varchar(100) NOT NULL,
    Email       varchar(255) NOT NULL UNIQUE,
    Birthday    date NOT NULL,
    CountryCode varchar(3) NOT NULL,
    Phone1      varchar(3) NOT NULL,
    Phone2      varchar(3) NOT NULL,
    Phone3      varchar(4) NOT NULL,
    Street      varchar(256) NOT NULL,
    City        tinytext NOT NUll,
    State       tinytext NOT NULL,
    Zip         varchar(5) NOT NULL,
    Country     varchar(50) NOT NULL,
    Notes       varchar(256),
    Banned      bool NOT NULL DEFAULT 0,

    PRIMARY KEY (CustomerID)
);