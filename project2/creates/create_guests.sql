CREATE TABLE Guests (
                        GuestID         bigint unsigned NOT NULL AUTO_INCREMENT,
                        SessionID        varchar(255) NOT NULL UNIQUE,
                        CartID           varchar(255),

                       PRIMARY KEY (GuestID)
);