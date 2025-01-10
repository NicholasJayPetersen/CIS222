<?php
require("../creds.php");

try{
    if (isset($_POST)) {

        //pull in POST data and filter/sanitize
        $name = strip_tags(mb_substr($_POST["name"], 0, 50));
        $email = filter_var(mb_substr($_POST["email"], 0, 50), FILTER_VALIDATE_EMAIL);
        $password = hash("sha1", strip_tags(mb_substr($_POST["password"], 0, 16)));
        $confirm_password = hash("sha1", strip_tags(mb_substr($_POST["confirm-password"], 0, 16)));
        $birthday = strip_tags($_POST["birthday"]);

        //set regex to verify valid date format
        $valid_birthday = '#\d{4}-\d{2}-\d{2}#';
        //set empty array for catching errors
        $errors= [];

        if(!$email){
            $errors[] = "Email address is invalid";
        }
        if(empty($password)){
            $errors[] = "Password is required";
        }
        if ($password != $confirm_password) {
            $errors[] = "Passwords do not match";
        }
        if(!preg_match($valid_birthday, $birthday)){
            $errors[] = " $birthday is an Invalid birthday";
        }

    }
    else{
        $errors[] = "Form incomplete";
    }

    if (!empty($errors)) {
        Throw new Exception (implode("<br>", $errors));
    }
    else{
        header('Location: ./index.php?success=1');
    }
}
catch (Exception $e){
    $errors_message = urlencode($e->getMessage());
    header("Location: ./index.php?errors=$errors_message");
}