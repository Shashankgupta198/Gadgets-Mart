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
        $table_name = "categoryinfo";
        $column_values = array();
        //$column_values["courseid"] = addslashes($courseid);
        //$column_values["coursename"] = addslashes($coursename);
        $column_values["categoryid"] = mysqli_escape_string($con, $categoryid);
        $column_values["categoryname"] = mysqli_escape_string($con, $categoryname);
        $column_values["description"] = mysqli_escape_string($con, $description);
        $query = generateInsertQuery($table_name, $column_values);
        //$message = $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Category Information is Saved in System";
            $iserror = false;
        } else {
            $message = "Insertion Failure Due To : " . mysqli_error($con);
            if (strpos($message, "PRIMARY")) {
                $message = "Category ID is Already Taken By Some Other Category";
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
header("location:addcategory.php");
?>
