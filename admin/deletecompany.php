<?php

session_start();
$message = "";
$iserror = true;
if (isset($_GET["companyid"])) {
    $companyid = trim($_GET["companyid"]);
    if (empty($companyid)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $table_name = "companyinfo";
        $column_values = array();
        $column_values["companyid"] = $companyid;
        $query = generateDeleteQuery($table_name, $column_values);
        $result = mysqli_query($con, $query);
        if ($result && mysqli_affected_rows($con)>0) {
            $message = "Company Information is Removed from System";
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
header("location:viewcompany.php");
?>
