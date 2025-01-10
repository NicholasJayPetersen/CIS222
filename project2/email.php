<?php

include("./includes/creds.php");
try {
    $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);

    //add order to orders table
    $sql = "SELECT Email, MAX(OrderNum) FROM Customers 
            JOIN Orders ON Customers.CustomerID = Orders.CustomerID           
            WHERE Customers.CustomerID = :CustomerID";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':customerID', $SESSION_['customerID']);
    $statement->execute();
    $customer = $statement->fetch();

    $to = $customer['Email'];
    $subject =  "Order Confirmed!";
    $message =  "Your order was placed successfully on ". date("m-d-Y") . " at " . date("H:i A") . ". Your order number is " . $customer['OrderNum'] . ". Thank you.";
    $headers =  'From: njpetersen@hawkmail.hfcc.edu' . "\r\n" .
        'Reply-To: njpetersen@hawkmail.hfcc.edu' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $success = mail($to, $subject, $message, $headers);

}
catch (PDOException $e) {
    echo "<h3>Database Error: There was an error sending your confirmation email.</h3>";
    echo $e->getMessage();
    $conn = null;
}