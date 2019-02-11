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
        $table_name = "companyinfo";
        $column_values = array();
        $column_values["companyid"] = mysqli_escape_string($con, $companyid);
        $column_values["companyname"] = mysqli_escape_string($con, $companyname);
        $column_values["description"] = mysqli_escape_string($con, $description);
        $query = generateInsertQuery($table_name, $column_values);
        //$message = $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Company Information is Saved in System";
            $iserror = false;
        } else {
            $message = "Insertion Failure Due To : " . mysqli_error($con);
            if (strpos($message, "PRIMARY")) {
                $message = "Company ID is Already Taken By Some Other Company";
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
header("location:addcompany.php");
?>
