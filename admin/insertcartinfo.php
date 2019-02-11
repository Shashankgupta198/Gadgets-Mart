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
        $table_name = "cartinfo";
        $column_values = array();
        $column_values["username"] = mysqli_escape_string($con, $username);
        $column_values["cartdate"] = mysqli_escape_string($con, $cartadte);
        $column_values["isorder"] = mysqli_escape_string($con, $isorder);
        $query = generateInsertQuery($table_name, $column_values);
        //$message = $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Cart Information is Saved in System";
            $iserror = false;
        } else {
            $message = "Insertion Failure Due To : " . mysqli_error($con);
            if (strpos($message, "PRIMARY")) {
                $message = "Cart ID is Already Taken By Some Other Cart";
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
header("location:addcartinfo.php");
?>
