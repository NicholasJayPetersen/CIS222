<?php session_start()?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/confirmation.php
* @author Nicholas Petersen
* @Date 2024-11-18
* @Category Projects
* @Package Project2_Confirmation
-->

<?php
//set required SQL table columns
if(isset($_SESSION['customerID'])){
    $customerID = $_SESSION['customerID'];
}
else {
    $customerID = null;
}

$dateOrdered = date("Y-m-d H:i:s");
$subtotal = $_SESSION['subtotal'];
$tax = $_SESSION['tax'];
$shipping = $_SESSION['shipping'];
$total = $_SESSION['total'];
$firstname = '';
$lastname = '';
$phone = '';
$street = '';
$city = '';
$state = '';
$zip = '';

//set country code based on country from checkout form
if ($country = "MEX") {
    $countryCode= '52';
}
else $countryCode= '1';

    include("./includes/creds.php");
    try {

        //Set empty vars using checkout form inputs
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['phone']) && !empty($_POST['street']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip']) && !empty($_POST['country'])) {
            $firstname = strip_tags(mb_substr($_POST['firstname'], 0, 25));
            $lastname = strip_tags(mb_substr($_POST['lastname'], 0, 25));
            $phone = strip_tags(mb_substr($_POST['phone'], 0, 10));
            $street = strip_tags(mb_substr($_POST['street'], 0, 100));
            $city = strip_tags(mb_substr($_POST['city'], 0, 25));
            $state = strip_tags(mb_substr($_POST['state'], 0, 2));
            $zip = strip_tags(mb_substr($_POST['zip'], 0, 5));
            $country = strip_tags(mb_substr($_POST['country'], 0, 3));
        }
        elseif (!empty($_POST['shipping-firstname']) && !empty($_POST['shipping-lastname']) && !empty($_POST['shipping-phone']) && !empty($_POST['shipping-street']) && !empty($_POST['shipping-city']) && !empty($_POST['shipping-state']) && !empty($_POST['shipping-zip']) && !empty($_POST['shipping-country'])) {
            $firstname = strip_tags(mb_substr($_POST['shipping-firstname'], 0, 25));
            $lastname = strip_tags(mb_substr($_POST['shipping-lastname'], 0, 25));
            $phone = strip_tags(mb_substr($_POST['shipping-phone'], 0, 10));
            $street = strip_tags(mb_substr($_POST['shipping-street'], 0, 100));
            $city = strip_tags(mb_substr($_POST['shipping-city'], 0, 25));
            $state = strip_tags(mb_substr($_POST['shipping-state'], 0, 2));
            $zip = strip_tags(mb_substr($_POST['shipping-zip'], 0, 5));
            $country = strip_tags(mb_substr($_POST['shipping-country'], 0, 3));
        }
        else {
            throw new exception("Please enter all fields when checking out");
        }
    }
    catch (Exception $e) {
        $_SESSION['checkout_error'] = $e->getMessage();
    }
    if(isset($_SESSION['checkout_error'])){
        header("Location: ./checkout.php");
    }


    //Create database connection object
//    try {
        $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);

        if($customerID != null){
            //add order to orders table for logged in user
            $sql = "INSERT INTO Orders (CustomerID, DateOrdered, Subtotal, Tax, Shipping, Total, CountryCode, Phone, Street, City, State, Zip, Country)
            VALUES (:ID, :dateOrdered, :subtotal, :tax, :shipping, :total, :countryCode, :phone, :street, :city, :state, :zip, :country)";
        }
        else{
            //Get Guest ID
            $session_id = session_id();
            $sql = "SELECT GuestID From Guests WHERE SessionID = :ID";
            $statement = $conn->prepare($sql);
            $session_id = session_id();
            $statement->bindParam(':ID', $session_id);
            $statement->execute();
            $guestID = $statement->fetch();

            //add order to orders table for guest
            $customerID = $guestID['GuestID'];
            $sql = "INSERT INTO Orders (GuestID, DateOrdered, Subtotal, Tax, Shipping, Total, CountryCode, Phone, Street, City, State, Zip, Country)
            VALUES (:ID, :dateOrdered, :subtotal, :tax, :shipping, :total, :countryCode, :phone, :street, :city, :state, :zip, :country)";

        }
        $statement = $conn->prepare($sql);
        $statement->bindParam(':ID', $customerID, PDO::PARAM_INT);
        $statement->bindParam(':dateOrdered', $dateOrdered);
        $statement->bindParam(':subtotal', $subtotal );
        $statement->bindParam(':tax', $tax);
        $statement->bindParam(':shipping', $shipping);
        $statement->bindParam(':total', $total);
        $statement->bindParam(':countryCode', $countryCode);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':street', $street);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':state', $state);
        $statement->bindParam(':zip', $zip);
        $statement->bindParam(':country', $country);
        $statement->execute();

        //add order items to the order_items table
        foreach($_SESSION['CartItems'] as $cart_item){
            $sql = "INSERT INTO Order_Items (OrderNum, ProductID, Quantity)
                VALUES ((SELECT MAX(OrderNum) FROM Orders WHERE CustomerID = :ID OR GuestID = :ID), :ProductID, :Quantity)";

            $statement = $conn->prepare($sql);
            $statement->bindParam(':ID', $customerID);
            $statement->bindParam(':ProductID', $cart_item['ProductID']);
            $statement->bindParam(':Quantity', $cart_item['Quantity']);
            $statement->execute();
        }


        //set username if logged in or not
        if (!isset($_SESSION['username'])){
            $username = session_id();
        }
        else {
            $username = $_SESSION['username'];
        }

        //delete items from cart for selected user
        $sql = "DELETE FROM Cart WHERE Uname = :Uname OR GuestID = (SELECT GuestID FROM Guests WHERE SessionID = :Uname)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':Uname', $username);
        $statement->execute();
        $conn = null;
        unset($_SESSION['CartItems']);

        //Display success message
        echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="css/header.css">
                    <link rel="stylesheet" href="css/footer.css">
                    <link rel="stylesheet" href="css/styles.css">
                    <link rel="stylesheet" href="css/bootstrap.css">
                
                    <title>Order Confirmation</title>
                </head>
                <body>';
                    include_once ("./includes/header.php");
        echo '      <div class="container">
                    <div class="main-content">
                        <h1>Thank you!</h1>
                        <h3>Your order is on its way.</h3>
                        <p>An email will be sent with your order number for your reference.</p>
                
                    </div>
                </div>
                <?php include_once ("./includes/footer.php"); ?>
                </body>
                </html>
        ';

        //send confirmation email
        require_once ("./email.php");

//    }
//    catch (PDOException $e) {
//        echo "<h3>Database Error: There was a problem placing your order.</h3>";
//        echo $e->getMessage();
//        $conn = null;
//    }
?>
