<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework8/index.php
* @author Nicholas Petersen
* @Date 2024-11-21
* @Category Assignments
* @Package Homework8
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>File Server</title>
</head>

<body>
    <h1>User Account Creation</h1>
    <br>

    <div class="form-fields">
        <form action="process_signups.php" method="post">
            <table>
                <tr>
                    <td><label for="name">Name: </label>
                    <td><input type="text" id="name" name="name" placeholder="Your name.." maxlength="50" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email: </label>
                    <td><input type="text" id="email" name="email" placeholder="Your Email.." maxlength="50" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password: </label>
                    <td><input type="password" id="password" name="password" placeholder="Password.." minlength="8" maxlength="16" required></td>
                </tr>
                <tr>
                    <td><label for="confirm-password">Confirm Passsword: </label>
                    <td><input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password.." minlength="8" maxlength="16" required></td>
                </tr>
                <tr>
                    <td><label for="birthday">Birthday: </label>
                    <td><input type="date" id="birthday" name="birthday" required></td>
                </tr>
                <tr>
                    <td colspan="2" id="empty"></td>
                </tr>
                <tr>
                    <td id="account-submit" colspan="2"><button type="submit">Submit</button>
                </tr>
            </table>
        </form>
    </div>
    <br>
    <br>

    <?php
    if(!empty($_GET['success'])){
        if($_GET['success'] == 1){
            echo "<p id='output-message'>Your account has been created.</p>";
        }
    }
    elseif(!empty($_GET['errors'])){
        echo'<p id="output-message">Account cannot be created.</p>';
        echo'<p>';
        echo urldecode($_GET['errors']);
        echo'<br><br>Please try again...';
        echo '</p>';
    }
    else exit;
    ?>

</body>
</html>