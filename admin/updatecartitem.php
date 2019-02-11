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
    if (empty($productid) || (is_numeric($quantity) && empty($quantity)) || (is_numeric($price) && empty($price)) || empty($cartid)) {
        $message = "Please Fill All Boxes";
    } elseif (is_numeric($quantity) && is_numeric($price)) {
        if ($quantity > 0 && $price > 0) {
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $productid = mysqli_escape_string($con, $productid);
            $quantity = (int) $quantity;
            $price = (int) $price;
            $cartid = mysqli_escape_string($con, $cartid);
            $table_name = "cartitems";
            $column_values = array();
            $column_values["productid"] = $productid;
            $column_values["quantity"] = $quantity;
            $column_values["price"] = $price;
            $column_values["cartid"] = $cartid;
            $where_values = array();
            $where_values["itemid"] = $itemid;
            $query = generateUpdateQuery($table_name, $column_values, $where_values);
            $result = mysqli_query($con, $query);
            if ($result) {
                $message = "item Information is Updated in System";
                $iserror = false;
            } else {
                $message = "Updation Failure Due To : " . mysqli_error($con);
            }
            require("../api/CloseConnection.php");
            //$message .= " ( {$query} )";
        }
    }
} else {
    $message = "Insufficient Data Provided";
}
if ($iserror) {
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:viewcartitem.php");
?>
