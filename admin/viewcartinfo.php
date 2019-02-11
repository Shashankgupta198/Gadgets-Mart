<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Cart Info : </h1>
<br>
<?php
if (isset($_SESSION["message"])) {
    $alert_class_name = "alert-success";
    if (isset($_SESSION["error"])) {
        unset($_SESSION["error"]);
        $alert_class_name = "alert-danger";
    }
    ?>
    <div class="alert <?php echo $alert_class_name; ?>">
        <?php
        echo $_SESSION["message"];
        ?>
    </div>
    <?php
    unset($_SESSION["message"]);
}
?>
<table class="table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Cart ID</th>
            <th>Username</th>
            <th>Cart Date</th>
            <th>Isorder</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select cartid ,username , cartdate, isorder ";
        $query .= " from cartinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["cartid"] . '</td>';
                echo '<td>' . $row["username"] . '</td>';
                echo '<td>' . $row["cartdate"] . '</td>';
                echo '<td>' . $row["isorder"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deletecartinfo.php?cartid=';
                echo urlencode($row["cartid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Cart</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["cartid"]) . "','" . addslashes($row["username"]) . "','" . urlencode($row["cartdate"]) . "','" . urlencode($row["isorder"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Category Details Saved in System';
            echo '</td></tr>';
        }
        ?>
    </tbody>
</table>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Cart Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updatecartinfo.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="username"> Enter Username : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
                        </div>        
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="cartdate"> Cart Date : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="cartdate" id="cartdate" value="<?php echo $cartdate; ?>">
                        </div>      
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="isorder"> Isorder : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="isorder" id="isorder"  value="<?php echo $isorder; ?>">
                        </div>        
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">Add Cart Info</button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>
<script>
    function setData(caid, uname, cdate, isorder) {
        $("#cartid").val(decodeURI(caid.replace(/\+/g, ' ')));
        $("#username").val(decodeURI(uname.replace(/\+/g, ' ')));
        $("#cartdate").val(decodeURI(cdate.replace(/\+/g, ' ')));
        $("#isorder").val(decodeURI(isorder.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>