<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework6/index.php
* @author Nicholas Petersen
* @Date 2024-11-06
* @Category Assignments
* @Package Homework6
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Server</title>
</head>

<body>
<h1> File Upload Utility</h1>

<form action="#" method="post" enctype="multipart/form-data">
    <label for="file-upload">Choose a file to upload</label>
    <br>
    <input type="file" id="file-upload" name="file-upload">
    <br>
    <br>
    <button type="submit">Upload file</button>
</form>

<?php

require("../creds.php");

// PULL info from DB
try {
    $conn = new PDO('mysql:host=localhost;dbname='. DBASE, UNAME, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT Filename, Location FROM FileList";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $file_list = $statement->fetchAll();
    $conn = null; // Close connection after fetching
} catch (PDOException $e) {
    echo "<h3>Database Error: Your connection to the database failed.</h3>";
    exit;
}

// Make sure a file was actually submitted
if (isset($_FILES['file-upload'])) {
    $filename = basename($_FILES['file-upload']['name']);
    $directory = "../uploads/";
    $target_path = $directory . $filename;
    $temp_path = $_FILES['file-upload']['tmp_name'];
    $max_size = 10 * 1024 * 1024;
    $filesize = $_FILES['file-upload']['size'];

    if ($filesize <= $max_size) {
        if (move_uploaded_file($temp_path, $target_path)) {

            // Store info in DB
            try {
                $conn = new PDO('mysql:host=localhost;dbname='. DBASE, UNAME, PASS);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO FileList(Filename, Location) VALUES (:Filename, :Location)";
                $statement = $conn->prepare($sql);
                $statement->bindParam(':Filename', $filename);
                $statement->bindParam(':Location', $target_path);
                $statement->execute();

                // Re-run the query to fetch updated list of files
                $sql = "SELECT Filename, Location FROM FileList";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $file_list = $statement->fetchAll();

                $conn = null; // Close connection after update


                //print a confirmation message and send an email
                echo "<p>File uploaded successfully</p>";
                $to =       "njpetersen@hawkmail.hfcc.edu";
                $subject =  "File Uploaded on CIS Linux Server.";
                $message =  "Your file was successfully uploaded!\n
                             Name: $filename\n
                             Location: https://cislinux.hfcc.edu/~njpetersen/$target_path";
                $headers =  'From: njpetersen@hawkmail.hfcc.edu' . "\r\n" .
                            'Reply-To: njpetersen@hawkmail.hfcc.edu' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                $success = mail($to, $subject, $message, $headers);

            } catch (PDOException $e) {
                echo "<h3>Database Error: Your connection to the database failed.</h3>";
            }
        } else {
            echo "<p>Failed to upload file</p>";
        }
    } else {
        echo "<p>File size is too large</p>";
    }
}

// Display list of files
echo "<h3>Files on the server:</h3>";
foreach ($file_list as $row) {
    echo "<a href='". $row['Location'] . "' download>" . $row['Filename'] . "</a><br>";
}
?>

</body>
</html>