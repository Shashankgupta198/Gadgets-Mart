<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Order Details : </h1>
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
            <th>Details ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Order ID</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select productid, quantity, price, orderid";
        $query .= " from orderdetails";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["detailid"] . '</td>';
                echo '<td>' . $row["productid"] . '</td>';
                echo '<td>' . $row["quantity"] . '</td>';
                echo '<td>' . $row["price"] . '</td>';
                echo '<td>' . $row["orderid"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deleteorderdetails.php?detailid=';
                echo urlencode($row["detailid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Detail</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["detailid"]) . "','" . addslashes($row["productid"]) . "','" . addslashes($row["quantity"])
                        . "','" . addslashes($row["price"]) . "','" . addslashes($row["orderid"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Order Details Saved in System';
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
                <h4 class="modal-title">Update Order Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updateoredrdetails.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="productid"> Enter Product ID : </label>
                        </div>        
                        <div class="col-md-10">
                            <select class="form-control" name="productid" id="productid">
                                <option value="">Choose Product ID</option>
                                <?php
                                require_once("../api/OpenConnection.php");
                                $query = "select productid from productinfo";
                                $result = mysqli_query($con, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_row($result)) {
                                        list($productid) = $row;
                                        echo '<option value="' . $productid . '">';
                                        echo $productid;
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
                            <label for="quantity"> Enter  Quantity : </label>
                        </div>   
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="quantity" id="quantity"  value="<?php echo $quantity; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="price"> Enter Price : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" id="price"  value="<?php echo $price; ?>">
                        </div>        
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="orderid"> Enter Order ID: </label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="orderid" id="orderid">
                                <option value="">Choose Order ID</option>
                                <?php
                                require_once("../api/OpenConnection.php");
                                $query = "select orderid from orderinfo";
                                $result = mysqli_query($con, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_row($result)) {
                                        list($orderid) = $row;
                                        echo '<option value="' . $orderid . '">';
                                        echo $orderid;
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                }
                                ?>
                            </select>
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">Add Order Details</button>
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
    function setData(did, pid, quant, price, oid) {
        $("#detailid").val(decodeURI(did.replace(/\+/g, ' ')));
        $("#productid").val(decodeURI(pid.replace(/\+/g, ' ')));
        $("#quantity").val(decodeURI(quant.replace(/\+/g, ' ')));
        $("#price").val(decodeURI(price.replace(/\+/g, ' ')));
        $("#orderid").val(decodeURI(oid.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>