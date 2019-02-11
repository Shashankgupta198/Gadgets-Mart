<?php

session_start();
$message = "";
$iserror = true;
if (isset($_POST["username"]) && isset($_POST["sq"]) && isset($_POST["sans"])) {
    $username = trim($_POST["username"]);
    $sq = trim($_POST["sq"]);
    $sans = trim($_POST["sans"]);
    if (empty($username) || empty($sq) || empty($sans)) {
        $message = "Please Provide All Values";
    } else {
        require("api/OpenConnection.php");
        require("api/utility.php");
        $query = "select emailid ";
        $query .= " from logins where username='{$username}' ";
        $query .= " and sq = '{$sq}' and sans = '{$sans}'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $emailid = $row[0];
            $new_password = randomString(10);
            $query = "update logins set password='{$new_password}' ";
            $query .= " where username='{$username}'";
            $res = mysqli_query($con, $query);
            if ($res) {
                $message = "Your Reset Password : " . $new_password;
                if(sendEmail($emailid, "Password has been Reset", "<h1>{$message}</h1>")){
                    $message = "Your Reset Password has been sent to your registered EmailID";
                }else{
                    $message = "Your Reset Password : " . $new_password;
                }                
            } else {
                $message = "Your Password Does not reset";
            }
            mysqli_free_result($result);
        } else {
            $message = "Your Given Details does not match with our database records";
        }
        require("api/CloseConnection.php");
    }
} else {
    $message = "Insufficient Data Provided";
}
$_SESSION["message"] = $message;
if ($iserror) {
    $_SESSION["error"] = "yes";
}
header("location:forgot.php");
?>
