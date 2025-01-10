<?php session_start() ?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/product_detail.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_Product_detail
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

    <title>Products</title>
</head>
<body>
<?php include_once ("./includes/header.php"); ?>
    <div class="container">
        <div class="main-content">
            <h1>Product Details</h1>
            <div class="product-grid">

                <?php if(isset($_POST['ProductID'])) {
                    require_once("includes/creds.php");


                    $productID = strip_tags(mb_substr($_POST['ProductID'], 0, 1));
                    $quantity = strip_tags(mb_substr($_POST['Quantity'], 0, 3));

                    try {
                        $DBO = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
                    } catch (PDOException $e) {
                        echo "<h3>Database Error: Your connection to the database failed.</h3>";
                        $DBO = null;
                    }

                    //check if logged in
                    if (isset($_SESSION['username']) and $_SESSION['username'] != "") {
                        $uname = $_SESSION['username'];
                        $sql = "INSERT INTO Cart (Uname, ProductID, Quantity)
                                 VALUES (:Uname, :ProductID, :Quantity);";
                        $statement = $DBO->prepare($sql);
                        $statement->bindParam(':Uname', $uname);
                    } //if not logged in add guest user
                    else {
                        $uname = session_id();

                        $sql = "SELECT SessionID FROM Guests WHERE SessionID = :Uname;";
                        $statement = $DBO->prepare($sql);
                        $statement->bindParam(':Uname', $uname);
                        $statement->execute();
                        $sessionID = $statement->fetch(PDO::FETCH_ASSOC);

                        //if not existing add ID to Guests table
                        if(!$sessionID) {
                            $sql = "INSERT INTO Guests (SessionID)
                                    VALUES(:SessionID)";
                            $statement = $DBO->prepare($sql);
                            $statement->bindParam(':SessionID', $uname);
                            $statement->execute();
                        }

                        //create cart using guest ID
                        $sql = "INSERT INTO Cart (GuestID ,ProductID, Quantity)
                                VALUES ((SELECT GuestID FROM Guests WHERE SESSIONID = :SessionID), :ProductID, :Quantity);";
                        $statement = $DBO->prepare($sql);
                        $statement->bindParam(':SessionID', $uname);
                    }

                    //add selected item to Cart table for user
                    $statement->bindParam(':ProductID', $productID);
                    $statement->bindParam(':Quantity', $quantity);
                    $statement->execute();

                    echo "<script>alert('Product Added to Cart');</script>";
                }
                ?>

                <?php
                require_once("includes/creds.php");

                //pull GET parameter
                $productID = strip_tags(mb_substr($_GET['id'], 0, 3));

                //Create database connection object
                try {
                    $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
                }
                catch (PDOException $e) {
                    echo "<h3>Database Error: Your connection to the database failed.</h3>";
                    $conn = null;
                }

                //pull specific from Products table
                $sql = "SELECT * FROM Products
                        WHERE ProductID = $productID";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                $conn = null;

                //output the chosen product image, name, and price
                echo "<div class ='product-detail-image-box'><img id='detail-image' alt='product image' src='." . $result[0] -> Image ."'" . "></div>";
                echo "<div class ='product-detail-item-name'><h3>". $result[0]->Name. "</h3></div>";
                echo "<div class ='product-detail-price'><h4>$". $result[0]->Price. "</h4></div>";

                //output user rating using a loop that outputs a star x amount of times based on the rating
                echo "<div class ='product-detail-rating'><h5>Average Customer Rating:</h5>";
                for ($i = 1; $i <= $result[0]->Rating; $i++) {
                    echo "<img alt='gold star' src='./images/goldstar_small.png'>";
                }

                echo "</div>";

                //output the product description
                echo "<div class ='product-detail-description'><p>" . $result[0]->Description . "</p><br>";

                //output whether in stock or out of stock
                if ($result[0]->Quantity > 0) {echo"<h5>In stock!</h5>";}
                else {echo "<h5>Out of stock!</h5>";}
                echo "</div>";

                //if not in stock disable the add to cart button
                if ($result[0]->Quantity > 0){
                    echo "<div class ='product-detail-add-to-cart'>
                            <form action='#' method='post'>
                                <input type='hidden' name='ProductID' value='" . $result[0]->ProductID . "'>
                                <label for='Quantity'>Quantity</label>
                                <input type='number' name='Quantity' value='1' min='1' max='". $result[0]->Quantity . "' required>
                                <button type='submit' id='add-to-cart'>Add to cart</button>
                            </form>
                          </div>";
                }
                else {
                    echo "<div class ='product-detail-add-to-cart'>
                            <form action='#' method='post'>
                                <button type='submit' disabled>Add to cart</button>
                            </form>
                          </div>";}

                //go back button to return to the last page
                echo "<div class ='product-detail-go-back'><button onclick='goBack()'>Go back</button></div>";

                //empty spacers to make the grid layout better
                echo "<div class ='spacer-1'></div>";
                echo "<div class ='spacer-2'></div>";
                echo "<div class ='spacer-3'></div>";
                ?>
            </div>
        </div>
    </div>

<?php include_once ("./includes/footer.php"); ?>

<script>
    function goBack() {
        window.location.href = "./catalog.php";
    }
</script>

</body>
</html>
