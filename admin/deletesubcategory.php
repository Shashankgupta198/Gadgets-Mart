<?php

session_start();
$message = "";
$iserror = true;
if (isset($_GET["subcategoryid"])) {
    $subcategoryid = trim($_GET["subcategoryid"]);
    if (empty($subcategoryid)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $table_name = "subcategoryinfo";
        $column_values = array();
        $column_values["subcategoryid"] = $subcategoryid;
        $query = generateDeleteQuery($table_name, $column_values);
        $result = mysqli_query($con, $query);
        if ($result && mysqli_affected_rows($con)>0) {
            $message = "Sub Category Information is Removed from System";
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
header("location:viewsubcategory.php");
?>
