<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["categoryid"]) && isset($_POST["categoryname"]) && isset($_POST["description"])) {
    $categoryid = trim($_POST["categoryid"]);
    $categoryname = trim($_POST["categoryname"]);
    $description = trim($_POST["description"]);
    $_SESSION["categoryid"] = $categoryid;
    $_SESSION["categoryname"] = $categoryname;
    $_SESSION["description"] = $description;
    if (empty($categoryid) || empty($categoryname) || empty($description)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $categoryname = mysqli_escape_string($con, $categoryname);
        $categoryid = mysqli_escape_string($con, $categoryid);
        $table_name = "categoryinfo";
        $column_values = array();
        $column_values["categoryname"] = $categoryname;
        $column_values["description"] = $description;
        $where_values = array();
        $where_values["categoryid"] = $categoryid;
        $query = generateUpdateQuery($table_name, $column_values, $where_values);
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Category Information is Updated in System";
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
header("location:viewcategory.php");
?>
