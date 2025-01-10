<?php

require('customer.php');
require('user.php');
$errors ='';
//get form data
try {
    $first = strtolower(strip_tags(mb_substr($_POST['first'], 0, 100)));
    $last = strtolower(strip_tags(mb_substr($_POST['last'], 0, 100)));
    $email = strtolower(filter_var(mb_substr($_POST['email'], 0, 100), FILTER_SANITIZE_EMAIL));
    $birthday = strip_tags(mb_substr($_POST['birthday'], 0, 10));
    $uname = strtolower(strip_tags(mb_substr($_POST['username'], 0, 100)));
    $pw = hash('sha256', (mb_substr($_POST['password'], 0, 25)));
    $pw_confirm = hash('sha256', (mb_substr($_POST['confirm-password'], 0, 25)));

    if($pw != $pw_confirm){
        $errors .= "Passwords do not match<br>";
        throw new Exception("Passwords do not match");
    }

    //get user info from DB
    $conn = require('./includes/db_conn.php');
    $SQL = "SELECT * FROM Customers
            JOIN Users ON Customers.CustomerID = Users.CustomerID
            WHERE Users.Uname = :uname";

    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(':uname', $uname);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //build new customer object from results
    $customer = new Customer($result['First'], $result['Last'], $result['Email'], $result['Birthday'], (int)$result['CountryCode'],
        (int)$result['Phone1'], (int)$result['Phone2'], (int)$result['Phone3'], $result['Street'], $result['City'], $result['State'],
        (int)$result['Zip'], $result['Country'], (int)$result['CustomerID']);

    //check if user input matched stored values. If so change password
    if(strtolower($customer->getFirst()) == $first && strtolower($customer->getLast()) == $last &&
        strtolower($customer->getEmail()) == $email && $customer->getBirthday() == $birthday)
    {
        $user = new User($customer->fetch_CustomerID(), $uname, $pw);

        if($user->ChangePassword())
        {
            header('Location: login.php?success=3');
        };
    }
    else
    {
        $errors .= "Invalid information. Reset failed.<br>";
    }

    if($errors != ''){
        throw new Exception($errors);
    }
}
catch (Exception $e) {
    header('Location: reset_password.php?error='.$e->getMessage());
}
