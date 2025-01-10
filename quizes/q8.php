<?php

/**
 * q8.txt
 *
 * @category    Security
 * @package     Quiz 8
 * @author      Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version     2024.11.21
 * @grade       11 / 10
 */

// 1. (5pts) Assume a form has been sent to you, and you must do some validity checks.
//              Check if the 'new_user_agrees' index of $_POST is not null.
//              Check if the 'new_user_age' index of $_POST is an int.
//              Check if the 'new_user_email' index of $_POST is a valid email address.
//              If any of these fail, throw a new error.



//first check if the agreement was accepted if not throw an error.
//if the agreement was accepted check other indexes as well
//if any other indexes not correct store error message in array
//if the array is not empty at the end throw an error
$errors= [];
try {
    if (isset($_POST['new_user_agrees'])) {
        if (is_int($_POST['new_user_age'])) {
            $errors = "Age must be an integer";
        }
        if (!filter_var($_POST['new_user_email'], FILTER_VALIDATE_EMAIL)) {
            $errors = "Invalid email address";
        }
        if (!empty($errors)) {
            throw new Exception(implode(" ,", $errors));
        }
    }
    else{
        throw new Exception("Agreement not accepted.");
    }
}
catch (Exception $e) {
    echo $e->getMessage();
}


// 2. (2pts) Assume the 'new_user_name' index of the $_POST has been sent with the form as well.
//              Write the code needed to ensure the name string inside has no HTML tags in it.
//              Also ensure this HTML tag free name is stored in a var called $newUserName

$newUserName = strip_tags($_POST['new_user_name']);

// 3. (3pts) Below I have some sensitive information I stored in a string, hash it.
$sensitiveInfo = "My favorite color is red!";

$sensitiveInfo = hash("sha256", $sensitiveInfo);


// B. (1pt) Describe why you might use a honey pot.

//One might use a honeypot if they are looking to filter out or catch unwanted activity by creating something enticing
//that the malicious actor might fall for. In order filter out bot request include something that a human
//user would not include in the request but maybe a bot would like a fake username field. You can then dump any
//requests where this field has been set.