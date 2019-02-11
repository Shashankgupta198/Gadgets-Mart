<?php
session_start();
$message = "";
$iserror = true;
if (isset($_GET["detailid"])) {
    $detailid = trim($_GET["detailid"]);
    if (empty($detailid)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $table_name = "orderdetails";
        $column_values = array();
        $column_values["detailid"] = $detailid;
        $query = generateDeleteQuery($table_name, $column_values);
        $result = mysqli_query($con, $query);
        if ($result && mysqli_affected_rows($con)>0) {
            $message = "Order Details is Removed from System";
            $iserror = false;
        } else {
            $message = "Deletion Failure Due To : " . mysqli_error($con);
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
header("location:vieworderdetails.php");
?>
