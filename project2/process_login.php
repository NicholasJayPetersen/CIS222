<?php
session_start();
include("./includes/creds.php");
//pull username and password from form
//pull ony up to the first 25 characters entered in the form
//strip any encoded characters from the username
//strip any encoded characters but allow special characters from password
$username = mb_substr(strip_tags($_POST['username']), 0, 25);
$password = mb_substr(htmlspecialchars($_POST['password'], ENT_QUOTES), 0, 25);

//set username to lowercase for comparison
$username = strtolower($username);
//hash the password for DB comparision
$password = hash('sha256', $password);


//establish DB connection and compare login info to what's in the DB
try{
    $DBO = new PDO("mysql:host=".DB_HOST.";dbname=".DBASE , UNAME, PASS);
}
catch(PDOException $e){
    echo "<h3>Database Error: Your connection to the database failed.</h3>";
    $conn = null;
}

//check databse for given username and password combo, fetch if exists
$sql = "SELECT First, Last, Users.Uname, PW, IsAdmin 
        FROM Users
        LEFT JOIN Customers ON Customers.CustomerID = Users.CustomerID
        JOIN Pass ON Users.Uname = Pass.Uname
        WHERE Users.Uname = :username AND PW = :password";
$stmt = $DBO->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
$DB_Username = $stmt->fetchAll(PDO::FETCH_ASSOC);

//check if query returned a result
try{
    if($DB_Username != null){
        $success = true;
        $_SESSION['username'] = $username;
        $_SESSION['first'] = $DB_Username[0]['First'];
        $_SESSION['last'] = $DB_Username[0]['Last'];

        //check if admin user to allow admin privileges
        if($DB_Username[0]['IsAdmin'] == 1) $_SESSION['IsAdmin'] = true;

    }
    else{
        $success = false;
        throw new Exception("Invalid Username or Password!");
    }
}catch(Exception $e){
    header("Location: login.php?success=$success");
}

if($success) {
    header("Location: login.php?success=$success");
}

