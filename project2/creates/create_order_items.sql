CREATE TABLE Order_Items(
    LineItem        smallint unsigned NOT NULL AUTO_INCREMENT,
    OrderNum        int unsigned NOT NULL,
    ProductID       int unsigned NOT NULL,

    PRIMARY KEY (LineItem),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    FOREIGN KEY (OrderNum) REFERENCES Orders(OrderNum)
)