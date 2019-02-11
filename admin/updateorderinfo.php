<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["username"]) && isset($_POST["cartid"]
        ) && isset($_POST["orderdate"]) && isset($_POST["shippingdate"])
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
    if (empty($username) || empty($cartid)
            || empty($orderdate) || empty($shippingdate)
                    || empty($orderstatus) || empty($shippingaddress) || empty($paymentdetails)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $username = mysqli_escape_string($con, $username);
        $cartid = mysqli_escape_string($con, $cartid);
        $orderdate = mysqli_escape_string($con, $orderdate);
        $shippingdate = mysqli_escape_string($con, $shippingdate);
        $orderstatus = mysqli_escape_string($con, $orderstatus);
        $shippingaddress = mysqli_escape_string($con, $shippingaddress);
        $paymentdetails = mysqli_escape_string($con, $paymentdetails);
        $table_name = "orderinfo";
        $column_values = array();
        $column_values["username"] = $username;
        $column_values["cartid"] = $cartid;
        $column_values["orderdate"] = $orderdate;
        $column_values["shippingdate"] = $shippingdate;
        $column_values["orderstatus"] = $orderstatus;
        $column_values["shippingaddress"] = $shippingaddress;
        $column_values["paymentdetails"] = $paymentdetails;
        $where_values = array();
        $where_values["orderid"] = $orderid;
        $query = generateUpdateQuery($table_name, $column_values, $where_values);
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Order Information is Updated in System";
            $iserror = false;
        } else {
            $message = "Updation Failure Due To : " . mysqli_error($con);
        }
        require("../api/CloseConnection.php");
        //$message .= " ( {$query} )";
    }
} else {
    $message = "Insufficient Data Provided";
}
if ($iserror) {
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:vieworderinfo.php");
?>
