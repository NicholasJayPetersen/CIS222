<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project1/contact_submit.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project1_Contact_submit_landing_page
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Homework 4</title>
</head>
<body>
<div class="container">
    <div class="main-content">

        <?php
        include("includes/header.php");

        //Pull URL parameters from web form and filter the data
        $first = strip_tags(mb_substr($_POST['first'],0,20));
        $last = strip_tags(mb_substr($_POST['last'],0,20));
        $email = filter_var(mb_substr($_POST['email'],0,75), FILTER_SANITIZE_EMAIL);
        $inquiry = htmlspecialchars($_POST['inquiry'],ENT_QUOTES);

        if(empty($first) || empty($last) || empty($email) || empty($inquiry)){
            die('<h3>Please fill in all the required fields.</h3>
                <br>
                <br>
                <form action="contact.php">
                <button>Go back</button>
                </form>
                ');
        }

        //Establish DB connection
        include("includes/creds.php");
        try{
            $conn = new PDO('mysql:host=localhost;dbname='. DBASE, UNAME, PASS);
        }
        catch (PDOException $e){
            echo "<h3>Database Error: Your connection to the database failed.</h3>";
            $conn = null;
        }

        //Construct query to add contact entry to database
        $sql = "INSERT INTO Contacts(
                             First,
                             Last,
                             Email,
                             Inquiry)
                Values (:first, 
                        :last, 
                        :email, 
                        :inquiry)";

        //bind parameters to query and execute
        $statement = $conn->prepare($sql);
        $statement ->bindParam(':first', $first, PDO::PARAM_STR);
        $statement ->bindParam(':last', $last, PDO::PARAM_STR);
        $statement ->bindParam(':email', $email, PDO::PARAM_STR);
        $statement ->bindParam(':inquiry', $inquiry, PDO::PARAM_STR);
        $conn=null;
        if ($statement->execute())
            echo "Thanks for reaching out! Someone will be in touch with you soon.<br><br>";
        else
            echo "Error sending your message... Please try again later.<br><br>";
        ?>
        <form action="index.php">
            <button class="form-button" type="submit">Home</button>
        </form>
    </div>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
