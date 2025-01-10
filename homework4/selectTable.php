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
            $sql = "SELECT * FROM $table";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $conn = null;

            echo "<table>
                    <thead>
                        <tr>
                            <th> Table Data: $table</th>
                        </tr>
                    </thead>";
            //accumulators to be used in the loop
            $i=0;
            $ii=0;
            foreach ($result as $row) {
                //create a single row for the column names
                echo "<tr>";
                //set a condition to only loop through the column names once
                 while ($ii < 1) {
                    foreach ($row as $column => $value) {
                        if ($i % 2 == 0) {echo "<td>" . $column . "</td>";}
                        $i++;
                    }
                    $ii++;
                }
                echo "</tr>";

                 //make each record its own row in the table
                echo "<tr>";
                foreach ($row as $column => $value) {
                    if($i % 2 == 0) {echo "<td>" . $value. "</td>";}
                    $i++;
                }

                echo "</tr>";
            }
            echo "</table>";

        ?>
    </div>
    <div class="describe-table">
        <form action="describeTable.php" method="get">
            <input type="hidden" name="table" value="<?php echo $table ?>">
            <button type="submit">Go back</button>
        </form>
        <form action="index.php" method="get">
            <button type="submit">Start over</button>
        </form>
    </div>
</body>
</html>
