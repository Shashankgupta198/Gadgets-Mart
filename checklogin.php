<?php

session_start();
$message = "";
$iserror = true;
if (isset($_POST["uname"]) && isset($_POST["upass"])) {
    $uname = trim($_POST["uname"]);
    $upass = trim($_POST["upass"]);
    if (empty($uname) || empty($upass)) {
        $message = "Please Fill All Boxes";
    } else {
        require("api/OpenConnection.php");
        $query = "select username,password,rolename,lastlogin ";
        $query .= " from logininfo where username='${uname}'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_array($result);
            if($row["password"] == $upass ){
                if($row["rolename"] == "admin"){
                    $iserror = false;
                    $_SESSION["aname"] = $uname;
                    $_SESSION["lastlogin"] = $row["lastlogin"];
                    $query = "update logininfo set lastlogin=sysdate() ";
                    $query .= " where username='{$uname}'";
                    mysqli_query($con, $query);
                    header("Location:admin/index.php");
                }else if($row["rolename"] == "user"){
                    $iserror = false;
                    $_SESSION["uname"] = $uname;
                    $_SESSION["lastlogin"] = $row["lastlogin"];
                    $query = "update logininfo set lastlogin=sysdate() ";
                    $query .= " where username='{$uname}'";
                    mysqli_query($con, $query);
                    header("Location:user/index.php");
                }else{
                    $message = "User is not authorized. Contact Administrator";
                }
            }else{
                $message = "Invalid User Name and Password Given";
            }
        } else {
            $message = "Invalid User Name and Password Given";
        }
        require("api/CloseConnection.php");
    }
} else {
    $message = "Insufficient Data Provided";
}
$_SESSION["message"] = $message;

if ($iserror) {
    $_SESSION["error"] = "yes";
   header("location:login.php");
}
?>
