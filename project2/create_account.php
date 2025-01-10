<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/create_account.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_create_account
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
    <title>Create Account</title>
</head>
<body>
<?php include_once ("./includes/header.php"); ?>

    <div class="container">
        <div class="main-content">
            <h3>Create Account</h3>
            <div class="question-form">
                <form action="process_account.php" method="post">
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
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" minlength="10" maxlength="10" required>
                    <br>
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" maxlength="255" required>
                    <br>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" maxlength="100" required>
                    <br>
                    <label for="state">State:</label>
                    <select name="state" id="state" required>
                        <option disabled selected></option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>

                    <br>
                    <label for="zip">Zipcode:</label>
                    <input type="text" name="zip" id="zip" maxlength="5" required>
                    <br>
                    <label for="country">Country:</label>
                    <br>
                    <select name="country" id="country" required>
                        <option disabled selected></option>
                        <option value="USA">United States</option>
                        <option value="CAN">Canada</option>
                        <option value="MEX">Mexico</option>
                    </select>
                    <br>
                    <label for="username">Username:</label>
                    <br>
                    <input class="responsive-textbox" type="text" id="username" name="username" maxlength="25" required>
                    <br>
                    <label for="password">Password:</label>
                    <br>
                    <input class="responsive-textbox" type="password" id="password" name="password" maxlength="25" required>
                    <br>
                    <label for="confirm-password">Confirm password:</label>
                    <br>
                    <input class="responsive-textbox" type="password" id="confirm-password" name="confirm-password" maxlength="25" required>
                    <br>
                    <button class="form-button" type="submit">Submit</button>
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

</body>
</html>


