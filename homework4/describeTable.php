<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Homework 4</title>
</head>
<body>
    <div class="table-format describe-table">
    <?php

    include("creds.php");

    //Create database connection object
    try {
        $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
    }

    //get variable and select all from chosen table
    $table = $_GET["table"];
    $sql = "DESCRIBE  $table";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;

    //Create table and output on the page
    echo "<table>
                    <thead>
                        <tr>
                            <th>Table Description</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>Field</td>
                        <td>Type</td>
                        <td>Null</td>
                        <td>Key</td>
                        <td>Default</td>
                        <td>Extra</td>
                    </tr>";
    //Loop through each item in the result set
    foreach ($result as $field) {
        echo "<tr>";
        echo "<td>" . $field["Field"] . ":" . "</td>" .
             "<td>" . $field["Type"] . "</td>" .
             "<td>". $field["Null"] . "</td>" .
             "<td>" . $field["Key"] . "</td>" .
             "<td>" . $field["Default"] . "</td>" .
             "<td>" . $field["Extra"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    </div>
    <div class="describe-table">
        <form action="selectTable.php" method="get">
            <input type="hidden" name="table" value="<?php echo $table ?>">
            <button type="submit">Select table</button>
        </form>
        <form action="showTables.php" method="get">
            <button type="submit">Go back</button>
        </form>
        <form action="index.php" method="get">
            <button type="submit">Start over</button>
        </form>
    </div>
</body>
</html>