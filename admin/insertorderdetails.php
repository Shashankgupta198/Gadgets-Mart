<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["productid"]) && isset($_POST["quantity"]) && isset($_POST["price"]) && isset($_POST["orderid"])) {
    $productid = trim($_POST["productid"]);
    $quantity = trim($_POST["quantity"]);
    $price = trim($_POST["price"]);
    $orderid = trim($_POST["orderid"]);
    $_SESSION["productid"] = $productid;
    $_SESSION["quantity"] = $quantity;
    $_SESSION["price"] = $price;
    $_SESSION["orderid"] = $orderid;
    if (empty($productid) || (is_numeric($quantity) && empty($quantity)) ||
            (is_numeric($price) && empty($price)) || empty($orderid)) {
        $message = "Please Fill All Boxes";
    } elseif (!is_numeric($_quantity) || (!is_numeric($_price))) {
        if ($quantity > 0 || $price > 0) {
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $table_name = "orderdetails";
            $column_values = array();
            $column_values["productid"] = mysqli_escape_string($con, $productid);
            $column_values["quantity"] = (int) $quantity;
            $column_values["price"] = (int) $price;
            $column_values["orderid"] = mysqli_escape_string($con, $orderid);
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con, $query);
            if ($result) {
                $message = "Order details is Saved in System";
                $iserror = false;
            } else {
                $message = "Insertion Failure Due To : " . mysqli_error($con);
                if (strpos($message, "PRIMARY")) {
                    $message = "Order Details is Already of Some Other Order";
                }
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
header("location:addorderdetails.php");
?>

