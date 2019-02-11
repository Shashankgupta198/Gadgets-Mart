<?php

session_start();
$message = "";
$iserror = true;
if (isset($_POST["productname"]) && isset($_POST["subcategoryid"]) && isset($_POST["companyid"]) && isset($_POST["price"]) && isset($_POST["description"]) && isset($_POST["discount"])) {
    $productname = trim($_POST["productname"]);
    $subcategoryid = trim($_POST["subcategoryid"]);
    $companyid = trim($_POST["companyid"]);
    $price = trim($_POST["price"]);
    $description = trim($_POST["description"]);
    $discount = trim($_POST["discount"]);
    $_SESSION["productname"] = $productname;
    $_SESSION["subcategoryid"] = $subcategoryid;
    $_SESSION["companyid"] = $companyid;
    $_SESSION["price"] = $price;
    $_SESSION["description"] = $description;
    $_SESSION["discount"] = $discount;
    if (empty($productname) || empty($subcategoryid) ||
            empty($companyid) || (!is_numeric($price) && empty($price)) ||
            empty($description) || (!is_numeric($discount) && empty($discount))) {
        $message = "Please Fill All Boxes";
    } elseif (is_numeric($price) && is_numeric( $discount)) {
        if ($price >0 && $discount >0) {
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $table_name = "productinfo";
            $column_values = array();
            $column_values["productname"] = mysqli_escape_string($con, $productname);
            $column_values["subcategoryid"] = mysqli_escape_string($con, $subcategoryid);
            $column_values["productid"] = mysqli_escape_string($con, $companyid);
            $column_values["price"] = (int) $price;
            $column_values["description"] = mysqli_escape_string($con, $description);
            $column_values["discount"] = (int) $discount;
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con, $query);
            if ($result) {
                $message = "Product Information is Saved in System";
                $iserror = false;
            } else {
                $message = "Insertion Failure Due To : " . mysqli_error($con);
                if (strpos($message, "PRIMARY")) {
                    $message = "Product ID is Already Taken By Some Other Product";
                }
            }
            require("../api/CloseConnection.php");
        } else {
            $message = "Price and Discount must be a positive number";
        }
    } else {
        $message = "Price and Discount must be a number";
    }
} else {
    $message = "Insufficient Data Provided";
}
if ($iserror) {
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:addproduct.php");
?>
