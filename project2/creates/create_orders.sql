CREATE TABLE Orders(
    OrderNum        int unsigned NOT NULL AUTO_INCREMENT,
    CustomerID      int unsigned,
    GuestID         varchar(255),
    DateOrdered     datetime NOT NULL,
    Subtotal        decimal NOT NULL,
    Tax             decimal NOT NULL,
    Email           varchar(255) NOT NULL,
    Shipping        decimal NOT NULL,
    Total           decimal NOT NULL,
    CountryCode     varchar(3) NOT NULL,
    Phone1          varchar(3) NOT NULL,
    Phone2          varchar(3) NOT NULL,
    Phone3          varchar(3) NOT NULL,
    Street          varchar(256) NOT NULL,
    City            tinytext NOT NUll,
    State           tinytext NOT NULL,
    Zip             mediumint NOT NULL,
    Country         varchar(50) NOT NULL,

    PRIMARY KEY (OrderNum),
    FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
    FOREIGN KEY (GuestID) REFERENCES Guests(GuestID)
);