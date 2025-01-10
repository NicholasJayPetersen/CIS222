<?php session_start(); ?>

<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/catalog.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_Catalog
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
                <h1>Catalog</h1>

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

                //pull all from Products table
                $sql = "SELECT * FROM Products
                        WHERE Discontinued = 0";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                $conn = null;

                echo "<table class='products'>
                        <thead>
                            <th>Image</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Price</th>
                        </thead>";
                echo "<tbody>";
                foreach ($result as $row) {
                    echo "<tr>
                            <td class='product-image-box'><a href='product_detail.php?id=" . $row["ProductID"] . "'><img alt='product image' src='." . $row["Image"] ."'" . "></a></td>
                            <td>" . $row["ProductID"] . "</td>
                            <td><a href='product_detail.php?id=" . $row["ProductID"] . "'>" . $row["Name"] . "</a></td>
                            <td>$" . $row["Price"] . "</td>
                        </tr>";
                }
                echo "</tbody>
                    </table>";
                ?>


            </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
    </body>
</html>