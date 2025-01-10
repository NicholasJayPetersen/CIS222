<?php
session_start();

if(!(isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] == 1)){
    exit("Access Denied.");
}

require("admin_product.php");
require("admin_tools.php");

$discontinued = new Tool((int)strip_tags($_POST["ProductID"]));

if($discontinued->Discontinue_Product()){
    header("location:admin.php?success=1");
}
else{
    header("location:admin.php?error=3");
}