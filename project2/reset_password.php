<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/reset_password.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_Reset_Password
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
            <h3>Reset Password</h3>
            <div class="question-form">
                <form action="process_reset.php" method="post">
                    <label for="username">Username:</label>
                    <br>
                    <input class="responsive-textbox" type="text" id="username" name="username" maxlength="25" required>
                    <br>
                    <label for="first">First name:</label>
                    <br>
                    <input type="text" id="first" name="first" maxlength="100" required>
                    <br>
                    <label for="last">Last name:</label>
                    <br>
                    <input type="text" id="last" name="last" maxlength="100" required>
                    <br>
                    <label for="email">Email:</label>
                    <br>
                    <input type="email" id="email" name="email" maxlength="255" required>
                    <br>
                    <label for="birthday">Birthday:</label>
                    <br>
                    <input type="date" id="birthday" name="birthday" required>
                    <br>
                    <label for="password">Password:</label>
                    <br>
                    <input class="responsive-textbox" type="password" id="password" name="password" maxlength="25" required>
                    <br>
                    <label for="confirm-password">Confirm password:</label>
                    <br>
                    <input class="responsive-textbox" type="password" id="confirm-password" name="confirm-password" maxlength="25" required>
                    <br>
                    <button class="form-button" type="submit">Change Password</button>
                </form>
                <?php
                if (!empty($_GET['error'])){
                    echo "<button type='button' class='btn btn-danger'>" . $_GET['error'] . "</button>";
                }
                ?>
            </div>
            <a href="login.php"><button>Back</button></a>
        </div>
    </div>
    <?php include_once("./includes/footer.php"); ?>
    <script src="js/slideshow.js"></script>
</body>
</html>