<?php
require_once("creds.php");
try {
    $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
    return $conn;
}
catch (PDOException $e) {
    echo "<h3>Database Error: Your connection to the database failed.</h3>";
    $conn = null;
}