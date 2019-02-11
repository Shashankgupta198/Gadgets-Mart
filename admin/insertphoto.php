<?php

session_start();
$message = "";
$iserror = true;
$photoname = "";
$extname = "";
$phototype = "";
$photosize = "";
$tmp_path = "";
$file_upload = false;
$productid = $_POST["productid"];
if (isset($_FILES["photoname"]) && $_FILES["photoname"]["error"] == 0) {
    $photoname = $_FILES["photoname"]["name"];
    $extname = strtolower(pathinfo($photoname, PATHINFO_EXTENSION));
    $extensions = " jpg,jpeg,png,bmp,gif";
    echo "<h1>{$extname}</h1>";
    echo "<h1>{$extensions}</h1>";
    $pos = strpos($extensions, $extname);
    echo "<h1>{$pos}</h1>";
    if ($pos === false) {
        echo " NOT MAGIC ";
        $message .= "Please Choose Any Valid Image Format<br>";
        $allvalid = false;
    } else {
        echo " MAGIC ";
        $phototype = $_FILES["photoname"]["type"];
        $photosize = $_FILES["photoname"]["size"];
        $tmp_path = $_FILES["photoname"]["tmp_name"];
        $file_upload = true;
    }
}
if ($file_upload) {
    require_once("../api/OpenConnection.php");
    require("../api/utility.php");
    $table_name = "productphoto";
    $column_values = array();
    $column_values["productid"] = (int) $productid;
    $column_values["extname"] = mysqli_escape_string($con, $extname);
    $column_values["photoname"] = mysqli_escape_string($con, $photoname);
    $column_values["phototype"] = mysqli_escape_string($con, $phototype);
    $column_values["photosize"] = (int) $photosize;
    $query = generateInsertQuery($table_name, $column_values);
    echo $query;
    $result = mysqli_query($con, $query);
    if ($result) {
        $photoid = mysqli_insert_id($con);
        $path = "../gad_photos/{$photoid}.{$extname}";
        move_uploaded_file($tmp_path, $path);
    }
}


$_SESSION["message"] = $message;
//header("location:addphoto.php");
?>
