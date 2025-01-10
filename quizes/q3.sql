/**
 * q3.txt
 *
 * Quiz 3 is a few SQL commands, feel free to convert this to a .sql file if needed to test.
 *
 * @category   SQL
 * @package    Quiz 3
 * @author     Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version    2024.09.26
 * @grade      11 / 10
 */

/* 4 pts
1. Your IT department has been tasked with keeping track of all hardware in your organizations.
	Create a database table to store this information in. All future queries in this quiz will refer to this table.
	Name the table hardware and give it 8 fields, the field information is below.
		hardware_id is a whole number that can get very large, it should be the automatically increasing primary key of the table.
		user_id is also a whole number that can get very large, it should link to the id of the user who owns the device.
		value should track the cost or value of the machine.
		serial_num is a string of numbers and letters used to identify the machine by the manufacturer.
		notes should store any amount of text based notes about the machine, such is if it went for service or has a virus.
		created_date should store when the machine was purchased, so this field should never be null.
		updated_date should store when the machine was modified, this field can be null by default.
		deleted_date should store when the machine was retired, so null by default.
*/

    CREATE DATABASE Hardware;
    USE Hardware;
    CREATE TABLE  Components  (
        hardware_id     bigint unsigned NOT NULL AUTO_INCREMENT,
        user_id         bigint unsigned NOT NULL,
        value           decimal,
        serial_num      varchar NOT NULL,
        notes           text,
        created_date    datetime NOT NULL,
        updated_date    datetime DEFAULT NULL,
        deleted_date     datetime DEFAULT NULL,
        PRIMARY KEY (hardware_id)
    );


-- 3 pts
-- 2. Write an insert statement that will insert 2 rows of data into this table.
-- You can make the data up but it should make sense for the data type.

    INSERT INTO Components(
                    user_id,
                    value,
                    serial_num,
                    notes,
                    created_date,
                    updated_date

    )
    VALUES(
               'ajohnson',
               199.95,
               'A1345L',
               'New Device. Treat with care.',
               2024-09-26,
               2024-09-26
              ),
            (
             'njpetersen',
             499.95,
             'Q348603LN',
             'Older Unit. History of Failures. Retiring soon.',
             2019-06-08,
             2023-7-25
            );

-- 1 pts
-- 3. Write an update statement that will retire any machine that has a hardware id value of 4.
-- This is done by populating the deleted_date field and adding a note that says "RETIRED!"

    UPDATE Components
    SET notes = 'RETIRED', deleted_date = CURDATE()
    WHERE hardware_id = 4;

-- 1 pts
-- 4. Write a select statement that will show me the top 5 most expensive pieces of hardware, but do not include any that are retired.

    SELECT hardware_id,
           value,
           notes,
           deleted_date
    FROM Components
    WHERE notes != 'RETIRED' OR deleted_date IS NULL
    ORDER BY value DESC
    LIMIT 5;

-- 1 pt
-- 5. Which engine did I go over that is newer and more efficient than MyISAM?

    -- InnoDB

-- 1 ec pt
-- Ex: Write a single SQL statement that will remove all the data from your table and reset the auto_increment to 1
--     Write this command without the use of the DROP key word.

    TRUNCATE TABLE Components;
