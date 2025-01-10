<?php
session_start();
include("./includes/creds.php");

$productID = $_GET['productID'];

if(isset($_SESSION['username']) && $_SESSION['username'] != ""){
    $username = $_SESSION['username'];
}
else{
    $username = session_id();
}

//Create database connection object
try {
    $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);

    $sql = "DELETE FROM Cart
            WHERE ProductID = :productID AND (Uname = :username OR GuestID = (SELECT GuestID FROM Guests WHERE SESSIONID = :username))";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':ID', $productID);
    $statement->bindParam(':productID', $productID);
    $statement->execute();
    $conn = null;

    header("Location: cart.php");
}
catch (PDOException $e) {
    echo "<h3>Database Error: Your connection to the database failed.</h3>";
    $conn = null;
}

?>
