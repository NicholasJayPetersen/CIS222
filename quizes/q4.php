<?php
/**
 * q4.txt
 *
 * @category    PHP
 * @package     Quiz 4
 * @author      Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version     2024.10.03
 * @grade       10 / 10
 */

// 2/3 pts
// 1. You are building a new site and have to implement a few files to do so.
//		However, there are a couple conditions for these files that must be met.
//		Write the php code needed to accomplish this task and meet the conditions.
//
//		apis/file1.php		This file imports data for our API service; it must be executed, but must not be executed more than one time.
//		anims/file2.php			This file imports a cool visual effect; it can be executed, but must not be executed more than one time.
//		apis/file3.php			This file dynamically generates data for the page; it can be executed as often as needed.

            require_once("apis/file1.php");
            include_once("apis/file2.php");
            include("apis/file3.php");


// 2 pts
// 2. Write a SQL statement that will return a list of the tables in your current database.

      //  USE CurrentDatabase  //optional if desired database is already selected
      //  SHOW TABLES;

// 3 pts
// 3. Create a function that accepts 3 parameters, you can name it anything you want.
//		The first parameter should be multiplied by the second, and then the third parameter should be added to that product.
//		The function should return the result of this operation.

        function MultiplyAdd($times1, $times2, $add3)
        {
            return $times1 * $times2 + $add3;
        }

// 2 pts
// 4. Below are a 3 i variables that have been set to numbers.
//		Call the function you defined above by passing it the three variables below, and be sure to store the result in a var.
$i1 = 7;
$i2 = 13;
$i3 = 17;

        $result = MultiplyAdd($i1, $i2, $i3);



// 1 ex pt
// 5. Write a SQL statement that will return meta data for a table like the description and column names/types.

/*
    SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'Owners' AND TABLE_SCHEMA = 'njpetersen';
*/

/*
 * The above query returns the column names, data type, if can be null, and defaults
 * for the chosen table in the chosen database
 */