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
    $_SESSION["categoryname"] = $subcategoryname;
    $_SESSION["description"] = $description;
    if (empty($subcategoryid) || empty($categoryid) || empty($subcategoryname) || empty($description)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $table_name = "subcategoryinfo";
        $column_values = array();
        //$column_values["courseid"] = addslashes($courseid);
        //$column_values["coursename"] = addslashes($coursename);
        $column_values["subcategoryid"] = mysqli_escape_string($con, $subcategoryid);
        $column_values["categoryid"] = mysqli_escape_string($con, $categoryid);
        $column_values["subcategoryname"] = mysqli_escape_string($con, $subcategoryname);
        $column_values["description"] = mysqli_escape_string($con, $description);
        $query = generateInsertQuery($table_name, $column_values);
        //$message = $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Sub Category Information is Saved in System";
            $iserror = false;
        } else {
            $message = "Insertion Failure Due To : " . mysqli_error($con);
            if (strpos($message, "PRIMARY")) {
                $message = "SubCategory ID is Already Taken By Some Other Category";
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
header("location:addsubcategory.php");
?>
