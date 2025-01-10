<?php session_start()?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/checkout.php
* @author Nicholas Petersen
* @Date 2024-11-18
* @Category Projects
* @Package Project2_Checkout
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

    <title>Checkout</title>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("shippingaddress");
            const inputs = document.querySelectorAll("#shipping-firstname, #shipping-lastname, #shipping-phone, #shipping-street, #shipping-city, #shipping-state, #shipping-zip, #shipping-country");
            const container = document.getElementById("shipping-fields");
            let heading;

            checkbox.addEventListener("change", () => {
                if (checkbox.checked) {
                    container.classList.add("expanded");
                    if (!heading) {
                        heading = document.createElement("h3");
                        heading.textContent = "Shipping Address";
                        container.prepend(heading);
                    }
                    inputs.forEach(input => (input.hidden = false));
                    inputs.forEach(input => (input.required = true));

                } else {
                    container.classList.remove("expanded");
                    setTimeout(() => {
                    if (heading) {
                        heading.remove();
                        heading = null;
                    }
                    inputs.forEach(input => (input.hidden = true));
                    inputs.forEach(input => (input.required = false));
                    }, 650);
                }
            });
        });
    </script>
</head>

<body>
<?php
include_once ("./includes/header.php");
include("./includes/creds.php");

if(isset($_SESSION['username'])){
    //get username from session
    $username = $_SESSION['username'];

//Create database connection object
    try {
        $DBO = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
    }
    catch (PDOException $e) {
        echo "<h3>Database Error: Your connection to the database failed.</h3>";
        $DBO = null;
    }
//get customer information to autopopulate billing fields
    $sql = "SELECT First,
                Last,
                Email,
                CountryCode,
                Phone1,
                Phone2,
                Phone3,
                Street,
                City,
                State,
                Zip,
                Country  
        FROM Customers
        JOIN Users ON Customers.CustomerID = Users.CustomerID
        WHERE Uname = :username";

    $statement = $DBO->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->execute();
    $customer = $statement->fetchAll();

//get customer ID to store for later
    $sql = "SELECT CustomerID  
        FROM Users
        WHERE Uname = :username";

    $statement = $DBO->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->execute();
    $customerID = $statement->fetch();

    $_SESSION['customerID'] = $customerID['CustomerID'];
}

//display totals
$subtotal = $_SESSION['subtotal'];
$tax = round($subtotal * 0.06, 2);
$shipping = 19.99;
$total = round($subtotal + $tax + $shipping,2);

$_SESSION['total'] = $total;
$_SESSION['tax'] = $tax;
$_SESSION['shipping'] = $shipping;
?>

<div class="container">
    <div class="main-content">
        <h1>Checkout</h1>
        <div class="checkout-page">
            <div class="summary-table">
                <table class="products totals">
                    <tbody>
                        <tr>
                            <td id='subtotal'>Subtotal</td>
                            <td id='subtotal'>$<?php echo $subtotal?></td>
                        </tr>
                        <tr>
                            <td id='tax'>Tax:</td>
                            <td id='tax'>$<?php echo $tax?></td>
                        </tr>
                        <tr>
                            <td id='shipping'>Subtotal:</td>
                            <td id='shipping'>$<?php echo $shipping?></td>
                        </tr>
                        <tr>
                            <td id='total'>Total:</td>
                            <td id='total'>$<?php echo $total?></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="checkout">
                    <h3>Billing Address</h3>
                    <form class="question-form" id="checkout-form" method="post" action="confirmation.php">
                        <label for="firstname">First name:</label>
                        <input type="text" placeholder="First name" name="firstname" id="firstname" value="<?php if(isset($customer[0])) echo $customer[0]['First']?>" maxlength="25" required>
                        <label for="lastname">Last name:</label>
                        <input type="text" placeholder="Last name" name="lastname" id="lastname" value="<?php if(isset($customer[0])) echo $customer[0]['Last']?>" maxlength="25" required>
                        <label for="phone">Phone:</label>
                        <input type="tel" placeholder="Phone (no dashes)" name="phone" id="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" minlength="10" maxlength="10" value="<?php if(isset($customer[0])) echo $customer[0]['Phone1'] . $customer[0]['Phone2'] . $customer[0]['Phone3']?>" required>
                        <label for="street">Street:</label>
                        <input type="text" placeholder="Street" name="street" id="street" value="<?php if(isset($customer[0])) echo $customer[0]['Street']?>" maxlength="100" required>
                        <label for="city">City:</label>
                        <input type="text" placeholder="City" name="city" id="city" value="<?php if(isset($customer[0])) echo $customer[0]['City']?>" maxlength="25" required>
                        <label for="state">State:</label>
                        <input type="text" placeholder="State" name="state" id="state" value="<?php if(isset($customer[0])) echo $customer[0]['State']?>" maxlength="2" required>
                        <label for="zip">Zip code:</label>
                        <input type="text" placeholder="Zip code" name="zip" id="zip" value="<?php if(isset($customer[0])) echo $customer[0]['Zip']?>" maxlength="5" required>
                        <label for="country">Country:</label>
                        <input type="text" placeholder="Country" name="country" id="country" maxlength="3" required
                            <?php
                            //select appropriate country code based on DB value
                            if(isset($customer[0])){
                                switch ($customer[0]['CountryCode']) {
                                    case 'CAN':
                                        echo' value="Canada"';
                                        break;

                                    case 'MEX':
                                        echo' value="Mexico"';
                                        break;

                                    default:
                                        echo' value="United States"';
                                        break;
                                }
                            }
                            else echo 'value=""';

                            ?>
                        >
                    <div class="payment-info">
                        <h3>Payment Information</h3>
                        <label for="cname">Card Name:</label>
                        <input type="text" id="cname" placeholder="Card Name" name="cardname" required>
                        <label for="ccnum">Card Number:</label>
                        <input type="text" id="ccnum" placeholder="Card Number" name="cardnumber" required>
                        <label for="expmonth">Month:</label>
                        <input type="text" id="expmonth" placeholder="MM" name="expmonth" required>
                        <label for="expyear">Year:</label>
                        <input type="text" id="expyear" placeholder="YY" name="expyear" required>
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" placeholder="CVV" name="cvv" required>
                        <label for="zip">Zip code:</label>
                        <input type="text" id="zip" placeholder="Zip" name="zip" required>
                    </div>
                    <label for="shipping-address" id="shipping-address"><input type="checkbox" id="shippingaddress" name="shipping-address">Shipping address different from billing</label>

                    <div id="shipping-fields">
                        <label for="shipping-firstname" id="shipping-firstname">First name:</label>
                        <input type="text" placeholder="First name" name="shipping-firstname" id="shipping-firstname" maxlength="25" hidden>
                        <label for="shipping-lastname" id="shipping-lastname">Last name:</label>
                        <input type="text" placeholder="Last name" name="shipping-lastname" id="shipping-lastname" maxlength="25" hidden>
                        <label for="shipping-phone">Phone:</label>
                        <input type="tel" placeholder="Phone (no dashes)" name="shipping-phone" id="shipping-phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" minlength="10" maxlength="10" hidden>
                        <label for="shipping-street">Street:</label>
                        <input type="text" placeholder="Street" name="shipping-street" id="shipping-street" maxlength="100" hidden>
                        <label for="shipping-city">City:</label>
                        <input type="text" placeholder="City" name="shipping-city" id="shipping-city" maxlength="25" hidden>
                        <label for="shipping-state">State:</label>
                        <input type="text" placeholder="State" name="shipping-state" id="shipping-state" maxlength="2" hidden>
                        <label for="shipping-zip">Zip code:</label>
                        <input type="text" placeholder="Zip code" name="shipping-zip" id="shipping-zip" maxlength="5" hidden>
                        <label for="shipping-country">Country:</label>
                        <input type="text" placeholder="Country" name="shipping-country" id="shipping-country" maxlength="3" hidden>
                    </div>
                        <?php
                        if (isset($_SESSION['checkout_error'])){
                            echo "<button type='button' class='btn btn-danger'>" . $_SESSION['checkout_error'] . "</button>";
                            unset($_SESSION['checkout_error']);
                        }
                        ?>
                    <button type="submit">Place Order</button>
                </form>
            </div>
        </div>

    </div>
</div>
<?php include_once ("./includes/footer.php"); ?>
</body>
</html>
