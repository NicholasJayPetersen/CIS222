<?php
session_start();

if(!(isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] == 1)){
    exit("Access Denied.");
}

require("admin_product.php");
require("admin_tools.php");

$add_success= 0;
$file_success = 0;

//upload image file and create product object
if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])){
    $filename = basename($_FILES['image']['name']);
    $directory = "./images/";
    $target_path = $directory . $filename;
    $temp_path = $_FILES['image']['tmp_name'];
    $max_size = 10 * 1024 * 1024;
    $filesize = $_FILES['image']['size'];

    if ($filesize <= $max_size) {
        if (move_uploaded_file($temp_path, $target_path)) {
            $file_success = 1;
        }
        else $file_success = 0;
    }

    //create product object with image file
    $product = new Tool(
        strip_tags($_POST["name"]),
        strip_tags($_POST["description"]),
        (float)strip_tags($_POST["price"]),
        (int)strip_tags($_POST["quantity"]),
        substr($target_path, 1), //removes the period at the beginning for DB compatibility
        (int)strip_tags($_POST["rating"]),
    );
}
//create product object without image file
else{
    $product = new Tool(
        strip_tags($_POST["name"]),
        strip_tags($_POST["description"]),
        (float)strip_tags($_POST["price"]),
        (int)strip_tags($_POST["quantity"]),
        '',
        (int)strip_tags($_POST["rating"]),
    );
    $file_success = 1;
}

//add product to database
$add_success = $product->Add_Product();

//generate user message
if($add_success == 1 && $file_success == 1){header("location:admin.php?success=1");}
elseif($add_success == 1 && $file_success == 0){header("location:admin.php?error=1");}
elseif($add_success == 0 && $file_success == 1){header("location:admin.php?error=2");}
else{header("location:admin.php?error=0");}
