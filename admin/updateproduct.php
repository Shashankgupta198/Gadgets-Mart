<?php
session_start();
$message = "";
$iserror = true;
if (isset($_POST["productname"]) && isset($_POST["subcategoryid"]) && isset($_POST["companyid"]) && isset($_POST["price"]) && isset($_POST["description"]) && isset($_POST["discount"])) {
    $productname = trim($_POST["productname"]);
    $subcategoryid = trim($_POST["subcategoryid"]);
    $companyid = trim($_POST["companyid"]);
    $price = trim($_POST["price"]);
    $description = trim($_POST["description"]);
    $discount = trim($_POST["discount"]);
    $_SESSION["productname"] = $productname;
    $_SESSION["subategoryid"] = $subcategoryid;
    $_SESSION["companyid"] = $companyid;
    $_SESSION["price"] = $price;
    $_SESSION["description"] = $description;
    $_SESSION["discount"] = $discount;
    if (empty($productname) || empty($subcategoryid) || empty($companyid) || empty($price) || empty($description) || empty($discount)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        $productname = mysqli_escape_string($con, $productname);
        $subcategoryid = mysqli_escape_string($con, $subcategoryid);
        $companyid = mysqli_escape_string($con, $companyid);
        $price = (int)$price;
        $description = mysqli_escape_string($con, $description);
        $discount = (int)$discount;
        $table_name = "productinfo";
        $column_values = array();
        $column_values["productname"] = $productname;
        $column_values["subcategoryid"] = $subcategoryid;
        $column_values["companyid"] = $companyid;
        $column_values["price"] = $price;
        $column_values["description"] = $description;
        $column_values["discount"] = $discount;
        $where_values = array();
        $where_values["productid"] = $productid;
        $query = generateUpdateQuery($table_name, $column_values, $where_values);
        $result = mysqli_query($con, $query);
        if ($result) {
            $message = "Product Information is Updated in System";
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
header("location:viewproduct.php");
?>
