<?php
require_once("./includes/creds.php");
try {
    $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
}
catch (PDOException $e) {
    echo "<h3>Database Error: Your connection to the database failed.</h3>";
    $conn = null;
}

//pull specific from Products table
$sql = "SELECT ProductID, Name 
        FROM Products
        ORDER BY ProductID";
$statement = $conn->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$conn = null;
echo json_encode($result);