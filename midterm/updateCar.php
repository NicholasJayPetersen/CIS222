<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midterm</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

<form action="updateCar.php" method="get">
    <label for="carID"></label>
    <input type="text" name="carID" id="carID" value="<?php echo ($carID = $_GET["carID"]); ?>" hidden>

    <label for="Make">Make</label>
    <input type="text" name="Make" id="Make">
    <br>
    <label for="Model">Model</label>
    <input type="text" name="Model" id="Model">
    <br>
    <label for="Price">Price</label>
    <input type="number" name="Price" id="Price">
    <br>
    <label for="Year">Year</label>
    <input type="text" name="Year" id="Year">
    <br>
    <br>
    <button type="submit">Submit</button>
</form>

    <?php
    if (isset($_GET["Make"]) && isset($_GET["Model"]) && isset($_GET["Price"]) && isset($_GET["Year"]))
    {

        include("creds.php");

        //Create database connection object
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
        } catch (PDOException $e) {
            echo "<h3>Database Error: Your connection to the database failed.</h3>";
            $conn = null;
        }

        //get selected CarID and form inputs
        $carID = $_GET["carID"];
        $make = $_GET["Make"];
        $model = $_GET["Model"];
        $price = $_GET["Year"];
        $year = $_GET["Price"];


        //perform SQL database update
        $sql = "UPDATE midterm_cars 
                SET Make = :make, Model = :model, Price = :price, Year = :year
                WHERE carID = :carID";

        $statement = $conn->prepare($sql);
        $statement->bindParam(':make', $make);
        $statement->bindParam(':model', $model);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':year', $year);
        $statement->bindParam(':carID', $carID);
        if ($statement->execute())
            echo "<br>Database updated successfully!<br><br>";
        else
            echo "<br>Error updating database... Please try again later.<br><br>";
        }
    ?>
</body>
</html>
