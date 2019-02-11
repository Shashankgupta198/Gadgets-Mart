<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["username"]) && isset($_POST["cartid"])
        && isset($_POST["orderdate"]) && isset($_POST["shippingdate"])
                && isset($_POST["orderstatus"]) && isset($_POST["shippingaddress"]) && isset($_POST["paymentdetails"])) {
    $username = trim($_POST["username"]);
    $cartid = trim($_POST["cartid"]);
    $orderdate = trim($_POST["orderdate"]);
    $shippingdate = trim($_POST["shippingdate"]);
    $orderstatus = trim($_POST["orderstatus"]);
    $shippingaddress = trim($_POST["shippingaddress"]);
    $paymentdetails = trim($_POST["paymentdetails"]);
    $_SESSION["username"] = $username;
    $_SESSION["cartid"] = $cartid;
    $_SESSION["orderdate"] = $orderdate;
    $_SESSION["shippingdate"] = $shippingdate;
    $_SESSION["orderstatus"] = $orderstatus;
    $_SESSION["shippingaddress"] = $shippingaddress;
    $_SESSION["paymentdetails"] = $paymentdetails;
    if (empty($username) || empty($cartid) ||
            empty($orderdate) || empty($shippingdate) || 
            empty($orderstatus) || empty($shippingdate) || empty($paymentdetails)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $table_name = "orderinfo";
        $column_values = array();
        $column_values["username"] = mysqli_escape_string($con, $username);
        $column_values["cartid"] = mysqli_escape_string($con, $cartid);
        $column_values["orderdate"] = mysqli_escape_string($con, $orderdate);
        $column_values["shippingdate"] = mysqli_escape_string($con, $shippingdate);
        $column_values["orderstatus"] = mysqli_escape_string($con, $orderstatus);
        $column_values["shippingaddress"] = mysqli_escape_string($con, $shippingaddress);
        $column_values["paymentdetails"] = mysqli_escape_string($con, $paymentdetails);
        $query = generateInsertQuery($table_name, $column_values);
        //$message = $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Order Information is Saved in System";
            $iserror = false;
        } else {
            $message = "Insertion Failure Due To : " . mysqli_error($con);
            if (strpos($message, "PRIMARY")) {
                $message = "Order ID is Already Taken By Some Other Order";
            }
        }
        require("../api/CloseConnection.php");
    }
} else {
    $message = "Insufficient Data Provided";
}
if ($iserror) {
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:addorderinfo.php");
?>

