<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Homework 4</title>
</head>
<body>
<?php

//Pull URL parameters from web form
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$inquiry = $_POST['inquiry'];

//Establish DB connection
include("creds.php");
try{
    $conn = new PDO('mysql:host=localhost;dbname='. DBASE, UNAME, PASS);
}
catch (PDOException $e){
        echo $e->getMessage();
        $conn = null;
}



?>
</body>
</html>