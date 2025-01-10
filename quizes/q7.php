<?php

/**
 * q7.txt
 *
 * @category    Cookies & Sessions
 * @package     Quiz 7
 * @author      Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version     2024.11.14
 * @grade       11 / 10
 */

// 1. (3pts) Using a PHP function, save a cookie named favLoop.
//              The cookie should contain the value saved in the $fl variable.

    $fl = "foreach";
    setcookie("favLoop", $fl);

// 2. (3pts) Using a PHP function, save a cookie named favLanguage.
//              The cookie should contain the value saved in the $fl2 variable.
//              The cookie should expire after 90 days.

    $fl2 = "PHP";
    setcookie("favLanguage", $fl2, time() + (60 * 60 * 24 * 90));

// 3. (1pt) What must you do once each page request before using the $_SESSION array?

    session_start();

// 4. (2pts) Imagine you have a user_id in a variable called $uid.
//          Write the code needed below to store that user_id in the global session array.
//Name this session index current_user_id.

    session_start();
    $uid = 42;
    $_SESSION["current_user_id"] = $uid;

// 5. (1pt) Now clear the global session array of all data, as if the user has signed out.

    session_unset(); //clears the session variables
    session_destroy(); //deletes the session

// B. (1pt) What function can you use to get the id of a users current session?

    session_id();