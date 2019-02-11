<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["username"]) && isset($_POST["cartdate"]) && isset($_POST["isorder"])) {
    $username = trim($_POST["username"]);
    $cartdate = trim($_POST["cartdate"]);
    $isorder = trim($_POST["isorder"]);
    $_SESSION["username"] = $username;
    $_SESSION["cartdate"] = $cartdate;
    $_SESSION["isorder"] = $isorder;
    if (empty($username) || empty($cartdate) || empty($isorder)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $username = mysqli_escape_string($con, $username);
        $cartdate = mysqli_escape_string($con, $cartdate);
        $isorder = mysqli_escape_string($con, $isorder);
        $table_name = "cartinfo";
        $column_values = array();
        $column_values["username"] = $username;
        $column_values["cartdate"] = $cartdate;
        $column_values["isorder"] = $isorder;
        $where_values = array();
        $where_values["cartid"] = $cartid;
        $query = generateUpdateQuery($table_name, $column_values, $where_values);
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Cart Information is Updated in System";
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
header("location:viewcartinfo.php");
?>
