<?php

session_start();
$message = "";
$iserror = true;
if (isset($_POST["companyid"]) && isset($_POST["companyname"]) && isset($_POST["description"])) {
    $companyid = trim($_POST["companyid"]);
    $companyname = trim($_POST["companyname"]);
    $description = trim($_POST["description"]);
    $_SESSION["companyid"] = $companyid;
    $_SESSION["companyname"] = $companyname;
    $_SESSION["description"] = $description;
    if (empty($companyid) || empty($companyname) || empty($description)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $companyname = mysqli_escape_string($con, $companyname);
        $companyid = mysqli_escape_string($con, $companyid);
        $table_name = "companyinfo";
        $column_values = array();
        $column_values["companyname"] = $companyname;
        $column_values["description"] = $description;
        $where_values = array();
        $where_values["companyid"] = $companyid;
        $query = generateUpdateQuery($table_name, $column_values, $where_values);
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Company Information is Updated in System";
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
header("location:viewcompany.php");
?>
