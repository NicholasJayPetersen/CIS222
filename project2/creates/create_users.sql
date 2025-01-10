CREATE TABLE Users (
    Uname           varchar(255) NOT NULL UNIQUE,
    CustomerID      int unsigned,
    CartID          varchar(255),
    OrderNum        int unsigned,
    IsAdmin         bool NOT NULL DEFAULT 0,

    PRIMARY KEY (Uname),
    FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
    FOREIGN KEY (OrderNum) REFERENCES  Orders(OrderNum)
);