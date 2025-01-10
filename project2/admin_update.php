<?php
session_start();

if(!(isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] == 1)){
    exit("Access Denied.");
}

require("admin_product.php");
require("admin_tools.php");

//initialize error catching array
$update_errors = '';

//check post fields and set to default value if left blank in order to new up product object.
if ($_POST['name'] == '') {
    $_POST['name'] = 'blank';
}
if ($_POST['description'] == '') {
    $_POST['description'] = 'blank';
}
if ($_POST['price'] == '') {
    $_POST['price'] = '-1';
}
if ($_POST['quantity'] == '') {
    $_POST['quantity'] = '-1';
}
if(empty($_FILES["image"]["name"])){
    $_POST['image'] = 'blank';
}
if ($_POST['rating'] == '') {
    $_POST['rating'] = '-1';
}

if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])){
    $filename = basename($_FILES['image']['name']);
    $directory = "./images/";
    $target_path = $directory . $filename;
    $temp_path = $_FILES['image']['tmp_name'];
    $max_size = 10 * 1024 * 1024;
    $filesize = $_FILES['image']['size'];

    if ($filesize <= $max_size) {
        if (!move_uploaded_file($temp_path, $target_path))
            $update_errors .= "Error uploading file.<br>";
    }

    //create product object with image file
    $product = new Tool(
        strip_tags($_POST["name"]),
        strip_tags($_POST["description"]),
        (float)strip_tags($_POST["price"]),
        (int)strip_tags($_POST["quantity"]),
        substr($target_path, 1), //removes the period at the beginning for DB compatibility
        (int)strip_tags($_POST["rating"]),
        (int)strip_tags($_POST['ProductID'])
    );
}

//create product object without image file
else{
    $product = new Tool(
        strip_tags($_POST["name"]),
        strip_tags($_POST["description"]),
        (float)strip_tags($_POST["price"]),
        (int)strip_tags($_POST["quantity"]),
        strip_tags($_POST["image"]),
        (int)strip_tags($_POST["rating"]),
        (int)strip_tags($_POST['ProductID'])
    );
    $file_success = 1;
}

//check each property and update the database value if not the default value
if($product->getName() != 'blank'){
    if(!$product->Update_Name())
        $update_errors .= "Error Updating Name<br>";
}
if($product->getDescription() != 'blank'){
    if(!$product->Update_Description())
        $update_errors .= "Error Updating Description<br>";
}
if($product->getPrice() != '-1'){
    if(!$product->Update_Price())
        $update_errors .= "Error Updating Price<br>";
}
if($product->getQuantity() != '-1'){
    if(!$product->Update_Quantity())
        $update_errors .= "Error Updating Quantity<br>";
}
if($product->getImage() != 'blank'){
    if(!$product->Update_Image())
        $update_errors .= "Error Updating Image<br>";
}
if($product->getRating() != '-1'){
    if(!$product->Update_Rating())
        $update_errors .= "Error Updating Rating<br>";
}

if(!empty($update_errors))
    header('Location: admin.php?update_errors='.$update_errors);
else
    header('Location: admin.php?success=1');