USE njpetersen;

CREATE TABLE Products(
    ProductID   int unsigned NOT NULL AUTO_INCREMENT,
    Name        varchar(255) NOT NULL,
    Image       varchar(255),
    Description varchar(255) NOT NULL,
    Price       decimal(7,2) NOT NULL,
    Quantity    int unsigned NOT NULL,
    Rating      tinyint(5),
    Discontinued bool NOT NULL DEFAULT 0,

    PRIMARY KEY (ProductID)
);