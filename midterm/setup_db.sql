USE njpetersen;

CREATE TABLE midterm_cars(
    CarID   int unsigned NOT NULL AUTO_INCREMENT,
    Make    varchar(50) NOT NULL,
    Model   varchar(50) NOT NULL,
    Price   decimal NOT NULL,
    Year    smallint unsigned NOT NULL,

    PRIMARY KEY (CarID)
);

INSERT INTO midterm_cars( Make, Model, Price, Year)
VALUES    ('Jeep', 'Grand Cherokee', 29900.00, 2007),
          ('Dodge', 'Neon', 5890.00, 2005),
          ('Buick', 'Skylark', 500.25, 1985);
