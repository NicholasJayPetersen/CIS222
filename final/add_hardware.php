<!--
* @link https://cislinux.hfcc.edu/~njpetersen/final/add_hardware.php
* @author Nicholas Petersen
* @Date 2024-12-12
* @Category Exams
* @Package Final
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final - Add hardware</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<div class="container">
    <h1>Add Hardware</h1>
    <form method="post" action="#">
        <div class="form-group">
            <div class="row">
            <label for="name" hidden>Name</label>
            <input type="text" name="name" placeholder="Name" required>

            <label for="description" hidden>Description</label>
            <input type="text" name="description" placeholder="Description" required>

            <label for="make" hidden>Make</label>
            <input type="text" name="make" placeholder="Make" required>

            <label for="model" hidden>Model</label>
            <input type="text" name="model" placeholder="Model" required>

            <label for="date" hidden>Date</label>
            <input type="date" name="date" required>

            <button class="btn btn-outline-primary" type="submit">Submit</button>
            </div>
        </div>
    </form>

    <?php
        require_once "hardware.php";
        if(isset($_POST) && $_POST != null){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $make = $_POST["make"];
            $model = $_POST["model"];
            $date = date("Y-m-d H:i:s" , strtotime($_POST["date"]));

            $device = new Hardware($name, $description, $make, $model, $date);

            echo "<pre>";
            var_export($device);
            echo "</pre>";

            if($device->insertHardware()){
                header("location: index.php?success=1");
            }
            else{
                header("location: index.php?error=1");
            }
        }
    ?>

</div>
</body>
</html>



