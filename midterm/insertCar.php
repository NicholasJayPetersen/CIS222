<!-- view this page at https://cislinux.hfcc.edu/njpetersen/-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Midterm</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <form action="insertCar.php" method="get">
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

            <button type="submit">Submit</button>
        </form>

        <?php
        if (isset($_GET["Make"]) && isset($_GET["Model"]) && isset($_GET["Price"]) && isset($_GET["Year"]))
        {
            include("creds.php");

            //pull GET parameters into variables
            $make = $_GET["Make"];
            $model = $_GET["Model"];
            $price = $_GET["Price"];
            $year = $_GET["Year"];

            //Create database connection object
            try {
                $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
            } catch (PDOException $e) {
                echo "<h3>Database Error: Your connection to the database failed.</h3>";
                $conn = null;
            }

            //Create insert statement using get parameters
            $sql = "INSERT INTO midterm_cars(
                                 Make,
                                 Model,
                                 Price,
                                 Year)
                    Values (:make, 
                            :model, 
                            :price, 
                            :year)";


            //bind parameters to query and execute
            $statement = $conn->prepare($sql);
            $statement->bindParam(':make', $make, PDO::PARAM_STR);
            $statement->bindParam(':model', $model, PDO::PARAM_STR);
            $statement->bindParam(':price', $price, PDO::PARAM_STR);
            $statement->bindParam(':year', $year, PDO::PARAM_STR);
            if ($statement->execute())
                echo "<br>Database updated successfully!<br><br>";
            else
                echo "<br>Error updating database... Please try again later.<br><br>";
        }
        ?>
    <br>
    <form action="index.php">
        <button type="submit">Go back</button>
    </form>

    </body>
</html>

