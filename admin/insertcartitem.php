<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["productid"]) && isset($_POST["quantity"]) && isset($_POST["price"]) && isset($_POST["cartid"])) {
    $productid = trim($_POST["productid"]);
    $quantity = trim($_POST["quantity"]);
    $price = trim($_POST["price"]);
    $cartid = trim($_POST["cartid"]);
    $_SESSION["productid"] = $productid;
    $_SESSION["quantity"] = $quantity;
    $_SESSION["price"] = $price;
    $_SESSION["cartid"] = $cartid;
    if (empty($productid) || (!is_numeric($quantity) && empty($quantity)) ||
            (!is_numeric($price) && empty($price)) || empty($cartid)) {
        $message = "Please Fill All Boxes";
    } elseif (is_numeric($price) && is_numeric($quantity)) {
        if ($price > 0 && $quantity > 0) {
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $table_name = "cartitems";
            $column_values = array();
            $column_values["productid"] = mysqli_escape_string($con, $productid);
            $column_values["quantity"] = (int) $quantity;
            $column_values["price"] = (int) $price;
            $column_values["cartid"] = mysqli_escape_string($con, $cartid);
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con, $query);
            if ($result) {
                $message = "Cart Item is Saved in System";
                $iserror = false;
            } else {
                $message = "Insertion Failure Due To : " . mysqli_error($con);
            }
            require("../api/CloseConnection.php");
        } else {
            $message = "Price and Quantity must be a positive number";
        }
    } else {
        $message = "Price and Quantity must be a number";
    }
} else {
    $message = "Insufficient Data Provided";
}
if ($iserror) {
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:addcartitem.php");
?>
