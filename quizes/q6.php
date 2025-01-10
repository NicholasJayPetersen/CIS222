<?php
/**
* q6.txt
*
* @category    Web dev stuff
* @package     Quiz 6
* @author      Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
* @version     2024.11.07
* @grade       11 / 10
*/

// 1. (5pts) Write the PHP needed below to send an email.
//          The subject should read "Test Email"
//          The body should use a variable called $prepared_content
//          The email should be sent to crbanks1@hfcc.edu
//          Use an email address of yours as the from and reply to addresses.

$to =       "crbanks1@hfcc.edu";
$subject =  "Test Email";
$message =  "This is a test email for quiz 6!";
$headers =  'From: njpetersen@hawkmail.hfcc.edu' . "\r\n" .
            'Reply-To: njpetersen@hawkmail.hfcc.edu' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

$success = mail($to, $subject, $message, $headers);

// 2. (2pts) Using PHP, echo the JS needed to make an alert pop up that says "Hello World!"

echo '<script>alert("Hello World!")</script>';

// 3. (2pt) Use the PHP header functionality to send the user to the following url: https://ldjam.com

header("Location: https://ldjam.com");

// 4. (1pt) When uploading a file via an HTML 5 form to a PHP server, what global array are the files temporarily stored in?

    //PHP stores the uploaded the file in a superglobal array called $_FILES. An uploaded file goes to a temporary location on the server
    //which can be accessed using the ['tmp_name'] part of the array. The name of the file can be accessed using ['name']
    //the size can be accessed using ['size'] and so on...

// B. (1pt) Use the date function to echo a date and time to the browser in the MySQL format.

echo date("Y-m-d H:i:s",time());