<!--
* @link https://cislinux.hfcc.edu/~njpetersen/midterm/index.php
* @author Nicholas Petersen
* @Date 2024-10-10
* @Category Exams
* @Package Midterm
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Midterm</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>

    <?php

    include("creds.php");

    //Create database connection object
    try {
        $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
    } catch (PDOException $e) {
        echo "<h3>Database Error: Your connection to the database failed.</h3>";
        $conn = null;
    }

    $sql = "SELECT * FROM midterm_cars";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;

    echo "<table>
            <thead>
                <th>Car ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Price</th>
                <th>Year</th>
            </thead>";
    foreach ($result as $row) {
        echo "<tr>
        <td>" . $row["CarID"] . "</td>
        <td>" . $row["Make"] . "</td>
        <td>" . $row["Model"] . "</td>
        <td>$" . $row["Price"] . "</td>
        <td>" . $row["Year"] . "</td>
        <td><a href='updateCar.php?carID=" . $row["CarID"] . "'>Update Car</a></td>
      </tr>";
                }
        echo "</table>";

        echo '<form action="insertCar.php">
                <button type="submit">Insert Car</button>
            </form>'
    ?>


    </body>
</html>
