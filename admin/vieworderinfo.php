<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Order Information : </h1>
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
            <th>Order ID</th>
            <th>Username</th>
            <th>Cart ID</th>
            <th>Order Date</th>
            <th>Shipping Date</th>
            <th>Order Status</th>
            <th>Shipping Address</th>
            <th>Payment Details</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select username ,cartid, orderdate, shippingdate, orderstatus, shippingaddress, paymentdetails  ";
        $query .= " from orderinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["orderid"] . '</td>';
                echo '<td>' . $row["username"] . '</td>';
                echo '<td>' . $row["cartid"] . '</td>';
                echo '<td>' . $row["orderdate"] . '</td>';
                echo '<td>' . $row["shippingdate"] . '</td>';
                echo '<td>' . $row["orderstatus"] . '</td>';
                echo '<td>' . $row["shippingaddress"] . '</td>';
                echo '<td>' . $row["paymentdetails"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deleteorderinfo.php?orderid=';
                echo urlencode($row["orderid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Order</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["orderid"]) . "','" . addslashes($row["username"]) . "','" . addslashes($row["cartid"])
                        . "','" . addslashes($row["orderdate"]) . "','" . addslashes($row["shippingdate"])
                        . "','" . addslashes($row["orderstatus"]) . "','" . addslashes($row["shippingaddress"])
                        . "','" . addslashes($row["paymentdetails"]) . "')";
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
                <h4 class="modal-title">Update Order Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updateoredrinfo.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="username"> Enter Username : </label>
                        </div>        
                        <div class="col-md-10">
                            <select class="form-control" name="username" id="username">
                                <option value="">Choose Username</option>
                                <?php
                                require_once("../api/OpenConnection.php");
                                $query = "select username from logininfo";
                                $result = mysqli_query($con, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_row($result)) {
                                        list($username) = $row;
                                        echo '<option value="' . $username . '">';
                                        echo $username;
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="cartid"> Enter Cart ID : </label>
                        </div>   
                        <div class="col-md-10">
                            <select class="form-control" name="cartid" id="cartid">
                                <option value="">Choose Cart</option>
                                <?php
                                require_once("../api/OpenConnection.php");
                                $query = "select cartid from cartinfo";
                                $result = mysqli_query($con, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_row($result)) {
                                        list($cartid) = $row;
                                        echo '<option value="' . $cartid . '">';
                                        echo $cartid;
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="orderdate"> Enter Order Date : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="datetime" class="form-control" name="orderdate" id="orderdate"  value="<?php echo $orderdate; ?>">
                        </div>        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="shippingdate"> Enter Shipping Date : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="datetime" class="form-control" name="shippingdate" id="shippingdate"  value="<?php echo $shippingdate; ?>">
                        </div>        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="orderstatus"> Enter Order Status : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="orderstatus" id="orderstatus"  value="<?php echo $orderstatus; ?>">
                        </div>        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="shippingaddress"> Enter Shipping Address: </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="shippingaddress" id="orderdate"  value="<?php echo $shippingaddress; ?>">
                        </div>        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="paymentdetails"> Enter Payment Details: </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="paymentdatails" id="paymentdetails"  value="<?php echo $paymentdetails; ?>">
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">Add Order Info</button>
                        </div>
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
    function setData(oid, uname, cid, odate, sdate, ostatus, sadd, paydet) {
        $("#orderid").val(decodeURI(oid.replace(/\+/g, ' ')));
        $("#username").val(decodeURI(uname.replace(/\+/g, ' ')));
        $("#cartid").val(decodeURI(cid.replace(/\+/g, ' ')));
        $("#orderdate").val(decodeURI(odate.replace(/\+/g, ' ')));
        $("#shippingdate").val(decodeURI(sdate.replace(/\+/g, ' ')));
        $("#orderstatus").val(decodeURI(ostatus.replace(/\+/g, ' ')));
        $("#shippingaddress").val(decodeURI(sadd.replace(/\+/g, ' ')));
        $("#paymentdetails").val(decodeURI(paydet.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>