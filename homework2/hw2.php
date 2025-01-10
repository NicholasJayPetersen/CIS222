
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework2/hw2.php
* @author Nicholas Petersen
* @Date 2024-09-05
* @Category Assignments
* @Package Homework 2
* @Grade 10 / 10
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homework 2</title>
        <link rel="stylesheet" href="../homework1/style.css">
    </head>

    <body>
        <div class="container">
            <h1>Student Roster</h1>
            <div class="status-container">
                <div class="status-left">
                    <h2>Roster Status:</h2>
                </div>

                <?php
                    //create array named students
                    $students = ['Nicholas', 'Sarah', 'Cassie', 'Donovan', 'Daniel'];

                    //check array length and output based on length
                    $arrLength = count($students);
                    if ($arrLength > 20)
                        echo '<div class="status-right"><h2 style="color:green"> We have enough students!</h2></div></div>';

                    else
                        echo '<div class="status-right"><h2 style="color:red"> Not enough students!</h2></div></div>';


                    //output name of each student in the array in a list
                    echo "<h3>Current roster:</h3>";
                    echo "<ol>";
                    foreach ($students as $pupil)
                        echo "<li>$pupil";
                    echo "</ol>";
                    ?>

            <br><br>
            <h3>Vardump simulator:</h3>
            <form action="hw2.php" method="post">
                <label for="message">Message:</label>
                <input type="text" name="message" id="message">
                <button type="submit">Submit</button>
            </form>
            <br>

            <?php
                //check $_POST and output and output any variables if it's not empty.
                if (isset($_POST) && count($_POST) > 0) {
                    $message = $_POST['message'];
                    var_dump($_POST);
                }
            ?>
        </div>
    </body>
</html>