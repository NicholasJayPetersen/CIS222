CREATE TABLE Hardware (
    hardware_id             bigint unsigned NOT NULL AUTO_INCREMENT,
    hardware_name           varchar(255),
    hardware_description    mediumtext,
    hardware_make           varchar(255),
    hardware_model          varchar(255),
    hardware_date           datetime,

    PRIMARY KEY (hardware_id)
)