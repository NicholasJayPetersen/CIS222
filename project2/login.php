<?php session_start(); ?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/index.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_Index
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
    <title>Digital Art</title>
</head>
<body>
<?php include_once ("./includes/header.php"); ?>

<div class="container">
    <div class="main-content">
        <div class="question-form">
                <form action="process_login.php" method="post">
                    <label for="username">Username:</label>
                    <br>
                    <input class="responsive-textbox" type="text" id="username" name="username" maxlength="25" required>
                    <br>
                    <label for="password">Password:</label>
                    <br>
                    <input class="responsive-textbox" type="password" id="password" name="password" maxlength="25" required>
                    <br>
                    <button class="form-button" type="submit">Login</button>
                </form>

            <div class="row">
                <div class="col-6"></div>
                <div class="col">
                    <a href="create_account.php">Create account</a>
                </div>
                <div class="col-3">
                    <a href="reset_password.php">Forgot Password</a>
                </div>
            <br><br>
            <?php
            //on successful login redirect to homepage
            if (isset($_GET['success'])) {
                if ($_GET['success'] == "1"){
                    echo "<button type='button' class='btn btn-success fade-out'>Login Successful!</button>";
                    echo "<script>setTimeout(function(){window.location.href='index.php';}, 2500);</script>";
                }
                elseif ($_GET['success'] == "2"){
                    echo "<button type='button' class='btn btn-success fade-out'>Account created successfully!</button>";
                    echo "<script>history.replaceState(null, '', 'login.php');</script>";
                }
                elseif ($_GET['success'] == "3"){
                    echo "<button type='button' class='btn btn-success fade-out'>Password has been changed.</button>";
                    echo "<script>history.replaceState(null, '', 'login.php');</script>";
                }
                else{
                    echo "<button type='button' class='btn btn-danger fade-out'>Login failed...</button>";
                }
            }
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "1") {
                    echo "<button type='button' class='btn btn-danger'>Error creating user account!</button>";
                }
            }

            ?>
        </div>
        </div>
    </div>
</div>
<?php include_once("./includes/footer.php"); ?>
<script src="js/slideshow.js"></script>
</body>
</html>