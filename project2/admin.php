<?php
session_start();
?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/admin.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_Admin
-->

<?php
if (isset($_SESSION['IsAdmin']) && $_SESSION["IsAdmin"] == 1) {
    echo'
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/header.css">
            <link rel="stylesheet" href="css/footer.css">
            <link rel="stylesheet" href="css/styles.css">
            <link rel="stylesheet" href="css/bootstrap.css">
            <title>Admin Panel</title>
            <script src="js/admin_forms.js"></script>
        </head>
            <body>';

             include_once ("./includes/header.php");

     echo'
                <div class="container">
                    <div class="main-content">';
                    if(isset($_GET['success']) && $_GET['success'] == 1) {
                        echo '<button class="btn btn-success fade-out-long">Operation Successful</button>';
                    }
                    elseif(isset($_GET['error']) && $_GET['error'] == 0) {
                        echo '<button class="btn btn-danger fade-out-long">An unknown error has occurred</button>';
                    }
                    elseif(isset($_GET['error']) && $_GET['error'] == 1) {
                        echo '<button class="btn btn-danger fade-out-long">Error: Product added but image not uploaded</button>';
                    }
                    elseif(isset($_GET['error']) && $_GET['error'] == 2) {
                        echo '<button class="btn btn-danger fade-out-long">Error: Product add failed, but image uploaded successfully</button>';
                    }
                    elseif(isset($_GET['error']) && $_GET['error'] == 3) {
                        echo '<button class="btn btn-danger fade-out-long">Error: Product discontinue failed</button>';
                    }
                    elseif(isset($_GET['error']) && $_GET['error'] == 4) {
                        echo '<button class="btn btn-danger fade-out-long">Error: Product reinstate failed</button>';
                    }
                    elseif(!empty($_GET['update_errors'])) {
                        echo '<button class="btn btn-danger fade-out-long">'. $_GET['update_errors'] .'</button>';
                    }
     echo'                  <br>
                            <h3>Admin Tools</h3>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button onClick="add_product()">Add Product</button>
                                </div>
                                <div class="col">
                                    <button onClick="discontinue_product()">Discontinue Product</button>
                                </div>
                                <div class="col">
                                    <button onClick="reinstate_product()">Reinstate Product</button>
                                </div>
                                <div class="col">
                                    <button onClick="update_product()">Update Product</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p class="instructions"></p>
                            <form class="question-form"></form>
                        </div>
                </div>';
            include_once("./includes/footer.php");
     echo'
            </body>
        </html>
        ';
}
else {
    echo'
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/header.css">
            <link rel="stylesheet" href="css/footer.css">
            <link rel="stylesheet" href="css/styles.css">
            <link rel="stylesheet" href="css/bootstrap.css">
            <title>Admin Panel</title>
        </head>
            <body>';

    include_once ("./includes/header.php");

    echo'
                <div class="container">
                        <div class="main-content">
                            <h3>Access Denied</h3>
                        </div>
                </div>';
    include_once("./includes/footer.php");
    echo'
            </body>
        </html>
        ';
}
?>