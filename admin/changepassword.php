<?php
session_start();
if (!isset($_SESSION["aname"])) {
    header("location:../login.php");
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> Change Password </h1>
        <h1><a href="signout.php">Log Out</a></h1>
        <form method="post">
            <label for="op">Old Password : </label>
            <input type="password" name="op" id="op"/><br><br>
            <label for="np">New Password : </label>
            <input type="password" name="np" id="np"/><br><br>
            <label for="cp">Confirm Password : </label>
            <input type="password" name="cp" id="cp"/><br><br>
            <input type="submit" value="Change Password">
        </form>
        <?php
        if (isset($_POST["op"]) && isset($_POST["np"]) && isset($_POST["cp"])) {
            $op = $_POST["op"];
            $np = $_POST["np"];
            $cp = $_POST["cp"];
            if (empty($op) || empty($np) || empty($cp)) {
                echo "<h1>Please Enter Some Value</h1>";
            } else if ($np == $cp) {
                require("../api/OpenConnection.php");
                $query = "update logininfo set password='{$np}' ";
                $query .= " where username='" . $_SESSION["aname"] . "' ";
                $query .= " and password='{$op}'";
                $result = mysqli_query($con, $query);
                if($result && mysqli_affected_rows($con)>0){
                    echo "<h1>Your New password has been Set</h1>";
                }else{
                    echo "<h1>New password does not set. Please Try Again</h1>";
                }
                require("../api/CloseConnection.php");
            } else {
                echo "<h1>Confirm Password must match with New Password</h1>";
            }
        }
        ?>
    </body>
</html>
