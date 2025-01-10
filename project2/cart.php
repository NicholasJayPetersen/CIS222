<?php session_start()?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/cart.php
* @author Nicholas Petersen
* @Date 2024-11-18
* @Category Projects
* @Package Project2_Cart
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

    <title>Cart</title>
</head>
<body>
<?php include_once ("./includes/header.php"); ?>
    <div class="container">
            <div class="main-content">
                <h1>Cart</h1>

                <?php
                include("./includes/creds.php");

                //Create database connection object
                try {
                    $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
                }
                catch (PDOException $e) {
                    echo "<h3>Database Error: Your connection to the database failed.</h3>";
                    $conn = null;
                }

                //if logged in
                if(isset($_SESSION['username']) && $_SESSION['username'] != ""){
                    $username = $_SESSION['username'];
                }
                else{
                    $username = session_id();
                }
                //pull all from Products table
                $sql = "SELECT Cart.ProductID, 
                        Name, 
                        Image, 
                        Price, 
                        Cart.Quantity,
                        Price * Cart.Quantity AS ExtPrice
                        
                        FROM Cart
                        JOIN Products ON Cart.ProductID = Products.ProductID
                        WHERE Uname = :username OR GuestID = (SELECT GuestID FROM Guests WHERE SESSIONID = :username)";

                $statement = $conn->prepare($sql);
                $statement->bindParam(':username', $username);
                $statement->execute();
                $result = $statement->fetchAll();
                $conn = null;

                echo "<table class='products'>
                        <thead>
                            <th>Image</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Extended Price</th>
                            <th>X</th>
                        </thead>";
                echo "<tbody>";

                $subtotal = 0;
                unset($_SESSION['CartItems']);
                $_SESSION['CartItems'] = [];
                foreach ($result as $row) {
                    echo "<tr>
                            <td class='product-image-box'><a href='product_detail.php?id=" . $row["ProductID"] . "'><img alt='product image' src='." . $row["Image"] ."'" . "></a></td>
                            <td>" . $row["ProductID"] . "</td>
                            <td><a href='product_detail.php?id=" . $row["ProductID"] . "'>" . $row["Name"] . "</a></td>
                            <td>$" . $row["Price"] . "</td>
                            <td>" . $row["Quantity"] . "</td>
                            <td>$" . $row["ExtPrice"] . "</td>
                            <td><a href='remove_from_cart.php?productID=" . $row['ProductID'] . "'><img src='./images/trash_can.png' alt='trash can'></a></td>
                        </tr>";

                    //Store cart information as session info
                    $subtotal += $row["ExtPrice"];
                    $_SESSION['CartItems'][] = ["ProductID" => $row["ProductID"], "Quantity" => $row["Quantity"]];
                }
                $_SESSION['subtotal'] = $subtotal;
                    echo "<tr>
                            <td id='subtotal' colspan='7'>Subtotal:&ensp;$" . $subtotal . "</td>
                          </tr>";
                echo "</tbody>
                    </table>";

                if(!empty($_SESSION['CartItems'])){
                    echo ' 
                        <form action="checkout.php" method="get">
                            <button type="submit">Checkout</button>
                        </form>';
                }
                ?>

            </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
    </body>
</html>