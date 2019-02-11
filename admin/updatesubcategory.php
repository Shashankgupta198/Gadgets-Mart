<?php

session_start();
$message = "";
$iserror = true;
if (isset($_POST["subcategoryid"]) && isset($_POST["categoryid"]) && isset($_POST["subcategoryname"]) && isset($_POST["description"])) {
    $subcategoryid = trim($_POST["subcategoryid"]);
    $categoryid = trim($_POST["categoryid"]);
    $subcategoryname = trim($_POST["subcategoryname"]);
    $description = trim($_POST["description"]);
    $_SESSION["subcategoryid"] = $subcategoryid;
    $_SESSION["categoryid"] = $categoryid;
    $_SESSION["subcategoryname"] = $subcategoryname;
    $_SESSION["description"] = $description;
    if (empty($subcategoryid) ||empty($categoryid) || empty($subcategoryname) || empty($description)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $subcategoryname = mysqli_escape_string($con, $subcategoryname);
        $subcategoryid = mysqli_escape_string($con, $subcategoryid);
        $table_name = "subcategoryinfo";
        $column_values = array();
       $column_values["categoryid"] = $categoryid; 
        $column_values["subcategoryname"] = $subcategoryname;
        $column_values["description"] = $description;
        $where_values = array();
        $where_values["subcategoryid"] = $subcategoryid;
        $query = generateUpdateQuery($table_name, $column_values, $where_values);
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Sub Category Information is Updated in System";
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
header("location:viewsubcategory.php");
?>
