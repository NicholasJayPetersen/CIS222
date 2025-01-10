<!--
* @link https://cislinux.hfcc.edu/~njpetersen/final/index.php
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
    <title>Final</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h1>Hardware Devices</h1>
        <a href="add_hardware.php"><button class="btn btn-outline-primary">Add New Device</button></a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 1){
        echo '<div class="row">
                <button class="btn btn-success">Hardware added successfully</button>
              </div>';
    }
    if(isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="row">
                    <button class="btn btn-warning">Failed to add hardware</button>
                  </div>';
    }
    ?>

    <div class="row">
        <div class="col">
        <br>
        <br>
        <table>
            <?php
            require_once "hardware.php";
            $sort = 1;

            if(isset($_POST['sort']) && $_POST['sort'] != "" ){
                $sort = $_POST['sort'];
            }
            $devices = new Hardware();

            foreach($devices->getHardwareDevices($sort) as $hardware){
                echo "<tr>";
                echo "<td>".$hardware['hardware_name']."</td>";
                echo "<td>".$hardware['hardware_description']."</td>";
                echo "<td>".$hardware['hardware_make']."</td>";
                echo "<td>".$hardware['hardware_model']."</td>";
                echo "<td>".$hardware['hardware_date']."</td>";
                echo "<td><a href='edit_hardware.php?ID=" . $hardware['hardware_id'] . "'<button>Edit</button>";
                echo "</tr>";
            }
            ?>
        </table>
        </div>
        <div class="col-sm">
            <form action ="#" method="post">
                <label for="sort">Sort by:</label>
                <select name="sort" id="sort">
                    <option value="1">Name A-Z</option>
                    <option value="2">Name Z-A</option>
                    <option value="3">Date (Newest)</option>
                    <option value="4">Date (Oldest)</option>
                </select>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>