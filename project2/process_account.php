<?php

require('customer.php');
require('user.php');
$errors ='';
//get form data
try {
    $first = strip_tags(mb_substr($_POST['first'], 0, 100));
    $last = strip_tags(mb_substr($_POST['last'], 0, 100));
    $email = filter_var(mb_substr($_POST['email'], 0, 100), FILTER_SANITIZE_EMAIL);
    $birthday = strip_tags(mb_substr($_POST['birthday'], 0, 10));
    $phone1 = strip_tags(mb_substr($_POST['phone'], 0, 3));
    $phone2 = strip_tags(mb_substr($_POST['phone'], 3, 3));
    $phone3 = strip_tags(mb_substr($_POST['phone'], 6, 4));
    $street = strip_tags(mb_substr($_POST['street'], 0, 100));
    $city = strip_tags(mb_substr($_POST['city'], 0, 100));
    $state = strip_tags(mb_substr($_POST['state'], 0, 2));
    $zip = strip_tags(mb_substr($_POST['zip'], 0, 5));
    $country = strip_tags(mb_substr($_POST['country'], 0, 3));
    $uname = strip_tags(mb_substr($_POST['username'], 0, 100));
    $pw = hash('sha256', (mb_substr($_POST['password'], 0, 25)));
    $pw_confirm = hash('sha256', (mb_substr($_POST['confirm-password'], 0, 25)));

    if($country == "MEX"){
        $countryCode = 52;
    }
    else $countryCode = 1;

    if(!ctype_digit($phone1) || !ctype_digit($phone2) || !ctype_digit($phone3)) {
        $errors .= "Phone number must be numbers only<br>";
    }
    if(!ctype_digit($zip)) {
        $errors .= "Zip Code must be numbers only<br>";
    }

    if($pw != $pw_confirm){
        $errors .= "Passwords do not match";
    }
    if(!empty($errors)){
        throw new exception("One or more inputs are invalid.");
    }
}
catch (Exception $e) {
    header('Location: create_account.php?error=' . $errors);
}

$customer = new Customer($first, $last, $email, $birthday, $countryCode, $phone1, $phone2, $phone3, $street, $city, $state, $zip, $country);

try {
//add customer to DB
    if ($customer->add_customer()) {
        //returns customer ID on success or -1 if failed
        $customerID = $customer->fetch_CustomerID();
        if ($customerID != -1) {
            $user = new User($customerID, $uname, $pw);
            if ($user->addUser()) {
                header('Location: login.php?success=2');
            }
        }
        else throw new exception("Unable to add user");
    }
    else throw new exception("Unable to add customer.");
}
catch(Exception $e) {
    header('Location: login.php?error=1');
}




