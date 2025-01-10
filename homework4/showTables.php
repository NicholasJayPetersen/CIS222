<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Homework 4</title>
</head>
<body>
    <div class="show-tables">
    <?php
    include("creds.php");

    //Create database connection object
    try {
        $conn = new PDO('mysql:host=localhost;dbname=' . DBASE, UNAME, PASS);

    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
    }

    //Create and execute SQL commands
    $sql = "SHOW TABLES";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;


    //Output database table on the page
    echo "<h2>Database Tables</h2>";
    echo "<table>";
    //loop through each row in the result set
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . "<a href=describeTable.php?table=$row[Tables_in_njpetersen]>$row[Tables_in_njpetersen]</a>" . "</td>";
        echo "</tr>";
    }
    echo"</table>";
    ?>
</div>
<div class="describe-table">
    <form action="index.php" method="get">
        <button type="submit">Go back</button>
    </form>
    <form action="index.php" method="get">
        <button type="submit">Start over</button>
    </form>
</div>
</body>
</html>