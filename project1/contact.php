<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project1/contact.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project1_Contact_form
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Contact Us</title>
</head>
<body>
<?php include_once ("./includes/header.php"); ?>
    <div class="container">
            <div class="main-content">
                <h1>Have a question?</h1>
                <h3>Send us a message!</h3>
                <div class="question-form">
                    <form action="contact_submit.php" method="post">
                        <label for="first">First name: </label>
                        <br>
                        <input class="responsive-textbox" type="text" id="first" name="first" maxlength="20" required>
                        <br>
                        <label for="last">Last name: </label>
                        <br>
                        <input class="responsive-textbox" type="text" id="last" name="last" maxlength="20" required>
                        <br>
                        <label for="email">Email address: </label>
                        <br>
                        <input class="responsive-textbox" type="email" id="email" name="email" maxlength="75" required>
                        <br>
                        <label for="inquiry">Inquiry: <br> (1000 character limit)</label>
                        <br>
                        <textarea wrap="soft" id="inquiry" name="inquiry" maxlength="1000" required></textarea>
                        <br>
                        <button class="form-button" type="submit">Submit</button>
                    </form>
                </div>
            </div>
    </div>
<?php include_once ("./includes/footer.php"); ?>
</body>
</html>