-- create a list of owners
CREATE TABLE Owners (
       UserID       int unsigned NOT NULL AUTO_INCREMENT,
       Username     varchar(50) NOT NULL,
       FirstName    varchar(50) NOT NULL,
       LastName     varchar(50) NOT NULL,
       Email        varchar(100) NOT NULL,
       Birthday     date NOT NULL,
       Phone        bigint unsigned NOT NULL,
       PRIMARY KEY (UserID)
);

-- create a list of dog diets
CREATE TABLE Diet(
       DietPlan     int unsigned NOT NULL AUTO_INCREMENT,
       Food         varchar(50) NOT NULL,
       Price        decimal(5,2) NOT NULL,
       description  text NOT NULL,
       GrainFree    bool NOT NULL,
       PRIMARY KEY (DietPlan)
);

-- create a list of dogs
CREATE TABLE Dogs (
       ID           int unsigned NOT NULL AUTO_INCREMENT,
       DogName      varchar(25) NOT NULL,
       Breed        varchar(50),
       Gender       bool NOT NULL,
       Age          tinyint unsigned,
       Vaccinated   bool NOT NULL,
       AdoptFee     decimal(6,2) unsigned,
       OwnerID      int unsigned,
       DietPlan     int unsigned,
       PRIMARY KEY (ID),
       FOREIGN KEY (OwnerID) REFERENCES Owners(UserID),
       FOREIGN KEY (DietPlan) REFERENCES Diet(DietPlan)
);

-- get info on each table
DESCRIBE Owners;
DESCRIBE Diet;
DESCRIBE Dogs;

-- add some data into the owners table
INSERT INTO Owners  (Username,
                     FirstName,
                     LastName,
                     Email,
                     Birthday,
                     Phone)
VALUES              ('njpetersen',
                     'Nicholas',
                     'Petersen',
                     'njpetersen@hawkmail.hfcc.edu',
                     19990101,
                     3135556666);

INSERT INTO Owners  (Username,
                     FirstName,
                     LastName,
                     Email,
                     Birthday,
                     Phone)
VALUES              ('lskywalker',
                     'Luke',
                     'Skywalker',
                     'lskywalder@therebelion.com',
                     19750101,
                     9196581258);

-- add some data into the list of foods
INSERT INTO Diet (Food,
                  Price,
                  description,
                  GrainFree)
VALUES           ('Blue Harvest Chicken',
                  63.99,
                  '45lb bag dry dog food, chicken flavor',
                  0
                 );

INSERT INTO Diet (Food,
                  Price,
                  description,
                  GrainFree)
VALUES           ('Iams',
                  22.99,
                  '25lb bag dry dog food, cat flavor',
                  0
                 );

-- add some data into the dogs table
INSERT INTO Dogs   (DogName,
                    Breed,
                    Gender,
                    Age,
                    Vaccinated,
                    AdoptFee)
VALUES             ('Dexter',
                    'Husky',
                    0,
                    2,
                    0,
                    399.99
                    );

INSERT INTO Dogs   (DogName,
                    Breed,
                    Gender,
                    Age,
                    Vaccinated,
                    AdoptFee)
VALUES             ('Spike',
                    'American Bulldog',
                    0,
                    6,
                    0,
                    249.99
                   );

-- perform an update to list of foods
UPDATE Diet
SET     Food = 'Hills Science Diet',
        Price = 45.99,
        description = '30lb bag dry dog food, beef flavor',
        GrainFree = 1
WHERE   DietPlan = 1;

-- perform an update on the owner
UPDATE Owners
SET     Birthday = '19000101'
WHERE   UserID = 1;

-- perform an update on the dog
UPDATE Dogs
SET    Vaccinated = 1, OwnerID = 1
WHERE ID = 1;

-- delete fake account
DELETE FROM Owners
WHERE Username = 'lskywalker';

-- delete unvaccinated dogs
DELETE FROM Dogs
WHERE Vaccinated = 0;

-- Delete immoral diets
DELETE FROM Diet
WHERE food = 'Iams';

-- Find some data
Select * FROM Owners;

Select DogName, Breed, OwnerID
FROM Dogs;

Select * FROM Diet
WHERE GrainFree = 1;


